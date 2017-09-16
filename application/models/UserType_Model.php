<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * UserType_Model class.
 * 
 * @extends CI_Model
 */
class UserType_Model extends CI_Model {
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
	 * create_user_type function.
	 * 
	 * @access public
	 * @param mixed $t_name
	 * @return bool true on success, false on failure
	 */
	public function create_user_type($t_name) {
		
		$data = array(
			'type_name'   => $t_name,
		);
		
		return $this->db->insert('kpi_user_type', $data);
		
	}
	
	/**
	 * resolve_user_type function.
	 * 
	 * @access public
	 * @param mixed $t_name
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_type($t_name) {
		
		$this->db->select('*');
		$this->db->from('kpi_user_type');
		$this->db->where('type_name', $t_name);
		$n_rows = $this->db->get()->num_rows();
		
		if($n_rows == 0) return true;
		return false;
		
	}
	
	/**
	 * get_user_type_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $t_name
	 * @return int the type id
	 */
	public function get_user_type_id_from_username($t_name) {
		
		$this->db->select('type_id');
		$this->db->from('kpi_user_type');
		$this->db->where('type_name', $t_name);
		return $this->db->get()->row('type_id');
		
	}

	/**
	 * get_user_type function.
	 **/
	public function get_user_type() {

		$this->db->select('*');
		$this->db->from('kpi_user_type');
		$this->db->order_by("type_name","asc");

		return $this->db->get()->result();
		
	}

	/**
	 * edit_user_type function.
	 **/
	public function edit_user_type($t_id, $t_name) {

		$data = array(
		    'type_name' => $t_name
		);

		$this->db->where('type_id', $t_id);
		$this->db->update('kpi_user_type', $data);

		return $this->db->get()->row();
		
	}

	/**
	 * delete_user_type function.
	 **/
	public function delete_user_type($t_id) {
		$this->db->where('type_id', $t_id);
		$this->db->delete('kpi_user_type');

		return true;
	}

}