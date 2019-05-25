<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Admin
 */

class Admin extends CI_Controller
{

	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->library('auth');
		$this->form_validation->set_error_delimiters('<div class="custom-label label-danger">', '</div>');
	}

	/**
	 * User login
	 */
	public function index()
	{
		$data = array();
		if($_POST) {
			$data = $this->auth->login($_POST);
		}
		return $this->auth->open_login_form($data);
	}

	/**
	 * Custom error
	 */
	public function error()
	{
		return $this->load->view("error");
	}

	/**
	 * User logout
	 */
	public function logout()
	{
		$this->auth->logout();
		redirect('admin', 'refresh');
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
