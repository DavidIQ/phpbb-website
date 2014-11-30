<?php
/**
 *
 * @package AppBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author PayBas
 *
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;

class StaticTemplateController extends TemplateController
{
	public function staticTemplateAction($template, $maxAge = 86400, $sharedAge = 86400, $private = null)
	{
		return $this->templateAction($template, $maxAge, $sharedAge, $private);
	}
}
