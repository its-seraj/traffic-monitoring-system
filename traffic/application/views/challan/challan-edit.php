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
      <form action="<?= base_url('challan/edit_challan')?>" method="post">
        <div class="row">
          <input type="hidden" name="challanid" value="<?= $rowChallan['CT_ID']; ?>">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="Challan Code">Challan Code:</label>
              <input type="text" name="chaCode" value="<?php echo $rowChallan['ct_no'];?>" class="form-control" required>
              <span class="badge badge-danger"><?php echo form_error('chaCode'); ?></span>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="Challan Description">Challan Description:</label>
              <input type="text" name="chaName" value="<?php echo $rowChallan['ct_detail'];?>" class="form-control">
              <span class="badge badge-danger"><?php echo form_error('chaName'); ?></span>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="vehicle type">Vehicle Type:</label>
              <select class="form-control" name="vehicle_type" >
                <option value="">All</option>
                <?php
                if($rsvehicle)
                  foreach ($rsvehicle as $row) {
                    if($rowChallan['ct_tv_id']!=$row['TV_ID'])
                    {
                      echo "<option value='".$row['TV_ID']."'>".$row['tv_sort_name']."(".$row['tv_name'].")</option>";
                    }
                    else
                    {
                      echo "<option value='".$row['TV_ID']."' selected>".$row['tv_sort_name']."(".$row['tv_name'].")</option>";
                    }
                    
                  }
                 ?>
              </select>
              <span class="badge badge-danger"><?php echo form_error('vehicle_type'); ?></span>
            </div>
          </div>
           <div class="col-sm-2">
            <div class="form-group">
              <label for="Amount Challan">Amount:</label>
                <input type="text" name="chaAmount" value="<?php echo $rowChallan['ct_amount'];?>" class="form-control">
              <span class="badge badge-danger"><?php echo form_error('chaAmount'); ?></span>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="Subject Code">Status:</label>
               <select class="form-control" name="chaStatus" required>
                 <?php
                if($rowChallan['ct_status']==1)
                {
                  echo '<option selected value="1">Active</option>
                        <option value="0">Inactive</option>';
                } 
                else
                {
                  echo '<option value="1">Active</option>
                        <option selected value="0">Inactive</option>';
                }
                ?>
              </select>
              <span class="badge badge-danger"><?php echo form_error('chaStatus'); ?></span>
            </div>
          </div>
          </div>
           
        <div class="row">
          <div class="col-sm-6">
            <button type="submit" name="submit" class="btn btn-block btn-primary">Submit</button>
          </div>
          <div class="col-sm-6">
            <button type="reset" name="reset" class="btn btn-block btn-defalult">Reset</button>
          </div>
        </div><!--end of row-->
      </div>
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
          $('#pg-challan').addClass("active");
        });
    </script>

