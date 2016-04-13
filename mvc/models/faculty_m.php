<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class faculty_m extends MY_Model {

	protected $_table_name = 'faculty';
	protected $_primary_key = 'facultyID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "faculty asc";

	function __construct() {
		parent::__construct();
	}

	function get_faculty($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_faculty($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_faculty($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_faculty($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_faculty($id){
		parent::delete($id);
	}
}

/* End of file faculty_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/faculty_m.php */