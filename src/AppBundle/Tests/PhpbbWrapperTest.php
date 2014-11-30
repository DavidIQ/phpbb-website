<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Tests;

use AppBundle\Wrappers\PhpbbHandling;

class PhpbbWrapperTest extends \PHPUnit_Framework_TestCase
{
	public function testBbcodeStripping()
	{
		$content = '[b:32fdkg1c]b[/b:32fdkg1c][i:32fdkg1c]i[/i:32fdkg1c][u:32fdkg1c]u[/u:32fdkg1c] [url=http&#58;//www&#46;phpbb&#46;com:32fdkg1c].com[/url:32fdkg1c] [size=85:32fdkg1c]sm[/size:32fdkg1c][color=#FF0000:32fdkg1c]re[/color:32fdkg1c][code:32fdkg1c]hi[/code:32fdkg1c][quote=&quot;MichaelC&quot;:32fdkg1c]hi[/quote:32fdkg1c][list:32fdkg1c][*:32fdkg1c]one[/*:m:32fdkg1c][*:32fdkg1c]another[/*:m:32fdkg1c][/list:u:32fdkg1c]';
		$uid = '32fdkg1c';
		$expected = ' b  i  u   .com   sm  re  hi  hi   one  another  ';

		$this->assertEquals(PhpbbHandling::bbcodeStripping($content, $uid), $expected);
	}
}
