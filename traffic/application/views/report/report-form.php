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
        <div class="row">
          <div class="col-sm-2">
            <div  class="form-group">
              <label> Thana Incharge: </label>
              <select name="thana" class="form-control" onchange="disableBlock(this);">
             <?php
               if(!empty($rsStation))
               {
                echo "<option  value=''>Select Any One</option>";
                foreach ($rsThana as $value) {
                  echo "<option value='".$value['USER_ID']."'>".$value['user_name']."</option>";
                }
               }
              ?>   
              </select>
            </div>
          </div>
       		<div class="col-sm-2">
            <div  class="form-group">
              <label> Station: </label>
              <select name="station" class="form-control" onchange="disableBlock(this);">
             <?php
               if(!empty($rsStation))
               {
                echo "<option  value=''>Select Any One</option>";
                foreach ($rsStation as $value) {
                  echo "<option value='".$value['sid']."'>".$value['sname']."</option>";
                }
               }
              ?>   
              </select>
            </div>
          </div>
          <div class="col-sm-2">
	       		<div  class="form-group">
	       			<label> Area: </label>
	       			<select name="area" class="form-control" onchange="disableBlock(this);">
             <?php
               if(!empty($rsArea))
               {
                echo "<option  value=''>Select Any One</option>";
                foreach ($rsArea as $value) {
                  echo "<option value='".$value['AREAID']."'>".$value['arecode']."(".$value['arename'].")</option>";
                }
               }
              ?>     
              </select>
	       		</div>
       		</div>
       		<div class="col-sm-2">
	       		<div  class="form-group">
	       			<label> Staff: </label>
	       			<select name="staff" class="form-control"  onchange="disableBlock(this);">
             <?php
               if(!empty($rsStaff))
               {
                echo "<option  value=''>Select Any One</option>";
                foreach ($rsStaff as $value) {
                 echo "<option value='".$value['USER_ID']."'>".$value['user_name']."</option>";
                }
               }
              ?>      
              </select>
	       		</div>
       		</div>
       		<div class="col-sm-2">
	       		<div  class="form-group">
	       			<label> Reson: </label>
	       			<select name="challan" class="form-control"  onchange="disableBlock(this);">
                <?php
               if(!empty($rsChallan))
               {
                echo "<option value=''>Select Any One</option>";
                foreach ($rsChallan as $value) {
                  echo "<option value='".$value['CT_ID']."'>".$value['ct_no']."(".$value['ct_detail'].")</option>";
                }
               }
              ?>
              </select>
	       		</div>
       		</div>
       		<div class="col-sm-2">
	       		<div  class="form-group">
	       			<label style="color: white;"> Thana: </label><br/>
	       			<button name="getreport" type="button" class="btn btn-primary btn-block">Submit</button>
	       		</div>
       		</div>
       	</div>
        <div class="row kishan" ></div>
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
          $('#pg-report').addClass("active");
        });
        $('button[name="getreport"]').click(function(){
          var thana  = $('select[name="thana"]').val();
          var station  = $('select[name="station"]').val();
          var area   = $('select[name="area"]').val();
          var staff  = $('select[name="staff"]').val();
          var challan  = $('select[name="challan"]').val();
        //  alert(thana+station+area+staff+challan);
          if(thana==''&&station==''&&area==''&&staff==''&&challan=='')
          {
            $('#myModal').modal();
            $('#myModal .modal-title').html("Alert");
            $('#myModal .modal-body').html("Fill any field");
           // alert(thana+station+area+staff+challan);
          }
          else
          {
            $.ajax({
              url:'<?= site_url("report/getreport")?>',
              data:{thana:thana,station:station,area:area,staff:staff,challan:challan,getvaluereport:'Yes'},
              method:'post',
              success:function(res)
              {
                $('.kishan').html(res);
              }
            })
          }

        });
        function disableBlock(a)
        {
          /*if($(a).val()!='')
          {
            $('select').prop({"disabled":"disabled"});
            $(a).removeProp("disabled");
          }
          else
          {
           $('select').removeProp("disabled"); 
          }*/
        }
      
    </script>

