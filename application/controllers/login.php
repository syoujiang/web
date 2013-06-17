<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			//$this->load->view('news', $data);
			redirect('news', 'refresh');
		}
		else
		{
			//If no session, redirect to login page
			//redirect('login', 'refresh');
			$this->load->view('login_view');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */