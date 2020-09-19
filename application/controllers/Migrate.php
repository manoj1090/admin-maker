<?php

class Migrate extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index() {
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            die('Dtabase migrated successfully...');
        }
    }

    public function downMigrate($version) {
        if ($this->migration->version($version) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            die('Dtabase migrated successfully...');
        }
    }
}