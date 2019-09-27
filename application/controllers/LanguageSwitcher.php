<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LanguageSwitcher extends CI_Controller
 
{
 
	public function __construct() {

		parent::__construct();

	}

	/*public function index(){
		$response = $this->config->item('response');
		redirect($response['root']);

	}*/
 
	function switchLang($language = "") {
		$response = $this->config->item('response');
		$language = ($language != "") ? $language : "english";
		$this->session->set_userdata('site_lang', $language);
		redirect($response['root']);

	}
 
}