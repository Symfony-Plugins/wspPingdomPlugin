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
 * Response class of Report_getCurrentStates function. It contains field for status of the performed operation, and field for list of current check states for current user.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetCurrentStatesResponse
 */
class PingdomApiReportGetCurrentStatesResponse extends PingdomApiResponse
{
  /**
   * Array of current check states.
   *
   * @var array
   */
  private $currentStates;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->currentStates))
    {
      $this->currentStates = array();
      foreach ($apiResponse->currentStates as $eachCurrentState)
      {
      	$this->currentStates[] = new PingdomApiReportCheckStateEntry($eachCurrentState);
      }
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Report_GetCurrentStatesResponse.', 6);
    }
  }

  /**
   * Get the current report states.
   *
   * @return array of PingdomApiReportCheckStateEntry
   */
  public function getCurrentStates()
  {
    return $this->currentStates;
  }
}