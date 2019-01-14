<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

		// load library
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('cookie','url'));	

		$this->load->model('user_model', '', TRUE);
		$cookie = $this->user_model->get_user_cookie();
		if($cookie == false){
			redirect();
		}elseif($cookie->level > '1'){
			redirect('permissionRequest');
		}
		
		if ($this->agent->is_mobile()){
			redirect('material/requrest');
		}
    }

    public function index() {
		redirect('user/lists');
	}

    public function lists($index = 1) {
		$response = $this->config->item('response');
		$response['profile'] = $this->user_model->get_user_cookie();
		$response['title'] = 'User List '.$response['title'];
		$response['active_nav'] = 'user';


		$level = 0;
		$search = '';
		if($index < 1){
			$index = 1;
		}
		if(isset($_GET['level'])){
			$level = $_GET['level'];
		}
		if(isset($_GET['search'])){
			$search = $_GET['search'];
		}
		$response['user_list'] = $this->user_model->get_list($index, $level, $search);
		$response['count_user_list'] = $this->user_model->count_list($level, $search);
		$response['user_structure'] = $this->user_model->get_structure();

		$this->load->library('pagination');
		$pagination_config['per_page'] = 4;
		$pagination_config['total_rows'] = $response['count_user_list'];
		$pagination_config['base_url'] = $response['root'] . 'user/lists';
		$this->pagination->initialize($pagination_config);
		$response['pagination'] = $this->pagination->create_links();

		$this->load->view('user', $response);
    }

	function create(){
		$response = $this->config->item('response');
		$response['profile'] = $this->user_model->get_user_cookie();
		$response['title'] = 'Create User '.$response['title'];
		$response['active_nav'] = 'user';

		if(isset($_POST) && $_POST!=null){
			if($_POST['username'] == ''){
				$response['error_massage'] = 'Empty USERNAME !';
				$response['error_class'] = 'danger'; 
			}else{
				$_POST['username'] = strtolower($_POST['username']);
			}

			if(!isset($response['error_massage'])){
				$username_avaliable = $this->user_model->username_avaliable($_POST['username']);
				if($username_avaliable == false){
					$response['error_massage'] = $_POST['username'].' has been already to used.';
					$response['error_class'] = 'warning'; 				
				}
			}

			
			if(!isset($response['error_massage'])){
				if($_POST['password'] != ''){				
					$_POST['password'] = MD5($_POST['password']);
				}elseif($_POST['password'] == ''){
					$response['error_massage'] = 'Empty PASSWORD !';
					$response['error_class'] = 'danger'; 				
				}			
			}

			if(!isset($response['error_massage']) && $_FILES['fileToUpload']['size']>0){
				$config['upload_path']          = 'uploads/images';
				$config['allowed_types']        = 'jpg|jpeg|png';
				$config['max_size']             = 2048;

				if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('fileToUpload')) {
					$response['error_massage'] = $this->upload->display_errors();
					$response['error_class'] = 'warning'; 
				} else {
					$client_name = $this->upload->data('file_name');
					$_POST['image'] = $client_name;
				}						
			}	

			if(!isset($response['error_massage'])){
				$_POST['create_by'] = $response['profile']->id;
				$createID = $this->user_model->create($_POST);
				redirect('user/view/'.$createID);
				$response['error_massage'] = 'Create Success !';
				$response['error_class'] = 'success'; 
			}	
		}

		$response['user_structure'] = $this->user_model->get_structure();

		$this->load->view('userForm', $response);
	
	}

	function edit($user_id=false){
		$response = $this->config->item('response');
		$response['profile'] = $this->user_model->get_user_cookie();
		$response['title'] = 'Edit User '.$response['title'];
		$response['active_nav'] = 'user';

		if(isset($_POST) && $_POST!=null){
			UNSET($_POST['username']);

			if($_POST['password'] != ''){				
				$_POST['password'] = MD5($_POST['password']);
			}else{
				UNSET($_POST['password']);
			}

			if($user_id=='1' && $_POST['status']=='0'){
				$response['error_massage'] = 'Can not Disable this user !';
				$response['error_class'] = 'danger'; 			
			}

			if($_FILES['fileToUpload']['size']>0){
				$config['upload_path']          = 'uploads/images';
				$config['allowed_types']        = 'jpg|jpeg|png';
				$config['max_size']             = 2048;

				if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('fileToUpload')) {
					$response['error_massage'] = $this->upload->display_errors();
					$response['error_class'] = 'warning'; 
				} else {
					$client_name = $this->upload->data('file_name');
					$_POST['image'] = $client_name;
				}						
			}

			if(!isset($response['error_massage'])){
				$this->user_model->edit($_POST, $user_id);
				$response['error_massage'] = 'Update success !';
				$response['error_class'] = 'success'; 
			}
		}
		
		$response['user_detail'] = $this->user_model->get_detail($user_id);
		if($response['user_detail']==false){
			redirect('user/create');
		}
		$response['user_structure'] = $this->user_model->get_structure();

		$this->load->view('userForm', $response);	
	}

	function view($user_id=false){
		$response = $this->config->item('response');
		$response['profile'] = $this->user_model->get_user_cookie();
		$response['title'] = 'View User '.$response['title'];
		$response['active_nav'] = 'user';

		if(isset($_POST) && $_POST!=null){
			if(!isset($response['error_massage'])){
				$this->user_model->edit($_POST, $user_id);
				$response['error_massage'] = 'Change status success !';
				$response['error_class'] = 'success'; 
			}
		}
		
		$response['user_detail'] = $this->user_model->get_detail($user_id);
		if($response['user_detail']==false){
			redirect('user/create');
		}

		$response['user_structure'] = $this->user_model->get_structure();

		$this->load->view('userView', $response);	
	}

	function delete($id=false){
		$response['profile'] = $this->user_model->get_user_cookie();

		if($response['profile']->level > '1'){
			redirect('permissionRequest');
		}
		$this->user_model->del($id);
		redirect('user/lists');	
	}

}
