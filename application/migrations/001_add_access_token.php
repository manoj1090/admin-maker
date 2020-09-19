<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_access_token extends CI_Migration {

    public function up() {
        $this->db->query("ALTER TABLE `users` ADD `access_token` VARCHAR(250) NULL AFTER `password`;");
    }

    public function down() {
        $this->db->query("ALTER TABLE `users` DROP `access_token`;");
    }
}