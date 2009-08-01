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
 * Request class of Report_getOutages function. It specifies which check should be analyzed, total time range for outage analysis, page of the results that will be returned, and number of results per page. To avoid flooding server and client with large data sets, number of results per page is limited to 50. Function Report_getOutages will not return more than 50 results per page, even if user requests greater number.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetOutagesRequest
 *
 * @throws PingdomApiInvalidArgumentException
 */
class PingdomApiReportGetOutagesRequest extends PingdomApiRequest
{
  /**
   * Name of the check for outage analysis.
   *
   * @var string
   */
  private $checkName;

  /**
   * Set the check for for outage analysis.
   *
   * @param string $name
   *
   * @return PingdomApiReportGetOutagesRequest this
   */
  public function setCheckName($name)
  {
    if (!$name)
    {
      throw new PingdomApiInvalidArgumentException('The given check name is invalid.', 10);
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