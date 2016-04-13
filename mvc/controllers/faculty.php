<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class faculty extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("faculty_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('faculty', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Cleader" || $usertype == "Cmoderator" || $usertype == "Pvc" || $usertype == "Dlt") {
			$this->data['faculty'] = $this->faculty_m->get_order_by_faculty();
			$this->data["subview"] = "faculty/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'faculty', 
				'label' => $this->lang->line("faculty_name"), 
				'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_faculty'
			), 
			array(
				'field' => 'code', 
				'label' => $this->lang->line("faculty_code"), 
				'rules' => 'trim|required|xss_clean|max_length[60]'
			), 
			array(
				'field' => 'note', 
				'label' => $this->lang->line("faculty_note"), 
				'rules' => 'trim|max_length[200]|xss_clean'
			)
		);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data['form_validation'] = validation_errors(); 
					$this->data["subview"] = "faculty/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"faculty" => $this->input->post("faculty"),
						"code" => $this->input->post("code"),
						"note" => $this->input->post("note")
					);

					$this->faculty_m->insert_faculty($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("faculty/index"));
				}
			} else {
				$this->data["subview"] = "faculty/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['faculty'] = $this->faculty_m->get_faculty($id);
				if($this->data['faculty']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "faculty/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"faculty" => $this->input->post("faculty"),
								"code" => $this->input->post("code"),
								"note" => $this->input->post("note")
							);

							$this->faculty_m->update_faculty($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("faculty/index"));
						}
					} else {
						$this->data["subview"] = "faculty/edit";
						$this->load->view('_layout_main', $this->data);
					}
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);	
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {

			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->faculty_m->delete_faculty($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("faculty/index"));
			} else {
				redirect(base_url("faculty/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	public function unique_faculty() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$faculty = $this->faculty_m->get_order_by_faculty(array("faculty" => $this->input->post("faculty"), "facultyID !=" => $id));
			if(count($faculty)) {
				$this->form_validation->set_message("unique_faculty", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$faculty = $this->faculty_m->get_order_by_faculty(array("faculty" => $this->input->post("faculty")));

			if(count($faculty)) {
				$this->form_validation->set_message("unique_faculty", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}

}
