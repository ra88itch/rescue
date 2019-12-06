<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Manager_model extends CI_Model {

    function __construct() {
        parent::__construct();

		$this->load->library(array('encrypt'));
		$this->load->helper(array('cookie'));
    }

	
	/*********************************************/
	/*******       COMPLETE FUNCTION      ********/
	/*********************************************/

	function login($params){
		$return = false;

		$where_params = array('username'=>$params['username'],
			'password'=>MD5($params['password']));

		$this->db->select('*');
		$this->db->from('manager');		
		$this->db->where($where_params);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->row();
			UNSET($return->password);
		}
		return $return;
	}

	function get_list($index=1, $search=''){
		$return = false;
		$index = ( $index - 1 ) * 20;

		$this->db->select('*');
		$this->db->from('manager');
		if($search != ''){
			$this->db->like('username', $search);
		}
		$this->db->limit('20', $index);

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->result();
		}
		return $return;
	}

	function count_all_list($search=''){
		$return = false;

		if($search != ''){
			$where_params['username'] = $search;
		}

		$this->db->select('*');
		$this->db->from('manager');
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

	function get_manager_detail($manager_id){
		$return = false;

		$this->db->select('*');
		$this->db->from('manager');		
		$this->db->where('id', $manager_id);
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
	function avaliable_manager_username($username){
		$return = true;		

		$this->db->select('*');
		$this->db->from('manager');		
		$this->db->where('username', $username);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = false;
		}
		return $return;
	}

	function create($params){
		$this->db->insert('manager', $params);
		return $this->db->insert_id();
	}

	function edit($params, $manager_id){
		$this->db->where('id', $manager_id);
		$this->db->update('manager', $params);
	}

    /*********************************************/
	/*****  COMPLETE ADMIN COOKIES FUNCTION  *****/
	/*********************************************/	
	
	private function set_cookie($user) {
        $user = $this->encrypt->encode(serialize($user));
		$expires = ( 60 * 60 * 24 * 365) / 12;
		$expires = '0';

		set_cookie('threscmanager', $user, $expires);
    }

	private function get_cookie() {
        $user = get_cookie('threscmanager', true);
        if ($user != null) {
            $user = $this->encrypt->decode($user);
            $user = @unserialize($user);
            return $user;
        }
        return false;
    }

    private function unset_cookie() {
        delete_cookie('threscmanager');
    }

}
