<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Lobbyuserinfo extends Base {

	public function __construct() {
		parent::__construct();

		$caller_ip = $this->get_caller_ip();
		$server_ip = $this->config->item('server_ip_address');
		if(is_null($caller_ip) || $caller_ip != $server_ip) {
			//exit("Access denied.");
		}

		echo $caller_ip . ' - ' . $server_ip;
	}

	public function get_user_by_token($user_token) {

	}

}
