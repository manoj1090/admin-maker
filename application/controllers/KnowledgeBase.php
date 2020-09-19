<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KnowledgeBase extends MY_Controller {
    
    public $user;

	function __construct() {
        parent::__construct();
    }


    /**
     * This is a initial function to load the view of dashboard
     * @return VOID
     */
    public function index() {
    	$this->load->view('common/header');
    	$this->load->view('knowledgebase');
    	$this->load->view('common/footer');

    }

}