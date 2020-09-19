<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Test_new extends CI_Migration {

        public function up()
        {
                $this->db->query(
                        "CREATE TABLE IF NOT EXISTS `advanced_control` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `room_id` int(11) NOT NULL DEFAULT '0',
                          `entertainment_id` int(11) DEFAULT NULL,
                          `label` varchar(255) NOT NULL DEFAULT 'NA',
                          `position` int(11) NOT NULL DEFAULT '0',
                          `is_automation` tinyint(1) NOT NULL DEFAULT '0',
                          `is_roomlevel` tinyint(1) NOT NULL DEFAULT '0',
                          `is_active` int(11) NOT NULL DEFAULT '0',
                          `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is_custom_command=1,switch_device=2',
                          `modified_by` int(11) NOT NULL DEFAULT '0',
                          `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          `last_updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                          `is_disable` tinyint(1) NOT NULL DEFAULT '0',
                          PRIMARY KEY (`id`),
                          KEY `FK_advanced_control_room_info_room_id` (`room_id`),
                          KEY `FK_advanced_control_entertainment_id` (`entertainment_id`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1003 ;"

                );

                $this->db->query("
                        INSERT INTO `advanced_control` (`id`, `room_id`, `entertainment_id`, `label`, `position`, `is_automation`, `is_roomlevel`, `is_active`, `type`, `modified_by`, `created_at`, `last_updated_at`, `is_disable`) VALUES
                                (1001, 1, 4, 'TV (AD NOTAM DFU)', 1, 0, 0, 0, 0, 0, '2018-09-05 15:38:14', NULL, 0),
                                (1002, 1, 5, 'STB', 2, 0, 0, 0, 0, 0, '2018-09-05 15:38:15', NULL, 0);
                        ");
        }

        public function down()
        {
                $this->dbforge->drop_table('advanced_control');
        }
}