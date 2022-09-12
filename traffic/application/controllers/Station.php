<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->isNotLoggedIn();
        $this->load->library('form_validation');
        $this->load->model("station_model");
        $this->load->model("user_model");
        $this->load->model("thana_model");
    }
    public function index()
    {
			$data['title']="Station";
			$data['breadcrumbs'] = array(
			 'Home' => site_url('dashboard'),
			 'Station' => '',
				);
			$data['user'] = $this->user_model->user_detail($this->session->uid);
			$data['rsstation']=$this->station_model->getStationRecord();
	    	$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("station/show-station");
			$this->load->view('page_footer');
    }// end function index
    //==============add station ================
    public function add_station()
    {
        $this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
        $this->form_validation->set_rules('station_name','Station Name','required');
        $this->form_validation->set_rules('station_status','Station Status','required');
        if($this->form_validation->run()==TRUE)
        {
            $stationID = $this->station_model->insert_station();
            $msg = array('statusType'=>'success','statusMsg'=>'Station Successfully Inserted');
            $this->session->set_flashdata($msg); 
            echo "1";
        }
        else
        {
            echo validation_errors();
        }
    }
    //--------------end of add station-------

    //==============delete station ================
    public function delete_station($sid)
	{
	   $this->station_model->delete_station($sid);
       $msg = array('statusType'=>'success','statusMsg'=>'Record Deleted Successfully.');
	   $this->session->set_flashdata($msg);
	   redirect('station');
	}
    //--------------end of delete station-------
    //=========Get single record for edit========
    public function get_station_singlerow()
    {
        $sid = $this->input->post('sid');
        $data['rowStation'] = $this->station_model->getStation($sid);
        echo json_encode(array("sname"=>$data['rowStation']['sname'],'sstatus'=>$data['rowStation']['sstatus'],'station_id'=>$data['rowStation']['sid']));
    }
    //--------------end of Get single record for edit-------
    //===================edit ============
    public function edit_station()
    {
        $this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
        $this->form_validation->set_rules('station_name','Station Name','required');
        $this->form_validation->set_rules('station_status','Station Status','required');
         if($this->form_validation->run()==TRUE)
        {
           $stationID = $this->station_model->update_station();
           $msg = array('statusType'=>'success','statusMsg'=>'Station Successfully Updated');
            $this->session->set_flashdata($msg); 
            echo "1";
        }
        else
        {
            echo validation_errors();
        }
    }
    //----------end of the edit station-----
    //this is for assign the area to any staff
    public function changestation()
    {
        $id  =$this->input->post('id');
        $stationid  =$this->input->post('stationid');
        $data['stationupdateid'] = $this->thana_model->stationUpdate($id,$stationid);
    }
    
}// class LoginController

?>