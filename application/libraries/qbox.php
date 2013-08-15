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
// define('QBOX_SDK_DIR', LIB_DIR . 'qiniu' . DIRECTORY_SEPARATOR . 'qbox' . DIRECTORY_SEPARATOR);
/**
 * 加载配置文件
 */
require_once LIB_DIR . 'rs.php';
require_once LIB_DIR . 'io.php';
require_once LIB_DIR . 'fop.php';
require_once LIB_DIR . 'http.php';
/**
 * 设置错误报告级别
 */
class qbox extends CI_Controller{
	protected $client = NULL;
	protected $bucket;
	protected $upToken;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->bucket = 'hhs';
		$accessKey = 'LtcS2cGr8WfCpgfZGyX6YDmW4OjOEwt_rNGO0gog';
		$secretKey = 'XDbYbJN3nkYlgnOulKbCOM_tDE3EUh50A0lpwq6o';
		Qiniu_setKeys($accessKey, $secretKey);
		// $client = new Qiniu_MacHttpClient(null);
		$putPolicy = new Qiniu_RS_PutPolicy($this->bucket);
		 // $putPolicy->ReturnUrl="http://127.0.0.1/";
		$putPolicy->ReturnBody='{
					    "foo": "bar",
					    "name": $(fname),
					    "size": $(fsize),
					    "type": $(mimeType),
					    "hash": $(etag),
					    "w": $(imageInfo.width),
					    "h": $(imageInfo.height),
					    "color": $(exif.ColorSpace.val)
					}';
		$this->upToken = $putPolicy->Token(null);
	}
	public function GetUploadURL()
	{
		return $this->upToken;
	}
	public function GetBucket()
	{
		return $this->bucket;
	}
	public function GetDownloadURL($domain, $key)
	{
		$previewURL="";
		$baseUrl = Qiniu_RS_MakeBaseUrl($domain, $key);
		$getPolicy = new Qiniu_RS_GetPolicy();
		$privateUrl = $getPolicy->MakeRequest($baseUrl, null);
		return $privateUrl;
	}
	public function DeleteQiniuFile($fkey)
	{
		$client = new Qiniu_MacHttpClient(null);
		$err = Qiniu_RS_Delete($client, $this->bucket, $fkey);
		echo "====> Qiniu_RS_Delete result: \n";
		if ($err !== null) {
		    var_dump($err);
		} else {
		    echo "Success!";
		}
		return true;
	}
}

/**
 * 初始化 Qbox Reource Service Transport
 */

