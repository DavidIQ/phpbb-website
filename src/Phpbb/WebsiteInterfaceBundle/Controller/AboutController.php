<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    public function homeAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'about',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:About:home.html.twig', $templateVariables);
    }

    public function historyAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'about history',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:About:history.html.twig', $templateVariables);
    }

    public function advertiseAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'about advertise-contact',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:About:advertise.html.twig', $templateVariables);
    }

    public function getInvolvedAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'get-involved',
            'FORUM_EVENTS'			=> '/community/search.php?keywords=%5BEVENT%5D&terms=all&fid%5B%5D=64&sc=1&sf=titleonly&sr=topics&sk=t&sd=d&st=0&ch=300&t=0&submit=Search',
            'TRANSLATIONS_APPLY'	=> '/languages/apply.php',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:About:getInvolved.html.twig', $templateVariables);
    }

    public function contactAction()
    {
        $templateVariables = array(
            'header_css_image'	=> 'contact',
            'ICON_POST_REPORT'	=> '/community/styles/prosilver/imageset/icon_post_report.gif',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:About:contact.html.twig', $templateVariables);
    }

    public function featureAction()
    {
        $templateVariables = array(
            'header_css_image'	=> 'about features',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:About:features.html.twig', $templateVariables);
    }

    public function launchAction()
    {
        $templateVariables = array(
            'header_css_image'  => 'about launch',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:About:launch.html.twig', $templateVariables);
    }
}
