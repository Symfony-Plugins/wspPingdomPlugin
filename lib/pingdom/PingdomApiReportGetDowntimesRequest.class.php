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
 * Request class of Report_getDowntimes function. It specifies which check should be analyzed, total time range for downtime analysis, and resolution that divides total time range into chunks. To avoid flooding server and client with large data sets, total number of chunks is limited to 55. If number of chunks exceeds 55, Report_getDowntimes function will return 'Invalid argument' error.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetDowntimesRequest
 */
class PingdomApiReportGetDowntimesRequest extends PingdomApiRequest
{

}