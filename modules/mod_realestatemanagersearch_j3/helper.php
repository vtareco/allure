<?php

defined('_JEXEC') or die;

class modRealSearchHelper
{
    public static function getLink(&$params)
	{
		$document = JFactory::getDocument();

		foreach ($document->_links as $link => $value)
		{
			$value = JArrayHelper::toString($value);
			if (strpos($value, 'application/'.$params->get('format').'+xml'))
			{
				return $link;
			}
		}

	}
       
   
}
