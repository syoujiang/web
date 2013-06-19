<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fotang_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
	}
	public function get_today_api($user)
	{
		$query = $this->db->query("select id,gongke_type,number from hhs_gongke where name='$user' and TO_DAYS(riqi)=TO_DAYS(now())");
		return $query->result_array();
	}
	public function get_month_api($user,$type)
	{
		$query = $this->db->query("select sum(number) from hhs_gongke where name='$user' and gongke_type='$type' and date_sub(curdate(), INTERVAL 30 DAY) <= date(`riqi`)");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				return $row['sum(number)'];
			}
		}
		return 0;
	}
	public function get_year_api($user,$type)
	{
		# code...
		$query = $this->db->query("select sum(number) from hhs_gongke where name='$user' and gongke_type='$type' and YEAR(riqi)=YEAR(NOW())");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				return $row['sum(number)'];
			}
		}
		return 0;
	}
	public function add($user,$type,$number)
	{
		//check 当天是否已经有这样的记录
		$query = $this->db->query("select * from hhs_gongke where name='$user' and gongke_type='$type' and TO_DAYS(riqi)=TO_DAYS(now())");
//		log_message('error','message'.$this->db->last_query());
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$this->update($row->id,$number);
			}		
		}
		else
		{
			$data = array(
			'name' => $user,
			'gongke_type' => $type,
			'number' => $number,
			'riqi' => date('Y-m-d H:i:s')
			);
			$this->db->insert('hhs_gongke', $data);
		}	
	}
	public function update($id,$number)
	{
		# code...
		$data = array(
			'id' => $id,
			'number' => $number
			);
		# code...
		$this->db->update('hhs_gongke', $data);
//		log_message('error','message'.$this->db->last_query());
	}
}

/* End of file fotang_model.php */
/* Location: ./application/models/fotang_model.php */