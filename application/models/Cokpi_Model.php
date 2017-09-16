<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Cokpi_Model class.
 * 
 * @extends CI_Model
 */
class Cokpi_Model extends CI_Model {
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
	 * create_cokpi function.
	 * 
	 * @access public
	 * @param mixed $cri_id
	 * @param mixed $title
	 * @param mixed $weight
	 * @param mixed $approach
	 * @param mixed $unit
	 * @param mixed $comment
	 * @return bool true on success, false on failure
	 */
	public function create_cokpi($cri_id, $title, $weight, $approach="", $unit, $comment="") {
		
		$data = array(
			'cokpi_title'   => $title,
			'cokpi_wei'   => $weight,
			'cokpi_app'   => $approach,
			'cokpi_unit'   => $unit,
			'cokpi_comment'   => $comment
		);
		
		if($this->db->insert('kpi_cokpi', $data)){
			
			$cokpi_id = $this->db->insert_id();

			$data_opt = array(
				'cri_id' => $cri_id,
				'cokpi_id' => $cokpi_id
			);

			return $this->db->insert('kpi_cokpi_crit', $data_opt);
		}else{
			return false;
		}
		
	}
	
	/**
	 * get_cokpi_by_id function.
	 * 
	 * @access public
	 * @param mixed $id
	 * @return object the co-kpi object
	 */
	public function get_cokpi_by_id($id) {
		
		$this->db->from('kpi_cokpi');
		$this->db->where('kpi_cokpi.cokpi_id', $id);
		return $this->db->get()->row();
		
	}
	
	/**
	 * get_cokpi_by_cri_id function.
	 * 
	 * @access public
	 * @param mixed $id
	 * @return object the co-kpi object
	 */
	public function get_cokpi_by_cri_id($id) {
		
		// please count sub-cokpi for customize delete button
		$this->db->select('*');
		$this->db->from('kpi_criterion');
		$this->db->join('kpi_cokpi_crit', 'kpi_cokpi_crit.cri_id = kpi_criterion.cri_id');
		$this->db->join('kpi_cokpi', 'kpi_cokpi_crit.cokpi_id = kpi_cokpi.cokpi_id');
		//$this->db->select('count(kpi_cokpi_subcokpi.subcokpi_id) as num_subcokpi');
		//$this->db->join('kpi_cokpi_subcokpi', 'kpi_cokpi_crit.cokpi_id = kpi_cokpi.cokpi_id');
		$this->db->where('kpi_criterion.cri_id', $id);
/*
		$this->db->query('SELECT a.*,b.*,c.* FROM kpi_criterion as a 
			JOIN kpi_cokpi_crit as b ON a.cri_id = b.cri_id 
			JOIN kpi_cokpi as c ON b.cokpi_id = c.cokpi_id 
			WHERE a.cri_id = '.$id);
*/
		return $this->db->get()->result();
		
	}
	
	/**
	 * get_cokpi function.
	 * 
	 * @access public
	 * @param mixed $key
	 * @return object the co-kpi object
	 */
	public function get_cokpi($key=0) {

		$this->db->from('kpi_cokpi');
		//$this->db->where('kpi_criterion.cri_title LIKE "%'.$key.'%" OR kpi_criterion.cri_kpi_app LIKE "%'.$key.'%"');
		$this->db->join('kpi_cokpi_crit', 'kpi_cokpi_crit.cokpi_id = kpi_cokpi.cokpi_id AND kpi_cokpi.cokpi_id = '.$key);
		$this->db->order_by("kpi_cokpi.cokpi_id","asc");

		return $this->db->get()->result();

	}


	function get_cokpi_pg($limit, $offset, $key='') {
		
    	if ($offset > 0) {
        	$offset = ($offset - 1) * $limit;
    	}

		$this->db->from('kpi_cokpi');
		//$this->db->where('kpi_criterion.cri_title LIKE "%'.$key.'%" OR kpi_criterion.cri_kpi_app LIKE "%'.$key.'%"');
		$this->db->where('kpi_cokpi_crit', 'kpi_cokpi.cokpi_id = '.$key);
		$this->db->order_by("kpi_criterion.cri_id","asc");

		$result['num_rows'] = $this->db->count_all_results();

		$this->db->limit($limit, $offset);

    	return $result;

	}

	/**
	 * delete_cokpi function
	 */
	public function delete_cokpi($id, $cri_id) {
		
		$this->db->where('cokpi_id', $id);

		if($this->db->delete('kpi_cokpi')){

			$this->db->where('cokpi_id', $id);
			$this->db->where('cri_id', $cri_id);

			return $this->db->delete('kpi_cokpi_crit');

		}else return false;

	}

	/**
	 * update_cokpi function
	 */
	public function update_cokpi($id, $title, $weight, $unit, $approach="", $comment="") {
		
		$data = array(
			'cokpi_title'   => $title,
			'cokpi_wei'   => $weight,
			'cokpi_app'   => $approach,
			'cokpi_unit'   => $unit,
			'cokpi_comment'   => $comment
		);
		$this->db->where('cokpi_id', $id);

		return $this->db->update('kpi_cokpi', $data);

	}
	
}