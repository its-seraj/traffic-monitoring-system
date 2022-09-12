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
         <a class="btn btn-primary ml-3" href="<?=base_url("thana/thana_form")?>">
          <i class="fa fa-plus"></i>&nbsp;Add Thana Incharge
        </a>
      </center>
      <?php } ?>
    <div class="table-responsive">
      <table class="myTable  table table-bordered table-striped">
          <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Station</th>
                <th>Status</th>
                <?php  if($this->session->user_type==0){ ?>
                <th width="18%">Action</th>
                <?php } ?>
            </tr>
          </thead>
        <tbody>
          <?php
           if(!empty($rsThana)){
             if(!empty($rsStation)) 
               {
                $stationrecord = json_encode($rsStation);
               }
      
            $i = 0;
            foreach($rsThana as $row){

                $link          = site_url("thana/delete_thana/".$row['USER_ID']);
                $editlink      = site_url("thana/edit_form/".$row['USER_ID']);
              echo '<tr>
                        <td>';
                           echo ++$i;
                        echo '</td>
                        <td>'.$row['user_name'].'</td>
                        <td>'.$row['user_email'].'</td>
                        <td>'.$row['user_mobile'].'</td>
                        <td>'.$row['sname'].'</td>
                        <td>';
                           if($row['user_status']==1){
                            echo '<small class="badge badge-success">Active</small>';
                           }else{
                            echo '<small class="badge badge-danger">Inactive</small>';
                           }
                   echo '</td>';
                    if($this->session->user_type==0){
                   echo '<td>';
                             echo '<div class="btn-group"><a class="btn btn-primary" href="'.$editlink.'" title="Edit Table">
                                   <i class="fa fa-edit"></i></a>
                                  <button class="btn btn-danger" onclick="deleteModal('."'".$link."'".')">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                   <button type="button" class="btn btn-md btn-primary" name="changepass" value="'.$row['USER_ID'].'" title="Change Password"><i class="fa fa-key"></i></button>';
                        

                             echo '<button type="button" class="btn btn-md btn-warning" name="changethana" data-stationname="'.$row['sname'].'" data-stationid="'.$row['sid'].'"  value="'.$row['USER_ID'].'" title="Change Thana"><i class="fa fa-map-marker"></i></button>';
                            

                  echo'  </div></td> ';
                       }
                  echo '</tr>';
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
    $('button[name="changethana"]').click(function(){
   var stationrecord =  '<?= $stationrecord; ?>';
  var userid = $(this).val();
  var stationid = $(this).data('stationid');
  stationrecord = JSON.parse(stationrecord);

   var selectrow = "<option value=''>Select Any One</option>";
   for (var i = 0; i < stationrecord.length; i++) {
      if(stationid!=stationrecord['sid'])
      {
          selectrow = selectrow + "<option value='"+stationrecord[i]['sid']+"'>"+stationrecord[i]['sname']+"</option>";
      }
      else
      {
          selectrow = selectrow + "<option value='"+stationrecord[i]['sid']+"' selected>"+stationrecord[i]['sname']+"</option>";
      }
   }
     var content = '<div class="row"><div class="col-sm-8"><div class="form-group"><label>Area:</label><select name="stationuser" class="form-control">'+selectrow+'</select></div></div><div class="col-sm-4"><div class="form-group"><br><button name="areachange" class="btn btn-md btn-primary" type="button" onclick="saveStation('+userid+')">Save</button></div></div></div>';
     $('#myModal').modal();
     $('#myModal .modal-title').html('Station');
     $('#myModal .modal-body').html(content);
     $('#myModal .modal-footer').html("");
  });
    

    $('button[name="changepass"]').click(function(){

        $('#myModal').modal({backdrop:'static'});
        $('#myModal .modal-title').html("Change Password");
        $('#myModal .modal-body').html('<form method="post" name="changePasswordform" id="changePassForm"><input type="hidden" name="userid" value="'+$(this).val()+'"><div class="row"><div class="col-sm-12 error"></div><div class="col-sm-12"><div class="form-group clearfix"><b>New Password</b><span id="strength"><span class="result"></span><span class="str-box box1"><div></div></span><span class="str-box box2"><div></div></span><span class="str-box box3"><div></div></span><span class="str-box box4"><div></div></span></span><input class="form-control form-control-sm" type="password" placeholder="Type Password" name="upassword" id="user_password" onkeyup="checkPassword(this);"></div></div><div class="col-sm-12"><div class="form-group"><span for="email"><b>Confirm Password<span class="compass" aria-hidden="true" style="display: none;font-size:20px;"></span></b></span><input class="form-control form-control-sm" type="password" id="confirmPass" placeholder="Confirm Password" name="confirmPassword" onkeyup="metchpass(this);"></div></div>');
        $('#myModal .modal-footer').html('<button type="button" class="btn btn-success btn-md" name="change" onclick="chagepass();">Save</button></div></form><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    });
  });
   function checkPassword(a)
  {

        $(".result").html(checkStrength(a.value));
  }
  function saveStation(id)
  {
    var stationid = $('select[name="stationuser"]').val();
    $.ajax({
      url : '<?= site_url("station/changestation")?>',
      data:{stationid:stationid,id:id,station:'change'},
      method:'post',
      success:function(res)
      {
        window.location.href="";
      }
    })
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
      var url = '<?= site_url('thana/change_password'); ?>';
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
          $('#pg-ti').addClass("active");
        });
    </script>

