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
 * Class that describes total downtime in one period of time.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_DowntimeEntry
 *
 * @throws PingdomApiInvalidArgumentException
 */
class PingdomApiReportDowntimeEntry
{
  /**
   * Start time of downtime analysis.
   *
   * @var string
   */
  private $from;

  /**
   * End time of downtime analysis.
   *
   * @var DateTime
   */
  private $to;

  /**
   * Total downtime duration in seconds.
   *
   * @var int
   */
  private $duration;

  public function __construct(stdClass $downtimeEntry)
  {
    if ($this->validate($downtimeEntry))
    {
      $this->from = new DateTime($downtimeEntry->from);
      $this->to = new DateTime($downtimeEntry->to);
      $this->duration = intval($downtimeEntry->duration);
    }
    else
    {
      throw new PingdomApiInvalidArgumentException('The given downtime entry is invalid.', 17);
    }
  }

  /**
   * Validate the given downtime entry.
   *
   * @param stdClass $downtimeEntry
   *
   * @return bool
   */
  private function validate(stdClass $downtimeEntry)
  {
    if (!isset($downtimeEntry->from))
    {
      return false;
    }

    if (!isset($downtimeEntry->to))
    {
      return false;
    }

    if (!isset($downtimeEntry->duration) or !is_numeric($downtimeEntry->duration))
    {
      return false;
    }

    return true;
  }

  /**
   * Get the end time of response time analysis.
   *
   * @return DateTime
   */
  public function getFrom()
  {
    return $this->from;
  }

  /**
   * Get the start time of response time analysis.
   *
   * @return DateTime
   */
  public function getTo()
  {
    return $this->to;
  }

  /**
   * Get the total downtime duration in seconds.
   *
   * @return int
   */
  public function getDuration()
  {
    return $this->duration;
  }
}