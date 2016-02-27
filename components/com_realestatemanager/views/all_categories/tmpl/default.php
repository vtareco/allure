<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
global $hide_js, $Itemid, $acl, $mosConfig_live_site, $my, $mainframe, $doc;
$doc->addStyleSheet($mosConfig_live_site . '/components/com_realestatemanager/includes/realestatemanager.css');
?>
    <?php positions_rem($params->get('allcategories01')); ?>
<div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
<?php echo $currentcat->header; ?>
</div>
<?php positions_rem($params->get('allcategories02')); ?>
<table class="basictable table_44" border="0" cellpadding="4" cellspacing="0" width="100%">
    <tr>
        <td>
<?php echo $currentcat->descrip; ?>
        </td>     
        <td width="120" align="center">
            <img src="./components/com_realestatemanager/images/rem_logo.png" align="right" alt="Real Estate Manager logo"/>
        </td>
    </tr>
</table>
<?php positions_rem($params->get('allcategories03')); ?>

<form action="<?php echo sefRelToAbs("index.php?option=com_realestatemanager&Itemid=" . $Itemid); ?>" method="post" name="adminForm" id="adminForm" >
<?php if ($params->get('show_search')) { ?>
        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
            <div class="realestate_search_button table_45">
                <?php $link = 'index.php?option=com_realestatemanager&amp;task=show_search&amp;catid=' . $catid . '&amp;Itemid=' . $Itemid;
                ?>
                <a href="<?php echo sefRelToAbs($link); ?>">
                    <img align="right" src="./components/com_realestatemanager/images/search.png" alt="Search" border="0" align="left"/><?php echo _REALESTATE_MANAGER_LABEL_SEARCH; ?></a>
            </div>
        </div>
        <br />
        <?php
    }
    HTML_realestatemanager::listCategories($params, $categories, $catid, $tabclass, $currentcat);
    ?>
    <div class="basictable table_46">
        <?php
        mosHTML::BackButton($params, $hide_js);
        ?>
    </div>
</form>
<div style="text-align: center;"><a href="http://ordasoft.com" style="font-size: 10px;">Powered by OrdaSoft!</a></div>
