<?php
/**
 * @author        Toni Uebernickel <toni@uebernickel.info>
 * @link          http://toni.uebernickel.info/
 *
 * @package       wspPingdomPlugin
 * @subpackage    unit.test
 * @version       $Id$
 * @link          $HeadURL$
 */

require_once(dirname(__FILE__) . '/../bootstrap/unit.php');

$plannedTests = 23;
$limeTest = new lime_test($plannedTests, new lime_output_color());

sfContext::createInstance(ProjectConfiguration::getApplicationConfiguration('mkt', 'test', true));

$pingdomApiClient = new PingdomApiClient();
$limeTest->isa_ok($pingdomApiClient, 'PingdomApiClient', 'PingdomApiClient created');

$pingdomApi = new PingdomApi();

$testEcho = 'Hello World!';
$limeTest->is($pingdomApi->getClient()->Test_echo($testEcho)->getOutString(), $testEcho, 'Pingdom API test echo');

$pingdomApi->login();
$limeTest->is($pingdomApi->getResponse()->getStatus(), PingdomApiClient::STATUS_OK, 'Pingdom API connect/auth');
$limeTest->isnt($pingdomApi->getClient()->getSessionId(), '', 'Session Id given');
$limeTest->isnt($pingdomApi->getClient()->getApiKey(), '', 'API key given');

$pingdomApi->logout();
$limeTest->is($pingdomApi->getResponse()->getStatus(), PingdomApiClient::STATUS_OK, 'Pingdom API logout');
$limeTest->is($pingdomApi->getClient()->getSessionId(), '', 'Session Id removed');
$limeTest->is($pingdomApi->getClient()->getApiKey(), '', 'API key removed');

# we are logged out, so this should not work
try
{
  $limeTest->is($pingdomApi->getClient()->getCheckList()->getStatus(), PingdomApiClient::STATUS_WRONG_IDENTIFICATION, 'API key check');
  $limeTest->fail('This point should not be reached.');
}
catch (PingdomApiException $e)
{
  $limeTest->isa_ok($e, 'PingdomApiInvalidResponseException', 'Exception caught');
}

# login, to ensure the upcoming request work
$pingdomApi->login();

$limeTest->isa_ok($pingdomApi->getClient()->getCheckList()->getCheckNames(), 'array', 'got list of checks');
$limeTest->isa_ok($pingdomApi->getClient()->getLocationList()->getLocations(), 'array', 'got list of locations');



$response = $pingdomApi->getClient()->getCurrentStates();
$limeTest->isa_ok($response, 'PingdomApiReportGetCurrentStatesResponse', 'current states response ok');
$limeTest->plan += count($response->getCurrentStates());
foreach ($response->getCurrentStates() as $eachCurrentState)
{
	/* @var $eachCurrentState PingdomApiReportCheckStateEntry */
	$limeTest->isa_ok($eachCurrentState, 'PingdomApiReportCheckStateEntry', 'check state entry ok');
}



$response = $pingdomApi->getClient()->getLastDowns();

$limeTest->isa_ok($response, 'PingdomApiReportGetLastDownsResponse', 'last donws response ok');
$limeTest->plan += count($response->getLastDowns()) * 2;
foreach ($response->getLastDowns() as $eachLastDown)
{
  /* @var $eachLastDown PingdomApiReportLastDownEntry */
  $limeTest->isa_ok($eachLastDown, 'PingdomApiReportLastDownEntry', 'last down entry ok');
  $limeTest->is(true, (($eachLastDown->getLastDown() instanceof DateTime) || ($eachLastDown->getLastDown() === false)), 'last down value ok');
}



# set up some DateTime parameters
$dateTimeZone = new DateTimeZone('Europe/Berlin');
$fromDate = new DateTime('-1 week', $dateTimeZone);
$toDate = new DateTime('now', $dateTimeZone);



$downtimeRequest = new PingdomApiReportGetDowntimesRequest();
$downtimeRequest->setFrom($fromDate);
$downtimeRequest->setTo($toDate);
$downtimeRequest->setCheckName($pingdomApi->getCheckName());
$downtimeRequest->setResolution(PingdomApiReportResolutionEnum::DAILY);
$response = $pingdomApi->getClient()->getDowntimes($downtimeRequest);

$limeTest->isa_ok($response, 'PingdomApiReportGetDowntimesResponse', 'notification response ok');
$limeTest->is($response->getStatus(), PingdomApiClient::STATUS_OK, 'got downtime report');
$limeTest->plan += count($response->getDowntimes());
foreach ($response->getDowntimes() as $eachDowntime)
{
	$limeTest->isa_ok($eachDowntime, 'PingdomApiReportDowntimeEntry', 'downtime entry ok');
}



$notificationRequest = new PingdomApiReportGetNotificationsRequest();
$notificationRequest->setFrom($fromDate);
$notificationRequest->setTo($toDate);
$notificationRequest->setStatus(array(PingdomApiReportStatusEnum::SENT));
$response = $pingdomApi->getClient()->getNotifications($notificationRequest);

$limeTest->isa_ok($response, 'PingdomApiReportGetNotificationsResponse', 'notification response ok');
$limeTest->is($response->getStatus(), PingdomApiClient::STATUS_OK, 'got notification report');
$limeTest->plan += count($response->getNotifications());
foreach ($response->getNotifications() as $eachNotification)
{
	/* @var $eachNotification PingdomApiReportGetNotificationsResponseItem */
	$limeTest->isa_ok($eachNotification, 'PingdomApiReportGetNotificationsResponseItem', 'notification item ok');
}



$outagesRequest = new PingdomApiReportGetOutagesRequest();
$outagesRequest->setCheckName($pingdomApi->getCheckName());
$outagesRequest->setFrom($fromDate);
$outagesRequest->setTo($toDate);
$response = $pingdomApi->getClient()->getOutages($outagesRequest);

$limeTest->isa_ok($response, 'PingdomApiReportGetOutagesResponse', 'outages response ok');
$limeTest->is($response->getStatus(), PingdomApiClient::STATUS_OK, 'got outages report');
$limeTest->plan += count($response->getOutages());
foreach ($response->getOutages() as $eachOutage)
{
	/* @var $eachOutage PingdomApiReportOutageEntry */
	$limeTest->isa_ok($eachOutage, 'PingdomApiReportOutageEntry', 'outage entry ok');
}



$rawdataRequest = new PingdomApiReportGetRawDataRequest();
$rawdataRequest->setCheckName($pingdomApi->getCheckName());
$rawdataRequest->setFrom($fromDate);
$rawdataRequest->setTo($toDate);
$response = $pingdomApi->getClient()->getRawData($rawdataRequest);

$limeTest->isa_ok($response, 'PingdomApiReportGetRawDataResponse', 'raw data response ok');
$limeTest->is($response->getStatus(), PingdomApiClient::STATUS_OK, 'got raw data report');
$limeTest->plan += count($response->getRawData());
foreach ($response->getRawData() as $eachRawData)
{
  /* @var $eachRawData PingdomApiReportRawDataEntry */
  $limeTest->isa_ok($eachRawData, 'PingdomApiReportRawDataEntry', 'raw data entry ok');
}



$responsetimeRequest = new PingdomApiReportGetResponseTimesRequest();
$responsetimeRequest->setCheckName($pingdomApi->getCheckName());
$responsetimeRequest->setFrom($fromDate);
$responsetimeRequest->setTo($toDate);
$responsetimeRequest->setResolution(PingdomApiReportResolutionEnum::DAILY);
$response = $pingdomApi->getClient()->getResponseTimes($responsetimeRequest);

$limeTest->isa_ok($response, 'PingdomApiReportGetResponseTimesResponse', 'response times response ok');
$limeTest->is($response->getStatus(), PingdomApiClient::STATUS_OK, 'got response times report');
$limeTest->plan += count($response->getResponseTimes());
foreach ($response->getResponseTimes() as $eachResponseTimeEntry)
{
	/* @var $eachResponseTimeEntry PingdomApiReportResponseTimeEntry */
	$limeTest->isa_ok($eachResponseTimeEntry, 'PingdomApiReportResponseTimeEntry', 'response time entry ok');
}