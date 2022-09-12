<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Fine_model extends CI_Model
{
  //get the fine
  public function getFine($fine=null)
    {
        if($fine!=null)
        {

          $this->db->select("fine_name,fine_vehicle_no,fine_vehicle_type,total_fine,fine_gruop,fine_username,arecode,arename,fine_Date,fine_transaction_id");
          $this->db->join('area', 'area.AREAID = fine.fine_area', 'left');
          $this->db->join('user','user.USER_ID = fine.fine_userid');
          $query = $this->db->get_where('fine',array('fine.row_delete'=>0,'fine.FID'=>$fine));
          return $query->row_array();
        }
        else
        {
          $this->db->join('area', 'area.AREAID = fine.fine_area', 'left');
          $this->db->join('user','user.USER_ID = fine.fine_userid');
          $query = $this->db->get_where('fine',array('fine.row_delete'=>0));
          return $query->result_array();  
        }
        
    }
  public function getVehicle()
  {
      $query = $this->db->get_where('type_vehicle',array('type_vehicle.row_delete'=>0,'type_vehicle.status'=>1));
        return $query->result_array();
  }
  public function calculate($id)
  {
        $this->db->select('ct_amount');
         $query = $this->db->get_where('challan_type',array('challan_type.row_delete'=>0,"CT_ID" => $id));
          return $query->row_array();  
  }
  public function getReson($id='')
  {
    $query = $this->db->get_where('fine',array('fine.FID' =>$id ,'fine.row_delete'=>0));
    $rowDetail = $query->row_array();
    $listofFine =  json_decode($rowDetail['fine_gruop'], true);
   
    $this->db->select('ct_no,ct_detail,ct_tv_id,ct_amount,tv_sort_name,tv_name');
    $this->db->where_in('CT_ID', $listofFine);
    $this->db->join('type_vehicle', 'TV_ID = ct_tv_id', 'left');
    $query2 = $this->db->get('challan_type');
    return $query2->result_array();
  }
  //delete area
  public function delete_fine($fine)
    {
    	$data = array(
  		        'row_delete' 		    => 1,
              'operation'    		  => 'Delete',
              'operation_userid'	=> $this->session->uid,
          );
  		$this->db->where('FID', $fine);
  		$this->db->update('fine', $data);
    }
  //insert new area
  public function insert_fine($area)
    {
        
        $data = array(
              'operation'           =>  'insert',
              'operation_userid'    =>   $this->session->uid,
              'operation_date'      =>   date("Y-m-d H:i:s"),
              'fine_name'           =>   $this->input->post('finename'),
              'fine_vehicle_no'     =>   $this->input->post('finenameVehicleno'),
              'fine_Date'           =>   date("Y-m-d H:i:s"),
              'fine_vehicle_type'   =>   $this->input->post('finenameVehicletype'),
              'fine_gruop'          =>   json_encode($this->input->post('finelist[]')),
              'total_fine'          =>   json_encode($this->input->post('fine[]')),
              'fine_userid'         =>   $this->session->uid,
              'fine_username'       =>   $this->session->user_name,
              'fine_area'           =>   $area,
              'fine_transaction_id' =>   $this->input->post('transactionid'),
          ); 
         $fineid =  $this->db->insert('fine',$data);
  	  return($fineid);
    }
  //update area
  public function update_challan()
    {
       $data = array(
              'operation'        =>  'update',
              'operation_userid' =>   $this->session->uid,
              'operation_date'   =>   date("Y-m-d H:i:s"),
              'ct_no'            =>   $this->input->post('chaCode'),
              'ct_detail'        =>   $this->input->post('chaName'),
              'ct_amount'        =>   $this->input->post('chaAmount'),
              'ct_status'        =>   $this->input->post('chaStatus'),
              'ct_tv_id'         =>   $this->input->post('vehicle_type'),
              
          );
       $this->db->where('CT_ID', $this->input->post('challanid'));
       $this->db->update('challan_type',$data);
    }
}//class area model
?>