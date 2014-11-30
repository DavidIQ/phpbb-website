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

use AppBundle\Wrappers\PhpbbHandling;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GlobalController extends Controller
{
	public function homeAction()
	{
		$templateVariables = array();
		$announcement_forum = 14;

		$finishedAnnouncements = $this->getForumAnnouncements($announcement_forum);

		$cache = $this->get('phpbb.cache');

		if ($cache->contains('blog_announcements_file') !== FALSE)
		{
			$blogFile = $cache->fetch('blog_announcements_file');
			$cacheStatus = 'Hit';
		}
		else
		{
			$blogFile = @file_get_contents('https://www.phpbb.com/website/wp_announcements.php?password=thisisnotverysecretbutitdoesntreallyneedtobe');
			$cache->save('blog_announcements_file', $blogFile, 3600);
			$cacheStatus = 'Miss';
		}

		$blogJson = @json_decode($blogFile, true);

		$blogAnnouncements = $blogJson === null ? array() : $blogJson;
		$finishedAnnouncements = $finishedAnnouncements === null ? array() : $finishedAnnouncements;

		krsort($blogAnnouncements);

		$announcements = array_merge($finishedAnnouncements, $blogAnnouncements);

		$templateVariables += array(
			'homepage'			  => true,
			'announcements_forum'   => '/community/viewforum.php?f=' . $announcement_forum,
			'announcements'		 => $announcements,);

		$content = $this->renderView('AppBundle:Global:index.html.twig', $templateVariables);
		$response = new Response($content);
		$response->headers->set('X-Cache-Blog', $cacheStatus);
		return $response;
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
			$preview = trim(preg_replace('#http(?:\:|&\#58;)//\S+#', '', $preview));

			// Decide how large the preview text should be
			$preview_max_len = 200;
			$preview_len = strlen($preview);

			if ($preview_len > $preview_max_len) {
				// If the first thing is a link, nuke it
				$preview_clean = str_replace('&#58;', ':', $preview);

				if (substr($preview_clean, 0, 8) == 'https://' || substr($preview_clean, 0, 7) == 'http://') {
					$preview = preg_replace('/^(\S*)\s/', '', $preview);
				}

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
