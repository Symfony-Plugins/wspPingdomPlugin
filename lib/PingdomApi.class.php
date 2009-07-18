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
  private $apiKey;
  private $checkName;
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

    $this->apiKey = sfConfig::get('app_wsp_pingdom_plugin_apikey', '');
    $this->checkName = sfConfig::get('app_wsp_pingdom_plugin_checkname', '');
  }

  /**
   * Get the check name for this api connection.
   *
   * @return string
   */
  public function getCheckName() {
    return $this->checkName;
  }

  /**
   * Login to Pingdom API.
   *
   * @return bool
   */
  public function login()
  {
    $this->response = $this->getClient()->authLogin($this->apiKey, $this->getLoginCredentials());

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

    return $login->setUsername(sfConfig::get('app_wsp_pingdom_plugin_username', ''))->setPassword(sfConfig::get('app_wsp_pingdom_plugin_password', ''));
  }
}