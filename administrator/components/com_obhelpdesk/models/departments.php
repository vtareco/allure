<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of department records.
 */
class obHelpDeskModelDepartments extends JModelList
{
	/**
	 * Constructor.
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'description', 'a.description',
				'published', 'a.published',
				'prefix', 'a.prefix',
				'assignment_type', 'a.assignment_type',
				'generation_rule', 'a.generation_rule',
				'next_ticket_number', 'a.next_ticket_number',
				'user_email_ticket', 'a.user_email_ticket',
				'staff_email_ticket', 'a.staff_email_ticket',
				'file_upload', 'a.file_upload',
				'notify_new_ticket_emails', 'a.notify_new_ticket_emails',
				'notify_assign', 'a.notify_assign',
				'file_upload_extensions', 'a.file_upload_extensions',
				'priority', 'a.priority',
				'ordering', 'a.ordering',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'usergroups', 'a.usergroups',
				'fields', 'a.fields',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Adjust the context to support modal layouts.
		if ($layout = JRequest::getVar('layout', 'default'))
		{
			$this->context .= '.'.$layout;
		}

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$state = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published');
		$this->setState('filter.published', $state);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_obhelpdesk');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.title', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id	.= ':'.$this->getState('filter.published');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 *
	 * @since   1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);

		$query->from($db->quoteName('#__obhelpdesk3_departments').' AS a');

		// If the model is set to check item state, add to the query.
		$state = $this->getState('filter.published');

		if (is_numeric($state))
		{
			$query->where('a.published = '.(int) $state);
		}

		// Filter the items over the search string if set.
		if ($this->getState('filter.search') !== '')
		{
			// Escape the search token.
			$token	= $db->Quote('%'.$db->escape($this->getState('filter.search')).'%');

			// Compile the different search clauses.
			$searches	= array();
			$searches[]	= 'a.title LIKE '.$token;
			$searches[]	= 'a.description LIKE '.$token;
			$searches[]	= 'a.prefix LIKE '.$token;

			// Add the clauses to the query.
			$query->where('('.implode(' OR ', $searches).')');
		}

		// Add the list ordering clause.
		$query->order($db->escape($this->getState('list.ordering', 'a.name')).' '.$db->escape($this->getState('list.direction', 'ASC')));

		return $query;
	}

}
