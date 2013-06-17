<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fotang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
				$this->load->model('fabao_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->sidebar = array();
	}
	public function index()
	{
		$page_config['seg']=3;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		// echo $this->uri->total_segments();
		if($this->uri->total_segments() == 4)
		{
			if($this->uri->segment(3)=='on')
			{
				$id = $this->uri->segment(4);
				$this->fabao_model->Set_tuijian($id,1);
			}
			elseif ($this->uri->segment(3)=='off') 
			{
				$id = $this->uri->segment(4);
				$this->fabao_model->Set_tuijian($id,0);
			}
			$page_config['nowindex']=1;
		}
		else
		{
			$page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		}
		if ($this->input->post('mymethod') == 'search') 
		{
			# code...
			//$total= $this->fabao_model->search_count();
			//SELECT * FROM `magazine` WHERE CONCAT（`title`,`tag`,`description`） LIKE ‘%关键字%’
			echo $this->input->post('searchtext');
		}
		//else
			$total= $this->db->count_all('hhs_fabao');
		
		$page_config['perpage']=10;   //每页条数
		$page_config['part']=2;//当前页前后链接数量
		$page_config['url']='fabao/index';//url
		$page_config['seg']=3;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		// $page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		$page_config['total']=$total;
		$this->load->library('mypage');
		$this->mypage->initialize($page_config);

		$offset = ($page_config['nowindex']-1)*($page_config['perpage']);
		$data['news'] = $this->fabao_model->get_fabao(($offset),$page_config['perpage']);
		$data['news_type']=$this->fabao_model->get_all_fabao_type();
		$attributes = array('id' => 'indexform');
		$hidden = array('deleteid' => '','mymethod'=>'');
		$data['formurl'] = form_open('fabao/index', $attributes,$hidden);
		$data['arrayleft'] = $this->sidebar;
		$data['searchtext'] = $this->input->post('searchtext');
		$this->load->view('templates/head', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/left',$data);
		$this->load->view('fabao/index', $data);
		$this->load->view('templates/footer');
	}

}

/* End of file fotang.php */
/* Location: ./application/controllers/fotang.php */