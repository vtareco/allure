<?php 
	/*------------------------------------------------------------------------
	# author    Gonzalo Suez
	# copyright Copyright � 2012 gsuez.cl. All rights reserved.
	# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
	# Website   http://www.gsuez.cl
	-------------------------------------------------------------------------*/
	
	defined( '_JEXEC' ) or die; 
	// variables
	$tpath = $this->baseurl.'/templates/'.$this->template;
?>
<!doctype html>
	<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
	<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
	<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
	<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->
	<head>
	  <!-- .$this->title; -->
	  <title><?php echo ' Allure Villas - 404' ?></title>	
	  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" /> <!-- mobile viewport optimized -->
	  <link rel="stylesheet" href="<?php echo $tpath; ?>/css/error.css?v=1.0.0" type="text/css" />
	  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/apple-touch-icon-57x57.png"> <!-- iphone, ipod, android -->
	  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/apple-touch-icon-72x72.png"> <!-- ipad -->
	  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/apple-touch-icon-114x114.png"> <!-- iphone retina -->
	  <link href="<?php echo $tpath; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" /> <!-- favicon -->
	  <script src="<?php echo $tpath; ?>/js/modernizr-2.6.2.js" type="text/javascript"></script>
	  
	  <style>
			.errorLabel {
				  color: #e55727 !important;
				  font-size: 24px;
				  font-weight: 400;
				  text-rendering: optimizelegibility;
				  font-family: "Lato",sans-serif;
				  padding-top: 25px;
				  top: -60px;
				  position: relative;
				}
		</style>
	  
	</head>
	<body>
	  <div align="center"> 
	    <div id="error">
	    	<br><br><br>
			
			<a href="<?php echo $this->baseurl; ?>/">
				<img style="width:400px; height:100px; " src="/allure/images/Allure_hor.jpg" alt="Logo">
			</a>
			
			<br><br><br><br>
	   	    
	   	    <p class="errorLabel">Page Not Found</p>
	        
	        <?php 
				// render module mod_search
		    	//    $module = new stdClass();
		    	//    $module->module = 'mod_search';
		    	//    echo JModuleHelper::renderModule($module);
		    ?>
		</div>
	  </div>
	</body>
</html>

