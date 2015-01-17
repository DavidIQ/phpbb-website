<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\Controller;

class ExtensionsControllerTest extends BootstrapTestSuite
{
	public function testExtensionsMain()
	{
		$objs = $this->setupTest('/extensions/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extensions') !== false, 'Title contains Extensions');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Extensions are the natural successor to modifications")')->count() > 0, 'Extensions Home Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsRules()
	{
		$objs = $this->setupTest('/extensions/rules-and-policies/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Rules and Policies') !== false, 'Title contains Extensions Rules and Policies');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Extension Database Submission & Validation Policies")')->count() > 0, 'Extensions Rules and Policies Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsRecDevs()
	{
		$objs = $this->setupTest('/extensions/recognised-developer/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Recognised Extension Developer') !== false, 'Title contains Recognised Extension Developer');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Do you write great code?")')->count() > 0, 'Extensions Recognised Developer Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsOfficialExts()
	{
		$objs = $this->setupTest('/extensions/official-extensions/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Official Extensions') !== false, 'Title contains Official Extensions');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("These are extensions created and maintained by the")')->count() > 0, 'Official Extensions Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsOfficialExtsTeam()
	{
		$objs = $this->setupTest('/extensions/official-extensions/team/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extensions Development Team') !== false, 'Title contains Extensions Development Team');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("The Extensions Development Team are extension authors that work under the mentorship of the Extensions Team to create")')->count() > 0, 'Extensions Development Team Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testJuniorValidators()
	{
		$objs = $this->setupTest('/extensions/junior-validators/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Junior Validators') !== false, 'Title contains Junior Validators');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("The task of a Junior Validator is test submitted extensions")')->count() > 0, 'Junior Validators Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsInstalling()
	{
		$objs = $this->setupTest('/extensions/installing/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Installing Extensions') !== false, 'Title contains Installing Extensions');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Installing an Extension")')->count() > 0, 'Installing Extensions Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsWriting()
	{
		$objs = $this->setupTest('/extensions/writing/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Writing Extensions') !== false, 'Title contains Writing Extensions');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Extensions are the natural successor to modifications")')->count() > 0, 'Writing Extensions Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsTeamOverViews()
	{
		$objs = $this->setupTest('/extensions/team-overview/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extensions Team Overview') !== false, 'Title contains Extensions Team Overview');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("The Extensions Team oversees all activities on phpBB.com with relation to extensions")')->count() > 0, 'Extensions Team Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsValidationPolicy()
	{
		$objs = $this->setupTest('/extensions/rules-and-policies/validation-policy/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extension Validation Policy') !== false, 'Title contains Extension Validation Policy');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("The following policies should be followed when developing extensions for phpBB")')->count() > 0, 'Validation Policy Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsDevRules()
	{
		$objs = $this->setupTest('/extensions/rules-and-policies/development-rules/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extension Development Rules and Guidelines') !== false, 'Title contains Extension Development Rules and Guidelines');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Licensing your Extension")')->count() > 0, 'Extensions Development Rules Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testExtensionsWritersRules()
	{
		$objs = $this->setupTest('/extensions/rules-and-policies/writers-rules/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extension Writers Rules and Guidelines') !== false, 'Title contains Extension Writers Rules and Guidelines');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Issues that may be discussed")')->count() > 0, 'Extensions Writers Rules Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	public function testEPV()
	{
		$objs = $this->setupTest('/extensions/epv/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'EPV - Extension Pre Validator') !== false, 'Title contains EPV - Extension Pre Validator');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("It is suggested that extension authors use EPV")')->count() > 0, 'EPV Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}
}
