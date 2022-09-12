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
      <form action="<?= base_url('area/edit_area')?>" method="post">
        <div class="row">
          <input type="hidden" name="areaid" value="<?= $rowArea['AREAID']; ?>">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="Branch Name">Station Name</label>
              <select class="form-control" name="stationid" required>
                <?php
                if($rsstation)
                  foreach ($rsstation as $row) {
                      if($rowArea['sid']!=$row['sid'])
                      {
                        echo "<option value='".$row['sid']."'>".$row['sname']."</option>";    
                      }
                      else
                      {
                        echo "<option selected value='".$row['sid']."'>".$row['sname']."</option>";     
                      }
                  }
                 ?>
              </select>
              <span class="badge badge-danger"><?php echo form_error('stationid'); ?></span>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="Subject Code">Area Code</label>
              <input type="text" name="areCode" value="<?php echo $rowArea['arecode']; ?>" class="form-control" required>
              <span class="badge badge-danger"><?php echo form_error('areCode'); ?></span>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="Subject Code">Area Name</label>
              <input type="text" name="areName" value="<?php echo $rowArea['arename']; ?>" class="form-control">
              <span class="badge badge-danger"><?php echo form_error('areName'); ?></span>
            </div>
          </div>
          
          <div class="col-sm-2">
            <div class="form-group">
              <label for="Subject Code">Status</label>
               <select class="form-control" name="areStatus" required>
                <?php
                if($rowArea['arestatus']==1)
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
              <span class="badge badge-danger"><?php echo form_error('arestatus'); ?></span>
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
          $('#pg-area').addClass("active");
        });
    </script>

