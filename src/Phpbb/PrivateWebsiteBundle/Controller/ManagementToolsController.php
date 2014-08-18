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
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class ManagementToolsController extends Controller
{
	public function cacheClearAction(Request $request, $password)
	{
		$authorised = false;

		if ('13d8e77501a7cc59f8ac2e237c7b4143' == md5(md5($password)))
		{
			$command = $this->container->get('phpbb.private_website.cache.clear');
			$input = new ArgvInput(array('--env=' . $this->container->getParameter('kernel.environment')));
			$output = new ConsoleOutput();
			$command->run($input, $output);

			$authorised = true;
		}

		return $this->render('PhpbbPrivateWebsiteBundle::cache.html.twig', array(
			'authorised'	=> $authorised,
			'cache'			=> 'clear',
			'header_css_image'      => 'home',
		));
	}

	public function cacheWarmupAction(Request $request, $password)
	{
		$authorised = false;

		if ('13d8e77501a7cc59f8ac2e237c7b4143' == md5(md5($password)))
		{
			$command = $this->container->get('phpbb.private_website.cache.warmup');
			$input = new ArgvInput(array('--env=' . $this->container->getParameter('kernel.environment')));
			$output = new ConsoleOutput();
			$command->run($input, $output);

			$authorised = true;
		}

		return $this->render('PhpbbPrivateWebsiteBundle::cache.html.twig', array(
			'authorised'	=> $authorised,
			'cache'			=> 'warmup',
			'header_css_image'      => 'home',
		));
	}
}
