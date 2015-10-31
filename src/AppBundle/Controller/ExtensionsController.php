<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC, Paul, VSE & battye
 *
 */

namespace AppBundle\Controller;

use Phpbb\Epv\Output\HtmlOutput;
use Phpbb\Epv\Output\Output;
use Phpbb\Epv\Tests\TestStartup;
use AppBundle\Entity\EpvResults;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Helper\Extensions\OfficialExtension;
use Symfony\Component\HttpFoundation\Request;

// Controller for Extensions pages
class ExtensionsController extends Controller
{
	public function officialExtensionsAction()
	{
		// TODO: In the future we may load this dynamically from a database table
		$officialExtensions = array();

		$officialExtensions[] = new OfficialExtension(
			'Auto Groups',
			'The Auto Groups extension can automate the process of adding and removing users from groups upon reaching specified quantitative milestones related to their post count, age, membership, and warnings count. This allows board administrators to set up special groups that users will automatically be added to (or removed from) based on their activity.',
			'The Auto Groups extension comes with a handful of user data conditions that can be used to qualify users for automatic group placement. However, this extension was written with extensibility in mind to allow other extension developers to easily add new user data conditions or integrate Auto Groups into their own extensions. For example, an extension that adds new user data, such as "reputation points," could integrate with Auto Groups to allow a user\'s reputation points to be used as a condition for auto group placement. For more information, see the Wiki page at the Auto Groups GitHub repository to find detailed documentation about extending Auto Groups.',
			'https://www.phpbb.com/customise/db/extension/auto_groups/',
			'https://github.com/phpbb-extensions/autogroups',
			'/assets/images/images/extensions/autogroups.png'
		);

		$officialExtensions[] = new OfficialExtension(
			'Board Rules',
			'The Board Rules Extension adds a dedicated Rules page to a board. It offers an ACP module from which an unlimited number of rules and rule categories can be created in each language installed on a board. It also supports sending out notifications to all board members notifying them that the rules have been changed, and can require newly registering users read the board rules as part of the terms of agreement for registering on a board.',
			'The Board Rules Extension is a fairly advanced design compared to previous phpBB modifications. Abstract classes implemented through interfaces are used to specify the methods that handle most of the code logic. There is an Entity class for manipulating a single rule and an Operator class for manipulating sets of rules. Controller classes are used to process the front-end of the ACP module and the Rules page itself. It also makes use of phpBB\'s new notification system, nestedsets/trees, and AJAX functionality in the ACP user-interface. There is also extensive PHP unit test coverage of the code to ensure its stability and reliability and prevent regressions. We think testing code is so important, we\'ve made it possible for any extension (on Github) to use phpBB\'s PHPUnit testing framework with Travis Continuous Integration hosted servers; just look through our tests and travis files/folders to see how we did it.',
			'https://www.phpbb.com/customise/db/extension/boardrules/',
			'https://github.com/phpbb-extensions/boardrules',
			'/assets/images/images/extensions/boardrules.png'
		);

		$officialExtensions[] = new OfficialExtension(
			'Board Announcements',
			'The Board Announcements Extension allows board admins to create a special board-wide announcement. Unlike phpBB\'s native global announcements which only appear inside forums, Board Announcements appear near the top of any page being viewed. Users have the option to dismiss the announcement after they have read it.',
			'Board Announcements is an entry-level extension by design. We built this extension using techniques that will be more familiar to MOD developers. Code changes are injected directly from the event listener, and all ACP module logic is contained in its ACP module class. Overall, this extension is a good example that shows how to inject new code, add an ACP module, utilize a controller file to run some functional code in combination with AJAX, and how to use new config_text table in phpBB 3.1.x to store textual data.',
			'https://www.phpbb.com/customise/db/extension/boardannouncements/',
			'https://github.com/phpbb-extensions/boardannouncements',
			'/assets/images/images/extensions/boardannouncements.png'
		);

		$officialExtensions[] = new OfficialExtension(
			'Collapsible Forum Categories',
			'Collapsible Forum Categories is a nice addition to any forum that will allow users to collapse, or hide, any forum or forum category with a simple click. This provides a convenient way for users to minimise the forums they do not particpate in and focus their attention on the forums they do care about. Collapsed forums will remain hidden for logged-in users across different browsers and devices (guests settings are handled via cookies).',
			'Collpasible Forum Categories can be used in third party extensions. Some extensions that add forum category-like sections to a phpBB board (such as a chatbox, portal or additional topic lists) may want to include collapsibility. The GitHub repository for Collapsible Forum Categories has a Wiki article for adding Collapsible Forum Category support to another extension.',
			'https://www.phpbb.com/customise/db/extension/collapsible_forum_categories/',
			'https://github.com/phpbb-extensions/collapsible-categories',
			'/assets/images/images/extensions/collapsiblecategories.png'
		);

		$officialExtensions[] = new OfficialExtension(
			'Google Analytics',
			'The Google Analytics Extension simply adds a Google Analytics tracking code with your Property ID to your phpBB forum.',
			'This extension is the simplest of extensions in form and function. It adds a single new field to the ACP for a Google Analytics Property ID, validates it, and inserts the Universal Analytics a-synchronous javascript code into the head of your board\'s HTML pages, just before the closing </head> tag, as recommended by Google. In addition to allowing boards to easily add Google\'s powerful analytics, this extension is an ideal starting example for new extension authors, demonstrating how to effectively add an ACP config option implement that config setting using template events.',
			'https://www.phpbb.com/customise/db/extension/googleanalytics/',
			'https://github.com/phpbb-extensions/googleanalytics',
			'/assets/images/images/extensions/googleanalytics.png'
		);

		$officialExtensions[] = new OfficialExtension(
			'Pages',
			'The Pages Extension allows administrators to create custom static pages for their phpBB forum. With Pages you can add an unlimited number of new static pages to your board, such as an About Us page, News page, or even a simple forum Blog. The ACP\'s page editor allows you to create page content using BBCodes or HTML, making it possible to embed media from other sites and create truly unique pages.',
			'This extension provides another opportunity for developers to analyse an object-oriented and abstracted approach to developing an extension for phpBB. Because the Pages extension can create an unlimited number of pages, it is set up to account for dynamic page routes and links. It allows users to choose a number of possible link locations for each page using mutliple template events, and leverages the power of phpBB\'s finder object to allow users to upload their own custom link icons and page template files. As with all our extensions, there is complete test coverage of all code to ensure maximum stability and reliability.',
			'https://www.phpbb.com/customise/db/extension/pages/',
			'https://github.com/phpbb-extensions/pages',
			'/assets/images/images/extensions/pages.png'
		);

		$templateVariables = array(
			'extensions' => $officialExtensions,
		);

		return $this->render('AppBundle:Extensions:official-extensions.html.twig', $templateVariables);
	}

	public function policiesAction()
	{
		// Extensions Rules and Policies
		$templateVariables = array(
			'policies'		 => array(
				array('i' => 0, 'name' => 'Validation Policy', 'description' => 'Some general policies on how we handle validation.', 'link' => '/extensions/rules-and-policies/validation-policy'),
				array('i' => 1, 'name' => 'Insta-Deny Policy', 'description' => 'How we handle Insta-Denies of Extensions.', 'link' => '/extensions/rules-and-policies/insta-deny'),
				array('i' => 2, 'name' => 'Repack Policy', 'description' => 'How we handle repacking of Extensions.', 'link' => '/extensions/rules-and-policies/repack'),
			)
		);

		return $this->render('AppBundle:Extensions:rules-policies.html.twig', $templateVariables);
	}

	public function epvAction(Request $request)
	{
		$templateVariables = array();

		$github = $request->request->get('github');
		$debug = $request->request->get('debug');

		if ($github)
		{
			$results = $this->getDoctrine()
				->getRepository('AppBundle:EpvResults')
				->findByGithub($github);
			$em = $this->getDoctrine()->getManager();

			$fail = false;
			if ($results && sizeof($results))
			{
				/** @var  $item EpvResults */
				foreach ($results as $item)
				{
					if ($item->getRuntime() > time() - 30)
					{
						$fail = true;
					}
					else
					{
						$em->remove($item);
					}
				}
			}

			if (!$fail)
			{
				$int_output = new HtmlOutput();
				$output	 = new Output($int_output, $debug);

				$test						 = new TestStartup($output, TestStartup::TYPE_GITHUB, $github, $debug);
				$templateVariables['results'] = $int_output->getBuffer();

				$result = new EpvResults();
				$result->setGithub($github);
				$result->setRuntime(time());

				$em->persist($result);
				$em->flush();
			}
			else
			{
				$templateVariables['errors'] = 'Please wait a while before running EPV again.';
			}

		}

		return $this->render('AppBundle:Extensions:epv.html.twig', $templateVariables);
	}
}
