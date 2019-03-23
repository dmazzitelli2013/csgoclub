<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Main extends Base {

	public function __construct() {
		parent::__construct();

        $this->load->model('authentication_model');
	}

	public function index() {
		$this->load_template_with_view('pages/main');
	}

	public function register() {
		$this->load_template_with_view('pages/register');
	}

	public function login() {
		$this->load_template_with_view('pages/login');
	}

}
