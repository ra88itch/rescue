<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Setting_model extends CI_Model {

    function __construct() {
        parent::__construct();

	}
	
	function get_team($user){	
		$return = false;

		$this->db->select('*');
		$this->db->from('team');		
		$this->db->where('id', $user->team_id);
		$this->db->limit('1');

		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			$return = $query->row();
		}
		return $return;
	}
	
	function update_team($post){		
		$this->db->where('id', $post['id']);
		$this->db->update('team', $post);
	}
}