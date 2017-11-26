<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ManageCokpi class.
 * 
 * @extends CI_Controller
 */
class ManageCokpi extends CI_Controller {
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
		$this->load->model('Cokpi_Model');
		$this->load->model('Criterion_Model');
		$this->load->model('Grade_Model');
		
	}
	
    public function index() {

    }
	

	public function addCokpi($id){

		// create the data object
		$data = new stdClass();

		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		if(isset($_SESSION['s_user_id'])){

			$data_cri = $this->Criterion_Model->get_criterion($id);
			$data->cri_id = (int)$data_cri->cri_id;
			$data->cri_title = (string)$data_cri->cri_title;

			$data_cokpi = $this->Cokpi_Model->get_cokpi_by_cri_id($id);
			$data->data_cokpi_obj = $data_cokpi;

			$this->load->view('templates/header');
			$this->load->view('authens/AddCokpi', $data);
			$this->load->view('templates/footer');

		}else{

			$data->error = 'Permission denied.';
				
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');

		}

	}

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
		
		// set variables from the form
		$cri_id = $this->input->post('i_cri_id');
		$cokpi_title = $this->input->post('i_cokpi_title');
		$cokpi_wei = $this->input->post('i_cokpi_wei');
		$cokpi_unit = $this->input->post('i_cokpi_unit');
		$cokpi_app = $this->input->post('i_cokpi_app');
		$cokpi_comment = $this->input->post('i_cokpi_comment');

		if ($this->Cokpi_Model->create_cokpi($cri_id, $cokpi_title, $cokpi_wei, $cokpi_app, $cokpi_unit, $cokpi_comment)) {

			// criterion creation ok
			$data->info = "New co-kpi created.";
			redirect('ManageCokpi/addCokpi/'.$cri_id, $data);

			$this->load->view('templates/header');
			$this->load->view('ManageCokpi/getCokpi', $data);
			$this->load->view('templates/footer');
				
		} else {

			// criterion creation failed, this should never happen
			$data->error = 'There was a problem creating your new co-kpi. Please try again.';
			redirect('ManageCokpi/addCokpi'.$cri_id, $data);
			
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('ManageCokpi/getCokpi', $data);
			$this->load->view('templates/footer');
				
		} //end check create data
		
	}
		
	/**
	 * updateCokpi function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updateCokpi($id, $cri_id) {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){
			
			$data_cri = $this->Criterion_Model->get_criterion($cri_id);
			$data->cri_id = (int)$data_cri->cri_id;
			$data->cri_title = (string)$data_cri->cri_title;

			$data_cokpi = $this->Cokpi_Model->get_cokpi_by_cri_id($cri_id);
			$data->data_cokpi_obj = $data_cokpi;

			$data_one = $this->Cokpi_Model->get_cokpi_by_id($id);

			$data->cokpi_id = (int)$data_one->cokpi_id;
			$data->cokpi_title = (string)$data_one->cokpi_title;
			$data->cokpi_wei = (int)$data_one->cokpi_wei;
			$data->cokpi_app = (string)$data_one->cokpi_app;
			$data->cokpi_unit = (int)$data_one->cokpi_unit;
			$data->cokpi_comment = (string)$data_one->cokpi_comment;

			$data_cri = $this->Criterion_Model->get_criterion($cri_id);
			$data->data_cri_obj = $data_cri;
			$data->data_method = "UPD";

			$this->load->view('templates/header');
			$this->load->view('authens/AddCokpi', $data);
			$this->load->view('templates/footer');
					
		} else {

			$data->error = 'Permission denied.';
				
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
				
		}
		
	}

	/**
	 * updatingCokpi function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updatingCokpi() {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		$cri_id = $this->input->post('i_cri_id');
		$cokpi_id = $this->input->post('i_cokpi_id');
		$cokpi_title = $this->input->post('i_cokpi_title');
		$cokpi_wei = $this->input->post('i_cokpi_wei');
		$cokpi_app = $this->input->post('i_cokpi_app');
		$cokpi_unit = $this->input->post('i_cokpi_unit');
		$cokpi_comment = $this->input->post('i_cokpi_comment');

		if(isset($_SESSION['s_user_id'])){
			//$id, $title, $weight, $unit, $approach="", $comment=""
			$result = $this->Cokpi_Model->update_cokpi($cokpi_id, $cokpi_title, $cokpi_wei, $cokpi_unit, $cokpi_app, $cokpi_comment);
			if($result){
				$data->info = "Updated co-kpi information successfully.";
				redirect('ManageCokpi/AddCokpi/'.$cri_id);
			}else{
				$data->error = 'Co-kpi information is wrong.';
				redirect('ManageCokpi/AddCokpi/'.$cri_id);
			}
		}else{
			$data->error = 'Permission denied.';
				
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
		}

	}
	
	/**
	 * getCokpi function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getCokpi($key = '') {
		
		// create the data object
		$data = new stdClass();

		$key = $this->input->post('i_key');

		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {

			if(isset($key)) {
				// select all cokpi data
				$alldata = $this->Cokpi_Model->get_cokpi($key);
				$data->data_obj = $alldata;
			}

			// select all criterion data
			$data_cri_obj = $this->Criterion_Model->get_criterions();
			$data->data_cri_obj = $data_cri_obj;
			$data->key = $key;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageCokpi', $data);
			$this->load->view('templates/footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			$data->error = "Permission denied.";
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
			
		}
		
	}

	/**
	 * getCokpiByCrit function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getCokpiByCrit($key = '') {
		
		// create the data object
		$data = new stdClass();

		$key = $this->input->post('i_key');

		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {

			// select all cokpi data
			$alldata = $this->Cokpi_Model->get_cokpi($key);
			$data->data_obj = $alldata;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageCokpi', $data);
			$this->load->view('templates/footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			$data->error = "Permission denied.";
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
			
		}
		
	}

	/**
	 * deleting function.
	 */
	public function deleting($id, $cri_id) {
		$data = new stdClass();
		if(isset($id) && isset($cri_id) && isset($_SESSION['s_user_type'])==1){
			$cokpi = $this->Cokpi_Model->delete_cokpi($id, $cri_id);
			$data->data_obj = $cokpi;
			$data->info = "Deleted co-kpi successfully.";
		} else {
			echo "Permission denied.";
		}
		redirect('ManageCokpi/addCokpi/'.$cri_id);
	}

	/**
	 * getSubkpi function.
	 */
	public function getSubkpi($key=0) {

		$data = new stdClass();
		$key = $this->input->post('i_key');
		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {
			// select all criterion data
			$data_cri_obj = $this->Criterion_Model->get_criterions();
			$data->data_cri_obj = $data_cri_obj;

			$data_cokpi = $this->Cokpi_Model->get_cokpi_by_cri_id($key);
			$data->data_cokpi_obj = $data_cokpi;

			$data->key = $key;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageSubkpi', $data);
			$this->load->view('templates/footer');
		} else {
			// there user was not logged in, we cannot logged him out,
			$data->error = "Permission denied.";
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
		}
	}

	/**
	 * addSubkpi function.
	 */
	public function addSubkpi($id1, $id2){

		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');

		if(isset($_SESSION['s_user_id'])){

			$data_cri = $this->Criterion_Model->get_criterion($id1);
			$data->cri_id = (int)$data_cri->cri_id;
			$data->cri_title = (string)$data_cri->cri_title;

			$data_cokpi = $this->Cokpi_Model->get_cokpi_by_id($id2);
			$data->cokpi_id = (int)$data_cokpi->cokpi_id;
			$data->cokpi_title = (string)$data_cokpi->cokpi_title;

			//get kpi_sub_cokpi and kpi_cokpi_subcokpi
			$data_subkpi = $this->Cokpi_Model->get_subkpi_by_cokpi_id($id2);
			$data->data_subkpi_obj = $data_subkpi;

			$this->load->view('templates/header');
			$this->load->view('authens/AddSubkpi', $data);
			$this->load->view('templates/footer');

		}else{

			$data->error = 'Permission denied.';
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');

		}

	} //end function addSubkpi

	/**
	 * addingSubkpi function.
	 */
	public function addingSubkpi() {

		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set variables from the form
		$cri_id = $this->input->post('i_cri_id');
		$cokpi_id = $this->input->post('i_cokpi_id');
		$subkpi_title = $this->input->post('i_subkpi_title');
		$subkpi_def = $this->input->post('i_subkpi_def');
		$subkpi_comment = $this->input->post('i_subkpi_comment');

		if ($this->Cokpi_Model->create_subkpi($cri_id, $cokpi_id, $subkpi_title, $subkpi_def, $subkpi_comment)) {
			$data->info = "New sub-kpi created.";
			redirect('ManageCokpi/addSubkpi/'.$cri_id.'/'.$cokpi_id, $data);

			$this->load->view('templates/header');
			$this->load->view('ManageCokpi/getCokpi', $data);
			$this->load->view('templates/footer');
		} else {
			$data->error = 'There was a problem creating your new sub-kpi. Please try again.';
			redirect('ManageCokpi/addSubkpi/'.$cri_id.'/'.$cokpi_id, $data);

			$this->load->view('templates/header');
			$this->load->view('ManageCokpi/addSubkpi', $data);
			$this->load->view('templates/footer');	
		}	
	} //end function addingSubkpi

	/**
	 * updateSubkpi function.
	 */
	public function updateSubkpi($id, $cokpi_id, $cri_id) {
		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){
			$data_cri = $this->Criterion_Model->get_criterion($cri_id);
			$data->cri_id = (int)$data_cri->cri_id;
			$data->cri_title = (string)$data_cri->cri_title;

			$data_cokpi = $this->Cokpi_Model->get_cokpi_by_id($cokpi_id);
			$data->cokpi_id = (int)$data_cokpi->cokpi_id;
			$data->cokpi_title = (string)$data_cokpi->cokpi_title;

			$data_subkpi = $this->Cokpi_Model->get_subkpi_by_cokpi_id($cokpi_id);
			$data->data_subkpi_obj = $data_subkpi;

			$data_one = $this->Cokpi_Model->get_subkpi_by_id($id);

			$data->subkpi_id = (int)$data_one->subcokpi_id;
			$data->subkpi_title = (string)$data_one->subcokpi_title;
			$data->subkpi_def = (string)$data_one->subcokpi_def;
			$data->subkpi_comment = (string)$data_one->subcokpi_comment;
			$data->data_method = "UPD";

			$this->load->view('templates/header');
			$this->load->view('authens/AddSubkpi', $data);
			$this->load->view('templates/footer');	
		} else {
			$data->error = 'Permission denied.';
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');				
		}
	} //end updateSubkpi function

	/**
	 * updatingSubkpi function.
	 */
	public function updatingSubkpi() {
		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		$cri_id = $this->input->post('i_cri_id');
		$cokpi_id = $this->input->post('i_cokpi_id');
		$subkpi_id = $this->input->post('i_subkpi_id');
		$subkpi_title = $this->input->post('i_subkpi_title');
		$subkpi_def = $this->input->post('i_subkpi_def');
		$subkpi_comment = $this->input->post('i_subkpi_comment');

		if(isset($_SESSION['s_user_id'])){
			$result = $this->Cokpi_Model->update_subkpi($cokpi_id, $subkpi_id, $subkpi_title, $subkpi_def, $subkpi_comment);
			if($result){
				$data->info = "Updated sub-kpi information successfully.";
				redirect('ManageCokpi/AddSubkpi/'.$cri_id.'/'.$cokpi_id);
			}else{
				$data->error = 'Sub-kpi information is wrong.';
				redirect('ManageCokpi/AddSubkpi/'.$subkpi_id.'/'.$cokpi_id.'/'.$cri_id.'#ADD');
			}
		}else{
			$data->error = 'Permission denied.';
				
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
		}
	} //end updatingSubkpi function.

	/**
	 * deletingSubkpi function.
	 */
	public function deletingSubkpi($id, $cokpi_id, $cri_id) {
		$data = new stdClass();
		if(isset($id) && isset($cokpi_id) && isset($_SESSION['s_user_type'])==1){
			$subkpi = $this->Cokpi_Model->delete_subkpi($id, $cokpi_id);
			$data->data_obj = $subkpi;
			$data->info = "Deleted sub-kpi successfully.";
		} else {
			echo "Permission denied.";
		}
		redirect('ManageCokpi/addSubkpi/'.$cri_id.'/'.$cokpi_id);
	} //end deletingSubkpi function.

	/**
	 * getSubissue function.
	 */
	public function getSubissue($key="") {

		$data = new stdClass();
		$key = $this->input->post('i_key');
		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {

			$data_subkpi = $this->Cokpi_Model->get_subkpi($key);
			$data->data_subkpi_obj = $data_subkpi;

			$data->key = $key;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageSubissue', $data);
			$this->load->view('templates/footer');
		} else {
			// there user was not logged in, we cannot logged him out,
			$data->error = "Permission denied.";
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
		}
	} //end getSubissue function.

	/**
	 * addSubissue function.
	 *
	 * @access public
	 * @param mixed $id1 - cri_id
	 * @param mixed $id2 - cokpi_id
	 * @param mixed $id3 - subcokpi_id
	 */
	public function addSubissue($id1, $id2, $id3){

		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');

		if(isset($_SESSION['s_user_id'])){

			$data_cri = $this->Criterion_Model->get_criterion($id1);
			$data->cri_id = (int)$data_cri->cri_id;
			$data->cri_title = (string)$data_cri->cri_title;

			$data_cokpi = $this->Cokpi_Model->get_cokpi_by_id($id2);
			$data->cokpi_id = (int)$data_cokpi->cokpi_id;
			$data->cokpi_title = (string)$data_cokpi->cokpi_title;

			$data_subkpi = $this->Cokpi_Model->get_subkpi_by_id($id3);
			$data->subkpi_id = (int)$data_subkpi->subcokpi_id;
			$data->subkpi_title = (string)$data_subkpi->subcokpi_title;

			$data_grade = $this->Grade_Model->get_grades();
			$data->data_grade_obj = $data_grade;

			$data_subissue = $this->Cokpi_Model->get_subissue_by_subcokpi_id($id3);
			$data->data_subissue_obj = $data_subissue;

			$data_att = $this->Cokpi_Model->get_attach($id3);
			$data->data_att_obj = $data_att;

			$this->load->view('templates/header');
			$this->load->view('authens/AddSubissue', $data);
			$this->load->view('templates/footer');

		}else{

			$data->error = 'Permission denied.';
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');

		}

	} //end function addSubissue

	/**
	 * addingSubissue function.
	 */
	public function addingSubissue() {

		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set variables from the form
		$cri_id = $this->input->post('i_cri_id');
		$cokpi_id = $this->input->post('i_cokpi_id');
		$subkpi_id = $this->input->post('i_subkpi_id');
		$issdet_title = $this->input->post('i_issdet_title');
		$issdet_wei = $this->input->post('i_issdet_wei');
		$gra_id = $this->input->post('i_gra_id');

		$uploadData = array();
		if(!empty($_FILES['upload_Files']['name'])){
            $filesCount = count($_FILES['upload_Files']['name']);
            for($i = 0; $i < $filesCount; $i++){
            	$new_name = strtotime(date('Y-m-j H:i:s'));
                $_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
                $_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
                $_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
                $_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
                $_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
                $uploadPath = 'attachs/files/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['file_name'] = $new_name;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('upload_File')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['att_label'] = $fileData['file_name'];
                    $uploadData[$i]['att_path'] = $uploadPath.$fileData['file_name'];
                }
            } //endfor loop

        } // endif check uploads

		if ($this->Cokpi_Model->create_subissue($cri_id, $cokpi_id, $subkpi_id, $issdet_title, $issdet_wei, $gra_id, $issdet_score="", $uploadData)) {
			$data->info = "New sub-issue created.";
			redirect('ManageCokpi/addSubissue/'.$cri_id.'/'.$cokpi_id.'/'.$subkpi_id, $data);
		} else {
			$data->error = 'There was a problem creating your new sub-issue. Please try again.';
			redirect('ManageCokpi/addSubissue/'.$cri_id.'/'.$cokpi_id.'/'.$subkpi_id, $data);
		}	
	} //end function addingSubissue

	/**
	 * deletingSubissue function.
	 */
	public function deletingSubissue($id, $subkpi_id, $cokpi_id, $cri_id) {
		$data = new stdClass();
		if(isset($id) && isset($cokpi_id) && isset($_SESSION['s_user_type'])==1){
			$subkpi = $this->Cokpi_Model->delete_subissue($id, $subkpi_id);
			$data->data_obj = $subkpi;
			$data->info = "Deleted sub-issue successfully.";
		} else {
			echo "Permission denied.";
		}
		redirect('ManageCokpi/addSubissue/'.$cri_id.'/'.$cokpi_id.'/'.$subkpi_id);
	} //end deletingSubkpi function.

} //end class ManageCokpi