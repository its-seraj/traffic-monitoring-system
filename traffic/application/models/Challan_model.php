<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Challan_model extends CI_Model
{
  //get the challan
  public function getChallan($challanno=null)
    {
        if($challanno!=null)
        {
          $this->db->join('type_vehicle','type_vehicle.TV_ID = challan_type.ct_tv_id','left');
          $query = $this->db->get_where('challan_type',array('challan_type.row_delete'=>0, 'CT_ID'=>$challanno));
          return $query->row_array();
        }
        else
        {
          $this->db->join('type_vehicle','type_vehicle.TV_ID = challan_type.ct_tv_id','left');
        $query = $this->db->get_where('challan_type',array('challan_type.row_delete'=>0));
        return $query->result_array();  
        }
        
    }
  public function getVehicle()
  {
      $query = $this->db->get_where('type_vehicle',array('type_vehicle.row_delete'=>0,'type_vehicle.status'=>1));
        return $query->result_array();
  }
  //delete challan
  public function delete_challan($challanno)
    {
    	$data = array(
  		        'row_delete' 		    => 1,
              'operation'    		  => 'Delete',
              'operation_userid'	=> $this->session->uid,
          );
  		$this->db->where('CT_ID', $challanno);
  		$this->db->update('challan_type', $data);
    }
  //insert new challan
  public function insert_challan()
    {
        $vehicle_type  =   $this->input->post('vehicle_type[]');
        $chaCode       =   $this->input->post('chaCode[]');
        $chaName       =   $this->input->post('chaName[]');
        $chaAmount     =   $this->input->post('chaAmount[]');
        $chaStatus     =   $this->input->post('chaStatus[]');
       for ($i=0; $i<count($chaCode); $i++)
       {
        $data = array(
              'operation'        =>  'insert',
              'operation_userid' =>   $this->session->uid,
              'operation_date'   =>   date("Y-m-d H:i:s"),
              'ct_no'            =>   $chaCode[$i],
              'ct_detail'        =>   $chaName[$i],
              'ct_amount'        =>   $chaAmount[$i],
              'ct_status'        =>   $chaStatus[$i],
              'ct_tv_id'         =>   $vehicle_type[$i],
          );
         $challanid =  $this->db->insert('challan_type',$data);
       }
  	  return($challanid);
    }
  //update challan
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
}//class challan model
?>