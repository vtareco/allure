<?php
/**
* This file provides compatibility for Real Estate Manager on Joomla! 1.0.x and Joomla! 1.5
*
*/


// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

// Register legacy classes for autoloading
JLoader::register('JDispatcher' , JPATH_LIBRARIES.DS.'joomla'.DS.'event'.DS.'dispatcher.php');

/**
 * Legacy class, use {@link JDispatcher} instead
 *
 * @deprecated	As of version 1.5
 * @package	Joomla.Legacy
 * @subpackage	1.5
 */
if ( !class_exists('mosMambotHandler')) {
  class mosMambotHandler extends JDispatcher
  {
	  function __construct()
	  {
		  parent::__construct();
	  }
  
	  /**
	  * Loads all the bot files for a particular group
	  * @param string The group name, relates to the sub-directory in the plugins directory
	  */
	  function loadBotGroup( $group )
	  {
		  return JPluginHelper::importPlugin($group, null, false);
	  }
	  /**
	  * Loads the bot file
	  * @param string The folder (group)
	  * @param string The elements (name of file without extension)
	  * @param int Published state
	  * @param string The params for the bot
	  */
	  function loadBot( $folder, $element, $published, $params='' )
	  {
		  return JPluginHelper::_import($folder, $element, $published, $params='' );
	  }
  
	  /**
	  * Registers a function to a particular event group
	  *
	  * @param string The event name
	  * @param string The function name
	  */
	  function registerFunction( $event, $function )
	  {
		  JApplication::registerEvent( $event, $function );
	  }
  
	  /**
	  * Deprecated, use {@link JDispatcher::trigger() JDispatcher->trigger()} instead and handle return values
	  * in your code
	  *
	  * @param string The event name
	  * @since 1.5
	  * @deprecated As of 1.5
	  */
	  function call($event)
	  {
		  $args = func_get_args();
		  array_shift($args);
  
		  $retArray = $this->trigger( $event, $args );
		  return $retArray[0];
	  }
  }
}