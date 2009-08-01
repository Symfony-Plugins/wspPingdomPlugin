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
 * Class that describes one outage by defining its start and end.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_OutageEntry
 */
class PingdomApiReportOutageEntry
{
  /**
   * Outage start time.
   *
   * @var DateTime
   */
  private $fromDate;

  /**
   * Outage end time.
   *
   * @var DateTime
   */
  private $toDate;

  public function __construct(DateTime $from, DateTime $to)
  {
    $this->fromDate = $from;
    $this->toDate = $to;
  }

  /**
   * Get the datetime of the start time.
   *
   * @return DateTime
   */
  public function getFrom()
  {
    return $this->fromDate;
  }

  /**
   * Get the datetime of the end time.
   *
   * @return DateTime
   */
  public function getTo()
  {
    return $this->toDate;
  }
}