<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Notification_model extends CI_Model
{
  //get the notification
  public function getNote($nid=null)
    {
      if($nid!=null)
    	{
    		$query = $this->db->get_where('notification',array('NID'=>$nid,'notification.row_delete'=>0));
        return $query->row_array();
    	}
    	else
    	{
    		$query = $this->db->get_where('notification',array('notification.row_delete'=>0));
        return $query->result_array();
    	}
    }
  //delete notification
  public function delete_notification($nid)
    {
      	$data = array(
    		        'row_delete' 		    => 1,
                'operation'    		  => 'Delete',
                'operation_userid'	=> $this->session->uid,
            );
    		$this->db->where('NID', $nid);
    		$this->db->update('notification', $data);
    }
  //insert new notification
  public function insert_notification()
    {
        $data = array(
              'operation'        =>  'insert',
              'operation_userid' =>   $this->session->uid,
              'operation_date'   =>   date("Y-m-d H:i:s"),
              'nTitle'           =>   $this->input->post('notiTitle'),
              'nCode'            =>   $this->input->post('notiCode'),
              'ndescription'     =>   $this->input->post('notidesc'),
              'nstatus'          =>   $this->input->post('notiStatus'),
          );
         $notificationid =  $this->db->insert('notification',$data);
         $insertId = $this->db->insert_id();
         return $insertId;
    }
  //update notification
  public function update_notification($data,$id)
     {
        $this->db->where('NID', $id);
        $data = $this->db->update('notification', $data);
        return($data);
    }
}//class notification model
?>