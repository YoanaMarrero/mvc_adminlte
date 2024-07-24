<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="user_name" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="user_pass" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <?php 
        $ctr_login = new users_controller();
        $ctr_login->login_user();
      ?>
      <div class="row">
        <div class="col-md-11 pull-right">
          <div class="checkbox icheck">
            <label>
            &nbsp;<input type="checkbox"> Recordame
            </label>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar sesión</button>&nbsp;
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>


