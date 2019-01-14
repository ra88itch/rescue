<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class User_model extends CI_Model {

    function __construct() {
        parent::__construct();

		$this->load->library(array('encrypt'));
		$this->load->helper(array('cookie'));
    }

	/*********************************************/
	/*******    COMPLETE AUTH FUNCTION    ********/
	/*********************************************/

	function auth_login($params){
		$return = false;

		$where_params = array('auth_token'=>$params);

		$this->db->select('*');
		$this->db->from('user');		
		$this->db->where($where_params);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->row();
			$return->rescue = $this->get_rescue($return->rescue_id);
		}
		return $return;
	}

	
	/*********************************************/
	/*******   COMPLETE COOKIE FUNCTION   ********/
	/*********************************************/

	function login($params){
		$return = false;

		$where_params = array('username'=>$params['username'],
			'password'=>MD5($params['password']));

		$this->db->select('*');
		$this->db->from('user');		
		$this->db->where($where_params);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$response = $this->config->item('response');

			$return = $query->row();
			$return->level_text = $this->get_user_level($return->id);
			UNSET($return->password);
		}
		return $return;
	}

	function get_list($index=1, $level=0, $search=''){
		$return = false;
		$index = ( $index - 1 ) * 4;

		if($level > 0){
			$where_params['level'] = $level;		
		}

		$this->db->select('*');
		$this->db->from('user');
		if(isset($where_params)){			
            $this->db->group_start();
			$this->db->where($where_params);
			$this->db->group_end();		
		}		
		if($search != ''){
			//$like_params = array('username'=>$search, 'name'=>$search);
			//$this->db->like($like_params);
            $this->db->group_start();
			$this->db->like('name', $search);
			$this->db->or_like('username', $search);
			$this->db->group_end();
		}
		$this->db->limit('4', $index);

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}
		return $return;
	}

	function count_list($level=0, $search=''){
		$return = false;

		if($level > 0){
			$where_params['level'] = $level;		
		}

		if($search != ''){
			$where_params['username'] = $search;
			$or_where_params['username'] = $search;
		}

		$this->db->select('*');
		$this->db->from('user');
		if(isset($where_params)){
			$this->db->where($where_params);		
		}
		if(isset($or_where_params)){
			$this->db->or_where($or_where_params);		
		}
		$query = $this->db->get();	
		$return = $query->num_rows();
		return $return;
	}

	function get_detail($user_id){
		$return = false;

		$this->db->select('*');
		$this->db->from('user');		
		$this->db->where('id', $user_id);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->row();
		}
		return $return;
	}

	

	/*********************************************/
	/*******     COMPLETE FORM FUNCTION    *******/
	/*********************************************/
	function username_avaliable($username){
		$return = true;		

		$this->db->select('*');
		$this->db->from('user');		
		$this->db->where('username', $username);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = false;
		}
		return $return;
	}

	function create($params){
		$this->db->insert('user', $params);
		return $this->db->insert_id();
	}

	function edit($params, $user_id){
		$this->db->where('id', $user_id);
		$this->db->update('user', $params);
	}

	/*********************************************/
	/*******  COMPLETE STRUCTURE FUNCTION  *******/
	/*********************************************/
	function get_structure(){
		$return = (object) array();
		$return->level = $this->get_user_level();
		$return->position = $this->get_user_position();

		return $return;
	}

	private function get_rescue($id=''){
		$return = false;

		$this->db->select('*');
		$this->db->from('rescue');	
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {			
			if($id!=''){
				$return = $query->row();
			}else{
				$return = $query->result();
			}
		}
		return $return;
	}
}
