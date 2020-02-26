<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TeamAccount extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));
		$this->load->model('team_account_model', '', TRUE);
		$this->load->model('system_model', '', TRUE);

		$this->user = $this->system_model->get_user_cookie();
		if($this->user == false){
			redirect('login');
		}

		$this->current_location = 'teamAccount';

		if($this->input->post() != null){
			//var_dump($this->input->post());

			$this->errorAction = 'failed';
			$submit = $this->input->post('submit');


			if($submit == ''){
				$submit = $this->input->post('do');
				UNSET($_POST['do'], $_POST['image-data']);		
			}else{
				UNSET($_POST['submit'], $_POST['image-data']);
			}

			$post = $this->input->post();
			$post['team_id'] = $this->user->team_id;
			
			switch(strtolower($submit)){
				case 'create':
					$do = $this->do_create($post);
					break;

				case 'update':
					$do = $this->do_update($post);
					break;

				case 'delete':
					$do = $this->do_delete($post);
					break;
			}
			$this->errorCode = $do->errorCode;
			$this->errorAction = $do->errorAction;
			$this->errorDesc = $this->system_model->get_error_desc($do->errorCode);
		}
    }

    public function index() {
		redirect('teamAccount/lists');
    }
	
	function lists($index = 1) {
		$response = $this->config->item('response');
		$response['js'][] = 'teamAccount.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= $this->current_location;
		$response['title'] = 'Team Account - '.$response['title'];

		if($this->input->post() != null){
			$response['errorCode'] = $this->errorCode;
			$response['errorAction'] = $this->errorAction;	
			$response['errorDesc'] = $this->errorDesc;
		}
		$structure = $this->team_account_model->get_structure($this->user);
		$response['team'] = $this->system_model->convert_object($structure->team, 'fullname');

		$response['lists'] = $this->team_account_model->get_lists($this->user, $this->input->get(), $index);
		$response['count_lists'] = $this->team_account_model->count_lists($this->user, $this->input->get());

		$response['pagination'] = $this->create_pagination($response);	
		$response['user'] = $this->user;

//		echo '<pre>';
//		var_dump($response);
//		echo '</pre>';

		$this->load->view('teamAccount/lists', $response);
    }

	function create(){
		$response = $this->config->item('response');
		$response['js'][] = 'jquery.validate.min.js';
		$response['js'][] = 'teamAccount.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= $this->current_location;
		$response['title'] = 'Create Team Account Profile - '.$response['title'];

		if($this->input->post() != null){
			$response['errorCode'] = $this->errorCode;
			$response['errorAction'] = $this->errorAction;	
			$response['errorDesc'] = $this->errorDesc;
		}
		$structure = $this->team_account_model->get_structure($this->user);
		$response['team'] = $structure->team;

		$response['user'] = $this->user;
		$this->load->view('teamAccount/form', $response);	
	}

	function edit($team_account_id = false){
		$response = $this->config->item('response');
		$response['js'][] = 'jquery.validate.min.js'; 
		$response['js'][] = 'teamAccount.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= $this->current_location;
		$response['title'] = 'Edit Team Account Profile - '.$response['title'];

		if($this->input->post() != null){
			$response['errorCode'] = $this->errorCode;
			$response['errorAction'] = $this->errorAction;	
			$response['errorDesc'] = $this->errorDesc;
		}

		$detail = $this->team_account_model->get_detail($team_account_id);
		$response['detail'] = $detail;
		if($detail == false || $detail->team_id != $this->user->team_id){
			redirect('error/404');
		}
		$structure = $this->team_account_model->get_structure($this->user);
		$response['team'] = $structure->team;
	
		$response['user'] = $this->user;
		$response['referrer'] = $this->agent->referrer();
		$this->load->view('teamAccount/form', $response);	
	}

	private function create_pagination($response){
		$count_lists	= $response['count_lists'];
		$base_url		= $response['root'] . 'teamAccount/lists';

		$this->load->library('pagination');
		$pagination_config['per_page'] = 20;
		$pagination_config['total_rows'] = $count_lists;
		$pagination_config['base_url'] = $base_url;
		$this->pagination->initialize($pagination_config);

		return $this->pagination->create_links();
	
	}

	private function do_create($post){
		$return = new stdClass;
		$return->errorCode = 0;
		$return->errorAction = 'success';

		$structure = $this->team_account_model->create($post);
		return $return;
	
	}

	private function do_update($post){
		$return = new stdClass;
		$return->errorCode = 0;
		$return->errorAction = 'success';

		$structure = $this->team_account_model->update($post);
		return $return;
	}

	private function do_delete($post){
		$return = new stdClass;
		$return->errorCode = 0;
		$return->errorAction = 'success';

		
		$structure = $this->team_account_model->delete($post);
		return $return;
	}
}
