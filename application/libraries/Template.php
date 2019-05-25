<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Temaplate View
 * Create by Amit Kumar
 * https://twitter.com/amitaldo
 * Github: https://github.com/akamit21
 * 2018
 *
 */

class Template
{
	/*
	|--------------------------------------------------------------------------
	| Template Library
	|--------------------------------------------------------------------------
	|
	| This Library handles view part for the application and
	| loads custom layout page
	|
	*/

	var $template_data = array();

	/**
	 * Create content in template
	 *
	 * @param $content_area
	 * @param $template-variable
	 * @return void
	 */
	public function set($content_area, $value)
	{
		$this->template_data[$content_area] = $value;
	}

	/**
	 * Load admin
	 *
	 * @param $template
	 * @param $name
	 * @param $view
	 * @param $view_data
	 * @return FALSE
	 */
	public function admin($template = '', $view = '' , $view_data = array(), $return = FALSE)
	{
		$this->CI =& get_instance();
		$this->set('contents' , $this->CI->load->view($view, $view_data, TRUE));
		$this->CI->load->view('admin/'.$template, $this->template_data);
	}

	/**
	 * Load admin
	 *
	 * @param $template
	 * @param $name
	 * @param $view
	 * @param $view_data
	 * @return FALSE
	 */
	public function website($template = '', $view = '' , $view_data = array(), $return = FALSE)
	{
		$this->CI =& get_instance();
		$this->set('contents' , $this->CI->load->view($view, $view_data, TRUE));
		$this->CI->load->view('website/'.$template, $this->template_data);
	}
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */
