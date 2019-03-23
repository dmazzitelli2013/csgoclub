<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url');
	}

	protected function check_valid_session() {
		if(!isset($this->session->userdata['user'])) {
			redirect('/');
		}
	}

	protected function load_template_with_view($view_name, $data = array()) {
		$this->load->view('templates/header', $data);
		$this->load->view($view_name, $data);
		$this->load->view('templates/footer', $data);
	}

	protected function get_caller_ip() {
        $ip = null;
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}
