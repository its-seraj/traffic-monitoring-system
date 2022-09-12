<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notification extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->isNotLoggedIn();
	    $this->load->helper(array('url','form','date'));
	    $this->load->database();
	  	$this->load->model('station_model');
	  	$this->load->model('area_model');
	  	$this->load->model('user_model');
	  	$this->load->model('notification_model');
	  	
	  	$this->load->library("form_validation");
	}
	public function index()
	{
			$data['title']="Notification";
			$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Notification' => '',
				);
			$data['user'] = $this->user_model->user_detail($this->session->uid);
			$data['rsNotification'] =$this->notification_model->getNote();
	    	$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("notification/show-notification");
			$this->load->view('page_footer');
	} //end of view class
	public function delete_notification($nid)
	{
	   $this->notification_model->delete_notification($nid);
       $msg = array('statusType'=>'success','statusMsg'=>'Record Deleted successfully.');
	   $this->session->set_flashdata($msg);
	   redirect('notification');
	}//delete_area

	public function notification_form()
	{
		$data['title']="Add Notification";
		$data['user'] = $this->user_model->user_detail($this->session->uid);
		$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Notification' => site_url("notification"),
			 'Add Notification'=>'',
				);
			$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("notification/notification-form");
			$this->load->view('page_footer');
	}//this is for add the area form
	public function add_notification()
	{
       		$this->form_validation->set_rules('notiCode','Notification Code','required');
      		$this->form_validation->set_rules('notiTitle','Title','required');
      		$this->form_validation->set_rules('notiStatus','Status','required');
    		if($this->form_validation->run()==TRUE)
    		{
    			$nid = $this->notification_model->insert_notification();	//insert notification
    			$new_name = "notification";
                $config['file_name']              = $new_name;
                $config['upload_path']            = 'assets/notification';
                $config['allowed_types']          = 'jpg|png|jpeg|pdf';

                $config['max_filename_increment'] = 1000;

              //  echo "kishan";
                $this->load->library('upload', $config);
                if($this->upload->do_upload('Notificationimg'))//file upload
                {
                   $fileattr = array('upload_data' => $this->upload->data());
                   $fileName =   $config['upload_path'].'/'.$fileattr['upload_data']['file_name'];
                   $data =array(
                      'file'=>$fileName,
                    );
                   $this->notification_model->update_notification($data,$nid);
              
                }
                else
                {
                  $error = array('error' => $this->upload->display_errors());
                }
    			if($nid)
    			{
    				$msg = array('statusType'=>'success','statusMsg'=>'Record Inserted successfully.'.$nid);
    	   		    $this->session->set_flashdata($msg);
    			 	$this->index();
    			}
    			else
    			{	
    				$msg = array('statusType'=>'danger','statusMsg'=>'Some problam occurs record not inserted.');
    				$this->session->set_flashdata($msg);
    				$this->index();
    			}
    		}
    		else
    		{
    			$this->notification_form();
    		}
	}
	   public function edit_notification_form($nid)
    {
       	$data['rowNotification']=$this->notification_model->getNote($nid=$nid);
       	$data['title']="Edit Notification";
		$data['breadcrumbs'] = array(
			 'Home' => base_url('dashboard'),
			 'Notification' => site_url("notification"),
			 'Edit Notification'=>'',
			);
       	$this->load->view('page_header',$data);
       	$this->load->view('page_left_sildebar');
		$this->load->view("notification/notification-edit");
		$this->load->view('page_footer');
    }
    public function edit_notification()
    {

    	$this->form_validation->set_rules('notiCode','Notification Code','required');
      	$this->form_validation->set_rules('notiTitle','Title','required');
      	$this->form_validation->set_rules('notiStatus','Status','required');
		if($this->form_validation->run()==TRUE)
		{
			$nid =  $this->input->post("nid");
            $data =array(
                  'nTitle'           =>   $this->input->post('notiTitle'),
	              'nCode'            =>   $this->input->post('notiCode'),
	              'ndescription'     =>   $this->input->post('notidesc'),
	              'nstatus'          =>   $this->input->post('notiStatus'),
                );
              $updateNoti =  $this->notification_model->update_notification($data,$nid);
                $new_name = "notification";
                $config['file_name']              = $new_name;
                $config['upload_path']            = 'assets/notification';
                $config['allowed_types']          = 'jpg|png|jpeg|pdf';
                $config['max_filename_increment'] = 1000;
                 $this->load->library('upload', $config);
                if($this->upload->do_upload('Notificationimg'))//file upload
                {
                   $fileattr = array('upload_data' => $this->upload->data());
                   $fileName =   $config['upload_path'].'/'.$fileattr['upload_data']['file_name'];
                   $data =array(
                      'file'=>$fileName,
                    );
                   $this->notification_model->update_notification($data,$nid);
              
                }
                else
                {
                  $error = array('error' => $this->upload->display_errors());
                }
                if($updateNoti)
                {
                    $msg = array('statusType'=>'success','statusMsg'=>'Record Updated successfully.');
                     $this->session->set_flashdata($msg);
                    $this->index();
                }
                else
                {
                    $msg = array('statusType'=>'danger','statusMsg'=>'Some problam occurs record not inserted.');
                    $this->session->set_flashdata($msg);
                    $this->index();
                }
            }
            else
            {
                $this->edit_notification_form($this->input->post("nid"));
            }
    }
  
}
?>