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

class PingdomApi
{
  const API_KEY = '66de9b3a058f7cf107234fecf1205b60';
  const CHECK_NAME = 'havvgs life';
  const TIME_PERIOD = 604799;

  const USERNAME = 'tuebernickel@gmail.com';
  const PASSWORD = '5D044d93?27ed';

  /**
   * A reference to a Pingdom API client.
   *
   * @var PingdomApiClient
   */
  private $pingdom;

  /**
   * A reference to the last API response.
   *
   * @var PingdomApiResponse
   */
  private $response;

  /**
   * constructor, initializing the PingdomApiClient
   *
   * @return void
   */
  public function __construct()
  {
    $this->pingdom = new PingdomApiClient();
  }

  /**
   * Login to Pingdom API.
   *
   * @return bool
   */
  public function login()
  {
    $this->response = $this->getClient()->authLogin(self::API_KEY, $this->getLoginCredentials());

    return ($this->response->getStatus() == PingdomApiClient::STATUS_OK);
  }

  /**
   * Logout from Pingdom API.
   *
   * @return bool
   */
  public function logout()
  {
    $this->response = $this->getClient()->authLogout();

    return ($this->response->getStatus() == PingdomApiClient::STATUS_OK);
  }

  /**
   * Get the Pingdom API client.
   *
   * @return PingdomApiClient
   */
  public function getClient()
  {
    return $this->pingdom;
  }

  /**
   * get the last response
   *
   * @return PingdomApiResponse
   */
  public function getResponse()
  {
    return $this->response;
  }

  /**
   * Get a soap enabled object of the login credentials.
   *
   * @return PingdomApiAuthCredentialsData
   */
  private function getLoginCredentials()
  {
    $login = new PingdomApiAuthCredentialsData();

    return $login->setUsername(self::USERNAME)->setPassword(self::PASSWORD);
  }
}