<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class User_model extends CI_Model
{
  public function user_detail($userid)
  {
      $query = $this->db->get_where('user',array('USER_ID'=>$userid,'user_status'=>1,'row_delete'=>0));
      return $query->row_array();
  }
  public function check_useremail($email)
  {
  	$query = $this->db->get_where('user',array('user_email'=>$email,'row_delete'=>0));
    return $query->row_array();
  }

}//class User_model
?>