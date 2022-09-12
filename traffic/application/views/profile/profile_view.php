 <style type="text/css">
 .mandatory
{
  color: red;
  font-size: 24px;
  font-weight: bolder;
}
 .fileContainer,
.fileContainer input 
 {
     height: 30px;
     width: 170px;
 }

.fileContainer
 {
    background: #2498cc;
    border-radius: 20px;
    color: white;
    font-size: 1em; 
    font-weight: bold;
    text-align: center;
 }

 .fileContainer input {
     opacity: 0;
     margin-top: -27px;
 }
.box-profile {
  width: 75%;
  margin: 0px auto;
}
.card-body ul li:hover {
  background: #f2f2f2;
}
.str-box {
  position: relative;
  width: 56px;
  height: 12px;
  float: left;
}
.str-box div {
  position: absolute;
  width: 0%;
  height: 100%;
  -moz-transition: 1s;
  -o-transition: 1s;
  -webkit-transition: 1s;
  transition: 1s;
}

.short {
  color: #FF0000;
}
.short .str-box.box1 div {
  background: #f6dfc9;
  width: 100%;
}

.weak {
  color: #E66C2C;
}
.weak .str-box.box1 div {
  background: #ace600;
  width: 100%;
}
.weak .str-box.box2 div {
  background: #ace600;
  width: 100%;
}

.good {
  color: #2D98F3;
}
.good .str-box.box1 div {
  background: #00e614;
  width: 100%;
}
.good .str-box.box2 div {
  background: #00e614;
  width: 100%;
}
.good .str-box.box3 div {
  background: #00e614;
  width: 100%;
}

.strong {
  color: #006400;
}
.strong .str-box.box1 div {
  background: #036936;
  width: 100%;
}
.strong .str-box.box2 div {
  background: #036936;
  width: 100%;
}
.strong .str-box.box3 div {
  background: #036936;
  width: 100%;
}
.strong .str-box.box4 div {
  background: #036936;
  width: 100%;
}
.result {
  font-size: 18px;
  font-family: arial;
  width: auto;
  display: block;
  -moz-transition: 0.5s;
  -o-transition: 0.5s;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  font-variant: small-caps;
}
  .error p{
    background-color: #5F5F5F;
    padding: 5px;
    color:white;
  }

              </style>
               <?php
             if($this->session->flashdata('statusType'))
              {
                  echo '<div class="alert alert-'.$this->session->statusType.' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>'.$this->session->statusMsg.'</p>
                        </div>
                  ';
              }
              if(!empty($this->session->user_firstlogin))
              {
              ?>
                <script type="text/javascript">
                  $(function(){
                    $('.passwordchange').click();
                  });
                </script>
              <?php
              $this->session->unset_userdata('user_firstlogin');
              }
          ?>
          <div class="box box-success">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?= $cardtitle?></h3>
              </div>

                  <div class="container-fluid">
                      <div class="card-body">
                         <div class="row justify-content-around" >
                          <div class="col-sm-6">
                                <ul class="list-group list-group-unbordered mb-3 ">
                            <li class="list-group-item">
                              <b>Name</b> <a class="float-right"><?= $user['user_name'];?></a>
                            </li>
                            <li class="list-group-item">
                              <b>Mobile</b> <a class="float-right"><?=$user['user_mobile'];?></a>
                            </li>
                            <li class="list-group-item">
                              <b>Email ID</b> <a class="float-right"><?= $user['user_email'];?></a>
                            </li>
                            <li class="list-group-item">
                              <b>Address</b> <a class="float-right"><?=$user['user_address'];?></a>
                            </li>
                            <li class="list-group-item">
                              <b>City</b> <a class="float-right"><?= $user['user_city'];?></a>
                            </li>
                            <li class="list-group-item">
                              <b>State</b> <a class="float-right"><?=$user['user_state'];?></a>
                            </li>
                          </ul>
                          <div class="row">
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-primary" title="Change Profile" onclick="editProfile(this,'<?= $_SESSION['user_type'];?>');" value="<?= $user['USER_ID'];?>"><b>Change Profile</b></button>
                            </div>
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-primary passwordchange" title="Reset Password" onclick="resetPass(this);"  value="<?= $user['USER_ID'];?>"><b>Change Password</b></button>
                            </div>
                          </div>
                          </div>
                          <div class="col-sm-4">
                          <div class="callout callout-danger">
                            <img class="img-fluid" src="<?= ($user['user_img']=='') ? base_url('assets/profile/user/User.png') : $user['user_img'];?>"  alt="User profile picture">
                          </div>
                        </div><!--end of col-sm-4-->
                      </div><!--end of row-->
                    </div><!--end of the card-body-->
                    
                </div><!--end of container-->
              </div><!--end of the card-->
            </div><!-- end of the box-->
            <script type="text/javascript">
function editProfile(a,usertype)    
  {
    var changeview="";
    var extraCatgory='';
    var extraBranch='';
    $.ajax({
      url:'profile/profile_form',
      data:{id:a.value},
      method:'post',
      dataType:'json',
      success:function(json)
      {
         if(json.User['user_img']==null || json.User['user_img']=='')
          {
            var imgsrc="<?php echo base_url() ?>/assets/profile/user/user.png";
          }
          else
          {
          var imgsrc="<?php echo base_url() ?>/"+json.User['user_img'];  
          }

          var user_name     =  json.User['user_name'];
          var user_email    =  json.User['user_email'];
          var user_address  =  json.User['user_address'];
          var user_city     =  json.User['user_city'];
          var user_state    =  json.User['user_state'];
          var user_mobile   =  json.User['user_mobile'];
          if(json.User['user_name']==null)
          {
            user_name='';
          }
          if(json.User['user_email']==null)
          {
            user_email='';
          }
          if(json.User['user_address']==null)
          {
            user_address='';
          }
          if(json.User['user_city']==null)
          {
            user_city='';
          } 
          if(json.User['user_state']==null)
          {
            user_state='';
          } 
          if(json.User['user_mobile']==null)
          {
            user_mobile='';
          }
          changeview= '<input type="hidden" name="uid" value="'+json.User['USER_ID']+'"><div class="col-sm-6"><div class="form-group"><span for="exampleInputEmail1"> <b>Name:</b><sub><span class="mandatory">*</span></sub></span><input type="text" class="form-control form-control-sm" value="'+user_name+'" name="uname" placeholder="Enter Name" required></div></div><div class="col-sm-6"><div class="form-group"><span for="email"><b>Email:-</b><sub><span class="mandatory">*</span></sub></span><input type="email" class="form-control form-control-sm" value="'+user_email+'" name="uemail" placeholder="Enter Email" ></div></div><div class="col-sm-6"><div class="form-group"><span for="email"><b>Address:-</b></span><textarea name="uaddress" class="form-control form-control-sm" cols="5" rows="4">'+user_address+'</textarea></div></div><div class="col-sm-6"><div class="form-group"><span for="email"><b>City:-</b></span><input type="text"  class="form-control form-control-sm" name="ucity" value="'+user_city+'" placeholder="Enter City"></div><div class="form-group"><span for="email"><b>State:-</b></span><input type="text"  class="form-control form-control-sm" value="'+user_state+'" name="ustate" placeholder="Enter State"></div></div><div class="col-sm-6"><div class="form-group"><span for="email"><b>Mobile:-</b></span><input type="number" class="form-control form-control-sm" value="'+user_mobile+'" name="umobile" placeholder="Enter Mobile" ></div></div><div class="col-sm-3"><div class="form-group"><span for="email"><b>Photo:-</b></span><div class="fileContainer">Browse<input type="file" class="form-control form-control-sm" name="uimg" placeholder="" onchange="filevalidation(this);"></div></div></div><div class="col-sm-3"><img class="showImg" src="'+imgsrc+'" width="170px"></div>'; 
        
        $('#myModal').modal({backdrop:'static'});
        $('#myModal .modal-title').html("<small>Profile Edit</small>");
        $('#myModal .modal-body').html('<form action="profile/edit_profile" method="post" enctype="multipart/form-data"><div class="row"><div class="col-sm-12 error"></div>'+changeview+'</div><br><center><button type="submit" name="submit" class="btn btn-success btn-sm">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" name="reset" class="btn btn-info btn-sm">Reset</button>');
        $('#myModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
      }
    });
  }
            //change the password
            function resetPass(a)
            {
              //alert(a.value);
              $('#myModal').modal({backdrop:'static'});
              $('#myModal .modal-title').html("Change Password");
              $('#myModal .modal-body').html('<form action="<?= site_url('profile/change_password')?>" method="post" name="changePasswordform" id="changePassForm"><div class="row"><div class="col-sm-12 error"></div><div class="col-sm-12"><div class="form-group"><span for="email"><b>Old Password</b></span><input class="form-control form-control-sm" type="password" placeholder="Type Old Password" name="uoldpassword" id="user_old_password"></div></div><div class="col-sm-12"><div class="form-group clearfix"><b>New Password</b><span id="strength"><span class="result"></span><span class="str-box box1"><div></div></span><span class="str-box box2"><div></div></span><span class="str-box box3"><div></div></span><span class="str-box box4"><div></div></span></span><input class="form-control form-control-sm" type="password" placeholder="Type Password" name="upassword" id="user_password" onkeyup="checkPassword(this);"></div></div><div class="col-sm-12"><div class="form-group"><span for="email"><b>Confirm Password<span class="compass" aria-hidden="true" style="display: none;font-size:20px;"></span></b></span><input class="form-control form-control-sm" type="password" id="confirmPass" placeholder="Confirm Password" name="confirmPassword" onkeyup="metchpass(this);"></div></div>');
               $('#myModal .modal-footer').html('<button type="button" class="btn btn-success btn-md" name="change" onclick="chagepass();">Save</button></div></form><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
            }
          //this is for animation of password chaek
  function checkPassword(a)
  {
        $(".result").html(checkStrength(a.value));
  }
  //this is for the file validation
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
                   
                      if(size > MAX_SIZE)
                      {
                          alert("Maximum file size exceeds");
                      }
                      else
                      {
                          var reader = new FileReader();
                          reader.onload = function(e) { 
                          $('.showImg').attr("src",e.target.result);
                                    }           
                        reader.readAsDataURL(fuData.files[0]);
                    }
               }

          } 
        else 
        {
          alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
        }
  }
}

 function chagepass()
  {
    if($('#confirmPass').val()!=$('#user_password').val())
    {
      alert("Password and Confirm Password should Same");
    }
    else if($('#user_password').val()==$('#user_old_password').val())
    {
      alert("Old Password and New Password Can't Same");
    }
    else if($('#user_password').val()=='')
    {
      alert("Password can't Blank");
    }
    else
    {
      var url = '<?= site_url('profile/change_password'); ?>';
      $.post(url,
       $('#changePassForm').serialize(),
           function(res){
            if(res==1){
             // alert(res);
              location.reload();
            }
            else{
              obj = JSON.parse(res);
               $('#myModal .modal-body .error').html(obj.error_message);
            }
           }
      );
    }
  }
//password metch or not
  function metchpass(a)
  {
    if(a.value!=$('#user_password').val())
    {
      $('.compass').addClass('fa fa-times');
      $('.compass').css({display:'block',color:'red'});
    }
    else
    {
      $('.compass').removeClass('fa fa-times');
      $('.compass').addClass('fa fa-check');
      $('.compass').css({display:'block',color:'green'});
    }
  }
 function checkStrength(password){

    //initial strength
    var result = $("#strength");
    var strength = 0
    
    if (password.length == 0) {
        result.removeClass();
        return ''
    }
    //if the password length is less than 6, return message.
    if (password.length < 6) {
        result.removeClass()
        result.addClass('short')
        return 'too short'
    }
 
    //length is ok, lets continue.
 
    //if length is 8 characters or more, increase strength value
    if (password.length > 7) strength += 1
 
    //if password contains both lower and uppercase characters, increase strength value
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
 
    //if it has numbers and characters, increase strength value
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
 
    //if it has one special character, increase strength value
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
 
    //if it has two special characters, increase strength value
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1
 
    //now we have calculated strength value, we can return messages
 
    //if value is less than 2
    if (strength < 2) {
        result.removeClass()
        result.addClass('weak')
        return 'weak'
    } else if (strength == 2 ) {
        result.removeClass()
        result.addClass('good')
        return 'good'
    } else {
        result.removeClass()
        result.addClass('strong')
        return 'strong'
    }
}

//this function is used to change the status of the  user on and off
            </script>