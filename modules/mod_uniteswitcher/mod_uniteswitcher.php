<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_uniteswitcher
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';
$document = JFactory::getDocument();

$urlBase = JURI::root()."modules/mod_uniteswitcher/tmpl/";
$urlStyles = $urlBase."styles.css";

$colorTemplate = $params->get("color_template");
$urlStylesTemplate = $urlBase.$colorTemplate.".css";

//set joomla default url images
//$urlImages = JURI::root()."media/mod_languages/images/";
$urlImages = $urlBase."images/default/";

modUniteSwitcherHelper::$urlImages = $urlImages;

//$document->addStyleSheet($urlStyles);
$document->addStyleSheet($urlStylesTemplate);

$headerText	= JString::trim($params->get('header_text'));
$footerText	= JString::trim($params->get('footer_text'));

$list = modUniteSwitcherHelper::getList($params);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$path = JModuleHelper::getLayoutPath('mod_uniteswitcher', $params->get('layout', 'default'));

require $path;
