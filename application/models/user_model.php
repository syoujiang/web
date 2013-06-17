<?php
/**
* 
*/
/**
* 
*/
class user_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
		# code...
	}

 	public function login($username, $password)
 	{
		$this->db->select('id, username, password');
		$this->db->from('hhs_users');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);
		$query = $this->db->get();
		echo  $this->db->last_query();
		echo $query->num_rows();
		if($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
 	}
}
?>