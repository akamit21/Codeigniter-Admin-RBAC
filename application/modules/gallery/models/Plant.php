<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Park Online Management - Admin Portal
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Plant
 */

class Plant extends Base_Model
{
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * Define database table primary key
	 *
	 * @var string $primary_key [PRIMARY KEY]
	 */
	protected $_primary_key = 'plant_id';

	/**
	 * Insert images for plant gallery.
	 * @param  array $names [image name]
	 * @param  array $id    [plant id]
	 * @return array
	 */
	public function insert_plant_gallery($names, $id)
	{
		if ($names != null && $id != null) {
			foreach ($names as $name) {
				$data = array(
					'fk_plant_id' => $id,
					'img_name' => $name
				);
				$this->db->insert('plant_gallery', $data);
			}
			$response = array(
				'status' => true,
				'id' => $id
			);
			return $response;
			
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * Get images of plant gallery.
	 * @param  int $id [plant id]
	 * @return array
	 */
	public function get_plant_gallery($id)
	{
		if ($id != null) {
			return $this->db->get_where('plant_gallery', array('fk_plant_id' => $id))->result();
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * Delete images of plant gallery.
	 * @param  string $name [image name]
	 * @param  int    $id   [plant id]
	 * @return boolean
	 */
	public function delete_gallery_image($name, $id)
	{
		if ($name != null && $id != null) {
			$this->db->where(array('fk_plant_id' => $id, 'img_name' => $name));
			$this->db->delete('plant_gallery');
			if($this->db->affected_rows() == 1) {
				if(file_exists('assets/img/plants/' . $id . '/gallery/' . $name)) {
					unlink('assets/img/plants/' . $id . '/gallery/' . $name);
				}
				return true;
			}
			return false;
		} else {
			error_log('Error, Undefined variabled: $name');
			return false;
		}
	}
}

/* End of file Plant.php */
/* Location: ./application/modules/plants/models/Plant.php */
