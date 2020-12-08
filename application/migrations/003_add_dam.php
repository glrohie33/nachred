<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_dam extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'dam_id' => array(
                                'type' => 'INT',
                                'constraint' =>255,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'dam_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '500',
                        ),
                        'dam_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'rel_code'=>array(
                            'type'=>'TEXT'
                        ),
                        'created_at datetime default current_timestamp',
                        'update_at datetime default current_timestamp on update current_timestamp'
                    ));
                $this->dbforge->add_key('dam_id', TRUE);
                $this->dbforge->create_table('dam',TRUE);
        }

        public function down()
        {
                $this->dbforge->drop_table('dam');

        }
}