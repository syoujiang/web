<?php 
/**
 * 
 */
 class User extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		//Do your magic here
 		$this->load->helper('form');
		$this->load->helper('url');
 	}
 	public function login($username, $password)
 	{
		$this -> db -> select('id, username, password');
		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> where('password', MD5($password));
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
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