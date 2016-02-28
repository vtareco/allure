<meta name="viewport" content="width=device-width; initial-scale=1.0;" />
<?php
if(!defined('_VALID_MOS') && !defined('_JEXEC')) die('Direct Access to '.basename(__FILE__).' is not allowed.');

/**
 * @version 3.0
 * @package RealEstateManager 
 * @copyright 2012 OrdaSoft
 * @author 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru)
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @description Search RealEstate for RealEstateManager Component
 * Homepage: http://www.ordasoft.com
*/
global $task; 
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
require_once ( JPATH_BASE .DS.'administrator'.DS.'components'.DS.'com_realestatemanager'.DS.'realestatemanager.class.others.php');
require_once ( JPATH_BASE .DS.'administrator'.DS.'components'.DS.'com_realestatemanager'.DS.'realestatemanager.class.others.php' );
require_once ( JPATH_BASE .DS.'components'.DS.'com_realestatemanager'.DS.'functions.php' );
require_once ( JPATH_BASE .DS.'components'.DS.'com_realestatemanager'.DS.'realestatemanager.main.categories.class.php' );
$doc = JFactory::getDocument(); 
$doc->addStyleSheet( JURI::base(true) .DS. 'components'.DS.'com_realestatemanager'.DS.'includes'.DS.'realestatemanager.css');


$database = JFactory::getDbo();
$languagelocale = "";
$query = "SELECT l.title, l.lang_code, l.sef ";
$query .= "FROM #__rem_const_languages as cl ";
$query .= "LEFT JOIN #__rem_languages AS l ON cl.fk_languagesid=l.id ";
$query .= "LEFT JOIN #__rem_const AS c ON cl.fk_constid=c.id ";
$query .= "GROUP BY  l.title";
$database->setQuery( $query );
$languages = $database->loadObjectList();

$lang = JFactory::getLanguage();
foreach ($lang->getLocale() as $locale){
    foreach ($languages as $language){
	if($locale == $language->title || $locale == $language->lang_code || $locale == $language->sef) {
	        $mosConfig_lang = $locale;
	        $languagelocale = $language->lang_code;
	        break;
	}
    }
} 

if ($languagelocale == ''){
    $mosConfig_lang = $lang->getTag();
    $languagelocale = $lang->getTag();
}
if ($languagelocale == '')
    $languagelocale = "en-GB";


$query = "SELECT c.const, cl.value_const ";
$query .= "FROM #__rem_const_languages as cl ";
$query .= "LEFT JOIN #__rem_languages AS l ON cl.fk_languagesid=l.id ";
$query .= "LEFT JOIN #__rem_const AS c ON cl.fk_constid=c.id ";
$query .= "WHERE l.lang_code = '$languagelocale'";
$database->setQuery( $query );
$langConst = $database->loadObjectList();

foreach($langConst as $item) {
    if(!defined($item->const))
    define($item->const, $item->value_const);
}

if(!function_exists('sefRelToAbs')){
    function sefRelToAbs($value){
        //Need check!!!
        //Replace all &amp; with & as the router doesn't understand &amp;
        $url = str_replace('&amp;', '&', $value);
        if(substr(strtolower($url),0,9) != "index.php") return $url;
        $uri    = JURI::getInstance();
        $prefix = $uri->toString(array('scheme', 'host', 'port'));
        return $prefix.JRoute::_($url);
    }
}


if(!function_exists('real_categoryArray')){
    function real_categoryArray(){
        global $database;
        //get a list of the menu items
        $query = "SELECT c.*, c.parent_id AS parent FROM #__rem_main_categories c"
                 ."\n WHERE section='com_realestatemanager' AND published <> -2 ORDER BY ordering";
        $database->setQuery($query);
        $items = $database->loadObjectList();
        //establish the hierarchy of the menu
        $children = array();
        //first pass - collect children
        foreach ($items as $v){
            $pt = $v->parent;
            $list = @$children[$pt] ? $children[$pt] : array();
            array_push($list, $v);
            $children[$pt] = $list;
        }
        //second pass - get an indent list of the items
        $array = realestatemanagerTreeRecurse(0, '', array(), $children);
        return $array;
    }
}

if(!function_exists('mod_real_categoryTreeList')){
    function mod_real_categoryTreeList($id, $action,$is_new, $options = array()){
        global $database;
        $list = real_categoryArray();
        $cat = new mainRealEstateCategories($database);
        $cat->load($id);

        $this_treename = '';
        $childs_ids =  Array();
        foreach ($list as $item){
            if ($item->id == $cat->id || array_key_exists($item->parent_id,$childs_ids)) $childs_ids[$item->id] = $item->id;
        }

        foreach ($list as $item){
            if ($this_treename){
                if ($item->id!=$cat->id && strpos($item->treename, $this_treename) === false
                    && array_key_exists($item->id,$childs_ids) === false){
                        $options[] = mosHTML::makeOption($item->id, $item->treename);
                    }
            } else{
                if ($item->id != $cat->id){
                    $options[] = mosHTML::makeOption($item->id, $item->treename);
                } else{
                    $this_treename = "$item->treename/";
                }
            }
        }

        $parent= null;
        $parent = mosHTML::selectList($options, 'catid', 'class="inputbox" size="1" style="width: 115px"', 'value', 'text', $cat->parent_id);
        return $parent;
    }
}

if ( !function_exists( 'realestatemanagerTreeRecurse') ) {
  /*
* function realestatemanagerTreeRecurse()
* Redefines a standard function to not display &nbsp;
*/
function realestatemanagerTreeRecurse( $id, $indent, $list, $children, $maxlevel=9999, $level=0, $type=1 ) {

  if (@$children[$id] && $level <= $maxlevel) {
      $parent_id = $id;
    foreach ($children[$id] as $v) {
      $id = $v->id;

      if ( $type ) {
        $pre  = " "; //'<sup>|_</sup>_';
        $spacer = '. -- ';
      } else {
        $pre  = "- ";
        $spacer = ' . -';
      }

      if ( $v->parent == 0 ) {
        $txt  = $v->name; 
      } else {
        $txt  = $pre . $v->name; 
      }
      $pt = $v->parent;
      $list[$id] = $v;
      $list[$id]->treename = "$indent$txt";
      $list[$id]->children = count( @$children[$id] );
        $list[$id]->all_fields_in_list = count(@$children[$parent_id]);

      $list = realestatemanagerTreeRecurse( $id, $indent . $spacer, $list, $children, $maxlevel, $level+1, $type );
    }
  }
  return $list;
}
}

global $mosConfig_absolute_path, $mosConfig_allowUserRegistration, $mosConfig_lang, $database;
require_once('./components/com_realestatemanager/compat.joomla1.5.php');

$showDescription = $params->get('showDescription', 0);
$showTitle = $params->get('showTitle', 0);
$showCountry = $params->get('showCountry', 0);
$showRegion = $params->get('showRegion', 0);
$showCity = $params->get('showCity', 0); 
$showDistrict = $params->get('showDistrict', 0); 
$showAddress = $params->get('showAddress', 0);
$showFeature = $params->get('showFeature', 0);
$showBroker = $params->get('showBroker', 0);
$showArea = $params->get('showArea', 0);
$showAgent  = $params->get('showAgent', 0);
$showModel = $params->get('showModel', 0);
$showOwner = $params->get('showOwner', 0);
$showAdvanceSearch = $params->get('showAdvanceSearch', 0);

$moduleclass_sfx=$params-> get('moduleclass_sfx');
$ItemId_tmp_from_params=$params->get ('ItemId');

$categories[] = mosHTML::makeOption(_REALESTATE_MANAGER_LABEL_ALL, _REALESTATE_MANAGER_LABEL_ALL);
$database->setQuery("SELECT id FROM #__menu WHERE link LIKE'%option=com_realestatemanager%' AND params LIKE '%back_button%'");
$ItemId_tmp_from_db = $database->loadResult();
if($ItemId_tmp_from_params=="") $ItemId=$ItemId_tmp_from_db; else $ItemId=$ItemId_tmp_from_params;
$clist = mod_real_categoryTreeList(0,'',true,$categories);

//select list for listing type
$listing_type[]=mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL,_REALESTATE_MANAGER_LABEL_ALL);
$listing_type[]=mosHtml::makeOption(1,_REALESTATE_MANAGER_OPTION_FOR_RENT);
$listing_type[]=mosHtml::makeOption(2,_REALESTATE_MANAGER_OPTION_FOR_SALE);
$listing_type_list = mosHTML :: selectList($listing_type, 'listing_type', 'class="inputbox" size="1" style="width: 100px"', 'value', 'text', _REALESTATE_MANAGER_LABEL_ALL);
$params->def('listing_type_list',$listing_type_list);

//select list for price type
$price_type[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL,_REALESTATE_MANAGER_LABEL_ALL);
$price_type1=explode(',',_REALESTATE_MANAGER_OPTION_PRICE_TYPE);
$i=1; foreach($price_type1 as $price_type2) {$price_type[]=mosHtml::makeOption($i,$price_type2);$i++;}
$price_type_list = mosHTML :: selectList($price_type, 'price_type', 'class="inputbox" size="1" style="width: 140px"', 'value', 'text',_REALESTATE_MANAGER_LABEL_ALL);
$params->def('price_type_list', $price_type_list);

//select list for listing status
$listing_status[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL,_REALESTATE_MANAGER_LABEL_ALL);
$listing_status1=explode(',',_REALESTATE_MANAGER_OPTION_LISTING_STATUS);
$i=1; foreach($listing_status1 as $listing_status2) {$listing_status[]=mosHtml::makeOption($i,$listing_status2);$i++;}
$listing_status_list = mosHTML :: selectList($listing_status, 'listing_status', 'class="inputbox" size="1" style="width: 115px"', 'value', 'text',_REALESTATE_MANAGER_LABEL_ALL);
$params->def('listing_status_list', $listing_status_list);

//select list for property type
$property_type[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL,_REALESTATE_MANAGER_LABEL_ALL);
$property_type1=explode(',',_REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
$i=1; foreach($property_type1 as $property_type2) {$property_type[]=mosHtml::makeOption($i,$property_type2);$i++;}
$property_type_list = mosHTML :: selectList($property_type, 'property_type', 'class="inputbox" size="1" style="width: 115px"', 'value', 'text',_REALESTATE_MANAGER_LABEL_ALL);
$params->def('property_type_list', $property_type_list);

//select list for provider class
$provider_class[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL,_REALESTATE_MANAGER_LABEL_ALL);
$provider_class1=explode(',',_REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
$i=1; foreach($provider_class1 as $provider_class2) {$provider_class[]=mosHtml::makeOption($i,$provider_class2);$i++;}
$provider_class_list = mosHTML :: selectList($provider_class, 'provider_class', 'class="inputbox" size="1" style="width: 115px"', 'value', 'text',_REALESTATE_MANAGER_LABEL_ALL);
$params->def('provider_class_list', $provider_class_list);

//select list for zoning
$zoning[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL,_REALESTATE_MANAGER_LABEL_ALL);
$zoning1=explode(',',_REALESTATE_MANAGER_OPTION_ZONING);
$i=1; foreach($zoning1 as $zoning2) {$zoning[]=mosHtml::makeOption($i,$zoning2);$i++;}
$zoning_list = mosHTML :: selectList($zoning, 'zoning', 'class="inputbox" size="1" style="width: 115px"', 'value', 'text',_REALESTATE_MANAGER_LABEL_ALL);
$params->def('zoning_list', $zoning_list);

//select list for style
$style[] = mosHtml::makeOption(_REALESTATE_MANAGER_LABEL_ALL,_REALESTATE_MANAGER_LABEL_ALL);
$style1=explode(',',_REALESTATE_MANAGER_OPTION_STYLE);
$i=1; foreach($style1 as $style2) {$style[]=mosHtml::makeOption($i,$style2);$i++;}
$style_list = mosHTML :: selectList($style, 'style', 'class="inputbox" size="1" style="width: 115px"', 'value', 'text',_REALESTATE_MANAGER_LABEL_ALL);
$params->def('style_list', $style_list);

//year
$year[] = mosHTML :: makeOption(_REALESTATE_MANAGER_LABEL_FROM, _REALESTATE_MANAGER_LABEL_FROM);
$year_to[] = mosHTML :: makeOption(_REALESTATE_MANAGER_LABEL_TO, _REALESTATE_MANAGER_LABEL_TO);
for($i=date('Y');$i>=1900;$i--){
    $year[] = mosHTML :: makeOption($i, $i);
    $year_to[] = mosHTML :: makeOption($i, $i);
}
$yearlist = mosHTML :: selectList($year, 'yearfrom', 'class="inputbox" size="1" style="width: 90px"', 'value', 'text');
$yearlistto = mosHTML :: selectList($year_to, 'yearto', 'class="inputbox" size="1" style="width: 89px"', 'value', 'text');

//price 
$query = "SELECT price FROM #__rem_houses";
$database->setQuery($query);
$prices = $database->loadColumn();
rsort($prices,SORT_NUMERIC);
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
        $i = $i + $stepFinalPrice ;
        $price_to[] = mosHTML :: makeOption($i, $i);

$pricelist = mosHTML :: selectList($price, 'pricefrom', 'class="inputbox" size="1" style="width: 87px"', 'value', 'text');
$pricelistto = mosHTML :: selectList($price_to, 'priceto', 'class="inputbox" size="1" style="width: 89px"', 'value', 'text');
global $mosConfig_live_site;
//$link = sefRelToAbs("index.php?option=com_realestatemanager&amp;task=search_villa&amp;catid=0&amp;Itemid=".$ItemId);
$link = $mosConfig_live_site . "/villas/search_villa/";

// cities
$whereclause = '';
if($REQUEST['region'] != null && $REQUEST['region'] != ''){
	$whereclause = "WHERE hregion='".$REQUEST['region']."'";
}
$getCities = " SELECT DISTINCT(hcity) FROM #__rem_houses ". $whereclause ." ORDER BY hcity ASC";
$database->setQuery($getCities);
$cities = $database->loadObjectList();

?>

<script>
	
	/**
	 * Obter cidades por regiao selecionada
	 */
	function getCities($i){
		(function($){
			$.ajax ({
				url: '<?php echo $mosConfig_live_site; ?>/villas/ajax_get_cities/?region='+$i,
				type: 'GET'
			}).done(function(data){
				var cities = JSON.parse($(data).find("result").text());
				var options = $("#City");
				options.html(''); // fr toutes les villes
				options.append($("<option />").val("").text("<?php echo _REALESTATE_MANAGER_ALL_CITIES; ?>").attr("default", "default").attr("selected", "selected"));
				$.each(cities, function() {
					console.log(this.hcity);
					options.append($("<option />").val(this.hcity).text(this.hcity));
				});
			});
		})(jQuery);
	}
	
</script>

<!-- SEARCH & BOOK -->
<h4 id="title-search"><?php echo _REALESTATE_MANAGER_ADMIN_SALE_MANAGER;?></h4>
<div class="com_realestatemanager<?php echo $moduleclass_sfx;?>">
    <form action="<?php echo $link; ?>" method="post" name="mod_realestatlibsearchForm">
        <!-- PESQUISA NOME, CIDADE, REGIAO, PAIS
	-->
	<div class="search_houses">
	    <div class="search_regions">
			<!-- All regions -->
		   <?php
                $provider_class[0] = _REALESTATE_MANAGER_OPTION_SELECT;
                $provider_class1 = explode(',', _REALESTATE_MANAGER_ADMIN_REQUEST_RENT);
                $i = 1;
                foreach ($provider_class1 as $provider_class2) {
                    $provider_class[$i] = $provider_class2;
                    $i++;
                }
            ?>
       
		<?php //echo "SEARCH BY CITY,REGION,COUNTRY OR VILLA NAME"//echo _REALESTATE_MANAGER_SEARCH_DESC1; ?>
		<div class="search-title"><?php echo _REALESTATE_MANAGER_LABEL_REGION;?></div>
		<label id="search-label-regions">
		    <select id="search-selet-regions" name="Region" onchange="getCities(value)">
			<option value="all"><?php echo $provider_class[1]; ?></option>
			<option value="north"><?php echo $provider_class[2]; ?></option>
			<option value="center"><?php echo $provider_class[3]; ?></option>
			<option value="lisbon"><?php echo $provider_class[4]; ?></option>
			<option value="alentejo"><?php echo $provider_class[5]; ?></option> 
			<option value="algarve"><?php echo $provider_class[6]; ?></option>
			<option value="madeira"><?php echo $provider_class[7]; ?></option> 
		    </select>
		</label>
		
	    </div>
	    <div class="search_title">
		<?php //echo "KEYWORD: SEARCH BY CITY,REGION,COUNTRY OR VILLA NAME"//echo _REALESTATE_MANAGER_SEARCH_DESC1; ?>
		<div class="search-title"><?php echo _REALESTATE_MANAGER_LABEL_CITY;?></div>   
		<!--<input id="search-keyword" class="inputbox input-medium" placeholder='<?php echo _REALESTATE_MANAGER_SHOW_SUGGESTION_MANAGER;?>' type="text" name="City" size="15" maxlength="20"/>-->
		<label id="search-label-regions" style="height:69px"> 
	                            <select name="City" id="City">
	                            		<option value="" selected default><?php echo _REALESTATE_MANAGER_ALL_CITIES; ?></option>
	                            		 <?php for($i=0; $i<count($cities); $i++){
	                                    	if($cities[$i]->hcity != ''){?> 
	                                    		<option value="<?php echo $cities[$i]->hcity; ?>" <?php if($_REQUEST['City'] == $cities[$i]->hcity) echo 'selected'; ?>><?php echo $cities[$i]->hcity; ?></option>
		                        		 <?php  }} ?>
	                            </select>
	                     </label>
	    </div>
        </div>
        <!-- PESQUISA DATA CHEGADA -- DATA PARTIDA
	-->
	<?php if($params->get('rent') == 0){ ?>
            <div class="search_rent">
		    <div id="search-title-arrival" class="">  <!-- class search-title VMT 28-02-2016 -->
			 <?php echo _REALESTATE_MANAGER_LABEL_ARRIVAL." ";?>                                           
			   <!-- onfocus="this.setAttribute('type','date');" -->                       
			</div>
			<input id="search-arrival" placeholder='<?php echo _REALESTATE_MANAGER_ADMIN_IMPEXP;?>' type="text" class="dp" autocomplete="off" readonly="readonly" name="Arrival" max="5000-12-31" size="15" maxlength="20">
		    
		    <div id="search-title-departure" class="search-title"><?php echo _REALESTATE_MANAGER_LABEL_DEPARTURE;?></div><input id="search-departure" class="dp" autocomplete="off" readonly="readonly" placeholder='<?php echo _REALESTATE_MANAGER_ADMIN_IMPEXP;?>' type="text" name="Departure" min="2000-01-02" size="15" maxlength="20">
		    
		    <?php
		    //
		    // HOMEPAGE OU RESTANTES PAGINAS
		    //
		    // ($showBroker == 0 || $showBroker == 1) 
		   // if($task == 'getSpotlight') { 
		    //	echo "::::::::: ".$task;
			?>
		    <!-- N Pessoas -->
			<div id="search-title-persons" class="search-title"><?php echo _REALESTATE_MANAGER_LABEL_BROKER;?></div>
			<label id="search-label-regions" style="height: initial !important">
				    <select id="search-selet-regions" name="Broker">
							<?php
                                for($i=1; $i<=30; $i++){
                                    echo '<option value="'.$i.'"';
                                    if($_REQUEST['Broker'] == $i)
                                    	echo " selected";
                                        echo '>'.$i.'</option>';
                                 }
                               ?>
					</select>
			</label>
			<!--  <input id="search-persons" type="number" min="1" placeholder="100" size="15" name="Broker" maxlength="20"/>  -->
			
			<!-- ADVANCED SEARCH -->
		    <!-- SEARCH ON MAP -->
			<!-- FR || EN -->
			<?php if(_REALESTATE_MANAGER_ADMIN_SALE_MANAGER == 'Search & book'){ ?>
				<a id="search-advancedsearch" href="<?php echo $mosConfig_live_site; ?>/villas/search_villa"><?php echo _REALESTATE_MANAGER_LABEL_ADVANCED_SEARCH; ?></a>
				<a id="search-mapsearch" href="<?php echo $mosConfig_live_site; ?>/villas/search_villa/map"><?php echo _REALESTATE_MANAGER_ADMIN_ABOUT; ?></a>
		    <?php } else {?>
				<a id="search-advancedsearch" href="<?php echo $mosConfig_live_site; ?>/fr/villas/search_villa"><?php echo _REALESTATE_MANAGER_LABEL_ADVANCED_SEARCH; ?></a>
				<a id="search-mapsearch" href="<?php echo $mosConfig_live_site; ?>/fr/villas/search_villa/map"><?php echo _REALESTATE_MANAGER_ADMIN_ABOUT; ?></a>
		    <?php }?>
			
			<?php
		//    }else{
		    ?>
		    
		  <!--    
		     <div class="row_text">
		    	<!-- WCs 
		     	<div style="float:left;width:45%;margin-top:-25px;margin-bottom:-25px">
			     	<div><?php echo _REALESTATE_MANAGER_LABEL_BATHROOMS;?></div>
					<label id="search-label-regions" style="height: initial !important">
						    <select id="search-selet-regions" name="Bathrooms">
									<?php
		                                for($i=1; $i<=20; $i++){
		                                    echo '<option value="'.$i.'"';  
		                                    if($_REQUEST['Bathrooms'] == $i)
		                                    	echo " selected";
		                                        echo '>'.$i.'</option>';
		                                 }
		                               ?>
							</select>
					</label> 
				</div>
				<!-- Quartos
				<div style="float:right;margin-top:-25px;width:45%;"> 
					<div><?php echo _REALESTATE_MANAGER_LABEL_BEDROOMS;?></div>
					<label id="search-label-regions" style="height: initial !important">
						    <select id="search-selet-regions" name="Bedrooms">
									<?php
		                                for($i=1; $i<=20; $i++){
		                                    echo '<option value="'.$i.'"';
		                                    if($_REQUEST['Bedrooms'] == $i)
		                                    	echo " selected";
		                                        echo '>'.$i.'</option>';
		                                 }
		                               ?>
							</select>
					</label> 
			    </div>
		    </div>
		     <div class="row_text">
		    	<!-- N Pessoas
		     	<div style="float:left;width:45%;">
			     	<div><?php echo _REALESTATE_MANAGER_LABEL_BROKER;?></div>
					<label id="search-label-regions" style="height: initial !important">
						    <select id="search-selet-regions" name="Broker">
									<?php
		                                for($i=1; $i<=30; $i++){
		                                    echo '<option value="'.$i.'"';
		                                    if($_REQUEST['Broker'] == $i)
		                                    	echo " selected";
		                                        echo '>'.$i.'</option>';
		                                 }
		                               ?>
							</select>
					</label> 
				</div>
				<!-- Max Value
				<div style="float:right;margin-top:-25px;width:45%;"> 
					<div><?php echo _REALESTATE_MANAGER_LABEL_SELECT_CATEGORIES;?></div>
					<label id="search-label-regions" style="height: initial !important">
						    <select name="Price" id="Price">
	                            	<?php if($languagelocale == 'fr-FR'){ ?>
	                               		<option value="" selected default><?php echo "illimité"; ?></option>
	                                <?php  } else{ ?>
	                                	<option value="" selected default><?php echo "unlimited"; ?></option>
	                                <?php  } ?>
			               				 <?php for($i=1000; $i<=10000; $i+=1000){ ?>
	                                    	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		                        		 <?php  } ?>
	                            </select>
					</label> 
			    </div>
			    </div>
		     	<br>efverv
		     	<br>erfverv
		     	<br>ervergvytjyu
		     	<br>uikui,mu
		     	<br>werrrw
		     	<br>cvbbvvb
		    <?php
		  //  }	
		    ?>
		    -->
			
			<!--_REALESTATE_MANAGER_LABEL_AVAILABLE_FOR_RENT.':<br>'.
		    
		    REMOVIDO
		    
                    JHtml::_('calendar','','search_date_from','search_date_from1','%Y-%m-%d', array('size'=>'17')).
		    JHtml::_('calendar','','search_date_until','search_date_until1','%Y-%m-%d', array('size'=>'17'))
; ?> -->
            </div>
        <?php } if($params->get('year') == 0){ ?>
            <div class="search_year">
                    <?php echo _REALESTATE_MANAGER_LABEL_YEAR.':&nbsp;'.$yearlist.$yearlistto; ?>
            </div>
        <?php } if($params->get('price') == 0){ ?>
            <div class="search_price">
                    <?php echo _REALESTATE_MANAGER_LABEL_PRICE.':&nbsp;'.$pricelist.$pricelistto; ?>
            </div>
        <?php } ?>
 <div class="search_select">
            <!-- CATEGORIA OUT !!!!!!!!!!!!!!!!! <div class="search_category">
                    <?php //echo _REALESTATE_MANAGER_LABEL_CATEGORY . ':&nbsp;'. $clist;?>&nbsp;
            </div>-->

  <?php if($params->get('listing_status_list') == 0){?>
            <div>
                    <?php echo _REALESTATE_MANAGER_LABEL_LISTING_STATUS . ':&nbsp;'. $listing_status_list; ?>&nbsp;  
            </div>
  <?php }?>
  <?php if($params->get('property_type_list') == 0){?>
            <div class="search_property">
                    <?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TYPE . ':&nbsp;'. $property_type_list; ?>&nbsp;  
            </div>
  <?php }?>
  <?php if($params->get('provider_class_list') == 0){?>
            <div class="search_provider">
                    <?php echo _REALESTATE_MANAGER_LABEL_PROVIDER_CLASS . ':&nbsp;'. $provider_class_list; ?>&nbsp;  
            </div>
  <?php }?>
  <?php if($params->get('zoning_list') == 0){?>
            <div class="search_zoning">
                    <?php echo _REALESTATE_MANAGER_LABEL_ZONING . ':&nbsp;'. $zoning_list; ?>&nbsp;  
            </div>
  <?php }?>
  <?php if($params->get('style_list') == 0){?>
            <div class="search_style">
                    <?php echo _REALESTATE_MANAGER_LABEL_STYLE . ':&nbsp;'. $style_list; ?>&nbsp;  
            </div>
  <?php }?>
</div>
<div>
<div class="search_checkbox">
        <?php /*if($showDescription==0){?>
            <div class="search_description">
                    <?php echo _REALESTATE_MANAGER_LABEL_COMMENT ?>:&nbsp;<input type="checkbox" name="Description" checked="checked">
            </div>
        <?php } elseif($showDescription==1){ ?>
            <input type="hidden" name="Description" value="on">
        <?php } ?>

        <?php if($showTitle==0){ ?>
            <div class="search_title">
                    <?php echo _REALESTATE_MANAGER_LABEL_TITLE ?>:&nbsp;<input type="checkbox" name="Title" checked="checked">
            </div>
        <?php } elseif($showTitle==1){ ?>
            <input type="hidden" name="Title" value="on">
        <?php } ?>

        <?php if($showCountry==0){ ?>
            <div class="search_country">
                    <?php echo _REALESTATE_MANAGER_LABEL_COUNTRY; ?>:&nbsp;<input type="checkbox" name="Country" checked="checked">
            </div>
        <?php } elseif($showCountry==1){?>
            <input type="hidden" name="Country" value="on">
        <?php } ?>

        <?php if($showRegion==0){ ?>
            <div class="search_region">
                    <?php echo _REALESTATE_MANAGER_LABEL_REGION; ?>:&nbsp;<input type="checkbox" name="Region" checked="checked">
            </div>
        <?php } elseif($showRegion==1){ ?>
            <input type="hidden" name="Region" value="on">
        <?php }?>

        <?php if($showCity==0){?>
            <div class="search_city">
                    <?php echo _REALESTATE_MANAGER_LABEL_CITY; ?>:&nbsp;<input type="checkbox" name="City" checked="checked">
            </div>
        <?php } elseif($showCity==1){ ?>
            <input type="hidden" name="City" value="on">
        <?php }?>

        <?php if($showDistrict==0){?>
            <div class="search_district">
                    <?php echo _REALESTATE_MANAGER_LABEL_DISTRICT; ?>:&nbsp;<input type="checkbox" name="District" checked="checked">
            </div>
        <?php } elseif($showDistrict==1){ ?>
            <input type="hidden" name="District" value="on">
        <?php }?>

        <?php if($showAddress==0){?>
            <div class="search_address">
                    <?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>:&nbsp;<input type="checkbox" name="Address" checked="checked">
            </div>
        <?php } elseif($showAddress==1){ ?>
            <input type="hidden" name="Address" value="on">
        <?php }?>

        <?php if($showFeature==0){?>
            <div class="search_feature">
                    <?php echo _REALESTATE_MANAGER_LABEL_FEATURE; ?>:&nbsp;<input type="checkbox" name="Feature" checked="checked">
            </div>
        <?php } elseif($showFeature==1){ ?>
            <input type="hidden" name="Feature" value="on">
        <?php }*/?>

  <?php /*if($showBroker==0){?>
  <div class="search_broker">
      <?php echo _REALESTATE_MANAGER_LABEL_BROKER; ?>:&nbsp;<input type="checkbox" name="Broker" checked="checked">
  </div>
  <?php } elseif($showBroker==1){?>
  <input type="hidden" name="Broker" value="on">
  <?php }*/?>

   <?php if($showArea==0){?>
  <div class="search_area">
      <?php echo _REALESTATE_MANAGER_LABEL_AREA; ?>:&nbsp;<input type="checkbox" name="Area" checked="checked">
  </div>
<noscript>Javascript is required to use Real Estate Manager <a href="http://ordasoft.com/Real-Estate-Manager/realestatemanager-basic-and-pro-feature-comparison.html">Real estate manager Joomla extension for Real Estate Brokers, Real Estate Companies and other Enterprises selling Real estate
</a>, <a href="http://ordasoft.com/Real-Estate-Manager/realestatemanager-basic-and-pro-feature-comparison.html">Real Estate Manager create own real estate web portal for sell, rent,  buy real estate and property</a></noscript>
  <?php } elseif($showArea==1){?>
  <input type="hidden" name="Area" value="on">
  <?php }?>

    <?php if($showAgent==0){?>
  <div class="search_agent">
      <?php echo _REALESTATE_MANAGER_LABEL_AGENT; ?>:&nbsp;<input type="checkbox" name="Agent" checked="checked">
  </div>
  <?php } elseif($showAgent==1){?>
  <input type="hidden" name="Agent" value="on">
  <?php }?>

  <?php if($showModel==0){?>
  <div class="search_model">
      <?php echo _REALESTATE_MANAGER_LABEL_MODEL; ?>:&nbsp;<input type="checkbox" name="Model" checked="checked">
  </div>
  <?php } elseif($showModel==1){?>
  <input type="hidden" name="Model" value="on">
  <?php }?>

        <?php if($showOwner==0){?>
            <div class="search_owner">
                    <?php echo _REALESTATE_MANAGER_LABEL_OWNER ?>:&nbsp;<input type="checkbox" name="Ownername" checked="checked">
            </div>
        <?php } elseif($showOwner==1){ ?>
            <input type="hidden" name="Ownername" value="on">
        <?php }?>
</div>
<!-- BOTAO SEARCH -->
<div>
            <div class="search_button">
                    <div style="margin: 1px;padding: 1px;">
                        <button id="btn-search" class="btn" type="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_SEARCH_BUTTON; ?>" class="button"  > <i class="glyphicon glyphicon-search"></i> <?php echo _REALESTATE_MANAGER_LABEL_SEARCH_BUTTON; ?></button>
                    </div>
      <?php if($showAdvanceSearch==0){
        //$link1 ="index.php?option=com_realestatemanager&amp;task=show_search&amp;catid=0&amp;Itemid=".$ItemId;
	$link1 = "$mosConfig_live_site/villas/search_villa";
      ?>
    <div style="line-height: 0.9em">
        <a id="url-advanced-search" href="<?php echo sefRelToAbs($link1); ?>"><?php echo _REALESTATE_MANAGER_LABEL_ADVANCED_SEARCH; ?></a>
    </div>
      <?php } ?>
                    <input type="hidden" name="option" value="com_realestatemanager" />
                    <input type="hidden" name="task" value="search_villa" />
                    <input type="hidden" name="Itemid" value="<?php echo $ItemId ?>" />
  </div>
</form>
</div>