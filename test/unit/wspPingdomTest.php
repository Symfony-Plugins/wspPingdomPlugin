<?php
/**
 * @author        Toni Uebernickel <toni@uebernickel.info>
 * @link          http://toni.uebernickel.info/
 *
 * @package       wspPingdom
 * @subpackage    unit.test
 * @version       $Id$
 * @link          $HeadURL$
 */

require_once(dirname(__FILE__) . '/../bootstrap/unit.php');

$limeTest = new lime_test(20, new lime_output_color());

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
$limeTest->isa_ok($pingdomApi->getClient()->getCurrentReportStates()->getCurrentStates(), 'array', 'got list of current report states');

$response = $pingdomApi->getClient()->getLastDownsReport();
foreach ($response->getLastDowns() as $eachLastDown)
{
  $limeTest->isa_ok($eachLastDown, 'PingdomApiReportLastDownEntry', 'last down entry ok');
}