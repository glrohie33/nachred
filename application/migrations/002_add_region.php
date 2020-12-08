<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_region extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'region_id' => array(
                                'type' => 'INT',
                                'constraint' =>255,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'region_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'region_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'rel_code'=>array(
                            'type'=>'TEXT',
                            'null'=>true
                        ),
                        'created_at datetime default current_timestamp',
                        'update_at datetime default current_timestamp on update current_timestamp'
                    ));
                $this->dbforge->add_key('region_id', TRUE);
                $this->dbforge->create_table('region',TRUE);
        }

        public function down()
        {
                $this->dbforge->drop_table('region');

        }
}