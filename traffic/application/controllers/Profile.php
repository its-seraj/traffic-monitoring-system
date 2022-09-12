<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once('ClientInfo.php');
class Profile extends MY_Controller 
{
	public function __construct(){
        parent::__construct();
        $this->isNotLoggedIn();
        $this->load->model('profile_model');
        $this->load->library('session');
      //  $this->load->model('teacher_model');
        $this->load->library("form_validation");
    }
    //this is the forst function which call
    public function index()
    {
        $data['title'] = 'Profile';
        $data['breadcrumbs'] = array(
            'Home' => site_url('dashboard'),
            'Profile' =>'');
        $this->load->view('page_header',$data);
        $condition = array(
            'user.row_delete'=>0,
            'USER_ID'   =>$_SESSION['uid']
            );
        $data['cardtitle'] = 'Profile';
        $data['user'] = $this->profile_model->get_profile($condition);

        $this->load->view('profile/profile_view',$data);
        $this->load->view('page_left_sildebar');
        $this->load->view('page_footer');
    }//eof index method

    public function change_password()
    {
         $this->form_validation->set_rules('uoldpassword', 'User Old Password', 'required');
         $this->form_validation->set_rules('upassword', 'User Password', 'required');
         $this->form_validation->set_rules('confirmPassword', 'Confirm Password','required');
        if ($this->form_validation->run() == FALSE)
        {
            $data['error_message'] = validation_errors();
            echo json_encode($data);
        }
        else if($this->input->post('uoldpassword')==$this->input->post('upassword'))
        {
              $data['error_message'] = "<p>Old Password and New password is Same</p>";
              echo json_encode($data);
        }
        else if($this->input->post('upassword')!=$this->input->post('confirmPassword'))
        {
           $data['error_message'] = "<p>New Password and Confirm Password should Same</p>";
              echo json_encode($data);
        }
        else
        {
            $condition = array(
                'user.row_delete'=>0,
                'USER_ID'   =>$_SESSION['uid']
            );
             $data['user'] = $this->profile_model->get_profile($condition);
             if($data['user']['user_pass']== base64_encode(md5($this->input->post('uoldpassword'))))
             {
                $data = array(
                    'user_pass'         => base64_encode(md5($this->input->post('upassword'))),
                    'operation'         => 'update',
                    'operation_date'    => date("Y-m-d H:i:s"),
                    'operation_userid'  => $_SESSION['uid']
                    );
              $this->profile_model->update_profile($data,$_SESSION['uid']);
              $msg = array('statusType'=>'success','statusMsg'=>' You Successfully Updated the Password');
             $this->session->set_flashdata($msg);
             // redirect("profile");
             echo '1';
             }
             else
             {
                $data['error_message'] = "<p>Old password is not correct</p>";
                echo json_encode($data);
             }
        }
    }//end of the chage password
     //this is for edit the record in to the form
    public function edit_profile()
    {
        $this->form_validation->set_rules('uname', 'Username', 'required');
        if($_FILES['uimg']['name']!='')
        {
          $new_name = "User";
          $config['file_name']              = $new_name;
          $config['upload_path']            = 'assets/profile/user';
          $config['allowed_types']          = 'jpg|png|jpeg';
          $config['max_filename_increment'] = 1000;
          $config['file_ext_tolower']       = true;
          $config['max_size']               = 1600000000000;
          $config['max_width']              = 10024;
          $config['max_height']             = 700000;
           $this->load->library('upload', $config);
          if($this->upload->do_upload('uimg'))
          {
             $fileattr = array('upload_data' => $this->upload->data());
             $fileName =   $config['upload_path'].'/'.$fileattr['upload_data']['file_name'];
          }
          else
          {
            $fileName='';
          }
           $id   = $this->input->post('uid');
           $data = array(
                      'user_img'         => $fileName,
                    );
        $this->profile_model->update_profile($data,$id);
      }
         if ($this->form_validation->run() == FALSE)
            {
             $msg = array('statusType'=>'Danger','statusMsg'=>' You unable to Updated the Record');
                 $this->session->set_flashdata($msg);
                 redirect("profile");
            }
        else
            {
                    $id   = $this->input->post('uid');
                    $data = array(
                            'user_name'         => $this->input->post('uname'),
                            'user_mobile'       => $this->input->post('umobile'),
                            'user_email'        => $this->input->post('uemail'),
                            'user_address'      => $this->input->post('uaddress'),
                            'user_city'         => $this->input->post('ucity'),
                            'user_state'        => $this->input->post('ustate'),
                            'operation'         => 'update',
                            'operation_date'    => date("Y-m-d H:i:s"),
                            'operation_userid'  => $this->session->uid
                            );
                    $this->profile_model->update_profile($data,$id);
                    $msg = array('statusType'=>'success','statusMsg'=>' You Successfully Updated the Record');
                     $this->session->set_flashdata($msg);
                     redirect("profile");
            }
    }
    //this will return the record
    public function profile_form()
    {
        $data['User'] = $this->profile_model->get_profile();
        echo json_encode($data);
    }

}//end of class