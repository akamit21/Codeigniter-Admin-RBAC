<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * BMC
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Website
 */

class Website extends Base_Model
{
	// model constructor
	function __construct()
	{
		// parent constructor
		parent::__construct();
	}
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $primary_key = 'user_p_id';
}

/* End of file Website.php */
/* Location: ./application/modules/websites/models/Website.php */
