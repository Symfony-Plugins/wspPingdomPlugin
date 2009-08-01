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
 * Class that encapsulates username and password used for Auth_login function.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_CredentialsData
 *
 * @todo work around the public username and password members
 */
class PingdomApiAuthCredentialsData
{
  /**
   * Registered Pingdom user's email address.
   *
   * @access private This property however is declared public for the SOAP client.
   *
   * @var string
   */
  public $username;

  /**
   * Registered Pingdom user's password.
   *
   * @access private This property however is declared public for the SOAP client.
   *
   * @var string
   */
  public $password;

  /**
   * Set the username for auth credentials.
   *
   * @param string $username
   *
   * @return PingdomAuthCredentials this
   */
  public function setUsername($username)
  {
    $this->username = $username;
    return $this;
  }

  /**
   * Set the password for auth credentials.
   *
   * @param string $password
   *
   * @return PingdomAuthCredentials this
   */
  public function setPassword($password)
  {
    $this->password = $password;
    return $this;
  }

  /**
   * Validate the credentials
   *
   * @return bool
   */
  public function validate()
  {
    return ($this->getUsername() != '' and $this->getPassword() != '');
  }

  /**
   * Get the current username.
   *
   * @return string
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Get the current password.
   *
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }
}