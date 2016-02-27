<?php


if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
defined("DS") OR define("DS", DIRECTORY_SEPARATOR);
global $mosConfig_lang, $user_configuration; // for 1.6
$mainframe = JFactory::getApplication(); // for 1.6
$GLOBALS['mainframe'] = $mainframe;



$mosConfig_absolute_path = $GLOBALS['mosConfig_absolute_path'] = JPATH_SITE;

$uri = $_SERVER['REQUEST_URI'];

if(stripos($uri, "&fb-share") > -1){
    $task = $_GET['task'];
    $id = $_GET['id'];
    $catid=46;
    $layout='default';
}else{
    //if(strpos($uri, "search_villa?")){
        $uri = str_replace("search_villa?", "search_villa/?", $uri);
        
    //}
    $vars = explode("/", $uri);
    
    $task='';
    
    for($i=0;$i<count($vars); $i++){
        if($vars[$i] == 'villas' && isset($vars[$i])){
            $task = $vars[$i+1];
            if($task == 'view'){
                $id=$vars[$i+2];
                $catid=46;
                $layout='default';
            }
        }
    }

    if(strpos($task, 'view')>-1 && $task != 'view'){
        $task = '';
    }
}


require($mosConfig_absolute_path.'/components/com_realestatemanager/realestatemanager.php');


?>