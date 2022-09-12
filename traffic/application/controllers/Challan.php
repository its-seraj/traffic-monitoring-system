<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Challan extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->isNotLoggedIn();
	    $this->load->helper(array('url','form','date'));
	    $this->load->database();
	  	$this->load->model('station_model');
	  	$this->load->model('area_model');
	  	$this->load->model('challan_model');
	  	$this->load->model('user_model');
	  	$this->load->library("form_validation");
	}
	//view challan
	public function index()
	{
			$data['title']="Challan";
			$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Challan' => '',
				);
			$data['user'] = $this->user_model->user_detail($this->session->uid);
			$data['rsChallan'] =$this->challan_model->getChallan();
	    	$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("challan/show-challan");
			$this->load->view('page_footer');
	} //end of view class
	public function delete_challan($challanno)
	{
	   $this->challan_model->delete_challan($challanno);
       $msg = array('statusType'=>'success','statusMsg'=>'Record Deleted successfully.');
	   $this->session->set_flashdata($msg);
	   redirect('challan');
	}//delete_challan
	//challan add form
	public function challan_form()
	{
		$data['title']="Add Challan";
		$data['user'] = $this->user_model->user_detail($this->session->uid);
		$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Challan' => site_url("challan"),
			 'Add Challan'=>'',
				);
			$data['rsvehicle']=$this->challan_model->getVehicle();
			$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("challan/challan-form");
			$this->load->view('page_footer');
	}//this is for add the area form
	//challan add query
	public function add_challan()
	{
		$this->form_validation->set_rules('chaCode[]','Challan Code','required');
		$this->form_validation->set_rules('chaName[]','Challan ','required');
		$this->form_validation->set_rules('chaStatus[]','Challan Status','required');
		if($this->form_validation->run()==TRUE)
		{
			$challanid['chaid'] =$this->challan_model->insert_challan();	
			if($challanid)
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
			$this->challan_form();
		}
	}
	//get the edit challan form
    public function edit_challan_form($challanno)
    {
       	$data['rowChallan']=$this->challan_model->getChallan($challanno=$challanno);
       	$data['title']="Edit Challan";
		$data['rsvehicle']=$this->challan_model->getVehicle();
		$data['breadcrumbs'] = array(
			 'Home' => base_url('dashboard'),
			 'Challan' => site_url("challan"),
			 'Edit Challan'=>'',
			);
       	$this->load->view('page_header',$data);
       	$this->load->view('page_left_sildebar');
		$this->load->view("challan/challan-edit");
		$this->load->view('page_footer');
    }
    //end of challan form
    //query for update the challan
    public function edit_challan()
    {

    	$this->form_validation->set_rules('challanid','Challan ID','required');
		$this->form_validation->set_rules('chaCode','Challan Code','required');
		$this->form_validation->set_rules('chaName','Challan Description','required');
		$this->form_validation->set_rules('chaStatus','Challan Status','required');
		if($this->form_validation->run()==TRUE)
		{
			$chaid['chaid'] =$this->challan_model->update_challan();	
			$msg = array('statusType'=>'success','statusMsg'=>'Record Updated successfully.');
   			$this->session->set_flashdata($msg);
			$this->index();
		}
		else
		{
			$this->edit_area_form($this->input->post('areaid'));
		}
    }
}
?>