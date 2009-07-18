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
 * Response class of Test_echo function. It contains field for status of the performed operation, and field for echo string.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_EchoResponse
 */
class PingdomApiTestEchoResponse extends PingdomApiResponse
{
  /**
   * Out string.
   *
   * @var string
   */
  private $outString;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->outString))
    {
      $this->outString = $apiResponse->outString;
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Test_EchoResponse.', 2);
    }
  }

  /**
   * Get the retrieved out string.
   *
   * @return string
   */
  public function getOutString()
  {
    return $this->outString;
  }
}