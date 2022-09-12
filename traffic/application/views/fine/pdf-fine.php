<?php
require_once 'assets/vendor/mpdf/vendor/autoload.php';
$mpdf = new  \Mpdf\Mpdf(['UTF-8']);
ob_start();
//print_r($rsFine);
      ?>
      <link rel="stylesheet" href="<?= base_url("assets/vendor/bootstrap/css/bootstrap.min.css")?>">
     <div style="text-align: center;">
     	<h2><?= $rsFine['arecode'].'('.$rsFine['arename'].')'?></h2>
     	<h4>Durg, C.G.</h4>
     	<p>--------------------------------------------------------------------------------------------------------------</p>
     </div>
     <div>
     	<div class="row">
	 			<div class="col-xs-offset-3 col-xs-2">Vehicle No</div>
	 			<div class="col-xs-1">:</div>
	 			<div class="col-xs-4"><?=  $rsFine['fine_vehicle_no'];?></div>
	     	
	     		<div class="col-xs-offset-3  col-xs-2">Officer</div>
	     		<div class="col-xs-1">:</div>
	     		<div class="col-xs-4"><?=  $rsFine['fine_username'];?></div>

	     		<div class="col-xs-offset-3 col-xs-2">Payment Date</div>
	     		<div class="col-xs-1">:</div>
	     		<div class="col-xs-4"><?=  $rsFine['fine_Date'];?></div>
	     	
	     		<div class="col-xs-offset-3 col-xs-2">Transaction ID</div>
	     		<div class="col-xs-1">:</div>
	     		<div class="col-xs-4"><?=  $rsFine['fine_transaction_id'];?></div>
	     		<div class="col-xs-offset-3 col-xs-2">Person Name</div>
	     		<div class="col-xs-1">:</div>
	     		<div class="col-xs-4"><?=  $rsFine['fine_name'];?></div>
	     		<div class="col-xs-offset-3 col-xs-2">Vehicle Name</div>
	     		<div class="col-xs-1">:</div>
	     		<div class="col-xs-4"><?=  $rsFine['fine_vehicle_type'];?></div>
     	</div>
     	<div style="text-align: center;">
     	<p>--------------------------------------------------------------------------------------------------------------</p>
     </div>
      <div class="row">
	     	 <div class="col-xs-offset-3 col-xs-2">Fine Detail</div>
	 			<div class="col-xs-1">:</div>
	 			<div class="col-xs-4">Amount</div></div><br>
	     <div class="row">
	     	<?php 
	     //	print_r($rsReason);
	     	$totalAmount =0;
	     	for ($i=0; $i <count($rsReason) ; $i++) { 
	     		echo '<div class="col-xs-offset-3 col-xs-2">'.$rsReason[$i]['ct_no'].'('.$rsReason[$i]['ct_detail'].')</div>
	 			<div class="col-xs-1">:</div>
	 			<div class="col-xs-4">'.$rsReason[$i]['ct_amount'].'</div>';
	 			$totalAmount = $totalAmount + $rsReason[$i]['ct_amount'];
	     	}

	     	 echo '</div>
	     	 <div style="text-align: center;">
	     		 <p>--------------------------------------------------------------------------------------------------------------</p>
	     	 </div>
	     	 <div class="row">
		     	 <div class="col-xs-offset-3 col-xs-2">Grand Total</div>
		 		 <div class="col-xs-1">:</div>
		 		 <div class="col-xs-4">'.$totalAmount.'</div>
	 		 </div>';
	     	?>
	     	
	     	
	     		
	     </div>
     </div>
<?php
  $html = ob_get_contents();
  ob_end_clean();
  $mpdf->AddPage('L'); 
  $mpdf->WriteHTML($html);
  $mpdf->SetTitle("Traffic Reciept" );
  $mpdf->Output();
?>
