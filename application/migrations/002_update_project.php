<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_project extends CI_Migration {

    public function up() {
        $this->db->query("ALTER TABLE `projects` CHANGE `db_file` `db_file` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;");
    }

    public function down() {
        $this->db->query("ALTER TABLE `projects` CHANGE `db_file` `db_file` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;");
    }
}
