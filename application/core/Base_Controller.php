<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Create by Amit Kumar
 *
 * @link http://github.com/akamit21/Codeigniter3-HMVC-RBAC-Login-Module
 * @copyright Copyright (c) 2018, Amit Kumar <https://twitter.com/amitaldo>
 */

/**
 * Class Base_Controller
 */
class Base_Controller extends MX_Controller
{
	/**
	 * Base_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		// auth library
		$this->load->library('auth');
		// user authentication [if user is logged in or not]
		$this->auth->is_loggedin();
		// check route access [check if user is authorized to view this page or not]
		$this->auth->route_access();
		// miscaellaneous library
		$this->load->library('misc');
		// form error deliminiters
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

		// modules
		$this->load->module('users');
		$this->load->module('roles');
		$this->load->module('components');
		$this->load->module('permissions');
		$this->load->module('families');
		$this->load->module('plants');
	}
}
