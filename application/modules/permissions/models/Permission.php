<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Admin Portal
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Permission
 */

class Permission extends Base_Model
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
	protected $_primary_key = 'permission_id';
}

/* End of file Permission.php */
/* Location: ./application/modules/permissions/models/Permission.php */
