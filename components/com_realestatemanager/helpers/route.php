<?php
defined('_JEXEC') or die;

abstract class RealestatemanagerHelperRoute{

	public static function getRemAssocRoute($id, $itemId){

        $database = JFactory::getDBO();
		$link = array();
        $houseIdArr = array();        
        if(isset($id) && isset($itemId)){
            $query = "SELECT associate_house FROM #__rem_houses WHERE id = $id";
            $database->setQuery($query);
            $associate_house = $database->loadResult();  
            $associate_house = unserialize($associate_house);
            
            foreach($associate_house as $oneHouse){
                if($oneHouse != 0){
                    $houseIdArr[] = $oneHouse;
                }
            } 
            
            if(count($houseIdArr) > 0){
                $houseIdStr = implode(',', $houseIdArr);
                $query = "SELECT id, language
                            FROM #__rem_houses  
                             WHERE id in ( $houseIdStr )";
                $database->setQuery($query);
                $assocHouse = $database->loadAssocList(); 

                foreach ($assocHouse as $value) {
                    $lang = $value['language'];
                    $CurId = $value['id'];
                    
                    if(isset($assocHouse)){
                        $query = "SELECT idcat
                                      FROM #__rem_categories  
                                      WHERE iditem = $CurId";
                        $database->setQuery($query);
                        $assocHouseCat = $database->loadResult();                        
                    }     
                    $link[$lang] = "index.php?option=com_realestatemanager&task=view&catid=$assocHouseCat&id=$CurId&Itemid=$itemId";
                }
            }
        } 
        return $link;
	}

	public static function getRemCategoryRoute($catid, $itemId){

        $database = JFactory::getDBO();
        $link = array();
            
        if(isset($catid) && isset($itemId)){
            $catIdArr = array();
            
            $query = "SELECT associate_category FROM #__rem_main_categories WHERE id = $catid";
            $database->setQuery($query);
            $parent_id = $database->loadResult();  
            $parent_id = unserialize($parent_id);
            
            foreach($parent_id as $oneCat){
                if($oneCat != 0){
                    $catIdArr[] = $oneCat;
                }
            } 
     
            if($parent_id > 0){
                $catIdStr = implode(',', $catIdArr);
                $query = "SELECT id, language
                            FROM #__rem_main_categories  
                             WHERE id in ($catIdStr)";
                $database->setQuery($query);
                $assocCategory = $database->loadAssocList();
       
                foreach ($assocCategory as $value) {
                    $lang = $value['language'];
                    $CurId = $value['id'];
                        
                    $link[$lang] = "index.php?option=com_realestatemanager&task=showCategory&catid=$CurId&Itemid=$itemId";
                }
            }
        }  
        return $link; 
	}
}