<?php  if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * 网站入口文件
 *
 * @version $VersionId$ @ $UpdateTime$
 * @author 404 <why404@gmail.com>
 * @copyright Copyright (c) 2011-2012 404 <why404@gmail.com>
 * @license MIT License {@link http://www.opensource.org/licenses/mit-license.php}
 */

/**
 * 定义时区
 */
date_default_timezone_set('Asia/Shanghai');

/**
 * 定义网站目录
 */
define('ROOT_DIR', str_replace(array('\\\\', '//'), DIRECTORY_SEPARATOR, dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR);
define('QINIU_DIR', ROOT_DIR . 'libraries' . DIRECTORY_SEPARATOR);
define('LIB_DIR', QINIU_DIR . 'lib' . DIRECTORY_SEPARATOR);
define('QBOX_SDK_DIR', LIB_DIR . 'qiniu' . DIRECTORY_SEPARATOR . 'qbox' . DIRECTORY_SEPARATOR);
/**
 * 加载配置文件
 */
//echo ROOT_DIR."<br>";
//echo QINIU_DIR."<br>";
//echo LIB_DIR."<br>";
//echo QBOX_SDK_DIR."<br>";

require_once QINIU_DIR . 'config.php';
require_once QINIU_DIR . 'helper.php';
require_once LIB_DIR . 'rs.php';
require_once LIB_DIR . 'fileop.php';
require_once LIB_DIR . 'client/rs.php';
require_once LIB_DIR . 'authtoken.php';
//require_once LIB_DIR . 'pdo.class.php';
/**
 * 设置错误报告级别
 */
error_reporting($config['error']['reporting']);

class qbox extends CI_Controller{
	protected $rs = NULL;
	protected $bucket;
	protected $upToken;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$config = array(

			# DEBUG
			'error' => array(
			'reporting'       => 4095,
			'throw_exception' => true,
			),

			# qiniu account
			'qbox' => array(
			'access_key' => 'LtcS2cGr8WfCpgfZGyX6YDmW4OjOEwt_rNGO0gog',
			'secret_key' => 'XDbYbJN3nkYlgnOulKbCOM_tDE3EUh50A0lpwq6o',
			'bucket'     => 'hhs',
			),

		);
		$this->bucket = $config["qbox"]["bucket"];
		$QBOX_ACCESS_KEY = $config["qbox"]["access_key"];
		$QBOX_SECRET_KEY = $config["qbox"]["secret_key"];
		$client = QBox_OAuth2_NewClient();
		$this->rs = QBox_RS_NewService($client, $this->bucket);
		$opts = array(
		"scope"			=> "hhs",
		"expiresIn"		=> 3600,
		"callbackUrl"	=> "http://example.com/callback?a=b&d=c",
		);
		$this->upToken = QBox_MakeAuthToken($opts);
	}
	public function GetUploadURL()
	{
		# code...
		list($result, $code, $error) = $this->rs->PutAuth();
		if ($code == 200) {
			$upload_url = $result["url"];
		} else {
		$msg = QBox_ErrorMessage($code, $error);
		die("PutFile failed: $code - $msg\n");
		}
		return $upload_url;
	}
	public function GetBucket()
	{
		# code...
		return $this->bucket;
	}
	public function GetupToken()
	{
		# code...
		return $this->upToken;
	}
	public function GetPictureURL($key, $attName)
	{
		$previewURL="";
		list($result, $code, $error) = $this->rs->Get($key, $attName);
		if ($code == 200) {
			$previewURL = QBox_FileOp_ImagePreviewURL($result['url'], 0);
		} else {
			$errnum = $code;
			$errmsg = QBox\ErrorMessage($code, $error);
		}
		return $previewURL;
	}
	public function GetDownloadURL($key, $attName)
	{
		$previewURL="";
		list($result, $code, $error) = $this->rs->Get($key, $attName);
		if ($code == 200) {
			$previewURL = $result['url'];
		} else {
			$errnum = $code;
			$errmsg = QBox\ErrorMessage($code, $error);
		}
		return $previewURL;
	}
	public function Delete($fkey)
	{
		# code...
		log_message('error','delete key is ['.$fkey."]");
		list($code, $error) = $this->rs->Delete($key);
		log_message('error',"===> Delete $key result:".$code);
		if ($code == 200) {
			log_message('error',"Delete file $key ok!");
		} else {
			$msg = QBox\ErrorMessage($code, $error);
			die("Delete failed: $code - $msg\n");
		}
		return true;
	}
}

/**
 * 初始化 Qbox Reource Service Transport
 */

