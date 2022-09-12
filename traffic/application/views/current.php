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
      ?>
 
	 <div class="row">
	 	<div class="col-sm-4">
	 	<form action="<?= site_url('timetable/search')?>" method ="post">
		 <fieldset>
		  <legend>Search:</legend>
		  <div class="row">
		  	<div class="col-sm-6">
				<div class="form-group">
				  	<label>Staff Name:</label>
					  	<select name="staff" class="form-control" onchange="staffChange(this)">
					  		<option value="">Select Any One</option>
					  		<?php
						  		foreach ($rsStaff as $key => $value) {
						  			echo "<option value='".$value['USER_ID']."'>".$value['user_name']."</option>";
						  		}
					  		?>	
					  	</select>
				</div>
			</div>
			<div class="col-sm-1">
				<div class="form-group">
					<br>
					<label>or</label>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="form-group">
				  	<label>Area Name:</label>
					  	<select name="area" class="form-control" onchange="areaChange(this)">
					  		<option value="">Select Any One</option>
					  		<?php
						  		foreach ($rsArea as $key => $value) {
						  			echo "<option value='".$value['AREAID']."'>".$value['arecode']."(".$value['arename'].")</option>";
						  		}
					  		?>	
					  	</select>
				</div>
			</div>
		  </div>
		  <div class="form-group">
		  	<label>Date</label>
		  	<input type="date" name="date" class="form-control" id ="datepicker">
		  </div>
		  <div class="form-group">
		  	<button type="button" class="btn btn-block btn-success" id="fittertimetable"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;<b>Search</b></button>
		  </div>
		 </fieldset>
		</form>
	  </div><!-- end of col-sm-04 -->
	  <div class="col-sm-8 result">
	  </div>
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

<script type="text/javascript">
        $(function(){
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-current').addClass("active");
        });
        

        $('#fittertimetable').click(function(){
			var staff =	$('select[name="staff"').val();
			var area 	=	$('select[name="area"').val();
			var date 	=	$('input[name="date"').val();
			 if(staff =='' && area=='')
			{
				alert("please select Staff or Area.");
			}
			else
			{
			$.ajax({
				url:'<?= site_url("dashboard/getsearchresult")?>',
				data:{staff:staff,area:area,date:date},
				method:'post',
				success: function (res)
					{
						$('.result').html(res);
					}

				})
			}
        });
      function areaChange(a)
      {
      	if($(a).val()!='')
      	{
      		$('select[name="staff"]').prop("disabled", true);

      	}
      	else
      	{
      		$('select[name="staff"]').removeAttr("disabled");
      	}

      }
       function staffChange(a)
      {
      	if($(a).val()!='')
      	{
      		$('select[name="area"]').prop("disabled", true);

      	}
      	else
      	{
      		$('select[name="area"]').removeAttr("disabled");
      	}

      }

    </script>

