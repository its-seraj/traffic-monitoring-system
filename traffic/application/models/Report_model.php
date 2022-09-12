<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Report_model extends CI_Model
{
    public function getReportByStation($stationid)
  { 
    $this->db->select('station.sid,station.sname,user.user_name,user.user_mobile,user.user_email,
    	user.user_img');
    $this->db->join('user','user.area = station.sid','left');
    $query = $this->db->get_where('station',array('station.row_delete' => 0,'station.sid' => $stationid));
    $data['firstrow'] = $query->row_array();

    $this->db->select("user.user_name,user.user_email,user.user_mobile,area.AREAID,area.arecode,
    	area.arename");
    $this->db->join('user','user.area=area.AREAID','left');
    $query = $this->db->get_where('area',array('area.sid'=> $stationid,'area.row_delete'=> 0));
    $data['secondrow'] = $query->result_array();

    $this->db->select("area.AREAID,area.arecode,area.arename,fine.FID,fine.fine_name,fine.fine_vehicle_no,fine.fine_vehicle_type,fine.fine_gruop,fine.total_fine,fine.fine_username,fine.fine_transaction_id,fine.fine_Date");
    $this->db->join('fine','fine.fine_area=area.AREAID','left');
    $query = $this->db->get_where('area',array('area.sid'=> $stationid,'area.row_delete'=> 0,'fine.row_delete'=>0));
    $data['thirdrow'] = $query->result_array();
    return $data;
  }
  public function getReportByThana($thana)
  {

    $this->db->select('station.sid,station.sname,user.user_name,user.user_mobile,user.user_email,
        user.user_img');
    $this->db->join('station','user.area = station.sid','left');
    $query = $this->db->get_where('user',array('user.row_delete' => 0,'user.USER_ID' => $thana));
    $data['firstrow'] = $query->row_array();

    $stationid = $data['firstrow']['sid'];

   $this->db->select("user.user_name,user.user_email,user.user_mobile,area.AREAID,area.arecode,
        area.arename");
    $this->db->join('user','user.area=area.AREAID','left');
    $query = $this->db->get_where('area',array('area.sid'=> $stationid,'area.row_delete'=> 0));
    $data['secondrow'] = $query->result_array();

    $this->db->select("area.AREAID,area.arecode,area.arename,fine.FID,fine.fine_name,fine.fine_vehicle_no,fine.fine_vehicle_type,fine.fine_gruop,fine.total_fine,fine.fine_username,fine.fine_transaction_id,fine.fine_Date");
    $this->db->join('fine','fine.fine_area=area.AREAID','left');
    $query = $this->db->get_where('area',array('area.sid'=> $stationid,'area.row_delete'=> 0,'fine.row_delete'=>0));
    $data['thirdrow'] = $query->result_array();
    return $data;
    }
    public function getReportByStaff($staff)
    {
        $this->db->select('area.AREAID,area.arecode,area.arename,user.user_name,user.user_mobile,user.user_email,
            user.user_img,station.sname,user.USER_ID');
        $this->db->join('area','user.area = area.AREAID','left');
        $this->db->join('station','station.sid = station.sid','left');
        $query = $this->db->get_where('user',array('user.row_delete' => 0,'user.USER_ID' => $staff));
        return  $query->row_array();
    }
}//class report model
?>