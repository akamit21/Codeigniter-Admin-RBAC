<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author    Amit Kumar <akamit21@gmail.com>
 * @copyright Copyright (c) 2019
 */

/**
 * Class User_model
 */

class User_model extends Base_Model
{
	function __construct()
	{
		// model constructor
		parent::__construct();
	}
	/**
	 * Define database table primary key
	 *
	 * @var string $_primary_key [PRIMARY KEY]
	 */
	protected $_primary_key = 'user_id';
}

/* End of file User_model.php */
/* Location: ./application/modules/user/models/User_model.php */
