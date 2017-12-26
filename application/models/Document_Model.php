<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Document_Model class.
 * 
 * @extends CI_Model
 */
class Document_Model extends CI_Model {
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
	 * create_label function.
	 */
	public function create_label() {
		
		$this->db->from('kpi_document');
		$label = "DOC-".sprintf("%'.04d\n", ($this->db->get()->num_rows()+1));
		return $label;
		
	} //end create_label function.

	/**
	 * create_document function.
	 * 
	 * @access public
	 * @return bool true on success, false on failure
	 */
	public function create_document($label, $title, $year, $comment="", $status="", $create_by, $edit_by="", $data_arr0, $data_arr1, $data_arr2, $data_arr3) {
		// Status: D - Draft, S - Submitted
		$data = array(
			'doc_label' => $label,
			'doc_title' => $title,
			'doc_year' => $year,
			'doc_comment' => $comment,
			'doc_status' => $status,
			'doc_create_by' => $create_by,
			'doc_create' => date('Y-m-j H:i:s'),
			'doc_edit_by' => '',
			'doc_edit' => ''
		);

		if($this->db->insert('kpi_document', $data)){
			$doc_id = $this->db->insert_id();

			foreach ($data_arr0 as $key_a => $value_a) {
				foreach ($value_a as $key_aa => $value_ab) {
					$data_a_tmp = array('doc_id' => $doc_id, 'cri_id' => $key_a, 'cokpi_id' => $key_aa, 'cokpi_score' => $value_ab);
					$this->db->insert('kpi_codoc_crit_cokpi', $data_a_tmp);
				}
			}

			foreach ($data_arr1 as $key_b => $value_b) {
				foreach ($value_b as $key_ba => $value_bb) {
					$data_b_tmp = array('doc_id' => $doc_id, 'cokpi_id' => $key_b, 'subcokpi_id' => $key_ba);
					$this->db->insert('kpi_codoc_cokpi_subcokpi', $data_b_tmp);
				}
			}

			foreach ($data_arr2 as $key_c => $value_c) {
				foreach ($value_c as $key_ca => $value_cb) {
					$data_c_tmp = array('doc_id' => $doc_id, 'subcokpi_id' => $key_c, 'issdet_id' => $key_ca, 'gra_id' => $data_arr3[$key_c][$key_ca], 'issdet_ch_score' => $value_cb);
					$this->db->insert('kpi_codoc_subcokpi_issdet', $data_c_tmp);
				}
			}
			return true;
		}
		return false;
	} //end create_document function.
	
	/**
	 * get_documents function.
	 */
	public function get_documents($key="") {
		$this->db->from('kpi_document');
		$this->db->join('kpi_user', 'kpi_document.doc_create_by=kpi_user.user_id');
		$this->db->like('doc_label', $key);
		$this->db->or_like('doc_title', $key);
		$this->db->or_like('doc_year', $key);
		$this->db->order_by("doc_label","asc");

		return $this->db->get()->result();
	}

	/**
	 * get_documents_by_pg function.
	 */
	public function get_documents_by_pg($limit, $offset, $key="") {
    	if ($offset > 0) {
        	$offset = ($offset - 1) * $limit;
    	}

		$this->db->from('kpi_document');
		$this->db->join('kpi_user', 'kpi_document.doc_create_by=kpi_user.user_id');
		$this->db->like('doc_label', $key);
		$this->db->or_like('doc_title', $key);
		$this->db->or_like('doc_year', $key);
		$this->db->order_by("doc_label","asc");

		$result['num_rows'] = $this->db->count_all_results();

		$this->db->limit($limit, $offset);

    	return $result;
	}

	/**
	 * get_document_by_id function.
	 */
	public function get_document_by_id($id) {
		$this->db->from('kpi_document');
		$this->db->join('kpi_user', 'kpi_document.doc_create_by=kpi_user.user_id');
		$this->db->where('kpi_document.doc_id', $id);

		return $this->db->get()->row();
	}

	/**
	 * get_cokpi_by_cri_id function.
	 */
	public function get_codoc_crit_cokpi_by_id($id) {
		$this->db->select('*');
		$this->db->from('kpi_codoc_crit_cokpi');
		$this->db->join('kpi_criterion', 'kpi_codoc_crit_cokpi.cri_id = kpi_criterion.cri_id');
		$this->db->join('kpi_cokpi', 'kpi_codoc_crit_cokpi.cokpi_id = kpi_cokpi.cokpi_id');
		$this->db->where('kpi_codoc_crit_cokpi.doc_id', $id);
		$this->db->order_by("kpi_codoc_crit_cokpi.cri_id","asc");

		return $this->db->get()->result();
	}

	/**
	 * get_codoc_cokpi_subcokpi_by_id function
	 */
	public function get_codoc_cokpi_subcokpi_by_id($id) {
		$this->db->from('kpi_codoc_cokpi_subcokpi');
		$this->db->join('kpi_cokpi', 'kpi_cokpi.cokpi_id = kpi_codoc_cokpi_subcokpi.cokpi_id');
		$this->db->join('kpi_sub_cokpi', 'kpi_sub_cokpi.subcokpi_id = kpi_codoc_cokpi_subcokpi.subcokpi_id');
		$this->db->where('kpi_codoc_cokpi_subcokpi.doc_id', $id);
		$this->db->order_by("kpi_codoc_cokpi_subcokpi.subcokpi_id","asc");

		return $this->db->get()->result();
	}

	/**
	 * get_codoc_subcokpi_issdet_by_id function.
	 */
	public function get_codoc_subcokpi_issdet_by_id($id) {
		$this->db->from('kpi_codoc_subcokpi_issdet');
		$this->db->join('kpi_sub_cokpi', 'kpi_codoc_subcokpi_issdet.subcokpi_id = kpi_sub_cokpi.subcokpi_id');
		$this->db->join('kpi_sub_issuesdetail', 'kpi_codoc_subcokpi_issdet.issdet_id = kpi_sub_issuesdetail.issdet_id');
		$this->db->join('kpi_grade', 'kpi_grade.gra_id = kpi_codoc_subcokpi_issdet.gra_id');
		$this->db->where('kpi_codoc_subcokpi_issdet.doc_id', $id);
		$this->db->order_by("kpi_codoc_subcokpi_issdet.issdet_id","asc");

		return $this->db->get()->result();
	}

	/**
	 * update_document function.
	 */
	public function update_document($id, $title, $status="", $edit_by="", $data_arr0, $data_arr1, $data_arr2, $data_arr3) {
		$data = array(
			'doc_title' => $title,
			'doc_status' => $status,
			'doc_edit_by' => $edit_by,
			'doc_edit' => date('Y-m-j H:i:s')
		);
		$this->db->where('doc_id', $id);

		if($this->db->update('kpi_document', $data)){
			$doc_id = $id;

			foreach ($data_arr0 as $key_a => $value_a) {
				foreach ($value_a as $key_aa => $value_ab) {
					$data_a_tmp = array('cokpi_score' => $value_ab);
					$this->db->where('doc_id', $id);
					$this->db->where('cri_id', $key_a);
					$this->db->where('cokpi_id', $key_aa);
					$this->db->update('kpi_codoc_crit_cokpi', $data_a_tmp);
				}
			}

			foreach ($data_arr2 as $key_c => $value_c) {
				foreach ($value_c as $key_ca => $value_cb) {
					$data_c_tmp = array('issdet_ch_score' => $value_cb);
					$this->db->where('doc_id', $id);
					$this->db->where('subcokpi_id', $key_c);
					$this->db->where('issdet_id', $key_ca);
					$this->db->update('kpi_codoc_subcokpi_issdet', $data_c_tmp);
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * search_document function.
	 **/
	public function search_document($d0="", $d1="", $d2="") {
		$this->db->from('kpi_document');
		$this->db->join('kpi_user', 'kpi_document.doc_create_by=kpi_user.user_id');
		//$this->db->where('kpi_document.doc_status LIKE \'S\' AND (kpi_document.doc_year = \''.$d0.'\' OR kpi_document.doc_label LIKE "%'.$d1.'%" OR kpi_document.doc_title LIKE "%'.$d2.'%")');
		$this->db->where('(kpi_document.doc_status LIKE \'S\' OR kpi_document.doc_status LIKE \'C\') AND (kpi_document.doc_year = \''.$d0.'\' OR kpi_document.doc_label LIKE "%'.$d1.'%" OR kpi_document.doc_title LIKE "%'.$d2.'%")');
		$this->db->order_by("kpi_document.doc_label","asc");

		return $this->db->get()->result();
	}

	/**
	 * search_documents_by_pg function.
	 **/
	public function search_documents_by_pg($limit, $offset, $d0="", $d1="", $d2="") {
    	if ($offset > 0) {
        	$offset = ($offset - 1) * $limit;
    	}

		$this->db->from('kpi_document');
		$this->db->join('kpi_user', 'kpi_document.doc_create_by=kpi_user.user_id');
		//$this->db->where('kpi_document.doc_status LIKE \'S\' AND (kpi_document.doc_year = \''.$d0.'\' OR kpi_document.doc_label LIKE "%'.$d1.'%" OR kpi_document.doc_title LIKE "%'.$d2.'%")');
		$this->db->where('(kpi_document.doc_status LIKE \'S\' OR kpi_document.doc_status LIKE \'C\') AND (kpi_document.doc_year = \''.$d0.'\' OR kpi_document.doc_label LIKE "%'.$d1.'%" OR kpi_document.doc_title LIKE "%'.$d2.'%")');
		$this->db->order_by("kpi_document.doc_label","asc");
		
		$result['num_rows'] = $this->db->count_all_results();

		$this->db->limit($limit, $offset);

    	return $result;
	}
	
	/**
	 * delete_document (draft) function.
	 */
	public function delete_document($id) {
		$this->db->where('doc_id', $id);

		if($this->db->delete('kpi_document')){
			$doc_id = $id;
			
			$this->db->where('doc_id', $id);
			$this->db->delete('kpi_codoc_crit_cokpi');

			$this->db->where('doc_id', $id);
			$this->db->delete('kpi_codoc_cokpi_subcokpi');

			$this->db->where('doc_id', $id);
			$this->db->delete('kpi_codoc_subcokpi_issdet');
			return true;
		}
		return false;
	} //end delete_document function.

	/**
	 * validate_document function.
	 */
	public function validate_document($id) {
		$this->db->from('kpi_document');
		$this->db->where('kpi_document.doc_label', $id);

		return $this->db->get()->num_rows();
	}

	//check status value
	public function check_status($data=""){
		return ($data=='D')? "ฉบับร่าง": "ฉบับสมบูรณ์";
	}

}
