<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_projecttable extends CI_Migration {

    public function up() {
        $this->db->query("ALTER TABLE `projects` CHANGE `db_file` `logo` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;");
        $this->db->query("ALTER TABLE `projects` ADD `favicon` VARCHAR(250) NULL AFTER `logo`;");
    }

    public function down() {
        $this->db->query("ALTER TABLE `projects` CHANGE `logo` `db_file` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;");
        $this->db->query("ALTER TABLE `projects` DROP `favicon`;");
    }
}
