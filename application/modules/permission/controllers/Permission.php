<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author    Amit Kumar <akamit21@gmail.com>
 * @copyright Copyright (c) 2019
 */

/**
 * Class Permission
 */

class Permission extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Permission_model', 'permission_model');
	}

	/**
	 * Fetch all permission list
	 *
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->permission_model->get_all();
		$this->template->set('title', 'Permission List');
		$this->template->admin('template', 'list', $data);
	}

	/**
	 * Insert a new permission
	 *
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
				'fk_component_id' => $clean_post['module-name'],
				'permission_name' => strtolower($clean_post['permission-name']),
				'display_name' => strtoupper($clean_post['display-name'])
				
			);
			// insert to database
			if($this->permission_model->insert($form_data)) {
				$this->session->set_flashdata('success', "Success, New data successfully added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new data. Try Again!");
			}
			redirect('permission', 'refresh');
		}
	}

	/**
	 * Edit permission details
	 *
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('permission-name', 'permission name', 'required|trim');
		$this->form_validation->set_rules('display-name', 'display name', 'required|trim');
		$this->form_validation->set_rules('module-name', 'module name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->permission_model->get($id);
			$this->template->set('title', 'Edit Permission');
			$this->template->admin('template', 'edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'fk_component_id' => $clean_post['module-name'],
				'permission_name' => strtolower($clean_post['permission-name']),
				'display_name' => strtoupper($clean_post['display-name'])
			);
			// update to database
			if($this->permission_model->update($form_data, $id)) {
				$this->session->set_flashdata('success', "Success, Data successfully updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
			}
			redirect('permission', 'refresh');
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
		if($this->permission_model->update($data, $id)) {
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
		if($this->permission_model->update($data, $id)) {
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
		if($this->permission_model->delete($id)) {
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
		if($this->permission_model->remove($id)) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('permission', 'refresh');
	}
}

/* End of file Permission.php */
/* Location: ./application/modules/permission/controllers/Permission.php */
