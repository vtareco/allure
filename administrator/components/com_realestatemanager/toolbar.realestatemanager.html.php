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
 * */
include_once( JPATH_SITE . '/components/com_realestatemanager/compat.joomla1.5.php' );


//*** Get language files
global $mosConfig_absolute_path, $mosConfig_lang;

$mosConfig_absolute_path = $GLOBALS['mosConfig_absolute_path'];
require_once($mosConfig_absolute_path . "/administrator/components/com_realestatemanager/menubar_ext.php");


// load language
$lang_def_en = 0;
$lang = JFactory::getLanguage();
foreach ($lang->getLocale() as $locale) {
    $mosConfig_lang = $locale;
    if (file_exists($mosConfig_absolute_path . "/components/com_realestatemanager/language/{$mosConfig_lang}.php")) {
        include_once($mosConfig_absolute_path . "/components/com_realestatemanager/language/{$mosConfig_lang}.php" );
        $lang_def_en = 1;
        break;
    }
}
if ($lang_def_en != 1) {
    $mosConfig_lang = "english";
    //include_once($mosConfig_absolute_path."/components/com_realestatemanager/language/english.php" );
}

class menucat {

    static function NEW_CATEGORY() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function EDIT_CATEGORY() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function SHOW_CATEGORIES() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::publishList();
        mosMenuBar_ext::unpublishList();
        mosMenuBar_ext::addNew();
        mosMenuBar_ext::editList();
        mosMenuBar_ext::deleteList();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function DEFAULT_CATEGORIES() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::publishList();
        mosMenuBar_ext::unpublishList();
        mosMenuBar_ext::addNew('new', 'Add');
        mosMenuBar_ext::editList();
        mosMenuBar_ext::deleteList();
        mosMenuBar_ext::endTable();
    }

}

class menufeaturedmanager {

    static function NEW_FEATUREDMANAGER() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function EDIT_FEATUREDMANAGER() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function SHOW_FEATUREDMANAGER() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::publishList();
        mosMenuBar_ext::unpublishList();
        mosMenuBar_ext::addNew();
        mosMenuBar_ext::editList();
        mosMenuBar_ext::deleteList();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_FEATUREDMANAGER() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::publishList();
        mosMenuBar_ext::unpublishList();
        mosMenuBar_ext::addNew('add', 'Add');
        mosMenuBar_ext::editList();
        mosMenuBar_ext::save('addFeature', 'Save category');
        mosMenuBar_ext::deleteList();
        mosMenuBar_ext::endTable();
    }

}

class menulanguagemanager {

    static function EDIT_LANGUAGEMANAGER() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_LANGUAGEMANAGER() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::editList();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

}

class menurealestatemanager {

    static function MENU_NEW() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }
    
 static function MENU_EDIT() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::apply('apply', 'apply');

        //*******************  begin add for review edit  **********************
        mosMenuBar_ext::editList('edit_review', _REALESTATE_MANAGER_TOOLBAR_ADMIN_EDIT_REVIEW);
        mosMenuBar_ext::deleteList('', 'delete_review', _REALESTATE_MANAGER_TOOLBAR_ADMIN_DELETE_REVIEW);
        //*******************  end add for review edit  ************************

        mosMenuBar_ext::cancel();
        //mosMenuBar::help();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_DELETE_REVIEW() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::apply('apply', 'apply');
        mosMenuBar_ext::spacer();

        //*******************  begin add for review edit  **********************
        mosMenuBar_ext::editList('edit_review', _REALESTATE_MANAGER_TOOLBAR_ADMIN_EDIT_REVIEW);
        mosMenuBar_ext::deleteList('', 'delete_review', _REALESTATE_MANAGER_TOOLBAR_ADMIN_DELETE_REVIEW);
        //*******************  end add for review edit  ************************

        mosMenuBar_ext::spacer();
        mosMenuBar_ext::cancel();
        //mosMenuBar::help();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    /**
     * Review Villa Edit
     * Editar review de uma villa VMT 14-02-2016 Publish
     */
    static function MENU_EDIT_REVIEW() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save('update_review');
        mosMenuBar_ext::cancel('cancel_review_edit');
        mosMenuBar_ext::apply('publish_manage_review','Publish');
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_CANCEL() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::back();  //old valid  mosMenuBar::cancel();
        //mosMenuBar::help();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_CONFIG() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save('config_save');
        //mosMenuBar::help();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    /**
     * Menu Manage Villas
     */
    static function MENU_DEFAULT() { 
        mosMenuBar_ext::startTable();
        // publish
        mosMenuBar_ext::publishList();
        // unpublish
        mosMenuBar_ext::unpublishList();

      //  mosMenuBar_ext::spacer();

    //    mosMenuBar_ext::NewCustom('rent', 'adminForm', "../administrator/components/com_realestatemanager/images/dm_lend.png", "../administrator/components/com_realestatemanager/images/dm_lend_32.png", _REALESTATE_MANAGER_TOOLBAR_RENT_HOUSES, _REALESTATE_MANAGER_TOOLBAR_ADMIN_RENT, true, 'adminForm');

    //    mosMenuBar_ext::NewCustom('rent_return', 'adminForm', "../administrator/components/com_realestatemanager/images/dm_lend_return.png", "../administrator/components/com_realestatemanager/images/dm_lend_return_32.png", _REALESTATE_MANAGER_TOOLBAR_RETURN_HOUSES, _REALESTATE_MANAGER_TOOLBAR_ADMIN_RETURN, true, 'adminForm');             
        
        /** ESCONDIDO EDIT REVIEW mosMenuBar_ext::editList('edit_rent', _REALESTATE_MANAGER_TOOLBAR_ADMIN_EDIT_RENT);*/
        
        // clone
        mosMenuBar_ext::apply('clone','Clone');
        mosMenuBar_ext::spacer();
        // nova villa
        mosMenuBar_ext::addNew();
        mosMenuBar_ext::spacer();
        
        // apagar villa
        mosMenuBar_ext::deleteList();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_SAVE_BACKEND() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::save();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::apply('apply', 'apply');
        mosMenuBar_ext::back();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_RENT() {
        mosMenuBar_ext::startTable();

        mosMenuBar_ext::NewCustom('rent', 'adminForm', "../administrator/components/com_realestatemanager/images/dm_lend.png", "../administrator/components/com_realestatemanager/images/dm_lend_32.png", _REALESTATE_MANAGER_TOOLBAR_RENT_HOUSES, _REALESTATE_MANAGER_TOOLBAR_ADMIN_RENT, true, 'adminForm');

        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_EDIT_RENT() {
        mosMenuBar_ext::startTable();

        mosMenuBar_ext::NewCustom('edit_rent', 'adminForm', "../administrator/components/com_realestatemanager/images/dm_lend.png", "../administrator/components/com_realestatemanager/images/dm_lend_32.png", _REALESTATE_MANAGER_TOOLBAR_RENT_HOUSES, _REALESTATE_MANAGER_TOOLBAR_ADMIN_RENT, true, 'adminForm');

        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_RENTREQUESTS() {
        global $mosConfig_absolute_path;
        mosMenuBar_ext::startTable();

        mosMenuBar_ext::NewCustom('accept_rent_requests', 'adminForm', '../administrator/components/com_realestatemanager/images/dm_accept.png', '../administrator/components/com_realestatemanager/images/dm_accept_32.png', _REALESTATE_MANAGER_TOOLBAR_ACCEPT_REQUEST, _REALESTATE_MANAGER_TOOLBAR_ADMIN_ACCEPT, true, 'adminForm');

//        mosMenuBar_ext::NewCustom('decline_rent_requests', 'adminForm', '../administrator/components/com_realestatemanager/images/dm_decline.png', '../administrator/components/com_realestatemanager/images/dm_decline_32.png', _REALESTATE_MANAGER_TOOLBAR_EXPORT, _REALESTATE_MANAGER_TOOLBAR_ADMIN_DECLINE, true, 'adminForm');
        mosMenuBar_ext::deleteList('','decline_rent_requests',_REALESTATE_MANAGER_TOOLBAR_ADMIN_DECLINE );


//        mosMenuBar_ext::cancel();
        //mosMenuBar::help(./components/com_realestatemanager/help/1.html);
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

     /**
     * FOR SALE
     */
    static function MENU_BUYINGREQUESTS() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::save();
        mosMenuBar_ext::cancel();
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_RENT_RETURN() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::NewCustom('rent_return', 'adminForm', "../administrator/components/com_realestatemanager/images/dm_lend_return.png", "../administrator/components/com_realestatemanager/images/dm_lend_return_32.png", _REALESTATE_MANAGER_TOOLBAR_RETURN_HOUSES, _REALESTATE_MANAGER_TOOLBAR_ADMIN_RETURN, true, 'adminForm');
        mosMenuBar_ext::cancel();
        //mosMenuBar::help(./components/com_realestatemanager/help/1.html);
        mosMenuBar_ext::spacer();
        mosMenuBar_ext::endTable();
    }

    static function MENU_ABOUT() {
        mosMenuBar_ext::startTable();
        mosMenuBar_ext::back();
        mosMenuBar_ext::endTable();
    }

}

