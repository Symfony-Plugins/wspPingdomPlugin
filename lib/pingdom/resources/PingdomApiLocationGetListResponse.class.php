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
 * Response class of Location_getList function. It contains field for status of the performed operation, and field for list of available locations.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetLocationsResponse
 *
 * @throws PingdomApiInvalidResponseException
 */
class PingdomApiLocationGetListResponse extends PingdomApiResponse
{
  /**
   * Array of locations.
   *
   * @var array
   */
  private $locations;

  public function __construct(stdClass $apiResponse)
  {
    parent::__construct($apiResponse);

    if (isset($apiResponse->locationsArray))
    {
      $this->locations = $apiResponse->locationsArray;
    }
    else
    {
      throw new PingdomApiInvalidResponseException('The given response is no Location_GetListResponse.', 5);
    }
  }

  /**
   * Get the retrieved locations.
   *
   * @return array
   */
  public function getLocations()
  {
    return $this->locations;
  }
}