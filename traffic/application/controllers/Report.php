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
		$this->load->model('fine_model');
		$this->load->model('challan_model');
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
	public function getreport()
	{
		if($this->session->user_type!=0)
		{
			redirect("dashboard");
		}
		$thana 		= $this->input->post('thana');
		$station 	= $this->input->post('station');
		$area 		= $this->input->post('area');
		$staff 		= $this->input->post('staff');
		$challan 	= $this->input->post('challan');

		if(($thana!='' || $station!='') && $area=='' && $staff=='' && $challan=='')
		{
			if($station!='' || $thana!='')
			{
				if($station!='')
				{
					$data  =$this->report_model->getReportByStation($station);	
				}
				else
				{
					$data  =$this->report_model->getReportByThana($thana);		
				}

                $a = $data['secondrow'];
              	$arename= array();
                $arecode= array();
                $total  = array();
                $totalAmount = array();
                foreach ($data['secondrow'] as $value) {

                	if(!in_array($value['arename'] ,$arename))
                	{
                		array_push($arename, $value['arename']);
                	}
                	if(!in_array($value['arecode'] ,$arecode))
                	{
                		array_push($arecode, $value['arecode']);
                	}
                }
                for ($ki=0; $ki <count($arecode) ; $ki++) { 
                	foreach ($data['secondrow'] as $value) {
                		if($value['arecode']==$arecode[$ki])
                		{
                			array_push($total,array($value['arecode'] => array($value['user_name'],$value['user_email'],$value['user_mobile'])));
                		}
                	}
                	foreach ($data['thirdrow'] as  $value2) {
                		if($value2['arecode']==$arecode[$ki])
                		{

                		array_push($totalAmount,array($value2['arecode'] => array($value2['fine_name'],$value2['fine_vehicle_no'],$value2['fine_vehicle_type'],$value2['fine_gruop'],$value2['total_fine'],$value2['fine_username'],$value2['fine_transaction_id'],$value2['fine_Date'])));	
                		}
                	}
                }
				$imgfile =  "assets/profile/user/user.png";
				$username = "Not Incharge";
				if($data['firstrow']['user_img']!='')
				{
					$imgfile = $data['firstrow']['user_img'];
				}
				if($username!='')
				{
					$username = $data['firstrow']['user_name'];
				}

				echo '
				<div class="col-sm-4">
					<div class="card-body box-profile">
			                <div class="text-center">
			                  <img class="profile-user-img img-fluid img-circle" src="'.base_url($imgfile).'" alt="User profile picture">
			                </div>

			                <h3 class="profile-username text-center">'.$username.'</h3>

			                <p class="text-muted text-center">Thana Incharge</p>

			                <ul class="list-group list-group-unbordered mb-3">
			                  <li class="list-group-item">
			                    <b>Station </b> <a class="float-right">'.$data['firstrow']['sname'].'</a>
			                  </li>
			                  <li class="list-group-item">
			                    <b>Mobile No.</b> <a class="float-right">'.$data['firstrow']['user_mobile'].'</a>
			                  </li>
			                  <li class="list-group-item">
			                    <b>Email ID</b> <a class="float-right">'.$data['firstrow']['user_email'].'</a>
			                  </li>
			                </ul>
			                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
	              	</div>
             	</div>';
             echo '<div class="col-sm-8">
             <br/>
		             <div class="card">
		              <div class="card-header border-2">
		                <h3 class="card-title">Areas</h3>
		              </div>
		              <div class="card-body p-0">
		                <table class="table table-striped table-valign-middle">
		                  <thead>
		                  <tr>
		                  	<th>No. </th>
		                    <th>Area Code</th>
		                    <th>Area Name</th>
		                    <th>Total Employee</th>
		                    <th>Count Fine</th>
		                    <th>Total Fine</th>
		                  </tr>
		                  </thead>
		                  <tbody>';
		                  $j=0;
		                  if($arecode)
		                  	for ($i=0; $i <count($arecode) ; $i++) { 
		                  		echo '<tr><td>'.++$j.'</td>
		                  				  <td>'.$arecode[$i].'</td>
		                  				  <td>'.$arename[$i].'</td>
		                  				  ';
		                  				  $countvalue = 0;
		                  				  $showemployee =  array();
		                  				  foreach ($total as $key => $value2) {
		                  				  		if(!empty($value2[$arecode[$i]][0]))
		                  				  		{
		                  				  			 $countvalue++;
		                  				  			 array_push($showemployee,$value2[$arecode[$i]]);
		                  				  		}
		                  				  }
		                  				  $showemployee =json_encode($showemployee);
		                  				  echo '<td><button name="getList" data-jsonvalue='."'".$showemployee."'".' type="button" class="btn btn-info btn-md ">'.$countvalue.'</button></td>';
		                  				  $countvalue = 0;
		                  				  $totalAmountsum = 0;
		                  				  $showfine = array();
		                  				  foreach ($totalAmount as $key => $value3) {
		                  				  	if(!empty($value3[$arecode[$i]][0]))
		                  				  		{
		                  				  			 $countvalue++;
		                  				  			$totalAmountsum = $totalAmountsum +array_sum(json_decode($value3[$arecode[$i]][4],true));	 
		                  				  			 array_push($showfine,$value3[$arecode[$i]]);
		                  				  		}
		                  				  }
		                  				  $showfine =json_encode($showfine);
		                  				  echo '
		                  				  <td><button name="getListDetail" data-jsonvalue='."'".$showfine."'".' type="button" class="btn btn-info btn-md ">'.$countvalue.'</button></td>
		                  				  <td>'.$totalAmountsum.'</td>'; 
		                  				  $countvalue = 0;
		                  				  $totalAmountsum = 0;

		                  				  echo '
		                  			  </tr>';
		                  	}
		                  echo '</tbody>
		                </table>
		              </div>
		            </div>
             	</div>';
             	?>
             	<script type="text/javascript">
             		$('button[name="getList"]').click(function(){
				       var jsonvalue  = $(this).data('jsonvalue');
				       console.log(jsonvalue);
				       var  content  = "<table class='table table-bordered table-striped '><thead><tr><th>No.</th><th>Name</th><th>Email Id</th><th>Mobile No.</th></tr></thead><tbody>";
				       var jk =1;
				       for(var j=0; j<jsonvalue.length;j++)
				       {
				       //	colval =  jsonvalue[j].split(",");
				        content = content + "<tr><td>"+jk+"</td><td>"+jsonvalue[j][0]+"</td><td>"+jsonvalue[j][1]+"</td><td>"+jsonvalue[j][2]+"</td></tr>";
				        jk++;
				       }
				       content = content + "</tbody></table>";
				       
				        $('#myModal').modal();
				        $('#myModal .modal-title').html("List of Employee");
				        $('#myModal .modal-body').html(content);

				      });
             		$('button[name="getListDetail"]').click(function(){
				       var jsonvalue  = $(this).data('jsonvalue');
				       console.log(jsonvalue);
				       var  content  = "<table class='table table-bordered table-striped '><thead><tr><th>No.</th><th>Transaction ID</th><th>Name</th><th>Type</th><th>Vehicle No</th><th>Incharge</th><th>Date</th><th>Reson</th><th>Amount</th></tr></thead><tbody>";
				       var jk =1;
				       console.log(jsonvalue);
				       for(var j=0; j<jsonvalue.length;j++)
				       {
				     
				       //	colval =  jsonvalue[j].split(",");
				      var amount = jsonvalue[j][4].replace(/\[/g, "");
				          amount = amount.replace(/\"/g,'');
				          amount = amount.replace(/\]/g,'');
				      var totalreson  = jsonvalue[j][3].replace(/\[/g, "");
				       	  totalreson  = totalreson.replace(/\"/g,'');
				          totalreson  = totalreson.replace(/\]/g,'');
				          totalreson  = totalreson.replace(/\,/g,'');
				        content = content + "<tr><td>"+jk+"</td><td>"+jsonvalue[j][6]+"</td><td>"+jsonvalue[j][0]+"</td><td>"+jsonvalue[j][2]+"</td><td>"+jsonvalue[j][1]+"</td><td>"+jsonvalue[j][5]+"</td><td>"+jsonvalue[j][7]+"</td><td>"+totalreson.length+"</td><td>"+amount+"</td></tr>";
				        jk++;
				       }
				       content = content + "</tbody></table>";
				       
				        $('#myModal').modal();
				        $('#myModal .modal-title').html("List of Fine");
				        $('#myModal .modal-body').html(content);

				      });
             	</script>
             	<?php
			}
		}
		else if($staff!='')
			{
				$data['firstrow'] = $this->report_model->getReportByStaff($staff);
				$data['rsFine'] =$this->fine_model->getFine();
				$data['rsChallan'] =$this->challan_model->getChallan();
			/*	echo "<pre>";
				print_r($data);*/
				$imgfile =  "assets/profile/user/user.png";
				$username = "Not Incharge";
				if($data['firstrow']['user_img']!='')
				{
					$imgfile = $data['firstrow']['user_img'];
				}
				if($username!='')
				{
					$username = $data['firstrow']['user_name'];
				}
				
				echo '
				<div class="col-sm-4">
					<div class="card-body box-profile">
			                <div class="text-center">
			                  <img class="profile-user-img img-fluid img-circle" src="'.base_url($imgfile).'" alt="User profile picture">
			                </div>

			                <h3 class="profile-username text-center">'.$username.'</h3>

			                <p class="text-muted text-center">Thana Staff</p>

			                <ul class="list-group list-group-unbordered mb-3">
			                  <li class="list-group-item">
			                    <b>Station </b> <a class="float-right">'.$data['firstrow']['sname'].'</a>
			                  </li>
			                  <li class="list-group-item">
			                    <b>Area </b> <a class="float-right">'.$data['firstrow']['arecode'].'('.$data['firstrow']['arename'].')</a>

			                  </li>
			                  <li class="list-group-item">
			                    <b>Mobile No.</b> <a class="float-right">'.$data['firstrow']['user_mobile'].'</a>
			                  </li>
			                  <li class="list-group-item">
			                    <b>Email ID</b> <a class="float-right">'.$data['firstrow']['user_email'].'</a>
			                  </li>
			                </ul>
			                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
	              	</div>
             	</div>';
             echo '<div class="col-sm-8"><br/>
		             <div class="card">
		              <div class="card-header border-2">
		                <h3 class="card-title">Fines</h3>
		              </div>
		              <div class="card-body p-0">
		                <table class="table table-striped table-valign-middle">
		                  <thead>
		                  <tr>	
		                  	<th>No. </th>
		                    <th>Transaction ID</th>
		                    <th>Name</th>
		                    <th>Type</th>
		                    <th>Vehicle No</th>
		                    <th>Date</th>
		                     <th>Amount</th>
		                  </tr>
		                  </thead>
		                  <tbody>';
		                  $j=0;
		                  if($data['rsFine'])
		                  	for ($i=0; $i <count($data['rsFine']) ; $i++) { 
		                  		if($data['rsFine'][$i]['fine_userid']== $data['firstrow']['USER_ID'])
		                  		{
		                  			echo '<tr><td>'.++$j.'</td>
		                  				  <td>'.$data['rsFine'][$i]['fine_transaction_id'].'</td>
		                  				  <td>'.$data['rsFine'][$i]['fine_name'].'</td>
		                  				  <td>'.$data['rsFine'][$i]['fine_vehicle_type'].'</td>
		                  				  <td>'.$data['rsFine'][$i]['fine_vehicle_no'].'</td>
		                  				  <td>'.$data['rsFine'][$i]['operation_date'].'</td>
		                  				  <td>'.array_sum(json_decode($data['rsFine'][$i]['total_fine'],true)).'</td>'; 
		                  				  echo '
		                  			  </tr>';
		                  		}
		                  		
		                  	}
		                  echo '</tbody>
		                </table>
		              </div>
		            </div>
             	</div>';
			}

	}

}//eof class
?>