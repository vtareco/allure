<?php
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
require_once JPATH_SITE . '/modules/mod_articles_latest/helper.php' ;
class modProtostarCarouselSlide {
     public $img;
     public $url;
     public $text;
}
class modProtostarCarousel {
	public $height;
	public $slides;
}
class modProtostarCarouselHelper extends modArticlesLatestHelper
{
    /**
     * Retrieves the Carousel
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    
    function getCarousel( $params )
    {
	    $carousel=new modProtostarCarousel();
	    $carousel->height=$params->get('height') !="" ? $params->get('height') : 300 ;
	    $carousel->slides=Array();
	    
	    /*zforeach ($this->getList( $params )  as $k => $article) {

		    $images = json_decode($article->images);
		    $imageName="image_".$params->get('image');
		    
		    if (isset($images->$imageName) and !empty($images->$imageName) )
		    {

			    $slide=new modProtostarCarouselSlide();
			    $article->slug = $article->id . ':' . $article->alias;
			    $article->catslug = $article->catid . ':' . $article->category_alias;
			    $slide->url = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug));
			    $slide->img=$images->$imageName;
			    $slide->text=$article->introtext;
			    $slide->title=$article->title;
			    array_push($carousel->slides,$slide);
		    }
	    }
	    */
	    //if(sizeof($carousel->slides) == 0){
	       $dir    = 'images/carousel';
	       $files = scandir($dir);
	       foreach($files as $file){
		    if( (strpos($file,'.jpg') !== false) ){
			 $file = "images/carousel/".$file;
			 $slide=new modProtostarCarouselSlide();
			 $slide->url = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug));
			 $slide->img=$file;
			 $slide->text="Nova casa em Lisboa com vista para o tejo, mesmo TOP!";//$article->introtext;
			 //$slide->title="Casa TOP em lisboa";//$article->title;
			 array_push($carousel->slides,$slide);
		    }
	       }
	    //}
	    
	    return $carousel;
    }
}
?>