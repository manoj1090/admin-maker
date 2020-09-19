<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class First_component extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('First_component_model');
	}


	public function index() {
		$this->load->view('inc/header');
		$this->load->view('inc/sidebar');
		$this->load->view('First_component_view');
		$this->load->view('inc/footer');
	}


	public function saveData() {
		$this->model->insert();
	}
}