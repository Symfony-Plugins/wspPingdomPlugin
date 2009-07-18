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
 * Response class of Check_getList function. It contains field for status of the performed operation, and field for list of check names for current user.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_EchoResponse
 */
class PingdomApiCheckGetListResponse extends PingdomApiResponse {
  /**
   * Array of check names.
   *
   * @var array
   */
  private $checkNames;

  public function __construct(stdClass $apiResponse) {
    parent::__construct($apiResponse);

    if (isset($apiResponse->checkNames)) {
      $this->checkNames = $apiResponse->checkNames;
    } else {
      throw new PingdomApiInvalidResponseException('The given response is no Check_GetListResponse.', 4);
    }
  }

  /**
   * Get the retrieved check names.
   *
   * @return array
   */
  public function getCheckNames() {
    return $this->checkNames;
  }
}