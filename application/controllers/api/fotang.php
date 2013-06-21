<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
class Fotang extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fotang_model');
	}
	public function today_get()
	{
		$username = $this->input->server('PHP_AUTH_USER');
        # code...
        // $message = $this->fotang_model->get_today_api($username);
        # (念佛，诵经，持咒，吃素)
        $type = array('念佛','诵经','持咒','吃素');
		for ($i=0; $i <4 ; $i++) { 
			$message[$i]['gongke_type']=$type[$i];
			$message[$i]['numer']=$this->fotang_model->get_today_api($username,$type[$i]);
		}
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
        $beizhu=$this->post('beizhu');
        $this->fotang_model->add($username,$type,$number,$beizhu);
		$message = array('result' => '1',
			'reason' => "添加成功");
			$this->response($message, 200); // 200 being the HTTP response code
		# code...
	}
	public function gongke_put()
	{
        # code...
        $id=$this->put('id');  
        log_message('error','message'.$id);  
        $number=$this->put('number');
        $beizhu=$this->put('beizhu');
        $this->fotang_model->update($id,$number,$beizhu);
		$message = array('result' => '1',
			'reason' => "更新成功");
			$this->response($message, 200); // 200 being the HTTP response code
		# code...
	}


	public function today_info_get()
	{
		$username = $this->input->server('PHP_AUTH_USER');
		$message = $this->fotang_model->get_info_api($username,'today');
		$this->response($message, 200); // 200 being the HTTP response code
	}
	public function month_info_get()
	{
		$username = $this->input->server('PHP_AUTH_USER');
		$message = $this->fotang_model->get_info_api($username,'month');
		$this->response($message, 200); // 200 being the HTTP response code
	}
	public function year_info_get()
	{
		$username = $this->input->server('PHP_AUTH_USER');
		$message = $this->fotang_model->get_info_api($username,'year');
		$this->response($message, 200); // 200 being the HTTP response code
	}
}

/* End of file fotang.php */
/* Location: ./application/controllers/api/fotang.php */