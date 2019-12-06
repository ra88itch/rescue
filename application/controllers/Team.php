<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Team extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));
		$this->load->model('team_model', '', TRUE);
		$this->load->model('system_model', '', TRUE);

		$this->user = $this->system_model->get_user_cookie();
		if($this->user == false){
			redirect('login');
		}

		$this->current_location = 'team';

		if($this->input->post() != null){
			//var_dump($this->input->post());

			$this->errorAction = 'failed';
			$submit = $this->input->post('submit');
			
			$empty_image_data = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMYAAAEJCAYAAADPUliIAAAA40lEQVR4nO3BMQEAAADCoPVPbQ0PoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4MAANQ4AAUw3uNQAAAAASUVORK5CYII=';

			//echo $_POST['image-data'];

			if($_POST['image-data'] != $empty_image_data){
				$image_name = md5(DATE('Y-m-d H:i:s')).'.png';
				$_POST['image'] = $image_name;

				$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['image-data']));
				$img_path = './assets/uploads/'.$image_name;
				file_put_contents($img_path, $data);
			}

			if($submit == ''){
				$submit = $this->input->post('do');
				UNSET($_POST['do'], $_POST['image-data']);		
			}else{
				UNSET($_POST['submit'], $_POST['image-data']);
			}

			$post = $this->input->post();
			$post['hotline'] = $post['profile_detail']['contact']['mobile'];
			
			switch(strtolower($submit)){
				case 'create':
					$post['team_id'] = $this->user->team_id;
					$post['team_account'] = 4294967295;
					$do = $this->do_create($post);
					break;

				case 'update':
					$do = $this->do_update($post);
					break;

				case 'holiday':
					$do = $this->do_holiday($post);
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
		redirect('team/lists');
    }
	
	function lists($index = 1) {
		$response = $this->config->item('response');
		$response['js'][] = 'team.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= $this->current_location;
		$response['title'] = 'Team - '.$response['title'];

		if($this->input->post() != null){
			$response['errorCode'] = $this->errorCode;
			$response['errorAction'] = $this->errorAction;	
			$response['errorDesc'] = $this->errorDesc;
		}
		
		$structure = $this->team_model->get_structure($this->user);
		$response['team'] = $this->system_model->convert_object($structure->team);
		$response['blood'] = $this->system_model->convert_object($structure->blood);
		$response['religion'] = $this->system_model->convert_object($structure->religion);
		$response['status'] = $this->system_model->convert_object($structure->status);
		$response['team_account'] = $this->system_model->convert_object($structure->team_account);

		$response['lists'] = $this->team_model->get_lists($this->user, $this->input->get(), $index);
		$response['count_lists'] = $this->team_model->count_lists($this->user, $this->input->get());

		$response['pagination'] = $this->create_pagination($response);	
		$response['user'] = $this->user;
		$this->load->view('team/lists', $response);
    }

	function create(){
		$response = $this->config->item('response');
		$response['js'][] = 'jquery.validate.min.js'; 
		$response['js'][] = 'cropbox.js'; 
		$response['js'][] = 'team.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= $this->current_location;
		$response['title'] = 'Create Team Profile - '.$response['title'];

		if($this->input->post() != null){
			$response['errorCode'] = $this->errorCode;
			$response['errorAction'] = $this->errorAction;	
			$response['errorDesc'] = $this->errorDesc;
		}

		$structure = $this->team_model->get_structure($this->user);
		$response['team'] = $this->system_model->convert_object($structure->team, 'fullname');
		$response['team_account'] = $structure->team_account;
		$response['blood'] = $structure->blood;
		$response['religion'] = $structure->religion;
		$response['status'] = $structure->status;
		$response['training'] = $structure->team_training;

		$response['user'] = $this->user;
		$this->load->view('team/form', $response);	
	}

	function view($team_profile=false){
		if($team_profile==false){
			redirect('team/no-profile');
		}
		$response = $this->config->item('response');
		$response['js'][] = 'team.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= $this->current_location;
		$response['title'] = 'View Team Profile - '.$response['title'];

		if($this->input->post() != null){
			$response['errorCode'] = $this->errorCode;
			$response['errorAction'] = $this->errorAction;	
			$response['errorDesc'] = $this->errorDesc;
		}

		$response['detail'] = $this->team_model->get_detail($team_profile);		
		if($response['detail'] == false){
			redirect('team/no-profile');
		}elseif($response['detail']->team_id != $this->user->team_id){
			redirect('team/not-your-team');	
		}
		$response['detail_contact'] = $this->team_model->get_detail_contact($team_profile);
		$response['detail_training'] = $this->team_model->get_detail_training($team_profile);
		$response['detail_vehicle'] = $this->team_model->get_detail_vehicle($team_profile);

		$structure = $this->team_model->get_structure($this->user);
		$response['team'] = $this->system_model->convert_object($structure->team, 'fullname');
		$response['team_account'] = $this->system_model->convert_object($structure->team_account);
		$response['blood'] = $this->system_model->convert_object($structure->blood);
		$response['religion'] = $this->system_model->convert_object($structure->religion);
		$response['status'] = $this->system_model->convert_object($structure->status);
		$response['training'] = $this->system_model->convert_object($structure->team_training, 'all');
	
		$response['user'] = $this->user;
		$this->load->view('team/view', $response);	
	}

	function edit($team_profile=false){
		if($team_profile==false){
			redirect('team/no-profile');
		}
		$response = $this->config->item('response');
		$response['js'][] = 'jquery.validate.min.js'; 
		$response['js'][] = 'cropbox.js'; 
		$response['js'][] = 'team.js'; 
		UNSET($response['errorCode'], $response['errorDesc'], $response['errorAction']);

		$response['current_location']	= $this->current_location;
		$response['title'] = 'Edit Team Profile - '.$response['title'];

		if($this->input->post() != null){
			$response['errorCode'] = $this->errorCode;
			$response['errorAction'] = $this->errorAction;	
			$response['errorDesc'] = $this->errorDesc;
		}

		$response['detail'] = $this->team_model->get_detail($team_profile);
		if($response['detail'] == false || $response['detail']->team_id != $this->user->team_id){
			redirect('team/not-your-team');	
		}
		$response['detail_contact'] = $this->team_model->get_detail_contact($team_profile);
		$response['detail_training'] = $this->team_model->get_detail_training($team_profile);
		$response['detail_vehicle'] = $this->team_model->get_detail_vehicle($team_profile);

		$structure = $this->team_model->get_structure($this->user);
		$response['team'] = $this->system_model->convert_object($structure->team, 'fullname');
		$response['team_account'] = $structure->team_account;
		$response['blood'] = $structure->blood;
		$response['religion'] = $structure->religion;
		$response['status'] = $structure->status;
		$response['training'] = $structure->team_training;
	
		$response['user'] = $this->user;
		$this->load->view('team/form', $response);	
	}

	function noProfile(){
		echo 'noprofile';
	}

	function notYourTeam(){
		echo 'notYourTeam';
	}

	private function create_pagination($response){
		$count_lists	= $response['count_lists'];
		$base_url		= $response['root'] . 'team/lists';

		$this->load->library('pagination');
		$pagination_config['per_page'] = 6;
		$pagination_config['total_rows'] = $count_lists;
		$pagination_config['base_url'] = $base_url;
		$this->pagination->initialize($pagination_config);

		return $this->pagination->create_links();
	
	}

	private function do_create($post){
		$return = new stdClass;
		$return->errorCode = 0;
		$return->errorAction = 'success';

		$structure = $this->team_model->create_profile($post);
		return $return;
	
	}

	private function do_update($post){
		$return = new stdClass;
		$return->errorCode = 0;
		$return->errorAction = 'success';

		$structure = $this->team_model->update_profile($post);

		return $return;
	
	}

	private function do_holiday($post){
		$return = new stdClass;
		$return->errorCode = 0;
		$return->errorAction = 'success';

		
		$structure = $this->team_model->set_profile_status($post, '10');

		return $return;
	}

	private function do_delete($post){
		$return = new stdClass;
		$return->errorCode = 0;
		$return->errorAction = 'success';

		
		$structure = $this->team_model->set_profile_status($post, '100');

		return $return;
	}
}
