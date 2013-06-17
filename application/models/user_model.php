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

	public function check_User_api($username,$passwd)
	{
		$query = $this->db->get_where('hhs_user', array('username' => $username,
														'password' => $passwd));
	//	echo  $this->db->last_query();
		return $query->result_array();
	}
}
?>