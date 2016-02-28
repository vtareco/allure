
<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
global $hide_js, $mainframe, $Itemid, $realestatemanager_configuration, $mosConfig_live_site, $mosConfig_absolute_path, $my, $doc;
if (version_compare(JVERSION, "3.0.0", "lt"))
    JHTML::_('behavior.mootools');
else
    JHtml::_('behavior.framework', true);

// VIEW DETALHE DA CASA

$site = $mosConfig_live_site;
$doc = &JFactory::getDocument();
$doc->setMetaData("og:title", "Allure Villas | Rent Villas in Portugal");
$doc->setMetaData("og:site_name", "Allure Villas");
$doc->setMetaData("og:url", "$site/villas/view/".$house->id);
$doc->setMetaData("og:image", "$site/components/com_realestatemanager/photos/". PHP_realestatemanager::picture_thumbnail($house_photos[0]->main_img, $realestatemanager_configuration['fotoupload']['high'], $realestatemanager_configuration['fotoupload']['width']));
$doc->setMetaData("og:description", "Villas | ".$house->htitle);
$doc->setMetaData("fb:app_id", "461899543966064");

    
    $language = JFactory::getLanguage();
    //echo "------->".$language->getTag();
    
    //print_r($house);
    
    HTML_realestatemanager::showCrumbs("search_villa", $house->hregion, $house->region, $house->hcity, $house->htitle, $house->id);
?>

<script type="text/javascript" src="<?php echo $mosConfig_live_site . '/components/com_realestatemanager/lightbox/js/jQuerREL-1.2.6.js'; ?>"></script>
<script type="text/javascript">jQuerREL=jQuerREL.noConflict();</script> 
<script src="<?php echo $mosConfig_live_site . '/components/com_realestatemanager/lightbox/js/lightbox-2.6.min.js'; ?>" 
type="text/javascript"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" ></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site . '/components/com_realestatemanager/includes/jquery.raty.js'; ?>"></script> 
<?php
$doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/lightbox/css/lightbox.css');
$doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
//////////TABS
$doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/TABS/tabcontent.css');
$doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/TABS/tabcontent.js');
////////////Adding google map
$realestatemanager_configuration = $GLOBALS['realestatemanager_configuration'];
?>
<script type="text/javascript">  

    window.addEvent('domready', function() {
        initialize();
        
    });
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
		var pinImage = new google.maps.MarkerImage("/allure/images/mapIcon.png");
        var marker = new google.maps.Marker({ position: myLatlng, icon: pinImage });
        marker.setMap(map);
        
    }

</script>

<div id="overDiv" ></div>

<?php
JPluginHelper::importPlugin('content');
$dispatcher = JDispatcher::getInstance();
?>

<script language="javascript" type="text/javascript">

    function review_submitbutton() {
        var form = document.review;
        // do field validation
        var rating_checked = false; 
        for (c = 0;  c < form.rating.length; c++){
            if (form.rating[c].checked){
                rating_checked = true;
                form.rating.value = c ;
            } 
        }
        if (form.title.value == "") {
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_TITLE; ?>" );
        } else if (form.comment == "") {
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_COMMENT; ?>" );
        } else if (! form.rating.value) {                
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_RATING; ?>" );
        } else {
            form.submit();
        }
    }
    //*****************   begin add for show/hiden button "Add review" ********************

    function buying_request_submitbutton() {
        var form = document.buying_request;
        if (form.customer_name.value == "") {
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_BUY_REQ_NAME; ?>" );
        } else if (form.customer_email.value == ""|| !isValidEmail(form.customer_email.value)) {
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_BUY_REQ_EMAIL; ?>" );
        } else if (form.customer_phone.value == ""||!isValidPhoneNumber(form.customer_phone.value)){
            alert( "<?php echo _REALESTATE_MANAGER_INFOTEXT_JS_BUY_REQ_PHONE; ?>" );
        } else {
            form.submit();
        }
    }
    function isValidPhoneNumber(str){
        myregexp = new RegExp("^([_0-9() -;,]*)$");
        mymatch = myregexp.exec(str);
        if(str == "")
            return false;
        if(mymatch != null)
            return true;
        return false;
    }
    function isValidEmail(str) {
        return (str.indexOf("@") > 1);
    }
        
    //****************   end add for show/hiden button "Add buying"   *********************
    function buy_house( is_hide ) {
        var el  = document.getElementById('hidden_buying');
        var el2 = document.getElementById('show_buying');
        if( is_hide ) {
            el.style.display = 'none';
            el2.style.display = 'block';
        } else {
            el.style.display = 'block';
            el2.style.display = 'none';
        }
    }
    
    function book_house(){
        (function($){
        	$("#availability-form").hide();  
            var pav_tab = document.getElementById("price_availability");
            var box_form = $("#book-form");
            countries.expandit(0);
            pav_tab.focus();
            setTimeout(function(){}, 500);
            pav_tab.scrollIntoView();
            $(box_form).show('slow');
            
           /** var panel = $("#book_house_panel");
            var closeButton = $("#close_book_panel");
            if ($(panel).css('display') == 'none') {
                $(panel).show('slow');
                $(closeButton).show('slow');
                //if($("#back_opacity") == null)
                    $("#back_opacity").fadeIn();
                //else
                //    $("#back_opacity").show();
            }else{
                $(panel).hide('slow');
                $(closeButton).hide('slow');
                $("#back_opacity").fadeOut();
            }*/
        })(jQuery);
    }
    
    function addToFavorites() {
        (function($){
            if($("#house-favorite-link").attr("class") != "favorite"){
                $.ajax({
                    url: "index.php?option=com_realestatemanager&task=add_favorite&id=<?php echo $house->id; ?>"
                }).done(function(data) {
                    $("#house-favorite-link").text("remove from favorites");
                    $("#house-favorite-link").addClass("favorite");
                    $("#menu-mobile").html($(data).find("#menu-mobile"));
                });
            }else{
                $.ajax({
                    url: "index.php?option=com_realestatemanager&task=remove_favorite&id=<?php echo $house->id; ?>"
                }).done(function(data) {
                    $("#house-favorite-link").text("add to favorites");
                    $("#house-favorite-link").removeClass("favorite");
                    $("#menu-mobile").html($(data).find("#menu-mobile"));
                });
            }
        })(jQuery);
            
    }
</script>

<div id="house-external-actions">
    <!-- FACEBOOK -->
    <?php
    $title='Allure Villas | Rent Villas in Portugal';
    $url=$mosConfig_live_site.'/villas/view/'.$house->id;
    $summary='Allure Villas | '.$house->htitle;
    $image=$mosConfig_live_site.'/components/com_realestatemanager/photos/'. PHP_realestatemanager::picture_thumbnail($house_§[0]->main_img, $realestatemanager_configuration['fotoupload']['high'], $realestatemanager_configuration['fotoupload']['width']);
    ?>    
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.3";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="fb-share-link" class="fb-share-button" data-href="<?php echo $mosConfig_live_site."/index.php?option=com_villas&task=view&id=".$house->id."&fb-share"; ?>" 
	data-layout="button_count"></div>
	<!-- TWITTER -->
	<!-- "<?php //echo $mosConfig_live_site . "/index.php/component/villas/view/" . $house->id; ?>" -->
	<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "http://178.62.160.47/allure/index.php/villas/view/" . $house->id; ?>" data-text="<?php echo $house->htitle; ?>" data-via="AllureVillas" data-hashtags="RentVillasInPortugal"></a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

    <!-- GOOGLEPLUS -->
	<!-- Posicione esta tag no cabeçalho ou imediatamente antes da tag de fechamento do corpo. -->
	<script src="https://apis.google.com/js/platform.js" async defer>
	  {lang: 'en-GB'}
	</script>
	<!-- Posicione esta tag onde você deseja que o botão +1 apareça. -->
	<div class="g-plusone" data-size="medium" data-width="300"></div>
	
	<!--  ENVIO POR EMAIL CASA -->
	<a onclick="sendEmail();">
        <span class="glyphicon glyphicon-envelope"></span>
    </a>
	<!--  IMPRIMIR CASA-->
    <a href="<?php echo $mosConfig_live_site . "/villas/view/" . $house->id . "/?printItem=print"; ?>" target="_blank">
      <span class="glyphicon glyphicon-print"></span>
    </a>
</div>
 
<div id="house-top-page" style="max-height:500px">
    <!-- Fast Photo Gallery -->
    <div id="house_photo_gallery">
        <div id="detailHouse-previous"><a></a></div>
        <div id="detailHouse-next"><a></a></div>
        <div id="carousel-house-photos" class="photos-house-container">
                <?php if (count($house_photos) > 0) { ?>
                    <?php for ($i = 0;$i < count($house_photos);$i++) { ?>
                        <img
                        <?php
                            if($i==0)
                                echo ' class="photo_on" ';
                            else
                                echo ' class="photo_off"';
                        ?>
                        alt="<?php echo $house->htitle; ?>" title="<?php echo $house->htitle; ?>" src="./components/com_realestatemanager/photos/<?php echo PHP_realestatemanager::picture_thumbnail($house_photos[$i]->main_img, $realestatemanager_configuration['fotoupload']['high'], $realestatemanager_configuration['fotoupload']['width']); ?>" style = "vertical-align:middle;" />
                    <?php
                    }
                } else echo "No photos to show!";
                ?>
        </div> <!-- Carousel -->
    </div>
    
    <!-- Fast details -->
    <div id="house_basic_details" class="table_country3">
        <!-- title -->
		<div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
		   <?php echo $currentcat->header; ?>     
        </div>
		<!-- breadcrumb-->
        <div class="view_house_local_bradcrumbs">
            <?php
                echo "<a href='".$mosConfig_live_site."/villas/search_villa'>Portugal</a>";
                echo " > ";
                echo "<a href='".$mosConfig_live_site."/villas/search_villa/?Region=".$house->hregion."'>".$house->region."</a>";
                echo " > ";
                echo "<a href='".$mosConfig_live_site."/villas/search_villa/?City=".$house->hcity."'>".$house->hcity."</a>";
            ?>
        </div>
		<!-- /breadcrumb -->
		<!-- icons -->
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
            <span class="col_text_2"><?php echo $house->extra3."km"; ?></span>
        </div>
		<!-- / icons -->
		<!-- Changeover day -->
            <?php
                $provider_class[0] = _REALESTATE_MANAGER_OPTION_SELECT;
                $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
                $i = 1;
                foreach ($provider_class1 as $provider_class2) {
                    $provider_class[$i] = $provider_class2;
                    $i++;
                }
                if ($house->provider_class != 0) {
            ?>
                <div class="row_text">
                    <p><?php echo _REALESTATE_MANAGER_LABEL_PROVIDER_CLASS; ?></p>
                    <p><?php echo $provider_class[$house->provider_class]; ?></p>
                </div>
            <?php }
            else{ ?>
                <div class="row_text">
                    <p class="house-change-over-day"><?php echo _REALESTATE_MANAGER_LABEL_PROVIDER_CLASS; ?></p>
                    <p class="house-text-desc"><?php echo "Flexible"; ?></p>
                </div>
            <?php    
            }
            
            ?>
        <!-- / Changeover day 16:00 -->
        <p class="house-text-desc">
        	Check-in: <?php echo $house->extra7; ?>h, 
        	Check-out:<?php echo $house->extra8; ?>h
        </p>
        
          <script>
		<!-- email notification for reviews -->  
        function sendEmail() 
        {
            window.location = "mailto:vtareco88@gmail.com?Subject= <?php echo $currentcat->header; ?>"; 
        }
        </script>
<!-- BOOK NOW -->
		<!-- buttons book, question, review, favorites -->
        <div style="margin-top:45px; text-align: center;">
            <button id="house-detail-btn-booknow" onclick="book_house();" class="house-operations-button">
                <?php echo strtoupper(_REALESTATE_MANAGER_LABEL_BUTTON_RENT_REQU);?>
            </button>
        </div>
        
<!-- ASK A QUESTION -->
        <div style="margin-top:45px; text-align: center;">
            <button onclick="sendEmail();" class="house-operations-button">
                <?php echo strtoupper(_REALESTATE_MANAGER_LABEL_ASK_A_QUESTION);?>
            </button>
        </div>
        
         <!-- ADD REVIEW -->
        <div id="button_hiden_review" style="margin-top:40px; text-align: center;">
            <button class="house-operations-button" onclick="house_review();">
                <?php echo strtoupper(_REALESTATE_MANAGER_LABEL_BUTTON_ADD_REVIEW); ?>
            </button>
        </div>

        <p class="house-favorites-link">
            <?php
             $bb = 0;
            if( is_array($_SESSION['favorite_houses']) && !in_array($house->id, $_SESSION['favorite_houses']) ) {  
            // 
            	?>
                <button id="house-favorite-link" onclick="addToFavorites();" class=""><?php echo _REALESTATE_MANAGER_LABEL_REMOVE_FAVORITE; ?></button></p>
            <?php
            } else { ?>
                <button id="house-favorite-link" onclick="addToFavorites();" class="favorite"><?php echo _REALESTATE_MANAGER_LABEL_ADD_FAVORITE; ?></button></p>
            <?php } ?>
        <div id="close_book_panel" style="display: none; font-weight:bold; font-size: 15pt; background-color: #e55727; opacity: 1; position:fixed; top:120px; height: 30px; color:#fff; border-radius: 5px; width:603px; text-align:center; left:10px; z-index:1000; cursor:pointer;" onclick="book_house();">Close</div>
        <iframe height='400' width='603' frameborder='0' marginwidth='0' scrolling='AUT' src='http://www.holidayrentalmanagement.com/PIMSforms/PIMSdatecheck.php?uin=447395&formID=3&propcode=<?php echo $house->houseid; ?>&inline=1' style="display:none; position:fixed; top:150px; left: 10px; padding: 40px; border: solid 1px #ccc; border-radius: 5px; background-color: #fff; z-index:1000;" id="book_house_panel"></iframe>
        <!-- / buttons book, question, review, favorites -->
        
    </div>

</div>


<div class="tabs_buttons"></div>
    <!--list of all tabs-->
    <ul id="countrytabs" class="shadetabs">
        <li><a href="#" rel="price_availability" class="house-info-tab selected" onmouseup="setTimeout('initialize()', 10)"><?php echo _REALESTATE_MANAGER_TAB_CALENDAR; ?></a></li>
        <li><a href="#" rel="country1" class="house-info-tab" ><?php echo _REALESTATE_MANAGER_TAB_MAIN; ?></a></li>
        <li><a href="#" rel="country2" class="house-info-tab" onmouseup="setTimeout('initialize()',10)"><?php echo _REALESTATE_MANAGER_TAB_LOCATION; ?></a></a></li>
        <li><a href="#" rel="country3" class="house-info-tab"><?php echo _REALESTATE_MANAGER_TAB_ALL; ?></a></li>
        <li><a href="#" rel="photos" class="house-info-tab"><?php echo _REALESTATE_MANAGER_HEADER_PHOTOGALERY; ?></a></li>
        <?php
        if(count($house->videos) > 0) {
			// New videos to show !!!!!!
			if( $house->extra6 == "true") {
        ?>
				<li><a href="#" rel="videos" id="videos_blinking" class="house-info-tab" onclick=""><?php echo _REALESTATE_MANAGER_HEADER_VIDEOS; ?></a></li>
        <?php
			}else{
		?>
				<li><a href="#" rel="videos" class="house-info-tab"><?php echo _REALESTATE_MANAGER_HEADER_VIDEOS; ?></a></li>
		<?php
			}
        }
        ?>
        <li><a href="#" rel="country4" class="house-info-tab"><?php echo _REALESTATE_MANAGER_TAB_REVIEWS; ?></a></li>
        <?php
        if($house->extra1 == "true"){
        ?>
            <li><a href="#" rel="for_sale" class="house-info-tab"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA1; ?></a></li>
        <?php
        }
        ?>
    </ul>


<!--Description tab-->
<div id="tabs">
    <div id="country1" class="tabcontent">
        <div class="table_tab_01 table_03">
         <?php if ($language->getTag() == 'en-GB' && trim($house->description)) { ?>
                <div class="row_text">
                    <span class="col_text_2"><?php echo $house->description; ?></span>
                </div>

                <?php
            } else if ($language->getTag() == 'fr-FR' && trim($house->description_fr)) { ?>
                <div class="row_text">
                    <span class="col_text_2"><?php echo $house->description_fr; ?></span>
                </div>

            <?php } else {
                echo "<center><span class='list_item_no_description'>". strtoupper( _REALESTATE_MANAGER_LABEL_NO_DESCRIPTION ) ."</span></center>";
            } ?>
        </div>
    </div>
	<!--Description tab-->

    <!-- Location and Map Tab -->
    <div id="country2" class="tabcontent">
    	<?php 
    	if ($language->getTag() == 'en-GB') 
    		echo "<span class='componentheading' style='padding-top:0;top:0;'>Approximate location</span>"; 
    	else 
    		echo "<span class='componentheading' style='padding-top:0;top:0;'>Localisation approximative</span>"; ?>  
        <!--if we are given the coordinates, then display latitude, longitude and a map with a marker -->
		<?php if ($house->hlatitude && $house->hlongitude) { ?> 

					<div class="table_latitude table_04">
						<div id="map_canvas" class="re_map_canvas re_map_canvas_02"></div>
					</div>

			<?php } //else
			//echo _REALESTATE_MANAGER_LABEL_NO_LOCATION_AVAILIBLE;
		?>
    </div>
    <!-- end of Location and Map Tab -->
    
    <!-- Reviews Tab -->
    <div id="country4" class="tabcontent">
        <!-- Reviews Form -->
        <!-- Reviews Form -->
        <!-- Reviews Form -->
        <div id="review-form" style=" display:none; position:relative; top:50px; margin-bottom:50px; margin-left: 1%; margin-right: 4%;">
        
            <form action="<?php echo sefRelToAbs("index.php?option=com_realestatemanager&amp;task=review&amp;Itemid=" . $Itemid); ?>" method="post" name="review"> 
                <input type="hidden" name="user_name" value="<?php echo $my->username ?>">
                <input type="hidden" name="fk_userid" value="<?php echo $my->id ?>">
                <input type="hidden" name="user_email" value="<?php echo $my->email ?>">
                
			    <div class="add_table_review table_09">
        
                    <div class="row_01"><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_TITLE; ?></div>
                    <div class="row_02">
                        <input class="inputbox" type="text" name="title" size="80" value="<?php if (isset($_REQUEST["title"])) {
            echo $_REQUEST["title"];
        } ?>" /> 
                    </div>
        
                    <div class="row_03"><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_COMMENT; ?></div>
                    <div class="row_04">
        <?php
        $comm_val = "";
        if (isset($_REQUEST["comment"])) {
            $comm_val = $_REQUEST["comment"];
        }
        //editorArea( 'editor1',  $comm_val, 'comment', '410', '200', '60', '10' );
        ?>
                        <textarea name="comment" cols="50" rows="8" style="color:#000;  "><?php echo $comm_val; ?></textarea>
                    </div>
        
                    <!-- #### RATING #### -->
                            <?php if (version_compare(JVERSION, "3.0", "ge")): ?>
                        <script type="text/javascript">
                            os_img_path = '<?php echo $mosConfig_live_site . '/components/com_realestatemanager/images/'; ?>' ;
                            jQuerREL(document).ready(function(){
                                jQuerREL('#star').raty({
                                    starHalf: os_img_path+'star-half.png',
                                    starOff: os_img_path+'star-off.png',
                                    starOn: os_img_path+'star-on.png' 
                                });
                            });
                        </script>
        
                        <div class="row_rating_j3">
                            <span class="lable_rating"><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_RATING; ?></span>
                            <span id="star"></span>
                        </div>
        
            <?php else:
            ?>
                        <div class="row_rating_j2">
                            <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_RATING; ?></span>
                            <br />
                            <span>  
            <?php
            $k = 0;
            while ($k < 11) {
                ?>
                                    <input type="radio" name="rating" value="<?php echo $k; ?>" <?php
                if (isset($_REQUEST["rating"]) && $_REQUEST["rating"] == $k) {
                    echo "CHECKED";
                }
                ?> alt="Rating" />
                                    <img src="./components/com_realestatemanager/images/rating-<?php echo $k; ?>.png" alt="<?php echo ($k) / 2; ?>" border="0" /><br />
                <?php
                $k++;
            }
            ?>
                            </span>
                        </div>
        
        <?php endif; ?>
        
                    <!--****************************   end add antispam guest   ******************************-->
                    <div  class="row_button_review">
                        <span class="button_save"> 
                            <!-- save review button-->
                            <button class="button house-operations-button house-operations-button-small" onclick="review_submitbutton()"><?php echo _REALESTATE_MANAGER_LABEL_BUTTON_SAVE; ?></button>
                        </span>
                                                    
                        <!--<span class="button_hide"> --> 
                            <!-- hide review button-->
                            <!--<span class="button house-operations-button house-operations-button-small" onclick="house_review()"><?php echo _REALESTATE_MANAGER_LABEL_BUTTON_REVIEW_HIDE; ?></span>
                        </span>-->
                    </div>
        
                </div>
        
                <input type="hidden" name="fk_houseid" value="<?php echo $house->id; ?>" />
                <input type="hidden" name="catid" value="<?php $temp = $house->catid;
        echo $temp[0]; ?>" />
            </form>
        </div> 
        <!-- End Reviews Form -->
        <?php
		//
		//show the reviews
		//
            if ($params->get('show_reviews')) {
                if ($reviews = $house->getReviews()) {
                    ?>
                    <br />
                    <!--<div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
                        <?php echo _REALESTATE_MANAGER_LABEL_REVIEWS; ?> 
                    </div>-->

                    <div class="reviews_table table_06">
                        <?php
                        if ($reviews != null && count($reviews) > 0) {
                            for ($m = 0, $n = count($reviews); $m < $n; $m++) {
                                $review = $reviews[$m];
                                if($review->published != 1){  
                                
	                                ?>
	                                <div class="box_comment">
	                                    <div class="user_name"><?php echo $review->user_name; ?></div>
	                                    <span class="arrow_up_comment"></span>
	                                    <div class="head_comment">
	                                        <div class="title_rating">
	                                            <span class="col_title_rev"><?php echo $review->title; ?></span>
	                                            <span class="col_rating_rev">
	                                                <img src="./components/com_realestatemanager/images/rating-<?php echo $review->rating; ?>.png" alt="<?php echo ($review->rating) / 2; ?>" border="0" align="right"/>
	                                            </span>
	                                        </div>
	                                        <div class="row_comment">
	                                            <span class="quotes_before"></span><?php echo $review->comment; ?><span class="quotes_after"></span>
	                                        </div>
	                                        <div class="date">
	                                            <span class="date_format"><?php echo data_transform_rem($review->date); ?></span>
	                                        </div>
	                                    </div>
	                                </div>
	                                <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                } 
            	else{   
                	if($language->getTag() == 'fr-FR')
                		echo "Les commentaires de cette villa ne sont pas disponibles pour le moment. Si vous souhaitez lire les commentaires, s'il vous plaît demander par la poste.";
            		else
            			echo "The reviews of this villa are not available at the moment. If you would like to read the reviews, please request them by mail.";
                }
            }
            ?>
    </div>
    <!-- end of Reviews Tab -->
    
    <!-- Photo Gallery Tab -->
    <div id="photos" class="tabcontent">
        <div class="table_gallery table_07">
        <?php if (count($house_photos) > 0) { ?>
                <!--<div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>" > 
            <?php echo _REALESTATE_MANAGER_HEADER_PHOTOGALERY; ?>
                </div>-->
                <div class="gallery_img">
                <?php for ($i = 0;$i < count($house_photos);$i++) { ?>
                    <div class="thumbnail viewHouses" style="width: <?php echo $realestatemanager_configuration['fotogal']['width'];?>px; height: <?php echo $realestatemanager_configuration['fotogal']['high'];?>px;" >
                        <a href="<?php echo $mosConfig_live_site; ?>/components/com_realestatemanager/photos/<?php echo PHP_realestatemanager::picture_thumbnail($house_photos[$i]->main_img, $realestatemanager_configuration['fotoupload']['high'], $realestatemanager_configuration['fotoupload']['width']); ?>" data-lightbox="roadtrip" title="photo" >
                             <img alt="<?php echo $house->htitle; ?>" title="<?php echo $house->htitle; ?>" src="./components/com_realestatemanager/photos/<?php echo PHP_realestatemanager::picture_thumbnail($house_photos[$i]->main_img, $realestatemanager_configuration['fotoupload']['high'], $realestatemanager_configuration['fotoupload']['width']); ?>" style = "vertical-align:middle;" />
                        </a>
                    </div>
                <?php
                }
                ?>
                </div>
        <?php }
        ?>
        </div>
    </div>
    <!-- end of Photo Gallery Tab -->
    <?php
    if(count($house->videos) > 0) {
    ?>
        <!-- Video Gallery Tab -->
        <div id="videos" class="tabcontent">
         
          <p style="margin-left: 5cm;">     
            <?php
				// New videos to show !!!!!!
				//echo "mostra: ".$house->extra6;
                //print_r($house);
                foreach($house->videos as $video){
                    $youtubeLink = str_replace("com/watch?v=", "com/embed/", $video);
                    //$youtubeLink = str_replace("https", "http", $youtubeLink);
                    //$youtubeEmbed = '<iframe width="420" height="315" src="'.$youtubeLink.' allowfullscreen"></iframe>';
                    // <iframe width="560" height="315" src="https://www.youtube.com/embed/wyJ8_62YUw8" frameborder="0" allowfullscreen></iframe>
                    $youtubeEmbed = '<iframe src="' . $youtubeLink . '" width="420" height="315"  frameborder="0" allowfullscreen></iframe>';
                    echo $youtubeEmbed;
                }
            ?>
           </p> 
        </div>
        <!-- end of Video Gallery Tab -->
    <?php
    }
    ?>
    
    <!-- Price and Availability Tab -->
    <div id="price_availability" class="tabcontent">
    	<div id="availability-form">
    		
	    	<?php
	        	// tabela preços sessao
	            $price_content = file_get_contents("http://www.holidayrentalmanagement.com/userratecards/pimsratecard.php?uid=0129&propcode=".$house->houseid."&lang=en");
	            /* Show price table */
	            //echo "<iframe height='600' width='603' frameborder='0' marginwidth='0' scrolling='no' src='http://www.holidayrentalmanagement.com/userratecards/pimsratecard.php?uid=0129&propcode=".$house->houseid."&lang=en'></iframe>";
	            echo $price_content;
	            echo "<br><br>";
	            /* Show Availability Calendar */
	            //$availability_calendar = file_get_contents("http://www.holidayrentalmanagement.com/usercalendars/pimscalendar.php?uid=0129&nohistory=1&nofuture=0&calsize=12&calcols=3&cellwidth=22&sizemonth=8&sizeday=8&sizedate=7&propcode=".$house->houseid."&lang=en");
	            //echo "<iframe height='600' width='603' frameborder='0' marginwidth='0' scrolling='no' src='http://www.holidayrentalmanagement.com/usercalendars/pimscalendar.php?uid=0129&nohistory=1&nofuture=0&calsize=12&calcols=3&cellwidth=22&sizemonth=8&sizeday=8&sizedate=7&propcode=".$house->houseid."&lang=en'></iframe>";
	            //echo $availability_calendar;
	            // calendario de availability
	            echo "<iframe name='calendar_iframe_viewhouse' id='calendar_iframe_viewhouse' height='600' width='603' frameborder='0' marginwidth='0' scrolling='no' src='http://www.holidayrentalmanagement.com/usercalendars/pimscalendar.php?uid=0129&nohistory=1&nofuture=0&calsize=12&calcols=3&cellwidth=72&sizemonth=8&sizeday=8&sizedate=7&propcode=".$house->houseid."&lang=en'></iframe>";
	            
	            // Please Rotate to view calendar
	            // echo "<div name='rotate_to_viewcalendar' id='rotate_to_viewcalendar' style='display:none'>"._REALESTATE_MANAGER_LABEL_ZONING."</div>";
	            
	            echo "<div id='availability-tab-info'>";
		            if($language->getTag() == 'fr-FR')
		                echo $house->availability_tab_info_fr;
		            else 
		                echo $house->availability_tab_info;
	            echo "</div>";
	        ?>
	        
        </div>
        <div id="book-form" style=" display:none; background:white; position:relative; top:50px; margin-bottom:50px; margin-left: 2%; margin-right: 35%;">
            <iframe height="1000" width="800" frameborder="0" marginwidth="0" scrolling="AUT" src="<?php 
	    		echo "http://www.holidayrentalmanagement.com/PIMSforms/PIMSdatecheck.php?uin=447395&formID=3&propcode=".$house->houseid ."&amp;&inline=1";
	        	?>" style="top: 150px; left: 10px; padding: 40px; z-index: 1000;" id="book_house_panel"></iframe>
	     </div>
    </div>
    <!-- End of Price and Availability Tab -->
    
<!-- For Sale Tab -->
    <?php if($house->extra1 == "true") { ?>
    <div id="for_sale" class="tabcontent">
    	<div id="country4" class="tabcontent" style="display: block;">
	    	<?php echo _REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_FEATURE; ?>
    	</div>
    	<div class="row_text">
			<!-- formatMoney($house->price, true, $realestatemanager_configuration['price_format']) -->
            <span class="col_text_2">
                    <?php
        			if ($house->price != 0){
                    	
	                    if ($realestatemanager_configuration['price_unit_show'] == '1') 
	                        echo _REALESTATE_MANAGER_HEADER_ADDRESS_FIELDS . " " . number_format($house->price, 0, ',', '.') . " €"; 
	                    else
	                        echo _REALESTATE_MANAGER_HEADER_ADDRESS_FIELDS . " € " . number_format($house->price, 0, ',', '.');
                    
                    }
                    ?>
            </span>
        </div>
        
		  <?php
    if ( ($house->property_taxes > 0.00) and trim($house->year) and trim($house->lot_size) and trim($house->area)) { ?>
        <div class="row_text"> 
			<!-- ano de construcao-->
			<span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_BUILD_YEAR; ?>:</span>
            <span class="col_text_1"><?php echo $house->year; ?> &nbsp;</span>
			
			<!-- taxas -->
			<span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TAXES; ?>:</span>
            <span class="col_text_1"><?php echo $house->property_taxes; ?> &nbsp;</span>
		
			<!-- area habitavel-->
			<span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_AREA; ?>:</span>
            <span class="col_text_1"><?php echo $house->area; ?>m<sup>2</sup>&nbsp;</span>
			
			<!-- area lot -->
            <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_LOT_SIZE; ?>:</span>
            <span class="col_text_1"><?php echo $house->lot_size; ?>m<sup>2</sup> &nbsp;</span>
			
			<!-- area development -->
            <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_AGENT; ?>:</span>
            <span class="col_text_1"><?php echo $house->agent; ?>m<sup>2</sup> &nbsp;</span>	
			
        </div>
        <?php
    }
    ?>
       
    </div>
    <?php } ?>
    <!-- End of For Sale Tab -->
        
    <!-- Facilities and Activities Tab -->
    <div id="country3" class="tabcontent">
        <?php
            $style[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
            $i = 1;
            foreach ($style1 as $style2) {
                $style[$i] = $style2;
                $i++;
            }
            if ($house->style != 0) {
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_STYLE; ?>:</span>
                    <span class="col_text_2"><?php echo $style[$house->style]; ?></span>
                </div>
		<?php
}
$zoning[0] = _REALESTATE_MANAGER_OPTION_SELECT;
$zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_ZONING);
$i = 1;
foreach ($zoning1 as $zoning2) {
    $zoning[$i] = $zoning2;
    $i++;
}
if ($house->zoning != 0) {
    ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_ZONING; ?>:</span>
                    <span class="col_text_2"><?php echo $zoning[$house->zoning]; ?></span>
                </div>
<?php } if (trim($house->school)) { ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL; ?>:</span>
                    <span class="col_text_2"><?php echo $house->school; ?></span>
                </div>
<?php } if (trim($house->school_district)) { ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL_DISTRICT; ?>:</span>
                    <span class="col_text_2"><?php echo $house->school_district; ?></span>
                </div>
<?php }  if (trim($house->agent)) { ?>
               <!-- <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_AGENT; ?>:</span>
                    <span class="col_text_2"><?php echo $house->agent; ?></span>
                </div> -->
            <?php } if (trim($house->hoa_dues)) { ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_HOA_DUES; ?>:</span>
                    <span class="col_text_2"><?php echo $house->hoa_dues; ?></span>
                </div>
            <?php }
            
             if (trim($house->contacts)) {
                            ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_CONTACTS; ?>:</span>
                <span class="col_text_2"><?php echo $house->contacts; ?></span>
            </div>
            <?php }
            $listing_status[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $listing_status1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
            $i = 1;
            foreach ($listing_status1 as $listing_status2) {
                $listing_status[$i] = $listing_status2;
                $i++;
            }
            
            $property_type[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
            $i = 1;
            foreach ($property_type1 as $property_type2) {
                $property_type[$i] = $property_type2;
                $i++;
            }
          
            
            $provider_class[0] = _REALESTATE_MANAGER_OPTION_SELECT;
            $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
            $i = 1;
            foreach ($provider_class1 as $provider_class2) {
                $provider_class[$i] = $provider_class2;
                $i++;
            }
            if ($house->provider_class != 0) {
                ?>
                <!--
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_PROVIDER_CLASS; ?>:</span>
                    <span class="col_text_2"><?php echo $provider_class[$house->provider_class]; ?></span>
                </div>
                -->
                <?php }
            ?>
<?php if (trim($house->model)) { ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_MODEL; ?>:</span>
                    <span class="col_text_2"><?php echo $house->model; ?></span>
                </div>
                <?php }
            ?>
            <?php 
                    
                    if (count($house_feature)) {
                        ?>
                <div class="row_text">
                    <span class="col_text_2" style="text-align: justify;">
                        <?php
                        //print_r($house_feature);
                        for ($i = 0; $i < count($house_feature); $i++) {
                            if ($realestatemanager_configuration['manager_feature_category'] == 1) {
                                if ($i != 0) {
                                    
                                	
                                	
                                	
                                 if ($house_feature[$i]->categories !== $house_feature[$i - 1]->categories){
                                  	
                                	if($language->getTag() == 'fr-FR'){
                                		// ver se == Activities
                                		if($house_feature[$i]->categories == "Activities")
                                			echo '<div class="house-feature-category">Activités</div>';
                                		// outside
                                		else if($house_feature[$i]->categories == " Outside")
                                			echo '<div class="house-feature-category">A l’extérieur</div>';
                                		// inside
                                		else if($house_feature[$i]->categories == " Inside")
                                			echo '<div class="house-feature-category">A l’intérieur</div>';
                                		else
                                			echo '<div class="house-feature-category">'.$house_feature[$i]->categories.'</div>';
                                	}
                                	else
                                		echo '<div class="house-feature-category">'.$house_feature[$i]->categories.'</div>';
                                  }
                                } else
                                    echo "<div class='house-feature-category'>" . $house_feature[$i]->categories . "</div>";
                            }
                            if ($realestatemanager_configuration['manager_feature_image'] == 1 and $house_feature[$i]->image_link != '') {
                                ?>       
                                <img alt="photo" src="<?php echo "$mosConfig_live_site/components/com_realestatemanager/featured_ico/" . $house_feature[$i]->image_link; ?>"></img>      
            <?php
        }
       if($language->getTag() == 'fr-FR')
        	echo '<span class="house-feature">'.$house_feature[$i]->name_fr.'</span>';
        else 
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
            <?php
            
            /**if ($realestatemanager_configuration['extra4'] == 1 && $house->extra4 != "") {
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA4; ?>:</span>
                    <span class="col_text_2"><?php echo $house->extra4; ?></span>
                </div>
                <?php
            }
            if ($realestatemanager_configuration['extra5'] == 1 && $house->extra5 != "") {
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA5; ?>:</span>
                    <span class="col_text_2"><?php echo $house->extra5; ?></span>
                </div>
                <?php
            }
            if ($realestatemanager_configuration['extra6'] == 1 && $house->extra6 > 0) {
                $extra1 = explode(',', _REALESTATE_MANAGER_EXTRA6_SELECTLIST);
                $i = 1;
                foreach ($extra1 as $extra2) {
                    $extra[$i] = $extra2;
                    $i++;
                }
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA6; ?>:</span>
                    <span class="col_text_2"><?php echo $extra[$house->extra6]; ?></span>
                </div>
                <?php
            }
            if ($realestatemanager_configuration['extra7'] == 1 && $house->extra7 > 0) {
                $extra1 = explode(',', _REALESTATE_MANAGER_EXTRA7_SELECTLIST);
                $i = 1;
                foreach ($extra1 as $extra2) {
                    $extra[$i] = $extra2;
                    $i++;
                }
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA7; ?>:</span>
                    <span class="col_text_2"><?php echo $extra[$house->extra7]; ?></span>
                </div>
                <?php
            }
            if ($realestatemanager_configuration['extra8'] == 1 && $house->extra8 > 0) {
                $extra1 = explode(',', _REALESTATE_MANAGER_EXTRA8_SELECTLIST);
                $i = 1;
                foreach ($extra1 as $extra2) {
                    $extra[$i] = $extra2;
                    $i++;
                }
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA8; ?>:</span>
                    <span class="col_text_2"><?php echo $extra[$house->extra8]; ?></span>
                </div>
                <?php
            }
            if ($realestatemanager_configuration['extra9'] == 1 && $house->extra9 > 0) {
                $extra1 = explode(',', _REALESTATE_MANAGER_EXTRA9_SELECTLIST);
                $i = 1;
                foreach ($extra1 as $extra2) {
                    $extra[$i] = $extra2;
                    $i++;
                }
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA9; ?>:</span>
                    <span class="col_text_2"><?php echo $extra[$house->extra9]; ?></span>
                </div>
    <?php
}
if ($realestatemanager_configuration['extra10'] == 1 && $house->extra10 > 0) {
    $extra1 = explode(',', _REALESTATE_MANAGER_EXTRA10_SELECTLIST);
    $i = 1;
    foreach ($extra1 as $extra2) {
        $extra[$i] = $extra2;
        $i++;
    }
    ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA10; ?>:</span>
                    <span class="col_text_2"><?php echo $extra[$house->extra10]; ?></span>
                </div>
    <?php }*/
?>
            <!--add edocument -->
            <?php
            /*if ($params->get('show_edocsrequest') && $house->edok_link != null) {
                $session = JFactory::getSession();
                $sid = $session->getId();
                $session->set("ssmid", $sid);
                setcookie('ssd', $sid, time() + 60 * 60 * 24, "/");
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_EDOCUMENT; ?>:</span>
                    <span class="col_text_2">
                        <a href="<?php echo sefRelToAbs('index.php?option=com_realestatemanager&amp;task=mdownload&amp;id=' . $house->id . '&amp;Itemid=' . $Itemid); ?>" target="blank">
            <?php echo _REALESTATE_MANAGER_LABEL_EDOCUMENT_DOWNLOAD; ?>
                        </a>
                    </span>
                </div>
    <?php
}*/ //end if
?>
    </div>
    <!-- end of Facilities and Activities Tab -->
    
    <!--</div>-->

<?php
/*if ($house->listing_type == 1) {
    if ($params->get('show_rentrequest') && $params->get('show_rentstatus') && $params->get('calendarlist_show')) {
        ?>
            <!--<div id="country5" class="tabcontent">-->
                <div style="text-align: center;" id="availability-form-and-calendar">
        <?php
        if (isset($_POST['month']) && isset($_POST['year'])) {
            $month = $_POST['month'];
            $year = $_POST['year'];
            $calendar = PHP_realestatemanager::getCalendar($month, $year, $house->id);
        } else {
            $month = date("m", mktime(0, 0, 0, date('m'), 1, date('Y')));
            $year = date("Y", mktime(0, 0, 0, date('m'), 1, date('Y')));
            $calendar = PHP_realestatemanager::getCalendar($month, $year, $house->id);
        }
        ?>
                    <span><b><?php echo _REALESTATE_MANAGER_LABEL_CALENDAR_TITLE; ?></b></span>

                    <br />
                    <br />

                    <form action="" method="post" id="calendar" name="calendar" >    

                        <select name="month" class="inputbox" onChange="form.submit()">
                            <option value="" disabled selected> -- Month -- </option>
                            <option value="1" <?php if ($month == '1') echo "selected" ?> ><?php echo JText::_('JANUARY'); ?></option>
                            <option value="2" <?php if ($month == '2') echo "selected" ?> ><?php echo JText::_('FEBRUARY'); ?></option>
                            <option value="3" <?php if ($month == '3') echo "selected" ?> ><?php echo JText::_('MARCH'); ?></option>
                            <option value="4" <?php if ($month == '4') echo "selected" ?> ><?php echo JText::_('APRIL'); ?></option>
                            <option value="5" <?php if ($month == '5') echo "selected" ?> ><?php echo JText::_('MAY'); ?></option>
                            <option value="6" <?php if ($month == '6') echo "selected" ?> ><?php echo JText::_('JUNE'); ?></option>
                            <option value="7" <?php if ($month == '7') echo "selected" ?> ><?php echo JText::_('JULY'); ?></option>
                            <option value="8" <?php if ($month == '8') echo "selected" ?> ><?php echo JText::_('AUGUST'); ?></option>
                            <option value="9" <?php if ($month == '9') echo "selected" ?> ><?php echo JText::_('SEPTEMBER'); ?></option>
                            <option value="10" <?php if ($month == '10') echo "selected" ?> ><?php echo JText::_('OCTOBER'); ?></option>
                            <option value="11" <?php if ($month == '11') echo "selected" ?> ><?php echo JText::_('NOVEMBER'); ?></option>
                            <option value="12" <?php if ($month == '12') echo "selected" ?> ><?php echo JText::_('DECEMBER'); ?></option>
                        </select>

                        <select name="year" class="inputbox"  onChange="form.submit()">
                            <option value="" disabled selected> -- Year -- </option>
                            <option value="2012" <?php if ($year == '2012') echo "selected" ?> >2012</option>
                            <option value="2013" <?php if ($year == '2013') echo "selected" ?> >2013</option>
                            <option value="2014" <?php if ($year == '2014') echo "selected" ?> >2014</option>
                            <option value="2015" <?php if ($year == '2015') echo "selected" ?> >2015</option>
                            <option value="2016" <?php if ($year == '2016') echo "selected" ?> >2016</option>
                            <option value="2017" <?php if ($year == '2017') echo "selected" ?> >2017</option>
                        </select>

                    </form>

                    <br />

                    <div class="tableC basictable">
                        <div class="row_01" align="center">
                            <div id="view_house_first_calendar"><span class="col_01" ><?php echo $calendar->tab1; ?></span></div>
                            <div id="view_house_second_calendar"><span class="col_02"><?php echo $calendar->tab2; ?></span></div>
                            <div id="view_house_third_calendar"><span class="col_03"><?php echo $calendar->tab3; ?></span></div>
                        </div>

                        <div class="row_02">
                            <span class="col_01"><?php echo $calendar->tab21; ?></span>
                            <span class="col_02"><?php echo $calendar->tab22; ?></span>
                            <span class="col_03"><?php echo $calendar->tab23; ?><br /></span>
                        </div>

                        <div class="calendar_notation row_03">
                            <div class="row_calendar">
                                <span class="label_calendar_available"><?php echo _REALESTATE_MANAGER_LABEL_CALENDAR_AVAILABLE; ?></span>
                                <div class="calendar_available_notation"></div>
                            </div>

                            <div class="row_calendar">
                                <span class="label_calendar_available"><?php echo _REALESTATE_MANAGER_LABEL_CALENDAR_NOT_AVAILABLE; ?></span>
                                <div class="calendar_not_available_notation"></div>
                            </div>
                        </div>
                    </div>
        <?php
    }
    ?>
            </div>
        <!--</div>-->
    <?php
}*/

?>
</div> <!--end all tabs -->


<script type="text/javascript">
    
    var countries=new ddtabcontent("countrytabs")
    countries.setpersist(true)
    countries.setselectedClassTarget("link") //"link" or "linkparent"
    countries.init()
    
    
    function teste() {
        document.getElementById("book_house_panel").style.display="block";
    }
    
    function showPriceAndAvailability(){
        countries.expandit(0);
        var pav_tab = document.getElementById("price_availability");
        pav_tab.focus();
        setTimeout(function(){}, 500);
        pav_tab.scrollIntoView();
    }
    
    function house_review() {
        (function($){
            var reviewsPos = <?php if(count($house->videos)) echo '6'; else echo '5'; ?>;
            
            var pav_tab = document.getElementById("country4");
            var box_form = $("#review-form");
            countries.expandit(reviewsPos);
            pav_tab.focus();
            setTimeout(function(){}, 500);
            pav_tab.scrollIntoView();
            $(box_form).show('slow');
        })(jQuery);
            
        
    }
    
    (function($){

    	//Abre sempre na primeira tab - Prices and Availability
    	$(document).ready(function(){
			countries.expandit(0);
        });
        
        var reviewsPos = <?php if(count($house->videos)) echo '6'; else echo '5'; ?>;
        var t = $('a.house-info-tab');
        $(document).on('click', t, function(){
            // fecha as reviews
            if (countries.currentTabIndex != reviewsPos) {
                if ($("#review-form") != null) {
                    //console.log($("#review-form"));
                    $("#review-form").hide();
                }
            }
         	// fecha book now
            if (countries.currentTabIndex != 0) {
                if ($("#book-form") != null) {
                	console.log($("#book-form"));
                    $("#book-form").hide();  
                    $("#availability-form").show(); 
                }
            }
        });
	
		<?php
		if($house->extra6 == 'true'){
	    ?>
		    var v = $('a[rel="videos"]'); 
		    $(document).on('click', v, function(){
			if (countries.currentTabIndex == 5){
			    $(v).attr('id', 'videos');
			    console.log("func1");
			}
			else if (countries.currentTabIndex != 5){
			    $(v).attr('id', 'videos_blinking');
			    console.log("func2");
			    $(v).show();
			    $("#videos").hide();
			}
		    });
	    
	    <?php
		} ?>
        
    })(jQuery);
    
</script>
            <?php
            global $option;
            if ($option != 'com_realestatemanager') {
                $form_action = "index.php?option=" . $option . "&amp;task=rent_request&amp;tab=getmyhousesTab&amp;Itemid=" . $Itemid . '#tabs-2';
            } else
                $form_action = "index.php?option=com_realestatemanager&amp;task=rent_request&amp;Itemid=" . $Itemid;
            ?>
<form action="<?php echo sefRelToAbs($form_action); ?>" method="post" name="house">

    <!--<div class="table_gallery table_07">
    <?php if (count($house_photos) > 0) { ?>
            <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>" > 
        <?php echo _REALESTATE_MANAGER_HEADER_PHOTOGALERY; ?>
            </div>
            <div class="gallery_img">
          <?php for ($i = 0;$i < count($house_photos);$i++) { ?>
            <div class="thumbnail viewHouses" style="width: <?php echo $realestatemanager_configuration['fotogal']['width'];?>px; height: <?php echo $realestatemanager_configuration['fotogal']['high'];?>px;" >
                <a href="<?php echo $mosConfig_live_site; ?>/components/com_realestatemanager/photos/<?php echo PHP_realestatemanager::picture_thumbnail($house_photos[$i]->main_img, $realestatemanager_configuration['fotoupload']['high'], $realestatemanager_configuration['fotoupload']['width']); ?>" data-lightbox="roadtrip" title="photo" >
                     <img alt="<?php echo $house->htitle; ?>" title="<?php echo $house->htitle; ?>" src="./components/com_realestatemanager/photos/<?php echo PHP_realestatemanager::picture_thumbnail($house_photos[$i]->main_img, $realestatemanager_configuration['fotogal']['high'], $realestatemanager_configuration['fotogal']['width']); ?>" style = "vertical-align:middle;" />
                </a>
            </div>
               <?php
		}
    ?>
            </div>
    <?php }
?>
    </div>-->   

    <input type="hidden" name="bid[]" value="<?php echo $house->id; ?>" />
<?php
if ($house->listing_type == 1) {
    if ($params->get('show_rentrequest') && $params->get('show_rentstatus')) {
        ?>
            <!--<input type="submit" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_RENT_REQU; ?>" class="button" onclick="document.house.submit();"/>-->
        </form>
        <?php
    } else
        echo "</form>";
} else if ($house->listing_type == 2) {
    ?>
    </form>
                <?php
                if ($params->get('show_buyrequest') && $params->get('show_buystatus')) {
                    global $option;
                    if ($option != 'com_realestatemanager') {
                        $form_action = "index.php?option=" . $option . "&amp;task=buying_request&amp;tab=getmyhousesTab&amp;Itemid=" . $Itemid . '#tabs-2';
                    } else
                        $form_action = "index.php?option=com_realestatemanager&amp;task=buying_request&amp;Itemid=" . $Itemid;
                    ?>
        <div id="hidden_buying" style = "<?php
            if (isset($_REQUEST['err_msg_buy'])) {
                echo 'display:none';
            }
            ?>">
            <input type="button" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_BUY_HOUSE; ?>" class="button" onclick="buy_house(true)"/>
        </div>
        <div id="show_buying" style="<?php
            if (isset($_REQUEST['err_msg_buy'])) {
                echo 'display:block';
            } else {
                echo 'display:none';
            }
            ?>">
            <form action="<?php echo sefRelToAbs($form_action); ?>" method="post" name="buying_request">
                <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
        <?php echo _REALESTATE_MANAGER_LABEL_BUYING; ?>
                </div>

                <div class="table_request table_08">
                    <?php
                    global $my;
                    if ($my->guest) {
                        ?>		
                        <div class="row_01">
                            <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME ?>:</span>
                            <span class="col_02"><input class="inputbox" type="text" name="customer_name" size="38" maxlength="80" /></span>
                        </div>
                        <div class="row_02">
                            <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL ?>:</span>
                            <span class="col_02"><input class="inputbox" type="text" name="customer_email" size="38" maxlength="80" /></span>
                        </div>

            <?php
        } else {
            ?>
                        <div class="row_03">
                            <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME ?>:</span>
                            <span class="col_02"><input class="inputbox" type="text" name="customer_name" size="38" maxlength="80" value="<?php echo $my->name; ?>" /></span>
                        </div>
                        <div class="row_04">
                            <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL ?>:</span>
                            <span class="col_02"><input class="inputbox" type="text" name="customer_email" size="38" maxlength="80" value="<?php echo $my->email; ?>"/></span>
                        </div>
            <?php
        }
        ?>
                    <div class="row_05">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_REQUEST_PHONE ?>:</span>
                        <span class="col_02"><input class="inputbox" type="text" name="customer_phone" size="38" maxlength="80" /></span>
                    </div>
                    <div class="row_06">
                        <span class="col_01"><?php echo _REALESTATE_MANAGER_LABEL_COMMENT ?>:</span>
                        <textarea name="customer_comment" cols="50" rows="8" ></textarea>        
                        <input type="hidden" name="bid[]" value="<?php echo $house->id; ?>" />
                    </div>
                    <div class="row_07">
                        <span class="col_01"><input type="button" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_SEND_REQUEST; ?>" class="button" onclick="buying_request_submitbutton()"/></span> 
                        <span class="col_02"><input type="button" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_HIDDEN_BUYING; ?>" class="button" onclick="buy_house(false)"/></span>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
} else
    echo "</form>";
?>

<?php
//show the reviews
if ($params->get('show_reviews')) {
    $reviews = $house->getReviews();
    ?>
                <?php
                if ($params->get('show_inputreviews')) {
                    ?>
        <!--***********   begin add for show/hiden button "Add review"   ***********************-->

        <!--<div id ="button_hidden_review" style="<?php
                    if (isset($_REQUEST['err_msg'])) {
                        echo 'display:none';
                    }
                    ?>">
            <input type="button" name="submit" value="<?php echo _REALESTATE_MANAGER_LABEL_BUTTON_ADD_REVIEW; ?>" class="button" onclick="javascript:button_hidden(true)"/>
            <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
                <hr />
            </div>
        </div>-->
        
        <?php
    } //end if($params->get('show_inputreviews'))
} // end if( $params->get('show_reviews'))
?>
<?php
mosHTML::BackButton($params, $hide_js);
?>

<!--</div>-->


<?php /*<div style="text-align: center;"><a href="http://ordasoft.com" style="font-size: 10px;">Powered by OrdaSoft!</a></div> */ ?>

<div id='back_opacity' style='width:100%; height:100%; position: fixed; top:0; left:0; background-color:#333; opacity:0.5; display:none'>&nbsp;</div>
