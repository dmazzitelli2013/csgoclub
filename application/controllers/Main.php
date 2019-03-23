<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Main extends Base {

	public function __construct() {
		parent::__construct();

        $this->load->model('authentication_model');
	}

	private function check_session_and_redirect() {
        if(isset($this->session->userdata['user'])) {
			redirect('lobby');
		}
	}

	public function index() {
		$this->check_session_and_redirect();
		$this->load_template_with_view('pages/main');
	}

	public function register() {
		$this->check_session_and_redirect();

		if($this->input->post('email')) {
			if($this->do_register()) {
				redirect('/');
			}
		} else {
			$this->load_template_with_view('pages/register');
		}
	}

	private function do_register() {
		$data['firstname'] = trim($this->input->post('firstname'));
		$data['lastname'] = trim($this->input->post('lastname'));
		$data['email'] = trim($this->input->post('email'));
		$data['nickname'] = trim($this->input->post('nickname'));
		$data['password'] = trim($this->input->post('password'));
		$data['steam_id'] = trim($this->input->post('steam_id'));

		if(strlen($data['firstname']) == 0 ||
			strlen($data['lastname']) == 0 ||
			strlen($data['email']) == 0 ||
			strlen($data['nickname']) == 0 ||
			strlen($data['password']) == 0 ||
			strlen($data['steam_id']) == 0) {
			$this->session->set_flashdata('register_error', 'Debes completar todos los datos del formulario.');
			$this->load_template_with_view('pages/register', $data);
			return false;
		}

		if($data['password'] != $this->input->post('password_again')) {
			$this->session->set_flashdata('register_error', 'Las contraseñas no coinciden.');
			$this->load_template_with_view('pages/register', $data);
			return false;
		}

		if(!$this->authentication_model->has_valid_password($data['password'])) {
			$this->session->set_flashdata('register_error', 'La contraseña debe tener al menos 6 caracteres.');
			$this->load_template_with_view('pages/register', $data);
			return false;
		}

		if(!$this->authentication_model->has_valid_email($data['email'])) {
			$this->session->set_flashdata('register_error', 'La dirección de e-mail ya está en uso.');
			$this->load_template_with_view('pages/register', $data);
			return false;
		}

		if(!$this->authentication_model->has_valid_nickname($data['nickname'])) {
			$this->session->set_flashdata('register_error', 'El nickname ya está en uso.');
			$this->load_template_with_view('pages/register', $data);
			return false;
		}

		return $this->authentication_model->register_user($data);
	}

	public function login() {
		$this->check_session_and_redirect();

		if($this->input->post('email')) {
			if($this->do_login()) {
				redirect('lobby');
			}
		} else {
			$this->load_template_with_view('pages/login');
		}
	}

	private function do_login() {
		$data['email'] = trim($this->input->post('email'));
		$data['password'] = trim($this->input->post('password'));

		$user = $this->authentication_model->authenticate_user($data);

		if(is_null($user)) {
			$this->session->set_flashdata('login_error', 'Credenciales inválidas.');
			$this->load_template_with_view('pages/login');
			return false;
		}

		$this->session->set_userdata('user', $user);

		return true;
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}

}
