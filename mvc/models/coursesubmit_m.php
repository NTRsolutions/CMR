<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coursesubmit_m extends MY_Model {

	protected $_table_name = 'coursesubmit';
	protected $_primary_key = 'coursesubmitID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "facultyID asc";

	function __construct() {
		parent::__construct();
	}

	function get_faculty() {
		$this->db->select('*')->from('faculty')->order_by('code asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_course() {
		$this->db->select('*')->from('course')->order_by('course asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_subject($id) {
		$query = $this->db->get_where('subject', array('facultyID' => $id));
		return $query->result();
	}

	function get_join_all($id) {
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('coursesubmit');
		$this->db->where(array('coursesubmit.facultyID' => $id, 'coursesubmit.edate >=' => $date));
		$this->db->join('course', 'course.courseID = coursesubmit.courseID', 'LEFT');
		$this->db->join('faculty', 'faculty.facultyID = coursesubmit.facultyID', 'LEFT');
		$this->db->join('acayear', 'acayear.acayearID = coursesubmit.acayearID', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	function get_join_all_wsection($id, $sectionID) {
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('coursesubmit');
		$this->db->where(array('coursesubmit.facultyID' => $id, 'coursesubmit.sectionID' => $sectionID, 'coursesubmit.edate >=' => $date));
		$this->db->join('course', 'course.courseID = coursesubmit.courseID', 'LEFT');
		$this->db->join('faculty', 'faculty.facultyID = coursesubmit.facultyID', 'LEFT');
		$this->db->join('section', 'section.sectionID = coursesubmit.sectionID', 'LEFT');
		$this->db->join('subject', 'subject.subjectID = coursesubmit.subjectID', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	function get_coursesubmit($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_coursesubmit($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_coursesubmit($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_coursesubmit($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_coursesubmit($id){
		parent::delete($id);
	}	

}

/* End of file coursesubmit_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/coursesubmit_m.php */