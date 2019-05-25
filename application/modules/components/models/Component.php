<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Admin Portal
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Component
 */

class Component extends Base_Model
{
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * Define database table primary key
	 *
	 * @var string $primary_key [PRIMARY KEY]
	 */
	protected $_primary_key = 'component_id';
}

/* End of file Component.php */
/* Location: ./application/modules/components/models/Component.php */
