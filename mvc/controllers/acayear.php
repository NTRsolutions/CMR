<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acayear extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("acayear_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('acayear', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Cleader" || $usertype == "Cmoderator" || $usertype == "pvc" || $usertype == "dlt") {
			$this->data['acayears'] = $this->acayear_m->get_order_by_acayear();
			$this->data["subview"] = "acayear/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				array(
					'field' => 'acayear', 
					'label' => $this->lang->line("acayear_name"), 
					'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_acayear'
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
					$this->data["subview"] = "acayear/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"acayear" => $this->input->post("acayear"),

					);

					$this->acayear_m->insert_acayear($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("acayear/index"));
				}
			} else {
				$this->data["subview"] = "acayear/add";
				$this->load->view('_layout_main', $this->data);
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
				$this->data['acayear'] = $this->acayear_m->get_acayear($id);
				if($this->data['acayear']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "acayear/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"acayear" => $this->input->post("acayear"),

							);

							$this->acayear_m->update_acayear($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("acayear/index"));
						}
					} else {
						$this->data["subview"] = "acayear/edit";
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
				$this->acayear_m->delete_acayear($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("acayear/index"));
			} else {
				redirect(base_url("acayear/index"));
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function unique_acayear() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$acayear = $this->acayear_m->get_order_by_acayear(array("acayear" => $this->input->post("acayear"), "acayearID !=" => $id));
			if(count($acayear)) {
				$this->form_validation->set_message("unique_acayear", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$acayear = $this->acayear_m->get_order_by_acayear(array("acayear" => $this->input->post("acayear")));

			if(count($acayear)) {
				$this->form_validation->set_message("unique_acayear", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}


}

