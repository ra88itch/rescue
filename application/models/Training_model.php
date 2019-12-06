<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Training_model extends CI_Model {

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
			//$where_params['team_id'] = $user->team_id;
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
			$this->db->like('code', $search);
			$this->db->or_like('name', $search);
			$this->db->or_like('trainer', $search);
			$this->db->group_end();
		}
		$this->db->order_by('training_date','desc');
		$this->db->limit('20', $index);

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}
		return $return;
	}

	function count_lists($user, $get_param=false){
		$return = false;

		if($user->type > 10){
			//$where_params['team_id'] = $user->team_id;
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
			$this->db->like('code', $search);
			$this->db->or_like('name', $search);
			$this->db->or_like('trainer', $search);
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

	function get_detail2($profile_id){
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

	function create_profile($post){
		$this->db->insert('profile', $post);
		$profile_id = $this->db->insert_id();

		$profile_detail_param = array('id', $profile_id);
		$this->db->insert('profile_detail', $profile_detail_param);
	}

	function update_profile($post){
		$this->db->where('id', $post['id']);
		$this->db->update('profile', $post);
	}

	function set_profile_status($post, $status){
		$where_params['status'] = $status;

		$this->db->where('id', $post['id']);
		$this->db->update('profile', $where_params);
	}


	/*********************************************/
	/*******  COMPLETE STRUCTURE FUNCTION  *******/
	/*********************************************/
	function get_structure($user){
		$return = new stdClass;
		$return->team = $this->get_team($user);

		return $return;
	}

	private function get_training($user){
		$return = false;

		if($user->type > 10){
			$where_params['id'] = $user->team_id;
		}

		$this->db->select('*');
		$this->db->from('team_)training');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		$this->db->order_by('training_date','desc');
		//$this->db->order_by('id','asc');	
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}

		return $return;
	}
}
