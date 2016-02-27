<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
 *
 * @package  RealEstateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com) 
 * Homepage: http://www.ordasoft.com
 * @version: 3.0 Pro
 *
 * */
//require_once($mosConfig_absolute_path . "/libraries/joomla/plugin/helper.php");
jimport( 'joomla.plugin.helper' );
if (version_compare(JVERSION, "3.0.0", "lt"))
    jimport('joomla.html.toolbar');

require_once($mosConfig_absolute_path . "/components/com_realestatemanager/functions.php");
require_once($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.php");
//require_once($mosConfig_absolute_path."/administrator/components/com_realestatemanager/menubar_ext.php");

$mosConfig_live_site = JURI::root(true); //for 1.6
$GLOBALS['mosConfig_live_site'] = $mosConfig_live_site;
$GLOBALS['mosConfig_absolute_path'] = $mosConfig_absolute_path; //for 1.6
// for J 1.6
$mainframe = JFactory::getApplication();
$GLOBALS['mainframe'] = $mainframe;

$templateDir = JPATH_THEMES . DS . JFactory::getApplication()->getTemplate() . DS;
$GLOBALS['templateDir'] = $templateDir;
$doc = JFactory::getDocument();
$GLOBALS['doc'] = $doc;
$g_item_count = 0;

class HTML_realestatemanager {

    static function showCrumbs($page_task, $region = '', $region_label='', $city='', $title='', $id=''){
        global $languagelocale, $mosConfig_live_site;
        
        //echo $_SESSION['referer'];
        if(stripos($_SERVER['REQUEST_URI'], 'villas/view')){
        	//echo $_SERVER['REQUEST_URI'];
        	
        	$page_task = $_SESSION['referer'];
        }
        
        if($languagelocale == 'fr-FR'){
            $home_label = "ACCUEIL";
            switch($page_task){
                case 'search_villa':
                    $label = 'RECHERCHE DE VILLAS';
                    break;
                case 'best_of':
                    $label = 'NOTRE SELECTION';
                    break;
                case 'favorites':
                    $label = 'FAVORIS';
                    break;
                case 'for_sale':
                    $label = '&Agrave; VENDRE';
                    break;
            }
        }else{
            $home_label = "HOME";
            $label = str_replace("_", " ", $page_task);
        }
        
        ?>
        <div id="main-Breadcrumbs"
        <?php
        if($id   != ''){
            echo ' class="view_house_breadcrumbs"';
        }
        ?>
        >
                <div id="visible-breadcrumbs">
                    <a href="index.php"><?php echo $home_label; ?></a> <img src="/allure/media/system/images/arrow.png" alt="">
                    <a href="<?php echo $mosConfig_live_site . "/villas/" . $page_task; ?>"><?php echo $label; ?></a>
                    <?php if($region != '') { ?>
                        <img src="/allure/media/system/images/arrow.png" alt=""> <a href="<?php echo $mosConfig_live_site . "/villas/" . $page_task; ?>/?Region=<?php echo $region; ?>"><?php 
                        echo $region_label; ?></a>
                    <?php } ?>
                    <?php if($city != '') { ?>
                        <img src="/allure/media/system/images/arrow.png" alt=""> <a href="<?php echo $mosConfig_live_site . "/villas/" . $page_task; ?>/?City=<?php echo $city; ?>"><?php echo $city; ?></a>
                    <?php } ?>
                    <?php if($title != '') { ?>
                        <img src="/allure/media/system/images/arrow.png" alt=""> <a href="<?php echo $mosConfig_live_site . "/villas/view/" . $id; ?>"><?php echo $title; ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php
    }
    
    static function getPublishedHouses($spotlight){
    	$counter = 5;
    	/**foreach($spotlight as $row){
    		if($row->published == "1"){
    			$counter--;
    		}
    	}*/
    	echo "PUB: ".$counter;	
    }	

    static function showSpotlights($spotlight){
        global $mosConfig_live_site, $option, $task;
        
        
         if( $task == 'search_villa'){ 
         	//echo "EEEE: ".$task;
         	?>
         	<div id="inner-spotlight" class="inner-spotlight-searchvilla">
          <?php } else { ?>
	        <div id="inner-spotlight">
          <?php } ?>
        
            <?php //print_r($spotlight);
        
        
            if(count($spotlight)){  
                ?>
                <h2><?php echo _REALESTATE_MANAGER_IN_SPOTLIGHTS; ?></h2>
                <table>
                    <tr>
                        <?php
                        foreach($spotlight as $row){
                        	//if($row->published == "1"){ 
                            $option = 'com_realestatemanager';
                            //$link = 'index.php?option=' . $option . '&amp;task=view&amp;id=' . $row->id . '&amp;catid=46&amp;Itemid=' . $Itemid;
                            $link = $mosConfig_live_site . "/villas/view/" . $row->id;
                            $imageURL = $row->image_link;
                            ?>
                            <td>
                                <div id="inner-spotlight-image-<?php echo $row->id;?>" class="inner-spotlight-image" style="height:105px">
                                    <?php
                                    if ($imageURL != '') {
                                        $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, 600, 800);//$realestatemanager_configuration['fotogallery']['high'], $realestatemanager_configuration['fotogallery']['width']);
                                        $file = $mosConfig_live_site . '/components/com_realestatemanager/photos/' . $file_name;
                                        //echo '<img alt="' . $row->htitle . '" title="' . $row->htitle . '" src="' . $file . '" border="0" class="little" style="width:'.$realestatemanager_configuration['fotogallery']['high'].'px;">';
                                        echo '<img alt="' . $row->htitle . '" title="' . $row->htitle . '" src="' . $file . '" border="0" class="little" style="width:150px;">';
                                    } else {
                                        echo '<img alt="' . $row->htitle . '" title="' . $row->htitle . '" src="' . $mosConfig_live_site . '/components/com_realestatemanager/images/';
                                        echo _REALESTATE_MANAGER_NO_PICTURE;
                                        echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE . '" border="0"  />';
                                    }
                                    ?>
                                    <div id="inner-spotlight-details-<?php echo $row->id;?>" class="inner-spotlight-details">
                                        <div class="inner-spotlight-title"><?php echo $row->htitle;?></div>
                                        <div class="inner-spotlight-city">
                                        <?php
                                        
                                        echo "<a href='".$mosConfig_live_site."/villas/search_villa/?Region=".$row->hregion."'>".$row->region."</a>";
                                        echo " > ";
                                        echo "<a href='".$mosConfig_live_site."/villas/search_villa/?City=".$row->hcity."'>".$row->hcity."</a>";
                                        
                                        ?>
                                            
                                        </div>
                                        <!--</div>
                                        <div class="inner-spotlight-link">-->
                                        <a class="view_this_villa" href="<?php echo $link;?>"><?php echo strtoupper(_REALESTATE_MANAGER_LABEL_VIEW_VILLA); ?></a>
                                    </div>
                                </div>
                                
                            </td>
                            <?php
                        	//} //published    
                        }
                        ?>    
                    </tr>
                </table>
                <?php                 
           }
            ?>
        </div>
        <?php
    }
    
    static function editHouse($option, & $row, & $clist, & $rating, & $delete_edoc, & $price_type_list, & $listing_status_list, & $property_type_list, & $listing_type_list, & $provider_class_list, & $zoning_list, & $style_list, & $house_photo, & $house_photos, & $house_rent_sal, & $house_feature, & $currency, & $languages, & $extra_list) {
        global $realestatemanager_configuration;
        global $my, $mosConfig_live_site, $mainframe, $Itemid, $doc;
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');




        $acl = JFactory::getACL();
        ?>

        <script language="javascript" type="text/javascript">
            function findPosY(obj) {
                var curtop = 0;
                if (obj.offsetParent) {
                    while (1) {
                        curtop+=obj.offsetTop;
                        if (!obj.offsetParent) {
                            break;
                        }
                        obj=obj.offsetParent;
                    }
                } else if (obj.y) {
                    curtop+=obj.y;
                }
                return curtop-20;
            }
            function trim(string){
                return string.replace(/(^\s+)|(\s+$)/g, "");
            }

            function submitbutton(pressbutton) {
                var form = document.save_add;
                if (pressbutton == 'submit2') {
                    if (trim(form.houseid.value) == '') {
                        window.scrollTo(0,findPosY(document.getElementById('houseid_label')));
                        alert("<?php echo _REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_HOUSEID_CHECK; ?>" );
                        return;
                    } else if (form.catid.value == ''){
                        window.scrollTo(0,findPosY(document.getElementById('category_label')));
                        alert("<?php echo _REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_CATEGORY; ?>");
                        return;
                    } else if (form.htitle.value == ''){
                        window.scrollTo(0,findPosY(document.getElementById('title_label')));
                        alert("<?php echo _REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_TITLE; ?>");
                        return;
                    } else{
                        form.submit();
                    }
                } else form.submit();
                form.submit();
            }
            </script>
        <?php
        if ($option != 'com_realestatemanager') {
            $form_action = "index.php?option=" . $option . "&task=save_add&is_show_data=1&tab=getmyhousesTab&Itemid=" . $Itemid . '#tabs-2';
        }
        else
            $form_action = "index.php?option=" . $option . "&task=save_add&Itemid=" . $Itemid;
        ?>
        <form action="<?php echo sefRelToAbs($form_action); ?>" method="post" name="save_add" id="save_add" enctype="multipart/form-data">

            <div class="admin_table_47">

                <div class="row_add_house">
                    <span class="warning_login">
                        <?php if (!isset($my->email)) : ?>
                            <?php echo _REALESTATE_MANAGER_WARNING_NO_LOGIN; ?>
                        <?php else: ?>
                            <input type="hidden" name="owneremail" value="<?php echo $my->email; ?>"/>
                        <?php endif; ?>
                    </span>

                    <input type="hidden" name="id" value="<?php echo $row->id; ?>"/>
                   
                           
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?>:</span>
                    <input class="inputbox" type="text" name="houseid" size="20" maxlength="20" value="<?php echo $row->houseid; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_COMMENT; ?>:</span>
                    <div class="editor_area"><?php editorArea('editor1', $row->description, 'description', 500, 250, '70', '10', false); ?></div>
                    <!--<textarea name="description" cols="50" rows="8" ><?php //echo $row->description;  ?></textarea>-->
                </div>

                <?php if ($realestatemanager_configuration['edocs']['allow']) { ?>

                    <div class="row_add_house">
                        <span><?php echo _REALESTATE_MANAGER_LABEL_EDOCUMENT_UPLOAD; ?>:</span>
                        <input class="inputbox" type="file" name="edoc_file" value="" size="25" maxlength="250" onClick="document.save_add.edok_link.value ='';"/>
                    </div>

                    <div class="row_add_house">
                        <span><?php echo _REALESTATE_MANAGER_LABEL_EDOCUMENT_UPLOAD_URL; ?>:</span>
                        <input class="inputbox" type="text" name="edok_link" value="<?php echo $row->edok_link; ?>" size="50" maxlength="250"/>
                    </div>

                <?php } if (strlen($row->edok_link) > 0) { ?>
                    <div class="row_add_house">
                        <span><?php echo _REALESTATE_MANAGER_LABEL_EDOCUMENT_DELETE; ?>:</span>
                        <span><?php echo $delete_edoc; ?></span>
                    </div>
                <?php } ?>

                <hr size="2" width="100%" />

                <h3><?php echo _REALESTATE_MANAGER_HEADER_REQUIREMENT_FIELDS; ?></h3>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?>:</span>
                    <span><?php echo $clist; ?></span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?>:</span>
                    <input class="inputbox" type="text" name="htitle" size="60" value="<?php echo $row->htitle; ?>" />
                </div>

                <hr size="2" width="100%" />

                <h3><?php echo _REALESTATE_MANAGER_HEADER_ADDRESS_FIELDS; ?></h3>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_COUNTRY; ?>:</span>
                    <input class="inputbox" type="text" id="hcountry" name="hcountry" size="30" value="<?php echo $row->hcountry; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_REGION; ?>:</span>
                    <input class="inputbox" type="text" id="hregion" name="hregion" size="30" value="<?php echo $row->hregion; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_CITY; ?>:</span>
                    <input class="inputbox" type="text" id="hcity" name="hcity" size="30" value="<?php echo $row->hcity; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_DISTRICT; ?>:</span>
                    <input class="inputbox" type="text" id="hdistrict" name="hdistrict" size="30" value="<?php echo $row->hdistrict; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_ZIPCODE; ?>:</span>
                    <input class="inputbox" type="text" id="hzipcode" name="hzipcode" size="30" value="<?php echo $row->hzipcode; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>:</span>
                    <input class="inputbox" type="text" id="hlocation" name="hlocation" size="60" value="<?php echo $row->hlocation; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_LATITUDE; ?>:</span>
                    <input class="inputbox" type="text" id="hlatitude" name="hlatitude" size="20" value="<?php echo $row->hlatitude; ?>" readonly/>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_LONGITUDE; ?>:</span>
                    <input class="inputbox" type="text" id="hlongitude" name="hlongitude" size="20" value="<?php echo $row->hlongitude; ?>" readonly/>
                    <input type="hidden" id="map_zoom" name="map_zoom" value="<?php echo $row->map_zoom; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_GEOCOOR; ?></span>
                    <input type="button" value="<?php echo _REALESTATE_MANAGER_BUTTON_SHOW_ADDRESS; ?>" onclick="codeAddress()">
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_CLICKMAP; ?>:</span>

                    <div id="map_canvas" class="re_map_canvas"></div>
                    <!--Image google map-->
                    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
                    <script type="text/javascript">
                        var map;
                        var lastmarker = null;
                        var marker = null;
                        var mapOptions;
                					    
                        var myOptions = {
                            zoom: <?php if ($row->map_zoom) echo $row->map_zoom;
                                        else echo 1;?>,
                                                         center: new google.maps.LatLng(<?php if ($row->hlatitude) echo $row->hlatitude; else echo 0; ?>,<?php if ($row->hlongitude) echo $row->hlongitude; else echo 0; ?>),
                                                         scrollwheel: false,
                                                         zoomControlOptions: {
                                                             style: google.maps.ZoomControlStyle.LARGE
                                                         },
                                                         mapTypeId: google.maps.MapTypeId.ROADMAP
                                                     };
                                                     var geocoder = new google.maps.Geocoder();
                                                     var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                                                     var bounds = new google.maps.LatLngBounds ();
        <?php if ($row->hlatitude && $row->hlongitude) {
            ?>
                    //Set the marker coordinates
                    var lastmarker = new google.maps.Marker({
                        position: new google.maps.LatLng(<?php echo $row->hlatitude; ?>, <?php echo $row->hlongitude; ?>)
                    });
                    lastmarker.setMap(map);
        <?php } ?>   
                //If the zoom, then store it in the field map_zoom
                google.maps.event.addListener(map,"zoom_changed", function(){
                    document.getElementById("map_zoom").value=map.getZoom();
                });
                google.maps.event.addListener(map,"click", function(e){
                    //Initialize marker
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(e.latLng.lat(),e.latLng.lng())
                    });
                    //Delete marker
                    if(lastmarker) lastmarker.setMap(null);;
                    //Add marker to the map
                    marker.setMap(map);
                    //Output marker information
                    document.getElementById("hlatitude").value=e.latLng.lat();
                    document.getElementById("hlongitude").value=e.latLng.lng();
                    //Memory marker to delete
                    lastmarker = marker;
                });
                								
                								
                function updateCoordinates(latlng)
                {
                    if(latlng) 
                    {
                        document.getElementById('hlatitude').value = latlng.lat();
                        document.getElementById('hlongitude').value = latlng.lng();
                        document.getElementById("map_zoom").value=map.getZoom();
                    }
                }



                function toggleBounce() {

                    if (marker.getAnimation() != null) {
                        marker.setAnimation(null);
                    } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                }


                function codeAddress() {
                    myOptions = {
                        zoom:14,
                        scrollwheel: false,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.LARGE
                        },
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                    //var address = document.getElementById('vlocation').value + " " + document.getElementById('country').value+ " " + document.getElementById('region').value+ " " + document.getElementById('city').value+ " " + document.getElementById('zipcode').value;
                    var address = document.getElementById('hlocation').value + " " + document.getElementById('hcountry').value+ " " + document.getElementById('hregion').value+ " " + document.getElementById('hcity').value+ " " + document.getElementById('hzipcode').value + " " + document.getElementById('hlatitude').value + " " + document.getElementById('hlongitude').value;
                    geocoder.geocode( { 'address': address}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            map.setCenter(results[0].geometry.location);
                            updateCoordinates(results[0].geometry.location);
                            if (marker) marker.setMap(null);
                            marker = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location,
                                draggable: true,
                                animation: google.maps.Animation.DROP
                            });
                            google.maps.event.addListener(marker, 'click', toggleBounce);
                            google.maps.event.addListener(marker, "dragend", function() {
                                updateCoordinates(marker.getPosition());
                            });
                						
                					

                        } else {
                            alert("Please check the accuracy of Address");
                        }
                    });
                }

                    </script>
                </div>

                <h3><?php echo _REALESTATE_MANAGER_HEADER_RECOMMENDED_FIELDS; ?></h3>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_LISTING_TYPE; ?>:</span>
                    <span><?php echo $listing_type_list; ?></span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_PRICE; ?>:</span>
                    <input class="inputbox" type="text" name="price" size="15" value="<?php echo $row->price; ?>" />
            <!--<input class="inputbox" type="text" name="priceunit" size="15" value="<?php //echo $row->priceunit;  ?>" />-->
        <?php echo $currency; ?>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_PRICE_TYPE; ?>:</span>
                    <span><?php echo $price_type_list; ?></span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_BATHROOMS; ?>:</span>
                    <input class="inputbox" type="text" name="bathrooms" size="10" value="<?php echo $row->bathrooms; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_BEDROOMS; ?>:</span>
                    <input class="inputbox" type="text" name="bedrooms" size="10" value="<?php echo $row->bedrooms; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_BROKER; ?>:</span>
                    <input class="inputbox" type="text" name="broker" size="40" value="<?php echo $row->broker; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_OWNER; ?>:</span>

                    <span>
                        <?php if ($my->guest): ?>
                            <input type="text" name="name" readonly/>
                        <?php else: ?>
                            <input type="text" name="name" value="<?php echo $my->name; ?>" readonly/>
        <?php endif; ?>  
                    </span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_CUSTOM_OWNER_EMAIL; ?>:</span>
                    <span>
                        <?php if (trim($row->owneremail) != ""): ?>
                            <input type='text' name='owneremail' value="<?php echo $row->owneremail; ?>"/>
                        <?php else: ?>
                            <input type='text' name='owneremail' value="<?php echo $my->email; ?>"/>
        <?php endif; ?>
                    </span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_CONTACTS; ?>:</span>
                    <input class="inputbox" type="text" name="contacts" size="40" value="<?php echo $row->contacts; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_LISTING_STATUS; ?>:</span>
                    <span><?php echo $listing_status_list; ?></span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TYPE; ?>:</span>
                    <span><?php echo $property_type_list; ?></span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_PROVIDER_CLASS; ?>:</span>
                    <span><?php echo $provider_class_list; ?></span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_BUILD_YEAR; ?>:</span>
                    <span>
                        <select name="year" id="year" class="inputbox" size="1">
                            <?php
                            print_r("<option value=''>");
                            print_r(_REALESTATE_MANAGER_OPTION_SELECT);
                            print_r("</option>");
                            $num = 1900;
                            for ($i = 0; $num <= date('Y'); $i++) {
                                print_r("<option value=\"");
                                print_r($num);
                                print_r("\"");
                                if ($num == $row->year) {
                                    print(" selected= \"true\" ");
                                }
                                print_r(">");
                                print_r($num);
                                print_r("</option>");
                                $num++;
                            }
                            ?>
                        </select>
                    </span>
                </div>

                <hr size="2" width="100%" />

                <h3><?php echo _REALESTATE_MANAGER_HEADER_OPTIONAL_FIELDS ?></h3>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_AGENT; ?>:</span>
                    <input class="inputbox" type="text" name="agent" size="30" value="<?php echo $row->agent; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_AREA; ?>:</span>
                    <input class="inputbox" type="text" name="area" size="30" value="<?php echo $row->area; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_EXPIRATION_DATE; ?>:</span>
                    <span>
                        <?php
                        if (trim($row->expiration_date))
                            echo JHtml::_('calendar', $row->expiration_date, 'expiration_date', 'expiration_date', '%Y-%m-%d', array('size' => '30'));
                        else
                            echo JHtml::_('calendar', date("Y-m-d", strtotime(date("Y-m-d") . " +1 year")), 'expiration_date', 'expiration_date', '%Y-%m-%d', array('size' => '30'));
                        ?>
                    </span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_FEATURE; ?>:</span>
                    <input class="inputbox" type="text" name="feature" size="30" value="<?php echo $row->feature; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_HOA_DUES; ?>:</span>
                    <input class="inputbox" type="text" name="hoa_dues" size="30" value="<?php echo $row->hoa_dues; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_LOT_SIZE; ?>:</span>
                    <input class="inputbox" type="text" name="lot_size" size="30" value="<?php echo $row->lot_size; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_MODEL; ?>:</span>
                    <input class="inputbox" type="text" name="model" size="30" value="<?php echo $row->model; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TAXES; ?>:</span>
                    <input class="inputbox" type="text" name="property_taxes" size="30" value="<?php echo $row->property_taxes; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL; ?>:</span>
                    <input class="inputbox" type="text" name="school" size="30" value="<?php echo $row->school; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL_DISTRICT; ?>:</span>
                    <input class="inputbox" type="text" name="school_district" size="30" value="<?php echo $row->school_district; ?>" />
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_STYLE; ?>:</span>
                    <span><?php echo $style_list; ?></span>
                </div>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_ZONING; ?>:</span>
                    <span><?php echo $zoning_list; ?></span>
                </div>
                <hr size="2" width="100%" />

                <h3><?php echo _REALESTATE_MANAGER_HEADER_PHOTO_MANAGE; ?></h3>

                <div class="row_add_house">
                    <span><?php echo _REALESTATE_MANAGER_LABEL_PICTURE_URL_UPLOAD; ?>:</span>
                    <input class="inputbox" type="file" name="image_link" value="<?php echo $row->image_link; ?>" size="25" maxlength="250" />
                </div>

                <div class="row_add_house">
        <?php if ($house_photo != '') { ?>	
                        <span><?php echo _REALESTATE_MANAGER_LABEL_SELECT_PHOTO_TO_REMOVE; ?>:</span>
                        <span>
                            <input type="checkbox" name="del_main_photo" value="<?php echo $house_photo[0]; ?>" />
                            <img alt="photo" src="<?php echo $mosConfig_live_site . "/components/com_realestatemanager/photos/" . $house_photo[1]; ?>"/>
                        </span>
        <?php } else echo '<span>&nbsp</span>'; ?>				
                </div>

                <div class="row_add_house">
                    <span> <?php echo _REALESTATE_MANAGER_LABEL_OTHER_PICTURES_URL_UPLOAD; ?>:</span>

                    <div ID="items">
                        <input class="inputbox" name="new_photo" value="<?php echo _REALESTATE_MANAGER_BUTTON_ADD_NEW_PHOTO; ?>" onclick="new_photos()" id="add" type="button">
                    </div>
                </div>

        <?php if (count($house_photos) != 0) { ?>

                    <div class="row_add_house">
                        <span><?php echo _REALESTATE_MANAGER_LABEL_SELECT_PHOTO_FROM_GALLERY; ?>:</span>
                        <span>
                            <?php
                            for ($i = 0; $i < count($house_photos); $i++) {
                                if (($i % 7) == 0) {
                                    echo "<br>";
                                }
                                ?>
                                <input type="checkbox" name="del_photos[]" value="<?php echo $house_photos[$i][0]; ?>" />
                                <img src="<?php echo $mosConfig_live_site . "/components/com_realestatemanager/photos/" . $house_photos[$i][1]; ?>" alt="no such file"/> &nbsp
            <?php } ?>
                        </span>
                    </div>

        <?php } ?>
                <?php
                // denis 13.12.2013
                count($house_photos);
                $user_group = userGID_REM($my->id);       
                $user_group_mas = explode(',', $user_group);
                //var_dump($user_group_mas);

                $max_count_foto = 0;
                foreach ($user_group_mas as $value) {            
                    $count_foto_for_single_group = $realestatemanager_configuration['user_manager_vm'][$value]['count_foto'];
                    if($count_foto_for_single_group>$max_count_foto){
                        $max_count_foto = $count_foto_for_single_group;
                    }            
                }
                $count_foto_for_single_group = $max_count_foto;
                ?>

                <hr size="2" width="100%" />

                <h3><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_FEATURE_MANAGER; ?></h3>	

                <div class="row_house_checkbox">

                    <?php
                    for ($i = 0; $i < count($house_feature); $i++) {
                        if ($i != 0) {
                            if ($house_feature[$i]->categories !== $house_feature[$i - 1]->categories)
                                echo "<div class='categories_feature'>" . $house_feature[$i]->categories . "</div>";
                        } else
                            echo "<div class='categories_feature'>" . $house_feature[$i]->categories . "</div>";
                        ?>    

                        <div class="box_check_feature">
                            <input type="checkbox" <?php if ($house_feature[$i]->check) echo "checked"; ?> name="feature[]" value="<?php echo $house_feature[$i]->id; ?>"><?php echo $house_feature[$i]->name; ?></input>
            <?php if ($house_feature[$i]->image_link != '') { ?>       
                                <img alt="photo" src="<?php echo "$mosConfig_live_site/components/com_realestatemanager/featured_ico/" . $house_feature[$i]->image_link; ?>"></img>      
            <?php } ?>       
                        </div>

                <?php } ?>

                </div>

                <!--******************************************************-->

        <?php
        $month = date("m", mktime(0, 0, 0, date('m'), 1, date('Y')));
        $year = date("Y", mktime(0, 0, 0, date('m'), 1, date('Y')));
        $placeholder = $realestatemanager_configuration['calendar']['placeholder'];
        ?>

            <script language="javascript" type="text/javascript">
            var photos=0;
            function new_photos_rem(){
                div= document.getElementById("items");
                button= document.getElementById("add");
                photos++;
                var allowed_files = <?php echo $count_foto_for_single_group;?>;
                if (<?php echo count($house_photos); ?> < allowed_files) {
                  newitem="<strong>" + "<?php echo _REALESTATE_MANAGER_ADMIN_NEW_PHOTO ?>" + photos + ": </strong>";
                  newitem+="<input type=\"file\" multiple='true' name=\"new_photo_file[]";
                  newitem+="\" value=\"\"size=\"45\"><br>";
                  newnode= document.createElement("span");
                  newnode.innerHTML=newitem;
                  div.appendChild(newnode);
                }
                if( photos + <?php echo count($house_photos); ?> >= allowed_files ) {
                    button.onclick = function(){
                      return false; 
                    }; 
                }
            }
                 
                    var itW=0;
                    function new_calen_rent(){
                        div=document.getElementById("itemsW");
                        button=document.getElementById("addW");
                        itW++;
                        newitem="<strong>" + "<?php echo _REALESTATE_MANAGER_LABEL_CALENDAR_NEW_PRICE; ?>" + itW + ": </strong><br />";
                        newitem+="<select name=\"yearW[]\"><option value=\"2012\" " + " <?php if ($year == '2012') echo "selected" ?> " + " >2012</option><option value=\"2013\" " + " <?php if ($year == '2013') echo "selected" ?> " + " >2013</option><option value=\"2014\" " + " <?php if ($year == '2014') echo "selected" ?> " + " >2014</option><option value=\"2015\" " + " <?php if ($year == '2015') echo "selected" ?> " + " >2015</option><option value=\"2016\" " + " <?php if ($year == '2016') echo "selected" ?> " + " >2016</option><option value=\"2017\" " + " <?php if ($year == '2017') echo "selected" ?> " + " >2017</option></select>";
                        newitem+="<select name=\"monthW[]\"><option value=\"1\" " + " <?php if ($month == '1') echo "selected" ?> " + " ><?php echo JText::_('JANUARY'); ?>" + "</option><option value=\"2\" " + " <?php if ($month == '2') echo "selected" ?> " + " ><?php echo JText::_('FEBRUARY'); ?>" + "</option><option value=\"3\" " + " <?php if ($month == '3') echo "selected" ?> " + " >" + "<?php echo JText::_('MARCH'); ?>" + "</option><option value=\"4\" " + " <?php if ($month == '4') echo "selected" ?> " + " >April</option><option value=\"5\" " + " <?php if ($month == '5') echo "selected" ?> " + " >" + "<?php echo JText::_('MAY'); ?>" + "</option><option value=\"6\" " + " <?php if ($month == '6') echo "selected" ?> " + " >" + "<?php echo JText::_('JUNE'); ?>" + "</option><option value=\"7\" " + " <?php if ($month == '7') echo "selected" ?> " + " >" + "<?php echo JText::_('JULY'); ?>" + "</option>";
                        newitem+="<option value=\"8\" " + " <?php if ($month == '8') echo "selected" ?> " + "  >" + "<?php echo JText::_('AUGUST'); ?>" + "</option><option value=\"9\" " + " <?php if ($month == '9') echo "selected" ?> " + " >" + "<?php echo JText::_('SEPTEMBER'); ?>" + "</option><option value=\"10\" " + " <?php if ($month == '10') echo "selected" ?> " + " >" + "<?php echo JText::_('OCTOBER'); ?>" + "</option><option value=\"11\" " + " <?php if ($month == '11') echo "selected" ?> " + " >" + "<?php echo JText::_('NOVEMBER'); ?>" + "</option><option value=\"12\" " + " <?php if ($month == '12') echo "selected" ?> " + " >" + "<?php echo JText::_('DECEMBER'); ?>" + "</option></select><br />";
                        newitem+="<b>Week</b><br /><textarea rows=\"5\" cols=\"25\" name=\"week[]\">" + "<?php echo $placeholder; ?>" + "</textarea><br /><b>Weekend</b><br /><textarea rows=\"5\" cols=\"25\" name=\"weekend[]\">" + "<?php echo $placeholder; ?>" + "</textarea><br /><b>Midweek</b><br /><textarea rows=\"5\" cols=\"25\" name=\"midweek[]\">" + "<?php echo $placeholder; ?>" + "</textarea><br /><br /><br />";
                        newnode=document.createElement("span");
                        newnode.innerHTML=newitem;
                        div.insertBefore(newnode,button);
                    }
                </script>

                <hr size="2" width="100%" />
        
        

                <!--********************************************************************************************************************************-->

                <?php
                if ($realestatemanager_configuration['extra1'] == 0 && $realestatemanager_configuration['extra2'] == 0 && $realestatemanager_configuration['extra3'] == 0 && $realestatemanager_configuration['extra4'] == 0 && $realestatemanager_configuration['extra5'] == 0
                        && $realestatemanager_configuration['extra6'] == 0 && $realestatemanager_configuration['extra7'] == 0 && $realestatemanager_configuration['extra8'] == 0 && $realestatemanager_configuration['extra9'] == 0 && $realestatemanager_configuration['extra10'] == 0) {
                    
                } else {
                    ?>

                    <hr size="2" width="100%" />

                   

                        <h3><?php echo _REALESTATE_MANAGER_LABEL_EXTRA; ?></h3>

            <?php if ($realestatemanager_configuration['extra1'] == 1) { ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA1; ?>:</span>
                                <input class="inputbox" type="text" name="extra1" size="30" value="<?php echo $row->extra1; ?>" />
                            </div>

            <?php
            }
            if ($realestatemanager_configuration['extra2'] == 1) {
                ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA2; ?>:</span>
                                <input class="inputbox" type="text" name="extra2" size="30" value="<?php echo $row->extra2; ?>" />
                            </div>

            <?php
            }
            if ($realestatemanager_configuration['extra3'] == 1) {
                ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA3; ?>:</span>
                                <input class="inputbox" type="text" name="extra3" size="30" value="<?php echo $row->extra3; ?>" />
                            </div>

            <?php
            }
            if ($realestatemanager_configuration['extra4'] == 1) {
                ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA4; ?>:</span>
                                <input class="inputbox" type="text" name="extra4" size="30" value="<?php echo $row->extra4; ?>" />
                            </div>

                        <?php
                        }
                        if ($realestatemanager_configuration['extra5'] == 1) {
                            ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA5; ?>:</span>
                                <input class="inputbox" type="text" name="extra5" size="30" value="<?php echo $row->extra5; ?>" />
                            </div>

                        <?php
                        }
                        if ($realestatemanager_configuration['extra6'] == 1) {
                            ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA6; ?>:</span>
                                <span><?php echo $extra_list[0]; ?></span>
                            </div>

                        <?php
                        }
                        if ($realestatemanager_configuration['extra7'] == 1) {
                            ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA7; ?>:</span>
                                <span><?php echo $extra_list[1]; ?></span>
                            </div>

                        <?php
                        }
                        if ($realestatemanager_configuration['extra8'] == 1) {
                            ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA8; ?>:</span>
                                <span><?php echo $extra_list[2]; ?></span>
                            </div>

            <?php
            }
            if ($realestatemanager_configuration['extra9'] == 1) {
                ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA9; ?>:</span>
                                <span><?php echo $extra_list[3]; ?></span>
                            </div>

                    <?php
                    }
                    if ($realestatemanager_configuration['extra10'] == 1) {
                        ?>

                            <div class="row_add_house">
                                <span><?php echo _REALESTATE_MANAGER_LABEL_EXTRA10; ?>:</span>
                                <span><?php echo $extra_list[4]; ?></span>
                            </div>

                <?php } ?>
                    

            <?php } ?>
                <!--********************************************************************************************************************************-->
            <?php if (checkAccess_REM($realestatemanager_configuration['add_house']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                ?>
                    <input  type="button" name="submit2" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_SAVE; ?>"  class="button" onclick="javascript:submitbutton('submit2');">
            <?php }
            ?>
            </div>

            <?php
            //************publish on add begin

            if ($realestatemanager_configuration['approve_on_add']['show']) {
                if (checkAccess_REM($realestatemanager_configuration['approve_on_add']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                    ?><input type="hidden" name="approved" value="1"/><?php
            } else {
                    ?><input type="hidden" name="approved" value="0"/><?php
            }
        } else {
                ?><input type="hidden" name="approved" value="0"/><?php } ?>
        <?php
        if ($realestatemanager_configuration['publish_on_add']['show']) {
            if (checkAccess_REM($realestatemanager_configuration['publish_on_add']['registrationlevel'], 'NORECURSE', userGID_REM($my->id), $acl)) {
                ?><input type="hidden" name="published" value="1"/><?php
            } else {
                ?><input type="hidden" name="published" value="0"/><?php
            }
        } else {
            ?><input type="hidden" name="published" value="0"/><?php } ?>

        </form>
        <?php
    }

    static function displayLicense($id) {
        global $mosConfig_live_site, $doc;
        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        $session = JFactory::getSession();
        $pas = $session->get("ssmid", "default");
        $sid_1 = $session->getId();
        $house = $session->get("obj_house", "default");
        if (!($session->get("ssmid", "default")) || $pas == "" || $pas != $sid_1 || $_COOKIE['ssd'] != $sid_1 ||
                !array_key_exists("HTTP_REFERER", $_SERVER) || $_SERVER["HTTP_REFERER"] == "" ||
                strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME']) === false) {
            echo '<H3 align="center">Link failure</H3>';
            exit;
        }
        echo '<style type="text/css"><!--#frm {width: 95%;height: 200px;border-width: thin;}--></style>';
        echo '<form name="dlform" method="POST" action="' . sefRelToAbs($mosConfig_live_site . '/index.php?option=com_realestatemanager&amp;task=downitsf&amp;id=' . @$house->id) . ' ">';
        echo '<H2 align = "center" style="text-align: center;">' . _LICENSE_AGREEMENT_TITLE . '</H2>';
        echo '';
        echo '<IFRAME src="' . $mosConfig_live_site . '/components/com_realestatemanager/mylicense.php" width="95%" height="230" name="frm" id="frm" SCROLLING="auto" noresize>';
        echo '</IFRAME>';
        echo '<input type="hidden" name="id" value="' . $id . '" />';
        echo '<input type="hidden" name="task" value="downitsf" />';
        echo '<input type="hidden" name="ssidPost" value="' . $session->getId() . '" >';
        echo '<div align="right" style="text-align:right;>';
        echo '<BR /> <font size="3"><strong>' . _LICENSE_AGREEMENT_ACCEPT . '</strong></font> <input type="radio" name="choice" checked="checked" onclick="document.getElementById(\'DBB\').disabled=true;" />';
        echo _REALESTATE_MANAGER_NO;
        echo '<input type="radio" name="choice" onclick="document.getElementById(\'DBB\').removeAttribute(
\'disabled\');" >';
        echo _REALESTATE_MANAGER_YES . '&nbsp;&nbsp;&nbsp;';
        echo '<input type="submit" ID="DBB" name="downbutton" disabled="disabled" value="download" />&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<br /><br /><br /><br />';
        echo '</div>';
        echo '</form>';
    }

    static function showRentRequest(& $houses, & $currentcat, & $params, & $tabclass, & $catid, & $sub_categories, $is_exist_sub_categories, $option) {
        $pageNav = new JPagination(0, 0, 0);
        HTML_realestatemanager::displayHouses($houses, $currentcat, $params, $tabclass, $catid, $sub_categories, $is_exist_sub_categories, $pageNav, $option);
        // add the formular for send to :-)
    }

    static function displayHouses_empty($rows, $currentcat, &$params, $tabclass, $catid, $categories, $is_exist_sub_categories, &$pageNav = null, $option) {
        positions_rem($params->get('allcategories01'));
        ?>
        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
        <?php echo $currentcat->header; ?>
        </div>
        <?php positions_rem($params->get('allcategories02')); ?>
        <table class="basictable table_48" border="0" cellpadding="4" cellspacing="0" width="100%">
            <tr>
                <td>
        <?php echo $currentcat->descrip; ?>
                </td>     
                <td width="120" align="center">
                    <img src="./components/com_realestatemanager/images/rem_logo.png" align="right" alt="Real Estate Manager logo"/>
                </td>
            </tr>
        </table>
        <?php
        if ($is_exist_sub_categories) {
            ?>
            <?php positions_rem($params->get('singlecategory07')); ?>
            <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
            <?php echo _REALESTATE_MANAGER_LABEL_FETCHED_SUBCATEGORIES . " : " . $params->get('category_name'); ?>
            </div>
            <?php positions_rem($params->get('singlecategory08')); ?>
            <?php
            HTML_realestatemanager::listCategories($params, $categories, $catid, $tabclass, $currentcat);
        }
    }

    static function displayHouses(&$rows, $currentcat, &$params, $tabclass, $catid, $categories, $is_exist_sub_categories, &$pageNav = null, $option, $layout = "gallery", $map_houses) {
        global $mosConfig_absolute_path;
        
        //require($mosConfig_absolute_path."/components/com_realestatemanager/views/alone_category/tmpl/".$layout.".php");
        $type = 'alone_category';
        
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }

    static function displayAllHouses(&$rows, &$params, $tabclass, &$pageNav, $layout = "default") {
        
        global $mosConfig_absolute_path;
        //require($mosConfig_absolute_path . "/components/com_realestatemanager/views/all_houses/tmpl/" . $layout . ".php");
        $type = 'all_houses';
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }

//pdf0
    static function displayHousesPdf($rows, $currentcat, &$params, $tabclass, $catid, $categories, $is_exist_sub_categories, &$pageNav) {
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");

        global $hide_js, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path, $option;
        global $limit, $total, $limitstart, $task, $paginations, $mainframe, $realestatemanager_configuration;

        global $doc;

        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        ob_end_clean();
        ob_start();
        ?>
        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo $currentcat->header; ?>
        </div>
        <br />

        <div id="list">
            <table class="basictable table_49" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="10%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_COVER; ?>
                    </td>
                    <td width="40%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                        <?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?>
                    </td>
                    <td width="40%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>
                    </td>
                    <td width="15%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_PRICE ?>
                    </td>
                        <?php
                        if ($params->get('hits')) {
                            ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                        <?php echo _REALESTATE_MANAGER_LABEL_HITS; ?>
                        </td>
                    <?php
                }
                if ($params->get('search_request')) {
                    ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                    <?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?>
                        </td>
                    <?php
                }
                if ($params->get('show_rentstatus')) {
                    ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                            <?php echo _REALESTATE_MANAGER_LABEL_RENT_CB; ?>
                        </td>
                            <?php
                        }
                        ?>
                </tr>
                        <?php
                        $available = false;
                        $k = 0;
//****************************************   add my perenos
                        $total = count($rows);
                        foreach ($rows as $row) {
//****************************************   add my perenos
                            $link = 'index.php?option=' . $option . '&amp;task=view&amp;id=' . $row->id . '&amp;catid=' . $row->catid[0] . '&amp;Itemid=' . $Itemid;     //
                            ?>
                    <tr class="<?php echo $tabclass[$k]; ?>" >
                        <td style="padding-left:5px; padding-top:5px; padding-right:10px;">
            <?php
            $house = $row;
            //for local images
            $imageURL = urlencode($house->image_link);

            if ($imageURL != '') {
                $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, $realestatemanager_configuration['fotogallery']['high'], $realestatemanager_configuration['fotogallery']['width']);
                $file = './components/com_realestatemanager/photos/' . $file_name;
                echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . $file . '" border="0" class="little">';
            } else {
                echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . './components/com_realestatemanager/images/';
                echo _REALESTATE_MANAGER_NO_PICTURE;
                echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE . '" border="0"  />';
            }
            ?>                
                        </td>
                        <td >
                            <a href="<?php echo sefRelToAbs($link); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
            <?php echo $row->htitle; ?>
                            </a>
                        </td>
                        <td>
            <?php echo $row->hlocation; ?>
                        </td>
                        <td >
            <?php echo $row->price . $row->priceunit; ?>
                        </td>
            <?php
            if ($params->get('hits')) {
                ?>
                            <td align="left">
                <?php echo $row->hits; ?>
                            </td>
                        </tr>
            <?php }
        } ?>
            </table>
        </div>
        <?php
        $tbl = ob_get_contents();
        ob_end_clean();

        $pdf = new TCPDF1('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetTitle('Realestate Manager');
        $pdf->SetFont('freesans', 'B', 20);
        $pdf->AddPage();
        $pdf->SetFont('freesans', '', 10);
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('Real_Estate_manager.pdf', 'I');
        exit;
    }

    static function showAjaxResponse($result){

	$_REQUEST['tmpl'] = 'component';
        
	
	$session = JFactory::getSession();
        $arr = $session->get("array", "default");

        global $hide_js, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path;
        global $limit, $total, $limitstart, $task, $paginations, $mainframe, $realestatemanager_configuration;

        global $doc;

        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        
	echo '<result>';
	print_r(json_encode($result));
	echo '</result>';
    }

    static function displayHousesPrint($rows, $currentcat, &$params, $tabclass, $catid, $categories, $is_exist_sub_categories, &$pageNav) {
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");

        global $hide_js, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path;
        global $limit, $total, $limitstart, $task, $paginations, $mainframe, $realestatemanager_configuration;

        global $doc;

        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
            <table class="basictable table_50">
                <tr>
                    <td>
        <?php echo $currentcat->header; ?>
                    </td>
                    <td align="right">
                        <a href="#" onclick="window.print();return false;"><img src="./components/com_realestatemanager/images/printButton.png" alt="Print"  /></a>
                    </td>
                </tr>      
            </table>
        </div>
        <br />


        <div id="list">
            <table class="basictable table_51" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="10%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_COVER; ?>
                    </td>
                    <td width="40%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                        <?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?>
                    </td>
                    <td width="40%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>
                    </td>
                    <td width="15%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                        <?php echo _REALESTATE_MANAGER_LABEL_PRICE ?>
                    </td>
                    <?php
                    if ($params->get('hits')) {
                        ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                    <?php echo _REALESTATE_MANAGER_LABEL_HITS; ?>
                        </td>
                    <?php
                }
                if ($params->get('search_request')) {
                    ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                    <?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?>
                        </td>
                    <?php
                }
                if ($params->get('show_rentstatus')) {
                    ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                            <?php echo _REALESTATE_MANAGER_LABEL_RENT_CB; ?>
                        </td>
                            <?php
                        }
                        ?>
                </tr>
                        <?php
                        $available = false;
                        $k = 0;
//****************************************   add my perenos
                        $total = count($rows);
                        foreach ($rows as $row) {
//****************************************   add my perenos
                            $link = 'index.php?option=com_realestatemanager&amp;task=view&amp;id=' . $row->id . '&amp;catid=' . $row->catid[0] . '&amp;Itemid=' . $Itemid;     //
                            ?>
                    <tr class="<?php echo $tabclass[$k]; ?>" >
                        <td style="padding-left:5px; padding-top:5px; padding-right:10px;">
            <?php
            $house = $row;
            //for local images
            $imageURL = urlencode($house->image_link);

            if ($imageURL != '') {
                $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, $realestatemanager_configuration['fotogallery']['high'], $realestatemanager_configuration['fotogallery']['width']);
                $file = './components/com_realestatemanager/photos/' . $file_name;
                echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . $file . '" border="0" class="little">';
            } else {
                echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . './components/com_realestatemanager/images/';
                echo _REALESTATE_MANAGER_NO_PICTURE;
                echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE . '" border="0"  />';
            }
            ?>                

                        </td>
                        <td >
                            <a href="<?php echo sefRelToAbs($link); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
            <?php echo $row->htitle; ?>
                            </a>                  
                        </td>
                        <td>
            <?php
            echo $row->hlocation;
            ?>
                        </td>
                        <td >
            <?php echo $row->price . $row->priceunit; ?>
                        </td>
            <?php
            if ($params->get('hits')) {
                ?>
                            <td align="left">
                <?php echo $row->hits; ?>
                            </td>
                        </tr>                      
            <?php }
        } ?>
            </table>
        </div>
        <?php
       // exit;
    }

    static function displayAllHousesPdf($rows, &$params, $tabclass, &$pageNav) {
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");

        global $hide_js, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path, $option;
        global $limit, $total, $limitstart, $task, $paginations, $mainframe, $realestatemanager_configuration;

        global $doc;

        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');

        ob_end_clean();
        ob_start();
        ?>

        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
        </div>

        <div id="list">
            <table class="basictable table_52" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="10%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                        <?php echo _REALESTATE_MANAGER_LABEL_COVER; ?>
                    </td>
                    <td width="40%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?>
                    </td>
                    <td width="40%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                        <?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>
                    </td>
                    <td width="15%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_PRICE ?>
                    </td>
                    <?php
                    if ($params->get('hits')) {
                        ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                    <?php echo _REALESTATE_MANAGER_LABEL_HITS; ?>
                        </td>
                    <?php
                }
                if ($params->get('search_request')) {
                    ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                    <?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?>
                        </td>
                    <?php
                }
                if ($params->get('show_rentstatus')) {
                    ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                            <?php echo _REALESTATE_MANAGER_LABEL_RENT_CB; ?>
                        </td>
                            <?php
                        }
                        ?>
                </tr>
                        <?php
                        $available = false;
                        $k = 0;
//****************************************   add my perenos
                        $total = count($rows);
                        if (isset($_GET['lang']))
                            $lang = $_GET['lang']; else
                            $lang = '*';
                        foreach ($rows as $row) {
//****************************************   add my perenos
                            $link = 'index.php?option=' . $option . '&amp;task=view&amp;id=' . $row->id . '&amp;catid=' . $row->catid[0] . '&amp;Itemid=' . $Itemid;     //
                            ?>
                    <tr class="<?php echo $tabclass[$k]; ?>" >
                        <td style="padding-left:5px; padding-top:5px; padding-right:10px;">
            <?php
            $house = $row;
            //for local images
            $imageURL = urlencode($house->image_link);

            if ($imageURL != '') {
                $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, $realestatemanager_configuration['fotogallery']['high'], $realestatemanager_configuration['fotogallery']['width']);
                $file = './components/com_realestatemanager/photos/' . $file_name;
                echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . $file . '" border="0" class="little">';
            } else {
                echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . './components/com_realestatemanager/images/';
                echo _REALESTATE_MANAGER_NO_PICTURE;
                echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE . '" border="0"  />';
            }
            ?>      
                        </td>
                        <td >
                            <a href="<?php echo sefRelToAbs($link); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
                            <?php echo $row->htitle; ?>
                            </a>
                        </td>
                        <td>
            <?php echo $row->hlocation; ?>
                        </td>
                        <td >
                        <?php echo $row->price . $row->priceunit; ?>
                        </td>
                        <?php
                        if ($params->get('hits')) {
                            ?>
                            <td align="left">
                            <?php echo $row->hits; ?>
                            </td>
                        <?php
                        }
                        if ($params->get('search_request')) {
                            ?>
                            <td align="right">
                                <?php
                                $link1 = 'index.php?option=com_realestatemanager&amp;task=showCategory&amp;catid=' . $row->catid[0] . '&amp;Itemid=' . $Itemid;
                                ?>

                                <a href="<?php echo sefRelToAbs($link1); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
                                <?php echo $row->category_titel; ?>
                                </a>
                            </td><?php
            }
            if ($params->get('show_rentstatus')) {
                if ($params->get('show_rentrequest')) {
                    $data1 = JFactory::getDBO();
                    $query = "SELECT  b.rent_from , b.rent_until  FROM #__rem_rent AS b " .
                            " LEFT JOIN #__rem_houses AS c ON b.fk_houseid = c.id " .
                            " WHERE c.id=" . $row->id . " AND c.published='1' AND c.approved='1' AND b.rent_return IS NULL";
                    $data1->setQuery($query);
                    $rents1 = $data1->loadObjectList();
                                    ?>
                                <td align="center" width="100%">
                    <?php
                    if (($row->listing_type == 1) && !isset($rents1[0]->rent_until)) {
                        echo "<img src='" . $mosConfig_live_site . "/components/com_realestatemanager/images/available.png' alt='Available' name='image' border='0' align='middle' />";
                    } else if ($row->fk_rentid != 0 && isset($rents1[0]->rent_until)) {
                        echo _REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL . "<br />";
                        for ($a = 0; $a < count($rents1); $a++) {
                            $from_until = substr($rents1[$a]->rent_from, 0, 10) .
                                    "&nbsp;/&nbsp;" .
                                    substr($rents1[$a]->rent_until, 0, 10) . "\n";
                            print_r($from_until);
                        }
                    } else if (/* $row->fk_rentid == 0 && */($row->listing_type != 1)) {
                        echo "<img src='" . $mosConfig_live_site .
                        "/components/com_realestatemanager/images/not_available.png' alt='Not Available' name='image' border='0' align='middle' />";
                    } /* else echo "<img src='" . $mosConfig_live_site .
                      "/components/com_realestatemanager/images/available.png' alt='Available' name='image' border='0' align='middle' />"; */
                    ?>            
                                </td>

                    <?php
                }
            }
            ?>
                    </tr>
        <?php } ?>
            </table>
        </div>
        <?php
        $tbl = ob_get_contents();
        ob_end_clean();

        $pdf = new TCPDF1('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetTitle('Realestate Manager');
        $pdf->SetFont('freesans', 'B', 20);
        $pdf->AddPage();
        $pdf->SetFont('freesans', '', 10);
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('Real_Estate_manager.pdf', 'I');
        exit;
    }

    static function displayAllHousePrint($rows, &$params, $tabclass, &$pageNav) {
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");

        global $hide_js, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path;
        global $limit, $total, $limitstart, $task, $paginations, $mainframe, $realestatemanager_configuration;

        global $doc;

        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
            <table class="basictable table_53">
                <tr>
                    <td align="right">
                        <a href="#" onclick="window.print();return false;"><img src="./components/com_realestatemanager/images/printButton.png" alt="Print"  /></a>
                    </td>
                </tr>      
            </table>
        </div>



        <div id="list">
            <table class="basictable table_54" width="100%" border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="10%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_COVER; ?>
                    </td>
                    <td width="40%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?>
                    </td>
                    <td width="40%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>
                    </td>
                    <td width="15%" height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                    <?php echo _REALESTATE_MANAGER_LABEL_PRICE ?>
                    </td>
                        <?php
                        if ($params->get('hits')) {
                            ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                        <?php echo _REALESTATE_MANAGER_LABEL_HITS; ?>
                        </td>
                    <?php
                }
                if ($params->get('search_request')) {
                    ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                    <?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?>
                        </td>
                    <?php
                }
                if ($params->get('show_rentstatus')) {
                    ?>
                        <td height="20" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
                            <?php echo _REALESTATE_MANAGER_LABEL_ACCESSED_FOR_RENT; ?>
                        </td>
                            <?php
                        }
                        ?>
                </tr>
                        <?php
                        $available = false;
                        $k = 0;
//****************************************   add my perenos
                        $total = count($rows);
                        foreach ($rows as $row) {
//****************************************   add my perenos
                            $link = 'index.php?option=com_realestatemanager&amp;task=view&amp;id=' . $row->id . '&amp;catid=' . $row->catid[0] . '&amp;Itemid=' . $Itemid;     //
                            ?>
                    <tr class="<?php echo $tabclass[$k]; ?>" >
                        <td style="padding-left:5px; padding-top:5px; padding-right:10px;">
                                <?php
                                $house = $row;
                                //for local images
                                $imageURL = urlencode($house->image_link);

                                if ($imageURL != '') {
                                    $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, $realestatemanager_configuration['fotogallery']['high'], $realestatemanager_configuration['fotogallery']['width']);
                                    $file = './components/com_realestatemanager/photos/' . $file_name;
                                    echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . $file . '" border="0" class="little">';
                                } else {
                                    echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . './components/com_realestatemanager/images/';
                                    echo _REALESTATE_MANAGER_NO_PICTURE;
                                    echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE . '" border="0"  />';
                                }
                                ?>      

                        </td>
                        <td >
                            <a href="<?php echo sefRelToAbs($link); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
                        <?php echo $row->htitle; ?>
                            </a>                  
                        </td>
                        <td>
                            <?php
                            echo $row->hlocation;
                            ?>
                        </td>
                        <td >
            <?php echo $row->price . $row->priceunit; ?>
                        </td>
                                <?php
                                if ($params->get('hits')) {
                                    ?>
                            <td align="left">
                            <?php echo $row->hits; ?>
                            </td>
                            <?php
                        }
                        if ($params->get('search_request')) {
                            ?>
                            <td align="right">
                            <?php
                            $link1 = 'index.php?option=com_realestatemanager&amp;task=showCategory&amp;catid=' . $row->catid[0] . '&amp;Itemid=' . $Itemid;
                            ?>

                                <a href="<?php echo sefRelToAbs($link1); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
                                <?php echo $row->category_titel; ?>
                                </a>
                            </td><?php
            }
            if ($params->get('show_rentstatus')) {
                if ($params->get('show_rentrequest')) {
                    $data1 = JFactory::getDBO();
                    $query = "SELECT  b.rent_from , b.rent_until  FROM #__rem_rent AS b " .
                            " LEFT JOIN #__rem_houses AS c ON b.fk_houseid = c.id " .
                            " WHERE c.id=" . $row->id . " AND c.published='1' AND c.approved='1' AND b.rent_return IS NULL";
                    $data1->setQuery($query);
                    $rents1 = $data1->loadObjectList();
                                    ?>
                                <td align="center" width="100%">
                                    <?php
                                    if (($row->listing_type == 1) && !isset($rents1[0]->rent_until)) {
                                        echo "<img src='" . $mosConfig_live_site . "/components/com_realestatemanager/images/available.png' alt='Available' name='image' border='0' align='middle' />";
                                    } else if ($row->fk_rentid != 0 && isset($rents1[0]->rent_until)) {
                                        echo _REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL . "<br />";
                                        for ($a = 0; $a < count($rents1); $a++) {
                                            $from_until = substr($rents1[$a]->rent_from, 0, 10) .
                                                    "&nbsp;/&nbsp;" .
                                                    substr($rents1[$a]->rent_until, 0, 10) . "\n";
                                            print_r($from_until);
                                        }
                                    } else if (/* $row->fk_rentid == 0 && */($row->listing_type != 1)) {
                                        echo "<img src='" . $mosConfig_live_site .
                                        "/components/com_realestatemanager/images/not_available.png' alt='Not Available' name='image' border='0' align='middle' />";
                                    } /* else echo "<img src='" . $mosConfig_live_site .
                                      "/components/com_realestatemanager/images/available.png' alt='Available' name='image' border='0' align='middle' />"; */
                                    ?>            
                                </td>

                    <?php
                }
            }
            ?>
                    </tr>                      
        <?php } ?>
            </table>
        </div>
        <?php
       // exit;
    }

    /**
     * Displays the house
     */
    static function displayHouse(& $house, & $tabclass, & $params, & $currentcat, & $rating, & $house_photos, $id, $catid, $option, & $house_feature, & $currencys_price, $layout = "default") {
        global $mosConfig_absolute_path;
        //require($mosConfig_absolute_path."/components/com_realestatemanager/views/view_house/tmpl/".$layout.".php");
        $type = 'view_house';
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }

    static function displayHouseMainPdf(& $house, & $tabclass, & $params, & $currentcat, & $rating, & $house_photos) {
        global $hide_js, $mainframe, $Itemid, $realestatemanager_configuration, $mosConfig_live_site, $mosConfig_absolute_path, $my;
        global $doc;
//echo $mosConfig_live_site ; exit ;
        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        JPluginHelper::importPlugin('content');
        $dispatcher = JDispatcher::getInstance();
        ob_end_clean();
        ob_start();
        ?>
        <table class="basictable table_55" align="center">
            <tr>
                <td colspan ="2" align="center" class="title_td">
                    <?php echo $house->htitle; ?>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap" align="center" colspan="2">
                    <?php
                    //for local images
                    $imageURL = urlencode($house->image_link);
                    if ($imageURL != '') {
                        //echo '<img src="./components/com_realestatemanager/photos/'.$imageURL.'" height=200 width=350 >';
                        $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, $realestatemanager_configuration['fotomain']['high'], $realestatemanager_configuration['fotomain']['width']);
                        $file = './components/com_realestatemanager/photos/' . $file_name;
                        echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . $file . '" border="0" class="little">';
                    } else {
                        //echo '<img src="./components/com_realestatemanager/images/' . _REALESTATE_MANAGER_NO_PICTURE_BIG.'" alt="no-img_eng.gif" border="0" height=200 width=350 />';
                        echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . './components/com_realestatemanager/images/';
                        echo _REALESTATE_MANAGER_NO_PICTURE_BIG;
                        echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE_BIG . '" border="0"  />';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="first_td" align="right">       
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>:</strong>
                </td>
                <td width="270px" align="left" >
                    <?php echo $house->hlocation; ?>
                </td>
            </tr>
            <?php if (trim($house->description)) { ?><tr>

                    <td valign="top" class="first_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_COMMENT; ?>:</strong>
                    </td>
                    <td width="270px" align="justify">
            <?php
            positions_rem($house->description);
            ?>
                    </td>
                </tr>
            <?php } if ($realestatemanager_configuration['owner']['show'] && $house->ownername != '' && $house->owneremail != '') {
                ?>
                <tr>
                    <td class="first_td" align="right">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_OWNER; ?>:</strong>
                    </td>
                    <td align="left">
                        <strong><?php echo $house->ownername, ', ', $house->owneremail; ?></strong>
                    </td>
                </tr>
                    <?php
                    }
                    if ($house->listing_type != 0) {
                        ?>
                <tr>
                    <td class="first_td" align="right">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_LISTING_TYPE; ?>:</strong>
                    </td>
                    <td width="270px" align="left">
                <?php
                $listing_type[0] = _REALESTATE_MANAGER_OPTION_SELECT;
                $listing_type[1] = _REALESTATE_MANAGER_OPTION_FOR_RENT;
                $listing_type[2] = _REALESTATE_MANAGER_OPTION_FOR_SALE;
                echo $listing_type[$house->listing_type];
                ?>
                    </td>
                </tr>
            <?php
            }
            if ($params->get('show_contacts_line')) {
                if ($params->get('show_contacts_registrationlevel')) {
                    if (trim($house->contacts)) {
                        ?>
                        <tr>
                            <td nowrap="nowrap" align="left" class="first_td">
                                <strong><?php echo _REALESTATE_MANAGER_LABEL_CONTACTS; ?>:</strong>
                            </td>
                            <td width="270px" align="left">
                        <?php echo $house->contacts; ?>
                            </td>
                        </tr>
                    <?php }
                }
            } ?>
            <?php
            if ($house->listing_type == 1) {
                $rent = $house->getRent();
                if ($rent == null) {
                    $help['name'] = '';
                    $help['until'] = '';
                    $help['rent'] = '';
                } else {
                    if ($rent->rent_until != null) {
                        $help['rent'] = data_transform_rem($rents[$e]->rent_from) . "  =>  " . data_transform_rem($rents[$e]->rent_until);
                        $help['name'] = $rent->user_name;
                        $id = $rent->fk_houseid;
                        $database = JFactory::getDBO();
                        $select = "SELECT rent_from , rent_until FROM #__rem_rent AS a WHERE fk_houseid=" . $id . " AND rent_return IS NULL";
                        $database->setQuery($select);
                        $rents = 0;
                        $rents = $database->loadObjectList();
                        $num = count($rents);
                    } else {
                        $help['rent'] = $help['rent'] . _REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL_NOT_KNOWN;
                    }
                } //end else
                ?>
                <?php if (isset($rents)) { ?>
                    <tr>
                        <td align="right" class="title_td">
                            <strong><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL; ?>:</strong>
                        </td>
                    </tr>
                            <?php
                            for ($e = 0, $m = count($rents); $e < $m; $e++) {
                                print("<tr><td align=\"right\"><strong></strong></td><td>");
                                $date = data_transform_rem($rents[$e]->rent_from) . "  =>  " . data_transform_rem($rents[$e]->rent_until);
                                print_r($date);
                                print(" </td></tr>");
                            }
                        }
                        ?>
            <?php
            }
            //end if
            ?>
        <?php if ($house->price != "" && $params->get('show_pricerequest') == '1') { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_PRICE; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $house->price . " " . $house->priceunit; ?>
                    </td>
                </tr>
                <?php
                if ($house->price_type != 0) {
                    $price_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PRICE_TYPE);
                    $i = 1;
                    foreach ($price_type1 as $price_type2) {
                        $price_type[$i] = $price_type2;
                        $i++;
                    }
                    ?>
                    <tr>
                        <td nowrap="nowrap" align="right" class="title_td" >
                            <strong><?php echo _REALESTATE_MANAGER_LABEL_PRICE_TYPE; ?>:</strong>
                        </td>
                        <td align="left">
                    <?php echo $price_type[$house->price_type]; ?>
                        </td>
                    </tr>
                <?php }
            } ?><?php
        if ($house->style != 0) {
            $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
            $i = 1;
            foreach ($style1 as $style2) {
                $style[$i] = $style2;
                $i++;
            }
            ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td" >
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_STYLE; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo $style[$house->style]; ?>
                    </td>
                </tr>	<?php } ?>
        <?php
        if ($house->zoning != 0) {
            $zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_ZONING);
            $i = 1;
            foreach ($zoning1 as $zoning2) {
                $zoning[$i] = $zoning2;
                $i++;
            }
            ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td" >
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_ZONING; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo $zoning[$house->zoning]; ?>
                    </td>
                </tr>
        <?php } ?>
                    <?php if (trim($house->school)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td" >
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo $house->school; ?>
                    </td>
                </tr>
        <?php } ?>
        <?php if (trim($house->school_district)) { ?>
                <tr>	
                    <td nowrap="nowrap" align="right" class="title_td" >
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL_DISTRICT; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $house->school_district; ?>
                    </td>
                </tr>
        <?php } ?>
        <?php if (trim($house->bathrooms)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td" >
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_BATHROOMS; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $house->bathrooms; ?>
                    </td>
                </tr>
        <?php } ?>
        <?php if (trim($house->bedrooms)) { ?>
                <tr>

                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_BEDROOMS; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $house->bedrooms; ?>
                    </td>
                </tr>
        <?php } ?>

        <?php if (trim($house->area)) { ?>
                <tr>

                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_AREA; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $house->area; ?>
                    </td>
                </tr>	
            <?php } ?>
        <?php if (trim($house->agent)) { ?>		
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_AGENT; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo $house->agent; ?>
                    </td>
                </tr>
            <?php } ?>
        <?php if (trim($house->broker)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_BROKER; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $house->broker; ?>
                    </td>
                </tr><?php } ?>
            <?php
            if ($params->get('show_contacts_line')) {

                if ($params->get('show_contacts_registrationlevel')) {

                    if (trim($house->contacts)) {
                        ?>		
                        <tr>
                            <td nowrap="nowrap" align="right"class="title_td" >
                                <strong><?php echo _REALESTATE_MANAGER_LABEL_CONTACTS; ?>:</strong>
                            </td>
                            <td align="left">
                    <?php echo $house->contacts; ?>
                            </td>
                        </tr>
                    <?php }
                }
            } ?>
        <?php if (trim($house->feature)) { ?>		<tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_FEATURE; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $house->feature; ?>
                    </td>
                </tr>
            <?php } ?>
            <?php
            if ($house->listing_status != 0) {
                $listing_status1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
                $i = 1;
                foreach ($listing_status1 as $listing_status2) {
                    $listing_status[$i] = $listing_status2;
                    $i++;
                }
                ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td" >
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_LISTING_STATUS; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $listing_status[$house->listing_status]; ?>
                    </td>
                </tr>
        <?php } ?>
        <?php if (trim($house->hoa_dues)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_HOA_DUES; ?>:</strong>
                    </td>
                    <td>
                <?php echo $house->hoa_dues; ?>
                    </td>
                </tr>
            <?php } ?>
            <?php
            if ($house->property_type != 0) {
                $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
                $i = 1;
                foreach ($property_type1 as $property_type2) {
                    $property_type[$i] = $property_type2;
                    $i++;
                }
                ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TYPE; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo $property_type[$house->property_type]; ?>
                    </td>
                </tr>
                    <?php } ?>
                    <?php if (trim($house->lot_size)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_LOT_SIZE; ?>:</strong>
                    </td>
                    <td>
            <?php echo $house->lot_size; ?>
                    </td>
                </tr>
                    <?php } ?>
                    <?php
                    if ($house->provider_class != 0) {
                        $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
                        $i = 1;
                        foreach ($provider_class1 as $provider_class2) {
                            $provider_class[$i] = $provider_class2;
                            $i++;
                        }
                        ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_PROVIDER_CLASS; ?>:</strong>
                    </td>
                    <td align="left">
                <?php echo $provider_class[$house->provider_class]; ?>
                    </td>
                </tr>
        <?php } ?>
        <?php if (trim($house->model)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_MODEL; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo $house->model; ?>
                    </td>
                </tr>
        <?php } ?>
        <?php if (trim($house->year)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_BUILD_YEAR; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo $house->year; ?>
                    </td>
                </tr>
        <?php } ?>
        <?php if (trim($house->expiration_date)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_EXPIRATION_DATE; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo data_transform_rem($house->expiration_date); ?>
                    </td>
                </tr>
        <?php } ?>
        <?php if (trim($house->property_taxes > 0.00)) { ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TAXES; ?>:</strong>
                    </td>
                    <td align="left">
            <?php echo $house->property_taxes; ?> 
                    </td>
                </tr><?php } ?>
        </table>


        <?php
        $tbl = ob_get_contents();
        ob_end_clean();

        $pdf = new TCPDF1('P', 'mm', 'A4', true, 'UTF-8', false);
        //$pdf->SetAuthor('');
        $pdf->SetTitle('Real Estate manager');
        $pdf->SetFont('freesans', 'B', 20);
        $pdf->AddPage();
        //$pdf->Write(0, 'Real Estate manager', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('freesans', '', 10);
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('Real_Estate_manager.pdf', 'I');
        exit;
    }

    static function displayHouseMainprint(& $house, & $tabclass, & $params, & $currentcat, & $rating, & $house_photos) {
        global $hide_js, $mainframe, $Itemid, $realestatemanager_configuration, $mosConfig_live_site, $mosConfig_absolute_path, $my;
        global $doc;

        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        $doc->addStyleSheet($mosConfig_live_site . '/templates/masterbootstrap/css/template.css');
        $doc->addStyleSheet($mosConfig_live_site . '/templates/masterbootstrap/css/print.css');

        JPluginHelper::importPlugin('content');
        $dispatcher = JDispatcher::getInstance();
        
        ?>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" ></script>

        
         
        
        <table class="basictable table_56" align="center">
            <tr>
                <td class="house-photo-td">
                      <?php
                        //for local images
                        $imageURL = urlencode($house->image_link);
                        //echo $imageURL;
                        if ($imageURL != '') {
                            $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, $realestatemanager_configuration['fotoupload']['high'], $realestatemanager_configuration['fotoupload']['width']);
                            $file = './components/com_realestatemanager/photos/' . $file_name;
                            echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . $file . '" border="0" class="little">';
                        } else {
                            echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . './components/com_realestatemanager/images/';
                            echo _REALESTATE_MANAGER_NO_PICTURE_BIG;
                            echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE_BIG . '" border="0"  />';
                        }
                        ?>          
                </td>
                <td>
                    <div id="house_basic_details" class="table_country3">
                        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
                            <?php echo $house->htitle; ?>     
                        </div>
                        <div class="view_house_local_bradcrumbs">
                            <?php
                                echo "<u>Portugal</u>";
                                echo " > ";
                                echo "<u>".$house->region."</u>";
                                echo " > ";
                                echo "<u>".$house->hcity."</u>";
                            ?>
                        </div>
                        <div>
                            <span class="col_text_1"><img src="images/icons/person.png" alt="<?php echo _REALESTATE_MANAGER_LABEL_BROKER; ?>" title="<?php echo _REALESTATE_MANAGER_LABEL_BROKER; ?>"/></span>
                            <span class="col_text_2">1-<?php echo $house->broker; ?></span>
                            &nbsp;&nbsp;
                            <span class="col_text_1"><img src="images/icons/room.png" alt="<?php echo _REALESTATE_MANAGER_LABEL_BEDROOMS; ?>" title="<?php echo _REALESTATE_MANAGER_LABEL_BEDROOMS; ?>"/></span>
                            <span class="col_text_2"><?php echo $house->bedrooms; ?></span>
                            &nbsp;&nbsp;
                            <span class="col_text_1"><img src="images/icons/wc.png" alt="<?php echo _REALESTATE_MANAGER_LABEL_BATHROOMS; ?>" title="<?php echo _REALESTATE_MANAGER_LABEL_BATHROOMS; ?>"/></span>
                            <span class="col_text_2"><?php echo $house->bathrooms; ?></span>
                            
                            <span class="col_text_1"><img src="images/icons/beach.png" alt="<?php echo _REALESTATE_MANAGER_LABEL_EXTRA3; ?>" title="<?php echo _REALESTATE_MANAGER_LABEL_EXTRA3; ?>"/></span>
                            <span class="col_text_2"><?php echo $house->extra3; ?>km</span>
                        </div>
                    </div>
                </td>
            </tr>
            
            <tr>
                <!--<td class="first_td" align="right">       
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>:</strong>
                </td>-->
                <td class="second_td" colspan="2" align="left" >
                    <?php echo $house->hlocation; ?>
                </td>
            </tr>
                    <?php if (trim($house->description)) { ?>
                    <tr>

                    <!--<td valign="top" class="first_td" align="right">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_COMMENT; ?>:</strong>
                    </td>-->
                    <td colspan="2" class="second_td" align="justify">
                <?php
                positions_rem($house->description);
                ?>
                    </td>
                </tr>
        <?php }
        /*
        if ($realestatemanager_configuration['owner']['show'] && $house->ownername != '' && $house->owneremail != '') {
            ?>
                <tr>
                    <td class="first_td" align="right">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_OWNER; ?>:</strong>
                    </td>
                    <td  align="left">
                        <strong><div class="strong"><?php echo $house->ownername, ', ', $house->owneremail; ?>
                            </div></strong>
                    </td>
                </tr>
            <?php
            }
            if ($house->listing_type != 0) {
                ?>
                <tr>
                    <td class="first_td" align="right">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_LISTING_TYPE; ?>:</strong>
                    </td>
                    <td class="second_td" align="left">
                <?php
                $listing_type[0] = _REALESTATE_MANAGER_OPTION_SELECT;
                $listing_type[1] = _REALESTATE_MANAGER_OPTION_FOR_RENT;
                $listing_type[2] = _REALESTATE_MANAGER_OPTION_FOR_SALE;
                echo $listing_type[$house->listing_type];
                ?>
                    </td>
                </tr>
            <?php
            }
            if ($params->get('show_contacts_line')) {
                if ($params->get('show_contacts_registrationlevel')) {
                    if (trim($house->contacts)) {
                        ?>
                        <tr>
                            <td nowrap="nowrap" align="right" class="first_td">
                                <strong><?php echo _REALESTATE_MANAGER_LABEL_CONTACTS; ?>:</strong>
                            </td>
                            <td class="second_td" align="left">
                    <?php echo $house->contacts; ?>
                            </td>
                        </tr>
                <?php }
            }
        } ?>

        <?php
        if ($house->listing_type == 1) {
            $rent = $house->getRent();

            if ($rent == null) {
                $help['name'] = '';
                $help['until'] = '';
                $help['rent'] = '';
            } else {
                if ($rent->rent_until != null) {
                    $help['rent'] = substr($rent->rent_from, 0, 10) . "   " . substr($rent->rent_until, 0, 10);
                    $help['name'] = $rent->user_name;
                    $id = $rent->fk_houseid;
                    $database = JFactory::getDBO();
                    $select = "SELECT rent_from , rent_until FROM #__rem_rent AS a WHERE fk_houseid=" . $id . " AND rent_return IS NULL";
                    $database->setQuery($select);
                    $rents = 0;
                    $rents = $database->loadObjectList();
                    $num = count($rents);
                } else {
                    $help['rent'] = $help['rent'] . _REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL_NOT_KNOWN;
                }
            } //end else
            ?>

            <?php if (isset($rents)) { ?>
                    <td align="right" class="title_td">
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL; ?>:</strong>
                    </td>
                    <td>
                    </td>
                </tr>
                <?php
                for ($e = 0, $m = count($rents); $e < $m; $e++) {
                    print("<td align=\"right\"><strong></strong></td><td>");
                    $date = substr($rents[$e]->rent_from, 0, 10) . "   " . substr($rents[$e]->rent_until, 0, 10);
                    print_r($date);
                    print(" </td></tr>");
                }
            }
            ?>

                <?php
                }
                //end if
                ?>
        <?php if ($house->price != "" && $params->get('show_pricerequest') == '1') { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_PRICE; ?>:</strong>
                </td>
                <td>
            <?php echo $house->price . " " . $house->priceunit; ?>
                </td>
            </tr>
            <?php
            if ($house->price_type != 0) {
                $price_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PRICE_TYPE);
                $i = 1;
                foreach ($price_type1 as $price_type2) {
                    $price_type[$i] = $price_type2;
                    $i++;
                }
                ?>
                <tr>
                    <td nowrap="nowrap" align="right" class="title_td" >
                        <strong><?php echo _REALESTATE_MANAGER_LABEL_PRICE_TYPE; ?>:</strong>
                    </td>
                    <td>
                <?php echo $price_type[$house->price_type]; ?>
                    </td>
                </tr>
            <?php }
        } ?><?php
        if ($house->style != 0) {
            $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
            $i = 1;
            foreach ($style1 as $style2) {
                $style[$i] = $style2;
                $i++;
            }
            ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td" >
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_STYLE; ?>:</strong>
                </td>
                <td>
                    <?php echo $style[$house->style]; ?>
                </td>
            </tr>	<?php } ?>
        <?php
        if ($house->zoning != 0) {
            $zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_ZONING);
            $i = 1;
            foreach ($zoning1 as $zoning2) {
                $zoning[$i] = $zoning2;
                $i++;
            }
            ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td" >
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_ZONING; ?>:</strong>
                </td>
                <td>
            <?php echo $zoning[$house->zoning]; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->school)) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td" >
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL; ?>:</strong>
                </td>
                <td>
            <?php echo $house->school; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->school_district)) { ?>
            <tr>	
                <td nowrap="nowrap" align="right" class="title_td" >
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL_DISTRICT; ?>:</strong>
                </td>
                <td>
            <?php echo $house->school_district; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->bathrooms)) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td" >
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_BATHROOMS; ?>:</strong>
                </td>
                <td>
            <?php echo $house->bathrooms; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->bedrooms)) { ?>
            <tr>

                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_BEDROOMS; ?>:</strong>
                </td>
                <td>
            <?php echo $house->bedrooms; ?>
                </td>
            </tr>
        <?php } ?>

        <?php if (trim($house->area)) { ?>
            <tr>

                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_AREA; ?>:</strong>
                </td>
                <td>
            <?php echo $house->area; ?>
                </td>
            </tr>	
        <?php } ?>
        <?php if (trim($house->agent)) { ?>		
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_AGENT; ?>:</strong>
                </td>
                <td>
            <?php echo $house->agent; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->broker)) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_BROKER; ?>:</strong>
                </td>
                <td>
            <?php echo $house->broker; ?>
                </td>
            </tr><?php } ?>
        <?php
        if ($params->get('show_contacts_line')) {

            if ($params->get('show_contacts_registrationlevel')) {

                if (trim($house->contacts)) {
                    ?>		
                    <tr>
                        <td nowrap="nowrap" align="right" class="title_td" >
                            <strong><?php echo _REALESTATE_MANAGER_LABEL_CONTACTS; ?>:</strong>
                        </td>
                        <td>
                    <?php echo $house->contacts; ?>
                        </td>
                    </tr>
                        <?php }
                    }
                } ?>
        <?php if (trim($house->feature)) { ?>		<tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_FEATURE; ?>:</strong>
                </td>
                <td>
            <?php echo $house->feature; ?>
                </td>
            </tr>
        <?php } ?>
        <?php
        if ($house->listing_status != 0) {
            $listing_status1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
            $i = 1;
            foreach ($listing_status1 as $listing_status2) {
                $listing_status[$i] = $listing_status2;
                $i++;
            }
            ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td" >
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_LISTING_STATUS; ?>:</strong>
                </td>
                <td>
                    <?php echo $listing_status[$house->listing_status]; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->hoa_dues)) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_HOA_DUES; ?>:</strong>
                </td>
                <td>
                    <?php echo $house->hoa_dues; ?>
                </td>
            </tr>
        <?php } ?>
        <?php
        if ($house->property_type != 0) {
            $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
            $i = 1;
            foreach ($property_type1 as $property_type2) {
                $property_type[$i] = $property_type2;
                $i++;
            }
            ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TYPE; ?>:</strong>
                </td>
                <td>
            <?php echo $property_type[$house->property_type]; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->lot_size)) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_LOT_SIZE; ?>:</strong>
                </td>
                <td>
            <?php echo $house->lot_size; ?>
                </td>
            </tr>
        <?php } ?>
        <?php
        if ($house->provider_class != 0) {
            $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
            $i = 1;
            foreach ($provider_class1 as $provider_class2) {
                $provider_class[$i] = $provider_class2;
                $i++;
            }
            ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_PROVIDER_CLASS; ?>:</strong>
                </td>
                <td>
            <?php echo $provider_class[$house->provider_class]; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->model)) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_MODEL; ?>:</strong>
                </td>
                <td>
            <?php echo $house->model; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->year)) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_BUILD_YEAR; ?>:</strong>
                </td>
                <td>
            <?php echo $house->year; ?>
                </td>
            </tr>
        <?php } ?>
        <?php if (trim($house->expiration_date)) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_EXPIRATION_DATE; ?>:</strong>
                </td>
                <td>
            <?php echo data_transform_rem($house->expiration_date); ?>
                </td>
            </tr>
        <?php } ?>
        <?php if ($house->property_taxes > 0.00) { ?>
            <tr>
                <td nowrap="nowrap" align="right" class="title_td">
                    <strong><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TAXES; ?>:</strong>
                </td>
                <td>
            <?php echo $house->property_taxes; ?> 
                </td>
            </tr><?php }*/ ?>
            <tr>
                <td colspan="2">
                    <?php 
                    $house_feature = $house->features;
                    if (count($house_feature)) {
                        ?>
                <div class="row_text">
                    <span class="col_text_2" style="text-align: justify;">
                        <?php
                        //print_r($house_feature);
                        for ($i = 0; $i < count($house_feature); $i++) {
                            if ($realestatemanager_configuration['manager_feature_category'] == 1) {
                                if ($i != 0) {
                                    if ($house_feature[$i]->categories !== $house_feature[$i - 1]->categories)
                                        echo "<div class='house-feature-category'>" . $house_feature[$i]->categories . "</div>";
                                } else
                                    echo "<div class='house-feature-category'>" . $house_feature[$i]->categories . "</div>";
                            }
                            if ($realestatemanager_configuration['manager_feature_image'] == 1 and $house_feature[$i]->image_link != '') {
                                ?>       
                                <img alt="photo" src="<?php echo "$mosConfig_live_site/components/com_realestatemanager/featured_ico/" . $house_feature[$i]->image_link; ?>"></img>      
            <?php
        }
        echo '<span class="house-feature">'.$house_feature[$i]->name.'</span>';
        //if ($i != count($house_feature)-1) {
        //    if ($house_feature[$i]->categories == $house_feature[$i + 1]->categories) echo " ,";            
        //}
        ?>


        <?php }
    ?>
                    </span>
                </div>

                <?php }
            ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="map_canvas" class="re_map_canvas re_map_canvas_02"></div>
                </td>
            </tr>
        </table>
        <script>
            function initialize(){
                var map;
                var myLatlng=new google.maps.LatLng(<?php
                if ($house->hlatitude && $house->hlatitude != '')
                    echo $house->hlatitude;
                else
                    echo 0;
                ?>,<?php
                if ($house->hlongitude && $house->hlongitude != '')
                    echo $house->hlongitude;
                else
                    echo 0;
                ?>);
                        var myOptions = {
                            zoom: <?php if ($house->map_zoom)
                    echo $house->map_zoom;
                else
                    echo 1;
                ?>,
                    center: myLatlng,
                    scrollwheel: false,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.LARGE
                    },
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                var marker = new google.maps.Marker({ position: myLatlng });
                marker.setMap(map);
                
            }
            (function($){
                $.when(initialize()).done(function(){
                    window.print();
                });
            })(jQuery);
        </script>

        <?php
        //exit();
    }

    /**
     * Display links to categories
     */
    static function showCategories(&$params, &$categories, &$catid, &$tabclass, &$currentcat, $layout) {
        global $mosConfig_absolute_path;
        //require($mosConfig_absolute_path."/components/com_realestatemanager/views/all_categories/tmpl/".$layout.".php");
        $type = 'all_categories';
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }

    static function showAddButton($Itemid) {
        global $mosConfig_live_site;
        ?>
        <form action="<?php echo sefRelToAbs("index.php?option=com_realestatemanager&amp;task=show_add&amp;Itemid=" . $Itemid); ?>" method="post" name="show_add" enctype="multipart/form-data">
            <input  type="submit" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_ADD_HOUSE; ?>" class="button"/>
        </form>
        <?php
    }

    static function showButtonMyHouses() {
        global $mosConfig_live_site, $Itemid;
        ?>
        <form action="<?php echo sefRelToAbs("index.php?option=com_realestatemanager&amp;task=show_my_houses&amp;Itemid=" . $Itemid); ?>" method="post" name="show_my_houses">
            <input  type="submit" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_SHOW_MY_HOUSES; ?>" class="button"/>
        </form>
        <?php
    }

    static function showOwnersButton() {
        global $mosConfig_live_site, $Itemid;
        ?>
        <form action="<?php echo sefRelToAbs("index.php?option=com_realestatemanager&amp;task=owners_list&amp;Itemid=" . $Itemid); ?>" method="post" name="ownerslist">
            <input  type="submit" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_OWNERSLIST; ?>" class="button"/>
        </form>
        <?php
    }

    /*
     * function for Display
     * suggestion
     */

//*********************************   begin add for suggestion   ******************************************
    static function showSuggestion(& $params, $where, $catid, $Itemid) {
        global $mosConfig_live_site, $my;
        global $doc;

        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <script language="javascript" type="text/javascript">
            function suggestion_submitbutton() {
                var form = document.suggestion;
                if (form.title.value == "") {
                    alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_SUGGESTION_TITEL; ?>" );
                } else if (form.comment == "") {
                    alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_SUGGESTION_COMMENT; ?>" );
                } else { form.submit(); }
            }
            function hidden_suggestion_on(is_hide) {
                var el  = document.getElementById('hidden_suggestion');
                var el2 = document.getElementById('show_suggestion');
                if( is_hide ) {
                    el.style.display = 'none';
                    el2.style.display = 'block';
                } else {
                    el.style.display = 'block';
                    el2.style.display = 'none';
                }
            }
        </script>
        <div id="hidden_suggestion" style="<?php if (isset($_REQUEST['err_msg'])) {
                    echo 'display:none';
                } ?>">
            <input type="submit" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_ADD_SUGGESTION; ?>" class="button" onclick="javascript:hidden_suggestion_on(true)"/>
        </div>
        <div id="show_suggestion" style="<?php if (isset($_REQUEST['err_msg'])) {
                    echo 'display:block';
                } else {
                    echo 'display:none';
                } ?>" >

            <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>"> 
                        <?php echo _REALESTATE_MANAGER_LABEL_SUGGESTION; ?>
            </div> 

            <form action="<?php echo sefRelToAbs("index.php?option=com_realestatemanager&task=suggestion&Itemid=" . $Itemid); ?>" method="post" name="suggestion">

                <div class="table_57">

                    <div class="row_01">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_SUGGESTION_TITLE; ?></span>
                        <br />
                        <input class="inputbox" type="text" name="title" maxlength="75" size="50" value="<?php if (isset($_REQUEST["title"])) {
                    echo $_REQUEST["title"];
                } ?>" />
                    </div>

                    <div class="row_02">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_SUGGESTION_COMMENT; ?>
        <?php
        $comm_val = "";
        if (isset($_REQUEST["comment"])) {
            $comm_val = $_REQUEST["comment"];
        }
        ?></span>
                        <br />
                        <textarea name="comment" cols="50" rows="8"><?php echo $comm_val; ?></textarea>   
                    </div>

                    <!--*****************************   begin add antispam in suggestion   ************************-->
        <?php
        $user_guest = userGID_REM($my->id);
        if (($user_guest == 0) || ($user_guest < 0)) {
            ?>
                        <div class="row_03">
                            <!--********************************   begin insert image   ***********************************-->
            <?php
//    @session_start();
            // begin create kod
            $st = "      ";
            $algoritm = mt_rand(1, 2);
            switch ($algoritm) {
                case 1:
                    for ($j = 0; $j < 6; $j+=2) {
                        $st = substr_replace($st, chr(mt_rand(97, 122)), $j, 1); //abc
                        $st = substr_replace($st, chr(mt_rand(50, 57)), $j + 1, 1); //23456789
                    }
                    break;
                case 2:
                    for ($j = 0; $j < 6; $j+=2) {
                        $st = substr_replace($st, chr(mt_rand(50, 57)), $j, 1); //23456789
                        $st = substr_replace($st, chr(mt_rand(97, 122)), $j + 1, 1); //abc
                    }
                    break;
            }

            //**************   begin search in $st simbol 'o, l, i, j, t, f'   ********************************
            $st_validator = "olijtf";
            for ($j = 0; $j < 6; $j++) {
                for ($i = 0; $i < strlen($st_validator); $i++) {
                    if ($st[$j] == $st_validator[$i]) {
                        $st[$j] = chr(mt_rand(117, 122)); //uvwxyz
                    }
                }
            }

            //**************   end search in $st simbol 'o, l, i, j, t, f'   **********************************
            $session = JFactory::getSession();
            $session->set('captcha_keystring', $st);

            if (isset($_REQUEST['error']) && $_REQUEST['error'] != "")
                echo "<font style='color:red'>" . $_REQUEST['error'] . "</font><br />";
            $name_user = "";
            if (isset($_REQUEST['name_user']))
                $name_user = $_REQUEST['name_user'];

            if (isset($_REQUEST["err_msg"]))
                echo "<script> alert('Error: " . $_REQUEST["err_msg"] . "'); </script>\n";

            echo "<br /><img src='" . $mosConfig_live_site . "/index.php?option=com_realestatemanager&amp;task=secret_image' alt='CAPTCHA_picture'/><br/>";
            ?>
                            <!--****************************   end insetr image   ***********************************-->
                        </div>

                        <div class="row_04">
                            <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_KEYGUEST; ?></span>
                            <br />
                            <input class="inputbox" type="text" name="keyguest" size="6" maxlength="6" />
                        </div>

        <?php } ?>
                    <!--****************************   end add antispam in suggestion   ************************-->

                    <div class="row_05">
                        <input class="button" type="button" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_SAVE; ?>" onclick="suggestion_submitbutton()"/>
                        <input class="button" type="button" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_SUGGEST_HIDE; ?>" onclick="javascript:hidden_suggestion_on(false)"/>
                    </div>
                    <div class="row_06">
                        <input type="hidden" name="where" value="<?php echo $where; ?>" />
                        <input type="hidden" name="catid" value="<?php echo $catid; ?>" />
                        <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
                        <input type="hidden" name="nado_back" value="0" />
                    </div>
                </div>

            </form>
        </div> <!-- show_suggestion END-->
        <br />

                <?php
            }

//end showSuggestion()
//********************************   end add for suggestion   **************************************

            static function listCategories(&$params, $cat_all, $catid, $tabclass, $currentcat) {
                global $Itemid, $mosConfig_live_site, $doc;
                $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
                ?>
        <?php positions_rem($params->get('allcategories04')); ?>
        <div class="basictable table_58">
            <div class="row_01">
                <span class="col_01 sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
            <?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?>
                </span>
                <?php if ($params->get('rss_show')): ?>
                    <span class=" col_03 sectiontableheader">
                        <a href="<?php echo sefRelToAbs("index.php?option=com_realestatemanager&task=show_rss_categories&Itemid=" . $Itemid); ?>">
                            <img src="./components/com_realestatemanager/images/rss.png" alt="All categories RSS" align="right" title="All categories RSS"/>
                        </a>
                    </span>
        <?php endif; ?>
                <span class="col_02 sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
        <?php echo _REALESTATE_MANAGER_LABEL_HOUSES; ?> 
                </span>
            </div>
            <div class="row_02">
        <?php positions_rem($params->get('allcategories05')); ?>
        <?php HTML_realestatemanager::showInsertSubCategory($catid, $cat_all, $params, $tabclass, $Itemid, 0); ?>
            </div>
        </div>

        <?php positions_rem($params->get('allcategories06')); ?>
    <?php
    }

    /* function for show subcategory */

    static function showInsertSubCategory($id, $cat_all, $params, $tabclass, $Itemid, $deep) {
        global $g_item_count, $realestatemanager_configuration, $mosConfig_live_site;
        global $doc;

        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');

        $deep++;
        for ($i = 0; $i < count($cat_all); $i++) {
            if (($id == $cat_all[$i]->parent_id) && ($cat_all[$i]->display == 1)) {
                $g_item_count++;

                $link = 'index.php?option=com_realestatemanager&amp;task=showCategory&amp;catid=' . $cat_all[$i]->id . '&amp;Itemid=' . $Itemid;
                ?>
                <div class="table_59 <?php echo $tabclass[($g_item_count % 2)]; ?>">
                    <span class="col_01">
                <?php
                if ($deep != 1) {
                    $jj = $deep;
                    while ($jj--) {
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    echo "&nbsp;|_";
                }
                ?>
                    </span>
                    <span class="col_01">
                <?php if (($params->get('show_cat_pic')) && ($cat_all[$i]->image != "")) { ?>
                            <img src="./images/stories/<?php echo $cat_all[$i]->image; ?>" alt="picture for subcategory" height="48" width="48" />&nbsp;
                    <?php } else {
                    ?>
                            <a <?php echo "href=" . sefRelToAbs($link); ?> class="category<?php echo $params->get('pageclass_sfx'); ?>" style="text-decoration: none"><img src="./components/com_realestatemanager/images/folder.png" alt="picture for subcategory" height="48" width="48" /></a>&nbsp;
                <?php } ?>
                    </span>
                    <span class="col_02">
                        <a href="<?php echo sefRelToAbs($link); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
                <?php echo $cat_all[$i]->title; ?>
                        </a>
                    </span>
                <?php if ($params->get('rss_show')): ?>
                        <span class="col_04">
                            <a href="<?php echo sefRelToAbs("index.php?option=com_realestatemanager&task=show_rss_categories&catid=" . $cat_all[$i]->id . "&Itemid=" . $Itemid); ?>">
                                <img src="./components/com_realestatemanager/images/rss2.png" alt="Category RSS" align="right" title="Category RSS"/>
                            </a>
                        </span>
                <?php endif; ?>
                    <span class="col_03">
                <?php if ($cat_all[$i]->houses == '') echo "0";else echo $cat_all[$i]->houses; ?>
                    </span>
                </div>
                <?php
                if ($realestatemanager_configuration['subcategory']['show'])
                    HTML_realestatemanager::showInsertSubCategory($cat_all[$i]->id, $cat_all, $params, $tabclass, $Itemid, $deep);
            }//end if ($id == $cat_all[$i]->parent_id)
//	    $z = 1 - $z;
        }//end for(...)	
    }

//end function showInsertSubCategory($id, $cat_all)

    static function showSearchHouses($params, $currentcat, $clist, $option, $layout = "default", $task="") {
        global $mosConfig_absolute_path;
        $type = 'show_search_house';
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }

/////////////////////////////////////

    static function showRssCategories($params, &$categories, &$catid) {
        global $hide_js, $Itemid, $acl, $mosConfig_live_site, $my;
        global $limit, $total, $limitstart, $paginations, $mainframe, $realestatemanager_configuration;
        global $doc;
        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        $mosConfig_live_site_http = JURI::root();
        header("Content-Type: application/rss+xml; charset=utf-8");
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<!-- generator="AdvertisementBoard" -->' . "\n";
        echo '<?xml-stylesheet href="" type="text/css"?>' . "\n";
        echo '<?xml-stylesheet href="" type="text/xsl"?>' . "\n";
        echo '<rss version="2.0">' . "\n";
        echo "<channel>\n";
        if (!$categories) {
            echo "<title>" . $mosConfig_live_site_http . " - " . _REALESTATE_MANAGER_TITLE . "</title>\n";
            echo "<description>" . _REALESTATE_MANAGER_TITLE . " - " . _REALESTATE_MANAGER_ERROR_HAVENOT_HOUSES_RSS . "</description>\n";
        } else {
            if (!$catid) {
                echo "<title>" . $mosConfig_live_site_http . " - " . _REALESTATE_MANAGER_TITLE . " - ALL</title>\n";
                echo "<description><![CDATA[" . _REALESTATE_MANAGER_TITLE . "  " . $categories[0]->cdesc . "]]></description>\n";
            } else {
                echo "<title>" . $mosConfig_live_site_http . " - " . _REALESTATE_MANAGER_TITLE . " - " . $categories[0]->ctitle . "</title>\n";
                echo "<description><![CDATA[" . _REALESTATE_MANAGER_TITLE . "  " . $categories[0]->cdesc . "]]></description>\n";
            }
        }
        echo "<link>" . $mosConfig_live_site . "</link>\n";
        echo "<lastBuildDate>" . date("Y-m-d H:i:s") . "</lastBuildDate>\n";
        echo "<generator>" . _REALESTATE_MANAGER_TITLE . "</generator>\n";

        for ($i = 0; $i < count($categories); $i++) {
            //Select list for listing type
            $listing_type[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $listing_type[1] = _REALESTATE_MANAGER_OPTION_FOR_RENT;
            $listing_type[2] = _REALESTATE_MANAGER_OPTION_FOR_SALE;
            //Select list for price type
            $price_type[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $price_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PRICE_TYPE);
            $j = 1;
            foreach ($price_type1 as $price_type2) {
                $price_type[$j] = $price_type2;
                $j++;
            }
            //Select list for listing status type
            $listing_status_type[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $listing_status_type1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
            $j = 1;
            foreach ($listing_status_type1 as $listing_status_type2) {
                $listing_status_type[$j] = $listing_status_type2;
                $j++;
            }
            //Select list for property type
            $property_type[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
            $j = 1;
            foreach ($property_type1 as $property_type2) {
                $property_type[$j] = $property_type2;
                $j++;
            }
            //Select list for provider class
            $provider_class[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
            $j = 1;
            foreach ($provider_class1 as $provider_class2) {
                $provider_class[$j] = $provider_class2;
                $j++;
            }
            //Select list for zoning
            $zoning[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_ZONING);
            $j = 1;
            foreach ($zoning1 as $zoning2) {
                $zoning[$j] = $zoning2;
                $j++;
            }
            //Select style
            $style[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
            $j = 1;
            foreach ($style1 as $style2) {
                $style[$j] = $style2;
                $j++;
            }

            $category = $categories[$i];
            echo "<item>";
            echo "<title>" . $category->htitle . "</title>" . "\n";
            echo "<link>" . $mosConfig_live_site_http . "/index.php?option=com_realestatemanager&amp;Itemid=" .
            $Itemid . "&amp;task=view&amp;id=" . $category->bid . "&amp;catid=" . $category->cid . "</link>" . "\n";
            echo "<description><![CDATA[";
            if ($category->image_link) {
                $imagebase = $category->image_link;
                $image = $mosConfig_live_site . '/components/com_realestatemanager/photos/' . $imagebase;
                echo "<br /><img src='" . $image . "' />";
            }
            if (trim($category->description))
                echo "<br /><description><b>" . _REALESTATE_MANAGER_LABEL_DESCRIPTION . ": </b>" . $category->description . "</description>";
            if ($category->listing_type != 0)
                echo "<br /><listing_type><b>" . _REALESTATE_MANAGER_LABEL_LISTING_TYPE . ": </b>" . $listing_type[$category->listing_type] . "</listing_type>";
            if ($category->price > 0)
                echo "<br /><price><b>" . _REALESTATE_MANAGER_LABEL_PRICE . ": </b>" . $category->price . "</price>";
            if ($category->price_type != 0)
                echo "<br /><price_type><b>" . _REALESTATE_MANAGER_LABEL_PRICE_TYPE . ": </b>" . $price_type[$category->price_type] . "</price_type>";
            if (trim($category->hlocation))
                echo "<br /><hlocation><b>" . _REALESTATE_MANAGER_LABEL_ADDRESS . ": </b>" . $category->hlocation . "</hlocation>";
            echo "<br /><owner><b>" . _REALESTATE_MANAGER_LABEL_OWNER . ": </b>" . $category->owneremail . "</owner>";
            if (trim($category->year))
                echo "<br /><year><b>" . _REALESTATE_MANAGER_LABEL_YEAR . ": </b>" . $category->year . "</year>";
            if (trim($category->bathrooms))
                echo "<br /><bathrooms><b>" . _REALESTATE_MANAGER_LABEL_BATHROOMS . ": </b>" . $category->bathrooms . "</bathrooms>";
            if (trim($category->bedrooms))
                echo "<br /><bedrooms><b>" . _REALESTATE_MANAGER_LABEL_BEDROOMS . ": </b>" . $category->bedrooms . "</bedrooms>";
            if ($category->listing_status != 0)
                echo "<br /><listing_status><b>" . _REALESTATE_MANAGER_LABEL_LISTING_STATUS . ": </b>" . $listing_status_type[$category->listing_status] . "</listing_status>";
            if (trim($category->contacts))
                if ($params->get('show_contacts_line')) {
                    if ($params->get('show_contacts_registrationlevel')) {
                        echo "<br /><contacts><b>" . _REALESTATE_MANAGER_LABEL_CONTACTS . ": </b>" . $category->contacts . "</contacts>";
                    }
                }
            if (trim($category->broker))
                echo "<br /><broker><b>" . _REALESTATE_MANAGER_LABEL_BROKER . ": </b>" . $category->broker . "</broker>";
            if (trim($category->area))
                echo "<br /><area><b>" . _REALESTATE_MANAGER_LABEL_AREA . ": </b>" . $category->area . "</area>";
            if ($category->zoning != 0)
                echo "<br /><zoning><b>" . _REALESTATE_MANAGER_LABEL_ZONING . ": </b>" . $zoning[$category->zoning] . "</zoning>";
            echo "]]></description>\n";
            echo "<pubDate>" . $category->date . "</pubDate>\n";
            echo "</item>\n";
        }
        ?>
        </channel>
        </rss>
            <?php
            exit;
        }

        static function showOwnersList(&$params, &$ownerslist, &$pageNav, &$layout = "default") {
            global $mosConfig_absolute_path, $realestatemanager_configuration;
            //require($mosConfig_absolute_path."/components/com_realestatemanager/views/owner_houses/tmpl/".$layout.".php");
            $type = 'owner_houses';
            require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
        }

        static function showRentRequestThanks($params, $currentcat,$houseid=NULL,$time_difference=NULL) {
            global $Itemid, $doc, $mosConfig_live_site, $hide_js, $catid, $option, $realestatemanager_configuration;;
            $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
            ?>
        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
        <?php echo $currentcat->header; ?>
        </div>
        <?php
        if($houseid){
            $business = $realestatemanager_configuration['pay_pal_buy']['business'];
            $return = $realestatemanager_configuration['pay_pal_buy']['return'];
            $item_name = $houseid->htitle;							//'Donate to website.com';
            $image_url = $realestatemanager_configuration['pay_pal_buy']['image_url'] ;
            $cancel_return =  $realestatemanager_configuration['pay_pal_buy']['cancel_return'];
            $paypal_real_or_test =  $realestatemanager_configuration['paypal_real_or_test']['show'];

            if($paypal_real_or_test==0)
                $paypal_path = 'www.sandbox.paypal.com';        
            else
                $paypal_path = 'www.paypal.com';
        
            if($time_difference){
                $amount = $time_difference[0]; // price
                $currency_code = $time_difference[1] ; // priceunit  
            }
            else{
                $amount= $houseid->price;
                $currency_code = $houseid->priceunit;
            }
        
        $amountLine='';
        $amountLine .= '<input type="hidden" name="amount" value="'.$amount.'" />'."\n"; 
        }
        ?> 
        
        <div class="save_add_table">
        <?php
        if ($currentcat->img != null) {
            ?>
                <img src="<?php echo $currentcat->img; ?>" alt="?" />
                <?php
            }
            ?>
            <div class="descrip"><?php echo $currentcat->descrip; ?></div>  
        </div>
        <form action="<?php
            echo sefRelToAbs("index.php?option=com_realestatemanager&view=all_categories&layout=allcategories&amp;Itemid=" . $Itemid);
        ?>" method="post" name="userForm">
            <input type="submit" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_OK; ?>" class="button" />
        </form>
        <?php
        if ($option != 'com_realestatemanager') {
            $form_action = "index.php?option=" . $option . "&tab=getmyhousesTab&Itemid=" . $Itemid . '#tabs-2';
        }
        else
            $form_action = "index.php?option=com_realestatemanager&Itemid=" . $Itemid;
    }

    static function showTabs(&$params, &$userid, &$username, &$comprofiler, &$option) {
        $option = 'com_realestatemanager';
        ?>
        <div class='button_margin'>
        <?php
        if ($params->get('show_cb')) {
            if ($params->get('show_cb_registrationlevel')) {
                //    if ($option!="com_realestatemanager"){
                ?>
                    <span class='house_button'>
                        <a href="<?php echo JRoute::_('index.php?option=' . $option . '&task=my_houses&tab=getmyhousesTab&name=' . $username . '&user=' . $userid . '&is_show_data=1' . '#tabs-2'); ?>"><?php echo _REALESTATE_MANAGER_SHOW_TABS_SHOW_MY_HOUSES; ?></a>
                    </span>
                            <?php
                            //  }
                        }
                    }
                    if ($params->get('show_edit')) {
                        if ($params->get('show_edit_registrationlevel')) {
                            ?>
                    <span class='house_button'>
                        <a href="<?php echo JRoute::_('index.php?option=' . $option . '&task=my_houses' . $comprofiler . '#tabs-2', false); ?>"><?php echo _REALESTATE_MANAGER_SHOW_TABS_EDIT_MY_HOUSES; ?></a>
                    </span>
                <?php
            }
        }
        if ($params->get('show_rent')) {
            if ($params->get('show_rent_registrationlevel')) {
                ?>
                    <span class='house_button'>
                        <a href="<?php echo JRoute::_('index.php?option=' . $option . '&task=rent_requests' . $comprofiler . '#tabs-2', false); ?>"><?php echo _REALESTATE_MANAGER_SHOW_TABS_RENT_REQUESTS; ?></a>
                    </span>
                <?php
            }
        }
        if ($params->get('show_buy')) {
            if ($params->get('show_buy_registrationlevel')) {
                ?>
                    <span class='house_button'>
                        <a href="<?php echo JRoute::_('index.php?option=' . $option . '&task=buying_requests' . $comprofiler . '#tabs-2', false); ?>"><?php echo _REALESTATE_MANAGER_SHOW_TABS_BUYING_REQUESTS; ?></a>
                    </span>
                        <?php
                    }
                }
                if ($params->get('show_history')) {
                    if ($params->get('show_history_registrationlevel')) {
                        ?>
                    <span class='house_button'>
                        <a href="<?php echo JRoute::_('index.php?option=' . $option . '&task=rent_history' . $comprofiler . '#tabs-2', false); ?>"><?php echo _REALESTATE_MANAGER_LABEL_CBHISTORY_ML; ?></a>
                    </span>
                        <?php
                    }
                }
                ?>
        </div>
                <?php
            }

            static function showMyHouses(&$houses, &$params, &$pageNav, $option, $layout = "default") {
                global $mosConfig_absolute_path;
                //require($mosConfig_absolute_path."/components/com_realestatemanager/views/my_houses/tmpl/".$layout.".php");
                $type = 'my_houses';
                require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
            }

            static function showRentHouses($option, $rows, & $userlist, $type) {
                global $my, $mosConfig_live_site, $mainframe, $doc, $Itemid, $realestatemanager_configuration;
                $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
                $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
                ?>
        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
        <form action="index.php" method="get" name="adminForm" id="adminForm">
                <?php
                if ($type == "rent" || $type == "edit_rent") {
                    ?>
                <div class="my_real_table_rent">
                    <div class="my_real">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TO . ":"; ?></span>
                        <span class="col_02"><?php echo $userlist; ?></span>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_USER . ":"; ?></span>
                        <span class="col_02"><input type="text" name="user_name" class="inputbox" /></span>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_EMAIL . ":"; ?></span>
                        <span class="col_02"><input type="text" name="user_email" class="inputbox" /></span>
                    </div>
                    <script>
                        Date.prototype.toLocaleFormat = function(format) {
                            var f = {Y : this.getYear() + 1900,m : this.getMonth() + 1,d : this.getDate(),H : this.getHours(),M : this.getMinutes(),S : this.getSeconds()}
                            for(k in f)
                                format = format.replace('%' + k, f[k] < 10 ? "0" + f[k] : f[k]);
                            return format;
                        };
                                
                        window.onload = function ()

                        {
                            var today = new Date();
                            var date = today.toLocaleFormat("<?php echo $realestatemanager_configuration['date_format'] ?>");
                            document.getElementById('rent_from').value = date;
                            document.getElementById('rent_until').value = date;
                        };

                    </script>
                    <div class="my_real">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM . ":"; ?></span>
                            <?php echo JHtml::_('calendar', date("Y-m-d"), 'rent_from', 'rent_from', $realestatemanager_configuration['date_format']); ?>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TIME; ?></span>
            <?php echo JHtml::_('calendar', date("Y-m-d"), 'rent_until', 'rent_until', $realestatemanager_configuration['date_format']); ?>
                    </div>
                </div>


        <?php } else { ?>
                &nbsp;
        <?php } ?>

            <div class="table_63">

                <div class="row_01">
                    <span class="col_01">
        <?php if ($type != 'rent') {
            ?>
                            <input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this);" />
                            <span class="toggle_check">check All</span>
        <?php } ?>
                    </span>
          <!--<span class="col_02 title">id</span>
              <span class="col_03 title"><?php // echo _REALESTATE_MANAGER_LABEL_HOUSEID;  ?></span>
              <span class="col_04 title"><?php // echo _REALESTATE_MANAGER_LABEL_TITLE;  ?></span>
              <span class="col_05 title"><?php // echo _REALESTATE_MANAGER_LABEL_RENT_FROM;  ?></span>
              <span class="col_06 title"><?php // echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL;  ?></span>
              <span class="col_07 title"><?php // echo _REALESTATE_MANAGER_LABEL_RENT_RETURN;  ?></span>
              <span class="col_08 title"><?php // echo _REALESTATE_MANAGER_LABEL_RENT_TO;  ?></span>-->
                </div>

        <?php
        for ($i = 0, $n = count($rows); $i < $n; $i++) {
            $row = $rows[$i];
            //error for this row rent was called even if the House is already lent out
            if ($row->rent_from != null && $type == "rent") {
                ?>
                        &nbsp;
                        <?php
                        //rent was called for a correct House
                    } else if ($row->rent_from == null && $type == "rent") {
                        //rent return was called on a House which was not rent out
                    } else if ($row->rent_from == null && $type == "rent_return") {
                        ?>
                        &nbsp;
                <?php
                //rent return was called correctly
            } else if ($row->rent_from != null && $type == "rent_return") {
                
            } else {
                ?>
                        &nbsp;
            <?php } ?>
                    <input class="inputbox" type="hidden" name="houseid" id="houseid" size="0" maxlength="0" value="<?php echo $row->houseid; ?>" />
                    <input class="inputbox" type="hidden" name="id" id="id" size="0" maxlength="0" value="<?php echo $row->id; ?>" />
                    <input class="inputbox" type="hidden" name="htitle" id="htitle" size="0" maxlength="0" value="<?php echo $row->htitle; ?>" />
                <?php
                $house = $row->id;
                $title = $row->htitle;
                $data = JFactory::getDBO();
                $query = "SELECT l.*,u.name FROM #__rem_rent as l LEFT JOIN #__users AS u ON l.fk_userid = u.id WHERE fk_houseid =" . $house . " ORDER BY rent_return ";
                $data->setQuery($query);

                /* $house=$row->houseid;
                  $title=$row->htitle;
                  $data = JFactory::getDBO();
                  $query ="SELECT * FROM #__rem_rent WHERE fk_houseid=".$house." ORDER BY rent_return ";
                  $data->setQuery($query); */
                $allrent = $data->loadObjectList();
                if ($type == "rent") {
                    ?>

                        <div class="real_my_rent">
                            <input class="inputbox" type="checkbox" name="checkHouse" id="checkHouse" size="0" maxlength="0" value="on" />
                            <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></span> 
                            <span class="col_02"><?php echo $row->houseid; ?></span>
                            <span class="col_03"><?php echo $title; ?></span>
                        </div>

                <?php
                print_r("<hr />");
            } else if ($type == "edit_rent") {
                ?>

                        <input type="hidden" name="checkHouse" id="checkHouse" value="on" /></td>
                <?php
            }
            $num = 1;
            for ($i = 0, $n = count($allrent); $i < $n; $i++) {
                ?>

                        <div class="box_rent_real">

                            <div class="row_01 row_rent_real">
                        <?php if (!isset($allrent[$i]->rent_return) && $type != "rent") {
                            ?>
                                    <span class="rent_check_vid">
                                        <input type="checkbox" id="cb<?php echo $i; ?>" name="bid[]" value="<?php echo $allrent[$i]->id; ?>" onClick="isChecked(this.checked);" />
                                    </span>
                        <?php } else {
                            ?>
                        <?php } ?>
                                <span class="col_01">id</span>
                                <span class="col_02"><?php echo $num; ?></span>
                            </div>

                            <div class="row_02 row_rent_real">
                                <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></span>  
                                <span class="col_02"><?php echo $row->houseid; ?></span>
                            </div>

                            <div class="row_03 row_rent_real">
                        <?php echo $row->htitle; ?>
                            </div>

                            <div class="from_until_return">
                                <div class="row_04 row_rent_real">
                                    <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM; ?></span>  
                                    <span class="col_02"><?php echo data_transform_rem($allrent[$i]->rent_from); ?></span>
                                </div>
                                <br />
                                <div class="row_05 row_rent_real">
                                    <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL; ?></span>  
                                    <span class="col_02"><?php echo data_transform_rem($allrent[$i]->rent_until); ?></span>
                                </div>
                                <br />
                                <div class="row_06 row_rent_real">
                                    <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_RETURN; ?></span>  
                                    <span class="col_02"><?php echo data_transform_rem($allrent[$i]->rent_return); ?></span>
                                </div>
                            </div>

                        </div>
                <?php
                if ($allrent[$i]->fk_userid != null)
                    print_r("<div class='rent_user'>" . $allrent[$i]->name . "</div>");
                else
                    print_r("<div class='rent_user'>" . $allrent[$i]->user_name . $allrent[$i]->user_email . "</div>");
                $num++;
            }
        }
        ?>
            </div> <!-- table_63 -->


            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" id="adminFormTaskInput" name="task" value="" />
            <input type="hidden" name="save" value="1" />
            <input type="hidden" name="boxchecked" value="1" />
                        <?php
                        if ($option != "com_realestatemanager") {
                            ?>
                <input type="hidden" name="tab" value="getmyhousesTab" />
                <input type="hidden" name="is_show_data" value="1" />
                    <?php
                }
                ?>
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

                        <?php if ($type == "rent") { ?>
                <input type="button" name="rent_save" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_RENT; ?>" onclick="rem_buttonClickRent(this)"/>
                        <?php } ?>
        <?php if ($type == "rent_return") { ?>
                <input type="button" name="rentout_save" value="<?php echo _REALESTATE_MANAGER_LABEL_RENT_RETURN; ?>" onclick="rem_buttonClickRent(this)"/>
                        <?php } ?>
        </form>
        <?php
    }

    static function showRentHistory($option, $rows, $pageNav) {
        global $my, $Itemid, $mosConfig_live_site, $mainframe, $doc;
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");
        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <form action="index.php" method="get" name="adminForm" id="adminForm">







            <table class="table_64">
                <tr>
                    <th align = "center" width="30">#</th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                    <th align = "center" class="title" width="25%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_RETURN; ?></th>
            <!--<th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TO; ?></th>-->
                </tr>
                <?php
                $numb = 0;
                for ($i = 0, $n = count($rows); $i < $n; $i++) {
                    $row = $rows[$i];
                    $house = $row->id;
                    $title = $row->htitle;
                    $numb++;
                    print_r("<td align=\"center\">" . $numb . "</td>
                         <td align=\"center\">" . $row->houseid . "</td>
                         <td align=\"center\">" . $row->htitle . "</td>
                         <td align=\"center\">" . data_transform_rem($row->rent_from) . "</td>
                         <td align=\"center\">" . data_transform_rem($row->rent_until) . "</td>
                         <td align=\"center\">" . data_transform_rem($row->rent_return) . "</td></tr>");
                }
                ?>

            </table>

            <div id="pagenavig">
            <?php
            $paginations = $arr;
            if ($paginations && ($pageNav->total > $pageNav->limit))
                echo $pageNav->getPagesLinks();
            ?>
            </div>

        </form>
        <?php
    }

    static function showRequestRentHouses($option, $rent_requests, & $pageNav) {
        global $my, $mosConfig_live_site, $mainframe, $doc, $Itemid;
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <form action="index.php" method="get" name="adminForm" id="adminForm">
            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="basictable table_65">
                <tr>
                    <th align = "center" width="20">
                        <input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this);" />
                    </th>
                    <th align = "center" width="30">#</th>
                    <th align = "center" class="title" width="10%" nowrap="nowrap">
        <?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM; ?></th>
                    <th align = "center" class="title" width="10%" nowrap="nowrap">
        <?php echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL; ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap">
        <?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap">
        <?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap">
        <?php echo _REALESTATE_MANAGER_LABEL_RENT_USER; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap">
                <?php echo _REALESTATE_MANAGER_LABEL_RENT_EMAIL; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap">
                <?php echo _REALESTATE_MANAGER_LABEL_RENT_ADRES; ?></th>
                </tr>
        <?php
        for ($i = 0, $n = count($rent_requests); $i < $n; $i++) {
            $row = $rent_requests[$i];
            ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td width="20" align="center">
                            <?php
                            echo mosHTML::idBox($i, $row->id, 0, 'bid');
                            ?>
                        </td>
                        <td align = "center"><?php echo $row->id; ?></td>
                        <td align = "center">
                            <?php echo $row->rent_from; ?>
                        </td>
                        <td align = "center">
            <?php echo $row->rent_until; ?>
                        </td>
                        <td align = "center">
            <?php
            $data = JFactory::getDBO();
            $query = "SELECT houseid FROM #__rem_houses where id = " . $row->fk_houseid . " ";
            $data->setQuery($query);
            $houseid = $data->loadObjectList();
            echo $houseid[0]->houseid;
            ?>
                        </td>
                        <td align = "center">
            <?php echo $row->htitle; ?>
                        </td>
                        <td align = "center">
                    <?php echo $row->user_name; ?>
                        </td>
                        <td align = "center">
                            <a href=mailto:"<?php echo $row->user_email; ?>">
                    <?php echo $row->user_email; ?>
                            </a>
                        </td>
                        <td align = "center">
                <?php echo $row->user_mailing; ?>
                        </td>
                    </tr>
                <?php
            }
            ?>
                <tr>
                    <td colspan = "6" align="center" id="pagenavig">
            <?php
            $paginations = $arr;
            if ($paginations && ($pageNav->total > $pageNav->limit)) {
                echo $pageNav->getPagesLinks();
            }
            ?>
                    </td>
                </tr>

            </table>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
        <?php
        if ($option != "com_realestatemanager") {
            ?>
                <input type="hidden" name="tab" value="getmyhousesTab" />
                <input type="hidden" name="is_show_data" value="1" />
            <?php
        }
        ?>
            <input type="hidden" id="adminFormTaskInput" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
            <input type="button" name="acceptButton" value="accept request" onclick="rem_buttonClickRentRequest(this)"/>
            <input type="button" name="declineButton" value="decline request" onclick="rem_buttonClickRentRequest(this)"/>
        </form>
        <?php
    }

    static function showRequestBuyingHouses($option, $buy_requests, $pageNav, $Itemid) {

        global $my, $mosConfig_live_site, $mainframe, $doc;
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <form action="index.php" method="get" name="adminForm" id="adminForm">

            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="basictable table_66">
                <tr>
                    <th align = "center" width="20"><input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this);" /></th>
                    <th align = "center" width="30">#</th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_USER; ?></th>
                    <th align = "center" class="title"  nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_COMMENT; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_EMAIL; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_BUYING_ADRES; ?></th>
                </tr>
        <?php
        for ($i = 0, $n = count($buy_requests); $i < $n; $i++) {
            $row = $buy_requests[$i];
            ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td width="20">
            <?php if ($row->fk_rentid != 0) { ?>
                                &nbsp;
                <?php
            } else {
                ?>
                                <div align = "center">
                <?php echo mosHTML::idBox($i, $row->id, ($row->fk_rentid != 0), 'bid'); ?>
                                </div>
                <?php
            }
            ?>
                        </td>
                        <td align = "center"><?php echo $row->id; ?></td>
                        <td align = "center"><?php echo $row->fk_houseid; ?></td>
                        <td align = "center"><?php echo $row->hlocation; ?></td>
                        <td align = "center"><?php echo $row->customer_name; ?></td>
                        <td align = "center" width="30%"><?php echo $row->customer_comment; ?></td>
                        <td align = "center">
                            <a href=mailto:"<?php echo $row->customer_email; ?>">
            <?php echo $row->customer_email; ?>
                            </a>
                        </td>
                        <td align = "center"><?php echo $row->customer_phone; ?></td>
                    </tr>
        <?php } ?>
            </table>

            <div id="pagenavig">
        <?php
        $paginations = $arr;
        if ($paginations && ($pageNav->total > $pageNav->limit)) {
            echo $pageNav->getPagesLinks();
        }
        ?>
            </div>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
        <?php
        if ($option != "com_realestatemanager") {
            ?>
                <input type="hidden" name="tab" value="getmyhousesTab" />
                <input type="hidden" name="is_show_data" value="1" />
            <?php
        }
        ?>
            <input type="hidden" id="adminFormTaskInput" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
            <input type="button" name="acceptButton" value="accept request" onclick="rem_buttonClickBuyRequest(this)"/>
            <input type="button" name="declineButton" value="decline request" onclick="rem_buttonClickBuyRequest(this)"/>
        </form>
        <?php
    }
    
}

//class html
