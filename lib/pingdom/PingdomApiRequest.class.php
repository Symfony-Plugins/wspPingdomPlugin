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
 * A basic Pingdom API request.
 *
 * @see http://www.pingdom.com/services/api-documentation/
 */
class PingdomApiRequest {
  /**
   * Start of time period for notifications analysis.
   *
   * @var datetime
   */
  protected $fromDate;

  /**
   * End of time period for notifications analysis.
   *
   * @var datetime
   */
  protected $toDate;

  /**
   * Number of pages for notifications analysis.
   *
   * @var int
   */
  protected $pageNumber;

  /**
   * Number of results per page for notifications analysis.
   *
   * @var int defaults to 25
   */
  protected $resultsPerPage;

  /**
   * Set up the current Pingdom API Response.
   */
  public function __construct(DateTime $from = null, DateTime $to = null, $pageNumber = null, $resultsPerPage = null) {

    $this->toDate = $to;
    $this->pageNumber = $pageNumber;
    $this->resultsPerPage = $resultsPerPage;
  }


  /**
   * Set the date from which e.g. a report is retrieved.
   *
   * @param DateTime $from
   *
   * @return void
   */
  protected function setFrom(DateTime $from) {
    $this->fromDate = $from;
  }

  /**
   * Set the date to which e.g. a report is retrieved.
   *
   * @param DateTime $to
   *
   * @return void
   */
  protected function setTo(DateTime $to = null) {
    $this->toDate = $to;
  }

  /**
   * Set the page number to retrieve from multipage requests.
   *
   * @throws PingdomApiInvalidArgumentException
   *
   * @param int $pageNumber
   *
   * @return void
   */
  protected function setPageNumber($pageNumber) {
    if (is_numeric($pageNumber)) {
      $this->pageNumber = intval($pageNumber);
    } else {
      throw new PingdomApiInvalidArgumentException('The given page number is invalid.', 2);
    }
  }

  /**
   * Set the amount of results per page.
   *
   * @throws PingdomApiInvalidArgumentException
   *
   * @param int $resultsPerPage
   *
   * @return void
   */
  protected function setResultsPerPage($resultsPerPage) {
    if (is_numeric($resultsPerPage)) {
      $this->resultsPerPage = intval($resultsPerPage);
    } else {
      throw new PingdomApiInvalidArgumentException('The given results per page value is invalid.', 3);
    }
  }
}