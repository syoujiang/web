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
class fabao extends REST_Controller
{
    private $show_count=0;
    function __construct()
    {
        # code...
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('fabao_model');
        $this->load->model('user_model');
        $this->load->database();
        $this->load->helper('url');
        $this->show_count = $this->config->item('news_limit_no');
    }
    public function index_get()
    {
        // 轮播图
        // 法宝分类
        $this->output->enable_profiler(TRUE);
       // $types=$this->fabao_model->get_all_fabao_type();
        $types=$this->fabao_model->get_tuijian_type();
        $lunbo=$this->fabao_model->get_lunbo_api();
        $sendmsg = array('bucket' => "hhs",
                        'lunbotu' => $lunbo,
                        'types' => $types);
        $this->response($sendmsg, 200); // 200 being the HTTP response code

        # code...
    }
    // 获取法宝类别
    function fabao_type_get()
    {
        $this->output->enable_profiler(TRUE);
        if($this->get('id'))
        {
            echo $this->get('method');
            $types=$this->fabao_model->get_fabao_type($this->get('id'));
        }
        else
        {
            $types=$this->fabao_model->get_all_fabao_type();
        }
        if($types)
        {
            $this->response($types, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array(), 200);
        }
    }
    //获取资讯的摘要
	function content_get()
    {
        if(!$this->get('type_id'))
        {
        	$this->response(NULL, 400);
        }
        $type_id = $this->get('type_id');

        // if($this->get('contentid'))
        // {
        //     if(!$this->get('direct'))
        //     {
        //         $this->response(array(), 400);
        //     }
        //     else
        //     {
        //         $content=$this->fabao_model->get_fabao_limit_api($type_id,$this->get('contentid'),$this->get('direct'),$this->show_count); 
        //     }
        // }
        // else
        // {
        //     $this->output->enable_profiler(TRUE);
        //     $content=$this->fabao_model->get_fabao_limit_api($type_id,0,'none',$this->show_count); 
        // }
        //法宝数量不多。一次都传递过去
        $content=$this->fabao_model->get_fabao_all_api($type_id);
        $sendmsg = array('bucket' => "hhs",
                    'fabao' => $content);
        // if($content)
        // {
            $this->response($sendmsg, 200); // 200 being the HTTP response code
        // }
        // else
        // {
        //     $this->response($sendmsg, 200);
        // }
    }
    //获取资讯内容
    function content_one_get()
    {
        $this->load->model('yunfei_model');
        $yunfei=$this->yunfei_model->get_api();
        if(!$this->get('id'))
        {
            $sendmsg = array('bucket' => "hhs",
            'fabao' => array(),
            'tuijian' => array(),
            'yunfei' => $yunfei);
            $this->response($sendmsg, 200); // 200 being the HTTP response code
        }

        $this->output->enable_profiler(TRUE);
        $content=$this->fabao_model->getOneFabao_api($this->get('id'));      

        if($content)
        {
            $content_tuijian=$this->fabao_model->get_tuijian($content['type']);
            $sendmsg = array('bucket' => "hhs",
                                'fabao' => $content,
                                'tuijian' => $content_tuijian,
                                'yunfei' => $yunfei);
            $this->response($sendmsg, 200); // 200 being the HTTP response code
        }
        else
        {

            $sendmsg = array('bucket' => "hhs",
                            'fabao' => array(),
                            'tuijian' => array(),
                            'yunfei' => $yunfei);
            $this->response($sendmsg, 200); // 200 being the HTTP response code
        }

    }

    public function tj_fabao_type_get()
    {
        # code...
        $fabao_msg=$this->fabao_model->get_tuijian_type();
        $this->response($fabao_msg, 200); // 200 being the HTTP response code


    }
    public function tj_fabao_get()
    {
        # code...
        $fabao_msg=$this->fabao_model->get_tuijian($this->get('type'));
        $sendmsg = array('bucket' => "hhs",
                'fabao' => $fabao_msg);
        $this->response($sendmsg, 200); // 200 being the HTTP response code
    }

    public function shop_get()
    {
        $username = $this->input->server('PHP_AUTH_USER');
        # code...
        $message = $this->fabao_model->GetFabao_api($username);
        $this->response($message, 200); // 200 being the HTTP response code
    }

    // 增加法宝,放入购物车
    function shop_post()
    {
        if(!$this->post('number'))
        {
            $message = array('result' => '0',
                            'reason' => '没有法宝数量');
            $this->response($message, 200); // 200 being the HTTP response code
            return;
        }
        // if(($this->post('number') > 5)|| ($this->post('number') < 1)){
        //     # code...
        //     $message = array('result' => '0',
        //         'reason' => '一次添加的法宝数量不能超过5个');
        //     $this->response($message, 200); // 200 being the HTTP response code
        //     return;
        // }
        $ret = $this->fabao_model->AddFabao_api($this->post('user'),
                                        $this->post('id'),
                                        $this->post('number'));
        if($ret)
        {
            log_message('error','AddFabao_api'.$this->post('id'));
            $message = array('result' => '1',
            'reason' => "添加成功");
            $this->response($message, 200); // 200 being the HTTP response code
        }
        else
        {
            $message = array('result' => '0',
            'reason' => "结缘车已经存在这个法宝，请不要重复添加！");
            $this->response($message, 200); // 200 being the HTTP response code

        }

    }
    public function shop_put()
    {
        if(!$this->put('number'))
        {
            $message = array('result' => '0',
                            'reason' => '没有法宝数量');
            $this->response($message, 200); // 200 being the HTTP response code
            return;
        }
        // if(($this->put('number') > 5)|| ($this->put('number') < 1))
        // {
        //     # code...
        //     $message = array('result' => '0',
        //         'reason' => '一次添加的法宝数量不能超过5个');
        //     $this->response($message, 200); // 200 being the HTTP response code
        //     return;
        // }
        $ret = $this->fabao_model->UpdateFabao_api($this->put('user'),
                                        $this->put('id'),
                                        $this->put('number'));
        if($ret)
        {
            $message = array('result' => '1',
            'reason' => "更新成功");
            $this->response($message, 200); // 200 being the HTTP response code
        }
        else
        {
            $message = array('result' => '0',
            'reason' => "请先添加法宝");
            $this->response($message, 200); // 200 being the HTTP response code

        }
    }

    public function shop_delete()
    {
        if($this->delete('id'))
        {
            log_message('error','delete_shop'.$this->delete('id'));
            $this->fabao_model->delete_shop($this->delete('user'),$this->delete('id'));
        }
        else
        {
            log_message('error','empty_shop');
            $this->fabao_model->empty_shop($this->delete('user'));
        }
        $message = array('result' => '1',
            'reason' => "删除成功");
        $this->response($message, 200); // 200 being the HTTP response code
    }

    // 提交订单
    function order_post()
    {
        $errmsg="";
        $user=$this->post('user');
        $fabao=$this->post('fabao');
        $fabao = json_decode($fabao,true);
        log_message('error',$fabao);
        if($this->fabao_model->create_order($user,$fabao,$errmsg))
        {
            $message = array('result' => '1','reason'=>$errmsg);
            $this->response($message, 200); // 200 being the HTTP response code
        }
        else
        {
            $message = array('result' => '0','reason'=>$errmsg);
            $this->response($message, 200); // 200 being the HTTP response code
         }
    }

    //获取订单
    public function order_get()
    {
        # code...
        if(!$this->get('id'))
        {
            $this->response(array(), 200);
        }
        $this->output->enable_profiler(TRUE);
        $content=$this->fabao_model->get_one_order($this->get('id'));
        var_dump($content);
        $content_count = count($content);
        for ($i=0; $i <$content_count ; $i++) { 
            # code...
            // echo $content[$i]['fabao_id'];
            $content[$i]['fabao_id']=$this->fabao_model->getFbName($content[$i]['fabao_id']);
        }
        var_dump($content);
        // foreach ($content as $value) {
        //     # code...
        //     foreach ($value as $key=>$age) {    
        //         if($key == "fabao_id"){
        //             foreach ($fabao_name as $key => $value) {
        //                 # code...
        //             }
        //             echo $age;
        //             echo $fabao_name['$age'];
        //         }
        //     }
        // }

        if($content)
        {
            $this->response($content, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array(), 200);
        }
    }

    function content_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    

}