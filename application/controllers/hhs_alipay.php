<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hhs_alipay extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('hhs_alipay_view');
	}

}

/* End of file hhs_alipay.php */
/* Location: ./application/controllers/hhs_alipay.php */