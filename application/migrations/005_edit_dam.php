<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Edit_dam extends CI_Migration
{

	public function up()
	{
		$field = array('slug' => array('type' => 'TEXT'));
		$this->dbforge->add_column('dam', $field);
		$this->dbforge->add_column('region', $field);
		$this->dbforge->add_column('state', $field);
	}

	public function down()
	{
		// $this->dbforge->drop_table('state');
	}
}
