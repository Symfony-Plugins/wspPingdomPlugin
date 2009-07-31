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
 * Class that describes response time in one period of time.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_ResponseTimeEntry
 */
class PingdomApiReportResponseTimeEntry
{
  /**
   * Start time of response time analysis.
   *
   * @var string
   */
  private $from;

  /**
   * End time of response time analysis.
   *
   * @var DateTime
   */
  private $to;

  /**
   * Average response time in milliseconds.
   *
   * @var float
   */
  private $responseTime;

  public function __construct(stdClass $responseTimeEntry)
  {
    if ($this->validate($responseTimeEntry))
    {
      $this->from = new DateTime($responseTimeEntry->from);
      $this->to = new DateTime($responseTimeEntry->to);
      $this->responseTime = (float) $responseTimeEntry->responseTime;
    }
    else
    {
      throw new PingdomApiInvalidArgumentException('The given response time entry is invalid.', 13);
    }
  }

  /**
   * Validate the given response time entry.
   *
   * @param stdClass $responseTimeEntry
   *
   * @return bool
   */
  private function validate(stdClass $responseTimeEntry)
  {
    if (!isset($responseTimeEntry->from))
    {
      return false;
    }

    if (!isset($responseTimeEntry->to))
    {
      return false;
    }

    if (!isset($responseTimeEntry->responseTime))
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
   * Get the average response time in milliseconds.
   *
   * @return float
   */
  public function getResponseTime()
  {
    return $this->responseTime;
  }
}