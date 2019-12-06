<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['use_page_numbers'] = TRUE;
$config['per_page'] = 20;
$config['reuse_query_string'] = true;

$config["full_tag_open"] = '<ul class="pagination">';

$config["first_link"] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
$config["first_tag_open"] = '<li class="page-item page-link" >';
$config["first_tag_close"] = '</li>';

$config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
$config['prev_tag_open'] = '<li class=" page-item page-link">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active page-item"><a class="page-link" href="#">';
$config['cur_tag_close'] = '</a></li>';

$config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
$config['next_tag_open'] = '<li class=" page-item page-link">';
$config['next_tag_close'] = '</li>';

$config["last_link"] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
$config["last_tag_open"] = '<li class=" page-item page-link">';
$config["last_tag_close"] = '</li>';

$config['num_tag_open'] = '<li class="page-link">';
$config['num_tag_close'] = '</li>';

$config["full_tag_close"] = '</ul>';