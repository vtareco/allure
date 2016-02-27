<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

/**
 *
 * @package  RealEstateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com)
 * Homepage: http://www.ordasoft.com
 * @version: 3.0 Pro
 *
 * */

$LangLocal = array('lang_code'=>'fr-FR', 'title'=>'French');

$constLang = array();

$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBMAIN', 'value_const'=>'Community Builder/My Houses plugin settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHOUSES', 'value_const'=>'Show my houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBEDIT', 'value_const'=>'Show edit houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBRENT', 'value_const'=>'Show rent requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBBUY', 'value_const'=>'Show buy requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHISTORY', 'value_const'=>'Show user rent history');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHOUSES_TO', 'value_const'=>'Show my houses to');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBEDIT_TO', 'value_const'=>'Show edit houses to');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBRENT_TO', 'value_const'=>'Show rent requests to');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBBUY_TO', 'value_const'=>'Show buy requests to');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHISTORY_TO', 'value_const'=>'Show user rent history to');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHOUSES_TT', 'value_const'=>'Show my houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBEDIT_TT', 'value_const'=>'Show edit houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBRENT_TT', 'value_const'=>'Show rent requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBBUY_TT', 'value_const'=>'Show buy requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHISTORY_TT', 'value_const'=>'Show user rent history');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHOUSES_RL', 'value_const'=>'Show button \'show my houses\' on CB plugin');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHOUSES_ML', 'value_const'=>'Show my houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHOUSES_ML_BODY', 'value_const'=>'Select user group for which will be show this button');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBEDIT_RL', 'value_const'=>'Show button \'edit my houses\' on CB plugin');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBEDIT_ML', 'value_const'=>'Show edit houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBRENT_RL', 'value_const'=>'Show button \'rent requests\' on CB plugin');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBRENT_ML', 'value_const'=>'Show rent requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBBUY_RL', 'value_const'=>'Show button \'buy requsts\' on CB plugin');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBBUY_ML', 'value_const'=>'Show buy requsts');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHISTORY_RL', 'value_const'=>'Show button \'my rent history\' on CB plugin');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CBHISTORY_ML', 'value_const'=>'Show my rent history');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TITLE', 'value_const'=>'Real Estate Manager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DESC', 'value_const'=>'Our house catalogue with houses for sale and rent.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SEARCH_DESC1', 'value_const'=>'Search houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SEARCH_DESC2', 'value_const'=>'Search houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_NO_PICTURE', 'value_const'=>'no-img_eng.gif');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_NOT_AUTHORIZED', 'value_const'=>'You are not allowed to perform this action!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_OK', 'value_const'=>'OK');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_STATUS', 'value_const'=>'Status');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_IMPEXP', 'value_const'=>'RealEstateManager :: Import/Export');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_IMPEXP_ADD', 'value_const'=>'You must add a category for this section first.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_PLEASE_SEL', 'value_const'=>'Please select');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_FORMAT_CSV', 'value_const'=>'CSV File');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_FORMAT_XML', 'value_const'=>'XML File');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_ERR1', 'value_const'=>'You must select a type to import!' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_ERR2', 'value_const'=>'You must select a category to import!' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_ERR3', 'value_const'=>'You must choose a file to import!' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_ERR4', 'value_const'=>'You must select a type to export!' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_LABEL_IMPORT_TYP', 'value_const'=>'Import type' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_IMPORT_TYP', 'value_const'=>'Select file format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_IMPORT_TYP_TT_HEAD', 'value_const'=>'Select file format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_LABEL_IMPORT_CATEGORY', 'value_const'=>'Category' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_IMPORT_CAT', 'value_const'=>'Category');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_IMPORT_CAT_TT_HEAD', 'value_const'=>'Select category');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_LABEL_IMPORT_FILE', 'value_const'=>'File to import' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_IMPORT_FILE', 'value_const'=>'File to import');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_IMPORT_FILE_TT_HEAD', 'value_const'=>'Select file to import');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_FORMAT', 'value_const'=>'At the moment the following CSV format is supported:<br />HouseID | Description | Link | Listing type |  Location | PriÑ?e | Title | ...' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_LABEL_EXPORT_TYP', 'value_const'=>'Export type' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_EXPORT_TYP', 'value_const'=>'Select file format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_EXPORT_TYP_TT_HEAD', 'value_const'=>'Select file format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_LABEL_EXPORT_CATEGORY', 'value_const'=>'Category' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_EXPORT_CAT', 'value_const'=>'Category');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_IMPEXP_LABEL_EXPORT_CAT_TT_HEAD', 'value_const'=>'Select category');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_RESULT', 'value_const'=>'Export Result' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_RESULT_DOWNLOAD', 'value_const'=>'You can download the requested Export under the following URL (right-click to save):' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_RESULT_REMEMBER', 'value_const'=>'Please note that the files will still be saved on the server and you have to clean them yourself.' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CATEGORIES_MANAGER', 'value_const'=>'RealEstateManager :: Categories');
$constLang[] = array('const'=>'_HEADER_CATEGORY', 'value_const'=>'Category');
$constLang[] = array('const'=>'_HEADER_NUMBER', 'value_const'=>'Houses');
$constLang[] = array('const'=>'_HEADER_PUBLISHED', 'value_const'=>'Published');
$constLang[] = array('const'=>'_HEADER_REORDER', 'value_const'=>'Reorder');
$constLang[] = array('const'=>'_HEADER_ACCESS', 'value_const'=>'Access');
$constLang[] = array('const'=>'_HEADER_CHECKED_OUT', 'value_const'=>'Checked Out By');
$constLang[] = array('const'=>'_HEADER_ADD', 'value_const'=>'Add');
$constLang[] = array('const'=>'_HEADER_EDIT', 'value_const'=>'Edit');
$constLang[] = array('const'=>'_CATEGORY', 'value_const'=>'Category');
$constLang[] = array('const'=>'_DML_CAT_MUST_SELECT_NAME', 'value_const'=>'Category name must be not empty');
$constLang[] = array('const'=>'_CATEGORIES_NAME', 'value_const'=>'Categories');
$constLang[] = array('const'=>'_A_SELECT_IMAGE', 'value_const'=>'- Select Image -');
$constLang[] = array('const'=>'_A_SELECT_TOP', 'value_const'=>'Top');
$constLang[] = array('const'=>'_CATEGORIES_HEADER_TITLE', 'value_const'=>'Category Alias');
$constLang[] = array('const'=>'_CATEGORIES_HEADER_NAME', 'value_const'=>'Category Title');
$constLang[] = array('const'=>'_CATEGORIES_HEADER_ORDER', 'value_const'=>'Ordering');
$constLang[] = array('const'=>'_CATEGORIES_HEADER_IMAGE', 'value_const'=>'Image');
$constLang[] = array('const'=>'_CATEGORIES_HEADER_IMAGEPOS', 'value_const'=>'Image Position');
$constLang[] = array('const'=>'_CATEGORIES__PARENTITEM', 'value_const'=>'Parent Item');
$constLang[] = array('const'=>'_CATEGORIES__IMAGEPREVIEW', 'value_const'=>'No preview available');
$constLang[] = array('const'=>'_CATEGORIES__DETAILS', 'value_const'=>'Details');
$constLang[] = array('const'=>'_DELETED', 'value_const'=>'Deleted'); 
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_RENT_HOUSES', 'value_const'=>'RealEstateManager - Rent out a house' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_RENT_RETURN', 'value_const'=>'RealEstateManager - Return House from a lease' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_IMP', 'value_const'=>'Import');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_EXP', 'value_const'=>'Export');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_ALL_CATEGORIES', 'value_const'=>'- All Categories');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_CATEGORIES', 'value_const'=>'Select Categories');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_TO_RENT', 'value_const'=>'Select house to rent out');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_ALL_RENT', 'value_const'=>'- All Houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_RENT', 'value_const'=>'Rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_NOT_RENT', 'value_const'=>'Not Rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_ALL_USERS', 'value_const'=>'- All Users');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_TO_PUBLIC', 'value_const'=>'Select Published');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_ALL_PUBLIC', 'value_const'=>'- All Houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_NOT_PUBLIC', 'value_const'=>'Not Published');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_PUBLIC', 'value_const'=>'Published');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SEARCH', 'value_const'=>'Search Houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SEARCH_KEYWORD', 'value_const'=>'Search Keywords');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SEARCH_BUTTON', 'value_const'=>'Search');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW', 'value_const'=>'RealEstateManager :: Houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_SEARCH', 'value_const'=>'Search:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_SEARCH_KOM', 'value_const'=>'You must first create a Category for this Section.'); 
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_HOUSEID', 'value_const'=>'HouseID');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RESULT', 'value_const'=>'Result');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_COMMENT', 'value_const'=>'Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CATEGORY', 'value_const'=>'Category');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_HOUSES', 'value_const'=>'# House');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_COVER', 'value_const'=>'View');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_COUNTRY', 'value_const'=>'Country');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REGION', 'value_const'=>'Region');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CITY', 'value_const'=>'City');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_DISTRICT', 'value_const'=>'District');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ZIPCODE', 'value_const'=>'Zipcode');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ADDRESS', 'value_const'=>'Address');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LATITUDE', 'value_const'=>'Latitude');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LONGITUDE', 'value_const'=>'Longitude');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_NO_LOCATION_AVAILIBLE', 'value_const'=>'No location available');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE', 'value_const'=>'Title');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BROKER', 'value_const'=>'Broker');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUILD_YEAR', 'value_const'=>'Built year');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PROPERTY_TYPE', 'value_const'=>'Property type');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RATING', 'value_const'=>'Rating');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PICTURE_URL', 'value_const'=>'Picture URL');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PICTURE', 'value_const'=>'Picture');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_URL', 'value_const'=>'[ Buy from ] link');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_TO', 'value_const'=>'Rent to');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_FROM', 'value_const'=>'Rent from');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_UNTIL', 'value_const'=>'Rent until');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL', 'value_const'=>'Rent from - until');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_FROM_UNTIL_NOT_KNOWN', 'value_const'=>'unknown');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_USER', 'value_const'=>'User');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_EMAIL', 'value_const'=>'email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_ADRES', 'value_const'=>'Postal mailing address');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUYING_ADRES', 'value_const'=>'Phone number');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_TIME', 'value_const'=>'Rent until: ');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_HITS', 'value_const'=>'Hits');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LINE', 'value_const'=>'Reorder');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT', 'value_const'=>'Rent out');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PUBLIC', 'value_const'=>'Published');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CONTROL', 'value_const'=>'Checked out');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SUGGESTION_DATE', 'value_const'=>'Suggestion date');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_REVIEW_DATE', 'value_const'=>'Review date');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FETCHED_SUBCATEGORIES', 'value_const'=>'Subcategories');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PICTURE_URL_UPLOAD', 'value_const'=>'Upload main photo');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_OTHER_PICTURES_URL_UPLOAD', 'value_const'=>'Click to upload photos for house photo gallery');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PICTURE_URL_DESC', 'value_const'=>'If you upload a picture, the URL of the current picture will be deleted and reset to the uploaded picture.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PICTURE_URL_UPLOAD_ERROR', 'value_const'=>'Error uploading picture! Please note that only image formats (jpg, png, gif) are supported');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PRICE', 'value_const'=>'Price');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_INFORMATIONS', 'value_const'=>'Rent information');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EDOCUMENT_ACTUAL', 'value_const'=>'Actual edocument');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EDOCUMENT_UPLOAD', 'value_const'=>'Upload edocument');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EDOCUMENT_DOWNLOAD', 'value_const'=>'Download edocument');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EDOCUMENT_DELETE', 'value_const'=>'Delete edocument');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EDOCUMENT', 'value_const'=>'Edocument');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EDOCUMENT_UPLOAD_ERROR', 'value_const'=>'Error uploading edocument!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_CB', 'value_const'=>'Rent out');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REQUIRED', 'value_const'=>'Required');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ADDREVIEW', 'value_const'=>'Add Review');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REVIEWS', 'value_const'=>'Reviews');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_SAVE', 'value_const'=>'[ Save ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_RENT_REQU', 'value_const'=>'[ Rent Request ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_RENT_REQU_SAVE', 'value_const'=>'[ Submit Rent Request ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REVIEW', 'value_const'=>'Review');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REVIEW_TITLE', 'value_const'=>'Title');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REVIEW_RATING', 'value_const'=>'Rating');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REVIEW_COMMENT', 'value_const'=>'Comment');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ANONYMOUS', 'value_const'=>'Anonymous');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_CLICKS', 'value_const'=>'Featured clicks');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_SHOWS', 'value_const'=>'Featured shows');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_TITLE', 'value_const'=>'Please enter a Title for your review!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_COMMENT', 'value_const'=>'Please enter a Text for your review!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_RATING', 'value_const'=>'Please enter a Rating for your review!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_NAME', 'value_const'=>'Please enter a Name for your rent request!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_EMAIL', 'value_const'=>'Please enter a valid e-mail address for your rent request!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_MAILING', 'value_const'=>'Please enter a valid Postal Address for your rent request!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_UNTIL', 'value_const'=>'Please enter correct Return date.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_NOT_USED', 'value_const'=>'Not specified');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_PTBR', 'value_const'=>'Brazilian Portuguese'); 
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_DK', 'value_const'=>'Danish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_DUT', 'value_const'=>'Dutch');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_ENG', 'value_const'=>'English');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_FAR', 'value_const'=>'Farsi');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_FRE', 'value_const'=>'French');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_GER', 'value_const'=>'German');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_ITA', 'value_const'=>'Italian');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_PR', 'value_const'=>'Portuguese');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_ROM', 'value_const'=>'Romanian');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_RUS', 'value_const'=>'Russian');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_SPA', 'value_const'=>'Spanish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LANGUAGE_SWE', 'value_const'=>'Swedish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_NO', 'value_const'=>'NO');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_YES', 'value_const'=>'YES');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_IS_EDITED', 'value_const'=>'The house title is currently being edited by another administrator');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ERROR_DEL', 'value_const'=>'Error deleting house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FRONTEND', 'value_const'=>'Settings Frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BACKEND', 'value_const'=>'House Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_HOUSEID_AUTO_INCREMENT', 'value_const'=>'HouseID auto-increment'); 
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_HOUSEID_AUTO_INCREMENT_TT_HEAD', 'value_const'=>'HouseID auto increment');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_HOUSEID_AUTO_INCREMENT_TT_BODY', 'value_const'=>'YES if you want to use HouseID auto-increment. NO if you want use manually entered HouseID');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD', 'value_const'=>'edocument support');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD_TT_HEAD', 'value_const'=>'edocument support');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD_TT_BODY', 'value_const'=>'YES if you want to activate edocument support for the administrator interface.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD_LOCATION', 'value_const'=>'Location of edocuments');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD_LOCATION_TT_HEAD', 'value_const'=>'edocuments location');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_DOWNLOAD_LOCATION_TT_BODY', 'value_const'=>'The location of the uploaded edocuments on the server. The path is relative to the main Joomla directory and must start and end with a /');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_SHOW', 'value_const'=>'Show edocuments download link');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_SHOW_TT_HEAD', 'value_const'=>'Show edocuments download in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_SHOW_TT_BODY', 'value_const'=>'YES if you want to show an edocument download link in the frontend.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_SHOW', 'value_const'=>'Show button <br />[ Add reviews ] ');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_SHOW_TT_HEAD', 'value_const'=>'Show reviews in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_SHOW_TT_BODY', 'value_const'=>'YES if you want to activate the House Review functionality for users on your website.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_REGISTRATIONLEVEL', 'value_const'=>'Allow Reviews');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow Reviews');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEWS_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow Reviews in the frontend. This function will be activated only if --Show Reviews-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENTSTATUS_SHOW', 'value_const'=>'Show Rent status');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENTSTATUS_SHOW_TT_HEAD', 'value_const'=>'Show Rent status in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENTSTATUS_SHOW_TT_BODY', 'value_const'=>'YES if you want to show the current Rent status of houses in the frontend.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENTREQUEST_REGISTRATIONLEVEL', 'value_const'=>'Allow Rent Requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENTREQUEST_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow Rent Request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENTREQUEST_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow Rent Requests in the frontend. This function will be activated only if --Show Rent Status-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_SHOW', 'value_const'=>'Show price');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_SHOW_TT_HEAD', 'value_const'=>'Show price');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_SHOW_TT_BODY', 'value_const'=>'Shows the price of the house in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ITEM_IN_PAGE', 'value_const'=>'Houses per page.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PAGE_SHOW_TT_BODY', 'value_const'=>'Set number of Houses shown per page.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PAGE_SHOW_TT_HEAD', 'value_const'=>'Pagination.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTO_SIZE', 'value_const'=>'House photos size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTO_SIZE_TT_HEAD', 'value_const'=>'House photos size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTO_SIZE_TT_BODY', 'value_const'=>'Set photos size - height/width in px');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PAGE_ITEMS', 'value_const'=>'Page items');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PAGE_ITEMS_TT_HEAD', 'value_const'=>'Page items');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PAGE_ITEMS_TT_BODY', 'value_const'=>'Input quantity of houses shown on each page.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL', 'value_const'=>'Review email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL_TT_HEAD', 'value_const'=>'Review email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL_TT_BODY', 'value_const'=>'Where to send notification messages for new Review added. You can enter multiple email addresses separated by a comma.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL', 'value_const'=>'Suggestion email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL_TT_HEAD', 'value_const'=>'Suggestion email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL_TT_BODY', 'value_const'=>'Where to send notification messages for new Suggestion added. You can enter multiple email addresses separated by a comma.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL', 'value_const'=>'Rent Request email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL_TT_HEAD', 'value_const'=>'Rent Request email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL_TT_BODY', 'value_const'=>'Where to send notification messages for new Rent Request added. You can enter multiple email addresses separated by a comma.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_REQUEST_RENT', 'value_const'=>'RealEstateManager :: Rent Requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ABOUT', 'value_const'=>'RealEstateManager :: About');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ABOUT_ABOUT', 'value_const'=>'About');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ABOUT_RELEASENOTE', 'value_const'=>'Releasenote');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ABOUT_CHANGELOG', 'value_const'=>'Changelog');
$constLang[] = array('const'=>'_REALESTATE_MANAGER__HTML_ABOUT', 'value_const'=>'Welcome to RealEstateManager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER__HTML_ABOUT_INTRO', 'value_const'=>'Thank you for using our component!<br /><br />
RealEstateManager allows you to manage large house catalogues. It comes with category and subcategory support and you can add a HouseID for your internal reference. Rent management is built-in, with a rent request possibility for users of your website. RealEstateManager also offers the possibility of house reviews by users, with review management in the backend. Edocument support is built-in. House information and house photos can be entered manually. <br/ ><br />
NOTES: <br/ >
- for download photos to your server to work, you need to compile PHP5 with CURL support<br />
- for csv export to work, you need to compile PHP5 with XSL support<br/ >
- for CAPTCHA to work, you need to compile PHP5 with GD support<br />
<br />
On the website <a href="http://www.ordasoft.com">www.ordasoft.com</a> you can find RealEstateManager Manuals, additional Language files, Support Forums and also download additional modules and plugins.<br />
<br />
We are available for Custom Development if you want a new feature added to RealEstateManager. Please mail your exact requirements to <a href="mailto:sales@ordasoft.com">sales@ordasoft.com</a> and we will get back to you with a quote. When you order a paid Customisation, you will receive the next PRO version with your custom feature added.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_TEXT_WSINFO_TEXT1', 'value_const'=>'The fields below only need to be filled in manually when you have set ');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_TEXT_WSINFO_TEXT2', 'value_const'=>'. otherwise they will be ignored.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_HOUSEID_CHECK', 'value_const'=>'Please insert an HouseID for this house!');    
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_HOUSEID', 'value_const'=>'A house with this HouseID already exists!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_CATEGORY', 'value_const'=>'You must select a Category for the house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DESC_TITLE', 'value_const'=>'Rent Request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DESC_RENT', 'value_const'=>'The list shows the houses selected for renting.<br />If it is empty, please check your selection again.');  
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME', 'value_const'=>'Your full name');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL', 'value_const'=>'email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_MAILING', 'value_const'=>'Your postal mailing address');     
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_UNTIL', 'value_const'=>'House return date');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_FROM', 'value_const'=>'Rent from');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_THANKS', 'value_const'=>'Your Rent Request was stored in our database. We will check your request and inform you as soon as possible.<br />Thank you for using our service.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUYING_REQUEST_THANKS', 'value_const'=>'Your Buying Request was stored in our database. We will check your request and inform you as soon as possible.<br />Thank you for using our service.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SUGGESTION_THANKS', 'value_const'=>'Your Suggestion was stored in our database.<br />Thank you for using our service.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL_OBJECT', 'value_const'=>'RealEstateManager: Rent Request accepted');     
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL_TEXT1', 'value_const'=>'The house');  
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL_TEXT2', 'value_const'=>'you requested is ready to be rented out.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_SAVE', 'value_const'=>'Save');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_RENT', 'value_const'=>'Rent house');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_RETURN', 'value_const'=>'Return house from rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_ACCEPT', 'value_const'=>'Accept request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_DECLINE', 'value_const'=>'Decline request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_IMPORT', 'value_const'=>'Import houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_EXPORT', 'value_const'=>'Export houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_DELETE_REVIEW', 'value_const'=>'Delete review');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_EDIT_REVIEW', 'value_const'=>'Edit review');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_GENERAL_INFO', 'value_const'=>'General information:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_VERSION', 'value_const'=>'Version:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_RELEASE_DATE', 'value_const'=>'Release date:'); 
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_PROJECTLINK', 'value_const'=>'Project link:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_PROJECT_HOST', 'value_const'=>'Project host:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_LICENSE', 'value_const'=>'License:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_WARRANTY', 'value_const'=>'This program is distributed in the hope that it will be useful, but without any warranty. See the included LICENSE.TXT for more details.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_DEVELOP', 'value_const'=>'Developed by:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DOC_HOMEPAGE', 'value_const'=>'Homepage');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EDOCUMENT_UPLOAD_URL', 'value_const'=>'edocument Download Link URL');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_REGISTRATIONLEVEL', 'value_const'=>'Allow edocuments download');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow edocuments download in the frontend. This function will only be activated if --Show edocuments Download Link-- is also set to YES');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EDOCUMENTS_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow edocuments download');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_REGISTRATIONLEVEL', 'value_const'=>'Allow price:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow price in the frontend. This function will be activated only if --Show Price-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRICE_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow price');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_REVIEW_MANAGER', 'value_const'=>'RealEstateManager :: Reviews');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_HOUSE', 'value_const'=>'House address');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_REVIEW', 'value_const'=>'Review title');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REVIEW_KEYGUEST', 'value_const'=>'Type the characters you see in the picture above into the box below.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT', 'value_const'=>'Print');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT_SELECT', 'value_const'=>'Please select the columns for printing and then click [ Next ]!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT_FONT_SIZE', 'value_const'=>'Font size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_PRINT_FORMAT', 'value_const'=>'Format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_LICENSE_ALLOW', 'value_const'=>'Show edocument download license');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_LICENSE_ALLOW_TT_BODY', 'value_const'=>'Show edocument download license accept/decline before allowing edocument download from the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_LICENSE_ALLOW_TT_HEAD', 'value_const'=>'Show edocument download license');
$constLang[] = array('const'=>'_LICENSE_AGREEMENT_TITLE', 'value_const'=>'License Agreement');
$constLang[] = array('const'=>'_LICENSE_AGREEMENT_ACCEPT', 'value_const'=>'Accept?');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_ADD_REVIEW', 'value_const'=>'[ Add review ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_REVIEW_HIDE', 'value_const'=>'[ Hide review ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_ADD_SUGGESTION', 'value_const'=>'[ Suggest House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SUGGESTION', 'value_const'=>'House Suggestion');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SUGGESTION_TITLE', 'value_const'=>'Suggestion Title');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SUGGESTION_COMMENT', 'value_const'=>'Suggestion Comment');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_SUGGESTION_TITEL', 'value_const'=>'Please enter a Title for your suggestion!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_SUGGESTION_COMMENT', 'value_const'=>'Please enter a Text for your suggestion!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_SUGGESTION_MANAGER', 'value_const'=>'RealEstateManager :: Suggestions');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_DELETE_SUGGESTION', 'value_const'=>'Delete suggestion');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_VIEW_SUGGESTION', 'value_const'=>'View suggestion');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYNOW_SHOW', 'value_const'=>'Show button [ Buy now ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYNOW_SHOW_TT_HEAD', 'value_const'=>'Show button [ Buy now ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYNOW_SHOW_TT_BODY', 'value_const'=>'Shows button [ Buy now ] next to the house in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYNOW_REGISTRATIONLEVEL', 'value_const'=>'Allow button [ Buy now ]:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYNOW_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Show button [ Buy now ] in the frontend for the selected categories. This function will be activated only if --Show button [ Buy now ]-- is also set to YES! You can select multiple categories.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYNOW_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow button [ Buy now ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ENTIRE_BU', 'value_const'=>'Full data export');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ENTIRE_RECOVER', 'value_const'=>'Full data import');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPEXP_CONF', 'value_const'=>'This operation will remove ALL existing RealEstateManager data before importing. Do you want to continue?');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_SUGGEST_HIDE', 'value_const'=>'[ Hide suggestion ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_SHOW', 'value_const'=>'Show button<br />[ Suggest House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_SHOW_TT_HEAD', 'value_const'=>'Show button<br />[ Suggest House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_SHOW_TT_BODY', 'value_const'=>'Shows button [ Suggest House ] in the house list and house details in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_REGISTRATIONLEVEL', 'value_const'=>'Allow button<br />[ Suggest House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow button<br />[ Suggest House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow button [ Suggest House ] in the frontend. This function will be activated only if --Show button [ Suggest House ]-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_IMPORT_WARNING_MESSAG', 'value_const'=>'
<strong>CSV&nbsp;IMPORT:</strong>
<ul>
	<li>At the moment the following CSV format is supported:&nbsp;&nbsp;HouseID&nbsp;|&nbsp;Description&nbsp;|&nbsp;&nbsp;|&nbsp;Listing type&nbsp;|&nbsp;Price&nbsp;|&nbsp;Price type&nbsp;|&nbsp;Title&nbsp;|&nbsp;Address&nbsp;|&nbsp;...&nbsp;|</li>
	<li>Fields are separated by a pipe character (<strong>&nbsp;|&nbsp;</strong>)</li>
	<li>You must import a whole list with just HouseID by leaving the other fields empty, for example:&nbsp;&nbsp;HouseID&nbsp;|&nbsp;<i>empty</i>&nbsp;|&nbsp;<i>empty</i>&nbsp;|&nbsp;<i>empty</i>&nbsp;|&nbsp;Price&nbsp;|&nbsp;<i>empty</i>&nbsp;|&nbsp;Title&nbsp;|&nbsp;<i>empty</i>&nbsp;|&nbsp;...&nbsp;|</li>
	<li><strong>WARNING:</strong>&nbsp;do not use CSV import if there are House Reviews present, in that case use Full data import instead!</li>
</ul>
<strong>XML&nbsp;IMPORT:</strong>
<ul>
	<li>import data in XML format</li>
	<li><strong>WARNING:</strong>&nbsp;do not use XML import if there are House Reviews present, in that case use full data import!</li>
</ul>
<strong>FULL&nbsp;DATA&nbsp;IMPORT:</strong>
<ul>
	<li>This import will import all RealEstateManager data and restore all fields and details</li>
	<li>This option will overwrite ALL existing entries, so be careful when using it!</li>
  <li>For restore all Houses photos, please restore all files saved before from folder: --components/com_realestatemanager/photos--!</li>
  <li>For restore all Houses eDocuments, please restore all files saved before from folder what you set in  setting backend --Location of edocuments--!</li>
</ul>
');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_EXPORT_WARNING_MESSAG', 'value_const'=>'
<strong>CSV&nbsp;EXPORT:</strong>
<ul>
	<li>CSV export will contain all fields for further editing in a text editor or spreadsheet application</li>
	<li>Please note that for subsequent import, only the following CSV format is supported:&nbsp;&nbsp;HouseID&nbsp;|&nbsp;Description&nbsp;|&nbsp;Link&nbsp;|&nbsp;Listing type&nbsp;|&nbsp;Price&nbsp;|&nbsp;Price type&nbsp;|&nbsp;Title&nbsp;|&nbsp;Address&nbsp;|&nbsp;...&nbsp;|</li>
	<li><strong>WARNING:</strong> if you want to import later including House Reviews, use Full data export instead!</li>
</ul>
<strong>XML&nbsp;EXPORT:</strong>
<ul>
	<li>Export data in XML</li>
  <li><strong>WARNING:</strong> if you want to import later including House Reviews, use Full data export instead!</li>
	</ul>
<strong>FULL&nbsp;DATA&nbsp;EXPORT:</strong>
<ul>
	<li>This export will export all RealEstateManager data and save all fields and entries</li>
	<li>You can later use these sql files to restore your RealEstateManager data in full</li>
	<li>This subsequent import will overwrite ALL existing entries, so be careful when using it!</li>
  <li>To restore all house photos, please restore all files from folder: --components/com_realestatemanager/photos--!</li>
  <li>To restore all houses eDocuments, please restore all files from the folder you have set in [Settings Backend] -- [Location of edocuments]</li>
</ul>
');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL_SEND', 'value_const'=>'Send Review Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL_SEND_TT_HEAD', 'value_const'=>'Send Review Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL_SEND_TT_BODY', 'value_const'=>'Set to YES if you want to be notified through email when a user adds a House Review. Use the panel on the right to set who will send these notifications. You can set the receiving email addresses in [ Configuration Backend ].');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL_REGISTRATIONLEVEL', 'value_const'=>'User groups from which Review notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'User groups from which Review notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_REVIEW_EMAIL_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Choose which user groups will send Review notifications. This function will be activated only if --Send Review Notification-- is also set to YES');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL_SEND', 'value_const'=>'Send Suggestion Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL_SEND_TT_HEAD', 'value_const'=>'Send Suggestion Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL_SEND_TT_BODY', 'value_const'=>'Set to YES if you want to be notified through email when a user adds a House Suggestion. Use the panel on the right to set who will send these notifications. You can set the receiving email addresses in [ Configuration Backend ].');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL_REGISTRATIONLEVEL', 'value_const'=>'User groups from which Suggestion notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'User groups from which Suggestion notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUGGEST_EMAIL_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Choose which user groups will send Suggestion notifications. This function will be activated only if --Send Suggestion Notification-- is also set to YES');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL_SEND', 'value_const'=>'Send Rent Request  Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL_SEND_TT_HEAD', 'value_const'=>'Send Rent Request  Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL_SEND_TT_BODY', 'value_const'=>'Set to YES if you want to be notified through email when a user submits a Rent Request. Use the panel on the right to set who will send these notifications. You can set the receiving email addresses in [ Configuration Backend ].');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL_REGISTRATIONLEVEL', 'value_const'=>'User groups from which Rent Request notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'User groups from which Rent Request notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_EMAIL_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Choose which user groups will send Rent Request notifications. This function will be activated only if --Send Rent Request Notification-- is also set to YES');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_REVIEW_COMMENT', 'value_const'=>'Review comment');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PICTURE_IN_CATEGORY', 'value_const'=>'Custom Category images');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PICTURE_IN_CATEGORY_TT_HEAD', 'value_const'=>'Custom Category images');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PICTURE_IN_CATEGORY_TT_BODY', 'value_const'=>'If set to YES you can assign a custom image to every category instead of the standard folder icon. You can then adjust the category images in [ RealEstateManager ] - [ Manage&nbsp;Categories ] - [ Edit ] - [ Select&nbsp;image ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUBCATEGORY_SHOW', 'value_const'=>'Show subcategory');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUBCATEGORY_SHOW_TT_HEAD', 'value_const'=>'Show subcategory');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SUBCATEGORY_SHOW_TT_BODY', 'value_const'=>'If set to YES, you will see subcategory for every category');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_MESSAGE_RETURN_HOUSES', 'value_const'=>'You can not return house from rent that were not rent out');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_RENT_HOUSES', 'value_const'=>'Please make a selection from the list to Rent Ð?ouses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_RETURN_HOUSES', 'value_const'=>'Please make a selection from the list to Return Houses from rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ACCEPT_REQUEST', 'value_const'=>'Please make a selection from the list to Accept Request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_DECLINE_REQUEST', 'value_const'=>'Please make a selection from the list to Decline Request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_IMPORT', 'value_const'=>'You must select a type to import!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_EXPORT', 'value_const'=>'You must select a type to export!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_VIEW_SUGGESTION', 'value_const'=>'Please make a selection from the list to View Suggestion');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_LISTING_TYPE', 'value_const'=>'You must select a Listing type for this house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_ADDRESS', 'value_const'=>'Please insert an Address for this house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_PRICE', 'value_const'=>'Please insert a Price for this house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_TITLE', 'value_const'=>'Please insert a Title for this house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_PROPERTY_TAXES', 'value_const'=>'Please insert a valid value of Property taxes! Possible values are within the range from 0 to 1 !');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_BATHROOMS', 'value_const'=>'Please enter a valid number of Bathrooms!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_BEDROOMS', 'value_const'=>'Please enter a valid number of Bedrooms!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_BUILD_YEAR', 'value_const'=>'Please enter a valid Build year for this house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_BUILD_AREA', 'value_const'=>'Please enter a valid Area for this house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_BUILD_LOT_SIZE', 'value_const'=>'Please enter a valid Lot size for this house!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_BUY_REQ_NAME', 'value_const'=>'Please enter a Name for your buying request!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_BUY_REQ_EMAIL', 'value_const'=>'Please enter a valid e-mail address for your buying request!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_INFOTEXT_JS_BUY_REQ_PHONE', 'value_const'=>'Please enter a valid Phone Number for your buying request!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LISTING_TYPE', 'value_const'=>'Listing type');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LISTING_STATUS', 'value_const'=>'Listing status');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PRICE_TYPE', 'value_const'=>'Price type');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BATHROOMS', 'value_const'=>'Bathrooms');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BEDROOMS', 'value_const'=>'Bedrooms');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PROVIDER_CLASS', 'value_const'=>'Provider class');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_AGENT', 'value_const'=>'Agent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_AREA', 'value_const'=>'Area');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXPIRATION_DATE', 'value_const'=>'Expiration date');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURE', 'value_const'=>'Feature');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_HOA_DUES', 'value_const'=>'HOA_dues');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LOT_SIZE', 'value_const'=>'Lot size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_MODEL', 'value_const'=>'Model');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PROPERTY_TAXES', 'value_const'=>'Property taxes');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SCHOOL', 'value_const'=>'School');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SCHOOL_DISTRICT', 'value_const'=>'School district');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_STYLE', 'value_const'=>'Style');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ZONING', 'value_const'=>'Zoning');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_APPROVED', 'value_const'=>'Approved');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_REQUEST_PHONE', 'value_const'=>'Your phone number');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HEADER_REQUIREMENT_FIELDS', 'value_const'=>'Required fields');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HEADER_RECOMMENDED_FIELDS', 'value_const'=>'Recommended fields');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HEADER_ADDRESS_FIELDS', 'value_const'=>'Address fields');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HEADER_OPTIONAL_FIELDS', 'value_const'=>'Optional fields');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HEADER_PHOTO_MANAGE', 'value_const'=>'Photo manage');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HEADER_PHOTOGALERY', 'value_const'=>'Gallery');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HEADER_ADVERTISMENT', 'value_const'=>'Advertisment');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUYING', 'value_const'=>'Customer\'s information ');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SALE_MANAGER', 'value_const'=>'RealEstateManager :: For Sale');//Sale Manager
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_BUY_HOUSE', 'value_const'=>'[ Buying Request ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_HIDDEN_BUYING', 'value_const'=>'[ Hidden Buying ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_SEND_REQUEST', 'value_const'=>'[ Send Request ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_EMAIL_SEND', 'value_const'=>'Send Buying Request  Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_EMAIL_SEND_TT_HEAD', 'value_const'=>'Send Buying Request  Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_EMAIL_SEND_TT_BODY', 'value_const'=>'Set to YES if you want to be notified through email when a user submits a Buying Request. Use the panel on the right to set who will send these notifications. You can set the receiving email addresses in [ Configuration Backend ].');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_EMAIL_REGISTRATIONLEVEL', 'value_const'=>'User groups from which Buying Request notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_EMAIL_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'User groups from which Buying Request notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_EMAIL_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Choose which user groups will send Buying Request notifications. This function will be activated only if --Send Buying Request Notification-- is also set to YES');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_EMAIL', 'value_const'=>'Buying Request email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG', 'value_const'=>'RealEstateManager :: Settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_REMOVE_MAIN_PHOTO', 'value_const'=>'Remove');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_NEW_PHOTO', 'value_const'=>'Photo ');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HOUSE_RENT_OUT', 'value_const'=>'House rent out');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ACCESSED_FOR_RENT', 'value_const'=>'Available for rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_RENT_RETURN', 'value_const'=>'Rent return');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_TAB', 'value_const'=>'Show Location tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_TAB_TT_HEAD', 'value_const'=>'Show Location tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_TAB_TT_BODY', 'value_const'=>'Set to YES if you want to display Location tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEW_TAB', 'value_const'=>'Show Reviews tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEW_TAB_TT_HEAD', 'value_const'=>'Show Reviews tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEW_TAB_TT_BODY', 'value_const'=>'Set to YES if you want to display Reviews tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_ADD_HOUSE', 'value_const'=>'[ Add House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_PUBLISH', 'value_const'=>'Publish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_UNPUBLISH', 'value_const'=>'Unpublish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_DELETE', 'value_const'=>'Delete');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_RETURN_HOUSE_FROM_RENT', 'value_const'=>'Return house from rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_RENT', 'value_const'=>'Rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_SHOW', 'value_const'=>'Show button [ Add House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_SHOW_TT_HEAD', 'value_const'=>'Show button [ Add House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_SHOW_TT_BODY', 'value_const'=>'Shows button [ Add House ] in the house list in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_REGISTRATIONLEVEL', 'value_const'=>'Allow button [ Add House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow button [ Add House ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow button [ Add House ] in the frontend. This function will be activated only if --Show button [ Add House ]-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CONTACTS', 'value_const'=>'Contacts');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_CONTACTS', 'value_const'=>'Show Contacts');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_CONTACTS_TT_HEAD', 'value_const'=>'Show Contacts');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_CONTACTS_TT_BODY', 'value_const'=>'Show Contacts on  \'All information\' tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PHOTOS_DOWNLOAD_LOCATION', 'value_const'=>'Location of photos');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PHOTOS_DOWNLOAD_LOCATION_TT_BODY', 'value_const'=>'The location of the uploaded photos on the server. The path is relative to the main Joomla directory and must start and end with a /');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PHOTOS_DOWNLOAD_LOCATION_TT_HEAD', 'value_const'=>'Photos location');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEWS_TAB_REGISTRATIONLEVEL', 'value_const'=>'Show Reviews tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEWS_TAB_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Show Reviews tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_REVIEWS_TAB_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow Reviews tab in the frontend. This function will be activated only if --Show Reviews tab-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_TAB_REGISTRATIONLEVEL', 'value_const'=>'Show Location tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_TAB_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Show Location tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_TAB_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow location tab in the frontend. This function will be activated only if --Show location tab-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_CONTACTS_REGISTRATIONLEVEL', 'value_const'=>'Show Contacts');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_CONTACTS_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Show Contacts');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_CONTACTS_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow Contacts in the frontend. This function will be activated only if --Show Contacts-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_UNAVAILABLE_FOR_RENT', 'value_const'=>'Unavailable for rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_REAL_ESTATE_THANKS', 'value_const'=>'Your Real Estate was stored in our database.<br />Thank you for using our service');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_AVAILABLE_FOR_RENT_FROM', 'value_const'=>'Available for rent from');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_AVAILABLE_FOR_RENT_UNTIL', 'value_const'=>'Available for rent until');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SEARCH_NOTHING_FOUND', 'value_const'=>'Nothing found.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TAB_MAIN', 'value_const'=>'Main');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TAB_LOCATION', 'value_const'=>'Location');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TAB_ALL', 'value_const'=>'All information');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TAB_REVIEWS', 'value_const'=>'Reviews');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_SELECT', 'value_const'=>'---select---');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_FOR_RENT', 'value_const'=>'house for rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_FOR_SALE', 'value_const'=>'house for sale');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_PRICE_TYPE', 'value_const'=>'negotiable,starting');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_LISTING_STATUS', 'value_const'=>'active,offer,contract,closed,withdrawn');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_PROPERTY_TYPE', 'value_const'=>'apartment,commercial,condo,coop,farm,land,manufactured,multifamily,ranch,single family,tic,townhouse');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_PROVIDER_CLASS', 'value_const'=>'agent,aggregator,broker,franchisor,homebuilder,publisher');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_ZONING', 'value_const'=>'agricultural,industrial,recreational,residential,unincorporated');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_OPTION_STYLE', 'value_const'=>'cape cod,colonial,craftsman,gothic,prairie,ranch,split level,tudor,victorian queen anne');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_ANSWER', 'value_const'=>'Buy request answer');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_ANSWER_TT_HEAD', 'value_const'=>'Buy request answer');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_ANSWER_TT_BODY', 'value_const'=>'Send email to user about buy request solution');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_FORM', 'value_const'=>'Form for answer to buy request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_FORM_TT_BODY', 'value_const'=>'Past particular tags in "Buy request answer",and you recive necessary data in your letter');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_FORM_TT_HEAD', 'value_const'=>'Tags Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_SEARCH_HOUSEID', 'value_const'=>'houseid');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_SEARCH_OWNER', 'value_const'=>'Owner');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_SEARCH_EXACTLY', 'value_const'=>'Exactly to all');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_RENT_ANSWER_SUBJECT', 'value_const'=>'Answer for your request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_FORM', 'value_const'=>'Form for answer to rent request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_FORM_TT_BODY', 'value_const'=>'Past particular tags in "Rent request answer",and you recive necessary data in your letter');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_FORM_TT_HEAD', 'value_const'=>'Tags Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_FORM_DESCTIPTION', 'value_const'=>'You can use this tags in your letter: <br/>{title} - title of rent house
          <br/>{answer} - declined or accepded<br/>{username} - the name of the user who requested a house<br/>
          {owneremail} - the email of the owner house<br/>{ownername} - the name of the owner house<br/>');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER', 'value_const'=>'Rent request answer');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_TT_HEAD', 'value_const'=>'Rent request answer');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_TT_BODY', 'value_const'=>'Send email to user about rent request solution');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_ACCEPTED', 'value_const'=>'Accepted');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_ANSWER_DECLINED', 'value_const'=>'Declined');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOOLBAR_ADMIN_EDIT_RENT', 'value_const'=>'Edit rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNERSLIST_REGISTRATIONLEVEL', 'value_const'=>'Allow owners list');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNERSLIST_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow owners list');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNERSLIST_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Choose users, whom allow show owners list');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNERSLIST_SHOW', 'value_const'=>'Show owners list');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNERSLIST_SHOW_TT_HEAD', 'value_const'=>'Show owners list');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNERSLIST_SHOW_TT_BODY', 'value_const'=>'If choose "yes" then show owners list in frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNER_SHOW', 'value_const'=>'Show owner');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNER_SHOW_TT_HEAD', 'value_const'=>'Show owner');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_OWNER_SHOW_TT_BODY', 'value_const'=>'Show house owner or not');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_RSS_REGISTRATIONLEVEL', 'value_const'=>'Allow RSS for');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_RSS_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow RSS');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_RSS_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Select users for whom allow RSS');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_RSS_SHOW', 'value_const'=>'Show RSS');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_RSS_SHOW_TT_BODY', 'value_const'=>'Show RSS or not');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_RSS_SHOW_TT_HEAD', 'value_const'=>'Show RSS');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_VIEW_TYPE_LIST', 'value_const'=>'list');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_VIEW_TYPE_GALLERY', 'value_const'=>'gallery');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_VIEW_TYPE_LIST_GALLERY', 'value_const'=>'User-selectable');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_VIEW_TYPE', 'value_const'=>'View type');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_VIEW_TYPE_TT_HEAD', 'value_const'=>'View type');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_VIEW_TYPE_TT_BODY', 'value_const'=>'Select view type for houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_REGISTRATIONLEVEL', 'value_const'=>'Allow publish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_ON_ADD_TT_BODY', 'value_const'=>'Publish houses added from frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_ON_ADD', 'value_const'=>'Publish added houseses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_ON_ADD_TT_HEAD', 'value_const'=>'Publish added houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_APPROVE_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Choose users whom allow approve houses from frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_APPROVE_REGISTRATIONLEVEL', 'value_const'=>'Allow approve');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_APPROVE_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow approve');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_APPROVE_ON_ADD_TT_BODY', 'value_const'=>'Approve houses added from frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_APPROVE_ON_ADD', 'value_const'=>'Approve added houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_APPROVE_ON_ADD_TT_HEAD', 'value_const'=>'Approve added houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PDF_BUTTON_REGISTRATIONLEVEL', 'value_const'=>'Allow button<br />[ print PDF ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PDF_BUTTON_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow button<br />[ print PDF ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PDF_BUTTON_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow button [ print PDF ] in the frontend. This function will be activated only if --Show button [ print PDF ]-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRINT_BUTTON_REGISTRATIONLEVEL', 'value_const'=>'Allow button<br />[ print View ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRINT_BUTTON_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow button<br />[ print View ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRINT_BUTTON_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow button [ print View ] in the frontend. This function will be activated only if --Show button [ print View ]-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MAILTO_BUTTON_REGISTRATIONLEVEL', 'value_const'=>'Allow button<br />[ send Link ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MAILTO_BUTTON_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow button<br />[ send Link ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MAILTO_BUTTON_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow button [ send Link ] in the frontend. This function will be activated only if --Show button [ send Mail ]-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MAILTO_BUTTON_SHOW', 'value_const'=>'Show button<br />[ send Link ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MAILTO_BUTTON_SHOW_TT_HEAD', 'value_const'=>'Show button<br />[ send Link ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MAILTO_BUTTON_SHOW_TT_BODY', 'value_const'=>'Shows button [ send Link ] in the House list in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRINT_BUTTON_SHOW', 'value_const'=>'Show button<br />[ print View ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRINT_BUTTON_SHOW_TT_HEAD', 'value_const'=>'Show button<br />[ print View ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PRINT_BUTTON_SHOW_TT_BODY', 'value_const'=>'Shows button [ print View ] in the House list in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PDF_BUTTON_SHOW', 'value_const'=>'Show button<br />[ print PDF ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PDF_BUTTON_SHOW_TT_HEAD', 'value_const'=>'Show button<br />[ print PDF ]');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PDF_BUTTON_SHOW_TT_BODY', 'value_const'=>'Shows button [ print PDF ] in the House list in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_USER_HOUSES', 'value_const'=>'User houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_DESCRIPTION', 'value_const'=>'Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_YEAR', 'value_const'=>'Year');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_OWNER', 'value_const'=>'Owner');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ERROR_HAVENOT_HOUSES_RSS', 'value_const'=>'There have not houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HAVENOT_HOUSES', 'value_const'=>'You have not houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DELETE_HOUSES', 'value_const'=>'Are you sure?');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ERROR_NOT_SELECTED', 'value_const'=>'Please select houses first!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_NUMBER_HOUSES', 'value_const'=>'Houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_OWNERS', 'value_const'=>'Owners');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ERROR_ACCESS_PAGE', 'value_const'=>'Sorry, you have not access to this page');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_OWNERSLIST', 'value_const'=>'Owners list');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_OWNERSLIST', 'value_const'=>'Owners list');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SHOW_MY_HOUSES', 'value_const'=>'Show my houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_MY_HOUSES', 'value_const'=>'My houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_PUBLISH', 'value_const'=>'Publish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_UNPUBLISH', 'value_const'=>'Unpublish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_DELETE', 'value_const'=>'Delete');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ID', 'value_const'=>'Id');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EDIT', 'value_const'=>'Edit');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_FULL_XML', 'value_const'=>'Full XML');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_RENT_EDIT', 'value_const'=>'RealestateManager - Edit house rent details' );
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL_SEND', 'value_const'=>'Send Add House Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL_SEND_TT_HEAD', 'value_const'=>'Send Add House Notification');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL_SEND_TT_BODY', 'value_const'=>'Set to YES if you want to be notified through email when a user adds a House. Use the panel on the right to set who will send these notifications. You can set the receiving email addresses in [ Configuration Backend ].');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL_REGISTRATIONLEVEL', 'value_const'=>'User groups from which Add House notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'User groups from which Add House notifications will be sent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Choose which user groups will send Add House notifications. This function will be activated only if --Send Add House Notification-- is also set to YES');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYSTATUS_SHOW', 'value_const'=>'Show Buy status');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYSTATUS_SHOW_TT_HEAD', 'value_const'=>'Show Buy status in the frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYSTATUS_SHOW_TT_BODY', 'value_const'=>'YES if you want to show the current Buy status of houses in the frontend.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYREQUEST_REGISTRATIONLEVEL', 'value_const'=>'Allow Buy Requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYREQUEST_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Allow Buy Request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUYREQUEST_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow Buy Requests in the frontend. This function will be activated only if --Show Buy Status-- is also set to YES!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOMAIN_SIZE', 'value_const'=>'House main photos size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOMAIN_SIZE_TT_BODY', 'value_const'=>'Set main photos size - height/width in px');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOMAIN_SIZE_TT_HEAD', 'value_const'=>'House main photos size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOGALLERY_SIZE', 'value_const'=>'House gallery photo size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOGALLERY_SIZE_TT_HEAD', 'value_const'=>'House gallery photo size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOGALLERY_SIZE_TT_BODY', 'value_const'=>'Set gallery photo size - height/width in px');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOUPLOAD_SIZE', 'value_const'=>'House upload photo size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOUPLOAD_SIZE_TT_HEAD', 'value_const'=>'House upload photo size');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_FOTOUPLOAD_SIZE_TT_BODY', 'value_const'=>'Set upload photo size - height/width in px');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL', 'value_const'=>'Add House email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL_TT_HEAD', 'value_const'=>'Add House email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADDHOUSE_EMAIL_TT_BODY', 'value_const'=>'Where to send notification messages for new House added. You can enter multiple email addresses separated by a comma.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY', 'value_const'=>'Rent before end notify');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_TT_HEAD', 'value_const'=>'Rent before end notify');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_TT_BODY', 'value_const'=>'Send email to admin before Rent end.<br /> For that you need create CRON job and connect to Cron check so URL:<br /> http://{yours site}/index.php?option=com_realestatemanager&Itemid={Yours ItemID}&task=rent_before_end_notify  with span - every day.<br /> Cron Jobs may look like:<br/> "wget -q -O - http://localhost/index.php?option=com_realestatemanager&Iteid=56&task=rent_before_end_notify /dev/null ');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_DAYS', 'value_const'=>'Rent end days');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_DAYS_TT_HEAD', 'value_const'=>'Rent end days');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_DAYS_TT_BODY', 'value_const'=>'How much days before rent end send notify email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_EMAIL', 'value_const'=>'Rent end email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_EMAIL_TT_HEAD', 'value_const'=>'Rent end email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_EMAIL_TT_BODY', 'value_const'=>'Set emails for send notify email to user about Rent end. You may set set emails separated them with help coma.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_MAP', 'value_const'=>'Show location map');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_MAP_TT_HEAD', 'value_const'=>'Location map');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SHOW_LOCATION_MAP_TT_BODY', 'value_const'=>'If choose "yes" then show location map ');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_UPDATE', 'value_const'=>'Update');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_UPDATE_TT_HEAD', 'value_const'=>'Update');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_UPDATE_TT_BODY', 'value_const'=>'If choose "yes" then do not remove database');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ERROR_CATEGORIES', 'value_const'=>'Check categories of houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_RENT_REQUEST', 'value_const'=>'Rent request');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ERROR_HOUSE_NOT_PUBLISHED', 'value_const'=>'You can\'t view this page because it not published');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ERROR_HOUSE_NOT_APPROVED', 'value_const'=>'You can\'t view this page because it not approved by administrator');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_EDIT_HOUSE', 'value_const'=>'Edit House');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TITLE_ADD_HOUSE', 'value_const'=>'Add House');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_WARNING_NO_LOGIN', 'value_const'=>'You have not logined! If you want edit house in future, then login!');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CLICKMAP', 'value_const'=>'Click on the map to choose the house location:');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_DATE', 'value_const'=>'Date');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_NO_PICTURE_BIG', 'value_const'=>'no-img_eng_big.gif');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_BUTTON_EDIT_HOUSE', 'value_const'=>'Edit house');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_FORM_DESCTIPTION', 'value_const'=>'You can use this tags in your letter: <br/>{title} - title of buy house
          <br/>{answer} - declined or accepded<br/>{username} - the name of the user who requested a house<br/>
          {owneremail} - the email of the owner house<br/>{ownername} - the name of the owner house<br/>');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ADVANCED_SEARCH', 'value_const'=>'Advanced<br />search');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FROM', 'value_const'=>'from');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_TO', 'value_const'=>'to');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ALL', 'value_const'=>'all');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_AVAILABLE_FOR_RENT', 'value_const'=>'Available for rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_SEARCH_YEAR', 'value_const'=>'Year');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_SEARCH_UNTIL', 'value_const'=>'until');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_TITLE', 'value_const'=>'Calendar of availability and rental rates per period.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_WEEK', 'value_const'=>'Week');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_WEEKEND', 'value_const'=>'Weekend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_MIDWEEK', 'value_const'=>'Midweek');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_YEAR', 'value_const'=>'Year');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_MONTH', 'value_const'=>'Month');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_CALENDAR', 'value_const'=>'Calendar');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_ADD_PRICE', 'value_const'=>'Add price');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_SELECT_DELETE', 'value_const'=>'Select price which are necessary to remove');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_AVAILABLE', 'value_const'=>'Available date for rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_NOT_AVAILABLE', 'value_const'=>'Not available date for rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_CALENDAR_NEW_PRICE', 'value_const'=>'New price rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_BUTTON_CALENDAR_ADD_NEW_PRICE', 'value_const'=>'Add new price rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TAB_CALENDAR', 'value_const'=>'Calendar');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDARLIST_REGISTRATIONLEVEL', 'value_const'=>'Show Calendar tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDARLIST_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Show Calendar tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDARLIST_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Choose users, whom allow show Calendar tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDARLIST_SHOW', 'value_const'=>'Show Calendar tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDARLIST_SHOW_TT_HEAD', 'value_const'=>'Show Calendar tab');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDARLIST_SHOW_TT_BODY', 'value_const'=>'If choose "yes" then show calendar tab in frontend');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDAR_SHOW', 'value_const'=>'Show owner');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDAR_SHOW_TT_HEAD', 'value_const'=>'Show calendar');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CONFIG_CALENDAR_SHOW_TT_BODY', 'value_const'=>'Show house calendar or not');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PLACEHOLDER', 'value_const'=>'Default price label for calendar');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PLACEHOLDER_TT_BODY', 'value_const'=>'Default price labels for calendar (weekend, week, midweek)');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PLACEHOLDER_TT_HEAD', 'value_const'=>'Default price label for calendar');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER', 'value_const'=>'RealEstateManager :: Language Manager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LANGUAGE_MANAGER_LANG_TAG', 'value_const'=>'Lang tag');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_CONST', 'value_const'=>'Constant');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_VALUE_CONST', 'value_const'=>'Value constant');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LANGUAGE_MANAGER_SYS_TYPE', 'value_const'=>'Sys type');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LANGUAGE', 'value_const'=>'Language');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_FEATURED_MANAGER', 'value_const'=>'RealEstateManager :: Features Manager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_FEATURE', 'value_const'=>'Feature');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_CATEGORY', 'value_const'=>'Category');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_PUBLISHED', 'value_const'=>'Published');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_NAME_ALIAS', 'value_const'=>'Name Alias');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_CATEGORY_ALIAS', 'value_const'=>'Category Alias');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_FEATURE_MANAGER', 'value_const'=>'Features manager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_IMAGE', 'value_const'=>'Image');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_REMOVE', 'value_const'=>'Select photo if it is necessary to remove');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_RECOMMENDED_IMAGE', 'value_const'=>'Recommended image size 25 x 25 pixels');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES', 'value_const'=>'Categories for Manager Feature');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_TT_BODY', 'value_const'=>'Category must be entered, separated by commas');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_TT_HEAD', 'value_const'=>'Categories for Manager Feature');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_IMAGE', 'value_const'=>'Show Feature Icon');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_IMAGE_TT_BODY', 'value_const'=>'Show Feature Icon');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_IMAGE_TT_HEAD', 'value_const'=>'If choose "yes" then show Icon for Manager Feature');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_SHOW', 'value_const'=>'Show title of Category Features');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_SHOW_TT_BODY', 'value_const'=>'Show title of Category Features');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_MANAGER_FEATURE_CATEGORIES_SHOW_TT_HEAD', 'value_const'=>'If choose "yes" then show title categories for Manager Feature');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_CURRENCY', 'value_const'=>'Currency');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_CURRENCY_TT_BODY', 'value_const'=>'Currency');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_CURRENCY_TT_HEAD', 'value_const'=>'Currency with coefficients');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SALE_SEPARATOR_SHOW', 'value_const'=>'Show price separator');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SALE_SEPARATOR_SHOW_TT_BODY', 'value_const'=>'Show price separator');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_SALE_SEPARATOR_SHOW_TT_HEAD', 'value_const'=>'Show price separator');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_GEOCOOR', 'value_const'=>'Get geographic coordinates');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA1_SHOW', 'value_const'=>'Show Custom Text Field 1');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA2_SHOW', 'value_const'=>'Show Custom Text Field 2');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA3_SHOW', 'value_const'=>'Show Custom Text Field 3');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA4_SHOW', 'value_const'=>'Show Custom Text Field 4');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA5_SHOW', 'value_const'=>'Show Custom Text Field 5');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA6_SHOW', 'value_const'=>'Show Custom Dropdown Field 6');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA7_SHOW', 'value_const'=>'Show Custom Dropdown Field 7');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA8_SHOW', 'value_const'=>'Show Custom Dropdown Field 8');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA9_SHOW', 'value_const'=>'Show Custom Dropdown Field 9');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA10_SHOW', 'value_const'=>'Show Custom Dropdown Field 10');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA', 'value_const'=>'Custom Fields Manager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA1', 'value_const'=>'Custom Text 1');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA2', 'value_const'=>'Custom Text 2');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA3', 'value_const'=>'Custom Text 3');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA4', 'value_const'=>'Custom Text 4');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA5', 'value_const'=>'Custom Text 5');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA6', 'value_const'=>'Custom Dropdown Field 6');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA7', 'value_const'=>'Custom Dropdown Field 7');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA8', 'value_const'=>'Custom Dropdown Field 8');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA9', 'value_const'=>'Custom Dropdown Field 9');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_EXTRA10', 'value_const'=>'Custom Dropdown Field 10');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EXTRA6_SELECTLIST', 'value_const'=>'Extra1,Extra2,Extra3,Extra4,Extra5');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EXTRA7_SELECTLIST', 'value_const'=>'Extra1,Extra2,Extra3,Extra4,Extra5');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EXTRA8_SELECTLIST', 'value_const'=>'Extra1,Extra2,Extra3,Extra4,Extra5');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EXTRA9_SELECTLIST', 'value_const'=>'Extra1,Extra2,Extra3,Extra4,Extra5');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EXTRA10_SELECTLIST', 'value_const'=>'Extra1,Extra2,Extra3,Extra4,Extra5');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ALLOWED_EXTS', 'value_const'=>'Allowed Exts eDocument');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ALLOWED_EXTS_IMG', 'value_const'=>'Allowed Exts Image');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ALL_CATEGORIES_LAYOUT', 'value_const'=>'All Categories Layout');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_HOUSE_PAGE_LAYOUT', 'value_const'=>'House Page Layout');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ALL_HOUSES_LAYOUT', 'value_const'=>'All Houses Layout');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SINGLE_CATEGORY_LAYOUT', 'value_const'=>'Single Category Layout');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_PRICE_FORMAT', 'value_const'=>'Price Format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DATE_TIME_FORMAT', 'value_const'=>'Date & Time format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DATE_FORMAT', 'value_const'=>'Date format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TIME_FORMAT', 'value_const'=>'Time format');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_DATE', 'value_const'=>'%Y - Year; %m - month;  %d - day');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TIME', 'value_const'=>'%H - hours; %i - minutes; %s - seconds');
$constLang[] = array('const'=>'_REALESTATE_PRICE_UNIT_SHOW', 'value_const'=>'Price unit show');
$constLang[] = array('const'=>'_REALESTATE_PRICE_UNIT_SHOW_AFTER', 'value_const'=>'After');
$constLang[] = array('const'=>'_REALESTATE_PRICE_UNIT_SHOW_BEFORE', 'value_const'=>'Before');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_PRICE_FORMAT_INFO', 'value_const'=>'Select price ditlimer os set youre.');
$constLang[] = array('const'=>'_REALESTATE_PRICE_UNIT_SHOW_INFO', 'value_const'=>'Show price unit before or affter price');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CUSTOM_OWNER_EMAIL', 'value_const'=>'Custom owneremail');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_BUTTON_SHOW_ADDRESS', 'value_const'=>'Show adderess on map');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_BUTTON_ADD_NEW_PHOTO', 'value_const'=>'Add new photo');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ORDER_BY', 'value_const'=>'Order By');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_PHOTO_TO_REMOVE', 'value_const'=>'Select photo if it is necessary to remove');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_PHOTO_FROM_GALLERY', 'value_const'=>'Select photos which are necessary to remove from photo gallery');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TITLE_TO_TEXTAREA_FOR_ADDFEATURE', 'value_const'=>'A short name to appear in FeatureMenus');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TITLE_TO_TEXTAREA_1_FOR_ADDCATEGORY', 'value_const'=>'A short name to appear in menus');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TITLE_TO_TEXTAREA_2_FOR_ADDCATEGORY', 'value_const'=>'A full name to appear in menus');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_HOUSE_TAB_GENERAL_INFO', 'value_const'=>'General Info');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_HOUSE_TAB_ADDITIONAL_INFO', 'value_const'=>'Additional Info');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_HOUSE_TAB_PHOTOS_AND_DOCUMENTS', 'value_const'=>'Photos and Documents');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_HOUSE_TAB_OWNER_CONTACTS', 'value_const'=>'Owner Contakts');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_FEATURE_TAB_1', 'value_const'=>'Categories for Feature Manager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_FEATURE_TAB_2', 'value_const'=>'Feature List');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_1', 'value_const'=>'House Page Settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_2', 'value_const'=>'Category Page Settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_3', 'value_const'=>'Email and Notification Settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_4', 'value_const'=>'Administrator Settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS_TAB_5', 'value_const'=>'Plugins Settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HOUSE_IMAGE_HEADER_SETTINGS', 'value_const'=>'House Image Settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TABS_MANAGER_HEADER_SETTINGS', 'value_const'=>'Tabs Manager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HEADER_LABEL_SELLER_CONTACT_SETTINGS', 'value_const'=>'Seller Contact Settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_FEATURE_LIST_SETTINGS', 'value_const'=>'Feature list settings');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_EXTRA_FIELDS_MANAGER', 'value_const'=>'Extra Fields manager');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_EDOCUMENT_OPTIONS', 'value_const'=>'eDocument Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_COMMON_SETTINGS', 'value_const'=>'Buttons Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_RENT_REQUEST_OPTIONS', 'value_const'=>'Rent Request Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_BUY_REQUEST_OPTIONS', 'value_const'=>'Buy Request Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_NOTIFICATION_ADD_HOUSE', 'value_const'=>'{title}
        [HouseID]: {id}<br>
        A new house was added by {username}<br>
        on {date} to category {category}.<br>
        Please log on and approve or deny this item.<br>');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_NOTIFICATION_REVIEW', 'value_const'=>'User {username} has added a Review to house:<br>{house_title}<br>
        Title Comment: {title}<br>
        Label Rating: [{rating}]<br>
        Review Comment:<br> {comment}<br>
        Please log on and edit this review where necessary.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_NOTIFICATION_SUGGESTION', 'value_const'=>"User {username} has added a house suggestion <br>
        Suggestion Title: {title}<br>
        Suggestion Comment: {comment}<br>
        Please log in and check.");
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_NOTIFICATION_RENT_REQUEST', 'value_const'=>"User {username} has submitted a Rent Request for:<br>
        HouseID: {hid_value}<br>
        {house_title}<br>
        Please log on and approve or deny this Rent Request");
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_NOTIFICATION_RENT_REQUEST_ANSWER', 'value_const'=>"Answer for your request:<br>
        Dear {username}!<br>
        Your rent request for<br>
        {title} {owneremail} {ownername}<br>
        Answer: {answer}");
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_NOTIFICATION_BUYING_REQUEST', 'value_const'=>"
        User {username}  has submitted a Buying Request for:<br>
        HouseID: {hid_value}<br>
        {house_title}<br>
        Please log on and approve or deny this Buying Request");
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_NOTIFICATION_BUYING_REQUEST_ANSWER', 'value_const'=>"Dear {username}!<br>
        Your buy request for<br>
        {title} {owneremail} {ownername}<br>
        Answer: {answer}<br>");
$constLang[] = array('const'=>'_REALESTATE_MANAGER_EMAIL_NOTIFICATION_RENT_BEFORE_END', 'value_const'=>
        "Rent User: {username}({user_email})<br>
        House: {house_title}<br>
        HouseID: {vid}<br>");
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_DESCRIPTION', 'value_const'=>'You can use this tags in your letter:<br>{house_title} - title of added house
        <br>{username} - the name of the user who added a house
        <br>{hid_value} - identification number of the house');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_DESCRIPTION_TT_BODY', 'value_const'=>'Past particular tags in "Send Buy Request Notification",and you recive necessary data in your letter');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_BUY_DESCRIPTION_TT_HEAD', 'value_const'=>'Tags Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_DESCRIPTION', 'value_const'=>'You can use this tags in your letter:<br/>{house_title} - title of added house
          <br>{username} - the name of the user who added a house <br>{user_email} - email of the user who rents the house
          <br>{vid} - identification number of the house');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_DESCRIPTION_TT_BODY', 'value_const'=>'Past particular tags in "Rent before end notify",and you recive necessary data in your letter');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_BEFORE_END_NOTIFY_DESCRIPTION_TT_HEAD', 'value_const'=>'Tags Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_REQUEST_DESCRIPTION', 'value_const'=>'You can use this tags in your letter:<br>{house_title} - title of added house
          <br>{username} - the name of the user who added a house
          <br>{hid_value} - identification number of the house<br>');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_REQUEST_TT_BODY', 'value_const'=>'Past particular tags in "Send Rent Request Notification",and you recive necessary data in your letter');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_RENT_REQUEST_TT_HEAD', 'value_const'=>'Tags Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_DESCRIPTION', 'value_const'=>'You can use this tags in your letter: <br>{title} - title of added house
          <br>{id} - identification number of the house
          <br>{username} - the name of the user who added a house
          <br>{date} - date when house was added<br>{category} - category which the house was added in');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_TT_BODY', 'value_const'=>'Past particular tags in "Send Add House Notification",and you recive necessary data in your letter');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_HOUSE_TT_HEAD', 'value_const'=>'Tags Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_REVIEW_DESCRIPTION', 'value_const'=>'You can use this tags in your letter: <br>{username} - name of the user,what added a review
          <br>{house_title} - title of review house
          <br>{title} - title of the comment, {rating} - rating of the comment,
          <br>{comment} - body of the comment');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_REVIEW_TT_BODY', 'value_const'=>'Past particular tags in "Send Review Notification",and you recive necessary data in your letter');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_REVIEW_TT_HEAD', 'value_const'=>'Tags Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_SUGGESTION_DESCRIPTION', 'value_const'=>'You can use this tags in your letter: <br>{username} - name of the user,what added a suggestion
          <br>{title} - title of the suggestion, 
          <br>{comment} - body of the suggestion');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_SUGGESTION_TT_BODY', 'value_const'=>'Past particular tags in "Send Suggestion Notification",and you recive necessary data in your letter');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_ADD_SUGGESTION_TT_HEAD', 'value_const'=>'Tags Description');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_TABS_SHOW_MY_HOUSES', 'value_const'=>'show my houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_TABS_EDIT_MY_HOUSES', 'value_const'=>'edit my houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_TABS_RENT_REQUESTS', 'value_const'=>'rent requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SHOW_TABS_BUYING_REQUESTS', 'value_const'=>'buying requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ALL_CATEGORIES_LAYOUT_TT_HEAD', 'value_const'=>'All Categories Layout');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ALL_CATEGORIES_LAYOUT_TT_BODY', 'value_const'=>'Here you can select layout for all categories');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SINGLE_CATEGORY_LAYOUT_TT_HEAD', 'value_const'=>'Single Category Layout');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SINGLE_CATEGORY_LAYOUT_TT_BODY', 'value_const'=>'Here you can select layout for single categorie');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SEARCH_LAYOUT', 'value_const'=>'Search Layout');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SEARCH_LAYOUT_TT_HEAD', 'value_const'=>'Search layout');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SEARCH_LAYOUT_TT_BODY', 'value_const'=>'Here you can select layout for search item');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA_TEXT_TT_BODY', 'value_const'=>'Select which extra text fields, you want to display');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA_TEXT_TT_HEAD', 'value_const'=>'Text field');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA_DROPDOWN_TT_BODY', 'value_const'=>'Select which extra dropdown fields, you want to display');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_EXTRA_DROPDOWN_TT_HEAD', 'value_const'=>'Dropdown field');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_REVIEW_LABEL_PUBLISHED', 'value_const'=>'Published');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_REVIEW_ON_ADD', 'value_const'=>'Approve review added');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_REVIEW_ON_ADD_TT_BODY', 'value_const'=>'Chose YES if you want to publish added review automatically');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_REVIEW_ON_ADD_TT_HEAD', 'value_const'=>'Publish review added');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_REVIEW_REGISTRATIONLEVEL', 'value_const'=>'Allow publish');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_REVIEW_REGISTRATIONLEVEL_TT_BODY', 'value_const'=>'Allow publish to usergroup');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_PUBLISH_REVIEW_REGISTRATIONLEVEL_TT_HEAD', 'value_const'=>'Chose the usergroup who can publish added review automatically');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CONFIG_LICENSE_TEXT', 'value_const'=>'License text');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SUGGESTIONS', 'value_const'=>'Suggestions');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_RENT_REQUESTS', 'value_const'=>'Rent Requests');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SALE_MANAGER_MENU', 'value_const'=>'For Sale'); // Sale Manager
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_IMPORT_EXPORT', 'value_const'=>'Import/Export');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LANGUAGE_MENU', 'value_const'=>'Language Manager');                                
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS', 'value_const'=>'Settings');

$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_GROUP', 'value_const'=>'Group');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_COUNT_OF_CARS', 'value_const'=>'Count of houses');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_COUNT_OF_CARS_HELP', 'value_const'=>'How many houses users can publish from a specific group.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_PAYPAL_BUY', 'value_const'=>'Show PayPal buy');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ALLOW_PAYPAL_BUY', 'value_const'=>'Allow PayPal buy');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SHOW_PAYPAL_RENT', 'value_const'=>'Show PayPal rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ALLOW_PAYPAL_RENT', 'value_const'=>'Allow PayPal rent');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_YOUR_PAY_PAL_EMAIL', 'value_const'=>'Your PayPal email');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_SUCCESSFUL_RETURN', 'value_const'=>'Successful return url');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_AFTER_SUCCESSFUL_RETURN', 'value_const'=>'After successful payment returns the buyer on your page.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_IMAGE_URL_PAYPAL', 'value_const'=>'Image url');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_AFTER_IMAGE_URL_PAYPAL', 'value_const'=>'Add image to PayPal page.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_CANCEL_RETURN_URL', 'value_const'=>'Cancel return url');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_AFTER_CANCEL_RETURN_URL', 'value_const'=>'If buyer press cancel in payment page, returns the buyer on your page.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_REAL_OF_TEST', 'value_const'=>'Real(yes) or a test(no) PayPal account');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_REAL_OF_TEST_LABLE', 'value_const'=>'If real go to www.paypal.com else go to www.sandbox.paypal.com');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_PAYPAL_LABLE', 'value_const'=>'PayPal Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_NUMBER_OF_PHOTOS', 'value_const'=>'Number of photos');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_NUMBER_OF_PHOTOS_HELP', 'value_const'=>'How many photos in gallery users can publish from a specific group.');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TOTAL_PRICE', 'value_const'=>'Total price: ');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_CAR_NOW_BY_PAYPAL', 'value_const'=>'Go now to PayPal');

$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_SPECIAL_PRICE_PER_DAY', 'value_const'=>'Special price per day');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_SPECIAL_PRICE_PER_NIGHT', 'value_const'=>'Special price per night');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_ADD_SPECIAL_PRICE', 'value_const'=>'Add new special price and save');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_FROM', 'value_const'=>'From');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_TO', 'value_const'=>'To');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_PRICE_PER_DAY', 'value_const'=>'Price per day');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_CALCULATE', 'value_const'=>'Ð¡alculate');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_SPECIAL_PRICE_AND_RENT_TIME', 'value_const'=>'Special price and rent time');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_SPECIAL_PRICE_YES_NO', 'value_const'=>'Special price per day("yes") or per night("no")');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_RENT_SPECIAL_PRICE_YES_NO_HELP', 'value_const'=>'if per day calculation all day(example of 2014-02-10 from 2014-02-16 is 7 days) if per night calculation all night (example of 2014-02-10 from 2014-02-16 is 6 nights)');


$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_TAB_LABEL_PRICE', 'value_const'=>'Pay');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_LANGUAGE_NAME', 'value_const'=>'Language');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_LABEL_SELECT_LANGUAGE', 'value_const'=>'Select Language');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_LABEL_CLON_CAR', 'value_const'=>'Clone');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_ADMIN_ABOUT_ORDERS', 'value_const'=>'Orders');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_HOUSE_MARKER', 'value_const'=>'/images/marker-1.png,/images/marker-2.png,/images/marker-3.png,/images/marker-4.png');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_CANCEL_URL_TEXT', 'value_const'=>'Message for Cancel URL text');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SUCCESSES_URL_TEXT', 'value_const'=>'Message for Successes URL text');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_HEADER_CATEGORY_OPTIONS', 'value_const'=>'Category Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_HEADER_LABEL_PRICE_OPTIONS', 'value_const'=>'Price Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_HEADER_DATE_TIME_OPTIONS', 'value_const'=>'Date&Time Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_EXTENSIONS_SETTINGS', 'value_const'=>'Extension Options');
$constLang[] = array('const'=>'_REALESTATE_MANAGER_SETTINGS_UPDATE_SETTINGS', 'value_const'=>'Update Options');


/** New Labels By CMS */
$constMas[] = array('const'=>'_REALESTATE_MANAGER_ORDER_DESCENDING', 'value_const'=>'Descending');
$constMas[] = array('const'=>'_REALESTATE_MANAGER_ORDER_ASCENDING', 'value_const'=>'Ascending');
$constMas[] = array('const'=>'_REALESTATE_MANAGER_LABEL_ARRIVAL', 'value_const'=>'Arrival');
$constMas[] = array('const'=>'_REALESTATE_MANAGER_LABEL_DEPARTURE', 'value_const'=>'Departure');
$constMas[] = array('const'=>'_REALESTATE_MANAGER_LABEL_NO_DESCRIPTION', 'value_const'=>'No Description');
$constMas[] = array('const'=>'_REALESTATE_MANAGER_LABEL_READ_MORE', 'value_const'=>'Read More');
