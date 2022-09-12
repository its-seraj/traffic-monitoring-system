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
      <form action="<?= base_url('notification/add_notification')?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Notification Code</label>
                  <input type="text" name="notiCode" class="form-control" value="<?php echo set_value('notiCode');?>"  required>
                  <span class="badge badge-danger"><?php echo form_error('notiCode'); ?></span>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Notification Title</label>
                  <input type="text" name="notiTitle" class="form-control" value="<?php echo set_value('notiTitle');?>"  required>
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
              <textarea  name="notidesc" class="form-control" value="<?php echo set_value('notidesc');?>" rows=5></textarea>
              <span class="badge badge-danger"><?php echo form_error('notidesc'); ?></span>
            </div>
          </div>
            <div class="col-sm-12">
             <div class="form-group">
              <label for="Subject Code">Status:</label>
               <select class="form-control" name="notiStatus" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
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
    $("button[name='addMore']").click(function(){
      $('.extrafields').append('<div class="col-sm-12 removeExtrafield"><div class="row"><div class="col-sm-4"><div class="form-group"><label for="Area Code">Area Code</label><input type="text" name="areCode[]" value="<?php echo set_value('areCode[]');?>" class="form-control" required><span class="badge badge-danger"><?php echo form_error('areCode[]'); ?></span></div></div><div class="col-sm-4"><div class="form-group"><label for="Area Code">Area Name</label><input type="text" name="areName[]" value="<?php echo set_value('areName[]');?>" class="form-control"><span class="badge badge-danger"><?php echo form_error('areName[]'); ?></span></div></div><div class="col-sm-2"><div class="form-group"><label for="Area Code">Status</label><select class="form-control" name="areStatus[]" required><option value="1">Active</option><option value="0">Inactive</option></select><span class="badge badge-danger"><?php echo form_error('areStatus[]'); ?></span></div></div><div class="col-sm-2"><span class="input-group-addon btn btn-danger " onclick="close_url(this);" style="cursor:pointer; height:45px;width:50px; margin-top:35px;">X</span></div></div></div>');
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
          $('#pg-note').addClass("active");
        });
    </script>

