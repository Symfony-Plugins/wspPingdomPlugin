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
 * Response class of Report_getResponseTimes function. It contains field for status of the performed operation, and field for list of response time objects.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetResponseTimesResponse
 *
 * @throws PingdomApiInvalidResponseException
 */
class PingdomApiReportGetResponseTimesResponse extends PingdomApiResponse
{
  /**
   * Array of response time objects, where each contains response time info for a particular period of time.
   *
   * @var array of PingdomApiReportResponseTimeEntry
   */
  private $responseTimesArray;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->responseTimesArray))
    {
      $this->responseTimesArray = array();
      foreach ($apiResponse->responseTimesArray as $eachResponseTimeEntry)
      {
      	$this->responseTimesArray[] = new PingdomApiReportResponseTimeEntry($eachResponseTimeEntry);
      }
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Report_GetResponseTimesResponse.', 12);
    }
  }

  /**
   * Get the response times report.
   *
   * @return array of PingdomApiReportResponseTimeEntry
   */
  public function getResponseTimes()
  {
    return $this->responseTimesArray;
  }
}