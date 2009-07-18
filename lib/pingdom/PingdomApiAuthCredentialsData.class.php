<?php
/**
 * @author        Toni Uebernickel <toni@uebernickel.info>
 * @link          http://toni.uebernickel.info/
 *
 * @package       wspPingdomPlugin
 * @subpackage    pingdom.lib
 * @version       $Id$
 * @link          $HeadURL$
 */

class PingdomApiAuthCredentialsData {
  public $username;

  public $password;

  /**
   * set the username for auth credentials
   *
   * @param string $username
   *
   * @return PingdomAuthCredentials (this)
   */
  public function setUsername($username) {
    $this->username = $username;
    return $this;
  }

  /**
   * set the password for auth credentials
   *
   * @param string $password
   *
   * @return PingdomAuthCredentials (this)
   */
  public function setPassword($password) {
    $this->password = $password;
    return $this;
  }

  /**
   * validate the credentials
   *
   * @return bool
   */
  public function validate() {
    return ($this->username != '' and $this->password != '');
  }
}