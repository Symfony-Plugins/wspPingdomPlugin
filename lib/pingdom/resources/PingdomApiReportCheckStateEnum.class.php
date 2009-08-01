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
 * Enum class for defining check states of report responses.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_CheckState
 */
class PingdomApiReportCheckStateEnum
{
  const CHECK_UP = 'CHECK_UP';

  const CHECK_DOWN = 'CHECK_DOWN';

  const CHECK_UNKNOWN = 'CHECK_UNKNOWN';

  /**
   * Get the list of all values of this Enum.
   *
   * @return array
   */
  public static final function getEnum() {
    return array(
      self::CHECK_UP,
      self::CHECK_DOWN,
      self::CHECK_UNKNOWN,
    );
  }
}