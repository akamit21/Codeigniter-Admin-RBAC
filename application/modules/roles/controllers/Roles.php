<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Admin Portal
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Roles
 */

class Roles extends Base_Controller
{
	/**
	 * Roles_Controller Constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('role', 'mdl_role');
	}

	/**
	 * Fetch all data list
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_role->get_all();
		$this->template->set('title', 'Role List');
		$this->template->admin('template', 'list', $data);
	}

	/**
	 * Insert a new record
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('role-name', 'role name', 'required|trim|is_unique[roles.role_name]');

		if($this->form_validation->run() == false) {
			$data['components'] = $this->mdl_component->get_all();
			$data['permissions'] = $this->mdl_permission->get_all();
			$this->template->set('title', 'Add Role');
			$this->template->admin('template', 'add', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'role_name' => $cleanPost['role-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			$permissions = $this->input->post('permission');
			// insert to database
			if($this->mdl_role->insert_role($formData, $permissions)) {
				$this->session->set_flashdata('success', "Success, New role has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new role!");
			}
			redirect('roles', 'refresh');
		}
	}

	/**
	 * Edit record details
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('role-name', 'role name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_role->get($id);
			$data['components'] = $this->mdl_component->get_all();
			$data['permissions'] = $this->mdl_permission->get_all();
			$data['role_components'] = $this->mdl_role->get_components_by_role($id);
			$data['role_permissions'] = $this->mdl_role->get_permissions_by_role($id);
			$this->template->set('title', 'Edit Role');
			$this->template->admin('template', 'edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'role_name' => $clean_post['role-name'],
				'description' => $clean_post['description'] ? $clean_post['description'] : null
			);
			$components_arr = $this->input->post('component');
			$permissions_arr = $this->input->post('permission');
			// update to database
			if($this->mdl_role->update_role($form_data, $components_arr, $permissions_arr, $id)) {
				$this->session->set_flashdata('success', "Success, Data successfully updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
			}
			redirect('roles', 'refresh');
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
		if($this->mdl_role->update($data, $id)) {
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
		if($this->mdl_role->update($data, $id)) {
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
		if($this->mdl_role->delete($id)) {
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
		if($this->mdl_role->force_delete($id)) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('roles', 'refresh');
	}
}

/* End of file Roles.php */
/* Location: ./application/modules/roles/controllers/Roles.php */
