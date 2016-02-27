<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

$session = JFactory::getSession();
$arr = $session->get("array", "default");

global $hide_js, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path, $database, $doc, $my;
global $limit, $total, $limitstart, $task, $paginations, $mainframe, $realestatemanager_configuration;

$doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
if (version_compare(JVERSION, "3.0.0", "lt"))
    JHTML::_('behavior.mootools');
else
    JHtml::_('behavior.framework', true);
?>
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
        if(document.orderForm.order_direction.value=='asc')
            document.orderForm.order_direction.value='desc';
        else document.orderForm.order_direction.value='asc';

        document.orderForm.submit();
    }

</script>
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
<?php if (($task != 'rent_request') && ($realestatemanager_configuration['location_map'] == 1)) {
    ?>
    <div id="map_canvas" class="re_map_canvas re_map_canvas_02"></div>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" ></script>
    <script type="text/javascript">
        window.addEvent('domready', function() {
            initialize2();
        });


        function initialize2(){
            var map;
            var marker = new Array();
            var myOptions = {
                scrollwheel: false,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            var bounds = new google.maps.LatLngBounds ();
    <?php
    $j = 0;
    for ($i = 0; $i < count($rows); $i++) {
        if ($rows[$i]->hlatitude && $rows[$i]->hlongitude) {
            ?>
                            marker.push(new google.maps.Marker({
                                position: new google.maps.LatLng(<?php echo $rows[$i]->hlatitude; ?>, <?php echo $rows[$i]->hlongitude; ?>),
                                map: map,
                                title: "<?php echo $database->Quote($rows[$i]->htitle); ?>"
                            }));
                            bounds.extend(new google.maps.LatLng(<?php echo $rows[$i]->hlatitude; ?>,<?php echo $rows[$i]->hlongitude; ?>));
                            google.maps.event.addListener(marker[<?php echo $j; ?>], 'click', function() {
                                window.open("index.php?option=com_realestatemanager&task=view&id=<?php echo $rows[$i]->id; ?>&catid=<?php echo $rows[$i]->idcat ?>&Itemid=<?php echo $Itemid; ?>");
                            });
                            var myLatlng = new google.maps.LatLng(<?php echo $rows[$i]->hlatitude; ?>,<?php echo $rows[$i]->hlongitude; ?>);
                            var myZoom = <?php echo $rows[$i]->map_zoom; ?>;
            <?php
            $j++;
        }
    }
    ?>
            if (<?php echo $j; ?>>1) map.fitBounds(bounds);
            else if (<?php echo $j; ?>==1) {map.setCenter(myLatlng);map.setZoom(myZoom)}
            else {map.setCenter(new google.maps.LatLng(0,0));map.setZoom(0);}
        }
    </script>
<?php } ?>

<?php positions_rem($params->get('singlecategory03')); ?>
<?php if (!$params->get('wrongitemid') && $params->get('show_search')) {
    ?>
    <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
        <div class="realestate_search_button basictable table_22">
    <?php $link = 'index.php?option=' . $option . '&amp;task=show_search&amp;catid=' . $catid . '&amp;Itemid=' . $Itemid; ?>
            <a href="<?php echo sefRelToAbs($link); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>" align="right">
                <img src="./components/com_realestatemanager/images/search.png" alt="?" border="0" align="right"/>
            <?php echo _REALESTATE_MANAGER_LABEL_SEARCH; ?>&nbsp;
            </a>
        </div>
    </div>
<?php } ?>
<br />

<?php
if (count($rows) > 0) {
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

    $sort_arr['order_field'] = $params->get('sort_arr_order_field');
    $sort_arr['order_direction'] = $params->get('sort_arr_order_direction');
    ?>
    <?php positions_rem($params->get('singleuser03')); ?>
    <?php positions_rem($params->get('singlecategory04')); ?>
    <?php $option_type = JArrayHelper::getValue($_REQUEST, 'option');
          if($option_type != 'com_simplemembership') { ?>
    <div id="ShowOrderBy">
        <form method="POST" action="<?php echo sefRelToAbs($_SERVER["REQUEST_URI"]); ?>" name="orderForm">
            <input type="hidden" id="order_direction" name="order_direction" value="<?php echo $sort_arr['order_direction']; ?>" >
            <a title="Click to sort by this column." onclick="javascript:allreordering();return false;" href="#">
                <img alt="" src="./components/com_realestatemanager/images/sort_<?php echo $sort_arr['order_direction']; ?>.png" />
            </a>
    <?php echo _REALESTATE_MANAGER_LABEL_ORDER_BY; ?><select size="1" class="inputbox" onchange="javascript:document.orderForm.order_direction.value='asc'; document.orderForm.submit();" id="order_field" name="order_field">
                <option value="date" <?php if ($sort_arr['order_field'] == "date") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_DATE; ?> </option>
                <option value="price" <?php if ($sort_arr['order_field'] == "price") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_PRICE; ?></option>
                <option value="htitle" <?php if ($sort_arr['order_field'] == "htitle") echo 'selected="selected"'; ?> > <?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?></option></select>
        </form>
    </div>
    <?php }?>
    <?php positions_rem($params->get('singleuser04')); ?>
            <?php positions_rem($params->get('singlecategory05')); ?>

    <div id="list">
    <?php
    $available = false;
    $k = 0;
    $total = count($rows);
    $g_item_count = 0;
    foreach ($rows as $row) {
        $tmphouse = new mosRealEstateManager($database);
        $tmphouse->load($row->id);
        $tmphouse->setCatIds();
        $link = 'index.php?option=com_realestatemanager&amp;task=view&amp;id=' . $row->id . '&amp;catid=' . $tmphouse->catid[0] . '&amp;tab=getmyhousesTab&amp;Itemid=' . $Itemid . '#tabs-2';
        $g_item_count++;
        ?>

            <div class="list_house <?php echo $tabclass[($g_item_count % 2)]; ?>" >
                <span class="col_img">
                    <a href="<?php echo sefRelToAbs($link); ?>">
            <?php
            $house = $row;
            $imageURL = $house->image_link;
            if ($imageURL != '') {
                $file_name = PHP_realestatemanager::picture_thumbnail($imageURL, $realestatemanager_configuration['foto']['high'], $realestatemanager_configuration['foto']['width']);
                $file = $mosConfig_live_site . '/components/com_realestatemanager/photos/' . $file_name;
                echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . $file . '" border="0" class="little">';
            } else {
                echo '<img alt="' . $house->htitle . '" title="' . $house->htitle . '" src="' . $mosConfig_live_site . '/components/com_realestatemanager/images/';
                echo _REALESTATE_MANAGER_NO_PICTURE;
                echo '" alt="' . _REALESTATE_MANAGER_NO_PICTURE . '" border="0"  />';
            }
            ?>
                    </a>
                </span>
                        <?php
                        if ($params->get('search_request')) {
                            $link1 = 'index.php?option=com_realestatemanager&amp;task=showCategory&amp;catid=' . $tmphouse->catid[0] . '&amp;Itemid=' . $Itemid;
                            ?>
                    <div class="col_category_title">
                        <a href="<?php echo sefRelToAbs($link1); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
                            <?php echo $row->category_titel; ?>
                        </a>
                    </div>
            <?php }
        ?>

                <div class="col_hlocation">
                    <a href="<?php echo sefRelToAbs($link); ?>" class="category<?php echo $params->get('pageclass_sfx'); ?>">
                <?php echo $row->hlocation; ?></a>
                </div>
                <div class="col_htitle">
                        <?php echo $row->htitle; ?>
                </div>

                <div class="price_hits">

                <?php
                if (($row->price != '' || $row->priceunit != '') && $params->get('show_pricerequest')) {
                    if ($realestatemanager_configuration['price_unit_show'] == '1') {
                        if ($realestatemanager_configuration['sale_separator']) {
                            ?>
                                <div class="price_priceunit">
                                    <span class="col_price">
                                <?php echo formatMoney($row->price, true, $realestatemanager_configuration['price_format']); ?></span>
                                    <span class="col_priceunit"><?php echo $row->priceunit; ?></span>
                                </div>
                <?php } else { ?>
                                <div class="price_priceunit">
                                    <span class="col_price"><?php echo $row->price; ?></span>
                                    <span class="col_priceunit"><?php echo $row->priceunit; ?></span>
                                </div>
                            <?php
                            }
                        } else {
                            if ($realestatemanager_configuration['sale_separator']) {
                                ?>
                                <div class="price_priceunit">
                                    <span class="col_priceunit"><?php echo $row->priceunit; ?></span>
                                    <span class="col_price">
                    <?php echo formatMoney($row->price, true, $realestatemanager_configuration['price_format']); ?></span>
                                </div>
                <?php } else { ?>
                                <div class="price_priceunit">
                                    <span class="col_priceunit"><?php echo $row->priceunit; ?></span>
                                    <span class="col_price"><?php echo $row->price; ?></span>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>

                    <?php
                    if ($params->get('hits')) {
                        ?>
                        <div class="col_hits">
                            <span class="col_10">
                        <?php echo "<img src='" . $mosConfig_live_site . "/components/com_realestatemanager/images/hits.png' name='image' border='0' align='middle' />" . "&nbsp;" . _REALESTATE_MANAGER_LABEL_HITS; ?>
                            </span>
                            <span class="col_11">
                        <?php echo $row->hits; ?>
                            </span>
                        </div>
                        <?php }
                    ?>

                </div> <!-- price_hits -->

                            <?php
                            if ($params->get('show_rentstatus')) {
                                if ($params->get('show_rentrequest')) {
                                    $data1 = JFactory::getDBO();
                                    $query = "SELECT  b.rent_from , b.rent_until  FROM #__rem_rent AS b " .
                                            " LEFT JOIN #__rem_houses AS c ON b.fk_houseid = c.id " .
                                            " WHERE c.id=" . $row->id . " AND c.published='1' AND c.approved='1' AND b.rent_return IS NULL";
                                    $data1->setQuery($query);
                                    $rents1 = $data1->loadObjectList();
                                    ?>

                        <div class="col_rent">
                        <?php
                        if (($row->listing_type == 1) && !isset($rents1[0]->rent_until)) {
                            echo _REALESTATE_MANAGER_LABEL_ACCESSED_FOR_RENT . "<img src='" . $mosConfig_live_site . "/components/com_realestatemanager/images/available.png' alt='Available' name='image' border='0' align='middle' />";
                        } else if ($row->fk_rentid != 0 && isset($rents1[0]->rent_until)) {
                            echo _REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL . "<br />";
                            for ($a = 0; $a < count($rents1); $a++) {
                                $from_until = data_transform_rem($rents1[$a]->rent_from) .
                                        "  =>  " .
                                        data_transform_rem($rents1[$a]->rent_until) . "\n";
                                print_r($from_until . "<br>");
                            }
                        } else if (/* $row->fk_rentid == 0 && */($row->listing_type != 1)) {
                            echo _REALESTATE_MANAGER_LABEL_ACCESSED_FOR_RENT . "<img src='" . $mosConfig_live_site .
                            "/components/com_realestatemanager/images/not_available.png' alt='Not Available' name='image' border='0' align='middle' />";
                        } /* else echo "<img src='" . $mosConfig_live_site .
                          "/components/com_realestatemanager/images/available.png' alt='Available' name='image' border='0' align='middle' />"; */
                        ?>          
                        </div>

                            <?php
                        }
                    }
                    ?>          
            </div>
                    <?php
                }
                ?>
    </div> <!-- list -->

                <?php positions_rem($params->get('singleuser05')); ?>
                <?php positions_rem($params->get('singlecategory06')); ?>
                <?php
            }
            if ($params->get('show_rentstatus') && $params->get('show_rentrequest') && $params->get('rent_save')) {// && $available)
                ?>
    <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
            <?php echo _REALESTATE_MANAGER_LABEL_RENT_INFORMATIONS; ?>
        <input type="hidden" name="houseid" id="houseid" value="<?php echo $row->id ?>" maxlength="80" />
    </div>
    <form action="<?php echo sefRelToAbs("index.php"); ?>" name="userForm" method="post">
        <table class="basictable table_25" width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>
        <?php
        global $my;
        if ($my->guest) {
            ?>
                    <td>
        <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME; ?>:<br />
                        <input class="inputbox" type="text" name="user_name" size="38" maxlength="80" />
                        <br>
        <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL; ?>:<br />
                        <input class="inputbox" type="text" name="user_email" size="30" maxlength="80" />
                    </td>
            <?php
        } else {
            ?>

                    <td>
        <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME; ?>:<br />
                        <input class="inputbox" type="text" name="user_name" size="38" maxlength="80" value="<?php echo $my->name; ?>" />
                        <br>
                    <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL; ?>:<br />
                        <input class="inputbox" type="text" name="user_email" size="30" maxlength="80" value="<?php echo $my->email; ?>" />
                    </td>
                <?php }
                ?>
            </tr>
        </table>
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
        <table class="basictable table_26" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
    <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_MAILING; ?>:<br />
    <?php
    //  editorArea('editor1', '', 'user_mailing', '400', '200', '30', '5');
    ?>
                    <textarea name="user_mailing" cols="50" rows="8" ></textarea>

                </td>
                <td>
                    <br />
                    <p>
    <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_FROM; ?>:<br />
    <?php global $realestatemanager_configuration;
    echo JHtml::_('calendar', date("Y-m-d"), 'rent_from', 'rent_from', $realestatemanager_configuration['date_format'], array('size' => '17'));
    ?>
                    </p>
                    <p>
    <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_UNTIL; ?>:<br />
    <?php echo JHtml::_('calendar', date("Y-m-d"), 'rent_until', 'rent_until', $realestatemanager_configuration['date_format'], array('size' => '17')); ?>
                    </p>
                </td>
            </tr>
        </table>
    <?php } ?>
    <br/>
    <div class="basictable table_27">
        <div id="pagenavig">
<?php
$paginations = $arr;
if ($paginations && ( $pageNav->total > $pageNav->limit )) {
    echo $pageNav->getPagesLinks();
}
?>
        </div>
        <div class="col_02">
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
            <?php
            } else {
                ?>
                &nbsp;
                <?php
            }
            ?>
        </div>
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

<div class="basictable table_28">
<?php
mosHTML::BackButton($params, $hide_js);
?>
</div>

<style type="text/css">
    #list img.little{
        /*height: <?php //echo $params->get('minifotohigh');  ?>px;
        width:<?php //echo $params->get('minifotowidth'); ?>px;*/
    }
    .okno_R{
        width: <?php echo $realestatemanager_configuration['fotogallery']['width'] + 10; ?>px;
        height: <?php echo $realestatemanager_configuration['fotogallery']['high'] + 65; ?>px;
    }
    .okno_R img{
        width:<?php echo $realestatemanager_configuration['fotogallery']['width']; ?>px;
        max-height: <?php echo $realestatemanager_configuration['fotogallery']['high']; ?>px;
    }
    .okno_R .texthouse{
        width:<?php echo $realestatemanager_configuration['fotogallery']['width']; ?>px;
    }
</style>
<div style="text-align: center;"><a href="http://ordasoft.com" style="font-size: 10px;">Powered by OrdaSoft!</a></div>