<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Staff_model extends CI_Model
{
  //this is for get the teacher details
  public function getStaff($userid=null)
    {
      if($userid!=null)
      {
         $this->db->join('area', 'area.AREAID = user.area', 'left');
         $query = $this->db->get_where('user',array('user.row_delete'=>0,'user.USER_ID'=>$userid));
         return $query->row_array(); 
      }
      else
      {
        $this->db->join('area', 'area.AREAID = user.area', 'left');
        $query = $this->db->get_where('user',array('user.row_delete'=>0, 'user_role' => 3));
        return $query->result_array();  
      }
    }
    public function areaUpdate($id,$areaid)
   {
        $data = array(
              'area'        => $areaid,
              'operation'         => 'Area Change',
              'operation_userid'  => $this->session->uid,
          );
      $this->db->where('USER_ID', $id);
      $this->db->update('user', $data);
   }
//indert the new teacher
  public function insert_staff()
    {
        $data = array(
            'operation'        =>  'insert',
            'operation_userid' =>   $this->session->uid,
            'operation_date'   =>   date("Y-m-d H:i:s"),
            'user_role'        =>   3,
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
  //update teacher by teacher 
  public function update_staff($data,$id)
    {
        $this->db->where('USER_ID', $id);
        $data = $this->db->update('user', $data);
        return($data);
    }
//delete the teacher detail
  public function del_staff($userid)
    {
        $data =array(
                    'row_delete'=>1,
                    'operation'=>'Delete',
                    'operation_userid'=>$this->session->uid,
                    'operation_date' => date("Y-m-d H:i:s"),
                    );
        $this->db->where('USER_ID', $userid);
        $teacher_deleted = $this->db->update('user', $data);
    }
  //check the teacher is availeble or not for particular subject
     public function get_staff_attendance($areaid)
  {
        $this->db->join('area', 'area.AREAID = user.area');
        $query = $this->db->get_where('user',array('user.row_delete'=>0, 'user_role' => 3,'area' => $areaid));
        return $query->result_array();  
  }
  public function getsearch($staff,$area,$date)
  {
      if($staff!='')
      {
        $this->db->join('user','user.USER_ID= attendance.staff_id');
        $this->db->join('area','area.AREAID = attendance.area_id');
        $query = $this->db->get_where('attendance',array('attendance.row_delete'=>0,'a_date' =>date("Y-m-d", strtotime($date)),'staff_id'=> $staff));
        return $query->row_array();
      }
      else
      {
        $this->db->join('user','user.USER_ID= attendance.staff_id');
        $query = $this->db->get_where('attendance',array('attendance.row_delete'=>0,'a_date' =>date("Y-m-d", strtotime($date)),'area_id'=>$area));
        return $query->result_array();
      }

  }
}//class Teacher Modal
?>