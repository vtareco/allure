<?php

if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
defined("DS") OR define("DS", DIRECTORY_SEPARATOR);
/**
 *
 * @package  RealEstateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com)
 * Homepage: http://www.ordasoft.com
 * @version: 3.0 Pro
 *
 * */
$mosConfig_absolute_path = $GLOBALS['mosConfig_absolute_path'] = JPATH_SITE;
global $mosConfig_lang, $user_configuration; // for 1.6
$mainframe = JFactory::getApplication(); // for 1.6
$GLOBALS['mainframe'] = $mainframe;

if (get_magic_quotes_gpc()) {

    function stripslashes_gpc(&$value) {
        $value = stripslashes($value);
    }

    array_walk_recursive($_GET, 'stripslashes_gpc');
    array_walk_recursive($_POST, 'stripslashes_gpc');
    array_walk_recursive($_COOKIE, 'stripslashes_gpc');
    array_walk_recursive($_REQUEST, 'stripslashes_gpc');
}

jimport('joomla.html.pagination');
require_once($mosConfig_absolute_path . "/components/com_realestatemanager/compat.joomla1.5.php");
if (version_compare(JVERSION, "3.0.0", "lt"))
    include_once($mosConfig_absolute_path . '/libraries/joomla/application/pathway.php'); // for 1.6
include_once($mosConfig_absolute_path . '/components/com_realestatemanager/realestatemanager.main.categories.class.php');
jimport('joomla.application.pathway');
jimport('joomla.html.pagination');
jimport('joomla.filesystem.folder');

$database = JFactory::getDBO();
// load language
/*$languagelocale = "";
$query = "SELECT l.title, l.lang_code, l.sef ";
$query .= "FROM #__rem_const_languages as cl ";
$query .= "LEFT JOIN #__rem_languages AS l ON cl.fk_languagesid=l.id ";
$query .= "LEFT JOIN #__rem_const AS c ON cl.fk_constid=c.id ";
$query .= "GROUP BY  l.title";
$database->setQuery($query);
$languages = $database->loadObjectList();

$lang = JFactory::getLanguage();
foreach ($lang->getLocale() as $locale) {
    foreach ($languages as $language) {
        if ($locale == $language->title || $locale == $language->lang_code || $locale == $language->sef) {
            $mosConfig_lang = $locale;
            $languagelocale = $language->lang_code;
            break;
        }
    }
}

if ($languagelocale == '') {
    $languagelocale = "en-GB";
    $mosConfig_lang = "en-GB";
    }
*/

//Altera��o 21-02-2015
//D� a multi-language ao componente realestatemanager
//de acordo com a forma como foi implementado o sistema de multi-linguas do site
$lang = JFactory::getLanguage();
$languagelocale = $lang->getTag();
$locale = $lang->getLocale();
$mosConfig_lang = $languagelocale;

//echo "---------->".$locale;
//echo "---------->".$languagelocale;

//echo "Favoreites:";print_r($_SESSION['favorite_houses']);


global $langContent;
$langContent = substr($languagelocale, 0, 2);

$GLOBALS['languagelocale'] = $languagelocale;

$query = "SELECT c.const, cl.value_const ";
$query .= "FROM #__rem_const_languages as cl ";
$query .= "LEFT JOIN #__rem_languages AS l ON cl.fk_languagesid=l.id ";
$query .= "LEFT JOIN #__rem_const AS c ON cl.fk_constid=c.id ";
$query .= "WHERE l.lang_code = '$languagelocale'";
$database->setQuery($query);
$langConst = $database->loadObjectList();

foreach ($langConst as $item) {
   if(!defined($item->const) )  define($item->const, $item->value_const); // $database->quote()
}

require_once($mosConfig_absolute_path . "/components/com_realestatemanager/captcha.php");

/** load the html drawing class */
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.rent.php");
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.html.php"); // for 1.6
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.php"); // for 1.6
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.rent_request.php");
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.buying_request.php");
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.rent.php");
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.review.php");
require_once ($mosConfig_absolute_path . "/administrator/components/com_realestatemanager/realestatemanager.class.others.php");
//added 2012_06_05 that's because it doesn't work with enabled plugin System-Legacy, so if it works, let it work :)
require_once($mosConfig_absolute_path . "/components/com_realestatemanager/functions.php");
require_once($mosConfig_absolute_path . "/components/com_realestatemanager/includes/menu.php");

//added 2012_06_05 that's because it doesn't work with enabled plugin System-Legacy, so if it works, let it work :)
if (!array_key_exists('realestatemanager_configuration', $GLOBALS)) {
    require_once ($mosConfig_absolute_path . "/administrator/components/com_realestatemanager/realestatemanager.class.conf.php");
    $GLOBALS['realestatemanager_configuration'] = $realestatemanager_configuration;
} else
    global $realestatemanager_configuration;

if (!isset($option))
    $GLOBALS['option'] = $option = mosGetParam($_REQUEST, 'option', 'com_realestatemanager');
else
    $GLOBALS['option'] = $option;


if (isset($option) && $option == "com_simplemembership") {
    if (!array_key_exists('user_configuration2', $GLOBALS)) {
        require_once (JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_simplemembership' . DS . 'admin.simplemembership.class.conf.php');
        $GLOBALS['user_configuration2'] = $user_configuration;
    } else {
        global $user_configuration;
    }
}

if (!isset($task))
    $GLOBALS['task'] = $task = mosGetParam($_REQUEST, 'task', ''); else
    $GLOBALS['task'] = $task;
    
if($task==''){
    header("Location: ".$mosConfig_live_site."/villas/search_villa");
    exit();
    //$task='search_villa';
}

$my = JFactory::getUser();
$acl = JFactory::getACL();
$GLOBALS['my'] = $my;
$GLOBALS['acl'] = $acl;


/*Altera��o em 18-04-2015
 *@author CMS
 *As variaveis id e catid apenas s�o atribuidas, se estas ainda n�o foram atribuidas previamente
 *Tipicamente s�o atribuidas no componente com_villas, antes deste componente ser chamado
 */
if(!isset($id))
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
if(!isset($catid))
    $catid = intval(mosGetParam($_REQUEST, 'catid', 0));
    
    
$bids = mosGetParam($_REQUEST, 'bid', array(0));
$Itemid = mosGetParam($_REQUEST, 'Itemid', 0);
$printItem = trim(mosGetParam($_REQUEST, 'printItem', ""));

$doc = JFactory::getDocument(); // for 1.6
$GLOBALS['doc'] = $doc; // for 1.6
$GLOBALS['op'] = $doc; // for 1.6
$doc->setTitle(_REALESTATE_MANAGER_TITLE); // for 1.6

if (!isset($GLOBALS['Itemid']))
    $GLOBALS['Itemid'] = JRequest::getInt('Itemid');
if (!isset($GLOBALS['Itemid']))
    $GLOBALS['Itemid'] = $Itemid = intval(mosGetParam($_REQUEST, 'Itemid', 0));

// paginations
$intro = $realestatemanager_configuration['page']['items']; // page length

if ($intro) {
    $paginations = 1;
    /*
     *Altera��es por CMS em 27-02-2015
     *Para dar suporte a pagina��o consoante o
     *componente foi alterado
     */
    $limit = null;
    $limitstart = null;
    //Se n�o existe a variavel get limit
    //Atribui as duas variaveis como se fossem separadas as duas por virgulas
    if($_REQUEST['limit'] == ''){
        $vars = explode("/",$_SERVER['PHP_SELF']);
        
        if(is_numeric($vars[count($vars)-1]))
            $limit = $vars[count($vars)-1];
        else
            $limit = $intro;
            
        if(is_numeric($vars[count($vars)-2]))
            $limitstart = $vars[count($vars)-2];
        else
            $limitstart = 0;
    }
    else {
        //Sen�o atribui as duas como se existissem as duas variaveis get com os nomes definidos
        $limit = $_REQUEST['limit'];
        $limitstart = $_REQUEST['limitstart'];
    }
    //Se por algum motivo alguma delas continua a null
    if($limit == null)
        $limit = $intro;
    if($limitstart == null)
        $limitstart = 0;
    //Atribui a variaveis globais
    $GLOBALS['limit'] = $limit;
    $GLOBALS['limitstart'] = $limitstart;
    /*$limit = intval(mosGetParam($_REQUEST, 'limit', $intro));
    $GLOBALS['limit'] = $limit;
    $limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));
    $GLOBALS['limitstart'] = $limitstart;
    */
    $total = 0;
    $LIMIT = 'LIMIT ' . $limitstart . ',' . $limit;
} else {
    $paginations = 0;
    $LIMIT = '';
}

$session = JFactory::getSession();
$session->set("array", $paginations);



// for 1.6
if (isset($_REQUEST['view']))
    $view = mosGetParam($_REQUEST, 'view', '');
if ((!isset($task) OR $task == '' ) AND isset($view))
    $task = $view;
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "[ Rent Request ]")
    $task = "rent_request";

if ($realestatemanager_configuration['debug'] == '1') {
    echo "Task: " . $task . "<br />";
    print_r($_REQUEST);
    echo "<hr /><br />";
}

$bid = mosGetParam($_REQUEST, 'bid', array(0));
// --
if(isset ($_REQUEST["bid"]) AND isset ($_REQUEST["rent_from"]) AND isset($_REQUEST["rent_until"])){
    
    $bid_ajax_rent = $_REQUEST["bid"];
    $rent_from = $_REQUEST["rent_from"];
    $rent_until = $_REQUEST["rent_until"];
    
    if(isset($_REQUEST["special_price"])){
       $special_price = $_REQUEST["special_price"]; 
    }
    if(isset($_REQUEST["currency_spacial_price"])){
       $currency_spacial_price = $_REQUEST["currency_spacial_price"];
    }  
    
    if(isset($_REQUEST["comment_price"])){
        $comment_price = $_REQUEST["comment_price"];
    } else {
        $comment_price = '';
    }
    
}

switch ($task) {
    case 'ajax_rent_calcualete':        
        PHP_realestatemanager::ajax_rent_calcualete($bid_ajax_rent,$rent_from,$rent_until);
        break;
    case 'secret_image':
        PHP_realestatemanager::secretImage();
        break;
    case 'search_villa':
        //$_SESSION['referer'] = 'search_villa';
        PHP_realestatemanager::showSearchHouses($option, $catid, $option);
        echo "<div id='searchResult' style='float: left; width:650px'>";
        PHP_realestatemanager::searchHouses($option, $catid, $option, $languagelocale);
        echo "</div>";
        break;
    case 'best_of':
        //$_SESSION['referer'] = 'best_of';
        PHP_realestatemanager::showSearchHouses($option, $catid, $option, "", $task);
        echo "<div id='searchResult' style='float: left; width:650px'>";
        $_REQUEST['extra2'] = 'on';
        PHP_realestatemanager::searchHouses($option, $catid, $option, $languagelocale);
        echo "</div>";
        break;
    case 'for_sale':
        //$_SESSION['referer'] = 'for_sale';
        PHP_realestatemanager::showSearchHouses($option, $catid, $option, "", $task);
        echo "<div id='searchResult' style='display:none;float: left; width:650px'>";
        $_REQUEST['extra1'] = 'on';
        PHP_realestatemanager::searchHouses($option, $catid, $option, $languagelocale);
        echo "</div>";
        break;
    case 'favorites':
        //$_SESSION['referer'] = 'favorites';
        if(isset($_SESSION['favorite_houses']) && count($_SESSION['favorite_houses'])>0){
            PHP_realestatemanager::showSearchHouses($option, $catid, $option, "", $task);
            $_REQUEST['favorites'] = 'on';
            echo "<div id='searchResult' style='float: left; width:650px'>";
            PHP_realestatemanager::searchHouses($option, $catid, $option, $languagelocale);
            echo "</div>";
        }else{
            $_REQUEST['favorites'] = 'off';
            mosRedirect($mosConfig_live_site.'/index.php/component/realestatemanager/search_villa');
        }
        break;
    case 'getSpotlight':
        
        break;
    case 'getInTheSpotlights':
        PHP_realestatemanager::showSpotlights();
        break;
    case 'show_search_house':
        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new mosParameters($menu->params);
        }
        $layout = $params->get('showsearchhouselayout', '');
        PHP_realestatemanager::showSearchHouses($option, $catid, $option, $layout);
        break;
    case 'show_search':
        PHP_realestatemanager::showSearchHouses($option, $catid, $option);
        break;

    case 'search':
        PHP_realestatemanager::searchHouses($option, $catid, $option, $languagelocale);
        break;

    case 'all_houses':
        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new mosParameters($menu->params);
        }
        $layout = $params->get('allhouselayout', '');
        if ($layout == '')
            $layout = $realestatemanager_configuration['layout_all_houses'];
        PHP_realestatemanager::ShowAllHouses($layout, $printItem);
        break;
    case 'view_house':
    case 'view':
        
        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new mosParameters($menu->params);
        }
        $layout = $params->get('viewhouselayout', '');

        if ($layout == '' && isset($catid) && $catid != 0) {
            $query = "SELECT params2 FROM #__rem_main_categories WHERE id =" . $catid;
            $database->setQuery($query);
            $params2 = $database->loadResult();
            $object_params = unserialize($params2);
            if ($object_params && $object_params->view_house != '')
                $layout = $object_params->view_house;
        }

        if ($layout == '')
            $layout = $realestatemanager_configuration['view_house'];
        if ($id) {
            $query = "SELECT idcat AS catid FROM #__rem_categories WHERE iditem=" . $id;
            $database->setQuery($query);
            $catid = $database->loadObjectList();
            $catid = $catid[0]->catid;
            PHP_realestatemanager::showItemREM($option, $id, $catid, $printItem, $layout);
        } else {
            if (version_compare(JVERSION, '3.0', 'ge')) {
                $menu = new JTableMenu($database);
                $menu->load($Itemid);
                $params = new JRegistry;
                $params->loadString($menu->params);
            } else {
                $menu = new mosMenu($database);
                $menu->load($GLOBALS['Itemid']);
                $params = new mosParameters($menu->params);
            }
            if (version_compare(JVERSION, "1.6.0", "lt")) {
                $id = $params->get('house');
            } else if (version_compare(JVERSION, "1.6.0", "ge") && version_compare(JVERSION, "3.5.0", "lt")) {
                $view_house_id = ''; // for 1.6 
                $view_house_id = $params->get('house');

                if ($view_house_id > 0) {
                    $id = $view_house_id;
                }
            }
            $query = "SELECT idcat AS catid FROM #__rem_categories WHERE iditem=" . $id;
            $database->setQuery($query);
            $catid = $database->loadObject();
            $catid = $catid->catid;
            
            PHP_realestatemanager::showItemREM($option, $id, $catid, $printItem, $layout);
        }
        break;

    case 'add_favorite':
        PHP_realestatemanager::addToFavorites($id);
        break;
    case 'remove_favorite':
        PHP_realestatemanager::removeFromFavorites($id);
        break;
    case 'review':
        PHP_realestatemanager::reviewHouse($option);
        break;

    case 'alone_category':
    case 'showCategory':
        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new mosParameters($menu->params);
        }

        $layout = $params->get('categorylayout', '');

        if ($layout == '' && isset($catid) && $catid != 0) {
            $query = "SELECT params2 FROM #__rem_main_categories WHERE id =" . $catid;
            $database->setQuery($query);
            $params2 = $database->loadResult();
            $object_params = unserialize($params2);
            if ($object_params && $object_params->alone_category != '')
                $layout = $object_params->alone_category;
        }

        if ($layout == '')
            $layout = $realestatemanager_configuration['view_type'];

        if ($catid) {
            PHP_realestatemanager::showCategory($catid, $printItem, $option, $layout, $languagelocale);
        } else {
            $menu = new mosMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new mosParameters($menu->params);
            if (version_compare(JVERSION, "1.6.0", "lt")) {
                $catid = $params->get('catid');
            } else if (version_compare(JVERSION, "1.6.0", "ge") && version_compare(JVERSION, "3.5.00", "lt")) {
                $single_category_id = ''; // for 1.6
                $single_category_id = $params->get('single_category');
                if ($single_category_id > 0)
                    $catid = $single_category_id;
            }
            PHP_realestatemanager::showCategory($catid, $printItem, $option, $layout, $languagelocale);
        }
        break;

    case 'rent_request':
        PHP_realestatemanager::showRentRequest($option, $bids);
        break;

    case 'rent_requests':
        PHP_realestatemanager::rent_requests($option, $bids);
        break;

    case 'rent':
        if (mosGetParam($_REQUEST, 'save') == 1)
            PHP_realestatemanager::saveRent($option, $bid);
        else
            PHP_realestatemanager::rent($option, $bid);
        break;

    case 'rent_return':
        if (mosGetParam($_REQUEST, 'save') == 1)
            PHP_realestatemanager::saveRent_return($option, $bid); else
            PHP_realestatemanager::rent_return($option, $bid);
        break;

    case 'accept_rent_requests':
        PHP_realestatemanager::accept_rent_requests($option, $bids);
        break;

    case 'decline_rent_requests':
        PHP_realestatemanager::decline_rent_requests($option, $bids);
        break;

    case 'buying_requests':
        PHP_realestatemanager::buying_requests($option, $bids);
        break;

    case 'accept_buying_requests':
        PHP_realestatemanager::accept_buying_requests($option, $bids);
        break;

    case 'decline_buying_requests':
        PHP_realestatemanager::decline_buying_requests($option, $bids);
        break;

    case 'rent_history':
        PHP_realestatemanager::rent_history($option);
        break;

    case 'save_rent_request':
        PHP_realestatemanager::saveRentRequest($option, $bids);
        break;

    case 'buying_request':

        PHP_realestatemanager::saveBuyingRequest($option, $bids);
        break;

    case 'mdownload':
        PHP_realestatemanager::mydownload($id);
        break;

    case 'downitsf':
        PHP_realestatemanager::downloaditself($id);
        break;

    case 'suggestion':
        PHP_realestatemanager::suggestion_func($option);
        break;

    case 'show_add' :
        PHP_realestatemanager::editHouse($option, 0);
        break;

    case 'edit_house':
        PHP_realestatemanager::editHouse($option, $id);
        break;

    case 'save_add' :
        PHP_realestatemanager::saveHouse($option, $id);
        break;

    case 'my_houses':
    case 'show_my_houses':
    case 'showmyhouses':
        PHP_realestatemanager::showMyHouses($option);
        break;

    case 'show_rss_categories':
        PHP_realestatemanager::listRssCategories($languagelocale);
        break;

    case 'owners_list':
    case 'ownerslist':
        PHP_realestatemanager::ownersList($option);
        break;

    case 'owner_houses':
    case 'view_user_houses':
    case 'showownerhouses':
        PHP_realestatemanager::viewUserHouses($option, $languagelocale);
        break;

    case 'rent_before_end_notify':
        PHP_realestatemanager::rentBeforeEndNotify($option);
        break;

    case 'publish':
        PHP_realestatemanager::publishHouse();
        break;

    case 'unpublish':
        PHP_realestatemanager::unpublishHouse();
        break;

    case 'delete':
        PHP_realestatemanager::deleteHouse();
        break;
    
    case "ajax_rent_price":
        rentPriceREM($bid_ajax_rent,$rent_from,$rent_until,$special_price,$comment_price,$currency_spacial_price);
        break;
    case 'ajax_get_cities':
        $region = mosGetParam($_REQUEST, 'region');
        PHP_realestatemanager::getCities($region);
        break;
    case 'all_categories':
        if (version_compare(JVERSION, '2.5', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new mosParameters($menu->params);
        }
        $layout = $params->get('allcategorylayout', '');
        if ($layout == '')
            $layout = $realestatemanager_configuration['all_categories'];
        PHP_realestatemanager::listCategories($catid, $layout, $languagelocale);
        break;

    default:
        global $mosConfig_live_site;
        header("Location: ".$mosConfig_live_site."/villas/search_villa");
        /*if (version_compare(JVERSION, '2.5', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new mosParameters($menu->params);
        }
        $layout = $params->get('allcategorylayout', '');
        if ($layout == '')
            $layout = $realestatemanager_configuration['all_categories'];
        PHP_realestatemanager::listCategories($catid, $layout, $languagelocale);*/
        break;
}

class PHP_realestatemanager {

    /**
     * Obter cidades por regiao selecionada
     */
    static function getCities($region) {
        global $database;
            $whereclause = "";
            if($region != null && $region != '' && $region != 'all')
                $whereclause = "WHERE `hregion` = '$region'";
            $getCities = "SELECT DISTINCT hcity FROM `allure_rem_houses` $whereclause ORDER BY hcity ASC";
            $database->setQuery($getCities);
            $region_cities = $database->loadObjectList();
            $ret = array();
            for($i=0; $i<count($region_cities); $i++){
                $region_cities[$i]->hcity = trim($region_cities[$i]->hcity);
                $tmp = $region_cities[$i];
                if($tmp->hcity != null && $tmp->hcity != '')
                    array_push($ret, $tmp);
            }
            HTML_realestatemanager::showAjaxResponse($ret);
    }

	/**
	 * Spotlight Query
	 */
    static function showSpotlights(){
        global $database;
        
        $query = "SELECT r.region, h.* FROM allure_rem_houses AS h LEFT JOIN allure_regions AS r ON r.regionid=h.hregion WHERE published = 1 and extra2 = 'true' ORDER BY RAND() LIMIT 5";
        
        $database->setQuery($query);
        $houses = $database->loadObjectList();
        
        HTML_realestatemanager::showSpotlights($houses);
    }
    
    static function addToFavorites($house_id){
        if(!isset($_SESSION['favorite_houses'])){
            $_SESSION['favorite_houses'] = array();
        }else if(!in_array($house_id, $_SESSION['favorite_houses'])){
            array_push($_SESSION['favorite_houses'], $house_id);
        }
        //echo "1";
        //exit();
    }

    static function removeFromFavorites($house_id){
        if(isset($_SESSION['favorite_houses']) && in_array($house_id, $_SESSION['favorite_houses'])){
            for($i=0; $i < count($_SESSION['favorite_houses']); $i++){
                if($_SESSION['favorite_houses'][$i] == $house_id){
                    unset($_SESSION['favorite_houses'][$i]);
                }
            }
        }
//        echo "1";
//        exit();
    }
    
    static function mylenStr($str, $lenght) {
        if (strlen($str) > $lenght) {
            $str = substr($str, 0, $lenght);
            $str = substr($str, 0, strrpos($str, " "));
        }
        return $str;
    }

    static function addTitleAndMetaTags($idHouse = 0) {
        global $database, $doc, $mainframe, $Itemid;

        $view = JREQUEST::getCmd('view', null);
        $catid = JREQUEST::getInt('catid', null);
        $id = JREQUEST::getInt('id', null);
        $lang = JREQUEST::getString('lang', null);
        $title = array();
        $sitename = htmlspecialchars($mainframe->getCfg('sitename'));

        if (isset($view)) {
            $view = str_replace("_", " ", $view);
            $view = ucfirst($view);
            $title[] = $view;
        }

        $s = getWhereUsergroupsCondition('c');

        if (!isset($catid)) {

            // Parameters
            if (version_compare(JVERSION, '3.0', 'ge')) {
                $menu = new JTableMenu($database);
                $menu->load($Itemid);
                $params = new JRegistry;
                $params->loadString($menu->params);
            } else {
                $menu = new mosMenu($database);
                $menu->load($Itemid);
                $params = new mosParameters($menu->params);
            }
            if (version_compare(JVERSION, "1.6.0", "lt")) {
                $catid = $params->get('catid');
            } else if (version_compare(JVERSION, "1.6.0", "ge") && version_compare(JVERSION, "3.5.100", "lt")) {
                $single_category_id = ''; // for 1.6 
                $single_category_id = $params->get('single_category');
                if ($single_category_id > 0)
                    $catid = $single_category_id;
            }
        }

        //To get name of category
        if (isset($catid)) {
            $query = "SELECT  c.name, c.id AS catid, c.parent_id
                    FROM #__rem_main_categories AS c
                    WHERE ($s) AND c.id = " . intval($catid);
            $database->setQuery($query);
            $row = null;
            $row = $database->loadObject();
            if (isset($row)) {
                $cattitle = array();
                $cattitle[] = $row->name;
                while (isset($row) && $row->parent_id > 0) {
                    $query = "SELECT  name, c.id AS catid, parent_id 
                        FROM #__rem_main_categories AS c
                        WHERE ($s) AND c.id = " . intval($row->parent_id);
                    $database->setQuery($query);
                    $row = $database->loadObject();
                    if (isset($row) && $row->name != '') {
                        $cattitle[] = $row->name;
                    }
                }
                $title = array_merge($title, array_reverse($cattitle));
            }
        }

        //To get Name of the houses
        if (isset($id)) {
            $query = "SELECT h.htitle, c.id AS catid 
                    FROM #__rem_houses AS h
                    LEFT JOIN #__rem_categories AS hc ON h.id=hc.iditem
                LEFT JOIN #__rem_main_categories AS c ON c.id=hc.idcat 
                    WHERE ({$s}) AND h.id=" . intval($id) . "
                    GROUP BY h.id";
            $database->setQuery($query);
            $row = null;
            $row = $database->loadObject();
            if (isset($row)) {
                $idtitle = array();
                $idtitle[] = $row->htitle;
                $title = array_merge($title, $idtitle);
            }
        }

        if (empty($title) && $idHouse != 0) {
            $query = "SELECT h.htitle 
                    FROM #__rem_houses AS h
                    WHERE  h.id=" . $idHouse;
            $database->setQuery($query);
            $row = null;
            $row = $database->loadObject();
            if (isset($row)) {
                $idtitle = array();
                $idtitle[] = $row->htitle;
                $title = array_merge($title, $idtitle);
            }
        }

        $tagtitle = "";
        for ($i = 0; $i < count($title); $i++) {
            $tagtitle = trim($tagtitle) . " | " . trim($title[$i]);
        }

        //$rem = "RealEstate Manager ";
        $rem = "Allure Villas";
        //To set Title
        $title_tag = PHP_realestatemanager::mylenStr($rem . $tagtitle, 75);
        //To set meta Description
        $metadata_description_tag = PHP_realestatemanager::mylenStr($rem . $tagtitle, 200);
        //To set meta KeywordsTag
        $metadata_keywords_tag = PHP_realestatemanager::mylenStr($rem . $tagtitle, 250);
//print_r($title_tag);exit;
        $doc->setTitle($title_tag);
        $doc->setMetaData('description', $metadata_description_tag);
        $doc->setMetaData('keywords', $metadata_keywords_tag);
        //$doc->setBase('google.pt');
    }

    static function output_file($file, $name, $mime_type = '') {
        /*
          This function takes a path to a file to output ($file),
          the filename that the browser will see ($name) and
          the MIME type of the file ($mime_type, optional).
          If you want to do something on download abort/finish,
          register_shutdown_function('function_name');
         */
        if (!is_readable($file))
            die('File not found or inaccessible!');
        $size = filesize($file);
        $name = rawurldecode($name);

        /* Figure out the MIME type (if not specified) */
        $known_mime_types = array(
            "pdf" => "application/pdf",
            "txt" => "text/plain",
            "html" => "text/html",
            "htm" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "png" => "image/png",
            "jpeg" => "image/jpg",
            "jpg" => "image/jpg",
            "php" => "text/plain"
        );

        if ($mime_type == '') {
            $file_extension = strtolower(substr(strrchr($file, "."), 1));
            if (array_key_exists($file_extension, $known_mime_types)) {
                $mime_type = $known_mime_types[$file_extension];
            } else
                $mime_type = "application/force-download";
        };

        $name = str_replace(" ", "", $name);
        ob_end_clean(); //turn off output buffering to decrease cpu usage
        // required for IE, otherwise Content-Disposition may be ignored
        if (ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');

        header('Content-Type: application/force-download');
        header("Content-Disposition: inline; filename=$name");
        header("Content-Transfer-Encoding: binary");
        header('Accept-Ranges: bytes');

        /* The three lines below basically make the download non-cacheable */
        header("Cache-control: private");
        header('Pragma: private');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        // multipart-download and download resuming support
        if (isset($_SERVER['HTTP_RANGE'])) {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
            list($range) = explode(",", $range, 2);
            list($range, $range_end) = explode("-", $range);
            $range = intval($range);
            if (!$range_end)
                $range_end = $size - 1; else
                $range_end = intval($range_end);
            $new_length = $range_end - $range + 1;
            header("HTTP/1.1 206 Partial Content");
            header("Content-Length: $new_length");
        } else {
            $new_length = $size;
            header("Content-Length: " . $size);
        }

        $chunksize = 1 * (1024 * 1024); //you may want to change this
        $bytes_send = 0;
        if ($file = fopen($file, 'r')) {
            if (isset($_SERVER['HTTP_RANGE']))
                fseek($file, $range);
            while (!feof($file) && (!connection_aborted()) && ($bytes_send < $new_length)) {
                $buffer = fread($file, $chunksize);
                print($buffer); // is also possible
                flush();
                $bytes_send += strlen($buffer);
            }
            fclose($file);
        } else
            die('Error - can not open file.');
        die();
    }

    static function mydownload($id) {
        global $realestatemanager_configuration;
        global $mosConfig_absolute_path;

        $session = JFactory::getSession();
        $pas = $session->get("ssmid", "default");
        $sid_1 = $session->getId();

        if (!($session->get("ssmid", "default")) || $pas == "" || $pas != $sid_1 || $_COOKIE['ssd'] != $sid_1 ||
                !array_key_exists("HTTP_REFERER", $_SERVER) || $_SERVER["HTTP_REFERER"] == "" ||
                strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME']) === false) {
            echo '<H3 align="center">Link failure</H3>';
            exit;
        }
        if ($realestatemanager_configuration['license']['show']) {
            $fd = fopen($mosConfig_absolute_path . "/components/com_realestatemanager/mylicense.php", "w") or die("Config license file is failure");
            fwrite($fd, _REALESTATE_MANAGER_ADMIN_CONFIG_LICENSE_TEXT);
            fclose($fd);
            HTML_realestatemanager :: displayLicense($id);
        } else
            PHP_realestatemanager::downloaditself($id);
    }

    static function downloaditself($idt) {
        global $database, $my, $realestatemanager_configuration, $mosConfig_absolute_path;

        $session = JFactory::getSession();
        $pas = $session->get("ssmid", "default");
        $sid_1 = $session->getId();

        if (!($session->get("ssmid", "default")) || $pas == "" || $pas != $sid_1 ||
                $_COOKIE['ssd'] != $sid_1 || !array_key_exists("HTTP_REFERER", $_SERVER) ||
                $_SERVER["HTTP_REFERER"] == "" || strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME']) === false) {
            echo '<H3 align="center">Link failure</H3>';
            exit;
        }
        $session->set("ssmid", "default");

        if (array_key_exists("id", $_POST))
            $id = intval($_POST['id']); else
            $id = $idt;

        $query = "SELECT * from #__rem_houses where id = " . $id;
        $database->setQuery($query);
        $house = $database->loadObjectList();

        if (strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME']) !== false) {
            $name = explode('/', $house[0]->edok_link);
            $file_path = $mosConfig_absolute_path . $realestatemanager_configuration['edocs']['location'] . $name[count($name) - 1];
            set_time_limit(0);
            PHP_realestatemanager::output_file($file_path, $name[count($name) - 1]);
            exit;
        } else {
            header("Cache-control: private");
            header('Pragma: private');
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("HTTP/1.1 301 Moved Permanently");
            header('Content-Type: application/force-download');
            header("Location: " . $house[0]->edok_link);
            exit;
        }
    }

    static function saveRentRequest($option, $bids) {
        global $mainframe, $database, $my, $acl, $realestatemanager_configuration, $mosConfig_mailfrom, $Itemid;
        $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=rent_request&amp;Itemid=' . $Itemid);

        $transform_from = data_transform_rem($_POST['rent_from']);
        $transform_until = data_transform_rem($_POST['rent_until']);
        
        if($transform_from > $transform_until){
            echo "<script> alert('date from mast be less date until'); window.history.go(-1); </script>\n";
            exit;
        }
        
        PHP_realestatemanager::addTitleAndMetaTags();
        // for 1.6
        $path_way = $mainframe->getPathway();
        $path_way->addItem(_REALESTATE_MANAGER_LABEL_TITLE_RENT_REQUEST, $pathway);
        // --

        if (!($realestatemanager_configuration['rentstatus']['show']) || !checkAccess_REM($realestatemanager_configuration['rentrequest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
            echo _REALESTATE_MANAGER_NOT_AUTHORIZED;
            return;
        }

        $help = array();

        $rent_request = new mosRealEstateManager_rent_request($database);
        $post = JRequest::get('post');
        if (!$rent_request->bind($post)) {
            echo "<script> alert('" . $rent_request->getError() . "'); window.history.go(-1); </script>\n";
            exit;
        }


        $date_format = $realestatemanager_configuration['date_format'];
        if(phpversion() >= '5.3.0') {
            $date_format = str_replace('%', '', $date_format);
            $d_from = DateTime::createFromFormat($date_format, $post['rent_from']);
            $d_until = DateTime::createFromFormat($date_format, $post['rent_until']);
            if ($d_from === FALSE or $d_until === FALSE) {
                echo "<script> alert('Bad date format'); window.history.go(-1); </script>\n";
                exit;
            }
            $rent_request->rent_from = $d_from->format('Y-m-d');
            $rent_request->rent_until = $d_until->format('Y-m-d');
            
        } else {
            $rent_request->rent_from = data_transform_rem($post['rent_from'],'to');
            $rent_request->rent_until = data_transform_rem($post['rent_until'],'to');
        }
        

        $data = JFactory::getDBO();

        $rent_request->user_email = $data->Quote($rent_request->user_email);
        $rent_request->rent_request = date("Y-m-d H:i:s");
        $rent_request->fk_houseid = intval($_REQUEST["houseid"]);

      
        if ($rent_request->rent_from > $rent_request->rent_until) {
            echo "<script> alert('" . $rent_request->rent_from . " is more than " . $rent_request->rent_until .
            "'); window.history.go(-1); </script>\n";
            exit;
        }
        $query = "SELECT * FROM #__rem_houses where id= " . $rent_request->fk_houseid;
        $data->setQuery($query);
        $houseid = $data->loadObject();

        $query = "SELECT * FROM #__rem_rent where fk_houseid= " . $houseid->id . " AND rent_return IS NULL";
        $data->setQuery($query);
        $rents = $data->loadObjectList();
        
        $rent_from = substr($rent_request->rent_from, 0, 10);
        $rent_until = substr($rent_request->rent_until, 0, 10);
        
        foreach ($rents as $oneTerm){

            $oneTerm->rent_from = substr($oneTerm->rent_from, 0, 10);
            $oneTerm->rent_until = substr($oneTerm->rent_until, 0, 10);
            $returnMessage = checkRentDayNightREM (($oneTerm->rent_from),($oneTerm->rent_until), $rent_from, $rent_until, $realestatemanager_configuration);
           
            if(strlen($returnMessage) > 0){                 
                echo "<script> alert('$returnMessage'); window.history.go(-1); </script>\n";          
                exit;
            }       
        }  

        if ($my->id != 0)
            $rent_request->fk_userid = $my->id;
        if (!$rent_request->check()) {
            echo "<script> alert('" . $rent_request->getError() . "'); window.history.go(-1); </script>\n";
            exit;
        }

        if (!$rent_request->store()) {
            echo "<script> alert('" . $rent_request->getError() . "'); window.history.go(-1); </script>\n";
            exit;
        }   
        
        $time_difference = calculatePriceREM($houseid->id,$rent_from,$rent_until,$realestatemanager_configuration,$database);    
        
        $rent_request->checkin();
        array_push($help, $rent_request);

        $currentcat = new stdClass();

        // Parameters
        $menu = new mosMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);
        $menu_name = set_header_name_rem($menu, $Itemid);
        $params->def('header', $menu_name);
        $params->def('pageclass_sfx', '');
        $params->def('show_search', '1');
        $params->def('back_button', $mainframe->getCfg('back_button'));
        // --

        $currentcat->descrip = _REALESTATE_MANAGER_LABEL_RENT_REQUEST_THANKS;
        $currentcat->img = "./components/com_realestatemanager/images/rem_logo.png";
        //$currentcat->img = null;
        $currentcat->header = $params->get('header');

        // used to show table rows in alternating colours
        $tabclass = array('sectiontableentry1', 'sectiontableentry2');

        if ($realestatemanager_configuration['rentrequest_email']['show']) {
            $params->def('show_email', 1);
            if (checkAccess_REM($realestatemanager_configuration['rentrequest_email']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_email', 1);
            }
        }

        if ($params->get('show_input_email')) {
            if (trim($realestatemanager_configuration['rentrequest_email']['address']) != "") {
                $mail_to = explode(",", $realestatemanager_configuration['rentrequest_email']['address']);
                $userid = $my->id;
                //select user (added rent request)
                $zapros = "SELECT name, email FROM #__users WHERE id=" . $userid . ";";
                $database->setQuery($zapros);
                $item_user = $database->loadObjectList();
                echo $database->getErrorMsg();

                $zapros = "SELECT r.`id`, r.`houseid`, r.`htitle`, r.`owneremail` FROM #__rem_houses AS r WHERE r.`id`='" . $rent_request->fk_houseid . "';";
                $database->setQuery($zapros);
                $item_house = $database->loadObjectList();
                echo $database->getErrorMsg();
                //$houseid = _REALESTATE_MANAGER_LABEL_HOUSEID;

                if (trim($item_house[0]->owneremail) != '')
                    $mail_to[] = $item_house[0]->owneremail;

                if (count($mail_to) > 0)
                    $username = (isset($item_user[0]->name)) ? $item_user[0]->name : "anonymous";
                $message = str_replace("{username}", $username, _REALESTATE_MANAGER_EMAIL_NOTIFICATION_RENT_REQUEST);
                $message = str_replace("{hid_value}", $item_house[0]->houseid, $message);
                $message = str_replace("{house_title}", $item_house[0]->htitle, $message);

                if ($userid == 0) {
                    mosMail($mosConfig_mailfrom, 'anonymous', $mail_to, 'New rent request added!', $message, true);
                } else {
                    mosMail($mosConfig_mailfrom, $item_user[0]->name, $mail_to, 'New rent request added!', $message, true);
                }
            }
        }
        //********************   end add send mail for admin   ****************
        HTML_realestatemanager :: showRentRequestThanks($params, $currentcat,$houseid,$time_difference);
    }

    static function saveBuyingRequest($option, $bids) {
        global $mainframe, $database, $my, $Itemid, $acl;
        global $realestatemanager_configuration, $mosConfig_mailfrom;

        if (!($realestatemanager_configuration['buystatus']['show']) ||
                !checkAccess_REM($realestatemanager_configuration['buyrequest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
            echo _REALESTATE_MANAGER_NOT_AUTHORIZED;
            return;
        }

        $buying_request = new mosRealEstateManager_buying_request($database);
        $post = JRequest::get('post');
        if (!$buying_request->bind($post)) {
            echo $buying_request->getError();
            exit;
        }
        $buying_request->customer_email = $database->Quote($buying_request->customer_email);
        $buying_request->buying_request = date("Y-m-d H:i:s");
        $buying_request->fk_houseid = $bids[0];
        if (!$buying_request->store())
            echo "error:" . $buying_request->getError();
        $currentcat = new stdClass();

        // Parameters
        $menu = new JTableMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);
        //$app = JFactory::getApplication();
        //$menu1 = $app->getMenu();
        //if ( $menu1->getItem($Itemid) )
        $menu_name = set_header_name_rem($menu, $Itemid);
        //$menu_name = $menu1->getItem($Itemid)->title ;
        //else $menu_name = '';
        $params->def('header', $menu_name);
        $params->def('pageclass_sfx', '');
        $params->def('show_search', '1');
        $params->def('back_button', $mainframe->getCfg('back_button'));

        $currentcat->descrip = _REALESTATE_MANAGER_LABEL_BUYING_REQUEST_THANKS;

        // page image
        $currentcat->img = "./components/com_realestatemanager/images/rem_logo.png";
        //$currentcat->img = null;
        $currentcat->header = $params->get('header');

        //sending notification
        if (($realestatemanager_configuration['buyingrequest_email']['show'])) {
            $params->def('show_email', 1);
            if (checkAccess_REM($realestatemanager_configuration['buyingrequest_email']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl))
                $params->def('show_input_email', 1);
        }

        if ($params->get('show_input_email')) {
            $mail_to = array();
            if (trim($realestatemanager_configuration['buyingrequest_email']['address']) != "")
                $mail_to = explode(",", $realestatemanager_configuration['buyingrequest_email']['address']);

            $userid = $my->id;
            //select user (added rent request)
            $zapros = "SELECT name, email FROM #__users WHERE id=" . $userid . ";";
            $database->setQuery($zapros);
            $item_user = $database->loadObjectList();
            echo $database->getErrorMsg();

            for ($i = 0; $i < count($bids); $i++) {
                $zapros = "SELECT `id`, `houseid`, `htitle`,`owneremail` FROM #__rem_houses WHERE `id`='" . $bids[$i] . "';";
                $database->setQuery($zapros);
                $item_house = $database->loadObjectList();
                echo $database->getErrorMsg();

                //if (trim($mail_to) != ''){
                // $mail_to[] = $item_house[0]->owneremail;

                if (count($mail_to) > 0) {
                    $username = (isset($item_user[0]->name)) ? $item_user[0]->name : "anonymous";

                    $message = str_replace("{username}", $username, _REALESTATE_MANAGER_EMAIL_NOTIFICATION_BUYING_REQUEST);
                    $message = str_replace("{hid_value}", $item_house[0]->houseid, $message);
                    $message = str_replace("{house_title}", $item_house[0]->htitle, $message);
                    if ($userid == 0) {
                        mosMail($mosConfig_mailfrom, 'anonymous', $mail_to, 'New buying request added!', $message, true);
                    } else {
                        mosMail($mosConfig_mailfrom, $item_user[0]->name, $mail_to, 'New buying request added!', $message, true);
                    }
                }
            }
        }
        $query = "SELECT * FROM #__rem_houses where id= " . $buying_request->fk_houseid;
        $database->setQuery($query);
        $houseid = $database->loadObject();
        
        HTML_realestatemanager :: showRentRequestThanks($params, $currentcat,$houseid);
    }

    static function showRentRequest($option, $bid) {
        global $mainframe, $database, $my, $Itemid, $acl, $realestatemanager_configuration;

        $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=rent_request&amp;Itemid=' . $Itemid);

        // for 1.6
        $path_way = $mainframe->getPathway();
        $path_way->addItem(_REALESTATE_MANAGER_LABEL_TITLE_RENT_REQUEST, $pathway);
        // --

        if (!($realestatemanager_configuration['rentstatus']['show']) || !checkAccess_REM($realestatemanager_configuration['rentrequest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
            echo _REALESTATE_MANAGER_NOT_AUTHORIZED;
            return;
        }

        $bids = implode(',', $bid);

        // getting all houses for this category
        $query = "SELECT * FROM #__rem_houses"
                . "\nWHERE `id` IN (" . $bids . ") ORDER BY `catid`, `ordering`";
        $database->setQuery($query);
        $houses = $database->loadObjectList();

        $currentcat = new stdClass();

        // Parameters
        $menu = new mosMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);
        $menu_name = set_header_name_rem($menu, $Itemid);
        $params->def('header', $menu_name);
        // --

        $params->def('pageclass_sfx', '');
        $params->def('show_rentstatus', 1);
        $params->def('show_rentrequest', 1);
        $params->def('rent_save', 1);
        $params->def('back_button', $mainframe->getCfg('back_button'));

        // page description
        $currentcat->descrip = _REALESTATE_MANAGER_DESC_RENT;

        // page image
        //$currentcat->img = './components/com_realestatemanager/images/rem_logo.png';
        $currentcat->img = null;
        //$currentcat->align = 'right';

        $currentcat->header = $params->get('header');
        // used to show table rows in alternating colours
        $tabclass = array('sectiontableentry1', 'sectiontableentry2');

        HTML_realestatemanager::showRentRequest($houses, $currentcat, $params, $tabclass, $catid, $sub_categories, false, $option);
    }

    /**
     * comments for registered users REVIEW VILLA
     */
    static function reviewHouse() {
        global $mainframe, $database, $my, $Itemid, $acl, $realestatemanager_configuration, $mosConfig_absolute_path, $catid;
        global $mosConfig_mailfrom, $session;

        if (!($realestatemanager_configuration['reviews']['show'])){// || !checkAccess_REM($realestatemanager_configuration['reviews']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
            echo _REALESTATE_MANAGER_NOT_AUTHORIZED;
            return;
        }
        $review = new mosRealEstateManager_review($database);
        //************publish_on_review begin
        if ($realestatemanager_configuration['publish_on_review']['show']) {
            if (checkAccess_REM($realestatemanager_configuration['publish_on_review']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $review->published = 1;
            }
            else
                $review->published = 1; // VMT 14-02-2016 NAO FICAR PUBLICADO DE IMEDIATO
        }
        else
            $review->published = 1; // VMT 


        //************publish on add end

        $review->date = date("Y-m-d H:i:s");
        $review->getReviewFrom($my->id);

        //*********************   begin compare to key   ***************************
        $session = JFactory::getSession();
        $password = $session->get('captcha_keystring', 'default');

        if (array_key_exists('keyguest', $_POST) && ($_POST['keyguest'] != $password) && (userGID_REM($my->id) <= 0)) {
            mosRedirect("index.php?option=com_realestatemanager&task=view&catid=" . intval($_POST["catid"]) . "&id=" .
                    intval($_POST["fk_houseid"]) . "&Itemid=$Itemid&title=" . $_POST['title'] . "&comment=" .
                    $_POST['comment'] . "&rating=" . $_POST['rating'], "You typed bad characters from picture!");
            exit;
        }
        //**********************   end compare to key   *****************************
        $post = JRequest::get('post');
        if (!$review->bind($post)) {
            echo "<script> alert('" . $house->getError() . "'); window.history.go(-1); </script>\n";
            exit;
        }
        $review->rating = $_POST['rating'];
        if (version_compare(JVERSION, "3.0", "ge"))
            $review->rating *= 2;
        if (!$review->check()) {
            echo "<script> alert('" . $house->getError() . "'); window.history.go(-1); </script>\n";
            exit;
        }
        if (!$review->store()) {
            echo "<script> alert('" . $house->getError() . "'); window.history.go(-1); </script>\n";
            exit;
        }

        //***************   begin add send mail for admin   ******************

        $menu = new mosMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);

        if (($realestatemanager_configuration['review_added_email']['show']) && trim($realestatemanager_configuration['review_email']['address']) != "") {

            $params->def('show_email', 1);
            if (checkAccess_REM($realestatemanager_configuration['review_added_email']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_email', 1);
            }
        }

        
        global $mosConfig_mailfrom, $mosConfig_live_site;

        //if ($params->get('show_input_email')) {
            //$mail_to = explode(",", $realestatemanager_configuration['review_email']['address']);
            $mail_to = $mosConfig_mailfrom;
            //echo $mosConfig_mailfrom;
            //select house title
            $zapros = "SELECT htitle FROM allure_rem_houses WHERE id = '" . $_POST['fk_houseid'] . "';";
            $database->setQuery($zapros);
            $house_title = $database->loadObjectList();
            echo $database->getErrorMsg();

            $rating = (($review->rating)/2);

            $username = (isset($review->user_name)) ? "User ".$review->user_name : "Anonymous user";
            $message = str_replace("{username}", $username, _REALESTATE_MANAGER_EMAIL_NOTIFICATION_REVIEW);
            $message = str_replace("{house_title}", $house_title[0]->htitle, $message);
            $message = str_replace("{title}", $review->title, $message);
            $message = str_replace("{rating}", $rating, $message);
            $message = str_replace("{comment}", $review->comment, $message);
            $message = str_replace("{link}", 'allure-villas.com/allure/villas/view/'.$_POST['fk_houseid'], $message); // $mosConfig_live_site NOT WORKING
            //$message .= '<br><br><a href="'.$mosConfig_live_site.'/villas/view/'.$_POST['fk_houseid'].'">Link to view this villa</a>';
            
            $mail_subject = 'New villa review for: '.$house_title[0]->htitle;;

            mosMail($mosConfig_mailfrom, $username, $mail_to, $mail_subject, $message, true);
            // TEST:mosMail('vtareco88@gmail.com', $username, 'vtareco88@gmail.com', $mail_subject, $message, true);
        //}
        //********************   end add send mail for admin ************
        //showing the original entries
        mosRedirect("index.php?option=com_realestatemanager&task=view&catid=" . intval($_POST['catid']) . "&id=$review->fk_houseid&Itemid=$Itemid");
    }

    //*************   begin add for suggestion   ********************
    static function suggestion_func($option) {
        global $mainframe, $database, $my, $Itemid, $acl, $realestatemanager_configuration, $mosConfig_absolute_path, $catid;
        global $mosConfig_mailfrom, $session;

        $session = JFactory::getSession();
        $password = $session->get('captcha_keystring', 'default');

        if ($_REQUEST['where'] == 1) {
            if (array_key_exists('keyguest', $_REQUEST)
                    && ($_REQUEST['keyguest'] != $password)
                    && (userGID_REM($my->id) <= 0)) {
                mosRedirect("index.php?option=com_realestatemanager&Itemid=" .
                        $_REQUEST['Itemid'] . "&title=" . $_REQUEST['title'] . "&comment=" .
                        $_REQUEST['comment'] . "&err_msg=you typed bad characters from picture!");
                exit();
            }
        }

        if ($_REQUEST['where'] == 2) {
            //session_start();
            if (array_key_exists('keyguest', $_REQUEST)
                    && ($_REQUEST['keyguest'] != $password)
                    && (userGID_REM($my->id) <= 0)) {
                mosRedirect("index.php?option=com_realestatemanager&task=showCategory&catid=" . intval(
                                $_REQUEST['catid']) . "&Itemid=" . $Itemid . "&title=" . $_REQUEST['title'] . "&err_msg=you typed bad characters from picture!");
                exit();
            }
        }

        //insert data in database #__realestatemanager_suggestion
        $date = date("Y-m-d H:i:s");
        $title = $_REQUEST['title'];
        $comment = $_REQUEST['comment'];

        $user = new mosRealEstateManager_review($database);
        $user->getReviewFrom($my->id);

        $stroka = "INSERT INTO #__rem_suggestion (user_name, user_email, date, title, comment)" .
                "\n VALUES" .
                "\n ('" . $my->username . "','" . $my->email . "' , '" . $date . "', '" . $title . "', '" . $comment . "');";
        $database->setQuery($stroka);
        $database->query();
        echo $database->getErrorMsg();


        // Parameters
        if (version_compare(JVERSION, "3.0.0", "ge")) {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $params = new mosParameters($menu->params);
        }

        $menu_name = set_header_name_rem($menu, $Itemid);


        $params->def('header', $menu_name);
        $params->def('pageclass_sfx', '');
        //
        $params->def('show_search', '1');
        $params->def('back_button', $mainframe->getCfg('back_button'));

        $currentcat = new stdClass();
        $currentcat->descrip = _REALESTATE_MANAGER_LABEL_SUGGESTION_THANKS;

        // page image
        $currentcat->img = "./components/com_realestatemanager/images/rem_logo.png";
        //$currentcat->img = null;

        $currentcat->header = $params->get('header');

        //*******   begin add send mail for admin   ******************
        if (($realestatemanager_configuration['suggest_added_email']['show']) && trim($realestatemanager_configuration['suggest_email']['address']) != "") {
            $params->def('show_email', 1);
            if (checkAccess_REM($realestatemanager_configuration['suggest_added_email']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_email', 1);
            }
        }

        if ($params->get('show_input_email')) {
            $mail_to = explode(",", $realestatemanager_configuration['suggest_email']['address']);

            $username = (isset($my->name)) ? $my->name : "anonymous";
            $message = str_replace("{username}", $username, _REALESTATE_MANAGER_EMAIL_NOTIFICATION_SUGGESTION);
            $message = str_replace("{title}", $title, $message);
            $message = str_replace("{comment}", $comment, $message);

            mosMail($mosConfig_mailfrom, $username, $mail_to, 'New house suggestion added', $message, true);
        }

        //***********   end add send mail for admin**********
        HTML_realestatemanager :: showRentRequestThanks($params, $currentcat);
    }

    //*******************   end add for suggestion   ********************
    //this function check - is exist houses in this folder and folders under this category
    static function is_exist_curr_and_subcategory_houses($catid) {
        global $database, $my;

        $s = getWhereUsergroupsCondition("cc");

        $query = "SELECT *, COUNT(a.id) AS numlinks FROM #__rem_main_categories AS cc"
                . "\n  JOIN #__rem_categories AS hc ON hc.idcat = cc.id"
                . "\n  JOIN #__rem_houses AS a ON a.id = hc.iditem"
                . "\n WHERE a.published='1' AND a.approved='1' AND section='com_realestatemanager' AND cc.id='" . intval($catid) . "' AND cc.published='1' AND ($s) "
                . "\n GROUP BY cc.id"
                . "\n ORDER BY cc.ordering";
        $database->setQuery($query);

        $categories = $database->loadObjectList();
        if (count($categories) != 0)
            return true;

        $query = "SELECT id "
                . "FROM #__rem_main_categories AS cc "
                . " WHERE section='com_realestatemanager' AND parent_id='" . intval($catid) . "' AND published='1' AND ($s) ";
        $database->setQuery($query);
        $categories = $database->loadObjectList();

        if (count($categories) == 0)
            return false;

        foreach ($categories as $k) {
            if (is_exist_curr_and_subcategory_houses($k->id))
                return true;
        }
        return false;
    }

//end function
    //this function check - is exist folders under this category
    static function is_exist_subcategory_houses($catid) {
        global $database, $my;

        $s = getWhereUsergroupsCondition("cc");

        $query = "SELECT *, COUNT(a.id) AS numlinks FROM #__rem_main_categories AS cc"
                . "\n  JOIN #__rem_categories AS hc ON hc.idcat = cc.id"
                . "\n  JOIN #__rem_houses AS a ON a.id = hc.iditem"
                . "\n WHERE a.published='1' AND a.approved='1' AND section='com_realestatemanager' AND cc.parent_id='" . intval($catid) . "' AND cc.published='1' AND ($s) "
                . "\n GROUP BY cc.id"
                . "\n ORDER BY cc.ordering";

        $database->setQuery($query);

        $categories = $database->loadObjectList();
        if (count($categories) != 0)
            return true;

        $query = "SELECT id "
                . "FROM #__rem_main_categories AS cc "
                . " WHERE section='com_realestatemanager' AND parent_id='" . intval($catid) . "' AND published='1' AND ($s) ";
        $database->setQuery($query);
        $categories = $database->loadObjectList();

        if (count($categories) == 0)
            return false;

        foreach ($categories as $k) {
            if (is_exist_subcategory_houses($k->id))
                return true;
        }
        return false;
    }

//end function

    /**
     * This function is used to show a list of all houses
     */
    static function listCategories($catid, $layout, $languagelocale) {
        global $mainframe, $database, $my, $acl, $langContent;
        global $mosConfig_shownoauth, $mosConfig_live_site, $mosConfig_absolute_path;
        global $cur_template, $Itemid, $realestatemanager_configuration;

        PHP_realestatemanager::addTitleAndMetaTags();

        $s = getWhereUsergroupsCondition("c");



        if (isset($langContent)) {

            $lang = $langContent;
            $query = "SELECT lang_code FROM #__languages WHERE sef = '$lang'";
            $database->setQuery($query);
            $lang = $database->loadResult();
            $lang = " and ( h.language = '$lang' or h.language like 'all' or h.language like '' or h.language like '*' or h.language is null) "
                    . " AND ( c.language = '$lang' or c.language like 'all' or c.language like '' or c.language like '*' or c.language is null) ";
        } else {
            $lang = "";
        }

         $query = "SELECT h.*,c.id, c.parent_id, c.title, c.image,COUNT(hc.iditem) as houses, '1' as display" .
                "\n FROM  #__rem_main_categories as c " .
                "\n LEFT JOIN #__rem_categories AS hc ON hc.idcat=c.id " .
                "\n LEFT JOIN #__rem_houses AS h ON h.id=hc.iditem AND ( h.published || isnull(h.published) ) AND ( h.approved || isnull(h.approved ) )" .
                "\n WHERE c.section='com_realestatemanager' AND c.published=1 
                 \n  $lang AND ({$s})     
		\n GROUP BY c.id ORDER BY c.parent_id DESC, c.ordering";


        $database->setQuery($query);
        $cat_all = $database->loadObjectList();
// print_r($query);print_r($cat_all); exit;
        foreach ($cat_all as $k1 => $cat_item1) {
          $cat_all[$k1]->display = is_exist_curr_and_subcategory_houses($cat_all[$k1]->id);                   
        }

        $currentcat = new stdClass();

        // Parameters
        $menu = new JTableMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);
        $menu_name = set_header_name_rem($menu, $Itemid);

        $params->def('header', $menu_name);
        $params->def('pageclass_sfx', '');
        $params->def('show_search', '1');
        $params->def('back_button', $mainframe->getCfg('back_button'));

        // page header
        $currentcat->header = $params->get('header');

        //*****   begin add for Manager Suggestion: button 'Suggest a house'
        if ($realestatemanager_configuration['add_suggest']['show']) {
            $params->def('show_add_suggest', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_suggest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_add_suggest', 1);
            }
        }
        //*********   end add for Manager Suggestion: button 'Suggest a house'   **
        //*****   begin add for Manager Add house: button 'Add a house'
        if (($realestatemanager_configuration['add_house']['show'])) {
            $params->def('show_add_house', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_house']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_add_house', 1);
            }
        }
        //*********   end add for Manager Add house: button 'Add a house'   **
        //show_button_my_houses
        if ($my->email != null) {
            $params->def('show_button_my_houses', 1);
        }

        if (checkAccess_REM($realestatemanager_configuration['rss']['registrationlevel'], 'RECURSE', userGID_REM($my->id), $acl) &&
                $realestatemanager_configuration['rss']['show']) {
            $params->def('rss_show', 1);
        }

        if (checkAccess_REM($realestatemanager_configuration['ownerslist']['registrationlevel'], 'RECURSE', userGID_REM($my->id), $acl) &&
                $realestatemanager_configuration['ownerslist']['show']) {
            $params->def('ownerslist_show', 1);
        }

        //add for show in category picture
        if ($realestatemanager_configuration['cat_pic']['show'])
            $params->def('show_cat_pic', 1);

        // page description
        $currentcat->descrip = _REALESTATE_MANAGER_DESC;

        // used to show table rows in alternating colours
        $tabclass = array('sectiontableentry1', 'sectiontableentry2');

        $params->def('allcategories01', "{loadposition com_realestatemanager_all_categories_01,xhtml}");
        $params->def('allcategories02', "{loadposition com_realestatemanager_all_categories_02,xhtml}");
        $params->def('allcategories03', "{loadposition com_realestatemanager_all_categories_03,xhtml}");
        $params->def('allcategories04', "{loadposition com_realestatemanager_all_categories_04,xhtml}");
        $params->def('allcategories05', "{loadposition com_realestatemanager_all_categories_05,xhtml}");
        $params->def('allcategories06', "{loadposition com_realestatemanager_all_categories_06,xhtml}");
        $params->def('allcategories07', "{loadposition com_realestatemanager_all_categories_07,xhtml}");
        $params->def('allcategories08', "{loadposition com_realestatemanager_all_categories_08,xhtml}");
        $params->def('allcategories09', "{loadposition com_realestatemanager_all_categories_09,xhtml}");
        $params->def('allcategories10', "{loadposition com_realestatemanager_all_categories_10,xhtml}");

        $layout = $params->get('allcategorylayout','default');

        HTML_realestatemanager::showCategories($params, $cat_all, $catid, $tabclass, $currentcat, $layout);
    }

    static function constructPathway($cat) {
        global $mainframe, $database, $option, $Itemid, $mosConfig_absolute_path;

        $app = JFactory::getApplication();
        $path_way = $app->getPathway();

        $query = "SELECT * FROM #__rem_main_categories WHERE section = 'com_realestatemanager' AND published = 1";
        $database->setQuery($query);
        $rows = $database->loadObjectlist('id');
        if ($cat != NULL)
            $pid = $cat->id;  //need check
        $pathway = array();
        $pathway_name = array();
        while ($pid != 0) {
            $cat = @$rows[$pid];
            $pathway[] = sefRelToAbs('index.php?option=' . $option . '&task=showCategory&catid=' . @$cat->id . '&Itemid=' . $Itemid);
            $pathway_name[] = @$cat->title;
            $pid = @$cat->parent_id;
        }
        $pathway = array_reverse($pathway);
        $pathway_name = array_reverse($pathway_name);

        for ($i = 0, $n = count($pathway); $i < $n; $i++) {
            $path_way->addItem($pathway_name[$i], $pathway[$i]);
        }
    }

    //get current user groups
    static function getUserGroups() {
        $my = JFactory::getUser();
        $acl = JFactory::getACL();
        $usergroups = $acl->get_group_parents($my->gid, 'ARO', 'NORECURSE');
        if ($usergroups)
            $usergroups = ',' . implode(',', $usergroups); else
            $usergroups = '';
        return '-2,' . $my->gid . $usergroups;
    }

    static function showCategory($catid, $printItem, $option, $layout, $languagelocale) {
        global $mainframe, $database, $acl, $my, $langContent;
        global $mosConfig_shownoauth, $mosConfig_live_site, $mosConfig_absolute_path;
        global $cur_template, $Itemid, $realestatemanager_configuration;
        global $mosConfig_list_limit, $limit, $total, $limitstart;

        PHP_realestatemanager::addTitleAndMetaTags();
        //getting the current category informations
        $database->setQuery("SELECT * FROM #__rem_main_categories WHERE id='" . intval($catid) . "'");
        $category = $database->loadObjectList();
        if (isset($category[0]))
            $category = $category[0];
        else {
            echo _REALESTATE_MANAGER_ERROR_ACCESS_PAGE;
            return;
        }

        if ($category->params == '')
            $category->params = '-2';
        if (!checkAccess_REM($category->params, 'NORECURSE', userGID_REM($my->id), $acl)) {
            echo _REALESTATE_MANAGER_ERROR_ACCESS_PAGE;
            return;
        }
        //sorting

        $item_session = JFactory::getSession();
        $sort_arr = $item_session->get('rem_housesort', '');
        if (is_array($sort_arr)) {
            $tmp1 = mosGetParam($_POST, 'order_direction');
            //$tmp1= $database->Quote($tmp1);
            if ($tmp1 != '') {
                $sort_arr['order_direction'] = $tmp1;
            }
            $tmp1 = mosGetParam($_POST, 'order_field');
            //$tmp1= $database->Quote($tmp1);
            if ($tmp1 != '') {
                $sort_arr['order_field'] = $tmp1;
            }
            $item_session->set('rem_housesort', $sort_arr);
        } else {
            $sort_arr = array();
            $sort_arr['order_field'] = 'htitle';
            $sort_arr['order_direction'] = 'asc';
            $item_session->set('rem_housesort', $sort_arr);
        }
        if ($sort_arr['order_field'] == "price")
            $sort_string = "CAST( " . $sort_arr['order_field'] . " AS SIGNED)" . " " . $sort_arr['order_direction'];
        else
            $sort_string = $sort_arr['order_field'] . " " . $sort_arr['order_direction'];



        if (isset($langContent)) {

            $lang = $langContent;
            $query = "SELECT lang_code FROM #__languages WHERE sef = '$lang'";
            $database->setQuery($query);
            $lang = $database->loadResult();
            $lang = " and ( h.language = '$lang' or h.language like 'all' or h.language like '' or h.language like '*' or h.language is null) "
                    . " AND ( c.language = '$lang' or c.language like 'all' or c.language like '' or c.language like '*' or c.language is null) ";
        } else {
            $lang = "";
        }
        $s = getWhereUsergroupsCondition('c');



        $query = "SELECT COUNT(DISTINCT h.id)
            \nFROM #__rem_houses AS h"
                . "\nLEFT JOIN #__rem_categories AS hc ON hc.iditem=h.id"
                . "\nLEFT JOIN #__rem_main_categories AS c ON c.id=hc.idcat"
                . "\nWHERE c.id = '$catid' AND h.published='1' $lang AND h.approved='1' AND c.published='1'
             AND ($s)";


        //getting groups of user
        $s = getWhereUsergroupsCondition('c');

        $database->setQuery($query);
        $total = $database->loadResult();

        $pageNav = new JPagination($total, $limitstart, $limit); // for J 1.6
        // getting all houses for this category

        $query = "SELECT h.*,hc.idcat AS catid,hc.idcat AS idcat, c.title as category_title "
                . "\nFROM #__rem_houses AS h "
                . "\nLEFT JOIN #__rem_categories AS hc ON hc.iditem=h.id "
                . "\nLEFT JOIN #__rem_main_categories AS c ON c.id=hc.idcat "
                . "\nWHERE hc.idcat = '" . $catid . "' AND h.published='1' "
                . "\n    AND c.published='1'  $lang AND ($s)"
                . "\nGROUP BY h.id"
                . "\nORDER BY " . $sort_string
                . "\nLIMIT $pageNav->limitstart,$pageNav->limit;";


        $database->setQuery($query);
        $houses = $database->loadObjectList();

        $query = "SELECT h.*,c.id, c.parent_id, c.title, c.image,COUNT(hc.iditem) as houses,
		'1' as display" .
                " \n FROM  #__rem_main_categories as c " .
                " \n LEFT JOIN #__rem_categories AS hc ON hc.idcat=c.id " .
                " \n LEFT JOIN #__rem_houses AS h ON h.id=hc.iditem " .
                "  \n WHERE c.section='com_realestatemanager'  $lang "
                . " AND c.published=1 AND ({$s})
		\n GROUP BY c.id
		\n ORDER BY c.parent_id DESC, c.ordering ";

        $database->setQuery($query);
        $cat_all = $database->loadObjectList();
        
        foreach ($cat_all as $k1 => $cat_item1) {            
            $query = "SELECT COUNT(hc.iditem) as houses" .
                         "\n FROM  #__rem_main_categories as c " .
                         "\n LEFT JOIN #__rem_categories AS hc ON hc.idcat=c.id " .
                         "\n LEFT JOIN #__rem_houses AS h ON h.id=hc.iditem " .
                         "\n WHERE c.section='com_realestatemanager' AND c.published=1  $lang
                          \n AND ( h.published || isnull(h.published) ) AND ( h.approved || isnull(h.approved )) AND ({$s})
                          \n AND c.id = " . $cat_all[$k1]->id . "    
                          \n GROUP BY c.id";              
                
                    $database->setQuery($query);

                    $houses_count = $database->loadObjectList();
                    if($houses_count)
                        $cat_all[$k1]->houses = $houses_count[0]->houses;
                    else
                        $cat_all[$k1]->houses = 0;                    
        }
        ////////////////////////////////////////////////////////////

        $currentcat = new stdClass();

        // Parameters
        $menu = new JTableMenu($database); //for 1.6
        $menu->load($Itemid);

        $menu_name = set_header_name_rem($menu, $Itemid);

        $params = new mosParameters($menu->params);
        $params->def('show_category', 1);
        $params->def('header', $menu_name); // for 1.6
        $params->def('pageclass_sfx', '');
        $params->def('category_name', $category->title);
        $params->def('show_search', '1');

        PHP_realestatemanager::constructPathway($category);

        if ($realestatemanager_configuration['price']['show']) {
            $params->def('show_pricestatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['price']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_pricerequest', 1);
            }
        }

        //*********   begin add for Manager Suggestion: button 'Suggest a house'   ****
        if ($realestatemanager_configuration['add_suggest']['show']) {
            $params->def('show_add_suggest', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_suggest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_add_suggest', 1);
            }
        }
        //*********   end add for Manager Suggestion: button 'Suggest a house'   ***
        //*********   begin add for  Manager print pdf: button 'print PDF'    *******
        if (($realestatemanager_configuration['print_pdf']['show'])) {
            $params->def('show_print_pdf', 1);
            if (checkAccess_REM($realestatemanager_configuration['print_pdf']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_print_pdf', 1);
            }
        }
        //*************************   end add for  Manager print pdf: button 'print PDF'    ******************************
        //*************************   begin add for  Manager print view: button 'print VIEW'    ******************************
        if ($realestatemanager_configuration['print_view']['show']) {
            $params->def('show_print_view', 1);
            if (checkAccess_REM($realestatemanager_configuration['print_view']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_print_view', 1);
            }
        }
        //*************************   end add for  Manager print view: button 'print VIEW'    ******************************
        //*************************   begin add for  Manager mail to: button 'mail to'    ******************************
        if ($realestatemanager_configuration['mail_to']['show']) {
            $params->def('show_mail_to', 1);
            if (checkAccess_REM($realestatemanager_configuration['mail_to']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_mail_to', 1);
            }
        }
        //*************************   end add for  Manager mail to: button 'mail to'    ******************************
        //*****   begin add for Manager Add house: button 'Add a house'
        if ($realestatemanager_configuration['add_house']['show']) {
            $params->def('show_add_house', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_house']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_add_house', 1);
            }
        }
        //*********   end add for Manager Add house: button 'Add a house'   **

        $params->def('sort_arr_order_direction', $sort_arr['order_direction']);
        $params->def('sort_arr_order_field', $sort_arr['order_field']);

        //add for show in category picture
        if ($realestatemanager_configuration['cat_pic']['show'])
            $params->def('show_cat_pic', 1);

        $params->def('show_rating', 1);
        $params->def('hits', 1);
        $params->def('back_button', $mainframe->getCfg('back_button'));

        $currentcat->descrip = $category->description;

        // page image
        $currentcat->img = null;
        $path = $mosConfig_live_site . '/images/stories/';

        $currentcat->header = $params->get('header');
        $currentcat->header = ((trim($currentcat->header)) ? $currentcat->header . ":" : "") . $category->title;
        $currentcat->img = null;


        // used to show table rows in alternating colours
        $tabclass = array('sectiontableentry1', 'sectiontableentry2');

        $params->def('view_type', $realestatemanager_configuration['view_type']);
        $params->def('minifotohigh', $realestatemanager_configuration['foto']['high']);
        $params->def('minifotowidth', $realestatemanager_configuration['foto']['width']);

        foreach ($houses as $house) {
            if ($house->language != '*') {
                $query = "SELECT sef FROM #__languages WHERE lang_code = '$house->language'";
                $database->setQuery($query);
                $house->language = $database->loadResult();
            }
        }

        $params->def('singlecategory01', "{loadposition com_realestatemanager_single_category_01,xhtml}");
        $params->def('singlecategory02', "{loadposition com_realestatemanager_single_category_02,xhtml}");
        $params->def('singlecategory03', "{loadposition com_realestatemanager_single_category_03,xhtml}");
        $params->def('singlecategory04', "{loadposition com_realestatemanager_single_category_04,xhtml}");
        $params->def('singlecategory05', "{loadposition com_realestatemanager_single_category_05,xhtml}");
        $params->def('singlecategory06', "{loadposition com_realestatemanager_single_category_06,xhtml}");
        $params->def('singlecategory07', "{loadposition com_realestatemanager_single_category_07,xhtml}");
        $params->def('singlecategory08', "{loadposition com_realestatemanager_single_category_08,xhtml}");
        $params->def('singlecategory09', "{loadposition com_realestatemanager_single_category_09,xhtml}");
        $params->def('singlecategory10', "{loadposition com_realestatemanager_single_category_10,xhtml}");
        $params->def('singlecategory11', "{loadposition com_realestatemanager_single_category_11,xhtml}");

        if (empty($houses)) {
            HTML_realestatemanager::displayHouses_empty($houses, $currentcat, $params, $tabclass, $catid, $cat_all, PHP_realestatemanager::is_exist_subcategory_houses($catid), $pageNav, $option);
            //	HTML_realestatemanager::displayHouses_empty($houses, $currentcat, $params, $tabclass, $catid, $cat_all,PHP_realestatemanager::is_exist_subcategory_houses($catid),$pageNav);
        } else {
            switch ($printItem) {
                case 'pdf':
                    HTML_realestatemanager::displayHousesPdf($houses, $currentcat, $params, $tabclass, $catid, $cat_all, PHP_realestatemanager::is_exist_subcategory_houses($catid), $pageNav);
                    break;

                case 'print':
                    HTML_realestatemanager::displayHousesPrint($houses, $currentcat, $params, $tabclass, $catid, $cat_all, PHP_realestatemanager::is_exist_subcategory_houses($catid), $pageNav);
                    break;

                default:
                    HTML_realestatemanager::displayHouses($houses, $currentcat, $params, $tabclass, $catid, $cat_all, PHP_realestatemanager::is_exist_subcategory_houses($catid), $pageNav, $option, $layout);
                    break;
            }
        }
    }

    static function showItemREM($option, $id, $catid, $printItem, $layout) {
        global $mainframe, $database, $my, $acl, $option;
        global $mosConfig_shownoauth, $mosConfig_live_site, $mosConfig_absolute_path;
        global $cur_template, $Itemid, $realestatemanager_configuration;

        PHP_realestatemanager::addTitleAndMetaTags($id);

        $database->setQuery("SELECT id FROM #__rem_houses where id=$id ");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $trueid = $database->loadResultArray();
        else
            $trueid = $database->loadColumn();
        if (!in_array(intval($id), $trueid)) {
            echo _REALESTATE_MANAGER_ERROR_ACCESS_PAGE;
            return;
        }
        //add to path category name
        //getting the current category informations
        $query = "SELECT * FROM #__rem_main_categories WHERE id='" . intval($catid) . "'";

        $database->setQuery($query);
        $category = $database->loadObjectList();

        if (isset($category[0]))
            $category = $category[0];
        else {
            echo _REALESTATE_MANAGER_ERROR_ACCESS_PAGE;
            return;
        }
        PHP_realestatemanager::constructPathway($category);
        $pathway = sefRelToAbs('index.php?option=' . $option .
                '&task=showCategory&catid=' . $category->id . '&Itemid=' . $Itemid);

        //Record the hit
        $sql = "UPDATE #__rem_houses SET hits = hits + 1 WHERE id = " . $id . "";
        $database->setQuery($sql);
        $database->query();

        $sql2 = "UPDATE #__rem_houses SET featured_clicks = featured_clicks - 1 WHERE featured_clicks > 0 and id = " . $id . "";
        $database->setQuery($sql2);
        $database->query();


        $sql3 = "UPDATE #__rem_houses SET featured_shows = featured_shows - 1 WHERE featured_shows > 0 and id = " . $id . "";
        $database->setQuery($sql3);
        $database->query();

        //load the house
        $house = new mosRealEstateManager($database);
        $house->load($id);
        $house->setOwnerName();
        $access = $house->getAccess_REM();

        $selectstring = "SELECT a.* FROM #__rem_houses AS a";
        $database->setQuery($selectstring);
        $rows = $database->loadObjectList();
        $date = date(time());
        foreach ($rows as $row) {
            $check = strtotime($row->checked_out_time);
            $remain = 7200 - ($date - $check);
            if (($remain <= 0) && ($row->checked_out != 0)) {
                $database->setQuery("UPDATE #__rem_houses SET checked_out=0,checked_out_time=0");
                $database->query();
            }
        }

        if (!checkAccess_REM($access, 'RECURSE', userGID_REM($my->id), $acl)) {
            echo _REALESTATE_MANAGER_ERROR_ACCESS_PAGE;
            return;
        }
        if ($house->owneremail != $my->email) {
            if ($house->published == 0) {
                echo _REALESTATE_MANAGER_ERROR_HOUSE_NOT_PUBLISHED;
                return;
            }
            if ($house->approved == 0) {
                echo _REALESTATE_MANAGER_ERROR_HOUSE_NOT_APPROVED;
                return;
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////
        //Select list for listing type
        $listing_type[0] = _REALESTATE_MANAGER_OPTION_SELECT;
        $listing_type[1] = _REALESTATE_MANAGER_OPTION_FOR_RENT;
        $listing_type[2] = _REALESTATE_MANAGER_OPTION_FOR_SALE;

        //Select list for price type
        $price_type[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
        $price_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PRICE_TYPE);
        $i = 1;
        foreach ($price_type1 as $price_type2) {
            $price_type[$price_type2] = $i;
            $i++;
        }

        //Select list for listing status
        $listing_status[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
        $listing_status1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
        $i = 1;
        foreach ($listing_status1 as $listing_status2) {
            $listing_status[$listing_status2] = $i;
            $i++;
        }

        //Select list for property type
        $property_type[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
        $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
        $i = 1;
        foreach ($property_type1 as $property_type2) {
            $property_type[$property_type2] = $i;
            $i++;
        }

        //Select list for provider class
        $provider_class[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
        $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
        $i = 1;
        foreach ($provider_class1 as $provider_class2) {
            $provider_class[$provider_class2] = $i;
            $i++;
        }

        //Select list for zoning
        $zoning[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
        $zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_ZONING);
        $i = 1;
        foreach ($zoning1 as $zoning2) {
            $zoning[$zoning2] = $i;
            $i++;
        }

        //Select list for style
        $style[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
        $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
        $i = 1;
        foreach ($style1 as $style2) {
            $style[$style2] = $i;
            $i++;
        }

        ////////////////////////////////////////////////////////////
        //$app = JFactory::getApplication();
        //$menu1 = $app->getMenu();
        //if ( $menu1->getItem($Itemid) )
        //$menu_name = $menu1->getItem($Itemid)->title ;
        //else $menu_name = '';
        // --
        // Parameters
        $menu = new JTableMenu($database); // for 1.6
        // Parameters
        $menu = new mosMenu($database);
        $menu->load($Itemid);

        $menu_name = set_header_name_rem($menu, $Itemid);

        $params = new mosParameters($menu->params);
        $params->def('header', $menu_name); //for 1.6
        $params->def('pageclass_sfx', '');
        if (!isset($my->id)) { //for 1.6
            $my->id = 0;
        }

        //*******   begin add for  Manager print pdf: button 'print PDF'    ***********
        if ($realestatemanager_configuration['print_pdf']['show']) {
            $params->def('show_print_pdf', 1);
            if (checkAccess_REM($realestatemanager_configuration['print_pdf']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_print_pdf', 1);
            }
        }
        //****   end add for  Manager print pdf: button 'print PDF'    *************
        //****   begin add for  Manager print view: button 'print VIEW'   **********
        if ($realestatemanager_configuration['print_view']['show']) {
            $params->def('show_print_view', 1);
            if (checkAccess_REM($realestatemanager_configuration['print_view']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_print_view', 1);
            }
        }
        //****   end add for  Manager print view: button 'print VIEW'    ********
        //****   begin add for  Manager mail to: button 'mail to'    *************
        if ($realestatemanager_configuration['mail_to']['show']) {
            $params->def('show_mail_to', 1);
            if (checkAccess_REM($realestatemanager_configuration['mail_to']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_mail_to', 1);
            }
        }

        if ($realestatemanager_configuration['calendar']['show']) {
            $params->def('calendar_show', 1);
            if (checkAccess_REM($realestatemanager_configuration['calendarlist']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('calendarlist_show', 1);
            }
        }



        //***  end add for  Manager mail to: button 'mail to'    **********

        if ($realestatemanager_configuration['rentstatus']['show']) {
            $params->def('show_rentstatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['rentrequest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_rentrequest', 1);
            }
        }

        if ($realestatemanager_configuration['buystatus']['show']) {
            $params->def('show_buystatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['buyrequest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_buyrequest', 1);
            }
        }

        if ($realestatemanager_configuration['reviews']['show']) {
            $params->def('show_reviews', 1);
            if (checkAccess_REM($realestatemanager_configuration['reviews']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_inputreviews', 1);
            }
        }

        if ($realestatemanager_configuration['edocs']['show']) {
            $params->def('show_edocstatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['edocs']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_edocsrequest', 1); //+18.01
                //+18.01
            }
        }

        if ($realestatemanager_configuration['price']['show']) {
            $params->def('show_pricestatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['price']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_pricerequest', 1); //+18.01
            }
        }

        //************   begin show 'location and reviews tab'   ***************
        if (($realestatemanager_configuration['location_tab']['show'])) {
            $params->def('show_location', 1);
            if (checkAccess_REM($realestatemanager_configuration['location_tab']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_locationtab_registrationlevel', 1); //+18.01
            }
        }

        if (($realestatemanager_configuration['reviews_tab']['show'])) {
            $params->def('show_reviews_tab', 1);
            if (checkAccess_REM($realestatemanager_configuration['reviews_tab']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_reviewstab_registrationlevel', 1); //+18.01
            }
        }
        //************   end show 'location and reviews tab'   ***************
        //************   begin show 'contacts'   ***************************
        if (($realestatemanager_configuration['contacts']['show'])) {
            $params->def('show_contacts_line', 1);
            $i = checkAccess_REM($realestatemanager_configuration['contacts']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl);
            if ($i) {
                $params->def('show_contacts_registrationlevel', 1); //+18.01
            }
        }

        $params->def('pageclass_sfx', '');
        $params->def('item_description', 1);
        $params->def('show_edoc', $realestatemanager_configuration['edocs']['show']);
        $params->def('back_button', $mainframe->getCfg('back_button'));

        if ($realestatemanager_configuration['price']['show']) {
            $params->def('show_pricestatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['price']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_pricerequest', 1);
            }
        }
        // page header
        $currentcat = new stdClass();
        $currentcat->header = $params->get('header');
        $currentcat->header = ((trim($currentcat->header)) ? $currentcat->header . ":" : "") . $house->htitle;
        $currentcat->img = null;


        $query = "select main_img from #__rem_photos WHERE fk_houseid='$house->id' order by `order` asc";
        $database->setQuery($query);
        $house_photos = $database->loadObjectList();
        // show the house

        $query = "SELECT f.* ";
        $query .= "FROM #__rem_feature as f ";
        $query .= "LEFT JOIN #__rem_feature_houses as fv ON f.id = fv.fk_featureid ";
        $query .= "WHERE f.published = 1 and fv.fk_houseid = $id ";
        $query .= "ORDER BY f.categories";
        $database->setQuery($query);
        $house_feature = $database->loadObjectList();


        $currencys = explode(';', $realestatemanager_configuration['currency']);
        if ($currencys[count($currencys) - 1] == "")
            array_pop($currencys);
        $currencys1 = array();
        $currencys_price = array();
        $currencys_one = "";

        foreach ($currencys as $row) {
            $row = explode("=", $row);
            $currencys1[$row[0]] = $row[1];
        }

        foreach ($currencys1 as $key => $row) {
            if ($house->priceunit == $key)
                $currencys_one = $row;
        }

        if ($currencys_one != "") {
            foreach ($currencys1 as $key => $row) {
                $currencys_price[$key] = round($row / $currencys_one * $house->price, 2);
            }
        }
        
        $sql_query = "SELECT region FROM allure_regions WHERE regionid='".$house->hregion."'";
        $database->setQuery($sql_query);
        $region = $database->loadResult();
        $house->region = $region;
        
        $params->def('view01', "{loadposition com_realestatemanager_view_house_01,xhtml}");
        $params->def('view02', "{loadposition com_realestatemanager_view_house_02,xhtml}");
        $params->def('view03', "{loadposition com_realestatemanager_view_house_03,xhtml}");
        $params->def('viewdescription', "{loadposition com_realestatemanager_view_house_description,xhtml}");
        $params->def('view04', "{loadposition com_realestatemanager_view_house_04,xhtml}");
        $params->def('view05', "{loadposition com_realestatemanager_view_house_05,xhtml}");
        $params->def('view06', "{loadposition com_realestatemanager_view_house_06,xhtml}");
        $params->def('view07', "{loadposition com_realestatemanager_view_house_07,xhtml}");

        $query = "SELECT * FROM allure_rem_videos WHERE house_id=".$house->id;
        $database->setQuery($query);
        $videos = $database->loadObjectList();
        $house->videos = array_map(create_function('$o', 'return $o->link;'), $videos);

        $referer = explode('/',$_SERVER['HTTP_REFERER']);
        if(in_array('villas', $referer)){

            if(in_array('best_of', $referer) &&  $house->extra2 == 'true'){
                $_SESSION['referer'] = 'best_of';
            } else if(in_array('for_sale', $referer) && $house->extra1 == 'true'){
                $_SESSION['referer'] = 'for_sale';
            } else if(in_array('favorites', $referer) && in_array($house->id, $_SESSION['favorite_houses'])){
                $_SESSION['referer'] = 'favorites';
            } else if(in_array('search_villa', $referer)){
                $_SESSION['referer'] = 'search_villa';
            }
        } else {
            $_SESSION['referer'] = 'search_villa';
        }
        
        switch ($printItem) {
            case 'pdf': HTML_realestatemanager::displayHouseMainPdf($house, $tabclass, $params, $currentcat, $ratinglist, $house_photos);
                break;

            case 'print':
                $house->features = $house_feature;
                HTML_realestatemanager::displayHouseMainprint($house, $tabclass, $params, $currentcat, $ratinglist, $house_photos);
                break;

            default: HTML_realestatemanager::displayHouse($house, $tabclass, $params, $currentcat, $ratinglist, $house_photos, $id, $catid, $option, $house_feature, $currencys_price, $layout);
                break;
        }
    }

    static function getMonth($month) {

        switch ($month) {
            case 1:
                $smonth = JText::_('JANUARY');
                break;
            case 2:
                $smonth = JText::_('FEBRUARY');
                break;
            case 3:
                $smonth = JText::_('MARCH');
                break;
            case 4:
                $smonth = JText::_('APRIL');
                break;
            case 5:
                $smonth = JText::_('MAY');
                break;
            case 6:
                $smonth = JText::_('JUNE');
                break;
            case 7:
                $smonth = JText::_('JULY');
                break;
            case 8:
                $smonth = JText::_('AUGUST');
                break;
            case 9:
                $smonth = JText::_('SEPTEMBER');
                break;
            case 10:
                $smonth = JText::_('OCTOBER');
                break;
            case 11:
                $smonth = JText::_('NOVEMBER');
                break;
            case 12:
                $smonth = JText::_('DECEMBER');
                break;
        }

        return $smonth;
    }

    static function getMonthCal($month, $year, $id) {

        global $database, $realestatemanager_configuration;

        //$query = "SELECT rent_from, rent_until FROM #__rem_rent WHERE fk_houseid='$id'";
        $query = "SELECT rent_from, rent_until, rent_return FROM #__rem_rent WHERE fk_houseid='$id'";
        $database->setQuery($query);
        $calenDate = $database->loadObjectList();
        
        $skip = date("w", mktime(0, 0, 0, $month, 1, $year)) - 1;

        if ($skip < 0) {
            $skip = 6;
        }

        $daysInMonth = date("t", mktime(0, 0, 0, $month, 1, $year));

        //$rent = array();
/*******************************get only rent days*****************************/  

        
        $rentDataArr = array();
        foreach ($calenDate as &$value) {
            if(!($value->rent_return)){              
               array_push($rentDataArr, $value);
            }
        }
        $calenDate = $rentDataArr;
        
        
        
               
/******************************************************************************/ 
        
 /*       foreach ($calenDate as $key) {
            $rent_from = explode("-", $key->rent_from);
            $rent_until = explode("-", $key->rent_until);



            if (((int) $rent_from[0] == $year) && ((int) $rent_from[1] <= $month)) {
                if ((int) $rent_from[1] == (int) $rent_until[1] and $rent_from[1] == $month) {
                    for ($i = (int) $rent_from[2]; $i <= (int) $rent_until[2]; $i++) {
                        $rent[] = $i;
                    }
                } elseif ((int) $rent_from[1] == $month) {
                    for ($i = (int) $rent_from[2]; $i <= $daysInMonth; $i++) {
                        $rent[] = $i;
                    }
                } elseif ((int) $rent_until[1] == $month and $rent_until[0] == $year) {
                    for ($i = 1; $i <= (int) $rent_until[2]; $i++) {
                        $rent[] = $i;
                    }
                } elseif ((int) $rent_from[1] == (int) $rent_until[1]) {
                    
                } else {
                    for ($i = 1; $i <= $daysInMonth; $i++) {
                        $rent[] = $i;
                    }
                }
            } elseif
            (((int) $rent_from[0] < $year and (int) $rent_until[0] > $year)) {
                for ($i = 1; $i <= $daysInMonth; $i++) {
                    $rent[] = $i;
                }
            } elseif (((int) $rent_until[0] == $year) && ((int) $rent_until[1] >= $month) and $rent_until[0] != $rent_from[0]) {
                if ((int) $rent_from[1] == (int) $rent_until[1]) {
                    for ($i = (int) $rent_from[2]; $i <= (int) $rent_until[2]; $i++) {
                        $rent[] = $i;
                    }
                } else if ((int) $rent_from[1] == $month and $rent_from[0] == $year) {
                    for ($i = (int) $rent_from[2]; $i <= $daysInMonth; $i++) {
                        $rent[] = $i;
                    }
                } elseif ((int) $rent_until[1] == $month and $rent_until[0] == $year) {
                    for ($i = 1; $i <= (int) $rent_until[2]; $i++) {
                        $rent[] = $i;
                    }
                } else {
                    for ($i = 1; $i <= $daysInMonth; $i++) {
                        $rent[] = $i;
                    }
                }
            }
        }
*/
        
        $calendar = '';
        $day = 1;
        $smonth = PHP_realestatemanager::getMonth($month);

        $calendar = '<table class="tableC" style="border-collapse: separate; border-spacing: 2px;text-align:center"><tr class="year"><th colspan = "7">' . $smonth . ' ' . $year . '</th></tr><tr class="days"><th>' . JText::_('MON') . '</th><th>' . JText::_('TUE') . '</th><th>' . JText::_('WED') . '</th><th>' . JText::_('THU') . '</th><th>' . JText::_('FRI') . '</th><th>' . JText::_('SAT') . '</th><th>' . JText::_('SUN') . '</th></tr>';

        for ($i = 0; $i < 6; $i++) {
            $calendar .= '<tr>';
            for ($j = 0; $j < 7; $j++) {
                if (($skip > 0) or ($day > $daysInMonth)) {
                    $calendar .= '<td> &nbsp; </td>';
                    $skip--;
                } else {
                    $isAvilable = getAvilableREM($calenDate, $month, $year, $realestatemanager_configuration, $day);
                    $calendar .= '<td class="'.$isAvilable.'">' . $day . '</td>';                    
//                    if ($j == 0)
//                        if (in_array($day, $rent)) {
//                            $calendar .= '<td class="calendar_not_available">' . $day . '</td>';
//                        } else {
//                            $calendar .= '<td class="calendar_available">' . $day . '</td>';
//                        } else {
//                        if (in_array($day, $rent)) {
//                            $calendar .= '<td class="calendar_not_available">' . $day . '</td>';
//                        } else {
//                            $calendar .= '<td class="calendar_available">' . $day . '</td>';
//                        }
//                    }
                    $day++;
                }
            }
            $calendar .= '</tr>';
        }
        $calendar .= '</table>';

        return $calendar;
    }

    static function getCalendarPrice($month, $year, $id) {
        global $database;
        $query = "SELECT * FROM `#__rem_rent_sal` WHERE (`fk_houseid`='$id') and (`yearW`='$year') and (`monthW`='$month')";
        $database->setQuery($query);
        $calenWeeks = $database->loadObjectList();
        if (!empty($calenWeeks)) {
            $calenWeek = $calenWeeks[0];
            $calendar = "";
            $calendar = '<table style="text-align:left">';
            $calendar .= '<tr><td><b>' . _REALESTATE_MANAGER_LABEL_CALENDAR_WEEK . '<b></td></tr>';
            $calendar .= '<tr><td>' . str_replace("\n", "<br>\n", $calenWeek->week) . '</td></tr>';
            $calendar .= '<tr><td><b>' . _REALESTATE_MANAGER_LABEL_CALENDAR_WEEKEND . '<b></td></tr>';
            $calendar .= '<tr><td>' . str_replace("\n", "<br>\n", $calenWeek->weekend) . '</td></tr>';
            $calendar .= '<tr><td><b>' . _REALESTATE_MANAGER_LABEL_CALENDAR_MIDWEEK . '</b></td></tr>';
            $calendar .= '<tr><td><span>' . str_replace("\n", "<br>\n", $calenWeek->midweek) . '<span></td></tr>';
            $calendar .= '</table>';
            return $calendar;
        }
    }

    static function getCalendar($month, $year, $id) {

        $month = (int) $month;
        $year = (int) $year;

        if ($month == 1) {
            $month1 = 12;
            $year1 = $year - 1;
        } else {
            $month1 = $month - 1;
            $year1 = $year;
        }

        if ($month == 12) {
            $month2 = 1;
            $year2 = $year + 1;
        } else {
            $month2 = $month + 1;
            $year2 = $year;
        }


        $calendar = new stdClass();
        $calendar->tab1 = PHP_realestatemanager::getMonthCal($month1, $year1, $id);
        $calendar->tab2 = PHP_realestatemanager::getMonthCal($month, $year, $id);
        $calendar->tab3 = PHP_realestatemanager::getMonthCal($month2, $year2, $id);
        $calendar->tab21 = PHP_realestatemanager::getCalendarPrice($month1, $year1, $id);
        $calendar->tab22 = PHP_realestatemanager::getCalendarPrice($month, $year, $id);
        $calendar->tab23 = PHP_realestatemanager::getCalendarPrice($month2, $year2, $id);

        return $calendar;
    }

    static function showSearchHouses($options, $catid, $option, $layout = "", $task="") {
        global $mainframe, $database, $my;
        global $mosConfig_shownoauth, $mosConfig_live_site, $mosConfig_absolute_path, $realestatemanager_configuration;
        global $cur_template, $Itemid;

        PHP_realestatemanager::addTitleAndMetaTags();

        $currentcat = new stdClass();
        //if it is't from menus, get layout from config.
        if ($layout == '')
            $layout = $realestatemanager_configuration['show_search_house'];

        //parameters
        $menu = new mosMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);
        //$app = JFactory::getApplication();
        //$menu1 = $app->getMenu();
        //if ($menu1->getItem($Itemid))
        //$menu_name = $menu1->getItem($Itemid)->title;
        //else $menu_name = '';

        $menu_name = set_header_name_rem($menu, $Itemid);

        $params->def('header', $menu_name);
        $params->def('pageclass_sfx', '');
        $params->def('show_search', '1');
        $params->def('show_category', '1');
        $params->def('back_button', $mainframe->getCfg('back_button'));
        $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=show_search&amp;Itemid=' . $Itemid);
        $pathway_name = _REALESTATE_MANAGER_LABEL_SEARCH;

        $currentcat->descrip = " ";
        $currentcat->align = 'right';

        //page image
        $currentcat->img = "./components/com_realestatemanager/images/rem_logo.png";

        //used to show table rows in alternating colours
        $tabclass = array('sectiontableentry1', 'sectiontableentry2');

        //listing type
        $listing_type[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
        $listing_type[] = mosHtml::makeOption(1, _REALESTATE_MANAGER_OPTION_FOR_RENT);
        $listing_type[] = mosHtml::makeOption(2, _REALESTATE_MANAGER_OPTION_FOR_SALE);
        $listing_type_list = mosHTML :: selectList($listing_type, 'listing_type', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', _REALESTATE_MANAGER_LABEL_ALL);
        $params->def('listing_type_list', $listing_type_list);

        //price type
        $price_type[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
        $price_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PRICE_TYPE);
        $i = 1;
        foreach ($price_type1 as $price_type2) {
            $price_type[] = mosHtml::makeOption($i, $price_type2);
            $i++;
        }
        $price_type_list = mosHTML :: selectList($price_type, 'price_type', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', _REALESTATE_MANAGER_LABEL_ALL);
        $params->def('price_type_list', $price_type_list);

        //listing status
        $listing_status[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
        $listing_status1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
        $i = 1;
        foreach ($listing_status1 as $listing_status2) {
            $listing_status[] = mosHtml::makeOption($i, $listing_status2);
            $i++;
        }
        $listing_status_list = mosHTML :: selectList($listing_status, 'listing_status', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', _REALESTATE_MANAGER_LABEL_ALL);
        $params->def('listing_status_list', $listing_status_list);

        //property type
        $property_type[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
        $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
        $i = 1;
        foreach ($property_type1 as $property_type2) {
            $property_type[] = mosHtml::makeOption($i, $property_type2);
            $i++;
        }
        $property_type_list = mosHTML :: selectList($property_type, 'property_type', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', '');
        $params->def('property_type_list', $property_type_list);

        //provider class
        $provider_class[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
        $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
        $i = 1;
        foreach ($provider_class1 as $provider_class2) {
            $provider_class[] = mosHtml::makeOption($i, $provider_class2);
            $i++;
        }
        $provider_class_list = mosHTML :: selectList($provider_class, 'provider_class', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', '');
        $params->def('provider_class_list', $provider_class_list);

        //style
        $style[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
        $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
        $i = 1;
        foreach ($style1 as $style2) {
            $style[] = mosHtml::makeOption($i, $style2);
            $i++;
        }
        $style_list = mosHTML :: selectList($style, 'style', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', '');
        $params->def('style_list', $style_list);

        //zoning
        $zoning[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
        $zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
        $i = 1;
        foreach ($zoning1 as $zoning2) {
            $zoning[] = mosHtml::makeOption($i, $zoning2);
            $i++;
        }
        $zoning_list = mosHTML :: selectList($zoning, 'zoning', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', '');
        $params->def('zoning_list', $zoning_list);

        //extra6,extra7,extra8,extra9,extra10
        for ($i = 6; $i <= 10; $i++) {
            $extraOption = '';
            $extraOption[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
            $name = "_REALESTATE_MANAGER_EXTRA" . $i . "_SELECTLIST";
            $extra = explode(',', constant($name));
            $j = 1;
            foreach ($extra as $extr) {
                $extraOption[] = mosHTML::makeOption($j, $extr);
                $j++;
            }
            $extra_list[$i] = mosHTML :: selectList($extraOption, 'extra' . $i, 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', '');
            $params->def('extrafield' . $i, $extra_list[$i]);
        }
        // end for extra6,extra7,extra8,extra9,extra10


        $property_type_list = mosHTML :: selectList($property_type, 'property_type', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', '');
        $params->def('property_type_list', $property_type_list);

        //categories
        $categories[] = mosHTML :: makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
        $clist = PHP_realestatemanager::com_house_categoryTreeList(0, '', true, $categories);

        //year
        $year[] = mosHTML :: makeOption(_REALESTATE_MANAGER_LABEL_FROM, _REALESTATE_MANAGER_LABEL_FROM);
        $year_to[] = mosHTML :: makeOption(_REALESTATE_MANAGER_LABEL_TO, _REALESTATE_MANAGER_LABEL_TO);
        for ($i = date('Y'); $i >= 1900; $i--) {
            $year[] = mosHTML :: makeOption($i, $i);
            $year_to[] = mosHTML :: makeOption($i, $i);
        }
        $yearlist = mosHTML :: selectList($year, 'yearfrom', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text');
        $params->def('yearlist', $yearlist);
        $yearlistto = mosHTML :: selectList($year_to, 'yearto', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text');
        $params->def('yearlistto', $yearlistto);

        //price
        $db = JFactory::getDBO();
        $query = "SELECT price  FROM   #__rem_houses ";
        $database->setQuery($query);
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $prices = $database->loadResultArray();
        else
            $prices = $database->loadColumn();

        rsort($prices, SORT_NUMERIC);
        $max_price = $prices[0];
        $price[] = mosHTML :: makeOption(_REALESTATE_MANAGER_LABEL_FROM, _REALESTATE_MANAGER_LABEL_FROM);
        $price_to[] = mosHTML :: makeOption(_REALESTATE_MANAGER_LABEL_TO, _REALESTATE_MANAGER_LABEL_TO);
        
        $stepPrice = $max_price / 50;
        $stepPrice = (string) $stepPrice;
        $stepCount = strlen($stepPrice);
        if ($stepCount > 2) {
            $stepFinalPrice = $stepPrice[0] . $stepPrice[1];
            for ($i = 2; $i < $stepCount; $i++) {
                $stepFinalPrice .= '0';
            }
            $stepFinalPrice = (int) $stepFinalPrice;
        }
        else
            $stepFinalPrice = (int) $stepPrice;

        if($max_price == 0 || $stepFinalPrice == 0){
            $price[] = mosHTML :: makeOption(0, 0);
            $price_to[] = mosHTML :: makeOption(0, 0);
        }
        for ($i = 0; $i < $max_price; $i = $i + $stepFinalPrice) {
            $price[] = mosHTML :: makeOption($i, $i);
            $price_to[] = mosHTML :: makeOption($i, $i);
        }
        
        $pricelist = mosHTML :: selectList($price, 'pricefrom', 'class="inputbox" size="1"', 'value', 'text');
        $params->def('pricefrom', $pricelist);
        $pricelistto = mosHTML :: selectList($price_to, 'priceto', 'class="inputbox" size="1"', 'value', 'text');
        $params->def('priceto', $pricelistto);

        $params->def('showsearch01', "{loadposition com_realestatemanager_show_search_01,xhtml}");
        $params->def('showsearch02', "{loadposition com_realestatemanager_show_search_02,xhtml}");
        $params->def('showsearch03', "{loadposition com_realestatemanager_show_search_03,xhtml}");
        $params->def('showsearch04', "{loadposition com_realestatemanager_show_search_04,xhtml}");
        $params->def('showsearch05', "{loadposition com_realestatemanager_show_search_05,xhtml}");
        
        HTML_realestatemanager::showSearchHouses($params, $currentcat, $clist, $option, $layout, $task);
    }
    
    static function searchHouses($options, $catid, $option, $languagelocale, $ownername = '') {
        global $mainframe, $database, $my, $acl, $limitstart, $limit, $langContent;
        global $mosConfig_shownoauth, $mosConfig_live_site, $mosConfig_absolute_path;
        global $cur_template, $Itemid, $realestatemanager_configuration;

        PHP_realestatemanager::addTitleAndMetaTags();

        $ownernameTMP = $ownername;

        //get current user groups
        $s = getWhereUsergroupsCondition("c");
        $session = JFactory::getSession();
        if ($ownername == '') {
            $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=show_search&amp;Itemid=' . $Itemid);
            $pathway_name = _REALESTATE_MANAGER_LABEL_SEARCH;
        }

        if (array_key_exists("searchtext", $_REQUEST)) {
            $search = mosGetParam($_REQUEST, 'searchtext', '');
            $search = addslashes($search);
            $session->set("poisk", $search);
        }

        $poisk_search = $session->get("poisk", "");

        $where = array();
        $Houseid = " ";
        $Description = " ";
        $Title = " ";
        $Address = " ";
        $Country = " ";
        $Region = " ";
        $City = " ";
        $District = " ";
        $Zipcode = " ";
        $Extra1 = " ";
        $Extra2 = " ";
        $Extra3 = " ";
        $Extra4 = " ";
        $Extra5 = " ";
        $Extra6 = " ";
        $Extra7 = " ";
        $Extra8 = " ";
        $Extra9 = " ";
        $Extra10 = " ";
        $Bathrooms = " ";
        $Bedrooms = " ";
        $Broker = " ";
        $Contacts = " ";
        $Agent = " ";
        $Area = " ";
        $Feature = " ";
        $HOA_dues = " ";
        $Lot_size = " ";
        $Model = " ";
        $School = " ";
        $School_district = " ";
        $Rent = " ";
        $RentSQL = " ";
        $RentSQL_JOIN_1 = " ";
        $RentSQL_JOIN_2 = " ";
        $RentSQL_rent_until = " ";

        if (isset($_REQUEST['exactly']) && $_REQUEST['exactly'] == "on") {
            $exactly = $poisk_search;
        } else {
            $exactly = "%$poisk_search%";
        }

        if (isset($_REQUEST['yearfrom']) && (intval($_REQUEST['yearfrom']) > 1900) && (intval($_REQUEST['yearto']) > 1900) && isset($_REQUEST['yearto'])) {
            $year = " (b.year BETWEEN " . intval($_REQUEST['yearfrom']) . " and " . intval($_REQUEST['yearto']) . ") ";
        } elseif (isset($_REQUEST['yearfrom']) && (intval($_REQUEST['yearfrom']) > 1900)) {
            $year = " b.year >= " . intval($_REQUEST['yearfrom']) . " ";
        } elseif (isset($_REQUEST['yearto']) && (intval($_REQUEST['yearto']) > 1900)) {
            $year = " b.year <= " . intval($_REQUEST['yearto']) . " ";
        }

        //sorting
        $item_session = JFactory::getSession();
        //$sort_arr = $item_session->get('rem_housesort', '');
        if($_POST['order_field'] != ''){
            $sort_arr = explode("-", $_POST['order_field']);
            $aux = $sort_arr;
            $sort_arr = array();
        //}
        //if (is_array($sort_arr)) {
            //$tmp1 = mosGetParam($_POST, 'order_direction');
            //$tmp1= $database->Quote($tmp1);
            //if ($tmp1 != '')
            //    $sort_arr['order_direction'] = $tmp1;
            //$tmp1 = mosGetParam($_POST, 'order_field');
            //$tmp1= $database->Quote($tmp1);
            //if ($tmp1 != '')
            //    $sort_arr['order_field'] = $tmp1;
            //$item_session->set('rem_housesort', $sort_arr);
            switch($aux[0]){
                case 'people':
                    $sort_arr['order_field'] = 'broker';
                    break;
                case 'price':
                    $sort_arr['order_field'] = 'price_low_season';
                    break;
                case 'htitle':
                    $sort_arr['order_field'] = 'htitle';
                    break;
            }
            $sort_arr['order_direction'] = $aux[1];
        } else {
            $sort_arr = array();
            $sort_arr['order_field'] = 'htitle';
            $sort_arr['order_direction'] = 'asc';
            $item_session->set('rem_housesort', $sort_arr);
        }
        if ($sort_arr['order_field'] == "price")
            $sort_string = "CAST( " . $sort_arr['order_field'] . " AS SIGNED)" . " " . $sort_arr['order_direction'];
        else
            $sort_string = $sort_arr['order_field'] . " " . $sort_arr['order_direction'];  //end sortering

        $is_add_or = false;
        $add_or_value = "  ";
        if ($poisk_search != '') {
            if (isset($_REQUEST['Houseid']) && $_REQUEST['Houseid'] == "on") {
                $Houseid = " ";
                if ($is_add_or)
                    $Houseid = " or ";
                $is_add_or = true;
                $Houseid .= "LOWER(b.houseid) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Description']) && $_REQUEST['Description'] == "on") {
                $Description = " ";
                if ($is_add_or)
                    $Description = " or ";
                $is_add_or = true;
                $Description .=" LOWER(b.description) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Title']) && $_REQUEST['Title'] == "on") {
                $Title = " ";
                if ($is_add_or)
                    $Title = " or ";
                $is_add_or = true;
                $Title .=" LOWER(b.htitle) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Address']) && $_REQUEST['Address'] == "on") {
                $Address = " ";
                if ($is_add_or)
                    $Address = " or ";
                $is_add_or = true;
                $Address .=" LOWER(b.hlocation) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Country']) && $_REQUEST['Country'] == "on") {
                $Country = " ";
                if ($is_add_or)
                    $Country = " or ";
                $is_add_or = true;
                $Country .= "LOWER(b.hcountry) LIKE '$exactly' ";
            }
            /*if (isset($_REQUEST['Region']) && $_REQUEST['Region'] == "on") {
                $Region = " ";
                if ($is_add_or)
                    $Region = " or ";
                $is_add_or = true;
                $Region .= "LOWER(b.hregion) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['City']) && $_REQUEST['City'] == "on") {
                $City = " ";
                if ($is_add_or)
                    $City = " or ";
                $is_add_or = true;
                $City .= "LOWER(b.hcity) LIKE '$exactly' ";
            }*/
            if (isset($_REQUEST['District']) && $_REQUEST['District'] == "on") {
                $District = " ";
                if ($is_add_or)
                    $District = " or ";
                $is_add_or = true;
                $District .= "LOWER(b.hdistrict) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Zipcode']) && $_REQUEST['Zipcode'] == "on") {
                $Zipcode = " ";
                if ($is_add_or)
                    $Zipcode = " or ";
                $is_add_or = true;
                $Zipcode .= "LOWER(b.hzipcode) LIKE '$exactly' ";
            }
            /*if (isset($_REQUEST['extra1']) && $_REQUEST['extra1'] == "on") {
                $Extra1 = " ";
                if ($is_add_or)
                    $Extra1 = " or ";
                $is_add_or = true;
                $Extra1 .= "LOWER(b.extra1) LIKE '$exactly' ";
            }*/
            /*if (isset($_REQUEST['extra2']) && $_REQUEST['extra2'] == "on") {
                $Extra2 = " ";
                if ($is_add_or)
                    $Extra2 = " or ";
                $is_add_or = true;
                $Extra2 .= "LOWER(b.extra2) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['extra3']) && $_REQUEST['extra3'] == "on") {
                $Extra3 = " ";
                if ($is_add_or)
                    $Extra3 = " or ";
                $is_add_or = true;
                $Extra3 .= "LOWER(b.extra3) LIKE '$exactly' ";
            }*/
            if (isset($_REQUEST['extra4']) && $_REQUEST['extra4'] == "on") {
                $Extra4 = " ";
                if ($is_add_or)
                    $Extra4 = " or ";
                $is_add_or = true;
                $Extra4 .= "LOWER(b.extra4) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['extra5']) && $_REQUEST['extra5'] == "on") {
                $Extra5 = " ";
                if ($is_add_or)
                    $Extra5 = " or ";
                $is_add_or = true;
                $Extra5 .= "LOWER(b.extra5) LIKE '$exactly' ";
            }
            /*if (isset($_REQUEST['Bathrooms']) && $_REQUEST['Bathrooms'] == "on") {
                $Bathrooms = " ";
                if ($is_add_or)
                    $Bathrooms = " or ";
                $is_add_or = true;
                $Bathrooms .= "LOWER(b.bathrooms) LIKE '$exactly' ";
            }*/
            /*if (isset($_REQUEST['Bedrooms']) && $_REQUEST['Bedrooms'] == "on") {
                $Bedrooms = " ";
                if ($is_add_or)
                    $Bedrooms = " or ";
                $is_add_or = true;
                $Bedrooms .= "LOWER(b.bedrooms) LIKE '$exactly' ";
            }*/
            /*if (isset($_REQUEST['Broker']) && $_REQUEST['Broker'] == "on") {
                $Broker = " ";
                if ($is_add_or)
                    $Broker = " or ";
                $is_add_or = true;
                $Broker .=" LOWER(b.broker) LIKE '$exactly' ";
            }*/
            if (isset($_REQUEST['Contacts']) && $_REQUEST['Contacts'] == "on") {
                $Contacts = " ";
                if ($is_add_or)
                    $Contacts = " or ";
                $is_add_or = true;
                $Contacts .=" LOWER(b.contacts) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Agent']) && $_REQUEST['Agent'] == "on") {
                $Agent = " ";
                if ($is_add_or)
                    $Agent = " or ";
                $is_add_or = true;
                $Agent .=" LOWER(b.agent) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Area']) && $_REQUEST['Area'] == "on") {
                $Area = " ";
                if ($is_add_or)
                    $Area = " or ";
                $is_add_or = true;
                $Area .=" LOWER(b.area) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Feature']) && $_REQUEST['Feature'] = "on") {
                $Feature = " ";
                if ($is_add_or)
                    $Feature = " or ";
                $is_add_or = true;
                $Feature .=" LOWER(b.feature) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['HOA_dues']) && $_REQUEST['HOA_dues'] = "on") {
                $HOA_dues = " ";
                if ($is_add_or)
                    $HOA_dues = " or ";
                $is_add_or = true;
                $HOA_dues .=" LOWER(b.hoa_dues) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Lot_size']) && $_REQUEST['Lot_size'] = "on") {
                $Lot_size = " ";
                if ($is_add_or)
                    $Lot_size = " or ";
                $is_add_or = true;
                $Lot_size .=" LOWER(b.lot_size) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['Model']) && $_REQUEST['Model'] == "on") {
                $Model = " ";
                if ($is_add_or)
                    $Model = " or ";
                $is_add_or = true;
                $Model .=" LOWER(b.model) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['School']) && $_REQUEST['School'] == "on") {
                $School = " ";
                if ($is_add_or)
                    $School = " or ";
                $is_add_or = true;
                $School .=" LOWER(b.school) LIKE '$exactly' ";
            }
            if (isset($_REQUEST['School_district']) && $_REQUEST['School_district'] == "on") {
                $School_district = " ";
                if ($is_add_or)
                    $School_district = " or ";
                $is_add_or = true;
                $School_district .=" LOWER(b.school_district) LIKE '$exactly' ";
            }
        }

        $listing_type = mosGetParam($_REQUEST, 'listing_type', '');
        $price_type = mosGetParam($_REQUEST, 'price_type', '');
        $listing_status = mosGetParam($_REQUEST, 'listing_status', '');
        $property_type = mosGetParam($_REQUEST, 'property_type', '');
        $provider_class = mosGetParam($_REQUEST, 'provider_class', '');
        $style = mosGetParam($_REQUEST, 'style', '');
        $zoning = mosGetParam($_REQUEST, 'zoning', '');
        $extra6 = mosGetParam($_REQUEST, 'extra6', '');
        $extra7 = mosGetParam($_REQUEST, 'extra7', '');
        $extra8 = mosGetParam($_REQUEST, 'extra8', '');
        $extra9 = mosGetParam($_REQUEST, 'extra9', '');
        $extra10 = mosGetParam($_REQUEST, 'extra10', '');
        //print_r($_REQUEST);exit;
        if ($listing_type != _REALESTATE_MANAGER_LABEL_ALL && $listing_type != '') {
            $where[] = " LOWER(b.listing_type)='$listing_type'";
        }
        if ($price_type != _REALESTATE_MANAGER_LABEL_ALL && $price_type != '') {
            $where[] = " LOWER(b.price_type)='$price_type'";
        }
        if ($listing_status != _REALESTATE_MANAGER_LABEL_ALL && $listing_status != '') {
            $where[] = " LOWER(b.listing_status)='$listing_status'";
        }
        if ($property_type != _REALESTATE_MANAGER_LABEL_ALL && $property_type != '') {
            $where[] = " LOWER(b.property_type)='$property_type'";
        }
        if ($provider_class != _REALESTATE_MANAGER_LABEL_ALL && $provider_class != '') {
            $where[] = " LOWER(b.provider_class)='$provider_class'";
        }
        if ($style != _REALESTATE_MANAGER_LABEL_ALL && $style != '') {
            $where[] = " LOWER(b.style)='$style'";
        }
        if ($zoning != _REALESTATE_MANAGER_LABEL_ALL && $zoning != '') {
            $where[] = " LOWER(b.zoning)='$zoning'";
        }
        if ($extra6 != _REALESTATE_MANAGER_LABEL_ALL && $extra6 != '') {
            $where[] = " LOWER(b.extra6)='$extra6'";
        }
        if ($extra7 != _REALESTATE_MANAGER_LABEL_ALL && $extra7 != '') {
            $where[] = " LOWER(b.extra7)='$extra7'";
        }
        if ($extra8 != _REALESTATE_MANAGER_LABEL_ALL && $extra8 != '') {
            $where[] = " LOWER(b.extra8)='$extra8'";
        }
        if ($extra9 != _REALESTATE_MANAGER_LABEL_ALL && $extra9 != '') {
            $where[] = " LOWER(b.extra9)='$extra9'";
        }
        if ($extra10 != _REALESTATE_MANAGER_LABEL_ALL && $extra10 != '') {
            $where[] = " LOWER(b.extra10)='$extra10'";
        }
        
        //Adicionado a 03-01-2015
        //Condi��o para escolher regia�o
        if(isset($_REQUEST['Region']) && $_REQUEST['Region'] != "" && $_REQUEST['Region'] != "all"){
            $where[] = " b.hregion = '" . $_REQUEST['Region'] . "'";
            //print_r( $_REQUEST);
        }
        
        //Adicionado a 25-02-2015
        //Condi��o para escolher City
        if(isset($_REQUEST['City']) && $_REQUEST['City'] != ""){
            $where[] = " b.hcity like '%" . $_REQUEST['City'] . "%'";
            //print_r( $_REQUEST);
        }
        
        //Adicionado a 02-01-2015 CMS
        //Condi��o para numero de pessoas, casas de banho e quartos
        //echo "------------->" . $_REQUEST['Broker'];
        // Editado a 31-02-2016 VMT
        // preço
        if(isset($_REQUEST['Broker']) && $_REQUEST['Broker'] != ''){
            $where[] = " b.broker >= ".$_REQUEST['Broker'];
        }
        if(isset($_REQUEST['Bathrooms']) && $_REQUEST['Bathrooms'] != ''){
            $where[] = " b.bathrooms >= ".$_REQUEST['Bathrooms'];
        }
        if(isset($_REQUEST['Bedrooms']) && $_REQUEST['Bedrooms'] != ''){
            $where[] = " b.bedrooms >= ".$_REQUEST['Bedrooms'];
        } 
        if(isset($_REQUEST['Price']) && $_REQUEST['Price'] != ''){
        	$where[] = " b.price_high_season <= ".$_REQUEST['Price'];
        }
        //Condica��o para filtrar por features
        if(isset($_REQUEST['house_feature']) && count($_REQUEST['house_feature']) > 0){
            $selected_features = $_REQUEST['house_feature'];//implode($_REQUEST['house_feature'], ",");
            $query = "SELECT fk_houseid, fk_featureid FROM allure_rem_feature_houses ORDER BY fk_houseid ASC";
            $database->setQuery($query);
            $all_features = $database->loadObjectList();
            $house_features = array();
            $j=-1;
            for($i=0; $i<count($all_features); $i++){
                if($i==0 || $all_features[$i-1]->fk_houseid != $all_features[$i]->fk_houseid){
                    $j++;
                    $house_features[$j]=array("house" => $all_features[$i]->fk_houseid, "features" => array());
                }
                array_push($house_features[$j]["features"], $all_features[$i]->fk_featureid);
            }
            
            $valid_houses = array();
            //echo "<teste1>";
            foreach($house_features as $hf){
                $containsSearch = count(array_intersect($selected_features, $hf['features'])) == count($selected_features);
                //echo "------> " . $containsSearch . " - " . $hf['house'] . "<br><br>";
                if($containsSearch>0){
                    array_push($valid_houses, $hf['house']);
                }
            }
            //print_r($valid_houses);
            
            //print_r($valid_houses);
            //echo "</teste1>";
            //$house_ids = array_map(create_function('$o', 'return $o->fk_houseid;'), $houses);
            
            //echo "<teste1>".print_r($valid_houses)."</teste1>";
            if(count($valid_houses)==0){
                $house_ids = "''";
            }else{
                $house_ids = implode($valid_houses, ",");
            }
            //echo "<house_ids>".$house_ids."</house_ids>";
            $where[] = " b.id IN ($house_ids)";
        }
        
        //Altera��coes em 24-01-2015
        //Permitir pesquisar por "best of" e por "for sale"
        if(isset($_REQUEST['extra1']) && $_REQUEST['extra1'] =="on"){
            $where[] = " b.extra1='true'";
        }
        if(isset($_REQUEST['extra2']) && $_REQUEST['extra2'] =="on"){
            $where[] = " b.extra2='true'";
        }
        //Adicionado em 14-04-2015
        //Permite pesquisar por "favorites"
        if(isset($_REQUEST['favorites']) && $_REQUEST['favorites'] == 'on'){
            $favorites = implode($_SESSION['favorite_houses'], ",");
            //echo $favorites;
            $where[] = " b.id IN ($favorites)";
        }
        
        //Condica��o para filtrar por datas de chegada e partida consoante disponibilidade
        if( (isset($_REQUEST['Arrival']) && $_REQUEST['Arrival'] != "") || (isset($_REQUEST['Departure']) && $_REQUEST['Departure'] != "")){
            $user_id = '0129';
            $flexible = 0;
            $arrival_date = $_REQUEST['Arrival'];
            $departure_date = $_REQUEST['Departure'];
            //echo $arrival_date . " - " . $departure_date;
            $pims_request = 'http://www.holidayrentalmanagement.com/userpropertysearch/search_properties_result.php'
                                    .'?uid='. $user_id .'&start_date='. $arrival_date .'&end_date='. $departure_date
                                    .'&iamflexible='. $flexible .'&displaywhere=remote';
            $pims_response = file_get_contents($pims_request);
            $doc = new DOMDocument;
            $doc->loadHTML($pims_response);
            $xpath = new DOMXPath($doc);
            $query = "//div[@id='search_result_wrapper']";
            $entries = $xpath->query($query);
            //echo $entries->item(0)->textContent;
            $pims_availability = explode(" ", trim(rtrim($entries->item(0)->textContent)));
            for($i=0; $i<count($pims_availability); $i++){
                $pims_availability[$i] = "'".$pims_availability[$i]."'";
            }
            $pims_ids = implode(",",$pims_availability);
            //echo $pims_ids;
            $where[] = " b.houseid IN ($pims_ids)";
        }
        
       $siteLanguage = $_SESSION['__default']['lang'];
        
        //Adicionado a 6-01-2015 CMS
        //filtra cidade e titulo
        //Alteracao em 10-10-2015 CMS
        //filtra tambem por regiao introduzida na caixa de texto
        if(isset($search) && $search!=''){
            $cond = " (b.hcity LIKE '%$search%' OR b.htitle LIKE '%$search%'";
            if($siteLanguage == 'fr-FR')
                $rq = "SELECT regionid FROM #__regions WHERE region_fr LIKE '%$search%'";
            else
                $rq = "SELECT regionid FROM #__regions WHERE region LIKE '%$search%'";
            $database->setQuery($rq);
            $r = $database->loadObjectList();
            $read_regions = array();
            foreach($r as $item)
                array_push($read_regions, "'".$item->regionid."'");
            $list_of_regions = implode(",", $read_regions);
            if($list_of_regions!=null && $list_of_regions!="")
                $cond .= " OR b.hregion IN ($list_of_regions)";
            $cond .= ")";
            $where[] = $cond;
        }
        
        $pricefrom = intval(mosGetParam($_REQUEST, 'pricefrom', ''));
        $priceto = intval(mosGetParam($_REQUEST, 'priceto', ''));
        if ($pricefrom > 0)
            $where[] = " CAST( b.price AS SIGNED) >= $pricefrom ";
        if ($priceto > 0)
            $where[] = " CAST( b.price AS SIGNED) <= $priceto ";

        if (isset($_REQUEST['ownername']) && $_REQUEST['ownername'] == "on")
            $ownername = "$exactly";

        if ($ownername != '' && $ownername != '%%') {
            $query = "SELECT u.email FROM #__users AS u WHERE LOWER(u.id) LIKE '$ownername' OR LOWER(u.name) LIKE '$ownername';";
            $database->setQuery($query);
            if (version_compare(JVERSION, "3.0.0", "lt"))
                $owneremails = $database->loadResultArray();
            else
                $owneremails = $database->loadColumn();
            //print_r($owneremails); exit;
            $ownername = "";
            if (count($owneremails)) {
                foreach ($owneremails as $owneremail) {
                    if (isset($_REQUEST['ownername']) && $_REQUEST['ownername'] == "on") {
                        //search from frontend
                        if ($is_add_or)
                            $ownername .= " or ";
                        $is_add_or = true;
                        $ownername .= "b.owneremail='$owneremail'";
                    } else {
                        //show owner houses
                        $where[] = "b.owneremail='$owneremail'";
                    }
                }
            } else if (!$is_add_or) {
                echo"<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . _REALESTATE_MANAGER_LABEL_SEARCH_NOTHING_FOUND . "</h1>";
                return;
            }
        }

        /*$search_date_from = mosGetParam($_REQUEST, 'search_date_from', '');
        $search_date_from = addslashes($search_date_from);
        $search_date_until = mosGetParam($_REQUEST, 'search_date_until', '');
        $search_date_until = addslashes($search_date_until);

        if (isset($_REQUEST['search_date_from']) && (trim($_REQUEST['search_date_from']) ) && trim($_REQUEST['search_date_until']) == "") {
            $RentSQL = "((fk_rentid = 0 OR b.id NOT IN (select dd.fk_houseid from #__rem_rent AS dd
			where dd.rent_until >= '" . $search_date_from . "' and dd.rent_from <= '" . $search_date_from . "' and dd.fk_houseid=b.id)) AND (listing_type = \"1\"))";
            if ($is_add_or)
                $RentSQL .= " AND ";
            $RentSQL_JOIN_1 = "\nLEFT JOIN #__rem_rent AS d ";
            $RentSQL_JOIN_2 = "\nON d.fk_houseid=b.id ";
        }
        if (isset($_REQUEST['search_date_until']) && (trim($_REQUEST['search_date_until']) ) && trim($_REQUEST['search_date_from']) == "") {
            $RentSQL = "((fk_rentid = 0 OR b.id NOT IN (select dd.fk_houseid from #__rem_rent AS dd
			where dd.rent_from <= '" . $search_date_until . "' and dd.rent_until >= '" . $search_date_until . "' and dd.fk_houseid=b.id)) AND (listing_type = \"1\"))";
            if ($is_add_or)
                $RentSQL .= " AND ";
            $RentSQL_JOIN_1 = "\nLEFT JOIN #__rem_rent AS d ";
            $RentSQL_JOIN_2 = "\nON d.fk_houseid=b.id ";
        }
        if (isset($_REQUEST['search_date_until']) && (trim($_REQUEST['search_date_until']))
                && isset($_REQUEST['search_date_from']) && ( trim($_REQUEST['search_date_from']))) {
            $RentSQL = "((fk_rentid = 0 OR b.id NOT IN (select dd.fk_houseid from #__rem_rent AS dd
			where (dd.rent_until >= '" . $search_date_from . "' and dd.rent_from <= '" . $search_date_from . "') or " .
                    " (dd.rent_from <= '" . $search_date_until . "' and dd.rent_until >= '" . $search_date_until . "' ) or " .
                    " (dd.rent_from >= '" . $search_date_from . "' and dd.rent_until <= '" . $search_date_until . "')))" .
                    " AND (listing_type = \"1\"))";
            if ($is_add_or)
                $RentSQL .= " AND ";
            $RentSQL_JOIN_1 = "\nLEFT JOIN #__rem_rent AS d ";
            $RentSQL_JOIN_2 = "\nON d.fk_houseid=b.id ";
        }
        */
        $RentSQL = $RentSQL . (($is_add_or) ? ( "( ( " . $Houseid . "  " . $Description . "  " . $Title . "  " . $Address .
                        "  " . $Country . "  " . $Region . "  " . $City . "  " . $District . "  " . $Zipcode . "  " . $Extra1 .
                        "  " . $Extra2 . "  " . $Extra3 . "  " . $Extra4 . "  " . $Extra5 . "  " . $Bathrooms . "  " . $Bedrooms . "  " . $Broker .
                        "  " . $Contacts . "  " . $Agent . "  " . $Area . "  " . $Feature . "  " . $HOA_dues . "  " . $Lot_size .
                        "  " . $Model . "  " . $School . "  " . $School_district . "  ))") : (" "));

        if (trim($RentSQL) != "")
            array_push($where, $RentSQL);
        if (isset($year))
            array_push($where, $year);

        //select category, to which user has access
        $where[] = " ($s) ";
        $where[] = " c.published = '1' ";

        //select published and approved houses
        array_push($where, " b.published = '1' ");
        array_push($where, " b.approved = '1' ");

        if ($catid)
            array_push($where, "c.id=" . intval($catid) . "");


        if (isset($langContent)) {

            $lang = $langContent;
            $query = "SELECT lang_code FROM #__languages WHERE sef = '$lang'";
            $database->setQuery($query);
            $lang = $database->loadResult();
            $where[] = " ( b.language = '$lang' or b.language like 'all' or b.language like '' or b.language like '*' or b.language is null) ";
            $where[] = "  ( c.language = '$lang' or c.language like 'all' or c.language like '' or c.language like '*' or c.language is null) ";
        }

        $query = "SELECT COUNT(DISTINCT b.id)
		FROM #__rem_houses AS b
		LEFT JOIN #__rem_categories AS hc ON b.id=hc.iditem
		LEFT JOIN #__rem_main_categories AS c ON hc.idcat = c.id " .
                $RentSQL_JOIN_1 . $RentSQL_JOIN_2 .
                ((count($where) ? "\n WHERE " . implode(' AND ', $where) : ""));
        
        //echo $query ."<br><br>";
        
        $database->setQuery($query);
        $total = $database->loadResult();
        //echo $total . " - " . $limitstart . " - " . $limit;
        $pageNav = new JPagination($total, $limitstart, $limit); // for J 1.6
        //print_r($pageNav);
        //echo $total;
        
        /*print_r($_SERVER);
        if(stripos($_SERVER[HTTP_REFERER], 'search_villa') ){
            $where = [];
            $pageNav->limit = 1;
        }*/
        
        // getting all houses for this category
        $query = "SELECT distinct hc.idcat as idcat, b . * , r.region AS region, c.title AS category_titel, c.ordering AS category_ordering, c.id as catid
		FROM #__rem_houses AS b
		LEFT JOIN #__rem_categories AS hc ON b.id=hc.iditem
                LEFT JOIN allure_regions AS r ON r.regionid = b.hregion
		LEFT JOIN #__rem_main_categories AS c ON hc.idcat = c.id " .
                $RentSQL_JOIN_1 . $RentSQL_JOIN_2 .
                ((count($where) ? "\n WHERE " . implode(' AND ', $where) : "")) .
                " GROUP BY b.id ORDER BY $sort_string
		\nLIMIT " . $pageNav->limitstart . "," . $pageNav->limit;
        //echo $query."------>";
        $database->setQuery($query);
        
        $houses = $database->loadObjectList();

        //Cria nova query sem limite de numero de casas para as mostrar a todas no mapa 
        $query2 = preg_replace("/LIMIT [0-9]+,[0-9]+/", "", $query);
        $database->setQuery($query2);
        //print_r($query2);
        $map_houses = $database->loadObjectList();

        $currentcat = new stdClass();
        //print_r($houses);
        //parameters
        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($Itemid);
            $params = new mosParameters($menu->params);
        }
        //$app = JFactory::getApplication();
        //$menu1 = $app->getMenu();

        $menu_name = set_header_name_rem($menu, $Itemid);
        //if ($menu1->getItem($Itemid)) $menu_name = $menu1->getItem($Itemid)->title ;
        //else $menu_name = '';

        $params->def('header', $menu_name);
        $params->def('pageclass_sfx', '');
        $params->def('category_name', _REALESTATE_MANAGER_LABEL_SEARCH);
        $params->def('search_request', '1');
        $params->def('hits', 1);
        $params->def('show_rating', 1);

        $params->def('sort_arr_order_direction', $sort_arr['order_direction']);
        $params->def('sort_arr_order_field', $sort_arr['order_field']);

        $database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_realestatemanager'");
        if ($database->loadResult() != $Itemid)
            $params->def('wrongitemid', '1');

        if ($realestatemanager_configuration['rentstatus']['show']) {
            $params->def('show_rentstatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['rentrequest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_rentrequest', 1);
            }
        }
        if ($realestatemanager_configuration['buystatus']['show']) {
            $params->def('show_buystatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['buyrequest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_buyrequest', 1);
            }
        }
        //*******   begin add for Manager Suggestion: button 'Suggest a house' *******
        if ($realestatemanager_configuration['add_suggest']['show']) {
            $params->def('show_add_suggest', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_suggest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_add_suggest', 1);
            }
        }
        //****   end add for Manager Suggestion: button 'Suggest a house'   *****
        //*****   begin add for Manager Add house: button 'Add a house'
        if ($realestatemanager_configuration['add_house']['show']) {
            $params->def('show_add_house', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_house']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_add_house', 1);
            }
        }
        //*********   end add for Manager Add house: button 'Add a house'   **
        //add for show in category picture
        if ($realestatemanager_configuration['cat_pic']['show'])
            $params->def('show_cat_pic', 1);
        $params->def('back_button', $mainframe->getCfg('back_button'));
        $currentcat->descrip = " ";
        $currentcat->align = 'right';

        //page image
        //$currentcat->img = "./components/com_realestatemanager/images/rem_logo.png";
        $currentcat->img = null;

        //$currentcat->header = $params->get( 'header' );
        //$currentcat->header = $currentcat->header .":". _REALESTATE_MANAGER_LABEL_SEARCH;
        //used to show table rows in alternating colours
        $tabclass = array('sectiontableentry1', 'sectiontableentry2');

        $params->def('singleuser01', "{loadposition com_realestatemanager_single_user_house_01,xhtml}");
        $params->def('singleuser02', "{loadposition com_realestatemanager_single_user_house_02,xhtml}");
        $params->def('singleuser03', "{loadposition com_realestatemanager_single_user_house_03,xhtml}");
        $params->def('singleuser04', "{loadposition com_realestatemanager_single_user_house_04,xhtml}");
        $params->def('singleuser05', "{loadposition com_realestatemanager_single_user_house_05,xhtml}");

        $layout = $realestatemanager_configuration['view_type'];
        
        
        //if (count($houses)) {
            
            /*  if ($option != "com_realestatemanager")
              PHP_realestatemanager::showTabs();
             */
            HTML_realestatemanager::displayHouses($houses, $currentcat, $params, $tabclass, $catid, null, false, $pageNav, $option, $layout, $map_houses);
        /*} else {
            if ($option != "com_realestatemanager") {
                if (isset($_REQUEST['userId'])) {
                    if ($my->id == $_REQUEST['userId']) {
                        PHP_realestatemanager::showTabs();
                    }
                } else {
                    PHP_realestatemanager::showTabs();
                }
            }
            print_r("<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . _REALESTATE_MANAGER_LABEL_SEARCH_NOTHING_FOUND . " </h1><br><br> ");
        }*/
    }

    /**
     * Compiles information to add or edit houses
     * @param integer bid The unique id of the record to edit (0 if new)
     * @param array option the current options
     */
    static function editHouse($option, $bid) {
        global $database, $my, $mosConfig_live_site, $realestatemanager_configuration, $Itemid, $acl, $mainframe;

        PHP_realestatemanager::addTitleAndMetaTags();

        $house = new mosRealEstateManager($database);

        // load the row from the db table
        $house->load(intval($bid));
        $houseTMP = $house;

        if ($bid != 0 && $my->id != $house->owner_id) {
            mosRedirect("index.php?option=$option");
            exit;
        }
        if ($bid == 0) {
            if (!$realestatemanager_configuration['add_house']['show'] || !checkAccess_REM($realestatemanager_configuration['add_house']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                mosRedirect('index.php?option=com_realestatemanager&Itemid=' . $Itemid);
            }

            $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=show_add&amp;Itemid=' . $Itemid);
            $pathway_name = _REALESTATE_MANAGER_LABEL_TITLE_ADD_HOUSE;
        } else {
            $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=edit_house&amp;Itemid=' . $Itemid . '&amp;id=' . $bid);
            $pathway_name = _REALESTATE_MANAGER_LABEL_TITLE_EDIT_HOUSE;
        }

        $numeric_houseids = array();
        if (empty($house->houseid) && $realestatemanager_configuration['houseid']['auto-increment']['boolean'] == 1) {
            $database->setQuery("select houseid from #__rem_houses order by houseid");
            $houseids = $database->loadObjectList();
            foreach ($houseids as $houseid) {
                if (!is_numeric($houseid->houseid)) {
                    echo "<script> alert('You have no numeric houseId. Please set option" . _REALESTATE_MANAGER_ADMIN_CONFIG_HOUSEID_AUTO_INCREMENT . " to \'No\' or change all houseID to numeric '); window.history.go(-1); </script>\n";
                    exit();
                }
                $numeric_houseids[] = intval($houseid->houseid);
            }
            if (count($numeric_houseids) > 0) {
                sort($numeric_houseids);
                for ($freeid = 1; in_array($freeid, $numeric_houseids); $freeid++) {
                    
                };
                $house->houseid = $freeid;
            } else
                $house->houseid = 1;
        }

        $categories = array();
        PHP_realestatemanager::com_house_categoryTreeList(0, '', true, $categories);
        if (count($categories) <= 1)
            mosRedirect("index.php?option=$option&section=categories", _REALESTATE_MANAGER_ADMIN_IMPEXP_ADD);
        if (trim($house->id) != "")
            $house->setCatIds();
        $maxsize = 5;
        if (count($categories) > 6)
            $maxsize = 6;
        $clist = mosHTML :: selectList($categories, 'catid[]', 'class="inputbox" size="' . $maxsize . '" multiple', 'value', 'text', ($house->catid));

        //get Rating
        $retVal2 = mosRealEstateManagerOthers :: getRatingArray();
        $rating = null;
        for ($i = 0, $n = count($retVal2); $i < $n; $i++) {
            $help = $retVal2[$i];
            $rating[] = mosHTML :: makeOption($help[0], $help[1]);
        }

        //delete ehouse?
        $help = str_replace($mosConfig_live_site, "", $house->edok_link);
        $delete_ehouse_yesno[] = mosHTML :: makeOption($help, _REALESTATE_MANAGER_YES);
        $delete_ehouse_yesno[] = mosHTML :: makeOption('0', _REALESTATE_MANAGER_NO);
        $delete_edoc = mosHTML :: RadioList($delete_ehouse_yesno, 'delete_edoc', 'class="inputbox"', '0', 'value', 'text');

        // fail if checked out not by 'me'
        if ($house->checked_out && $house->checked_out <> $my->id)
            mosRedirect("index2.php?option=$option", _REALESTATE_MANAGER_IS_EDITED);

        if ($bid) {
            $house->checkout($my->id);
        } else {
            // initialise new record
            $house->published = 0;
            $house->approved = 0;
        }

        //Select list for listing type
        $listing_type[] = mosHtml::makeOption(0, _REALESTATE_MANAGER_OPTION_SELECT);
        $listing_type[] = mosHtml::makeOption(1, _REALESTATE_MANAGER_OPTION_FOR_RENT);
        $listing_type[] = mosHtml::makeOption(2, _REALESTATE_MANAGER_OPTION_FOR_SALE);
        $listing_type_list = mosHTML :: selectList($listing_type, 'listing_type', 'class="inputbox" size="1"', 'value', 'text', $house->listing_type);

        //Select list for price type
        $price_type[] = mosHtml::makeOption(0, _REALESTATE_MANAGER_OPTION_SELECT);
        $price_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PRICE_TYPE);
        $i = 1;
        foreach ($price_type1 as $price_type2) {
            $price_type[] = mosHtml::makeOption($i, $price_type2);
            $i++;
        }
        $price_type_list = mosHTML :: selectList($price_type, 'price_type', 'class="inputbox" size="1"', 'value', 'text', $house->price_type);

        //Select list for listing status
        $listing_status[] = mosHtml::makeOption(0, _REALESTATE_MANAGER_OPTION_SELECT);
        $listing_status1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
        $i = 1;
        foreach ($listing_status1 as $listing_status2) {
            $listing_status[] = mosHtml::makeOption($i, $listing_status2);
            $i++;
        }
        $listing_status_list = mosHTML :: selectList($listing_status, 'listing_status', 'class="inputbox" size="1"', 'value', 'text', $house->listing_status);

        //Select list for property type
        $property_type[] = mosHtml::makeOption(0, _REALESTATE_MANAGER_OPTION_SELECT);
        $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
        $i = 1;
        foreach ($property_type1 as $property_type2) {
            $property_type[] = mosHtml::makeOption($i, $property_type2);
            $i++;
        }
        $property_type_list = mosHTML :: selectList($property_type, 'property_type', 'class="inputbox" size="1"', 'value', 'text', $house->property_type);

        //Select list for provider class
        $provider_class[] = mosHtml::makeOption(0, _REALESTATE_MANAGER_OPTION_SELECT);
        $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
        $i = 1;
        foreach ($provider_class1 as $provider_class2) {
            $provider_class[] = mosHtml::makeOption($i, $provider_class2);
            $i++;
        }
        $provider_class_list = mosHTML :: selectList($provider_class, 'provider_class', 'class="inputbox" size="1"', 'value', 'text', $house->provider_class);

        //Select list for zoning
        $zoning[] = mosHtml::makeOption(0, _REALESTATE_MANAGER_OPTION_SELECT);
        $zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_ZONING);
        $i = 1;
        foreach ($zoning1 as $zoning2) {
            $zoning[] = mosHtml::makeOption($i, $zoning2);
            $i++;
        }
        $zoning_list = mosHTML :: selectList($zoning, 'zoning', 'class="inputbox" size="1"', 'value', 'text', $house->zoning);

        //Select list for style
        $style[] = mosHtml::makeOption(0, _REALESTATE_MANAGER_OPTION_SELECT);
        $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
        $i = 1;
        foreach ($style1 as $style2) {
            $style[] = mosHtml::makeOption($i, $style2);
            $i++;
        }
        $style_list = mosHTML :: selectList($style, 'style', 'class="inputbox" size="1"', 'value', 'text', $house->style);

        if (trim($house->id) != "") {
            $query = "select * from #__rem_rent_sal WHERE fk_houseid='$house->id' order by `yearW`, `monthW`";
            $database->setQuery($query);
            $house_rent_sal = $database->loadObjectList();
        }

        if (trim($house->id) != "") {
            $query = "select main_img from #__rem_photos WHERE fk_houseid='$house->id' order by id";
            $database->setQuery($query);
            $house_temp_photos = $database->loadObjectList();

            foreach ($house_temp_photos as $house_temp_photo) {
                $house_photos[] = array($house_temp_photo->main_img, PHP_realestatemanager::picture_thumbnail($house_temp_photo->main_img, $realestatemanager_configuration['foto']['high'], $realestatemanager_configuration['foto']['width']));
            }

            $query = "select image_link from #__rem_houses WHERE id='$house->id'";
            $database->setQuery($query);
            $house_photo = $database->loadResult();

            if ($house_photo != '')
                $house_photo = array($house_photo, PHP_realestatemanager::picture_thumbnail($house_photo, $realestatemanager_configuration['foto']['high'], $realestatemanager_configuration['foto']['width']));
        }
        if (trim($house->id) != "") {
            $query = "select * from #__rem_rent_sal WHERE fk_houseid='$house->id' order by `yearW`, `monthW`";
            $database->setQuery($query);
            $house_rent_sal = $database->loadObjectList();
        }

        $query = "SELECT * ";
        $query .= "FROM #__rem_feature as f ";
        $query .= "WHERE f.published = 1 ";
        $query .= "ORDER BY f.categories";
        $database->setQuery($query);
        $house_feature = $database->loadObjectList();

        for ($i = 0; $i < count($house_feature); $i++) {
            $feature = "";
            if (!empty($house->id)) {
                $query = "SELECT COUNT(id) ";
                $query .= "FROM #__rem_feature_houses ";
                $query .= "WHERE fk_featureid =" . $house_feature[$i]->id . " AND fk_houseid =" . $house->id;
                $database->setQuery($query);
                $feature = $database->loadResult();
                if ($feature == 1)
                    $house_feature[$i]->check = 1; else
                    $house_feature[$i]->check = 0;
            } else {
                $house_feature[$i]->check = 0;
            }
        }

        $currencys = explode(';', $realestatemanager_configuration['currency']);
        foreach ($currencys as $row) {
            if ($row != '') {
                $row = explode("=", $row);
                $currency[] = mosHTML::makeOption($row[0], $row[0]);
            }
        }
        $currency = mosHTML :: selectList($currency, 'priceunit', 'class="inputbox" size="1"', 'value', 'text', $house->priceunit);

        $query = "SELECT lang_code, title FROM #__languages";
        $database->setQuery($query);
        $languages = $database->loadObjectList();

        $languages_row[] = mosHTML::makeOption('*', 'All');
        foreach ($languages as $language) {
            $languages_row[] = mosHTML::makeOption($language->lang_code, $language->title);
        }
        $languages = mosHTML :: selectList($languages_row, 'language', 'class="inputbox" size="1"', 'value', 'text', $house->language);

        for ($i = 6; $i <= 10; $i++) {
            $name = "_REALESTATE_MANAGER_EXTRA" . $i . "_SELECTLIST";
            $extra = explode(',', constant($name));
            $extraOption = '';
            foreach ($extra as $key =>$extr) {
                $extraOption[] = mosHTML::makeOption($key+1, $extr);
            }

            switch ($i) {
                case 6:
                    $extraSelect = $house->extra6;
                    break;
                case 7:
                    $extraSelect = $house->extra7;
                    break;
                case 8:
                    $extraSelect = $house->extra8;
                    break;
                case 9:
                    $extraSelect = $house->extra9;
                    break;
                case 10:
                    $extraSelect = $house->extra10;
                    break;
            }
            $extra_list[] = mosHTML :: selectList($extraOption, 'extra' . $i, 'class="inputbox" size="1"', 'value', 'text', $extraSelect);
        }

        if ($my->email == $houseTMP->owneremail)
            PHP_realestatemanager::showTabs();
        HTML_realestatemanager :: editHouse($option, $house, $clist, $ratinglist, $delete_edoc, $price_type_list, $listing_status_list, $property_type_list, $listing_type_list, $provider_class_list, $zoning_list, $style_list, $house_photo, $house_photos, $house_rent_sal, $house_feature, $currency, $languages, $extra_list);
    }
    
    
static function ajax_rent_calcualete($bid,$rent_from,$rent_until){ 
    
    
    global $realestatemanager_configuration;
    
    $database = JFactory::getDBO();    
    
    $resulArr = calculatePriceREM ($bid,$rent_from,$rent_until,$realestatemanager_configuration,$database);
    
    echo $resulArr[0].' '.$resulArr[1].' Comments: '.$resulArr[2];
    exit; 
   }
   
   
    static function guid() {
        
        
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = //chr(123)// "{"
                    substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12);
            //.chr(125);// "}"
            return $uuid;
        }
    }

    /**
     * Saves the record on an edit form submit
     * @param database A database connector object
     */
    static function picture_thumbnail($file, $high_original, $width_original) {
        global $mosConfig_absolute_path;
        $mosConfig_absolute_path = JPATH_SITE;
        //разделение имени файла на им�? и ра�?ширение
        /*
          print_r($file);
          print_r("<BR>");
          print_r($high_original);
          print_r("<BR>");
          print_r($width_original); exit(); */
        $file_inf = pathinfo($file);
        $file_type = '.' . $file_inf['extension'];
        $file_name = basename($file, $file_type);

        // Setting the resize parameters
        if (file_exists($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file))
            ;
        //list($width, $height) = getimagesize($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file);
        if(isset($file)){
        	list($width, $height) = getimagesize($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file);
}
        $size = "_" . $high_original . "_" . $width_original;

        if (file_exists($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file_name . $size . $file_type)) {
            return $file_name . $size . $file_type;
        } else {
            if ($width < $height) {
                if ($height > $high_original) {
                    $k = $height / $high_original;
                } else if ($width > $width_original) {
                    $k = $width / $width_original;
                }
                else
                    $k = 1;
            } else {
                if ($width > $width_original) {
                    $k = $width / $width_original;
                } else if ($height > $high_original) {
                    $k = $height / $high_original;
                }
                else
                    $k = 1;
            }
            $w_ = $width / $k;
            $h_ = $height / $k;
        }

        // Creating the Canvas VMT 06-02-2016
        if( $w_ > 0 && $h_ > 0){
        sleep(5);
        	$tn = imagecreatetruecolor($w_, $h_);
        
        //print_r($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file_name . $size . $file_type);
        switch (strtolower($file_type)) {
            case '.png':
                $source = imagecreatefrompng($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file);
                $file = imagecopyresampled($tn, $source, 0, 0, 0, 0, $w_, $h_, $width, $height);
                imagepng($tn, $mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file_name . $size . $file_type);
                break;
            case '.jpg':
                $source = imagecreatefromjpeg($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file);
                $file = imagecopyresampled($tn, $source, 0, 0, 0, 0, $w_, $h_, $width, $height);
                imagejpeg($tn, $mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file_name . $size . $file_type);
                break;
            case '.jpeg':
                $source = imagecreatefromjpeg($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file);
                $file = imagecopyresampled($tn, $source, 0, 0, 0, 0, $w_, $h_, $width, $height);
                imagejpeg($tn, $mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file_name . $size . $file_type);

                break;
            case '.gif':
                $source = imagecreatefromgif($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file);
                $file = imagecopyresampled($tn, $source, 0, 0, 0, 0, $w_, $h_, $width, $height);
                imagegif($tn, $mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $file_name . $size . $file_type);
                break;
            default:
                //echo 'not support';
                return;
        }
        }

        return $file_name . $size . $file_type;
    }

    static function saveHouse($option, $id) {
        global $database, $menu, $Itemid, $mainframe, $my, $mosConfig_absolute_path,
        $mosConfig_live_site, $realestatemanager_configuration, $params, $catid,
        $currentcat, $acl;
        global $mosConfig_mailfrom, $session;

        ///////////////
        if (!$realestatemanager_configuration['add_house']['show']
                || !checkAccess_REM($realestatemanager_configuration['add_house']['registrationlevel'], 'RECURSE', userGID_REM($my->id), $acl)) {
            mosRedirect('index.php?option=com_realestatemanager&Itemid=' . $Itemid);
            exit;
        }

        //check how the other info should be provided
        $house = new mosRealEstateManager($database);
        $post = JRequest::get('post', JREQUEST_ALLOWHTML);
        if (!$house->bind($post)) {
            echo "<script> alert('" . $house->getError() . "'); window.history.go(-1); </script>\n";
            exit();
        }
        $house->expiration_date = date('Y-m-d', strtotime($house->expiration_date));

        if ((strlen($house->owneremail) > 0) && ($house->owner_id == 0))
            $house->owner_id = $my->id;

        if ($id != 0 && $my->email != $house->owneremail) {
            mosRedirect('index.php?option=$option&Itemid=' . $Itemid);
            exit;
        }


        // $house->save();
        //save of the main image


        if (isset($_POST['yearW']) || isset($_POST['monthW'])) {
            $id = $_POST['id'];
            $monthW = $_POST['monthW'];
            $yearW = $_POST['yearW'];
            $week = $_POST['week'];
            $midweek = $_POST['midweek'];
            $weekend = $_POST['weekend'];
            for ($i = 0; $i < count($_POST['yearW']); $i++) {
                //if (($week[$i]!='') and ($weekend[$i]!='') and ($midweek[$i]!='')) {
                $database->setQuery("INSERT INTO #__rem_rent_sal (fk_houseid, monthW, yearW, week, weekend, midweek) VALUES (" . $id . ", " . $monthW[$i] . ", " . $yearW[$i] . ", '" . $week[$i] . "', '" . $weekend[$i] . "', '" . $midweek[$i] . "')");
                $database->query();
                //}
            }
        } //end if

        if ($_POST['edok_link'] != '')
            $house->edok_link = mosGetParam($_REQUEST, 'edok_link', '');

        //delete ehouse file if neccesary
        $delete_edoc = mosGetParam($_POST, 'delete_edoc', 0);
        if ($delete_edoc != '0') {
            $retVal = @unlink($mosConfig_absolute_path . $delete_edoc);
            $house->edok_link = "";
        }

        //storing e-house
        $edfile = $_FILES['edoc_file'];
        $uid = md5(uniqid(rand(), 1));
        $edfile['name'] = $uid . $edfile['name'];
        $newpath = JPATH_COMPONENT . '/edocs/' . $edfile['name'];

        //check if fileupload is correct
        if ($realestatemanager_configuration['edocs']['allow']
                && intval($edfile['error']) > 0 && intval($edfile['error']) < 4) {
            echo "<script> alert('" . _REALESTATE_MANAGER_LABEL_EDOCUMENT_UPLOAD_ERROR . "'); window.history.go(-1); </script>\n";
            exit();
        } else if ($realestatemanager_configuration['edocs']['allow'] && intval($edfile['error']) != 4) {
            $uploaddir = $mosConfig_absolute_path .
                    $realestatemanager_configuration['edocs']['location'];
            $file_new = $uploaddir . $uid . $_FILES['edoc_file']['name'];
            ///
            $ext = pathinfo($_FILES['edoc_file']['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            $allowed_exts = explode(",", $realestatemanager_configuration['allowed_exts']);
            foreach ($allowed_exts as $key => $allowed_ext) {
                $allowed_exts[$key] = strtolower($allowed_ext);
            }
            if (!in_array($ext, $allowed_exts)) {
                echo "<script> alert(' File ext. not allowed to upload! - " . $_FILES['edoc_file']['name'] . "'); window.history.go(-1); </script>\n";
                exit();
            }
            $file['type'] = $_FILES['edoc_file']['type'];
            $db = JFactory::getDbo();
            $db->setQuery("SELECT mime_type FROM #__rem_mime_types WHERE `mime_ext` = " . $db->quote($ext) . " and mime_type = " . $db->quote($file['type']));
            $file_db_mime = $db->loadResult();
            if ($file_db_mime != $file['type']) {
                echo "<script> alert(' File mime type not match file ext. - " . $_FILES['edoc_file']['name'] . "'); window.history.go(-1); </script>\n";
                exit();
            }
            ////
            if (!copy($edfile['tmp_name'], $file_new)) {
                echo "<script> alert('error: not copy'); window.history.go(-1); </script>\n";
                exit();
            } else {
                $house->edok_link = $mosConfig_live_site . $realestatemanager_configuration['edocs']['location'] . $edfile['name'];
            }
        }

        if (is_string($house)) {
            echo "<script> alert('" . $house . "'); window.history.go(-1); </script>\n";
            exit();
        }

        $house->date = date("Y-m-d H:i:s");
        if (!$house->check()) {
            echo "<script> alert('" . $house->getError() . "'); window.history.go(-1); </script>\n";
            exit();
        }

        //************approve on add begin
        if ($realestatemanager_configuration['approve_on_add']['show']) {
            if (checkAccess_REM($realestatemanager_configuration['approve_on_add']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                
            }
            else
                $house->approved = 0;
        }
        else
            $house->approved = 0;
        
/********************************** if count car group > count car user set status unpulish***************************/
        
        $count_house_single_all = getCountHouseForSingleUserREM($my, $database, $realestatemanager_configuration);
        $count_house_single_user = $count_house_single_all[0];       
        $count_house_for_single_group = $count_house_single_all[1];    
        
        if($count_house_single_user >= $count_house_for_single_group){
            $house->published = 0; 
        }

/**********************************************************************************************************************/
/*
        //************approve on add end
        //
        //************publish on add begin
        //denis 11.12.2013
        $user_group = userGID_REM($my->id);       
        $user_group_mas = explode(',', $user_group);
        //var_dump($user_group_mas);
        
        $max_count_car = 0;
        foreach ($user_group_mas as $value) {            
            $count_car_for_single_group = $realestatemanager_configuration['user_manager_vm'][$value]['count_car'];
            if($count_car_for_single_group>$max_count_car){
                $max_count_car = $count_car_for_single_group;
            }            
        }
        $count_car_for_single_group = $max_count_car;
        
        $database->setQuery("SELECT COUNT('houseid') as `count_car` FROM #__rem_houses WHERE owner_id= '" . $my->id. "'AND published='1'" );
        $count_car_single_user = $database->loadObject();
        
        if ($realestatemanager_configuration['publish_on_add']['show'])
        {
            if (checkAccess_REM($realestatemanager_configuration['publish_on_add']['registrationlevel'], 'RECURSE', userGID_REM($my->id), $acl)
                    and ($count_car_single_user->count_car < $count_car_for_single_group)
                    and ($count_car_single_user->count_car + count($id)) < $realestatemanager_configuration['user_manager_vm'][-2]['count_car'])
            {                
                
            }
            else
                $house->published = 0;
        }
        else
            $house->published = 0;

*/
        //************publish on add end
        $house->checked_out = 0;


        if (!$house->store()) {
            echo "<script> alert('" . $house->getError() . "'); window.history.go(-1); </script>\n";
            exit();
        }

        $uploaddir = $mosConfig_absolute_path . '/components/com_realestatemanager/photos/';
        $code = PHP_realestatemanager::guid();
        if ($_FILES['image_link']['name'] != '') {
            ///
            $ext = pathinfo($_FILES['image_link']['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            $allowed_exts = explode(",", $realestatemanager_configuration['allowed_exts_img']);
            foreach ($allowed_exts as $key => $allowed_ext) {
                $allowed_exts[$key] = strtolower($allowed_ext);
            }
            if (!in_array($ext, $allowed_exts)) {
                echo "<script> alert(' File ext. not allowed to upload! - " . $_FILES['image_link']['name'] . "'); window.history.go(-1); </script>\n";
                exit();
            }
            $file['type'] = $_FILES['image_link']['type'];
            $db = JFactory::getDbo();
            $db->setQuery("SELECT mime_type FROM #__rem_mime_types WHERE `mime_ext` = " . $db->quote($ext) . " and mime_type = " . $db->quote($file['type']));
            $file_db_mime = $db->loadResult();
            if ($file_db_mime != $file['type']) {
                echo "<script> alert(' File mime type not match file ext. - " . $_FILES['image_link']['name'] . "'); window.history.go(-1); </script>\n";
                exit();
            }
            ///
            $uploadfile = $uploaddir . $code . "_" . $_FILES['image_link']['name'];
            $file_name = $code . "_" . $_FILES['image_link']['name'];
            if (copy($_FILES['image_link']['tmp_name'], $uploadfile)) {
                $tmp_file = PHP_realestatemanager::picture_thumbnail($file_name, $realestatemanager_configuration['fotoupload']['high'], $realestatemanager_configuration['fotoupload']['width']);
                copy($uploaddir . $tmp_file, $uploaddir . $file_name);
                unlink($uploaddir . $tmp_file);
                //     echo "UPDATE #__rem_houses SET image_link='$file_name' WHERE houseid=".mosGetParam( $_REQUEST, 'houseid', 0 );
                $database->setQuery("UPDATE #__rem_houses SET image_link='$file_name' WHERE houseid=" . mosGetParam($_REQUEST, 'houseid', 0));
                if (!$database->query())
                    echo "<script> alert('" . $database->getErrorMsg() . "');</script>\n";
            }
        } //end if

        $house->saveCatIds($house->catid);
        $house->checkin();

        //�?охранение динамиче�?ких файлов в папку photos
        $uploaddir = $mosConfig_absolute_path . '/components/com_realestatemanager/photos/';
        if (array_key_exists("new_photo_file", $_FILES)) {
            for ($i = 0; $i < count($_FILES['new_photo_file']['name']) && trim($_FILES['new_photo_file']['name'][$i]) != ""; $i++) {
                $code = PHP_realestatemanager::guid();
                ////
                $ext = pathinfo($_FILES['new_photo_file']['name'][$i], PATHINFO_EXTENSION);
                $ext = strtolower($ext);
                $allowed_exts = explode(",", $realestatemanager_configuration['allowed_exts_img']);
                foreach ($allowed_exts as $key => $allowed_ext) {
                    $allowed_exts[$key] = strtolower($allowed_ext);
                }
                if (!in_array($ext, $allowed_exts)) {
                    echo "<script> alert(' File ext. not allowed to upload! - " . $_FILES['new_photo_file']['name'][$i] . "'); window.history.go(-1); </script>\n";
                    exit();
                }
                $file['type'] = $_FILES['new_photo_file']['type'][$i];
                $db = JFactory::getDbo();
                $db->setQuery("SELECT mime_type FROM #__rem_mime_types WHERE `mime_ext` = " . $db->quote($ext) . " and mime_type = " . $db->quote($file['type']));
                $file_db_mime = $db->loadResult();
                if ($file_db_mime != $file['type']) {
                    echo "<script> alert(' File mime type not match file ext. - " . $_FILES['new_photo_file']['name'][$i] . "'); window.history.go(-1); </script>\n";
                    exit();
                }
                ////
                $uploadfile = $uploaddir . $code . "_" . $_FILES['new_photo_file']['name'][$i];
                if (copy($_FILES['new_photo_file']['tmp_name'][$i], $uploadfile)) {
                    $file_name = $code . "_" . $_FILES['new_photo_file']['name'][$i];
                    //$file_name = PHP_realestatemanager::picture_thumbnail($file_name_,2);
                    //$mini_file_name = PHP_realestatemanager::picture_thumbnail($file_name_,1);
                    //save file names in database
                    $database->setQuery("INSERT INTO #__rem_photos (fk_houseid,main_img) VALUES ('$house->id','$file_name')");
                    if (!$database->query()) {
                        echo "<script> alert('" . $database->getErrorMsg() . "');</script>\n";
                        $mini_file_name = PHP_realestatemanager::picture_thumbnail($file_name, 1);
                    }
                }
            } //for
        } //end if

        $idd = $_POST['houseid'];
        //check the files marked for deletion
        if (array_key_exists("del_main_photo", $_POST)) {
            $del_main_photo = $_POST['del_main_photo'];
            if ($del_main_photo != '') {

                $database->setQuery("select image_link  FROM  #__rem_houses where  houseid ="
                        . $house->houseid . "");
                $image_link = $database->loadObjectList();

                $house->image_link = '';

                unlink($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $image_link[0]->image_link);

                //separation of the file name in the name and extension
                $del_main_phot = pathinfo($image_link[0]->image_link);
                $del_main_photo_type = '.' . $del_main_phot['extension'];
                $del_main_photo_name = basename($image_link[0]->image_link, $del_main_photo_type);

                $path = $mosConfig_absolute_path . '/components/com_realestatemanager/photos/';
                $check_files = JFolder::files($path, '^' . $del_main_photo_name . '.*$', false, true);
                foreach ($check_files as $check_file) {
                    unlink($check_file);
                }
            }

            //Update DB

            $database->setQuery("UPDATE #__rem_houses SET image_link='' WHERE houseid=$idd");
            if (!$database->query())
                echo "<script> alert('" . $database->getErrorMsg() . "');</script>\n";
        } //end if

        if (isset($_POST['del_photos']) && (count($_POST['del_photos']) != 0)) {
            foreach ($_POST['del_photos'] as $del_photo) {
                $database->setQuery("DELETE FROM #__rem_photos WHERE main_img='$del_photo'");
                if ($database->query()) {
                    unlink($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $del_photo);
                    //separation of the file name in the name and extension
                    $del_photo_pth = pathinfo($del_photo);
                    $del_photo_type = '.' . $del_photo_pth['extension'];
                    $del_photo_name = basename($del_photo, $del_photo_type);
                    unlink($mosConfig_absolute_path . '/components/com_realestatemanager/photos/' . $del_photo_name . "_mini" . $del_photo_type);
                } else {
                    echo '<script>alert("Can\'t delete");window.history.go(-1);</script>';
                }
            }
        }
        $house->checkin();

        if (isset($_POST['del_rent_sal'])) {
            for ($i = 0; $i < count($_POST['del_rent_sal']); $i++) {
                $del_rent_sal = $_POST['del_rent_sal'][$i];
                $database->setQuery("DELETE FROM #__rem_rent_sal WHERE id ='$del_rent_sal'");
                $database->query();
            }
        }

        if(!empty($_POST['feature'])) {	
            $feature = $_POST['feature']; 
            $database->setQuery("DELETE FROM #__rem_feature_houses WHERE fk_houseid = ".$house->id );
	        $database->query();

	        for ($i=0;$i<count($feature);$i++) {
	           $database->setQuery("INSERT INTO #__rem_feature_houses (fk_houseid, fk_featureid) VALUES (".$house->id . ", " . $feature[$i] . ")");
	           $database->query();
            }
        }
        // Parameters
        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($Itemid);
            $params = new mosParameters($menu->params);
        }

        //$app = JFactory::getApplication();
        //$menu1 = $app->getMenu();

        $menu_name = set_header_name_rem($menu, $Itemid);
        //if ($menu1->getItem($Itemid)) $menu_name = $menu1->getItem($Itemid)->title; else $menu_name = '';

        $params->def('header', $menu_name);
        $params->def('pageclass_sfx', '');
        //
        $params->def('show_search', '1');
        $params->def('back_button', $mainframe->getCfg('back_button'));

        $currentcat = new stdClass();
        $currentcat->descrip = _REALESTATE_MANAGER_LABEL_REAL_ESTATE_THANKS;

        // page image
        $currentcat->img = "./components/com_realestatemanager/images/rem_logo.png";

        $currentcat->header = $params->get('header');


        if ($realestatemanager_configuration['add_email']['show'] &&
                $realestatemanager_configuration['add_email']['address'] != "") {
            $params->def('show_email', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_email']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_email', 1);
            }
        }

        if ($params->get('show_input_email')) {
            $mail_to = explode(",", $realestatemanager_configuration['add_email']['address']);
            $userid = $my->id;
            //select user (added rent request)
            $zapros = "SELECT name, email FROM #__users WHERE id=" . $userid . ";";
            $database->setQuery($zapros);
            $item_user = $database->loadObjectList();
            echo $database->getErrorMsg();

            $zapros = "SELECT id, houseid, htitle FROM #__rem_houses WHERE houseid=" . $idd . ";";
            $database->setQuery($zapros);
            $item_house = $database->loadObjectList();
            echo $database->getErrorMsg();
            $houseid = _REALESTATE_MANAGER_LABEL_HOUSEID;
            //for ($i = 0;$i < count($mail_to);$i++){
            if ($userid == 0) {
                mosMail($mosConfig_mailfrom, 'anonymous', $mail_to, 'New house added!', 'User anonymous has submitted a new house: <br /><br /> ' .
                        $houseid . ': ' . $item_house[0]->houseid . '<br />' .
                        $item_house[0]->htitle . '<br /><br /> ' .
                        'Please log on and approve or deny this house', true);
            } else {
                mosMail($mosConfig_mailfrom, $item_user[0]->name, $mail_to, 'New house added!', 'User ' . $item_user[0]->name . ' has submitted a new house:<br /><br /> ' .
                        $houseid . ': ' . $item_house[0]->houseid . '<br />' .
                        $item_house[0]->htitle . '<br /><br /> ' .
                        'Please log on and approve or deny this house', true);
            }
            //}
        }
        //********************   end add send mail for admin   ****************
        HTML_realestatemanager :: showRentRequestThanks($params, $currentcat);
    }

    function secretImage() {
        $session = JFactory::getSession();
        $pas = $session->get('captcha_keystring', 'default');
        $new_img = new PWImageRealestate();
        $new_img->set_show_string($pas);
        $new_img->get_show_image(2.2, array(mt_rand(0, 50), mt_rand(0, 50), mt_rand(0, 50)), array(mt_rand(200, 255),
            mt_rand(200, 255), mt_rand(200, 255)));
        exit;
    }

    function checkAccess_REM($accessgroupid, $recurse, $usersgroupid, $acl) {
        $usersgroupid = explode(',', $usersgroupid);

        //parse usergroups
        $tempArr = array();
        $tempArr = explode(',', $accessgroupid);

        for ($i = 0; $i < count($tempArr); $i++) {
            if (($tempArr[$i] == $usersgroupid OR in_array($tempArr[$i], $usersgroupid)) || $tempArr[$i] == -2) {
                //allow access
                return true;
            } else {
                if ($recurse == 'RECURSE') {
                    if (is_array($usersgroupid)) {
                        for ($j = 0; $j < count($usersgroupid); $j++) {
                            if (in_array($usersgroupid[$j], $tempArr))
                                return 1;
                        }
                    } else {
                        if (in_array($usersgroupid, $tempArr))
                            return 1;
                    }
                }
            }
        } // end for
        //deny access
        return 0;
    }

    static function com_house_categoryTreeList($id, $action, $is_new, &$options = array()) {
        global $database;
        $list = PHP_realestatemanager::com_house_categoryArray();
        $cat = new mainRealEstateCategories($database);
        $cat->load($id);

        $this_treename = '';
        $childs_ids = Array();
        foreach ($list as $item) {
            if ($item->id == $cat->id || array_key_exists($item->parent_id, $childs_ids))
                $childs_ids[$item->id] = $item->id;
        }

        foreach ($list as $item) {
            if ($this_treename) {
                if ($item->id != $cat->id
                        && strpos($item->treename, $this_treename) === false
                        && array_key_exists($item->id, $childs_ids) === false) {
                    $options[] = mosHTML::makeOption($item->id, $item->treename);
                }
            } else {
                if ($item->id != $cat->id) {
                    $options[] = mosHTML::makeOption($item->id, $item->treename);
                } else {
                    $this_treename = "$item->treename/";
                }
            }
        }

        $parent = null;
        $parent = mosHTML::selectList($options, 'catid', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text', $cat->parent_id);
        return $parent;
    }

    static function com_house_categoryArray() {
        global $database, $my, $acl;

        // get a list of the menu items
        $query = "SELECT c.*, c.parent_id AS parent, c.params AS access"
                . "\n FROM #__rem_main_categories c"
                . "\n WHERE section='com_realestatemanager'"
                . "\n AND published <> -2"
                . "\n ORDER BY ordering";
        $database->setQuery($query);
        $items = $database->loadObjectList();
        foreach ($items as $r => $cat_item) {
            if (!checkAccess_REM($cat_item->access, 'NORECURSE', userGID_REM($my->id), $acl)) {//if have not access then remove item from search
                unset($items[$r]);
            }
        }
        $items = array_values($items);
        // establish the hierarchy of the menu
        $children = array();
        // first pass - collect children
        foreach ($items as $v) {
            $pt = $v->parent;
            $list = @$children[$pt] ? $children[$pt] : array();
            array_push($list, $v);
            $children[$pt] = $list;
        }
        // second pass - get an indent list of the items
        $array = mosTreeRecurse(0, '', array(), $children);

        return $array;
    }

    static function showTabs() {
        global $mosConfig_live_site, $realestatemanager_configuration, $database, $Itemid, $my, $option;
        $acl = JFactory::getACL();
        $doc = JFactory::getDocument();
        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');

        $menu = new mosMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);


        if ($option != "com_realestatemanager") {
            $comprofiler = "&tab=getmyhousesTab&is_show_data=1";
        } else {
            $comprofiler = "";
        }

        $userid = $my->id;
        $query = "SELECT u.id, u.name AS username FROM #__users AS u WHERE u.id = " . $userid;
        $database->setQuery($query);
        $ownerslist = $database->loadObjectList();
        foreach ($ownerslist as $owner) {
            $username = $owner->username;
        }

        $query = "SELECT h.owneremail as owneremail FROM #__rem_houses AS h" .
                " INNER JOIN #__rem_rent_request AS r ON h.id=r.fk_houseid " .
                " WHERE h.owner_id = '" . $my->id . "' AND r.status=0";
        $database->setQuery($query);
        $ownerhouse = $database->loadObjectList();
        foreach ($ownerhouse as $howner) {
            $houseowner = $howner->owneremail;
            break;
        }

        $query = "SELECT h.owneremail as owneremail FROM #__rem_houses AS h" .
                " INNER JOIN  #__rem_buying_request AS br ON h.id=br.fk_houseid" .
                " WHERE h.owner_id = '" . $my->id . "'";
        $database->setQuery($query);
        $ownerbuyhouse = $database->loadObjectList();
        foreach ($ownerbuyhouse as $buyowner) {
            $buyhouseowner = $buyowner->owneremail;
            break;
        }

        $query = "SELECT * FROM #__rem_rent AS r WHERE r.fk_userid = " . $my->id;
        $database->setQuery($query);
        $current_user_rent_history_array = $database->loadObjectList();
        $check_for_show_rent_history = 0;
        if (isset($current_user_rent_history_array)) {
            foreach ($current_user_rent_history_array as $temp) {
                if ($temp->fk_userid == $my->id)
                    $check_for_show_rent_history = 1;
            }
        }

        if ($realestatemanager_configuration['cb_myhouse']['show']) {
            $params->def('show_cb', 1);
            $i = checkAccess_REM($realestatemanager_configuration['cb_myhouse']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl);
            if ($i)
                $params->def('show_cb_registrationlevel', 1);
        }

        if ($realestatemanager_configuration['cb_edit']['show']) {
            $params->def('show_edit', 1);
            $i = checkAccess_REM($realestatemanager_configuration['cb_edit']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl);
            if ($i)
                $params->def('show_edit_registrationlevel', 1);
        }

        if (isset($houseowner) && $my->email == $houseowner) {
            if (($realestatemanager_configuration['cb_rent']['show'])) {
                $params->def('show_rent', 1);
                $i = checkAccess_REM($realestatemanager_configuration['cb_rent']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl);
                if ($i)
                    $params->def('show_rent_registrationlevel', 1);
            }
        }

        if (isset($buyhouseowner) && $my->email == $buyhouseowner) {
            if (($realestatemanager_configuration['cb_buy']['show'])) {
                $params->def('show_buy', 1);
                $i = checkAccess_REM($realestatemanager_configuration['cb_buy']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl);
                if ($i)
                    $params->def('show_buy_registrationlevel', 1);
            }
        }

        if ($check_for_show_rent_history != 0) {
            if (($realestatemanager_configuration['cb_history']['show'])) {
                $params->def('show_history', 1);
                $i = checkAccess_REM($realestatemanager_configuration['cb_history']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl);
                if ($i)
                    $params->def('show_history_registrationlevel', 1);
            }
        }

        HTML_realestatemanager::showTabs($params, $userid, $username, $comprofiler, $option);
    }

    static function showMyHouses($option) {
        global $database, $Itemid, $mainframe, $my, $realestatemanager_configuration;

        PHP_realestatemanager::addTitleAndMetaTags();

        $menu = new JTableMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);
        $database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_realestatemanager'");
        if ($database->loadResult() != $Itemid) {
            $params->def('wrongitemid', '1');
        }
        $limit = $realestatemanager_configuration['page']['items'];
        $limitstart = mosGetParam($_REQUEST, 'limitstart', 0);

        if (!$params->get('wrongitemid')) {
            $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=show_my_houses&amp;Itemid=' . $Itemid);
            $path_way = $mainframe->getPathway();
            $path_way->addItem(_REALESTATE_MANAGER_LABEL_TITLE_MY_HOUSES, $pathway);
        }

        $menu_name = set_header_name_rem($menu, $Itemid);
        $params->def('header', $menu_name);

        //check user
        if ($my->email == null) {
            mosRedirect("index.php?", "Please login");
            exit;
        }

        $database->setQuery("SELECT COUNT(id) FROM #__rem_houses WHERE owner_id='" . $my->id . "'");
        $total = $database->loadResult();
        $pageNav = new JPagination($total, $limitstart, $limit); // for J 1.6
        //getting my cars

        $selectstring = "SELECT a.*, GROUP_CONCAT(cc.title SEPARATOR ', ') AS category,
		l.id as rentid, l.rent_from as rent_from, l.rent_return as rent_return,
		l.rent_until as rent_until, u.name AS editor" .
                "\nFROM #__rem_houses AS a" .
                "\nLEFT JOIN #__rem_categories AS hc ON hc.iditem = a.id" .
                "\nLEFT JOIN #__categories AS cc ON cc.id = hc.idcat" .
                "\nLEFT JOIN #__rem_rent AS l ON l.fk_houseid = a.id  and l.rent_return is null " .
                "\nLEFT JOIN #__users AS u ON u.id = a.checked_out" .
                "\nWHERE owner_id='" . $my->id . "' " .
                "\nGROUP BY a.id" .
                "\nORDER BY a.htitle " .
                "\nLIMIT " . $pageNav->limitstart . "," . $pageNav->limit . ";";
        $database->setQuery($selectstring);
        $houses = $database->loadObjectList();

        $rows = $database->loadObjectList();
        $date = date(time());
        foreach ($houses as $row) {
            $check = strtotime($row->checked_out_time);
            $remain = 7200 - ($date - $check);
            if (($remain <= 0) && ($row->checked_out != 0)) {
                $database->setQuery("UPDATE #__rem_houses SET checked_out=0,checked_out_time=0");
                $database->query();
            }
        }

        $params->def('my01', "{loadposition com_realestatemanager_my_house_01,xhtml}");
        $params->def('my02', "{loadposition com_realestatemanager_my_house_02,xhtml}");
        $params->def('my03', "{loadposition com_realestatemanager_my_house_03,xhtml}");
        $params->def('my04', "{loadposition com_realestatemanager_my_house_04,xhtml}");
        $params->def('my05', "{loadposition com_realestatemanager_my_house_05,xhtml}");

        HTML_realestatemanager::showMyHouses($houses, $params, $pageNav, $option);
    }

    static function deleteHouse() {
        global $database, $my, $option, $Itemid, $mosConfig_absolute_path;
        $do = mosGetParam($_REQUEST, 'task');
        $bid = mosGetParam($_REQUEST, 'bid');

        //get real user houses id
        if (count($bid)) {
            $database->setQuery("SELECT id FROM #__rem_houses WHERE owner_id='" . $my->id . "' AND id IN (" . implode(', ', $bid) . ")");
            if (version_compare(JVERSION, "3.0.0", "lt"))
                $bid = $database->loadResultArray();
            else
                $bid = $database->loadColumn();
            if (count($bid)) {
                $bids = implode(',', $bid);
                $database->setQuery("SELECT image_link FROM #__rem_houses WHERE id IN (" . $bids . ")");
                $image_link = $database->loadObjectList();
                for ($i = 0; $i < count($image_link); $i++) {
                    $image_link_name = substr($image_link[$i]->image_link, 0, strrpos($image_link[$i]->image_link, "."));
                    $image_link_type = substr($image_link[$i]->image_link, strrpos($image_link[$i]->image_link, "."));
                    @unlink($mosConfig_absolute_path . "/components/com_realestatemanager/photos/" . $image_link_name . "_gallery" . $image_link_type);
                    @unlink($mosConfig_absolute_path . "/components/com_realestatemanager/photos/" . $image_link_name . "_mini" . $image_link_type);
                    @unlink($mosConfig_absolute_path . "/components/com_realestatemanager/photos/" . $image_link[$i]->image_link);
                }

                $database->setQuery("SELECT thumbnail_img, main_img FROM #__rem_photos WHERE fk_houseid IN (" . $bids . ")");
                $del_photos = $database->loadObjectList();

                for ($i = 0; $i <= count($del_photos); $i++) {
                    @unlink($mosConfig_absolute_path . "/components/com_realestatemanager/photos/" . $del_photos[$i]->thumbnail_img);
                    @unlink($mosConfig_absolute_path . "/components/com_realestatemanager/photos/" . $del_photos[$i]->main_img);
                }
                $database->setQuery("DELETE FROM #__rem_photos WHERE fk_houseid IN (" . $bids . ")");
                $database->query();
                $database->setQuery("DELETE FROM #__rem_review WHERE fk_houseid IN (" . $bids . ")");
                $database->query();
                $database->setQuery("DELETE FROM #__rem_categories WHERE iditem IN (" . $bids . ");");
                $database->query();
                $database->setQuery("DELETE FROM #__rem_houses WHERE id IN (" . $bids . ");");
                $database->query();
                $database->setQuery("DELETE FROM #__rem_feature_houses WHERE fk_houseid IN ($bids)");
                $database->query();
            }
        }
        if ($option == 'com_comprofiler') {
            $redirect = JRoute::_("index.php?option=" . $option . "&task=show_add&is_show_data=1&tab=getmyhousesTab&task=my_houses&Itemid=" . $Itemid);
        } else {
            $redirect = JRoute::_("index.php?option=" . $option . "&task=my_houses&Itemid=" . $Itemid);
        }
        mosRedirect($redirect);
    }

    static function publishHouse() {
        global $database, $my, $option, $Itemid, $realestatemanager_configuration;
        $do = mosGetParam($_REQUEST, 'task');
        $bid = mosGetParam($_REQUEST, 'bid');
/*
        //get real user houses id
        $user_group = userGID_REM($my->id);    
        
        $user_group_mas = explode(',', $user_group);
        //var_dump($user_group_mas);
        
        $max_count_car = 0;
        foreach ($user_group_mas as $value) {            
            $count_car_for_single_group = $realestatemanager_configuration['user_manager_vm'][$value]['count_car'];
            if($count_car_for_single_group>$max_count_car){
                $max_count_car = $count_car_for_single_group;
            }            
        }
        $count_car_for_single_group = $max_count_car;
        
        //denis 11.12.2013
        $database->setQuery("SELECT `title` FROM #__usergroups WHERE id= '" . $user_group. "'" );
        $title_user_group = $database->loadResult();
        
        $database->setQuery("SELECT COUNT('houseid') as `count_car` FROM #__rem_houses WHERE owner_id= '" . $my->id. "'AND published='1'" );
        $count_car_single_user = $database->loadObject();

        //get real user vehicles id
 
 */
        
/**************************************if mass publish cheack count car***********************************************/       
        if (count($bid)){ 
            $count_house_all = getCountHouseForSingleUserREM($my,$database,$realestatemanager_configuration);
            $count_house_single_user = $count_house_all[0];
            $count_house_for_single_group = $count_house_all[1]; 
            
            if(($count_house_single_user + count($bid))<= $count_house_for_single_group){
                
                $database->setQuery("SELECT id FROM #__rem_houses WHERE owneremail='" . $my->email . "' AND id IN (" . implode(', ', $bid) . ")");
                
                if (version_compare(JVERSION, '3.0', 'lt')){
                    $bid = $database->loadResultArray();
                }else{
                    $bid = $database->loadColumn();
                }
                
                $bids = implode(',', $bid);
                $database->setQuery("UPDATE #__rem_houses SET published = 1
                                      \n WHERE owneremail='" . $my->email . "' AND id IN (" . $bids . ");");
                $database->query();               
            }else{              
                echo "<script> alert('You can publish onle $count_house_for_single_group houses'); window.history.go(-1); </script>\n";
                exit;
            }
        }

/**********************************************************************************************************************/ 
        
        if ($option == 'com_comprofiler') {
            $redirect = JRoute::_("index.php?option=" . $option . "&task=show_add&is_show_data=1&tab=getmyhousesTab&task=my_houses&Itemid=" . $Itemid);
        } else {
            $redirect = JRoute::_("index.php?option=" . $option . "&task=my_houses&Itemid=" . $Itemid);
        }
        mosRedirect($redirect);
    }

    static function unpublishHouse() {
        global $database, $my, $option, $Itemid;
        $do = mosGetParam($_REQUEST, 'task');
        $bid = mosGetParam($_REQUEST, 'bid');

        //get real user houses id
        if (count($bid)) {
            $database->setQuery("SELECT id FROM #__rem_houses WHERE owner_id='" . $my->id . "' AND id IN (" . implode(', ', $bid) . ")");
            if (version_compare(JVERSION, "3.0.0", "lt"))
                $bid = $database->loadResultArray();
            else
                $bid = $database->loadColumn();
            if (count($bid)) {
                $bids = implode(',', $bid);
                $database->setQuery("UPDATE #__rem_houses SET published = 0
						\n WHERE owner_id='" . $my->id . "' AND id IN (" . $bids . ");");
                $database->query();
            }
        }
        if ($option == 'com_comprofiler') {
            $redirect = JRoute::_("index.php?option=" . $option . "&task=show_add&is_show_data=1&tab=getmyhousesTab&task=my_houses&Itemid=" . $Itemid);
        } else {
            $redirect = JRoute::_("index.php?option=" . $option . "&task=my_houses&Itemid=" . $Itemid);
        }
        mosRedirect($redirect);
    }

    static function listRssCategories($languagelocale) {
        global $mainframe, $database, $my, $acl, $LIMIT, $total, $langContent;
        global $mosConfig_shownoauth, $mosConfig_live_site, $mosConfig_absolute_path;
        global $cur_template, $Itemid, $realestatemanager_configuration;
        $catid = mosGetParam($_REQUEST, 'catid', "");
        $s = getWhereUsergroupsCondition("c");
        if ($catid == "")
            $where_catid = ""; else
            $where_catid = " AND idcat=" . intval($catid);

        if (isset($langContent)) {

            $lang = $langContent;
            $query = "SELECT lang_code FROM #__languages WHERE sef = '$lang'";
            $database->setQuery($query);
            $lang = $database->loadResult();
            $lang = " and ( h.language = '$lang' or h.language like 'all' or h.language like '' or h.language like '*' or h.language is null) "
                    . " AND ( c.language = '$lang' or c.language like 'all' or c.language like '' or c.language like '*' or c.language is null) ";
        } else {
            $lang = "";
        }

        $query = "SELECT c.id AS cid, c.title as ctitle, c.description as cdesc, h.id as bid, h.*, " .
                " r.rent_from, r.rent_until, r.user_name, u.name as ownername " .
                " FROM #__rem_main_categories AS c " .
                " LEFT JOIN #__rem_categories AS hc ON hc.idcat=c.id" .
                " LEFT JOIN #__rem_houses AS h ON h.id=hc.iditem " .
                " LEFT JOIN #__users as u ON u.id=h.owner_id" .
                " LEFT JOIN #__rem_rent AS r ON r.fk_houseid=h.id" .
                " WHERE c.section='com_realestatemanager' " . $lang .
                " AND c.published='1' " .
                " AND h.published='1' " .
                " AND h.approved='1'" .
                " AND ($s)" .
                $where_catid .
                " GROUP BY h.id " .
                " ORDER BY h.date desc";

        $database->setQuery($query);
        $cat_all = $database->loadObjectList();

        // Parameters
        $menu = new mosMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);

        if (($realestatemanager_configuration['contacts']['show'])) {
            $params->def('show_contacts_line', 1);
            $i = checkAccess_REM($realestatemanager_configuration['contacts']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl);
            if ($i)
                $params->def('show_contacts_registrationlevel', 1);
        }
        //take all efiles
        HTML_realestatemanager :: showRssCategories($params, $cat_all, $catid);
    }

    static function ownersList($option) {
        global $database, $my, $Itemid, $mainframe, $realestatemanager_configuration,
        $langContent, $acl, $mosConfig_list_limit, $limit, $limitstart;

        PHP_realestatemanager::addTitleAndMetaTags();

        $symbol = mosGetParam($_REQUEST, 'letindex', '');
        $symbol_str = '';
        if ($symbol) {
            $symbol_str = " AND (LOWER(u.name) LIKE '$symbol%' ) ";
        }
        //getting groups of user
        $s = getWhereUsergroupsCondition("c");


        $menu = new JTableMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);
        $database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_realestatemanager'");
        if ($database->loadResult() != $Itemid) {
            $params->def('wrongitemid', '1');
        }
        //$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
        //$limitstart=mosGetParam($_REQUEST,'limitstart',0);
        $params->def('header', _REALESTATE_MANAGER_LABEL_TITLE_OWNERSLIST);
        if (!$params->get('wrongitemid')) {
            $pathway = sefRelToAbs('index.php?option=' . $option .
                    '&amp;task=owners_list&amp;Itemid=' . $Itemid);
            $pathway_name = _REALESTATE_MANAGER_LABEL_TITLE_OWNERSLIST;
            $mainframe->appendPathWay($pathway_name, $pathway);
        }

        if (checkAccess_REM($realestatemanager_configuration['ownerslist']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl) &&
                $realestatemanager_configuration['ownerslist']['show']) {
            $params->def('ownerslist_show', 1);
        }


        if (isset($langContent)) {

            $lang = $langContent;
            $query = "SELECT lang_code FROM #__languages WHERE sef = '$lang'";
            $database->setQuery($query);
            $lang = $database->loadResult();
            $lang = " and ( rm.language = '$lang' or rm.language like 'all' or rm.language like '' or rm.language like '*' or rm.language is null) "
                    . " AND ( c.language = '$lang' or c.language like 'all' or c.language like '' or c.language like '*' or c.language is null) ";
        } else {
            $lang = "";
        }

        $db = JFactory::getDBO();
        $query = "SELECT COUNT(DISTINCT u.email)
		\nFROM #__rem_houses AS rm
		\nLEFT JOIN #__rem_categories AS rc ON rc.iditem=rm.id
		\nLEFT JOIN #__rem_main_categories AS c ON c.id=rc.idcat
		\nLEFT JOIN #__users AS u ON rm.owner_id=u.id
		\nWHERE rm.published=1 AND rm.approved=1 AND c.published=1" .
                "      AND ($s) $lang $symbol_str ";
        $db->setQuery($query);
        $total = $db->loadResult();
        $pageNav = new JPagination($total, $limitstart, $limit); // for J 1.6
        $query = "SELECT u.name, COUNT( rm.id ) AS houses
		FROM #__rem_houses AS rm
		LEFT JOIN #__rem_categories AS rc ON rc.iditem=rm.id
		LEFT JOIN #__rem_main_categories AS c ON c.id=rc.idcat
		LEFT JOIN #__users AS u ON rm.owner_id = u.id
        WHERE rm.published=1 AND rm.approved=1 " . $lang . " and c.published=1 AND rm.owner_id>0
		AND ($s) $symbol_str
		GROUP BY u.name
		ORDER BY u.name
		LIMIT $pageNav->limitstart,$pageNav->limit;";

        $db->setQuery($query);
        $ownerslist = $db->loadObjectList();


        $query = "SELECT DISTINCT UPPER( SUBSTRING( u.name, 1, 1 ) ) AS symb
		FROM #__rem_houses AS rm
		LEFT JOIN #__rem_categories AS rc ON rc.iditem=rm.id
		LEFT JOIN #__rem_main_categories AS c ON c.id=rc.idcat
		LEFT JOIN #__users AS u ON rm.owner_id = u.id
		WHERE rm.published=1 AND rm.approved=1 AND c.published=1 AND rm.owner_id>0
		AND ($s) $lang 
		ORDER BY u.name";
        $db->setQuery($query);
        $symb = $db->loadObjectList();
        if (count($symb) > 0) {
            $symb_list_str = '<div style="display:inline; margin-left:auto;margin-right:auto;">';
            foreach ($symb as $symbol) {
                $symb_list_str .= '<span style="padding:5px; ">' .
                        '<a href="index.php?option=' . $option .
                        '&task=owners_list' .
                        '&letindex=' . $symbol->symb . '&Itemid=' . $Itemid .
                        '">' . $symbol->symb . '</a></span>';
            }
            $symb_list_str.="</div>";
            $params->def('symb_list_str', $symb_list_str);
        }

        $params->def('ownerlist01', "{loadposition com_realestatemanager_owner_list_01,xhtml}");
        $params->def('ownerlist02', "{loadposition com_realestatemanager_owner_list_02,xhtml}");
        $params->def('ownerlist03', "{loadposition com_realestatemanager_owner_list_03,xhtml}");

        HTML_realestatemanager :: showOwnersList($params, $ownerslist, $pageNav);
    }

    static function viewUserHouses($option, $languagelocale) {
        global $database, $my, $Itemid, $mainframe, $user_configuration;

        PHP_realestatemanager::addTitleAndMetaTags();

        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $menu_name = set_header_name_rem($menu, $Itemid);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($Itemid);
            $menu_name = set_header_name_rem($menu, $Itemid);
            $params = new mosParameters($menu->params);
        }
        $database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_realestatemanager'");

        if ($database->loadResult() != $Itemid) {
            $params->def('wrongitemid', '1');
        }

        $user = mosGetParam($_REQUEST, 'name');
        if (!isset($user)) {
            $params = @$mainframe->getParams();
            $user = $params->get('username');
            if (!isset($user) OR $user == '') {
                if (isset($_REQUEST['name'])) {
                    $user = $_REQUEST['name'];
                } elseif (isset($_SESSION)) {
                    $user = $_SESSION['rem_user']; // for 1.6
                } else {
                    $user = "Guest";
                }
            }
        }
        $anonym_flag = false;
        if ($user == '') {
            $user = "Anonymous";
            $anonym_flag = true;
        }

        $params->def('header', ((trim($menu_name)) ? $menu_name . ":" : "") . _REALESTATE_MANAGER_LABEL_TITLE_USER_HOUSES);
        $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=owners_list&amp;Itemid=' . $Itemid);
        //         if ($option!="com_simplemembership"){
        //             $query ="SELECT name FROM #__users WHERE id=".$user;
        //             $database->setQuery($query);
        //             $user=$database->loadResult();
        //         }
        $pathway_name = $user;


        if (!$params->get('wrongitemid')) {
            $path_way = $mainframe->getPathway();
            $path_way->addItem(_REALESTATE_MANAGER_LABEL_TITLE_OWNERSLIST, $pathway);
        }
        $pathway = sefRelToAbs('index.php?option=' . $option . '&amp;task=view_user_houses&amp;Itemid=' . $Itemid . '&amp;name=' . $user);
        // for 1.6
        $path_way = $mainframe->getPathway();
        $path_way->addItem($pathway_name, $pathway);

        PHP_realestatemanager::searchHouses($option, 0, $option, $languagelocale, $user);
    }

    static function rentBeforeEndNotify($option) {
        global $database, $realestatemanager_configuration, $Itemid, $mosConfig_mailfrom;

        $send_email = 0;
        if (($realestatemanager_configuration['rent_before_end_notify']) &&
                trim($realestatemanager_configuration['rent_before_end_notify_email']) != ""
                && is_numeric($realestatemanager_configuration['rent_before_end_notify_days'])) {
            $send_email = 1;
        }

        if ($send_email) {
            $mail_to = explode(",", $realestatemanager_configuration['rent_before_end_notify_email']);

            $zapros = "SELECT h.id, h.houseid, h.htitle, r.rent_from,r.rent_until,r.user_name,r.user_email " .
                    " FROM #__rem_houses as h " .
                    " left join #__rem_rent as r on r.fk_houseid = v.id " .
                    " WHERE r.rent_return IS NULL and TIMESTAMPDIFF(DAY, now(),rent_until ) = " .
                    $realestatemanager_configuration['rent_before_end_notify_days'] . " ; ";
            $database->setQuery($zapros);
            $item_house = $database->loadObjectList();
            echo $database->getErrorMsg();

            $message = "So houses rent expire soon (in " . $realestatemanager_configuration['rent_before_end_notify_days'] . " days):<br /><br />";
            foreach ($item_house as $item) {
                $message .= 'Rent User: ' . $item->user_name . '(' . $item->user_email . ')<br /> ' .
                        'House: ' . $item->htitle . ' <br />' .
                        'ID: ' . $item->id . ' <br />' .
                        'HouseID: ' . $item->houseid . ' <hr /><br />';
            }

            if (count($item_house) > 0)
                mosMail($mosConfig_mailfrom, "Rent expire  Notice", $mail_to, 'Rent expire Notice!', $message, true);
        }
    }

    static function rent_requests($option, $bid) {
        global $database, $my, $mainframe, $mosConfig_list_limit, $realestatemanager_configuration, $Itemid;

        PHP_realestatemanager::addTitleAndMetaTags();

        if ($my->email == null) {
            mosRedirect("index.php?option=com_realestatemanager&Itemid=" . $Itemid, "Please login");
            exit;
        }

        $limit = $realestatemanager_configuration['page']['items'];
        $limitstart = mosGetParam($_REQUEST, 'limitstart', 0);

        $database->setQuery("SELECT count(*) FROM #__rem_houses AS a" .
                "\nLEFT JOIN #__rem_rent_request AS l" .
                "\nON l.fk_houseid = a.id" .
                "\nWHERE l.status = 0");
        $total = $database->loadResult();
        echo $database->getErrorMsg();

        $pageNav = new JPagination($total, $limitstart, $limit); // for J 1.6

        $database->setQuery("SELECT * FROM #__rem_houses AS a" .
                "\nLEFT JOIN #__rem_rent_request AS l" .
                "\nON l.fk_houseid = a.id" .
                "\nWHERE l.status = 0 AND a.owner_id LIKE '$my->id'" .
                "\nORDER BY l.rent_from, l.rent_until, l.user_name" .
                "\nLIMIT $pageNav->limitstart,$pageNav->limit;");
        $rent_requests = $database->loadObjectList();
        echo $database->getErrorMsg();

        PHP_realestatemanager::showTabs();
        HTML_realestatemanager :: showRequestRentHouses($option, $rent_requests, $pageNav);
    }

    static function decline_rent_requests($option, $bids) {
        global $database, $realestatemanager_configuration, $Itemid;
        $datas = array();
        foreach ($bids as $bid) {
            $rent_request = new mosRealEstateManager_rent_request($database);
            $rent_request->load($bid);
            $tmp = $rent_request->decline();
            if ($tmp != null) {
                echo "<script> alert('" . $tmp . "'); window.history.go(-1); </script>\n";
                exit;
            }
            foreach ($datas as $c => $data) {
                if ($rent_request->user_email == $data['email']) {
                    $datas[$c]['ids'][] = $rent_request->fk_houseid;
                    continue 2;
                }
            }
            $datas[] = array('email' => $rent_request->user_email, 'name' => $rent_request->user_name, 'id' => $rent_request->fk_houseid);
        }

        if ($realestatemanager_configuration['rent_answer']) {
            if (isset($datas->name) || isset($datas->email) || isset($datas->id)) {
                sendMailRentRequest($datas, _REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_DECLINED);
            }
        }

        if ($option == "com_comprofiler") {
            mosRedirect("index.php?option=" . $option . "&task=rent_requests&tab=getmyhousesTab&is_show_data=1&Itemid=" . $Itemid);
        } else {
            mosRedirect("index.php?option=" . $option . "&task=rent_requests&Itemid=" . $Itemid);
        }
    }

    static function accept_rent_requests($option, $bids) {
        global $database, $realestatemanager_configuration, $Itemid;
        $datas = array();
        foreach ($bids as $bid) {
            $rent_request = new mosRealEstateManager_rent_request($database);
            $rent_request->load($bid);
            $tmp = $rent_request->accept();
            if ($tmp != null) {
                echo "<script> alert('" . $tmp . "'); window.history.go(-1); </script>\n";
                exit;
            }
            foreach ($datas as $c => $data) {
                if ($rent_request->user_email == $data['email']) {
                    $datas[$c]['ids'][] = $rent_request->fk_houseid;
                    continue 2;
                }
            }
            $datas[] = array('email' => $rent_request->user_email, 'name' => $rent_request->user_name, 'id' => $rent_request->fk_houseid);
        }

        if ($realestatemanager_configuration['rent_answer']) {
            if (isset($datas->name) || isset($datas->email) || isset($datas->id)) {
                sendMailRentRequest($datas, _REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_ACCEPTED);
            }
        }

        if ($option == "com_comprofiler") {
            mosRedirect("index.php?option=" . $option . "&task=rent_requests&tab=getmyhousesTab&is_show_data=1&Itemid=" . $Itemid);
        } else {
            mosRedirect("index.php?option=" . $option . "&task=rent_requests&Itemid=" . $Itemid);
        }
    }

    static function sendMailRentRequest($datas, $answer) {
        die("sendMAIL");
        global $database, $mosConfig_mailfrom, $realestatemanager_configuration;
        $conf = JFactory::getConfig();

        foreach ($datas as $key => $data) {
            $mess = null;
            $zapros = "SELECT htitle FROM #__rem_houses WHERE id=" . $data['id'];
            $database->setQuery($zapros);
            $item = $database->loadResult();
            echo $database->getErrorMsg();
            $database->setQuery("SELECT u.name AS ownername,u.email as owneremail
					\nFROM #__users AS u
					\nLEFT JOIN #__rem_houses AS rm ON rm.owner_id=u.id
					\nWHERE rm.id=" . $data['id']);
            echo $database->getErrorMsg();
            $ownerdata = $database->loadObjectList();

            $datas[$key]['title'] = $item;

            $message = _REALESTATE_MANAGER_EMAIL_NOTIFICATION_RENT_REQUEST_ANSWER;
            $message = str_replace("{title}", $datas[$key]['title'], $message);
            $message = str_replace("{answer}", $answer, $message);
            $message = str_replace("{username}", $datas[$key]['name'], $message);
            if ($answer == _REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_ACCEPTED) {
                $message = str_replace("{ownername}", $ownerdata[0]->ownername, $message);
                $message = str_replace("{owneremail}", $ownerdata[0]->owneremail, $message);
            } else {
                $message = str_replace("{ownername}", '', $message);
                $message = str_replace("{owneremail}", '', $message);
            }


            mosMail($mosConfig_mailfrom, $conf->_registry['config']['data']->fromname, $data['email'], $message, true);
        }
    }

    static function sendMailBuyingRequest($datas, $answer) {
        global $database, $mosConfig_mailfrom, $realestatemanager_configuration;
        $conf = JFactory::getConfig();

        foreach ($datas as $key => $data) {
            $mess = null;
            $zapros = "SELECT htitle FROM #__rem_houses WHERE id=" . $data['id'];
            $database->setQuery($zapros);
            $item = $database->loadResult();
            echo $database->getErrorMsg();
            $database->setQuery("SELECT u.name AS ownername,u.email AS owneremail
					\nFROM #__users AS u
					\nLEFT JOIN #__rem_houses AS rm ON rm.owner_id=u.id
					\nWHERE rm.id=" . $data['id']);
            echo $database->getErrorMsg();
            $ownerdata = $database->loadObjectList();

            $datas[$key]['title'] = $item;

            $message = $realestatemanager_configuration['buy_form'];
            $message = str_replace("{title}", $datas[$key]['title'], $message);
            $message = str_replace("{answer}", $answer, $message);
            $message = str_replace("{username}", $datas[$key]['name'], $message);
            if ($answer == _REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_ACCEPTED) {
                $message = str_replace("{ownername}", $ownerdata[0]->ownername, $message);
                $message = str_replace("{owneremail}", $ownerdata[0]->owneremail, $message);
            } else {
                $message = str_replace("{ownername}", '', $message);
                $message = str_replace("{owneremail}", '', $message);
            }

            mosMail($mosConfig_mailfrom, $conf->_registry['config']['data']->fromname, $data['email'], _REALESTATE_MANAGER_EMAIL_RENT_ANSWER_SUBJECT, $message, true);
        }
    }

    static function buying_requests($option) {
        global $database, $mainframe, $my, $mosConfig_list_limit, $realestatemanager_configuration, $Itemid;

        if ($my->email == null) {
            mosRedirect("index.php?option=com_realestatemanager&Itemid=" . $Itemid, "Please login");
            exit;
        }

        $limit = $realestatemanager_configuration['page']['items'];
        $limitstart = mosGetParam($_REQUEST, 'limitstart', 0);

        $database->setQuery("SELECT count(*) FROM #__rem_houses AS a" .
                "\n LEFT JOIN #__rem_buying_request AS s" .
                "\n ON s.fk_houseid = a.id" .
                "\n WHERE s.status = 0 ");
        $total = $database->loadResult();
        echo $database->getErrorMsg();

        $pageNav = new JPagination($total, $limitstart, $limit); // for J 1.6

        $database->setQuery("SELECT * FROM #__rem_houses AS a" .
                "\n LEFT JOIN #__rem_buying_request AS s" .
                "\n ON s.fk_houseid = a.id" .
                "\n WHERE s.status = 0 AND a.owner_id LIKE '" . $my->id . "'" .
                "\n ORDER BY s.customer_name" .
                "\n LIMIT " . $pageNav->limitstart . "," . $pageNav->limit . ";");
        $rent_requests = $database->loadObjectList();
        echo $database->getErrorMsg();
        PHP_realestatemanager::showTabs();

        HTML_realestatemanager::showRequestBuyingHouses($option, $rent_requests, $pageNav, $Itemid);
    }

    static function accept_buying_requests($option, $bids) {
        global $database, $Itemid;
        foreach ($bids as $bid) {
            $buying_request = new mosRealEstateManager_buying_request($database);
            $buying_request->load($bid);

            $datas[] = array('name' => $buying_request->customer_name,
                'email' => $buying_request->customer_email,
                'id' => $buying_request->fk_houseid);
            $buying_request->delete();
            /* if ($tmp!=null){
              echo "<script> alert('".$tmp."'); window.history.go(-1); </script>\n";
              exit;
              } */
        }
        if ($realestatemanager_configuration['buy_answer']) {
            if (isset($datas->name) || isset($datas->email) || isset($datas->id)) {
                sendMailBuyingRequest($datas, _REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_ACCEPTED);
            }
        }
        if ($option == "com_comprofiler") {
            mosRedirect(JRoute::_("index.php?option=" . $option . "&task=buying_requests&tab=getmyhousesTab&is_show_data=1&Itemid=" . $Itemid));
        } else {
            mosRedirect(JRoute::_("index.php?option=" . $option . "&task=buying_requests&Itemid=" . $Itemid));
        }
    }

    static function decline_buying_requests($option, $bids) {
        global $database, $Itemid;
        foreach ($bids as $bid) {
            $buying_request = new mosRealEstateManager_buying_request($database);
            $buying_request->load($bid);


            $datas[] = array('name' => $buying_request->customer_name,
                'email' => $buying_request->customer_email,
                'id' => $buying_request->fk_houseid
            );
            $tmp = $buying_request->decline();
            if ($tmp != null) {
                echo "<script> alert('" . $tmp . "'); window.history.go(-1); </script>\n";
                exit();
            }
        }
        if ($realestatemanager_configuration['buy_answer']) {
            if (isset($datas->name) || isset($datas->email) || isset($datas->id)) {
                sendMailBuyingRequest($datas, _REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_DECLINED);
            }
        }
        if ($option == "com_comprofiler") {
            mosRedirect("index.php?option=" . $option . "&task=buying_requests&tab=getmyhousesTab&is_show_data=1&Itemid=" . $Itemid);
        } else {
            mosRedirect("index.php?option=" . $option . "&task=buying_requests&Itemid=" . $Itemid);
        }
    }

    static function rent($option, $bid) {
        global $database, $my;

        PHP_realestatemanager::addTitleAndMetaTags();

        if (!array_key_exists("bid", $_REQUEST)) {
            echo "<script> alert('" . _REALESTATE_MANAGER_TOOLBAR_RENT_HOUSES . "'); window.history.go(-1);</script>\n";
            exit;
        }
        $bids = implode(',', $bid);

        $select = "SELECT a.*, cc.name AS category, l.id as rentid, l.rent_from as rent_from, " .
                "l.rent_return as rent_return, l.rent_until as rent_until, " .
                "l.user_name as user_name, l.user_email as user_email " .
                "\nFROM #__rem_houses AS a" .
                "\nLEFT JOIN #__rem_categories as hc on hc.iditem = a.id" .
                "\nLEFT JOIN #__rem_main_categories AS cc ON cc.id = hc.idcat" .
                "\nLEFT JOIN #__rem_rent AS l ON l.id = a.fk_rentid" .
                "\nWHERE a.id in (" . $bids . ")";
        $database->setQuery($select);
        if (!$database->query()) {
            echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            exit();
        }
        $houses = $database->loadObjectList();
        //for rent or not
        $count = count($houses);
        for ($i = 0; $i < $count; $i++) {
            if ($houses[$i]->listing_type != '1') {
                ?>
                <script type="text/JavaScript" language="JavaScript">
                    alert('This house is not for rent');
                    window.history.go(-1);
                </script>
                <?php

                exit;
            }
        }
        // get list of categories

        $userlist[] = mosHTML :: makeOption('-1', '----------');
        $database->setQuery("SELECT id AS value, name AS text from #__users ORDER BY name");
        $userlist = array_merge($userlist, $database->loadObjectList());
        $usermenu = mosHTML :: selectList($userlist, 'userid', 'class="inputbox" size="1"', 'value', 'text', '-1');
        HTML_realestatemanager :: showRentHouses($option, $houses, $usermenu, "rent");
    }

    static function saveRent($option, $bids, $task = "") {
        global $database, $Itemid, $realestatemanager_configuration;
        $checkh = mosGetParam($_REQUEST, 'checkHouse');

        /////////////////////
        if (isset($id)
                && $id != 0
                && $my->id
                != $house->owner_id
        ) {
            mosRedirect('index.php?option=com_realestatemanager&Itemid=' . $Itemid);
            exit;
        }

        /////////////////////////

        if ($checkh != "on") {
            echo "<script> alert('Select an item to rent'); window.history.go(-1);</script>\n";
            exit;
        }

        $data = JFactory::getDBO();
        $houseid = mosGetParam($_REQUEST, 'houseid');
        $id = mosGetParam($_REQUEST, 'id');
        $rent_from = mosGetParam($_REQUEST, 'rent_from');
        $rent_until = mosGetParam($_REQUEST, 'rent_until');

        if (!is_array($bids) || count($bids) < 1) {
            echo "<script> alert('Select an item to rent'); window.history.go(-1);</script>\n";
            exit;
        }

        $rent = new mosRealEstateManager_rent($database);
        if ($task == "edit_rent")
            $rent->load($bids[0]);
        $query = "SELECT * FROM #__rem_rent where fk_houseid= " . $id . " AND rent_return is NULL ";
        $data->setQuery($query);
        $rentTerm = $data->loadObjectList();

        if ($rent_from > $rent_until) {
            echo "<script> alert('" . $rent_from . " more then " . $rent_until . "'); window.history.go(-1); </script>\n";
            exit();
        }

        $rent_from = substr($rent_from, 0, 10);
        $rent_until = substr($rent_until, 0, 10);
        
        foreach ($rentTerm as $oneTerm){
            
            if ($task == "edit_rent" && $bids[0] == $oneTerm->id)
                continue;
            
            $oneTerm->rent_from = substr($oneTerm->rent_from, 0, 10);
            $oneTerm->rent_until = substr($oneTerm->rent_until, 0, 10);
            
            $returnMessage = checkRentDayNightREM (($oneTerm->rent_from),($oneTerm->rent_until), $rent_from, $rent_until, $realestatemanager_configuration);
           
            if(strlen($returnMessage) > 0){                 
                echo "<script> alert('$returnMessage'); window.history.go(-1); </script>\n";          
                exit;
            }       
        } 

        if (mosGetParam($_REQUEST, 'rent_from') != "")
            $rent->rent_from = data_transform_rem(mosGetParam($_REQUEST, 'rent_from'), "to");
        else
            $rent->rent_from = null;
        if (mosGetParam($_REQUEST, 'rent_until') != "")
            $rent->rent_until = data_transform_rem(mosGetParam($_REQUEST, 'rent_until'), "to");
        else
            $rent->rent_until = null;

        $rent->fk_houseid = $id;
        $userid = mosGetParam($_REQUEST, 'userid');

        if ($userid == "-1") {
            $rent->user_name = mosGetParam($_REQUEST, 'user_name', '');
            $rent->user_email = mosGetParam($_REQUEST, 'user_email', '');
        } else {
            $rent->fk_userid = $userid;
        }

        if (!$rent->check($rent)) {
            echo "<script> alert('" . $rent->getError() . "'); window.history.go(-1); </script>\n";
            exit();
        }

        if (!$rent->store()) {
            echo "<script> alert('" . $rent->getError() . "'); window.history.go(-1); </script>\n";
            exit();
        }

        $rent->checkin();
        $house = new mosRealEstateManager($database);
        $house->load($id);
        $house->fk_rentid = $rent->id;
        $house->store();
        $house->checkin();

        if ($option == 'com_comprofiler')
            $link_for_mosRedirect = JRoute::_("index.php?option=" . $option . "&task=my_houses&tab=getmyhousesTab&Itemid=" . $Itemid); else
            $link_for_mosRedirect = JRoute::_("index.php?option=" . $option . "&task=my_houses&Itemid=" . $Itemid);
        mosRedirect($link_for_mosRedirect);
    }

    static function rent_return($option, $bid) {
        global $database, $my, $Itemid;

        PHP_realestatemanager::addTitleAndMetaTags();

        if (!is_array($bid) || count($bid) < 1) {
            echo "<script> alert('Select an item to rent'); window.history.go(-1);</script>\n";
            exit;
        }
        $bids = implode(',', $bid);

        //for databases without subselect
        $select = "SELECT a.*, cc.name AS category, l.id as rentid, l.rent_from as rent_from, " .
                "l.rent_return as rent_return, l.rent_until as rent_until, " .
                "l.user_name as user_name, l.user_email as user_email " .
                "\nFROM #__rem_houses AS a" .
                "\nLEFT JOIN #__rem_categories as hc on hc.iditem = a.id" .
                "\nLEFT JOIN #__rem_main_categories AS cc ON cc.id = hc.idcat" .
                "\nLEFT JOIN #__rem_rent AS l ON l.id = a.fk_rentid" .
                "\nWHERE a.id in (" . $bids . ")";
        $database->setQuery($select);
        if (!$database->query()) {
            echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            exit;
        }

        $houses = $database->loadObjectList();
        $count = count($houses);
        for ($i = 0; $i < $count; $i++) {
            if ($houses[$i]->listing_type != '1') {
                ?>
                <script type="text/JavaScript" language="JavaScript">
                    alert('This house is not for rent');
                    window.history.go(-1);
                </script>
                <?php

                exit;
            }
        }
        for ($i = 0; $i < 1; $i++) {
            if (((@$houses[$i]->rent_from) == '') && ((@$houses[$i]->rent_return) == '')) {
                ?>
                <script type="text/JavaScript" language="JavaScript">
                    alert('You cannot return houses that were not lent out');
                    window.history.go(-1);
                </script>
                <?php

                exit;
            }
        }

        // get list of users
        $userlist[] = mosHTML :: makeOption('-1', '----------');
        $database->setQuery("SELECT id AS value, name AS text from #__users ORDER BY name");
        $userlist = array_merge($userlist, $database->loadObjectList());
        $usermenu = mosHTML :: selectList($userlist, 'userid', 'class="inputbox" size="1"', 'value', 'text', '-1');
        HTML_realestatemanager :: showRentHouses($option, $houses, $usermenu, "rent_return");
    }

    static function saveRent_return($option, $lids) {
        global $database, $my, $Itemid;

        $houseid = mosGetParam($_REQUEST, 'houseid');
        $id = mosGetParam($_REQUEST, 'id');
        $rent_from = mosGetParam($_REQUEST, 'rent_from');
        $rent_until = mosGetParam($_REQUEST, 'rent_until');

        if (!is_array($lids) || count($lids) < 1) {
            echo "<script> alert('Select an item to return'); window.history.go(-1);</script>\n";
            exit;
        }

        for ($i = 0, $n = count($lids); $i < $n; $i++) {
            $rent = new mosRealEstateManager_rent($database);
            $rent->load($lids[$i]);
            if ($rent->rent_return != null) {
                echo "<script> alert('House already returned'); window.history.go(-1);</script>\n";
                exit;
            }
            $rent->rent_return = date("Y-m-d H:i:s");
            if (!$rent->check($rent)) {
                echo "<script> alert('" . $rent->getError() . "'); window.history.go(-1); </script>\n";
                exit;
            }
            if (!$rent->store()) {
                echo "<script> alert('" . $rent->getError() . "'); window.history.go(-1); </script>\n";
                exit;
            }
            $rent->checkin();
            $is_update_house_lend = true;
            if ($is_update_house_lend) {
                $house = new mosRealEstateManager($database);
                $house->load($id);
                $query = "SELECT * FROM #__rem_rent where fk_houseid= " . $id . " AND rent_return is NULL";
                $database->setQuery($query);
                $info_rents = $database->loadObjectList();
                if (isset($info_rents[0])) {
                    $house->fk_rentid = $info_rents[0]->id;
                    $is_update_house_lend = FALSE;
                } else {
                    $house->fk_rentid = 0;
                }
                $house->store();
                $house->checkin();
            }
        }

        if ($option == 'com_comprofiler') {
            $link_for_mosRedirect = JRoute::_("index.php?option=" . $option . "&task=my_houses&tab=getmyhousesTab&Itemid=" . $Itemid);
        } else {
            $link_for_mosRedirect = JRoute::_("index.php?option=" . $option . "&task=my_houses&Itemid=" . $Itemid);
        }
        mosRedirect($link_for_mosRedirect);
    }

    static function rent_history($option) {
        global $database, $my, $Itemid, $realestatemanager_configuration, $mosConfig_list_limit;

        PHP_realestatemanager::addTitleAndMetaTags();

        if ($my->email == null) {
            mosRedirect("index.php?option=com_realestatemanager&Itemid=" . $Itemid, "Please login");
            exit;
        }

        $menu = new mosMenu($database);
        $menu->load($Itemid);
        $params = new mosParameters($menu->params);
        $database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_realestatemanager'");
        if ($database->loadResult() != $Itemid)
            $params->def('wrongitemid', '1');

        $limit = $realestatemanager_configuration['page']['items'];
        $limitstart = mosGetParam($_REQUEST, 'limitstart', 0);

        $database->setQuery("SELECT count(*) FROM #__rem_rent AS l " .
                "\nLEFT JOIN #__rem_houses AS a ON a.id = l.fk_houseid" .
                "\nWHERE l.fk_userid = '" . $my->id . "'");
        $total = $database->loadResult();
        echo $database->getErrorMsg();

        $pageNav = new JPagination($total, $limitstart, $limit); // for J 1.6

        $query = "SELECT l.*,a.* FROM #__rem_rent AS l " .
                "\nLEFT JOIN #__rem_houses AS a ON a.id = l.fk_houseid" .
                "\nWHERE l.fk_userid = '" . $my->id . "' LIMIT " . $pageNav->limitstart . "," . $pageNav->limit . ";";

        $database->setQuery($query);
        $houses = $database->loadObjectList();
        PHP_realestatemanager::showTabs();
        HTML_realestatemanager :: showRentHistory($option, $houses, $pageNav);
    }

    static function ShowAllHouses($layout = "default", $printItem) {
        global $mainframe, $database, $acl, $my, $langContent;
        global $mosConfig_shownoauth, $mosConfig_live_site, $mosConfig_absolute_path;
        global $cur_template, $Itemid, $realestatemanager_configuration, $mosConfig_list_limit, $limit, $total, $limitstart;

        PHP_realestatemanager::addTitleAndMetaTags();

        if (isset($langContent)) {

            $lang = $langContent;
            $query = "SELECT lang_code FROM #__languages WHERE sef = '$lang'";
            $database->setQuery($query);
            $lang = $database->loadResult();
            $lang = " and ( h.language = '$lang' or h.language like 'all' or h.language like '' or h.language like '*' or h.language is null) "
                    . " AND ( c.language = '$lang' or c.language like 'all' or c.language like '' or c.language like '*' or c.language is null) ";
        } else {
            $lang = "";
        }

        //sorting
        $item_session = JFactory::getSession();
        $sort_arr = $item_session->get('rem_housesort', '');
        if (is_array($sort_arr)) {
            $tmp1 = mosGetParam($_POST, 'order_direction');
            if ($tmp1 != '')
                $sort_arr['order_direction'] = $tmp1;
            $tmp1 = mosGetParam($_POST, 'order_field');
            if ($tmp1 != '')
                $sort_arr['order_field'] = $tmp1;
            $item_session->set('rem_housesort', $sort_arr);
        } else {
            $sort_arr = array();
            $sort_arr['order_field'] = 'htitle';
            $sort_arr['order_direction'] = 'asc';
            $item_session->set('rem_housesort', $sort_arr);
        }
        if ($sort_arr['order_field'] == "price")
            $sort_string = "CAST( " . $sort_arr['order_field'] . " AS SIGNED)" . " " . $sort_arr['order_direction'];
        else
            $sort_string = $sort_arr['order_field'] . " " . $sort_arr['order_direction'];

        //getting groups of user
        $s = getWhereUsergroupsCondition("c");

        $query = "SELECT COUNT(DISTINCT h.id)
            \nFROM #__rem_houses AS h"
                . "\nLEFT JOIN #__rem_categories AS hc ON hc.iditem=h.id"
                . "\nLEFT JOIN #__rem_main_categories AS c ON c.id=hc.idcat"
                . "\nWHERE h.published='1' AND h.approved='1' AND c.published='1'  $lang
              AND ($s)";

        $database->setQuery($query);
        $total = $database->loadResult();

        $pageNav = new JPagination($total, $limitstart, $limit);

        // getting all items for this category
        $query = "SELECT h.*,hc.idcat AS catid,hc.idcat AS idcat, c.title as category_titel
       \nFROM #__rem_houses AS h "
                . "\nLEFT JOIN #__rem_categories AS hc ON hc.iditem=h.id "
                . "\nLEFT JOIN #__rem_main_categories AS c ON c.id=hc.idcat "
                . "\nWHERE h.published='1' AND h.approved='1'  "
                . "\nAND c.published='1' $lang AND ($s) "
                . "\nGROUP BY h.id "
                . "\nORDER BY " . $sort_string
                . "\nLIMIT $pageNav->limitstart,$pageNav->limit;";
        $database->setQuery($query);

        $houses = $database->loadObjectList();

        $query = "SELECT h.*,c.id, c.parent_id, c.title, c.published, c.image,COUNT(hc.iditem) as houses, '1' as display" .
                " \n FROM  #__rem_main_categories as c
              \n LEFT JOIN #__rem_categories AS hc ON hc.idcat=c.id
              \n LEFT JOIN #__rem_houses AS h ON h.id=hc.iditem
              \n WHERE c.section='com_realestatemanager' 
              AND c.published=1 AND ({$s}) $lang 
              \n GROUP BY c.id
              \n ORDER BY c.parent_id DESC, c.ordering ";

        $database->setQuery($query);
        $cat_all = $database->loadObjectList();

        foreach ($cat_all as $k1 => $cat_item1) {
            if (is_exist_curr_and_subcategory_houses($cat_all[$k1]->id)) {
                foreach ($cat_all as $cat_item2) {
                    if ($cat_item1->id == $cat_item2->parent_id) {
                        $cat_all[$k1]->houses += $cat_item2->houses;
                    }
                }
            } else
                $cat_all[$k1]->display = 0;
        }

        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($Itemid);
            $params = new mosParameters($menu->params);
        }

        $menu_name = set_header_name_rem($menu, $Itemid);

        $params->def('rss_show', $realestatemanager_configuration['rss']['show']);
        $params->def('header', $menu_name);
        $params->def('pageclass_sfx', '');
        //$params->set('category_name', $category->title);
        $params->def('show_search', '1');
        $params->def('show_category', '1');

        if (($realestatemanager_configuration['rentstatus']['show'])) {
            if (checkAccess_REM($realestatemanager_configuration['rentrequest']['registrationlevel'], 'RECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_rentstatus', 1);
                $params->def('show_rentrequest', 1);
            }
        }

//     //add to path category name
//     PHP_realestatemanager::constructPathway($category);
//*****   begin add for Manager Suggestion: button 'Suggest a house'
        if ($realestatemanager_configuration['add_suggest']['show']) {
            $params->def('show_add_suggest', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_suggest']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_add_suggest', 1);
            }
        }
//*********   end add for Manager Suggestion: button 'Suggest a houses'   ***

        if ($realestatemanager_configuration['reviews']['show']) {
            $params->def('show_reviews', 1);
            if (checkAccess_REM($realestatemanager_configuration['reviews']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_inputreviews', 1);
            }
        }
//***************   begin add for  Manager print pdf: button 'print PDF'    *********************
        if ($realestatemanager_configuration['print_pdf']['show']) {
            $params->def('show_print_pdf', 1);
            if (checkAccess_REM($realestatemanager_configuration['print_pdf']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_print_pdf', 1);
            }
        }
//**************   end add for  Manager print pdf: button 'print PDF'    ******************************
//*************   begin add for  Manager print view: button 'print VIEW'    **************************
        if ($realestatemanager_configuration['print_view']['show']) {
            $params->def('show_print_view', 1);
            if (checkAccess_REM($realestatemanager_configuration['print_view']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_print_view', 1);
            }
        }
//********************   end add for  Manager print view: button 'print VIEW'    ********************
//*******************   begin add for  Manager mail to: button 'mail to'    ************************
        if ($realestatemanager_configuration['mail_to']['show']) {
            $params->def('show_mail_to', 1);
            if (checkAccess_REM($realestatemanager_configuration['mail_to']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_mail_to', 1);
            }
        }
//********************   end add for  Manager mail to: button 'mail to'    *************************
//**************   begin add for  Manager add_house: button 'Add house'    *********************
        if ($realestatemanager_configuration['add_house']['show']) {
            $params->def('show_add_house', 1);
            if (checkAccess_REM($realestatemanager_configuration['add_house']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_input_add_house', 1);
            }
        }
//*************   end add for  Manager add_house: button 'Add house'    ***********************

        $params->def('sort_arr_order_direction', $sort_arr['order_direction']);
        $params->def('sort_arr_order_field', $sort_arr['order_field']);

        //add for show in category picture
        if ($realestatemanager_configuration['cat_pic']['show'])
            $params->def('show_cat_pic', 1);

        $params->def('search_request', 1);
        $params->def('show_rating', 1);
        $params->def('hits', 1);
        $params->def('back_button', $mainframe->getCfg('back_button'));

        // used to show table rows in alternating colours
        $tabclass = array('sectiontableentry1', 'sectiontableentry2');

        //view type
        $params->def('view_type', $realestatemanager_configuration['view_type']);
        $params->def('minifotohigh', $realestatemanager_configuration['foto']['high']);
        $params->def('minifotowidth', $realestatemanager_configuration['foto']['width']);

        // price
        if ($realestatemanager_configuration['price']['show']) {
            $params->def('show_pricestatus', 1);
            if (checkAccess_REM($realestatemanager_configuration['price']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                $params->def('show_pricerequest', 1);
            }
        }


        $params->def('singlecategory01', "{loadposition com_realestatemanager_all_house_01,xhtml}");
        $params->def('singlecategory02', "{loadposition com_realestatemanager_all_house_02,xhtml}");
        $params->def('singlecategory03', "{loadposition com_realestatemanager_all_house_03,xhtml}");
        $params->def('singlecategory04', "{loadposition com_realestatemanager_all_house_04,xhtml}");
        $params->def('singlecategory05', "{loadposition com_realestatemanager_all_house_05,xhtml}");
        $params->def('singlecategory06', "{loadposition com_realestatemanager_all_house_06,xhtml}");
        $params->def('singlecategory07', "{loadposition com_realestatemanager_all_house_07,xhtml}");
        $params->def('singlecategory08', "{loadposition com_realestatemanager_all_house_08,xhtml}");
        $params->def('singlecategory09', "{loadposition com_realestatemanager_all_house_09,xhtml}");
        $params->def('singlecategory10', "{loadposition com_realestatemanager_all_house_10,xhtml}");
        $params->def('singlecategory11', "{loadposition com_realestatemanager_all_house_11,xhtml}");

        switch ($printItem) {
            case 'pdf':
                HTML_realestatemanager::displayAllHousesPdf($houses, $params, $tabclass, $pageNav);
                break;

            case 'print':
                HTML_realestatemanager::displayAllHousePrint($houses, $params, $tabclass, $pageNav);
                break;

            default:
                HTML_realestatemanager::displayAllHouses($houses, $params, $tabclass, $pageNav, $layout);
                break;
        }
    }

}
