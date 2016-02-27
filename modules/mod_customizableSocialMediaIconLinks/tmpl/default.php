<?php
/*------------------------------------------------------------------------
# mod_customizableSocialMediaIconLinks - Customizable Social Media Icon Links
# ------------------------------------------------------------------------
# @author - Ved Malia
# copyright - All Rights Reserved by ConnexDesigns.COM.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.connexdesigns.com/
# Technical Support: info@connexdesigns.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die;
$document = & JFactory::getDocument();
$document->addStyleSheet('modules/mod_customizableSocialMediaIconLinks/assets/icons.css');
/*settings*/
$width = $params->get('width');
$moduleclass_sfx = $params->get('moduleclass_sfx');
$backgroundColor = $params->get('backgroundColor');
$margin = $params->get('margin');
$borderRadius = $params->get('borderRadius');
$moduleId = $module->id;
$urlbase = JURI::root(). 'modules/mod_customizableSocialMediaIconLinks/assets/icons.png';
$style = "";
$style .= "
.module$moduleId li a{
	background:$backgroundColor url('$urlbase')no-repeat 0 -43px;
	display: block;
	margin: $margin";
$style .= "px;
	width: 42px;
	height: 42px;
	border-radius: $borderRadius";
$style .= "px;
	-webkit-transition: 0.3s;
}
		";
$document->addStyleDeclaration($style);
?>
<div class="sdgSocialMediaIconLinks <?php echo $moduleclass_sfx; ?>" style="max-width:<?php echo $width; ?>px;">
<ul class="social-icons-custom module<?php echo $moduleId; ?>">
	<?php if($params->get('facebook') != "") : ?>
      <li><a class="cfc-facebook" href="<?php echo $params->get('facebook');?>" target="_blank"></a></li>
	  <?php endif;?>
	  <?php if($params->get('twitter') != "") : ?>
      <li><a class="cfc-twitter" href="<?php echo $params->get('twitter');?>" target="_blank"></a></li>
      <?php endif;?>
	  <?php if($params->get('youtube') != "") : ?>
      <li><a class="cfc-youtube" href="<?php echo $params->get('youtube');?>" target="_blank"></a></li>
	  <?php endif;?>
	  <?php if($params->get('linkedin') != "") : ?>
      <li><a class="cfc-linkedin" href="<?php echo $params->get('linkedin');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('pinterest') != "") : ?>
      <li><a class="cfc-pinterest" href="<?php echo $params->get('pinterest');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('flickr') != "") : ?>
      <li><a class="cfc-flickr" href="<?php echo $params->get('flickr');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('rss') != "") : ?>
      <li><a class="cfc-rss" href="<?php echo $params->get('rss');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('skype') != "") : ?>
      <li><a class="cfc-skype" href="<?php echo $params->get('skype');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('vimeo') != "") : ?>
      <li><a class="cfc-vimeo" href="<?php echo $params->get('vimeo');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('digg') != "") : ?>
      <li><a class="cfc-digg" href="<?php echo $params->get('digg');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('blog') != "") : ?>
      <li><a class="cfc-blog" href="<?php echo $params->get('blog');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('tumblr') != "") : ?>
      <li><a class="cfc-tumblr" href="<?php echo $params->get('tumblr');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('mail') != "") : ?>
      <li><a class="cfc-mail" href="<?php echo $params->get('mail');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('wordpress') != "") : ?>
      <li><a class="cfc-wordpress" href="<?php echo $params->get('wordpress');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('dribble') != "") : ?>
      <li><a class="cfc-dribbble" href="<?php echo $params->get('dribble');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('yahoo') != "") : ?>
      <li><a class="cfc-yahoo" href="<?php echo $params->get('yahoo');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('reddit') != "") : ?>
      <li><a class="cfc-reddit" href="<?php echo $params->get('reddit');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('myspace') != "") : ?>
      <li><a class="cfc-myspace" href="<?php echo $params->get('myspace');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('soundcloud') != "") : ?>
      <li><a class="cfc-soundcloud" href="<?php echo $params->get('soundcloud');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('amazon') != "") : ?>
      <li><a class="cfc-amazon" href="<?php echo $params->get('amazon');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('bing') != "") : ?>
      <li><a class="cfc-bing" href="<?php echo $params->get('bing');?>" target="_blank"></a></li>    
      <?php endif;?>
      <?php if($params->get('delicious') != "") : ?>
      <li><a class="cfc-delicious" href="<?php echo $params->get('delicious');?>" target="_blank"></a></li>
      <?php endif;?>
      <?php if($params->get('share') != "") : ?>
      <li><a class="cfc-share" href="<?php echo $params->get('share');?>" target="_blank"></a></li> 
      <?php endif;?>
      <div class="clr"></div>
</ul>
<div class="clr"></div>
</div>