<?php
      defined('_JEXEC') or die;
      include 'includes/head.php';
      include 'includes/params.php';
?>
<!doctype html>
<html lang="en" >
      <body>
            <!-- GOOGLE ANALYTICS -->
			<?php include_once("analyticstracking.php") ?>
            <?php //echo "Favorites: "; print_r($_SESSION['favorite_houses']); ?>  
               
            <div class="allureContainer">       
               
            <!-------------------------------------------------------------- TOP ----------------------------------------------------------->
            <!-------------------------------------------------------------- TOP ----------------------------------------------------------->
            <!-------------------------------------------------------------- TOP ----------------------------------------------------------->
            <?php if($this->countModules('top')) : ?>
                  <div id="top">
                        <div class="container">
                              <div class="row">
                                    <jdoc:include type="modules" name="top" style="none"/>        
                              </div>
                        </div>
                  </div>
            <?php endif; ?>
            <!-------------------------------------------------------------- TOP ----------------------------------------------------------->
            <!-------------------------------------------------------------- TOP ----------------------------------------------------------->
            <!-------------------------------------------------------------- TOP ----------------------------------------------------------->
            
            
            
            
            
            
            <!----------------------------------------------------------- TOP-LOGO --------------------------------------------------------->
            <!----------------------------------------------------------- TOP-LOGO --------------------------------------------------------->
            <!----------------------------------------------------------- TOP-LOGO --------------------------------------------------------->
            <div id="header-top">
                  <div id="brand">
                        <a href="<?php echo $this->params->get('logo_link') ?>">
                              <img style="width:<?php echo $this->params->get('logo_width') ?>px; height:<?php echo $this->params->get('logo_height') ?>px; " src="<?php echo $this->params->get('logo_file') ?>" alt="Logo" />
                        </a>
                  </div>
            </div>
            <div id="top-header-languages" >
                  <?php if($this->countModules('top-header-languages')) : ?>
                        <jdoc:include type="modules" name="top-header-languages" style="block" />
                  <?php endif; ?>                                   
            </div>
            <div id="header-central-messages" >
                  <?php if($this->countModules('top-header-central-messages')) : ?>
                        <div  id="top-header-intro">
                              <jdoc:include type="modules" name="top-header-central-messages" style="block" />
                        </div>
                  <?php endif; ?>                                   
            </div>
            <?php if($this->countModules('top-search')) : ?>
                        <div  id="top-search">
                              <jdoc:include type="modules" name="top-search" style="block" />
                        </div>
            <?php endif; ?> 
            <!----------------------------------------------------------- TOP-LOGO --------------------------------------------------------->
            <!----------------------------------------------------------- TOP-LOGO --------------------------------------------------------->
            <!----------------------------------------------------------- TOP-LOGO --------------------------------------------------------->
            
            
            
            
            
            
            <!---------------------------------------------------------- MENU-SEARCH --------------------------------------------------------->
            <!---------------------------------------------------------- MENU-SEARCH --------------------------------------------------------->
            <!---------------------------------------------------------- MENU-SEARCH --------------------------------------------------------->
            <?php if($this->countModules('menu-search')) : ?>
                  <div id="menu-search">
                        <jdoc:include type="modules" name="menu-search" style="block" />
                  </div>
            <?php endif; ?>
            <!---------------------------------------------------------- MENU-SEARCH --------------------------------------------------------->
            <!---------------------------------------------------------- MENU-SEARCH --------------------------------------------------------->
            <!---------------------------------------------------------- MENU-SEARCH --------------------------------------------------------->
            
            
            </div>      
            
            
            
            <!---------------------------------------------------------- NAVIGATION -------------------------------------------------------->
            <!---------------------------------------------------------- NAVIGATION -------------------------------------------------------->
            <!---------------------------------------------------------- NAVIGATION -------------------------------------------------------->
            <div id="navigation" class="<?php echo JFactory::getLanguage()->getTag(); ?>-navigation">
               <div class="allureContainer">
                  <div class="container">
                        <div class="navbar navbar-default" role="navigation">
                              <div class="navbar-header">
                                    <button type="button" id="btn-menu"  onclick="openCloseMenu()" class="navbar-toggle" data-toggle="" data-target=".navbar-collapse">
                                          <span class="sr-only">Toggle navigation</span>
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                    </button>
                              </div>
                              <div id ="menu-mobile" class="navbar-collapse collapse">
                                    <?php if ($this->countModules('navigation')) : ?>
                                          <nav class="navigation" role="navigation">
                                                <jdoc:include type="modules" name="navigation" style="none" />
                                          </nav>
                                    <?php endif; ?>
                              </div>
                        </div>
                  </div>
               </div>
            </div>
            <div class="allureContainer">
            <div id="main-Breadcrumbs" class="gray-breadcrumb">
                
            </div>
            <div id="top-social">
                  <?php if($this->countModules('top-social')) : ?>
                        <jdoc:include type="modules" name="top-social" style="block" />
                  <?php endif; ?>
            </div>
            </div>
            <!---------------------------------------------------------- NAVIGATION -------------------------------------------------------->
            <!---------------------------------------------------------- NAVIGATION -------------------------------------------------------->
            <!---------------------------------------------------------- NAVIGATION -------------------------------------------------------->

            
            
            
            
            
            
            
            <!---------------------------------------------------------- FULLWIDTH --------------------------------------------------------->
            <!---------------------------------------------------------- FULLWIDTH --------------------------------------------------------->
            <!---------------------------------------------------------- FULLWIDTH --------------------------------------------------------->
            <?php if($this->countModules('fullwidth')) : ?>
                  <div id="fullwidth">
                        <div class="row">
                              <jdoc:include type="modules" name="fullwidth" style="block"/>
                        </div>
                  </div>
            <?php endif; ?>
            <!---------------------------------------------------------- FULLWIDTH --------------------------------------------------------->
            <!---------------------------------------------------------- FULLWIDTH --------------------------------------------------------->
            <!---------------------------------------------------------- FULLWIDTH --------------------------------------------------------->
            





            
            <!------------------------------------------------------------ SEARCH ---------------------------------------------------------->
            <!------------------------------------------------------------ SEARCH ---------------------------------------------------------->
            <!------------------------------------------------------------ SEARCH ---------------------------------------------------------->
            <div class="allure-background-gray">
	            <?php $active = JFactory::getApplication()->getMenu()->getActive();?>
	            <div id="search" class="<?php echo $active->alias; ?>-search ">
	                   <?php if($this->countModules('search')) : ?>
	                         <jdoc:include type="modules" name="search" style="block" />
	                   <?php endif; ?>
	            </div>
            </div>
            <!------------------------------------------------------------ SEARCH ---------------------------------------------------------->
            <!------------------------------------------------------------ SEARCH ---------------------------------------------------------->
            <!------------------------------------------------------------ SEARCH ---------------------------------------------------------->
            
            
            
            
            <div class="allureContainer">
            
            <!----------------------------------------------------------- SHOWCASE --------------------------------------------------------->
            <!----------------------------------------------------------- SHOWCASE --------------------------------------------------------->
            <!----------------------------------------------------------- SHOWCASE --------------------------------------------------------->
            <?php if($this->countModules('showcase')) : ?>
                  <div id="showcase">
                        <div class="container">
                              <div class="row">
                                    <jdoc:include type="modules" name="showcase" style="block"/>
                              </div>
                        </div>
                  </div>
            <?php endif; ?>
            <!----------------------------------------------------------- SHOWCASE --------------------------------------------------------->
            <!----------------------------------------------------------- SHOWCASE --------------------------------------------------------->
            <!----------------------------------------------------------- SHOWCASE --------------------------------------------------------->
            
            
            
            
            
            
            
            
            <!---------------------------------------------------------- SPOTLIGHT --------------------------------------------------------->
            <!---------------------------------------------------------- SPOTLIGHT --------------------------------------------------------->
            <!---------------------------------------------------------- SPOTLIGHT --------------------------------------------------------->
            <?php if($this->countModules('spotlight')) : ?>
                  <div id="spotlight">
                        <jdoc:include type="modules" name="spotlight" style="block" />
                  </div>
            <?php endif; ?>
            <!---------------------------------------------------------- SPOTLIGHT --------------------------------------------------------->
            <!---------------------------------------------------------- SPOTLIGHT --------------------------------------------------------->
            <!---------------------------------------------------------- SPOTLIGHT --------------------------------------------------------->
            
            
            
            
            
            
            
            
            
            <!---------------------------------------------------------- FACILITIES -------------------------------------------------------->
            <!---------------------------------------------------------- FACILITIES -------------------------------------------------------->
            <!---------------------------------------------------------- FACILITIES -------------------------------------------------------->
            <?php if($this->countModules('facilities')) : ?>
                  <div id="facilities">
                        <jdoc:include type="modules" name="facilities" style="block" />
                  </div>
            <?php endif; ?>
            <!---------------------------------------------------------- FACILITIES -------------------------------------------------------->
            <!---------------------------------------------------------- FACILITIES -------------------------------------------------------->
            <!---------------------------------------------------------- FACILITIES -------------------------------------------------------->
            
            
            
            </div>
            
            
            
            <!----------------------------------------------------------- CONTENT ---------------------------------------------------------->
            <!----------------------------------------------------------- CONTENT ---------------------------------------------------------->
            <!----------------------------------------------------------- CONTENT ---------------------------------------------------------->
            <div class="container <?php echo str_replace("/","", $_SERVER['REQUEST_URI']) ?>">
               <div class="allureContainer">
                  <?php if($this->countModules('breadcrumbs')) : ?>
                        <div id="breadcrumbs">        
                              <div class="row">
                                    <jdoc:include type="modules" name="breadcrumbs" style="block" />
                              </div>
                        </div>
                  <?php endif; ?>
                  <div id="main" class="row show-grid">
                        <?php if($this->countModules('left')) : ?>
                              <div id="sidebar" class="col-sm-<?php echo $leftcolgrid; ?>">
                                    <jdoc:include type="modules" name="left" style="xhtml" />
                              </div>
                        <?php endif; ?>
                        <div id="container" class="containerTOPContainer-<?php echo $active->alias; ?> col-sm-<?php echo (12-$leftcolgrid-$rightcolgrid); ?>">       
                              <?php if($this->countModules('content-top')) : ?>
                                    <div id="content-top">
                                          <div class="row">
                                                <jdoc:include type="modules" name="content-top" style="block" />        
                                          </div>
                                    </div>
                              <?php endif; ?>
                              <div class="main-box <?php  if (strpos($_SERVER['REQUEST_URI'], '/allure/villas/view/') !== false) { echo 'vistaDeCasa'; }  ?>" >
                                    <jdoc:include type="component" />
                                    <jdoc:include type="message" />        
                              </div>       
                              <?php if($this->countModules('content-bottom')) : ?>
                              <div id="content-bottom" class="<?php echo $active->alias; ?>-content-bottom">
                                    <div class="row">
                                          <jdoc:include type="modules" name="content-bottom" style="block" />	
                                    </div>
                              </div>
                              <?php endif; ?>
                        </div>
                        <?php if($this->countModules('right')) : ?>
                              <div id="sidebar-2" class="col-sm-<?php echo $rightcolgrid; ?>">
                                    <jdoc:include type="modules" name="right" style="xhtml" />
                              </div>
                        <?php endif; ?>
                  </div>
               </div>
            </div>
            <!----------------------------------------------------------- CONTENT ---------------------------------------------------------->
            <!----------------------------------------------------------- CONTENT ---------------------------------------------------------->
            <!----------------------------------------------------------- CONTENT ---------------------------------------------------------->


            <div class="allureContainer">

            
            
            <!------------------------------------------------------ IN-THE-SPOTLIGHT ------------------------------------------------------>
            <!------------------------------------------------------ IN-THE-SPOTLIGHT ------------------------------------------------------>
            <!------------------------------------------------------ IN-THE-SPOTLIGHT ------------------------------------------------------> 
            <?php if($this->countModules('in-the-spotlight')) : ?>
                  <div id="in-the-spotlight" class="<?php echo $active->alias; ?>-in-the-spot">
                        <jdoc:include type="modules" name="in-the-spotlight" style="block" />
                  </div>
            <?php endif; ?>
            <!------------------------------------------------------ IN-THE-SPOTLIGHT ------------------------------------------------------>
            <!------------------------------------------------------ IN-THE-SPOTLIGHT ------------------------------------------------------>
            <!------------------------------------------------------ IN-THE-SPOTLIGHT ------------------------------------------------------>
            
             
             
            <!------------------------------------------------------ MAPA ------------------------------------------------------>
            <!------------------------------------------------------ MAPA ------------------------------------------------------>
            <!------------------------------------------------------ MAPA ------------------------------------------------------>      
            <?php if($this->countModules('mapa')) : ?>
                  <div id="mapa">
                        <jdoc:include type="modules" name="mapa" style="block" />
                  </div>
            <?php endif; ?>
            <!------------------------------------------------------ MAPA ------------------------------------------------------>
            <!------------------------------------------------------ MAPA ------------------------------------------------------>
            <!------------------------------------------------------ MAPA ------------------------------------------------------>
            
             
             
             
             
            <!----------------------------------------------------------- FEATURE ---------------------------------------------------------->
            <!----------------------------------------------------------- FEATURE ---------------------------------------------------------->
            <!----------------------------------------------------------- FEATURE ---------------------------------------------------------->
            <?php if($this->countModules('feature')) : ?>
                  <div id="feature" class="<?php echo $active->alias; ?>-features">
                        <div class="container">
                              <div class="row">
                                    <jdoc:include type="modules" name="feature" style="block" />        
                              </div>
                        </div>
                  </div>
            <?php endif; ?>
            <!----------------------------------------------------------- FEATURE ---------------------------------------------------------->
            <!----------------------------------------------------------- FEATURE ---------------------------------------------------------->
            <!----------------------------------------------------------- FEATURE ---------------------------------------------------------->
            
            
            </div>
            
            
            
            <!-------------------------------------------------------- INTRO-BOTTOM -------------------------------------------------------->
            <!-------------------------------------------------------- INTRO-BOTTOM -------------------------------------------------------->
            <!-------------------------------------------------------- INTRO-BOTTOM -------------------------------------------------------->
            <?php if($this->countModules('intro-bottom')) : ?>
                              <div id="intro-bottom">
                                <div class="allureContainer">
                                    <div class="row">
                                          <jdoc:include type="modules" name="intro-bottom" style="block" />	
                                    </div>
                                </div>
                              </div>
            <?php endif; ?>
            <!-------------------------------------------------------- INTRO-BOTTOM -------------------------------------------------------->
            <!-------------------------------------------------------- INTRO-BOTTOM -------------------------------------------------------->
            <!-------------------------------------------------------- INTRO-BOTTOM -------------------------------------------------------->
            

            

            <div class="allureContainer">	

            <!------------------------------------------------------------ BOTTOM ---------------------------------------------------------->
            <!------------------------------------------------------------ BOTTOM ---------------------------------------------------------->
            <!------------------------------------------------------------ BOTTOM ---------------------------------------------------------->
            <?php if($this->countModules('bottom')) : ?>
                  <div id="bottom"></div>
            <?php endif; ?>
            <!------------------------------------------------------------ BOTTOM ---------------------------------------------------------->
            <!------------------------------------------------------------ BOTTOM ---------------------------------------------------------->
            <!------------------------------------------------------------ BOTTOM ---------------------------------------------------------->
            
            
            </div>
            
            
            
            <!------------------------------------------------------------ FOOTER ---------------------------------------------------------->
            <!------------------------------------------------------------ FOOTER ---------------------------------------------------------->
            <!------------------------------------------------------------ FOOTER ---------------------------------------------------------->
            <div id="footer">
               <div class="allureContainer">
                  <?php if($this->countModules('Footer-Column-1')) : ?>
                        <div class="footer-column" id="footer-column-1">
                              <jdoc:include type="modules" name="Footer-Column-1" style="block" />
                        </div>
                  <?php endif; ?>
                  <?php if($this->countModules('Footer-Column-2')) : ?>
                        <div class="footer-column" id="footer-column-2">
                              <jdoc:include type="modules" name="Footer-Column-2" style="block" />
                        </div>
                  <?php endif; ?>
                   <?php if($this->countModules('Footer-Column-2-meio-3')) : ?>
                        <div class="footer-column" id="footer-column-2-meio-3">
                              <jdoc:include type="modules" name="Footer-Column-2-meio-3" style="block" />
                        </div>
                  <?php endif; ?>
                  <?php if($this->countModules('Footer-Column-3')) : ?>
                        <div class="footer-column" id="footer-column-3">
                              <jdoc:include type="modules" name="Footer-Column-3" style="block" />
                              <jdoc:include type="modules" name="Footer-Column-3-1" style="block" />
                              <jdoc:include type="modules" name="Footer-Column-3-2" style="block" />
                        </div>
                  <?php endif; ?> 
                  <?php if($this->countModules('Footer-Column-4')) : ?>
                        <div class="footer-column" id="footer-column-4">
                              <jdoc:include type="modules" name="Footer-Column-4" style="block" />
                        </div>
                  <?php endif; ?>
               </div>
            </div>
            <!------------------------------------------------------------ FOOTER ---------------------------------------------------------->
            <!------------------------------------------------------------ FOOTER ---------------------------------------------------------->
            <!------------------------------------------------------------ FOOTER ---------------------------------------------------------->






            <!---------------------------------------------------------- COPYRIGHT ---------------------------------------------------------->
            <!---------------------------------------------------------- COPYRIGHT ---------------------------------------------------------->
            <!---------------------------------------------------------- COPYRIGHT ---------------------------------------------------------->
            <div id="copyright">
               <div class="allureContainer">
                  <?php if($this->countModules('copyright')) : ?>
                        <jdoc:include type="modules" name="copyright" style="block" />
                  <?php endif; ?>
                  <div id="copyright-menu">
                        <?php if($this->countModules('copyright-menu')) : ?>
                              <jdoc:include type="modules" name="copyright-menu" style="block"/>
                        <?php endif; ?>
                  </div>
                  <div id="copyright-social">
                        <?php if($this->countModules('copyright-social')) : ?>
                              <jdoc:include type="modules" name="copyright-social"/>
                        <?php endif; ?>     
                  </div>
               </div>
            </div>
            <!---------------------------------------------------------- COPYRIGHT ---------------------------------------------------------->
            <!---------------------------------------------------------- COPYRIGHT ---------------------------------------------------------->
            <!---------------------------------------------------------- COPYRIGHT ---------------------------------------------------------->
        
        
        
        
        
        
            <!----------------------------------------------------------- SCRIPTS ----------------------------------------------------------->
            <!----------------------------------------------------------- SCRIPTS ----------------------------------------------------------->
            <!----------------------------------------------------------- SCRIPTS ----------------------------------------------------------->
            <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js"></script>
            <script type="text/javascript">
                  (function($){
                        $(document).ready(function(){
                        	  var resizeClick =0;
                              if ($('.parent').children('ul').length > 0) {
                                    $('.parent').addClass('dropdown');
                                    $('.parent > a').addClass('dropdown-toggle');
                                    $('.parent > a').attr('data-toggle', 'dropdown');
                                    $('.parent > a').append('<b class="caret"></b>');
                                    $('.parent > ul').addClass('dropdown-menu');
                              }
                              $('a#Login').click(function(){
                                    /**
                                    DESCOMENTAR LOGIN
                                    if ($("#login-form").css('display') == 'none') {
                                          $("#login-form").fadeIn('slow');
                                    }else{
                                          $("#login-form").fadeOut('slow');
                                    }*/
                              });
                              
                              /////////////////////// loading da imagem da view villa quando refreca //////////////////////    
                              ///////////////////////quando refreca //////////////////////     
                                          
                                var size = $(window).width();
                                if (size > 1300) {
	            	                size =  1300;
	                            }
	                                   
	                            var razao =( size * 64.73)/100;
                                if (size < 979) {
                                	razao =( size * 91.3)/100;
                                }
                                
                                var percentageWidth = ($(".photo_on").width() * 100) / razao;
                                var percentageMargin = 100 - percentageWidth;
                                var marginLeftImage = ((percentageMargin * razao)/100)/2; 
                                if($(".photo_on").width() >= $(window).width()){
	                                marginLeftImage = 0;
                                }  
                                $(".photo_on").css('margin-left', function(index) {
                                    return marginLeftImage;
                                });                                                   
                                
                                var marginTop = ($("#carousel-house-photos").height() - $(".photo_on").height())/2;
                                $(".photo_on").css('margin-top', function(index) {
                                     return marginTop;
                                });
                              /////////////////////// loading da imagem da view villa quando refreca //////////////////////    
                              ///////////////////////quando refreca //////////////////////    
                              
                              var topSearchAction = $("#top-search").find("form").attr("action");
                              var site = "<?php echo $this->baseurl; ?>";
                              $("#top-search").find("form").attr("action", site+"/"+topSearchAction);
                              
                              if($(location).attr('href').indexOf('villas') > -1 && $(location).attr('href').indexOf('view') > -1){
                              					var house_photos = Array();
                                                var current_photo = 0;
                              				                                         

                                                function changePhoto(direction) {
                                                      if (direction == null) {
                                                                direction = 1;
                                                      }
                                                      $(house_photos[current_photo]).removeClass('photo_on');
                                                      $(house_photos[current_photo]).addClass('photo_off');
                                                      current_photo = (current_photo + direction) % house_photos.length;                                 
                                                      if (current_photo < 0) {
                                                                current_photo = house_photos.length-1;
                                                      }
                                                      
                                                      /*centrar imagem na div */
                                                      var size = $(window).width();
                                                      var razao = 1300;
                                                      if (size > 1300) {
	                                                       size =  1300;
	                                                  }
	                                                  
                                                      var razao =( size * 64.73)/100;
                                                      if (size < 979) {
                                                      	razao =( size * 91.3)/100;
                                                      }
                                                     
                                                      var percentageWidth = ($(house_photos[current_photo]).width() * 100) / razao;
                                                      var percentageMargin = 100 - percentageWidth;
                                                      var marginLeftImage = ((percentageMargin * razao)/100)/2;  
                                                      if($(house_photos[current_photo]).width() >= $(window).width()){
	                                                      marginLeftImage = 0;
                                                      }                                                   
                                                      /*centrar imagem na div */
                                                      
                                                      $(house_photos[current_photo]).addClass('photo_on');
                                                      $(house_photos[current_photo]).css('margin-left', function(index) {
                                                       		return marginLeftImage;
                                					  });
                                                      $(house_photos[current_photo]).removeClass('photo_off');
                                                      
                                                      var marginTop = ($("#carousel-house-photos").height() - $(".photo_on").height())/2;
                                                      $(".photo_on").css('margin-top', function(index) {
                                                       		return marginTop;
                                					  });
                                                      
                                                }
                                                $(".photos-house-container>img").each(function(){
                                                      house_photos.push($(this));
                                                      /*centrar imagem na div */
                                                      var size = $(window).width();
                                                      if (size > 1300) {
	                                                       size =  1300;
	                                                  }
	                                                  var razao =( size * 64.73)/100;
                                                      if (size < 979) {
                                                      	razao =( size * 91.3)/100;
                                                      }
                                                      var percentageWidth = ($(house_photos[0]).width() * 100) / razao;
                                                      var percentageMargin = 100 - percentageWidth;
                                                      var marginLeftImage = ((percentageMargin * razao)/100)/2; 
                                                      if($(house_photos[current_photo]).width() >= $(window).width()){
	                                                      marginLeftImage = 0;
                                                      }  
                                                      $(".photo_on").css('margin-left', function(index) {
                                                       		return marginLeftImage;
                                					  });                                                   
                                                      /*centrar imagem na div */
                                                      
                                                      var marginTop = ($("#carousel-house-photos").height() - $(".photo_on").height())/2;
                                                      $(".photo_on").css('margin-top', function(index) {
                                                       		return marginTop;
                                					  });
                                                });
                                                setInterval(changePhoto, 10000);
                                    
                                                $("#detailHouse-next").children("a").click(function(){
                                                                changePhoto();
                                                });
                                                $("#detailHouse-previous").children("a").click(function(){
                                                                changePhoto(-1);
                                                });
                              }
                              var href = $(location).attr('href'); 
                              if (href.indexOf("villas")>-1 && href.indexOf("view")>-1) {
                                    $(".col-sm-9").css("width", "100%");
                                    var imageHeight = $("#carousel-house-photos").children('img')[0].getHeight();
                                    $("#house_photo_gallery").css('height', imageHeight+"px");
                              }
                              
                              if ($(window).width() < 979) {
                                	if(resizeClick == 0){
	                                	$("#searchIconsBar a:nth-child(1)").click();
	                                	resizeClick = 1;
	                                }
                                }
               

                        });
                        $("#searchResult").css('width', function(index) {
                                var size = $(window).width();
                                if (size > 1300) {
                                       size =  1300- 354;
                                }else if (size >= 1200) {
                                       size =  size - 354;
                                }else if (size >= 600) {
                                       size =  size - 288;
                                }else{
                                       size = size - 43;   
                                } 
                                return size;
                        });
                        $( window ).bind("resize", function(){
                                $("#searchResult").css('width', function(index) {
                                       var size = $(window).width();
                                       if (size > 1300) {
                                             size =  1300 -354;
                                       }else if (size >= 1200) {
                                             size =  size - 354;
                                       }else if (size >= 600) {
                                             size =  size - 288;
                                       }else{
                                             size = size - 43;   
                                       }
                                       return size;
                                });
                        });
                        
                        $(".inner-spotlight-image").css('width', function(index) {
                                var size = $(window).width();
                                if (size > 1300) {
                                    size =  1300;
                                }
                                size = size / 8.3;
                                return size;
                        });
                        $( window ).bind("resize", function(){
                                $(".inner-spotlight-image").css('width', function(index) {
                                       var size = $(window).width();
                                       if (size > 1300) {
                                            size =  1300;
                                       }
                                       size = size / 8.2;
                                       return size;
                                });
                        });
                        
                        $(".inner-spotlight-image img").css('width', function(index) {
                                var size = $(window).width();
                                if (size > 1300) {
                                    size =  1300;
                                }
                                size = size / 8.2;
                                return size;
                        });
                        $( window ).bind("resize", function(){
                                $(".inner-spotlight-image img").css('width', function(index) {
                                       var size = $(window).width();
                                       if (size > 1300) {
                                             size =  1300;
                                       }
                                       if (size >= 400) {
                                                size = size / 8.2;
                                       }
                                       return size;
                                });
                        });
                        
                        
                        $("#searchForm").css('margin-left', function(index) {
                                var size = $(window).width();
                                if (size > 1300) {
                                    size =  1300;
                                }
                                if (size >= 400) {
                                       size = size / 6;
                                }else {
                                       size = size / 6;         
                                }
                                return size;
                        });
                        $( window ).bind("resize", function(){
                                $("#searchForm").css('margin-left', function(index) {
                                       var size = $(window).width();
                                       if (size > 1300) {
                                            size =  1300;
                                       }
                                       if (size >= 400) {
                                                size = size / 6;
                                       }else{
                                             size = size / 6;   
                                       }
                                       return size;
                                });
                        });
                        
                        
                        $("#footer-column-4 #aca_22").hover(function() {
                                $(this).css('background-image', 'url("/allure/images/nextIcon2.png")');
                        },
                        function(){
                                $(this).css('background-image', 'url("/allure/images/nextIcon.png")');
                        });
                        
                        $( "#searchIconsBar a" ).click(function() {
                                $( "#searchIconsBar a" ).removeClass( "selectedIconBar" );
                                $( this).addClass( "selectedIconBar" );
                        });
                        
                        
                        $("#searchIconsBar a:nth-child(2)").addClass(function() {
                                var addedClass = '';
                                if ($(window).width() >= 979) {
                                      addedClass = 'selectedIconBar showButton';
                                      $( this).removeClass( "hideButton" );
                                }
                                return addedClass;
                        });
                        
                        $("#searchIconsBar a:nth-child(3)").addClass(function() {
                                var addedClass = '';
                                if ($(this).hasClass('selectedIconBar')) {
                                      $('#gallery_rem').hide();
                                      $('#gallery_blocks_rem').hide();
                                }
                                return addedClass;
                        });
                        $( window ).bind("resize", function(){
                        	$("#searchIconsBar a:nth-child(3)").addClass(function() {
                                var addedClass = '';
                                if ($(this).hasClass('selectedIconBar')) {
                                	$( "#gallery_rem").addClass( "hideButton" );
                                	$( "#gallery_blocks_rem").addClass( "hideButton" );                             
                                }
                                
                                return addedClass;
                            });
                        });
                        
                        $("#searchIconsBar a:nth-child(1)").addClass(function() {
                                var addedClass = '';
                                if ($(window).width() < 979) {
                                      addedClass = 'selectedIconBar';
                                      $( "#searchIconsBar a:nth-child(2)").addClass( "hideButton" );
                                      $( this).removeClass( "showButton" );                                    
                                         
                                      $('#gallery_rem').hide();
                                      $('#gallery_blocks_rem').show();    
                                }
                                
                                return addedClass;
                        });
                        $("#searchIconsBar a:nth-child(2)").click(function() {
                                if ($(this).hasClass('selectedIconBar')) {
                                    $('#gallery_rem').removeClass( "hideButton" )
                                	$('#gallery_rem').show();  
                                	$('#gallery_blocks_rem').addClass( "hideButton" );                     
                                }
                        });
                        $("#searchIconsBar a:nth-child(1)").click(function() {
                                if ($(this).hasClass('selectedIconBar')) {
                                	$('#gallery_blocks_rem').removeClass( "hideButton" );  
                                	$('#gallery_blocks_rem').show();
                                	$('#gallery_rem').addClass( "hideButton" );
                                	                             
                                }
                        });
                        
                        
                        var resizeClick = 0;
                        $( window ).bind("resize", function(){
                                $("#searchIconsBar a:nth-child(2)").addClass(function() {
                                                var addedClass = '';
                                                if ($(window).width() >= 979) {
                                                      addedClass = 'showButton';
                                                      $( this).removeClass( "hideButton" );
                                                      $('#gallery_rem').show();
                                                      $('#gallery_blocks_rem').show();
                                                }
                                                return addedClass;
                                });
                                $("#searchIconsBar a:nth-child(1)").addClass(function() {
                                                var addedClass = '';
                                                if ($(window).width() < 979) {
                                                      addedClass = 'selectedIconBar';
                                                      $( "#searchIconsBar a:nth-child(2)").addClass( "hideButton " );
                                                      $( "#searchIconsBar a:nth-child(2)").removeClass( "showButton" );
                                                      
                                                      $('#gallery_rem').hide();
                                                      $('#gallery_blocks_rem').show(); 
                                                      
                                                      
                                                }
                                                return addedClass;
                                });
                                
                                if ($(window).width() < 979) {
                                	if(resizeClick == 0){
	                                	$("#searchIconsBar a:nth-child(1)").click();
	                                	resizeClick = 1;
	                                }
                                }
                        });
                        
                        $('#searchIconsBar a').click(function() {
                                var index = $(this).index();
                                if (index == 2) {
                                      $( "#pagenavig").hide();
                                      $( "#pagenavig-top").hide();         
                                }else{
                                      $( "#pagenavig").show();
                                      $( "#pagenavig-top").show();          
                                }
                        });
                        
                        $("#back_opacity").click(function(){
                                $("#back_opacity").hide();
                                $("#hidden_review").hide();
                                $("#close_book_panel").hide();
                                $("#book_house_panel").hide();             
                        });
                        
                        $(".inner-spotlight-image").hover(function() {
                                $(this).children(".inner-spotlight-details").css('zIndex', 10000);
                        },
                        function(){
                                $(this).children(".inner-spotlight-details").css('zIndex', -10000);
                        });
                        
                       
                       
                        var nowTemp = new Date();
						var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
						var checkin = $('#search-arrival').datepicker({
							// formato data de entrada
							 // format: "dd/mm/yy",
						  onRender: function(date) {
						    return date.valueOf() < now.valueOf() ? 'disabled' : '';
						  }
						}).on('changeDate', function(ev) {
						  if (ev.date.valueOf() > checkout.date.valueOf()) {
						    var newDate = new Date(ev.date)
						    newDate.setDate(newDate.getDate() + 1);
						    checkout.setValue(newDate);
						  }
						  checkin.hide();
						  $('#dpd2')[0].focus();
						}).data('datepicker');
						var checkout = $('#search-departure').datepicker({
							// formato data de saida
						 // format: "dd/mm/yy",
						  onRender: function(date) {
						    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
						  }
						}).on('changeDate', function(ev) {
						  checkout.hide();
						}).data('datepicker');
                           
                         $('.dp').on('change', function () {
					        $('.datepicker').hide();
					     });  
					     
					     $("#search-arrival").click(function() {
					     	checkin.show();
					     });
					     
					     $("#search-departure").click(function() {
					     	checkout.show();
					     });  
					     
					  
					     
						var el = $("#ul-caroussel-allure li");
						el.watch({					  
						    properties: "display",
						    callback: function(data, i) {
						        var propChanged = data.props[i];
						        var newValue = data.vals[i];					
						        var el = this;
						        var el$ = $(this);
						        
						        $("ppc_spotlight_image_desc").hide();
						     
						    }
						});       
                        
                        
                        
                        $( "#wz_12" ).keydown(function( event ) {
                        	if ( event.which == 13 ) {
                            	event.preventDefault();
                            }
                        });
                        
                        
                        
                        
                  })(jQuery);
                  function openCloseMenu(){
                        var x = document.getElementById("menu-mobile");
                        if (x.style.display == "block"){
                              x.style.display= "none";
                              var obj = document.getElementById("menu-search");
                              obj.style.top = "265px";
                        }else{
                              x.style.display= "block";  
                              var obj = document.getElementById("menu-search");
                              obj.style.top = "604px";
                        }
                  }
                  
                 /* $( window ).bind("resize", function(){             	                     
		          		 if ($(window).width() >= 767 ) {
                      	  	$( "#showmenu1").addClass( "hideButton" );
                      	  	$( "#showmenu2").addClass( "hideButton" );	
                      	  	
                      	  	$('#search_villa #search-area-lightOrange').show();
                      	  	$('#search_villa #search-area-darkOrange .col_text_2').show();
                      	 }	
                      	 else{
	                      	$( "#showmenu1").removeClass( "hideButton" );
                      	  	$( "#showmenu2").removeClass( "hideButton" );	
                      	  	
                      	  	$('#search_villa #search-area-lightOrange').hide();
                      	  	$('#search_villa #search-area-darkOrange .col_text_2').hide();
                      	 }		      
                  });*/
                  
                 				 
				 if ($(window).width() < 767) {
				 	$( "#showmenu1").removeClass( "hideButton" );
                    $( "#showmenu2").removeClass( "hideButton" );	
                    
                    $('#search_villa #search-area-lightOrange').slideToggle("fast");
                    $('#search_villa #search-area-darkOrange .col_text_2').slideToggle("fast");
                    
				 	$(document).ready(function() {
						$('#searchvilla-searchbook').click(function() {
					            $('#search_villa #search-area-lightOrange').slideToggle("fast");
					            
					            $("#showmenu1").text(function(i, text){
						            return text === "[ - ]" ? "[ + ]" : "[ - ]";
						        });
					        });
					    });
					    
					    $(document).ready(function() {
					        $('.title-search-facilities').click(function() {
					            $('#search_villa #search-area-darkOrange .col_text_2').slideToggle("fast");
					            $("#showmenu2").text(function(i, text){
						            return text === "[ - ]" ? "[ + ]" : "[ - ]";
						        });
					        });
					    });
				 }else{
					 $( "#showmenu1").addClass( "hideButton" );
                     $( "#showmenu2").addClass( "hideButton" );
				 }
				 
				 
            </script>
            <!----------------------------------------------------------- SCRIPTS ----------------------------------------------------------->
            <!----------------------------------------------------------- SCRIPTS ----------------------------------------------------------->
            <!----------------------------------------------------------- SCRIPTS ----------------------------------------------------------->
            
            
            
            
      </body>
</html>