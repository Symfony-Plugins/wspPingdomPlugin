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
class PingdomApiRequest
{
  /**
   * Start of time period for notifications analysis.
   *
   * @var DateTime
   */
  protected $fromDate;

  /**
   * End of time period for notifications analysis.
   *
   * @var DateTime
   */
  protected $toDate;

  /**
   * Number of pages for notifications analysis.
   *
   * @var int
   */
  protected $pageNumber = 1;

  /**
   * Number of results per page for notifications analysis.
   *
   * @var int defaults to 25
   */
  protected $resultsPerPage = 25;

  /**
   * Set the date from which e.g. a report is retrieved.
   *
   * @param DateTime $from
   *
   * @return void
   */
  public function setFrom(DateTime $from)
  {
    $this->fromDate = $from;
  }

  /**
   * Set the date to which e.g. a report is retrieved.
   *
   * @param DateTime $to
   *
   * @return void
   */
  public function setTo(DateTime $to = null)
  {
    $this->toDate = $to;
  }

  /**
   * Get the from datetime.
   *
   * @return DateTime
   */
  public function getFrom() {
    return $this->fromDate;
  }

  /**
   * Get the to datetime.
   *
   * @return DateTime
   */
  public function getTo() {
    return $this->toDate;
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
  public function setPageNumber($pageNumber)
  {
    if (is_numeric($pageNumber))
    {
      $this->pageNumber = intval($pageNumber);
    }
    else
    {
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
  public function setResultsPerPage($resultsPerPage)
  {
    if (is_numeric($resultsPerPage))
    {
      $this->resultsPerPage = intval($resultsPerPage);
    }
    else
    {
      throw new PingdomApiInvalidArgumentException('The given results per page value is invalid.', 3);
    }
  }

  /**
   * Get the page number.
   *
   * @return int
   */
  public function getPageNumber() {
    return $this->pageNumber;
  }

  /**
   * Get the results per page.
   *
   * @return int
   */
  public function getResultsPerPage() {
    return $this->resultsPerPage;
  }
}