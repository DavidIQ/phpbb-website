<?php
/**
 *
 * @copyright (c) 2016 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\Controller;

class VigLinkControllerTest extends BootstrapTestSuite
{
	public function testVigLinkUrl()
	{
		$objs = $this->setupTest('/viglink/convert?domain=foo.com&siteid=167a0418dd8ce3bf0ef00dfb6195f038&uuid=77950694654327856e6871014d69ad35&key=e4fd14f5d7f2bb6d80b8f8da1354718c');
		$crawler = $objs['crawler'];

		$this->assertTrue($this->client->getResponse()->isSuccessful(), 'Response is a sucessful one');
	}
}
