<?php
/**
 *
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Utilities\DownloadManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Download;

class DownloadsController extends Controller
{
	public function homeAction(Request $request, $branch = '3.1')
	{
		$downloadManager = $this->get('phpbb.downloadManager');
		$downloadManager->setBranch($branch);

		// Find out if we are updating files and if we are, from what version
		$mode = ($request->get('update', 0)) ? 'update' : 'stable';

		$selected_version = $request->get('version', '');
		if (!empty($selected_version) && $mode == 'update')
		{
			$downloadManager->setUpdate($selected_version);
		}

		$packagesInfo = $downloadManager->generatePackages();

		$packages = $packagesInfo['packages'];
		$versions = $packagesInfo['updateFromVersions'];

		$templateVariables = array(
			'versions' => $versions,
			'packages' => $packages,
		);

		$content = $this->renderView('AppBundle::downloads.html.twig', $templateVariables);
		$response = new Response($content);

		// Set caching headers
		$response->headers->set('X-Cache-Download-Json', $packagesInfo['caching'][0]);
		$response->headers->set('X-Cache-Download-Hashes', $packagesInfo['caching'][1]);
		$response->headers->set('X-Cache-Download-Packages', $packagesInfo['caching'][2]);

		return $response;
	}

	// public function downloadHandlerAction(Request $request, $package)
	// {
	// 	$download = new Download();
	// 	$download->setConfigurableOptions($package, $request->getClientIp());
	// 	$em = $this->getDoctrine()->getManager();
	// 	$em->persist($download);
	// 	$em->flush();

	// 	return $this->redirect(('https://download.phpbb.com/pub/release/' . $package), 301);
	// }

	// public function downloadRedirectHandlerAction(Request $request, $branch = 'latest')
	// {
	// 	$downloadManager = $this->get('phpbb.downloadManager');
	// 	$branch = ($branch == 'latest') ? '3.1' : $branch;
	// 	$downloadManager->setBranch($branch);
	// 	return $this->downloadHandlerAction($request, $downloadManager->getMainPackageName);
	// }
}
