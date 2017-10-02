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
	public function get_cokpi_by_cri_id($id=0) {
		
		// please count sub-cokpi for customize delete button
		$this->db->select('*');
		$this->db->from('kpi_criterion');
		$this->db->join('kpi_cokpi_crit', 'kpi_cokpi_crit.cri_id = kpi_criterion.cri_id');
		$this->db->join('kpi_cokpi', 'kpi_cokpi_crit.cokpi_id = kpi_cokpi.cokpi_id');
		if($id != 0) $this->db->where('kpi_criterion.cri_id', $id);
		$this->db->order_by("kpi_criterion.cri_id","asc");
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
		$this->db->join('kpi_cokpi_crit', 'kpi_cokpi_crit.cokpi_id = kpi_cokpi.cokpi_id AND kpi_cokpi.cokpi_id = '.$key);
		$this->db->order_by("kpi_cokpi.cokpi_id","asc");
		return $this->db->get()->result();
	}


	function get_cokpi_pg($limit, $offset, $key='') {
		
    	if ($offset > 0) {
        	$offset = ($offset - 1) * $limit;
    	}

		$this->db->from('kpi_cokpi');
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

	/**
	 * get_subkpi_by_cokpi_id function
	 */
	public function get_subkpi_by_cokpi_id($id=0) {
		$this->db->from('kpi_sub_cokpi');
		$this->db->join('kpi_cokpi_subcokpi', 'kpi_cokpi_subcokpi.subcokpi_id = kpi_sub_cokpi.subcokpi_id AND kpi_cokpi_subcokpi.cokpi_id = '.$id);
		$this->db->order_by("kpi_sub_cokpi.subcokpi_id","asc");

		return $this->db->get()->result();
	}

	/**
	 * get_subkpi_by_id function.
	 */
	public function get_subkpi_by_id($id) {
		$this->db->from('kpi_sub_cokpi');
		$this->db->where('subcokpi_id', $id);
		return $this->db->get()->row();
	}

	/**
	 * create_subkpi function.
	 */
	 public function create_subkpi($cri_id, $cokpi_id, $title, $definition="", $comment="") {
		$data = array(
			'subcokpi_title'   => $title,
			'subcokpi_def'   => $definition,
			'subcokpi_comment'   => $comment
		);
		
		if($this->db->insert('kpi_sub_cokpi', $data)){
			
			$subcokpi_id = $this->db->insert_id();

			$data_opt = array(
				'cokpi_id' => $cokpi_id,
				'subcokpi_id' => $subcokpi_id
			);

			return $this->db->insert('kpi_cokpi_subcokpi', $data_opt);
		}else{
			return false;
		}		
	} //end create_subkpi function.

	/**
	 * update_subkpi function
	 */
	public function update_subkpi($cri_id, $id, $title, $definition="", $comment="") {
		$data = array(
			'subcokpi_title'   => $title,
			'subcokpi_def'   => $definition,
			'subcokpi_comment'   => $comment
		);
		$this->db->where('subcokpi_id', $id);

		return $this->db->update('kpi_sub_cokpi', $data);
	} //end update_subkpi function.

	/**
	 * delete_subkpi function
	 */
	public function delete_subkpi($id, $cokpi_id) {
		$this->db->where('subcokpi_id', $id);
		if($this->db->delete('kpi_sub_cokpi')){
			$this->db->where('cokpi_id', $cokpi_id);
			$this->db->where('subcokpi_id', $id);
			return $this->db->delete('kpi_cokpi_subcokpi');
		}
		return false;
	} //end delete_subkpi function.

	/**
	 * get_subkpi function.
	 */
	public function get_subkpi($key="") {
		$this->db->from('kpi_criterion');
		$this->db->join('kpi_cokpi_crit', 'kpi_cokpi_crit.cri_id = kpi_criterion.cri_id');
		$this->db->join('kpi_cokpi', 'kpi_cokpi_crit.cokpi_id = kpi_cokpi.cokpi_id');
		$this->db->join('kpi_cokpi_subcokpi', 'kpi_cokpi_subcokpi.cokpi_id = kpi_cokpi.cokpi_id');
		$this->db->join('kpi_sub_cokpi', 'kpi_sub_cokpi.subcokpi_id = kpi_cokpi_subcokpi.subcokpi_id');
		if(isset($key)) $this->db->like('kpi_sub_cokpi.subcokpi_title', $key);
		$this->db->order_by("kpi_criterion.cri_id","asc");
		$this->db->order_by("kpi_cokpi.cokpi_id","asc");
		return $this->db->get()->result();
	} //end get_subkpi function.

	/**
	 * get_subissue_by_subcokpi_id function.
	 */
	public function get_subissue_by_subcokpi_id($id=0) {
		$this->db->from('kpi_sub_issuesdetail');
		$this->db->join('kpi_sub_cokpi', 'kpi_sub_issuesdetail.subcokpi_id = kpi_sub_cokpi.subcokpi_id AND kpi_sub_cokpi.subcokpi_id = '.$id);
		$this->db->join('kpi_grade', 'kpi_grade.gra_id = kpi_sub_issuesdetail.gra_id');
		$this->db->order_by("kpi_sub_issuesdetail.issdet_id","asc");

		return $this->db->get()->result();
	} //end get_subissue_by_subcokpi_id function

	/**
	 * create_subissue function.
	 */
	public function create_subissue($cri_id, $cokpi_id, $subkpi_id, $issdet_title, $issdet_wei, $gra_id, $issdet_score="") {
		//$cri_id, $cokpi_id, $subkpi_id, $issdet_title, $issdet_wei, $gra_id, $issdet_score=""
		$data = array(
			'subcokpi_id'   => $subkpi_id,
			'issdet_title'   => $issdet_title,
			'issdet_wei'   => $issdet_wei,
			'gra_id'   => $gra_id
		);

		return $this->db->insert('kpi_sub_issuesdetail', $data);
	} //end create_subissue function.

	/**
	 * delete_subissue function
	 */
	public function delete_subissue($id, $subkpi_id) {
		$this->db->where('issdet_id', $id);
		$this->db->where('subcokpi_id', $subkpi_id);
		return $this->db->delete('kpi_sub_issuesdetail');
	} //end delete_subissue function.


}