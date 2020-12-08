<?php
class Migration_Edit_state3 extends CI_Migration {

    public function up()
    {
            $field = array('location'=>array(
                'type'=>'TEXT'
            ));
            $field = array('hydrology'=>array(
                'type'=>'TEXT'
            ));
            $field = array('physio'=>array(
                'type'=>'TEXT'
            ));
            $field = array('ownership'=>array(
                'type'=>'TEXT'
            ));
            $this->dbforge->add_column('dam',$field);
    }

    public function down()
    {
            // $this->dbforge->drop_table('state');
    }
}