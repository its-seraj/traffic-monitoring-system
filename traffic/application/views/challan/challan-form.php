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
      <form action="<?= base_url('challan/add_challan')?>" method="post">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="Challan Code">Challan Code:</label>
              <input type="text" name="chaCode[]" value="<?php echo set_value('chaCode[]');?>" class="form-control" required>
              <span class="badge badge-danger"><?php echo form_error('chaCode[]'); ?></span>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="Challan Description">Challan Description:</label>
              <input type="text" name="chaName[]" value="<?php echo set_value('chaName[]');?>" class="form-control">
              <span class="badge badge-danger"><?php echo form_error('chaName[]'); ?></span>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="vehicle type">Vehicle Type:</label>
              <select class="form-control" name="vehicle_type[]" >
                <option value="">All</option>
                <?php
                if($rsvehicle)
                  foreach ($rsvehicle as $row) {
                    echo "<option value='".$row['TV_ID']."'>".$row['tv_sort_name']."(".$row['tv_name'].")</option>";
                  }
                 ?>
              </select>
              <span class="badge badge-danger"><?php echo form_error('vehicle_type[]'); ?></span>
            </div>
          </div>
           <div class="col-sm-1">
            <div class="form-group">
              <label for="Amount Challan">Amount:</label>
                <input type="text" name="chaAmount[]" value="<?php echo set_value('chaAmount[]');?>" class="form-control">
              <span class="badge badge-danger"><?php echo form_error('chaAmount[]'); ?></span>
            </div>
          </div>
          <div class="col-sm-1">
            <div class="form-group">
              <label for="Subject Code">Status:</label>
               <select class="form-control" name="chaStatus[]" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
              <span class="badge badge-danger"><?php echo form_error('chaStatus[]'); ?></span>
            </div>
          </div>
            <div class="col-sm-2 lastAdd">
            <label style="color: white;">f</label><br/>
             <button type="button" name="addMore" class="btn btn-block btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp; Challan</button>
          </div><!--end of the col-sm-12-->
        </div><!--end of row-->
        <div class="extrafields row">
        </div>
        <br/>
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
   var selectvalue =  $('select[name="vehicle_type[]"]').html();
    $("button[name='addMore']").click(function(){
      $('.extrafields').append('<div class="col-sm-12 removeExtrafield"><div class="row"><div class="col-sm-3"><div class="form-group"><label for="Challan Code">Challan Code:</label><input type="text" name="chaCode[]" value="<?php echo set_value('chaCode[]');?>" class="form-control" required><span class="badge badge-danger"><?php echo form_error('chaCode[]'); ?></span></div></div><div class="col-sm-3"><div class="form-group"><label for="Challan Description">Challan Description:</label><input type="text" name="chaName[]" value="<?php echo set_value('chaName[]');?>" class="form-control"><span class="badge badge-danger"><?php echo form_error('chaName[]'); ?></span></div></div><div class="col-sm-2"><div class="form-group"><label for="vehicle type">Vehicle Type:</label><select class="form-control" name="vehicle_type[]" >'+selectvalue+'</select><span class="badge badge-danger"><?php echo form_error('vehicle_type[]'); ?></span></div></div><div class="col-sm-1"><div class="form-group"><label for="Amount Challan">Amount:</label><input type="text" name="chaAmount[]" value="<?php echo set_value('chaAmount[]');?>" class="form-control"><span class="badge badge-danger"><?php echo form_error('chaAmount[]'); ?></span></div></div><div class="col-sm-1"><div class="form-group"><label for="Subject Code">Status:</label><select class="form-control" name="chaStatus[]" required><option value="1">Active</option><option value="0">Inactive</option></select><span class="badge badge-danger"><?php echo form_error('areStatus[]'); ?></span></div></div><div class="col-sm-2"><span class="input-group-addon btn btn-danger " onclick="close_url(this);" style="cursor:pointer; height:45px;width:50px; margin-top:35px;">X</span></div></div></div>');
    });
  });
  function close_url(a)
  {
    $(a).parents('.removeExtrafield').remove();
  }
  
</script>
<script type="text/javascript">
        $(function(){
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-challan').addClass("active");
        });
    </script>

