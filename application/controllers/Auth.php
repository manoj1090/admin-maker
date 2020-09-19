<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is the authentication file that is responsible for authenticate the users
 * like login, forgot password and register new user
 * @Auther : Manoj Kumar Ahirwar
 */

class Auth extends MY_Controller {

	public $responce = array(
		"success" => true,
		"message" => ".",
		"data" => ''
	);

	function __construct() {
		parent::__construct();
	}


	public function index() {
		if($this->session->userdata('userData')) {
			redirect(baseurl() . 'dashboard');
		} else {
			redirect(baseurl() . 'auth/login');
		}
	}

	/**
	 * This method is responsible for register new user in the system
	 */
	public function register() {
		$request = $this->input->post();
		if(empty($request)) {
			$this->load->view('auth/register');
		} else {
			$dataArray = array(
				"name" => $request['name'],
				"email" => $request['email'],
				"password" => password_hash($request['pwd'], PASSWORD_DEFAULT),
				"status" => 'pending',
				"role" => 2
			);
			$data = $this->globalModel->insert(TAB_USERS, $dataArray);
			$this->responce['message'] = "User registered successfully";
			$this->responce['data'] = $data;
	
			$this->sendResponce($this->responce);
		}
	}

	/**
	 * This is multipurpose function using to load the login view as well as to authenticate the user
	 * @return VOID
	 */
	public function login() {
		$request = $this->input->post();
		if(empty($request)) {
			$this->load->view('auth/login');
		} else {
			$where = array(

				'email' => $request['email'],
				//'status' => 'active',
			);
			$user = $this->globalModel->getData(TAB_USERS, $where, []);
			if(empty($user)) {
				$this->responce['success'] = false;
				$this->responce['message'] = "Please inter valid email or password.";
			} else {

				if (password_verify($request['pwd'], $user[0]->password)) {
					$userData = array(
						"id" => $user[0]->id,
						"name" => $user[0]->name,
						"email" => $user[0]->email,
						"phone" => $user[0]->phone,
						"access_token" => $this->generateAccessToken(32)
					);
					$this->session->set_userdata('userData', $userData);
					$this->responce['message'] = "User successfully loggedin.";
					$this->responce['data'] = $userData;
					$update = array('access_token' => $userData['access_token']);
					$updWhere = array('id' => $user[0]->id);
					$this->globalModel->update(TAB_USERS, $update, $updWhere);
				}
				else {
					$this->responce['success'] = false;
					$this->responce['message'] = "Please inter valid password.";
				}
			}
			$this->sendResponce($this->responce);
		}
		
	}

	/**
	 * This function is used to logout the user
	 * @return Void
	 */
	public function logout() {
		$this->session->unset_userdata('userData');
		redirect(baseurl() . 'auth/login');
	}

	
}
