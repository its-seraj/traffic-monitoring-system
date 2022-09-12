<div class="row"> 
  <div class="col-md-12">
    <div class="card card-info card-outline">
      <div class="card-header">
        <h3 class="card-title">Take Attendance</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body" style="display: block;">
        <div class="row d-flex justify-content-center">
          <div class="col-sm-6 ">

            <?php 

              if($this->session->flashdata('statusType'))
              {
                  echo '<div class="alert alert-'.$this->session->statusType.' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>'.$this->session->statusMsg.'</p>
                        </div>
                  ';
              }
              if($this->session->user_type==0){
                //Main or master admin
                echo'
                  <div class="form-group">
                    <label>Select Area</label>
                    <select class="form-control" name="areaid" id="areaid">';
                       echo'<option value="0">Select Area</option>';
                    foreach ($areas as $area) {
                      echo'<option value="'.$area['AREAID'].'">'.$area['arecode'].'('.$area['arename'].')</option>';
                    }
                   echo'</select>
                </div>
                ';
              }
            ?>
            <div class="form-group" id="batch_parent">
                
            </div><!-- /.form-group -->
                
              <label>Select Date:</label>
              <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input class="form-control datepicker" placeholder="YYYY-MM-DD" type="text" name="date" id="date">
              </div>

              <button type="button" class="btn btn-info" onClick="attendanceSheet();">Take Attendance</button>

              
  
          </div> 
        </div><!--./row-->

        <div class="row d-flex justify-content-center mt-5">
          <div id="attendanceSheet" class="col-md-8"></div>
        </div><!--./row-->
      </div>
      <!-- /.card-body -->
    </div>
  </div><!--/.md-6--> 
</div>
<!-- /.row -->

<script>
  $(function(){
    $('.nav-attendance').addClass('menu-open');
    $('.attendance-link').addClass('active');
    $('.nav-ta').addClass('active');

    $('.datepicker').datepicker({
      format:'yyyy-mm-dd',
      autoclose : true,
      todayHighlight :true
    });
  });
 $(function(){
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-takeatte').addClass("active");
        });
   


function attendanceSheet(){

var area = $('#areaid').val();
var date = $('#date').val();

  if(area==0){
    alert("Correct Selection is required");
  }
  else
  {
      $.ajax({
      url:'<?= site_url("attendance/get_attendance_table");?>',
      data:{area:area,date:date},
      type:'post',
      success:function(res)
      {
        $('#attendanceSheet').html(res);
      }
     });

  }

}//eof function
</script>