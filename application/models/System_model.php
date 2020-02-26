<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class System_model extends CI_Model {

    function __construct() {
        parent::__construct();

		$this->load->library(array('encrypt'));
		$this->load->helper(array('cookie'));
    }

	/*********************************************/
	/*******   COMPLETE COOKIE FUNCTION   ********/
	/*********************************************/

	function get_error_desc($errorCode){
		$return = false;

		$where_params = array('errorCode'=>$errorCode);

		$this->db->select('*');
		$this->db->from('error');		
		$this->db->where($where_params);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$return = $row->errorDesc;
		}
		return $return;
	}

	function set_user_cookie($params) {
        $user = $this->encrypt->encode(serialize($params));
		$expires = '0';
		set_cookie('threscmanager', $user, $expires);
    }

	function get_user_cookie() {
        $user = get_cookie('threscmanager', true);
        if ($user != null) {
            $user = $this->encrypt->decode($user);
            $user = @unserialize($user);
            return $user;
        }
        return false;
    }
	
	function unset_user_cookies() {
        delete_cookie('threscmanager');
    }

	function convert_object($object, $obj_name = 'name'){
		if($object === false){
			return false;
		}
		$array		= json_decode(json_encode($object), TRUE);
		$id			= array_column($array, 'id');
		if($obj_name == 'all'){
			$name		= $object;
		}else{
			$name		= array_column($array, $obj_name);
		}
		$return		= array_combine($id, $name);

		return $return;
	}
}
