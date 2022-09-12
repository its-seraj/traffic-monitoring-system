<div class="row"> 
  <div class="col-md-12">
    <div class="card card-info card-outline">
      <div class="card-header">
        <h3 class="card-title">Attendance Report</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body" style="display: block;">
        <div class="row d-flex justify-content-center">
          <div class="col-sm-6 ">

             <div class="form-group">
                <label>Select Area</label>
                <select class="form-control" name="areaid" id="areaid">
                  <option value="">Select Any One</option>
                  <?php 
                  if($areas)
                    foreach ($areas as  $value) {
                      echo "<option value='".$value['AREAID']."'>".$value['arename']."</option>";
                    }
                  ?>
                </select>
            </div><!-- /.form-group -->

            <div class="form-group" id="batch_parent">
                
            </div><!-- /.form-group -->
                
              <label>Select Date:</label>
              <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input class="form-control datepicker" placeholder="YYYY-MM" type="text" name="date" id="date">
              </div>

              <button type="button" class="btn btn-info" onclick="attendanceSheet();">Take Attendance</button>

              
  
          </div> 
        </div><!--./row-->

        <div class="row d-flex justify-content-center mt-5">
          <div id="attendanceSheet" class="col-md-12"></div>
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
    $('.nav-ar').addClass('active');

    $('.datepicker').datepicker({
        format: "yyyy-mm",
        startView: "months", 
        minViewMode: "months",
        autoclose : true,
    });
  });

function checkClient(a){
  var aType = $('#type').val();
  if(aType==1){//clients
    var branch = $('#branchId').val();
    if(branch!=0){//branch selected the
      //load Branch select
      $('#batch_parent').html('<label>Select Batch</label><select class="form-control" name="batch" id="batch"><option>Select</option></select>');

      $.ajax({
        type: "POST",
        url: "<?= base_url('attendance/load_batch') ?>",
        dataType: "json",
        data: { branchId: branch},
        success: function (res) {
           $.each(res, function(i, value) {
            //alert(value.batch_id);
              $('#batch').append($('<option>').text(value.batch_name).prop('value', value.batch_id));
          });
        },
        error: function (res) {}
      });//eof ajax
    }
    else{
      alert("Please select branch First");
      $('#type').val('Select');
    }
  }//eof type=1 checking
  else{
     $('#batch_parent').empty('');//remove if first select client and then select staff
  }//eof else of type=1 checking
}
function attendanceSheet(){

  var areaid = $('#areaid').val();
  var date   = $('#date').val();
  var type   = 1;
       $.ajax({
        type: "POST",
        url: "<?= base_url('attendance/process_report') ?>",
        data: {areaid:areaid,date:date,type:type},
        success: function (res) {
          $('#attendanceSheet').html(res);
        },
        error: function (res) {console.log(res);}
      });//eof ajax
   //eof else  
 
}//eof function



 $(function(){
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-reportatte').addClass("active");
        });
</script>