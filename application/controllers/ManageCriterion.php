<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ManageCriterion class.
 * 
 * @extends CI_Controller
 */
class ManageCriterion extends CI_Controller {
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
		$this->load->model('CapitalType_Model');
		
	}
	
    public function index() {

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
			$cri_year = $this->input->post('i_criyear');
			$cri_title = $this->input->post('i_crititle');
			$capt_id = $this->input->post('i_capt_id');
			$cri_wei_min = $this->input->post('i_criwei_min');
			$cri_wei_max = $this->input->post('i_criwei_max');
			$cri_app = $this->input->post('i_criapp');
			$cri_app_ex = $this->input->post('i_criapp_ex');

			if ($this->Criterion_Model->create_criterion($cri_title, $capt_id, $cri_year, $cri_wei_min, $cri_wei_max, $cri_app, $cri_app_ex)) {

				// criterion creation ok
				$data->info = "New criterion created.";
				redirect('ManageCriterion/getCriterion', $data);

				$this->load->view('templates/header');
				$this->load->view('ManageUser/getUser', $data);
				$this->load->view('templates/footer');
				
			} else {

				// criterion creation failed, this should never happen
				$data->error = 'There was a problem creating your new criterion. Please try again.';
				redirect('ManageCriterion/getCriterion', $data);
				
				// send error to the view
				$this->load->view('templates/header');
				$this->load->view('ManageUser/getUser', $data);
				$this->load->view('templates/footer');
				
			}
	
	}
		
	/**
	 * updateCriterion function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updateCriterion($id) {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){

			$data_one = $this->Criterion_Model->get_criterion($id);

			$data->cri_id = (int)$data_one->cri_id;
			$data->cri_title = (string)$data_one->cri_title;
			$data->capt_id = (int)$data_one->capt_id;
			$data->cri_year = (int)$data_one->cri_year;
			$data->cri_wei_min = (int)$data_one->cri_wei_min;
			$data->cri_wei_max = (int)$data_one->cri_wei_max;
			$data->cri_app = (string)$data_one->cri_kpi_app;
			$data->cri_app_ex = (string)$data_one->cri_kpi_appexa;

			// select all capital type data
			$capital_type = $this->CapitalType_Model->get_capitals_type();
			$data->capital_type_obj = $capital_type;

			$this->load->view('templates/header');
			$this->load->view('authens/UpdateCriterion', $data);
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
	 * updatingCriterion function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updatingCriterion() {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		// $title, $type=0, $weight_min, $weight_max, $approach="", $approach_ex=""
		$cri_year = $this->input->post('i_criyear');
		$cri_id = $this->input->post('i_cri_id');
		$cri_title = $this->input->post('i_crititle');
		$capt_id = $this->input->post('i_capt_id');
		$cri_wei_min = $this->input->post('i_criwei_min');
		$cri_wei_max = $this->input->post('i_criwei_max');
		$cri_app = $this->input->post('i_criapp');
		$cri_app_ex = $this->input->post('i_criapp_ex');

		if(isset($_SESSION['s_user_id'])){
			//$id, $title, $type=0, $weight_min, $weight_max, $approach="", $approach_ex=""
			$result = $this->Criterion_Model->update_criterion($cri_id, $cri_title, $capt_id, $cri_year, $cri_wei_min, $cri_wei_max, $cri_app, $cri_app_ex);
			if($result){
				$data->info = "Updated criterion information successfully.";
				redirect('ManageCriterion/getCriterion');
			}else{
				$data->error = 'Criterion information is wrong.';
				redirect('ManageCriterion/updateCriterion/'.$cri_id);
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
	 * getCriterion function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getCriterion($offset = 0, $key = '') {
		
		// create the data object
		$data = new stdClass();

		$key = $this->input->post('i_key');

		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {
	        //how many blogs will be shown in a page
	        $limit = 10;

	        $result = $this->Criterion_Model->get_criterions_pg($limit, $offset, $key);

	        // load pagination library
	        $this->load->library('pagination');
	        $config = array();
	        $config['base_url'] = site_url("ManageCriterion/getCriterion/");
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

			// select all user data
			$alldata = $this->Criterion_Model->get_criterions($key);
			$data->data_obj = $alldata;

			// select all capital type data
			$capital_type = $this->CapitalType_Model->get_capitals_type($key);
			$data->capital_type_obj = $capital_type;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageCriterion', $data);
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
	public function deleting($id) {

		// create the data object
		$data = new stdClass();

		if(isset($id) && isset($_SESSION['s_user_type'])==1){

			// create the data object
			$data = new stdClass();

			$crit = $this->Criterion_Model->delete_criterion($id);
			$data->data_obj = $crit;
			$data->info = "Deleted criterion successfully.";

		} else {

			echo "Permission denied.";

		}

		redirect('ManageCriterion/getCriterion');

	}

	
}
