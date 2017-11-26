<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_Model class.
 * 
 * @extends CI_Model
 */
class User_Model extends CI_Model {
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
	 * create_user function.
	 * 
	 * @access public
	 * @param mixed $flname
	 * @param mixed $username
	 * @param mixed $birthday
	 * @param mixed $email
	 * @param mixed $password
	 * @param mixed $address
	 * @param mixed $type
	 * @param mixed $photo
	 * @return bool true on success, false on failure
	 */
	public function create_user($flname="", $username, $birthday="", $email, $password, $address="", $type, $photo="images/profiles/kpi_avatar.png") {

		$data = array(
			'user_flname'   => $flname,
			'user_name'   => $username,
			'user_bd'   => $birthday,
			'user_email'      => $email,
			'user_password'   => $this->hash_password($password),
			'user_address'      => $address,
			'type_id'      => $type,
			'user_photo'      => $photo,
			'user_logged_in' => false,
			'user_confirmed' => true,
			'user_deleted' => false,
			'user_create' => date('Y-m-j H:i:s'),
			'user_edited' => ''
		);
		
		return $this->db->insert('kpi_user', $data);
		
	}
	
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($username, $password) {
		
		$this->db->select('user_password');
		$this->db->from('kpi_user');
		$this->db->where('user_name', $username);
		$this->db->where('user_deleted', b'0');
		$hash = $this->db->get()->row('user_password');
		
		return $this->verify_password_hash($password, $hash);
		
	}
	
	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $email
	 * @return int the user id
	 */
	public function get_user_id_from_username($username, $email="") {
		$this->db->select('user_id');
		$this->db->from('kpi_user');
		$this->db->where('user_name', $username);
		$this->db->or_where('user_email', $email);
		$this->db->where('user_deleted', b'0');
		return $this->db->get()->row('user_id');
	}

	/**
	 * get_user_email function.
	 */
	public function get_user_email($email) {
		$this->db->select('*');
		$this->db->from('kpi_user');
		$this->db->where('user_email', $email);
		$this->db->where('user_deleted', b'0');
		return $this->db->get()->row();
	}

	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($user_id) {
		
		$this->db->from('kpi_user');
		$this->db->join('kpi_user_type', 'kpi_user.type_id = kpi_user_type.type_id');
		$this->db->where('kpi_user.user_id', $user_id);
		$this->db->where('kpi_user.user_deleted', b'0');
		return $this->db->get()->row();
		
	}
	
	/**
	 * hash_password function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access public
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	public function verify_password_hash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}

	/**
	 * get_users function.
	 * 
	 * @access public
	 * @param mixed $key
	 * @return object the user object
	 */
	public function get_users($key, $srt='') {

		$this->db->from('kpi_user');
		$this->db->join('kpi_user_type', 'kpi_user.type_id = kpi_user_type.type_id');
		$this->db->where('kpi_user.user_deleted = 0 AND (kpi_user.user_name LIKE "%'.$key.'%" OR kpi_user.user_email LIKE "%'.$key.'%")');
		if($srt!='')
			$this->db->order_by("kpi_user.".$srt,"asc");
		else
			$this->db->order_by("kpi_user.user_create","asc");

		return $this->db->get()->result();

	}

	function get_users_pg($limit, $offset, $key='', $srt='') {
    	if ($offset > 0) {
        	$offset = ($offset - 1) * $limit;
    	}

		$this->db->from('kpi_user');
		$this->db->join('kpi_user_type', 'kpi_user.type_id = kpi_user_type.type_id');
		$this->db->where('kpi_user.user_deleted = 0 AND (kpi_user.user_name LIKE "%'.$key.'%" OR kpi_user.user_email LIKE "%'.$key.'%")');
		//$this->db->order_by("kpi_user.user_name","asc");
		if($srt!='')
			$this->db->order_by("kpi_user.".$srt,"asc");
		else
			$this->db->order_by("kpi_user.user_create","asc");

		$result['num_rows'] = $this->db->count_all_results();

		$this->db->limit($limit, $offset);

    	return $result;

	}

	/**
	 * delete_user function
	 */
	public function delete_user($user_id) {
		
		$data = array(
			"user_deleted" => b'1'
		);
		$this->db->where('user_id', $user_id);

		return $this->db->update('kpi_user', $data);

	}

	/**
	 * update_user function
	 */
	public function update_user($user_id, $flname, $email, $address, $birthday) {
		
		$data = array(
			"user_flname" => $flname,
			"user_email" => $email,
			"user_address" => $address,
			"user_bd" => $birthday,
			"user_edited" => date('Y-m-j H:i:s')
		);
		$this->db->where('user_id', $user_id);

		return $this->db->update('kpi_user', $data);

	}

	/**
	 * update_photo function.
	 */
	public function update_photo ($user_id, $user_photo) {

		$data = array(
			"user_photo" => $user_photo,
			"user_edited" => date('Y-m-j H:i:s')
		);
		$this->db->where('user_id', $user_id);

		return $this->db->update('kpi_user', $data);

	}


	/**
	 * update_password function.
	 */
	public function update_password ($user_id, $user_password) {

		$data = array(
			"user_password" => $this->hash_password($user_password),
			"user_edited" => date('Y-m-j H:i:s')
		);
		$this->db->where('user_id', $user_id);

		return $this->db->update('kpi_user', $data);

	}
	
	/**
	 * sorting_list function.
	 */
	function sorting_list(){
		$data = array(
			"user_id" => "รหัสผู้ใช้ (น้อย ไป มาก)",
			"user_name" => "ชื่อผู้ใช้ (A - Z)",
			"user_email" => "อีเมลผู้ใช้ (A - Z)",
			"type_id" => "ประเภทผู้ใช้ (น้อย ไป มาก)",
			"user_create" => "วันที่สมัคร (เก่าสุด - ล่าสุด)"
		);
		return $data;
	}

}
