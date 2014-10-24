<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Factory;
use Doctrine\Common\Cache\FilesystemCache;

class FilesystemCacheFactory
{
	protected $kernel;

	function __construct($kernel)
	{
		$this->kernel = $kernel;
	}

	public function get()
	{
		$cacheDirectory = $this->kernel->getCacheDir();

		return new FileSystemCache($cacheDirectory . '/Phpbb');
	}
}
