<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Website
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
  */

/**
 * Class Plants
 */

class Plants extends Base_Controller
{
	// controller constructor
	public function __construct()
	{
		// parent constructor
		parent::__construct();
		$this->load->model('Plants/Plant', 'mdl_plant');	
	}

	/**
	 * Fetch all data list
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_plant->get_all();
		$this->template->set('title', 'Plant Details');
		$this->template->website('template', 'plants/plant-lists', $data);
	}

	/**
	 * Get plant detail by name/id
	 * @return void
	 */
	public function details($name)
	{
		$data['info'] = $this->mdl_plant->get_by(array('botanical_name' => $name));
		$this->template->set('title', 'Plant Details');
		$this->template->website('template', 'plants/plant-details', $data);
	}
}

/* End of file Plants.php */
/* Location: ./application/modules/website/controllers/Plants.php */
