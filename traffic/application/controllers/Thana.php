<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Thana extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->isNotLoggedIn();
	    $this->load->helper(array('url','form','date'));
	    $this->load->database();
	  	$this->load->model('thana_model');
	  	$this->load->model('area_model');
	  	$this->load->model('station_model');
        $this->load->model('user_model');
        $this->load->model('profile_model');
	  	$this->load->library("form_validation");
	}
    //for the first page of ti
	public function index()
	{
			$data['title']="Thana Incharge";
			$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Thana Incharge' => '',
				);
            $data['rsStation'] = $this->station_model->getStation();
			$data['rsThana'] =$this->thana_model->getThana();
	    	$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("thana/show-thana");
			$this->load->view('page_footer');
	} //end of view ti
    //start of view 

    public function thana_form()
    {
    	$data['title']="Add Thana";
        $data['breadcrumbs'] = array(
         'Home' => site_url('dashboard'),
         'Thana' => site_url('thana'),
         'Add Thana' => ''
            );
        $this->load->view('page_header',$data);
        $this->load->view('page_left_sildebar');
        $this->load->view("thana/thana-form");
        $this->load->view('page_footer');
    }
    //end of ti add form
    //process of ti add
    public function add_thana()
    {
          $this->form_validation->set_rules('tname','Thana Incharge Name','required');
      		$this->form_validation->set_rules('temail','Thana Incharge Email','required|valid_email');
    		if($this->form_validation->run()==TRUE)
    		{
    			$tid = $this->thana_model->insert_thana();	//insert ti
    			$new_name = "Thana_Incharge";
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
                   $this->thana_model->update_thana($data,$tid);
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
    			$this->thana_form();
    		}
    }
    //end of ti process 
    //start of ti delete 
    public function delete_thana($userid)
    {
     $id =  $this->thana_model->del_thana($userid);
     $msg = array('statusType'=>'success','statusMsg'=>'Record Deleted Successfully.');
            $this->session->set_flashdata($msg);
            $this->index();
    }
    //end of ti delete
    //this is show when ti login and see his time table
    public function my_time_table()
    {
        $tid = $this->ti_model->getti($this->session->uid);
        $data['rsTable'] = $this->_model->gettable($bid=null,$semid=null,$roomid=null,$tiid=$tid['USER_ID']);
        $data['title']="My Time Table";
        $data['breadcrumbs'] = array(
         'Home' => site_url('dashboard'),
         'Table Table' => ''
            );
        $data['rsRoom'] = $this->room_model->getRoom();
        $data['rsSubject'] = $this->subject_model->getSubject();
        $data['rsti'] = $this->ti_model->getti();
        $data['tiid'] = $tid['USER_ID'];
        $this->load->view('page_header',$data);
        $this->load->view('page_left_sildebar');
        $this->load->view("ti/view-my-table");
        $this->load->view('page_footer');
    }
    //end of ti login time table
    //this is that ti is avalible or not
    public function checktiable()
    {
        $this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
        $this->form_validation->set_rules('id','ti id','required');
        $this->form_validation->set_rules('daysname','Days Name','required');
        $this->form_validation->set_rules('columcount','Column Name','required');
        if($this->form_validation->run()==TRUE)
        {
            $tidetails = $this->ti_model->check_ti();
            echo json_encode($tidetails);
        }
        else
        {
            echo validation_errors();
        }   
    }
    //end of ti avalible
    //check at the time of edit the time table
    public function checktiableedit()
    {
        $this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
        $this->form_validation->set_rules('id','ti id','required');
        $this->form_validation->set_rules('daysname','Days Name','required');
        $this->form_validation->set_rules('columcount','Column Name','required');
        $this->form_validation->set_rules('branchid','Branch Name','required');
        $this->form_validation->set_rules('semsterNo','Semester Name','required');
        if($this->form_validation->run()==TRUE)
        {
            $titails = $this->ti_model->check_ti();
            if($titails[0]['class']==$this->input->post("branchid") && $titails[0]['section']==$this->input->post("semsterNo"))
            {
                
            }
            else
            {
                echo json_encode($titails);    
            }
        }
        else
        {
            echo validation_errors();
        }    
    }
    //end of it
    //this is for the print of the time table
    public function pdf_ti($tid)
    {
        $data['rsTable'] = $this->_model->gettable($bid=null,$semid=null,$roomid=null,$tiid=$tid);
  
        $data['rsRoom']=$this->room_model->getRoom();
        $data['rsSubject'] = $this->subject_model->getSubject();
        $data['rsti'] = $this->ti_model->getti();
        $data['tiid'] = $tid;
        $this->load->view("ti/pdf-ti",$data);
    }
    //end of time table pdf
    //edit the ti
    public function edit_form($userid)
    {
        if($this->session->user_type==0)
        {
            $data['thana_detail'] = $this->thana_model->getThana($userid);   
        }
        else
        {
            $msg = array('statusType'=>'danger','statusMsg'=>'!You are not a authorized person.');
            $this->session->set_flashdata($msg);
            $this->index();
        }
        $data['title']="Edit Thana Incharge";
        $data['breadcrumbs'] = array(
         'Home' => site_url('dashboard'),
         'Thana Incharge' => site_url('thana'),
         'Edit Thana Incharge' => '',
            );
        $this->load->view('page_header',$data);
        $this->load->view('page_left_sildebar');
        $this->load->view("thana/thana-edit-form");
        $this->load->view('page_footer');
    }
    //end of edit ti form
    //start of update the ti
    public function edit_thana()
    {
        $this->form_validation->set_rules('tname','Thana Incharge Name','required');
        $this->form_validation->set_rules('temail','Thana Incharge Email','required|valid_email');
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
                $updateUser = $this->thana_model->update_thana($data,$userid);  
                $new_name = "Thana_Incharge";
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
                   $this->thana_model->update_thana($data,$userid);
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
    //end of update ti
    //check emial id on ti add
    public function check_email()
    {
        $emailid = $this->input->post("id");
        $res = $this->user_model->check_useremail($emailid);
        print_r($res);
        
    }
    //change the password of ti
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