<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_slug extends CI_Migration {

    public function up() {
        $this->db->query("ALTER TABLE `projects` ADD `slug` VARCHAR(250) NULL AFTER `id`;");
    }

    public function down() {
        $this->db->query("ALTER TABLE `projects` DROP `slug`;");
    }
}
