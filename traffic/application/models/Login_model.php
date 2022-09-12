<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model 
{
	public function get_user($user=null)
	{
		if($user)
		{
			$query = $this->db->get_where('user',array('user_email'=>$user,'user_status'=>1,'row_delete'=>0));
			return $query->row_array();
		}
	}//function getUser
}//class login modal

?>