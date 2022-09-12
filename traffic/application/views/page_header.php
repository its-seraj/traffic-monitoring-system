<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Traffic | <?php echo $title; ?></title>


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/admin-lte/plugins/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/admin-lte/plugins/font-awesome/css/font-awesome.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/admin-lte/dist/css/adminlte.min.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/vendor/datatables/datatables.min.js'); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/fastclick/fastclick.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendor/admin-lte/dist/js/adminlte.js')?>"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url('assets/vendor/admin-lte/dist/js/demo.js')?>"></script>

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/sparkline/jquery.sparkline.min.js')?>"></script>
<!-- jVectorMap -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
<!-- ChartJS 1.0.2 -->
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/chartjs-old/Chart.min.js')?>"></script>

<!-- PAGE SCRIPTS -->
<script src="<?php echo base_url('assets/vendor/admin-lte/dist/js/pages/dashboard2.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js')?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/datepicker/datepicker3.css')?>">
<script src="<?php echo base_url('assets/vendor/datepicker/bootstrap-datepicker.js')?>"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link sidebar-toggle" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <li class="nav-item">
        <a class="nav-link"  href="<?php echo base_url('Login/logout'); ?>" title="Logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php if(isset($title)){echo $title;} ?></h1>
              </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                  <?php
                    if(isset($breadcrumbs)){
                        $array_keys = array_keys($breadcrumbs);
                        $last_key = end($array_keys);
                        foreach ($breadcrumbs as $key => $value) {
                          if($key==$last_key){
                            //last element
                            echo'<li class="breadcrumb-item active">'.$key.'</li>';
                          }
                          else{
                            echo'<li class="breadcrumb-item"><a href="'.$value.'">'.$key.'</a></li>';
                          }
                        }
                    }//if
                   ?>
                  </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">