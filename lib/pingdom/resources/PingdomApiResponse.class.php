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
 * A basic Pingdom API response.
 *
 * @see http://www.pingdom.com/services/api-documentation/
 *
 * @throws PingdomApiInvalidArgumentException
 * @throws PingdomApiInvalidResponseException
 */
class PingdomApiResponse
{
  /**
   * Status of performed function.
   *
   * @var int
   */
  protected $status;

  /**
   * Set up the current Pingdom API Response.
   */
  public function __construct(stdClass $apiResponse)
  {
    if (isset($apiResponse->status))
    {
      $this->setStatus($apiResponse->status);
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no valid Pingdom API response.', 1);
    }
  }

  /**
   * Set the current status code.
   *
   * @throws PingdomApiInvalidArgumentException
   *
   * @param int $status
   *
   * @return PingdomApiResponse this
   */
  protected final function setStatus($status)
  {
    if (is_numeric($status))
    {
      $this->status = intval($status);

      return $this;
    }
    else
     {
      throw new PingdomApiInvalidArgumentException('The given status code is invalid.', 1);
    }
  }

  /**
   * Get the retrieved status code.
   *
   * @return int
   */
  public function getStatus()
  {
    return $this->status;
  }
}