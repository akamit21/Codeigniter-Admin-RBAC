<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Admin Portal
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Plants
 */

class Plants extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Plant', 'mdl_plant');
		$this->load->library('file');
	}

	/**
	 * Fetch all data list
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_plant->get_all();
		$this->template->set('title', 'Plant List');
		$this->template->admin('template', 'list', $data);
	}

	/**
	 * Insert a new record
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('family-name', 'family name', 'required|trim');
		$this->form_validation->set_rules('plant-name', 'plant name', 'required|trim|is_unique[plants.plant_name]');
		$this->form_validation->set_rules('botanical-name', 'botanical name', 'required|trim|is_unique[plants.botanical_name]');
		$this->form_validation->set_rules('english-name', 'english name', 'required|trim');
		$this->form_validation->set_rules('common-name', 'common name', 'trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Plants');
			$this->template->admin('template', 'add');
		} else {
			$file_path = "assets/img/plants/";
			$folder = $this->mdl_plant->get_next_id();
			if (!is_dir($file_path . $folder)) {
				mkdir($file_path . $folder, 0777, true);
			}
			// file upload
			$file_array = array(
				'photo' => $_FILES['photo']['name'],
				'qr-code' => $_FILES['qr-code']['name']
			);
			$file_config = array(
				'upload_path' => $file_path . $folder,
				'log_threshold' => 1,
				'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
				'max_size' => 500,
				'encrypt_name' => true,
				'remove_spaces' => true,
				'detect_mime' => true,
				'overwrite' => false
			);
			$file = $this->file->file_upload($file_array, $uploaded_file_array = null, $file_config, $file_path, $folder, $id = null);
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'fk_family_id' => $clean_post['family-name'],
				'plant_name' => $clean_post['plant-name'],
				'botanical_name' => $clean_post['botanical-name'],
				'english_name' => $clean_post['english-name'],
				'common_name' => $clean_post['common-name'] ? $clean_post['common-name']:null,
				'unique_features' => $clean_post['unique-features'] ? $clean_post['unique-features']:null,
				'significant_features' => $clean_post['significant-features'] ? $clean_post['significant-features']:null,
				'plant_care' => $clean_post['plant-care'] ? $clean_post['plant-care']:null,
				'photo' => isset($file['photo']) ? $file['photo']:null,
				'qr_code' => isset($file['qr-code']) ? $file['qr-code']:null
			);
			// insert to database
			$result = $this->mdl_plant->insert($form_data);
			if($result['status']) {
				$this->session->set_flashdata('success', "Success, New data successfully added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new data. Try Again!");
			}
			redirect("plants/gallery/{$result['id']}", 'refresh');
		}
	}

	/**
	 * Edit record details
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('family-name', 'family name', 'required|trim');
		$this->form_validation->set_rules('plant-name', 'plant name', 'required|trim');
		$this->form_validation->set_rules('botanical-name', 'botanical name', 'required|trim');
		$this->form_validation->set_rules('english-name', 'english name', 'required|trim');
		$this->form_validation->set_rules('common-name', 'common name', 'trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_plant->get($id);
			$this->template->set('title', 'Edit Plant');
			$this->template->admin('template', 'edit', $data);
		} else {
			$file_path = "assets/img/plants/";
			$folder = $id;
			$file_array = array(
				'photo' => !empty($_FILES['photo']['name']) ? $_FILES['photo']['name']:null,
				'qr-code' => !empty($_FILES['qr-code']['name']) ? $_FILES['qr-code']['name']:null
			);
			$uploaded_file_array = array(
				'photo' => !empty($_POST['icon-photo']) ? $_POST['icon-photo']:null,
				'qr-code' => !empty($_POST['qr-code-photo']) ? $_POST['qr-code-photo']:null
			);
			$file_config = array(
				'upload_path' => $file_path . $folder,
				'log_threshold' => 1,
				'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
				'max_size' => 500,
				'encrypt_name' => true,
				'remove_spaces' => true,
				'detect_mime' => true,
				'overwrite' => false
			);
			// file upload
			$file = $this->file->file_upload($file_array, $uploaded_file_array, $file_config, $file_path, $folder, $id);
			$post = $this->input->post(null, true);
			$clean_post = $this->security->xss_clean($post);
			$form_data = array(
				'fk_family_id' => $clean_post['family-name'],
				'plant_name' => $clean_post['plant-name'],
				'botanical_name' => $clean_post['botanical-name'],
				'english_name' => $clean_post['english-name'],
				'common_name' => $clean_post['common-name'] ? $clean_post['common-name']:null,
				'unique_features' => $clean_post['unique-features'] ? $clean_post['unique-features']:null,
				'significant_features' => $clean_post['significant-features'] ? $clean_post['significant-features']:null,
				'plant_care' => $clean_post['plant-care'] ? $clean_post['plant-care']:null,
				'photo' => isset($file['photo']) ? $file['photo']:$_POST['icon-photo'],
				'qr_code' => isset($file['qr-code']) ? $file['qr-code']:$_POST['qr-code-photo']
			);
			// update to database
			if($this->mdl_plant->update($form_data, $id)) {
				$this->session->set_flashdata('success', "Success, Data successfully updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the data. Try Again!");
			}
			redirect("plants", 'refresh');
		}
	}

	/**
	 * Add gallery for plant
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function gallery($id)
	{
		$data['id'] = $id;
		$data['images'] = $this->mdl_plant->get_plant_gallery($id);
		$this->template->set('title', 'Plant Gallery');
		$this->template->admin('template', 'gallery', $data);

		if($this->input->post('save')) {
			$file_path = "assets/img/plants/{$id}/";
			$folder = "gallery";
			if (!is_dir($file_path.$folder)) {
				mkdir($file_path.$folder, 0777, true);
			}
			// file upload
			$names = array();
			$count = count($_FILES['file']['size']);
			foreach($_FILES as $key => $value)
			for($i=0; $i<=$count-1; $i++) {
				$_FILES['file']['name'] = $value['name'][$i];
				$_FILES['file']['type'] = $value['type'][$i];
				$_FILES['file']['tmp_name'] = $value['tmp_name'][$i];
				$_FILES['file']['error'] = $value['error'][$i];
				$_FILES['file']['size'] = $value['size'][$i];   
				$config = array(
					'upload_path' => $file_path.$folder,
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
					'max_size' => 1000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				
				$this->load->library('upload', $config);
				//$this->upload->do_upload();
				if(!$this->upload->do_upload('file')) {
				   	$error = $this->CI->upload->display_errors();
					$this->CI->session->set_flashdata('warning', "$error");
				} else {
					$data = $this->upload->data();
					$names[] = $data['file_name'];
				}
			}
			$result = $this->mdl_plant->insert_plant_gallery($names, $id);
			if($result['status']) {
				$this->session->set_flashdata('success', "Success, New data successfully added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new data. Try Again!");
			}
			redirect("plants/gallery/{$id}", 'refresh');
		}
	}

	/**
	 * Delete gallery image
	 * @param  string $name [image name]
	 * @return boolean
	 */
	public function delete_image()
	{
		$name = $this->input->post('img_name');
		$plant_id = $this->input->post('plant_id');
		if($this->mdl_plant->delete_gallery_image($name, $plant_id)) {
			echo true;
		} else {
			echo false;
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
		if($this->mdl_plant->update($data, $id)) {
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
		if($this->mdl_plant->update($data, $id)) {
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
		if($this->mdl_plant->delete($id)) {
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
		if($this->mdl_plant->remove($id)) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('plants', 'refresh');
	}
}

/* End of file Plants.php */
/* Location: ./application/modules/plants/controllers/Plants.php */
