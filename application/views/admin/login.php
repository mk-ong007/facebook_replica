<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meet my friend | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>src/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>src/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>src/admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b> Panel</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
       <?php
            if(!empty( $this->session->flashdata('msg')))
            {
                echo '<div class="text-center alert alert-danger" >'.$this->session->flashdata('msg').'</div>';
            }
        ?>
      <form action="<?php echo base_url('admin/login/authenticate') ?>" method="post">
        <div class="input-group mb-1">
          <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo isset($_COOKIE['email'])?$_COOKIE['email']:'' ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
          <div class="text-danger mb-3" >
            <?php echo form_error('email'); ?>  
          </div>      
        <div class="input-group mb-1">
          <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo isset($_COOKIE['password'])?$_COOKIE['password']:'' ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <div class="text-danger mb-3" >
            <?php echo form_error('password'); ?>  
          </div>            
        <div class="row mb-4">
          <div class="col-12">
            <div class="icheck-primary">
              <input type="checkbox" name="rememberMe" id="remember" <?php echo isset($_COOKIE['password'])?'checked':'' ?>>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        

          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>

        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1 text-center">
        <a href="forgot-password.html">I forgot my password</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>src/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>src/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>src/admin/dist/js/adminlte.min.js"></script>
</body>
</html>