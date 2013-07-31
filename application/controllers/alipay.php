<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/Alipay_Controller.php';

class Alipay extends Alipay_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->view('alipay/index');
	}
	public function create()
	{
		log_message('debug','Alipay post');
		echo $this->notify_verify();
	}
	public function notify_url()
	{
		log_message('debug','notify_url ');
		$this->notify_url();
	}
	public function call_back_url()
	{
		log_message('debug','call_back_url ');
		$this->call_back_url();
	}
}

/* End of file alipay.php */
/* Location: ./application/controllers/alipay.php */