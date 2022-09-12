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
      <form action="<?= base_url('notification/edit_notification')?>" method="post" enctype="multipart/form-data">
         <div class="row">
          <input type="hidden" name="nid" value="<?= $rowNotification['NID']; ?>">
            <div class="col-sm-6">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Notification Code</label>
                  <input type="text" name="notiCode" class="form-control" value="<?= $rowNotification['nCode']; ?>"  required>
                  <span class="badge badge-danger"><?php echo form_error('notiCode'); ?></span>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Notification Title</label>
                  <input type="text" name="notiTitle" class="form-control" value="<?= $rowNotification['nTitle']; ?>"  required>
                  <span class="badge badge-danger"><?php echo form_error('notiTitle'); ?></span>
                </div>
              </div>
              <div class="col-sm-12">
                 <div class="form-group">
                    <label for="exampleInputEmail1">File:</label>
                      <center>
                        <input type="file" name="Notificationimg" id="uploadfile" value="" class="form-control "> 
                    </center>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12">
            <div class="form-group">
              <label>Description:</label>
              <textarea  name="notidesc" class="form-control" rows=5><?= $rowNotification['ndescription']; ?></textarea>
              <span class="badge badge-danger"><?php echo form_error('notidesc'); ?></span>
            </div>
          </div>
            <div class="col-sm-12">
             <div class="form-group">
              <label for="Subject Code">Status:</label>
               <select class="form-control" name="notiStatus" required>
                <?php
                if($rowNotification['nstatus']==1)
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
              <span class="badge badge-danger"><?php echo form_error('notiStatus'); ?></span>
            </div>
          </div>
        </div>
      </div><!-- end of row -->
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
          $('#pg-note').addClass("active");
        });
    </script>

