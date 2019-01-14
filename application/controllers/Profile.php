<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));	

		$this->load->model('system_model', '', TRUE);
		$cookie = $this->system_model->get_user_cookie();
		if($cookie == false){
			redirect();
		}else{			
			$this->lang->load('default','thai');
		}
		$this->response = $this->config->item('response');
    }

    public function index() {
		$this->response['active_nav'] = 'dashboard';
		
		

		$this->load->view('dashboard', $this->response);
    }
}
