
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Traffic C.G.</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/admin-lte/plugins/bootstrap/css/bootstrap.min.css'); ?>">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('css/modern-business.css')?>" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">CG  Traffic</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('head/aboutus')?>">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('head/map')?>">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('head/notice')?>">Contact</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="<?= site_url('login')?>">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('<?php echo site_url('images/header.jpg');?>')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Traffic Police</h3>
           
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('<?php echo site_url('images/header.jpg');?>')">
          <div class="carousel-caption d-none d-md-block">
            
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('<?php echo site_url('images/header.jpg');?>')">
          <div class="carousel-caption d-none d-md-block">
           
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>
  <style>
    .list-group{
    max-height: 300px;
    margin-bottom: 10px;
    overflow-y:scroll;
    -webkit-overflow-scrolling: touch;
  }
  </style>

  <!-- Page Content -->
  <div class="container">

    <h1 class="my-4">Welcome to Traffic Module</h1>

    <!-- Marketing Icons Section -->
    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Notification</h4>
          <div class="card-body">
            <div class="panel panel-default" >
                <div class="panel-body" >
                    <div class="row">
                    
                            <ul  class="list-group" style="width: 100%" >
                              <?php
                              if(isset($rsNotification))
                              {
                                  foreach ($rsNotification as $value) 
                                  {
                                    echo "<li class='list-group-item'>".$value['nTitle']."<br>".$value['ndescription']."<br>";
                                    if($value['file']!='')
                                    {
                                       echo "
                                    <a href='".site_url($value['file'])."' download>Read More</a>";
                                    }
                                    echo "</li>";
                                    
                                  }
                                  
                               
                              }
                              ?>
                          
                             </ul>
                       
                    </div>
   
                </div>
  
            <div class="panel-footer"> <ul class="pagination pull-right" style="margin: 0px;"><li><a href="#" class="prev"><span class="glyphicon glyphicon-chevron-down"></span></a></li><li><a href="#" class="next"><span class="glyphicon glyphicon-chevron-up"></span></a></li></ul><div class="clearfix"></div></div>
   
        </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Upcoming Events</h4>
          <div class="card-body">
            
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <div class="mapouter">
      <div class="gmap_canvas">
        <iframe width="100%" height="490" id="gmap_canvas" src="https://maps.google.com/maps?q=Raipur&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
          
        </iframe>
       </div><style>.mapouter{position:relative;text-align:right;height:490px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:490px;width:100%;}</style>
     </div>

   
  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">C.G.Police</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

</body>

</html>