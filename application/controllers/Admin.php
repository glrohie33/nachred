<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function index()
	{
		$page_data['page_name'] = "dashboard";
		$this->load->view('admin/index', $page_data);
	}

	public function login($para1 = null)
	{
		if ($this->session->userdata('admin_login') == 'yes') {
			redirect('/admin/dashboard');
		}
		if ($para1 != null) {
			if ($para1 == 'do_login') {
				$return['status'] = 'false';
				$rules = array(
					array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'required'
					),
					array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'required'
					)
				);

				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run()) {
					$login = false;
					if ($this->input->post('email') == 'admin@nachred.org.ng' && $this->input->post('password') == 'Nachred@123!') {
						$login = true;
					}
					if ($login) {
						$this->session->set_userdata('admin_login', 'yes');
						$return['status'] = true;
						$return['data'] = "";
					} else {
						$return['status'] = false;
						$return['error'] = "<p>wrong email and password</p>";
					}
				} else {
					$return['status'] = false;
					$return['error'] = validation_errors();
				}
				echo json_encode($return);
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function logout()
	{
		$this->session->set_userdata('admin_login', 'no');
		redirect('admin/login');
	}

	public function dashboard()
	{
		if ($this->session->userdata('admin_login') == 'no') {
			redirect('admin/login');
		}
		$page_data['regions'] = $this->db->count_all('region');
		$page_data['dams'] = $this->db->count_all('dam');
		$page_data['states'] = $this->db->count_all('state');
		$page_data['views'] = $this->db->select_sum('views')->get('dam')->row()->views;
		$page_data['page_name'] = "dashboard";
		$this->load->view('admin/index', $page_data);
	}

	public function region($para1 = null, $para2 = null)
	{
		if ($this->session->userdata('admin_login') == 'no') {
			redirect('admin/login');
		}
		if ($para1 != null) {
			if ($para1 == 'add') {

				$page_data['page_name'] = 'add_region';
				$this->load->view('admin/index', $page_data);
			} else if ($para1 == 'save') {
				$return['status'] = 'false';
				$rules = array(
					array(
						'field' => 'name',
						'label' => 'Name',
						'rules' => 'required'
					),
					array(
						'field' => 'ft_image',
						'label' => 'Featured Image',
						'rules' => 'required'
					)
				);

				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run()) {
					$slug = $this->crud_model->get_slug($this->input->post('name'));
					$this->db->like('slug', $slug);
					$slugs = $this->db->get('region');
					if ($slugs->num_rows() > 0) {
						$add = $slugs->num_rows();
						$slug = $slug . "-" . $add;
					}
					$data['region_name'] = $this->input->post('name');
					$data['region_description'] = $this->input->post('description');
					$data['slug'] = $slug;
					$data['feature_img'] = $this->input->post('ft_image');
					$insert = $this->db->insert('region', $data);
					if ($insert) {
						$data['region_id'] = $this->db->insert_id();
						$region = $this->db->get_where('region', $data)->row();
						$return['status'] = true;
						$return['data'] = $region;
					} else {
						$return['status'] = false;
						$return['error'] = "<p>data couldn't be saved please try later</p>";
					}
				} else {
					$return['status'] = false;
					$return['error'] = validation_errors();
				}
				echo json_encode($return);
			} else if ($para1 == 'edit') {
				if ($para2 != null) {
					$query = $this->db->get_where('region', array('region_id' => $para2));
					if ($query->num_rows() > 0) {
						$region = $query->row();
						$page_data['region'] = $region;
						$page_data['page_name'] = 'edit_region';
						$this->load->view('admin/index', $page_data);
					}
				}
			} else if ($para1 == 'update') {
				if ($para2 != null) {
					$status = false;
					$error = "";
					$data = "";
					$rules = array(
						array(
							'field' => 'name',
							'label' => 'Name',
							'rules' => 'required'
						),
						array(
							'field' => 'ft_image',
							'label' => 'Featured Image',
							'rules' => 'required'
						)
					);

					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run()) {

						$this->db->where('region_id', $para2);
						$p_data['region_name'] = $this->input->post('name');
						$p_data['region_description'] = $this->input->post('description');
						$p_data['feature_img'] = $this->input->post('ft_image');



						if ($this->db->update('region', $p_data)) {
							$status = true;
							$data = " ";
						} else {
							$error = "<p>Cant upload now there is an error</p>";
						}
					} else {
						$error = validation_errors();
					}

					echo json_encode(compact('status', 'error', 'data'));
				}
			} else if ($para1 == 'delete') {
				if ($para2 != null) {
					$status = false;
					$error = "";
					$data = "";
					$this->db->where('region_id', $para2);
					if ($this->db->delete('region')) {
						$status = true;
						$data = $this->db->get('region')->result_array();
					} else {
						$error = "sorry region could not be deleted try again later";
					}
					echo json_encode(compact('status', 'error', 'data'));
				}
			}
		} else {
			$regions = $this->db->get('region')->result_array();
			$config['attributes'] = array('ng-click' => 'setPage(this.innerHTML)');
			// die(var_dump(count($regions)));
			$config['total_rows'] = count($regions);
			$config['per_page'] = 5;
			$this->pagination->initialize($config);
			$page_data['regions'] = json_encode($regions);
			$page_data['pagination'] = $this->pagination->create_links();
			$page_data['page_name'] = 'region';
			$page_data['total_rows'] = $config['total_rows'];
			$this->load->view('admin/index', $page_data);
		}
	}

	public function state($para1 = null, $para2 = null)
	{
		if ($this->session->userdata('admin_login') == 'no') {
			redirect('admin/login');
		}
		if ($para1 != null) {
			if ($para1 == 'add') {

				$page_data['page_name'] = 'add_state';
				$page_data['regions'] = json_encode($this->db->get('region')->result_array());
				$this->load->view('admin/index', $page_data);
			} else if ($para1 == 'save') {
				$return['status'] = 'false';
				$rules = array(
					array(
						'field' => 'name',
						'label' => 'Name',
						'rules' => 'required'
					), array(
						'field' => 'region',
						'label' => 'Region',
						'rules' => 'required'
					),
					array(
						'field' => 'ft_image',
						'label' => 'Featured Image',
						'rules' => 'required'
					)
				);

				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run()) {
					$slug = $this->crud_model->get_slug($this->input->post('name'));
					$this->db->like('slug', $slug);
					$slugs = $this->db->get('state');
					if ($slugs->num_rows() > 0) {
						$add = $slugs->num_rows();
						$slug = $slug . "-" . $add;
					}
					$data['state_name'] = $this->input->post('name');
					$data['region_id'] = $this->input->post('region');
					$data['state_description'] = $this->input->post('description');
					$data['slug'] = $slug;
					$data['feature_img'] = $this->input->post('ft_image');
					$insert = $this->db->insert('state', $data);
					if ($insert) {
						$data['state_id'] = $this->db->insert_id();
						$region = $this->db->get_where('state', $data)->row();
						$return['status'] = true;
						$return['data'] = $region;
					} else {
						$return['status'] = false;
						$return['error'] = "<p>data couldn't be saved please try later</p>";
					}
				} else {
					$return['status'] = false;
					$return['error'] = validation_errors();
				}
				echo json_encode($return);
			} else if ($para1 == 'edit') {
				if ($para2 != null) {
					$query = $this->db->get_where('state', array('state_id' => $para2));
					if ($query->num_rows() > 0) {
						$state = $query->row();
						$page_data['state'] = $state;
						$page_data['regions'] = json_encode($this->db->get('region')->result_array());
						$page_data['page_name'] = 'edit_state';
						$this->load->view('admin/index', $page_data);
					}
				}
			} else if ($para1 == 'update') {
				if ($para2 != null) {
					$status = false;
					$error = "";
					$data = "";
					$rules = array(
						array(
							'field' => 'name',
							'label' => 'Name',
							'rules' => 'required'
						), array(
							'field' => 'region',
							'label' => 'Region',
							'rules' => 'required'
						),
						array(
							'field' => 'ft_image',
							'label' => 'Featured Image',
							'rules' => 'required'
						)
					);

					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run()) {


						$this->db->where('state_id', $para2);
						$p_data['state_name'] = $this->input->post('name');
						$p_data['region_id'] = $this->input->post('region');
						$p_data['state_description'] = $this->input->post('description');
						$p_data['feature_img'] = $this->input->post('ft_image');


						if ($this->db->update('state', $p_data)) {
							$status = true;
							$data = " ";
						} else {
							$error = "<p>Cant upload now there is an error</p>";
						}
					} else {
						$error = validation_errors();
					}

					echo json_encode(compact('status', 'error', 'data'));
				}
			} else if ($para1 == 'delete') {
				if ($para2 != null) {
					$status = false;
					$error = "";
					$data = "";
					$this->db->where('state_id', $para2);
					if ($this->db->delete('state')) {
						$status = true;
						$data = $this->db->get('region')->result_array();
					} else {
						$error = "sorry region could not be deleted try again later";
					}
					echo json_encode(compact('status', 'error', 'data'));
				}
			}
		} else {
			$this->db->select('state_id,state_name,state_description, state.updated_at,state.created_at,state.feature_img,region.region_name');
			$this->db->from('state');
			$this->db->join('region', 'region.region_id = state.region_id', 'left');

			$state = $this->db->get()->result_array();
			$config['attributes'] = array('ng-click' => 'setPage(this.innerHTML)');
			// die(var_dump(count($regions)));
			$config['total_rows'] = count($state);
			$config['per_page'] = 5;
			$this->pagination->initialize($config);
			$page_data['states'] = json_encode($state);
			$page_data['pagination'] = $this->pagination->create_links();
			$page_data['page_name'] = 'state';
			$page_data['total_rows'] = $config['total_rows'];
			$this->load->view('admin/index', $page_data);
		}
	}

	public function dam($para1 = null, $para2 = null)
	{
		if ($this->session->userdata('admin_login') == 'no') {
			redirect('admin/login');
		}
		if ($para1 != null) {
			if ($para1 == 'add') {
				$page_data['page_name'] = 'add_dam';
				$page_data['regions'] = json_encode($this->db->get('region')->result_array());
				$page_data['states'] = json_encode($this->db->get('state')->result_array());
				$this->load->view('admin/index', $page_data);
			} else if ($para1 == 'save') {
				$return['status'] = 'false';
				$rules = array(
					array(
						'field' => 'name',
						'label' => 'Name',
						'rules' => 'required'
					), array(
						'field' => 'region',
						'label' => 'Region',
						'rules' => 'required'
					), array(
						'field' => 'state',
						'label' => 'State',
						'rules' => 'required'
					),
					array(
						'field' => 'ft_image',
						'label' => 'Featured Image',
						'rules' => 'required'
					),
					array(
						'field' => 'location',
						'label' => 'Location',
						'rules' => 'required'
					),
					array(
						'field' => 'physio',
						'label' => 'Physiographic data',
						'rules' => 'required'
					),
					array(
						'field' => 'hydrology',
						'label' => 'Hydrology',
						'rules' => 'required'
					),
					array(
						'field' => 'ownership',
						'label' => 'Ownership and Construction details',
						'rules' => 'required'
					)
				);

				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run()) {

					$slug = $this->crud_model->get_slug($this->input->post('name'));
					$this->db->like('slug', $slug);
					$slugs = $this->db->get('dam');
					if ($slugs->num_rows() > 0) {
						$add = $slugs->num_rows();
						$slug = $slug . "-" . $add;
					}
					$data['dam_name'] = $this->input->post('name');
					$data['region_id'] = $this->input->post('region');
					$data['dam_description'] = $this->input->post('description');
					$data['slug'] = $slug;
					$data['state_id'] = $this->input->post('state');
					$data['feature_img'] = $this->input->post('ft_image');
					$data['images'] = $this->input->post('images');
					$data['ownership'] =  $this->input->post('ownership');
					$data['location'] =  $this->input->post('location');
					$data['physio'] =  $this->input->post('physio');
					$data['hydrology'] =  $this->input->post('hydrology');




					$insert = $this->db->insert('dam', $data);
					if ($insert) {
						$data['dam_id'] = $this->db->insert_id();
						$dam = $this->db->get_where('dam', $data)->row();
						$return['status'] = true;
						$return['data'] = $dam;
					} else {
						$return['status'] = false;
						$return['error'] = "<p>data couldn't be saved please try later</p>";
					}
				} else {
					$return['status'] = false;
					$return['error'] = validation_errors();
				}
				echo json_encode($return);
			} else if ($para1 == 'edit') {
				if ($para2 != null) {
					$query = $this->db->get_where('dam', array('dam_id' => $para2));
					if ($query->num_rows() > 0) {
						$dam = $query->row();
						$page_data['states'] = json_encode($this->db->get('state')->result_array());
						$page_data['state'] = json_encode($this->db->get_where('state', array('region_id' => $dam->region_id))->result_array());
						$page_data['dam'] = $dam;
						$page_data['regions'] = json_encode($this->db->get('region')->result_array());
						$page_data['page_name'] = 'edit_dam';
						$this->load->view('admin/index', $page_data);
					}
				}
			} else if ($para1 == 'update') {
				if ($para2 != null) {
					$status = false;
					$error = "";
					$data = "";
					$rules = array(
						array(
							'field' => 'name',
							'label' => 'Name',
							'rules' => 'required'
						), array(
							'field' => 'region',
							'label' => 'Region',
							'rules' => 'required'
						), array(
							'field' => 'state',
							'label' => 'State',
							'rules' => 'required'
						),
						array(
							'field' => 'ft_image',
							'label' => 'Featured Image',
							'rules' => 'required'
						),
						array(
							'field' => 'location',
							'label' => 'Location',
							'rules' => 'required'
						),
						array(
							'field' => 'physio',
							'label' => 'Physiographic data',
							'rules' => 'required'
						),
						array(
							'field' => 'hydrology',
							'label' => 'Hydrology',
							'rules' => 'required'
						),
						array(
							'field' => 'ownership',
							'label' => 'Ownership and Construction details',
							'rules' => 'required'
						)
					);

					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run()) {


						$this->db->where('dam_id', $para2);
						$p_data['dam_name'] = $this->input->post('name');
						$p_data['region_id'] = $this->input->post('region');
						$p_data['dam_description'] = $this->input->post('description');
						$p_data['state_id'] = $this->input->post('state');
						$p_data['feature_img'] = $this->input->post('ft_image');
						$p_data['images'] = $this->input->post('images');
						$p_data['ownership'] =  $this->input->post('ownership');
						$p_data['location'] =  $this->input->post('location');
						$p_data['physio'] =  $this->input->post('physio');
						$p_data['hydrology'] =  $this->input->post('hydrology');

						if ($this->db->update('dam', $p_data)) {
							$status = true;
							$data = " ";
						} else {
							$error = "<p>Cant upload now there is an error</p>";
						}
					} else {
						$error = validation_errors();
					}

					echo json_encode(compact('status', 'error', 'data'));
				}
			} else if ($para1 == 'delete') {
				if ($para2 != null) {
					$status = false;
					$error = "";
					$data = "";
					$this->db->where('state_id', $para2);
					if ($this->db->delete('state')) {
						$status = true;
						$data = $this->db->get('region')->result_array();
					} else {
						$error = "sorry region could not be deleted try again later";
					}
					echo json_encode(compact('status', 'error', 'data'));
				}
			}
		} else {
			$this->db->select('dam_id,dam_name, dam.update_at,dam.created_at,dam.feature_img,region.region_name,state.state_name');
			$this->db->from('dam');
			$this->db->join('region', 'region.region_id = dam.region_id', 'left');
			$this->db->join('state', 'state.state_id = dam.state_id', 'left');


			$state = $this->db->get()->result_array();
			$config['attributes'] = array('ng-click' => 'setPage(this.innerHTML)');
			// die(var_dump(count($regions)));
			$config['total_rows'] = count($state);
			$config['per_page'] = 5;
			$this->pagination->initialize($config);
			$page_data['dams'] = json_encode($state);
			$page_data['pagination'] = $this->pagination->create_links();
			$page_data['page_name'] = 'dam';
			$page_data['total_rows'] = $config['total_rows'];
			$this->load->view('admin/index', $page_data);
		}
	}

	function media($para1 = null)
	{
		if ($this->session->userdata('admin_login') == 'no') {
			redirect('admin/login');
		}
		if ($para1 != null) {

			if ($para1 == 'upload') {
				$feedback = '';
				$data = array();
				$count = count($_FILES['files']['tmp_name']);


				for ($i = 0; $i < $count; $i++) {
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$ext = pathinfo($_FILES['file']['name'])['extension'];
					$config['upload_path']          = 'uploads/files/';
					$config['allowed_types']        = "*";
					$config['mod_mime_fix']            = true;
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('file')) {
						$feedback .= $this->upload->display_errors();
					} else {
						$file = $this->upload->data('file_name');
						$path = $config['upload_path'] . $file;
						$feedback .=  "<p> $file uploaded</p>";
						$media_name = $file;
						$media_type = $this->media_model->get_type($ext);
						$url = base_url() . $path;
						$this->db->insert('media', compact('media_name', 'media_type', 'url'));
						$this->db->where('media_id', $this->db->insert_id());
						array_push($data, $this->db->get('media')->row());
					}
				}
				echo json_encode(compact('feedback', 'data'));
			} else if ($para1 == 'upload_image') {

				$feedback = '';
				$data = array();
				$config['upload_path']          = 'uploads/files/';
				$config['allowed_types']        = "*";
				$config['mod_mime_fix']            = true;
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('upload')) {
					$feedback .= $this->upload->display_errors();
				} else {
					$file = $this->upload->data('file_name');
					$ext = pathinfo($file)['extension'];
					$path = $config['upload_path'] . $file;
					$feedback .=  "<p> $file uploaded</p>";
					$media_name = $file;
					$media_type = $this->media_model->get_type($ext);
					$url = base_url() . $path;
					$this->db->insert('media', compact('media_name', 'media_type', 'url'));
					$this->db->where('media_id', $this->db->insert_id());
					$return = array(
						'fileName' => $file,
						'uploaded' => 1,
						'url' => $url
					);
					echo json_encode($return);
				}
			} elseif ($para1 == 'add') {
				$page_data['page_name'] = "add_media";
				$this->load->view('admin/index', $page_data);
			}
		} else {
			$page_data['page_name'] = "media";
			$page_data['media'] = $this->db->get('media');
			$this->load->view('admin/index', $page_data);
		}
	}

	function slider($para1 = null, $para2 = null)
	{
		if ($this->session->userdata('admin_login') == 'no') {
			redirect('admin/login');
		}
		if ($para1 != null) {
			if ($para1 == 'add') {

				$page_data['page_name'] = 'add_slider';
				$this->load->view('admin/index', $page_data);
			} else if ($para1 == 'save') {
				$return['status'] = 'false';
				$rules = array(
					array(
						'field' => 'slider',
						'label' => 'Slider',
						'rules' => 'required'
					)
				);

				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run()) {
					$data['slider_url'] = $this->input->post('slider');
					$data['slider_text'] = $this->input->post('text');
					$insert = $this->db->insert('slider', $data);
					if ($insert) {
						$data['slider_id'] = $this->db->insert_id();
						$slider = $this->db->get_where('slider', $data)->row();
						$return['status'] = true;
						$return['data'] = $slider;
					} else {
						$return['status'] = false;
						$return['error'] = "<p>data couldn't be saved please try later</p>";
					}
				} else {
					$return['status'] = false;
					$return['error'] = validation_errors();
				}
				echo json_encode($return);
			} else if ($para1 == 'edit') {
				if ($para2 != null) {
					$query = $this->db->get_where('slider', array('slider_id' => $para2));
					if ($query->num_rows() > 0) {
						$region = $query->row();
						$page_data['slider'] = $region;
						$page_data['page_name'] = 'edit_slider';
						$this->load->view('admin/index', $page_data);
					}
				}
			} else if ($para1 == 'update') {
				if ($para2 != null) {
					$status = false;
					$error = "";
					$data = "";
					$rules = array(
						array(
							'field' => 'slider',
							'label' => 'Slider',
							'rules' => 'required'
						)
					);

					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run()) {

						$this->db->where('slider_id', $para2);
						$p_data['slider_url'] = $this->input->post('slider');
						$p_data['slider_text'] = $this->input->post('text');



						if ($this->db->update('slider', $p_data)) {
							$status = true;
							$data = " ";
						} else {
							$error = "<p>Cant upload now there is an error</p>";
						}
					} else {
						$error = validation_errors();
					}

					echo json_encode(compact('status', 'error', 'data'));
				}
			} else if ($para1 == 'delete') {
				if ($para2 != null) {
					$status = false;
					$error = "";
					$data = "";
					$this->db->where('slider_id', $para2);
					if ($this->db->delete('slider')) {
						$status = true;
						$data = $this->db->get('slider')->result_array();
					} else {
						$error = "sorry slider could not be deleted try again later";
					}
					echo json_encode(compact('status', 'error', 'data'));
				}
			}
		} else {
			$sliders = $this->db->get('slider')->result_array();
			$page_data['page_name'] = "slider";
			$page_data['sliders'] = json_encode($sliders);
			$page_data['total_rows'] = count($sliders);
			$this->load->view('admin/index', $page_data);
		}
	}
}
