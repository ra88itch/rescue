<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));
		$this->load->model('setting_model', '', TRUE);
		$this->load->model('system_model', '', TRUE);

		$this->user = $this->system_model->get_user_cookie();
		// var_dump($this->user);
		if($this->user == false){
			redirect('login');
		}

		$this->current_location = 'profile';

		if($this->input->post() != null){
			//var_dump($this->input->post());

			$this->errorAction = 'failed';
			$submit = $this->input->post('submit');

			if($submit == ''){
				$submit = $this->input->post('do');
				UNSET($_POST['do']);		
			}else{
				UNSET($_POST['submit']);
			}

			$post = $this->input->post();
			
			switch(strtolower($submit)){
				case 'update':
					$do = $this->do_update($post);
					break;

			}
			$this->errorCode = $do->errorCode;
			$this->errorAction = $do->errorAction;
			$this->errorDesc = $this->system_model->get_error_desc($do->errorCode);
		}
    }
	
	function index() {
		$response = $this->config->item('response');
		// $response['js'][] = 'team.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= $this->current_location;
		$response['title'] = 'Profile - '.$response['title'];

		if($this->input->post() != null){
			$response['errorCode'] = $this->errorCode;
			$response['errorAction'] = $this->errorAction;	
			$response['errorDesc'] = $this->errorDesc;
		}
		
		$detail = $this->setting_model->get_team($this->user);
		$response['detail'] = $detail;

		$response['user'] = $this->user;
		$this->load->view('profile', $response);
    }

	private function do_update($post){
		$return = new stdClass;
		$return->errorCode = 106;
		$return->errorAction = 'failed';

		if($post['password'] != ''){
			$post['password'] = md5($post['password']);

			// var_dump($post);
		
			$this->db->where('id', $this->user->id);
			$this->db->update('manager', $post);

			$return->errorCode = 0;
			$return->errorAction = 'success';
		}
		return $return;
	}
}
