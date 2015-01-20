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

class DevelopmentControllerTest extends BootstrapTestSuite
{
	public function testDevelopmentMain()
	{
		$objs = $this->setupTest('/development/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Development') !== false, 'Title contains Development');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("bug tracker, testing infrastructure, a wiki, a discussion board and various other helpful development tools. Visit this site to get involved in phpBB development.")')->count() > 0, 'Development Home Content Check');

		// Sidebar Check
		//$this->assertTrue($crawler->filter('html:contains("To receive information on new releases of phpBB as they become available you are advised to subscribe to our mailing list.")')->count() > 0, 'Development Home Sidebar Check 1');
		$this->assertTrue($crawler->filter('html:contains("Designing prosilver")')->count() > 0, 'Development Home Sidebar Check 2');
		$this->assertTrue($crawler->filter('html:contains("check out our sponsor")')->count() > 0, 'Development Home Sidebar Check 3');
		$this->assertTrue($crawler->filter('div.carbonad')->count() == 1, 'Check for Carbon Ads');

		// Standard All Page Checks
		$this->globalTests();

		// @TODO Test the Release Notification Box
	}

	public function testDevelopmentProsilver()
	{
		$objs = $this->setupTest('/development/prosilver/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Designing Prosilver') !== false, 'Title contains Designing Prosilver');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Designing prosilver")')->count() > 0, 'Prosilver Header Check');
		$this->assertTrue($crawler->filter('html:contains("Moving the info panel to the right-hand side so the focus is on the post content")')->count() > 0, 'Prosilver Page 1 Check');
		$this->assertTrue($crawler->filter('html:contains("July 2004: New smilies")')->count() > 0, 'Prosilver Sidebar Check');
		$this->assertTrue($crawler->filter('html:contains("February 2006: phpBB3 website")')->count() > 0, 'Prosilver Sidebar Check 2');
		$this->assertTrue($crawler->filter('a:contains("July 2004: New smilies")')->count() > 0, 'Prosilver Sidebar ');

		// Standard All Page Checks
		$this->globalTests();

		// @TODO Check for Images
	}

	public function testDevelopmentProsilverSpecificPage()
	{
		$objs = $this->setupTest('/development/prosilver/2');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Designing Prosilver') !== false, 'Title contains Designing Prosilver');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Designing prosilver")')->count() > 0, 'Prosilver Specific Page Header Check');
		$this->assertTrue($crawler->filter('html:contains("Started to think about how the admin layout could be better organised. An exciting thing to do on Valentines day I know")')->count() > 0, 'Prosilver Specific Page 1 Check');
		$this->assertTrue($crawler->filter('html:contains("July 2004: New smilies")')->count() > 0, 'Prosilver Specific Page Sidebar Check');
		$this->assertTrue($crawler->filter('html:contains("February 2006: phpBB3 website")')->count() > 0, 'Prosilver Specific Page Sidebar Check 2');
		$this->assertTrue($crawler->filter('a:contains("July 2004: New smilies")')->count() > 0, 'Prosilver Specific Page Sidebar ');

		// Standard All Page Checks
		$this->globalTests();
	}
}
