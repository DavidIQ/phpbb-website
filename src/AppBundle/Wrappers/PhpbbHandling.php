<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Wrappers;

class PhpbbHandling
{
	/**
	 * Strip bbcodes from a post content
	 *
	 * @param  string $text The raw content from the database to strip bbcodes from
	 * @param  string $uid  The $uid used in encoding/decoding the bbcode
	 * @return string $text The post with bbcodes stripped
	 * @access public
	 * @static
	 */
	public static function bbcodeStripping($text, $uid = '[0-9a-z]{5,}')
	{
		$text = preg_replace("#\[\/?[a-z0-9\*\+\-]+(?:=(?:&quot;.*&quot;|[^\]]*))?(?::[a-z])?(\:$uid)\]#", ' ', $text);
		$match = array(
			'#<!\-\- e \-\-><a href="mailto:(.*?)">.*?</a><!\-\- e \-\->#',
			'#<!\-\- l \-\-><a (?:class="[\w-]+" )?href="(.*?)(?:(&amp;|\?)sid=[0-9a-f]{32})?">.*?</a><!\-\- l \-\->#',
			'#<!\-\- ([mw]) \-\-><a (?:class="[\w-]+" )?href="(.*?)">.*?</a><!\-\- \1 \-\->#',
			'#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/.*? \/><!\-\- s\1 \-\->#',
			'#<!\-\- .*? \-\->#s',
			'#<.*?>#s',
		);
		$replace = array('\1', '\1', '\2', '\1', '', '');

		$text = preg_replace($match, $replace, $text);

		return $text;
	}

	/**
	 * Get the topic details from the forums table & the first post
	 *
	 * @param \Doctrine\DBAL\Connection	  $phpBBConnection	DBAL connection to a phpBB database
	 *															  (Doctrine\DBAL\Connection)
	 * @param integer $forum				ID for the forum to get topics from
	 * @param integer $retrieve_limit	   Maxmium number of topics to retrieved
	 * @param string  $database_prefix	  The prefix of the tables in the database (include underscore)
	 * @return array  $topics			   The topics from that forum
	 * @access public
	 * @static
	 */
	public static function getTopicsFromForum(\Doctrine\DBAL\Connection $phpbbConnection, $forum, $retrieve_limit, $database_prefix = 'phpbb_')
	{
		$sql = 'SELECT t.*, p.post_text, p.bbcode_uid
			FROM ' . $database_prefix . 'topics t
			LEFT JOIN ' . $database_prefix . 'posts p
				ON t.topic_first_post_id = p.post_id
			WHERE t.forum_id IN (' . $forum . ', 0)
				AND t.topic_visibility = 1
			ORDER BY topic_time DESC
			LIMIT 0,' . $retrieve_limit;

		$topics = $phpbbConnection->fetchAll($sql);

		return $topics;
	}
}
