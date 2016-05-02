<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
$session = JFactory::getSession();
$arr = $session->get("array", "default");
global $hide_js, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path, $database, $doc, $my;
global $limit, $total, $limitstart, $task, $paginations, $mainframe, $realestatemanager_configuration;
global $languagelocale;
/* if($option != "com_realestatemanager") PHP_realestatemanager::showTabs(); */
$doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');

if (version_compare(JVERSION, "3.0.0", "lt"))
    JHTML::_('behavior.mootools');
else
    JHtml::_('behavior.framework', true);

?>

<style>

#loading_houses{
    display:none;
    text-align: center;
}

.glyphicon-refresh-animate {
    font-size: 75px;
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}

#fast_search>div{
    padding: 10px;
    margin-top: -30px;
    margin-bottom: 60px;
}

#remove_keywords {
    border: 0;
    color: #e55727;
    text-decoration: underline;
    background-color: #f0f0f0;
}

#remove_keywords:hover {
    color: #ffb001;
}

#searched_keywords {
    color: #e55727;
    font-weight: bold;
}
    
</style>

<script type="text/javascript">
    function rem_rent_request_submitbutton() {
        var form = document.userForm;
        if (form.user_name.value == "") {
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_NAME; ?>" );
        } else if (form.user_email.value == "" || !isValidEmail(form.user_email.value)) {
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_EMAIL; ?>" );
        } else if (form.user_mailing == "") {
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_MAILING; ?>" );
        } else if (form.rent_until.value == "") {   
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_UNTIL; ?>" );
        } else {
            form.submit();
        }
    }
        
    function isValidEmail(str) {
        return (str.indexOf("@") > 1);
    }

    function allreordering(){
        //if(document.orderForm.order_direction.value=='asc')
        //    document.orderForm.order_direction.value='desc';
        //else document.orderForm.order_direction.value='asc';

        document.orderForm.submit();
    }

</script>
    <div id="pagenavig-top" class="page_navigation">   
        <div class="row_02">
            <?php
            $paginations = $arr;
            //print_r(get_class_methods($pageNav));
            //print_r($pageNav->getPaginationLinks());
            if ($paginations && ($pageNav->total > $pageNav->limit)) {
                echo $pageNav->getPagesLinks();
            }
            ?>
        </div>
    </div>
    <?php positions_rem($params->get('singleuser01')); ?>
    <?php positions_rem($params->get('singlecategory01')); ?>
<!--<div class="componentheading<?php// echo $params->get('pageclass_sfx'); ?>">
    <?php
//     if (!$params->get('wrongitemid')) {
//         echo $currentcat->header;
//     } else {
//         $parametrs = $mainframe->getParams();
//         echo $parametrs->toObject()->page_title;
//     }
    ?>
</div>-->
<?php positions_rem($params->get('singleuser02')); ?>
<?php positions_rem($params->get('singlecategory02')); ?>
<?php if (($task != 'rent_request') && ($realestatemanager_configuration['location_map'] == 1)) { ?>
    <div id="map_canvas" class="re_map_canvas re_map_canvas_01"></div>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" ></script>
    <script type="text/javascript" id="map_houses_script">
        window.addEvent('domready', function() {
            initialize2();
        });


        function initialize2(){
            //debugger;
	    var map;
            var marker = new Array();
	    
            var infoWindow = new Array();
            var myOptions = {
                scrollwheel: false,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	    for(k=0; k<marker.length; k++){
		marker[k].setMap(null);
	    }
            var bounds = new google.maps.LatLngBounds ();
            <?php
            $j = 0;
            for ($i = 0; $i < count($map_houses); $i++) {
                if ($map_houses[$i]->hlatitude && $map_houses[$i]->hlongitude) {
                    $get_imageURL = $map_houses[$i]->image_link;
					$get_file_name = PHP_realestatemanager::picture_thumbnail($get_imageURL, 175, 122);
					$get_file = $mosConfig_live_site . '/components/com_realestatemanager/photos/' . $get_file_name;
					//echo 'TESTE ';//. $get_file;
					//echo '<img src="' . $get_file . '" "/>';
					
                    ?>
							infoWindow.push( new google.maps.InfoWindow({content: "<table height='120px' width=\"100%\"> " 
														+"<tr>"
																+"<td style='width: 140px;' rowspan=\"4\">"
																	//+"<span class=\"col_text_2\"><?php echo $get_file; ?></span>"
																	+"<span class=\"col_text_1\"><?php echo "<img src='$get_file'>"; ?></span>"
																+"</td>"
																+"<td>"
																	+"<div class=\"titlehouseMAP\">"
																		+"<?php echo $map_houses[$i]->htitle; ?>" 
																	+"</div>"
																+"</td>"
																+"<td>"
																	+"<div class=\"row_text house-capacity\">"
																		+"<span style='background-image: url(/allure/images/personLogo.png);background-size: 7px;background-repeat:no-repeat;position: relative;bottom: -39px;right: -65px;' class='col_text_1 icon-persons'>&nbsp;&nbsp;&nbsp;</span>"
																		+"<span style='bottom:-36px;right:-63px;position:relative;font-size:12px;' class=\"col_text_2\">1 - <?php echo $map_houses[$i]->broker; ?></span>"
																	+"</div>"
																	+"<div style='position:relative; left: -146px; top: 20px; color:#313131; font-size: 14px;' class=\"row_text lit_item_prices\">"
																		+"<?php echo _REALESTATE_MANAGER_LABEL_FROM; ?>"+" <span style='color:#e55727;font-size: 14px;' class=\"col_text_1\">&nbsp;<?php echo "&euro;".$map_houses[$i]->price_low_season. " / ". _REALESTATE_MANAGER_LABEL_WEEK; ?>"
																	+"</div>"
																+"</td>"
															+"</tr>"
															+"<tr>"
																+"<td>"
																	+"<a style='bottom:-20px;left:130px;' class=\"view_this_villa\" href=\"villas/view/<?php echo $map_houses[$i]->id; ?>\">"
																	+"<?php echo _REALESTATE_MANAGER_LABEL_VIEW_VILLA;?></a>"
																+"</td>"
															+"</tr>"
															+"</table>"
                                                           }));
	var pinColor = "e55727";
    var pinImage = new google.maps.MarkerImage("/allure/images/mapIcon.png");
                            marker.push(new google.maps.Marker({
                                position: new google.maps.LatLng(<?php echo $map_houses[$i]->hlatitude; ?>, <?php echo $map_houses[$i]->hlongitude; ?>),
                                map: map,
								icon: pinImage,
							    title: "<?php echo $database->Quote($map_houses[$i]->htitle); ?>"
                            }));
                            bounds.extend(new google.maps.LatLng(<?php echo $map_houses[$i]->hlatitude; ?>,<?php echo $map_houses[$i]->hlongitude; ?>));
                            google.maps.event.addListener(marker[<?php echo $j; ?>], 'click', function() {
                                //window.open("index.php?option=com_realestatemanager&task=view&id=<?php echo $map_houses[$i]->id; ?>&catid=<?php echo $map_houses[$i]->idcat ?>&Itemid=<?php echo $Itemid; ?>");
                                infoWindow[<?php echo $j; ?>].open(map, marker[<?php echo $j; ?>]);
                            });
                            var myLatlng = new google.maps.LatLng(<?php echo $map_houses[$i]->hlatitude; ?>,<?php echo $map_houses[$i]->hlongitude; ?>);
                            var myZoom = <?php echo $map_houses[$i]->map_zoom; ?>;
                    <?php
                    $j++;
                }
            }
            ?>
                
            if (<?php echo $j; ?>>1) map.fitBounds(bounds);
            else if (<?php echo $j; ?>==1) {map.setCenter(myLatlng);map.setZoom(myZoom)}
            else {map.setCenter(new google.maps.LatLng(0,0));map.setZoom(0);}
            
            //var markerCluster = new MarkerClusterer(map, marker, myOptions);
            
        }
        
        /*function open_list_item_description(id) {
            (function($){
                var item = $("div#list_item_description_"+id);
                if ($(item).css('display')=='none') {
                    $(item).show();
                }
                else{
                    $(item).hide();
                }
            })(jQuery);
        }*/
        
    </script>

            <?php }
        ?>

<?php positions_rem($params->get('singlecategory03')); ?>
            <?php if (!$params->get('wrongitemid') && $params->get('show_search')) { ?>
    <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
        <div class="realestate_search_button">
    <?php $link = 'index.php?option=' . $option . '&amp;task=show_search&amp;catid=' . $catid . '&amp;Itemid=' . $Itemid; ?>
            <a href="<?php echo sefRelToAbs($link); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                <img src="./components/com_realestatemanager/images/search.png" alt="search" border="0" align="right"/>
    <?php echo _REALESTATE_MANAGER_LABEL_SEARCH; ?>&nbsp;
            </a>
        </div>
    </div>
    <?php }
?>
<div id="error_message">
<?php
if(count($rows) == 0){
	echo "<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . _REALESTATE_MANAGER_LABEL_SEARCH_NOTHING_FOUND . " </h1><br><br> ";
}
else {
	echo "";
}
?>
</div>

<?php
//if (count($rows) >= 0) {
    $view_type = $params->get('view_type');
    if (isset($_REQUEST['viewtype'])) {
        $view_type_selected = mosGetParam($_REQUEST, 'viewtype');
        $session = JFactory::getSession();
        $session->set('view_type_selected', $view_type_selected);
    } else {
        $session = JFactory::getSession();
        $view_type_selected = $session->get('view_type_selected');
    }
    $is_show_view_type = false;
    //add view type selecting
    if ($view_type == 2) {
        $redirect_url = $_SERVER["REQUEST_URI"];
        $pos = strpos($redirect_url, "viewtype=");
        if ($pos != FALSE) {
            $redirect_url1 = str_replace("viewtype=1", "viewtype=0", $redirect_url);
            $redirect_url2 = str_replace("viewtype=0", "viewtype=1", $redirect_url);
        } else {
            $redirect_url1 = $_SERVER["REQUEST_URI"] . '&amp;viewtype=0';
            $redirect_url2 = $_SERVER["REQUEST_URI"] . '&amp;viewtype=1';
        }
        $is_show_view_type = true;
    }
    //$sort_arr['order_field'] = $params->get('sort_arr_order_field');
    //$sort_arr['order_direction'] = $params->get('sort_arr_order_direction');
    ?>
    <?php positions_rem($params->get('singleuser03')); ?>
    <?php positions_rem($params->get('singlecategory04')); ?>
    <?php $option_type = JArrayHelper::getValue($_REQUEST, 'option');
    if($option_type != 'com_simplemembership') { ?>
    <div id="ShowOrderBy">
		<?php
		if(count($rows)>0){
			?>
			<form method="POST" action="<?php echo sefRelToAbs($_SERVER["REQUEST_URI"]); ?>" name="orderForm">
				<?php echo _REALESTATE_MANAGER_LABEL_ORDER_BY; ?>
				<select size="1" class="inputbox" onchange="document.getElementById('search_form_order_field').value=document.orderForm.order_field.value; submitForm();" id="order_field" name="order_field">
					<option value="price-asc" <?php if ($_POST['order_field'] == "price-asc") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_PRICE . " " . _REALESTATE_MANAGER_LABEL_LOW . " > " . _REALESTATE_MANAGER_LABEL_HIGH; ?></option>
					<option value="price-desc" <?php if ($_POST['order_field'] == "price-desc") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_PRICE . " " . _REALESTATE_MANAGER_LABEL_HIGH . " > " . _REALESTATE_MANAGER_LABEL_LOW; ?></option>
					<option value="htitle-asc" <?php if ($_POST['order_field'] == "htitle-asc") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?> A > Z</option>
					<option value="htitle-desc" <?php if ($_POST['order_field'] == "htitle-desc") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?> Z > A</option>
					<option value="people-asc" <?php if ($_POST['order_field'] == "people-asc") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_BROKER . " " . _REALESTATE_MANAGER_LABEL_LOW . " > " . _REALESTATE_MANAGER_LABEL_HIGH; ?></option>
					<option value="people-desc" <?php if ($_POST['order_field'] == "people-desc") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_BROKER . " " . _REALESTATE_MANAGER_LABEL_HIGH . " > " . _REALESTATE_MANAGER_LABEL_LOW; ?></option>
				</select>
			</form>
			<?php
		}
		?>
        <!--<button onclick="initialize2();">Reaload Map</button>-->
    </div>
    
    <div id="fast_search">
    <?php
    if($_REQUEST['searchtext'] != ''){
	?>
    <div>
    You have searched for: <span id="searched_keywords"><?php echo $_REQUEST['searchtext']; ?></span>
    &nbsp;
    <button id="remove_keywords" onclick="removeSearchKeywords();">(remove)</button>
    </div>
	<?php
    }
    ?>
</div>
   
   <div id="loading_houses">
   		<!-- <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>  -->
   		<img alt="" src="http://vascotareco.com/allure/images/ajax-loader.gif">
   	</div>
   
    <?php }?> 
        <?php
    //}
    //if (count($rows) >= 0) {
        positions_rem($params->get('singleuser04'));
        ?>
        <?php positions_rem($params->get('singlecategory05')); ?>
    <div id="gallery_rem" class="current-search-list">
        <?php
        $total = count($rows);
        foreach ($rows as $row) {
            $tmphouse = new mosRealEstateManager($database);
            $tmphouse->load($row->id);
            $tmphouse->setCatIds();
            $option = 'com_realestatemanager';
            //$link = 'index.php?option=' . $option . '&amp;task=view&amp;id=' . $row->id . '&amp;catid=' . $tmphouse->catid[0] . '&amp;Itemid=' . $Itemid;
            $link = 'villas/view/'.$row->id;
            $imageURL = $row->image_link;
            ?>
            <!-- LISTAGEM CASAS -->
            <div class="okno_R" style="width:100%;" >
                <table width="100%">
                    <tr>
                        <td rowspan="4">
                            <a href="<?php echo $link;?>" class="listagem-img-link-gallery-rem"></a>
                            <?php
                            if ($imageURL != '') {
                                $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, 600, 800);//$realestatemanager_configuration['fotogallery']['high'], $realestatemanager_configuration['fotogallery']['width']);
                                $file = $mosConfig_live_site . '/components/com_realestatemanager/photos/' . $file_name;
                                //echo '<img alt="' . $row->htitle . '" title="' . $row->htitle . '" src="' . $file . '" border="0" class="little" style="width:'.$realestatemanager_configuration['fotogallery']['high'].'px;">';
                                echo '<img alt="' . $row->htitle . '" title="' . $row->htitle . '" src="' . $file . '" border="0" class="little" style="width:100%;">';
                            } else {
                                echo '<img alt="' . $row->htitle . '" title="' . $row->htitle . '" src="' . $mosConfig_live_site . '/components/com_realestatemanager/images/';
                                echo _REALESTATE_MANAGER_NO_PICTURE;
                                echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE . '" border="0"  />';
                            }
                            ?>
                            
                        </td>
                        <td>
                            <div class="texthouse">
                                <div class="titlehouse">
                                    <a href="<?php echo sefRelToAbs($link); ?>" >
                                <?php
                                if (strlen($row->htitle) > 45)
                                    echo substr($row->htitle, 0, 25), '...';
                                else {
                                    echo $row->htitle;
                                }
                                ?>
                                    </a>
                                </div>
                            </div>
                            <div class="row_text house-capacity">
                                <span class="col_text_1 icon-persons">&nbsp;&nbsp;&nbsp;</span>
                                <span class="col_text_2">1 - <?php echo $row->broker; ?></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="list_item_info_col">
                                <?php
                                
                                /*
                                echo "<a href='".$mosConfig_live_site."/index.php/component/realestatemanager/search_villa?Region=".$row->hregion."'>".$row->region."</a>";
                                echo " > ";
                                echo "<a href='".$mosConfig_live_site."/index.php/component/realestatemanager/search_villa?City=".$row->hcity."'>".$row->hcity."</a>";
                                */
                                echo "<a href='".$mosConfig_live_site."/villas/search_villa/?Region=".$row->hregion."'>".$row->region."</a>";
                                echo " > ";
                                echo "<a href='".$mosConfig_live_site."/villas/search_villa/?City=".$row->hcity."'>".$row->hcity."</a>";
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="list_item_description">
                                <?php
                                if($languagelocale == 'en-GB')
                                    $desc = strip_tags($row->description);
                                else if($languagelocale == 'fr-FR')
                                    $desc = strip_tags($row->description_fr);
                                else
                                    $desc = strip_tags($row->description);
                                if(strlen($desc)<5){
                                    $desc = "<center><span class='list_item_no_description'>". strtoupper( _REALESTATE_MANAGER_LABEL_NO_DESCRIPTION ) ."</span></center>";
                                }
                                if(strlen($desc)>170)
                                    echo substr($desc, 0, 170)."...";// <span class='list_item_read_more' onmouseover='open_list_item_description(".$row->id.")'>("._REALESTATE_MANAGER_LABEL_READ_MORE.")</span>";
                                else
                                    echo $desc;
                                
                                /*?>
                                <div id="list_item_description_<?php echo $row->id; ?>" class="list_item_desciption_popup" style="display:none;" onmouseleave="this.style.display='none';">
                                    <!--<span class='list_item_read_more' onclick="<?php echo "open_list_item_description(".$row->id.")"; ?>">Close</span>-->
                                    <div>
                                        <?php echo $row->description; ?>
                                    </div>
                                </div>
                                <?php */ ?>
                                
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row_text lit_item_prices">
                                <?php
                                    if($task != 'for_sale') {
                                        ?>
                                        <span class="col_text_2"><?php echo _REALESTATE_MANAGER_LABEL_LOW_SEASON; ?></span>
                                        <span class="col_text_1"><?php echo "&nbsp;&euro;".$row->price_low_season . "&nbsp;/&nbsp;". _REALESTATE_MANAGER_LABEL_WEEK; ?></span>
                                        &nbsp;&nbsp;&nbsp;
                                        <span class="col_text_2"><?php echo _REALESTATE_MANAGER_LABEL_HIGH_SEASON; ?></span>
                                        <span class="col_text_1"><?php echo "&nbsp;&euro;".$row->price_high_season. "&nbsp;/&nbsp;". _REALESTATE_MANAGER_LABEL_WEEK; ?></span>
                                        <?php
                                    } else {
                                    	if($row->price != 0) {
                                        ?>
                                        <span class="col_text_1"><?php echo "&nbsp;&euro;&nbsp;".number_format($row->price, 0, ',', '.'); ?></span>
                                        <?php
                                    	}    
                                    }
                                    ?>
                            </div>
                            <a class="view_this_villa" href="<?php echo $link;?>"><?php echo strtoupper(_REALESTATE_MANAGER_LABEL_VIEW_VILLA); ?></a>
                        </td>
                    </tr>
                </table>
            </div>
        <?php }
    ?>
    </div>
    <!-- MOSAICO CASAS -->
    <div id="gallery_blocks_rem" class="hideButton" style="display:none">
        <?php
        $total = count($rows);
        foreach ($rows as $row) {
            $tmphouse = new mosRealEstateManager($database);
            $tmphouse->load($row->id);
            $tmphouse->setCatIds();
            $option = 'com_realestatemanager';
            $link = 'villas/view/'.$row->id;
            $imageURL = $row->image_link;
            ?>
            <div class="okno_R" style="width:100%;" >
                <table width="100%">
                    <tr>
                        <td>
                            <a href="<?php echo $link;?>" class="listagem-img-link-gallery-blocks-rem"></a>
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
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="texthouse">
                                <div class="titlehouse">
                                    <a href="<?php echo sefRelToAbs($link); ?>" >
                                <?php
                                if (strlen($row->htitle) > 45)
                                    echo substr($row->htitle, 0, 25), '...';
                                else {
                                    echo $row->htitle;
                                }
                                ?>
                                    </a>
                                </div>
                            </div>
                            <div class="row_text house-capacity">
                                <span class="col_text_1 icon-persons">&nbsp;&nbsp;&nbsp;</span>
                                <span class="col_text_2">1 - <?php echo $row->broker; ?></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<div class="list_item_info_col">
                                <?php
                                
                                /*
                                echo "<a href='".$mosConfig_live_site."/index.php/component/realestatemanager/search_villa?Region=".$row->hregion."'>".$row->region."</a>";
                                echo " > ";
                                echo "<a href='".$mosConfig_live_site."/index.php/component/realestatemanager/search_villa?City=".$row->hcity."'>".$row->hcity."</a>";
                                */
                                echo "<a href='".$mosConfig_live_site."/villas/search_villa/?Region=".$row->hregion."'>".$row->region."</a>";
                                echo " > ";
                                echo "<a href='".$mosConfig_live_site."/villas/search_villa/?City=".$row->hcity."'>".$row->hcity."</a>";
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row_text lit_item_prices"> 
                                <span class="col_text_2"><?php echo _REALESTATE_MANAGER_LABEL_FROM; ?></span>
                                <span class="col_text_1"><?php echo "&nbsp;&euro;".$row->price_low_season. "&nbsp;/&nbsp;". _REALESTATE_MANAGER_LABEL_WEEK; ?></span>
                            </div>
                            <a class="view_this_villa" href="<?php echo $link;?>"><?php echo strtoupper(_REALESTATE_MANAGER_LABEL_VIEW_VILLA); ?></a>
                        </td>
                    </tr>
                </table>
            </div>
        <?php }
    ?>
    </div>
            <?php
        //}
        if ($params->get('show_rentstatus') && $params->get('show_rentrequest') && $params->get('rent_save')) { // && $available)
            ?>
    <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
                <?php echo _REALESTATE_MANAGER_LABEL_RENT_INFORMATIONS; ?>
        <input type="hidden" name="houseid" id="houseid" value="<?php echo $row->id ?>" maxlength="80" />
    </div>
    <form action="<?php echo sefRelToAbs("index.php"); ?>" name="userForm" method="post">
        <div class="table_rent_request table_17">

            <?php
            global $my;
            if ($my->guest) {
                ?>
                <div class="row_01">
                    <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME; ?>:<br />
                    <input class="inputbox" type="text" name="user_name" size="38" maxlength="80" />
                </div>
                <div class="row_02">
                    <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL; ?>:<br />
                    <input class="inputbox" type="text" name="user_email" size="30" maxlength="80" />
                </div>
                <?php
            } else {
                ?>

                <div class="row_03">
        <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME; ?>:<br />
                    <input class="inputbox" type="text" name="user_name" size="38" maxlength="80" value="<?php echo $my->name; ?>" />
                </div>
                <div class="row_04">
        <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL; ?>:<br />
                    <input class="inputbox" type="text" name="user_email" size="30" maxlength="80" value="<?php echo $my->email; ?>" />
                </div>
        <?php
    }
    ?>


            <script type="text/javascript">
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


            <div class="row_05">
    <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_MAILING; ?>:<br />
    <?php
    //  editorArea('editor1', '', 'user_mailing', '400', '200', '30', '5');
    ?>
                <textarea name="user_mailing" cols="50" rows="8" ></textarea>
            </div>

            <div class="row_06">
                <p><?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_FROM; ?>:</p>
    <?php global $realestatemanager_configuration;
    echo JHtml::_('calendar', date("Y-m-d"), 'rent_from', 'rent_from', $realestatemanager_configuration['date_format'], array('size' => '17'));
    ?>
            </div>
            <div class="row_07">
                <p><?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_UNTIL; ?>:</p>
                <?php echo JHtml::_('calendar', date("Y-m-d"), 'rent_until', 'rent_until', $realestatemanager_configuration['date_format'], array('size' => '17')); ?>
            </div>

        </div>
     <?php } ?>    
    <br/>
    <div id="pagenavig" class="page_navigation">   
        <div class="row_02">
<?php
$paginations = $arr;
if ($paginations && ($pageNav->total > $pageNav->limit)) {
    $test = $pageNav->getPagesLinks();
    //$test = str_replace("?", "/", $test);
    //$test = str_replace("&", "/", $test);
    echo $test;
}
?>
        </div>
        <?php
        if ($params->get('show_rentstatus') && $params->get('show_rentrequest') && !$params->get('rent_save') && !$params->get('search_request')) {
            ?>
            <br />
            <input type="submit" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_RENT_REQU; ?>" class="button" />
            <br />
    <?php
} else if ($params->get('show_rentstatus') && $params->get('show_rentrequest') && $params->get('rent_save') && !$params->get('search_request')) {
    ?>
            <input type="button" class="button" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_RENT_REQU_SAVE; ?>" onclick="rem_rent_request_submitbutton()" />
    <?php } else {
        ?>
            &nbsp;
        <?php
    }
    ?>
    </div>
    <input type="hidden" name="option" value="<?php echo $option; ?>"/>
    <input type="hidden" name="task" value="save_rent_request"/>
<?php
if ($option != 'com_realestatemanager') {
    ?>
        <input type="hidden" name="tab" value="getmyhousesTab"/>
        <input type="hidden" name="is_show_data" value="1"/>
        <?php
    }
    ?>
    <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>"/>
    <input type="hidden" name="houseid" value="<?php echo $rows[0]->id; ?>"/>
</form> 
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
?>

<div class="basictable table_20">
<?php mosHTML::BackButton($params, $hide_js); ?>
</div>


<style type="text/css">
    #list img.little{
        /*height: <?php //echo $params->get('minifotohigh');
?>px;
        width:<?php //echo $params->get('minifotowidth');
?>px;*/
    }
    /*.okno_R{
        width: <?php echo $realestatemanager_configuration['fotogallery']['width'] + 10; ?>px;
        height: <?php echo $realestatemanager_configuration['fotogallery']['high'] + 65; ?>px;
    }*/
    .okno_R img{
        /*  width: //echo $realestatemanager_configuration['fotogallery']['width']; px; */
        /*max-height: <?php echo $realestatemanager_configuration['fotogallery']['high']; ?>px;*/
    }
    /*.okno_R .texthouse{
        width:<?php echo $realestatemanager_configuration['fotogallery']['width']; ?>px;
    }*/
</style>
<?php
//<!--<div style="text-align: center;"><a href="http://ordasoft.com" style="font-size: 10px;">Powered by OrdaSoft!</a></div>-->
?>