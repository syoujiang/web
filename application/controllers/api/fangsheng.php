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
class Fangsheng extends REST_Controller
{
    private $show_count=0;
    function __construct()
    {
        # code...
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('fangsheng_model');
        $this->load->model('gonggao_model');
        $this->load->database();
        $this->load->helper('url');
        $this->show_count = $this->config->item('news_limit_no');
    }
    public function index_get()
    {
        $this->output->enable_profiler(TRUE);
        //放生开示的summary
        $kaishi=$this->fangsheng_model->get_summary_api();
        //顶上的轮播图
        $tongzhi=$this->gonggao_model->get_lunbo_api();

        $sendmsg = array('bucket' => "hhs",
                        'tongzhi' => $tongzhi,
                        'kaishi' => $kaishi);
        $this->response($sendmsg, 200); // 200 being the HTTP response code

        # code...
    }
    //获取资讯内容
    function content_one_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
        $id = $this->get('id');


        $content=$this->fangsheng_model->getOne_api($id);
        $sendmsg = array('bucket' => "hhs",
                    'kaishi' => $content);

        $this->response($sendmsg, 200); // 200 being the HTTP response code

    }
}