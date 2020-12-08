<?php
class Migration_Edit_dam1 extends CI_Migration {

    public function up()
    {
            $field = array('location'=>array(
                'type'=>'TEXT',
            ),'hydrology'=>array(
                'type'=>'TEXT'
            ),'physio'=>array(
                'type'=>'TEXT'
            )  
        );
            $this->dbforge->add_column('dam',$field);
    }

    public function down()
    {
            // $this->dbforge->drop_table('state');
    }
}