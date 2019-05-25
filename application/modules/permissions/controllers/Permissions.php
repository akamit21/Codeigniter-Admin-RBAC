<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Admin Portal
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Permissions
 */

class Permissions extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Permission', 'mdl_permission');
	}

	/**
	 * Fetch all data list
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_permission->get_all();
		$this->template->set('title', 'Permission List');
		$this->template->admin('template', 'list', $data);
	}

	/**
	 * Insert a new record
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('permission-name', 'permission value', 'required|trim|is_unique[permissions.permission_name]');
		$this->form_validation->set_rules('display-name', 'display name', 'required|trim');
		$this->form_validation->set_rules('module-name', 'module name', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Permission');
			$this->template->admin('template', 'add');
		} else {
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'permission_name' => strtolower($clean_post['permission-name']),
				'display_name' => strtoupper($clean_post['display-name']),
				'fk_component_id' => $clean_post['module-name'],
			);
			// insert to database
			if($this->mdl_permission->insert($form_data)) {
				$this->session->set_flashdata('success', "Success, New data successfully added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new data. Try Again!");
			}
			redirect('permissions', 'refresh');
		}
	}

	/**
	 * Edit record details
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('permission-name', 'permission name', 'required|trim');
		$this->form_validation->set_rules('display-name', 'display name', 'required|trim');
		$this->form_validation->set_rules('module-name', 'module name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_permission->get($id);
			$this->template->set('title', 'Edit Permission');
			$this->template->admin('template', 'edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'permission_name' => strtolower($clean_post['permission-name']),
				'display_name' => strtoupper($clean_post['display-name']),
				'fk_component_id' => $clean_post['module-name'],
			);
			// update to database
			if($this->mdl_permission->update($form_data, $id)) {
				$this->session->set_flashdata('success', "Success, Data successfully updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
			}
			redirect('permissions', 'refresh');
		}
	}

	/**
	 * Activate status
	 * @param  void
	 * @return boolean
	 */
	public function activate()
	{
		$data = array('is_active' => '1');
		$id = $this->input->post('primary_id');
		if($this->mdl_permission->update($data, $id)) {
			echo true;
		} else {
			echo false;
		}
	}

	/**
	 * Deactivate status
	 * @param  void
	 * @return boolean
	 */
	public function deactivate()
	{
		$data = array('is_active' => '0');
		$id = $this->input->post('primary_id');
		if($this->mdl_permission->update($data, $id)) {
			echo true;
		} else {
			echo false;
		}
	}

	/**
	 * Delete record from list
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_permission->delete($id)) {
			echo true;
		} else {
			echo false;
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

/* End of file Permissions.php */
/* Location: ./application/modules/permissions/controllers/Permissions.php */
