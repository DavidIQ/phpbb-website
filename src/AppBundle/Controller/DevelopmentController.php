<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DevelopmentController extends Controller
{
	public function prosilverAction($page = 1)
	{
		$templateVariables = array();

		$data = $this->getProsilverPageData();

		$i = 1;

		$toc = array();
		$var = array();

		foreach ($data as $item) {
			$var['TITLE']	= $item['DATE'];
			$var['ITEM']	= '/development/prosilver/' . $i;
			$var['ID']		= $i;

			$toc[$i] = $var;

			$i++;
		}

		$templateVariables += array(
			'TOC'					=> $toc,
			'MENU_COUNT' 			=> count($toc),

			'PAGE'					=> $page,

			'DATE_TITLE'			=> $data[$page]['DATE'],
			'CAPTION'				=> $data[$page]['TEXT'],

			'IMAGE'		=> ('/assets/images/prosilver/' . $data[$page]['IMAGE']),

			'NEXT_PAGE'	=> (isset($data[$page + 1])) ? ('/development/prosilver/' . ($page + 1)) : '',
			'PREV_PAGE'	=> (isset($data[$page - 1])) ? ('/development/prosilver/' . ($page - 1)) : '',

			'IN_DEV_PROSILVER'	=> true,);

		return $this->render('AppBundle:Development:prosilver.html.twig', $templateVariables);
	}

	private function getProsilverPageData()
	{
		$data = array(
			1 	=> array(
				'DATE' 	=> 'Feb 8th 2004: The first interface concept',
				'TEXT' 	=> 'Moving the info panel to the right-hand side so the focus is on the post content',
				'IMAGE'	=> 'prosilver_history01.jpg'),
			2 	=> array(
				'DATE' 	=> 'Feb 14th 2004: The first admin concept',
				'TEXT' 	=> 'Started to think about how the admin layout could be better organised. An exciting thing to do on Valentines day I know...',
				'IMAGE'	=> 'prosilver_history02.jpg'),
			3 	=> array(
				'DATE' 	=> 'Feb 24th 2004: An example topic page ',
				'TEXT' 	=> 'This page is trying different ideas with the side panel and links',
				'IMAGE'	=> 'prosilver_history03.jpg'),
			4 	=> array(
				'DATE' 	=> 'June 2004: Board index',
				'TEXT' 	=> 'There was quite a gap between the first flurry of activity and this board index design. Must have been busy with other stuff.',
				'IMAGE'	=> 'prosilver_history04.jpg'),
			5 	=> array(
				'DATE' 	=> 'July 2004: Board index',
				'TEXT' 	=> 'By now a fully marked-up version of this design was running on our super-sekrit testing forum that had frequent bug infestations...',
				'IMAGE'	=> 'prosilver_history05.jpg'),
			6 	=> array(
				'DATE' 	=> 'July 2004: New smilies',
				'TEXT' 	=> 'Why not have more face shaped smilies? I tried a few concepts of graphic elements for the new website. Also the first sign of a new logo idea.',
				'IMAGE'	=> 'prosilver_history06.jpg'),
			7 	=> array(
				'DATE' 	=> 'August 2004: Colour variations',
				'TEXT' 	=> 'Some half-hearted attempts at trying different colour schemes. Was never really that happy with the silver and beige shades.',
				'IMAGE'	=> 'prosilver_history07.jpg'),
			8	=> array(
				'DATE' 	=> 'November 2004: proSilver MkII',
				'TEXT' 	=> 'I wasn\'t happy with the previous colour scheme, so MkII used a much stronger palette.',
				'IMAGE'	=> 'prosilver_history08.jpg'),
			9 	=> array(
				'DATE' 	=> 'December 2004: proSilver MkII',
				'TEXT' 	=> 'Read the topic content below for the explaination.',
				'IMAGE'	=> 'prosilver_history09.jpg'),
			10 	=> array(
				'DATE' 	=> 'January 15th 2005: Logo concepts I',
				'TEXT' 	=> 'Some logo variations were put to the vote to the wider phpBB team.',
				'IMAGE'	=> 'prosilver_history10.jpg'),
			11 	=> array(
				'DATE' 	=> 'January 15th 2005: Logo concepts II',
				'TEXT' 	=> 'More logo variations.',
				'IMAGE'	=> 'prosilver_history11.jpg'),
			12 	=> array(
				'DATE' 	=> 'January 15th 2005: Olympus!',
				'TEXT' 	=> 'The new name for phpBB3, and also the name of the largest mountain on Mars...',
				'IMAGE'	=> 'prosilver_history12.jpg'),
			13 	=> array(
				'DATE' 	=> 'January 2005: Onwards',
				'TEXT' 	=> 'A lot of time spent creating templates and marking up the new design.',
				'IMAGE'	=> 'prosilver_history13.gif'),
			14 	=> array(
				'DATE' 	=> 'February 2006: phpBB3 website',
				'TEXT' 	=> 'Design for new website created.',
				'IMAGE'	=> 'prosilver_history14.jpg'
			));

		return $data;
	}
}
