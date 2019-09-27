<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Team_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	/*********************************************/
	/*******    COMPLETE AUTH FUNCTION    ********/
	/*********************************************/

	function get_lists($user, $get_param=false, $index=1){
		$return = false;
		$index = ( $index - 1 ) * 6;

		if($user->type > 10){
			$where_params['team_id'] = $user->team_id;
		}
		if(isset($get_param['search']) && $get_param['search'] != ''){
			$search = $get_param['search'];
		}

		$this->db->select('*');
		$this->db->from('profile');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		if(isset($search) && $search != ''){
			$this->db->group_start();
			$this->db->like('nickname', $search);
			$this->db->or_like('firstname', $search);
			$this->db->or_like('lastname', $search);
			$this->db->group_end();
		}
		$this->db->order_by('status','asc');	
		$this->db->order_by('team_account','asc');	
		$this->db->order_by('id','asc');	
		$this->db->limit('6', $index);

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}
		return $return;
	}

	function count_lists($user, $get_param=false){
		$return = false;

		if($user->type > 10){
			$where_params['team_id'] = $user->team_id;
		}
		if(isset($get_param['search']) && $get_param['search'] != ''){
			$search = $get_param['search'];
		}

		$this->db->select('*');
		$this->db->from('profile');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		if(isset($search) && $search != ''){
			$this->db->group_start();
			$this->db->like('nickname', $search);
			$this->db->or_like('firstname', $search);
			$this->db->or_like('lastname', $search);
			$this->db->group_end();
		}

		$query = $this->db->get();	
		$return = $query->num_rows();
		return $return;
	}

	function get_detail($profile_id){
		$return = false;

		$this->db->select('*');
		$this->db->from('profile');		
		$this->db->where('id', $profile_id);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->row();
		}
		return $return;
	}

	function get_detail_contact($profile_id){
		$return = false;

		$this->db->select('*');
		$this->db->from('profile_detail');		
		$this->db->where('id', $profile_id);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->row();
		}
		return $return;
	}

	function get_detail_training($profile_id){
		$return = false;

		$this->db->select('*');
		$this->db->from('profile_training');		
		$this->db->where('profile_id', $profile_id);

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}
		return $return;
	}

	function get_detail_vehicle($profile_id){
		$return = false;

		$this->db->select('*');
		$this->db->from('profile_vehicle');		
		$this->db->where('profile_id', $profile_id);

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}
		return $return;
	}

	function create_profile($post){
		$profile_param = $post;		
		UNSET($profile_param['profile_detail'], $profile_param['profile_training'], $profile_param['profile_vehicle']);

		$this->team_account_init($post['team_account']);

		$this->db->insert('profile', $profile_param);
		$profile_id = $this->db->insert_id();

		$profile_detail_param = array(
			'id'		=> $profile_id,
			'basic'		=> json_encode($post['profile_detail']['basic']),
			'contact'	=> json_encode($post['profile_detail']['contact']),
			'address'	=> json_encode($post['profile_detail']['address']),
			'education' => json_encode($post['profile_detail']['education']),
			'insurance' => json_encode($post['profile_detail']['insurance'])
		);
		$this->db->insert('profile_detail', $profile_detail_param);
	}

	function update_profile($post){	
		$this->update_profile_detail($post);
		$this->update_profile_training($post);
		$this->update_profile_vehicle($post);
		UNSET($post['profile_detail'], $post['profile_training'], $post['profile_vehicle']);

		$this->team_account_init($post['team_account']);
		
		$this->db->where('id', $post['id']);
		$this->db->update('profile', $post);
	}

	function update_profile_detail($post){
		$post['profile_detail']['address']['current_address'] = $this->clearText($post['profile_detail']['address']['current_address']);
		$post['profile_detail']['address']['address'] = $this->clearText($post['profile_detail']['address']['address']);
		$profile_detail_param = array(		
			'basic'		=> json_encode($post['profile_detail']['basic']),
			'contact'	=> json_encode($post['profile_detail']['contact']),
			'address'	=> json_encode($post['profile_detail']['address']),
			'education' => json_encode($post['profile_detail']['education']),
			'insurance' => json_encode($post['profile_detail']['insurance'])
		);

		$this->db->where('id', $post['id']);
		$this->db->update('profile_detail', $profile_detail_param);
	}

	function update_profile_training($post){
		if(!isset($post['profile_training'])){
			return false;
		}
		$profile_training = $post['profile_training'];

		foreach($profile_training AS $value){
			$do = strtolower($value['do']);
			UNSET($value['do']);
			switch($do){
				case 'delete':
					if($value['id'] != ''){
						$this->db->where('id', $value['id']);
						$this->db->delete('profile_training');				
					}
					break;
				case 'add':	
					if($value['training_id'] != ''){
						$profile_training_param = array(
							'profile_id'	=> $post['id'],
							'training_id'	=> $value['training_id']
						);
						$this->db->insert('profile_training', $profile_training_param);
					}
					break;
				default:
					if($value['id'] != ''){
						$this->db->where('id', $value['id']);
						$this->db->update('profile_training', $value);
					}
					break;
			}
		}
	}

	function update_profile_vehicle($post){	
	}

	function set_profile_status($post, $status){
		$where_params['status'] = $status;

		$this->db->where('id', $post['id']);
		$this->db->update('profile', $where_params);
	}

	function team_account_init($team_account){
		if($team_account > 0 && $team_account < 4294967295){
			$where_params = array('team_account'=>'4294967295');			

			$this->db->where('team_account', $team_account);
			$this->db->update('profile', $where_params);
		}	
	}


	/*********************************************/
	/*******  COMPLETE STRUCTURE FUNCTION  *******/
	/*********************************************/
	function get_structure($user){
		$return = new stdClass;
		$return->team = $this->get_team($user);
		$return->blood = $this->get_blood();
		$return->religion = $this->get_religion();
		$return->status = $this->get_status();
		$return->team_account = $this->get_team_account($user);
		$return->team_training = $this->get_team_training($user); //get_team_training
		return $return;
	}

	private function get_team($user){
		$return = false;

		if($user->type > 10){
			$where_params['id'] = $user->team_id;
		}

		$this->db->select('*');
		$this->db->from('team');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		$this->db->order_by('id','asc');	
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}

		return $return;
	}

	private function get_blood(){
		$return = false;

		$this->db->select('*');
		$this->db->from('setting_blood');
		$this->db->order_by('id','asc');	
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}

		return $return;
	}

	private function get_religion(){
		$return = false;

		$this->db->select('*');
		$this->db->from('setting_religion');
		$this->db->order_by('id','asc');	
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}

		return $return;
	}

	private function get_status(){
		$return = false;

		$this->db->select('*');
		$this->db->from('setting_status');
		$this->db->order_by('id','asc');	
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}

		return $return;
	}

	private function get_team_account($user){
		$return = false;

		if($user->type > 10){
			$where_params['team_id'] = $user->team_id;
		}

		$this->db->select('*');
		$this->db->from('team_account');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		$this->db->order_by('id','asc');	
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}

		return $return;
	}

	private function get_team_training($user){
		$return = false;

		if($user->type > 10){
			$where_params['team_id'] = $user->team_id;
			$or_where_params['team_id'] = 0;
		}

		$this->db->select('*');
		$this->db->from('team_training');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		if(isset($or_where_params)){
			$this->db->or_where($or_where_params);		
		}
		$this->db->order_by('id','asc');	
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}

		return $return;
	}

	private function clearText($text){
		$text = str_replace('\r\n', ' ', $text);
		$text = str_replace('\t\t', ' ', $text);
		$text = str_replace('\t', ' ', $text);
		return $text;
	}

	

}
