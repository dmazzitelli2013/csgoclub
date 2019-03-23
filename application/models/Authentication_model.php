<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication_Model extends CI_Model {

	protected $table = 'users';

	public function has_valid_password($password) {
		return (strlen($password) >= 6);
	}

	public function has_valid_email($email) {
		$this->db->where('email', $email);
		$result = $this->db->get($this->table)->result();
		
		if(count($result) > 0) {
        	return false;
        }

        return true;
	}

	public function has_valid_nickname($nickname) {
		$this->db->where('nickname', $nickname);
		$result = $this->db->get($this->table)->result();
		
		if(count($result) > 0) {
        	return false;
        }

        return true;
	}

	public function register_user($data) {
		$data['password'] = md5($data['password']);
		$this->db->insert($this->table, $data);
		return true;
	}

	public function authenticate_user($data) {
		$data['password'] = md5($data['password']);
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);

		$result = $this->db->get($this->table)->result();

		if(count($result) > 0) {
        	$result = $result[0];
        	return $this->get_formatted_user($result);
        }

        return NULL;
	}

	private function get_formatted_user(&$user) {
		unset($user->password);
		unset($user->steam_id);
		return $user;
	}

}

?>