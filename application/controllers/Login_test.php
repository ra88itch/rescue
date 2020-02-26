<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_test extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
		if($this->input->post() != null){
			echo '_POST';
			echo '<pre>';
			var_dump($_POST);
			echo '</pre>';
		}
		if($this->input->get() != null){
			echo '_GET';
			echo '<pre>';
			var_dump($_GET);
			echo '</pre>';

		}
    }
}
