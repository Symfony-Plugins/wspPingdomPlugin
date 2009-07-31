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
 * Response class of Report_getNotifications function. It contains field for status of the performed operation, and field for list of notification objects.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetNotificationsResponse
 */
class PingdomApiReportGetNotificationsResponse extends PingdomApiResponse
{
  /**
   * Array of notification response items.
   *
   * @var array
   */
  private $notificationsResponseArray;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->getNotificationsResponseArray))
    {
      $this->notificationsResponseArray = array();
      foreach ($apiResponse->getNotificationsResponseArray as $eachNotificationResponse)
      {
      	$this->notificationsResponseArray[] = new PingdomApiReportGetNotificationsResponseItem($eachNotificationResponse);
      }
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Report_GetNotificationsResponse.', 9);
    }
  }

  /**
   * Get the notifications report.
   *
   * @return array of PingdomApiReportGetNotificationsResponseItem
   */
  public function getNotifications()
  {
    return $this->notificationsResponseArray;
  }
}