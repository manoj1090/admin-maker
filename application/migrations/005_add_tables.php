<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_tables extends CI_Migration {

    public function up() {
        $this->db->query("CREATE TABLE `component` (
		  `id` int(11) NOT NULL,
		  `project_id` int(11) NOT NULL,
		  `title` varchar(250) NOT NULL,
		  `tab_name` varchar(250) NOT NULL,
		  `icon` varchar(250) DEFAULT NULL,
		  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
		  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

		$this->db->query("ALTER TABLE `component` ADD PRIMARY KEY (`id`);");
		$this->db->query("ALTER TABLE `component` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;");

		$this->db->query("CREATE TABLE `fields` (
			`id` int(11) NOT NULL,
			`component_id` int(11) NOT NULL,
			`title` varchar(250) NOT NULL,
			`column_name` varchar(250) NOT NULL,
			`type` varchar(250) NOT NULL,
			`configuration` longtext,
			`status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
			`create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

		$this->db->query("ALTER TABLE `fields` ADD PRIMARY KEY (`id`);");
		$this->db->query("ALTER TABLE `fields` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;");

		$this->db->query("CREATE TABLE `settings` (
			`key` varchar(250) NOT NULL,
			`value` longtext NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

		$this->db->query("ALTER TABLE `settings` ADD PRIMARY KEY (`key`);");
    }

    public function down() {
        $this->db->query("DROP TABLE `component`");
        $this->db->query("DROP TABLE `fields`");
        $this->db->query("DROP TABLE `settings`");
    }
}