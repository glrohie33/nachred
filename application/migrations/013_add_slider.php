<?php

class Migration_Add_slider extends CI_Migration
{

	public function up()
	{
		$this->dbforge->add_field(array(
			'slider_id' => array(
				'type' => 'INT',
				'constraint' => 255,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'slider_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'slider_text' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		));
		$this->dbforge->add_key('slider_id', TRUE);
		$this->dbforge->create_table('slider');
	}

	public function down()
	{
		$this->dbforge->drop_table('slider');
	}
}
