<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Lobbyuserinfo extends Base {

	public function __construct() {
		parent::__construct();

		$this->check_call_from_lobby();

		$this->load->model('user_model');
	}

	public function get_user_by_token($user_token) {
		$user = $this->user_model->get_user_by_token($user_token);

		if(is_null($user)) {
			echo "Invalid user";
			return;
		}

		echo json_encode($user);
	}

}
