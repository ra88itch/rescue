<?php
// admin
// password

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));	

		$this->load->model('system_model', '', TRUE);
		$user = $this->system_model->get_user_cookie();
		if($user != false){
			redirect('team');
		}
    }

    public function index() {
		$response = $this->config->item('response');
		$response['js'][] = 'login.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= 'login';
		$response['title'] = 'Login '.$response['title'];

		if($this->input->post() != null && $this->input->post('submit') == 'login'){
			$response['errorAction'] = 'failed';

			$response['post'] = $this->input->post();
			if($this->input->post('username') == '' || $this->input->post('password') == ''){
				$response['errorCode'] = '101';

			}else{
				$response['errorCode'] = '103';

				$this->load->model('manager_model', '', TRUE);
				$login = $this->manager_model->login($this->input->post());
				if($login != false){
					if($login->status == 1){
						$this->system_model->set_user_cookie($login);
						
						$response['errorCode'] = '0';
						$response['errorAction'] = 'success';	
						
					}else{
						$response['errorCode'] = '104';
								
					}				
				}			
			}
			
			$response['errorDesc'] = $this->system_model->get_error_desc($response['errorCode']);
		}
		$this->load->view('login', $response);
    }
}
