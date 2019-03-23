<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url');
	}

	protected function load_template_with_view($view_name, $data = array()) {
		$this->load->view('templates/header', $data);
		$this->load->view($view_name, $data);
		$this->load->view('templates/footer', $data);
	}

}
