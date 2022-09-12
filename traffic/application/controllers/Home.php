<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	    $this->load->helper(array('url','form','date'));
	    $this->load->database();
	  	$this->load->model('notification_model');
	  	$this->load->library("form_validation");
	}
	//view the home page of the traffic
	public function index()
	{
			$data['title']="Home Page";
			$data['rsNotification'] =$this->notification_model->getNote();
	    	$this->load->view('home/index',$data);

	} //end of view class
	

}
?>