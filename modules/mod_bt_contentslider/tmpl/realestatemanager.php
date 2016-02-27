<link rel="stylesheet" href="/allure/components/com_realestatemanager/includes/realestatemanager.css" />

    <div id="gallery_blocks_rem" style="display:block;">
	<div id="main_spotlight" style="overflow:hidden; width:100%; white-space: nowrap;">

<?php 

global $mosConfig_live_site;

$i=0;

$houses = $pages;

foreach($houses as $row){
	// casas como BEST OF
	if ($row->published == '1' ){
		
	$option = 'com_realestatemanager';
	$tmphouse->catid[0] = 46;
            //$link = 'index.php?option=' . $option . '&amp;task=view&amp;id=' . $row->id . '&amp;catid=' . $tmphouse->catid[0] . '&amp;Itemid=' . $Itemid;
            $link = $mosConfig_live_site . "/villas/view/" . $row->id;
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
                                    <a href="<?php echo $link; ?>" >
                                <?php
                                if (strlen($row->htitle) > 45)
                                    echo substr($row->htitle, 0, 25), '...';
                                else {
                                    echo $row->htitle.'';
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
                                <span class="col_text_1"><?php echo "&nbsp;&euro;".$row->price_low_season . "&nbsp;/&nbsp;". _REALESTATE_MANAGER_LABEL_WEEK; ?></span>
                            </div>
                            <a class="view_this_villa" href="<?php echo $link;?>"><?php echo strtoupper(_REALESTATE_MANAGER_LABEL_VIEW_VILLA); ?></a>
                        </td>
                    </tr>
                </table>
            </div>
	    
	<?php
	$i++;
}
	}
	?>
	
	</div>
	</div>
    <button id="main_spotlight_previous_house">&nbsp;</button>
    <button id="main_spotlight_next_house">&nbsp;</button>
    
<script>
	(function($){
		
		$("#main_spotlight_next_house").click(function(){
			var firstHouse = $('#main_spotlight>.okno_R:first-child');
			var lastHouse = $('#main_spotlight>.okno_R:last-child');
			var itemWidth = $(firstHouse).width();
			itemWidth = (itemWidth*-1) - 11;
			$( firstHouse ).animate({
				'margin-left': itemWidth
			}, 750, function() {
				$(firstHouse).remove();
				$(firstHouse).css('margin-left', '11px');
				$("#main_spotlight").append($(firstHouse));
			});
		});
		
		
		$("#main_spotlight_previous_house").click(function(){
			var lastHouse = $('#main_spotlight>.okno_R:last-child');
			var itemWidth = $(lastHouse).width(); 
			
			itemWidth = (itemWidth*-1) + 11;
			$(lastHouse).remove();
			$(lastHouse).css('margin-left', itemWidth);
			$("#main_spotlight").prepend($(lastHouse));
			
			var firstHouse = $('#main_spotlight>.okno_R:first-child');
			
			$( firstHouse ).animate({
				'margin-left': '11px'
			}, 750, function() {
				
			});
		});
		
		
		
	})(jQuery);
</script>
