<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model 
{
	/*
	*----------------------------------------------
	* create the attendance 
	* a_type = 1 for client
	* and 
	* a_type = 0 for teacher
	*----------------------------------------------
	*/
	public function create_attendance()
	{	
		
		$attendanceDate		=$this->input->post('attendanceDate');
		$a_type		   		 =$this->input->post('Usertype');
		$areaid		  	    =$this->input->post('areaid');
		$areaname		    =$this->input->post('areaname');
		$client_id		    =$this->input->post('client_id');
		//$attendance_status	=$this->input->post('attendance_status');

		if($a_type == 0){
			$user = 'ta_id';
		}
		elseif($a_type == 1){
			$user = 'staff_id';
		}	// client
			$i=0;
			foreach($this->input->post('client_id') as $client_id) {						
				$this->db->delete('attendance', array(
					'a_date' 	=> $this->input->post('attendanceDate'), 
					'a_type' 	=> $this->input->post('Usertype'),
					 $user		=> $client_id
				));
				
				$insert_data = array(				
					'a_date' 	=> $this->input->post('attendanceDate'), 
					'area_id' 	=> $this->input->post('areaid'), 
					'area_name' 	=> $this->input->post('areaname'), 
					'a_type' 	=> $this->input->post('Usertype'),
					'a_status' 	=> $this->input->post('attendance_status[]')[$i],
					$user		=> $client_id
				);

				$status = $this->db->insert('attendance', $insert_data);
				$i++;					
			} // /for
	}

	/*
	*----------------------------------------------
	* fetches the attendance	
	*----------------------------------------------
	*/
	public function get_attendance_status($userid,$date,$type)
	{		
			$condition = array(
				'row_delete'	=>0,
				'a_type'		=>$type,
				'a_date'		=>$date
			);
			if($type==0){//client
				$condition['ta_id'] = $userid;
			}
			elseif($type==1) {//staff
				$condition['staff_id'] = $userid;
			}
			$query = $this->db->get_where('attendance',$condition);
			return $query->row_array();

	}

	
	public function get_attendance_status_month($areaid = null, $month = null, $a_type = null, $userid = null)
	{		
			
			$sql ="select a_date, a_status from attendance where row_delete=0 AND a_type=$a_type AND area_id=$areaid AND EXTRACT(YEAR_MONTH FROM a_date)=$month";
			/*
			if($a_type==1){//client
				$sql .= " AND batch_id = $batch_id AND client_id = $client_id";
			}
			else*/if($a_type==1) {//staff
				$sql .= " AND staff_id = $userid";
			}
			$query = $this->db->query($sql);
			//echo'<pre>';print_r($query);
			return $query->result_array();

	}

	public function getAttendance($day = null, $reportDate = null, $candidateId = null, $a_type = null, $branch_id = null, $batch_id = null) {				
		
		$year = substr($reportDate, 0, 4);
		$month = substr($reportDate, 5, 7);					

		if($day < 10) {
			$day = "0".$day;
		} else {
			$day = $day;
		}

		if($a_type == 1) {
			// student		
			
			$sql = "SELECT * FROM attendance WHERE 
				date_format(attendance_date, '%Y-%m-%d') = '{$year}-{$month}-{$day}'		
				AND class_id = {$branch_id}
				AND section_id = {$batch_id}
				AND client_id = {$candidateId}			
				AND attendance_type = {$a_type}			
			";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else if($a_type == 2) {
			// teacher
			$sql = "SELECT * FROM attendance WHERE 
				date_format(attendance_date, '%Y-%m-%d') = '{$year}-{$month}-{$day}'					
				AND teacher_id = {$candidateId}
				AND attendance_type = {$a_type}			
			";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
			
	}

	

}
?>