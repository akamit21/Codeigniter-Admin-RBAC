<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Admin Portal
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Families
 */

class Families extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Family', 'mdl_family');
	}

	/**
	 * Index
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_family->get_all();
		$this->template->set('title', 'Plant Family List');
		$this->template->admin('template', 'list', $data);
	}

	/**
	 * Fetch all data list
	 * @param  void
	 * @return mixed
	 */
	public function fetch_all_data()
	{
		$data['lists'] = $this->mdl_family->get_all();
		$data['success'] = true;
		echo json_encode($data);
		//$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	/**
	 * Insert a new record
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('family-name', 'family name', 'required|trim|is_unique[families.family_name]');
		$this->form_validation->set_rules('description', 'description', 'trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Families');
			$this->template->admin('template', 'add');
		} else {
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'family_name' => $clean_post['family-name'],
				'description' => $clean_post['description'] ? $clean_post['description']:null
			);
			// insert to database
			if($this->mdl_family->insert($form_data)) {
				$this->session->set_flashdata('success', "Success, New data successfully added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new data. Try Again!");
			}
			redirect('families', 'refresh');
		}
	}

	/**
	 * Edit record details
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function fetch_by_id($id)
	{
		$data['info'] = $this->mdl_family->get($id);
		$data['success'] = true;
		echo json_encode($data);

	}
	/**
	 * Edit record details
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('family-name', 'Family Name', 'required|trim');
		$this->form_validation->set_rules('description', 'description', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_family->get($id);
			$this->template->set('title', 'Edit Families');
			$this->template->admin('template', 'edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'family_name' => $clean_post['family-name'],
				'description' => $clean_post['description'] ? $clean_post['description']:null
			);
			// update to database
			if($this->mdl_family->update($form_data, $id)) {
				$this->session->set_flashdata('success', "Success, Data successfully updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
			}
			redirect('families', 'refresh');
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
		if($this->mdl_family->update($data, $id)) {
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
		if($this->mdl_family->update($data, $id)) {
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
		if($this->mdl_family->delete($id)) {
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
		if($this->mdl_family->remove($id)) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('families', 'refresh');
	}
}

/* End of file Families.php */
/* Location: ./application/modules/families/controllers/Families.php */
