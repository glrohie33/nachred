<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Crud_model extends CI_Model{

    function get_slug($name){
        $name = strtolower($name);
        $name = str_replace(array(" ","&"),"-",$name);
        return $name;
    }

    function get_data($table,$id=null){
        if($id != null){
            $this->db->where($table."_id",$id);
        }
        return $this->db->get($table)->result_array();
    }

}