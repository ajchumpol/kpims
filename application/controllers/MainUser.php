<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * MainUser class.
 * 
 * @extends CI_Controller
 */
class MainUser extends CI_Controller {

	public function index() {
		$this->load->library('session');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('user_model');

		if(isset($_SESSION['s_user_id'])){

			$data = new stdClass();

		  	$user = $this->user_model->get_user($_SESSION['s_user_id']);

		  	$data->user_id = (int)$user->user_id;
		  	$data->user_name = (string)$user->user_name;
		  	$data->type_name = (string)$user->type_name;
		  	$data->user_bd = (string)$user->user_bd;
		  	$data->user_photo = (string)$user->user_photo;
		  	$data->user_email = (string)$user->user_email;
		  	$data->user_create = (string)$user->user_create;

			$this->load->view('templates/header');
			$this->load->view('authens/MainUser', $data);
			$this->load->view('templates/footer');

		} else {

			redirect('/');

		}
	}
	
}