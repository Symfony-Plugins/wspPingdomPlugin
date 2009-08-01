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
 * Function Report_getCurrentStates return this as a state object for each check.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_CheckStateEntry
 */
class PingdomApiReportCheckStateEntry
{
  /**
   * Name of a check.
   *
   * @var string
   */
  private $checkName;

  /**
   * State of a check.
   *
   * @var string
   */
  private $checkState;

  /**
   * Time of last check.
   *
   * @var DateTime
   */
  private $lastCheckTime;

  public function __construct(stdClass $checkStateEntry)
  {
    if ($this->validate($checkStateEntry))
    {
      $this->checkName = $checkStateEntry->checkName;
      $this->checkState = $checkStateEntry->checkState;
      $this->lastCheckTime = new DateTime($checkStateEntry->lastCheckTime);
    }
    else
    {
      throw new PingdomApiInvalidArgumentException('The given check state entry is invalid.', 16);
    }
  }

  /**
   * Validate a given check state entry.
   *
   * @param stdClass $checkStateEntry
   *
   * @return bool
   */
  private function validate(stdClass $checkStateEntry)
  {
    if (!isset($checkStateEntry->checkName))
    {
      return false;
    }

    if (!isset($checkStateEntry->lastCheckTime))
    {
      return false;
    }

    if (!isset($checkStateEntry->checkState))
    {
      return false;
    }
    elseif (!in_array($checkStateEntry->checkState, PingdomApiReportCheckStateEnum::getEnum()))
    {
      return false;
    }

    return true;
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
}