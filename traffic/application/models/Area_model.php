<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Area_model extends CI_Model
{
  //get the area
  public function getArea($aid=null)
    {
      if($aid!=null)
    	{
        $this->db->join('station','station.sid = area.sid');
    		$query = $this->db->get_where('area',array('AREAID'=>$aid,'area.row_delete'=>0));
        return $query->row_array();
    	}
    	else
    	{
        $this->db->join('station','station.sid = area.sid');
    		$query = $this->db->get_where('area',array('area.row_delete'=>0));
        return $query->result_array();
    	}
    }
  
  //delete area
  public function delete_area($areno)
    {
    	$data = array(
  		        'row_delete' 		    => 1,
              'operation'    		  => 'Delete',
              'operation_userid'	=> $this->session->uid,
          );
  		$this->db->where('AREAID', $areno);
  		$this->db->update('area', $data);
    }
  //insert new area
  public function getArea_byid($sid)
    {
      $this->db->select("AREAID,arecode,arename,arestatus");
      $query = $this->db->get_where('area',array('row_delete'=>0,'sid' =>$sid));
      return $query->result_array();
    }
  public function insert_area()
    {
        $stationid     =   $this->input->post('stationid');
        $areCode       =   $this->input->post('areCode[]');
        $areName       =   $this->input->post('areName[]');
        $areStatus     =   $this->input->post('areStatus[]');
        $areaid = null;
       for ($i=0; $i<count($areName); $i++)
       {
        $data = array(
              'operation'        =>  'insert',
              'operation_userid' =>   $this->session->uid,
              'operation_date'   =>   date("Y-m-d H:i:s"),
              'arename'          =>   $areName[$i],
              'arecode'          =>   $areCode[$i],
              'sid'              =>   $stationid,
              'arestatus'        =>   $areStatus[$i],
          );
         $areaid =  $this->db->insert('area',$data);
       }
  	  return($areaid);
    }
  //update area
  public function update_area()
    {
       $data = array(
              'operation'        =>  'update',
              'operation_userid' =>   $this->session->uid,
              'operation_date'   =>   date("Y-m-d H:i:s"),
              'arename'          =>   $this->input->post('areName'),
              'arecode'          =>   $this->input->post('areCode'),
              'sid'              =>   $this->input->post('stationid'),
              'arestatus'        =>   $this->input->post('areStatus'),
          );
       $this->db->where('AREAID', $this->input->post('areaid'));
       $this->db->update('area',$data);
    }
}//class area model
?>