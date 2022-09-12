<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once('ClientInfo.php');
class Report extends MY_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->isNotLoggedIn();
		$this->load->helper(array('url','form','date'));
	    $this->load->database();
		$this->load->model('area_model');
		$this->load->model('user_model');
		$this->load->model('thana_model');
		$this->load->model('attendance_model');
		$this->load->model('challan_model');
		$this->load->model('staff_model');
		$this->load->model('station_model');
		$this->load->model('report_model');
		$this->load->library("form_validation");
	}
	public function index()
	{		
        $data['title'] = 'Report';
        $data['breadcrumbs'] = array(
        	'Home' => site_url('dashboard'),
        	'Report' =>''
        );
        $data['rsThana']= $this->thana_model->getThana();
        $data['rsArea'] = $this->area_model->getArea();
        $data['rsStaff']= $this->staff_model->getStaff();
        $data['rsChallan']= $this->challan_model->getChallan();
        $data['rsStation']= $this->station_model->getStation();
     	$this->load->view('page_header',$data);
		$this->load->view('page_left_sildebar');
		$this->load->view("report/report-form");
		$this->load->view('page_footer');
	}//eof index method

}//eof class
?>