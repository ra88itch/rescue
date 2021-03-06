<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));	

		$this->load->model('system_model', '', TRUE);
		$user = $this->system_model->get_user_cookie();
		if($user != false){
			redirect('dashboard');
		}
    }

    public function index() {
		$response = $this->config->item('response');
		$response['current_location']	= 'register';
		$response['title'] = 'Register '.$response['title'];

		$this->load->view('register', $response);
    }
}
