<style type="text/css">

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
                  </div>';
        }
        if($this->session->user_type==0){ 
      ?>
       <center>
         <a class="btn btn-primary ml-3" href="<?=base_url("staff/staff_form")?>">
          <i class="fa fa-plus"></i>&nbsp;Add Staff
        </a>
      </center>
      <?php
      }

       if(!empty($rsArea)) 
       {
        $arearecord = json_encode($rsArea);
   
       }
      ?>
    <div class="table-responsive">
      <table class="myTable  table table-bordered table-striped">
          <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Area Code</th>
                <th>Area Name</th>
                <th>Status</th>
                <?php if($this->session->user_type!=3){ ?>
                <th width="18%">Action</th>
                <?php }?> 
            </tr>
          </thead>
        <tbody>
          <?php
           if(!empty($rsStaff)){
            $i = 0;
            foreach($rsStaff as $row){

                $link          = site_url("staff/delete_staff/".$row['USER_ID']);
                $editlink      = site_url("staff/edit_form/".$row['USER_ID']);
              echo '<tr>
                        <td>';
                           echo ++$i;
                        echo '</td>
                        <td>'.$row['user_name'].'</td>
                        <td>'.$row['user_email'].'</td>
                        <td>'.$row['user_mobile'].'</td>
                        <td>'.$row['arecode'].'</td>
                        <td>'.$row['arename'].'</td>
                        <td>';
                           if($row['user_status']==1){
                            echo '<small class="badge badge-success">Active</small>';
                           }else{
                            echo '<small class="badge badge-danger">Inactive</small>';
                           }
                   echo '</td>';
                   echo '<td>';
                   if($this->session->user_type==0 ){ 
                             echo '<div class="btn-group"><a class="btn btn-primary" href="'.$editlink.'" title="Edit Table">
                                   <i class="fa fa-edit"></i></a>
                                  <button class="btn btn-danger" onclick="deleteModal('."'".$link."'".')">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                   <button type="button" class="btn btn-md btn-primary" name="changepass" value="'.$row['USER_ID'].'" title="Change Password"><i class="fa fa-key"></i></button>
                                    ';
                        }
                        if($this->session->user_type==0 || $this->session->user_type==2)
                        {
                         echo '<button type="button" class="btn btn-md btn-warning" name="changearea" data-areacode="'.$row['arecode'].'" data-areaname="'.$row['arename'].'" data-areaid="'.$row['AREAID'].'"  value="'.$row['USER_ID'].'" title="Change Area"><i class="fa fa-map-marker"></i></button>';
                        }

                  echo'  </div>
                         </td>         
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

    $('button[name="changepass"]').click(function(){

        $('#myModal').modal({backdrop:'static'});
        $('#myModal .modal-title').html("Change Password");
        $('#myModal .modal-body').html('<form method="post" name="changePasswordform" id="changePassForm"><input type="hidden" name="userid" value="'+$(this).val()+'"><div class="row"><div class="col-sm-12 error"></div><div class="col-sm-12"><div class="form-group clearfix"><b>New Password</b><span id="strength"><span class="result"></span><span class="str-box box1"><div></div></span><span class="str-box box2"><div></div></span><span class="str-box box3"><div></div></span><span class="str-box box4"><div></div></span></span><input class="form-control form-control-sm" type="password" placeholder="Type Password" name="upassword" id="user_password" onkeyup="checkPassword(this);"></div></div><div class="col-sm-12"><div class="form-group"><span for="email"><b>Confirm Password<span class="compass" aria-hidden="true" style="display: none;font-size:20px;"></span></b></span><input class="form-control form-control-sm" type="password" id="confirmPass" placeholder="Confirm Password" name="confirmPassword" onkeyup="metchpass(this);"></div></div>');
        $('#myModal .modal-footer').html('<button type="button" class="btn btn-success btn-md" name="change" onclick="chagepass();">Save</button></div></form><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    });
  });
  $('button[name="changearea"]').click(function(){
   var arearow =  '<?= $arearecord; ?>';
  var userid = $(this).val();
  var areaid = $(this).data('areaid');
  arearow = JSON.parse(arearow);

   var selectrow = "<option value=''>Select Any One</option>";
   for (var i = 0; i < arearow.length; i++) {
      if(areaid!=arearow['AREAID'])
      {
          selectrow = selectrow + "<option value='"+arearow[i]['AREAID']+"'>"+arearow[i]['arecode']+"("+arearow[i]['arename']+")</option>";
      }
      else
      {
          selectrow = selectrow + "<option value='"+arearow[i]['AREAID']+"' selected>"+arearow[i]['arecode']+"("+arearow[i]['arename']+")</option>";
      }
   }
     var content = '<div class="row"><div class="col-sm-8"><div class="form-group"><label>Area:</label><select name="areauser" class="form-control">'+selectrow+'</select></div></div><div class="col-sm-4"><div class="form-group"><br><button name="areachange" class="btn btn-md btn-primary" type="button" onclick="saveArea('+userid+')">Save</button></div></div></div>';
     $('#myModal').modal();
     $('#myModal .modal-title').html('Area');
     $('#myModal .modal-body').html(content);
     $('#myModal .modal-footer').html("");
  });
  function saveArea(id)
  {
    var areaid = $('select[name="areauser"]').val();
    $.ajax({
      url : '<?= site_url("area/changearea")?>',
      data:{areaid:areaid,id:id,area:'change'},
      method:'post',
      success:function(res)
      {
        window.location.href="";
      }
    })
  }

   function checkPassword(a)
  {

        $(".result").html(checkStrength(a.value));
  }
  function chagepass()
  {
    if($('#confirmPass').val()!=$('#user_password').val())
    {
      alert("Password and Confirm Password should Same");
    }
    else if($('#user_password').val()=='')
    {
      alert("Password can't Blank");
    }
    else
    {
      var url = '<?= site_url('staff/change_password'); ?>';
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
//=========================Delete teacher==============================
	function deleteModal(link)
	{
		$('.modal-title').html('Confirm');
		$('.modal-body').html('Are you sure do you really want to delete this record?');
		$('.modal-footer').html('<a href="'+link+'" class="btn btn-danger">Delete</a> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		 $('#myModal').modal('show'); 
	}// fun deleteModal
//-------------------------------------------------------------
function submitsemform(url)
{
    $.post(url,
     $('#semform').serialize(),
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



</script>
<script type="text/javascript">
        $(function(){

          $('.nav-user').addClass('menu-open');
          $('.user-link').addClass('active');
          $('.nav-ar').addClass('active');
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-staff').addClass("active");
        });
    </script>

