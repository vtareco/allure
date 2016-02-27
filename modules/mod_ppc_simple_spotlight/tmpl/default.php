<?php
/*
// Pixel Point Creative "Simple Spotlight" Module for Joomla!
// License: http://www.gnu.org/copyleft/gpl.html
// Copyright (c) Pixel Point Creative LLC.
// More info at http://www.pixelpointcreative.com
// Developer: Daniel Riefstahl
// ***Last update: 5/3/132***
*/
defined('_JEXEC') or die('Restricted access');
if (!defined('DS')) { 
define('DS', DIRECTORY_SEPARATOR); 
}

?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#sp<?php echo $module->id?> ul').cycle({
	fx:     '<?php echo $effect;?>',
	timeout: <?php echo $auto_play ? $timer_speed : 0;?>,
    	speed:  <?php echo $slideshow_speed;?>,
	next:   '#next<?php echo $module->id?>', 
    	prev:   '#prev<?php echo $module->id?>',
	pause:  <?php echo ($pause) ? 1 : 0;?>,
	width:  100,
        height: 100,
        fit: 1		
	});		
});
</script>
<div style="background:none;width:100%;margin:auto;" >  
<div class="slideshow <?php echo $params->get("moduleclass_sfx");?>" id="sp<?php echo $module->id?>" >
<ul id="ul-caroussel-allure" style="background:none;margin:0px;padding:0px;">
	<?php 

        $arr_img = array();

if ($params->get('show1')){
	if ($spotlightImage) $getlink = '';
                   if ($params->get('nolink')) {$getlink = '<div><img src="'.JURI::base().$spotlightImage.'" width="100%" height="" border="0" alt="'.$alt.'" title="'.$alt.'" /></div>';
                    } else {
                   $getlink = '<img src="'.JURI::base().$spotlightImage.'" width="100%" height="" border="0" alt="'.$alt.'" title="'.$alt.'" />';
                    }
		    if($description1 != null && $description1 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description1.'</div><div class="ppc_spotlight_image_title">'.$alt.'</div><a class="ppc_spotlight_image_link" target="'.$window.'" href="'.$link.'">'.$book.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink .'</li>';
		    
} 
if ($params->get('show2')){
        if ($spotlightImage2) $getlink2 = '';
                   if ($params->get('nolink2')) {$getlink2 = '<div><img src="'.JURI::base().$spotlightImage2.'" width="100%" height="" border="0" alt="'.$alt2.'" title="'.$alt2.'" /></div>';
                    } else {
                   $getlink2 = '<img src="'.JURI::base().$spotlightImage2.'" width="100%" height="" border="0" alt="'.$alt2.'" title="'.$alt2.'" />';
                    }
                    if($description2 != null && $description2 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description2.'</div><div class="ppc_spotlight_image_title">'.$alt2.'</div><a class="ppc_spotlight_image_link" target="'.$window2.'" href="'.$link2.'">'.$book2.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink2 .'</li>';
}
if ($params->get('show3')){
	        if ($spotlightImage3) $getlink3 = '';
                   if ($params->get('nolink3')) {$getlink3 = '<div><img src="'.JURI::base().$spotlightImage3.'" width="100%" height="" border="0" alt="'.$alt3.'" title="'.$alt3.'" /></div>';
                    } else {
                   $getlink3 = '<img src="'.JURI::base().$spotlightImage3.'" width="100%" height="" border="0" alt="'.$alt3.'" title="'.$alt3.'" />';
                    }
                    if($description3 != null && $description3 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description3.'</div><div class="ppc_spotlight_image_title">'.$alt3.'</div><a class="ppc_spotlight_image_link" target="'.$window3.'" href="'.$link3.'">'.$book3.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink3 .'</li>';
}	
if ($params->get('show4')){				
        if ($spotlightImage4) $getlink4 = '';
                   if ($params->get('nolink4')) {$getlink4 = '<div><img src="'.JURI::base().$spotlightImage4.'" width="100%" height="" border="0" alt="'.$alt4.'" title="'.$alt4.'" /></div>';
                    } else {
                   $getlink4 = '<img src="'.JURI::base().$spotlightImage4.'" width="100%" height="" border="0" alt="'.$alt4.'" title="'.$alt4.'" />';
                    }
                    if($description4 != null && $description4 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description4.'</div><div class="ppc_spotlight_image_title">'.$alt4.'</div><a class="ppc_spotlight_image_link" target="'.$window4.'" href="'.$link4.'">'.$book4.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink4 .'</li>';
}	
if ($params->get('show5')){	
        if ($spotlightImage5) $getlink5 = '';
                   if ($params->get('nolink5')) {$getlink5 = '<div><img src="'.JURI::base().$spotlightImage5.'" width="100%" height="" border="0" alt="'.$alt5.'" title="'.$alt5.'" /></div>';
                    } else {
                   $getlink5 = '<img src="'.JURI::base().$spotlightImage5.'" width="100%" height="" border="0" alt="'.$alt5.'" title="'.$alt5.'" />';
                    }
                    if($description5 != null && $description5 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description5.'</div><div class="ppc_spotlight_image_title">'.$alt5.'</div><a class="ppc_spotlight_image_link" target="'.$window5.'" href="'.$link5.'">'.$book5.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink5 .'</li>';
}	
if ($params->get('show6')){		

	//echo "AAAAAA".$spotlightImage101."<br><br><br><br><br>";;
	
        if ($spotlightImage6) $getlink6 = '';
                   if ($params->get('nolink6')) {$getlink6 = '<div><img src="'.JURI::base().$spotlightImage6.'" width="100%" height="" border="0" alt="'.$alt6.'" title="'.$alt6.'" /></div>';
                    } else {
                   $getlink6 = '<img src="'.JURI::base().$spotlightImage6.'" width="100%" height="" border="0" alt="'.$alt6.'" title="'.$alt6.'" />';
                    }
                    if($description6 != null && $description6 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description6.'</div><div class="ppc_spotlight_image_title">'.$alt6.'</div><a class="ppc_spotlight_image_link" target="'.$window6.'" href="'.$link6.'">'.$book6.'</a></div>';
                    else
			$desc = ''; 
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink6 .'</li>';
}	

if ($params->get('show7')){
	if (spotlightImage7) $getlink7 = '';
	if ($params->get('nolink7')) {$getlink7 = '<div><img src="'.JURI::base().spotlightImage7.'" width="100%" height="" border="0" alt="'.$alt7.'" title="'.$alt7.'" /></div>';
	} else {
		$getlink7 = '<img src="'.JURI::base().spotlightImage7.'" width="100%" height="" border="0" alt="'.$alt7.'" title="'.$alt7.'" />';
	}
	if($description7 != null && $description7 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description7.'</div><div class="ppc_spotlight_image_title">'.$alt7.'</div><a class="ppc_spotlight_image_link" target="'.$window7.'" href="'.$link7.'">'.$book7.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink7 .'</li>';
}

if ($params->get('show8')){
	if ($spotlightImage8) $getlink8 = '';
	if ($params->get('nolink8')) {$getlink8 = '<div><img src="'.JURI::base().$spotlightImage8.'" width="100%" height="" border="0" alt="'.$alt8.'" title="'.$alt8.'" /></div>';
	} else {
		$getlink8 = '<img src="'.JURI::base().$spotlightImage8.'" width="100%" height="" border="0" alt="'.$alt8.'" title="'.$alt8.'" />';
	}
	if($description8 != null && $description8 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description8.'</div><div class="ppc_spotlight_image_title">'.$alt8.'</div><a class="ppc_spotlight_image_link" target="'.$window8.'" href="'.$link8.'">'.$book8.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink8 .'</li>';
}

if ($params->get('show9')){
	if ($spotlightImage9) $getlink9 = '';
	if ($params->get('nolink9')) {$getlink9 = '<div><img src="'.JURI::base().$spotlightImage9.'" width="100%" height="" border="0" alt="'.$alt9.'" title="'.$alt9.'" /></div>';
	} else {
		$getlink9 = '<img src="'.JURI::base().$spotlightImage9.'" width="100%" height="" border="0" alt="'.$alt9.'" title="'.$alt9.'" />';
	}
	if($description9 != null && $description9 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description9.'</div><div class="ppc_spotlight_image_title">'.$alt9.'</div><a class="ppc_spotlight_image_link" target="'.$window9.'" href="'.$link9.'">'.$book9.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink9 .'</li>';
}
 

if ($params->get('show10')){		
        if ($spotlightImage10) $getlink10 = '';
                   if ($params->get('nolink10')) {$getlink10 = '<div><img src="'.JURI::base().$spotlightImage10.'" width="100%" height="" border="0" alt="'.$alt10.'" title="'.$alt10.'" /></div>';
                    } else {
                   $getlink10 = '<img src="'.JURI::base().$spotlightImage10.'" width="100%" height="" border="0" alt="'.$alt10.'" title="'.$alt10.'" />';
                    }
                    if($description10 != null && $description10 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description10.'</div><div class="ppc_spotlight_image_title">'.$alt10.'</div><a class="ppc_spotlight_image_link" target="'.$window10.'" href="'.$link10.'">'.$book10.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink10 .'</li>';
}
if ($params->get('show11')){		
        if ($spotlightImage11) $getlink11 = '';
                   if ($params->get('nolink11')) {$getlink11 = '<div><img src="'.JURI::base().$spotlightImage11.'" width="100%" height="" border="0" alt="'.$alt11.'" title="'.$alt11.'" /></div>';
                    } else {
                   $getlink11 = '<img src="'.JURI::base().$spotlightImage11.'" width="100%" height="" border="0" alt="'.$alt11.'" title="'.$alt11.'" />';
                    }
                    if($description11 != null && $description11 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description11.'</div><div class="ppc_spotlight_image_title">'.$alt11.'</div><a class="ppc_spotlight_image_link" target="'.$window11.'" href="'.$link11.'">'.$book11.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink11 .'</li>';
}
if ($params->get('show12')){		
        if ($spotlightImage12) $getlink12 = '';
                   if ($params->get('nolink12')) {$getlink12 = '<div><img src="'.JURI::base().$spotlightImage12.'" width="100%" height="" border="0" alt="'.$alt12.'" title="'.$alt12.'" /></div>';
                    } else {
                   $getlink12 = '<img src="'.JURI::base().$spotlightImage12.'" width="100%" height="" border="0" alt="'.$alt12.'" title="'.$alt12.'" />';
                    }
                    if($description12 != null && $description12 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description12.'</div><div class="ppc_spotlight_image_title">'.$alt12.'</div><a class="ppc_spotlight_image_link" target="'.$window12.'" href="'.$link12.'">'.$book12.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink12 .'</li>';
}	
if ($params->get('show13')){		
        if ($spotlightImage13) $getlink13 = '';
                   if ($params->get('nolink13')) {$getlink13 = '<div><img src="'.JURI::base().$spotlightImage13.'" width="100%" height="" border="0" alt="'.$alt13.'" title="'.$alt13.'" /></div>';
                    } else {
                   $getlink13 = '<img src="'.JURI::base().$spotlightImage13.'" width="100%" height="" border="0" alt="'.$alt13.'" title="'.$alt13.'" />';
                    }
                    if($description13 != null && $description13 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description13.'</div><div class="ppc_spotlight_image_title">'.$alt13.'</div><a class="ppc_spotlight_image_link" target="'.$window13.'" href="'.$link13.'">'.$book13.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink13 .'</li>';
}	
if ($params->get('show14')){		
        if ($spotlightImage14) $getlink14 = '';
                   if ($params->get('nolink14')) {$getlink14 = '<div><img src="'.JURI::base().$spotlightImage14.'" width="100%" height="" border="0" alt="'.$alt14.'" title="'.$alt14.'" /></div>';
                    } else {
                   $getlink14 = '<img src="'.JURI::base().$spotlightImage14.'" width="100%" height="" border="0" alt="'.$alt14.'" title="'.$alt14.'" />';
                    }
                    if($description14 != null && $description14 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description14.'</div><div class="ppc_spotlight_image_title">'.$alt14.'</div><a class="ppc_spotlight_image_link" target="'.$window14.'" href="'.$link14.'">'.$book14.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink14 .'</li>';
}
if ($params->get('show15')){		
        if ($spotlightImage15) $getlink15 = '';
                   if ($params->get('nolink15')) {$getlink15 = '<div><img src="'.JURI::base().$spotlightImage15.'" width="100%" height="" border="0" alt="'.$alt15.'" title="'.$alt15.'" /></div>';
                    } else {
                   $getlink15 = '<img src="'.JURI::base().$spotlightImage15.'" width="100%" height="" border="0" alt="'.$alt15.'" title="'.$alt15.'" />';
                    }
                    if($description15 != null && $description15 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description15.'</div><div class="ppc_spotlight_image_title">'.$alt15.'</div><a class="ppc_spotlight_image_link" target="'.$window15.'" href="'.$link15.'">'.$book15.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink15 .'</li>';
}	
if ($params->get('show16')){		
        if ($spotlightImage16) $getlink16 = '';
                   if ($params->get('nolink16')) {$getlink16 = '<div><img src="'.JURI::base().$spotlightImage16.'" width="100%" height="" border="0" alt="'.$alt16.'" title="'.$alt16.'" /></div>';
                    } else {
                   $getlink16 = '<img src="'.JURI::base().$spotlightImage16.'" width="100%" height="" border="0" alt="'.$alt16.'" title="'.$alt16.'" />';
                    }
                    if($description16 != null && $description16 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description16.'</div><div class="ppc_spotlight_image_title">'.$alt16.'</div><a class="ppc_spotlight_image_link" target="'.$window16.'" href="'.$link16.'">'.$book16.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink16 .'</li>';
}
if ($params->get('show17')){		
        if ($spotlightImage17) $getlink17 = '';
                   if ($params->get('nolink17')) {$getlink17 = '<div><img src="'.JURI::base().$spotlightImage17.'" width="100%" height="" border="0" alt="'.$alt17.'" title="'.$alt17.'" /></div>';
                    } else {
                   $getlink17 = '<img src="'.JURI::base().$spotlightImage17.'" width="100%" height="" border="0" alt="'.$alt17.'" title="'.$alt17.'" />';
                    }
                    if($description17 != null && $description17 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description17.'</div><div class="ppc_spotlight_image_title">'.$alt17.'</div><a class="ppc_spotlight_image_link" target="'.$window17.'" href="'.$link17.'">'.$book17.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink17 .'</li>';
}	
if ($params->get('show18')){		
        if ($spotlightImage18) $getlink18 = '';
                   if ($params->get('nolink18')) {$getlink18 = '<div><img src="'.JURI::base().$spotlightImage18.'" width="100%" height="" border="0" alt="'.$alt18.'" title="'.$alt18.'" /></div>';
                    } else {
                   $getlink18 = '<img src="'.JURI::base().$spotlightImage18.'" width="100%" height="" border="0" alt="'.$alt18.'" title="'.$alt18.'" />';
                    }
                    if($description18 != null && $description18 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description18.'</div><div class="ppc_spotlight_image_title">'.$alt18.'</div><a class="ppc_spotlight_image_link" target="'.$window18.'" href="'.$link18.'">'.$book18.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink18 .'</li>';
}
if ($params->get('show19')){		
        if ($spotlightImage19) $getlink19 = '';
                   if ($params->get('nolink19')) {$getlink19 = '<div><img src="'.JURI::base().$spotlightImage19.'" width="100%" height="" border="0" alt="'.$alt19.'" title="'.$alt19.'" /></div>';
                    } else {
                   $getlink19 = '<img src="'.JURI::base().$spotlightImage19.'" width="100%" height="" border="0" alt="'.$alt19.'" title="'.$alt19.'" />';
                    }
                    if($description19 != null && $description19 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description19.'</div><div class="ppc_spotlight_image_title">'.$alt19.'</div><a class="ppc_spotlight_image_link" target="'.$window19.'" href="'.$link19.'">'.$book19.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink19 .'</li>';
}
if ($params->get('show20')){		
        if ($spotlightImage20) $getlink20 = '';
                   if ($params->get('nolink20')) {$getlink20 = '<div><img src="'.JURI::base().$spotlightImage20.'" width="100%" height="" border="0" alt="'.$alt20.'" title="'.$alt20.'" /></div>';
                    } else {
                   $getlink20 = '<img src="'.JURI::base().$spotlightImage20.'" width="100%" height="" border="0" alt="'.$alt20.'" title="'.$alt20.'" />';
                    }
                    if($description20 != null && $description20 != "")
			$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description20.'</div><div class="ppc_spotlight_image_title">'.$alt20.'</div><a class="ppc_spotlight_image_link" target="'.$window20.'" href="'.$link20.'"> '.$book20.'</a></div>';
                    else
			$desc = '';
		    $arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink20 .'</li>';
}	
if ($params->get('show21')){
	if ($spotlightImage21) $getlink21 = '';
	if ($params->get('nolink21')) {$getlink21 = '<div><img src="'.JURI::base().$spotlightImage21.'" width="100%" height="" border="0" alt="'.$alt21.'" title="'.$alt21.'" /></div>';
	} else {
		$getlink21 = '<img src="'.JURI::base().$spotlightImage21.'" width="100%" height="" border="0" alt="'.$alt21.'" title="'.$alt21.'" />';
	}
	if($description21 != null && $description21 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description21.'</div><div class="ppc_spotlight_image_title">'.$alt21.'</div><a class="ppc_spotlight_image_link" target="'.$window21.'" href="'.$link21.'"> '.$book21.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink21 .'</li>';
}
if ($params->get('show22')){
	if ($spotlightImage22) $getlink22 = '';
	if ($params->get('nolink22')) {$getlink22 = '<div><img src="'.JURI::base().$spotlightImage22.'" width="200%" height="" border="0" alt="'.$alt22.'" title="'.$alt22.'" /></div>';
	} else {
		$getlink22 = '<img src="'.JURI::base().$spotlightImage22.'" width="200%" height="" border="0" alt="'.$alt22.'" title="'.$alt22.'" />';
	}
	if($description22 != null && $description22 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description22.'</div><div class="ppc_spotlight_image_title">'.$alt22.'</div><a class="ppc_spotlight_image_link" target="'.$window22.'" href="'.$link22.'">'.$book22.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink22 .'</li>';
}
if ($params->get('show23')){
	if ($spotlightImage23) $getlink23 = '';
	if ($params->get('nolink23')) {$getlink23 = '<div><img src="'.JURI::base().$spotlightImage23.'" width="200%" height="" border="0" alt="'.$alt23.'" title="'.$alt23.'" /></div>';
	} else {
		$getlink23 = '<img src="'.JURI::base().$spotlightImage23.'" width="200%" height="" border="0" alt="'.$alt23.'" title="'.$alt23.'" />';
	}
	if($description23 != null && $description23 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description23.'</div><div class="ppc_spotlight_image_title">'.$alt23.'</div><a class="ppc_spotlight_image_link" target="'.$window23.'" href="'.$link23.'">'.$book23.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink23 .'</li>';
}
if ($params->get('show24')){
	if ($spotlightImage24) $getlink24 = '';
	if ($params->get('nolink24')) {$getlink24 = '<div><img src="'.JURI::base().$spotlightImage24.'" width="200%" height="" border="0" alt="'.$alt24.'" title="'.$alt24.'" /></div>';
	} else {
		$getlink24 = '<img src="'.JURI::base().$spotlightImage24.'" width="200%" height="" border="0" alt="'.$alt24.'" title="'.$alt24.'" />';
	}
	if($description24 != null && $description24 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description24.'</div><div class="ppc_spotlight_image_title">'.$alt24.'</div><a class="ppc_spotlight_image_link" target="'.$window24.'" href="'.$link24.'">'.$book24.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink24 .'</li>';
}
if ($params->get('show25')){
	if ($spotlightImage25) $getlink25 = '';
	if ($params->get('nolink25')) {$getlink25 = '<div><img src="'.JURI::base().$spotlightImage25.'" width="200%" height="" border="0" alt="'.$alt25.'" title="'.$alt25.'" /></div>';
	} else {
		$getlink25 = '<img src="'.JURI::base().$spotlightImage25.'" width="200%" height="" border="0" alt="'.$alt25.'" title="'.$alt25.'" />';
	}
	if($description25 != null && $description25 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description25.'</div><div class="ppc_spotlight_image_title">'.$alt25.'</div><a class="ppc_spotlight_image_link" target="'.$window25.'" href="'.$link25.'">'.$book25.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink25 .'</li>';
}
if ($params->get('show26')){
	if ($spotlightImage26) $getlink26 = '';
	if ($params->get('nolink26')) {$getlink26 = '<div><img src="'.JURI::base().$spotlightImage26.'" width="200%" height="" border="0" alt="'.$alt26.'" title="'.$alt26.'" /></div>';
	} else {
		$getlink26 = '<img src="'.JURI::base().$spotlightImage26.'" width="200%" height="" border="0" alt="'.$alt26.'" title="'.$alt26.'" />';
	}
	if($description26 != null && $description26 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description26.'</div><div class="ppc_spotlight_image_title">'.$alt26.'</div><a class="ppc_spotlight_image_link" target="'.$window26.'" href="'.$link26.'">'.$book26.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink26 .'</li>';
}
if ($params->get('show27')){
	if ($spotlightImage27) $getlink27 = '';
	if ($params->get('nolink27')) {$getlink27 = '<div><img src="'.JURI::base().$spotlightImage27.'" width="200%" height="" border="0" alt="'.$alt27.'" title="'.$alt27.'" /></div>';
	} else {
		$getlink27 = '<img src="'.JURI::base().$spotlightImage27.'" width="200%" height="" border="0" alt="'.$alt27.'" title="'.$alt27.'" />';
	}
	if($description27 != null && $description27 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description27.'</div><div class="ppc_spotlight_image_title">'.$alt27.'</div><a class="ppc_spotlight_image_link" target="'.$window27.'" href="'.$link27.'">'.$book27.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink27 .'</li>';
}
if ($params->get('show28')){
	if ($spotlightImage28) $getlink28 = '';
	if ($params->get('nolink28')) {$getlink28 = '<div><img src="'.JURI::base().$spotlightImage28.'" width="200%" height="" border="0" alt="'.$alt28.'" title="'.$alt28.'" /></div>';
	} else {
		$getlink28 = '<img src="'.JURI::base().$spotlightImage28.'" width="200%" height="" border="0" alt="'.$alt28.'" title="'.$alt28.'" />';
	}
	if($description28 != null && $description28 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description28.'</div><div class="ppc_spotlight_image_title">'.$alt28.'</div><a class="ppc_spotlight_image_link" target="'.$window28.'" href="'.$link28.'">'.$book28.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink28 .'</li>';
}
if ($params->get('show29')){
	if ($spotlightImage29) $getlink29 = '';
	if ($params->get('nolink29')) {$getlink29 = '<div><img src="'.JURI::base().$spotlightImage29.'" width="200%" height="" border="0" alt="'.$alt29.'" title="'.$alt29.'" /></div>';
	} else {
		$getlink29 = '<img src="'.JURI::base().$spotlightImage29.'" width="200%" height="" border="0" alt="'.$alt29.'" title="'.$alt29.'" />';
	}
	if($description29 != null && $description29 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description29.'</div><div class="ppc_spotlight_image_title">'.$alt29.'</div><a class="ppc_spotlight_image_link" target="'.$window29.'" href="'.$link29.'">'.$book29.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink29 .'</li>';
}
if ($params->get('show30')){
	if ($spotlightImage30) $getlink30 = '';
	if ($params->get('nolink30')) {$getlink30 = '<div><img src="'.JURI::base().$spotlightImage30.'" width="300%" height="" border="0" alt="'.$alt30.'" title="'.$alt30.'" /></div>';
	} else {
		$getlink30 = '<img src="'.JURI::base().$spotlightImage30.'" width="300%" height="" border="0" alt="'.$alt30.'" title="'.$alt30.'" />';
	}
	if($description30 != null && $description30 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description30.'</div><div class="ppc_spotlight_image_title">'.$alt30.'</div><a class="ppc_spotlight_image_link" target="'.$window30.'" href="'.$link30.'"> '.$book30.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink30 .'</li>';
}
if ($params->get('show31')){
	if ($spotlightImage31) $getlink31 = '';
	if ($params->get('nolink31')) {$getlink31 = '<div><img src="'.JURI::base().$spotlightImage31.'" width="100%" height="" border="0" alt="'.$alt31.'" title="'.$alt31.'" /></div>';
	} else {
		$getlink31 = '<img src="'.JURI::base().$spotlightImage31.'" width="100%" height="" border="0" alt="'.$alt31.'" title="'.$alt31.'" />';
	}
	if($description31 != null && $description31 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description31.'</div><div class="ppc_spotlight_image_title">'.$alt31.'</div><a class="ppc_spotlight_image_link" target="'.$window31.'" href="'.$link31.'"> '.$book31.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink31 .'</li>';
}
if ($params->get('show32')){
	if ($spotlightImage32) $getlink32 = '';
	if ($params->get('nolink32')) {$getlink32 = '<div><img src="'.JURI::base().$spotlightImage32.'" width="100%" height="" border="0" alt="'.$alt32.'" title="'.$alt32.'" /></div>';
	} else {
		$getlink32 = '<img src="'.JURI::base().$spotlightImage32.'" width="100%" height="" border="0" alt="'.$alt32.'" title="'.$alt32.'" />';
	}
	if($description32 != null && $description32 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description32.'</div><div class="ppc_spotlight_image_title">'.$alt32.'</div><a class="ppc_spotlight_image_link" target="'.$window32.'" href="'.$link32.'"> '.$book32.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink32 .'</li>';
}

if ($params->get('show33')){
	if ($spotlightImage33) $getlink33 = '';
	if ($params->get('nolink33')) {$getlink33 = '<div><img src="'.JURI::base().$spotlightImage33.'" width="300%" height="" border="0" alt="'.$alt33.'" title="'.$alt33.'" /></div>';
	} else {
		$getlink33 = '<img src="'.JURI::base().$spotlightImage33.'" width="300%" height="" border="0" alt="'.$alt33.'" title="'.$alt33.'" />';
	}
	if($description33 != null && $description33 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description33.'</div><div class="ppc_spotlight_image_title">'.$alt33.'</div><a class="ppc_spotlight_image_link" target="'.$window33.'" href="'.$link33.'">'.$book33.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink33 .'</li>';
}
if ($params->get('show34')){
	if ($spotlightImage34) $getlink34 = '';
	if ($params->get('nolink34')) {$getlink34 = '<div><img src="'.JURI::base().$spotlightImage34.'" width="300%" height="" border="0" alt="'.$alt34.'" title="'.$alt34.'" /></div>';
	} else {
		$getlink34 = '<img src="'.JURI::base().$spotlightImage34.'" width="300%" height="" border="0" alt="'.$alt34.'" title="'.$alt34.'" />';
	}
	if($description34 != null && $description34 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description34.'</div><div class="ppc_spotlight_image_title">'.$alt34.'</div><a class="ppc_spotlight_image_link" target="'.$window34.'" href="'.$link34.'">'.$book34.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink34 .'</li>';
}
if ($params->get('show35')){
	if ($spotlightImage35) $getlink35 = '';
	if ($params->get('nolink35')) {$getlink35 = '<div><img src="'.JURI::base().$spotlightImage35.'" width="300%" height="" border="0" alt="'.$alt35.'" title="'.$alt35.'" /></div>';
	} else {
		$getlink35 = '<img src="'.JURI::base().$spotlightImage35.'" width="300%" height="" border="0" alt="'.$alt35.'" title="'.$alt35.'" />';
	}
	if($description35 != null && $description35 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description35.'</div><div class="ppc_spotlight_image_title">'.$alt35.'</div><a class="ppc_spotlight_image_link" target="'.$window35.'" href="'.$link35.'">'.$book35.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink35 .'</li>';
}
if ($params->get('show36')){
	if ($spotlightImage36) $getlink36 = '';
	if ($params->get('nolink36')) {$getlink36 = '<div><img src="'.JURI::base().$spotlightImage36.'" width="300%" height="" border="0" alt="'.$alt36.'" title="'.$alt36.'" /></div>';
	} else {
		$getlink36 = '<img src="'.JURI::base().$spotlightImage36.'" width="300%" height="" border="0" alt="'.$alt36.'" title="'.$alt36.'" />';
	}
	if($description36 != null && $description36 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description36.'</div><div class="ppc_spotlight_image_title">'.$alt36.'</div><a class="ppc_spotlight_image_link" target="'.$window36.'" href="'.$link36.'">'.$book36.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink36 .'</li>';
}
if ($params->get('show37')){
	if ($spotlightImage37) $getlink37 = '';
	if ($params->get('nolink37')) {$getlink37 = '<div><img src="'.JURI::base().$spotlightImage37.'" width="300%" height="" border="0" alt="'.$alt37.'" title="'.$alt37.'" /></div>';
	} else {
		$getlink37 = '<img src="'.JURI::base().$spotlightImage37.'" width="300%" height="" border="0" alt="'.$alt37.'" title="'.$alt37.'" />';
	}
	if($description37 != null && $description37 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description37.'</div><div class="ppc_spotlight_image_title">'.$alt37.'</div><a class="ppc_spotlight_image_link" target="'.$window37.'" href="'.$link37.'">'.$book37.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink37 .'</li>';
}
if ($params->get('show38')){
	if ($spotlightImage38) $getlink38 = '';
	if ($params->get('nolink38')) {$getlink38 = '<div><img src="'.JURI::base().$spotlightImage38.'" width="300%" height="" border="0" alt="'.$alt38.'" title="'.$alt38.'" /></div>';
	} else {
		$getlink38 = '<img src="'.JURI::base().$spotlightImage38.'" width="300%" height="" border="0" alt="'.$alt38.'" title="'.$alt38.'" />';
	}
	if($description38 != null && $description38 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description38.'</div><div class="ppc_spotlight_image_title">'.$alt38.'</div><a class="ppc_spotlight_image_link" target="'.$window38.'" href="'.$link38.'">'.$book38.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink38 .'</li>';
}
if ($params->get('show39')){
	if ($spotlightImage39) $getlink39 = '';
	if ($params->get('nolink39')) {$getlink39 = '<div><img src="'.JURI::base().$spotlightImage39.'" width="300%" height="" border="0" alt="'.$alt39.'" title="'.$alt39.'" /></div>';
	} else {
		$getlink39 = '<img src="'.JURI::base().$spotlightImage39.'" width="300%" height="" border="0" alt="'.$alt39.'" title="'.$alt39.'" />';
	}
	if($description39 != null && $description39 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description39.'</div><div class="ppc_spotlight_image_title">'.$alt39.'</div><a class="ppc_spotlight_image_link" target="'.$window39.'" href="'.$link39.'">'.$book39.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink39 .'</li>';
} 

if ($params->get('show40')){
	if ($spotlightImage40) $getlink40 = '';
	if ($params->get('nolink40')) {$getlink40 = '<div><img src="'.JURI::base().$spotlightImage40.'" width="400%" height="" border="0" alt="'.$alt40.'" title="'.$alt40.'" /></div>';
	} else {
		$getlink40 = '<img src="'.JURI::base().$spotlightImage40.'" width="400%" height="" border="0" alt="'.$alt40.'" title="'.$alt40.'" />';
	}
	if($description40 != null && $description40 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description40.'</div><div class="ppc_spotlight_image_title">'.$alt40.'</div><a class="ppc_spotlight_image_link" target="'.$window40.'" href="'.$link40.'">'.$book40.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink40 .'</li>';
}
if ($params->get('show41')){
	if ($spotlightImage41) $getlink41 = '';
	if ($params->get('nolink41')) {$getlink41 = '<div><img src="'.JURI::base().$spotlightImage41.'" width="100%" height="" border="0" alt="'.$alt41.'" title="'.$alt41.'" /></div>';
	} else {
		$getlink41 = '<img src="'.JURI::base().$spotlightImage41.'" width="100%" height="" border="0" alt="'.$alt41.'" title="'.$alt41.'" />';
	}
	if($description41 != null && $description41 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description41.'</div><div class="ppc_spotlight_image_title">'.$alt41.'</div><a class="ppc_spotlight_image_link" target="'.$window41.'" href="'.$link41.'"> '.$book41.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink41 .'</li>';
}
if ($params->get('show42')){
	if ($spotlightImage42) $getlink42 = '';
	if ($params->get('nolink42')) {$getlink42 = '<div><img src="'.JURI::base().$spotlightImage42.'" width="100%" height="" border="0" alt="'.$alt42.'" title="'.$alt42.'" /></div>';
	} else {
		$getlink42 = '<img src="'.JURI::base().$spotlightImage42.'" width="100%" height="" border="0" alt="'.$alt42.'" title="'.$alt42.'" />';
	}
	if($description42 != null && $description42 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description42.'</div><div class="ppc_spotlight_image_title">'.$alt42.'</div><a class="ppc_spotlight_image_link" target="'.$window42.'" href="'.$link42.'"> '.$book42.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink42 .'</li>';
}

if ($params->get('show43')){
	if ($spotlightImage43) $getlink43 = '';
	if ($params->get('nolink43')) {$getlink43 = '<div><img src="'.JURI::base().$spotlightImage43.'" width="430%" height="" border="0" alt="'.$alt43.'" title="'.$alt43.'" /></div>';
	} else {
		$getlink43 = '<img src="'.JURI::base().$spotlightImage43.'" width="430%" height="" border="0" alt="'.$alt43.'" title="'.$alt43.'" />';
	}
	if($description43 != null && $description43 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description43.'</div><div class="ppc_spotlight_image_title">'.$alt43.'</div><a class="ppc_spotlight_image_link" target="'.$window43.'" href="'.$link43.'">'.$book43.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink43 .'</li>';
}

if ($params->get('show44')){
	if ($spotlightImage44) $getlink44 = '';
	if ($params->get('nolink44')) {$getlink44 = '<div><img src="'.JURI::base().$spotlightImage44.'" width="400%" height="" border="0" alt="'.$alt44.'" title="'.$alt44.'" /></div>';
	} else {
		$getlink44 = '<img src="'.JURI::base().$spotlightImage44.'" width="400%" height="" border="0" alt="'.$alt44.'" title="'.$alt44.'" />';
	}
	if($description44 != null && $description44 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description44.'</div><div class="ppc_spotlight_image_title">'.$alt44.'</div><a class="ppc_spotlight_image_link" target="'.$window44.'" href="'.$link44.'">'.$book44.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink44 .'</li>';
}
if ($params->get('show45')){
	if ($spotlightImage45) $getlink45 = '';
	if ($params->get('nolink45')) {$getlink45 = '<div><img src="'.JURI::base().$spotlightImage45.'" width="400%" height="" border="0" alt="'.$alt45.'" title="'.$alt45.'" /></div>';
	} else {
		$getlink45 = '<img src="'.JURI::base().$spotlightImage45.'" width="400%" height="" border="0" alt="'.$alt45.'" title="'.$alt45.'" />';
	}
	if($description45 != null && $description45 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description45.'</div><div class="ppc_spotlight_image_title">'.$alt45.'</div><a class="ppc_spotlight_image_link" target="'.$window45.'" href="'.$link45.'">'.$book45.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink45 .'</li>';
}
if ($params->get('show46')){
	if ($spotlightImage46) $getlink46 = '';
	if ($params->get('nolink46')) {$getlink46 = '<div><img src="'.JURI::base().$spotlightImage46.'" width="400%" height="" border="0" alt="'.$alt46.'" title="'.$alt46.'" /></div>';
	} else {
		$getlink46 = '<img src="'.JURI::base().$spotlightImage46.'" width="400%" height="" border="0" alt="'.$alt46.'" title="'.$alt46.'" />';
	}
	if($description46 != null && $description46 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description46.'</div><div class="ppc_spotlight_image_title">'.$alt46.'</div><a class="ppc_spotlight_image_link" target="'.$window46.'" href="'.$link46.'">'.$book46.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink46 .'</li>';
}
if ($params->get('show47')){
	if ($spotlightImage47) $getlink47 = '';
	if ($params->get('nolink47')) {$getlink47 = '<div><img src="'.JURI::base().$spotlightImage47.'" width="400%" height="" border="0" alt="'.$alt47.'" title="'.$alt47.'" /></div>';
	} else {
		$getlink47 = '<img src="'.JURI::base().$spotlightImage47.'" width="400%" height="" border="0" alt="'.$alt47.'" title="'.$alt47.'" />';
	}
	if($description47 != null && $description47 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description47.'</div><div class="ppc_spotlight_image_title">'.$alt47.'</div><a class="ppc_spotlight_image_link" target="'.$window47.'" href="'.$link47.'">'.$book47.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink47 .'</li>';
}
if ($params->get('show48')){
	if ($spotlightImage48) $getlink48 = '';
	if ($params->get('nolink48')) {$getlink48 = '<div><img src="'.JURI::base().$spotlightImage48.'" width="400%" height="" border="0" alt="'.$alt48.'" title="'.$alt48.'" /></div>';
	} else {
		$getlink48 = '<img src="'.JURI::base().$spotlightImage48.'" width="400%" height="" border="0" alt="'.$alt48.'" title="'.$alt48.'" />';
	}
	if($description48 != null && $description48 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description48.'</div><div class="ppc_spotlight_image_title">'.$alt48.'</div><a class="ppc_spotlight_image_link" target="'.$window48.'" href="'.$link48.'">'.$book48.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink48 .'</li>';
}
if ($params->get('show49')){
	if ($spotlightImage49) $getlink49 = '';
	if ($params->get('nolink49')) {$getlink49 = '<div><img src="'.JURI::base().$spotlightImage49.'" width="400%" height="" border="0" alt="'.$alt49.'" title="'.$alt49.'" /></div>';
	} else {
		$getlink49 = '<img src="'.JURI::base().$spotlightImage49.'" width="400%" height="" border="0" alt="'.$alt49.'" title="'.$alt49.'" />';
	}
	if($description49 != null && $description49 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description49.'</div><div class="ppc_spotlight_image_title">'.$alt49.'</div><a class="ppc_spotlight_image_link" target="'.$window49.'" href="'.$link49.'">'.$book49.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink49 .'</li>';
} 

if ($params->get('show50')){
	if ($spotlightImage50) $getlink50 = '';
	if ($params->get('nolink50')) {$getlink50 = '<div><img src="'.JURI::base().$spotlightImage50.'" width="500%" height="" border="0" alt="'.$alt50.'" title="'.$alt50.'" /></div>';
	} else {
		$getlink50 = '<img src="'.JURI::base().$spotlightImage50.'" width="500%" height="" border="0" alt="'.$alt50.'" title="'.$alt50.'" />';
	}
	if($description50 != null && $description50 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description50.'</div><div class="ppc_spotlight_image_title">'.$alt50.'</div><a class="ppc_spotlight_image_link" target="'.$window50.'" href="'.$link50.'">'.$book50.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink50 .'</li>';
}

if ($params->get('show51')){
	if ($spotlightImage51) $getlink51 = '';
	if ($params->get('nolink51')) {$getlink51 = '<div><img src="'.JURI::base().$spotlightImage51.'" width="100%" height="" border="0" alt="'.$alt51.'" title="'.$alt51.'" /></div>';
	} else {
		$getlink51 = '<img src="'.JURI::base().$spotlightImage51.'" width="100%" height="" border="0" alt="'.$alt51.'" title="'.$alt51.'" />';
	}
	if($description51 != null && $description51 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description51.'</div><div class="ppc_spotlight_image_title">'.$alt51.'</div><a class="ppc_spotlight_image_link" target="'.$window51.'" href="'.$link51.'"> '.$book51.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink51 .'</li>';
}
if ($params->get('show52')){
	if ($spotlightImage52) $getlink52 = '';
	if ($params->get('nolink52')) {$getlink52 = '<div><img src="'.JURI::base().$spotlightImage52.'" width="100%" height="" border="0" alt="'.$alt52.'" title="'.$alt52.'" /></div>';
	} else {
		$getlink52 = '<img src="'.JURI::base().$spotlightImage52.'" width="100%" height="" border="0" alt="'.$alt52.'" title="'.$alt52.'" />';
	}
	if($description52 != null && $description52 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description52.'</div><div class="ppc_spotlight_image_title">'.$alt52.'</div><a class="ppc_spotlight_image_link" target="'.$window52.'" href="'.$link52.'"> '.$book52.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink52 .'</li>';
}

if ($params->get('show53')){
	if ($spotlightImage53) $getlink53 = '';
	if ($params->get('nolink53')) {$getlink53 = '<div><img src="'.JURI::base().$spotlightImage53.'" width="530%" height="" border="0" alt="'.$alt53.'" title="'.$alt53.'" /></div>';
	} else {
		$getlink53 = '<img src="'.JURI::base().$spotlightImage53.'" width="530%" height="" border="0" alt="'.$alt53.'" title="'.$alt53.'" />';
	}
	if($description53 != null && $description53 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description53.'</div><div class="ppc_spotlight_image_title">'.$alt53.'</div><a class="ppc_spotlight_image_link" target="'.$window53.'" href="'.$link53.'">'.$book53.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink53 .'</li>';
}

if ($params->get('show54')){
	if ($spotlightImage54) $getlink54 = '';
	if ($params->get('nolink54')) {$getlink54 = '<div><img src="'.JURI::base().$spotlightImage54.'" width="540%" height="" border="0" alt="'.$alt54.'" title="'.$alt54.'" /></div>';
	} else {
		$getlink54 = '<img src="'.JURI::base().$spotlightImage54.'" width="540%" height="" border="0" alt="'.$alt54.'" title="'.$alt54.'" />';
	}
	if($description54 != null && $description54 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description54.'</div><div class="ppc_spotlight_image_title">'.$alt54.'</div><a class="ppc_spotlight_image_link" target="'.$window54.'" href="'.$link54.'">'.$book54.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink54 .'</li>';
}

if ($params->get('show55')){
	if ($spotlightImage55) $getlink55 = '';
	if ($params->get('nolink55')) {$getlink55 = '<div><img src="'.JURI::base().$spotlightImage55.'" width="500%" height="" border="0" alt="'.$alt55.'" title="'.$alt55.'" /></div>';
	} else {
		$getlink55 = '<img src="'.JURI::base().$spotlightImage55.'" width="500%" height="" border="0" alt="'.$alt55.'" title="'.$alt55.'" />';
	}
	if($description55 != null && $description55 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description55.'</div><div class="ppc_spotlight_image_title">'.$alt55.'</div><a class="ppc_spotlight_image_link" target="'.$window55.'" href="'.$link55.'">'.$book55.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink55 .'</li>';
}
if ($params->get('show56')){
	if ($spotlightImage56) $getlink56 = '';
	if ($params->get('nolink56')) {$getlink56 = '<div><img src="'.JURI::base().$spotlightImage56.'" width="500%" height="" border="0" alt="'.$alt56.'" title="'.$alt56.'" /></div>';
	} else {
		$getlink56 = '<img src="'.JURI::base().$spotlightImage56.'" width="500%" height="" border="0" alt="'.$alt56.'" title="'.$alt56.'" />';
	}
	if($description56 != null && $description56 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description56.'</div><div class="ppc_spotlight_image_title">'.$alt56.'</div><a class="ppc_spotlight_image_link" target="'.$window56.'" href="'.$link56.'">'.$book56.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink56 .'</li>';
}
if ($params->get('show57')){
	if ($spotlightImage57) $getlink57 = '';
	if ($params->get('nolink57')) {$getlink57 = '<div><img src="'.JURI::base().$spotlightImage57.'" width="500%" height="" border="0" alt="'.$alt57.'" title="'.$alt57.'" /></div>';
	} else {
		$getlink57 = '<img src="'.JURI::base().$spotlightImage57.'" width="500%" height="" border="0" alt="'.$alt57.'" title="'.$alt57.'" />';
	}
	if($description57 != null && $description57 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description57.'</div><div class="ppc_spotlight_image_title">'.$alt57.'</div><a class="ppc_spotlight_image_link" target="'.$window57.'" href="'.$link57.'">'.$book57.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink57 .'</li>';
}
if ($params->get('show58')){
	if ($spotlightImage58) $getlink58 = '';
	if ($params->get('nolink58')) {$getlink58 = '<div><img src="'.JURI::base().$spotlightImage58.'" width="500%" height="" border="0" alt="'.$alt58.'" title="'.$alt58.'" /></div>';
	} else {
		$getlink58 = '<img src="'.JURI::base().$spotlightImage58.'" width="500%" height="" border="0" alt="'.$alt58.'" title="'.$alt58.'" />';
	}
	if($description58 != null && $description58 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description58.'</div><div class="ppc_spotlight_image_title">'.$alt58.'</div><a class="ppc_spotlight_image_link" target="'.$window58.'" href="'.$link58.'">'.$book58.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink58 .'</li>';
}
if ($params->get('show59')){
	if ($spotlightImage59) $getlink59 = '';
	if ($params->get('nolink59')) {$getlink59 = '<div><img src="'.JURI::base().$spotlightImage59.'" width="500%" height="" border="0" alt="'.$alt59.'" title="'.$alt59.'" /></div>';
	} else {
		$getlink59 = '<img src="'.JURI::base().$spotlightImage59.'" width="500%" height="" border="0" alt="'.$alt59.'" title="'.$alt59.'" />';
	}
	if($description59 != null && $description59 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description59.'</div><div class="ppc_spotlight_image_title">'.$alt59.'</div><a class="ppc_spotlight_image_link" target="'.$window59.'" href="'.$link59.'">'.$book59.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink59 .'</li>';
} 

if ($params->get('show60')){
	if ($spotlightImage60) $getlink60 = '';
	if ($params->get('nolink60')) {$getlink60 = '<div><img src="'.JURI::base().$spotlightImage60.'" width="600%" height="" border="0" alt="'.$alt60.'" title="'.$alt60.'" /></div>';
	} else {
		$getlink60 = '<img src="'.JURI::base().$spotlightImage60.'" width="600%" height="" border="0" alt="'.$alt60.'" title="'.$alt60.'" />';
	}
	if($description60 != null && $description60 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description60.'</div><div class="ppc_spotlight_image_title">'.$alt60.'</div><a class="ppc_spotlight_image_link" target="'.$window60.'" href="'.$link60.'">'.$book60.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink60 .'</li>';
}

if ($params->get('show61')){
	if ($spotlightImage61) $getlink61 = '';
	if ($params->get('nolink61')) {$getlink61 = '<div><img src="'.JURI::base().$spotlightImage61.'" width="100%" height="" border="0" alt="'.$alt61.'" title="'.$alt61.'" /></div>';
	} else {
		$getlink61 = '<img src="'.JURI::base().$spotlightImage61.'" width="100%" height="" border="0" alt="'.$alt61.'" title="'.$alt61.'" />';
	}
	if($description61 != null && $description61 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description61.'</div><div class="ppc_spotlight_image_title">'.$alt61.'</div><a class="ppc_spotlight_image_link" target="'.$window61.'" href="'.$link61.'"> '.$book61.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink61 .'</li>';
}
if ($params->get('show62')){
	if ($spotlightImage62) $getlink62 = '';
	if ($params->get('nolink62')) {$getlink62 = '<div><img src="'.JURI::base().$spotlightImage62.'" width="100%" height="" border="0" alt="'.$alt62.'" title="'.$alt62.'" /></div>';
	} else {
		$getlink62 = '<img src="'.JURI::base().$spotlightImage62.'" width="100%" height="" border="0" alt="'.$alt62.'" title="'.$alt62.'" />';
	}
	if($description62 != null && $description62 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description62.'</div><div class="ppc_spotlight_image_title">'.$alt62.'</div><a class="ppc_spotlight_image_link" target="'.$window62.'" href="'.$link62.'"> '.$book62.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink62 .'</li>';
}

if ($params->get('show63')){
	if ($spotlightImage63) $getlink63 = '';
	if ($params->get('nolink63')) {$getlink63 = '<div><img src="'.JURI::base().$spotlightImage63.'" width="630%" height="" border="0" alt="'.$alt63.'" title="'.$alt63.'" /></div>';
	} else {
		$getlink63 = '<img src="'.JURI::base().$spotlightImage63.'" width="630%" height="" border="0" alt="'.$alt63.'" title="'.$alt63.'" />';
	}
	if($description63 != null && $description63 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description63.'</div><div class="ppc_spotlight_image_title">'.$alt63.'</div><a class="ppc_spotlight_image_link" target="'.$window63.'" href="'.$link63.'">'.$book63.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink63 .'</li>';
}

if ($params->get('show64')){
	if ($spotlightImage64) $getlink64 = '';
	if ($params->get('nolink64')) {$getlink64 = '<div><img src="'.JURI::base().$spotlightImage64.'" width="640%" height="" border="0" alt="'.$alt64.'" title="'.$alt64.'" /></div>';
	} else {
		$getlink64 = '<img src="'.JURI::base().$spotlightImage64.'" width="640%" height="" border="0" alt="'.$alt64.'" title="'.$alt64.'" />';
	}
	if($description64 != null && $description64 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description64.'</div><div class="ppc_spotlight_image_title">'.$alt64.'</div><a class="ppc_spotlight_image_link" target="'.$window64.'" href="'.$link64.'">'.$book64.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink64 .'</li>';
}

if ($params->get('show65')){
	if ($spotlightImage65) $getlink65 = '';
	if ($params->get('nolink65')) {$getlink65 = '<div><img src="'.JURI::base().$spotlightImage65.'" width="650%" height="" border="0" alt="'.$alt65.'" title="'.$alt65.'" /></div>';
	} else {
		$getlink65 = '<img src="'.JURI::base().$spotlightImage65.'" width="650%" height="" border="0" alt="'.$alt65.'" title="'.$alt65.'" />';
	}
	if($description65 != null && $description65 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description65.'</div><div class="ppc_spotlight_image_title">'.$alt65.'</div><a class="ppc_spotlight_image_link" target="'.$window65.'" href="'.$link65.'">'.$book65.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink65 .'</li>';
}

if ($params->get('show66')){
	if ($spotlightImage66) $getlink66 = '';
	if ($params->get('nolink66')) {$getlink66 = '<div><img src="'.JURI::base().$spotlightImage66.'" width="600%" height="" border="0" alt="'.$alt66.'" title="'.$alt66.'" /></div>';
	} else {
		$getlink66 = '<img src="'.JURI::base().$spotlightImage66.'" width="600%" height="" border="0" alt="'.$alt66.'" title="'.$alt66.'" />';
	}
	if($description66 != null && $description66 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description66.'</div><div class="ppc_spotlight_image_title">'.$alt66.'</div><a class="ppc_spotlight_image_link" target="'.$window66.'" href="'.$link66.'">'.$book66.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink66 .'</li>';
}
if ($params->get('show67')){
	if ($spotlightImage67) $getlink67 = '';
	if ($params->get('nolink67')) {$getlink67 = '<div><img src="'.JURI::base().$spotlightImage67.'" width="600%" height="" border="0" alt="'.$alt67.'" title="'.$alt67.'" /></div>';
	} else {
		$getlink67 = '<img src="'.JURI::base().$spotlightImage67.'" width="600%" height="" border="0" alt="'.$alt67.'" title="'.$alt67.'" />';
	}
	if($description67 != null && $description67 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description67.'</div><div class="ppc_spotlight_image_title">'.$alt67.'</div><a class="ppc_spotlight_image_link" target="'.$window67.'" href="'.$link67.'">'.$book67.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink67 .'</li>';
}
if ($params->get('show68')){
	if ($spotlightImage68) $getlink68 = '';
	if ($params->get('nolink68')) {$getlink68 = '<div><img src="'.JURI::base().$spotlightImage68.'" width="600%" height="" border="0" alt="'.$alt68.'" title="'.$alt68.'" /></div>';
	} else {
		$getlink68 = '<img src="'.JURI::base().$spotlightImage68.'" width="600%" height="" border="0" alt="'.$alt68.'" title="'.$alt68.'" />';
	}
	if($description68 != null && $description68 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description68.'</div><div class="ppc_spotlight_image_title">'.$alt68.'</div><a class="ppc_spotlight_image_link" target="'.$window68.'" href="'.$link68.'">'.$book68.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink68 .'</li>';
}
if ($params->get('show69')){
	if ($spotlightImage69) $getlink69 = '';
	if ($params->get('nolink69')) {$getlink69 = '<div><img src="'.JURI::base().$spotlightImage69.'" width="600%" height="" border="0" alt="'.$alt69.'" title="'.$alt69.'" /></div>';
	} else {
		$getlink69 = '<img src="'.JURI::base().$spotlightImage69.'" width="600%" height="" border="0" alt="'.$alt69.'" title="'.$alt69.'" />';
	}
	if($description69 != null && $description69 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description69.'</div><div class="ppc_spotlight_image_title">'.$alt69.'</div><a class="ppc_spotlight_image_link" target="'.$window69.'" href="'.$link69.'">'.$book69.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink69 .'</li>';
} 

if ($params->get('show70')){
	if ($spotlightImage70) $getlink70 = '';
	if ($params->get('nolink70')) {$getlink70 = '<div><img src="'.JURI::base().$spotlightImage70.'" width="700%" height="" border="0" alt="'.$alt70.'" title="'.$alt70.'" /></div>';
	} else {
		$getlink70 = '<img src="'.JURI::base().$spotlightImage70.'" width="700%" height="" border="0" alt="'.$alt70.'" title="'.$alt70.'" />';
	}
	if($description70 != null && $description70 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description70.'</div><div class="ppc_spotlight_image_title">'.$alt70.'</div><a class="ppc_spotlight_image_link" target="'.$window70.'" href="'.$link70.'">'.$book70.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink70 .'</li>';
}

if ($params->get('show71')){
	if ($spotlightImage71) $getlink71 = '';
	if ($params->get('nolink71')) {$getlink71 = '<div><img src="'.JURI::base().$spotlightImage71.'" width="100%" height="" border="0" alt="'.$alt71.'" title="'.$alt71.'" /></div>';
	} else {
		$getlink71 = '<img src="'.JURI::base().$spotlightImage71.'" width="100%" height="" border="0" alt="'.$alt71.'" title="'.$alt71.'" />';
	}
	if($description71 != null && $description71 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description71.'</div><div class="ppc_spotlight_image_title">'.$alt71.'</div><a class="ppc_spotlight_image_link" target="'.$window71.'" href="'.$link71.'"> '.$book71.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink71 .'</li>';
}
if ($params->get('show72')){
	if ($spotlightImage72) $getlink72 = '';
	if ($params->get('nolink72')) {$getlink72 = '<div><img src="'.JURI::base().$spotlightImage72.'" width="100%" height="" border="0" alt="'.$alt72.'" title="'.$alt72.'" /></div>';
	} else {
		$getlink72 = '<img src="'.JURI::base().$spotlightImage72.'" width="100%" height="" border="0" alt="'.$alt72.'" title="'.$alt72.'" />';
	}
	if($description72 != null && $description72 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description72.'</div><div class="ppc_spotlight_image_title">'.$alt72.'</div><a class="ppc_spotlight_image_link" target="'.$window72.'" href="'.$link72.'"> '.$book72.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink72 .'</li>';
}

if ($params->get('show73')){
	if ($spotlightImage73) $getlink73 = '';
	if ($params->get('nolink73')) {$getlink73 = '<div><img src="'.JURI::base().$spotlightImage73.'" width="730%" height="" border="0" alt="'.$alt73.'" title="'.$alt73.'" /></div>';
	} else {
		$getlink73 = '<img src="'.JURI::base().$spotlightImage73.'" width="730%" height="" border="0" alt="'.$alt73.'" title="'.$alt73.'" />';
	}
	if($description73 != null && $description73 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description73.'</div><div class="ppc_spotlight_image_title">'.$alt73.'</div><a class="ppc_spotlight_image_link" target="'.$window73.'" href="'.$link73.'">'.$book73.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink73 .'</li>';
}

if ($params->get('show74')){
	if ($spotlightImage74) $getlink74 = '';
	if ($params->get('nolink74')) {$getlink74 = '<div><img src="'.JURI::base().$spotlightImage74.'" width="740%" height="" border="0" alt="'.$alt74.'" title="'.$alt74.'" /></div>';
	} else {
		$getlink74 = '<img src="'.JURI::base().$spotlightImage74.'" width="740%" height="" border="0" alt="'.$alt74.'" title="'.$alt74.'" />';
	}
	if($description74 != null && $description74 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description74.'</div><div class="ppc_spotlight_image_title">'.$alt74.'</div><a class="ppc_spotlight_image_link" target="'.$window74.'" href="'.$link74.'">'.$book74.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink74 .'</li>';
}

if ($params->get('show75')){
	if ($spotlightImage75) $getlink75 = '';
	if ($params->get('nolink75')) {$getlink75 = '<div><img src="'.JURI::base().$spotlightImage75.'" width="750%" height="" border="0" alt="'.$alt75.'" title="'.$alt75.'" /></div>';
	} else {
		$getlink75 = '<img src="'.JURI::base().$spotlightImage75.'" width="750%" height="" border="0" alt="'.$alt75.'" title="'.$alt75.'" />';
	}
	if($description75 != null && $description75 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description75.'</div><div class="ppc_spotlight_image_title">'.$alt75.'</div><a class="ppc_spotlight_image_link" target="'.$window75.'" href="'.$link75.'">'.$book75.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink75 .'</li>';
}

if ($params->get('show76')){
	if ($spotlightImage76) $getlink76 = '';
	if ($params->get('nolink76')) {$getlink76 = '<div><img src="'.JURI::base().$spotlightImage76.'" width="760%" height="" border="0" alt="'.$alt76.'" title="'.$alt76.'" /></div>';
	} else {
		$getlink76 = '<img src="'.JURI::base().$spotlightImage76.'" width="760%" height="" border="0" alt="'.$alt76.'" title="'.$alt76.'" />';
	}
	if($description76 != null && $description76 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description76.'</div><div class="ppc_spotlight_image_title">'.$alt76.'</div><a class="ppc_spotlight_image_link" target="'.$window76.'" href="'.$link76.'">'.$book76.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink76 .'</li>';
}

if ($params->get('show77')){
	if ($spotlightImage77) $getlink77 = '';
	if ($params->get('nolink77')) {$getlink77 = '<div><img src="'.JURI::base().$spotlightImage77.'" width="700%" height="" border="0" alt="'.$alt77.'" title="'.$alt77.'" /></div>';
	} else {
		$getlink77 = '<img src="'.JURI::base().$spotlightImage77.'" width="700%" height="" border="0" alt="'.$alt77.'" title="'.$alt77.'" />';
	}
	if($description77 != null && $description77 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description77.'</div><div class="ppc_spotlight_image_title">'.$alt77.'</div><a class="ppc_spotlight_image_link" target="'.$window77.'" href="'.$link77.'">'.$book77.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink77 .'</li>';
}
if ($params->get('show78')){
	if ($spotlightImage78) $getlink78 = '';
	if ($params->get('nolink78')) {$getlink78 = '<div><img src="'.JURI::base().$spotlightImage78.'" width="700%" height="" border="0" alt="'.$alt78.'" title="'.$alt78.'" /></div>';
	} else {
		$getlink78 = '<img src="'.JURI::base().$spotlightImage78.'" width="700%" height="" border="0" alt="'.$alt78.'" title="'.$alt78.'" />';
	}
	if($description78 != null && $description78 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description78.'</div><div class="ppc_spotlight_image_title">'.$alt78.'</div><a class="ppc_spotlight_image_link" target="'.$window78.'" href="'.$link78.'">'.$book78.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink78 .'</li>';
}
if ($params->get('show79')){
	if ($spotlightImage79) $getlink79 = '';
	if ($params->get('nolink79')) {$getlink79 = '<div><img src="'.JURI::base().$spotlightImage79.'" width="700%" height="" border="0" alt="'.$alt79.'" title="'.$alt79.'" /></div>';
	} else {
		$getlink79 = '<img src="'.JURI::base().$spotlightImage79.'" width="700%" height="" border="0" alt="'.$alt79.'" title="'.$alt79.'" />';
	}
	if($description79 != null && $description79 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description79.'</div><div class="ppc_spotlight_image_title">'.$alt79.'</div><a class="ppc_spotlight_image_link" target="'.$window79.'" href="'.$link79.'">'.$book79.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink79 .'</li>';
} 

if ($params->get('show80')){
	if ($spotlightImage80) $getlink80 = '';
	if ($params->get('nolink80')) {$getlink80 = '<div><img src="'.JURI::base().$spotlightImage80.'" width="800%" height="" border="0" alt="'.$alt80.'" title="'.$alt80.'" /></div>';
	} else {
		$getlink80 = '<img src="'.JURI::base().$spotlightImage80.'" width="800%" height="" border="0" alt="'.$alt80.'" title="'.$alt80.'" />';
	}
	if($description80 != null && $description80 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description80.'</div><div class="ppc_spotlight_image_title">'.$alt80.'</div><a class="ppc_spotlight_image_link" target="'.$window80.'" href="'.$link80.'">'.$book80.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink80 .'</li>';
}

if ($params->get('show81')){
	if ($spotlightImage81) $getlink81 = '';
	if ($params->get('nolink81')) {$getlink81 = '<div><img src="'.JURI::base().$spotlightImage81.'" width="100%" height="" border="0" alt="'.$alt81.'" title="'.$alt81.'" /></div>';
	} else {
		$getlink81 = '<img src="'.JURI::base().$spotlightImage81.'" width="100%" height="" border="0" alt="'.$alt81.'" title="'.$alt81.'" />';
	}
	if($description81 != null && $description81 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description81.'</div><div class="ppc_spotlight_image_title">'.$alt81.'</div><a class="ppc_spotlight_image_link" target="'.$window81.'" href="'.$link81.'"> '.$book81.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink81 .'</li>';
}
if ($params->get('show82')){
	if ($spotlightImage82) $getlink82 = '';
	if ($params->get('nolink82')) {$getlink82 = '<div><img src="'.JURI::base().$spotlightImage82.'" width="100%" height="" border="0" alt="'.$alt82.'" title="'.$alt82.'" /></div>';
	} else {
		$getlink82 = '<img src="'.JURI::base().$spotlightImage82.'" width="100%" height="" border="0" alt="'.$alt82.'" title="'.$alt82.'" />';
	}
	if($description82 != null && $description82 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description82.'</div><div class="ppc_spotlight_image_title">'.$alt82.'</div><a class="ppc_spotlight_image_link" target="'.$window82.'" href="'.$link82.'"> '.$book82.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink82 .'</li>';
}

if ($params->get('show83')){
	if ($spotlightImage83) $getlink83 = '';
	if ($params->get('nolink83')) {$getlink83 = '<div><img src="'.JURI::base().$spotlightImage83.'" width="830%" height="" border="0" alt="'.$alt83.'" title="'.$alt83.'" /></div>';
	} else {
		$getlink83 = '<img src="'.JURI::base().$spotlightImage83.'" width="830%" height="" border="0" alt="'.$alt83.'" title="'.$alt83.'" />';
	}
	if($description83 != null && $description83 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description83.'</div><div class="ppc_spotlight_image_title">'.$alt83.'</div><a class="ppc_spotlight_image_link" target="'.$window83.'" href="'.$link83.'">'.$book83.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink83 .'</li>';
}

if ($params->get('show84')){
	if ($spotlightImage84) $getlink84 = '';
	if ($params->get('nolink84')) {$getlink84 = '<div><img src="'.JURI::base().$spotlightImage84.'" width="840%" height="" border="0" alt="'.$alt84.'" title="'.$alt84.'" /></div>';
	} else {
		$getlink84 = '<img src="'.JURI::base().$spotlightImage84.'" width="840%" height="" border="0" alt="'.$alt84.'" title="'.$alt84.'" />';
	}
	if($description84 != null && $description84 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description84.'</div><div class="ppc_spotlight_image_title">'.$alt84.'</div><a class="ppc_spotlight_image_link" target="'.$window84.'" href="'.$link84.'">'.$book84.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink84 .'</li>';
}

if ($params->get('show85')){
	if ($spotlightImage85) $getlink85 = '';
	if ($params->get('nolink85')) {$getlink85 = '<div><img src="'.JURI::base().$spotlightImage85.'" width="850%" height="" border="0" alt="'.$alt85.'" title="'.$alt85.'" /></div>';
	} else {
		$getlink85 = '<img src="'.JURI::base().$spotlightImage85.'" width="850%" height="" border="0" alt="'.$alt85.'" title="'.$alt85.'" />';
	}
	if($description85 != null && $description85 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description85.'</div><div class="ppc_spotlight_image_title">'.$alt85.'</div><a class="ppc_spotlight_image_link" target="'.$window85.'" href="'.$link85.'">'.$book85.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink85 .'</li>';
}

if ($params->get('show86')){
	if ($spotlightImage86) $getlink86 = '';
	if ($params->get('nolink86')) {$getlink86 = '<div><img src="'.JURI::base().$spotlightImage86.'" width="860%" height="" border="0" alt="'.$alt86.'" title="'.$alt86.'" /></div>';
	} else {
		$getlink86 = '<img src="'.JURI::base().$spotlightImage86.'" width="860%" height="" border="0" alt="'.$alt86.'" title="'.$alt86.'" />';
	}
	if($description86 != null && $description86 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description86.'</div><div class="ppc_spotlight_image_title">'.$alt86.'</div><a class="ppc_spotlight_image_link" target="'.$window86.'" href="'.$link86.'">'.$book86.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink86 .'</li>';
}

if ($params->get('show87')){
	if ($spotlightImage87) $getlink87 = '';
	if ($params->get('nolink87')) {$getlink87 = '<div><img src="'.JURI::base().$spotlightImage87.'" width="870%" height="" border="0" alt="'.$alt87.'" title="'.$alt87.'" /></div>';
	} else {
		$getlink87 = '<img src="'.JURI::base().$spotlightImage87.'" width="870%" height="" border="0" alt="'.$alt87.'" title="'.$alt87.'" />';
	}
	if($description87 != null && $description87 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description87.'</div><div class="ppc_spotlight_image_title">'.$alt87.'</div><a class="ppc_spotlight_image_link" target="'.$window87.'" href="'.$link87.'">'.$book87.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink87 .'</li>';
}

if ($params->get('show88')){
	if ($spotlightImage88) $getlink88 = '';
	if ($params->get('nolink88')) {$getlink88 = '<div><img src="'.JURI::base().$spotlightImage88.'" width="800%" height="" border="0" alt="'.$alt88.'" title="'.$alt88.'" /></div>';
	} else {
		$getlink88 = '<img src="'.JURI::base().$spotlightImage88.'" width="800%" height="" border="0" alt="'.$alt88.'" title="'.$alt88.'" />';
	}
	if($description88 != null && $description88 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description88.'</div><div class="ppc_spotlight_image_title">'.$alt88.'</div><a class="ppc_spotlight_image_link" target="'.$window88.'" href="'.$link88.'">'.$book88.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink88 .'</li>';
}
if ($params->get('show89')){
	if ($spotlightImage89) $getlink89 = '';
	if ($params->get('nolink89')) {$getlink89 = '<div><img src="'.JURI::base().$spotlightImage89.'" width="800%" height="" border="0" alt="'.$alt89.'" title="'.$alt89.'" /></div>';
	} else {
		$getlink89 = '<img src="'.JURI::base().$spotlightImage89.'" width="800%" height="" border="0" alt="'.$alt89.'" title="'.$alt89.'" />';
	}
	if($description89 != null && $description89 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description89.'</div><div class="ppc_spotlight_image_title">'.$alt89.'</div><a class="ppc_spotlight_image_link" target="'.$window89.'" href="'.$link89.'">'.$book89.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink89 .'</li>';
} 

if ($params->get('show90')){
	if ($spotlightImage90) $getlink90 = '';
	if ($params->get('nolink90')) {$getlink90 = '<div><img src="'.JURI::base().$spotlightImage90.'" width="900%" height="" border="0" alt="'.$alt90.'" title="'.$alt90.'" /></div>';
	} else {
		$getlink90 = '<img src="'.JURI::base().$spotlightImage90.'" width="900%" height="" border="0" alt="'.$alt90.'" title="'.$alt90.'" />';
	}
	if($description90 != null && $description90 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description90.'</div><div class="ppc_spotlight_image_title">'.$alt90.'</div><a class="ppc_spotlight_image_link" target="'.$window90.'" href="'.$link90.'">'.$book90.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink90 .'</li>';
}

if ($params->get('show91')){
	if ($spotlightImage91) $getlink91 = '';
	if ($params->get('nolink91')) {$getlink91 = '<div><img src="'.JURI::base().$spotlightImage91.'" width="100%" height="" border="0" alt="'.$alt91.'" title="'.$alt91.'" /></div>';
	} else {
		$getlink91 = '<img src="'.JURI::base().$spotlightImage91.'" width="100%" height="" border="0" alt="'.$alt91.'" title="'.$alt91.'" />';
	}
	if($description91 != null && $description91 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description91.'</div><div class="ppc_spotlight_image_title">'.$alt91.'</div><a class="ppc_spotlight_image_link" target="'.$window91.'" href="'.$link91.'"> '.$book91.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink91 .'</li>';
}
if ($params->get('show92')){
	if ($spotlightImage92) $getlink92 = '';
	if ($params->get('nolink92')) {$getlink92 = '<div><img src="'.JURI::base().$spotlightImage92.'" width="100%" height="" border="0" alt="'.$alt92.'" title="'.$alt92.'" /></div>';
	} else {
		$getlink92 = '<img src="'.JURI::base().$spotlightImage92.'" width="100%" height="" border="0" alt="'.$alt92.'" title="'.$alt92.'" />';
	}
	if($description92 != null && $description92 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description92.'</div><div class="ppc_spotlight_image_title">'.$alt92.'</div><a class="ppc_spotlight_image_link" target="'.$window92.'" href="'.$link92.'"> '.$book92.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink92 .'</li>';
}

if ($params->get('show93')){
	if ($spotlightImage93) $getlink93 = '';
	if ($params->get('nolink93')) {$getlink93 = '<div><img src="'.JURI::base().$spotlightImage93.'" width="930%" height="" border="0" alt="'.$alt93.'" title="'.$alt93.'" /></div>';
	} else {
		$getlink93 = '<img src="'.JURI::base().$spotlightImage93.'" width="930%" height="" border="0" alt="'.$alt93.'" title="'.$alt93.'" />';
	}
	if($description93 != null && $description93 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description93.'</div><div class="ppc_spotlight_image_title">'.$alt93.'</div><a class="ppc_spotlight_image_link" target="'.$window93.'" href="'.$link93.'">'.$book93.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink93 .'</li>';
}

if ($params->get('show94')){
	if ($spotlightImage94) $getlink94 = '';
	if ($params->get('nolink94')) {$getlink94 = '<div><img src="'.JURI::base().$spotlightImage94.'" width="940%" height="" border="0" alt="'.$alt94.'" title="'.$alt94.'" /></div>';
	} else {
		$getlink94 = '<img src="'.JURI::base().$spotlightImage94.'" width="940%" height="" border="0" alt="'.$alt94.'" title="'.$alt94.'" />';
	}
	if($description94 != null && $description94 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description94.'</div><div class="ppc_spotlight_image_title">'.$alt94.'</div><a class="ppc_spotlight_image_link" target="'.$window94.'" href="'.$link94.'">'.$book94.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink94 .'</li>';
}

if ($params->get('show95')){
	if ($spotlightImage95) $getlink95 = '';
	if ($params->get('nolink95')) {$getlink95 = '<div><img src="'.JURI::base().$spotlightImage95.'" width="950%" height="" border="0" alt="'.$alt95.'" title="'.$alt95.'" /></div>';
	} else {
		$getlink95 = '<img src="'.JURI::base().$spotlightImage95.'" width="950%" height="" border="0" alt="'.$alt95.'" title="'.$alt95.'" />';
	}
	if($description95 != null && $description95 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description95.'</div><div class="ppc_spotlight_image_title">'.$alt95.'</div><a class="ppc_spotlight_image_link" target="'.$window95.'" href="'.$link95.'">'.$book95.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink95 .'</li>';
}

if ($params->get('show96')){
	if ($spotlightImage96) $getlink96 = '';
	if ($params->get('nolink96')) {$getlink96 = '<div><img src="'.JURI::base().$spotlightImage96.'" width="960%" height="" border="0" alt="'.$alt96.'" title="'.$alt96.'" /></div>';
	} else {
		$getlink96 = '<img src="'.JURI::base().$spotlightImage96.'" width="960%" height="" border="0" alt="'.$alt96.'" title="'.$alt96.'" />';
	}
	if($description96 != null && $description96 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description96.'</div><div class="ppc_spotlight_image_title">'.$alt96.'</div><a class="ppc_spotlight_image_link" target="'.$window96.'" href="'.$link96.'">'.$book96.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink96 .'</li>';
}

if ($params->get('show97')){
	if ($spotlightImage97) $getlink97 = '';
	if ($params->get('nolink97')) {$getlink97 = '<div><img src="'.JURI::base().$spotlightImage97.'" width="970%" height="" border="0" alt="'.$alt97.'" title="'.$alt97.'" /></div>';
	} else {
		$getlink97 = '<img src="'.JURI::base().$spotlightImage97.'" width="970%" height="" border="0" alt="'.$alt97.'" title="'.$alt97.'" />';
	}
	if($description97 != null && $description97 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description97.'</div><div class="ppc_spotlight_image_title">'.$alt97.'</div><a class="ppc_spotlight_image_link" target="'.$window97.'" href="'.$link97.'">'.$book97.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink97 .'</li>';
}

if ($params->get('show98')){
	if ($spotlightImage98) $getlink98 = '';
	if ($params->get('nolink98')) {$getlink98 = '<div><img src="'.JURI::base().$spotlightImage98.'" width="980%" height="" border="0" alt="'.$alt98.'" title="'.$alt98.'" /></div>';
	} else {
		$getlink98 = '<img src="'.JURI::base().$spotlightImage98.'" width="980%" height="" border="0" alt="'.$alt98.'" title="'.$alt98.'" />';
	}
	if($description98 != null && $description98 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description98.'</div><div class="ppc_spotlight_image_title">'.$alt98.'</div><a class="ppc_spotlight_image_link" target="'.$window98.'" href="'.$link98.'">'.$book98.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink98 .'</li>';
}

if ($params->get('show99')){
	if ($spotlightImage99) $getlink99 = '';
	if ($params->get('nolink99')) {$getlink99 = '<div><img src="'.JURI::base().$spotlightImage99.'" width="900%" height="" border="0" alt="'.$alt99.'" title="'.$alt99.'" /></div>';
	} else {
		$getlink99 = '<img src="'.JURI::base().$spotlightImage99.'" width="900%" height="" border="0" alt="'.$alt99.'" title="'.$alt99.'" />';
	}
	if($description99 != null && $description99 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description99.'</div><div class="ppc_spotlight_image_title">'.$alt99.'</div><a class="ppc_spotlight_image_link" target="'.$window99.'" href="'.$link99.'">'.$book99.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink99 .'</li>';
} 

if ($params->get('show100')){
	if ($spotlightImage100) $getlink100 = '';
	if ($params->get('nolink100')) {$getlink100 = '<div><img src="'.JURI::base().$spotlightImage100.'" width="1000%" height="" border="0" alt="'.$alt100.'" title="'.$alt100.'" /></div>';
	} else {
		$getlink100 = '<img src="'.JURI::base().$spotlightImage100.'" width="1000%" height="" border="0" alt="'.$alt100.'" title="'.$alt100.'" />';
	}
	if($description100 != null && $description100 != "")
		$desc = '<div id="mainCoroussel"><div class="ppc_spotlight_image_desc">'.$description100.'</div><div class="ppc_spotlight_image_title">'.$alt100.'</div><a class="ppc_spotlight_image_link" target="'.$window100.'" href="'.$link100.'">'.$book100.'</a></div>';
	else
		$desc = '';
	$arr_img[]='<li style="background:none;margin:0px;padding:0px"> <div class="slider-overlay"></div>'.$desc. $getlink100 .'</li>';
}

       if($random == 1){
            shuffle($arr_img);
        }

        foreach($arr_img as $item) {
            echo $item;
	}


    ?>
	</ul>
	<?php if ($params->get('nav')) : ?>
    
	
	<div class="ssbutton" style="width:<?php echo ($width)-15 ?>px;text-align:<?php echo ($buttons) ?>; bottom:15px; padding: 0 25px 0 10px;  position: absolute;  z-index: 200;">
	<a href="#" class="ssprev"><span id="prev<?php echo $module->id?>"><img src="modules/mod_ppc_simple_spotlight/assets/img/button/prev<?php echo $imgbutton ;?>.png" title="Previous" alt="Previous" /></span></a> 
	<a href="#" class="ssnext"><span id="next<?php echo $module->id?>"><img src="modules/mod_ppc_simple_spotlight/assets/img/button/next<?php echo $imgbutton ;?>.png" title="Next" alt="Next" /></span></a>
    </div>
    <?php endif; ?>
</div>
<?php if($enable_shadow=="true") : ?>
	<div class="bgs_bottom" style="margin:0px auto"><div class="bgs_bottom_left"></div><div class="bgs_bottom_right"></div></div>
	<?php endif; ?>
</div>

<div style="clear: both;"></div> 