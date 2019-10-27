<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author    Amit Kumar <akamit21@gmail.com>
 * @copyright Copyright (c) 2019
 */

/**
 * Class Role
 */

class Role extends Base_Controller
{
	/**
	 * Roles_Controller Constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Role_model', 'role_model');
	}

	/**
	 * Fetch all role list
	 *
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->role_model->get_all();
		$this->template->set('title', 'Role List');
		$this->template->admin('template', 'list', $data);
	}

	/**
	 * Insert a new role
	 *
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('role-name', 'role name', 'required|trim|is_unique[roles.role_name]');

		if($this->form_validation->run() == false) {
			$data['components'] = $this->component_model->get_all();
			$data['permissions'] = $this->permission_model->get_all();
			$this->template->set('title', 'Add Role');
			$this->template->admin('template', 'add', $data);
		} else {
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'role_name' => $clean_post['role-name'],
				'description' => $clean_post['description'] ? $clean_post['description'] : null
			);
			$permissions = $this->input->post('permission');
			// insert to database
			if($this->role_model->insert_role($form_data, $permissions)) {
				$this->session->set_flashdata('success', "Success, New role has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new role!");
			}
			redirect("role", 'refresh');
		}
	}

	/**
	 * Edit role details
	 *
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('role-name', 'role name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->role_model->get($id);
			$data['components'] = $this->component_model->get_all();
			$data['permissions'] = $this->permission_model->get_all();
			$data['role_components'] = $this->role_model->get_components_by_role($id);
			$data['role_permissions'] = $this->role_model->get_permissions_by_role($id);
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
			if($this->role_model->update_role($form_data, $components_arr, $permissions_arr, $id)) {
				$this->session->set_flashdata('success', "Success, Data successfully updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
			}
			redirect("role", 'refresh');
		}

	}

	/**
	 * Activate status
	 *
	 * @param  void
	 * @return boolean
	 */
	public function activate()
	{
		$data = array('is_active' => '1');
		$id = $this->input->post('primary_id');
		if($this->role_model->update($data, $id)) {
			echo true;
		} else {
			echo false;
		}
	}

	/**
	 * Deactivate status
	 *
	 * @param  void
	 * @return boolean
	 */
	public function deactivate()
	{
		$data = array('is_active' => '0');
		$id = $this->input->post('primary_id');
		if($this->role_model->update($data, $id)) {
			echo true;
		} else {
			echo false;
		}
	}

	/**
	 * Delete record from list
	 *
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->role_model->delete($id)) {
			echo true;
		} else {
			echo false;
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
		if($this->role_model->force_delete($id)) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect("role", 'refresh');
	}
}

/* End of file Role.php */
/* Location: ./application/modules/role/controllers/Role.php */
