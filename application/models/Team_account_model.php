<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Team_account_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	/*********************************************/
	/*******    COMPLETE AUTH FUNCTION    ********/
	/*********************************************/

	function get_lists($user, $get_param=false, $index=1){
		$return = false;
		$index = ( $index - 1 ) * 20;

		if($user->type > 10){
			$where_params['team_id'] = $user->team_id;
		}
		if(isset($get_param['search']) && $get_param['search'] != ''){
			$search = $get_param['search'];
		}

		$this->db->select('*');
		$this->db->from('team_account');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		if(isset($search) && $search != ''){
			$this->db->group_start();
			$this->db->like('name', $search);
			$this->db->group_end();
		}
		$this->db->order_by('name','asc');	
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
			$where_params['team_id'] = $user->team_id;
		}
		if(isset($get_param['search']) && $get_param['search'] != ''){
			$search = $get_param['search'];
		}

		$this->db->select('*');
		$this->db->from('team_account');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		if(isset($search) && $search != ''){
			$this->db->group_start();
			$this->db->like('name', $search);
			$this->db->group_end();
		}

		$query = $this->db->get();	
		$return = $query->num_rows();
		return $return;
	}

	function get_detail($profile_id){
		$return = false;

		$this->db->select('*');
		$this->db->from('team_account');		
		$this->db->where('id', $profile_id);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->row();
		}
		return $return;
	}

	function create($post){
		$profile_param = $post;
		$this->db->insert('team_account', $profile_param);
		$profile_id = $this->db->insert_id();
	}

	function update($post){			
		$this->db->where('id', $post['id']);
		$this->db->update('team_account', $post);
	}

	function delete($post){			
		$this->db->where('id', $post['id']);
		$this->db->delete('team_account');
	}



	/*********************************************/
	/*******  COMPLETE STRUCTURE FUNCTION  *******/
	/*********************************************/
	function get_structure($user){
		$return = new stdClass;
		$return->team = $this->get_team($user);
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
}
