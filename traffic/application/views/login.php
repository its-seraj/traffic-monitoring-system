<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Traffic| Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/dist/css/adminlte.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/plugins/iCheck/square/blue.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Log</b>IN</a>
  </div>
  <?php 
  if(validation_errors())
  echo '<div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    '.validation_errors().'
          </div>';

  //id or password incorrect
  if($this->session->flashdata('statusType'))
  {
      echo '<div class="alert alert-'.$this->session->statusType.' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>'.$this->session->statusMsg.'</p>
            </div>
      ';
  }
  ?>
  <!-- /.login-logo -->
  <div class="card">

    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?= base_url("login")?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email ID" aria-label="Recipient's username" aria-describedby="basic-addon2" name="useremail" value="<?= $useremail; ?>">
          <div class="input-group-append">
            <span class="fa fa-envelope input-group-text" id="basic-addon2"></span>
          </div>
        </div>
         <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" aria-label="Recipient's username" aria-describedby="basic-addon2" name="password" value="<?= $userpassword; ?>">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text" id="basic-addon2"></span>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-8">
            <input type="checkbox" name="remeber"> <sub>Remeber me.</sub>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('assets/vendor/admin-lte/plugins/jquery/jquery.min.js') ?>">></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/vendor/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>">></script>
<!-- iCheck -->
<script src="<?= base_url('assets/vendor/admin-lte/plugins/iCheck/icheck.min.js') ?>">></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
