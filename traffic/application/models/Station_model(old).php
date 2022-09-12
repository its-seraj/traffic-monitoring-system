<?php
Class Station_model extends CI_Model
{
  //============Get station=========
  public function getStation($sid=null)
  {
  	if($sid!=null)
  	{
  		$query = $this->db->get_where('station',array('sid'=>$sid,'row_delete'=>0));
      	return $query->row_array();
  	}
  	else
  	{
  		$query = $this->db->get_where('station',array('row_delete'=>0));
       return $query->result_array();
  	}
  }
  public function getStationRecord()
  {
       $sql = "SELECT count('area.sid') as countarea, station.sid, station.sname, station.sstatus FROM station LEFT JOIN area ON area.sid = station.sid && station.row_delete =0 && area.row_delete= 0 group by station.sid";
       
       $query = $this->db->query($sql);
       return $query->result_array();
  }
  //---------end of get station-----

  //=========insert station===========
  public function insert_station()
  {
      $data = array(
            'operation'       => 'insert',
            'operation_userid'  => $this->session->uid,
            'sname'       => $this->input->post('station_name'),
            'sstatus'     => $this->input->post('station_status'),
            'operation_date'    =>  date("Y-m-d H:i:s"),
        );
      $this->db->insert('station',$data);
    return($this->db->insert_id());
  }
  //----------end of insert station----

  //=========delete station========
  public function delete_station($sid)
  {
  		$data = array(
		        'row_delete' 		=> 1,
            'operation'    		=> 'Deleted',
            'operation_userid'	=> $this->session->uid,
            'operation_date'    =>  date("Y-m-d H:i:s"),
        );
		$this->db->where('sid', $sid);
		$this->db->update('station', $data);
  }
  //----------end of delete station----
  //=========update station========
  public function update_station()
  {
        $data = array(
            'operation'    		=> 'update',
            'operation_userid'	=> $this->session->uid,
            'sname'				=> $this->input->post('station_name'),
            'sstatus'			=> $this->input->post('station_status'),
            'operation_date'    =>  date("Y-m-d H:i:s"),
        );
    $this->db->where('sid',  $this->input->post('station_id'));
		$this->db->update('station', $data);
  }
  //-------end of the update station------
 

}//class User_model
?>