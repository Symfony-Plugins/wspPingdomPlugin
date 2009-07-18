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
 * Enum class for defining resolution of report functions.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_ResolutionEnum
 */
class PingdomApiReportResolutionEnum
{
  const DAILY = 'DAILY';

  const WEEKLY = 'WEEKLY';

  const MONTHLY = 'MONTHLY';

  /**
   * Get the list of all values of this Enum.
   *
   * @return array
   */
  public static final function getEnum() {
    return array(
      self::DAILY,
      self::WEEKLY,
      self::MONTHLY,
    );
  }
}