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
 * Response class of Report_getDowntimes function. It contains field for status of the performed operation, and field for list of downtime objects for current user.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetDowntimesResponse
 *
 * @throws PingdomApiInvalidResponseException
 */
class PingdomApiReportGetDowntimesResponse extends PingdomApiResponse
{
  /**
   * Array of downtime objects, where each contains downtime info for a particular period of time.
   *
   * @var array of PingdomApiReportDowntimeEntry
   */
  private $downtimesArray;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->downtimesArray))
    {
      $this->downtimesArray = array();
      foreach ($apiResponse->downtimesArray as $eachDownTimeEntry)
      {
      	$this->downtimesArray[] = new PingdomApiReportDowntimeEntry($eachDownTimeEntry);
      }
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Report_GetDowntimesResponse.', 7);
    }
  }

  /**
   * Get the downtimes report.
   *
   * @return array of PingdomApiReportDowntimeEntry
   */
  public function getDowntimes()
  {
    return $this->downtimesArray;
  }
}