<?php
/**
 * ------------------------------------------------------------------------
 * JA Multilingual Component for J25 & J3
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */

defined('_JEXEC') or die;

JalangHelperContent::registerAdapter(
	__FILE__,
	'content',
	2,
	JText::_('CONTENT_ARTICLES'),
	JText::_('CONTENT_ARTICLES')
);

require_once( JPATH_ADMINISTRATOR . '/components/com_content/models/articles.php' );

class jaContentModelArticles extends ContentModelArticles
{
	public function __construct($config) {
		parent::__construct($config);
	}
	
	public function getListQuery() {
		return parent::getListQuery();
	}
}

class JalangHelperContentContent extends JalangHelperContent
{
	public function __construct($config = array())
	{
		$this->table = 'content';
		$this->edit_context = 'com_content.edit.article';
		$this->associate_context = 'com_content.item';
		$this->alias_field = 'alias';
		$this->translate_fields = array('title', 'introtext', 'fulltext', 'metakey', 'metadesc');
		$this->reference_fields = array('catid'=>'categories');
		$this->fixed_fields = array('asset_id'=> 0, 'version' => 1);
		parent::__construct($config);
	}

	public function getEditLink($id) {
		if($this->checkout($id)) {
			if(JalangHelper::isJoomla32()) {
				return 'index.php?option=com_content&view=article&layout=modal&tmpl=component&id='.$id;
			} else {
				return 'index.php?option=com_content&view=article&layout=edit&id='.$id;
			}
		}
		return false;
	}
	
	public function getListQuery2($model)
	{
		$db = JFactory::getDbo();
		$config = array();
		$modelContent = new jaContentModelArticles($config);
		
		$query = $modelContent->getListQuery();

		$defaultLanguage = JalangHelper::getDefaultLanguage();
		$language = $model->getState('mainlanguage');
		if($language == $defaultLanguage) {
			$query->where('(a.language = ' . $db->quote($language) . ' OR a.language = ' . $db->quote('*').')');
		} else {
			$query->where('a.language = ' . $db->quote($language));
		}
		return $query;
	}
	
	/**
	 * Returns an array of fields the table can be sorted by
	 */
	public function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.state' => JText::_('JSTATUS'),
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'category_title' => JText::_('JCATEGORY'),
			'access_level' => JText::_('JGRID_HEADING_ACCESS'),
			'a.created_by' => JText::_('JAUTHOR'),
			'language' => JText::_('JGRID_HEADING_LANGUAGE'),
			'a.created' => JText::_('JDATE'),
			'a.id' => JText::_('JGRID_HEADING_ID'),
			'a.featured' => JText::_('JFEATURED')
		);
	}
	
	/**
	 * Returns an array of fields will be displayed in the table list
	 */
	public function getDisplayFields()
	{
		return array(
			'a.id' => 'JGRID_HEADING_ID',
			'a.title' => 'JGLOBAL_TITLE',
			//'a.ordering' => 'JGRID_HEADING_ORDERING',
			'category_title' => 'JCATEGORY',
			//'a.created' => 'JDATE'
		);
	}

	public function afterTranslate(&$translator) {
		//update front-page
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('cf.*')->from('#__content_frontpage AS cf');
		$query->innerJoin('#__content AS c ON c.id = cf.content_id');

		$where = array();
		$where[] = 'c.language = '.$db->quote($translator->fromLangTag);
		if($translator->convertLangTag) {
			$where[] = 'c.language = '.$db->quote($translator->convertLangTag);
		}
		$query->where($where, 'OR');
		
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		if(count($rows)) {
			foreach ($rows as $row) {
				$newid = $translator->getAssociatedItem($this->table, $row->content_id);
				if($newid) {
					$queryTest = $db->getQuery(true);
					$queryTest->select('cf.content_id')->from('#__content_frontpage AS cf')->where('cf.content_id = '.$db->quote($newid));
					$db->setQuery($queryTest);
					$test = $db->loadResult();
					if(!$test) {
						$queryInsert = $db->getQuery(true);
						$queryInsert->insert('#__content_frontpage');
						$queryInsert->columns(array($db->quoteName('content_id'), $db->quoteName('ordering')));
						$queryInsert->values($db->quote($newid).','.$db->quote($row->ordering));

						$db->setQuery($queryInsert);
						$db->execute();
					}
				}
			}
		}
	}
}