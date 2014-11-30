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

class AboutControllerTest extends BootstrapTestSuite
{
	public function testAboutMain()
	{
		$objs = $this->setupTest('/about/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'About phpBB') !== false, 'Title contains About phpBB');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Millions of people use phpBB on a daily basis, making it the most widely used open source bulletin board system in the world.")')->count() > 0, 'About Home Content Check');
		$this->assertTrue($crawler->filter('a:contains("The History")')->count() > 0, 'About Home Sidebar Check');
		$this->assertTrue($crawler->filter('html:contains("Project External Links")')->count() > 0, 'About Home Sidebar Check 2');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testAboutHistory()
	{
		$objs = $this->setupTest('/about/history/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'History') !== false, 'Title contains About phpBB');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("phpBB was born as an open-source")')->count() > 0, 'About History Content Check');
		$this->assertTrue($crawler->filter('a:contains("Logos")')->count() > 0, 'About Home Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testAboutAdvertise()
	{
		$objs = $this->setupTest('/about/advertise/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Advertise with phpbb.com') !== false, 'Title contains About phpBB');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Static (non-rotating) text ads are possibly")')->count() > 0, 'About History Content Check');
		$this->assertTrue($crawler->filter('a:contains("Logos")')->count() > 0, 'About Home Sidebar Check');
		$this->assertTrue($crawler->filter('html:contains("ready to order advertising on phpBB.com")')->count() > 0, 'About History Content Check 2');
		$this->assertTrue($crawler->filter('html:contains("You may cancel your advertising with phpBB.com at any time")')->count() > 0, 'About History Content Check 3');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testGetInvolved()
	{
		$objs = $this->setupTest('/get-involved/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Get Involved with phpBB') !== false, 'Title contains Get Involved with phpBB');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Think you can help us with something not listed here or specific to the individual teams?")')->count() > 0, 'Get Involved Content Check');
		$this->assertTrue($crawler->filter('a:contains("Logos")')->count() > 0, 'About Home Sidebar Check');
		$this->assertTrue($crawler->filter('html:contains("Suggest changes and features")')->count() > 0, 'Get Involved Content Check 2');
		$this->assertTrue($crawler->filter('a:contains("apply here")')->count() > 0, 'Get Involved Content Check 3');

		// Standard All Page Checks
		$this->globalTests();
	}

	/*
	public function testGetInvolvedRedirects()
	{
		$objs = $this->setupTest('/about/get-involved/');
		$crawler = $objs['crawler'];

		$this->assertEquals('301', $this->response->getStatusCode(), 'About Get Involved Redirect');

		// Unset those so we can combine the two tests into one.
		unset($objs, $crawler);

		$objs = $this->setupTest('/development/about/get-involved/');
		$crawler = $objs['crawler'];

		$this->assertEquals('301', $this->response->getStatusCode(), 'Development Get Involved Redirect');
	}*/

	public function testContactMain()
	{
		$objs = $this->setupTest('/about/contact/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Contact phpBB') !== false, 'Title contains Contact phpBB(R)');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Who to contact concerning non-phpbb.com boards ")')->count() > 0, 'Contact Content Check');
		$this->assertTrue($crawler->filter('a:contains("Logos")')->count() > 0, 'Contact Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();

		// @TODO Test redirect for /about/contact_us.php
	}

	public function testFeaturesMain()
	{
		$objs = $this->setupTest('/about/features/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Features') !== false, 'Title contains Features');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("is now in its third major version. Version 3.1 incorporates a professional-quality modular")')->count() > 0, 'Feature Page Content Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testLaunch()
	{
		$this->setupTest('/about/launch/');

		// Standard All Page Checks
		$this->globalTests();
	}
}
