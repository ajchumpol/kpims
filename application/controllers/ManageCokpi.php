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

		// create the data object
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

	
}