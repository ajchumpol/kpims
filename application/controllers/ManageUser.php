<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ManageUser class.
 * 
 * @extends CI_Controller
 */
class ManageUser extends CI_Controller {
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
		$this->load->model('user_model');
		$this->load->model('usertype_model');
		
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
		$this->form_validation->set_rules('i_username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[kpi_user.user_name]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('i_email', 'Email', 'trim|required|valid_email|is_unique[kpi_user.user_email]', array('is_unique' => 'This e-mail already exists. Please choose another one.'));
		$this->form_validation->set_rules('i_password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('i_type', 'User Type', 'trim|required');

		if ($this->form_validation->run() === false) {
			
			$data->error = "Please check user information.";
			redirect('ManageUser/getUser', $data);

			// validation not ok, send validation errors to the view
			$this->load->view('templates/header');
			$this->load->view('ManageUser/getUser', $data);
			$this->load->view('templates/footer');

		} else {
			
			// set variables from the form
			$flname   = $this->input->post('i_flname');
			$username = $this->input->post('i_username');
			$birthday = $this->input->post('i_birthday');
			$email    = $this->input->post('i_email');
			$password = $this->input->post('i_password');
			$address  = $this->input->post('i_address');
			$type     = $this->input->post('i_type');

			if ($this->user_model->create_user($flname, $username, $birthday, $email, $password, $address, $type)) {

				// user creation ok
				$data->info = "New user created.";
				redirect('ManageUser/getUser', $data);

				$this->load->view('templates/header');
				$this->load->view('ManageUser/getUser', $data);
				$this->load->view('templates/footer');
				
			} else {

				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				redirect('ManageUser/getUser', $data);
				
				// send error to the view
				$this->load->view('templates/header');
				$this->load->view('ManageUser/getUser', $data);
				$this->load->view('templates/footer');
				
			}
			
		}
		
	}
		
	/**
	 * updateUser function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updateUser($user_id) {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){

			if(isset($_SESSION['s_user_type']) == 1)
				$user = $this->user_model->get_user($user_id);
			else
				$user = $this->user_model->get_user($_SESSION['s_user_id']);

			$data->user_id = (int)$user->user_id;
			$data->user_flname = (string)$user->user_flname;
			$data->user_name = (string)$user->user_name;
			$data->type_id = (int)$user->type_id;
			$data->type_name = (string)$user->type_name;
			$data->user_bd = (string)$user->user_bd;
			$data->user_photo = (string)$user->user_photo;
			$data->user_email = (string)$user->user_email;
			$data->user_address = (string)$user->user_address;
			$data->user_create = (string)$user->user_create;

			$user_type = $this->usertype_model->get_user_type();
			$data->user_type_obj = $user_type;

			$this->load->view('templates/header');
			
			if(isset($_SESSION['s_user_type']) == 1)
				$this->load->view('authens/UpdateUser', $data);
			else
				$this->load->view('authens/ChangeProfile', $data);

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
	 * getUserDetail function.
	 */
	public function getUserDetail($user_id) {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if(isset($_SESSION['s_user_id'])){

			if(isset($_SESSION['s_user_type']) == 1)
				$user = $this->user_model->get_user($user_id);
			else
				$user = $this->user_model->get_user($_SESSION['s_user_id']);

			$data->user_id = (int)$user->user_id;
			$data->user_flname = (string)$user->user_flname;
			$data->user_name = (string)$user->user_name;
			$data->type_id = (int)$user->type_id;
			$data->type_name = (string)$user->type_name;
			$data->user_bd = (string)$user->user_bd;
			$data->user_photo = (string)$user->user_photo;
			$data->user_email = (string)$user->user_email;
			$data->user_address = (string)$user->user_address;
			$data->user_create = (string)$user->user_create;
			$data->user_edited = (string)$user->user_edited;

			$this->load->view('templates/header');
			if(isset($_SESSION['s_user_type']) == 1)
				$this->load->view('authens/DetailUser', $data);
			else
				$this->load->view('authens/ProfileUser', $data);
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
	 * updatingUser function.
	 * 
	 * @access public
	 * @return void
	 */
	public function updatingUser() {
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		$user_id = $this->input->post('i_userid');
		$user_flname = $this->input->post('i_flname');
		$user_email = $this->input->post('i_email');
		$user_address = $this->input->post('i_address');
		$user_bd = $this->input->post('i_birthday');

		if(isset($_SESSION['s_user_id'])){
			$result = $this->user_model->update_user($user_id, $user_flname, $user_email, $user_address, $user_bd);
			if($result){
				$data->info = "Updated user information.";
				if(isset($_SESSION['s_user_type']) == 1)
					redirect('ManageUser/getUser');
				redirect('authens/MainUser');
			}else{
				$data->error = 'User information is wrong.';
				redirect('ManageUser/updateUser/'.$user_id);
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
	 * getUser function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getUser($offset = 0, $key = '') {
		
		// create the data object
		$data = new stdClass();

		$key = $this->input->post('i_key');

		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {
	        //how many blogs will be shown in a page
	        $limit = 10;

	        $result = $this->user_model->get_users_pg($limit, $offset, $key);

	        // load pagination library
	        $this->load->library('pagination');
	        $config = array();
	        $config['base_url'] = site_url("ManageUser/getUser/");
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

	        $data->user_pg = $this->pagination->create_links();

			// select all user data
			$user = $this->user_model->get_users($key);
			$data->user_obj = $user;

			// select all user type data
			$user_type = $this->usertype_model->get_user_type();
			$data->user_type_obj = $user_type;

			$this->load->view('templates/header');
			$this->load->view('authens/ManageUser', $data);
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
	public function deleting($user_id) {

		if(isset($user_id) && $user_id != 1){

			// create the data object
			$data = new stdClass();

			$user = $this->user_model->delete_user($user_id);
			$data->user_obj = $user;
			$data->info = "Deleted user successfully.";

		} else {

			echo "Permission denied.";

		}

		redirect('ManageUser/getUser');

	}
	
}