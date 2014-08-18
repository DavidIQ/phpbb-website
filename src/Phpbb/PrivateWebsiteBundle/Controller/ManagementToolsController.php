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
use Symfony\Component\Console\Application as ConsoleApp;
use Symfony\Bundle\FrameworkBundle\Command\CacheClearCommand;
use Symfony\Bundle\FrameworkBundle\Command\CacheWarmupCommand;
use Symfony\Component\Console\Tester\CommandTester;

class ManagementToolsController extends Controller
{
	public function cacheClearAction(Request $request, $password)
	{
		$authorised = false;
		$output = false;

		if ($password == 'B3rt13BeAr')
		{
			$consoleApp = new ConsoleApp;
			$consoleApp->add(new CacheClearCommand());

			$command = $consoleApp->find('cache:clear');

			$commandTester = new CommandTester($command);

			$commandTester->execute(
				array('command' => $command->getName())
			);

			$output = $commandTester->getDisplay();

			$authorised = true;
		}

		return $this->render('PhpbbPrivateWebsiteBundle::cache.html.twig', array(
			'authorised'	=> $authorised,
			'cache'			=> 'clear',
			'output'		=> $ouput,
		));
	}

	public function cacheWarmupAction(Request $request, $password)
	{
		$authorised = false;

		if ($password == 'B3rt13BeAr')
		{
			$consoleApp = new ConsoleApp;
			$consoleApp->add(new CacheClearCommand());

			$command = $consoleApp->find('cache:warmup');

			$commandTester = new CommandTester($command);

			$commandTester->execute(
				array('command' => $command->getName())
			);

			$output = $commandTester->getDisplay();

			$authorised = true;
		}

		return $this->render('PhpbbPrivateWebsiteBundle::cache.html.twig', array(
			'authorised'	=> $authorised,
			'cache'			=> 'warmup',
			'output'		=> $ouput,
		));
	}
}
