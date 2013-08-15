<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadtest extends CI_Controller {

	public function __construct()
	{
	   parent::__construct();
	   $this->load->helper(array('url', 'form'));
	   $this->load->library(array('session', 'encrypt'));
	   		$this->load->helper('url');
		$this->load->library('qbox');
	}

	public function index()
	{
		$token['uptoken'] = $this->qbox->GetUploadURL();
		$token['fileprev']="11";
		$this->load->view('upload_form',$token);
	}
		function urlsafe_base64_decode($string) {

		$data = str_replace(array('-','_'), array('+','/'), $string);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		return base64_decode($data);
	}  // urlsafe_base64_decode
	public function result()
	{
		log_message('error','message22222222222222');
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		echo $_GET['upload_ret'];
		$qniu_res=$this->urlsafe_base64_decode($_GET['upload_ret']);
		$obj=json_decode($qniu_res);
		// $this->qbox->GetDownloadURL("hhshe.qiniudn.com",$obj->hash);
		$token['uptoken'] = $this->qbox->GetUploadURL();
		$token['filename'] =date('ymdHis').substr(microtime(),2,4)."jpg";
		$token['fileprev'] = $this->qbox->GetDownloadURL("hhshe.qiniudn.com",$obj->hash);
		log_message('error','$token '.$token['fileprev']);
		$this->load->view('upload_form',$token);
	}
	public function uploadify()
	{
		$config['upload_path'] = "./uploads";
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("userfile"))
		{
			$error = $this->upload->display_errors();
			var_dump($this->upload->data());
			var_dump($error);
		}
		else
		{
			$data = $this->upload->data();

			var_dump($data);
		}
	}
	public function callback()
	{
		$this->load->library('qbox');
		$act = isset($_POST["action"]) ? strtolower(trim($_POST["action"])) : "";
		/**
		 * 响应并分发请求
		 */
		# 取得将要执行操作的类型
		log_message('error',"callback".$act);
		switch ($act) {

		    # 如果是写表操作
		    case "insert":
		    
		        # 首先接值
		        $filekey = isset($_POST["file_key"]) ? trim($_POST["file_key"]) : "";

		        # 然后检查有效性
		        if($filekey == ""){
		            $resp = json_encode(array("code" => 400, "data" => array("errmsg" => "Invalid Params, <file_key> and <file_name> cannot be empty")));
		            die($resp);
		        }
		        $previewURL = $this->qbox->GetDownloadURL("hhshe.qiniudn.com",$filekey);
				log_message('error','$previewURL '.$previewURL);
				$delURL=$this->qbox->DeleteQiniuFile($filekey);
		        # 最后返回处理结果
		        if (isset($previewURL)) {
		            die(json_encode(array(	"code" => 200,
		            						"preview"=>$previewURL, 
		            						"deleteurl"=>$delURL, 
		            						"data" => array("success" => true))));
		        } else {
		            die(json_encode(array("code" => 499, "data" => array("errmsg" => "Insert Failed"))));
		        }
		        break;
		    case 'delete':
		    	# code...
				$filekey = isset($_POST["file_key"]) ? trim($_POST["file_key"]) : "";
				$this->qbox->Delete($filekey);
	            die(json_encode(array(	"code" => 200,
						"data" => array("success" => true))));
		    	break;
		    # 如果是未知操作，返回错误
		    default:
		        $resp = json_encode(array("code" => 400, "data" => array("errmsg" => "Invalid URL, Unknow <action>: $act")));
		        die($resp);
		}
		# code...
	}
}

/* End of file uploadify.php */
/* Location: ./application/controllers/uploadify.php */