<?php

if (!defined('_VALID_MOS') && !defined('_JEXEC'))
    die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
    
global $mosConfig_lang;
$database = JFactory::getDBO();

//  remove_langs();
//  exit;

  // load language
  $languagelocale = "";
  $query = "SELECT l.title, l.lang_code, l.sef "
          . "FROM #__rem_const_languages as cl "
          . "LEFT JOIN #__rem_languages AS l ON cl.fk_languagesid=l.id "
          . "LEFT JOIN #__rem_const AS c ON cl.fk_constid=c.id "
          . "GROUP BY  l.title";
  $database->setQuery($query);
  $languages = $database->loadObjectList();
  
  $lang = JFactory::getLanguage();
  foreach ($languages as $language) {
      if ($lang->getTag() == $language->lang_code) {
          $mosConfig_lang = $language->lang_code;
          $languagelocale = $language->lang_code;
          break;
      }
  }
  
  if ($languagelocale == '') {
      foreach ($lang->getLocale() as $locale) {
          foreach ($languages as $language) {
              if ($locale == $language->title || $locale == $language->lang_code || $locale == $language->sef) {
                  $mosConfig_lang = $locale;
                  $languagelocale = $language->lang_code;
                  break;
              }
          }
      }
  }
  if (isset($_REQUEST['option']) && $_REQUEST['option'] == 'com_installer')
      $languagelocale = "en-GB";
  
  if ($languagelocale == '')
      $languagelocale = "en-GB";
  
  $query = "SELECT c.const, cl.value_const ";
  $query .= "FROM #__rem_const_languages as cl ";
  $query .= "LEFT JOIN #__rem_languages AS l ON cl.fk_languagesid=l.id ";
  $query .= "LEFT JOIN #__rem_const AS c ON cl.fk_constid=c.id ";
  $query .= "WHERE l.lang_code = '$languagelocale'";

  $database->setQuery($query);
  $langConst = $database->loadObjectList();
  
  foreach ($langConst as $item) {
      defined($item->const) or define($item->const, $item->value_const);
  }
