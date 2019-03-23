<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Lobby extends Base {

	public function __construct() {
		parent::__construct();

		if(!isset($this->session->userdata['user'])) {
			redirect('/');
		}
	}

	public function index() {
		$this->load_template_with_view('pages/lobby/main');
	}

	public function play2vs2() {
		$this->load_template_with_view('pages/lobby/play2vs2');
	}

}
