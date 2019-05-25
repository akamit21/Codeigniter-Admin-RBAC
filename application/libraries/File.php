<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Multiple File Upload
 *
 * @author      Amit Kumar
 * @copyright   Copyright (c) 2018
 */

/**
 * Class File
 */

class File
{
	/*
	|--------------------------------------------------------------------------
	| File Library
	|--------------------------------------------------------------------------
	|
	| This Library handles multiple file upload functions for the application.
	|
	*/

	protected $CI;

	public function __construct()
	{
		// constructor
		$this->CI =& get_instance();
	}

	/**
	 * Re-Uploading employee documents.
	 * @param  array  $new_file_arr [new uploaded files]
	 * @param  array  $old_file_arr [old uploaded files]
	 * @param  array  $config  [configuration array]
	 * @param  string $file_path    [file path name]
	 * @param  string $folder       [folder name]
	 * @param  int    $id  	        [primary key]
	 * @return array  $name
	 */
	public function file_upload($new_file_arr, $old_file_arr, $config, $file_path, $folder, $id)
	{
		$name = '';
		$this->CI->load->library('upload');
		foreach ($new_file_arr as $new_file_key => $new_file_value) {
			if($old_file_arr != null) {
				foreach ($old_file_arr as $old_file_key => $old_file_value) {
					if(empty($new_file_value)) continue;
					if($new_file_key == $old_file_key) {
						if(file_exists($file_path . $folder . '/' . $old_file_value)) {
							unlink($file_path . $folder . '/' . $old_file_value);
						}
					}
				}
			}

			if(empty($new_file_value)) continue;

			$config['file_name'] = $new_file_key;
			$this->CI->upload->initialize($config);
			if($this->CI->upload->do_upload($new_file_key)) {
				$data = $this->CI->upload->data();
				$name[$new_file_key] = $data['file_name'];
			} else {
				$error = $this->CI->upload->display_errors();
				$this->CI->session->set_flashdata('warning', "$error");
			}
		}
		return $name;
	}
}

/* End of file Misc.php */
/* Location: ./application/libraries/Misc.php */
