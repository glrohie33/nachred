<?php
class Migration_Edit_state extends CI_Migration {

    public function up()
    {
            $field = array('feature_img'=>array(
                'type'=>'VARCHAR',
                'constraint'=>'500'
            ));
            $this->dbforge->add_column('dam',$field);
            $this->dbforge->drop_column('dam','rel_code');
            // // $this->dbforge->add_column('dam',$dam);
            // // $this->dbforge->add_column('region',$region);
            // $this->dbforge->add_column('state',$state);
    }

    public function down()
    {
            // $this->dbforge->drop_table('state');
    }
}