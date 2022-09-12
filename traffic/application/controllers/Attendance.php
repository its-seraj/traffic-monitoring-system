<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once('ClientInfo.php');
class Attendance extends MY_Controller 
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
		$this->load->model('staff_model');
		$this->load->library("form_validation");
	}
	public function index()
	{
		
		if($this->session->user_type==3)
		{
			redirect("dashboard");
		}
        $data['title'] = 'Attendance';
        $data['breadcrumbs'] = array(
        	'Home' => site_url('dashboard'),
        	'Attendance' =>''
        );
        $data['areas'] = $this->area_model->getArea();
     	$this->load->view('page_header',$data);
		$this->load->view('page_left_sildebar');
		$this->load->view("attendance/take_attendance");
		$this->load->view('page_footer');
	}//eof index method

	public function report()
	{
		if($this->session->user_type==3)
		{
			redirect("dashboard");
		}
		 $data['title'] = 'Attendance';
        $data['breadcrumbs'] = array(
        	'Home' => site_url('dashboard'),
        	'Attendance Report' =>''
        );
        $data['areas'] = $this->area_model->getArea();
     	
		$this->load->view('page_header',$data);
		$this->load->view('page_left_sildebar');
		$this->load->view('attendance/report_attendance');
		$this->load->view('page_footer');
	}//eof index method

	public function get_client(){
		$this->load->model('client_model');
		$this->client_model->get_client();
	}

	public function create_attendance()
	{		
		$attendance = $this->attendance_model->create_attendance();
		$msg = array('statusType'=>'success','statusMsg'=>'Attendance submitted successfully');
		$this->session->set_flashdata($msg);	
		redirect('attendance');	
	}
	/**
	 * [load_batch returns Batch drop down list based on the brach id]
	 * @return [type] [description]
	 */
	function load_batch(){
		$branch_id = $this->input->post('branch_id');
		$branch_id = 1;
		$batch_data = $this->batch_model->get_batch_by_branch($branch_id);
		$data = array();
		foreach ($batch_data as $batch) {
			$data[] = ['batch_id' => $batch['BATCH_ID'],'batch_name'=>$batch['batch_name']];
		}
		echo json_encode($data);
	}

		/*
	*------------------------------------------------
	* fetches the branch, batch student, teacher info
	* into the table to a_status the attendance	
	* a_type varaible will check the attenadnce type
	* @a_type=1  for client or @a_type=0 for staff
	* //note:-staff_data is stored in $client_data variable
	*------------------------------------------------
	*/
	public function get_attendance_table() 
	{		
			$areaid	= $this->input->post('area');
			$arearow = $this->area_model->getArea($areaid);
			$client_data = $this->staff_model->get_staff_attendance($areaid);
				//note:-staff_data is stored in $client_data variable
		/*	print_r($areaid);
			print_r($arearow);
			print_r($client_data);*/
			$type = 1; //0 for ti and 1 for staff
			$date = $this->input->post('date');

			
			$div = '
			<div class="card">
		    <div class="jumbotron">
		    	<label>Attendance Type</label> : Staff <br />';		    
	    	$div .= '<label>Area Code</label> : '.$arearow['arecode'].' <br />';

	    	$div .=	'<label>Area Name</label> : '.$arearow['arename'].' <br />';
		    $div .=	'
		    </div>		
		    <div id="attendance-message"></div>
			<div class="col-md-12">
		    <form method="post" action="'.base_url('attendance/create_attendance').'" id="createAttendanceForm">
		    <input type="hidden" name="attendanceDate" value ="'.$date.'" >
		    <input type="hidden" name="Usertype" value ="'.$type.'" >
		    <input type="hidden" name="areaid" value ="'.$arearow['AREAID'].'" >
		    <input type="hidden" name="areaname" value ="'.$arearow['arecode'].'('.$arearow['arename'].')" >


			    <table class="table table-bordered">
			    	<thead>
			    		<tr>
			    			<th style="width:60%;">Name</th>
			    			<th style="width:40%;">Action</th>
			    		</tr>
			    	</thead>
			    	<tbody>';
			    	if($client_data) {
			    		foreach ($client_data as $key => $value) {
			    			// fetch attedance information through date, branch id, batch id, and a_type id
							$attedance_data = $this->attendance_model->get_attendance_status($value['USER_ID'],$date,$type);
					
				    		$div .= '<tr>
				    			<td>
				    				'.$value['user_name'] .'
				    				<input type="hidden" name="client_id[]" id="client_id" value="'.$value['USER_ID'].'" />
				    			</td>
				    			<td>
				    				<select name="attendance_status[]" id="attendance_status" class="form-control">
				    					<option value="" '; 
										if($attedance_data['a_status'] == 0){ 
											$div .= 'selected';
										}
										$div .= '></option>
				    					<option value="1" '; 
										if($attedance_data['a_status'] == 1){ 
											$div .= 'selected';
										}
										$div .= '>Present</option>
				    					<option value="2" '; 
										if($attedance_data['a_status'] == 2){ 
											$div .= 'selected';
										}
										$div .= '>Absent</option>
				    					<option value="3" '; 
										if($attedance_data['a_status'] == 3){ 
											$div .= 'selected';
										}
										$div .= '>Leave</option>
				    				</select>
				    			</td>
				    		</tr>';
				    		
				    	} // /foreach
			    	} // /if
			    	else {
			    		$div .= '<tr>
			    			<td colspan="3"><center>No Data Available</center></td>
			    		</tr>';
			    	}		    	
			    	$div .= '</tbody>
			    </table>

			    <center>
			    	

			    	<button type="submit" class="btn btn-primary mb-3">Save Changes</button>
			    </center>

		    </form>
		    </div>
		    </div><!--/card-->
			';
			
			echo $div;
		
	}//eof fucntion  get_attendance_table



	/**
	 * [report description]
	 * @param  [type] $a_type     [1-client, 0-staff]
	 * @param  [type] $reportDate [yyyy-mm]
	 * @param  [type] $branch_id  [description]
	 * @param  [type] $batch_id   [description]
	 * @return [type]             [description]
	 */
	public function process_report()
	{		
		$areaid 	= $this->input->post('areaid');
		$reportDate	= $this->input->post('date');
		$a_type 	= $this->input->post('type');

		$year  = date('Y', strtotime($reportDate));
		$month = date('m', strtotime($reportDate));
		$days  = cal_days_in_month(CAL_GREGORIAN,$month, $year);//no of days in selected month	
		
		$arearow = $this->area_model->getArea($areaid);	
		if($a_type == 1 || $a_type == 0) {
			if($a_type == 0 ){
				// 
			}
			else{
				//staff related info
				$type = 'Staff';
				$primary_key = 'STAFF_ID';
				$name = 'staff_name';
				$client_data = $this->staff_model->get_staff_attendance($areaid);
				//note:-staff_data is stored in $client_data variable
			}

			$div = '
			<div class="card">
			<div class="jumbotron">
				<center>
					<h4>Attendance Type : '.$type.'</h4>
					';
					$div .= '<label>Area Code</label> : '.$arearow['arecode'].' <br />';

	    	$div .=	'<label>Area Name</label> : '.$arearow['arename'].' <br />';
		    
					
				$div .=	'
					<h4>Year : '.$year.' Month : '.$month.'</h4>		
					<small>	
						P : Present <br />				
						A : Absent <br />
						L : Leave <br />
						UN : Undefined <br />
					</small>
				</center>
			</div>

			<div style="overflow-x:auto;">			
			<table class="table table-bordered" style="width:100%;" >			
				<tbody style="width:100%;">
					<tr>
						<td style="width:25%;">Name</td>
						';		
						// loop for days
						for($i = 1; $i <= $days; $i++) {
							$div .= '
								<td style="width:10%;">'.$i.'</td>';	
						} // /for
					$div .= '</tr>';
						
					
					foreach ($client_data as $key => $value) {
						$client_name = $value['user_name'];
						$div .= '
							<tr>
							<td>'.$client_name.'</td>';

							
							$a_data = $this->attendance_model->get_attendance_status_month($areaid, $year.$month, $a_type, $value['USER_ID']);
							//echo'<pre>';print_r($a_data);
							for($i = 01; $i <= $days; $i++) {	
								if($i < 10){
									$j = '0'.$i;
								}
								else{
									$j = $i;
								}

								$div .= '<td>';
								$day_key = array_search($year.'-'.$month.'-'.$j, array_column($a_data, 'a_date'));
								//echo $year.'-'.$month.'-'.$j;
								if($day_key === FALSE){
									//Entry not found in attendance table
									$attendance_status = '<span class="badge badge-warning">UN</span>';
								}
								else{
									if($a_data[$day_key]['a_status'] == 1) {
										// present
										$attendance_status = '<span class="badge badge-success">P</span>';	
									} else if($a_data[$day_key]['a_status'] == 2) {
										// absent
										$attendance_status = '<span class="badge badge-danger">A</span>';	
									} else if($a_data[$day_key]['a_status'] == 3) {
										// late
										$attendance_status = '<span class="badge badge-primary">L</span>';	
									} else {
										// undefined
										$attendance_status = '<span class="badge badge-warning">UN</span>';	
									}
									
									$div .= $attendance_status;
								
									$div .= '
									</td>';	
								}
							}	
							 // /for								

						$div .= '</tr>';		
					} // /foreach
				$div .= '</tbody>
				</table>
				<div>
				<div><!--eof card-->
			<div>';			
		
		}//eof if
		echo $div;
	}

}//eof class
?>