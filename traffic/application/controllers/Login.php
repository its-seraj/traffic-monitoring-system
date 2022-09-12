<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
       $this->load->library('form_validation');
       $this->load->helper('cookie');
    }
    public function index()
    {
        $this->isLoggedIn();
       $this->load->model('login_model');

        $this->form_validation->set_rules('useremail', 'User Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

       if ($this->form_validation->run() == FALSE){
            $data['title'] = 'Login';
            //$this->load->view('templates/header',$data);
            if(get_cookie('useremail'))
            {
                $data['useremail']      =  base64_decode(base64_decode(base64_decode(get_cookie('useremail'))));
                $data['userpassword']   =  base64_decode(base64_decode(base64_decode(get_cookie('userpassword'))));
            }
            else
            {
                $data['useremail']      = '';
                $data['userpassword']       = '';
            }
            
            $this->load->view('login.php',$data);
            //$this->load->view('templates/footer');
        }
        else{
            
            $useremail = $this->input->post('useremail');
            $password = $this->input->post('password');
            if($this->input->post('remeber'))
            {
                set_cookie('useremail', base64_encode(base64_encode(base64_encode($this->input->post('useremail')))),'86400'); 
                set_cookie('userpassword', base64_encode(base64_encode(base64_encode($this->input->post('password')))),'86400'); 
            }
            
            //retrive data from user table
            $row   =   $this->login_model->get_user($useremail);
            if(!empty($row)){

                if(base64_encode(md5($password))==$row['user_pass']){
                    //insert data from login table
                    // session create
                     $this->session->user_email = $useremail;
                     $this->session->user_type  = $row['user_role'];
                     $this->session->uid        = $row['USER_ID'];
                     $this->session->user_name  = $row['user_name'];
                     $this->session->user_img   = $row['user_img'];

                     if($row['user_pass']==base64_encode(md5($row['user_email'])))
                     {
                        $this->session->user_firstlogin   = 'Yes';
                        redirect('profile');
                     }
                     else
                     {
                        redirect('dashboard');    
                     }
                }
                else{
                    
                    $msg = array('statusType'=>'danger','statusMsg'=>'ID or Password Incorrect');
                    $this->session->set_flashdata($msg); 

            
                   redirect('login/');
                }//if
            }
            else{

                 $msg = array('statusType'=>'danger','statusMsg'=>'ID or Password Incorrect');
                 $this->session->set_flashdata($msg); 
                redirect('login');
            } //if  
                
        }//if

    }// function login

    public function logout()
    {
           $this->isNotLoggedIn();
        $this->session->sess_destroy();
        redirect('login');
    }//fun logout

}// class LoginController

?>