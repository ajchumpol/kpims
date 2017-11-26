<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ManageDocument class.
 * 
 * @extends CI_Controller
 */
class ManageDocument extends CI_Controller {
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->library(array('pagination'));
		$this->load->helper(array('url'));
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('Criterion_Model');
		$this->load->model('Cokpi_Model');
		$this->load->model('Grade_Model');
		$this->load->model('CapitalType_Model');
		$this->load->model('Document_Model');
		$this->load->model('User_Model');
		
	}
	
    public function index() {

    }
	
	/**
	 * openDocument function.
	 * 
	 * @access public
	 * @return void
	 */
	public function openDocument($key="") {
			
		$data = new stdClass();

		if(isset($_SESSION['s_user_id'])){
			$data->label = $this->Document_Model->create_label();

			//get all data from criterion and cokpi
			if($key=="") $key = date('Y')+543;
			$data_cri = $this->Cokpi_Model->get_cokpi_by_cri_id(0,$key);
			$data->data_cri_obj = $data_cri;

			//get all data from cokpi and subcokpi
			$data_cokpi = $this->Cokpi_Model->get_subkpi_and_cokpi();
			$data->data_cokpi_obj = $data_cokpi;

			//get all data from subcokpi and sub_issuesdetail
			$data_subcokpi = $this->Cokpi_Model->get_subissue_and_subcokpi();
			$data->data_subcokpi_obj = $data_subcokpi;

			//get all data from kpi_attach_issdet
			$data_att = $this->Cokpi_Model->get_all_attachs();
			$data->data_att_obj = $data_att;

			//get all data from grade
			$data_grade = $this->Grade_Model->get_grades();
			$data->data_grade_obj = $data_grade;
			$data->data_year = $key;

			$this->load->view('templates/header');
			$this->load->view('authens/OpenDocument', $data);
			$this->load->view('templates/footer');
		} else {
			$data->error = 'Permission denied.';
				
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
		}

	} //end openDocument function

	/**
	 * adding function.
	 * 
	 * @access public
	 * @return void
	 */
	public function adding() {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$label = $this->input->post('i_label');
		$title = $this->input->post('i_title');
		$year = $this->input->post('i_year');
		$submit_draft = $this->input->post('i_submit_draft');
		$submit = $this->input->post('i_submit');
		if(isset($submit)) $status = "S"; else $status = "D";
		$create_by = $_SESSION['s_user_id'];
		$cokpi_wei = $this->input->post('i_cokpi_wei');			// association array - $data_arr0
		$cokpi_subkpi = $this->input->post('i_cokpi_subkpi');	// association array - $data_arr1
		$gra_score = $this->input->post('i_gra_score');			// association array - $data_arr2
		$gra_id = $this->input->post('i_gra_id');				// association array - $data_arr3

		// call doc_label validate
		if($this->Document_Model->validate_document($label) == 0) {
			// call create_document
			if ($this->Document_Model->create_document($label, $title, $year, "", $status, $create_by, "", $cokpi_wei, $cokpi_subkpi, $gra_score, $gra_id)) {
				$data->info = "New (".$status.") document created.";
				redirect('ManageDocument/getDocLists', $data);
			} else {
				$data->error = 'There was a problem creating your new document. Please try again.';
				redirect('ManageDocument/openDocument', $data);
			} //end if check create_document model
		} else {
			$data->error = 'This document label ('.$label.') has already. Please try again.';
			redirect('ManageDocument/openDocument/'.$year, $data);
		} //end if document validate
		
	} //end check adding function

	/**
	 * getDocLists function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getDocLists($offset = 0, $key = '') {
		
		$data = new stdClass();

		$key = $this->input->post('i_key');

		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {
	        $limit = 10;

	        if($_SESSION['s_user_type'] == 2)
	        	$result = $this->Document_Model->search_documents_by_pg($limit, $offset, $key, $key, $key);
	        else
	        	$result = $this->Document_Model->get_documents_by_pg($limit, $offset, $key);

	        // load pagination library
	        $this->load->library('pagination');
	        $config = array();
	        $config['base_url'] = site_url("ManageDocument/getDocLists");
	        $config['total_rows'] = $result['num_rows'];
	        $config['per_page'] = $limit;
	        //which uri segment indicates pagination number
	        $config['uri_segment'] = 3;
	        $config['use_page_numbers'] = TRUE;
	        //max links on a page will be shown
	        $config['num_links'] = 5;
	        //various pagination configuration
	        $config['first_tag_open'] = ' <span class="first">';
	        $config['first_tag_close'] = '</span> ';
	        $config['first_link'] = '';
	        $config['last_tag_open'] = ' <span class="last">';
	        $config['last_tag_close'] = '</span> ';
	        $config['last_link'] = '';
	        $config['prev_tag_open'] = ' <span class="prev">';
	        $config['prev_tag_close'] = '</span> ';
	        $config['prev_link'] = '';
	        $config['next_tag_open'] = ' <span class="next">';
	        $config['next_tag_close'] = '</span> ';
	        $config['next_link'] = '';
	        $config['cur_tag_open'] = ' <span class="current">';
	        $config['cur_tag_close'] = '</span> ';

	        $this->pagination->initialize($config);

	        $data->data_pg = $this->pagination->create_links();

			if($_SESSION['s_user_type'] == 2)
				$alldata = $this->Document_Model->search_document($key, $key, $key);
			else
				$alldata = $this->Document_Model->get_documents($key);
			$data->data_obj = $alldata;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageDocument', $data);
			$this->load->view('templates/footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			$data->error = "Permission denied.";
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
			
		}
		
	} //end getDocLists function.

	/**
	 * updateDocument function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updateDocument($id) {

		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){
			/********************************************/
			$data_doc = $this->Document_Model->get_document_by_id($id);
			$data->doc_id = (int)$data_doc->doc_id;
			$data->doc_label = (string)$data_doc->doc_label;
			$data->doc_title = (string)$data_doc->doc_title;
			$data->doc_year = (int)$data_doc->doc_year;
			$data->doc_comment = (string)$data_doc->doc_comment;
			$data->doc_status = $this->Document_Model->check_status((int)$data_doc->doc_status);
			$data->doc_create_name = (string)$data_doc->user_flname;
			$data->doc_create = (string)$data_doc->doc_create;
			$data->doc_edit = (string)$data_doc->doc_edit;

			$data_cri = $this->Document_Model->get_codoc_crit_cokpi_by_id($id);
			$data->data_cri_obj = $data_cri;

			$data_cokpi = $this->Document_Model->get_codoc_cokpi_subcokpi_by_id($id);
			$data->data_cokpi_obj = $data_cokpi;

			$data_subcokpi = $this->Document_Model->get_codoc_subcokpi_issdet_by_id($id);
			$data->data_subcokpi_obj = $data_subcokpi;

			//get all data from kpi_attach_issdet
			$data_att = $this->Cokpi_Model->get_all_attachs();
			$data->data_att_obj = $data_att;

			//get all data from grade
			$data_grade = $this->Grade_Model->get_grades();
			$data->data_grade_obj = $data_grade;
			/********************************************/

			$this->load->view('templates/header');
			$this->load->view('authens/UpdateDocument', $data);
			$this->load->view('templates/footer');		
		} else {
			$data->error = 'Permission denied.';
				
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
		}
		
	} //end updateDocument function

	/**
	 * updating function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updating() {
		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$doc_id = $this->input->post('i_doc_id');
		$label = $this->input->post('i_label');
		$title = $this->input->post('i_title');
		$year = $this->input->post('i_year');
		$submit_draft = $this->input->post('i_submit_draft');
		$submit = $this->input->post('i_submit');
		if(isset($submit)) $status = "S"; else $status = "D";
		$edit_by = $_SESSION['s_user_id'];
		$cokpi_wei = $this->input->post('i_cokpi_wei');			// association array - $data_arr0
		$cokpi_subkpi = $this->input->post('i_cokpi_subkpi');	// association array - $data_arr1
		$gra_score = $this->input->post('i_gra_score');			// association array - $data_arr2
		$gra_id = $this->input->post('i_gra_id');				// association array - $data_arr3

		// call create_document
		if ($this->Document_Model->update_document($doc_id, $title, $status, $edit_by, $cokpi_wei, $cokpi_subkpi, $gra_score, $gra_id)) {
			$data->info = "Your (".$status.") document updated.";
			redirect('ManageDocument/getDocLists', $data);
		} else {
			$data->error = 'There was a problem updating your document. Please try again.';
			redirect('ManageDocument/updateDocument/'.$doc_id, $data);
		} //end if check create_document model
	} //end updating function.


	/**
	 * updateDocument function.
	 * 
	 * @access public
	 * @return void
	 */
	public function viewDocument($id) {

		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){
			/********************************************/
			$data_doc = $this->Document_Model->get_document_by_id($id);
			$data->doc_id = (int)$data_doc->doc_id;
			$data->doc_label = (string)$data_doc->doc_label;
			$data->doc_title = (string)$data_doc->doc_title;
			$data->doc_year = (int)$data_doc->doc_year;
			$data->doc_comment = (string)$data_doc->doc_comment;
			$data->doc_status = $this->Document_Model->check_status((string)$data_doc->doc_status);
			$data->doc_create_name = (string)$data_doc->user_flname;
			$data->doc_create = (string)$data_doc->doc_create;
			$user_obj = $this->User_Model->get_user((int)$data_doc->doc_edit_by);
			if($user_obj)
				$data->doc_edit_name = (string)$user_obj->user_flname;
			else
				$data->doc_edit_name = "ไม่ระบุ";
			if((string)$data_doc->doc_edit != "0000-00-00 00:00:00")
				$data->doc_edit = (string)$data_doc->doc_edit;
			else
				$data->doc_edit = "ไม่ระบุ";

			$data_cri = $this->Document_Model->get_codoc_crit_cokpi_by_id($id);
			$data->data_cri_obj = $data_cri;

			$data_cokpi = $this->Document_Model->get_codoc_cokpi_subcokpi_by_id($id);
			$data->data_cokpi_obj = $data_cokpi;

			$data_subcokpi = $this->Document_Model->get_codoc_subcokpi_issdet_by_id($id);
			$data->data_subcokpi_obj = $data_subcokpi;

			$data_att = $this->Cokpi_Model->get_all_attachs();
			$data->data_att_obj = $data_att;

			//get all data from grade
			$data_grade = $this->Grade_Model->get_grades();
			$data->data_grade_obj = $data_grade;
			/********************************************/

			$this->load->view('templates/header');
			$this->load->view('authens/ViewDocument', $data);
			$this->load->view('templates/footer');		
		} else {
			$data->error = 'Permission denied.';
				
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
		}
		
	} //end viewDocument function

	/**
	 * printDocument function.
	 * 
	 * @access public
	 * @return void
	 */
	public function printDocument($id) {

		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){
			$data_doc = $this->Document_Model->get_document_by_id($id);
			$data->doc_id = (int)$data_doc->doc_id;
			$data->doc_label = (string)$data_doc->doc_label;
			$data->doc_title = (string)$data_doc->doc_title;
			$data->doc_year = (int)$data_doc->doc_year;
			$data->doc_comment = (string)$data_doc->doc_comment;
			$data->doc_status = $this->Document_Model->check_status((string)$data_doc->doc_status);
			$data->doc_create_name = (string)$data_doc->user_flname;
			$data->doc_create = (string)$data_doc->doc_create;
			$user_obj = $this->User_Model->get_user((int)$data_doc->doc_edit_by);
			$data->doc_edit_name = (string)$user_obj->user_flname;
			$data->doc_edit = (string)$data_doc->doc_edit;

			$data_cri = $this->Document_Model->get_codoc_crit_cokpi_by_id($id);
			$data->data_cri_obj = $data_cri;

			$data_cokpi = $this->Document_Model->get_codoc_cokpi_subcokpi_by_id($id);
			$data->data_cokpi_obj = $data_cokpi;

			$data_subcokpi = $this->Document_Model->get_codoc_subcokpi_issdet_by_id($id);
			$data->data_subcokpi_obj = $data_subcokpi;

			$data_att = $this->Cokpi_Model->get_all_attachs();
			$data->data_att_obj = $data_att;

			//get all data from grade
			$data_grade = $this->Grade_Model->get_grades();
			$data->data_grade_obj = $data_grade;
			/********************************************/

			$this->load->view('authens/PrintDocument', $data);
		
		} else {
			echo 'Permission denied.';
			die;
		}
		
	} //end printDocument function

	/**
	 * deleting function.
	 */
	public function deleting($id) {
		$data = new stdClass();

		if(isset($_SESSION['s_user_id'])){
			$doc = $this->Document_Model->delete_document($id);
			$data->data_obj = $doc;
			$data->info = "Deleted document successfully.";
			redirect('ManageDocument/getDocLists');
		} else {
			echo "Permission denied.";
			redirect('Login');
		}

	}

	/**
	 * getDocSearch function.
	 */
	public function getDocSearch($offset = 0){
		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');

		if(isset($_SESSION['s_user_id'])){
			$d0 = $this->input->post('i_year');
			$data->doc_year = $d0;
			$d1 = $this->input->post('i_label');
			$data->doc_label = $d1;
			$d2 = $this->input->post('i_title');
			$data->doc_title = $d2;

			/************************/
			$limit = 10;

	        $result = $this->Document_Model->search_documents_by_pg($limit, $offset, $d0, $d1, $d2);

	        // load pagination library
	        $this->load->library('pagination');
	        $config = array();
	        $config['base_url'] = site_url("ManageDocument/getDocSearch");
	        $config['total_rows'] = $result['num_rows'];
	        $config['per_page'] = $limit;
	        //which uri segment indicates pagination number
	        $config['uri_segment'] = 3;
	        $config['use_page_numbers'] = TRUE;
	        //max links on a page will be shown
	        $config['num_links'] = 5;
	        //various pagination configuration
	        $config['first_tag_open'] = ' <span class="first">';
	        $config['first_tag_close'] = '</span> ';
	        $config['first_link'] = '';
	        $config['last_tag_open'] = ' <span class="last">';
	        $config['last_tag_close'] = '</span> ';
	        $config['last_link'] = '';
	        $config['prev_tag_open'] = ' <span class="prev">';
	        $config['prev_tag_close'] = '</span> ';
	        $config['prev_link'] = '';
	        $config['next_tag_open'] = ' <span class="next">';
	        $config['next_tag_close'] = '</span> ';
	        $config['next_link'] = '';
	        $config['cur_tag_open'] = ' <span class="current">';
	        $config['cur_tag_close'] = '</span> ';

	        $this->pagination->initialize($config);

	        $data->data_pg = $this->pagination->create_links();
			/************************/
			$doc = $this->Document_Model->search_document($d0, $d1, $d2);
			$data->data_obj = $doc;

			$this->load->view('templates/header');
			$this->load->view('authens/SearchDocument', $data);
			$this->load->view('templates/footer');
		} else {
			echo "Permission denied.";
			redirect('Login');
		}
	} //end getDocSearch function.
	
}
