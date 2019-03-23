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
		$data['created'] = date('Y-m-d H:i:s');
		$data['updated'] = $data['created'];
		
		$this->db->insert($this->table, $data);

		return true;
	}

	public function authenticate_user($data) {
		$data['password'] = md5($data['password']);
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);

		$result = $this->db->get($this->table)->result();

		if(count($result) > 0) {
			$user_token = $this->generate_user_token();
			$this->db->where('email', $data['email']);
			$this->db->update($this->table, array('user_token' => $user_token, 'updated' => date('Y-m-d H:i:s')));

        	$result = $result[0];
        	$result->user_token = $user_token;
        	return $this->get_formatted_user($result);
        }

        return NULL;
	}

	public function logout_user($email) {
		$this->db->where('email', $email);
		$this->db->update($this->table, array('user_token' => NULL, 'updated' => date('Y-m-d H:i:s')));
	}

	public function get_user_by_token($user_token) {
		$this->db->where('user_token', $user_token);
		$result = $this->db->get($this->table)->result();

		if(count($result) > 0) {
        	$user = $result[0];
        	unset($user->password);
        	return $user;
        }

        return NULL;
	}

	private function get_formatted_user(&$user) {
		unset($user->password);
		unset($user->steam_id);
		return $user;
	}

	private function generate_user_token() {
		$user_token = bin2hex(openssl_random_pseudo_bytes(64));
		
		while(!$this->is_valid_generated_user_token($user_token)) {
			$user_token = bin2hex(openssl_random_pseudo_bytes(64));
		}

		return $user_token;
	}

	private function is_valid_generated_user_token($user_token) {
		$this->db->where('user_token', $user_token);
		$result = $this->db->get($this->table)->result();

		if(count($result) > 0) {
        	return false;
        }

        return true;
	}

}

?>