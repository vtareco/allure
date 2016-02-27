<?php
/**
* Author:	Omar Muhammad
* Email:	admin@omar84.com
* Website:	http://omar84.com
* Module:	Simple Image Holder
* Version:	3.0.0
* Date:		04/11/2012
* License:	http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Copyright:Copyright © 2007 - 2012 Omar's Site. All rights reserved.
**/

defined('_JEXEC') or die('Restricted access');

$facebook	= $params->get('facebook','');
$twitter	= $params->get('twitter','');
$linkedin	= $params->get('linkedin','');
//$rss	= $params->get('rss','');



?>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>


<div class="social">
<a href="<?php echo $facebook ;?>" class="face" target="_blank"><span></span></a>
<a href="<?php echo $twitter ;?>" class="twitter" target="_blank"><span></span></a>
<a href="<?php echo $linkedin ;?>" class="linkedin" target="_blank"><span></span></a>

</div>

<style type="text/css">
 .social a {
 display: inline-block;
 width: 31px;
 height: 32px;
 overflow: hidden;
 vertical-align: middle;
 position: relative;
}

 .social a span {
 position: absolute;
 top: 0;
 left: 0;
 width: 31px;
 height: 64px;
 background-image: url(modules/mod_a_social/spirits.png);
}

 .social a.face span {
 background-position: -274px -60px;
}

 .social a.twitter span {
 background-position: -315px -60px;
}


 .social a.linkedin span {
 background-position: -355px -60px;
}

 .social a.github span {
 background-position: -396px -60px;
}
</style>
<script type="text/javascript">
/* Hover Effect on Social Icons */
 $('.social a').each(function (){
  $(this).hover( function (){
  $(this).find('span').stop(true, false).animate ({
     top: -32,
   }, 500, function() {
   });    
  },function(){
   $(this).find('span').stop(true, false).animate ({
     top: 0,
   }, 500, function() {
   });    
  });    
 })

</script>