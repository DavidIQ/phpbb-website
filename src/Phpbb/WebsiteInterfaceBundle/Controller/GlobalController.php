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

use Phpbb\WebsiteInterfaceBundle\Wrappers\PhpbbHandling;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GlobalController extends Controller
{
	public function homeAction()
	{
		$templateVariables = array();
		$announcement_forum = 14;

		$finishedAnnouncements = $this->getForumAnnouncements($announcement_forum);

		// Get announcements file
		$blogFile = @file_get_contents('https://www.phpbb.com/website/wp_announcements.php?password=thisisnotverysecretbutitdoesntreallyneedtobe');

		$blogJson = @json_decode($blogFile, true);

		$blogAnnouncements = $blogJson === null ? array() : $blogJson;
		$finishedAnnouncements = $finishedAnnouncements === null ? array() : $finishedAnnouncements;

		krsort($blogAnnouncements);

		$announcements = array_merge($finishedAnnouncements, $blogAnnouncements);

		$templateVariables += array(
			'homepage'              => true,
			'announcements_forum'   => '/community/viewforum.php?f=' . $announcement_forum,
			'announcements'         => $announcements,
			'header_css_image'      => 'home',);

		return $this->render('PhpbbWebsiteInterfaceBundle:Global:index.html.twig', $templateVariables);
	}

	public function demoAction()
	{
		$templateVariables = array(
			'header_css_image'      => 'demo',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Global:demo.html.twig', $templateVariables);
	}

	public function customiseAction()
	{
		$templateVariables = array(
			'header_css_image'      => 'customise',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Global:customise.html.twig', $templateVariables);
	}

	/**
	 * @param integer $announcement_forum
	 */
	private function getForumAnnouncements($announcement_forum)
	{
		$retrieve_limit = 3;

		$phpbbConnection = $this->get('doctrine.dbal.phpbb_connection');
		$forumAnnouncements = PhpbbHandling::getTopicsFromForum(
			$phpbbConnection,
			$announcement_forum,
			$retrieve_limit,
			$this->container->getParameter('phpbb_database_prefix')
		);
		$finishedAnnouncements = array();

		foreach ($forumAnnouncements as $announcement) {
			$preview = $announcement['post_text'];
			$preview = PhpbbHandling::bbcodeStripping($preview, $announcement['bbcode_uid']);
			$preview = preg_replace('#http(?:\:|&\#58;)//\S+#', '', $preview);

			// Decide how large the preview text should be
			$preview_max_len = 200;
			$preview_len = strlen($preview);

			if ($preview_len > $preview_max_len) {
				// Truncate to the maximum length
				$preview = substr($preview, 0, $preview_max_len);

				// See if there is a nice place to break close to the max length
				$breakchars = array(' ', ',', '.');
				$clean_break_pos = 0;

				foreach ($breakchars as $char) {
					$clean_break_pos_new = strrpos($preview, $char);
					$clean_break_pos = $clean_break_pos_new > $clean_break_pos ? $clean_break_pos_new : $clean_break_pos;
				}

				if ($clean_break_pos) {
					$preview = substr($preview, 0, $clean_break_pos);
				}
			}

			$finishedAnnouncements[$announcement['topic_time']] = array(
				'DAY' 		=> date('d', $announcement['topic_time']),
				'MONTH' 	=> date('M', $announcement['topic_time']),
				'YEAR' 		=> date('Y', $announcement['topic_time']),
				'U_LINK' 	=> '/community/viewtopic.php?f=' . $announcement_forum . '&amp;t=' . $announcement['topic_id'],
				'TITLE' 	=> $announcement['topic_title'],
				'FROM_BLOG' => false,
				'PREVIEW' 	=> $preview,
			);
		}

		return $finishedAnnouncements;
	}
}
