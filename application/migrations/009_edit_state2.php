<?php
class Migration_Edit_state2 extends CI_Migration {

    public function up()
    {
            $field = array('images'=>array(
                'type'=>'TEXT'
            ));
            $this->dbforge->add_column('dam',$field);
    }

    public function down()
    {
            // $this->dbforge->drop_table('state');
    }
}