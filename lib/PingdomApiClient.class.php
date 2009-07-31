<?php
/**
 * @author        Toni Uebernickel <toni@uebernickel.info>
 * @link          http://toni.uebernickel.info/
 *
 * @package       wspPingdomPlugin
 * @subpackage    lib
 * @version       $Id$
 * @link          $HeadURL$
 */

/**
 * This is a wrapper SoapClient providing Pingdom API access.
 *
 * @uses SoapClient
 * @see http://www.pingdom.com/services/api-documentation/
 */
class PingdomApiClient
{
  /**
   * The WSDL file for the Pingdom soap enbaled API.
   *
   * @var string
   */
  const SERVER_URL = 'https://ws.pingdom.com/soap/PingdomAPI.wsdl';

  /**
   * Everything went well.
   *
   * @see http://www.pingdom.com/services/api-documentation/list_statusCodes
   *
   * @var int
   */
  const STATUS_OK = 0;

  /**
   * One or more arguments are invalid.
   *
   * @see http://www.pingdom.com/services/api-documentation/list_statusCodes
   *
   * @var int
   */
  const STATUS_INVALID_ARGUMENT = 3;

  /**
   * An internal error occured.
   *
   * @see http://www.pingdom.com/services/api-documentation/list_statusCodes
   *
   * @var int
   */
  const STATUS_INTERNAL_ERROR = 4;

  /**
   * Your API key is wrong.
   *
   * @see http://www.pingdom.com/services/api-documentation/list_statusCodes
   *
   * @var int
   */
  const STATUS_WRONG_IDENTIFICATION = 5;

  /**
   * You don't have the privilege to call the function.
   *
   * @see http://www.pingdom.com/services/api-documentation/list_statusCodes
   *
   * @var int
   */
  const STATUS_WRONG_AUTHORIZATION = 6;

  /**
   * Username and/or password is/are not valid.
   *
   * @see http://www.pingdom.com/services/api-documentation/list_statusCodes
   *
   * @var int
   */
  const STATUS_WRONG_AUTHENTICATION = 7;

  /**
   * The internal soap client.
   *
   * @var SoapClient
   */
  private $soap;

  /**
   * The obtained session id from Auth_login.
   *
   * @var string
   */
  private $session_id = '';

  /**
   * The API key of the current connection.
   *
   * @var string
   */
  private $apiKey;

  /**
   * constructor of pingdom api client
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct(array $options = null)
  {
    # if no options are given
    if (is_null($options))
    {
      # set default options
      $options = array('trace' => 0, 'exceptions' => 0);
    }

    $this->soap = new SoapClient(self::SERVER_URL, $options);
  }

  /**
   * Get a string representation of the retrieved status code.
   *
   * @param int $code
   *
   * @return string
   */
  public function getStatusMessageByCode($code)
  {
    switch ($code)
    {
      case self::STATUS_OK:
        return 'Everything went well.';
      case self::STATUS_INVALID_ARGUMENT:
        return 'One or more arguments are invalid.';
      case self::STATUS_INTERNAL_ERROR:
        return 'An internal error occured.';
      case self::STATUS_WRONG_IDENTIFICATION:
        return 'Your API key is wrong.';
      case self::STATUS_WRONG_AUTHORIZATION:
        return 'You don\'t have the privilege to call the function.';
      case self::STATUS_WRONG_AUTHENTICATION:
        return 'Username and/or password is/are not valid.';
      default:
        return 'Unknown status code!';
    }
  }

  /**
   * Test the Pingdom API with a simple echo.
   *
   * @param string $string
   *
   * @return stdClass
   */
  public function Test_echo($string)
  {
    return new PingdomApiTestEchoResponse($this->soap->Test_echo($string));
  }

  /**
   * Call a method on the soap client with api key and session id.
   *
   * @param string $method
   * @param PingdomApiRequest $request
   *
   * @return stdClass
   */
  protected function callSoapClient($method, PingdomApiRequest $request = null)
  {
    if (!$method)
    {
      throw new PingdomApiException('Invalid method given.', 1);
    }

    # initialize the request for the soap client
    if ($request)
    {
      # we use the reflector to get all available getter methods
      $reflector = new ReflectionObject($request);
      $obj = new stdClass();

      /* @var $eachMethod ReflectionMethod */
      foreach ($reflector->getMethods(ReflectionMethod::IS_PUBLIC) as $eachMethod)
      {
        # retrieve the attributes name
        $attr = '';
        if (preg_match('/^get(.*)$/', $eachMethod->getName(), $attr))
        {
          $attr = strtolower(substr($attr[1], 0, 1)) . substr($attr[1], 1);

          if (!is_null($request->{$eachMethod->getName()}()))
          {
            # set the attribute for soap client
            $value = $request->{$eachMethod->getName()}();

            if ($value instanceof DateTime)
            {
              $value = $value->format(DateTime::W3C);
            }

            $obj->{$attr} = $value;
          }
        }
      }

      return $this->soap->{$method}($this->getApiKey(), $this->getSessionId(), $obj);
    }
    else
    {
      return $this->soap->{$method}($this->getApiKey(), $this->getSessionId());
    }
  }

  /**
   * Login to the Pingdom API
   *
   * @throws PingdomApiCredentialsException
   *
   * @param string $apiKey
   * @param PingdomApiAuthCredentialsData $credentials
   *
   * @return PingdomApiAuthLoginResponse
   */
  public function authLogin($apiKey, PingdomApiAuthCredentialsData $credentials)
  {
    if (!$credentials->validate())
    {
      throw new PingdomApiCredentialsException('Invalid credentials given for API Auth_login.', 1);
    }

    $response = new PingdomApiAuthLoginResponse($this->soap->Auth_login($apiKey, $credentials));
    $this->session_id = $response->getSessionId();
    $this->apiKey = $apiKey;

    return $response;
  }

  /**
   * Get the current Session Id.
   * This id is retrieved by login and remains empty until login() is called.
   *
   * @return string
   */
  public function getSessionId()
  {
    return $this->session_id;
  }

  /**
   * Get the current API Key.
   * This key is retrieved by login and remains empty until login() is called.
   *
   * @return string
   */
  public function getApiKey()
  {
    return $this->apiKey;
  }

  /**
   * Logout from Pingdom API
   *
   * @return PingdomApiAuthLogoutResponse
   */
  public function authLogout()
  {
    $response = new PingdomApiAuthLogoutResponse($this->callSoapClient('Auth_logout'));

    if ($response->getStatus() == self::STATUS_OK)
    {
      $this->session_id = '';
      $this->apiKey = '';
    }

    return $response;
  }

  /**
   * Returns names of user's checks.
   *
   * @see http://www.pingdom.com/services/api-documentation/operation_getCheckNames
   *
   * @return PingdomApiCheckGetListResponse
   */
  public function getCheckList()
  {
    return new PingdomApiCheckGetListResponse($this->callSoapClient('Check_getList'));
  }

  /**
   * Returns all Pingdom check locations.
   *
   * @return PingdomApiLocationGetListResponse
   */
  public function getLocationList()
  {
    return new PingdomApiLocationGetListResponse($this->callSoapClient('Location_getList'));
  }

  /**
   * Returns last state of every user's check.
   *
   * @return PingdomApiReportGetCurrentStatesResponse
   */
  public function getCurrentReportStates()
  {
    return new PingdomApiReportGetCurrentStatesResponse($this->callSoapClient('Report_getCurrentStates'));
  }

  /**
   * Returns a downtime report.
   *
   * @param PingdomApiReportGetDownTimesRequest $request
   *
   * @return PingdomApiReportGetDowntimesReponse
   */
  public function getDowntimesReport(PingdomApiReportGetDownTimesRequest $request)
  {
    return new PingdomApiReportGetDowntimesResponse($this->callSoapClient('Report_getDowntimes', $request));
  }

  /**
   * Returns the last downs.
   *
   * @return PingdomApiReportGetLastDownsResponse
   */
  public function getLastDownsReport()
  {
    return new PingdomApiReportGetLastDownsResponse($this->callSoapClient('Report_getLastDowns'));
  }

  /**
   * Returns the latest notifications.
   *
   * @param PingdomApiReportGetNotificationsRequest $request
   *
   * @return PingdomApiReportGetNotificationsResponse
   */
  public function getNotificationsReport(PingdomApiReportGetNotificationsRequest $request)
  {
    return new PingdomApiReportGetNotificationsResponse($this->callSoapClient('Report_getNotifications', $request));
  }
}