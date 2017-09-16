<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Grade_model class.
 * 
 * @extends CI_Model
 */
class Grade_Model extends CI_Model {
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
	 * create_grade function.
	 * 
	 * @access public
	 * @param mixed $name1 to $name5
	 * @return bool true on success, false on failure
	 */
	public function create_grade($name1, $name2, $name3, $name4, $name5) {
		
		$data = array(
			'gra_title1'   => $name1,
			'gra_score1'   => 1,
			'gra_title2'   => $name2,
			'gra_score2'   => 2,
			'gra_title3'   => $name3,
			'gra_score3'   => 3,
			'gra_title4'   => $name4,
			'gra_score4'   => 4,
			'gra_title5'   => $name5,
			'gra_score5'   => 5
		);
		
		return $this->db->insert('kpi_grade', $data);
		
	}
	
	/**
	 * get_grade function.
	 * 
	 * @access public
	 * @param mixed $id
	 * @return object the grade object
	 */
	public function get_grade($id) {
		
		$this->db->from('kpi_grade');
		$this->db->where('gra_id', $id);
		return $this->db->get()->row();
		
	}

	/**
	 * get_grades function.
	 * 
	 * @access public
	 * @param mixed $key
	 * @return object the grade object
	 */
	public function get_grades($key="") {

		$this->db->from('kpi_grade');
		$this->db->like('gra_title1', $key);
		$this->db->or_like('gra_title2', $key);
		$this->db->or_like('gra_title3', $key);
		$this->db->or_like('gra_title4', $key);
		$this->db->or_like('gra_title5', $key);
		$this->db->order_by("gra_id","asc");

		return $this->db->get()->result();

	}

	function get_grades_pg($limit, $offset, $key='') {
		
    	if ($offset > 0) {
        	$offset = ($offset - 1) * $limit;
    	}

		$this->db->from('kpi_grade');
		$this->db->or_like('gra_title1', $key);
		$this->db->or_like('gra_title2', $key);
		$this->db->or_like('gra_title3', $key);
		$this->db->or_like('gra_title4', $key);
		$this->db->or_like('gra_title5', $key);
		$this->db->order_by("gra_id","asc");

		$result['num_rows'] = $this->db->count_all_results();

		$this->db->limit($limit, $offset);

    	return $result;

	}
	
	/**
	 * delete_grade function
	 */
	public function delete_grade($id) {
		
		$this->db->where('gra_id', $id);

		return $this->db->delete('kpi_grade');

	}

	/**
	 * update_grade function
	 */
	public function update_grade($id, $name1, $name2, $name3, $name4, $name5) {
		
		$data = array(
			'gra_title1'   => $name1,
			'gra_score1'   => 1,
			'gra_title2'   => $name2,
			'gra_score2'   => 2,
			'gra_title3'   => $name3,
			'gra_score3'   => 3,
			'gra_title4'   => $name4,
			'gra_score4'   => 4,
			'gra_title5'   => $name5,
			'gra_score5'   => 5
		);
		$this->db->where('gra_id', $id);

		return $this->db->update('kpi_grade', $data);

	}
	
}