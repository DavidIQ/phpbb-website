<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

// Theses tests check the test suite as opposed to the actual application

namespace AppBundle\Tests;

class GeneralTest extends \PHPUnit_Framework_TestCase
{
	public function testGeneral()
	{
		$this->assertEquals(1, 1);
	}

	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testFailingInclude()
	{
		include 'not_existing_file.php';
	}
}
