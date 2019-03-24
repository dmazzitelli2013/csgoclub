<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {

	protected $table = 'users';

	public function get_user($id) {
		$this->db->where('id', $id);
		$result = $this->db->get($this->table)->result();

		if(count($result) > 0) {
        	$user = $result[0];
        	unset($user->password);
        	return $user;
        }

        return NULL;
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

}

?>