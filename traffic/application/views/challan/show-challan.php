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
        <?php if($this->session->user_type==0){ ?>
         <a class="btn btn-primary ml-3" href="<?=base_url("challan/challan_form")?>">
          <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Challan
        </a>
      <?php } ?>
      </center>
    <div class="table-responsive">
      <table class="myTable  table table-bordered table-striped">
          <thead>
            <tr>
                <th>#</th>
                <th>Challan Code</th>
                <th>Challan Detail</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Status</th>
              <?php  if($this->session->user_type==0)
                  { ?>
                <th>Action</th>
                <?php } ?>
            </tr>
          </thead>
        <tbody>
          <?php
           if(!empty($rsChallan)){
            $i = 0;
            foreach($rsChallan as $row){
              $link      = site_url("challan/delete_challan/".$row['CT_ID']);
              echo '<tr>
                        <td>'.++$i.'</td>
                        <td>'.$row['ct_no'].'</td>
                        <td>'.$row['ct_detail'].'</td>
                        <td>'.($row['tv_sort_name']!=''?$row['tv_sort_name'].'('.$row['tv_name'].')':'All').'</td>
                        <td>'.$row['ct_amount'].'</td>
                        <td>';
                           if($row['ct_status']==1){
                            echo '<small class="badge badge-success">Active</small>';
                           }else{
                            echo '<small class="badge badge-danger">Inactive</small>';
                           }
                   echo '</td>';
                  if($this->session->user_type==0)
                  { 
                   echo '<td><a class="btn btn-primary" href="'.base_url("challan/edit_challan_form/".$row['CT_ID']).'">
                                <i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-danger" onclick="deleteModal('."'".$link."'".')">
                             <i class="fa fa-trash"></i>
                            </button> 
                            </td>';
                  }echo'
                                  
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


</script>
<script type="text/javascript">
        $(function(){
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-challan').addClass("active");
        });
    </script>

