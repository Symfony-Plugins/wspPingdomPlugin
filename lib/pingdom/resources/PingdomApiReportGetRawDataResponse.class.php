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
 * Response class of Report_getRawData function. It contains field for status of the performed operation, and field for list of raw data objects.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetRawDataResponse
 */
class PingdomApiReportGetRawDataResponse extends PingdomApiResponse
{
  /**
   * Array of raw data objects.
   *
   * @var array of PingdomApiReportRawDataEntry
   */
  private $rawDataArray;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->rawDataArray))
    {
      $this->rawDataArray = array();
      foreach ($apiResponse->rawDataArray as $eachRawDataEntry)
      {
      	$this->rawDataArray[] = new PingdomApiReportRawDataEntry($eachRawDataEntry);
      }
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Report_GetRawDataResponse.', 11);
    }
  }

  /**
   * Get the raw data report.
   *
   * @return array of PingdomApiReportRawDataEntry
   */
  public function getRawData()
  {
    return $this->rawDataArray;
  }
}