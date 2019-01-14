<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageLoader {

	function initialize() {
		$ci =& get_instance();
		$ci->load->helper('language');
		$ci->lang->load('default','thai');
	}
}