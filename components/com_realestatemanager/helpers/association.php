<?php

defined('_JEXEC') or die;

JLoader::register('ContentHelper', JPATH_ADMINISTRATOR . '/components/com_content/helpers/content.php');
JLoader::register('CategoryHelperAssociation', JPATH_ADMINISTRATOR . '/components/com_categories/helpers/association.php');

abstract class RealestatemanagerHelperAssociation extends CategoryHelperAssociation{


    public static function getAssociations($id = 0, $view = null){

        if(isset($_REQUEST['task'])){
            
            $task = $_REQUEST['task'];
            $itemId = $_REQUEST['Itemid'];
            JLoader::import('helpers.route', JPATH_COMPONENT_SITE);

            if($task == 'showCategory'){

                $catid = $_REQUEST['catid'];

		if($catid){
                    $rederectUrlArr = RealestatemanagerHelperRoute::getRemCategoryRoute($catid, $itemId);
                    return $rederectUrlArr;
		}			
            }

            if($task == 'view'){		

                $id = $_REQUEST['id'];
		 	
                if ($id){
                    $rederectUrlArr = RealestatemanagerHelperRoute::getRemAssocRoute($id, $itemId);
                    return $rederectUrlArr;
		}
            }
	}
        return array();  
    }
}