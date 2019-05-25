<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author      Amit Kumar
 * @copyright   Copyright (c) 2018
 */

/**
 * Class Auth
 */

class Auth
{
	/*
	|--------------------------------------------------------------------------
	| Auth Library
	|--------------------------------------------------------------------------
	|
	| This Library handles authenticating users for the application and
	| redirecting them to your home screen.
	|
	*/

	protected $CI;

	public $user = null;
	public $user_id = null;
	public $role_id = null;
	public $username = null;
	public $password = null;
	public $permissions = null;
	public $login_status = false;
	public $error = array();


	public function __construct()
	{
		// constructor
		$this->CI =& get_instance();
		$this->init();
	}

	/**
	 * Initialization the Auth class
	 */
	protected function init()
	{
		if ($this->CI->session->has_userdata("user_id") && $this->CI->session->login_status) {
			$this->user_id = $this->CI->session->user_id;
			$this->role_id = $this->CI->session->role_id;
			$this->username = $this->CI->session->username;
			$this->login_status = true;
		}
		return;
	}

	/**
	 * Show login form
	 *
	 * @param array $data [null value]
	 */
	public function open_login_form($data = array())
	{
		$data['title'] = "Login";
		return $this->CI->load->view("login", $data);
	}

	/**
	 * User login authentication
	 *
	 * @param  string $request [input string]
	 * @return array|bool|void
	 */
	public function login($request)
	{
		// validate user input data
		if($this->_validate($request)) {
			// validate user login credentials
			$this->user = $this->_credentials($this->userName, $this->password);
			if ($this->user) {
				// update user login time
				$this->_update_login_time($this->user->user_id);
				// set user session data
				return $this->_set_user();
			} else {
				// failed login
				return $this->_failed_login($request);
			}
		}
		return false;
	}

	/**
	 * Validate the login data send by user is valid or not
	 *
	 * @param  string $request [input string]
	 * @return bool
	 */
	private function _validate($request)
	{
		$this->CI->form_validation->set_rules('username', 'User Name', 'required|trim|valid_email');
		$this->CI->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->CI->form_validation->run() == true) {
			$this->userName = $this->CI->input->post("username", true);
			$this->password = $this->CI->input->post("password", true);
			return true;
		}
		return false;
	}

	/**
	 * Check the credentials
	 *
	 * @param  string $username [input username]
	 * @param  string $password [input password]
	 * @return mixed
	 */
	private function _credentials($username, $password)
	{
		$this->CI->load->library("password");
		$user = $this->CI->db->get_where("users", array("username" => $username, "is_active" => '1', "is_deleted" => '0'), 1)->row();
		if($user && $this->CI->password->validate_password($password, $user->password)) {
			return $user;
		}
		return false;
	}

	/**
	 * Update time login
	 *
	 * @param  int $id [user primary id]
	 * @return bool
	 */
	private function _update_login_time($id)
	{
		$this->CI->db->where('user_id', $id);
		$this->CI->db->update('users', array('last_login' => date('d-m-Y h:i:s A')));
		return;
	}

	/**
	 * Setting session for authenticated user
	 */
	private function _set_user()
	{
		$this->CI->session->set_userdata(array(
			"user_id" => $this->user->user_id,
			"role_id" => $this->user->fk_role_id,
			"username" => $this->user->username,
			"full_name" => $this->user->full_name,
			"login_status" => true
		));
		return redirect("users");
		//$this->_send_login_notification();
	}

	/**
	 * Get the error message for failed login
	 *
	 * @param  string $request [input string]
	 * @return array
	 */
	private function _failed_login($request)
	{
		$this->error["failed"] = "Username or Password Incorrect.";
		return $this->error;
	}

	/**
	 * Read authenticated user ID
	 *
	 * @return int
	 */
	public function user_id()
	{
		return $this->user_id;
	}

	/**
	 * Read authenticated user roles
	 *
	 * @return int
	 */
	public function role_id()
	{
		return $this->role_id;
	}

	/**
	 * Read authenticated user Name
	 *
	 * @return string
	 */
	public function username()
	{
		return $this->username;
	}

	/**
	 * Read authenticated name
	 *
	 * @return string
	 */
	public function full_name()
	{
		return $this->full_name;
	}

	/**
	 * Check login status
	 *
	 * @return bool
	 */
	public function login_status()
	{
		return $this->login_status;
	}

	/**
	 * Send mail if logged from new device
	 */
	private function _send_login_notification()
	{
		$this->CI->load->library('user_agent');
		$browser = $this->CI->agent->browser();
		$os = $this->CI->agent->platform();
		$getip = $this->CI->input->ip_address();

		$result = $this->CI->db->get("settings")->row();
		$stLe = $result->site_title;
		$tz = $result->timezone;

		$now = new DateTime();
		$now->setTimezone(new DateTimezone($tz));
		$dTod =  $now->format('d-m-Y');
		$dTim =  $now->format('H:i:s');

		$this->CI->load->helper('cookie');
		$keyid = rand(1,9000);
		$scSh = sha1($keyid);
		$neMSC = md5($this->userName);
		$setLogin = array(
			'name'   => $neMSC,
			'value'  => $scSh,
			'expire' => strtotime("+2 day"),
		);
		$getAccess = get_cookie($neMSC);

		if(!$getAccess && $setLogin["name"] == $neMSC) {
			$this->CI->load->library('email');
			$this->CI->load->library('sendmail');
			$bUrl = base_url();
			$message = $this->CI->sendmail->secureMail($this->name, $this->userName, $dTod, $dTim, $stLe, $browser, $os, $getip, $bUrl);
			$to_email = $this->userName;
			$this->CI->email->from($this->CI->config->item('email'), 'New sign-in! from '.$browser.'');
			$this->CI->email->to($to_email);
			$this->CI->email->subject('New sign-in! from '.$browser.'');
			$this->CI->email->message($message);
			$this->CI->email->set_mailtype("html");
			$this->CI->email->send();

			$this->CI->input->set_cookie($setLogin, true);
			redirect('auth', 'refresh');
		} else {
			$this->CI->input->set_cookie($setLogin, true);
			redirect('auth', 'refresh');
		}
	}

	/**
	 * Determine if the current user is authenticated.
	 *
	 * @return bool
	 */
	public function is_loggedin()
	{
		if (!$this->login_status()) {
			return redirect('admin', 'refresh');
		}
		return true;
	}

	/**
	 * Check if user is developer or not
	 *
	 * @return bool
	 */
	public function is_developer()
	{
		return $this->role_id == '1' ? true : false;
	}

	/**
	 * Determine if the current user is authenticated to view the route/url
	 *
	 * @return bool
	 */
	public function route_access()
	{
		$route_name = is_null($this->CI->uri->segment(2)) ? $this->CI->uri->segment(1) . "-index" : $this->CI->uri->segment(1) . "-" . $this->CI->uri->segment(2);
		if($this->_can($route_name)) {
			return true;
		} else {
			return redirect('admin/error', 'refresh');
		}
	}

	/**
	 * Check if current user has a permission by its name.
	 *
	 * @param  string $route_name route name
	 * @param  bool $require_all
	 * @return bool
	 */
	private function _can($route_name, $require_all = false)
	{
		$permissions = $this->CI->db->get('permissions')->result();
		$permissions_array = array_column($permissions, 'permission_name');
				
		if (in_array($route_name, $permissions_array)) {
			$permission_id = $this->CI->db->get_where('permissions', array('permission_name' => $route_name))->row()->permission_id;
			if ($this->_check_permission($permission_id)) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
		
	}

	/**
	 * Check current user has specific permission
	 *
	 * @param  string $route_id route id
	 * @return bool
	 */
	private function _check_permission($permission_id)
	{
		return in_array($permission_id, $this->_user_permissions());
	}

	/**
	 * Read current user permissions name
	 *
	 * @return array
	 */
	private function _user_permissions()
	{
		$array = $this->CI->db->get_where("role_permission", array('fk_role_id' => $this->role_id))->row();
		return explode(',', $array->permission_ids);
	}

	/**
	 * Determine if the current user is authenticated to view the module
	 *
	 * @param  string $name module name
	 * @return bool
	 */
	public function module_access($name)
	{
		return array_map(function ($item) {
			if (in_array($item["component_id"], $this->_components_permissions())) {
				return true;
			} else {
				return false;
			}
		}, $this->CI->db->get_where('components', array('component_name' => $name))->result_array());
	}


	/**
	 * Get current user module permissions array
	 *
	 * @return array
	 */
	private function _components_permissions()
	{
		$array = $this->CI->db->get_where("role_component", array('fk_role_id' => $this->role_id))->row();
		return explode(',', $array->component_ids);
	}

	/**
	 * Determine if the current user is authenticated for specific methods.
	 *
	 * @param array $methods
	 * @return bool
	 */
	public function only($methods = array())
	{
		if (is_array($methods) && count(is_array($methods))) {
			foreach ($methods as $method) {
				if ($method == (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2))) {
					return $this->route_access();
				}
			}
		}
		return true;
	}

	/**
	 * Determine if the current user is authenticated except specific methods.
	 *
	 * @param array $methods
	 * @return bool
	 */
	public function except($methods = array())
	{
		if (is_array($methods) && count(is_array($methods))) {
			foreach ($methods as $method) {
				if ($method == (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2))) {
					return true;
				}
			}
		}
		return $this->route_access();
	}

	/**
	 * Logout current user
	 *
	 * @return bool
	 */
	public function logout()
	{
		$this->CI->session->unset_userdata(array("user_id", "role_id", "username", "full_name", "login_status"));
		$this->CI->session->sess_destroy();
		return true;
	}













	// forgot password
	public function forgot()
	{
		$result = $this->m_auth->getAllSettings();
		$sTl = $result->site_title;

		$email = $this->input->post('email-id');
		$clean = $this->security->xss_clean($email);
		$userInfo = $this->m_auth->getUserInfoByEmail($clean);

		if(!$userInfo){
			$this->session->set_flashdata('flash_message', 'We cant find your email address');
			redirect('auth/login', 'refresh');
		}

		if($userInfo->status != 'approved'){ //if status is not approved
			$this->session->set_flashdata('flash_message', 'Your account is not in approved status');
			redirect('auth/login', 'refresh');
		}

		//generate token
		$token = $this->m_auth->insertToken($userInfo->id);
		$qstring = $this->base64url_encode($token);
		$url = site_url() . '/auth/reset_password/token/' . $qstring;
		$link = '<a href="' . $url . '">' . $url . '</a>';

		$this->load->library('email');
		$this->load->library('sendmail');

		$message = $this->sendmail->sendForgot($userInfo->full_name,$this->input->post('email-id'),$link,$sTl);
		$to_email = $this->input->post('email-id');
		$this->email->from($this->config->item('forgot'), 'Reset Password! ' . $userInfo->full_name); //from sender, title email
		$this->email->to($to_email);
		$this->email->subject('Reset Password');
		$this->email->message($message);
		$this->email->set_mailtype("html");

		if($this->email->send())
		{
			$this->session->set_flashdata('success_message', 'A mail has been sent regarding password reset.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('flash_message', 'There was a problem sending an email.');
			redirect('auth/login', 'refresh');
		}
	}

	// reset password
	public function reset_password()
	{
		$token = $this->base64url_decode($this->uri->segment(4));
		$cleanToken = $this->security->xss_clean($token);
		$user_info = $this->m_auth->isTokenValid($cleanToken); //either false or array();

		if(!$user_info){
			$this->session->set_flashdata('flash_message', 'Token is invalid or expired');
			redirect('auth/login', 'refresh');
		}
		$data = array(
			'email'=>$user_info->email,
			'token'=>$this->base64url_encode($token)
		);

		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passconf', 'confirm password', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = "Medishala::Reset Password";
			$this->load->view('common_header', $data);
			$this->load->view('reset_password', $data);
			$this->load->view('common_footer');
		}
		else
		{
			$this->load->library('password');
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$cleanPost['password'] = $hashed;
			$cleanPost['user_id'] = $user_info->id;
			unset($cleanPost['passconf']);
			if($this->m_auth->updatePassword($user_info->role, $cleanPost) == true)
			{
				$this->session->set_flashdata('success_message', 'Your password has been updated. You may now login');
			}
			else
			{
				$this->session->set_flashdata('flash_message', 'There was a problem updating your password');
			}
			redirect('auth/login', 'refresh');
		}
	}

	// change password
	public function change_password()
	{
		$data = $this->session->userdata;
		// check user level
		if(empty($data['role'])) {
			redirect('auth/login', 'refresh');
		}

		// check is admin or not
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passconf', 'confirm password', 'required|required|matches[password]');

		$data['user_id'] = $data['id'];

		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = "Medishala::Change Password";
			$this->load->view('common_header', $data);
			$this->load->view('header', $data);
			$this->load->view('navbar', $data);
			$this->load->view('change_password', $data);
			$this->load->view('footer');
			$this->load->view('common_footer');
		}
		else
		{
			$this->load->library('password');
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$cleanPost['password'] = $hashed;
			$cleanPost['user_id'] = $cleanPost['user-id'];
			unset($cleanPost['passconf']);
			if($this->m_auth->updatePassword($data['role'], $cleanPost) == true)
			{
				$this->session->set_flashdata('success_message', 'Your password has been updated. You may now login');
			}
			else
			{
				$this->session->set_flashdata('flash_message', 'There was a problem updating your password');
			}
			redirect('auth/logout', 'refresh');
		}
	}

	// base64 encoding
	public function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

	// base64 decoding
	public function base64url_decode($data) {
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}

}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */
