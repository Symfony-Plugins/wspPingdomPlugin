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
 * Request class of Report_getResponseTimes function. It specifies which check should be analyzed, total time range for response time analysis, resolution that divides total time range into chunks, and probe locations which should be included in response time analysis. To avoid flooding server and client with large data sets, total number of chunks is limited to 55. If number of chunks exceeds 55, Report_getResponseTimes function will return 'Invalid argument' error.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetResponseTimesRequest
 */
class PingdomApiReportGetResponseTimesRequest extends PingdomApiRequest
{
  /**
   * Name of the check for response time analysis.
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
   * Locations for response time analysis. If omitted, all available locations are taken.
   *
   * @var array of string
   */
  private $locations = array();

  /**
   * Set the check for downtime request.
   *
   * @param string $name
   *
   * @return void
   */
  public function setCheckName($name)
  {
    if (!$name)
    {
      throw new PingdomApiInvalidArgumentException('The given check name is invalid.', 14);
    }
    $this->checkName = $name;
  }

  /**
   * Set the resolution for response time request.
   *
   * @param string $resolution
   *
   * @return void
   */
  public function setResolution($resolution)
  {
    if (!in_array($resolution, PingdomApiReportResolutionEnum::getEnum()))
    {
      throw new PingdomApiInvalidArgumentException('The given resolution is invalid.', 15);
    }
    $this->resolution = $resolution;
  }

  /**
   * Set the locations for response time request.
   *
   * @param array $locations
   */
  public function setLocations(array $locations)
  {
    $this->locations = $locations;
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
  public function getResolution()
  {
    return $this->resolution;
  }

  /**
   * Get the locations.
   *
   * @return array
   */
  public function getLocations()
  {
    return $this->locations;
  }
}