<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));	
    }

    public function index() {
		redirect('roundcube');
    }
}
