<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_uniteswitcher
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<div class="mod-languages<?php echo $moduleclass_sfx ?>">
<?php if ($headerText) : ?>
	<div class="pretext"><p><?php echo $headerText; ?></p></div>
<?php endif; ?>

	<ul class="list_uniteswitcher language-switcher">	
	<?php 
		//put the active language first
		foreach($list as $language):
			if($language->active == true)
				modUniteSwitcherHelper::putLangLi($language);
		endforeach;
		
		//put all other languages
		foreach($list as $language):
			if($language->active == false)
				modUniteSwitcherHelper::putLangLi($language);		
		endforeach;
	?>	
	</ul>

<?php if ($footerText) : ?>
	<div class="posttext"><p><?php echo $footerText; ?></p></div>
<?php endif; ?>
</div>
