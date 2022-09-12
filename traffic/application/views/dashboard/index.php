
  <script>
  paceOptions = {
  restartOnPushState: true
}
  </script>
    <!-- /.content-header -->
    <!-- Main content -->
    <?php  if($this->session->user_type!=3){ ?>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
     
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= count($countStation);?></h3>
                <p>Notes</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="<?= base_url('station');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= count($countArea) ?></h3>
                <p>Area</p>
              </div>
              <div class="icon">
                <i class="fa fa-clone"></i>
              </div>
              <a href="<?= base_url('area');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= count($countChallan) ?></h3>
                <p>Challan</p>
              </div>
              <div class="icon">
                <i class="fa fa-clone"></i>
              </div>
              <a href="<?= base_url('challan');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          

          <?php if($this->session->user_type==0){ ?>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= count($countNote);?></h3>
                <p>Notification</p>
              </div>
              <div class="icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <a href="<?= base_url('notification');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
        <?php }?>
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= count($countFine);?></h3>
                <p>Total Fine</p>
              </div>
              <div class="icon">
                <i class="fa fa-comment-o"></i>
              </div>
              <a href="<?= base_url('fine');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= count($countThana);?></h3>
                <p>Thana Incharge</p>
              </div>
              <div class="icon">
                <i class="fa fa-home"></i>
              </div>
              <a href="<?= base_url('thana');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= count($countStaff);?></h3>
                <p>Staff</p>
              </div>
              <div class="icon">
                <i class="fa fa-home"></i>
              </div>
              <a href="<?= base_url('staff');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
       
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
  <?php }?>
    <!-- /.content -->
    <script type="text/javascript">
        $(function(){
          $('.sidebar-toggle').trigger('click');
          $('.active').removeClass("active");
          $('#pg-dashboard').addClass("active");
        });
    </script>
