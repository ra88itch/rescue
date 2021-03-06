<?php
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
			redirect('admin/team');
		}
    }

    public function index() {
		$response = $this->config->item('response');
		$response['title'] = 'Login '.$response['title'];
		
		//var_dump($response);
		$view = 'admin/login';
		if(isset($_GET['auth']) && $_GET['auth'] != ''){
			$this->load->model('user_model', '', TRUE);
			$login = $this->user_model->auth_login($_GET['auth']);
				var_dump($login);
			
			if($login != false){	
				if($login->status == '0'){
					// Block
					$view = 'block';
				}else{
					// Success
					$this->system_model->set_user_cookie($login);
					redirect('admin/team');
				}
			}
		}

		$this->load->view($view, $response);
    }
}
