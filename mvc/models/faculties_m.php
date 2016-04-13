<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faculties_m extends MY_Model {

	protected $_table_name = 'faculties';
	protected $_primary_key = 'facultiesID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "faculties_numeric asc";

	function __construct() {
		parent::__construct();
	}

	function get_join_faculties() {
		$this->db->select('*');
		$this->db->from('faculties');
		$query = $this->db->get();
		return $query->result();
	}


	function get_faculties($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_faculties($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_faculties($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_faculties($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_faculties($id){
		parent::delete($id);
	}

	function get_order_by_numeric_faculties() {
		$this->db->select('*')->from('faculties')->order_by('faculties_numeric asc');
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file faculties_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/faculties_m.php */