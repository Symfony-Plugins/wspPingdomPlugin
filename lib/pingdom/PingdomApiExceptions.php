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

/**
 * General PingdomApi Exception.
 * All exceptions within this library are based on this one.
 *
 */
class PingdomApiException extends Exception { }

/**
 * Exception usually thrown on auth actions against the Pingdom API.
 *
 */
class PingdomApiCredentialsException extends PingdomApiException { }

/**
 * Exception thrown whenever a given argument is invalid.
 *
 */
class PingdomApiInvalidArgumentException extends PingdomApiException { }

/**
 * Exception thrown whenever a retrieved response object is not what's expected.
 *
 */
class PingdomApiInvalidResponseException extends PingdomApiException { }