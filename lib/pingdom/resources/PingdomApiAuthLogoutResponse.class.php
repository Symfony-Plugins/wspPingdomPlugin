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
 * Response class of Auth_logout function. It contains only one field for status of the performed operation.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_LogoutResponse
 *
 * @throws PingdomApiInvalidResponseException
 */
class PingdomApiAuthLogoutResponse extends PingdomApiResponse
{
  /**
   * This response only returns a status code, which is handled by the PingdomApiResponse.
   */
}