<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('User_Model');
		
	}
	
	
	public function index() {

	}
	
	/**
	 * validateUsername function.
	 */
	public function validateUsername() {
		
		// load form helper and validation library
		$this->load->helper('form');

		$username = $this->input->post('i_username');
		$email = $this->input->post('i_email');

		if ($this->User_Model->get_user_id_from_username($username, $email) > 0) {
			echo '{ "type": 1, "error": "This field is already registered. please choose another one." }';
		}else{
			echo '{ "type": 0, "error": "This field is valid." }';
		}

	}

	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('i_username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('i_email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('i_password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('i_password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('i_username');
			$email    = $this->input->post('i_email');
			$password = $this->input->post('i_password');
			
			if ($this->User_Model->create_user($username, $email, $password)) {
				
				// user creation ok
				$this->load->view('templates/header');
				$this->load->view('Login', $data);
				$this->load->view('templates/footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('templates/header');
				$this->load->view('Login', $data);
				$this->load->view('templates/footer');
				
			}
			
		}
		
	}
		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('i_username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('i_password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			redirect('/');
			$data->error = "Validation not ok.";
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('i_username');
			$password = $this->input->post('i_password');
			
			if ($this->User_Model->resolve_user_login($username, $password)) {
				$user_id = $this->User_Model->get_user_id_from_username($username);
				$user    = $this->User_Model->get_user($user_id);
				
				// set session user datas
				$_SESSION['s_user_id']      = (int)$user->user_id;
				$_SESSION['s_user_name']     = (string)$user->user_name;
				$_SESSION['s_user_logged_in']    = (bool)true;
				$_SESSION['s_user_confirmed'] = (bool)$user->user_confirmed;
				$_SESSION['s_user_type']     = (int)$user->type_id;
				
				// user login ok
				$data->user_id = (int)$user->user_id;
				$data->user_name = (string)$user->user_name;
				$data->type_name = (string)$user->type_name;
				$data->user_bd = (string)$user->user_bd;
				$data->user_photo = (string)$user->user_photo;
				$data->user_email = (string)$user->user_email;
				$data->user_create = (string)$user->user_create;

				redirect('MainUser');

				$this->load->view('templates/header');
				$this->load->view('authens/MainUser', $data);
				$this->load->view('templates/footer');
					
			} else {
				
				// login failed
				$data->error = 'Login failed wrong username or password, Please try again later.';
				
				// send error to the view
				$this->load->view('templates/header');
				$this->load->view('Login', $data);
				$this->load->view('templates/footer');
				
			}
			
		}
		
	}
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['s_user_logged_in']) && $_SESSION['s_user_logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->view('templates/header');
			$this->load->view('Login', $data);
			$this->load->view('templates/footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
		
	}
	
} // end class
