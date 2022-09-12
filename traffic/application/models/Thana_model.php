<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Thana_model extends CI_Model
{
  //this is for get the thana details
  public function getThana($userid=null)
    {
      if($userid!=null)
      {
          $this->db->join('station', 'station.sid = user.area', 'left');
         $query = $this->db->get_where('user',array('user.row_delete'=>0,'user.USER_ID'=>$userid));
         return $query->row_array(); 
      }
      else
      {
        $this->db->join('station', 'station.sid = user.area', 'left');
        $query = $this->db->get_where('user',array('user.row_delete'=>0, 'user_role' => 2));
        return $query->result_array();  
      }
    }
    public function stationUpdate($id,$stationid)
   {
        $data = array(
              'area'              => $stationid,
              'operation'         => 'Station Change',
              'operation_userid'  => $this->session->uid,
          );
      $this->db->where('USER_ID', $id);
      $this->db->update('user', $data);
   }
//indert the new thana
  public function insert_thana()
    {
        $data = array(
            'operation'        =>  'insert',
            'operation_userid' =>   $this->session->uid,
            'operation_date'   =>   date("Y-m-d H:i:s"),
            'user_role'        =>   2,
            'user_name'        =>   $this->input->post('tname'),
            'user_email'       =>   $this->input->post('temail'),
            'user_mobile'      =>   $this->input->post('tmobile'),
            'user_address'     =>   $this->input->post('taddress'),
            'user_city'        =>   $this->input->post('tcity'),
            'user_state'       =>   $this->input->post('tstate'),
            'user_pass'        =>   base64_encode(md5($this->input->post('temail'))),
            'user_status'      =>   1,
          );
         $tid =  $this->db->insert('user',$data);
         $insertId = $this->db->insert_id();
         return $insertId;
    }
  //update thana by thana 
  public function update_thana($data,$id)
    {
        $this->db->where('USER_ID', $id);
        $data = $this->db->update('user', $data);
        return($data);
    }
//delete the thana detail
  public function del_thana($userid)
    {
        $data =array(
                    'row_delete'=>1,
                    'operation'=>'Delete',
                    'operation_userid'=>$this->session->uid,
                    'operation_date' => date("Y-m-d H:i:s"),
                    );
        $this->db->where('USER_ID', $userid);
        $thana_deleted = $this->db->update('user', $data);
    }
  //check the thana is availeble or not for particular subject
  public function check_thana()
    {
      $id   = $this->input->post("id");
      $daysname   = $this->input->post("daysname");
      $columcount = $this->input->post("columcount");
      $columcount = $columcount+1;
      $query =$this->db->get_where('master',array("days_name" => $this->input->post("daysname"),"slotthana".$columcount."" => $this->input->post("id")));
      return $query->result_array();  
    }
}//class thana Modal
?>