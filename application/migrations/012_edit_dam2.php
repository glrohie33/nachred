<?php
class Migration_Edit_dam2 extends CI_Migration {

    public function up()
    {
            $field = array('views'=>array(
                'type'=>'INT',
                'constraint'=>255,
                'default'=>0
            ));
            $this->dbforge->add_column('dam',$field);
    }

    public function down()
    {
            // $this->dbforge->drop_table('state');
    }
}