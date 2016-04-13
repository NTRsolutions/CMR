<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_m extends MY_Model {

	protected $_table_name = 'course';
	protected $_primary_key = 'courseID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "course asc";

	function __construct() {
		parent::__construct();
	}

	function get_course($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_course($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_course($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_course($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_course($id){
		parent::delete($id);
	}
}

/* End of file course_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/course_m.php */