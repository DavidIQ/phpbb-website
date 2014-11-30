<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Factory;

class CacheFactory
{
	protected $cacheDriver;
	protected $container;

	function __construct($container, $cacheDriver)
	{
		$this->container = $container;
		$this->cacheDriver = $cacheDriver;
	}

	public function get()
	{
		return $this->container->get($this->cacheDriver);
	}
}
