<?php
/**
 * @author        Toni Uebernickel <toni@uebernickel.info>
 * @link          http://toni.uebernickel.info/
 *
 * @package       wspPingdomPlugin
 * @subpackage    resources.pingdom.lib
 * @version       $Id$
 * @link          $HeadURL$
 */

/**
 * Response class of Auth_login function. It contains field for status of the performed operation, and field for obtained session ID.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_LoginResponse
 *
 * @throws PingdomApiInvalidResponseException
 */
class PingdomApiAuthLoginResponse extends PingdomApiResponse
{
  /**
   * Session ID that will be used as authorization string for all web service calls. It expires after 30 minutes of inactivity, and cannot be used again. User can, however, log in again with the same credentials, and obtain new session ID
   *
   * @var string
   */
  private $sessionId;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->sessionId))
    {
      $this->sessionId = $apiResponse->sessionId;
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Auth_LoginResponse.', 3);
    }
  }

  /**
   * Get the retrieved session id.
   *
   * @return string
   */
  public function getSessionId()
  {
    return $this->sessionId;
  }
}