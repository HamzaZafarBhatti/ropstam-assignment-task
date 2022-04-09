<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
	}
	public function register()
	{
		$admin = $this->admin->get_admin();
		if ($admin) {
			redirect('/login');
		}
		$this->load->view('register');
	}
	public function do_register()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$data = [
			'email' => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
		];
		echo json_encode($data);
		$res = $this->admin->create_admin($data);
		if ($res) {
			redirect('/login');
		} else {
			$this->session->set_flashdata('error', 'Admin registration failed!');
			redirect('/register');
		}
	}
	public function login()
	{
		$data['admin'] = $this->admin->get_admin();
		$this->load->view('login', $data);
	}
	public function do_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$admin = $this->admin->get_admin_by_email($email);
		// echo json_encode($admin->password);die();
		if (password_verify($password, $admin->password)) {
			$sess_data = [
				'logged_in' => TRUE,
				'id' => $admin->id,
				'email' => $admin->email
			];
			$this->session->set_userdata($sess_data);
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('error', 'Email or password incorrect');
			redirect('/login');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('dashboard');
	}
}
