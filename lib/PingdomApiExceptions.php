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

class PingdomApiException extends Exception { }

class PingdomApiCredentialsException extends PingdomApiException { }

class PingdomApiInvalidArgumentException extends PingdomApiException { }

class PingdomApiInvalidResponseException extends PingdomApiException { }