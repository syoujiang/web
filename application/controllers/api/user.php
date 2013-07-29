<?php defined('BASEPATH') OR exit('No direct script access allowed');

// namespace D;

/**
 * fabao
 *
 * This is an fabao of a few basic content interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';
class User extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('fabao_model');
	}
	public function register_post()
	{
		log_message('debug','reigster_post');
		$username=$this->post("username");
		$mail=$this->post("mail");
		$password=$this->post("password");
		$result=$this->user_model->register($username,$mail,$password,$msg,$token);
		if($result==true)
		{
	        $sendmsg = array('result' => "1",
	                        'reason' => "注册成功",
	                        'token' => $token);
	        $this->response($sendmsg, 200); // 200 being the HTTP response code
		}
		else
		{
	        $sendmsg = array('result' => "0",
	                        'reason' => $msg);
			$this->response($sendmsg, 200); // 200 being the HTTP response code
		}

	}

	public function login_post()
	{
		log_message('debug','login_post');
		
		$mail=$this->post("mail");
		$password=$this->post("password");
		$token=$this->post("token");
		$result=$this->user_model->check_login($mail,$password,$token);
		if($result==true)
		{
	        $sendmsg = array('result' => "1",
	                        'reason' => "登入成功",
	                        'token' => $token);
	        $this->response($sendmsg, 200); // 200 being the HTTP response code
		}
		else
		{
	        $sendmsg = array('result' => "0",
	                        'reason' => "用户名密码错误");
			$this->response($sendmsg, 200); // 200 being the HTTP response code
		}
	}
	public function login_delete()
	{
		log_message('debug','login_delete');
		$mail=$this->delete("mail");
		$token=$this->delete("token");
		$this->user_model->logout($mail,$token);
        $sendmsg = array('result' => "1",
                        'reason' => "注销成功");
		$this->response($sendmsg, 200); // 200 being the HTTP response code

	}
	public function reset_put()
	{
		log_message('debug','login_delete');
		$mail=$this->put("mail");
		$result=$this->user_model->reset_passwd($mail,$msg);
		if($result==true)
		{
	        $sendmsg = array('result' => "1",
	                        'reason' => $msg);
	        $this->response($sendmsg, 200); // 200 being the HTTP response code
		}
		else
		{
	        $sendmsg = array('result' => "0",
	                        'reason' =>  $msg);
			$this->response($sendmsg, 200); // 200 being the HTTP response code
		}
	}
	// 我的结缘
	public function order_get()
	{
		$token=$this->get("token");
		if($token=="")
		{
			$this->response(array('status' => false, 'error' => 'Not authorized'), 401);

		}
		else
		{
			log_message('debug','token '.$token);
			log_message('debug','start check token is valid');


		}

	}
}

/* End of file user.php */
/* Location: ./application/controllers/api/user.php */