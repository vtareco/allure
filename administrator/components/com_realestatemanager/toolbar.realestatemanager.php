<?php

if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
 *
 * @package  RealEstateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com)
 * Homepage: http://www.ordasoft.com
 * @version: 3.0 Pro
 *
 *
 */
$mainframe = $GLOBALS['mainframe'] = JFactory::getApplication(); // for 1.6
if (stristr($_SERVER['PHP_SELF'], 'administrator')) {
    @define('_VM_IS_BACKEND', '1');
}
defined('_VM_TOOLBAR_LOADED') or define('_VM_TOOLBAR_LOADED', 1);
include_once (JPATH_SITE . '/components/com_realestatemanager/compat.joomla1.5.php');
$path = JPATH_SITE . "/administrator/components/com_realestatemanager/";
// ensure this file is being included by a parent file
require_once ($path . 'toolbar_ext.php');
require_once ($path . 'toolbar.realestatemanager.html.php');
require_once (JPATH_SITE . '/components/com_realestatemanager/functions.php');
$database = JFactory::getDBO();
if (version_compare(JVERSION, "3.0.0", "ge")) {
    // load language
    require_once $mosConfig_absolute_path . "/administrator/components/com_realestatemanager/language.php";
}
$section = mosGetParam($_REQUEST, 'section', 'courses');
if (isset($section) && $section == 'categories') {
    switch ($task) {
        case "add":
            menucat::NEW_CATEGORY();
            addSubmenuRealEstate("Categories");
            break;
        case "edit":
            menucat::EDIT_CATEGORY();
            addSubmenuRealEstate("Categories");
            break;
        default:
            menucat::SHOW_CATEGORIES();
            addSubmenuRealEstate("Categories");
            break;
    }
} elseif ($section == 'featured_manager') {
    switch ($task) {
        case "add":
            menufeaturedmanager::NEW_FEATUREDMANAGER();
            addSubmenuRealEstate("Features Manager");
            break;
        case "edit":
            menufeaturedmanager::EDIT_FEATUREDMANAGER();
            addSubmenuRealEstate("Features Manager");
            break;
        default:
            menufeaturedmanager::MENU_FEATUREDMANAGER();
            addSubmenuRealEstate("Features Manager");
            break;
    }
} elseif ($section == 'language_manager') {
    switch ($task) {
        case "copy":
            menulanguagemanager::EDIT_LANGUAGEMANAGER();
            addSubmenuRealEstate("Language Manager");
            break;
        case "edit":
            menulanguagemanager::EDIT_LANGUAGEMANAGER();
            addSubmenuRealEstate("Language Manager");
            break;
        default:
            menulanguagemanager::MENU_LANGUAGEMANAGER();
            addSubmenuRealEstate("Language Manager");
            break;
    }
} else {
    switch ($task) {
        case "add":
            menurealestatemanager::MENU_SAVE_BACKEND();
            addSubmenuRealEstate("Houses");
            break;
        case "edit":
            menurealestatemanager::MENU_EDIT();
            addSubmenuRealEstate("Houses");
            break;

        case "rent":
            menurealestatemanager::MENU_RENT();
            addSubmenuRealEstate("Rent Requests");
            break;
        case "edit_rent":
            menurealestatemanager::MENU_EDIT_RENT();
            addSubmenuRealEstate("Rent Requests");
            break;
        case "rent_return":
            menurealestatemanager::MENU_RENT_RETURN();
            addSubmenuRealEstate("Rent Requests");
            break;
        case "rent_requests":
            menurealestatemanager::MENU_RENTREQUESTS();
            addSubmenuRealEstate("Rent Requests");
            break;
        case "buying_requests":
            menurealestatemanager::MENU_BUYINGREQUESTS();
            addSubmenuRealEstate("For Sale"); // Sale Manager
            break;

        case "config":
            menurealestatemanager::MENU_CONFIG();
            addSubmenuRealEstate("Settings");
            break;
        case "config_save":
            menurealestatemanager::MENU_CONFIG();
            addSubmenuRealEstate("Settings");
            break;
        case "about":
            menurealestatemanager::MENU_ABOUT();
            addSubmenuRealEstate("About");
            break;
        case "delete_review":
            menurealestatemanager::MENU_DELETE_REVIEW();
            addSubmenuRealEstate("Houses");
            break;
        case "edit_review":
            menurealestatemanager::MENU_EDIT_REVIEW();
            addSubmenuRealEstate("Houses");
            break;
        case "update_review":
            menurealestatemanager::MENU_EDIT();
            addSubmenuRealEstate("Houses");
            break;
        case "cancel_review_edit":
            menurealestatemanager::MENU_EDIT();
            addSubmenuRealEstate("Houses");
            break;

        default:
            menurealestatemanager::MENU_DEFAULT();
            addSubmenuRealEstate("Houses");
            break;
    }
} //else
 