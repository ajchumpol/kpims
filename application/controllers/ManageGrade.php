<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ManageGrade class.
 * 
 * @extends CI_Controller
 */
class ManageGrade extends CI_Controller {
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
		$this->load->model('Grade_Model');
		
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
		$gra_title1 = $this->input->post('i_gra_title1');
		$gra_title2 = $this->input->post('i_gra_title2');
		$gra_title3 = $this->input->post('i_gra_title3');
		$gra_title4 = $this->input->post('i_gra_title4');
		$gra_title5 = $this->input->post('i_gra_title5');

		if ($this->Grade_Model->create_grade($gra_title1, $gra_title2, $gra_title3, $gra_title4, $gra_title5)) {

			$data->info = "New grade created.";
			redirect('ManageGrade/getGrade', $data);

			$this->load->view('templates/header');
			$this->load->view('ManageGrade/getGrade', $data);
			$this->load->view('templates/footer');
				
		} else {

			$data->error = 'There was a problem creating your new grade. Please try again.';
			redirect('ManageGrade/getGrade', $data);
			
			// send error to the view
			$this->load->view('templates/header');
			$this->load->view('ManageGrade/getGrade', $data);
			$this->load->view('templates/footer');
				
		}
		
	} //end adding function.
		
	/**
	 * updateGrade function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updateGrade($id) {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){

			$data_one = $this->Grade_Model->get_grade($id);

			$data->gra_id = (int)$data_one->gra_id;
			$data->gra_title1 = (string)$data_one->gra_title1;
			$data->gra_title2 = (string)$data_one->gra_title2;
			$data->gra_title3 = (string)$data_one->gra_title3;
			$data->gra_title4 = (string)$data_one->gra_title4;
			$data->gra_title5 = (string)$data_one->gra_title5;

			$this->load->view('templates/header');
			$this->load->view('authens/UpdateGrade', $data);
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
	 * updatingGrade function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updatingGrade() {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		$gra_id = $this->input->post('i_gra_id');
		$gra_title1 = $this->input->post('i_gra_title1');
		$gra_title2 = $this->input->post('i_gra_title2');
		$gra_title3 = $this->input->post('i_gra_title3');
		$gra_title4 = $this->input->post('i_gra_title4');
		$gra_title5 = $this->input->post('i_gra_title5');

		if(isset($_SESSION['s_user_id'])){
			$result = $this->Grade_Model->update_grade($gra_id, $gra_title1, $gra_title2, $gra_title3, $gra_title4, $gra_title5);
			if($result){
				$data->info = "Updated grade successfully.";
				redirect('ManageGrade/getGrade');
			}else{
				$data->error = 'Grade information is wrong.';
				redirect('ManageGrade/UpdateGrade/'.$capt_id);
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
	 * getGrade function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getGrade($offset = 0, $key = '') {
		
		// create the data object
		$data = new stdClass();

		$key = $this->input->post('i_key');

		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {

	        //how many blogs will be shown in a page
	        $limit = 10;

	        $result = $this->Grade_Model->get_grades_pg($limit, $offset, $key);

	        // load pagination library
	        $this->load->library('pagination');
	        $config = array();
	        $config['base_url'] = site_url("ManageGrade/getGrade/");
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

			// select all grade data
			$grade_obj = $this->Grade_Model->get_grades($key);
			$data->data_obj = $grade_obj;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageGrade', $data);
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

			$grade = $this->Grade_Model->delete_grade($id);
			$data->data_obj = $grade;
			$data->info = "Deleted grade successfully.";

		} else {

			echo "Permission denied.";

		}

		redirect('ManageGrade/getGrade');

	}

	
}
