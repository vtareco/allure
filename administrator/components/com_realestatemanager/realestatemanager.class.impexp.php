<?php

if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

/**
 *
 * @package  RealEstateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com); 
 * Homepage: http://www.ordasoft.com
 * @version: 3.0 Free
 *
 * */
$mosConfig_absolute_path = $GLOBALS['mosConfig_absolute_path'];
//$database = JFactory::getDBO();
// load language
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.feature.php");
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.main.categories.class.php");
require_once $mosConfig_absolute_path . "/administrator/components/com_realestatemanager/language.php";

function print_vars($obj) {
    $arr = get_object_vars($obj);
    while (list($prop, $val) = each($arr))
        if (class_exists($val))
            print_vars($val);
        else
            echo "\t $prop = $val\n<br />";
}

function print_methods($obj) {
    $arr = get_class_methods(get_class($obj));
    foreach ($arr as $method)
        echo "\tfunction $method()\n <br />";
}

if (PHP_VERSION >= 5) {

    // Emulate the old xslt library functions
    function xslt_create() {
        return new XsltProcessor();
    }

    function xslt_process($xsltproc, $xml_arg, $xsl_arg, $xslcontainer = null, $args = null, $params = null) {
        // Create instances of the DomDocument class
        $xml = new DomDocument;
        $xsl = new DomDocument;

        // Load the xml document and the xsl template
        $xml->load($xml_arg);
        $xsl->load($xsl_arg);

        // Load the xsl template
        $xsltproc->importStyleSheet($xsl);

        // Set parameters when defined
        if ($params)
            foreach ($params as $param => $value)
                $xsltproc->setParameter("", $param, $value);
        // Start the transformation
        $processed = $xsltproc->transformToXML($xml);
        // Put the result in a file when specified
        if ($xslcontainer)
            return @file_put_contents($xslcontainer, $processed); else
            return $processed;
    }

    function xslt_free($xsltproc) {
        unset($xsltproc);
    }

}

class mosRealEstateManagerImportExport {

    /**
     * Imports the lines given to this method into the database and writes a
     * table containing the information of the imported houses.
     * The imported houses will be set to [not published] 
     * Format: #;id;isbn;title;author;language
     * @param array lines - an array of lines read from the file
     * @param int catid - the id of the category the houses should be added to 
     */
    static function importHousesCSV($lines, $catid) {
        global $database;
        $retVal = array();
        $i = 0;
        foreach ($lines as $k => $line) {
            $tmp = array();
            if (trim($line) == "")
                continue;
            $line = explode('|', $line);
            array_push($line, "", "");
            $house = new mosRealEstateManager($database);

            $house->houseid = trim($line[0]);
            $house->description = $line[1];
            $house->link = $line[2];
            $house->listing_type = $line[3];
            if (($house->listing_type) != '') {
                $listing_type[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $listing_type[_REALESTATE_MANAGER_OPTION_FOR_RENT] = 1;
                $listing_type[_REALESTATE_MANAGER_OPTION_FOR_SALE] = 2;
                $house->listing_type = $listing_type[$house->listing_type];
            } else
                $house->listing_type = 0;
            $house->price = $line[4];
            $house->priceunit = $line[5];
            $house->htitle = $line[6];
            $house->hcountry = $line[7];
            $house->hregion = $line[8];
            $house->hcity = $line[9];
            $house->hdistrict = $line[10];
            $house->hzipcode = $line[11];
            $house->hlocation = $line[12];
            $house->hlatitude = $line[13];
            $house->hlongitude = $line[14];
            $house->map_zoom = $line[15];
            $house->bathrooms = $line[16];
            $house->bedrooms = $line[17];
            $house->broker = $line[18];
            $house->contacts = $line[19];
            $house->image_link = $line[20];
            $house->listing_status = $line[21];
            if (($house->listing_status) != '') {
                $listing_status[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $listing_status1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
                $k = 1;
                foreach ($listing_status1 as $listing_status2) {
                    $listing_status[$listing_status2] = $k;
                    $k++;
                }
                $house->listing_status = $listing_status[$house->listing_status];
            } else
                $house->listing_status = 0;
            $house->price_type = $line[22];
            if (($house->price_type) != '') {
                $price_type[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $price_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PRICE_TYPE);
                $k = 1;
                foreach ($price_type1 as $price_type2) {
                    $price_type[$price_type2] = $k;
                    $k++;
                }
                $house->price_type = $price_type[$house->price_type];
            } else
                $house->price_type = 0;
            $house->property_type = $line[23];
            if (($house->property_type) != '') {
                $property_type[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
                $k = 1;
                foreach ($property_type1 as $property_type2) {
                    $property_type[$property_type2] = $k;
                    $k++;
                }
                $house->property_type = $property_type[$house->property_type];
            } else
                $house->property_type = 0;
            $house->provider_class = $line[24];
            if (($house->provider_class) != '') {
                $provider_class[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
                $k = 1;
                foreach ($provider_class1 as $provider_class2) {
                    $provider_class[$provider_class2] = $k;
                    $k++;
                }
                $house->provider_class = $provider_class[$house->provider_class];
            } else
                $house->provider_class = 0;
            $house->year = $line[25];
            $house->agent = $line[26];
            $house->area = $line[27];
            $house->expiration_date = $line[28];
            $house->feature = $line[29];
            $house->hoa_dues = $line[30];
            $house->lot_size = $line[31];
            $house->model = $line[32];
            $house->property_taxes = $line[33];
            $house->school = $line[34];
            $house->school_district = $line[35];
            $house->style = $line[36];
            if (($house->style) != '') {
                $style[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
                $k = 1;
                foreach ($style1 as $style2) {
                    $style[$style2] = $k;
                    $k++;
                }
                $house->style = $style[$house->style];
            } else
                $house->style = 0;
            $house->zoning = $line[37];
            if (($house->zoning) != '') {
                $zoning[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_ZONING);
                $k = 1;
                foreach ($zoning1 as $zoning2) {
                    $zoning[$zoning2] = $k;
                    $k++;
                }
                $house->zoning = $zoning[$house->zoning];
            } else
                $house->zoning = 0;
            $house->date = $line[38];
            $house->hits = $line[39];
            $house->published = $line[40];
            $house->owneremail = trim($line[41]);
            $house->featured_clicks = $line[42];
            $house->featured_shows = $line[43];
            $house->extra1 = $line[44];
            $house->extra2 = $line[45];
            $house->extra3 = $line[46];
            $house->extra4 = $line[47];
            $house->extra5 = $line[48];
            $house->extra6 = $line[49];
            $house->extra7 = $line[50];
            $house->extra8 = $line[51];
            $house->extra9 = $line[52];
            $house->extra10 = $line[53];
            $house->language = $line[54];
            $house->owner_id = $line[55];
            $house->catid = $catid;
            $tmp[0] = $i;
            $tmp[1] = $house->houseid;
            $tmp[2] = $house->hlocation;
            $tmp[3] = $house->htitle;
            $tmp[4] = $house->broker;
            if (!$house->check() || !$house->store()) {
                $tmp[5] = $house->getError();
            } else {
                $tmp[5] = "OK";
                $house->saveCatIds($house->catid);
            }
            if (version_compare(JVERSION, "3.0.0", "lt")) {
                $house->checkin();
            }
            $retVal[$i] = $tmp;
            $i++;
        }

        return $retVal;
    }

    static function getXMLItemValue($item, $item_name) {
        $house_items = $item->getElementsByTagname($item_name);
        $house_item = $house_items->item(0);
        if (NULL != $house_item)
            return $house_item->nodeValue;
        else
            return "";
    }

    static function findCategory(&$categories, $new_category) {
        global $database;
        foreach ($categories as $category)
            if ($category->old_id == $new_category->old_id)
                return $category;
        $new_parent_id = -1;
        if ($new_category->old_parent_id != 0) {
            foreach ($categories as $category) {
                if ($category->old_id == $new_category->old_parent_id) {
                    $new_parent_id = $category->id;
                    break;
                }
            }
        } else
            $new_parent_id = 0;

        //sanity test
        if ($new_parent_id === -1) {
            echo "error in import !";
            exit;
        }
        $row = new mainRealEstateCategories($database);
        $row->section = 'com_realestatemanager';
        $row->parent_id = $new_parent_id;
        $row->name = $new_category->name;
        $row->title = $new_category->title;
        $row->published = $new_category->published;
        $row->params = $new_category->params;

        if (!$row->check()) {
            echo "error in import2 !";
            exit;
            exit();
        }
        if (!$row->store()) {
            echo "error in import3 !";
            exit;
            exit();
        }

        $row->updateOrder("section='com_realestatemanager' AND parent_id='$row->parent_id'");
        $new_category->id = $row->id;
        $categories[] = $new_category;
        return $new_category;
    }

//******************   begin add for import XML format   ****************************
    static function importHousesXML($files_name_pars, $catid) {
        global $database;
        $retVal = array();
        $k = 0;
        $new_categories = array();
        $new_relate_ids = array();

        $dom = new domDocument('1.0', 'utf-8');
        $dom->load($files_name_pars);

        if ($catid === null) {
            mosRealEstateManagerImportExport::clearDatabase();
            $cat_list = $dom->getElementsByTagname('category');
            for ($i = 0; $i < $cat_list->length; $i++) {
                $category = $cat_list->item($i);
                $new_category = new stdClass();
                if (mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_section') == 'com_realestatemanager') {
                    $new_category->old_id = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_id');
                    $new_category->old_parent_id = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_parent_id');
                    $new_category->old_asset_id = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_asset_id');
                    $new_category->name = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_name');
                    $new_category->title = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_title');
                    $new_category->alias = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_alias');
                    $new_category->image = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_image');
                    $new_category->section = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_section');
                    $new_category->image_position = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_image_position');
                    $new_category->description = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_description');
                    $new_category->published = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_published');
                    $new_category->checked_out = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_checked_out');
                    $new_category->checked_out_time = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_checked_out_time');
                    $new_category->editor = mosRealEstateManagerImportExport::getXMLItemValue($category, 'editor');
                    $new_category->ordering = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_ordering');
                    $new_category->access = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_access');
                    $new_category->count = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_count');
                    $new_category->params = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_params');
                    if ($new_category->params == '')
                        $new_category->params = '-2';
                    $new_category->params2 = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_params2');
                    $new_category->language = mosRealEstateManagerImportExport::getXMLItemValue($category, 'category_language');
                    $new_category = mosRealEstateManagerImportExport::findCategory($new_categories, $new_category);
                }
            }
        }

        $feature_list = $dom->getElementsByTagname('feature');
        for ($i = 0; $i < $feature_list->length; $i++) {
            $feature = $feature_list->item($i);
            $new_feature = new mosRealEstateManager_feature($database);
            $old_id = mosRealEstateManagerImportExport::getXMLItemValue($feature, 'feature_id');
            $new_feature->name = mosRealEstateManagerImportExport::getXMLItemValue($feature, 'feature_name');
            $new_feature->categories = mosRealEstateManagerImportExport::getXMLItemValue($feature, 'feature_categories');
            $new_feature->published = mosRealEstateManagerImportExport::getXMLItemValue($feature, 'feature_published');
            $new_feature->image_link = mosRealEstateManagerImportExport::getXMLItemValue($feature, 'feature_image_link');
            if (!$new_feature->check() || !$new_feature->store()) {
                $tmp[5] = $new_feature->getError();
            } else {
                $database->setQuery("UPDATE #__rem_feature SET id =" . $old_id . " WHERE id = " . $new_feature->id . "");
                $database->query();
                $tmp[5] = "OK";
            }
        }

        $house_list = $dom->getElementsByTagname('house');
        for ($i = 0; $i < $house_list->length; $i++) {
            $house_class = new mosRealEstateManager($database);
            $house = $house_list->item($i);
            //get HouseID
            $houseid = $house_class->houseid = mosRealEstateManagerImportExport::getXMLItemValue($house, 'houseid');
            //get rent ID
            $house_class->fk_rentid = mosRealEstateManagerImportExport::getXMLItemValue($house, 'fk_rentid');
            //get description
            $house_description = $house_class->description = mosRealEstateManagerImportExport::getXMLItemValue($house, 'description');
            //get link
            $house_class->link = mosRealEstateManagerImportExport::getXMLItemValue($house, 'link');
            //get listing_type
            $house_class->listing_type = mosRealEstateManagerImportExport::getXMLItemValue($house, 'listing_type');
            if (($house_class->listing_type) != '') {
                $listing_type[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $listing_type[_REALESTATE_MANAGER_OPTION_FOR_RENT] = 1;
                $listing_type[_REALESTATE_MANAGER_OPTION_FOR_SALE] = 2;
                $house_class->listing_type = $listing_type[$house_class->listing_type];
            } else
                $house_class->listing_type = 0;
            //get price type
            $house_class->price_type = mosRealEstateManagerImportExport::getXMLItemValue($house, 'price_type');
            if (($house_class->price_type) != '') {
                $price_type[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $price_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PRICE_TYPE);
                $k = 1;
                foreach ($price_type1 as $price_type2) {
                    $price_type[$price_type2] = $k;
                    $k++;
                }
                $house_class->price_type = $price_type[$house_class->price_type];
            } else
                $house_class->price_type = 0;
            //get listing status
            $house_class->listing_status = mosRealEstateManagerImportExport::getXMLItemValue($house, 'listing_status');
            if (($house_class->listing_status) != '') {
                $listing_status[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $listing_status1 = explode(',', _REALESTATE_MANAGER_OPTION_LISTING_STATUS);
                $k = 1;
                foreach ($listing_status1 as $listing_status2) {
                    $listing_status[$listing_status2] = $k;
                    $k++;
                }
                $house_class->listing_status = $listing_status[$house_class->listing_status];
            } else
                $house_class->listing_status = 0;
            //get property type
            $house_class->property_type = mosRealEstateManagerImportExport::getXMLItemValue($house, 'property_type');
            if (($house_class->property_type) != '') {
                $property_type[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $property_type1 = explode(',', _REALESTATE_MANAGER_OPTION_PROPERTY_TYPE);
                $k = 1;
                foreach ($property_type1 as $property_type2) {
                    $property_type[$property_type2] = $k;
                    $k++;
                }
                $house_class->property_type = $property_type[$house_class->property_type];
            } else
                $house_class->property_type = 0;
            //get provider class
            $house_class->provider_class = mosRealEstateManagerImportExport::getXMLItemValue($house, 'provider_class');
            if (($house_class->provider_class) != '') {
                $provider_class[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $provider_class1 = explode(',', _REALESTATE_MANAGER_OPTION_PROVIDER_CLASS);
                $k = 1;
                foreach ($provider_class1 as $provider_class2) {
                    $provider_class[$provider_class2] = $k;
                    $k++;
                }
                $house_class->provider_class = $provider_class[$house_class->provider_class];
            } else
                $house_class->provider_class = 0;
            //get style
            $house_class->style = mosRealEstateManagerImportExport::getXMLItemValue($house, 'style');
            if (($house_class->style) != '') {
                $style[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $style1 = explode(',', _REALESTATE_MANAGER_OPTION_STYLE);
                $k = 1;
                foreach ($style1 as $style2) {
                    $style[$style2] = $k;
                    $k++;
                }
                $house_class->style = $style[$house_class->style];
            } else
                $house_class->style = 0;
            //get zoning
            $house_class->zoning = mosRealEstateManagerImportExport::getXMLItemValue($house, 'zoning');
            if (($house_class->zoning) != '') {
                $zoning[_REALESTATE_MANAGER_OPTION_SELECT] = 0;
                $zoning1 = explode(',', _REALESTATE_MANAGER_OPTION_ZONING);
                $k = 1;
                foreach ($zoning1 as $zoning2) {
                    $zoning[$zoning2] = $k;
                    $k++;
                }
                $house_class->zoning = $zoning[$house_class->zoning];
            } else
                $house_class->zoning = 0;
            //get price
            $house_class->price = mosRealEstateManagerImportExport::getXMLItemValue($house, 'price');
            $house_priceunit = $house_class->priceunit = mosRealEstateManagerImportExport::getXMLItemValue($house, 'priceunit');
            //get Title(house)
            $house_htitle = $house_class->htitle = mosRealEstateManagerImportExport::getXMLItemValue($house, 'htitle');
            //get country
            $house_class->hcountry = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hcountry');
            //get region
            $house_class->hregion = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hregion');
            //get city
            $house_class->hcity = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hcity');
            //get district
            $house_class->hdistrict = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hdistrict');
            //get zipcode
            $house_class->hzipcode = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hzipcode');
            //get location
            $house_hlocation = $house_class->hlocation = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hlocation');
            //get latitude
            $house_hlatitude = $house_class->hlatitude = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hlatitude');
            //get longitude
            $house_hlongitude = $house_class->hlongitude = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hlongitude');
            //get map_zoom
            $house_map_zoom = $house_class->map_zoom = mosRealEstateManagerImportExport::getXMLItemValue($house, 'map_zoom');
            //get bathrooms
            $house_class->bathrooms = mosRealEstateManagerImportExport::getXMLItemValue($house, 'bathrooms');
            //get bedrooms
            $house_class->bedrooms = mosRealEstateManagerImportExport::getXMLItemValue($house, 'bedrooms');
            //get broker
            $house_class->broker = mosRealEstateManagerImportExport::getXMLItemValue($house, 'broker');
            //get contacts
            $house_class->contacts = mosRealEstateManagerImportExport::getXMLItemValue($house, 'contacts');
            //get image_link
            $house_class->image_link = mosRealEstateManagerImportExport::getXMLItemValue($house, 'image_link');
            //get year
            $house_class->year = mosRealEstateManagerImportExport::getXMLItemValue($house, 'year');
            //get agent
            $house_class->agent = mosRealEstateManagerImportExport::getXMLItemValue($house, 'agent');
            //get area
            $house_class->area = mosRealEstateManagerImportExport::getXMLItemValue($house, 'area');
            //get expiration_date
            $house_class->expiration_date = mosRealEstateManagerImportExport::getXMLItemValue($house, 'expiration_date');
            //get feature
            $house_class->feature = mosRealEstateManagerImportExport::getXMLItemValue($house, 'feature');
            //get hoa_dues
            $house_class->hoa_dues = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hoa_dues');
            //get lot_size
            $house_class->lot_size = mosRealEstateManagerImportExport::getXMLItemValue($house, 'lot_size');
            //get model
            $house_class->model = mosRealEstateManagerImportExport::getXMLItemValue($house, 'model');
            //get property_taxes
            $house_class->property_taxes = mosRealEstateManagerImportExport::getXMLItemValue($house, 'property_taxes');
            //get school
            $house_class->school = mosRealEstateManagerImportExport::getXMLItemValue($house, 'school');
            //get school_district
            $house_class->school_district = mosRealEstateManagerImportExport::getXMLItemValue($house, 'school_district');
            //get date
            $house_class->date = mosRealEstateManagerImportExport::getXMLItemValue($house, 'date');
            //get hits
            $house_class->hits = mosRealEstateManagerImportExport::getXMLItemValue($house, 'hits');
            //get published
            $house_class->published = mosRealEstateManagerImportExport::getXMLItemValue($house, 'published');
            //get owneremail
            $house_class->owneremail = mosRealEstateManagerImportExport::getXMLItemValue($house, 'owneremail');
            //get featured_clicks
            $house_class->featured_clicks = mosRealEstateManagerImportExport::getXMLItemValue($house, 'featured_clicks');
            //get featured_shows
            $house_class->featured_shows = mosRealEstateManagerImportExport::getXMLItemValue($house, 'featured_shows');
            //get owner_id
            $house_class->extra1 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra1');
            //get owner_id
            $house_class->extra2 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra2');
            //get owner_id
            $house_class->extra3 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra3');
            //get owner_id
            $house_class->extra4 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra4');
            //get owner_id
            $house_class->extra5 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra5');
            //get owner_id
            $house_class->extra6 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra6');
            //get owner_id
            $house_class->extra7 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra7');
            //get owner_id
            $house_class->extra8 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra8');
            //get owner_id
            $house_class->extra9 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra9');
            //get owner_id
            $house_class->extra10 = mosRealEstateManagerImportExport::getXMLItemValue($house, 'extra10');
            //get language
            $house_class->language = mosRealEstateManagerImportExport::getXMLItemValue($house, 'language');
            //get owner_id
            $house_class->owner_id = mosRealEstateManagerImportExport::getXMLItemValue($house, 'owner_id');

            //get category
            if ($catid === null) {
                $new_category = new stdClass();
                $catidsxml = $house->getElementsByTagname('catid');
                $tempcat = array();
                for ($t = 0; $t < $catidsxml->length; $t++) {
                    $tempxml[$t] = $catidsxml->item($t);
                    $new_category = new stdClass();
                    $new_category->old_id = $tempxml[$t]->nodeValue;
                    $new_category = mosRealEstateManagerImportExport::findCategory($new_categories, $new_category);
                    $tempcat[] = $new_category->id;
                }
            } else {
                $tempcat = array();
                ;
                $tempcat[] = $catid;
            }

            //for output rezult in table
            $tmp[0] = $i;
            $tmp[1] = $houseid;
            $tmp[2] = $house_hlocation;
            $tmp[3] = $house_htitle;
            $tmp[4] = $house_class->broker;

            //check houseid for existing
            if (!$house_class->check() || !$house_class->store()) {
                $tmp[5] = $house_class->getError();
            } else {
                $house_class->saveCatIds($tempcat);
                $tmp[5] = "OK";
            }
            $retVal[$i] = $tmp;

            //get Reviews
            if ($tmp[5] == "OK" && mosRealEstateManagerImportExport::getXMLItemValue($house, 'reviews') != "") {
                $review_list = $house->getElementsByTagname('review');
                for ($j = 0; $j < $review_list->length; $j++) {
                    $review = $review_list->item($j);
                    //get for review - user_name
                    $review_user_name = mosRealEstateManagerImportExport::getXMLItemValue($review, 'user_name');
                    //get for review - user_email
                    $review_user_email = mosRealEstateManagerImportExport::getXMLItemValue($review, 'user_email');
                    //get for review - date
                    $review_date = mosRealEstateManagerImportExport::getXMLItemValue($review, 'date');
                    //get for review - rating
                    $review_rating = mosRealEstateManagerImportExport::getXMLItemValue($review, 'rating');
                    //get for review - title
                    $review_title = mosRealEstateManagerImportExport::getXMLItemValue($review, 'title');
                    //get for review - comment
                    $review_comment = mosRealEstateManagerImportExport::getXMLItemValue($review, 'comment');
                    //get for review - publish
                    $review_published = mosRealEstateManagerImportExport::getXMLItemValue($review, 'published');

                    //insert data in table #__rem_review
                    $database->setQuery("INSERT INTO #__rem_review" .
                            "\n (fk_houseid, user_name,user_email, date, rating, title, comment, published)" .
                            "\n VALUES " .
                            "\n (" . $house_class->id . ", '" . $review_user_name . "', '" . $review_user_email .
                            "', '" . $review_date . "'," . $review_rating . ",'" . $review_title . "', '" . $review_comment . "', '" . $review_published . "');");
                    $database->query();
                } //end for(...) - REVIEW
            } //end if(...) - REVIEW
            //get rents
            if ($tmp[5] == "OK" && mosRealEstateManagerImportExport::getXMLItemValue($house, 'rents') != "") {
                $rent_list = $house->getElementsByTagname('rent');
                for ($j = 0; $j < $rent_list->length; $j++) {
                    $rent = $rent_list->item($j);
                    $help = new mosRealEstateManager_rent($database);
                    $help->fk_houseid = $house_class->houseid;
                    //get for rent - rent_from
                    $help->rent_from = mosRealEstateManagerImportExport::getXMLItemValue($rent, 'rent_from');
                    //get for rent - rent_until
                    $help->rent_until = mosRealEstateManagerImportExport::getXMLItemValue($rent, 'rent_until');
                    //get for rent - rent_return
                    $rent_return = mosRealEstateManagerImportExport::getXMLItemValue($rent, 'rent_return');
                    //get for rent - user_name
                    $help->user_name = mosRealEstateManagerImportExport::getXMLItemValue($rent, 'user_name');
                    //get for rent - user_email
                    $help->user_email = mosRealEstateManagerImportExport::getXMLItemValue($rent, 'user_email');
                    //get for rent - user_mailing
                    $help->user_mailing = mosRealEstateManagerImportExport::getXMLItemValue($rent, 'user_mailing');

                    //insert data in table #__rem_rent
                    if (empty($rent_return))
                        $help->rent_return = new stdClass(); else
                        $help->rent_return = $rent_return;

                    if (!$help->check() || !$help->store()) {
                        $tmp[5] = $help->getError();
                    } else {
                        $house_class->fk_rentid = $help->id;
                        if (!$house_class->check() || !$house_class->store()) {
                            $tmp[5] = $house_class->getError();
                        } else
                            $tmp[5] = "OK";
                    }
                } //end for(...) - rent
            } //end if(...) - rent
            //get rentrequests
            if ($tmp[5] == "OK" && mosRealEstateManagerImportExport::getXMLItemValue($house, 'rentrequests') != "") {
                $rentrequests_list = $house->getElementsByTagname('rentrequest');
                for ($j = 0; $j < $rentrequests_list->length; $j++) {
                    $rentrequest = $rentrequests_list->item($j);
                    //get for rentrequest - rent_from
                    $rr_rent_from = mosRealEstateManagerImportExport::getXMLItemValue($rentrequest, 'rent_from');
                    //get for rentrequest - rent_until
                    $rr_rent_until = mosRealEstateManagerImportExport::getXMLItemValue($rentrequest, 'rent_until');
                    //get for rentrequest - rent_return
                    $rr_rent_request = mosRealEstateManagerImportExport::getXMLItemValue($rentrequest, 'rent_request');
                    //get for rentrequest - user_name
                    $rr_user_name = mosRealEstateManagerImportExport::getXMLItemValue($rentrequest, 'user_name');
                    //get for rentrequest - user_email
                    $rr_user_email = mosRealEstateManagerImportExport::getXMLItemValue($rentrequest, 'user_email');
                    //get for rentrequest - user_mailing
                    $rr_user_mailing = mosRealEstateManagerImportExport::getXMLItemValue($rentrequest, 'user_mailing');
                    //get for rentrequest - status
                    $rr_status = mosRealEstateManagerImportExport::getXMLItemValue($rentrequest, 'status');

                    //insert data in table #__rem_rent_request
                    $database->setQuery("INSERT INTO #__rem_rent_request " .
                            "\n (fk_houseid, rent_from,rent_until, rent_request, user_name, user_email, user_mailing,status)" .
                            "\n VALUES " .
                            "\n (" . $house_class->id . ", '" . $rr_rent_from . "', '" . $rr_rent_until .
                            "', '" . $rr_rent_request . "','" . $rr_user_name . "','" . $rr_user_email . "', '" . $rr_user_mailing .
                            "', '" . $rr_status . "');");
                    $database->query();
                } //end for(...) - rentrequest
            } //end if(...) - rentrequest
            //get buyingrequests
            if ($tmp[5] == "OK" && mosRealEstateManagerImportExport::getXMLItemValue($house, 'buyingrequests') != "") {
                $buyingrequests_list = $house->getElementsByTagname('buyingrequest');
                for ($j = 0; $j < $buyingrequests_list->length; $j++) {
                    $buyingrequest = $buyingrequests_list->item($j);
                    //get for $buyingrequest - buying_request
                    $br_buying_request = mosRealEstateManagerImportExport::getXMLItemValue($buyingrequest, 'buying_request');
                    //get for $buyingrequest - customer_name
                    $br_customer_name = mosRealEstateManagerImportExport::getXMLItemValue($buyingrequest, 'customer_name');
                    //get for $buyingrequest - customer_email
                    $br_customer_email = mosRealEstateManagerImportExport::getXMLItemValue($buyingrequest, 'customer_email');
                    //get for $buyingrequest - customer_phone
                    $br_customer_phone = mosRealEstateManagerImportExport::getXMLItemValue($buyingrequest, 'customer_phone');
                    //get for $buyingrequest - status
                    $br_status = mosRealEstateManagerImportExport::getXMLItemValue($buyingrequest, 'status');

                    //insert data in table #__rem_buying_request
                    $database->setQuery("INSERT INTO #__rem_buying_request " .
                            "\n (fk_houseid, buying_request, customer_name, customer_email, customer_phone,status)" .
                            "\n VALUES " .
                            "\n (" . $house_class->id .
                            ", '" . $br_buying_request . "','" . $br_customer_name . "','" . $br_customer_email . "', '" . $br_customer_phone .
                            "', '" . $br_status . "');");
                    $database->query();
                } //end for(...) - $buyingrequest
            } //end if(...) - $buyingrequest
            //get images
            if ($tmp[5] == "OK" && mosRealEstateManagerImportExport::getXMLItemValue($house, 'images') != "") {
                $images_list = $house->getElementsByTagname('image');
                for ($j = 0; $j < $images_list->length; $j++) {
                    $image = $images_list->item($j);
                    //get for $image - thumbnail_img
                    $image_thumbnail_img = mosRealEstateManagerImportExport::getXMLItemValue($image, 'thumbnail_img');
                    //get for $image - main_img
                    $image_main_img = mosRealEstateManagerImportExport::getXMLItemValue($image, 'main_img');
                    //insert data in table #__rem_photos
                    $database->setQuery("INSERT INTO #__rem_photos " .
                            "\n (fk_houseid, thumbnail_img, main_img)" .
                            "\n VALUES " .
                            "\n (" . $house_class->id .
                            ", '" . $image_thumbnail_img . "','" . $image_main_img . "');");
                    $database->query();
                } //end for(...) - images
            } //end if(...) - images
        }//end for(...) - house
        return $retVal;
    }

//***************************************************************************************************
//***********************   end add for import XML format   *****************************************
//***************************************************************************************************


    static function exportHousesXML($houses, $all) {
        global $mosConfig_live_site, $mosConfig_absolute_path, $realestatemanager_configuration, $database;
        $strXmlDoc = "";
        $strXmlDoc .= "<?xml version='1.0' encoding='utf-8'?>\n";
        $strXmlDoc .= "<houses_data>\n";
        $strXmlDoc .= "<version>";
        $strXmlDoc .= $realestatemanager_configuration['release']['version'];
        $strXmlDoc .= "</version>\n";

        if ($all) {
            //create and append list element
            $strXmlDoc .= "<categories>\n";
            $database->setQuery("SELECT *  FROM #__rem_main_categories " .
                    "WHERE section='com_realestatemanager' order by parent_id ; ");
            $categories = $database->loadObjectList();
            foreach ($categories as $category) {
                //add category
                $strXmlDoc .= "<category>\n";
                $strXmlDoc .= "<category_id>" . $category->id . "</category_id>";
                $strXmlDoc .= "<category_parent_id>" . $category->parent_id . "</category_parent_id>";
                $strXmlDoc .= "<category_asset_id>" . $category->asset_id . "</category_asset_id>";
                $strXmlDoc .= "<category_title><![CDATA[" . $category->title . "]]></category_title>";
                $strXmlDoc .= "<category_name><![CDATA[" . $category->name . "]]></category_name>";
                $strXmlDoc .= "<category_alias><![CDATA[" . $category->alias . "]]></category_alias>";
                $strXmlDoc .= "<category_image><![CDATA[" . $category->image . "]]></category_image>";
                $strXmlDoc .= "<category_section><![CDATA[" . $category->section . "]]></category_section>";
                $strXmlDoc .= "<category_image_position><![CDATA[" . $category->image_position . "]]></category_image_position>";
                $strXmlDoc .= "<category_description><![CDATA[" . $category->description . "]]></category_description>";
                $strXmlDoc .= "<category_published><![CDATA[" . $category->published . "]]></category_published>";
                $strXmlDoc .= "<category_checked_out><![CDATA[" . $category->checked_out . "]]></category_checked_out>";
                $strXmlDoc .= "<category_checked_out_time><![CDATA[" . $category->checked_out_time . "]]></category_checked_out_time>";
                $strXmlDoc .= "<category_editor><![CDATA[" . $category->editor . "]]></category_editor>";
                $strXmlDoc .= "<category_ordering><![CDATA[" . $category->ordering . "]]></category_ordering>";
                $strXmlDoc .= "<category_access><![CDATA[" . $category->access . "]]></category_access>";
                $strXmlDoc .= "<category_count><![CDATA[" . $category->count . "]]></category_count>";
                $strXmlDoc .= "<category_params><![CDATA[" . $category->params . "]]></category_params>";
                $strXmlDoc .= "<category_params2><![CDATA[" . $category->params2 . "]]></category_params2>";
                $strXmlDoc .= "<category_language><![CDATA[" . $category->language . "]]></category_language>";
                $strXmlDoc .= "</category>\n";
            }
            $strXmlDoc .= "</categories>\n";

            $strXmlDoc .= "<features>\n";
            $database->setQuery("SELECT * FROM #__rem_feature ");
            $features = $database->loadObjectList();

            foreach ($features as $feature) {
                //add features
                $strXmlDoc .= "<feature>\n";
                $strXmlDoc .= "<feature_id>" . $feature->id . "</feature_id>";
                $strXmlDoc .= "<feature_name><![CDATA[" . $feature->name . "]]></feature_name>";
                $strXmlDoc .= "<feature_categories><![CDATA[" . $feature->categories . "]]></feature_categories>";
                $strXmlDoc .= "<feature_published><![CDATA[" . $feature->published . "]]></feature_published>";
                $strXmlDoc .= "<feature_image_link><![CDATA[" . $feature->image_link . "]]></feature_image_link>";
                $strXmlDoc .= "</feature>\n";
            }
            //create and append list element
            $strXmlDoc .= "</features>\n";

            $strXmlDoc .= "<features_houses>\n";
            $database->setQuery("SELECT * FROM #__rem_feature_houses ");
            $features_houses = $database->loadObjectList();

            foreach ($features_houses as $feature_house) {
                //add feature houses
                $strXmlDoc .= "<feature_house>\n";
                $strXmlDoc .= "<feature_house_id>" . $feature_house->id . "</feature_house_id>";
                $strXmlDoc .= "<feature_house_fk_houseid><![CDATA[" . $feature_house->fk_houseid . "]]></feature_house_fk_houseid>";
                $strXmlDoc .= "<feature_house_fk_featureid><![CDATA[" . $feature_house->fk_featureid . "]]></feature_house_fk_featureid>";
                $strXmlDoc .= "</feature_house>\n";
            }
            //create and append list element
            $strXmlDoc .= "</features_houses>\n";
        }
        //create and append list element
        $strXmlDoc .= "<houses_list>\n";
        foreach ($houses as $house)
            $strXmlDoc .= $house->toXML2($all);
        $strXmlDoc .= "</houses_list>\n";
        $strXmlDoc .= "</houses_data>";
        return $strXmlDoc;
    }

    static function storeExportFile($data, $type) {

        global $mosConfig_live_site, $mosConfig_absolute_path, $realestatemanager_configuration;
        $fileName = "realestatemanager_" . date("Ymd_His");
        $fileBase = "/administrator/components/com_realestatemanager/exports/";

        //write the xml file
        $fp = fopen($mosConfig_absolute_path . $fileBase . $fileName . ".xml", "w", 0); #open for writing

        fwrite($fp, $data); #write all of $data to our opened file
        fclose($fp); #close the file
        $InformationArray = array();
        $InformationArray['xml_file'] = $fileName . '.xml';
        $InformationArray['log_file'] = $fileName . '.log';
        $InformationArray['fileBase'] = "file://" . getcwd() . "/components/com_realestatemanager/exports/";
        $InformationArray['urlBase'] = $mosConfig_live_site . $fileBase;
        $InformationArray['out_file'] = $InformationArray['xml_file'];
        $InformationArray['error'] = new stdClass();

        switch ($type) {
            case 'csv':
                $InformationArray['xslt_file'] = 'csv.xsl';
                $InformationArray['out_file'] = $fileName . '.csv';
                mosRealEstateManagerImportExport :: transformPHP4($InformationArray);
                break;
            default:
                break;
        }
        return $InformationArray;
    }

    static function transformPHP4(&$InformationArray) {

        // create the XSLT processor^M
        $xh = xslt_create() or die("Could not create XSLT processor");

        // Process the document
        $result = xslt_process($xh, $InformationArray['fileBase'] . $InformationArray['xml_file'], $InformationArray['fileBase'] . $InformationArray['xslt_file'], $InformationArray['fileBase'] . $InformationArray['out_file']);

        if (!$result) {
            // Something croaked. Show the error
            $InformationArray['error'] = "Cannot process XSLT document: ";
        }
        // Destroy the XSLT processor
        xslt_free($xh);
    }

    static function clearDatabase() {
        global $database;
        $database->setQuery("DELETE FROM #__rem_main_categories "); // for 1.6
        $database->query();
        $database->setQuery("DELETE FROM #__rem_feature_houses");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_feature");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_categories");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_houses");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_photos");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_rent");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_rent_request");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_review");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_buying_request");
        $database->query();
        $database->setQuery("DELETE FROM #__rem_suggestion");
        $database->query();
    }

}
