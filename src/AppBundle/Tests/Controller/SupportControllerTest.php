<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\Controller;

class SupportControllerTest extends BootstrapTestSuite
{
	public function testSupportMain()
	{
		$objs = $this->setupTest('/support/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Support') !== false, 'Title contains Support');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Having installation problems? Is the database giving you trouble?")')->count() > 0, 'Support Home Content Check');
		$this->assertTrue($crawler->filter('a:contains("Code Changes")')->count() > 0, 'Support Home Sidebar Check');
		//$this->assertTrue($crawler->filter('html:contains("To receive information on new releases of phpBB as they become available you are")')->count() > 0, 'Support Home Sidebar Check 2');
		$this->assertTrue($crawler->filter('a:contains("Bug Tracker")')->count() > 0, 'About Home Sidebar Check 3');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testSupportIrc()
	{
		$objs = $this->setupTest('/support/irc/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'IRC Support') !== false, 'Title contains IRC Support');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("The main phpBB IRC channel is")')->count() > 0, 'Support IRC Content Check');
		$this->assertTrue($crawler->filter('a:contains("Code Changes")')->count() > 0, 'Support IRC Sidebar Check');
		$this->assertTrue($crawler->filter('html:contains("check out our sponsor")')->count() > 0, 'Support IRC Sidebar Check 2');

		// Standard All Page Checks
		$this->globalTests();
	}
}
