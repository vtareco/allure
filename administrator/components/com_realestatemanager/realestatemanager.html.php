<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

/**
 *
 * @package  RealEstateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com); 
 * Homepage: http://www.ordasoft.com
 * @version: 3.0 Pro
 *
 * */
require_once ($mosConfig_absolute_path . "/libraries/joomla/factory.php"); 
require_once ( JPATH_BASE . DS . 'includes' . DS . 'defines.php' );
require_once ( JPATH_BASE . DS . 'includes' . DS . 'framework.php' );
// ensure this file is being included by a parent file
$mainframe = JFactory::getApplication();
// JURI::base() - adds 'http://localhost/test16'
$templateDir = 'templates/' . $mainframe->getTemplate();
$GLOBALS['mainframe'] = $mainframe;
$GLOBALS['templateDir'] = $templateDir;
$mosConfig_live_site = JURI::root(true);
$GLOBALS['mosConfig_live_site'] = $mosConfig_live_site;
$doc = JFactory::getDocument();
$GLOBALS['doc'] = $doc;

$bid = mosGetParam($_POST, 'bid', array(0));

require_once ($mosConfig_absolute_path . "/administrator/components/com_realestatemanager/realestatemanager.class.others.php");

class HTML_Categories {

    static function show($rows, $myid, &$pageNav, &$lists, $type) {
        global $my, $mosConfig_live_site, $templateDir, $doc;
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $section = "com_realestatemanager";
        $section_name = "RealEstateManager";

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_CATEGORIES_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <form action="index.php" method="post" name="adminForm" id="adminForm">
            <table class="adminlist list_01">
                <tr>
                    <th width="20" align="center">#</th>
                    <th width="20"><input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this<?php   ?>);" /></th>
                    <th align = "center" class="title"><?php echo _HEADER_CATEGORY; ?></th>
                    <th align = "center" width="5%"><?php echo _HEADER_NUMBER; ?></th>
                    <th align = "center" width="10%"><?php echo _HEADER_PUBLISHED; ?></th>
                    <?php
                    if ($section <> 'content') {
                        ?>
                        <th align = "center" colspan="2"><?php echo _HEADER_REORDER; ?></th>
                        <?php
                    }
                    ?>
                    <th align = "center" width="10%"><?php echo _HEADER_ACCESS; ?></th>
                    <?php
                    if ($section == 'content') {
                        ?>
                        <th width="12%" align="left">Section</th>
                        <?php
                    }
                    ?>
                    <th align = "center" width="12%">ID</th>
                    <th align = "center" width="12%">
                        <?php echo _HEADER_CHECKED_OUT; ?>
                    </th>
                </tr>
                <?php
                $k = 0;
                $i = 0;
                $n = count($rows);
                foreach ($rows as $row) {
                    $img = $row->published ? 'tick.png' : 'publish_x.png';
                    $task = $row->published ? 'unpublish' : 'publish';
                    $alt = $row->published ? 'Published' : 'Unpublished';
                    if (!$row->access) {
                        $color_access = 'style="color: green;"';
                        $task_access = 'accessregistered';
                    } else if ($row->access == 1) {
                        $color_access = 'style="color: red;"';
                        $task_access = 'accessspecial';
                    } else {
                        $color_access = 'style="color: black;"';
                        $task_access = 'accesspublic';
                    }
                    ?>
                    <tr class="<?php echo "row$k"; ?>">
                        <td width="20" align="center"><?php echo $pageNav->getRowOffset($i); ?></td>
                        <td width="20">
                            <?php echo mosHTML::idBox($i, $row->id, ($row->checked_out_contact_category && $row->checked_out_contact_category != $my->id), 'bid'); ?>
                        </td>
                        <td width="35%">
                            <?php
                            if ($row->checked_out_contact_category && ($row->checked_out_contact_category != $my->id)) {
                                ?>
                                <?php echo $row->treename . ' ( ' . $row->title . ' )'; ?>
                                &nbsp;[ <i>Checked Out</i> ]
                                <?php
                            } else {
                                ?>
                                <a href="#edit" onClick="return listItemTask('cb<?php echo $i; ?>','edit')">
                                    <?php echo $row->treename . ' ( ' . $row->title . ' )'; ?>
                                </a>
                                <?php
                            }
                            ?>
                        </td>
                        <td align="center"><?php echo $row->cc; ?></td>
                        <td align="center">
                            <a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task; ?>')">
                                <?php
                                if (version_compare(JVERSION, "1.6.0", "lt")) {
                                    ?>
                                    <img src="<?php echo $mosConfig_live_site . "/administrator/images/" . $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $templateDir . "/images/admin/" . $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
                                    <?php
                                }
                                ?>
                            </a>
                        </td>
                        <!-- old td  >
                        <?php echo $i . $pageNav->orderUpIcon($i); ?>
                        </td>
                        <td>
                        <?php echo $i . "::" . $n . $pageNav->orderDownIcon($i, $n); ?>
                        </td-->
                        <td align="center"><?php echo catOrderUpIcon($row->ordering - 1, $i); ?></td>
                        <td align="center"><?php echo catOrderDownIcon($row->ordering - 1, $row->all_fields_in_list, $i); ?></td>
                        <td align="center">
            <!--<a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task_access; ?>')" <?php echo $color_access; ?>>-->
                            <?php echo $row->groups; ?>
                            <!--</a>-->
                        </td>
                        <td align="center">
                            <?php echo $row->id; ?>
                        </td>
                        <td align="center">
                            <?php echo $row->checked_out_contact_category ? $row->editor : ""; ?>				
                        </td>
                        <?php
                        $k = 1 - $k;
                        ?>
                    </tr>
                    <?php
                    $k = 1 - $k;
                    $i++;
                }
                ?>
                <tr><td colspan = "11"><?php echo $pageNav->getListFooter(); ?></td></tr>
            </table>

            <input type="hidden" name="option" value="com_realestatemanager" />
            <input type="hidden" name="section" value="categories" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="chosen" value="" />
            <input type="hidden" name="act" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="type" value="<?php echo $type; ?>" />
        </form>
        <?php
    }

    /**
     * Writes the edit form for new and existing categories
     * 
     * @param  $ The category object
     * @param string $ 
     * @param array $ 
     */
    static function edit(&$row, $section, &$lists, $redirect,$associate_cat_arr) {
        global $my, $mosConfig_live_site, $mainframe,$database;

        $doc = JFactory::getDocument();
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        global $mosConfig_live_site, $option;
        if ($row->image == "") {
            $row->image = 'blank.png';
        }
        mosMakeHtmlSafe($row, ENT_QUOTES, 'description');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_CATEGORIES_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <script language="javascript" type="text/javascript">
            submitbutton = function(pressbutton, section) {
                var form = document.adminForm; 
                if (pressbutton == 'cancel') {
                    submitform( pressbutton );
                    return;
                }

                if ( form.name.value == "" ) {
                    alert('<?php echo _DML_CAT_MUST_SELECT_NAME; ?>');
                }else if ( form.title.value == "" ) {
                    alert('<?php echo _DML_CAT_MUST_SELECT_NAME; ?>');
                }  else {
                    <?php getEditorContents('editor1', 'description'); ?>
                    submitform(pressbutton);
                }
            }
        </script>

        <form action="index.php" method="post" name="adminForm" id="adminForm">
            <table class="adminform form_01">
                <tr>
                    <th  class="house_manager_caption" align="left">
                        <?php echo $row->id ? _HEADER_EDIT : _HEADER_ADD; ?> <?php echo _CATEGORY; ?> <?php echo $row->name; ?>
                    </th>
                </tr>
            </table>


            <table class="adminform form_02" width="100%">
                <tr>
                    <th colspan="3"><?php echo _CATEGORIES__DETAILS; ?></th>
                </tr>
                <tr>
                    <td width="185"><?php echo _CATEGORIES_HEADER_TITLE; ?>:</td>
                    <td colspan="2">
                        <input class="text_area" type="text" name="title" value="<?php echo $row->title; ?>" size="50" maxlength="250" title="<?php echo _REALESTATE_MANAGER_TITLE_TO_TEXTAREA_1_FOR_ADDCATEGORY; ?>" />
                    </td>
                </tr>
                <tr>
                    <td width="185"><?php echo _CATEGORIES_HEADER_NAME; ?>:</td>
                    <td colspan="2">
                        <input class="text_area" type="text" name="name" value="<?php echo $row->name; ?>" size="50" maxlength="255" title="<?php echo _REALESTATE_MANAGER_TITLE_TO_TEXTAREA_2_FOR_ADDCATEGORY; ?>" />
                    </td>
                </tr>
<?php 
/*********************************************************************************************/
         
    if(!empty($associate_cat_arr) && !empty($row->language) && $row->language != '' && $row->language != '*'){
?>
                <tr> 
                    <td width="15%"><?php echo 'language associate category' ?>:</td>                        
                </tr>   
            
<?php
        $j =1;
        foreach ($associate_cat_arr as $lang=>$value) {
            $displ = '';
            if(!$value['list']){
                $displ = 'none';
            }
?>    
                <tr style="display: <?php echo $displ?>">
                    <td width="15%"><?php echo $lang; ?>:</td>
                    <td width="60%"><?php echo $value['list']; ?> 
                    <input class="inputbox" id="associate_category" type="text" name="associate_category<?php echo $j;?>" size="20" readonly="readonly" maxlength="20" style="width:25px; margin-bottom: -4px;" value="<?php echo $value['assocId']; ?>" />
                    <input style="display: none" name="associate_category_lang<?php echo $j;?>" value="<?php echo $lang ?>"/>  
                    </td>                          
                </tr>
<?php
        
        $j++;
        }
   }else{
?>
                <tr> 
                    <td width="15%"><?php echo 'language associate category' ?>:</td> 
                    <td width="60%"><?php echo 'this property only for category with language' ?> 
                </tr> 
<?php
   }

/*********************************************************************************************/
?>     
<script>

    window.onload = function(){
        
        var languageParentId = document.querySelectorAll('#language_associate_category');

        for(var i = 0; i < languageParentId.length; i++){
    
            var el = languageParentId[i];
            var idField = languageParentId[i].nextSibling.nextSibling;
            el.value = idField.value;
    
            var field = (function(x){
                el.onchange= function(){
                    var el = languageParentId[x];
                    var idField = languageParentId[x].nextSibling.nextSibling;
                    idField.value = el.value;     
                };  
            })(i);
        }
    };
</script>      
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_LABEL_LANGUAGE; ?>:</td>
                    <td colspan="2"><?php echo $lists['languages']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_SINGLE_CATEGORY_LAYOUT; ?>:</td>
                    <td colspan="2"><?php echo $lists['alone_category']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_HOUSE_PAGE_LAYOUT; ?>:</td>
                    <td colspan="2">
                        <?php echo $lists['view_house']; ?>
                    </td>
                </tr>
                <tr>
                    <td width="185"><?php echo _CATEGORIES__PARENTITEM; ?>:</td>
                    <td><?php echo $lists['parent']; ?></td>
                </tr>
                <tr><?php $issetImage = substr_count($lists['image'], '<option'); ?>
                    <td width="185"><?php echo _CATEGORIES_HEADER_IMAGE; ?>:</td>
                    <td><?php
                if ($issetImage == 1) {
                    echo $lists['image'] . '<br><span style="font-size: 12px; position: absolute;">To load images need to go Content->Media Manager.<br> There create a folder stories and load your pictures into it<span>';
                }
                else
                    echo $lists['image'];
                        ?></td>    
                    <?php echo $issetImage == 1 ? "</tr><tr><td>" : '<td rowspan="4" width="50%">'; ?>
                <script language="javascript" type="text/javascript">
                    if (document.forms[0].image.options.value!=''){
                        jsimg='../images/stories/' + getSelectedValue( 'adminForm', 'image' );
                    } 
                    else 
                    {
                        jsimg='../images/M_images/blank.png';
                    }
                    document.write('<img src=' + jsimg + ' name="imagelib" width="80" height="80" border="2" alt="<?php echo _CATEGORIES__IMAGEPREVIEW; ?>" />');
                </script>
                </td>
                </tr>
                <tr>
                    <td width="185"><?php echo _CATEGORIES_HEADER_IMAGEPOS; ?>:</td>
                    <td><?php echo $lists['image_position']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _CATEGORIES_HEADER_ORDER; ?>:</td>
                    <td><?php echo $lists['ordering']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _HEADER_ACCESS; ?>:</td>
                    <td><?php echo $lists['category']['registrationlevel']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _HEADER_PUBLISHED; ?>:</td>
                    <td><?php echo $lists['published']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _CATEGORIES__DETAILS; ?>:</td>
                    <td colspan="2">
                        <?php
                        // parameters : areaname, content, hidden field, width, height, rows, cols
                        editorArea('editor1', $row->description, 'description', '500', '200', '50', '5');
                        ?>
                    </td>
                </tr>
            </table>


            <input type="hidden" name="option" value="com_realestatemanager" />
            <input type="hidden" name="section" value="categories" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
        </form>
        <?php
    }

}

/**
 * realestatemanager Import Export Class
 * Handles the import and export of data from the realestatemanager.
 */
class HTML_realestatemanager {
static function edit_review($option, $house_id, $review) {
        global $my, $mosConfig_live_site, $mainframe, $doc;
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_SHOW_REVIEW_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <table cellpadding="4" cellspacing="5" border="0" width="100%" class="adminform form_03">
                <tr>
                    <td colspan="2"><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_TITLE; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="inputbox" type="text" name="title" size="80" value="<?php echo $review[0]->title ?>" />
                    </td>
                </tr>
                <tr>
                    <td><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_COMMENT; ?></td>
                    <td align="center" ><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_RATING; ?></td>
                </tr>
                <tr>
                    <td>
                     <!--<textarea align="top" name="comment" id="comment" cols="60" rows="10" style="width:400;height:100;"/></textarea>-->
                        <?php
                        editorArea('editor1', $review[0]->comment, 'comment', '410', '200', '60', '10');
                        ?>
                    </td>
                    <td width="400" align='right'>
                        <?php
                        $k = 0;
                        while ($k < 11) {
                            ?>
                            <input type="radio" name="rating" value="<?php echo $k; ?>" 
                                   <?php if ($k == $review[0]->rating) echo 'checked="checked"'; ?> alt="Rating" />

                            <img src="../components/com_realestatemanager/images/rating-<?php echo $k; ?>.png" 
                                 alt="<?php echo ($k) / 2; ?>" border="0" /><br />
                                 <?php
                                 $k++;
                             }
                             ?>
                    </td>
                </tr>
            </table>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="update_review" />
            <input type="hidden" name="house_id" value="<?php echo $house_id; ?>" />
            <input type="hidden" name="review_id" value="<?php echo $review[0]->id; ?>" />
        </form>
        <?php
    }

//*************   begin for manage reviews   ********************
    static function edit_manage_review($option, & $review) {
        global $my, $mosConfig_live_site, $mainframe, $doc;
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_SHOW_REVIEW_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <table cellpadding="4" cellspacing="5" border="0" width="100%" class="adminform form_04">
                <tr>
                    <td colspan="2"><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_TITLE; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="inputbox" type="text" name="title" size="80" value="<?php echo $review[0]->title ?>" />
                    </td>
                </tr>
                <tr>
                    <td><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_COMMENT; ?></td>
                    <td align="left" ><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_RATING; ?></td>
                </tr>
                <tr>
                    <td>
                     <!--<textarea align= "top" name="comment" id="comment" cols="60" rows="10" style="width:400;height:100;"/></textarea>-->
                        <?php
                        editorArea('editor1', $review[0]->comment, 'comment', '410', '200', '60', '10');
                        ?>
                    </td>
                    <td width="102" align='left'>
                        <?php
                        $k = 0;
                        while ($k < 11) {
                            ?>
                            <input type="radio" name="rating" value="<?php echo $k; ?>" 
                                   <?php if ($k == $review[0]->rating) echo 'checked="checked"'; ?> alt="Rating" />
                            <img src="../components/com_realestatemanager/images/rating-<?php echo $k; ?>.png" 
                                 alt="<?php echo ($k) / 2; ?>" border="0" /><br />
                                 <?php
                                 $k++;
                             }
                             ?>
                    </td>
                </tr>

            </table>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="update_edit_manage_review" />
            <input type="hidden" name="review_id" value="<?php echo $review[0]->id; ?>" />
        </form>
        <?php
    }

//***************   end for manage reviews   ********************

    static function showRequestRentHouses($option, $rent_requests, $h_associated, $title_assoc, & $pageNav) {
        global $my, $mosConfig_live_site, $mainframe;

        $doc = JFactory::getDocument();
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_REQUEST_RENT . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <form action="index.php" method="post" name="adminForm" id="adminForm" >
            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist list_02">
                <tr>
                    <th align = "center" width="20"><input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this);" /></th>
                    <th align = "center" width="30">#</th>
                    <th align = "center" class="title" width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM; ?></th>
                    <th align = "center" class="title" width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL; ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo "Region"; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_USER; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_EMAIL; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_ADRES; ?></th>
                    <?php
                    if (version_compare(JVERSION, "3.0.0", "ge")) {
                        ?>
                        <td>
                            <div class="btn-group pull-right hidden-phone">
                                <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                                <?php echo $pageNav->getLimitBox(); ?>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
                <?php
                $datarent = JFactory::getDBO();
                $query = "SELECT * FROM #__rem_rent_request  WHERE fk_houseid=4";
                $datarent->setQuery($query);
                $rentrequest = $datarent->loadObjectList();

                for ($i = 0, $n = count($rent_requests); $i < $n; $i++) {
                    $row = $rent_requests[$i];
                    $assoc_title = '';
                    if($title_assoc){
                        for ($t = 0, $z = count($title_assoc); $t < $z; $t++) {
                           if($title_assoc[$t]->htitle != $row->htitle) 
                           $assoc_title .= " ".$title_assoc[$t]->htitle; 
                        }
                    }
                    ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td width="20" align="center"><?php echo mosHTML::idBox($i, $row->id, 0, 'bid'); ?></td>
                        <td align = "center"><?php echo $row->id; ?></td>
                        <td align = "center"><?php echo $row->rent_from; ?></td>
                        <td align = "center"><?php echo $row->rent_until; ?></td>
                        <td align = "center"><?php echo $row->houseid; ?></td>
                        <!--<td align = "center"><?php echo $row->mls; ?></td>-->
                        <td align = "center"><?php echo $row->htitle . " ( " . $assoc_title ." ) "; ?></td>
                        <td align = "center"><?php echo $row->user_name; ?></td>
                        <td align = "center">
                            <a href=mailto:"<?php echo $row->user_email; ?>">
                                <?php echo $row->user_email; ?>
                            </a>
                        </td>
                        <td align = "center"><?php echo $row->user_mailing; ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr><td colspan = "11"><?php echo $pageNav->getListFooter(); ?></td></tr>
            </table>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="rent_requests" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>

        <?php
    }

    /**
     * Configurar informacao relativa á pagina For Sale
     * @param unknown $option
     * @param unknown $buy_requests
     * @param unknown $pageNav
     */
    static function showRequestBuyingHouses($option, $buy_requests, $pageNav) {
        global $my, $mosConfig_live_site, $mainframe,$doc;
        
        $doc = JFactory::getDocument();
       $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        
        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_SHOW . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        
        $datarent = JFactory::getDBO();
        $query = "SELECT * FROM allure_rem_for_sale";
        $datarent->setQuery($query);
        $rentrequest = $datarent->loadObjectList();
       
       $introduction = $rentrequest[0]->introduction;
       $introduction_fr = $rentrequest[0]->introduction_fr;
        ?>
        
         <!-- inputs para configurar password -->
         <form action="index.php" method="post" name="adminForm"  id="adminForm" enctype="multipart/form-data">    
            <span><?php echo "Introduction Text: "; ?></span><br><br> 
            <?php editorArea('editor1', $introduction, 'introduction', '500', '250', '70', '100'); 
            ?>
            <hr size="2" width="100%">
            <span><?php echo "Introduction Text FR: "; ?></span><br><br> 
            <?php editorArea('editor1', $introduction_fr, 'introduction_fr', '500', '250', '70', '100'); 
            ?>
      
       <!-- _REALESTATE_MANAGER_HOUSE_IMAGE_HEADER_SETTINGS not used-->
           
           <input type="hidden" name="const" value="<?php echo "not_used"; ?>"/> <!-- not needed -->
	       <input type="hidden" name="option" value="com_realestatemanager" />
	       <input type="hidden" name="section" value="for_sale" /> <!-- language_manager -->
           <input type="hidden" name="id" value="<?php echo "753"; ?>" /> <!-- FR 1618--> <!-- not needed -->
	       <input type="hidden" name="sectionid" value="com_realestatemanager" />
		   <input type="hidden" name="task" value="" />
	      </form>
        <?php
    }

    static function showHouses($option, $rows_house, & $clist, &$language, & $rentlist, & $publist, & $ownerlist, & $search, & $pageNav) {
        global $my, $mosConfig_live_site, $mainframe, $session, $doc;
        global $templateDir; // for J 1.6
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');

        $script_content = ''; // for J 1.6
        $script_content .= "function before_print_check() \n";
        $script_content .= " { \n";
        $script_content .= "  var add = document.getElementsByName('bid[]'); \n";
        $script_content .= "  var count=0;    \n";
        $script_content .= "  for(var i=0;i<add.length;i++) \n";
        $script_content .= "  { \n";
        $script_content .= "      if(add[i].checked) \n";
        $script_content .= "        { \n";
        $script_content .= "         count++; \n";
        $script_content .= "         break; \n";
        $script_content .= "       } \n";
        $script_content .= "   } \n";
        $script_content .= "  if(count == 0) \n";
        $script_content .= "    {\n";
        $script_content .= "     alert('Please choose some houses'); \n";
        $script_content .= "     exit; \n";
        $script_content .= "    } \n";
        $script_content .= "  else \n";
        $script_content .= "   {\n";
        $script_content .= "    document.adminForm.target = '_blank' ; \n";
        $script_content .= "    document.adminForm.task.value='print_houses'; \n";
        $script_content .= "    document.adminForm.submit(); \n";
        $script_content .= "  }\n";
        $script_content .= "}\n";

        $doc->addScriptDeclaration($script_content);

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_SHOW . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <form action="index.php" method="post" name="adminForm" id="adminForm" >                    
            <table cellpadding="4" class="adminlist list_04">
                <tr>
                    <td><?php echo _REALESTATE_MANAGER_SHOW_SEARCH; ?></td>
                    <td>
                        <input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onChange="document.adminForm.submit();" />
                    </td>
                    <td><?php echo $publist; ?></td>
                    <td><?php echo $rentlist; ?></td>
                    <td><?php echo $ownerlist; ?></td>
                    <td><?php echo $clist; ?></td>
                   
                  <?php //      <a href= "#"  onclick = "before_print_check();">
                          //  <img src="<?php echo $mosConfig_live_site; ?><?php // /administrator/components/com_realestatemanager/images/print.png" alt="Print" name="Print" title = "Print" align="middle" border="0" />
                       // </a> ?>
                    
                    <?php
                    if (version_compare(JVERSION, "3.0.0", "ge")) {
                        ?>
                        <td>
                            <div class="btn-group pull-right hidden-phone">
                                <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                                <?php echo $pageNav->getLimitBox(); ?>
                            </div>
                        </td>
                    <?php } ?> 
                </tr>
            </table>

			<!-- TABS PAINEL ADMINISTRACAO VILLAS -->
            <!-- TABS PAINEL ADMINISTRACAO VILLAS -->
            <!-- TABS PAINEL ADMINISTRACAO VILLAS -->
            <table cellpadding="4" class="adminlist list_05">
                <tr>
                    <th width="5%" align="center">
                        <input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this<?php // echo count( $rows_house);   ?>);" />
                    </th>
                    <!--<th width="30">#</th>-->
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                    <th align = "center" class="title" width="30%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?></th>
                    <th align = "center" class="title" width="30%" nowrap="nowrap"><?php echo "City"; ?></th> <!-- _REALESTATE_MANAGER_LABEL_ADDRESS -->
                    <th align = "center" class="title" width="30%" nowrap="nowrap"><?php echo "Region"; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA2; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA1; ?></th>
                    <th align = "center" class="title" width="16%" nowrap="nowrap"><?php echo _HEADER_PUBLISHED; ?></th>
                    
                    <!--<th align = "center" class="title" width="16%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_OWNER; ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT; ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HITS; ?></th>		
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_PUBLIC; ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_APPROVED; ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_CONTROL; ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_LANGUAGE_NAME; ?></th>-->
                </tr>
                <?php
                for ($i = 0, $n = count($rows_house); $i < $n; $i++) {
                    $row = $rows_house[$i];
                    ?>											
                    <tr class="row<?php echo $i % 2; ?>">

                        <td align="center">
                            <?php if ($row->checked_out && $row->checked_out != $my->id) {
                                ?>
                                &nbsp;
                                <?php
                            } else {
                                echo mosHTML::idBox($i, $row->id, ($row->checked_out && $row->checked_out != $my->id), 'bid');
                            }
                            ?>
                        </td>
                        <!--<td align = "center" ><?php echo $row->id; ?></td>-->
                        <td align = "center"><?php echo $row->houseid; ?></td>

                        <td align="left">
                            <?php
                            if ($row->checked_out && $row->checked_out != $my->id) {
                                echo $row->htitle . " [ <i>Checked Out</i> ]";
                            } else {
                                ?>
                                <a href="#edit" onClick="return listItemTask('cb<?php echo $i; ?>','edit')">
                                    <?php echo $row->htitle; ?>
                                </a>
                            <?php } ?>
                        </td>
                        <td align="left">
                            <?php
                            if ($row->checked_out && $row->checked_out != $my->id) {
                                echo $row->hcity . " [ <i>Checked Out</i> ]";
                            } else {
                                ?>
                                <a href="#edit" onClick="return listItemTask('cb<?php echo $i; ?>','edit')">
                                    <?php 
                                    if($row->hcity != null){
                                    	echo $row->hcity; 
                                    } else echo "";   
                                    ?>
                                </a>
                            <?php } ?>
                        </td>
                        <td align="left">
                            <?php
                            if ($row->checked_out && $row->checked_out != $my->id) {
                                echo $row->hregion . " [ <i>Checked Out</i> ]";
                            } else {
                                ?>
                                <a href="#edit" onClick="return listItemTask('cb<?php echo $i; ?>','edit')">
                                    <?php // north center lisbon alentejo algarve madeira
                                	if($row->hregion != null){
	                                    if ( $row->hregion == 'north')
	                                    	echo "North & Porto";
	                                    else if ( $row->hregion == 'center')
	                                    	echo "Center & Silver Coast";
	                                    else if ( $row->hregion == 'lisbon')
	                                    	echo "Lisbon Coast";
	                                    else if ( $row->hregion == 'alentejo')
	                                    	echo "Alentejo & Blue Coast";
	                                    else if ( $row->hregion == 'algarve')
	                                    	echo "Algarve";
	                                    else if ( $row->hregion == 'madeira') 
	                                    	echo "Madeira";
	                                    else echo ""; 
                                	} else echo ""; 
                                    ?>
                                </a>
                            <?php } ?>
                        </td>
                        <td align="center">
                            <?php
                            if($row->extra2 == "true")
                                echo "&#10004;";
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            if($row->extra1 == "true")
                                echo "&#10004;";
                            ?>
                        </td>
                        <td align = "center">
                        	<?php 
                        	if($row->published == "1")
                        		echo "&#10004;";
                        	?>
                        </td>
                        
                        <!-- / TABS PAINEL ADMINISTRACAO VILLAS -->
            			<!-- / TABS PAINEL ADMINISTRACAO VILLAS -->
            			<!-- / TABS PAINEL ADMINISTRACAO VILLAS -->
                        <?php /* ?>
                        <td align = "center"><?php echo $row->category; ?></td>
                        <td align = "center"><?php echo $row->editor; ?></td>
                        <td align = "center">
                            <?php
                            if ($row->listing_type == '1') {
                                if ($row->rent_from == null) {
                                    ?>
                                    <a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i; ?>','rent')">
                                        <img src='./components/com_realestatemanager/images/lend_f2.png' align='middle' width='15' height='15' border='0' alt='Rent out' />
                                        <br />
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i; ?>','rent_return')"> 
                                        <img src='./components/com_realestatemanager/images/lend_return_f2.png' align='middle' width='15' height='15' border='0' alt='Return house' /></a>
                                    <br />
                                    <?php ?>
                                    <?php
                                }
                            }
                            ?>
                        </td>
                        <td align = "center"><?php echo $row->hits; ?></td>
                        <?php
                        $task = $row->published ? 'unpublish' : 'publish';
                        $alt = $row->published ? 'Unpublish' : 'Publish';
                        $img = $row->published ? 'tick.png' : 'publish_x.png';
                        $task1 = $row->approved ? 'unapprove' : 'approve';
                        $alt1 = $row->approved ? 'Unapproved' : 'Approved';
                        $img1 = $row->approved ? 'tick.png' : 'publish_x.png';
                        ?>
                        <td width="5%" align="center">
                            <a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task; ?>')">
                                <?php
                                if (version_compare(JVERSION, "1.6.0", "lt")) {
                                    ?>
                                    <img src="<?php echo $mosConfig_live_site . "/administrator/images/" . $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $templateDir . "/images/admin/" . $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
                                    <?php
                                }
                                ?>
                            </a>
                        </td>
                        <td width="5%" align="center">
                            <a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task1; ?>')">
                                <?php
                                if (version_compare(JVERSION, "1.6.0", "lt")) {
                                    ?>
                                    <img src="<?php echo $mosConfig_live_site . "/administrator/images/" . $img1; ?>" width="12" height="12" border="0" alt="<?php echo $alt1; ?>" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $templateDir . "/images/admin/" . $img1; ?>" width="12" height="12" border="0" alt="<?php echo $alt1; ?>" />
                                    <?php
                                }
                                ?>
                            </a>
                        </td>

                        <?php
                        if ($row->checked_out) {
                            ?>
                            <td align="center"><?php echo $row->editor1; ?></td>
                        <?php } else {
                            ?>
                             <td align="center">&nbsp;</td>
                        <?php } ?>
                            <td align = "center"><?php echo $row->language; ?></td>
                        <?php */ ?>
                        
                    </tr>
                    <?php
                }//end for
                ?>
                <tr><td colspan = "13"><?php echo $pageNav->getListFooter(); ?></td>
                </tr>
            </table>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value= "0" />

        </form>
        <?php
    }
/**********   begin for manage reviews  *****************/
    static function showManageReviews($option, & $pageNav, & $reviews) {
        global $my, $mosConfig_live_site, $mainframe, $templateDir;

        global $doc;
        $doc = JFactory::getDocument();

        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_SHOW_REVIEW_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <form action="index.php" method="post" name="adminForm" id="adminForm" >
            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist list_06">
                <tr>
                    <th width="20" align="center">
                        <input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this);" />
                    </th>
                    <th align="center" width="30">
                        <a href="#numer" onClick="return listItemTask('cb<?php echo "1"; ?>','sorting_manage_review_numer');">#</a>
                    </th>

                    <th align="center" class="title" width="25%" nowrap="nowrap">
                        <a href="#house_location" onClick="return listItemTask('cb<?php echo "1"; ?>','sorting_manage_review_house_location');"><?php echo _REALESTATE_MANAGER_LABEL_TITLE_HOUSE; ?></a></th>

                    <th align="center" class="title" width="16%" nowrap="nowrap">
                        <a href="#title_catigory" onClick="return listItemTask('cb<?php echo "1"; ?>','sorting_manage_review_title_catigory');"><?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?></a></th>

                    <th align="center" class="title" width="25%" nowrap="nowrap">
                        <a href="#title_review" onClick="return listItemTask('cb<?php echo "1"; ?>','sorting_manage_review_title_review');"><?php echo _REALESTATE_MANAGER_LABEL_TITLE_REVIEW; ?></a></th>

                    <th align="center" class="title" width="7%" nowrap="nowrap">
                        <a href="#user_name" onClick="return listItemTask('cb<?php echo "1"; ?>','sorting_manage_review_user_name');"><?php echo _REALESTATE_MANAGER_LABEL_RENT_USER; ?></a></th>

                    <th align="center" class="title" width="8%" nowrap="nowrap">
                        <a href="#date" onClick="return listItemTask('cb<?php echo "1"; ?>','sorting_manage_review_date');"><?php echo _REALESTATE_MANAGER_REVIEW_DATE; ?></a></th>

                    <th align="center" class="title" width="7%" nowrap="nowrap">
                        <a href="#rating" onClick="return listItemTask('cb<?php echo "1"; ?>','sorting_manage_review_rating');"><?php echo _REALESTATE_MANAGER_LABEL_RATING; ?></a></th>

                    <th align="center" class="title" width="7%" nowrap="nowrap">
                        <a href="#published" onClick="return listItemTask('cb<?php echo "1"; ?>','sorting_manage_review_published');"><?php echo _REALESTATE_MANAGER_REVIEW_LABEL_PUBLISHED; ?></a></th>
                    <?php
                    if (version_compare(JVERSION, "3.0.0", "ge")) {
                        ?>
                        <td>
                            <div class="btn-group pull-right hidden-phone">
                                <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                                <?php echo $pageNav->getLimitBox(); ?>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
                <?php
                for ($i = 0; $i < count($reviews); $i++) {
                    $row = $reviews[$i];
                    ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td width="20" align="center">
                            <input type="checkbox" id="cb<?php echo $i; ?>" name="bid[]" value="<?php echo $row->review_id; ?>" onClick="Joomla.isChecked(this.checked);" />
                        </td>
                        <td align="center" width="30"><?php echo $reviews[$i]->review_id; ?></td>
                        <td align="center" width="25%"><?php echo $reviews[$i]->house_location; ?></td>
                        <td align="center" width="16%"><?php echo $reviews[$i]->title_catigory; ?></td>
                        <td align="center" width="25%">
                            <a href="#edit" onClick="return listItemTask('cb<?php echo $i; ?>','edit_manage_review');">
                                <?php
                                if (strlen($reviews[$i]->title_review) > 55) {
                                    for ($j = 0; $j < 55; $j++) {
                                        echo $reviews[$i]->title_review[$j];
                                    }
                                } else {
                                    echo $reviews[$i]->title_review;
                                }
                                ?>
                            </a>
                        </td>
                        <td align="center" width="7%"><?php echo $reviews[$i]->user_name; ?></td>
                        <td align="center" width="8%"><?php echo $reviews[$i]->date; ?></td>
                        <td align="center" width="7%">
                            <div><img src="../components/com_realestatemanager/images/rating-<?php echo $reviews[$i]->rating; ?>.png" alt="<?php echo ($reviews[$i]->rating) / 2; ?>" border="0" align="right"/>&nbsp;</div>
                        </td>
                        <td align="center" width="7%">
                            <?php
                            $task = $reviews[$i]->published ? 'unpublish_manage_review' : 'publish_manage_review';
                            $alt = $reviews[$i]->published ? 'Unpublish' : 'Publish';
                            $img = $reviews[$i]->published ? 'tick.png' : 'publish_x.png';
                            ?>
                            <a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task; ?>')">
                                <?php
                                if (version_compare(JVERSION, "1.6.0", "lt")) {
                                    ?>
                                    <img src="<?php echo $mosConfig_live_site . "/administrator/images/" . $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $templateDir . "/images/admin/" . $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
                                    <?php
                                }
                                ?>
                            </a>

                        </td>
                    </tr>
                    <?php
                }//end for(...)
                ?>
                <tr><td colspan = "11"><?php echo $pageNav->getListFooter(); ?></td></tr>
            </table>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="manage_review" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>

        <?php
    }

//*****************   end for manage reviews   ****************************************
    
//***************   begin add for button print in Manager Houses   ********************
    static function showPrintHouses($rows) {
        global $my, $mosConfig_live_site, $mainframe, $doc;
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        global $mosConfig_live_site;
        ?>
        <html>
            <head>
                <title>
                </title>
            </head>
            <body>
                <form name="Print" action="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_realestatemanager&task=print_item" method="post" target="_top">
                    <div align="left">
                        <?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT_FONT_SIZE; ?>:
                        <select name="font_size" title="Select size font!">
                            <option value="1">1
                            <option value="2">2
                            <option value="3">3
                            <option value="4">4
                            <option value="5">5
                            <option value="6">6
                            <option value="7">7
                            <option value="8" selected >8
                            <option value="9">9
                            <option value="10">10
                            <option value="11">11
                            <option value="12">12
                            <option value="13">13
                            <option value="14">14
                            <option value="15">15
                            <option value="16">16
                            <option value="17">17
                            <option value="18">18
                        </select>
                        <br /><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT_FORMAT; ?>:<br />
                        <input type="hidden" name="format_w_h" value="verticall" title="Checked format!" checked />

                        <select name="format" title="Select size font!">
                            <option value="A5">A5&nbsp;(148x210&nbsp;mm)
                            <option value="A4" selected >A4&nbsp;(210x297&nbsp;mm)
                            <option value="A3">A3&nbsp;(297x420&nbsp;mm)
                            <option value="Letter">Letter&nbsp;(8,5x11&nbsp;inch)
                            <option value="Legal">Legal&nbsp;(8,5x14&nbsp;inch)
                            <option value="Tabloid">Tabloid&nbsp;(11x17&nbsp;inch)
                            <option value="Executive">Executive&nbsp;(7,5x10&nbsp;inch)
                        </select>
                        <p>
                            <?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT_SELECT; ?>
                            <br />
                            <input type="submit" value="Next" title="Next step for print!"/>
                        </p>
                    </div>

                    <table cellpadding="4" cellspacing="0" border="1px" style="width:180mm" class="adminlist list_07">
                        <tr bgcolor="#d0d0d0">
                            <td width="5%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_id" value="1" title="Select for print!" checked />
                            </td>
                            <td width="5%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_houseid" value="1" title="Select for print!" checked />
                            </td>
                            <td width="20%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_title" value="1" title="Select for print!" checked />
                            </td>
                            <td width="10%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_category" value="1" title="Select for print!" checked />
                            </td>
                            <td width="10%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_rent_from" value="1" title="Select for print!" checked/>
                            </td>
                            <td width="10%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_rent_until" value="1" title="Select for print!" checked/>
                            </td>
                            <td width="10%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_user_name" value="1" title="Select for print!" checked />
                            </td>
                            <td width="10%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_user_email" value="1" title="Select for print!" checked/>
                            </td>
                            <td width="10%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_user_mailing" value="1" title="Select for print!" checked />
                            </td>
                            <td width="5%" nowrap="nowrap" align="center"><?php echo _REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT; ?>
                                <input type="checkbox" name="print_hits" value="1" title="Select for print!" checked />
                            </td>
                        </tr>
                        <tr bgcolor="#d0d0d0">
                            <th width="5%">#</th>
                            <th width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                            <th width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?></th>
                            <th width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?></th>
                            <th width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM; ?></th>
                            <th width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL; ?></th>
                            <th width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_USER; ?></th>
                            <th width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_EMAIL; ?></th>
                            <th width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_ADRES; ?></th>
                            <th width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HITS; ?></th>
                        </tr>

                        <?php for ($i = 0; $i < count($rows); $i++) { ?>
                            <tr bgcolor="#<?php
                if (($i % 2) != 1) {
                    echo "efefef";
                } else {
                    echo "ffffff";
                }
                            ?>" >
                                <td width="5%"><?php echo wordwrap($rows[$i]->id, 6, "<br />\n", 1); ?></td>
                                <td width="5%" nowrap="nowrap"><?php echo wordwrap($rows[$i]->houseid, 6, "<br />\n", 1); ?></td>
                                <td width="20%" nowrap="nowrap"><?php echo wordwrap($rows[$i]->hlocation, 20, "<br />\n", 1); ?></td>
                                <td width="10%" nowrap="nowrap"><?php echo wordwrap($rows[$i]->category, 10, "<br />\n", 1); ?></td>
                                <td width="10%" nowrap="nowrap">
                                    <?php
                                    if (isset($rows[$i]->rent_from)) {
                                        for ($j = 0; $j < 10; $j++) {
                                            echo $rows[$i]->rent_from[$j];
                                        }
                                    } else {
                                        echo "--";
                                    }
                                    ?>
                                </td>
                                <td width="10%" nowrap="nowrap">
                                    <?php
                                    if (isset($rows[$i]->rent_until)) {
                                        for ($j = 0; $j < 10; $j++) {
                                            echo $rows[$i]->rent_until[$j];
                                        }
                                    } else {
                                        echo "--";
                                    }
                                    ?>
                                </td>
                                <td width="10%" nowrap="nowrap">
                                    <?php
                                    if (isset($rows[$i]->user_name) && ($rows[$i]->user_name != "")) {
                                        echo wordwrap($rows[$i]->user_name, 10, "<br />\n", 1);
                                    } else {
                                        echo "--";
                                    }
                                    ?>
                                </td>
                                <td width="10%" nowrap="nowrap">
                                    <?php
                                    if (isset($rows[$i]->user_email) && ($rows[$i]->user_email != "")) {
                                        echo wordwrap($rows[$i]->user_email, 10, "<br />\n", 1);
                                    } else {
                                        echo "--";
                                    }
                                    ?>
                                </td>
                                <td width="10%" nowrap="nowrap">
                                    <?php
                                    if (isset($rows[$i]->user_mailing) && ($rows[$i]->user_mailing != "")) {
                                        echo wordwrap($rows[$i]->user_mailing, 10, "<br />\n", 1);
                                    } else {
                                        echo "--";
                                    }
                                    ?>
                                </td>
                                <td width="5%" nowrap="nowrap"><?php echo wordwrap($rows[$i]->hits, 6, "<br />\n", 1); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </form>
            </body>
        </html>
        <?php
        @ session_start();
        $_SESSION['rows'] = $rows;
        exit();
    }

//end showPrintHouses($rows)
//*********************************************************************************

    static function showPrintItem($rows) {
        global $my, $mosConfig_live_site, $mainframe, $doc;
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        ?>
        <html> 
            <head>  
                <title>
                </title>
                <style type="text/css">
                    .print_font_nik {
                        background-color: #ffffff;
                        font-size: <?php echo $_REQUEST['font_size']; ?>pt;
                        color: #000000;
                        font-family: Arial, Times, Helvetica, Zapf-Chancery, Western, Courier;
                    }
                </style>
                <script language="JavaScript" type="text/javascript">
                    function print_item_no_button() {
                        var el  = document.getElementById('print_button_off'); 
                        el.style.display = 'none';  
                        window.print();
                    }
                </script>
            </head>
            <body>
                <div align="left" id="print_button_off">
                    <p align="left">
                        <a href="#" onClick="javascript:print_item_no_button();" title="Print">
                            <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_realestatemanager/images/print.png"  alt="Print" name="Print" align="center" border="0" />
                        </a>
                    </p>
                </div>
                <?php
                $kol = 0;
                if (isset($_REQUEST['print_id']))
                    $kol++;
                if (isset($_REQUEST['print_houseid']))
                    $kol++;
                if (isset($_REQUEST['print_title']))
                    $kol++;
                if (isset($_REQUEST['print_category']))
                    $kol++;
                if (isset($_REQUEST['print_rent_from']))
                    $kol++;
                if (isset($_REQUEST['print_rent_until']))
                    $kol++;
                if (isset($_REQUEST['print_user_name']))
                    $kol++;
                if (isset($_REQUEST['print_user_email']))
                    $kol++;
                if (isset($_REQUEST['print_user_mailing']))
                    $kol++;
                if (isset($_REQUEST['print_hits']))
                    $kol++;

                if (($kol < 11) && (isset($_REQUEST['print_title']) == 0) && ($kol != 0))
                    $k = (int) (100 / $kol);
                if (($kol < 11) && (isset($_REQUEST['print_title'])) && ($kol != 0)) {
                    $k = (int) (100 / $kol);
                    if ($kol == 10) {
                        $k_tit = $k + 9;
                        $k -= 1;
                    }
                    if ($kol == 9) {
                        $k_tit = $k + 8;
                        $k -= 1;
                    }
                    if ($kol == 8) {
                        $k_tit = $k + 15;
                        $k -= 2;
                    }
                    if ($kol == 7) {
                        $k_tit = $k + 16;
                        $k -= 3;
                    }
                    if ($kol == 6) {
                        $k_tit = $k + 20;
                        $k -= 4;
                    }
                    if ($kol == 5) {
                        $k_tit = $k + 20;
                        $k -= 5;
                    }
                    if ($kol == 4) {
                        $k_tit = $k + 15;
                        $k -= 5;
                    }
                    if ($kol == 3) {
                        $k_tit = $k + 10;
                        $k -= 5;
                    }
                    if ($kol == 2) {
                        $k_tit = $k;
                    }
                }//end if

                if ($kol != 0) {
                    if (($_REQUEST['format_w_h'] == 'verticall') && ($_REQUEST['format'] == 'A5')) {
                        $width_tabl = 118;
                    }//138;}
                    if (($_REQUEST['format_w_h'] == 'verticall') && ($_REQUEST['format'] == 'A4')) {
                        $width_tabl = 180;
                    }//200;}
                    if (($_REQUEST['format_w_h'] == 'verticall') && ($_REQUEST['format'] == 'A3')) {
                        $width_tabl = 267;
                    }//287;}
                    if (($_REQUEST['format_w_h'] == 'verticall') && ($_REQUEST['format'] == 'Letter')) {
                        $width_tabl = 185;
                    }//205;}
                    if (($_REQUEST['format_w_h'] == 'verticall') && ($_REQUEST['format'] == 'Legal')) {
                        $width_tabl = 185;
                    }//205;}
                    if (($_REQUEST['format_w_h'] == 'verticall') && ($_REQUEST['format'] == 'Tabloid')) {
                        $width_tabl = 249;
                    }//269;}
                    if (($_REQUEST['format_w_h'] == 'verticall') && ($_REQUEST['format'] == 'Executive')) {
                        $width_tabl = 160;
                    }//180;}

                    if (($_REQUEST['format_w_h'] == 'horizontall') && ($_REQUEST['format'] == 'A5')) {
                        $width_tabl = 200;
                    }
                    if (($_REQUEST['format_w_h'] == 'horizontall') && ($_REQUEST['format'] == 'A4')) {
                        $width_tabl = 287;
                    }
                    if (($_REQUEST['format_w_h'] == 'horizontall') && ($_REQUEST['format'] == 'A3')) {
                        $width_tabl = 410;
                    }
                    if (($_REQUEST['format_w_h'] == 'horizontall') && ($_REQUEST['format'] == 'Letter')) {
                        $width_tabl = 269;
                    }
                    if (($_REQUEST['format_w_h'] == 'horizontall') && ($_REQUEST['format'] == 'Legal')) {
                        $width_tabl = 343;
                    }
                    if (($_REQUEST['format_w_h'] == 'horizontall') && ($_REQUEST['format'] == 'Tabloid')) {
                        $width_tabl = 421;
                    }
                    if (($_REQUEST['format_w_h'] == 'horizontall') && ($_REQUEST['format'] == 'Executive')) {
                        $width_tabl = 244;
                    }
                    ?>
                    <table cellpadding="4" cellspacing="0" border="1px" style="width:<?php echo $width_tabl; ?>mm" class="print_font_nik">
                        <tr bgcolor="#d0d0d0">
                            <?php if (isset($_REQUEST['print_id'])) {
                                ?>
                                <th width="<?php
                if (isset($k)) {
                    echo $k . "%";
                } else {
                    echo "5%";
                }
                                ?>">#</th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_houseid'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "5%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_title'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k_tit)) {
                        echo $k_tit . "%";
                    } else if (($kol == 1) && (isset($_REQUEST['print_title']))) {
                        echo "100%";
                    } else {
                        echo "20%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?></th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_category'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?></th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_rent_from'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM; ?></th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_rent_until'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL; ?></th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_user_name'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_USER; ?></th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_user_email'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_EMAIL; ?></th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_user_mailing'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_ADRES; ?></th>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_hits'])) {
                                    ?>
                                <th width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "5%";
                    }
                                    ?>" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HITS; ?></th>
                                <?php } ?>
                        </tr>
                        <?php for ($i = 0; $i < count($rows); $i++) {
                            ?>
                            <tr bgcolor="#<?php
                if (($i % 2) != 1) {
                    echo "efefef";
                } else {
                    echo "ffffff";
                }
                            ?>" >
                                    <?php if (isset($_REQUEST['print_id'])) {
                                        ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "5%";
                    }
                                        ?>">
                                            <?php
                                            if (isset($k)) {
                                                $symbol = $k;
                                            } else {
                                                $symbol = 6;
                                            } echo wordwrap($rows[$i]->id, $symbol, "<br />\n", 1);
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_houseid'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "5%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($k)) {
                                                $symbol = $k;
                                            } else {
                                                $symbol = 6;
                                            } echo wordwrap($rows[$i]->houseid, $symbol, "<br />\n", 1);
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_title'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k_tit)) {
                        echo $k_tit . "%";
                    } else if (($kol == 1) && (isset($_REQUEST['print_title']))) {
                        echo "100%";
                    } else {
                        echo "20%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($k_tit)) {
                                                $symbol = $k_tit;
                                            } else if (($kol == 1) && (isset($_REQUEST['print_title']))) {
                                                $symbol = $k;
                                            } else {
                                                $symbol = 20;
                                            }
                                            echo wordwrap($rows[$i]->hlocation, $symbol, "<br />\n", 1);
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_category'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($k)) {
                                                $symbol = $k;
                                            } else {
                                                $symbol = 10;
                                            } echo wordwrap($rows[$i]->category, $symbol, "<br />\n", 1);
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_rent_from'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($rows[$i]->rent_from)) {
                                                for ($j = 0; $j < 10; $j++) {
                                                    echo $rows[$i]->rent_from[$j];
                                                }
                                            } else {
                                                echo "--";
                                            }
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_rent_until'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($rows[$i]->rent_until)) {
                                                for ($j = 0; $j < 10; $j++) {
                                                    echo $rows[$i]->rent_until[$j];
                                                }
                                            } else {
                                                echo "--";
                                            }
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_user_name'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($rows[$i]->user_name) && ($rows[$i]->user_name != "")) {
                                                if (isset($k)) {
                                                    $symbol = $k;
                                                } else {
                                                    $symbol = 10;
                                                }
                                                echo wordwrap($rows[$i]->user_name, $symbol, "<br />\n", 1);
                                            } else {
                                                echo "--";
                                            }
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_user_email'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($rows[$i]->user_email) && ($rows[$i]->user_email != "")) {
                                                if (isset($k)) {
                                                    $symbol = $k;
                                                } else {
                                                    $symbol = 10;
                                                }
                                                echo wordwrap($rows[$i]->user_email, $symbol, "<br />\n", 1);
                                            } else {
                                                echo "--";
                                            }
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_user_mailing'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "10%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($rows[$i]->user_mailing) && ($rows[$i]->user_mailing != "")) {
                                                if (isset($k)) {
                                                    $symbol = $k;
                                                } else {
                                                    $symbol = 10;
                                                }
                                                echo wordwrap($rows[$i]->user_mailing, $symbol, "<br />\n", 1);
                                            } else {
                                                echo "--";
                                            }
                                            ?>
                                    </td>
                                <?php } ?>
                                <?php if (isset($_REQUEST['print_hits'])) {
                                    ?>
                                    <td width="<?php
                    if (isset($k)) {
                        echo $k . "%";
                    } else {
                        echo "5%";
                    }
                                    ?>" nowrap="nowrap">
                                            <?php
                                            if (isset($k)) {
                                                $symbol = $k;
                                            } else {
                                                $symbol = 6;
                                            } echo wordwrap($rows[$i]->hits, $symbol, "<br />\n", 1);
                                            ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php }/* end for */ ?>

                    </table>
                    <?php
                }//end if($kol != 0)
                ?>

                </br>
                <!--<?php echo $mosConfig_live_site; ?>/administrator/index2.php?option=com_realestatemanager# -->
                <form name="back_print" action="javascript:history.back()" method="post" target="_top">
                    <input type="submit" value="Back" title="Select other items for printing" />
                </form>

            </body>
        </html>
        <?php
        exit();
    }

//end function showPrintItem()
//*************************************************************************************************
//********************   end add for button print in Manager Houses   *****************************
//*************************************************************************************************

    /**
     * Writes the edit form for new and existing records
     *
     */
    static function editHouse($option, & $row, & $clist, & $rating, & $delete_edoc, & $reviews, & $test_list, & $listing_status_list, & $property_type_list, & $listing_type_list, & $provider_class_list, & $zoning_list, & $style_list, & $house_photo, & $house_photos, & $house_rent_sal, & $house_feature, & $currency, & $languages, & $extra_list, $currency_spacial_price, $associateArray) {

        global $realestatemanager_configuration, $database;
        global $my, $mosConfig_live_site, $mainframe, $doc;
        
        $is_admin = in_array(7,$my->groups);

        //echo "-------------->".$row->published; 

        if($realestatemanager_configuration['special_price']['show']){
            $switchTranslateDayNight = _REALESTATE_MANAGER_RENT_SPECIAL_PRICE_PER_DAY;       
        }else{
            $switchTranslateDayNight = _REALESTATE_MANAGER_RENT_SPECIAL_PRICE_PER_NIGHT;    
        }
        
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_SHOW . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        
        ?>
        <style>
            #sortable1, #sortable2 {
                border: 1px solid #eee;
                width: 100%;
                min-height: 20px;
                list-style-type: none;
                margin: 0;
                padding: 5px 0 0 0;
                float: left;
                margin-right: 10px;
              }
              #sortable1 li, #sortable2 li {
                margin: 0 5px 5px 5px;
                padding: 5px;
                font-size: 1.2em;
                width: 150px;
                display: inline;
              }
            
        </style>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script language="javascript" type="text/javascript">

            function trim(string){
                return string.replace(/(^\s+)|(\s+$)/g, "");
            }
            Joomla.submitbutton = function(pressbutton) {

                var form = document.adminForm;

                if (pressbutton == 'save' || pressbutton == 'apply') {
                    if (trim(form.houseid.value) == '') {

                        alert( "<?php echo _REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_HOUSEID_CHECK; ?>" );
                        return;
                    } else if (form.catid.value == 0) {
                        alert( "<?php echo _REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_CATEGORY; ?>");
                        return;
                    } else if (form.htitle.value == '') {
                        alert( "<?php echo _REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_TITLE; ?>");
                        return;
                    } else {
                        submitform( pressbutton );
                    }
                } else {
                    submitform( pressbutton );
                }
            }
            var photos=0;
            function new_photos(){
                div=document.getElementById("items");
                button=document.getElementById("add");
                photos++;
                newitem="<strong>" + "<?php echo _REALESTATE_MANAGER_ADMIN_NEW_PHOTO ?>" + photos + ": </strong>";
                newitem+="<input type=\"file\" multiple='true' name=\"new_photo_file[]";
                newitem+="\" value=\"\"size=\"45\"><br>";
                newnode=document.createElement("span");
                newnode.innerHTML=newitem;
                div.appendChild(newnode);
            }
        </script>
        <form action="index.php" method="post" name="adminForm" id="adminForm"  enctype="multipart/form-data">
            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                $options = array(
                    'onActive' => 'function(title, description){
                    description.setStyle("display", "block");
                    //description_fr.setStyle("display", "block");
                    title.addClass("open").removeClass("closed");
                    vm_initialize();
                    
                }',
                    'onBackground' => 'function(title, description){
                    description.setStyle("display", "none");
                    //description_fr.setStyle("display", "none");
                    title.addClass("closed").removeClass("open");
                }',
                    'startOffset' => 0, // 0 starts on the first tab, 1 starts the second, etc...
                    'useCookie' => true, // this must not be a string. Don't use quotes.
                );
                echo JHtml::_('tabs.start', 'addHouse', $options);
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_HOUSE_TAB_GENERAL_INFO), 'panel_1_addHouse');
            } else {
                $tabs = new mosTabs(3);
                $tabs->startPane("addHouse");
                $tabs->startTab('<a href="javascript:rem_initialize();">' . _REALESTATE_MANAGER_ADMIN_HOUSE_TAB_GENERAL_INFO . '</a>', "addHouse");
            }
            ?>
             
            <table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform form_10">
                <input type="hidden" name="catid[]" id="catid" value="46" />
                <input type="hidden" name="listing_type" id="listing_type" value="1"/>
                <tr>
                    <td colspan="2"><h2><?php echo _REALESTATE_MANAGER_HEADER_REQUIREMENT_FIELDS; ?></h2></td>
                </tr>
                <!--<tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_CATEGORY; ?>:</td>
                    <td align="left"><?php echo $clist; ?></td>
                </tr>-->
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="htitle" size="80" value="<?php echo $row->htitle; ?>" /></td>
                </tr>
                <tr>
                    <td width="15%"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?>:</td>
                    <td width="85%" align="left">
                        <input class="inputbox" type="text" name="houseid" size="20" maxlength="20" value="<?php echo $row->houseid; ?>" />
                        <input type="hidden" name="idtrue" id="idtrue" value="<?php echo $row->id_true; ?>"/>
                    </td>
                </tr>
<?php
/*********************************************************************************************/
    
    if(!empty($associateArray) && !empty($row->language) && $row->language != '' && $row->language != '*'){
//        print_r($associateArray); exit;
?>
                <tr> 
                    <td width="15%"><?php echo 'language associate houses' ?>:</td>                        
                </tr>   
            
<?php
        $j =1;
        foreach ($associateArray as $lang=>$value) {
            $displ = '';
            if(!$value['list']){
                $displ = 'none';
            }
?>    
                <tr style="display: <?php echo $displ?>">
                    <td width="15%"><?php echo $lang; ?>:</td>
                    <td width="60%"><?php echo $value['list']; ?> 
                    <input class="inputbox" id="associate_house" type="text" name="associate_house<?php echo $j;?>" size="20" readonly="readonly" maxlength="20" style="width:25px; margin-bottom: -4px;" value="<?php echo $value['assocId']; ?>" />
                    <input style="display: none" name="associate_house_lang<?php echo $j;?>" value="<?php echo $lang ?>"/>  
                    </td>                          
                </tr>
<?php
        
        $j++;
        }
   }else{
?>
               <!--
               hide languages
               <tr> 
                    <td width="15%"><?php echo 'language associate houses' ?>:</td> 
                    <td width="60%"><?php echo 'this property only for hoses with language' ?> 
                </tr>
                -->
<?php
   }
/*********************************************************************************************/
?>     
         
                <?php if($is_admin) { ?>
                <tr>
                    <td width="15%"><?php echo _REALESTATE_MANAGER_LABEL_LANGUAGE; ?>:</td>
                    <td width="85%" align="left"><?php echo $languages; ?></td>
                </tr>
                
                <?php } ?>
                <!--end Roman editions
                
                <tr>
                    <td colspan="2"><h2><?php echo _REALESTATE_MANAGER_HEADER_RECOMMENDED_FIELDS; ?></h2></td>
                </tr>
                -->
                <!--<tr>
                    <?php
                    if(!$is_admin){
                        $listing_type_list =str_replace("<select", "<select disabled='disabled'", $listing_type_list);
                        $listing_type_list =str_replace("listing_type", "listing_type_disabled", $listing_type_list);
                        $listing_type_list .= "<input type=\"hidden\" name=\"listing_type\" id=\"listing_type\" value=\"1\"/>"; 
                    }
                    ?>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_LISTING_TYPE; ?>:</td>
                    <td align="left"><?php echo $listing_type_list; ?></td>
                </tr>-->
        
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_BATHROOMS; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="bathrooms" size="10" value="<?php echo $row->bathrooms; ?>" /></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_BEDROOMS; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="bedrooms" size="10" value="<?php echo $row->bedrooms; ?>" /></td>
                </tr>
                <tr>
                	<!-- N PESSOAS -->
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_BROKER; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="broker" size="40" value="<?php echo $row->broker; 
                    
                    if($row->broker == 0){
                    	$row->broker = 1;
                    }
                    ?>" /></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_PROVIDER_CLASS; ?>:</td>
                    <td align="left"><?php echo $provider_class_list; ?>	</td>
                </tr>
                
                <!-- Checkin, Check out-->
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA7; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="extra7" id="extra7" value="<?php echo $row->extra7; ?>" /></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA8; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="extra8" id="extra8" value="<?php echo $row->extra8; ?>" /></td>
                 </tr>
                
                 <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_PRICE; ?> Low Season:</td>
                    <td align="left">
                        <input type="text" name="price_low_season" value="<?php echo $row->price_low_season; ?>" />
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_PRICE; ?> High Season:</td>
                    <td align="left">
                        <input type="text" name="price_high_season" value="<?php echo $row->price_high_season; ?>"/>
                    </td>
                </tr>
                
                
                <?php if($is_admin) { ?>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_CONTACTS; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="contacts" size="40" value="<?php echo $row->contacts; ?>"   /></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_LISTING_STATUS; ?>:</td>
                        <td align="left"><?php echo $listing_status_list; ?></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TYPE; ?>:</td>
                        <td align="left"><?php echo $property_type_list; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"><hr size="2" width="100%" /></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_COMMENT; ?>:</td>
                    <td align="left">
                        <?php editorArea('editor1', $row->description, 'description', 500, 250, '70', '10'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_COMMENT; ?> FR:</td>
                    <td align="left">
                        <?php editorArea('editor2', $row->description_fr, 'description_fr', 500, 250, '70', '10'); ?>
                    </td>
                </tr>
               
               <tr>
                    <td valign="top">Extra Info:</td>
                    <td align="left">
                        <?php editorArea('editor3', $row->availability_tab_info, 'availability_tab_info', 500, 250, '70', '10'); ?>
                    </td>
                </tr>
               
               <tr>
                    <td valign="top">Extra Info FR:</td>
                    <td align="left">
                        <?php editorArea('editor4', $row->availability_tab_info_fr, 'availability_tab_info_fr', 500, 250, '70', '10'); ?>
                    </td>
                </tr>
               
                <tr>
                    <td colspan="2"><hr size="2" width="100%" /></td>
                </tr>
                <tr>
                    <td colspan="2"><h2>Facilities</h2>	</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php
                        for ($i = 0; $i < count($house_feature); $i++) {
                            if ($i != 0) {
                                if ($house_feature[$i]->categories !== $house_feature[$i - 1]->categories)
                                    echo "<span class='house_categories'>" . $house_feature[$i]->categories . "</span>";
                            } else
                                echo "<span class='house_categories'>" . $house_feature[$i]->categories . "</span>";
                            ?>         
                            <div class="checkbox_rel">
                                <input type="checkbox" <?php if ($house_feature[$i]->check) echo "checked"; ?> name="ffeature[]" value="<?php echo $house_feature[$i]->id; ?>" />
                                <label class="house_feature"><?php echo $house_feature[$i]->name; ?></label>
                            </div>
                            <?php if ($house_feature[$i]->image_link != '') {
                                ?>       
                                <img alt="photo" src="<?php echo "$mosConfig_live_site/components/com_realestatemanager/featured_ico/" . $house_feature[$i]->image_link; ?>" />      
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
                <?php
                $month = date("m", mktime(0, 0, 0, date('m'), 1, date('Y')));
                $year = date("Y", mktime(0, 0, 0, date('m'), 1, date('Y')));
                $placeholder = $realestatemanager_configuration['calendar']['placeholder'];
                ?>

                <tr>
                <script language="javascript" type="text/javascript">
                   /*
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
                             
                    
                        window.addEvent('domready', function() {
                        $('subPrice').addEvent('click', function(event) {
                            var rent_from = $('price_from').get('value');
                            var rent_to = $('price_to').get('value');
                            var special_price = $('special_price').get('value');
                            var comment_price = $('comment_price').get('value');
                            var currency_spacial_price = $('currency_spacial_price').get('value');                            
                            var req = new Request.HTML({
                            method: 'post',
                            url: "index.php?option=com_realestatemanager&task=ajax_rent_price&bid=<?php 
                                    echo $row->id;?>&rent_from="+rent_from+"&rent_until="+rent_to+
                                    "&special_price="+special_price+"&comment_price="+comment_price+
                                    "&currency_spacial_price="+currency_spacial_price,
                            data: { 'do' : '1' },
                            update: $('SpecialPriseBlock'),
                            onComplete: function(response) { }
                            }).send();
                        });
                   });
                    */
                </script>

            </table>
            <?php if($is_admin) { ?>
                <h2><?php echo $switchTranslateDayNight;  ?></h2>
                                    <p>
                    <div id ='SpecialPriseBlock'>
                        <table class="adminlist adminlist_04">
                            <tr>
                                <th class="title" width ="35%"><?php echo _REALESTATE_MANAGER_LABEL_CALENDAR_SELECT_DELETE; ?></th>
                                <th class="title" ><?php echo _REALESTATE_MANAGER_FROM; ?></th>
                                <th class="title" ><?php echo _REALESTATE_MANAGER_TO; ?></th>
                                <th class="title" ><?php echo $switchTranslateDayNight; ?></th>
                                <th class="title" ><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_COMMENT; ?></th>
                            </tr>
                                                <?php
                                                
                    for ($i = 0; $i < count($house_rent_sal); $i++) {
                        
                        ?>
                                    <tr>
                                        <td align ='center'><input type="checkbox" name="del_rent_sal[]" value="<?php echo $house_rent_sal[$i]->id; ?>" /></td>
                                        <td align ='center'><?php echo $house_rent_sal[$i]->price_from; ?></td>
                                        <td align ='center'><?php echo $house_rent_sal[$i]->price_to; ?></td>
                                        <td align ='center'><?php echo $house_rent_sal[$i]->special_price. ' '.$house_rent_sal[$i]->priceunit; ?></td>
                                        <td><?php echo $house_rent_sal[$i]->comment_price; ?></td>                                        
                                    </tr>
                    <?php } ?>  
                        </table>
                        <p>
                        <div id ="message-here" style ='color: red; font-size: 18px;' ></div>
                        <p>                      
                    </div>                                                     
                
                    <span class="col_02">
                    <p>
			<?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_FROM; ?>:<br />
			<?php echo JHtml::_('calendar', date("Y-m-d"), 'price_from', 'price_from', $realestatemanager_configuration['date_format']); ?>
                    </p>
                    <p>
                        
		      <?php echo _REALESTATE_MANAGER_LABEL_RENT_REQUEST_UNTIL; ?>:<br />
		      <?php //echo JHtml::_('calendar', date("Y-m-d"), 'rent_until', 'rent_until', $realestatemanager_configuration['date_format'],'onchange="vm_rent_request_cout_day(this.value);"'); ?>
                      <?php echo JHtml::_('calendar', date("Y-m-d"), 'price_to', 'price_to', $realestatemanager_configuration['date_format']); ?> 
                        
                    </p>
                    <p><?php echo _REALESTATE_MANAGER_LABEL_PRICE; ?><br/>
                    <input id="special_price" class="inputbox price" type="text" name="special_price" size="15" value="" />
                    <?php echo $currency_spacial_price; ?>
                    </p>
                    <p><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_COMMENT;?>
                    <br /><textarea id="comment_price" rows="5" cols="25" name="comment_price"></textarea></p><br />
                    <p>
                    <input id="subPrice" class="inputbox" type="button" name="new_price" value="<?php echo _REALESTATE_MANAGER_RENT_ADD_SPECIAL_PRICE; ?>"/>
                    </p>
                    </span>
                <?php } //if is_admin ?>
                <!--**********************************   begin change review   ***********************-->
                <?php
                //
                // Tabela Reviews
                //
                if ($reviews > false) /* show, if review exist */ {
                    ?>
                    <tr>
                        <td colspan="7">
                            <hr width="100%" size="2" align="left"> <h2><?php echo _REALESTATE_MANAGER_LABEL_REVIEWS; ?>:</h2> 
                        </td>
                    </tr>
                    <table class="adminlist list_09">
                        <tr class="row0">
                            <td width="3%" valign="top" align="center"><div>#</div></td>
                            <td width="2%" valign="top" align="center"><div></div></td>
                            <td width="10%" valign="top" align="center"><b><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_TITLE; ?></b></td>
                            <td width="4%" valign="top" align="center"><b><?php echo "Published"; ?></b></td>
                            <td width="55%" valign="top" align="center"><b><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_COMMENT; ?></b></td>
                            <td width="20%" valign="top" align="center"><b><?php echo _REALESTATE_MANAGER_REVIEW_DATE; ?></b></td>
                            <td width="5%" valign="top" align="center"><b><?php echo _REALESTATE_MANAGER_LABEL_REVIEW_RATING; ?></b></td>
                        </tr>
                        <?php for ($i = 0, $nn = 1; $i < count($reviews); $i++, $nn++) /* if not one comment */ {
                            ?>
                            <tr class="row0">
                                <td valign="top" align="center"><div><?php echo $nn; ?></div></td>
                                <td valign="top" align="center"><div><?php echo "<input type='radio' id='cb" . $i . "' name='bid[]' value='" . $row->id . "," . $reviews[$i]->id . "' onClick='Joomla.isChecked(this.checked);' />"; ?></div></td>
                                <td valign="top" align="center"><div><?php print_r($reviews[$i]->title); ?></div></td>
                                <td valign="top" align="center"><div>
                                
                                <?php 
                                
                                if($reviews[$i]->published == 0)
                                	echo "&#10004;";
                                else echo "";
                                //print_r($reviews[$i]->published); 
                                ?>
                                
                                
                                </div></td>
                                <td valign="top" align="left"><div><?php print_r(strip_tags($reviews[$i]->comment)); ?></div></td>
                                <td valign="top" align="center"><div><?php print_r($reviews[$i]->date); ?></div></td>
                                <td valign="top" align="left"><div><img src="../components/com_realestatemanager/images/rating-<?php echo $reviews[$i]->rating; ?>.png" alt="<?php echo ($reviews[$i]->rating) / 2; ?>" border="0" align="right"/>&nbsp;</div></td>
                            </tr>
                        <?php }/* end for(...) */ ?>
                    </table>
                <?php }/* end if(...) */ ?>
            </table>

            <!-- _________________________________________________________________- -->
            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_HOUSE_TAB_ADDITIONAL_INFO), 'panel_2_addHouse');
            } else {
                $tabs->endTab();
                $tabs->startTab('<a href="javascript:rem_initialize();">' . _REALESTATE_MANAGER_ADMIN_HOUSE_TAB_ADDITIONAL_INFO . '</a>', "addHouse");
            }
            ?>
            <input class="inputbox" type="hidden" name="extra1" id="extra1" value="<?php echo $row->extra1; ?>" />
            <input class="inputbox" type="hidden" name="extra2" id="extra2" value="<?php echo $row->extra2; ?>" />
            <input class="inputbox" type="hidden" name="extra6" id="extra6" value="<?php echo $row->extra6; ?>" />
            <script>
                function updateForRentInput() {
                    if (document.getElementById('forRentAuxField').checked == true) {
                        document.getElementById('extra1').value = "true";
                        document.getElementById('ForRentDependent').style.display = "block";
                    } else {
                        document.getElementById('extra1').value = "false";
                        document.getElementById('ForRentDependent').style.display = "none";
                    }
                }

				function updateVideosInput() {
                    if (document.getElementById('videosField').checked == true) {
                        document.getElementById('extra6').value = "true";
                    } else {
                        document.getElementById('extra6').value = "false";
                    }
                }
                
                function updateBestOfInput() {
                    if (document.getElementById('bestOfAuxField').checked == true) {
                        document.getElementById('extra2').value = "true";
                    } else {
                        document.getElementById('extra2').value = "false";
                    }
                }
                
            </script>
            <table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform form_11">
                <?php //if($is_admin) { ?>
                        <tr>
                            <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA2; ?>:</td>
                            <td align="left"><input type="checkbox" class="inputbox" onclick="updateBestOfInput();" name="bestOfAuxField" id="bestOfAuxField"
                            <?php
                            if($row->extra2 == "true")
                                echo ' checked="checked"';
                            ?>/></td>
                        </tr>

                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA1; ?>:</td>
                        <td align="left"><input type="checkbox" class="inputbox" onclick="updateForRentInput();" name="forRentAuxField" id="forRentAuxField"
                            <?php
                            if($row->extra1 == "true")
                                echo ' checked="checked"';
                            ?>/></td>
                    </tr>
            </table>
            <!-- FOR SALE -->
            <table id="ForRentDependent"
                   <?php
                            if($row->extra1 == "true")
                                echo ' style="display:block"';
                            else
                                echo ' style="display:none"';
                   ?>
                   cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform form_11">
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_PRICE; ?>:</td>
                        <td align="left">
                            <input class="inputbox" type="text" name="price" size="15" value="<?php 
                            if($row->price == 0)
                            	echo "";
                            else 
                            	echo $row->price; ?>" />&nbsp;
                            <!--<input class="inputbox" type="text" name="priceunit" size="15" value="<?php //echo $row->priceunit; ?>" />-->
                            <?php echo "EUR";//$currency; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_PROPERTY_TAXES; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="property_taxes" size="30" value="<?php echo $row->property_taxes; ?>" /></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_AREA; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="area" size="30" value="<?php echo $row->area; ?>" /></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_LOT_SIZE; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="lot_size" size="30" value="<?php echo $row->lot_size; ?>" /></td>
                    </tr>
                    <tr>
                    <tr>    
                        <!-- area de implantacao do imovel -->
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_AGENT; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="agent" size="30" value="<?php echo $row->agent; ?>" /></td>
                    </tr>    
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_BUILD_YEAR; ?>:</td>
                        <td align="left">
                            <select name="year" id="year" class="inputbox" size="1" >
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
                        </td>
                    </tr>
                    <!--<tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_PRICE_TYPE; ?>:</td>
                        <td align="left"><?php echo $test_list; ?></td>
                    </tr>-->
                <?php //} ?>
                <?php if($is_admin) { ?>
                    <tr>
                        <td colspan="2"><h2><?php echo _REALESTATE_MANAGER_HEADER_OPTIONAL_FIELDS ?></h2></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EXPIRATION_DATE; ?>:</td>
                        <td align="left">
                            <?php
                            if (trim($row->expiration_date)){
                                echo JHtml::_('calendar', $row->expiration_date, 'expiration_date', 'expiration_date', $realestatemanager_configuration['date_format'], array('size' => '30'));
                            }else{
                                echo JHtml::_('calendar', date("Y-m-d", strtotime(date("Y-m-d") . " +1 year")), 'expiration_date', 'expiration_date', $realestatemanager_configuration['date_format'], array('size' => '30'));
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_FEATURE; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="feature" size="30" value="<?php echo $row->feature; ?>" /></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_HOA_DUES; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="hoa_dues" size="30" value="<?php echo $row->hoa_dues; ?>" /></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_MODEL; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="model" size="30" value="<?php echo $row->model; ?>" /></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="school" size="30" value="<?php echo $row->school; ?>" /></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_SCHOOL_DISTRICT; ?>:</td>
                        <td align="left"><input class="inputbox" type="text" name="school_district" size="30" value="<?php echo $row->school_district; ?>" /></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_STYLE; ?>:</td>
                        <td align="left"><?php echo $style_list; ?></td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_ZONING; ?>:</td>
                        <td align="left"><?php echo $zoning_list; ?></td>
                    </tr>
                <?php } ?>
            </table>
            
            <!--________________________________________________________________________________--->    

            <?php
            if ($realestatemanager_configuration['extra1'] == 0 && $realestatemanager_configuration['extra2'] == 0 && $realestatemanager_configuration['extra3'] == 0 && $realestatemanager_configuration['extra4'] == 0 && $realestatemanager_configuration['extra5'] == 0
                    && $realestatemanager_configuration['extra6'] == 0 && $realestatemanager_configuration['extra7'] == 0 && $realestatemanager_configuration['extra8'] == 0 && $realestatemanager_configuration['extra9'] == 0 && $realestatemanager_configuration['extra10'] == 0) {
                
            } else {
                ?>
                <table class="adminform form_12">
                    <!--<tr>
                        <td colspan="2"><h2><?php echo _REALESTATE_MANAGER_LABEL_EXTRA; ?></h2></td>
                    </tr>-->
                    <?php /*if ($realestatemanager_configuration['extra1'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA1; ?>:</td>
                            <td width="85%" align="left"><input class="inputbox" type="text" name="extra1" size="30" value="<?php echo $row->extra1; ?>" /></td>
                        </tr>
                        <?php
                    }*/
                    /*if ($realestatemanager_configuration['extra2'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA2; ?>:</td>
                            <td width="85%" align="left"><input class="inputbox" type="text" name="extra2" size="30" value="<?php echo $row->extra2; ?>" /></td>
                        </tr>
                        <?php
                    }*/
                    /*if ($realestatemanager_configuration['extra3'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA3; ?>:</td>
                            <td width="85%" align="left"><input class="inputbox" type="text" name="extra3" size="30" value="<?php echo $row->extra3; ?>" /></td>
                        </tr>
                        <?php
                    }
                    if ($realestatemanager_configuration['extra6'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA6; ?>:</td>
                            <td width="85%" align="left"><input class="inputbox" type="text" name="extra4" size="30" value="<?php echo $row->extra4; ?>" /></td>
                        </tr>
                        <?php
                    }*/ 
                    if ($realestatemanager_configuration['extra5'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA5; ?>:</td>
                            <td width="85%" align="left"><input class="inputbox" type="text" name="extra5" size="30" value="<?php echo $row->extra5; ?>" /></td>
                        </tr>
                        <?php
                    }
                    if ($realestatemanager_configuration['extra4'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA4; ?>:</td>
                            <td width="85%" align="left"><?php echo $extra_list[0]; ?></td>
                        </tr>
                        <?php
                    }
                    if ($realestatemanager_configuration['extra7'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA7; ?>:</td>
                            <td width="85%" align="left"><?php echo $extra_list[1]; ?></td>
                        </tr>
                        <?php
                    }
                    if ($realestatemanager_configuration['extra8'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA8; ?>:</td>
                            <td width="85%" align="left"><?php echo $extra_list[2]; ?></td>
                        </tr>
                        <?php
                    }
                    if ($realestatemanager_configuration['extra9'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA9; ?>:</td>
                            <td width="85%" align="left"><?php echo $extra_list[3]; ?></td>
                        </tr>
                        <?php
                    }
                    if ($realestatemanager_configuration['extra10'] == 1) {
                        ?>
                        <tr>
                            <td width="15%" align="right"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA10; ?>:</td>
                            <td width="85%" align="left"><?php echo $extra_list[4]; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
            <?php if($is_admin) { ?>}
            <table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform form_13">
                <tr>
                    <td colspan="2"><hr size="2" width="100%" /></td>
                </tr>    
                <tr>
                    <td colspan="2"><h2><?php echo _REALESTATE_MANAGER_HEADER_ADVERTISMENT; ?></h2></td>
                </tr>
                <tr>
                    <td valign="top" align="right"><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_CLICKS; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="featured_clicks" size="30" value="<?php echo $row->featured_clicks; ?>" /></td>
                </tr>
                <tr>
                    <td valign="top" align="right"><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_SHOWS; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="featured_shows" size="30" value="<?php echo $row->featured_shows; ?>" /></td>
                </tr>
            </table>
            <?php } ?>
            <!--_________________________________________________________________________--->
            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_HOUSE_TAB_PHOTOS_AND_DOCUMENTS), 'panel_3_addHouse');
            } else {
                $tabs->endTab();
                $tabs->startTab('<a href="javascript:rem_initialize();">' . _REALESTATE_MANAGER_ADMIN_HOUSE_TAB_PHOTOS_AND_DOCUMENTS . '</a>', "addHouse");
            }
            ?>
            <table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform form_14">
                <tr>
                    <td colspan="2"><h2><?php echo _REALESTATE_MANAGER_HEADER_PHOTO_MANAGE; ?></h2></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_PICTURE_URL_UPLOAD; ?>:</td>
                    <td align="left">
                        <small>Drop your file into the box below</small><br>
                        <input class="inputbox" type="file" name="image_link" value="<?php echo $row->image_link; ?>" size="50" maxlength="250" />
                    </td>
                </tr>
                <tr>
                    <?php if ($house_photo != '') {
                        ?>	<?php if(!$row->id_true): ?>
                        <td valign="bottom"><?php echo _REALESTATE_MANAGER_LABEL_SELECT_PHOTO_TO_REMOVE; ?>:</td>
                        <?php else:?>
                        <td>&nbsp</td>
                        <?php endif; ?>
                        <td> <?php if(!$row->id_true): ?>
                            <input type="checkbox" name="del_main_photo" value="<?php echo $house_photo[0]; ?>" />
                            <?php endif; ?>
                            <img alt="photo" src="<?php echo $mosConfig_live_site . "/components/com_realestatemanager/photos/" . $house_photo[1]; ?>"/>
                        </td>
                    <?php } else echo '<td>&nbsp</td>'; ?>				
                </tr>
                <tr>
                    <td valign="top"> <?php echo _REALESTATE_MANAGER_LABEL_OTHER_PICTURES_URL_UPLOAD; ?>:</td>
                    <td align="left">
                        <!--<div ID="items">
                            <input class="inputbox" type="button" name="new_photo" 
                                   value="<?php echo 'Add new photo'; ?>" onClick="new_photos()" ID="add"/>
                        </div>-->
                            <small>Drop your files into the box below</small><br>
                            <input class="inputbox" type="file" name="new_photo_file[]" size="50" maxlength="250" multiple/>
                    </td>
                </tr>

                <?php if (count($house_photos) != 0) {
                    ?>
                    <tr>
                        <td valign="center"><?php echo _REALESTATE_MANAGER_LABEL_SELECT_PHOTO_FROM_GALLERY; ?>:</td>
                        <td valign="top" align="right">
                            <table>
                                <tr>
                                    <td>
                                        Saved photos:<br>
                                        <ol id="sortable1" class="connectedSortable">
                                        <?php
                                        for ($i = 0; $i < count($house_photos); $i++) {
                                            if (($i % 7) == 0) {
                                                echo "<br>";
                                            }
                                            ?>
                                                <li class="dropable_photo">
                                                    <input type="hidden" name="order_photos[]" value="<?php echo $house_photos[$i][0]; ?>" />
                                                    <img src="<?php echo $mosConfig_live_site . "/components/com_realestatemanager/photos/" . $house_photos[$i][1]; ?>" alt="no such file"/> &nbsp
                                                </li>
                                        <?php } ?>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        To Delete:<br>
                                        <ol id="sortable2" class="connectedSortable">
                                        
                                        </ol>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
				<tr>
                    <td colspan="2"><hr size="2" width="100%" /></td>
                </tr>
                <tr>
                    <td colspan="2"><h2><?php echo _REALESTATE_MANAGER_HEADER_VIDEOS; ?></h2></td>
                </tr>
                <tr>
                    <td valign="center"><?php echo "Links"; ?></td>
                    <td valign="top" align="right">
                        <?php //print_r($row); ?>
                        <!--
                            By CMS at 04-04-2015
                            You should insert one video (youtube link) per line
                            -->
                        <textarea style="width:100%" id="house_videos" name="house_videos"><?php echo implode($row->videos, "\n"); ?></textarea><br>
                        <small>To add new videos, please insert youtube video link in a new link of text box.</small>
                    </td>
                </tr>
                <!-- new videos to show-->
				<tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA6; ?>:</td>
					<td align="left"><input type="checkbox" class="inputbox" onclick="updateVideosInput();" name="videosField" id="videosField"
					    <?php
                        if($row->extra6 == "true")
                            echo ' checked="checked"';
                        ?>/></td>
                </tr>
				<tr>
                    <td colspan="2"><hr size="2" width="100%" /></td>
                </tr>
				<tr>
                    <td colspan="2"><h2><?php echo 'Documents'; ?></h2></td>
                </tr>
                <?php
                if ($realestatemanager_configuration['edocs']['allow']) {
                    ?>	
                        <tr>
                            <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EDOCUMENT_UPLOAD; ?>:</td>
                            <td align="left">
                                <small>Drop your files into the box below</small><br>
                                <input class="inputbox" type="file" name="edoc_file" value="" size="50" maxlength="250" onClick="document.adminForm.edok_link.value ='';"/>
                                <!-- //+ -->
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EDOCUMENT_UPLOAD_URL; ?>:</td>
                            <td align="left"><input class="inputbox" type="text" name="edok_link" value="<?php echo $row->edok_link; ?>" size="50" maxlength="250"/></td>
                        </tr>
                    
                    <?php
                }
                if (strlen($row->edok_link) > 0 and !$row->id_true) {
                    ?>
                    <tr>
                        <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EDOCUMENT_DELETE; ?>:</td>
                        <td align="left"><?php echo $delete_edoc; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <!--____________________________________________________________________--->         

            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_HOUSE_TAB_OWNER_CONTACTS), 'panel_4_addHouse');
            } else {
                $tabs->endTab();
                $tabs->startTab('<a href="javascript:rem_initialize();">' . _REALESTATE_MANAGER_ADMIN_HOUSE_TAB_OWNER_CONTACTS . '</a>', "addHouse");
            }
            ?>
            <script>
            
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
                            var options = $("#hcity");
                            options.html(''); // fr toutes les villes
                            options.append($("<option />").val("").text("<?php echo _REALESTATE_MANAGER_ALL_CITIES; ?>").attr("default", "default").attr("selected", "selected"));
                            $.each(cities, function() {
                                options.append($("<option />").val(this.hcity).text(this.hcity));
                            });
                        });
                    })(jQuery);
                }
                
            </script>
            <table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform form_15">

                <tr>
                    <td colspan="2"><h2><?php echo "Address Fields"; ?></h2></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_ADDRESS; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" id="hlocation" name="hlocation" size="80" value="<?php echo $row->hlocation; ?>" /></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_COUNTRY; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" id="hcountry" name="hcountry" size="80" value="<?php echo $row->hcountry; ?>" /></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_REGION; ?>:</td>
                    <td align="left">
                    
                    
                    <?php 
                    
                    // cities
                    $whereclause = '';
                    if($row->hregion != null && $row->hregion != ''){
                    	$whereclause = "WHERE hregion='".$row->hregion."'";
                    }
                    $getCities = " SELECT DISTINCT(hcity) FROM #__rem_houses ". $whereclause ." ORDER BY hcity ASC";
                    $database->setQuery($getCities);
                    $cities = $database->loadObjectList();
                    
                    $provider_class[0] = _REALESTATE_MANAGER_OPTION_SELECT;
                    $provider_class1 = explode(',', _REALESTATE_MANAGER_ADMIN_REQUEST_RENT);
                    $i = 1;
                    foreach ($provider_class1 as $provider_class2) {
                    	$provider_class[$i] = $provider_class2;
                    	$i++;
                    }
                    
                    ?>
                       <select name="hregion" id="hregion" onchange="getCities(value)">
                            <option value="north" <?php if($row->hregion == 'north') echo 'selected'?>>North & Porto</option>
                            <option value="center" <?php if($row->hregion == 'center') echo 'selected'?>>Center & Silver Coast</option>
                            <option value="lisbon" <?php if($row->hregion == 'lisbon') echo 'selected'?>>Lisbon Coast</option>
                            <option value="alentejo" <?php if($row->hregion == 'alentejo') echo 'selected'?>>Alentejo & Blue Coast</option>
                            <option value="algarve" <?php if($row->hregion == 'algarve') echo 'selected'?>>Algarve</option>
                            <option value="madeira" <?php if($row->hregion == 'madeira') echo 'selected'?>>Madeira</option>
                        </select>
                        
                        <!--<input class="inputbox" type="text" id="hregion" name="hregion" size="80" value="<?php echo $row->hregion; ?>" />-->
                        <input class="hidden" type="text" id="hzipcode" name="hzipcode" size="80" value="" />
                    </td>
                </tr>
                <tr>
                	<!--  CIDADE: dropdown de cidades por região -->
                	<td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_CITY; ?>:</td>
                    
                    <td align="left">
                    	<select name="hcity" id="hcity">
	                		<option value="" selected default><?php echo _REALESTATE_MANAGER_ALL_CITIES; ?></option>
	                    	<?php for($i=0; $i<count($cities); $i++){
	                            	if($cities[$i]->hcity != ''){?> 
	                                	<option value="<?php echo $cities[$i]->hcity; ?>" <?php if($row->hcity == $cities[$i]->hcity) echo 'selected'; ?>><?php echo $cities[$i]->hcity; ?></option>
		                     <?php  }} ?>
	                    </select>
	                </td>
                </tr>
                <!-- CIDADE: nova cidade a adicionar 
                <tr>
                	<td valign="top"><?php echo " New city? "; ?>&nbsp;<input type="checkbox" id="myCheck" onclick="check()"></td>
                </tr>
                -->
                <tr id="bo-newcity">
                	<!-- CIDADE: nova cidade a adicionar --> 
                	<td valign="top"><?php echo "New city? Please write city name"; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" id="hcity" name="hcity" size="80" value="<?php echo $row->hcity; ?>" /></td>
                </tr>
                <!--<tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_DISTRICT; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" id="hdistrict" name="hdistrict" size="80" value="<?php echo $row->hdistrict; ?>" /></td>
                </tr>-->
                <!--<tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_ZIPCODE; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" id="hzipcode" name="hzipcode" size="80" value="<?php echo $row->hzipcode; ?>" /></td>
                </tr>-->
                <!--<tr>
                    <td><?php echo _REALESTATE_MANAGER_LABEL_OWNER; ?>:</td>
                    <td>
                        <?php if (trim($row->owneremail) != ""): ?>
                            <?php echo $row->getOwnerUsername(), '(', $row->owneremail, ')'; ?>
                        <?php endif; ?>
                    </td>
                </tr>-->
                <!--<tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_CUSTOM_OWNER_EMAIL; ?>:</td>
                    <td align="left">
                        <?php if (trim($row->owneremail) != ""): ?>
                            <input type='text' name='owneremail' value="<?php echo $row->owneremail; ?>"/>
                        <?php else: ?>
                            <input type='text' name='owneremail' value="<?php echo $my->email; ?>"/>
                        <?php endif; ?>
                    </td>
                </tr>-->
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_EXTRA3; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" name="extra3" size="30" value="<?php echo $row->extra3; ?>" /></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_LATITUDE; ?>:</td>
                    <td align="left"><input class="inputbox" type="text" id="hlatitude" name="hlatitude" size="20" value="<?php echo $row->hlatitude; ?>" readonly/></td>
                </tr>
                <tr>

                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_LONGITUDE; ?>:</td>
                    <td align="left">
                        <input class="inputbox" type="text" id="hlongitude" name="hlongitude" size="20" value="<?php echo $row->hlongitude; ?>" readonly/>
                        <input type="hidden" id="map_zoom" name="map_zoom" value="<?php echo $row->map_zoom; ?>" />
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_GEOCOOR; ?></td>
                    <td align="left"><input type="button" value="<?php echo _REALESTATE_MANAGER_BUTTON_SHOW_ADDRESS; ?>" onclick="codeAddress()"></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo _REALESTATE_MANAGER_LABEL_CLICKMAP; ?></td>
                </tr>
            </table>
            <div id="map_canvas"></div>
            <!--Image google map-->
            <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
            <script type="text/javascript">
                                            
                setTimeout(function() {
                    vm_initialize();
                },20);
                function vm_initialize(){
                    var map;
                    var lastmarker = null;
                    var marker = null;
                    var mapOptions;
                    var myOptions = {
                        zoom: <?php if ($row->map_zoom) echo $row->map_zoom;
                                    else echo 1; ?>,
                                                         center: new google.maps.LatLng(<?php if ($row->hlatitude) echo $row->hlatitude; else echo 0; ?>,<?php if ($row->hlongitude) echo $row->hlongitude; else echo 0; ?>),
                                                         scrollwheel: false,
                                                         zoomControlOptions: {
                                                             style: google.maps.ZoomControlStyle.LARGE
                                                         },
                                                         mapTypeId: google.maps.MapTypeId.ROADMAP
                                                     };
                                                     geocoder = new google.maps.Geocoder();
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
                                                                
            }

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
                var marker;
                myOptions = {
                    zoom:14,
                    scrollwheel: false,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.LARGE
                    },
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
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
            
            $(function() {
                $( "#sortable1, #sortable2" ).sortable({
                  connectWith: ".connectedSortable",
                  receive: function(event, ui){
                    if(ui.item.parent().attr('id') == 'sortable2'){
                        ui.item.find('input').attr('name', 'del_photos[]');
                    }else{
                        ui.item.find('input').attr('name', 'order_photos[]');
                    }
                  }
                }).disableSelection();
              });
            
            </script>
            <!--End google map.-->


            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                echo JHtml::_('tabs.end');
            } else {
                $tabs->endTab();
                $tabs->endPane();
            }
            
            
            ?>
 			
            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
            <input type="hidden" name="owner_id" value="<?php echo $row->owner_id; ?>" />
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="task" value="" />		
        </form>
        <!--************************   end change review ***********************-->
        <?php
    }

    static function showRentHouses($option, $house1, $rows, & $userlist, $type) {

        global $my, $mosConfig_live_site, $mainframe, $doc, $css;
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_REQUEST_RENT . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
        <form action="index.php" method="post" name="adminForm" id="adminForm">
            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform form_17">
                <tr>
                    <td width="100%" class="house_manager_caption"  >
                        <?php
                        if ($type == "rent") {
                            echo _REALESTATE_MANAGER_SHOW_RENT_HOUSES;
                        } else
                        if ($type == "rent_return") {
                            echo _REALESTATE_MANAGER_SHOW_RENT_RETURN;
                        } if ($type == "edit_rent") {
                            echo _REALESTATE_MANAGER_SHOW_RENT_EDIT;
                        } else {

                            echo "&nbsp;";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        <?php
        if ($type == "rent" or $type == "edit_rent") {
            
            ?>
                <table cellpadding="4" cellspacing="0" border="0" width="100%" class="table_form_01">
                    <tr>
                        <td align="center" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TO . ':'; ?></td>
                        <td align="center" nowrap="nowrap"><?php echo $userlist; ?></td>
                        <td align="center" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_USER . ':'; ?></td>
                        <td><input type="text" name="user_name" class="inputbox" /></td>
                    </tr>
                    <tr>
                        <td align="left" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_EMAIL . ':'; ?></td>
                        <td><input type="text" name="user_email" class="inputbox" /></td>
                    </tr>
                    <tr>
                        <td align="left" nowrap="nowrap"><?php echo "Rent from:"; ?></td>
                        <td align="left" nowrap="nowrap"><?php echo JHtml::_('calendar', date("Y-m-d"), 'rent_from', 'rent_from', '%Y-%m-%d'); ?></td>
                        <td align="left" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TIME . ':'; ?></td>
                        <td align="left" nowrap="nowrap"><?php echo JHtml::_('calendar', date("Y-m-d"), 'rent_until', 'rent_until', '%Y-%m-%d'); ?></td>
                    </tr>
                </table>
                <?php
                
            } else {
                ?>
                &nbsp;
                <?php
            }
            $all = JFactory::getDBO();

            $query = "SELECT * FROM #__rem_rent ";
            $all->setQuery($query);
            $num = $all->loadObjectList();
            ?>
            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist list_10">
                <tr>
                    <th width="20" align="center">
        <?php if ($type != 'rent') {
            ?> <input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this);" />
        <?php } ?> </th>
                    <th align = "center" width="30">#</th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                    <th align = "center" class="title" width="25%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_RETURN; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TO; ?></th>
                </tr>

                <?php
                if ($type == "rent")
                {
                    ?>
                        <td align="center">  <input class="inputbox"  type="checkbox"  name="checkHouse" id="checkHouse" size="0" maxlength="0" value="on" /></td>
                 <?php     
                } else if ($type == "edit_rent"){ ?>
                  <input type="hidden"  name="checkHouse" id="checkHouse" value="on" /></td>
                 <?php }
                $assoc_title = '';
                for ($t = 0, $z = count($rows); $t < $z; $t++) {
                  if($rows[$t]->id != $house1->id) $assoc_title .= " ".$rows[$t]->htitle; 
                }

                print_r("
                  <td align=\"center\">". $house1->id ."</td>
                  <td align=\"center\">" . $house1->houseid . "</td>
                  <td align=\"center\">" . $house1->htitle . " ( " . $assoc_title ." ) " . "</td>
                  <td align=\"center\">" . " " . "</td>
                  <td align=\"center\">" . " " . "</td>
                  <td align=\"center\">" . " " . "</td>
                  <td align=\"center\">" . " " . "</td> </tr>");

                print_r("
                  <td align=\"center\">-------- </td>
                  <td align=\"center\">-------</td>
                  <td align=\"center\">" . "------------" . "</td>
                  <td align=\"center\">" . "-----------------" . "</td>
                  <td align=\"center\">" . " -------------" . "</td>
                  <td align=\"center\">" . " ---------" . "</td>
                  <td align=\"center\">" . " ---------------------" . "</td>
                  <td align=\"center\">" . "------------------" . "</td> </tr>");
             for ($j = 0, $n = count($rows); $j < $n; $j++) {
                    $row = $rows[$j];

                   
            ?>
                    </td>
                    <input class="inputbox" type="hidden"  name="houseid" id="houseid" size="0" maxlength="0" value="<?php echo $house1->houseid; ?>" />
                    <input class="inputbox"  type="hidden"  name="id" id="id" size="0" maxlength="0" value="<?php echo $row->id; ?>" />
                    <input class="inputbox"  type="hidden"  name="id2" id="id2" size="0" maxlength="0" value="<?php echo $row->id; ?>" />
                    <?php
                    
                    $house = $row->id;
                    //$title = $row->htitle;
                    $data = JFactory::getDBO();
                    $query = "SELECT * FROM #__rem_rent WHERE fk_houseid=" . $house . " ORDER BY rent_return ";

                    $data->setQuery($query);
                    $allrent = $data->loadObjectList();
              
                    $num = 1;
                    for ($i = 0, $n2 = count($allrent); $i < $n2; $i++) {
                        if (!isset($allrent[$i]->rent_return) && $type != "rent"){
                      
                                ?>
                                <td align="center"><input type="checkbox"  id="cb<?php echo $i; ?>" name="bid[]" value="<?php echo $allrent[$i]->id; ?>"    onClick="isChecked(this.checked);" /></td>
                                <?php
                            } else {
                                ?>
                                <td align="center"></td>
                                <?php
                            }

                        print_r("
                <td align=\"center\">" . $num . "</td>
                <td align=\"center\">" . $row->houseid . "</td>
                <td align=\"center\">" . $row->htitle . "</td>
                <td align=\"center\">" . $allrent[$i]->rent_from . "</td>
                <td align=\"center\">" . $allrent[$i]->rent_until . "</td>      
                <td align=\"center\">" . $allrent[$i]->rent_return . "</td>     
                <td align=\"center\">" . $allrent[$i]->user_name . ":  " . $allrent[$i]->user_email . "</td> </tr>");
                        $num++;
                    }
                    ?>
        <?php } ?>
            </table>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="1" />
            <input type="hidden" name="save" value="1" />
        </form>
        <?php 
    }


static function editRentHouses($option, $house1, $rows, $title_assoc, & $userlist, & $all_assosiate_rent, $type) {
        global $my, $mosConfig_live_site, $mainframe, $doc, $css;
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_REQUEST_RENT . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        
        ?>
        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
        <form action="index.php" method="post" name="adminForm" id="adminForm">
            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform form_17">
                <tr>
                    <td width="100%" class="house_manager_caption"  >
                        <?php
                        if ($type == "rent") {
                            echo _REALESTATE_MANAGER_SHOW_RENT_HOUSES;
                        } else
                        if ($type == "rent_return") {
                            echo _REALESTATE_MANAGER_SHOW_RENT_RETURN;
                        } if ($type == "edit_rent") {
                            echo _REALESTATE_MANAGER_SHOW_RENT_EDIT;
                        } else {

                            echo "&nbsp;";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        <?php
        if ($type == "rent" or $type == "edit_rent") {
            
            ?>
                <table cellpadding="4" cellspacing="0" border="0" width="100%" class="table_form_01">
                    <tr>
                        <td align="center" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TO . ':'; ?></td>
                        <td align="center" nowrap="nowrap"><?php echo $userlist; ?></td>
                        <td align="center" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_USER . ':'; ?></td>
                        <td><input type="text" name="user_name" class="inputbox" /></td>
                    </tr>
                    <tr>
                        <td align="left" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_EMAIL . ':'; ?></td>
                        <td><input type="text" name="user_email" class="inputbox" /></td>
                    </tr>
                    <tr>
                        <td align="left" nowrap="nowrap"><?php echo "Rent from:"; ?></td>
                        <td align="left" nowrap="nowrap"><?php echo JHtml::_('calendar', date("Y-m-d"), 'rent_from', 'rent_from', '%Y-%m-%d'); ?></td>
                        <td align="left" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TIME . ':'; ?></td>
                        <td align="left" nowrap="nowrap"><?php echo JHtml::_('calendar', date("Y-m-d"), 'rent_until', 'rent_until', '%Y-%m-%d'); ?></td>
                    </tr>
                </table>
                <?php
                
            } else {
                ?>
                &nbsp;
                <?php
            }
            $all = JFactory::getDBO();

            $query = "SELECT * FROM #__rem_rent ";
            $all->setQuery($query);
            $num = $all->loadObjectList();
            ?>
            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist list_10">
                <tr>
                    <th width="20" align="center">
                    </th>
                    <th align = "center" width="30">#</th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_HOUSEID; ?></th>
                    <th align = "center" class="title" width="25%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_TITLE; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_FROM; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_UNTIL; ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_RETURN; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_RENT_TO; ?></th>
                </tr>

                <?php
                 if ($type == "edit_rent"){ ?>
                  <input type="hidden"  name="checkHouse" id="checkHouse" value="on" /></td>
                
                 <?php
                 } 
                $assoc_title = ''; 
                for ($t = 0, $z = count($title_assoc); $t < $z; $t++) {
                  if($title_assoc[$t]->htitle != $house1->htitle) $assoc_title .= " ".$title_assoc[$t]->htitle; 
                }
                
                 //show rent history what we may change
                    ?>
                        &nbsp;
                <input class="inputbox" type="hidden"  name="houseid" id="houseid" size="0" maxlength="0" value="<?php echo $house1->houseid; ?>" />
                <input class="inputbox"  type="hidden"  name="id" id="id" size="0" maxlength="0" value="<?php echo $house1->id; ?>" />
                <input class="inputbox"  type="hidden"  name="id2" id="id2" size="0" maxlength="0" value="<?php echo $house1->id; ?>" />   
            <?php       
                 $num = 1;
                    for ($i = 0, $n2 = count($all_assosiate_rent[0]); $i < $n2; $i++) { 
                        $assoc_rent_ids = ''; 
                        for ($j = 0, $n3 = count($all_assosiate_rent); $j < $n3; $j++) { 
                            if($assoc_rent_ids != "" ) $assoc_rent_ids .= ",".$all_assosiate_rent[$j][$i]->id; 
                            else $assoc_rent_ids = $all_assosiate_rent[$j][$i]->id; 
                        }       
                        ?>
                            <td align="center"><input type="checkbox"  id="cb<?php echo $i; ?>" name="bid[]" 
                              value="<?php echo $assoc_rent_ids; ?>" onClick="isChecked(this.checked);" /></td>
                        <?php  
                        print_r("
                          <td align=\"center\">" . $num . "</td>
                          <td align=\"center\"> </td>
                          <td align=\"center\">" . $house1->htitle . " ( " . $assoc_title ." ) " . "</td>
                          <td align=\"center\">" . $all_assosiate_rent[0][$i]->rent_from . "</td>
                          <td align=\"center\">" . $all_assosiate_rent[0][$i]->rent_until . "</td>    
                          <td align=\"center\">" . $all_assosiate_rent[0][$i]->rent_return . "</td>   
                          <td align=\"center\">" . $all_assosiate_rent[0][$i]->user_name . ":  " . $all_assosiate_rent[0][$i]->user_email . "</td> </tr>");
                        $num++;
                    }
              
                         print_r("
                          <td align=\"center\">-------- </td>
                          <td align=\"center\">-------</td>
                          <td align=\"center\">" . "------------" . "</td>
                          <td align=\"center\">" . "-----------------" . "</td>
                          <td align=\"center\">" . " -------------" . "</td>
                          <td align=\"center\">" . " ---------" . "</td>
                          <td align=\"center\">" . " ---------------------" . "</td>
                          <td align=\"center\">" . "------------------" . "</td> </tr>");
                  
                   //show rent history what we can't change
                  for ($j = 0, $n = count($rows); $j < $n; $j++) {
                    $row = $rows[$j];
                    if($row->rent_return == "" ) continue ;
                   
                    $num = 1;              
                    ?>
                        &nbsp;
                        
                    </td>
                    <input class="inputbox" type="hidden"  name="houseid" id="houseid" size="0" maxlength="0" value="<?php echo $row->houseid; ?>" />
                    <input class="inputbox"  type="hidden"  name="id" id="id" size="0" maxlength="0" value="<?php echo $row->id; ?>" />
                    <input class="inputbox"  type="hidden"  name="id2" id="id2" size="0" maxlength="0" value="<?php echo $row->id; ?>" />
                            <td align="center">
                            </td>
                        <?php
                        print_r("
                <td align=\"center\">" . $num . "</td>
                <td align=\"center\">" . $row->houseid . "</td>
                <td align=\"center\">" . $row->htitle . "</td>
                <td align=\"center\">" . $row->rent_from . "</td>
                <td align=\"center\">" . $row->rent_until . "</td>      
                <td align=\"center\">" . $row->rent_return . "</td>     
                <td align=\"center\">" . $row->user_name . ":  " . $row->user_email . "</td> </tr>");
                        $num++;
                    ?>
        <?php } ?>
            </table>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="1" />
            <input type="hidden" name="save" value="1" />
        </form>
        <?php 
    }
    

    static function showConfiguration($lists, $option, $txt) {
        global $my, $mosConfig_live_site, $mainframe, $act, $task, $realestatemanager_configuration;
        $doc = JFactory::getDocument();
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_CONFIG . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        
        ?>
        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
        <script>
            window.onload=function()
            {
                if (document.getElementById('money_select').options[document.getElementById('money_select').selectedIndex].value == 'other') { 
                    document.getElementById('patt').type="text";
                    document.getElementById('patt').removeAttribute('readonly');
                }
            }
            function set_pricetype(sel) {
                var value = sel.options[sel.selectedIndex].value;
                if (value=="space") {
                    document.getElementById('patt').value="&nbsp;";
                    //      document.getElementById('patt').setAttribute('readonly', true); 
                    //     document.getElementById('patt').type="hidden";
                }
                else if (value!="other") {
                    document.getElementById('patt').value=value;
                    document.getElementById('patt').setAttribute('readonly', true); 
                    document.getElementById('patt').type="hidden";
                } else
                {
                    document.getElementById('patt').value="";
                    document.getElementById('patt').type="text";
                    document.getElementById('patt').removeAttribute('readonly');
                }
            }
        </script>
        <form action="index.php" method="post" name="adminForm" id="adminForm"> 
            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                $options = Array();
                echo JHtml::_('tabs.start', 'configurePane', $options);
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_1), 'panel_1_configurePane');
            } else {
                $tabs = new mosTabs(7);
                $tabs->startPane("configurePane");
                $tabs->startTab(_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_1, "panel_1_configurePane");
            }
            ?>
            <div style="clear: both;"></div>
            <h2><?php echo _REALESTATE_MANAGER_HOUSE_IMAGE_HEADER_SETTINGS; ?></h2>
            <table class="adminform form_18" border="0">
                <!--
                //***********************************************************************************************
                //				begin add FotoSize
                //***********************************************************************************************
                -->
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_FOTOMAIN_SIZE; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_FOTOMAIN_SIZE_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo ($lists['fotomain']['high']) . " / " . ($lists['fotomain']['width']); ?></td>
                </tr>
                <!--
                //***********************************************************************************************
                //				end add FotoSize
                //***********************************************************************************************
                -->
            </table>
            <table class="adminform form_19" border="0">
                <!--********   begin ownershow   **************-->
                <tr>
                    <td colspan="6"><hr /></td>
                </tr>
                <tr>
                    <td>
                        <h2><?php echo _REALESTATE_MANAGER_TABS_MANAGER_HEADER_SETTINGS; ?></h2>
                    </td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEW_TAB; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEW_TAB_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['reviews_tab']['show']; ?></td>
                    <td width="130"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEWS_TAB_REGISTRATIONLEVEL; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEWS_TAB_REGISTRATIONLEVEL_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['reviews_tab']['registrationlevel']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_CONFIG_CALENDARLIST_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_CONFIG_CALENDARLIST_SHOW_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['calendar']['show']; ?></td>
                    <td width="130"><?php echo _REALESTATE_MANAGER_CONFIG_CALENDARLIST_REGISTRATIONLEVEL; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_CONFIG_CALENDARLIST_REGISTRATIONLEVEL_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['calendarlist']['registrationlevel']; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><hr /></td>
                </tr>
            </table>
            <h2><?php echo _REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_FEATURE_LIST_SETTINGS; ?></h2>
            <table class="adminform form_21">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_IMAGE; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_IMAGE_TT_HEAD . "' alt='info'>";  ?></td>
                    <td class="yesno"><?php echo $lists['manager_feature_image']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_SHOW_TT_HEAD . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['manager_feature_category']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_HOUSE_PAGE_LAYOUT; ?>:</td>
                    <td colspan="2"><?php echo $lists['view_house']; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><hr /></td>
                </tr>
            </table>
            <h2><?php echo _REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_EXTRA_FIELDS_MANAGER; ?></h2>
            <table class="adminform form_22">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA1_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA_TEXT_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['extra1']; ?><br></td>
                </tr>                
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA2_SHOW; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['extra2']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA3_SHOW; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['extra3']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA4_SHOW; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['extra4']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA5_SHOW; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['extra5']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA6_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA_DROPDOWN_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['extra6']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA7_SHOW; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['extra7']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA8_SHOW; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['extra8']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA9_SHOW; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['extra9']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA10_SHOW; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['extra10']; ?><br></td>
                </tr>

            </table>
            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_2), 'panel_2_configurePane');
            } else {
                $tabs->endTab();
                $tabs->startTab(_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_2, "panel_2_configurePane");
            }
            ?>
            <h2><?php echo _REALESTATE_MANAGER_SETTINGS_HEADER_CATEGORY_OPTIONS; ?></h2>
            <table class="adminform form_23">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_ALL_CATEGORIES_LAYOUT; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_ALL_CATEGORIES_LAYOUT_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['all_categories']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_SINGLE_CATEGORY_LAYOUT; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_SINGLE_CATEGORY_LAYOUT_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['view_type']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_SEARCH_LAYOUT; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_SEARCH_LAYOUT_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['show_search_house']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_MAP; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_MAP_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['location_map']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_FOTO_SIZE; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_FOTO_SIZE_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo ($lists['foto']['high']) . " / " . ($lists['foto']['width']); ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_FOTOGALLERY_SIZE; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_FOTOGALLERY_SIZE_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo ($lists['fotogallery']['high']) . " / " . ($lists['fotogallery']['width']); ?></td>
                </tr>
                <!--//***********************************************************************************************
                //				begin add PageItems
                //***********************************************************************************************
                -->                
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_PAGE_ITEMS; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_PAGE_ITEMS_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['page']['items']; ?></td>
                </tr>
                <!--*******	end add PageItems ************ -->

                <!--********   begin add for show in category picture   **************-->
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_PICTURE_IN_CATEGORY; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_PICTURE_IN_CATEGORY_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['cat_pic']['show']; ?><br></td>
                </tr>
                <!--***************   end add for show in category picture  *************-->

                <!--********   begin add for show subcategory   **************-->            
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_SUBCATEGORY_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_CONFIG_OWNERSLIST_SHOW_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['subcategory']['show']; ?></td>
                </tr> 
                <!--***************   end add for show subcategory *************-->
                <tr>
                    <td colspan="6"><hr /></td>
                </tr>
                </table>
            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_4), 'panel_4_configurePane');
            } else {
                $tabs->endTab();
                $tabs->startTab(_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_4, "panel_4_configurePane");
            }
            ?>
            <div style="clear: both;"></div>
            <h2><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_BACKEND; ?></h2>
            <table class="adminform form_27">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_FOTOUPLOAD_SIZE; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_FOTOUPLOAD_SIZE_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo ($lists['fotoupload']['high']) . " / " . ($lists['fotoupload']['width']); ?></td>
                </tr>
            </table>
             <table class="adminform form_28">
                <tr>
                    <td width="745px" colspan="6"><hr /></td>
                </tr>
                <tr>
                  <td><h2><?php echo _REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_EDOCUMENT_OPTIONS; ?></h2> </td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['edocs']['allow']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD_LOCATION; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD_LOCATION_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['edocs']['location']; ?></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_PHOTOS_DOWNLOAD_LOCATION; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_PHOTOS_DOWNLOAD_LOCATION_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['photos']['location']; ?></td>
                </tr>
                </table>
                <table class="adminform form_28">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_SHOW_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['edocs']['show']; ?></td>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_REGISTRATIONLEVEL; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_REGISTRATIONLEVEL_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['edocs']['registrationlevel']; ?></td>
                </tr>
                <tr>
                    <td  colspan="6"><hr /></td>
                </tr>
                </table>
                <h2><?php echo _REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_PRICE_OPTIONS; ?></h2> 
                <table class="adminform form_28">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_SHOW_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['price']['show']; ?></td>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_REGISTRATIONLEVEL; ?></td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_REGISTRATIONLEVEL_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['price']['registrationlevel']; ?></td> 
                </tr>
                </table>
                <table class="adminform form_28">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_PRICE_FORMAT; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_PRICE_FORMAT . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['money_ditlimer'] ?></td>
                    <td><input id="patt" type="hidden" readonly="true" value="<?php echo $realestatemanager_configuration['price_format'] ?>" name="patern" size="2"></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_SALE_SEPARATOR_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_SALE_SEPARATOR_SHOW_TT_HEAD . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['sale_separator']; ?><br></td>
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_CURRENCY; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_CURRENCY_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['currency']; ?></td>
                </tr>
                 <tr>
                    <td width="185"><?php echo _REALESTATE_PRICE_UNIT_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_PRICE_UNIT_SHOW . "' alt='info'>"; ?></td>
                    <td width="20"><?php echo $lists['price_unit_show'] ?></td>
                </tr>
                <tr>
                    <td width="745px" colspan="6"><hr /></td>
                </tr>
                </table>
                <h2><?php echo _REALESTATE_MANAGER_SETTINGS_HEADER_DATE_TIME_OPTIONS; ?></h2>
                <table class="adminform form_28">
                <tr rowspan="2">
                    <td width="185"><?php echo _REALESTATE_MANAGER_DATE_TIME_FORMAT; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_DATE_FORMAT." ("._REALESTATE_MANAGER_DATE .")". "' alt='info'>"; ?></td>
                    <td width="185"><?php echo $lists['date_format'] ?> </td>
                </tr>
                <tr>
                    <td width="185"></td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_TIME_FORMAT." ("._REALESTATE_MANAGER_TIME .")". "' alt='info'>"; ?></td>
                    <td width="185"><?php echo $lists['datetime_format'] ?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="745px" colspan="6"><hr /></td>
                </tr>
            </table>
            <h2><?php echo _REALESTATE_MANAGER_SETTINGS_COMMON_SETTINGS; ?></h2>
            <table class="adminform form_29">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_RENTSTATUS_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_RENTSTATUS_SHOW_TT_BODY. "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['rentstatus']['show']; ?></td>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_RENTREQUEST_REGISTRATIONLEVEL; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_RENTREQUEST_REGISTRATIONLEVEL_TT_BODY. "' alt='info'>"; ?></td>
                    <td><?php echo $lists['rentrequest']['registrationlevel']; ?></td>
                </tr>      
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_BUYSTATUS_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_BUYSTATUS_SHOW_TT_BODY. "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['buystatus']['show']; ?></td>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_BUYREQUEST_REGISTRATIONLEVEL; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_BUYREQUEST_REGISTRATIONLEVEL_TT_BODY. "' alt='info'>"; ?></td>
                    <td><?php echo $lists['buyrequest']['registrationlevel']; ?></td>
                </tr>
                <!-- __REVIEW__ -->
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_SHOW; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_SHOW_TT_BODY . "' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['reviews']['show']; ?></td>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_REGISTRATIONLEVEL; ?>:</td>         
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='" . _REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_REGISTRATIONLEVEL_TT_BODY . "' alt='info'>"; ?></td>
                    <td><?php echo $lists['reviews']['registrationlevel']; ?></td>         
                </tr>
                <tr>
                    <td colspan="6"><hr /></td>
                </tr>
                </table>
                <h2><?php echo _REALESTATE_MANAGER_SETTINGS_EXTENSIONS_SETTINGS; ?></h2>
                <table class="adminform form_29">
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ALLOWED_EXTS; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['allowed_exts']; ?></td>            
                </tr>
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ALLOWED_EXTS_IMG; ?>:</td>
                    <td width="20"></td>
                    <td class="yesno"><?php echo $lists['allowed_exts_img']; ?></td>            
                </tr>
                <tr>
                    <td colspan="6"><hr /></td>
                </tr>
                </table>
                <h2><?php echo _REALESTATE_MANAGER_SETTINGS_UPDATE_SETTINGS; ?></h2>
                <table class="adminform form_29">
                <!--********   begin add update  **************-->
                <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_UPDATE; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='"._REALESTATE_MANAGER_ADMIN_UPDATE_TT_BODY."' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['update']; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><hr /></td>
                </tr>
            </table>
            <?php /*<h2 id="special_price" ><?php echo _REALESTATE_MANAGER_RENT_SPECIAL_PRICE_AND_RENT_TIME; ?></h2>
            <table class="adminform adminform_43">	
               <tr>
                    <td width="185"><?php echo _REALESTATE_MANAGER_RENT_SPECIAL_PRICE_YES_NO; ?>:</td>
                    <td width="20"><?php echo "<img src='" . JURI::base() . 'components/com_realestatemanager/images/info.png' . "' title='"._REALESTATE_MANAGER_RENT_SPECIAL_PRICE_YES_NO_HELP."' alt='info'>"; ?></td>
                    <td class="yesno"><?php echo $lists['special_price']['show']; ?></td>
                </tr>		
                
            </table>
            */ ?>
            <div style="clear: both;"></div>
          
            <!--***************   end show cb  *****************-->
            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                echo JHtml::_('tabs.end');
            } else {
                $tabs->endTab();
                $tabs->endPane();
            }
            ?>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="config_save" />
        </form>
        <?php
    }

//------------------------------------------------------------------
    static function about() {

        global $mosConfig_live_site, $mainframe;
        $tabs = new mosTabs(0);
        global $doc;
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_ABOUT . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
        <form action="index.php" method="post" name="adminForm" id="adminForm">
            <?php
            $tabs->startPane("aboutPane");
            $tabs->startTab(_REALESTATE_MANAGER_ADMIN_ABOUT_ABOUT, "display-page");
            ?>
            <div style="clear: both;"></div>
            <table class="adminform form_31">
                <tr>
                    <td width="80%">
                        <h3><?PHP echo _REALESTATE_MANAGER__HTML_ABOUT; ?></h3>
        <?PHP echo _REALESTATE_MANAGER__HTML_ABOUT_INTRO; ?>
                    </td>
                    <td width="20%">
                        <img src="../components/com_realestatemanager/images/rem_logo.png" align="right" alt="Real Estate Manager logo" />
                    </td>	         
                </tr>
            </table>
            <?php
            $tabs->endTab();
            //******************************   tab--2 about   **************************************
            $tabs->startTab(_REALESTATE_MANAGER_ADMIN_ABOUT_RELEASENOTE, "display-page");
            include_once("./components/com_realestatemanager/doc/releasenote.php");
            $tabs->endTab();
            //******************************   tab--3 about--changelog.txt   ***********************
            $tabs->startTab(_REALESTATE_MANAGER_ADMIN_ABOUT_CHANGELOG, "display-page");
            include_once("./components/com_realestatemanager/doc/changelog.html");
            $tabs->endTab();

            $tabs->endPane();
            ?>
        <!-- <input type="hidden" name="option" value="<?php /* echo $option; */ ?>">  -->
        </form>
        <?php
    }


    static function showLanguageManager($const_languages, $pageNav, $search) {
        global $my, $mosConfig_live_site, $mainframe, $templateDir;
        // for 1.6
        global $doc;
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>

        <form action="index.php" method="post" name="adminForm" id="adminForm">

            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist list_11">
                <tr>
                    <td><?php echo _REALESTATE_MANAGER_SHOW_SEARCH; ?></td>
                    <td><input type="text" name="search_const" value="<?php echo $search['const']; ?>" class="inputbox" onChange="document.adminForm.submit();" /></td>
                    <td><input type="text" name="search_const_value" value="<?php echo $search['const_value']; ?>" class="inputbox" onChange="document.adminForm.submit();" /></td>
                    <td><?php echo $search['languages']; ?></td>
                    <td><?php echo $search['sys_type']; ?></td>
        <?php
        if (version_compare(JVERSION, "3.0.0", "ge")) {
            ?>
                        <td>
                            <div class="btn-group pull-right hidden-phone">
                                <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                        <?php echo $pageNav->getLimitBox(); ?>
                            </div>
                        </td>
        <?php } ?>
                </tr>
                <tr>
                    <th width="5" align="center"></th>
                    <th align = "center" class="title" width="30%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_CONST; ?></th>
                    <th align = "center" class="title" width="30%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_VALUE_CONST; ?></th>
                    <th align = "center" class="title" width="10%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_LANGUAGE; ?></th>
                    <th align = "center" class="title" width="30%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_SYS_TYPE; ?></th>
                </tr>
                <?php
                $i = 0;
                foreach ($const_languages as $const_language) {
                    ?>
                    <tr>
                        <td align="center"><?php echo mosHTML::idBox($i, $const_language->id, false, 'bid'); ?></td>
                        <td><a href="#edit" onClick="return listItemTask('cb<?php echo $i; ?>','edit')"><?php echo $const_language->const; ?></a>
                        <td><a href="#edit" onClick="return listItemTask('cb<?php echo $i; ?>','edit')"><?php echo $const_language->value_const; ?></a></td>
                        <td align="center"><?php echo $const_language->title; ?></td>
                        <td align="center"><?php echo $const_language->sys_type; ?></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                <tr><td colspan = "13"><?php echo $pageNav->getListFooter(); ?></td></tr>
            </table>
            <input type="hidden" name="option" value="com_realestatemanager" />
            <input type="hidden" name="section" value="language_manager" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" value="0" name="boxchecked">
        </form>
        <?php
    }

    static function editLanguageManager($row, $lists) {
        global $mosConfig_live_site;
        global $doc;
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>    
        <form action="index.php" method="post" name="adminForm"  id="adminForm" enctype="multipart/form-data">
            <table class="adminform form_33">
                <tr>
                    <th  class="house_manager_caption" align="left">
        <?php echo $row->id ? _HEADER_EDIT : _HEADER_ADD; ?> <?php echo _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_CONST; ?> 
                    </th>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td valign="top">
                        <table class="adminform form_34" >
                            <tr>
                                <td><?php echo _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_CONST; ?>:</td>
                                <td colspan="2"><?php echo $lists['const']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_VALUE_CONST; ?>:</td>
                                <td colspan="2">
                                    <textarea class="text_area" name="value_const" rows="10" cols="100" name="text"><?php echo $row->value_const; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_SYS_TYPE; ?>:</td>
                                <td colspan="2"><?php echo $lists['sys_type']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo _REALESTATE_MANAGER_LABEL_LANGUAGE; ?>:</td>
                                <td colspan="2"><?php echo $lists['languages']; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php echo ":::::: ".$row->id; ?>
            <input type="hidden" name="const" value="<?php echo $lists['const']; ?>"/>
            <input type="hidden" name="option" value="com_realestatemanager" />
            <input type="hidden" name="section" value="language_manager" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
            <input type="hidden" name="sectionid" value="com_realestatemanager" />
        </form>    
        <?php
    }

    static function showFeaturedManager($features, $pageNav, $lists) {
        global $my, $mosConfig_live_site, $mainframe, $templateDir, $realestatemanager_configuration;
        // for 1.6
        global $doc;
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_FEATURED_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
        <form action="index.php" method="post" name="adminForm" id="adminForm">
            <?php
            // Features tabs
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                $options = Array();
                echo JHtml::_('tabs.start', 'feature', $options);
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_LABEL_FEATURE_TAB_1), 'panel_1_feature');
            } else {
                $tabs = new mosTabs(0);
                $tabs->startPane("feature");
                $tabs->startTab('<a href="javascript:rem_initialize();">' . _REALESTATE_MANAGER_ADMIN_LABEL_FEATURE_TAB_1 . '</a>', "feature");
            }
            ?>      
            <table width="100%" class="adminform form_35">
                <tr> 
        <?php $lists['featuredmanager']['placeholder'] = '<input type="text" name="featuredmanager_placeholder" value="' . $realestatemanager_configuration['featuredmanager']['placeholder'] . '" class="inputbox" size="50" maxlength="500" title=""/>'; ?>
                    <td width="185"><?php echo _REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES; ?>:</td>
                    <td width="20"><?php echo mosToolTip(_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_TT_BODY, _REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_TT_HEAD); ?></td>
                    <td class="yesno"><?php echo $lists['featuredmanager']['placeholder']; ?></td>
                </tr>
            </table>

            <?php
            if (version_compare(JVERSION, "3.0.0", "ge")) {
                echo JHtml::_('tabs.panel', JText::_(_REALESTATE_MANAGER_ADMIN_LABEL_FEATURE_TAB_2), 'panel_2_feature');
            } else {
                $tabs->endTab();
                $tabs->startTab('<a href="javascript:rem_initialize();">' . _REALESTATE_MANAGER_ADMIN_LABEL_FEATURE_TAB_2 . '</a>', "feature");
            }
            ?>   

            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist list_12">
                <tr>
                    <th width="5" align="center"><input type="checkbox" name="toggle" onClick="rem_checkAll(this);" /></th>
                    <th align = "center" class="title" width="45%" nowrap="nowrap"><?php echo "Facilities"; ?></th>
                    <th align = "center" class="title" width="35%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_CATEGORY; ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_PUBLISHED; ?></th>
        <?php
        if (version_compare(JVERSION, "3.0.0", "ge")) {
            ?>
                        <td>
                            <div class="btn-group pull-right hidden-phone">
                                <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                        <?php echo $pageNav->getLimitBox(); ?>
                            </div>
                        </td>
                <?php } ?>
                </tr>
                <?php
                $i = 0;
                foreach ($features as $feature) {
                    $task = $feature->published ? 'unpublish' : 'publish';
                    $alt = $feature->published ? 'Unpublish' : 'Publish';
                    $img = $feature->published ? 'tick.png' : 'publish_x.png';
                    ?>
                    <tr>
                        <td align="center"><?php echo mosHTML::idBox($i, $feature->id, false, 'bid'); ?></td>
                        <td><?php echo $feature->name; ?></td>
                        <!--<td><a href="#edit" onClick="return listItemTask('cb<?php // echo $i; ?>','edit')"><?php // echo $feature->name; ?></a>-->
                        <td><?php echo $feature->categories; ?></td>
                        <td align="center"><a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task; ?>')">
                                <?php
                                if (version_compare(JVERSION, "1.6.0", "lt")) {
                                    ?>
                                    <img src="<?php echo $mosConfig_live_site . "/administrator/images/" . $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $templateDir . "/images/admin/" . $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
                <?php
            }
            ?>
                            </a>
                    </tr>
                    <?php
                    $i++;
                }
                ?>

                <?php
                if (version_compare(JVERSION, "3.0.0", "ge")) {
                    echo JHtml::_('tabs.end');
                } else {
                    $tabs->endTab();
                    $tabs->endPane();
                }
                ?>
                <tr><td colspan = "13"><?php echo $pageNav->getListFooter(); ?></td></tr>
            </table>
            <input type="hidden" name="option" value="com_realestatemanager" />
            <input type="hidden" name="section" value="featured_manager" />
            <!--<input type="hidden" name="option" value="<?php echo $option; ?>" />-->
            <input type="hidden" name="task" value="" />
            <input type="hidden" value="0" name="boxchecked">
        </form>
        <?php
    }
	/* FEATURES/ FACILITIES */
    static function editFeaturedManager($row, $lists) {
        global $mosConfig_live_site;
        global $doc;
        $doc->addStyleSheet($mosConfig_live_site . '/administrator/components/com_realestatemanager/admin_realestatemanager.css');
        $doc->addScript($mosConfig_live_site . '/components/com_realestatemanager/includes/functions.js');

        $html = "<div class='house_manager_caption' ><img src='./components/com_realestatemanager/images/building_icon.jpg' alt ='Config' /> " . _REALESTATE_MANAGER_ADMIN_FEATURED_MANAGER . "</div>";
        $app = JFactory::getApplication();
        $app->JComponentTitle = $html;
        ?>
		
		<!--/* EDIT FACILITIES */ -->		
        <form action="index.php" method="post" name="adminForm"  id="adminForm" enctype="multipart/form-data">
            <table class="adminform form_36">
                <tr>
                    <th  class="house_manager_caption" align="left">
        <?php echo $row->id ? _HEADER_EDIT : _HEADER_ADD; ?> <?php echo "Facilities"; ?> 
                    </th>
                </tr>
            </table>
            <table class="adminform form_37" width="100%">
                <tr>
                    <th colspan="3"><?php echo _CATEGORIES__DETAILS; ?></th>
                </tr>
                <tr>
                    <td><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_NAME_ALIAS; ?>:</td>
                    <td colspan="2"><input class="text_area" type="text" name="name" value="<?php echo $row->name; ?>" size="50" maxlength="250" title="<?php echo _REALESTATE_MANAGER_TITLE_TO_TEXTAREA_FOR_ADDFEATURE; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_NAME_ALIAS; ?> FR:</td>
                    <td colspan="2"><input class="text_area" type="text" name="name_fr" value="<?php echo $row->name_fr; ?>" size="50" maxlength="250" title="<?php echo _REALESTATE_MANAGER_TITLE_TO_TEXTAREA_FOR_ADDFEATURE; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_CATEGORY_ALIAS; ?>:</td>
                    <td colspan="2"><?php echo $lists['categories']; ?></td>
                </tr>
                <tr>
                    <td><?php echo _REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_PUBLISHED; ?>:</td>
                    <td colspan="2"><?php echo $lists['published']; ?></td>
                </tr>
				
            </table>

            <input type="hidden" name="option" value="com_realestatemanager" />
            <input type="hidden" name="section" value="featured_manager" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
            <input type="hidden" name="sectionid" value="com_realestatemanager" />
        </form>    
        <?php
    }

}
