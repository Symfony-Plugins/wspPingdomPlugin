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
 * Function Report_getLastDowns returns this as information of last down time for each check.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_LastDownEntry
 */
class PingdomApiReportLastDownEntry
{
  /**
   * The name of this entry.
   *
   * @var string
   */
  private $checkName;

  /**
   * The datetime of the last down of this entry.
   *
   * @var datetime | false
   */
  private $lastDown;

  public function __construct(stdClass $lastDownEntry)
  {
    if (isset($lastDownEntry->checkName))
    {
      $this->checkName = $lastDownEntry->checkName;
      if (isset($lastDownEntry->lastDown))
      {
        $this->lastDown = $lastDownEntry->lastDown;
      }
      else
      {
        $this->lastDown = false;
      }
    }
    else
    {
      throw new PingdomApiInvalidArgumentException('The given last down entry is invalid.', 4);
    }
  }

  /**
   * Get the check name of this entry.
   *
   * @return string
   */
  public function getCheckName()
  {
    return $this->checkName;
  }

  /**
   * Get the datetim of the last down.
   * Returns false, if this check was never down.
   *
   * @return datetime | false
   */
  public function getLastDown()
  {
    return $this->lastDown;
  }
}