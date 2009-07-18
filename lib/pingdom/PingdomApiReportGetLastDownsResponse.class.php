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
 * Response class of Report_getLastDowns function. It contains field for status of the performed operation, and field for list of last down entries.
 *
 * @see http://www.pingdom.com/services/api-documentation/operation_getLastDowns
 */
class PingdomApiReportGetLastDownsResponse extends PingdomApiResponse
{
  /**
   * Array of last downs.
   *
   * @var array
   */
  private $lastDowns;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->lastDowns))
    {
      $this->lastDowns = array();
      foreach ($apiResponse->lastDowns as $eachDownEntry)
      {
        $this->lastDowns[] = new PingdomApiReportLastDownEntry($eachDownEntry);
      }
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Report_getLastDowns.', 8);
    }
  }

  /**
   * Get the last downs
   *
   * @return array
   */
  public function getLastDowns()
  {
    return $this->lastDowns;
  }
}