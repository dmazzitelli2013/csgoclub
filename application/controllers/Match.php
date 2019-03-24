<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Match extends Base {

	public function __construct() {
		parent::__construct();

		$this->load->model('user_model');
		$this->load->model('match_model');
	}

	public function generate_random_2vs2_match($user_ids) {
		$this->check_call_from_lobby();

		$user_ids = explode('-', $user_ids);
		if(count($user_ids) != 4) {
			echo 'Invalid data';
			return;
		}

		foreach($user_ids as $user_id) {
			$user = $this->user_model->get_user($user_id);
			if(is_null($user)) {
				echo 'Invalid data';
				return;
			}
		}

		$url = $this->match_model->create_random_2vs2_match($user_ids);
		
		echo site_url('match/show/' . $url);
	}

	public function show($match_token) {
		$this->check_valid_session();

		$match = $this->match_model->get_match_by_token($match_token);

		if(is_null($match)) {
			redirect('/');
		}

		$this->load_template_with_view('pages/match/match2vs2', array('match' => $match));
	}

}
