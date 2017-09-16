<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CapitalType_model class.
 * 
 * @extends CI_Model
 */
class CapitalType_Model extends CI_Model {
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	/**
	 * create_capital_type function.
	 * 
	 * @access public
	 * @param mixed $name
	 * @return bool true on success, false on failure
	 */
	public function create_capital_type($name) {
		
		$data = array(
			'capt_name'   => $name
		);
		
		return $this->db->insert('kpi_capital_type', $data);
		
	}
	
	/**
	 * get_capital_type function.
	 * 
	 * @access public
	 * @param mixed $id
	 * @return object the capital type object
	 */
	public function get_capital_type($id) {
		
		$this->db->from('kpi_capital_type');
		$this->db->where('capt_id', $id);
		return $this->db->get()->row();
		
	}

	/**
	 * get_capitals_type function.
	 * 
	 * @access public
	 * @param mixed $key
	 * @return object the capital type object
	 */
	public function get_capitals_type($key="") {

		$this->db->from('kpi_capital_type');
		$this->db->like('capt_name', $key);
		$this->db->order_by("capt_id","asc");

		return $this->db->get()->result();

	}

	function get_capitals_type_pg($limit, $offset, $key='') {
		
    	if ($offset > 0) {
        	$offset = ($offset - 1) * $limit;
    	}

		$this->db->from('kpi_capital_type');
		$this->db->like('capt_name', $key);
		$this->db->order_by("capt_id","asc");

		$result['num_rows'] = $this->db->count_all_results();

		$this->db->limit($limit, $offset);

    	return $result;

	}
	
	/**
	 * delete_capital_type function
	 */
	public function delete_capital_type($id) {
		
		$this->db->where('capt_id', $id);

		return $this->db->delete('kpi_capital_type');

	}

	/**
	 * update_capital_type function
	 */
	public function update_capital_type($id, $name) {
		
		$data = array(
			'capt_name'   => $name
		);
		$this->db->where('capt_id', $id);

		return $this->db->update('kpi_capital_type', $data);

	}
	
}