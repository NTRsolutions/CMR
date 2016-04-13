<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("course_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('course', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Cleader") {
			$this->data['courses'] = $this->course_m->get_order_by_course();
			$this->data["subview"] = "course/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'course', 
				'label' => $this->lang->line("course_name"), 
				'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_course'
			), 
			array(
				'field' => 'code', 
				'label' => $this->lang->line("course_code"), 
				'rules' => 'trim|required|xss_clean|max_length[60]'
			), 
			array(
				'field' => 'date', 
				'label' => $this->lang->line("course_date"),
				'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid'
			), 
			array(
				'field' => 'note', 
				'label' => $this->lang->line("course_note"), 
				'rules' => 'trim|max_length[200]|xss_clean'
			)
		);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Cleader") {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data['form_validation'] = validation_errors(); 
					$this->data["subview"] = "course/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"course" => $this->input->post("course"),
						"code" => $this->input->post("code"),
						"date" => date("Y-m-d", strtotime($this->input->post("date"))),
						"note" => $this->input->post("note")
					);

					$this->course_m->insert_course($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("course/index"));
				}
			} else {
				$this->data["subview"] = "course/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Cleader") {

			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->course_m->delete_course($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("course/index"));
			} else {
				redirect(base_url("course/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	

	public function edit() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Cleader") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['course'] = $this->course_m->get_course($id);
				if($this->data['course']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "course/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"course" => $this->input->post("course"),
								"code" => $this->input->post("code"),
								"date" => date("Y-m-d", strtotime($this->input->post("date"))),
								"note" => $this->input->post("note")
							);

							$this->course_m->update_course($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("course/index"));
						}
					} else {
						$this->data["subview"] = "course/edit";
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

	

	public function unique_course() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$course = $this->course_m->get_order_by_course(array("course" => $this->input->post("course"), "courseID !=" => $id));
			if(count($course)) {
				$this->form_validation->set_message("unique_course", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$course = $this->course_m->get_order_by_course(array("course" => $this->input->post("course")));

			if(count($course)) {
				$this->form_validation->set_message("unique_course", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}

	function date_valid($date) {
	  	if(strlen($date) <10) {
			$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     	return FALSE;
		} else {
	   		$arr = explode("-", $date);   
	        $dd = $arr[0];            
	        $mm = $arr[1];              
	        $yyyy = $arr[2];
	      	if(checkdate($mm, $dd, $yyyy)) {
	      		return TRUE;
	      	} else {
	      		$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     		return FALSE;
	      	}
	    } 

	} 
}

