<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model 
{
	public function __construct()
		{
		   parent::__construct();
		   $this->load->database();
		}//fun construct
		public function get_profile()
		{
			$array = array('row_delete' => 0, 'USER_ID' => $this->session->uid);
			$this->db->where($array);
			$query = $this->db->get('user');
			return $query->row_array();
		}//fun select all user
	public function update_profile($data,$id)
		{
			$array = array('row_delete' => 0, 'USER_ID' => $id);
			$this->db->where($array);
			$data = $this->db->update('user', $data);
			return($data);
		}

		//this is use for check the namr exits or not
}//class User_model

?>