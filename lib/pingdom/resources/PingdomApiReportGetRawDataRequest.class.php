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
 * Request class of Report_getRawData function. It specifies which check should be analyzed, total time range for raw data analysis, page of the results that will be returned, and number of results per page. To avoid flooding server and client with large data sets, number of results per page is limited to 50. Function Report_getRawData will not return more than 50 results per page, even if user requests greater number.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetRawDataRequest
 */
class PingdomApiReportGetRawDataRequest extends PingdomApiRequest
{
  /**
   * Name of the check for raw data analysis.
   *
   * @var string
   */
  private $checkName;

  /**
   * Set the check for downtime request.
   *
   * @param string $name
   *
   * @return PingdomApiReportGetRawDataRequest this
   */
  public function setCheckName($name)
  {
    if (!$name)
    {
      throw new PingdomApiInvalidArgumentException('The given check name is invalid.', 12);
    }

    $this->checkName = $name;

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
}