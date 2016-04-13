<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acayear_m extends MY_Model {

	protected $_table_name = 'acayear';
	protected $_primary_key = 'acayearID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "acayear desc";

	function __construct() {
		parent::__construct();
	}

	function get_acayear($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_acayear($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_acayear($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_acayear($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_acayear($id){
		parent::delete($id);
	}
}

/* End of file acayear_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/acayear_m.php */