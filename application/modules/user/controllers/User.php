<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author    Amit Kumar <akamit21@gmail.com>
 * @copyright Copyright (c) 2019
 */

/**
 * Class User
 */

class User extends Base_Controller
{
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		// load the models
		$this->load->model('User_model', 'user_model');
	}

	/**
	 * Fetch all data list
	 *
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->user_model->get_all();
		$this->template->set('title', 'User List');
		$this->template->admin('template', 'list', $data);
	}

	/**
	 * Insert a new record
	 *
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('full-name', 'name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('confpass', 'confirm password', 'required|trim|matches[password]');
		$this->form_validation->set_rules('role', 'role', 'required|trim');

		if($this->form_validation->run() == FALSE) {
			$this->template->set('title', 'Add User');
			$this->template->admin('template', 'add');
		} else {
			$this->load->library('password');
			$post = $this->input->post(NULL, TRUE);
			$clean_post = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$form_data = array(
				'full_name' => $clean_post['full-name'],
				'username' => $clean_post['email'],
				'password' => $hashed,
				'fk_role_id' => $clean_post['role']
			);
			unset($clean_post['confpass']);
			// insert to database
			if($this->mdl_user->insert($form_data)) {
				$this->session->set_flashdata('success', "Success, New data successfully added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new data. Try Again!");
			}
			redirect('users', 'refresh');
		}
	}

	/**
	 * Edit record details
	 *
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('full-name', 'full name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
		$this->form_validation->set_rules('role', 'role', 'required|trim');

		if($this->form_validation->run() == FALSE) {
			$data['info'] = $this->user_model->get($id);
			$this->template->set('title', 'Edit User');
			$this->template->admin('template', 'edit', $data);
		} else {
			$post = $this->input->post(NULL, TRUE);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'full_name' => $clean_post['full-name'],
				'username' => $clean_post['email'],
				'fk_role_id' => $clean_post['role']
			);
			// update to database
			if($this->user_model->update($form_data, $id)) {
				$this->session->set_flashdata('success', "Success, Data successfully updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
			}
			redirect('user', 'refresh');
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
		$this->input->post('csrf_token');
		$data = array('is_active' => '1');
		$id = $this->input->post('primary_id');
		if($this->user_model->update($data, $id)) {
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
		$this->input->post('csrf_token');
		$id = $this->input->post('primary_id');
		if($this->user_model->update($data, $id)) {
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
		$this->input->post('csrf_token');
		$id = $this->input->post('primary_id');
		if($this->user_model->delete($id)) {
			echo TRUE;
		} else {
			echo FALSE;
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
		if($this->user_model->force_delete($id)) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('users', 'refresh');
	}
}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */
