<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class Mka extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Mka_model');
	}


	public function index() {
		$this->load->view('inc/header');
		$this->load->view('inc/sidebar');
		$this->load->view('Mka_view');
		$this->load->view('inc/footer');
	}


	public function saveData() {
		$this->model->insert();
	}
}