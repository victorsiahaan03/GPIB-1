<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8">
	<title>AdminGPIB | Log in</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.4 -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Font Awesome Icons -->
	<link href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<!-- iCheck -->
	<link href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
  </head>
  <body class="login-page">
	<div class="login-box">
	  <div class="login-logo">
		<a href="<?php echo base_url(); ?>secure/dashboard"><b>Admin</b>GPIB</a>
	  </div><!-- /.login-logo -->
	  <div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<?= form_open() ?>
		  <div class="form-group has-feedback">
			<input type="text" class="form-control" name="username" placeholder="Username"/>
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="password" class="form-control" name="password" placeholder="Password"/>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		  </div>
		  <div class="row">
			<div class="col-xs-8">	
			  <div class="checkbox icheck">
				<label>
				  <input type="checkbox"> Remember Me
				</label>
			  </div>						
			</div><!-- /.col -->
			<div class="col-xs-4">
			  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div><!-- /.col -->
		  </div>
		</form>

		<a href="#">I forgot my password</a><br>
		<a href="register.html" class="text-center">Register a new membership</a>

	  </div><!-- /.login-box-body -->
	</div><!-- /.login-box -->

	<!-- jQuery 2.1.4 -->
	<script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Bootstrap 3.3.2 JS -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url(); ?>assets/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
		});
	  });
	</script>
  </body>
</html>