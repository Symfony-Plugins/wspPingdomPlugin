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
 * Function Report_getRawData returns this as object that describes one raw check.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_RawDataEntry
 */
class PingdomApiReportRawDataEntry
{
  /**
   * Check time.
   *
   * @var DateTime
   */
  private $checkTime;

  /**
   * Response time.
   *
   * @var float
   */
  private $responseTime;

  /**
   * Location.
   *
   * @var string
   */
  private $location;

  /**
   * Check state.
   *
   * @var string
   */
  private $checkState;


  public function __construct(stdClass $rawDataEntry)
  {
    if ($this->validate($rawDataEntry))
    {
      $this->checkTime = new DateTime($rawDataEntry->checkTime);
      $this->responseTime = (float) $rawDataEntry->responseTime;
      $this->location = $rawDataEntry->location;
      $this->checkState = $rawDataEntry->checkState;
    }
    else
    {
      throw new PingdomApiInvalidArgumentException('The given raw data entry is invalid.', 11);
    }
  }

  private function validate($rawDataEntry)
  {
    if (!isset($rawDataEntry->checkTime))
    {
      return false;
    }

    if (!isset($rawDataEntry->responseTime))
    {
      return false;
    }

    if (!isset($rawDataEntry->location))
    {
      return false;
    }

    if (!isset($rawDataEntry->checkState))
    {
      return false;
    }
    elseif (!in_array($rawDataEntry->checkState, PingdomApiReportCheckStateEnum::getEnum()))
    {
      return false;
    }

    return true;
  }

  /**
   * Get the check time.
   *
   * @return DateTime
   */
  public function getCheckTime()
  {
    return $this->checkTime;
  }

  /**
   * Get the location.
   *
   * @return string
   */
  public function getLocation()
  {
    return $this->location;
  }

  /**
   * Get the response time.
   *
   * @return float
   */
  public function getResponseTime()
  {
    return $this->responseTime;
  }

  /**
   * Get the check states.
   *
   * @return array
   */
  public function getCheckState()
  {
    return $this->checkState;
  }
}