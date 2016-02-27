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
 *
 */
$mosConfig_absolute_path = $GLOBALS['mosConfig_absolute_path'];
if (version_compare(JVERSION, "3.0.0", "lt")) {
    jimport('joomla.html.toolbar');
}
if (!class_exists('JToolBarHelper_ext')) {

    class JToolBarHelper_ext extends JToolBarHelper {

        static function NewSave($task = '', $page, $icon = '', $iconOver = '', $alt = '', $listSelect = true, $formName = "adminForm") {
            $bar = JToolBar::getInstance('toolbar');
            if (empty($task)) {
                $image_name = uniqid("img_");
            } else {
                $image_name = $task;
            }
            if ($icon && $iconOver) {
                $bar->appendButton('NewSave', "<a class=\"toolbar\" 
                                      onmouseout=\"MM_swapImgRestore();\"  
                                      onmouseover=\"MM_swapImage('$image_name','','$iconOver',1);\">
                      <img name=\"$image_name\" title = \"$alt\" src=\"$icon\" alt=\"$alt\" border=\"0\" 
                                                                                               align=\"middle\"/>
                            &nbsp;<br/>$alt</a>");
            } else {
                // The button is just a link then!
                $bar->appendButton('Custom', "<a class=\"toolbar\" title = \"$alt\" href=\"$href\">&nbsp;$alt<a>");
            }
        }

        static function NewCustom_I($task = '', $page, $icon = '', $iconOver = '', $text = '', $alt = '', $listSelect = true, $formName = "adminForm") {
            global $VM_LANG;
            $bar = JToolBar::getInstance('toolbar');
            if ($listSelect) {
                if (empty($func))
                    $href = "javascript:if (document.adminForm.import_type.value == 0){ alert('$text');}
                                                        else{submitbutton('$task')}";
                else
                    $href = "javascript:submitbutton('$task')";
            } else {
                $href = "javascript:submitbutton('$task')";
            }
            if (empty($task)) {
                $image_name = uniqid("img_");
            } else {
                $image_name = $task;
            }
            if ($icon && $iconOver) {
                $bar->appendButton('Custom', "<a class=\"toolbar\" href=\"$href\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('$image_name','','$iconOver',1);\">
    <img name=\"$image_name\"title = \"$alt\" src=\"$icon\" alt=\"$alt\" border=\"0\" align=\"middle\" />
    &nbsp;$alt</a>");
            } else {
                // The button is just a link then!
                $bar->appendButton('Custom', "<a class=\"toolbar\" title = \"$alt\" href=\"$href\">&nbsp;$alt</a>");
            }
        }

        static function NewCustom_E($task = '', $page, $icon = '', $iconOver = '', $text = '', $alt = '', $listSelect = true, $formName = "adminForm") {
            global $VM_LANG;
            $bar = JToolBar::getInstance('toolbar');
            if ($listSelect) {
                if (empty($func))
                    $href = "javascript:if (document.adminForm.export_type.value == 0){ alert('$text');}
                                                        else{submitbutton('$task')}";
                else
                    $href = "javascript:submitbutton('$task')";
            } else {
                $href = "javascript:submitbutton('$task')";
            }
            if (empty($task)) {
                $image_name = uniqid("img_");
            } else {
                $image_name = $task;
            }
            if ($icon && $iconOver) {
                $bar->appendButton('Custom', "<a class=\"toolbar\" href=\"$href\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('$image_name','','$iconOver',1);\">
                            <img name=\"$image_name\" title = \"$alt\" src=\"$icon\" alt=\"$alt\" border=\"0\" align=\"middle\" />
                            &nbsp;$alt</a>");
            } else {
                // The button is just a link then!
                $bar->appendButton('Custom', "<a class=\"toolbar\" title = \"$alt\" href=\"$href\">&nbsp;$alt</a>");
            }
        }

        static function NewCustom($task = '', $page, $icon = '', $iconOver = '', $text = '', $alt = '', $listSelect = true, $formName = "adminForm") {
            global $VM_LANG;
            $bar = JToolBar::getInstance('toolbar');
            if ($listSelect) {
                if (empty($func))
                    $href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('$text');}else{rem_submitButton('$task','$formName', '$page')}";
                else
                    $href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('$text');}else{rem_submitListFunc('$task','$formName', '$func')}";
            } else {
                $href = "javascript:rem_submitButton('$task','$formName', '$page')";
            }
            if (empty($task)) {
                $image_name = uniqid("img_");
            } else {
                $image_name = $task;
            }
            if ($icon && $iconOver) {
                $bar->appendButton('Custom', "<a class=\"toolbar\" href=\"$href\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('$image_name','','$iconOver',1);\">
                            <img name=\"$image_name\" title = \"$alt\" src=\"$icon\" alt=\"$alt\" border=\"0\" align=\"middle\" />
                            &nbsp;$alt</a>");
            } else {
                // The button is just a link then!
                $bar->appendButton('Custom', "<a class=\"toolbar\" title = \"$alt\" href=\"$href\">&nbsp;$alt<a>");
            }
        }

    }

}
 