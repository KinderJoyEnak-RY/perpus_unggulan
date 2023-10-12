<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title_web; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="shortcut icon" href="" />
	<link rel="stylesheet" href="<?php echo base_url('assets_style/assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets_style/assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('assets_style/assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets_style/assets/dist/css/AdminLTE.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets_style/assets/dist/css/responsivelogin.css'); ?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style type="text/css">
		.navbar-inverse {
			background-color: #333;
		}

		.navbar-color {
			color: #F0F8FF;
		}

		blink,
		.blink {
			animation: blinker 3s linear infinite;
		}

		@keyframes blinker {
			50% {
				opacity: 50;
			}
		}
	</style>
</head>

<body class="hold-transition login-page" style="overflow-y: hidden;background:url(
	'<?php echo base_url('assets_style/image/SMAN6.png'); ?>')no-repeat;background-size:100%;">
	<div class="login-box">
		<br />
		<div id="tampilalert"></div>
		<!-- /.login-logo -->
		<div class="login-box-body" style="border:2px solid #226bbf;">
			<p class="login-box-msg" style="font-size:16px;"></p>
			<div class="login-logo">
				<img src="<?php echo base_url('assets_style/image/SMA6.png'); ?>" alt="logo" width="120px">
				<br>
				<a href="index.php" style="color: black;"><b>PERPUSTAKAAN <br />SMA NEGERI 6 KOTA SERANG</b></a>
			</div>

			<form action="<?= base_url('login/auth'); ?>" method="POST">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="Username" id="user" name="user" required="required" autocomplete="off">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required="required" autocomplete="off">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-6">
					<a href="<?= base_url() ?>/login/forgot">Lupa Password</a><br>
						<!-- /.social-auth-links -->
					</div>
					<div class="col-xs-6" style="display: flex; gap: 0.5em;">
						<a href="<?= base_url() ?>/login/register" class="btn btn-warning btn-flat">Register</a>
						<button type="submit" id="loding" class="btn btn-primary btn-flat">Sign In</button>
					</div>

					<!-- /.col -->
				</div>
			</form>
		</div>
		<!-- /.login-box-body -->
		<br />
	</div>
	<!-- /.login-box -->
	<!-- Response Ajax -->
	<div id="tampilkan"></div>
	<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets_style/assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('assets_style/assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url('assets_style/assets/plugins/iCheck/icheck.min.js'); ?>"></script>
</body>

</html>
