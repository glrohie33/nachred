<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_media extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'media_id' => array(
                                'type' => 'INT',
                                'constraint' =>255,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'media_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '300',
                        ),
                        'media_type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '300',
                        ),
                        'alt' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '300',
                            'null'=>TRUE
                        ),
                        'url' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '300',
                        ),
                        'created_at datetime default current_timestamp',
                        'updated_at datetime default current_timestamp on update current_timestamp'
                ));
                $this->dbforge->add_key('media_id', TRUE);
                $this->dbforge->create_table('media');
        }

        public function down()
        {
                $this->dbforge->drop_table('media');
        }
}