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
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.rent.php");
require_once ($mosConfig_absolute_path . "/components/com_realestatemanager/realestatemanager.class.review.php");

/**
 * House database table class
 */
class mosRealEstateManager extends JTable {
    //keys

    /** @var int Primary key */
    var $id = null;

    var $id_true = null;
    
    /** @var string */
    var $asset_id = null;

    /** @var int */
    var $houseid = null;

    /** @var int */
    var $catid = null;

    /** @var int */
    var $sid = null;

    /** @var int */
    var $fk_rentid = null;
    //Required fields

    /** @var varchar(250) */
    var $description = null;

    /** @var varchar(250) */
    var $link = null;

    /** @var varchar(45) */
    var $listing_type = null; //(for rent or for sale)

    /** @var varchar(14) */
    var $price = null;

    /** @var varchar(14) */
    var $priceunit = null;

    /** @var varchar(200) */
    var $htitle = null; //beautiful rooms and views
    //Address fields

    /** @var varchar(50) */
    var $hcountry = null;

    /** @var varchar(50) */
    var $hregion = null;

    /** @var varchar(50) */
    var $hcity = null;

    /** @var varchar(50) */
    var $hdistrict = null;

    /** @var varchar(100) */
    var $hzipcode = null;

    /** @var varchar(100) */
    var $hlocation = null; //address of house

    /** @var varchar(20) */
    var $hlatitude = null; //latitude of house

    /** @var varchar(20) */
    var $hlongitude = null; //longitude of house

    /** @var tinyint(4) */
    var $map_zoom = 1; //google map zoom
    //Recommended fields

    /** @var int */
    var $bathrooms = null;

    /** @var int */
    var $bedrooms = null;

    /** @var varchar(100) */
    var $broker = null;

    /** @var varchar(200) */
    var $contacts = null;

    /** @var varchar(200) */
    var $image_link = null;

    /** @var varchar(45) */
    var $listing_status = null;

    /** @var varchar(45) */
    var $price_type = null; //negotiable or starting

    /** @var varchar(45) */
    var $property_type = null; //apartmemt or land

    /** @var varchar(45) */
    var $provider_class = null; //agent, aggregator, broker, franchisor

    /** @var varchar(4) */
    var $year = null;
    //Optional fields

    /** @var varchar(45) */
    var $agent = null;

    /** @var int */
    var $area = null;

    /** @var date */
    var $expiration_date = null; //deadline for action

    /** @var varchar(100) */
    var $feature = null; //feature of conveniences

    /** @var varchar(100) */
    var $hoa_dues = null;

    /** @var int */
    var $lot_size = null;

    /** @var varchar(50) */
    var $model = null;

    /** @var FLOAT(2,2) */
    var $property_taxes = null;

    /** @var varchar(45) */
    var $school = null;

    /** @var varchar(45) */
    var $school_district = null;

    /** @var varchar(45) */
    var $style = null;

    /** @var varchar(45) */
    var $zoning = null; //agricultural, commercial, industrial,

    /** @var varchar(100) */
    var $featured_clicks = null;

    /** @var varchar(100) */
    var $featured_shows = null;

    /** @var boolean */
    var $checked_out = null;

    /** @var time */
    var $checked_out_time = null;

    /** @var datetime */
    var $date = null;

    /** @var int */
    var $published = null;

    /** @var int */
    var $approved = null;

    /** @var int */
    var $hits = null;

    /** @var varchar(200) */
    var $edok_link = null;
    /* /** @var int */
    var $ordering = null;
    /* /** @var varchar */
    var $owneremail = null;
    /* /** @var varchar */
    var $extra1 = null;
    /* /** @var varchar */
    var $extra2 = null;
    /* /** @var varchar */
    var $extra3 = null;
    /* /** @var varchar */
    var $extra4 = null;
    /* /** @var varchar */
    var $extra5 = null;
    /* /** @var varchar */
    var $extra6 = null;
    /* /** @var varchar */
    var $extra7 = null;
    /* /** @var varchar */
    var $extra8 = null;
    /* /** @var varchar */
    var $extra9 = null;
    /* /** @var varchar */
    var $extra10 = null;
    /* /** @var rchar */
    var $language = null;

    /** @var int  */
    var $owner_id = null;

    function mosRealEstateManager(&$db) {
        parent::__construct('#__rem_houses', 'id', $db);
    }

    // overloaded check function
    function check() {
        global $realestatemanager_configuration;
        // check for existing houseid
        $this->price = floatval(preg_replace('/[\s,]/', '', $this->price));
        if (trim($this->houseid) == "") {
            $this->setError(_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_HOUSEID_CHECK);
            return false;
        }
        $this->_db->setQuery("SELECT id FROM #__rem_houses WHERE houseid='$this->houseid'");
        $xid = intval($this->_db->loadResult());
        if ($xid && $xid != intval($this->id)) {
            $this->setError(_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_HOUSEID);
            return false;
        }
        return true;
    }

    function setCatIds() {
        $this->_db->setQuery("SELECT idcat FROM #__rem_categories WHERE iditem=$this->id");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $this->catid = $this->_db->loadResultArray();
        else
            $this->catid = $this->_db->loadColumn();
    }

    function saveCatIds($categs) {
        if (is_array($categs)) {
            foreach ($categs as $categ)
                $temp[] = '(' . $this->id . ',' . $categ . ')';
            $queryvalue = implode(', ', $temp);
        } else
            $queryvalue = "('" . $this->id . "','" . $categs . "')";
        $this->catid = $categs;
        $this->_db->setQuery("DELETE FROM #__rem_categories WHERE iditem='" . $this->id . "';");
        $this->_db->query();
        $this->_db->setQuery("INSERT INTO #__rem_categories (iditem,idcat) VALUES $queryvalue");
        $this->_db->query();
        echo $this->_db->getErrorMsg();
    }

    //check access to house
    function getAccess_REM() {
        $this->setCatIds();
        $categoriesid = implode(',', $this->catid);
        if (!$categoriesid)
            return;
        $this->_db->setQuery("SELECT params FROM #__rem_main_categories WHERE id IN ($categoriesid)");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $accesses = $this->_db->loadResultArray();
        else {
            $accesses = $this->_db->loadColumn();
        }
        foreach ($accesses as $key => $access)
            if ($access == '')
                $accesses[$key] = '-2';
        return implode(',', $accesses);
    }

    function getUnusedHouseId() {
        $this->_db->setQuery("SELECT houseid FROM $this->_tbl");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $houseids_ids = $this->_db->loadResultArray();
        else
            $houseids_ids = $this->_db->loadColumn();
        for ($i = 1; in_array($i, $houseids_ids); $i++) {
            
        }
        return $i;
    }

    function setOwnerName() {
        $this->_db->setQuery("SELECT name FROM #__users WHERE email='$this->owneremail'");
        $this->ownername = $this->_db->loadResult();
    }

    function getOwnerUsername() {
        $this->_db->setQuery("SELECT name FROM #__users WHERE email='$this->owneremail'");
        return $this->_db->loadResult();
    }

    function getReviews() {
        $this->_db->setQuery("SELECT id FROM #__rem_review WHERE fk_houseid='$this->id' ORDER BY id DESC");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $tmp = $this->_db->loadResultArray();
        else
            $tmp = $this->_db->loadColumn();
        $retVal = array();
        for ($i = 0, $j = count($tmp); $i < $j; $i++) {
            $help = new mosRealEstateManager_review($this->_db);
            $help->load(intval($tmp[$i]));
            $retVal[$i] = $help;
        }
        return $retVal;
    }

    function getRent() {
        $rent = null;
        if ($this->fk_rentid != null && $this->fk_rentid != 0) {
            $rent = new mosRealEstateManager_rent($this->_db);
            // load the row from the db table
            $rent->load(intval($this->fk_rentid));
        }
        return $rent;
    }

    function getAllRents($exclusion = "") {
        $this->_db->setQuery("SELECT id FROM #__rem_rent WHERE fk_houseid='$this->houseid' " . $exclusion . " ORDER BY fk_houseid");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $tmp = $this->_db->loadResultArray();
        else
            $tmp = $this->_db->loadColumn();
        $retVal = array();
        for ($i = 0, $j = count($tmp); $i < $j; $i++) {
            $help = new mosRealEstateManager_rent($this->_db);
            $help->load(intval($tmp[$i]));
            $retVal[$i] = $help;
        }
        return $retVal;
    }

    function getAllRentRequests($exclusion = "") {
        $this->_db->setQuery("SELECT id FROM #__rem_rent_request WHERE fk_houseid='$this->id'" . $exclusion . " ORDER BY id");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $tmp = $this->_db->loadResultArray();
        else
            $tmp = $this->_db->loadColumn();
        $retVal = array();
        for ($i = 0, $j = count($tmp); $i < $j; $i++) {
            $help = new mosRealEstateManager_rent_request($this->_db);
            $help->load(intval($tmp[$i]));
            $retVal[$i] = $help;
        }
        return $retVal;
    }

    function getAllBuyingRequests($exclusion = "") {
        $this->_db->setQuery("SELECT id FROM #__rem_buying_request WHERE fk_houseid='$this->id'" . $exclusion . " ORDER BY id");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $tmp = $this->_db->loadResultArray();
        else {
            $tmp = $this->_db->loadColumn();
        }
        $retVal = array();
        for ($i = 0, $j = count($tmp); $i < $j; $i++) {
            $help = new mosRealEstateManager_buying_request($this->_db);
            $help->load(intval($tmp[$i]));
            $retVal[$i] = $help;
        }
        return $retVal;
    }

    function getAllImages($exclusion = "") {
        $this->_db->setQuery("SELECT thumbnail_img, main_img FROM #__rem_photos WHERE fk_houseid='$this->id'" . $exclusion . " ORDER BY id");
        $retVal = $this->_db->loadObjectList();
        return $retVal;
    }

    function toXML3($xmlDoc, $all) {
        //create and append name element
        $retVal = $xmlDoc->createElement("house");
        $houseid = $xmlDoc->createElement("houseid");
        $houseid->appendChild($xmlDoc->createTextNode($this->houseid));
        $retVal->appendChild($houseid);
        $catid = $xmlDoc->createElement("catid");
        $catid->appendChild($xmlDoc->createTextNode($this->catid));
        $retVal->appendChild($catid);
        $fk_rentid = $xmlDoc->createElement("fk_rentid");
        $fk_rentid->appendChild($xmlDoc->createTextNode($this->fk_rentid));
        $retVal->appendChild($fk_rentid);
        $sid = $xmlDoc->createElement("sid");
        $sid->appendChild($xmlDoc->createTextNode($this->sid));
        $retVal->appendChild($sid);
        //
        $description = $xmlDoc->createElement("description");
        $description->appendChild($xmlDoc->createCDATASection($this->description));
        $retVal->appendChild($description);
        $link = $xmlDoc->createElement("link");
        $link->appendChild($xmlDoc->createTextNode($this->link));
        $retVal->appendChild($link);
        $listing_type = $xmlDoc->createElement("listing_type");
        $listing_type->appendChild($xmlDoc->createCDATASection($this->listing_type));
        $retVal->appendChild($listing_type);
        $price = $xmlDoc->createElement("price");
        $price->appendChild($xmlDoc->createTextNode($this->price));
        $retVal->appendChild($price);
        $htitle = $xmlDoc->createElement("htitle");
        $htitle->appendChild($xmlDoc->createCDATASection($this->htitle));
        $retVal->appendChild($htitle);
        $hlocation = $xmlDoc->createElement("hlocation");
        $hlocation->appendChild($xmlDoc->createCDATASection($this->hlocation));
        $retVal->appendChild($hlocation);
        $hlatitude = $xmlDoc->createElement("hlatitude");
        $hlatitude->appendChild($xmlDoc->createTextNode($this->hlatitude));
        $retVal->appendChild($hlatitude);
        $hlongitude = $xmlDoc->createElement("hlongitude");
        $hlongitude->appendChild($xmlDoc->createTextNode($this->hlongitude));
        $retVal->appendChild($hlongitude);
        $map_zoom = $xmlDoc->createElement("map_zoom");
        $map_zoom->appendChild($xmlDoc->createTextNode($this->map_zoom));
        $retVal->appendChild($map_zoom);
        //recommended fields
        $bathrooms = $xmlDoc->createElement("bathrooms");
        $bathrooms->appendChild($xmlDoc->createTextNode($this->bathrooms));
        $retVal->appendChild($bathrooms);
        $bedrooms = $xmlDoc->createElement("bedrooms");
        $bedrooms->appendChild($xmlDoc->createTextNode($this->bedrooms));
        $retVal->appendChild($bedrooms);
        $broker = $xmlDoc->createElement("broker");
        $broker->appendChild($xmlDoc->createCDATASection($this->broker));
        $broker->appendChild($broker);
        $image_link = $xmlDoc->createElement("image_link");
        $image_link->appendChild($xmlDoc->createCDATASection($this->image_link));
        $retVal->appendChild($image_link);
        $listing_status = $xmlDoc->createElement("listing_status");
        $listing_status->appendChild($xmlDoc->createTextNode($this->listing_status));
        $retVal->appendChild($listing_status);
        $price_type = $xmlDoc->createElement("price_type");
        $price_type->appendChild($xmlDoc->createTextNode($this->price_type));
        $retVal->appendChild($price_type);
        $property_type = $xmlDoc->createElement("property_type");
        $property_type->appendChild($xmlDoc->createTextNode($this->property_type));
        $retVal->appendChild($property_type);
        $provider_class = $xmlDoc->createElement("provider_class");
        $provider_class->appendChild($xmlDoc->createTextNode($this->provider_class));
        $retVal->appendChild($provider_class);
        $year = $xmlDoc->createElement("year");
        $year->appendChild($xmlDoc->createTextNode($this->year));
        $year->appendChild($year);
        //optional fields
        $agent = $xmlDoc->createElement("agent");
        $agent->appendChild($xmlDoc->createCDATASection($this->agent));
        $retVal->appendChild($agent);
        $area = $xmlDoc->createElement("area");
        $area->appendChild($xmlDoc->createCDATASection($this->area));
        $retVal->appendChild($area);
        $expiration_date = $xmlDoc->createElement("expiration_date");
        $expiration_date->appendChild($xmlDoc->createTextNode($this->expiration_date));
        $retVal->appendChild($expiration_date);
        $hoa_dues = $xmlDoc->createElement("hoa_dues");
        $hoa_dues->appendChild($xmlDoc->createCDATASection($this->hoa_dues));
        $retVal->appendChild($hoa_dues);
        $lot_size = $xmlDoc->createElement("lot_size");
        $lot_size->appendChild($xmlDoc->createCDATASection($this->lot_size));
        $retVal->appendChild($lot_size);
        $model = $xmlDoc->createElement("model");
        $model->appendChild($xmlDoc->createCDATASection($this->model));
        $retVal->appendChild($model);
        $property_taxes = $xmlDoc->createElement("property_taxes");
        $property_taxes->appendChild($xmlDoc->createTextNode($this->property_taxes));
        $retVal->appendChild($property_taxes);
        $school = $xmlDoc->createElement("school");
        $school->appendChild($xmlDoc->createCDATASection($this->school));
        $retVal->appendChild($school);
        $school_district = $xmlDoc->createElement("school_district");
        $school_district->appendChild($xmlDoc->createCDATASection($this->school_district));
        $retVal->appendChild($school_district);
        $style = $xmlDoc->createElement("style");
        $style->appendChild($xmlDoc->createCDATASection($this->style));
        $retVal->appendChild($style);
        $zoning = $xmlDoc->createElement("zoning");
        $zoning->appendChild($xmlDoc->createCDATASection($this->zoning));
        $zoning->appendChild($zoning);
        $hits = $xmlDoc->createElement("hits");
        $hits->appendChild($xmlDoc->createTextNode($this->hits));
        $retVal->appendChild($hits);
        $date = $xmlDoc->createElement("date");
        $date->appendChild($xmlDoc->createTextNode($this->date));
        $retVal->appendChild($date);
        $published = $xmlDoc->createElement("published");
        $published->appendChild($xmlDoc->createTextNode($this->published));
        $retVal->appendChild($published);
        $extra1 = $xmlDoc->createElement("extra1");
        $extra1->appendChild($xmlDoc->createTextNode($this->extra1));
        $retVal->appendChild($extra1);
        $extra2 = $xmlDoc->createElement("extra2");
        $extra2->appendChild($xmlDoc->createTextNode($this->extra2));
        $retVal->appendChild($extra2);
        $extra3 = $xmlDoc->createElement("extra3");
        $extra3->appendChild($xmlDoc->createTextNode($this->extra3));
        $retVal->appendChild($extra3);
        $extra4 = $xmlDoc->createElement("extra4");
        $extra4->appendChild($xmlDoc->createTextNode($this->extra4));
        $retVal->appendChild($extra4);
        $extra5 = $xmlDoc->createElement("extra5");
        $extra5->appendChild($xmlDoc->createTextNode($this->extra5));
        $retVal->appendChild($extra5);
        $extra6 = $xmlDoc->createElement("extra6");
        $extra6->appendChild($xmlDoc->createTextNode($this->extra6));
        $retVal->appendChild($extra6);
        $extra7 = $xmlDoc->createElement("extra7");
        $extra7->appendChild($xmlDoc->createTextNode($this->extra7));
        $retVal->appendChild($extra7);
        $extra8 = $xmlDoc->createElement("extra8");
        $extra8->appendChild($xmlDoc->createTextNode($this->extra8));
        $retVal->appendChild($extra8);
        $extra9 = $xmlDoc->createElement("extra9");
        $extra9->appendChild($xmlDoc->createTextNode($this->extra9));
        $retVal->appendChild($extra9);
        $extra10 = $xmlDoc->createElement("extra10");
        $extra10->appendChild($xmlDoc->createTextNode($this->extra10));
        $retVal->appendChild($extra10);
        $language = $xmlDoc->createElement("language");
        $language->appendChild($xmlDoc->createTextNode($this->language));
        $retVal->appendChild($language);
        $owner_id = $xmlDoc->createElement("owner_id");
        $owner_id->appendChild($xmlDoc->createTextNode($this->owner_id));
        $retVal->appendChild($owner_id);
        $associate_house = $xmlDoc->createElement("associate_house");
        $associate_house->appendChild($xmlDoc->createTextNode($this->associate_house));
        $retVal->appendChild($associate_house);
        if ($all) {
            $rents_data = $this->getRent();
            $exclusion = "";
            $rents = $xmlDoc->createElement("rents");
            $rents_data = $this->getAllRents($exclusion);
            foreach ($rents_data as $rent_data)
                $rents->appendChild($rent_data->toXML3($xmlDoc));
            $retVal->appendChild($rents);
            $rentrequests = $xmlDoc->createElement("rentrequests");
            $rentrequests_data = $this->getAllRentRequests($exclusion);
            foreach ($rentrequests_data as $rentrequest_data)
                $rentrequests->appendChild($rentrequest_data->toXML3($xmlDoc));
            $retVal->appendChild($rentrequests);
            $buyingrequests = $xmlDoc->createElement("buyingrequests");
            $buyingrequests_data = $this->getAllBuyingRequests($exclusion);
            foreach ($buyingrequests_data as $buyingrequest_data)
                $buyingrequests->appendChild($buyingrequest_data->toXML3($xmlDoc));
            $retVal->appendChild($buyingrequests);
            $reviews = $xmlDoc->createElement("reviews");
            $reviews_data = $this->getReviews();
            foreach ($reviews_data as $review_data)
                $reviews->appendChild($review_data->toXML3($xmlDoc));
            $retVal->appendChild($reviews);
            $images = $xmlDoc->createElement("images");
            $images_data = $this->getAllImages();
            foreach ($images_data as $image_data) {
                $image = $xmlDoc->createElement("image");
                $image_thumbnail_img = $xmlDoc->createElement("thumbnail_img");
                $image_thumbnail_img->appendChild($xmlDoc->createTextNode($image_data->thumbnail_img));
                $image->appendChild($image_thumbnail_img);
                $image_main_img = $xmlDoc->createElement("main_img");
                $image_main_img->appendChild($xmlDoc->createTextNode($image_data->main_img));
                $image->appendChild($image_main_img);
                $images->appendChild($image);
            }
            $retVal->appendChild($images);
        }
        return $retVal;
    }

    function toXML2($all) {
        $this->setCatIds();
        if (count($this->catid) < 1) {
            echo _REALESTATE_MANAGER_ERROR_CATEGORIES;
            exit;
        }
        foreach ($this->catid as $catid)
            $catids[] = "<catid>" . $catid . "</catid>\n";
        $catids = implode('', $catids);
        $retVal = "<house>\n";
        $retVal.= "<houseid>" . $this->houseid . "</houseid>\n";
        $retVal.= "<catids>" . $catids . "</catids>\n";
        $retVal.= "<fk_rentid>" . $this->fk_rentid . "</fk_rentid>\n";
        $retVal.= "<sid>" . $this->sid . "</sid>\n";
        $retVal.= "<description><![CDATA[" . $this->description . "]]></description>\n";
        $retVal.= "<link><![CDATA[" . $this->link . "]]></link>\n";
        $retVal.= "<listing_type>" . $this->listing_type . "</listing_type>\n";
        $retVal.= "<price>" . $this->price . "</price>\n";
        $retVal.= "<priceunit><![CDATA[" . $this->priceunit . "]]></priceunit>\n";
        $retVal.= "<htitle><![CDATA[" . $this->htitle . "]]></htitle>\n";
        $retVal.= "<hcountry><![CDATA[" . $this->hcountry . "]]></hcountry>\n";
        $retVal.= "<hregion><![CDATA[" . $this->hregion . "]]></hregion>\n";
        $retVal.= "<hcity><![CDATA[" . $this->hcity . "]]></hcity>\n";
        $retVal.= "<hdistrict><![CDATA[" . $this->hdistrict . "]]></hdistrict>\n";
        $retVal.= "<hzipcode><![CDATA[" . $this->hzipcode . "]]></hzipcode>\n";
        $retVal.= "<hlocation><![CDATA[" . $this->hlocation . "]]></hlocation>\n";
        $retVal.= "<hlatitude>" . $this->hlatitude . "</hlatitude>\n";
        $retVal.= "<hlongitude>" . $this->hlongitude . "</hlongitude>\n";
        $retVal.= "<map_zoom>" . $this->map_zoom . "</map_zoom>\n";
        $retVal.= "<bathrooms>" . $this->bathrooms . "</bathrooms>\n";
        $retVal.= "<bedrooms>" . $this->bedrooms . "</bedrooms>\n";
        $retVal.= "<broker>" . $this->broker . "</broker>\n";
        $retVal.= "<contacts>" . $this->contacts . "</contacts>\n"; //<contacts>
        $retVal.= "<image_link><![CDATA[" . $this->image_link . "]]></image_link>\n";
        $retVal.= "<listing_status>" . $this->listing_status . "</listing_status>\n";
        $retVal.= "<price_type>" . $this->price_type . "</price_type>\n";
        $retVal.= "<property_type>" . $this->property_type . "</property_type>\n";
        $retVal.= "<provider_class>" . $this->provider_class . "</provider_class>\n";
        $retVal.= "<year>" . $this->year . "</year>\n";
        $retVal.= "<agent><![CDATA[" . $this->agent . "]]></agent>\n";
        $retVal.= "<area><![CDATA[" . $this->area . "]]></area>\n";
        $retVal.= "<expiration_date>" . $this->expiration_date . "</expiration_date>\n";
        $retVal.= "<hoa_dues><![CDATA[" . $this->hoa_dues . "]]></hoa_dues>\n";
        $retVal.= "<lot_size>" . $this->lot_size . "</lot_size>\n";
        $retVal.= "<model><![CDATA[" . $this->model . "]]></model>\n";
        $retVal.= "<property_taxes>" . $this->property_taxes . "</property_taxes>\n";
        $retVal.= "<school><![CDATA[" . $this->school . "]]></school>\n";
        $retVal.= "<school_district><![CDATA[" . $this->school_district . "]]></school_district>\n";
        $retVal.= "<style><![CDATA[" . $this->style . "]]></style>\n";
        $retVal.= "<zoning><![CDATA[" . $this->zoning . "]]></zoning>\n";
        $retVal.= "<date>" . $this->date . "</date>\n";
        $retVal.= "<hits>" . $this->hits . "</hits>\n";
        $retVal.= "<published>" . $this->published . "</published>\n";
        $retVal.= "<owneremail><![CDATA[" . $this->owneremail . "]]></owneremail>\n";
        $retVal.= "<featured_clicks><![CDATA[" . $this->featured_clicks . "]]></featured_clicks>\n";
        $retVal.= "<featured_shows><![CDATA[" . $this->featured_shows . "]]></featured_shows>\n";
        $retVal.= "<extra1><![CDATA[" . $this->extra1 . "]]></extra1>\n";
        $retVal.= "<extra2><![CDATA[" . $this->extra2 . "]]></extra2>\n";
        $retVal.= "<extra3><![CDATA[" . $this->extra3 . "]]></extra3>\n";
        $retVal.= "<extra4><![CDATA[" . $this->extra4 . "]]></extra4>\n";
        $retVal.= "<extra5><![CDATA[" . $this->extra5 . "]]></extra5>\n";
        $retVal.= "<extra6><![CDATA[" . $this->extra6 . "]]></extra6>\n";
        $retVal.= "<extra7><![CDATA[" . $this->extra7 . "]]></extra7>\n";
        $retVal.= "<extra8><![CDATA[" . $this->extra8 . "]]></extra8>\n";
        $retVal.= "<extra9><![CDATA[" . $this->extra9 . "]]></extra9>\n";
        $retVal.= "<extra10><![CDATA[" . $this->extra10 . "]]></extra10>\n";
        $retVal.= "<language><![CDATA[" . $this->language . "]]></language>\n";
        $retVal.= "<owner_id><![CDATA[" . $this->owner_id . "]]></owner_id>\n";
        if ($all) {
            $exclusion = "";
            $retVal.= "<rents>\n";
            $rents = $this->getAllRents($exclusion);
            foreach ($rents as $rent)
                $retVal.= $rent->toXML2();
            $retVal.= "</rents>\n";
            $retVal.= "<rentrequests>\n";
            $rentrequests = $this->getAllRentRequests($exclusion);
            foreach ($rentrequests as $rentrequest)
                $retVal.= $rentrequest->toXML2();
            $retVal.= "</rentrequests>\n";
            $retVal.= "<buyingrequests>\n";
            $buyingrequests = $this->getAllBuyingRequests($exclusion);
            foreach ($buyingrequests as $buyingrequest)
                $retVal.= $buyingrequest->toXML2();
            $retVal.= "</buyingrequests>\n";
            $retVal.= "<reviews>\n";
            $reviews = $this->getReviews($exclusion);
            foreach ($reviews as $review)
                $retVal.= $review->toXML2();
            $retVal.= "</reviews>\n";
            $retVal.= "<images>\n";
            $images_data = $this->getAllImages();
            foreach ($images_data as $image_data) {
                $retVal.= "<image>\n";
                $retVal.= "<thumbnail_img><![CDATA[" . $image_data->thumbnail_img . "]]></thumbnail_img>\n";
                $retVal.= "<main_img><![CDATA[" . $image_data->main_img . "]]></main_img>\n";
                $retVal.= "</image>\n";
            }
            $retVal.= "</images>\n";
        }
        $retVal.= "</house>\n";
        return $retVal;
    }

}

?>
 