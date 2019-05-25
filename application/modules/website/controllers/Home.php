<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * BMC
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
  */

/**
 * Class Websites
 */

class Home extends Base_Controller
{
	// controller constructor
	public function __construct()
	{
		// parent constructor
		parent::__construct();		
	}

	/**
	 * Home page
	 * @return void
	 */
	public function index()
	{
		$this->template->set('title', 'Home');
		$this->template->website('template', 'home');
	}

}

/* End of file Websites.php */
/* Location: ./application/modules/websites/controllers/Websites.php */
