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
 * @see http://www.pingdom.com/services/api-documentation/class_Report_statusEnum
 */
class PingdomApiReportStatusEnum
{
  const SENT = 'SENT';

  const DELIVERED = 'DELIVERED';

  const NOT_DELIVERED = 'NOT_DELIVERED';

  const NO_CREDITS = 'NO_CREDITS';

  const ERROR = 'ERROR';

  /**
   * Get the list of all values of this Enum.
   *
   * @return array
   */
  public static final function getEnum() {
    return array(
      self::SENT,
      self::DELIVERED,
      self::NOT_DELIVERED,
      self::NO_CREDITS,
      self::ERROR,
    );
  }
}