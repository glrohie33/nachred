<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index()
	{
		$page_data['page_name'] = "home";
		$this->load->view('home/index',$page_data);
	}

	public function states($para1=null,$para2 = null)
	{
	
		echo $para1;
		$page_data['page_name'] = "states";
		$this->parser->parse('index',$page_data);
	}

	public function dam($slug = null){
			$state = $this->db->get_where('state',array('slug'=>$slug));
			$dam = $this->db->get_where('dam',array('slug'=>$slug));
			if($state->num_rows() > 0 ){
				$state = $state->row();
				$state_id = $state->state_id;
					$this->db->select('dam_id,dam_name,slug,views,feature_img');
					$this->db->where('state_id',$state_id);
				$dams = $this->db->get('dam')->result_array();
				$page_data['dams'] = json_encode($dams);
				$page_data['total_rows'] = count($dams);
				$page_data['state'] = $state;
				$page_data['title'] = $state->state_name;
				$page_data['page_name'] = 'dam_list';
				$this->load->view('home/index',$page_data);
			}else if($dam->num_rows() > 0){
			
				$this->db->select('dam_id,dam_name, dam.update_at,dam.created_at,dam.feature_img,dam.images,dam.location,dam.ownership,dam.hydrology,dam.physio,region.region_name,state.state_name');
				$this->db->from('dam');
				$this->db->join('region', 'region.region_id = dam.region_id','inner');
				$this->db->join('state', 'state.state_id = dam.state_id','inner');
				$dams = $this->db->get()->row();
			
				$page_data['dam'] = json_encode($dams);
				$page_data['region_name'] = $dams->region_name;
				$page_data['state_name'] = $dams->state_name;
				$page_data['title'] = $dams->dam_name;
				$page_data['page_name'] = 'dam';
				$this->load->view('home/index',$page_data);
			}
	}
}
