<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Criterion_Model class.
 * 
 * @extends CI_Model
 */
class Criterion_Model extends CI_Model {
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
	 * create_criterion function.
	 * 
	 * @access public
	 * @param mixed $title
	 * @param mixed $type
	 * @param mixed $weight_min
	 * @param mixed $weight_max
	 * @param mixed $approach
	 * @param mixed $approach_ex
	 * @return bool true on success, false on failure
	 */
	public function create_criterion($title, $type=0, $weight_min, $weight_max, $approach="", $approach_ex="") {
		
		$data = array(
			'capt_id'   => $type,
			'cri_title'   => $title,
			'cri_wei_min'   => $weight_min,
			'cri_wei_max'   => $weight_max,
			'cri_kpi_app'   => $approach,
			'cri_kpi_appexa'   => $approach_ex
		);
		
		return $this->db->insert('kpi_criterion', $data);
		
	}
	
	
	/**
	 * get_criterion function.
	 * 
	 * @access public
	 * @param mixed $cri_id
	 * @return object the criterion object
	 */
	public function get_criterion($id) {
		
		$this->db->from('kpi_criterion');
		$this->db->where('cri_id', $id);
		return $this->db->get()->row();
		
	}
	
	/**
	 * get_criterions function.
	 * 
	 * @access public
	 * @param mixed $key
	 * @return object the criterion object
	 */
	public function get_criterions($key) {

		$this->db->from('kpi_criterion');
		//$this->db->join('kpi_capital_type', 'kpi_criterion.capt_id = kpi_capital_type.capt_id');
		$this->db->where('kpi_criterion.cri_title LIKE "%'.$key.'%" OR kpi_criterion.cri_kpi_app LIKE "%'.$key.'%"');
		$this->db->order_by("kpi_criterion.cri_id","asc");

		return $this->db->get()->result();

	}

	/** start here **/

	function get_criterions_pg($limit, $offset, $key='') {
    	if ($offset > 0) {
        	$offset = ($offset - 1) * $limit;
    	}

		$this->db->from('kpi_criterion');
		//$this->db->join('kpi_capital_type', 'kpi_criterion.capt_id = kpi_capital_type.capt_id');
		$this->db->where('kpi_criterion.cri_title LIKE "%'.$key.'%" OR kpi_criterion.cri_kpi_app LIKE "%'.$key.'%"');
		$this->db->order_by("kpi_criterion.cri_id","asc");

		$result['num_rows'] = $this->db->count_all_results();

		$this->db->limit($limit, $offset);

    	return $result;

	}

	/**
	 * delete_criterion function
	 */
	public function delete_criterion($id) {
		
		$this->db->where('cri_id', $id);

		return $this->db->delete('kpi_criterion');

	}

	/**
	 * update_criterion function
	 */
	public function update_criterion($id, $title, $type=0, $weight_min, $weight_max, $approach="", $approach_ex="") {
		
		$data = array(
			'capt_id'   => $type,
			'cri_title'   => $title,
			'cri_wei_min'   => $weight_min,
			'cri_wei_max'   => $weight_max,
			'cri_kpi_app'   => $approach,
			'cri_kpi_appexa'   => $approach_ex
		);
		$this->db->where('cri_id', $id);

		return $this->db->update('kpi_criterion', $data);

	}
	
}