<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->helper(array('url','form','date'));
	    $this->load->database();
	  	$this->load->library('session');
	  	$this->load->model('user_model');
	  	$this->load->model('thana_model');
	  	$this->load->model('area_model');
	  	$this->load->model('station_model');
		$this->load->model('staff_model');
		$this->load->model('thana_model');
	  	$this->load->model('notification_model');
	  	$this->load->model('challan_model');
	  	$this->load->model('fine_model');
	}
	//view the dashboard
	public function index()
	{
		if($this->session->user_email)
		{
			$data['title']="Dashboard";
			$data['breadcrumbs'] = array(
				 'Home' => '',
					);
			$data['countStation'] 	= $this->station_model->getStation();
			//count of station
			$data['countArea']		= $this->area_model->getArea();
			//count of area
			$data['countChallan']   = $this->challan_model->getChallan();
			//count of challan
			$data['countNote'] 		= $this->notification_model->getNote();
			//count of notification
			$data['countFine']  	= $this->fine_model->getFine();
			//count of the fine
			$data['countStaff']		= $this->staff_model->getStaff();
			//count of the staff
			$data['countThana'] 	= $this->thana_model->getThana();
			//count of the thana Incharge

			
			$this->load->view('page_header',$data);
			$this->load->view('page_left_sildebar');
			$this->load->view("Dashboard/index");
			$this->load->view('page_footer');
		}
		else
		{
			  $msg = array('statusType'=>'danger','statusMsg'=>'Session Is not create for some resion');
                    $this->session->set_flashdata($msg); 
			redirect("");
		}
	}
	public function current()
	{
		$data['title']="Current";
        $data['breadcrumbs'] = array(
         'Home' => site_url('dashboard'),
         'Search' => '',
            );
        $data['rsStaff']    = $this->staff_model->getStaff();
        $data['rsArea']     = $this->area_model->getArea();
        $this->load->view('page_header',$data);
        $this->load->view('page_left_sildebar');
        $this->load->view("current");
        $this->load->view('page_footer');
	}
	public function getsearchresult()
	{
		$date = $this->input->post('date');
		$staff = $this->input->post('staff');
		$area = $this->input->post('area');
		if($date!='')
		{
			$data['rsResult'] = $this->staff_model->getsearch($staff,$area,$date);
			//print_r($data['rsResult']);	
			if($staff!='')
			{
				echo "<div class='row'><div class='col-sm-12'><div class='form-group'><label>Area Code:</label><input type='text' name='areacode' class='form-control' disabled value='".$data['rsResult']['arecode']."'></div></div><div class='col-sm-12'><div class='form-group'><label>Area Name:</label><input type='text' name='areacode' class='form-control' disabled value='".$data['rsResult']['arename']."'></div></div></div>";
			}
			else
			{

			if($data['rsResult']!='')
			{	echo '<div class="row table-resposive"><table class="table table-striped table-bordered "><thead><tr><th>#</th><th>Staff Name</th><th>Mobile</th><th>Email ID</th><th>Status</th></tr></thead><tbody>';
				$i =0;
				foreach ($data['rsResult'] as $value) {
					echo "<tr><td>".++$i."</td><td>".$value['user_name']."</td><td>".$value['user_mobile']."</td><td>".$value['user_email']."</td>";

					echo "<td>";

									if($value['a_status'] == 1) {
										// present
										echo  '<span class="badge badge-success">P</span>';	
									} else if($value['a_status'] == 2) {
										// absent
										echo  '<span class="badge badge-danger">A</span>';	
									} else if($value['a_status'] == 3) {
										// late
										echo  '<span class="badge badge-primary">L</span>';	
									} else {
										// undefined
										echo  '<span class="badge badge-warning">UN</span>';	
									}
					echo "</td>";
					echo "</tr>";
				}

				echo '<tbody></table></div>';
			}
			}
		}
		else if($staff!='')
		{
			 $data['rsResult'] =$this->staff_model->getStaff($staff);
			 echo "<div class='row'><div class='col-sm-12'><div class='form-group'><label>Area Code:</label><input type='text' name='areacode' class='form-control' disabled value='".$data['rsResult']['arecode']."'></div></div><div class='col-sm-12'><div class='form-group'><label>Area Name:</label><input type='text' name='areacode' class='form-control' disabled value='".$data['rsResult']['arename']."'></div></div></div>";
			//print_r($data['rsResult']);
		}
		else
		{
			 $data['rsResult'] = $this->staff_model->get_staff_attendance($area);
			//print_r($data['rsResult']);
			if($data['rsResult']!='')
			{	echo '<div class="row table-resposive"><table class="table table-striped table-bordered "><thead><tr><th>#</th><th>Staff Name</th><th>Mobile</th><th>Email ID</th></tr></thead><tbody>';
				$i =0;
				foreach ($data['rsResult'] as $value) {
					echo "<tr><td>".++$i."</td><td>".$value['user_name']."</td><td>".$value['user_mobile']."</td><td>".$value['user_email']."</td></tr>";
				}

				echo '<tbody></table></div>';
			}
		}
		
	}

}
?>