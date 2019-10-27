<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author    Amit Kumar <akamit21@gmail.com>
 * @copyright Copyright (c) 2019
 */

/**
 * Class Component
 */

class Component extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Component_model', 'component_model');
	}

	/**
	 * Fetch all component list
	 *
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		if($this->input->post('submit')) {
			$this->form_validation->set_rules('component-name', 'component name', 'required|trim|is_unique[components.component_name]');
			if($this->form_validation->run() == true) {
				$post = $this->input->post(null, true);
				$clean_post = $this->security->xss_clean($post);
				$form_data = array(
					'component_name' => strtolower($clean_post['component-name'])
				);
				// insert to database
				if($this->component_model->insert($form_data)) {
					$this->session->set_flashdata('success', "Success, New data successfully added!");
				} else {
					$this->session->set_flashdata('error', "Error, Can't add new data. Try Again!");
				}
				redirect("component", 'refresh');
			} else {
				$data['lists'] = $this->component_model->get_all();
				$this->template->set('title', 'Add Component');
				$this->template->admin('template', 'list', $data);
			}			
		} else {
			$data['lists'] = $this->component_model->get_all();
			$this->template->set('title', 'Add Component');
			$this->template->admin('template', 'list', $data);
		}
	}

	/**
	 * Edit component details
	 *
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{		
		if($this->input->post('submit')) {
			$this->form_validation->set_rules('component-name', 'component name', 'required|trim|is_unique[components.component_name]');
			if($this->form_validation->run() == true) {
				$post = $this->input->post(null, true);
				$clean_post = $this->security->xss_clean($post);
				$form_data = array(
					'component_name' => strtolower($clean_post['component-name'])
				);
				// update to database
				if($this->component_model->update($form_data, $id)) {
					$this->session->set_flashdata('success', "Success, Data successfully updated!");
				} else {
					$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
				}
				redirect("component", 'refresh');
			} else {
				$data['info'] = $this->component_model->get($id);
				$this->template->set('title', 'Edit Component');
				$this->template->admin('template', 'edit', $data);
			}
		} else {
			$data['info'] = $this->component_model->get($id);
			$this->template->set('title', 'Edit Component');
			$this->template->admin('template', 'edit', $data);
		}
	}

	

	/**
	 * Delete record permanently from database
	 *
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function remove($id)
	{
		if($this->component_model->remove($id)) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect("component", 'refresh');
	}
}

/* End of file Component.php */
/* Location: ./application/modules/component/controllers/Component.php */
