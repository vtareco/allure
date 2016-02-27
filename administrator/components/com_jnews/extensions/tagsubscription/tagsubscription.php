<?php
defined('_JEXEC') OR die('Access Denied!');
### Copyright (c) 2006-2013 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link http://www.joobi.co
$jNewsMainFrame = JFactory::getApplication();
$jNewsMainFrame->registerEvent( 'jnewsbot_tagsubscription', 'tagsubscription' );

/**
 * <p>Function to insert a subscription tag<p>

 */

function tagsubscription(){
		$js = 'function insertjnewstag(tag){';
	if( version_compare(JVERSION,'1.6.0','<') ){//1.5
		$js .= ' if(window.top.insertTag(tag)){window.top.document.getElementById(\'sbox-window\').close();}';
        }else if(version_compare(JVERSION,'3.0.0','<')){
		$js .= ' if(window.top.insertTag(tag)) {window.parent.SqueezeBox.close();}';
	}
        else {
               $js .= ' if(window.top.insertTag(tag)) {           
                    var need_click = jQuery(window.top.document).find("div.modal-backdrop");
                    if(need_click.length == 0) window.parent.SqueezeBox.close();
                    else    jQuery(window.top.document).find("div.modal-backdrop").click();}';
        }
		$js .= '}';
		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);
		
		echo '<style type="text/css">table.'. jnews::myTheme() . 'tr:hover {cursor: pointer;}</style>';

	?>

<div id="element-box">
	<div class="t">
	<div class="t">
	<div class="t"></div>
	</div>
	</div>
	<div class="m">
	<table class="<?php echo jnews::myTheme(); ?>">
			<tbody>
				<thead>
					<tr>
						<th class="title"><center><?php echo _JNEWS_MAILING_TAG; ?></center></th>
						<th class="title"><center><?php echo _JNEWS_TEMPLATE_DESC; ?></center></th>
					</tr>
				</thead>
				<tr class="row0" onclick="insertjnewstag('{tag:subscriptions}')">
					<td>
						<strong><?php echo '{tag:subscriptions}'; ?></strong>
					</td>
					<td>
						<?php echo _JNEWS_TAG_SUBSCRIPTION_DESC ?>
					</td>
				</tr>
				<tr class="row1" onclick="insertjnewstag('{tag:unsubscribe}')">
					<td>
						<strong><?php echo '{tag:unsubscribe}'; ?></strong>
					</td>
					<td>
						<?php echo _JNEWS_TAG_UNSUBSCRIBE_DESC ?>
					</td>
				</tr>
				<tr class="row0" onclick="insertjnewstag('{tag:confirm}')">
					<td>
						<strong><?php echo '{tag:confirm}'; ?></strong>
					</td>
					<td>
						<?php echo _JNEWS_TAG_CONFIRM_DESC ?>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
	<div class="b">
	<div class="b">
	<div class="b"></div>
	</div>
	</div>
</div>
<?php
}
