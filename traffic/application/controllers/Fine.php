<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fine extends MY_Controller
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
	  	$this->load->model('fine_model');
	  	$this->load->model('user_model');
	  	$this->load->library("form_validation");
	}
	public function index()
	{
			$data['title']="Fine";
			$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Fine' => '',
				);
			$data['user'] = $this->user_model->user_detail($this->session->uid);
			$data['rsFine'] =$this->fine_model->getFine();
			$data['rsChallan'] =$this->challan_model->getChallan();
	    	$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("fine/show-fine");
			$this->load->view('page_footer');
	} //end of view class
	public function delete_fine($fine)
	{
	   $this->fine_model->delete_fine($fine);
       $msg = array('statusType'=>'success','statusMsg'=>'Record Deleted successfully.');
	   $this->session->set_flashdata($msg);
	   redirect('fine');
	}//delete_area
	public function calculate()
	{
			$id = $this->input->post('id');
			$data['amount'] = $this->fine_model->calculate($id);
			echo json_encode($data);
	}
	public function fine_form()
	{
		$data['title']="Add Fine";
		$data['user'] = $this->user_model->user_detail($this->session->uid);
		$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Fine' => site_url("Fine"),
			 'Add Fine'=>'',
				);
			$data['rsVehicle']=$this->challan_model->getVehicle();
			$data['rsChallan']=$this->challan_model->getChallan();
			$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("fine/fine-form");
			$this->load->view('page_footer');
	}//this is for add the area form_validation
	public function add_fine()
	{
		$this->form_validation->set_rules('finename','Person Name','required');
		$this->form_validation->set_rules('finenameVehicleno','Vehicle No','required');
		$this->form_validation->set_rules('finenameVehicletype','Vehicle Type','required');
		$this->form_validation->set_rules('transactionid','Transaction ID','required');
		$data['user'] = $this->user_model->user_detail($this->session->uid);
	
		if($this->form_validation->run()==TRUE)
		{
			$fineid['fineid'] =$this->fine_model->insert_fine($data['user']['area']);	
			if($fineid)
			{
				$msg = array('statusType'=>'success','statusMsg'=>'Record Inserted successfully.');
	   			$this->session->set_flashdata($msg);
				redirect("fine");
			}
			else
			{
				$msg = array('statusType'=>'danger','statusMsg'=>'Some problam occurs record not inserted.');
				$this->session->set_flashdata($msg);
				redirect("fine");
			}
		}
		else
		{
			$this->fine_form();
		}
	}
	public function show_reason()
	{
		$id = $this->input->post('id');
		$data['rsReason'] = $this->fine_model->getReson($id);
		echo json_encode($data);
	}
	public function get_area_record()
    {
    	 $data['rowarea'] 	=   $this->area_model->getarea();
    	 echo  json_encode($data);
    }//for the ajax value idn question added form
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
    public function pdf_fine($fid)
    {
    /*	$data['rsTable'] = $this->timetable_model->gettable($bid=null,$semid=null,$roomid=$roomid);
        $data['rsRoom']=$this->room_model->getRoom();
        $data['rsSubject'] = $this->subject_model->getSubject();
        $data['rsTeacher'] = $this->teacher_model->getTeacher();*/
        $data['rsFine'] =$this->fine_model->getFine($fid);
        $data['rsReason'] = $this->fine_model->getReson($fid);

        $this->load->view("fine/pdf-fine",$data);

    }
    
}
?>