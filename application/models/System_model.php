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

	function set_user_cookie($params) {
        $user = $this->encrypt->encode(serialize($params));
		$expires = '0';
		set_cookie('thRescueVolunteer', $user, $expires);
    }

	function get_user_cookie() {
        $user = get_cookie('thRescueVolunteer', true);
        if ($user != null) {
            $user = $this->encrypt->decode($user);
            $user = @unserialize($user);
            return $user;
        }
        return false;
    }
	
	function unset_user_cookies() {
        delete_cookie('thRescueVolunteer');
    }
}
