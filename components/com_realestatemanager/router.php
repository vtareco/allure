<?php

/**
 *
 * @package RealEstateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru);Rob de Cleen(rob@decleen.com)
 * Homepage: http://www.ordasoft.com
 * @version: 3.0 Pro
 *
 *
 */
defined('_JEXEC') or die;

$mosConfig_absolute_path = $GLOBALS['mosConfig_absolute_path'] = JPATH_SITE;
require_once($mosConfig_absolute_path . "/components/com_realestatemanager/compat.joomla1.5.php");

function RealEstateManagerBuildRoute(&$query) {



//      print_r ("!!!!!!!!start RealEstateManagerBuildRoute     ---- ");
//      print_r($query);

    $segments = array();
    $db = JFactory::getDBO();
    if (isset($query['Itemid']) && $query['Itemid'] !== 0) {
        $menu = @JSite::getMenu();
//        if (!isset($query['view']) && !isset($query['task'])) {
//            if (version_compare(JVERSION, "1.6.0", "lt")) {
//                $query['view'] = $menu->getItem($query['Itemid'])->query['task'];
//            } else if (version_compare(JVERSION, "1.6.0", "ge") && version_compare(JVERSION, "3.5.100", "lt")) {
//                $query['view'] = $menu->getItem($query['Itemid'])->query['view'];
//            }
//        }
        if (isset($query['view']) && $query['view'] == "alone_category") {
            if (version_compare(JVERSION, '3.0', 'ge')) {
                $menu = new JTableMenu($db);
                $menu->load($query['Itemid']);
                $params = new JRegistry;
                $params->loadString($menu->params);
            } else {
                $menu = new mosMenu($db);
                $menu->load($query['Itemid']);
                $params = new mosParameters($menu->params);
            }
            $single_category = $params->get('single_category', '');
            if ($single_category != "")
                $query['catid'] = $single_category;
        }
    }

    if (isset($query['option']) && $query['option'] == 'com_realestatemanager') { //check component
        $segments[0] = (isset($query['Itemid'])) && ($query['Itemid'] != 0) ? $query['Itemid'] : '0';
        if ((isset($query['view'])) && (!isset($query['task']))) {
            $query['task'] = $query['view'];
        }

        if (isset($query['task'])) {
            switch ($query['task']) {
                case 'all_houses':
                    $segments[1] = 'all_houses';
                    break;
                case 'my_houses':
                    $segments[1] = 'my_houses';
                    break;
                case 'new_url':
                    $segments[1] = 'buy_now';
                    break;
                case 'new_url_for_vm':
                    $segments[1] = 'buy_now_for_rem';
                    break;
                    
                 case 'search':
                 case 'search_houses':
                      $segments[1] = 'search';
                     break;
                    
                case 'view_user_houses':
                case 'owner_houses':
                    $segments[1] = $query['task'];
                    if (isset($query['name'])) {
                        //$segments[] = JFilterOutput::stringURLSafe($query['name']);
                        $segments[] = $query['name'];
                        unset($query['name']);
                    }
                    break;
                default:
                    $segments[1] = $query['task'];
                    break;
            }
        }
        unset($query['task']);
        unset($query['view']);

        if (isset($query['catid']) && $segments[1] != "search") {
            if ($query['catid'] > 0) {
                /* $sql_query = "SELECT rmc.id, rmc.name, rc.idcat, rmc.parent_id ".
                  " FROM #__realestatemanager_main_categories AS rmc".
                  " LEFT JOIN #__realestatemanager_categories AS rc ON rc.idcat=rmc.id ".
                  " LEFT JOIN #__realestatemanager_houses AS r ON rc.iditem = r.id ".
                  " WHERE rmc.section = 'com_realestatemanager' AND rmc.id = ".intval($query['catid']); */
                $sql_query = "SELECT rmc.id, rmc.name, rc.idcat, rmc.parent_id " . " FROM #__rem_main_categories AS rmc" .
                " LEFT JOIN #__rem_categories AS rc ON rc.idcat=rmc.id " . " LEFT JOIN #__rem_houses AS r ON rc.iditem = r.id " . " WHERE rmc.section = 'com_realestatemanager' AND rmc.id = " . intval($query['catid']);
                $db->setQuery($sql_query);
                $row = null;
                $row = $db->loadObject();
                if (isset($row)) {
//                  print_r($db);
//                  print_r(":1111111111111:");
//                  print_r($row);
                    $cattitle = array();
                    $segments[] = $query['catid'];
                    $segments[] = $row->name;
                    unset($query['catid']);
                }
            } else {
                $temp = $query['catid']; //is catid set??
                unset($query['catid']);
            }
        }

        if (!empty($query['lang'])) {
            unset($query['lang']);
        }
        if (isset($query['Itemid'])) {
            unset($query['Itemid']);
        }
        if (!empty($query['Itemid'])) {
            $query['Itemid'] = "";
            unset($query['Itemid']);
        }
        if (isset($query['name'])) {
            $segments[] = JFilterOutput::stringURLSafe($query['name']);
            unset($query['name']);
        }
        if (isset($query['user'])) {
            $segments[] = $query['user'];
            unset($query['user']);
        }
        if (isset($query['id'])) {
            $sql_query = "SELECT rc.idcat AS catid, r.htitle" . "\n FROM #__rem_houses AS r" . "\n LEFT JOIN #__rem_categories AS rc ON rc.iditem=r.id" . "\n LEFT JOIN #__rem_main_categories AS rmc ON rmc.id=rc.idcat" . "\n WHERE r.id = " . intval($query['id']);
            $db->setQuery($sql_query);
            $row = null;
            $row = $db->loadObject();
            if (isset($row)) {
                $temp_title = JFilterOutput::stringURLSafe($row->htitle);
                if (isset($temp)) {
                    /* $sql_query = "SELECT name FROM #__realestatemanager_main_categories WHERE id = ".$row->catid; */
                    $sql_query = "SELECT name FROM #__rem_main_categories WHERE id = " . $row->catid;
                    $db->setQuery($sql_query);
                    $row = $db->loadObject();
                    if (isset($row)) {
                        $segments[] = $row->name;
                    }
                }
                $segments[] = $query['id']; //for back up in parseroute
                $segments[] = $temp_title;
                unset($query['id']);
            }
        }


        if (isset($query['start'])) {
            $segments[] = $query['start'];
            if (isset($query['limitstart'])) {
                $segments[] = $query['limitstart'];
                unset($query['limitstart']);
            } else {
                $segments[] = $query['start'];
            }
            unset($query['start']);
        } else if (isset($query['limitstart'])) {
            $segments[] = $query['limitstart'];
            unset($query['limitstart']);
        }
        /*    if(isset($query['tab'])){
          $segments[] = $query['tab'];
          unset($query['tab']);
          } */
        if (isset($query['viewtype'])) {
            $segments[] = 'viewtype' . ":" . $query['viewtype'];
            unset($query['viewtype']);
        }
        if (isset($query['searchtext'])) {
            $segments[] = $query['searchtext'];
            unset($query['searchtext']);
        }
        if (isset($query['searchtype'])) {
            $segments[] = $query['searchtype'];
            unset($query['searchtype']);
        }
    }
    unset($query);
    if (count($segments) == 1) {
        $segments[] = 'all_categories';
    }

//       print_r ("end RealEstateManagerBuildRoute     ---- ");
//       print_r($segments);

    return $segments;
}

/**
 * Parse the segments of a URL.
 *
 */
function RealEstateManagerParseRoute($segments) {

        
        
/*       ECHO "*****start RealEstateManagerParseRoute****";
       print_r($segments); 
       ECHO "******************************************";
 */     
      
    $db = JFactory::getDBO();
    $vars = array();

    $count = count($segments);
    $vars['option'] = 'com_realestatemanager';
    $menu = @JSite::getMenu();
    $menu->setActive($segments[0]);
    if (!is_numeric($segments[0])) {
        // ECHO "111111111111111 RealEstateManagerParseRoute";
        // print_r($segments);
        array_unshift($segments, "0");
    }
    $vars['Itemid'] = $segments[0];
    //if ($count > 1)
    if ((@$segments[1] == "alone_category" || @$segments[1] == "showCategory") && isset($segments[2]) ) {
        if (@$vars['task'] == "alone_category") {
            $vars['task'] = "alone_category";
        } else {
            $vars['task'] = "showCategory";
        }
        /*        $sql_query = "SELECT id FROM #__rem_main_categories WHERE name='" . $segments[3] . "'";
          $db->setQuery($sql_query);
          $row = null;
          $row = $db->loadObject();
          $vars['catid'] = $row->id; */
        $vars['catid'] = $segments[2];
        if (isset($segments[4])) {
            $viewtype = explode(':', $segments[3]);
            if ($viewtype[0] == "viewtype") {
                $vars['viewtype'] = (int) $viewtype[1];
            }
        }
        if (isset($segments[3]) && !isset($vars['viewtype'])) {
            $vars['start'] = $segments[3];
        } else {
            unset($vars['start']);
        }
        if (isset($segments[4]) && !isset($vars['viewtype'])) {
            $vars['limitstart'] = $segments[4];
        } else {
            unset($vars['limistart']);
        }
        if (isset($segments[5])) {
            $viewtype = explode(':', $segments[5]);
            if ($viewtype[0] == "viewtype") {
                $vars['viewtype'] = (int) $viewtype[1];
            }
        }
        if (isset($segments[6])) {
            $vars['tab'] = $segments[6];
        }
        // } elseif (@$segments[1] == "view" && isset($segments[4])){
        //    $var['id'] = */
    } elseif ((@$segments[1] == "view" || @$segments[1] == "showCategory") && isset($segments[4])) {
        if (@$segments[1] == "view") {
            $vars['task'] = "view"; //"alone_category";
            $vars['id'] = $segments[4];
        } else
            $vars['task'] = "showCategory";
        //if(isset($segments[4]))
        //$vars['id'] = (int) $segments[4];
        //$vars['name'] = $segments[3];
        /* $sql_query = "SELECT id FROM #__realestatemanager_main_categories WHERE name='".$segments[3]."'"; */
        $sql_query = "SELECT id FROM #__rem_main_categories WHERE name='" . $segments[3] . "'";
        $db->setQuery($sql_query);
        $row = null;
        $row = $db->loadObject();
        $vars['catid'] = $row->id;
        if (isset($segments[4])) {
            $viewtype = explode(':', $segments[3]);
            if ($viewtype[0] == "viewtype") {
                $vars['viewtype'] = (int) $viewtype[1];
            }
        }
        if (isset($segments[3]) && !isset($vars['viewtype'])) {
            $vars['start'] = $segments[3];
        } else {
            unset($vars['start']);
        }
        if (isset($segments[5]) && !isset($vars['viewtype'])) {
            $vars['limitstart'] = $segments[5];
        } else {
            unset($vars['limitstart']);
        }
        if (isset($segments[5])) {
            $viewtype = explode(':', $segments[5]);
            if ($viewtype[0] == "viewtype") {
                $vars['viewtype'] = (int) $viewtype[1];
            }
        }
    } elseif (@$segments[1] == "show_add") { //!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $vars['task'] = "show_add";
    } elseif (@$segments[1] == "edit_house") {

        $vars['task'] = "edit_house";
        if (isset($segments[2]))
            $vars['id'] = $segments[2];
        $vars['Itemid'] = $segments[0];
    } elseif (@$segments[1] == "owner_houses") {
        $vars['task'] = "owner_houses";
    } elseif (@$segments[1] == "my_houses") {
        $vars['task'] = "my_houses";
        if (isset($segments[2]))
            $vars['limitstart'] = $segments[2];
    } elseif (@$segments[1] == "all_houses") {
        $vars['task'] = @$segments[1];
        if (isset($segments[2]))
            $vars['limitstart'] = $segments[2];
    } elseif (@$segments[1] == "Search") {
        $vars['task'] = "search";
        if (isset($segments[4])) {
            $vars['searchtext'] = $segments[4];
        }
        if (isset($segments[5])) {
            $vars['searchtype'] = $segments[5];
        }
        if (isset($segments[2])) {
            $vars['start'] = $segments[2];
        } else {
            unset($vars['start']);
        }
        if (isset($segments[3])) {
            $vars['limitstart'] = $segments[3];
        } else {
            unset($vars['limistart']);
        }
    } elseif (@$segments[1] == "show_search") { //_realestate
        $vars['task'] = "show_search";
        if (isset($segments[4])) {
            $vars['searchtext'] = $segments[4];
        }
        if (isset($segments[5])) {
            $vars['searchtype'] = $segments[5];
        }
        if (isset($segments[2])) {
            $vars['start'] = $segments[2];
        } else {
            unset($vars['start']);
        }
        if (isset($segments[3])) {
            $vars['limitstart'] = $segments[3];
        } else {
            unset($vars['limistart']);
        }
        
        
        
    } elseif (@$segments[1] == "search" || @$segments[1] == "search_houses") {
        $vars['task'] = "search";
        
        if (isset($segments[2])) {
             $vars['start'] = $segments[2];
         } 
         else {
             unset($vars['start']);
         }
         if (isset($segments[3])) {
             $vars['limitstart'] = $segments[3];
         } 
	else {
             unset($vars['limistart']);
         }
         if (isset($segments[4])) {
             $vars['searchtext'] = $segments[4];
         }
        if (isset($segments[5])) {
             $vars['searchtype'] = $segments[5];
         }
        
        
        
    } 
    
    
    elseif (@$segments[1] == "show_rss_categories") {
        $vars['task'] = "show_rss_categories";
    } elseif (@$segments[1] == "buy_now") {
        $vars['task'] = "new_url";
        if (isset($segments[2])) {
            $vars['id'] = $segments[2];
        }
    } elseif (@$segments[1] == "buy_now_for_vm") {
        $vars['task'] = "new_url_for_vm";
        if (isset($segments[2])) {
            $vars['id'] = $segments[2];
        }
    } elseif (@$segments[1] == "view_user_houses") {
        $vars['task'] = "view_user_houses";
        if (isset($segments[2])) {
            $vars['name'] = $segments[2];
        }
    } elseif (@$segments[1] == "owner_houses") {
        $vars['task'] = "owner_houses";
        if (isset($segments[2])) {
            $vars['name'] = $segments[2];
        }
    } elseif (@$segments[1] == "lend_history") {
        $vars['task'] = "lend_history";
        $vars['name'] = $segments[2];
        $vars['user'] = $segments[3];
    } elseif (@$segments[1] == "lend_requests") {
        $vars['task'] = "lend_requests";
        if (isset($segments[2])) {
            $vars['start'] = $segments[2];
        } else {
            unset($vars['start']);
        }
        if (isset($segments[3])) {
            $vars['limitstart'] = $segments[3];
        } else {
            unset($vars['limistart']);
        }
    } elseif (@$segments[1] == "mdownload") {
        $vars['task'] = "mdownload";
        if (isset($segments[2])) {
            $vars['id'] = $segments[2];
        }
    } else {
        $vars['task'] = @$segments[1];
    }
/*
     ECHO "   ++++end RealEstateManagerParseRoute    ----  ";
     print_r($vars);*/
    return $vars;
}

