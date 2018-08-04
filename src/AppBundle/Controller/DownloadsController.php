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
	public function homeAction(Request $request, $branch = 'latest')
	{
		$templateVariables = array(
			'U_UPDATE_INSTRUCTIONS'	=> '/support/documents.php?mode=install&version=3.2',
		);

		switch ($branch)
		{
			case 'latest':
				$view = 'AppBundle:Downloads:home.html.twig';
				break;

			default:
				$view = 'AppBundle:Downloads:previous-version.html.twig';
				break;
		}

		return $this->render($view, $templateVariables);
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
