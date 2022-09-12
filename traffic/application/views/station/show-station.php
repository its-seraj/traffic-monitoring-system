
<style>

</style>
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
        <?php if($this->session->user_type==0) {?>
         <button class="btn btn-primary ml-3" onclick="addModal();">
          <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Station
        </button>
      <?php } ?>
      </center>
    <div class="table-responsive">
      <table class="myTable  table table-bordered table-striped">
          <thead>
            <tr>
                <th>#</th>
                <th>Station Name</th>
                <th>Total Area</th>
                <th>Status</th>
             <?php if($this->session->user_type==0) {?>
                <th>Action</th>
              <?php } ?>
            </tr>
          </thead>
        <tbody>
          <?php
           if(!empty($rsstation)){
            $i = 0;
            foreach($rsstation as $row){
              $link    = site_url("station/delete_station/".$row['sid']);
              echo '<tr>
                        <td>'.++$i.'</td>
                        <td>'.$row['sname'].'</td>
                        <td><button type="button" onclick="getArea('.$row['sid'].')" class="btn btn-md btn-info" >'.$row['countarea'].'</button></td>
                        <td>';
                           if($row['sstatus']==1){
                            echo '<small class="badge badge-success">Active</small>';
                           }else{
                            echo '<small class="badge badge-danger">Inactive</small>';
                           }
                   echo '</td>';
                  if($this->session->user_type==0) {
                   echo '<td>
                            <button class="btn btn-primary" onclick="editModal('.$row['sid'].')">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn btn-danger" onclick="deleteModal('."'".$link."'".')">
                             <i class="fa fa-trash"></i>
                            </button>      
                         </td>';
                       }

                         echo'         
                    </tr>';
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
<?php
// get all data packagetype and branch
echo '<script>
  
     </script>';
?>

<script>
  $(document).ready( function () {
    $('.myTable').DataTable({
    });
  });
//=========================Delete Branch==============================
	function deleteModal(link)
	{
		$('.modal-title').html('Confirm');
		$('.modal-body').html('Are you sure do you really want to delete this record?');
		$('.modal-footer').html('<a href="'+link+'" class="btn btn-danger">Delete</a> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		 $('#myModal').modal('show'); 
	}// fun deleteModal
//-------------------------------------------------------------

//======================Edit Branch modal==========================
	function editModal(sid)
  {
		$.ajax({
    			url   : '<?= site_url('station/get_station_singlerow') ?>',
    			method: 'post',
    			data  : {sid:sid},
          dataType :'json',
    			success:function(res)
            {
              var station_id = res.station_id;
              var sname     = res.sname;
              var sstatus   = res.sstatus;
              console.log(station_id+sname+sstatus);
              var stationstatus ='';
              if(sstatus==0)
                {
                 var  stationstatus='<div class="col-sm-12 form-group"><label>Status:</label><select class="form-control" name="station_status"><option value="1">Active</option><option value="0" selected>Inactive</option></select></div>';
                }
              else
                {
                 var  stationstatus='<div class="col-sm-12 form-group"><label>Status:</label><select class="form-control" name="station_status"><option value="1" selected>Active</option><option value="0">Inactive</option></select></div>';
                }
              $('#myModal').modal({backdrop:'static'});
              $('#myModal .modal-title').html("Edit Station");
              $('#myModal .modal-body').html('<form id="editStation" method="post"><input type="hidden" value="'+station_id+'" name="station_id"><div class="row"><div class="col-sm-12 error"></div><div class="col-sm-12 form-group"><label>Station Name<sup><i class="fa fa-star" style="color:red;"></i></sup></label><input type="text" class="form-control" name="station_name" value="'+sname+'" required></div>'+stationstatus+'</div>');
              $('.modal-footer').html('<button type="button" onclick="editForm()" class="btn btn-primary">Save</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></form>');
            }//end of ajax
        });
	}//efunction
//-----------------------End edit edit form modal---------------------------

//======================Edit Branch form submit==========================
  function editForm(){
    if($('input[name="station_name"]').val()=='')
    {
      alert("Station Name can't empty");
      $('input[name="station_name"]').focus();
    }
  else if($('input[name="station_status"]').val()=='')
    {
      alert("Please select any option");
      $('input[name="station_status"]').focus();
    }
  else
    {
      var url = '<?= site_url('station/edit_station'); ?>';
      $.post(url,
       $('#editStation').serialize(),
           function(res){
              if(res==1){
                location.reload();
              }
              else{
                 $('#myModal .modal-body .error').html(res);
              }
           }
      );
    }
  }//fun editForm
//-----------------------End edit form submit---------------------------

// ==============================add branch modal form=======================
function addModal()
{
   $('#myModal .modal-title').html("Add Station");
   $('#myModal .modal-body').html('<form id="stationForm" method="post"><div class="row"><div class="col-sm-12 error"></div><div class="col-sm-12 form-group"><label>Station Name<sup><i class="fa fa-star" style="color:red;"></i></sup></label><input type="text" class="form-control" name="station_name" required></div><div class="col-sm-12 form-group"><label>Status:</label><select class="form-control" name="station_status" required><option value="1" selected>Active</option><option value="0">Inactive</option></select></div></div>')
   $('.modal-footer').html('<button type="button" onclick="formSubmit()" class="btn btn-primary">Create</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></form>');
   $('#myModal').modal({backdrop:'static'}); 

}//fun addBatchModal
//---------------------------------end of te add branch modal form-----

// ==============================add branch form submit=======================
 function formSubmit(){
  if($('input[name="station_name"]').val()=='')
    {
      alert("Branch Name can't empty");
      $('input[name="station_name"]').focus();
    }
  else if($('input[name="station_status"]').val()=='')
    {
      alert("Please select any option");
      $('input[name="station_status"]').focus();
    }
  else
    {
      var url = '<?= site_url('station/add_station'); ?>';
      $.post(url,
       $('#stationForm').serialize(),
           function(res){
            if(res==1){
              location.reload();
            }
            else{

               $('#myModal .modal-body .error').html(res);
            }
           }
      );
    }
  } 
  function getArea(sid)
  {
    $.ajax({
      url:'<?= site_url('area/get_area_record_by_id')?>',
      data:{sid:sid},
      method:'post',
      dataType:'json',
      success:function(json)
      {
        
        var content = '<table class="table table-bordered table-striped"><thead><tr><th>No.</th><th>Area Code</th><th>Area Name</th><th>Status</th></tr></thead><tbody>';
        for(var i =0; i<json.rowArea.length;i++)
        {
          var a = i +parseInt(1);
          var statusContent =  '';
          if(json.rowArea[i]['arestatus']==1)
          {
            var statusContent =  '<label class="badge badge-success">Active</label>';
          }
          else
          {
            var statusContent =  '<label class="badge badge-success">Inactive</label>';
          }
          content = content +'<tr><td>'+a+'</td><td>'+json.rowArea[i]['arecode']+'</td><td>'+json.rowArea[i]['arename']+'</td><td>'+statusContent+'</td></tr>';
        }
        content = content +'</tbody></table>';
        $('#myModal').modal();
        $('#myModal .modal-title').html('Area Record');
        $('#myModal .modal-body').html(content);
        $('#myModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
      }
    })
  }
//-------------end of te add branch modal form submit-----
</script>
<!-- this function for toggle the navbar -->
<script type="text/javascript">
        $(function(){

    $('.nav-place').addClass('menu-open');
    $('.place-link').addClass('active');
    $('.nav-ar').addClass('active');

          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-station').addClass("active");
        });
</script>
