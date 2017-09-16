<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ManageCapitalType class.
 * 
 * @extends CI_Controller
 */
class ManageCapitalType extends CI_Controller {
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
		
		// set validation rules
		//$this->form_validation->set_rules('i_username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[kpi_user.user_name]', array('is_unique' => 'This username already exists. Please choose another one.'));
		//$this->form_validation->set_rules('i_email', 'Email', 'trim|required|valid_email|is_unique[kpi_user.user_email]', array('is_unique' => 'This e-mail already exists. Please choose another one.'));
		//$this->form_validation->set_rules('i_password', 'Password', 'trim|required|min_length[6]');
		//$this->form_validation->set_rules('i_type', 'User Type', 'trim|required');

		/**
		*if ($this->form_validation->run() === false) {
		*	
		*	$data->error = "Please check user information.";
		*	redirect('ManageUser/getUser', $data);
		*
		*	// validation not ok, send validation errors to the view
		*	$this->load->view('templates/header');
		*	$this->load->view('ManageUser/getUser', $data);
		*	$this->load->view('templates/footer');
		*
		*} else {
		**/	
			// set variables from the form
			$capt_name = $this->input->post('i_capt_name');

			if ($this->CapitalType_Model->create_capital_type($capt_name)) {

				// criterion creation ok
				$data->info = "New capital type created.";
				redirect('ManageCapitalType/getCapitalType', $data);

				$this->load->view('templates/header');
				$this->load->view('ManageCapitalType/getCapitalType', $data);
				$this->load->view('templates/footer');
				
			} else {

				// criterion creation failed, this should never happen
				$data->error = 'There was a problem creating your new capital type. Please try again.';
				redirect('ManageCapitalType/getCapitalType', $data);
				
				// send error to the view
				$this->load->view('templates/header');
				$this->load->view('ManageCapitalType/getCapitalType', $data);
				$this->load->view('templates/footer');
				
			}
			
		//} //end if check form validation
		
	}
		
	/**
	 * updateCapitalType function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updateCapitalType($id) {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){

			$data_one = $this->CapitalType_Model->get_capital_type($id);

			$data->capt_id = (int)$data_one->capt_id;
			$data->capt_name = (string)$data_one->capt_name;

			$this->load->view('templates/header');
			$this->load->view('authens/updateCapitalType', $data);
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
	 * updatingCapitalType function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updatingCapitalType() {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		$capt_id = $this->input->post('i_capt_id');
		$capt_name = $this->input->post('i_capt_name');

		if(isset($_SESSION['s_user_id'])){
			$result = $this->CapitalType_Model->update_capital_type($capt_id, $capt_name);
			if($result){
				$data->info = "Updated capital type successfully.";
				redirect('ManageCapitalType/getCapitalType');
			}else{
				$data->error = 'Capital type information is wrong.';
				redirect('ManageCapitalType/updateCapitalType/'.$capt_id);
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
	 * getCapitalType function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getCapitalType($offset = 0, $key = '') {
		
		// create the data object
		$data = new stdClass();

		$key = $this->input->post('i_key');

		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {
	        //how many blogs will be shown in a page
	        $limit = 10;

	        $result = $this->CapitalType_Model->get_capitals_type_pg($limit, $offset, $key);

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

			// select all capital type data
			$capital_type = $this->CapitalType_Model->get_capitals_type($key);
			$data->data_obj = $capital_type;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageCapitalType', $data);
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