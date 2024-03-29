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
 * Request class of Report_getDowntimes function. It specifies which check should be analyzed, total time range for downtime analysis, and resolution that divides total time range into chunks. To avoid flooding server and client with large data sets, total number of chunks is limited to 55. If number of chunks exceeds 55, Report_getDowntimes function will return 'Invalid argument' error.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetDowntimesRequest
 *
 * @throws PingdomApiInvalidArgumentException
 */
class PingdomApiReportGetDowntimesRequest extends PingdomApiRequest
{
  /**
   * Name of the check for downtime analysis.
   *
   * @var string
   */
  private $checkName;

  /**
   * Resolution for downtime analysis.
   *
   * @var string
   */
  private $resolution;

  /**
   * Set the check for downtime request.
   *
   * @throws PingdomApiInvalidArgumentException
   *
   * @param string $name
   *
   * @return PingdomApiReportGetDowntimesRequest this
   */
  public function setCheckName($name)
  {
    if (!$name)
    {
      throw new PingdomApiInvalidArgumentException('The given check name is invalid.', 5);
    }

    $this->checkName = $name;

    return $this;
  }

  /**
   * Set the resolution for downtime request.
   *
   * @throws PingdomApiInvalidArgumentException
   *
   * @param string $resolution
   *
   * @return PingdomApiReportGetDowntimesRequest this
   */
  public function setResolution($resolution)
  {
    if (!in_array($resolution, PingdomApiReportResolutionEnum::getEnum()))
    {
      throw new PingdomApiInvalidArgumentException('The given resolution is invalid.', 6);
    }

    $this->resolution = $resolution;

    return $this;
  }

  /**
   * Get the check name.
   *
   * @return string
   */
  public function getCheckName()
  {
    return $this->checkName;
  }

  /**
   * Get the resolution.
   *
   * @return string
   */
  public function getResolution() {
    return $this->resolution;
  }
}