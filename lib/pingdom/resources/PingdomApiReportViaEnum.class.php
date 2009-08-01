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
 * Enum class for defining status of report functions.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_Report_viaEnum
 */
class PingdomApiReportViaEnum
{
  const EMAIL = 'EMAIL';

  const SMS = 'SMS';

  /**
   * Get the list of all values of this Enum.
   *
   * @return array
   */
  public static final function getEnum() {
    return array(
      self::EMAIL,
      self::SMS,
    );
  }
}