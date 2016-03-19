<?php
session_start(); //teste ERR_CACHE_MISS
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); 
// /teste ERR_CACHE_MISS  

if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
 *
 * @package  RealestateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com);
 * Homepage: http://www.ordasoft.com
 * @version: 3.0 Free
 *
 *
 */
global $hide_js, $Itemid, $mainframe, $mosConfig_live_site, $doc, $realestatemanager_configuration, $database, $task, $limit, $limitstart, $languagelocale;
$doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
//print_r($params);exit;
HTML_realestatemanager::showCrumbs($task);
?>
 <script type="text/javascript" src="templates/masterbootstrap/js/allureJS.js"></script>
<?php positions_rem($params->get('showsearch01')); ?>
<div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
    <!-- <?php echo $currentcat->header; ?>-->
</div>
<?php positions_rem($params->get('showsearch02')); ?>

<table class="basictable table_10" border="0" cellpadding="4" cellspacing="0" width="100%">
    <tr>
        <?php
        if ($currentcat->img != null && $currentcat->align == 'left') {
            ?>
            <td>
                <img src="<?php echo $currentcat->img; ?>" align="<?php echo $currentcat->align; ?>" />
            </td>
            <?php
        }
        ?>
        <td width="100%">
        <?php echo $currentcat->descrip; ?>
        </td>
        <?php
        if ($currentcat->img != null && $currentcat->align == 'right') {
            ?>
            <td>
                <img src="<?php echo $currentcat->img; ?>" align="<?php echo $currentcat->align; ?>"  alt = "?"/>
            </td>
            <?php
        }
        ?>
    </tr>
</table>

<script type="text/javascript">
	
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
	                   //         console.log(this.hcity);
	                            options.append($("<option />").val(this.hcity).text(this.hcity));
	                        });
	                    });
	                })(jQuery);
	}
        
        function removeSearchKeywords(){
            (function($){
                $("#searchtext").val('');
                submitForm();
            })(jQuery);
        }
        
    function showDate(){
        if(document.adminForm.search_date_box.checked){
            var x=document.getElementById("search_date_from");
            document.adminForm.search_date_from.type="text";
            var x=document.getElementById("search_date_until");
            document.adminForm.search_date_until.type="text";
        } else{
            var x=document.getElementById("search_date_from");
            document.adminForm.search_date_from.type="hidden";
            var x=document.getElementById("search_date_until");
            document.adminForm.search_date_until.type="hidden";}
    }
    
    var $currentList;
    var disabledLists = Array();
    
    function resetForm(){
        (function($){
            $("#limitstart").val("");
            $("#searchtext").val("");
            $("#City").val("");
            $("#search-arrival").val("");
            $("#search-departure").val("");
            $('#Region option:eq(0)').prop('selected', true);
            $('#Broker option:eq(0)').prop('selected', true);
            
            submitForm();
        })(jQuery);
    }
	
	function getUrlParams() {
            var href = window.location.href;
	    var ret = new UrlParams();
		
	    href = href.split('#')[1];
		
	    if (href === undefined || href === null || href.length <= 1) {
                return ret;
            }
		
	    var params = href.split('&');
		
	    for(var i=0; i<params.length; i++){
                var pair = params[i].split('=');
                var value;
		if (pair[1] === undefined || pair[1] === null) {
                    value = '';
                }else {
                    value = pair[1];
		}
		
		ret.addParam(pair[0], value);
		
	    }

	    return ret;
        }
	
	var UrlParam = function(name, value) {
            this.value = value;
	    this.name = name;
        }
	
	var UrlParams = function () {
            this.params = new Array();
		
	    this.addParam = function(name, value){
		var p = new UrlParam(name, value);
		this.params.push(p);
	    }
		
	    this.getParamValue = function(name) {
		if (this.params === undefined || this.params === null || this.params.length === 0) {
                    return null;
                }
		for(var j=0; j<this.params.length; j++){
		    if (this.params[j].name == name) {
                        return this.params[j].value;
                    }
		}
		return null;
	    }
		
	    this.getPageValue = function(){
		var p = this.getParamValue('p');
		var ret = 0;
			
		if (p !== undefined && p !== null && p !== '') {
                    ret = p;
                }
			
		return ret;
	    }
    }
	
    function submitForm(usingPagination){
        //document.getElementById("searchForm").submit();
        (function($){
            showLoading();
			if (!usingPagination) {
				$("#limitstart").val('0');
				window.location.hash = '#showResult&p=0';
            }
            var params = $("form#searchForm").serialize();
			
            $.ajax({
                url: $("form#searchForm").attr('action'),
                data: params,
                type: "POST"
                //preloadImage: 'modules/mod_bt_contentslider/tmpl/images/loading.gif'
            }).done(function(data){
		var page = $("#limitstart").val();
		
                page = (page/12)+1;
                	
                //Actualiza a vista em listagem
                $("#map_canvas").html($(data).find("#map_canvas").html());
                if ($(data).find("#gallery_rem").html() === undefined) {
                    $("#gallery_rem").html("");
                }else{
                    $("#gallery_rem").html($(data).find("#gallery_rem").html());
                }
                
                //Actualiza a vista em galeria
                if ($(data).find("#gallery_blocks_rem").html() === undefined) {
                    $("#gallery_blocks_rem").html("");
                }else{
                    $("#gallery_blocks_rem").html($(data).find("#gallery_blocks_rem").html());
                }
                
                //Actualiza o mapa Falhava AQUI
                $("#map_houses_script").replaceWith($(data).find("#map_houses_script"));
                if ($currentList.attr('id') == "map_canvas") {
                    initialize2();
                }
                
                //console.log($(data).find("#pagenavig-top").html());
                
		//Actualiza opções de ordenação
		if ($(data).find("#ShowOrderBy").html() === undefined) {
                    $("#ShowOrderBy").html("");
                }else{
		    $("#ShowOrderBy").html($(data).find("#ShowOrderBy").html());
		}
		
		console.log("New search");
		
                if ($(data).find("#fast_search").html() === undefined) {
                    $("#fast_search").htm("");
                }else{
                    $("#fast_search").html($(data).find("#fast_search").html());
                }
                //Actualiza a pagina��o
                
                if ($(data).find("#pagenavig-top").html() === undefined) {
					$("#pagenavig-top").html("");
                }
                else{
                	$("#pagenavig-top").html($(data).find("#pagenavig-top").html());
                }
                if ($(data).find("#pagenavig").html() === undefined) {
                	$("#pagenavig").html("");
                }
                else{
                	$("#pagenavig").html($(data).find("#pagenavig").html());
                }
                //$("#pagenavig-top").replaceWith($(data).find("#pagenavig-top"));
                //$("#pagenavig").replaceWith($(data).find("#pagenavig"));
                
				//Actualiza mensagem de erro
				if ( $(data).find("#error_message") === undefined ) {
                    $("#error_message").html("");
                }else{
					$("#error_message").html($(data).find("#error_message"));
				}
				
                hideLoading();
            });
        })(jQuery);
    }
	
    function executeNewSearch() {
        (function($){
            $("#limitstart").val("0");
			window.location.hash = '#showResult&p=0';
	    submitForm();
	})(jQuery);
    }
    
    function changeList(type) {
        (function($){
     //       console.log('-------------->'+type);
            $old = $currentList;
            $old.removeClass("current-search-list");
            $old.fadeOut();
            if (type == "MAP") {
   //             console.log('NO MAPA!!!!');
                $newList = $("#map_canvas");
                $("div#ShowOrderBy").hide();
                $("div.page_navigation").hide();
                
            }else if (type == "TABLE") {
      //          console.log('NA TABLE!!!!');
                $newList = $("#gallery_blocks_rem");
                $("div#ShowOrderBy").show();
                $("div.page_navigation").show();
                
            }else{
      //          console.log('NA LIST!!!!');
                $newList = $("#gallery_rem");
                $("div#ShowOrderBy").show();
                $("div.page_navigation").show();
                
            }
            $newList.addClass("current-search-list");
            $newList.fadeIn();
            if (type == "MAP") {
                initialize2();
            }
            disabledLists.shift()
            $currentList = $newList;
            disabledLists.splice(disabledLists.indexOf($currentList), 1, $old);
        })(jQuery);
        
    }
    
    function showLoading(){
        (function($){
                $("div#ShowOrderBy").hide();
                $("div.page_navigation").hide();
                $("#map_canvas").html("");
                $("#gallery_blocks_rem").html("");
                $("#gallery_rem").html("");
                $("#loading_houses").show();
            })(jQuery);
    }
    function hideLoading() {
            (function($){
       //         console.log($currentList.attr('id'));
                if ($currentList.attr('id') != 'map_canvas') {
                    $("div#ShowOrderBy").show();
                    $("div.page_navigation").show();
                }
                $("#loading_houses").hide();
            })(jQuery);
    }

        (function($){
            $('span.uncative-icon').click(function(){
                $(this).removeClass('uncative-icon');
            });
            
        })(jQuery);
    
    
    //window.addEvent('domready', function(){
    (function($){
        $(document).ready(function(){
            
            first_open = true;
            
            
            if (first_open && $("#loading_houses") != null) {
                $("#loading_houses").show();
            }
            
            var mapElement = document.getElementById("map_canvas");
            if (mapElement != null ) {
                mapElement.style.display='none';
                $currentList = $(".current-search-list");
                disabledLists.push($("#map_canvas"));
                
                var vars = $(location).attr('href').split("\/");
                if (vars[vars.length-1] == 'map') {
                    changeList("MAP");
                }
            }
            
            
            
            //Traduz o link das paginas para atributos do link (tag 'a')
            //Remove o href do link
            $("ul.pagination").children("li").each(function(){
                var obj = $(this).children("a");
                /*var link = $(obj).attr('href');
                if (link !== undefined) {
                    $(obj).attr('href', '#');
                    var vars = link.split("\/");
                    
                    if (!isNaN(vars[vars.length-1])) {
                        $(obj).attr('data-limit', vars[vars.length-1]);
                    }
                    else{
                        $(obj).attr('data-limit', 0);
                    }
                    if (!isNaN(vars[vars.length-2])) {
                        $(obj).attr('data-limitstart', vars[vars.length-2]);
                    }
                    else{
                        $(obj).attr('data-limitstart', 0);
                    }
                }else{
                    $(obj).attr('data-limit', 0);
                    $(obj).attr('data-limitstart', 0);
                }*/
            });
            
            $( window ).resize(function() {
                if ($(window).width() < 900 && $currentList.attr('id') == "gallery_rem") {
                    changeList("TABLE");
                } 
            });
            //Ao clicar no link das p�ginas passa os atributos do link da pagina
            //para elementos do formulario
            //E muda de pagina atraves da submiss�o do formulario
            //Assim muda de pagina atrav�s de ajax, sem necessidade de submissao da pagina
            //e para manter a vista actual, carregando apenas o mapa ou as listagens das casas
            //$("ul.pagination").find("a").click(function(){
            $(document).on("click", "a.pagenav", function(){
                if ($(this).parent().attr('class') != 'active' && $(this).parent().attr('class') != 'disabled') {
                    $("input[name='limit']").attr('value', $(this).attr('data-limit'));
		    var limitstart = parseInt($(this).attr('data-limitstart'));
                    $("input[name='limitstart']").attr('value', limitstart);
		    event.preventDefault();
                    var page=(limitstart/12)+1;
            //        console.log('limitstart->'+limitstart);
            //        console.log('page->'+page); 
		    window.location.hash = '#showResult&p='+page;
                    //submitForm();
                }
            });
			
	    $(window).on('hashchange', function(){
		var urlParams = getUrlParams();
		var urlPage = urlParams.getPageValue();
                urlPage = (urlPage-1)*12;
		$("#limitstart").val(urlPage);
		submitForm(true);
	    });
            
            if (first_open) {
                submitForm();
                first_open = false;
            }
            
        })
    })(jQuery);
    
</script>
<?php positions_rem($params->get('showsearch03')); ?>

<?php
$path = "index.php?option=" . $option . "&amp;task=search_houses&amp;Itemid=" . $Itemid;

// facilities
$getFacilities = "SELECT * ";
$getFacilities .= "FROM #__rem_feature as f ";
$getFacilities .= "WHERE f.published = 1 ";
$getFacilities .= "ORDER BY f.categories";
$database->setQuery($getFacilities);
$house_feature = $database->loadObjectList();


// cities
$whereclause = '';
if($REQUEST['region'] != null && $REQUEST['region'] != ''){
	$whereclause = "WHERE hregion='".$REQUEST['region']."'";
}
$getCities = " SELECT DISTINCT(hcity) FROM #__rem_houses ". $whereclause ." ORDER BY hcity ASC";
$database->setQuery($getCities);
$cities = $database->loadObjectList();


?>

<!-- SEARCH & BOOK -->
 <?php if($task == 'for_sale' || $task == 'best_of' || $task == 'favorites'){ ?>
	<h4 class="bestof-forsale" id="title-search"><?php echo _REALESTATE_MANAGER_ADMIN_SALE_MANAGER;?></h4>
<?php }?>

 <?php if($task != 'for_sale' && $task != 'best_of'){ ?>
	<form id="searchForm" class="formulariosearchvilla" action="<?php echo '#'; ?>" method="get" name="userForm1" style="width:350px; float:left;">
<?php } else{?>
	<form id="searchForm" action="<?php echo '#';?>" method="get" name="userForm1" style="width:350px; float:left;">
<?php }?>
    <input type="hidden" name="option" value="<?php echo $option; ?>" />
    <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" /> 
    <input type="hidden" name="task" value="<?php if($task == "") echo 'search_villa'; else echo $task; ?>" />
    <input type="hidden" name="limit" value="<?php echo $limit; ?>" />
    <input type="hidden" name="limitstart" id="limitstart" value="<?php echo $limitstart; ?>" />
    <input type="hidden" name="searchtext" id="searchtext" value="<?php echo $_POST['searchtext']; ?>" />
    <input type="hidden" name="order_field" id="search_form_order_field" value="<?php $_POST['order_field']; ?>" />
    
    <!-- BOTAO PARA MOBILE -->
    <?php if($task != 'for_sale' && $task != 'best_of'){ ?>
    	<span class="col_text_1 searchvillamenu" id="searchvilla-searchbook">
    		<?php echo _REALESTATE_MANAGER_ADMIN_SALE_MANAGER; ?>
    		<div class="hideButton" id="showmenu1">[ + ]</div>
    	</span> 
   		
    <?php }?>
    
    <!--  SEARCH VILLA --- BARRA DE PESQUISA  -->
    <div class="show_search_house table_country3" id="<?php echo $task ?>">
        <div id="search-area-lightOrange">
        <!-- REGIOES -->
	    <div class="row_text">
		<span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_REGION;?></span>
		<span class="col_text_2">
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
						<!-- <div class="search-title"><?php //echo _REALESTATE_MANAGER_LABEL_REGION;?></div>  -->
						<?php if($task == 'for_sale'){ ?>
							<label id="search-label-regions" style="height:69px;margin-top:14px;"> 
						<?php }else{ ?>
							<label id="search-label-regions" style="height:69px">
						<?php }?>
						<?php
						$selectedRegion = '';
						?>
							<select name="Region" onchange="getCities(value)" id="Region"> <!-- onchange="getCities(value)" -->
							
							<option value="all" <?php if($_REQUEST['Region'] == 'all') echo 'selected'; ?>><?php echo $provider_class[1]; ?></option>
							<option value="north" <?php if($_REQUEST['Region'] == 'north') echo 'selected'; ?>><?php echo $provider_class[2]; $selectedRegion = 'north'; ?></option>
							<option value="center" <?php if($_REQUEST['Region'] == 'center') echo 'selected'; ?>><?php echo $provider_class[3]; $selectedRegion = 'center';?></option>
							<option value="lisbon" <?php if($_REQUEST['Region'] == 'lisbon') echo 'selected'; ?>><?php echo $provider_class[4]; $selectedRegion = 'lisbon';?></option>
							<option value="alentejo" <?php if($_REQUEST['Region'] == 'alentejo') echo 'selected'; ?>><?php echo $provider_class[5]; $selectedRegion = 'alentejo';?></option> 
							<option value="algarve" <?php if($_REQUEST['Region'] == 'algarve') echo 'selected'; ?>><?php echo $provider_class[6]; $selectedRegion = 'algarve';?></option>
							<option value="madeira" <?php if($_REQUEST['Region'] == 'madeira') echo 'selected'; ?>><?php echo $provider_class[7]; $selectedRegion = 'madeira';?></option> 
							</select>
						</label>
                </span>
	    </div>
	    	<!-- CIDADES -->
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_CITY;?></span>  
                  <!--  
                  <span class="col_text_2"><input id="City" class="inputbox input-medium" placeholder='<?php echo _REALESTATE_MANAGER_SHOW_SUGGESTION_MANAGER;?>' type="text" name="City" size="15" maxlength="20" value="<?php echo $_POST['City']; ?>"/></span>
 		          --> 
                    <span class="col_text_2">
	                   	<label id="search-label-regions" style="height:69px"> 
	                            <select name="City" id="City">
	                            		<option value="" selected default><?php echo _REALESTATE_MANAGER_ALL_CITIES; ?></option>
	                            		 <?php for($i=0; $i<count($cities); $i++){
	                                    	if($cities[$i]->hcity != ''){?> 
	                                    		<option value="<?php echo $cities[$i]->hcity; ?>" <?php if($_REQUEST['City'] == $cities[$i]->hcity) echo 'selected'; ?>><?php echo $cities[$i]->hcity; ?></option>
		                        		 <?php  }} ?>
	                            </select>
	                     </label>
            		</span>
                 </div>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_ARRIVAL; ?></span>
                    <span class="col_text_2"><input id="search-arrival" class="dp" type="text" placeholder='<?php echo _REALESTATE_MANAGER_ADMIN_IMPEXP;?>' 
                                                    value="<?php if(isset($_REQUEST['Arrival'])) echo $_REQUEST['Arrival']; ?>"
                                                    name="Arrival" autocomplete="off" readonly="readonly" min="0" size="20" maxlength="20"/></span>
                </div>
                <div class="row_text">
                    <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_DEPARTURE; ?></span>
                    <span class="col_text_2"><input class="dp" type="text" placeholder='<?php echo _REALESTATE_MANAGER_ADMIN_IMPEXP;?>' 
                                                    id="search-departure" autocomplete="off" readonly="readonly" value="<?php if(isset($_REQUEST['Departure'])) echo $_REQUEST['Departure']; ?>"
                                                    name="Departure" min="0" size="20" maxlength="20"/></span>
                </div>
                <div class="row_text">
                    <div style="float:left;width:45%;">
                        <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_BATHROOMS; ?></span>
                        <span class="col_text_2">
                        	<label id="search-label-regions" style="height:69px">
	                        	<select id="Bathrooms" name="Bathrooms">
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
                        </span>
                    </div>
                    <div style="float:right;width:45%;">
                                                    
                        <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_BEDROOMS; ?></span>
                        <span class="col_text_2">
                        
                        <label id="search-label-regions" style="height:69px">
	                        	<select id="Bedrooms" name="Bedrooms">
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
                        
                        <!-- 
                        <input class="inputbox" type="number" name="Bedrooms" placeholder="1"
                                                    value="<?php if(isset($_REQUEST['Bedrooms'])) echo $_REQUEST['Bedrooms']; ?>"
                                                    min="0" size="20" maxlength="20"/>
                         -->
                        </span> 
                    </div> 
                </div>
                <div class="row_text">
	                <!-- PERSONS -->
                    <div style="float:left;width:45%;margin-bottom:-24px;">
		                <span class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_BROKER; ?></span>
		                <span class="col_text_2"> 
	                    	<label id="search-label-regions" style="height: initial !important">
	                                <select id="Broker" name="Broker">
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
						</span>
					</div>
					<!--  VALOR MAXIMO-->
					<div style="float:right;width:45%;"> 
                                                    
                     	<span id="max_week_price" class="col_text_1"><?php echo _REALESTATE_MANAGER_LABEL_SELECT_CATEGORIES; ?></span>
                    	<span class="col_text_2">
                           <label id="search-label-regions" style="height:69px">
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
                        </span>
                    </div> 
                </div>
            
    	    <!-- SEARCH BUTTONS -->
            <div class="container_box_1">
	            
	             <div class="search_villa_reset_button">
	                <button id="btn-search-detail" class="button btn-advanced-search" type="reset" onclick="resetForm();"> 
	                    <?php echo _REALESTATE_MANAGER_LABEL_RESET; ?>
	                </button>
	            </div>
            
                <button id="btn-search-detail" class="button btn-advanced-search" name="submit" type="button" onclick="executeNewSearch();">
                    <i class="glyphicon glyphicon-search"></i>
                    <?php echo _REALESTATE_MANAGER_LABEL_SEARCH_BUTTON; ?>
                </button>
            </div>
        </div>
        
        <?php if($task != 'best_of' && $task != 'for_sale' && $task != 'favorites'){ 
        ?>  
        	<!-- FACILITEIS -->
            	
            <div id="search-area-darkOrange" class="row_text">
                <span class="col_text_1 title-search-facilities">
                	<?php echo _REALESTATE_MANAGER_LABEL_FEATURE; ?>
                	<div class="hideButton" id="showmenu2">[ + ]</div>
                </span>
                <span class="col_text_2">
                    <?php
                    for ($i=0; $i<count($house_feature); $i++){
                        //
                        // categorias 
                        //
                    	if($i==0 || $house_feature[$i]->categories != $house_feature[$i-1]->categories){
                        	// ver se tá no frances
                        	if($languagelocale == 'fr-FR'){
	                        	// ver se == Activities
                        		if($house_feature[$i]->categories == "Activities")
                        			echo '<div class="house-feature-category">Activités</div>';
                        		// outside
                        		else if($house_feature[$i]->categories == "Outside")
                        			echo '<div class="house-feature-category">A l’extérieur</div>';
                        		// inside
                        		else if($house_feature[$i]->categories == "Inside")
                        			echo '<div class="house-feature-category">A l’intérieur</div>';
                        		else
                        			echo '<div class="house-feature-category">'.$house_feature[$i]->categories.'</div>';
                        	}
                        	else
                            	echo '<div class="house-feature-category">'.$house_feature[$i]->categories.'</div>';
                        }
                        ?>
                        <span class="house_feature_checkbox"> 
                            <input type="checkbox" name="house_feature[]" class="css-checkbox"
                                <?php if(isset($_REQUEST['house_feature']) && in_array($house_feature[$i]->id, $_REQUEST['house_feature'])) echo ' checked="checked" '; ?>
                                    id="checkbox<?php echo $house_feature[$i]->id;?>" value="<?php echo $house_feature[$i]->id;?>" onclick="submitForm();"/>
                            <label for="checkbox<?php echo $house_feature[$i]->id;?>" class="css-label radGroup1 clr">
                                <?php
                                if($languagelocale == 'fr-FR' && $house_feature[$i]->name_fr != '')
                                    echo $house_feature[$i]->name_fr;
                                else
                                    echo $house_feature[$i]->name;
                                ?>
                            </label>
                                
                        </span>
                        <?php
                    }
                    ?>
                </span>
            </div>
            
        <?php
        }
        ?>
        
        
        


    </div>

    <div style="clear: both;"></div>

<?php
mosHTML::BackButton($params, $hide_js);
?>
</form>

<?php PHP_realestatemanager::showSpotlights(); ?>

<div id="for_sale_intro" class="row" style="font-size:14px;color:#646262;display:none">    
	
	<div class="col-sm-12 col-sm-8 col-lg-8" style="padding-left:3%;padding-top:0%;margin-top:-30px;margin-left:3%">  
		<div class="row">
			<div class="page-header">
			<?php 	
				 if($languagelocale == 'fr-FR'){ ?>
				 	<h1> À Vendre </h1>
			 <?php }
			 else {?>
				<h1> For Sale </h1>
			 <?php } ?>
			</div>
			<div class="pull-none item-image"> <img class="image_page_for_sale" src="/allure/images/banners/banner7.jpg" alt="" itemprop="image"> </div>
			<br><br>
			<!-- 
			Interested in buying a villa in Portugal? Please <a onclick="sendEmailToConsultVillasForSale();" 
			style="cursor:pointer;color:blue">contact us</a> to take a look at our offer. 
			Portugal is a popular holiday destination and our job is lead you throughout the whole process of 
			buying, from the first time you visit our web site till the signature of the contract of acquisition.
			 -->
			 <?php 
			 
			// $date = "04/30/1973";
			// list($month, $day, $year) = split('[/.-]', $date);
			// echo "Month: $month; Day: $day; Year: $year<br />\n";
			 
			 //echo _REALESTATE_MANAGER_HOUSE_IMAGE_HEADER_SETTINGS; 
			 $query = "SELECT * FROM allure_rem_for_sale";
			 $database->setQuery($query);
			 $rentrequest = $database->loadObjectList();
			  
 			 $introduction = $rentrequest[0]->introduction; 
			 $introduction_fr = $rentrequest[0]->introduction_fr;
			 
			  $htmlcode1 = "<html> \n <body>";
			  $htmlcode2 = "</body> \n <html>";
			  $contentIntroduction = htmlspecialchars_decode(stripslashes($htmlcode1.$introduction.$htmlcode2));
			  $contentIntroductionFR = htmlspecialchars_decode(stripslashes($htmlcode1.$introduction_fr.$htmlcode2));
			 
			 if($languagelocale == 'fr-FR'){
			 	echo $contentIntroductionFR;
			 }
			 else {
				 echo $contentIntroduction;
			 }
			 ?>
			 <div class="row" style="padding-top:9%">
				<input autocomplete="off" id="for_sale_cred" name="for_sale_cred" size="35" style="height:32px !important;" onkeydown="if (event.keyCode == 13) verifyCredential();" type="password" placeholder="Insert the provided credential.">
		 		<button id="btn-search-detail" onclick="verifyCredential()" class="button btn-advanced-search" style="height:32px !important;padding-top:10px !important;width:41px !important;float:none"name="submit" type="button">
	          		<i class="glyphicon glyphicon-log-in"></i>
	        	</button> 
		   		<span id="confirmMessage" class="confirmMessage"></span>
			</div>
		</div>
		
  	</div>
  	 
</div> 

<div id="searchIconsBar" style="text-align: right; width: 650px; float: left;"> 
    <a class="btn-lg" aria-label="Right Align" onclick="changeList('TABLE');">
        <span class="unactive-icon glyphicon glyphicon-th" aria-hidden="true"></span>
    </a>
    <a class="btn-lg" aria-label="Right Align" onclick="changeList('LIST');">
        <span class="unactive-icon glyphicon glyphicon-align-justify" aria-hidden="true"></span>
    </a>
    <a class="btn-lg" aria-label="Right Align" onclick="changeList('MAP');">
        <span class="unactive-icon glyphicon glyphicon-map-marker" aria-hidden="true"></span>
    </a>
</div>

<?php if($task == 'for_sale'){ ?>
	<script>
		document.getElementById("searchIconsBar").style.display = "none";
		document.getElementById("inner-spotlight").style.display = "none";  
		document.getElementById("for_sale_intro").style.display = "";

		function sendEmailToConsultVillasForSale() 
        {
            window.location = "mailto:info@allure-villas.com?Subject=Requesting credentials to consult villas for sale&body=Hi,I would like to consult villas for sale, can you provide me the credentials please ?";
        }
		 function verifyCredential() {
			
	        	var pass2 = document.getElementById('for_sale_cred');
	            var message = document.getElementById('confirmMessage');
	            var goodColor = "#66cc66";
	            var badColor = "#ff6666";
	            if(getCredential() == pass2.value){
	                message.style.color = goodColor;
	                message.innerHTML = "Passwords Match!"
	            	document.getElementById("searchIconsBar").style.display = "";
	            	document.getElementById("inner-spotlight").style.display = "";  
	        		document.getElementById("for_sale_intro").style.display = "none"; 
	        		document.getElementById("searchResult").style.display = "";
	            }else{
	                message.style.color = badColor;
	                message.innerHTML = "Passwords Do Not Match!"
	            }
	        }
	</script>
<?php } ?>


<!--<?php positions_rem($params->get('showsearch04')); ?>
<div style="text-align: center;"><a href="http://ordasoft.com" style="font-size: 10px;">Powered by OrdaSoft!</a></div>
-->
