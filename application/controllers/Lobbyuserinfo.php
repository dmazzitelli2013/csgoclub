<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Lobbyuserinfo extends Base {

	public function __construct() {
		parent::__construct();

		$caller_ip = $this->get_caller_ip();
		if(is_null($caller_ip) || $caller_ip != $_SERVER['SERVER_ADDR']) {
			//exit("Access denied.");
		}

		echo $caller_ip . ' - ' . $_SERVER['SERVER_ADDR'];
	}

	public function get_user_by_token($user_token) {

	}

}
