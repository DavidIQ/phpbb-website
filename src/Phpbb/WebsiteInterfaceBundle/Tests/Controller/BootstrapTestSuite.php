<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BootstrapTestSuite extends WebTestCase
{
    public $client;
    public $crawler;
    public $response;

    protected function setupTest($path)
    {
        $client = static::createClient();
        $this->setClient($client);
        $client->enableProfiler();
        $crawler = $client->request('GET', $path);
        $response = $client->getResponse();
        $this->setupBootstrapping($client, $crawler, $response);

        return array('client' => $client, 'crawler' => $crawler, 'response' => $response);
    }

    public function setupBootstrapping($client, $crawler, $response)
    {
        $this->setClient($client);
        $this->setCrawler($crawler);
        $this->setResponse($response);
    }

    public function globalTests($status = 200, $queries = 20)
    {
        $this->assertTrue($this->crawler->filter('html:contains("phpBB Limited")')->count() > 0, 'Footer Check');
        $this->assertTrue($this->crawler->filter('html:contains("About")')->count() > 0, 'Header Check');
        $this->assertEquals($this->response->getStatusCode(), $status, 'Response Code Check');
        $this->assertTrue($this->crawler->filter('html:contains("advertisements")')->count() > 0, 'Advertisments Check');

        if (strpos(strval($status), '2') !== false) {
            $this->assertTrue($this->client->getResponse()->isSuccessful(), 'Response is a sucessful one');
        }

        if ($profile = $this->client->getProfile()) {
            $this->queryCheck($queries, $profile);
        }
    }

    private function queryCheck($queries, $profile)
    {
        // Shouldn't really have more than 20 queries on any page
        $this->assertLessThan(
            $queries,
            $profile->getCollector('db')->getQueryCount(),
            ('Checks that query count is less than' . $queries . ' (token ' .  $profile->getToken() .')')
            );
    }

    public function get($dependency)
    {
        $container = $this->client->getContainer();

        return $container->get($dependency);
    }

    private function dropTablesInDatabase($symfonyConnection, $phpbbConnection)
    {
        // Check what tables exists
        $symfonyOldTables = $symfonyConnection->fetchAll('SHOW TABLES');
        $phpbbOldTables = $phpbbConnection->fetchAll('SHOW TABLES');

        // Delete existing tables
        foreach ($symfonyOldTables as $i => $oldTable) {
            foreach ($oldTable as $key => $oldTableName) {
                $symfonyConnection->query('DROP TABLE '. $oldTableName);
            }
        }

        foreach ($phpbbOldTables as $i => $oldTable) {
            foreach ($oldTable as $key => $oldTableName) {
                $phpbbConnection->query('DROP TABLE '. $oldTableName);
            }
        }
    }

    public function setupDatabase($symfonyTables, $phpbbTables)
    {
        // Connections to databases
        $symfonyConnection = $this->get('database_connection');
        $phpbbConnection = $this->get('doctrine.dbal.phpbb_connection');

        $this->dropTablesInDatabase($symfonyConnection, $phpbbConnection);

        // Add each symfony table's fixtures for those tables needed
        foreach ($symfonyTables as $symfonyTable) {
            $sql = $this->getSymfonyFixtures($symfonyTable);

            if ($sql) {
                $symfonyConnection->query($sql);
                unset($sql);
            }
        }

        // Add each phpbb table's fixtures for those tables needed
        foreach ($phpbbTables as $phpbbTable) {
            $sql = $this->getPhpbbFixtures($phpbbTable);

            if ($sql) {
                $phpbbConnection->query($sql);
                unset($sql);
            }
        }

        return;
    }

    private function getSymfonyFixtures($table)
    {
        switch ($table) {
            // Case statement
        }

        return (isset($sql) ? $sql : null);
    }

    private function getPhpbbFixtures($table)
    {
        switch ($table) {
            case 'community_posts':
            $sql = "
CREATE TABLE IF NOT EXISTS `community_posts` (
  `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `post_text` mediumtext COLLATE utf8_bin NOT NULL,
  `post_checksum` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_postcount` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_edit_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_edit_count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `post_edit_locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `post_visibility` tinyint(3) NOT NULL DEFAULT '0',
  `post_delete_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_delete_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_delete_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_ip` (`poster_ip`),
  KEY `poster_id` (`poster_id`),
  KEY `post_username` (`post_username`),
  KEY `tid_post_time` (`topic_id`,`post_time`),
  KEY `post_visibility` (`post_visibility`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `community_posts`
--

INSERT INTO `community_posts` (`post_id`, `topic_id`, `forum_id`, `poster_id`, `icon_id`, `poster_ip`, `post_time`, `post_reported`, `enable_bbcode`, `enable_smilies`, `enable_magic_url`, `enable_sig`, `post_username`, `post_subject`, `post_text`, `post_checksum`, `post_attachment`, `bbcode_bitfield`, `bbcode_uid`, `post_postcount`, `post_edit_time`, `post_edit_reason`, `post_edit_user`, `post_edit_count`, `post_edit_locked`, `post_visibility`, `post_delete_time`, `post_delete_reason`, `post_delete_user`) VALUES
(1, 1, 2, 2, 0, '127.0.0.1', 1343840387, 0, 1, 1, 1, 1, '', 'Welcome to phpBB3', 'This is an example post in your phpBB3 installation. Everything seems to be working. You may delete this post if you like and continue to set up your board. During the installation process your first category and your first forum are assigned an appropriate set of permissions for the predefined usergroups administrators, bots, global moderators, guests, registered users and registered COPPA users. If you also choose to delete your first category and your first forum, do not forget to assign permissions for all these usergroups for all new categories and forums you create. It is recommended to rename your first category and your first forum and copy permissions from these while creating new categories and forums. Have fun!', '5dd683b17f641daf84c040bfefc58ce9', 0, '', '', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
(2, 2, 14, 2, 0, '127.0.0.1', 1376676604, 0, 1, 1, 1, 1, '', 'this should not show if it does die', 'No Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '08a963224e1894a0f6ded63172f818d2', 0, '', '1fzugufv', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
(3, 3, 14, 2, 0, '127.0.0.1', 1376676710, 0, 1, 1, 1, 1, '', 'another', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'bdf55c952333a4f0992f429e152f03f7', 0, '', '1yurb15i', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
(4, 4, 14, 2, 0, '127.0.0.1', 1376676762, 0, 1, 1, 1, 1, '', 'third', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'bdf55c952333a4f0992f429e152f03f7', 0, '', '2y44jt86', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
(5, 5, 14, 2, 0, '127.0.0.1', 1376676815, 0, 1, 1, 1, 1, '', 'show', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'bdf55c952333a4f0992f429e152f03f7', 0, '', '32fdkg1c', 1, 0, '', 0, 0, 0, 1, 0, '', 0);
";
break;

case 'community_topics':
$sql = "
CREATE TABLE IF NOT EXISTS `community_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic_poster` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_time_limit` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_first_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_first_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_last_view_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_bumped` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_bumper` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `poll_start` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_length` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_max_options` tinyint(4) NOT NULL DEFAULT '1',
  `poll_last_vote` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_vote_change` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_visibility` tinyint(3) NOT NULL DEFAULT '0',
  `topic_delete_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_delete_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_delete_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_type` (`forum_id`,`topic_type`),
  KEY `last_post_time` (`topic_last_post_time`),
  KEY `fid_time_moved` (`forum_id`,`topic_last_post_time`,`topic_moved_id`),
  KEY `topic_visibility` (`topic_visibility`),
  KEY `forum_vis_last` (`forum_id`,`topic_visibility`,`topic_last_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `community_topics`
--

INSERT INTO `community_topics` (`topic_id`, `forum_id`, `icon_id`, `topic_attachment`, `topic_reported`, `topic_title`, `topic_poster`, `topic_time`, `topic_time_limit`, `topic_views`, `topic_status`, `topic_type`, `topic_first_post_id`, `topic_first_poster_name`, `topic_first_poster_colour`, `topic_last_post_id`, `topic_last_poster_id`, `topic_last_poster_name`, `topic_last_poster_colour`, `topic_last_post_subject`, `topic_last_post_time`, `topic_last_view_time`, `topic_moved_id`, `topic_bumped`, `topic_bumper`, `poll_title`, `poll_start`, `poll_length`, `poll_max_options`, `poll_last_vote`, `poll_vote_change`, `topic_visibility`, `topic_delete_time`, `topic_delete_reason`, `topic_delete_user`, `topic_posts_approved`, `topic_posts_unapproved`, `topic_posts_softdeleted`) VALUES
(1, 2, 0, 0, 0, 'Welcome to phpBB3', 2, 1343840387, 0, 2, 0, 0, 1, 'UKB', '000000', 1, 2, 'UKB', '000000', 'Welcome to phpBB3', 1343840387, 1405344757, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 1, 0, 0),
(2, 14, 0, 0, 0, 'this should not show if it does die', 2, 1376676604, 0, 2, 0, 0, 2, 'UKB', '000000', 2, 2, 'UKB', '000000', 'this should not show if it does die', 1376676604, 1376677290, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, 0, '', 0, 1, 0, 0),
(3, 14, 0, 0, 0, 'another', 2, 1376676710, 0, 1, 0, 0, 3, 'UKB', '000000', 3, 2, 'UKB', '000000', 'another', 1376676710, 1376677005, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, 0, '', 0, 1, 0, 0),
(4, 14, 0, 0, 0, 'third', 2, 1376676762, 0, 1, 0, 0, 4, 'UKB', '000000', 4, 2, 'UKB', '000000', 'third', 1376676762, 1376677091, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, 0, '', 0, 1, 0, 0),
(5, 14, 0, 0, 0, 'show', 2, 1376676815, 0, 1, 0, 0, 5, 'UKB', '000000', 5, 2, 'UKB', '000000', 'show', 1376676815, 1376677160, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, 0, '', 0, 1, 0, 0);
";
break;
}

return (isset($sql) ? $sql : null);
}

    /**
     * Gets the value of client.
     *
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Sets the value of client.
     *
     * @param mixed $client the client
     *
     * @return self
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Gets the value of crawler.
     *
     * @return mixed
     */
    public function getCrawler()
    {
        return $this->crawler;
    }

    /**
     * Sets the value of crawler.
     *
     * @param mixed $crawler the crawler
     *
     * @return self
     */
    public function setCrawler($crawler)
    {
        $this->crawler = $crawler;

        return $this;
    }

    /**
     * Gets the value of response.
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the value of response.
     *
     * @param mixed $response the response
     *
     * @return self
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }
}
