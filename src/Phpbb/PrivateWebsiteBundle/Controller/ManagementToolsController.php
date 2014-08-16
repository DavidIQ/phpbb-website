<?php
/**
 *
 * @package PrivateWebsiteBundle
 * @copyright (c) 2014 phpBB Group
 * @license Not for re-distribution
 * @author MichaelC
 *
 */

namespace Phpbb\PrivateWebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManagementToolsController extends Controller
{
	public function cacheClearAction(Request $request, $password)
	{
		$authorised = false;

		if ($password == 'B3rt13BeAr')
		{
			$input = new \Symfony\Component\Console\Input\ArgvInput(array('console','cache:clear', '--env=prod'));
			$application = new \Symfony\Bundle\FrameworkBundle\Console\Application($this->get('kernel'));
			$application->run($input);
			$authorised = true;
		}

		return $this->render('PhpbbPrivateWebsiteBundle::cache.html.twig', array(
			'authorised' 	=> $authorised,
			'cache'			=> 'clear',
		));
	}

	public function cacheWarmupAction(Request $request, $password)
	{
		$authorised = false;

		if ($password == 'B3rt13BeAr')
		{
			$input = new \Symfony\Component\Console\Input\ArgvInput(array('console','cache:warmup', '--env=prod'));
			$application = new \Symfony\Bundle\FrameworkBundle\Console\Application($this->get('kernel'));
			$application->run($input);
			$authorised = true;
		}

		return $this->render('PhpbbPrivateWebsiteBundle::cache.html.twig', array(
			'authorised' 	=> $authorised,
			'cache'			=> 'warmup',
		));
	}
}
