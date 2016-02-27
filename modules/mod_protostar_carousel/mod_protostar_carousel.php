<?php
/**
 * Protostar Carousel Module Entry Point
 * 
 * @package    Protostar  Carousel
 * @subpackage Modules
 * @link http://www.thomasbouffon.fr
 * @license        GNU/GPL, see COPYING.GPLv3.txt
 * mod_protostar_carousel is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// Include the syndicate functions only once

require_once( dirname(__FILE__).'/helper.php' );


$carouselHelper = new ModProtostarCarouselHelper;
$carousel = $carouselHelper->getCarousel($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require( JModuleHelper::getLayoutPath( 'mod_protostar_carousel' ) );

?>
