<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->isNotLoggedIn();
	    $this->load->helper(array('url','form','date'));
	    $this->load->database();
	  	$this->load->model('thana_model');
        $this->load->model('staff_model');
	  	$this->load->model('area_model');
	  	$this->load->model('station_model');
        $this->load->model('user_model');
        $this->load->model('profile_model');
	  	$this->load->library("form_validation");
	}
    //for the first page of staff
	public function index()
	{
			$data['title']="Staff";
			$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Staff' => '',
				);
			$data['rsStaff'] =$this->staff_model->getStaff();
            $data['rsArea'] =$this->area_model->getArea();
	    	$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("staff/show-staff");
			$this->load->view('page_footer');
	} //end of view staff

    public function staff_form()
    {
    	$data['title']="Add Staff";
        $data['breadcrumbs'] = array(
         'Home' => site_url('dashboard'),
         'Staff' => site_url('staff'),
         'Add Staff' => ''
            );
        $this->load->view('page_header',$data);
        $this->load->view('page_left_sildebar');
        $this->load->view("staff/staff-form");
        $this->load->view('page_footer');
    }
    //end of staff add form
    //process of staff add
    public function add_staff()
    {
          $this->form_validation->set_rules('tname','Staff Name','required');
      		$this->form_validation->set_rules('temail','Staff Email','required|valid_email');
    		if($this->form_validation->run()==TRUE)
    		{
    			$tid = $this->staff_model->insert_staff();	//insert staff
    			$new_name = "Staff";
                $config['file_name']              = $new_name;
                $config['upload_path']            = 'assets/profile/user';
                $config['allowed_types']          = 'jpg|png|jpeg';
                $config['max_filename_increment'] = 1000;
                $this->load->library('upload', $config);
                if($this->upload->do_upload('timg'))//file upload
                {
                   $fileattr = array('upload_data' => $this->upload->data());
                   $fileName =   $config['upload_path'].'/'.$fileattr['upload_data']['file_name'];
                   $data =array(
                      'user_img'=>$fileName,
                    );
                   $this->staff_model->update_staff($data,$tid);
                }
                else
                {
                  $error = array('error' => $this->upload->display_errors());
                }
    			if($tid)
    			{
    				$msg = array('statusType'=>'success','statusMsg'=>'Record Inserted successfully.');
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
    			$this->staff_form();
    		}
    }
    //end of staff process 
    //start of staff delete 
    public function delete_staff($userid)
    {
     $id =  $this->staff_model->del_staff($userid);
     $msg = array('statusType'=>'success','statusMsg'=>'Record Deleted Successfully.');
            $this->session->set_flashdata($msg);
            $this->index();
    }
    //end of staff delete
    //edit the staff
    public function edit_form($userid)
    {
        if($this->session->user_type==0 || $this->session->user_type==1)
        {
            $data['staff_detail'] = $this->staff_model->getStaff($userid);   
        }
        else
        {
            $msg = array('statusType'=>'danger','statusMsg'=>'!You are not a authorized person.');
            $this->session->set_flashdata($msg);
            $this->index();
        }
        $data['title']="Edit Staff";
        $data['breadcrumbs'] = array(
         'Home' => site_url('dashboard'),
         'Staff' => site_url('staff'),
         'Edit Staff' => '',
            );
        $this->load->view('page_header',$data);
        $this->load->view('page_left_sildebar');
        $this->load->view("staff/staff-edit-form");
        $this->load->view('page_footer');
    }
    //end of edit staff form
    //start of update the staff
    public function edit_staff()
    {
        $this->form_validation->set_rules('tname','Staff Name','required');
        $this->form_validation->set_rules('temail','Staff Email','required|valid_email');
            if($this->form_validation->run()==TRUE)
            {
                $userid =  $this->input->post("userid");
                $data =array(
                      'user_name'    => $this->input->post("tname"),
                      'user_mobile'  => $this->input->post("tmobile"),
                      'user_email'   => $this->input->post("temail"),
                      'user_address' => $this->input->post("taddress"),
                      'user_city'    => $this->input->post("tcity"),
                      'user_state'   => $this->input->post("tstate"),
                    );
                $updateUser = $this->staff_model->update_staff($data,$userid);  
                $new_name = "Staff";
                $config['file_name']              = $new_name;
                $config['upload_path']            = 'assets/profile/user';
                $config['allowed_types']          = 'jpg|png|jpeg';
                $config['max_filename_increment'] = 1000;
                $this->load->library('upload', $config);
                if($this->upload->do_upload('timg'))
                {
                   $fileattr = array('upload_data' => $this->upload->data());
                   $fileName =   $config['upload_path'].'/'.$fileattr['upload_data']['file_name'];
                   $data =array(
                      'user_img'=>$fileName,
                    );
                   $this->staff_model->update_staff($data,$userid);
                }
                else
                {
                  $error = array('error' => $this->upload->display_errors());
                }
                if($updateUser)
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
                $this->edit_form($this->input->post("userid"));
            }
    }
    //end of update staff
    //check emial id on staff add
    public function check_email()
    {
        $emailid = $this->input->post("id");
        $res = $this->user_model->check_useremail($emailid);
        print_r($res);
        
    }
    //change the password of staff
    public function change_password()   
    {
         $this->form_validation->set_rules('upassword', 'User Password', 'required');
         $this->form_validation->set_rules('confirmPassword', 'Confirm Password','required');
        if ($this->form_validation->run() == FALSE)
        {
            $data['error_message'] = validation_errors();
            echo json_encode($data);
        }
        else if($this->input->post('upassword')!=$this->input->post('confirmPassword'))
        {
           $data['error_message'] = "<p>New Password and Confirm Password should Same</p>";
              echo json_encode($data);
        }
        else
        {
            $data = array(
                    'user_pass'         => base64_encode(md5($this->input->post('upassword'))),
                    'operation'         => 'update',
                    'operation_date'    => date("Y-m-d H:i:s"),
                    'operation_userid'  => $this->session->uid,
                    );
              $this->profile_model->update_profile($data,$this->input->post('userid'));
              $msg = array('statusType'=>'success','statusMsg'=>' You Successfully Updated the Password');
             $this->session->set_flashdata($msg);
             echo '1';
        }
    }//end of the chage password
}
?>