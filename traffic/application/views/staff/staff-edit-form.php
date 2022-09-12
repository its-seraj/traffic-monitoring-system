<div class="col-sm-12">
	<div class="card">  
    <div class="card-header">
      <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      
      <style type="text/css">
      #uploadfile {
          position: absolute;
          height: 140px;
          margin-left: 95px;
          width: 152.53px;
          opacity: 0;
          z-index: 3;
        }
      .mandatory
        {
          color: red;
          font-size: 24px;
          font-weight: bolder;
        }
      </style>
      <form action="<?= base_url("staff/edit_staff")?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="hidden" name="userid" value="<?= $staff_detail['USER_ID'] ?>">
                <span for="exampleInputEmail1"><b>Name:</b><sub><span class="mandatory">*</span></sub></span>
                <input type="text" class="form-control" name="tname" placeholder="Enter Name" value="<?= $staff_detail['user_name'];?>">
                <span class="badge badge-danger"><?php echo form_error('tname'); ?></span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <span for="email"><b>Email:-</b><sub><span class="mandatory">*</span></sub></span>
                <input type="email" class="form-control"  name="temail" placeholder="Enter Email" value="<?= $staff_detail['user_email'];?>">
                <span class="badge badge-danger"><?php echo form_error('temail'); ?></span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <span for="email"><b>Address:-</b></span>
                <textarea name="taddress" class="form-control " cols="5" rows="4"><?= $staff_detail['user_address'];?></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <span for="email"><b>City:-</b></span>
                <input type="text" class="form-control " name="tcity"  placeholder="Enter City" value="<?= $staff_detail['user_city'];?>">
              </div>
              <div class="form-group">
                <span for="email"><b>State:-</b></span>
                <input type="text" class="form-control "  name="tstate" placeholder="Enter State" value="<?= $staff_detail['user_state'];?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <span for="email"><b>Mobile:-</b></span>
                <input type="number" class="form-control"  name="tmobile" placeholder="Enter Mobile" value="<?= $staff_detail['user_mobile'];?>">
                <span class="badge badge-danger"><?php echo form_error('tmobile'); ?></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Photo:</label>
                <center>
                  <input type="file" name="timg" value="" id="uploadfile" class="form-control " onchange="filevalidation(this);"> 
                  <?php if($staff_detail['user_img']!='' && $staff_detail['user_img']!=null)
                  {
                    ?>
                    <img src="<?= base_url($staff_detail['user_img']); ?>" width="100px" id="profilepic">
                    <?php
                  }else{
                    ?>
                    <img src="<?= base_url("assets/profile/user/user.png"); ?>" width="100px" id="profilepic">
                    <?php
                  } ?>
                       
                   <div id="hover-content">
                      <button type="button" class="btn ">Choose Photo...</button>
                  </div>
                </center>
              </div>
            </div>
          </div>
          <br>
          <center>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="reset" name="reset" class="btn btn-info">Reset</button>
          </center>
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
 
  function filevalidation(a)
  {
    var fuData = a;
    var FileUploadPath = fuData.value;
    var MAX_SIZE = 1024000;
      if (FileUploadPath == '')
      {
          alert("Please upload an image");
      } 
      else
      {
          var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
          if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                    || Extension == "jpeg" || Extension == "jpg") 
          {
                if (fuData.files && fuData.files[0])
                 {

                    var size = fuData.files[0].size;
                          var reader = new FileReader();

                          reader.onload = function(e) { 
                          $('#profilepic').attr("src",e.target.result);
                                    }           
                        reader.readAsDataURL(fuData.files[0]);
               }

          } 
        else 
        {
          alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
        }
  }
}
 
  
</script>
<script type="text/javascript">
      $(function(){
        $('.sidebar-toggle').trigger('click');
        $('.active').removeClass("active");
        $('#pg-staff').addClass("active");
      });
</script>

