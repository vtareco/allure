<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$current_uri = JURI::current();
//echo $current_uri;
// Note. It is important to remove spaces between elements.
?>
<?php // The menu class is deprecated. Use nav instead. ?>
<ul class="nav menu navbar-nav"<?php
	$tag = '';

	if ($params->get('tag_id') != null)
	{
		$tag = $params->get('tag_id') . '';
		echo ' id="' . $tag . '"';
	}
?>>
<?php

$lang = JFactory::getLanguage();
$languagelocale = $lang->getTag();

// $str = 'ABC';
// echo strpos($str, 'A');

// if(strpos($languagelocale, 'fr-FR')>=0)
// if($languagelocale == 'fr-FR')
// 	echo "AAA";
// else
// 	echo "BBB";
// 17-01-2015
// Alteracao para permitir deixar o item de menu  search villa activo
if(strpos($current_uri, "search_villa") || ( strpos($current_uri, 'view') && $_SESSION['referer'] == 'search_villa')){
	if($languagelocale == 'fr-FR')
		$path[0] = $active_id = 161;
	else
		$path[0] = $active_id = 102;
}
if(strpos($current_uri, "best_of") || ( strpos($current_uri, 'view') && $_SESSION['referer'] == 'best_of')){
	if($languagelocale == 'fr-FR')
		$path[0] = $active_id = 162;
	else
		$path[0] = $active_id = 103;
}
if(strpos($current_uri, "for_sale") || ( strpos($current_uri, 'view') && $_SESSION['referer'] == 'for_sale')){
	if($languagelocale == 'fr-FR')
		$path[0] = $active_id = 164;
	else
		$path[0] = $active_id = 120;
}
if(strpos($current_uri, "favorites") || ( strpos($current_uri, 'view') && $_SESSION['referer'] == 'favorites')){
	if($languagelocale == 'fr-FR')
		$path[0] = $active_id = 186;
	else
		$path[0] = $active_id = 185;
}

//print_r($path);
// echo $active_id;
// echo "->".$languagelocale."<-";

foreach ($list as $i => &$item)
{
	//Alteracao em 14-04-2015
	//@author CMS
	//Apenas mostra item Favorites caso existam casas selecionadas como Favorites
	if(strpos($item->link, "/favorites") > 0 && (!isset($_SESSION['favorite_houses']) || count($_SESSION['favorite_houses']) == 0)){
		continue;
	}
	
	$class = 'item-' . $item->id;
	if ( ($item->id == $active_id) OR ($item->type == 'alias' AND $item->params->get('aliasoptions') == $active_id))
	{
			$class .= ' current';
	}
	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type == 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type == 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' deeper';
	}

	if ($item->parent)
	{
		$class .= ' parent';
	}

	if (!empty($class))
	{
		$class = ' class="' . trim($class) . '"';
	}

	echo '<li' . $class . '>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
		case 'heading':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="nav-child unstyled small">';
	}
	elseif ($item->shallower)
	{
		// The next item is shallower.
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	else
	{
		// The next item is on the same level.
		echo '</li>';
	}
}
?></ul>
