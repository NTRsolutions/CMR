<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coursesubmit extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("coursesubmit_m");
		$this->load->model("faculty_m");
		$this->load->model("course_m");
		$this->load->model("acayear_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('coursesubmit', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Cleader") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['set'] = $id;
				$this->data['faculty'] = $this->coursesubmit_m->get_faculty();
				$this->data['coursesubmits'] = $this->coursesubmit_m->get_join_all($id);

				if($this->data['coursesubmits']) {
					$sections = $this->section_m->get_order_by_section(array("facultyID" => $id));
					$this->data['sections'] = $sections;
					foreach ($sections as $key => $section) {
						$this->data['allsection'][$section->section] = $this->coursesubmit_m->get_join_all_wsection($id, $section->sectionID);
					}
				} else {
					$this->data['coursesubmits'] = NULL;
				}

				$this->data["subview"] = "coursesubmit/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['faculty'] = $this->coursesubmit_m->get_faculty();
				$this->data["subview"] = "coursesubmit/search";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Student") {
			$student = $this->student_info_m->get_student_info();
			$this->data['coursesubmits'] = $this->student_info_m->get_join_all_coursesubmit_wsection($student->facultyID, $student->sectionID);
			$this->data["subview"] = "coursesubmit/index";
			$this->load->view('_layout_main', $this->data);
		} elseif($usertype == "Parent") {
			$username = $this->session->userdata("username");
			$parent = $this->parentes_m->get_single_parentes(array('username' => $username));
			$this->data['students'] = $this->student_m->get_order_by_student(array('parentID' => $parent->parentID));
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$checkstudent = $this->student_m->get_single_student(array('studentID' => $id));
				if(count($checkstudent)) {
					$facultyID = $checkstudent->facultyID;
					$this->data['set'] = $id;
					$this->data['coursesubmits'] = $this->student_info_m->get_join_all_coursesubmit_wsection($checkstudent->facultyID, $checkstudent->sectionID);
					$this->data["subview"] = "coursesubmit/index_parent";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "coursesubmit/search_parent";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
	
	protected function rules() {
		$rules = array(
				array(
					'field' => 'courseID', 
					'label' => $this->lang->line("coursesubmit_name"), 
					'rules' => 'trim|required|numeric|xss_clean|max_length[11]|callback_allcourse'
				),
				array(
					'field' => 'facultyID', 
					'label' => $this->lang->line("coursesubmit_faculty"), 
					'rules' => 'trim|required|numeric|xss_clean|max_length[11]|callback_allfaculty'
				),
				array(
					'field' => 'sectionID', 
					'label' => $this->lang->line("coursesubmit_section"), 
					'rules' => 'trim|required|numeric|xss_clean|max_length[11]|callback_allsection'
				),
				array(
					'field' => 'subjectID', 
					'label' => $this->lang->line("coursesubmit_subject"), 
					'rules' => 'trim|required|numeric|xss_clean|max_length[11]|callback_allsubject'
				),
				array(
					'field' => 'date',
					'label' => $this->lang->line("coursesubmit_date"), 
					'rules' => 'trim|required|xss_clean|max_length[10]|callback_date_valid|callback_pastdate_check'
				),
				array(
					'field' => 'coursefrom', 
					'label' => $this->lang->line("coursesubmit_coursefrom"), 
					'rules' => 'trim|required|xss_clean|max_length[10]'
				),
				array(
					'field' => 'courseto', 
					'label' => $this->lang->line("coursesubmit_courseto"), 
					'rules' => 'trim|required|xss_clean|max_length[10]'
				),
				array(
					'field' => 'room', 
					'label' => $this->lang->line("coursesubmit_room"), 
					'rules' => 'trim|xss_clean|max_length[10]'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {

			$this->data['faculty'] = $this->coursesubmit_m->get_faculty();
			$this->data['course'] = $this->coursesubmit_m->get_course();
			$facultyID = $this->input->post("facultyID");
			
			if($facultyID != 0) {
				$this->data['subjects'] = $this->coursesubmit_m->get_subject($facultyID);
				$this->data['sections'] = $this->section_m->get_order_by_section(array("facultyID" => $facultyID));
			} else {
				$this->data['subjects'] = "empty";
				$this->data['sections'] = "empty";
			}
			$this->data['subjectID'] = 0;
			$this->data['sectionID'] = 0;

			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "coursesubmit/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"ID" => $this->input->post("courseID"),
						"facultyID" => $this->input->post("facultyID"),
						"sectionID" => $this->input->post("sectionID"),
						"subjectID" => $this->input->post("subjectID"),
						"edate" => date("Y-m-d", strtotime($this->input->post("date"))),
						"coursefrom" => $this->input->post("coursefrom"),
						"courseto" => $this->input->post("courseto"),
						"room" => $this->input->post("room"),
						"year" => date("Y")
					);

					$this->coursesubmit_m->insert_coursesubmit($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("coursesubmit/index"));
				}
			} else {
				$this->data["subview"] = "coursesubmit/add";
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
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->data['coursesubmit'] = $this->coursesubmit_m->get_coursesubmit($id);
				if($this->data['coursesubmit']) {
					$classID = $this->data['coursesubmit']->facultyID;
					$this->data['subjects'] = $this->coursesubmit_m->get_subject($classID);
					$this->data['faculty'] = $this->coursesubmit_m->get_faculty();
					$this->data['courses'] = $this->coursesubmit_m->get_course();
					$this->data['sections'] = $this->section_m->get_order_by_section(array("facultyID" => $classID));
					$this->data['set'] = $url;
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "coursesubmit/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"courseID" => $this->input->post("courseID"),
								"facultyID" => $this->input->post("facultyID"),
								"sectionID" => $this->input->post("sectionID"),
								"subjectID" => $this->input->post("subjectID"),
								"edate" => date("Y-m-d", strtotime($this->input->post("date"))),
								"coursefrom" => $this->input->post("coursefrom"),
								"courseto" => $this->input->post("courseto"),
								"room" => $this->input->post("room")
							);

							$this->coursesubmit_m->update_coursesubmit($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("coursesubmit/index/$url"));
						}
					} else {
						$this->data["subview"] = "coursesubmit/edit";
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
			$faculty = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$faculty) {
				$this->coursesubmit_m->delete_coursesubmit($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("coursesubmit/index/$faculty"));
			} else {
				redirect(base_url("coursesubmit/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function coursesubmit_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("coursesubmit/index/$classID");
			echo $string;
		} else {
			redirect(base_url("coursesubmit/index"));
		}
	}

	public function student_list() {
		$studentID = $this->input->post('id');
		if((int)$studentID) {
			$string = base_url("coursesubmit/index/$studentID");
			echo $string;
		} else {
			redirect(base_url("coursesubmit/index"));
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

	function allsubject() {
		if($this->input->post('subjectID') == 0) {
			$this->form_validation->set_message("allsubject", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function subjectcall() {
		$classID = $this->input->post('id');

		if((int)$classID) {
			$allfaculty = $this->coursesubmit_m->get_subject($classID);
			echo "<option value='0'>", $this->lang->line("coursesubmit_select_subject"),"</option>";
			foreach ($allfaculty as $value) {
				echo "<option value=\"$value->subjectID\">",$value->subject,"</option>";
			}
		} 
	}

	function sectioncall() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$allsection = $this->section_m->get_order_by_section(array("facultyID" => $classID));
			echo "<option value='0'>", $this->lang->line("coursesubmit_select_section"),"</option>";
			foreach ($allsection as $value) {
				echo "<option value=\"$value->sectionID\">",$value->section,"</option>";
			}
		} 
	}

	function allcourse() {
		$courseID = $this->input->post('courseID');
		if($courseID === '0') {
			$this->form_validation->set_message("allcourse", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function allfaculty() {
		$courseID = $this->input->post('facultyID');
		if($courseID === '0') {
			$this->form_validation->set_message("allfaculty", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function allsection() {
		$sectionID = $this->input->post('sectionID');
		if($sectionID === '0') {
			$this->form_validation->set_message("allsection", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function pastdate_check() {
		$date = strtotime($this->input->post("date"));
		$now_date = strtotime(date("Y-m-d"));
		if($date < $now_date) {
			$this->form_validation->set_message("pastdate_check", "The %s field is past");
	     	return FALSE;
		}
		return TRUE;
	}
}

