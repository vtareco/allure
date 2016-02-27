<?php // no direct access
/**
 * Helper class for Protostar Carousel! module
 * 
 * @package    Protostar  Carousel
 * @subpackage Modules
 * @link http://www.thomasbouffon.fr
 * @license        GNU/GPL, see COPYING.GPLv3.txt
 * mod_protostarcarousel is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div id="myCarousel" class="carousel slide" style="height:<?php echo $carousel->height;?>px">
	<ol class="carousel-indicators">
		<?php foreach($carousel->slides as $k => $slide) :?>
			<li data-target="#myCarousel" data-slide-to=<?php echo "\"$k\" "; if ($k == 0) {echo ' class="active"';}?>></li>
		<?php endforeach;?>
	</ol>
	<!-- Carousel items -->
	<div class="carousel-inner" style="height:100%">
		<?php foreach($carousel->slides as $k => $slide) :?>
			<div class="item<?php if ($k == 0) {echo ' active';}?>" style="height:100%">
				<img alt="" src="<?php echo $slide->img;?>">
			</div>
		<?php 	 endforeach;?>
</div>
<!-- Carousel nav
-->
<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
