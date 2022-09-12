<?php 

class MY_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function isLoggedIn()
	{
		$this->load->library('session');
		
		if($this->session->has_userdata('uid')) {
			redirect('dashboard', 'refresh');
		}

	}	

	public function isNotLoggedIn()
	{
		$this->load->library('session');

		if(!$this->session->has_userdata('uid')) {
			 $msg = array('statusType'=>'danger','statusMsg'=>'Session Is not create for some reason');
                    $this->session->set_flashdata($msg); 
			redirect('login', 'refresh');
		}
	}
}
?>
