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
 * Response class of Report_getOutages function. It contains field for status of the performed operation, and field for list of outage objects.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetOutagesResponse
 */
class PingdomApiReportGetOutagesResponse extends PingdomApiResponse
{
  /**
   * Array of outage objects, where each contains one outage info.
   *
   * @var array of PingdomApiReportOutageEntry
   */
  private $outagesArray;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->outagesArray))
    {
      $this->outagesArray = array();
      foreach ($apiResponse->outagesArray as $eachOutage)
      {
      	$this->outagesArray[] = new PingdomApiReportOutageEntry(new DateTime($eachOutage->from), new DateTime($eachOutage->to));
      }
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Report_GetOutagesResponse.', 10);
    }
  }

  /**
   * Get the outages report.
   *
   * @return array of PingdomApiReportOutageEntry
   */
  public function getOutages()
  {
    return $this->outagesArray;
  }
}