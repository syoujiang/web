<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xinjing extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('xinjing_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->sidebar = array("<li><a href=\"".base_url('fotang/index')."\">佛堂</a></li>",
		"<li><a href=\"".base_url('xinjing/index')."\">心经</a></li>");
	}
	//朝课，暮课、佛七
	public function index()
	{
		if ($this->input->post('mymethod') == 'delete') 
		{
			# code...
			$this->xinjing_model->delete(rtrim($this->input->post('deleteid'), ','));
		}
		$total= $this->db->count_all('hhs_fangsheng');
		$page_config['perpage']=10;   //每页条数
		$page_config['part']=2;//当前页前后链接数量
		$page_config['url']='wuzhong/index';//url
		$page_config['seg']=3;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		$page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		$page_config['total']=$total;
		$this->load->library('mypage');
		$this->mypage->initialize($page_config);

		$offset = ($page_config['nowindex']-1)*($page_config['perpage']);
		$data['news'] = $this->xinjing_model->get(($offset),$page_config['perpage']);
		$attributes = array('id' => 'indexform');
		$hidden = array('deleteid' => '','mymethod'=>'delete');
		$data['formurl'] = form_open('wuzhong/index', $attributes,$hidden);
		$data['arrayleft'] = $this->sidebar;
		$this->load->view('templates/head', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/left',$data);
		$this->load->view('fotang/index', $data);
		$this->load->view('templates/footer');
	}

}

/* End of file xinjing.php */
/* Location: ./application/controllers/xinjing.php */