<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_state extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'state_id' => array(
                                'type' => 'INT',
                                'constraint' =>255,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'state_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'state_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'created_at datetime default current_timestamp',
                        'updated_at datetime default current_timestamp on update current_timestamp'
                ));
                $this->dbforge->add_key('state_id', TRUE);
                $this->dbforge->create_table('state');
        }

        public function down()
        {
                $this->dbforge->drop_table('state');
        }
}