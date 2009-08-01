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
 * Enum class for defining cause of report responses.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetNotificationsResponseItem
 */
class PingdomApiReportCauseEnum
{
  const UP = 'UP';

  const DOWN = 'DOWN';

  const TEST = 'TEST';

  const SYSTEM = 'SYSTEM';

  /**
   * Get the list of all values of this Enum.
   *
   * @return array
   */
  public static final function getEnum() {
    return array(
      self::UP,
      self::DOWN,
      self::TEST,
      self::SYSTEM,
    );
  }
}