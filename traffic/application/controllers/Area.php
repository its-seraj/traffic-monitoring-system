<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Area extends MY_Controller
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
	  	$this->load->model('staff_model');
	  	$this->load->library("form_validation");
	}
	//view of the AREA
	public function index()
	{
			$data['title']="Area";
			$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Area' => '',
				);
			$data['user'] = $this->user_model->user_detail($this->session->uid);
			$data['rsArea'] =$this->area_model->getArea();
	    	$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("area/show-area");
			$this->load->view('page_footer');
	} //end of view area
	//delete the aera
	public function delete_area($areno)
	{
	   $this->area_model->delete_area($areno);
       $msg = array('statusType'=>'success','statusMsg'=>'Record Deleted successfully.');
	   $this->session->set_flashdata($msg);
	   redirect('area');
	}//delete_area
	//view the form of area to add
	public function area_form()
	{
		$data['title']="Add area";
		$data['user'] = $this->user_model->user_detail($this->session->uid);
		$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Area' => site_url("area"),
			 'Add Area'=>'',
				);
			$data['rsstation']=$this->station_model->getStation();
			$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("area/area-form");
			$this->load->view('page_footer');
	}//this is for add the area form
	//this function is use to insert the area in to the database
	public function add_area()
	{
        $this->form_validation->set_rules('stationid','Station Name','required');
		$this->form_validation->set_rules('areCode[]','Area Code','required');
		$this->form_validation->set_rules('areName[]','Area Name','required');
		$this->form_validation->set_rules('areStatus[]','Area Status','required');
		if($this->form_validation->run()==TRUE)
		{
			$areaid['areid'] =$this->area_model->insert_area();	
			if($areaid)
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
			$this->area_form();
		}
	}
	//end of add function
	//this is for assign the area to any staff
	public function changearea()
	{
		$id	 =$this->input->post('id');
		$areaid	 =$this->input->post('areaid');
		$data['areaupdateid'] = $this->staff_model->areaUpdate($id,$areaid);
	}
	//end of change area function
	//get the single line of the area content for edit 
    public function get_area_record()
    {
    	 $data['rowarea'] 	=   $this->area_model->getarea();
    	 echo  json_encode($data);
    }//for the ajax value idn question added form
    public function get_area_record_by_id()
    {
    	
    	$data['rowArea']=$this->area_model->getArea_byid($sid= $this->input->post('sid'));
    	echo json_encode($data);

    }
    //get the edit form to edit any area
    public function edit_area_form($areano)
    {
       	$data['rowArea']=$this->area_model->getArea($aid=$areano);
       	$data['title']="Edit Area";
		$data['rsstation']=$this->station_model->getStation();
		$data['breadcrumbs'] = array(
			 'Home' => base_url('dashboard'),
			 'Area' => site_url("area"),
			 'Edit Area'=>'',
			);
       	$this->load->view('page_header',$data);
       	$this->load->view('page_left_sildebar');
		$this->load->view("area/area-edit");
		$this->load->view('page_footer');
    }
    //this is for update query in the area
    public function edit_area()
    {

    	$this->form_validation->set_rules('areaid','Area ID','required');
		$this->form_validation->set_rules('areCode','Area Code','required');
		$this->form_validation->set_rules('areName','Area Name','required');
		$this->form_validation->set_rules('areStatus','Area Status','required');
		$this->form_validation->set_rules('stationid','Station ID','required');
		if($this->form_validation->run()==TRUE)
		{
			$subid['subid'] =$this->area_model->update_area();	
			$msg = array('statusType'=>'success','statusMsg'=>'Record Updated successfully.');
   			$this->session->set_flashdata($msg);
			$this->index();
		}
		else
		{
			$this->edit_area_form($this->input->post('areaid'));
		}
    }
    //end of the update area
}
?>