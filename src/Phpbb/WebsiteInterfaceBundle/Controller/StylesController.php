<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author PayBas
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StylesController extends Controller
{
    public function homeAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'styles',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:home.html.twig', $templateVariables);
    }

	public function supportAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:support.html.twig', $templateVariables);
	}

	public function installingAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:installing.html.twig', $templateVariables);
	}

	public function createAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:create.html.twig', $templateVariables);
	}

    public function teamOverviewAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'styles',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:team-overview.html.twig', $templateVariables);
    }

	public function juniorValidatorsAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:junior-validators.html.twig', $templateVariables);
	}

	public function sspAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles ssp',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:ssp.html.twig', $templateVariables);
	}

	public function ssp30xAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles ssp',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:ssp-30x.html.twig', $templateVariables);
	}

	public function demoAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles demo',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:demo.html.twig', $templateVariables);
	}

	public function demoNotReadyAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles demo',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:demoNotReady.html.twig', $templateVariables);
	}
}
