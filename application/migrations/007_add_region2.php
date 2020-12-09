<?php
class Migration_Add_region2 extends CI_Migration
{

	public function up()
	{
		$dam = array('region_id'=>array('type'=>'BIGINT','constraint'=>255),'state_id'=>array('type'=>'BIGINT','constraint'=>255));
		$region= array('feature_img'=>array('type'=>'VARCHAR','constraint'=>255));
		$state = array('feature_img'=>array('type'=>'VARCHAR',
		'constraint'=>255),'region_id'=>array('type'=>'BIGINT',
		'constraint'=>255));
		$this->dbforge->add_column('dam',$dam);
		$this->dbforge->add_column('region',$region);
		$this->dbforge->add_column('state',$state);
	}

	public function down()
	{
		// $this->dbforge->drop_table('state');
	}
}
