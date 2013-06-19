<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
class Fotang extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fotang_model');
	}
	public function index_get()
	{
		$username = $this->input->server('PHP_AUTH_USER');
        # code...
        $message = $this->fotang_model->get_today_api($username);
        $this->response($message, 200); // 200 being the HTTP response code
	}
	public function month_get()
	{
		$username = $this->input->server('PHP_AUTH_USER');
        # (念佛，诵经，持咒，吃素)
        $type = array('念佛','诵经','持咒','吃素');
		for ($i=0; $i <4 ; $i++) { 
			$message[$i]['gongke_type']=$type[$i];
			$message[$i]['numer']=$this->fotang_model->get_month_api($username,$type[$i]);
		}
        $this->response($message, 200); // 200 being the HTTP response code
	}
	public function year_get()
	{
		$username = $this->input->server('PHP_AUTH_USER');
        # (念佛，诵经，持咒，吃素)
        $type = array('念佛','诵经','持咒','吃素');
		for ($i=0; $i <4 ; $i++) { 
			$message[$i]['gongke_type']=$type[$i];
			$message[$i]['numer']=$this->fotang_model->get_year_api($username,$type[$i]);
		}
        $this->response($message, 200); // 200 being the HTTP response code
	}
	public function gongke_post()
	{
		$username = $this->input->server('PHP_AUTH_USER');
        # code...
        $type=$this->post('type');    
        $number=$this->post('number');
        $this->fotang_model->add($username,$type,$number);
		$message = array('result' => '1',
			'reason' => "添加成功");
			$this->response($message, 200); // 200 being the HTTP response code
		# code...
	}
}

/* End of file fotang.php */
/* Location: ./application/controllers/api/fotang.php */