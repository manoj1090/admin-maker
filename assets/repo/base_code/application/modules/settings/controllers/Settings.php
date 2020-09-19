<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class Settings extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	/**
	 * This function is used to load the setting page
	 * @return Void
	 */
	public function index() {

		$settings = $this->model->getData(TAB_SETTINGS, [], []);
		$tmp = array();
		foreach ($settings as $settkey => $settvalue) {
			$tmp[$settvalue->key] = $settvalue->value;
		}
		$data['settings'] = $tmp; 
		$this->load->view('inc/header');
		$this->load->view('inc/sidebar');
		$this->load->view('setting', $data);
		$this->load->view('inc/footer');
	}


	/**
	 * This function is used to update the settings
	 * @return Void
	 */
	public function updateSettings() {

		$post = $this->input->post();
		foreach ($post as $key => $postVal) {
				
				$data = array('value' => $postVal);
				$where = array('key' => $key); 
				$this->model->update('settings', $data, $where);
		}

		if(isset($_FILES['logo']) && !empty($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
	        $logo = array(
	            'field_name'    => 'logo',
	            'path'          => ASSETS_PATH . 'images/',
	            'allowed_types' => 'jpg|jpeg|png',
	            'max_size'      => 1000,
	        );
	       $logofile = $this->fileUpload($logo);
	       $this->model->update('settings', ['value' => $logofile['filenames'][0]], ['key' => 'logo']);
	    }
	    if(isset($_FILES['favicon']) && !empty($_FILES['favicon']) && $_FILES['favicon']['error'] == 0) {
	        $logo = array(
	            'field_name'    => 'favicon',
	            'path'          => ASSETS_PATH . 'images/',
	            'allowed_types' => 'ico',
	            'max_size'      => 100,
	        );
	       $logofile = $this->fileUpload($logo);
	       $this->model->update('settings', ['value' => $logofile['filenames'][0]], ['key' => 'favicon']);
	    }
	    $art_msg['msg'] 	= 'Settings Successfully updated';
		$art_msg['type'] 	= 'success';
	    $this->session->set_userdata('alert_msg', $art_msg);
	    redirect(baseurl() . 'settings');

	}

}