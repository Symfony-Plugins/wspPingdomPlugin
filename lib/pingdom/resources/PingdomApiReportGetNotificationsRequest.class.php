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
 * Request class of Report_getNotifications function. It specifies which checks, contacts, status and via should be analyzed, total time range, page number, and results per page for notifications analysis. To avoid flooding server and client with large data sets, total number of chunks is limited to 50. If number of chunks exceeds 50, If number of chunks exceeds 55, Report_getNotifications function will return 'Invalid argument' error.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetNotificationsRequest
 */
class PingdomApiReportGetNotificationsRequest extends PingdomApiRequest
{
  /**
   * Names of the checks for notifications analysis. If array is empty, all available checks are taken.
   *
   * @var array of string
   */
  private $checkNames = array();

  /**
   * Names of the contacts for notifications analysis. If array is empty, all available contacts are taken.
   *
   * @var array of string
   */
  private $contacts = array();

  /**
   * Status values for notifications analysis. If array is empty, all status values are taken.
   *
   * @see PingdomApiReportStatusEnum
   *
   * @var array of string
   */
  private $status = array();

  /**
   * Via values for notifications analysis. If array is empty, all via values are taken.
   *
   * @see PingdomApiReportViaEnum
   *
   * @var array of string
   */
  private $via = array();

  /**
   * Set the check for notification request.
   *
   * @param array $names
   *
   * @return PingdomApiReportGetNotificationsRequest this
   */
  public function setCheckNames(array $names)
  {
    foreach ($names as $key => $eachName)
    {
    	$names[$key] = (string) $eachName;
    }

    $this->checkNames = $names;

    return $this;
  }

  /**
   * Set the contacts for notification request.
   *
   * @param array $contacts
   *
   * @return PingdomApiReportGetNotificationsRequest this
   */
  public function setContacts(array $contacts)
  {
    foreach ($contacts as $key => $eachContact)
    {
    	$contacts[$key] = (string) $eachContact;
    }

    $this->contacts = $contacts;

    return $this;
  }

  /**
   * Set the status for notification request.
   *
   * @throws PingdomApiInvalidArgumentException
   *
   * @param array $status
   *
   * @return PingdomApiReportGetNotificationsRequest this
   */
  public function setStatus(array $status)
  {
    foreach ($status as $eachStatus)
    {
      if (!in_array($eachStatus, PingdomApiReportStatusEnum::getEnum()))
      {
        throw new PingdomApiInvalidArgumentException('The given status is invalid', 7);
      }
    }

    $this->status = $status;

    return $this;
  }

  /**
   * Set the via for notification request.
   *
   * @throws PingdomApiInvalidArgumentException
   *
   * @param array $via
   *
   * @return PingdomApiReportGetNotificationsRequest this
   */
  public function setVia(array $via)
  {
    foreach ($via as $eachVia)
    {
    	if (!in_array($eachVia, PingdomApiReportViaEnum::getEnum()))
    	{
        throw new PingdomApiInvalidArgumentException('The given via is invalid', 8);
    	}
    }

    $this->via = $via;

    return $this;
  }

  /**
   * Get the check names.
   *
   * @return array of string
   */
  public function getCheckNames()
  {
    return $this->checkNames;
  }

  /**
   * Get the contacts.
   *
   * @return array of string
   */
  public function getContacts()
  {
    return $this->contacts;
  }

  /**
   * Get the status.
   *
   * @return array of string
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Get the via.
   *
   * @return array of string
   */
  public function getVia()
  {
    return $this->via;
  }
}