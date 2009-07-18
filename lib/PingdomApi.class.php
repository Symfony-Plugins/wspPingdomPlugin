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

class PingdomApi {
  const API_KEY = '';
  const CHECK_NAME = '';
  const TIME_PERIOD = 604799;

  const USERNAME = '';
  const PASSWORD = '';

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
  public function __construct() {
    $this->pingdom = new PingdomApiClient();
  }

  /**
   * Login to Pingdom API.
   *
   * @return bool
   */
  public function login() {
    $this->response = $this->getClient()->authLogin(self::API_KEY, $this->getLoginCredentials());

    return ($this->response->getStatus() == PingdomApiClient::STATUS_OK);
  }

  /**
   * Logout from Pingdom API.
   *
   * @return bool
   */
  public function logout() {
    $this->response = $this->getClient()->authLogout();

    return ($this->response->getStatus() == PingdomApiClient::STATUS_OK);
  }

  /**
   * Get the Pingdom API client.
   *
   * @return PingdomApiClient
   */
  public function getClient() {
    return $this->pingdom;
  }

  /**
   * get the last response
   *
   * @return PingdomApiResponse
   */
  public function getResponse() {
    return $this->response;
  }

  /**
   * Get a soap enabled object of the login credentials.
   *
   * @return PingdomApiAuthCredentialsData
   */
  private function getLoginCredentials() {
    $login = new PingdomApiAuthCredentialsData();

    return $login->setUsername(self::USERNAME)->setPassword(self::PASSWORD);
  }
}