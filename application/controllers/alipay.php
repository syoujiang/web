<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/Alipay_Controller.php';

class Alipay extends Alipay_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('user_model');
	}

	public function index()
	{
		$id=$this->uri->segment(3);
		log_message('debug','message'.$id);
		$date=array();
		if($id != "")
		{
			log_message('debug','message11111111111');
			$date=$this->user_model->get_alipay($id);
			$this->load->view('alipay/index',$date);
		}
		else
		{
			$this->load->view('alipay/error');
		}	
		
	}
	public function create()
	{
		log_message('debug','Alipay post');
		echo $this->notify_verify();
	}
	public function notify_url()
	{
		log_message('debug','notify_url ');
		$this->_notify_url();
	}
	public function call_back_url()
	{
		log_message('debug','call_back_url ');
		$this->_call_back_url();
	}
}

/* End of file alipay.php */
/* Location: ./application/controllers/alipay.php */