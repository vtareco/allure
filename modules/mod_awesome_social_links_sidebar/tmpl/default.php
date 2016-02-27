<?php
/**
 * @package     connexdesigns.Module
 * @subpackage  mod_awesome_social_links_sidebar.php
 * @author - Ved Maila
 * @copyright - All rights reserved by ConnexDesigns.com
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.connexdesigns.com
 * Technical Support:  info@connexdesigns.com
 * Documentation : Available at our Website
 * Type : Free
*/
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::base().'modules/mod_awesome_social_links_sidebar/css/general.css');

$position_top = $params->get('position_top');

if (trim( $params->get( 'jquery_min_load' ) ) == 1){
$doc->addScript(JURI::base().'modules/mod_awesome_social_links_sidebar/js/jquery-1.8.2.min.js');}
$doc->addScript(JURI::base().'modules/mod_awesome_social_links_sidebar/js/jquery.mtlib.js');
$doc->addScript(JURI::base().'modules/mod_awesome_social_links_sidebar/js/jquery-ui-1.8.23.custom.min.js');
?>
	
    <div style="top:<?php echo $params->get('positiontop')?>px;" class="<?php 
		if($params->get('social_icon_alignment') == '0')
		{
			echo 'social-buttons button-right';
		}
		else{
			echo 'social-buttons button-left';
		}?>">
    
		<?php if($params->get('facebook') != "") : ?> 
        <a class="itemsocial" target="_blank" href="<?php echo $params->get('facebook');?>" id="facebook-btn">
        	<span class="social-icon">
        	<span class="social-text">Follow via Facebook</span>
        	</span>
        </a>
        <?php endif;?>
    
		<?php if($params->get('twitter') != "") : ?>
        <a class="itemsocial" target="_blank" href="<?php echo $params->get('twitter');?>" id="twitter-btn">
            <span class="social-icon">
            <span class="social-text">Follow via Twitter</span>
            </span>
        </a>            
        <?php endif;?>
    
		<?php if($params->get('google_plus') != "") : ?>
        <a class="itemsocial" target="_blank" href="<?php echo $params->get('google_plus');?>" id="google-btn">
            <span class="social-icon">
            <span class="social-text">Follow via Google</span>
            </span>
        </a>
        <?php endif;?>
    
		<?php if($params->get('pinterest') != "") : ?>
        <a class="itemsocial" target="_blank" href="<?php echo $params->get('pinterest');?>" id="pinterest-btn">
            <span class="social-icon">
            <span class="social-text">Follow via Pinterest</span>
            </span>
        </a>
        <?php endif;?>
    
		<?php if($params->get('youtube') != "") : ?>
        <a class="itemsocial" target="_blank" href="<?php echo $params->get('youtube');?>" id="youtube-btn">
            <span class="social-icon">
            <span class="social-text">Follow via Youtube</span>
            </span>
        </a>
        <?php endif;?>
    
		<?php if($params->get('rssfed') != "") : ?>
        <a class="itemsocial" target="_blank" href="<?php echo $params->get('rssfed');?>" id="rss-btn">
            <span class="social-icon">
            <span class="social-text">Follow via RSS</span>
            </span>
        </a>
        <?php endif;?>
    
    </div>
		<script type="text/javascript">
            $mtkb(window).load(function(){
                if (is_touch_device()) {
                    
                } else {
                    $mtkb('.social-buttons .social-icon').mouseenter(function(){
                        $mtkb(this).stop();
                        $mtkb(this).animate({width:'160'}, 500, 'easeOutQuad',function(){});  
                    });
                    $mtkb('.social-buttons .social-icon').mouseleave(function(){
                        $mtkb(this).stop();
                        $mtkb(this).animate({width:'43'}, 500, 'easeOutQuad',function(){});
                    });
                }
            });
        </script>
