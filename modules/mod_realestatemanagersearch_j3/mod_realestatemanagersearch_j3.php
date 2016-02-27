<?php
/**
 * @version 3.0
 * @package RealEstateManager 
 * @copyright 2012 OrdaSoft
 * @author 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru)
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @description Search RealEstate for RealEstateManager Component
 * Homepage: http://www.ordasoft.com
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'helper.php';

$list = modRealSearchHelper::getLink($params);

require JModuleHelper::getLayoutPath('mod_realestatemanagersearch_j3',$params->get('layout', 'default'));