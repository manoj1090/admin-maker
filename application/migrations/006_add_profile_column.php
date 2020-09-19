<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_profile_column extends CI_Migration {

    public function up() {
        $this->db->query("ALTER TABLE `users` ADD `profile_image` VARCHAR(250) NOT NULL DEFAULT 'profile.jpg' AFTER `password`");
    }

    public function down() {
        $this->db->query("ALTER TABLE `users` DROP `profile_image`");
    }
}