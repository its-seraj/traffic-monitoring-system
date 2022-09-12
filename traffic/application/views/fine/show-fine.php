<div class="col-sm-12">
	<div class="card">  
    <div class="card-header">
      <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
       <?php 
        //id or password incorrect
        if($this->session->flashdata('statusType'))
        {
            echo '<div class="alert alert-'.$this->session->statusType.' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <p>'.$this->session->statusMsg.'</p>
                  </div>
            ';
        }
      ?>
       <center>
         <a class="btn btn-primary ml-3" href="<?=base_url("fine/fine_form")?>">
          <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fine
        </a>
      </center>
    <div class="table-responsive">
      <table class="myTable  table table-bordered table-striped">
          <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Vehicle Number</th>
                <th>Area</th>
                <th>Vehicle Type</th>
                <th>Transaction ID </th>

                <th>Reson</th>
                <th>Total Fine</th>
                <th>Person Name</th>
                <th>Action</th>
            </tr>
          </thead>
        <tbody>
          <?php
           if(!empty($rsFine)){
            $i = 0;
            foreach($rsFine as $row){
              $link      = site_url("fine/delete_fine/".$row['FID']);
              $pdflink   = site_url("fine/pdf_fine/".$row['FID']);
              if($this->session->user_type==3)
              {
                if($this->session->uid == $row['fine_userid'])
                {
                   echo '<tr>
                        <td>'.++$i.'</td>
                        <td>'.$row['fine_name'].'</td>
                        <td>'.$row['fine_vehicle_no'].'</td>
                        <td>'.($row['arecode']!=''?$row['arecode'].'('.$row['arename'].')':'').'</td>
                        <td>'.$row['fine_vehicle_type'].'</td>
                        <td>'.$row['fine_transaction_id'].'</td>
                        <td><button name="getRecord" type="button" data-id="'.$row['FID'].'" class="btn btn-md btn-primary">'.count(json_decode($row['fine_gruop'],true)).'</button></td>
                        <td>'.array_sum(json_decode($row['total_fine'],true)).'</td>
                        <td>'.$row['fine_username'].'</td>
                        <td>';
                  if($this->session->user_type==0 || $this->session->user_type==2){ 
                         echo '
                            <button class="btn btn-danger" onclick="deleteModal('."'".$link."'".')">
                             <i class="fa fa-trash"></i>
                            </button> '; 
                          }

                            echo '
                            <a class="btn btn-info" href="'.$pdflink.'" title="Pdf Table"> <i class="fa fa-file"></i></a>';
                          echo'</td>
                                  
                    </tr>'; 

                }

              }
              else
              {

              echo '<tr>
                        <td>'.++$i.'</td>
                        <td>'.$row['fine_name'].'</td>
                        <td>'.$row['fine_vehicle_no'].'</td>
                        <td>'.($row['arecode']!=''?$row['arecode'].'('.$row['arename'].')':'').'</td>
                        <td>'.$row['fine_vehicle_type'].'</td>
                        <td>'.$row['fine_transaction_id'].'</td>
                        <td><button name="getRecord" type="button" data-id="'.$row['FID'].'" class="btn btn-md btn-primary">'.count(json_decode($row['fine_gruop'],true)).'</button></td>
                        <td>'.array_sum(json_decode($row['total_fine'],true)).'</td>
                        <td>'.$row['fine_username'].'</td>
                        ';
                  if($this->session->user_type==0 || $this->session->user_type==2){ 
                         echo '<td>
                            <button class="btn btn-danger" onclick="deleteModal('."'".$link."'".')">
                             <i class="fa fa-trash"></i>
                            </button> 
                            <a class="btn btn-info" href="'.$pdflink.'" title="Pdf Table"> <i class="fa fa-file"></i></a></td>';
                            }echo'
                                  
                    </tr>'; 
              }
            }//foreach
           }//if
          ?>
       </tbody>
      </table>
    </div>
   </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!--/.col-sm-12-->
<style>
  .error p{
    background-color: #5F5F5F;
    padding: 5px;
    color:white;
  }
</style>
<script>
  $(document).ready( function () {
    $('.myTable').DataTable({
    
    });
  });
//=========================Delete package==============================
	function deleteModal(link)
	{
		$('.modal-title').html('Confirm');
		$('.modal-body').html('Are you sure do you really want to delete this record?');
		$('.modal-footer').html('<a href="'+link+'" class="btn btn-danger">Delete</a> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		 $('#myModal').modal('show'); 
	}// fun deleteModal
//-------------------------------------------------------------
 $('button[name="getRecord"]').click(function(){
   var id = $(this).data('id');
   $.ajax({
    url:'<?= site_url("fine/show_reason");?>',
    data:{id:id},
    type:'post',
    dataType:'json',
    success:function(json)
    {
        content = '<div class="row table-responsive"><table class="table table-striped table-bordered"><thead><th>#</th><th>ID</th><th>Reason</th><th>Amount</th></thead><tbody>';
        for(var i=0; i<json['rsReason'].length; i++)
        {
          console.log("hello");
          content = content + "<tr><td>"+(i +parseInt(1))+"</td><td>"+json['rsReason'][i]['ct_no']+"</td><td>"+json['rsReason'][i]['ct_detail']+"</td><td>"+json['rsReason'][i]['ct_amount']+"</td></tr>";
        } 
        content = content + '</tbody></table></div>';
        $('#myModal').modal();
        $('#myModal .modal-title').html("Reason");
        $('#myModal .modal-body').html(content);
    }
   });
 });

</script>
<script type="text/javascript">
        $(function(){
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-fine').addClass("active");
        });
    </script>

