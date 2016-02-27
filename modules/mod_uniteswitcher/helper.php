<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_uniteswitcher
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JLoader::register('MenusHelper', JPATH_ADMINISTRATOR . '/components/com_menus/helpers/menus.php');

abstract class modUniteSwitcherHelper
{
	
	public static $urlImages = "";
	
	public static function putLangLi($language){
		
		$imageCode = $language->image;
		$arrImage = explode("_",$imageCode);
		if(count($arrImage) > 1)
			$imageCode = $arrImage[0];
			
		$urlImage = self::$urlImages.$imageCode.'.gif';
		
		//print_r($language->link);
		//print_r($urlImage);exit();
		
		$alt = $language->title_native;
		$class = $language->active ? 'lang-active' : '';
		?>
			<li class="<?php echo $class?>">
			<a href="<?php echo $language->link;?>">
				<img src="<?php echo $urlImage?>" alt="<?php echo $alt?>">
			</a>
			</li>
		<?php			
	}

	public static function getList(&$params)
	{
		$user	= JFactory::getUser();
		$lang 	= JFactory::getLanguage();
		$app	= JFactory::getApplication();
		$menu 	= $app->getMenu();
		
		// Get menu home items
		$homes = array();
		foreach($menu->getMenu() as $item) {
			if ($item->home) {
				$homes[$item->language] = $item;
			}
		}
		
		// Load associations
		$assoc = isset($app->menu_associations) ? $app->menu_associations : 0;
		if ($assoc)
		{
			$active = $menu->getActive();
			if ($active)
			{
				$associations = MenusHelper::getAssociations($active->id);
			}
		}

		$levels		= $user->getAuthorisedViewLevels();
		$languages	= JLanguageHelper::getLanguages();
		
		// Filter allowed languages
		foreach($languages as $i => &$language) {
			
			//print_r($language->lang_code);
			
			
			// Do not display language without frontend UI
			if (!JLanguage::exists($language->lang_code)) {
				unset($languages[$i]);
			}
			// Do not display language without specific home menu
			elseif (!isset($homes[$language->lang_code])) {
				unset($languages[$i]);
			}
			// Do not display language without authorized access level
			elseif (isset($language->access) && $language->access && !in_array($language->access, $levels)) {
				unset($languages[$i]);
			}
			else {
				$language->active = $language->lang_code == $lang->getTag();
				if ($app->getLanguageFilter()) {
					if (isset($associations[$language->lang_code]) && $menu->getItem($associations[$language->lang_code])) {
						$itemid = $associations[$language->lang_code];
						if ($app->getCfg('sef')=='1') {
							$language->link = JRoute::_('index.php?lang='.$language->sef.'&Itemid='.$itemid);
						}
						else {
							$language->link = 'index.php?lang='.$language->sef.'&amp;Itemid='.$itemid;
						}
					}
					else {
						if ($app->getCfg('sef')=='1') {
							$itemid = isset($homes[$language->lang_code]) ? $homes[$language->lang_code]->id : $homes['*']->id;
							$language->link = JRoute::_('index.php?lang='.$language->sef.'&Itemid='.$itemid);
						}
						else {
							$language->link = 'index.php?lang='.$language->sef;
						}
					}
				}
				else {
					$language->link = JRoute::_('&Itemid='.$homes['*']->id);
				}
			}
			//CMS @ 03-10-2015
			//Altera��o relativa a mudan�a de linguagem de acordo com o dominio
			$members = explode(".",$_SERVER['HTTP_HOST']);
			//if(strpos($members[0], "www")>-1)
			array_pop($members);
			$base = implode(".", $members);
			if(!stripos($base, "http://")){
				$base = "http://".$base;
			}
			if($language->lang_code == 'fr-FR'){
				$base = $base.".fr";
				$language->link = $base.$language->link;
			}else{
				$base = $base.".com";
				$language->link = $base.$language->link;
				$language->link = str_replace("/index.php/en", "", $language->link);
			}
			//echo $language->link."<br>";
		}
		return $languages;
	}
}
