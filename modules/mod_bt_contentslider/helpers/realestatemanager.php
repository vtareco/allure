<?php

class RealEstateManagerHelper{
    
    static function getSpotligths(){
        global $database;
        
        $task = "getSpotlight";
        
        require_once JPATH_SITE.'/components/com_realestatemanager/realestatemanager.php';
        
        // casas como best of
        $query = "SELECT r.region, h.* FROM allure_rem_houses AS h LEFT JOIN allure_regions AS r ON r.regionid=h.hregion WHERE extra2 = 'true' ORDER BY RAND() LIMIT 10";
        
        $database->setQuery($query);
        $houses = $database->loadObjectList();
        
        return $houses;
        
    }
    
}

?>