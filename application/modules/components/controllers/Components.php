<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Admin Portal
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Components
 */

class Components extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Component', 'mdl_component');
	}

	/**
	 * Component list
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_component->get_all();
		$this->template->set('title', 'Add Component');
		$this->template->admin('template', 'list', $data);

		if($this->input->post('submit')) {
			$this->form_validation->set_rules('component-name', 'component name', 'required|trim|is_unique[components.component_name]');
			if($this->form_validation->run() == true) {
				$post = $this->input->post(null, true);
				$clean_post = $this->security->xss_clean($post);
				$form_data = array(
					'component_name' => strtolower($clean_post['component-name'])
				);
				// insert to database
				if($this->mdl_component->insert($form_data)) {
					$this->session->set_flashdata('success', "Success, New data successfully added!");
				} else {
					$this->session->set_flashdata('danger', "Error, Can't add new data. Try Again!");
				}
			} 			
			redirect('components', 'refresh');
		}
	}

	/**
	 * Edit record details
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{
		$data['info'] = $this->mdl_component->get($id);
		$this->template->set('title', 'Edit Component');
		$this->template->admin('template', 'edit', $data);
		
		if($this->input->post('submit')) {
			$this->form_validation->set_rules('component-name', 'component name', 'required|trim|is_unique[components.component_name]');
			if($this->form_validation->run() == true) {
				$post = $this->input->post(null, true);
				$clean_post = $this->security->xss_clean($post);
				$form_data = array(
					'component_name' => strtolower($clean_post['component-name'])
				);
				// update to database
				if($this->mdl_component->update($form_data, $id)) {
					$this->session->set_flashdata('success', "Success, Data successfully updated!");
				} else {
					$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
				}
			}
			redirect('components', 'refresh');
		}
	}

	

	/**
	 * Delete record permanently from database
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function remove($id)
	{
		if($this->mdl_permission->remove($id)) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('permissions', 'refresh');
	}
}

/* End of file Components.php */
/* Location: ./application/modules/components/controllers/Components.php */
