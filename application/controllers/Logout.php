<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));	
		$this->load->model('system_model', '', TRUE);
    }

	// 100% Complete
	public function index(){
		$this->system_model->unset_user_cookies();
		redirect();
	}
}
