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
      <form action="<?= base_url('fine/add_fine')?>" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Name:</label>
            <input type="text" name="finename" class="form-control" value="<?php echo set_value('finename');?>"  required>
            <span class="badge badge-danger"><?php echo form_error('finename'); ?></span>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Vehicle No: </label>
            <input type="text" name="finenameVehicleno" class="form-control" value="<?php echo set_value('finenameVehicleno');?>"  required>
            <span class="badge badge-danger"><?php echo form_error('finenameVehicleno'); ?></span>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Vehicle Type: </label>
            <input type="text" name="finenameVehicletype" class="form-control" value="<?php echo set_value('finenameVehicletype');?>"  required>
            <span class="badge badge-danger"><?php echo form_error('finenameVehicletype'); ?></span>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Transaction ID: </label>
            <input type="text" name="transactionid" class="form-control" value="<?php echo set_value('transactionid');?>"  required>
            <span class="badge badge-danger"><?php echo form_error('transactionid'); ?></span>
          </div>
        </div>
      </div>
      <div class="extrarow row">
        <div class="row">
        <div  class="col-sm-8">
          <div class="form-group">
              <label> Reason Fine List:</label>
               <select class="form-control" name="finelist[]" required onchange="getAmount(this)">
                <option value="">Select Any One</option>
                <?php
                if($rsChallan)
                  foreach ($rsChallan as $row) {
                     $newChallan =  $row['ct_no']." (".$row['ct_detail'].")";
                     if($row['ct_tv_id']!=null && $row['ct_tv_id']!='')
                     {
                      foreach ($rsVehicle as  $value2) {
                        if($value2['TV_ID']==$row['ct_tv_id'])
                        {
                           $newChallan = $newChallan. '('.$value2['tv_sort_name'].')';
                        }
                      }
                     }
                    echo "<option value='".$row['CT_ID']."'>".$newChallan."</option>";
                  }
                 ?>
              </select>
          </div>
        </div>
           <div  class="col-sm-4">
            <div class="form-group">
                <label>Fine:</label>
                <input type="text" readonly name="fine[]" class="form-control fine"/>     
             </div>
        </div>
        </div>
         <div  class="col-sm-2">
            <div class="form-group">
              <label style="color: white;">Fine:</label>
               <button name="addmore" type="button" class="btn btn-block btn-primary">+ &nbsp; Add More</button>
           </div>
         </div>
     
      </div><!-- end of row -->
      <div class="extrafield row">
      </div>
        <div class="row">
          <div class="col-sm-6">
            <button type="submit" name="submit" class="btn btn-block btn-primary">Submit</button>
          </div>
          <div class="col-sm-6">
            <button type="reset" name="reset" class="btn btn-block btn-defalult">Reset</button>
          </div>
        </div><!--end of row-->
      </form>
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
<script type="text/javascript">
        $(function(){
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-fine').addClass("active");
        });
        $('button[name="addmore"]').click(function(){
          finelist = $('select[name="finelist[]"]').html();
            $('.extrafield').append('<div class="col-sm-12 removeExtrafield"><div class="row"><div class="col-sm-8"><div class="form-group"><label> Reason Fine List:</label><select class="form-control" name="finelist[]" required onchange="getAmountOther(this)">'+finelist+'</select></div></div><div  class="col-sm-3"><div class="form-group"><label>Fine:</label><input type="text" readonly name="fine[]" class="form-control fine"/></div></div><div class="col-sm-1"><span class="input-group-addon btn btn-danger " onclick="close_url(this);" style="cursor:pointer; height:45px;width:50px; margin-top:35px;">X</span></div></div></div>');
        });
        function close_url(a)
        {
           $(a).parents('.removeExtrafield').remove();
        }
        function getAmountOther(a)
        {
           var id =  $(a).val();
           var current = $(a);
           if($(a).val()!='')
           {
              $.ajax({
                url:'<?= site_url("fine/calculate")?>',
                data:{id:id},
                method:'post',
                dataType:'json',
                success:function(json)
                {
                    current.parents('.removeExtrafield').find('.fine').val(json.amount['ct_amount']);
                }

              })
           }
           else
           {
                  current.parents('.removeExtrafield').find('.fine').val("");
           }
        }
        function getAmount(a)
        {
           var id =  $(a).val();
           var current = $(a);
           if($(a).val()!='')
           {
              $.ajax({
                url:'<?= site_url("fine/calculate")?>',
                data:{id:id},
                method:'post',
                dataType:'json',
                success:function(json)
                {
                    current.parents('.extrarow').find('.fine').val(json.amount['ct_amount']);
                }

              })
           }
           else
           {
                  current.parents('.extrarow').find('.fine').val("");
           }
          
        }
    </script>

