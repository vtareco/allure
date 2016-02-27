<?php
	/*------------------------------------------------------------------------
# author    Gonzalo Suez
# copyright Copyright � 2013 gsuez.cl. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.gsuez.cl
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

?>

<head>
	<?php
	
	/*
	 * Alteração em 12-04-2015
	 * @author CMS
	 * Personalização do titulo da página
	 */
	$app = JFactory::getApplication();
	$compoenent = $app->input->get('option');
	$task = $app->input->get('task');
	if(stripos($compoenent, 'realestatemanager'))
		switch($task){
			case 'search_villa':
				$this->setTitle( JText::_('REM_SEARCH_VILLA') );
				break;
			case 'for_sale':
				$this->setTitle( JText::_('REM_FOR_SALE') );
				break;
			case 'best_of':
				$this->setTitle( JText::_('REM_BEST_OF') );
				break;
			case 'view':
				$title = $this->getTitle();
				$vars = explode("|", $title);
				$this->setTitle( $vars[2] );
				break;
		}	
	?>
	<jdoc:include type="head" />
	
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<!-- Stylesheets -->
<link rel="apple-touch-icon-precomposed" href="<?php  echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php  echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php  echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php  echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
<link href="/allure/templates/masterbootstrap/css/font-awesome.css"/>
<link href='/allure/templates/masterbootstrap/css/googlefonts.css' rel='stylesheet' type='text/css'>
<link href='/allure/templates/masterbootstrap/css/style.css' rel='stylesheet' type='text/css'>
  <!--[if lte IE 8]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <?php  if ($pie==1) : ?>
      <style> 
        {behavior:url(<?php  echo $tpath; ?>/js/PIE.htc);}
      </style>
    <?php  endif; ?>
  <![endif]-->
    <script src="/allure/templates/masterbootstrap/js/jquery-1.10.2.min.js"> </script>
    <script src="/allure/templates/masterbootstrap/js/bootstrap-datepicker.js"> </script>
	<link href="/allure/templates/masterbootstrap/css/datepicker.css"/>

	<script src="/allure/templates/masterbootstrap/js/jspatch.js"> </script>
	<script src="http://malsup.github.io/jquery.cycle.all.js"></script>

	<script src="/allure/templates/masterbootstrap/js/jquery-watch.min.js"></script>
</head>