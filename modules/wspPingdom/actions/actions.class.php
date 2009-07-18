<?php
/**
 * @author        Toni Uebernickel <toni@uebernickel.info>
 * @link          http://toni.uebernickel.info/
 *
 * @package       wspPingdomPlugin
 * @subpackage    actions.wspPingdom.modules
 * @version       $Id: actions.class.php 19637 2009-06-28 10:49:48Z tuebernickel $
 * @link          $HeadURL$
 */

class wspPingdomActions extends sfActions
{
  /**
   * The index action of this module.
   *
   * @return string
   */
  public function executeIndex(sfWebRequest $request) {
    $pingdomApi = new PingdomApiClient();
  }
}