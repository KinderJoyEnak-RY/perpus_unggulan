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
				<a href="/index.php" style="color: black;"><b>SISTEM INFORMASI <br />PERPUSTAKAAN</b></a>
			</div>

			<form action="<?php echo base_url('login/processRegister'); ?>" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" name="nama" required="required" placeholder="Nama">
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="user" required="required" placeholder="Username">
						</div>
						<div class="form-group">
							<label>Telepon</label>
							<input id="uintTextBox" class="form-control" name="telepon" required="required" placeholder="Contoh : 089618173609">
						</div>
						<div class="form-group">
							<label>E-mail</label>
							<input type="email" class="form-control" name="email" required="required" placeholder="Contoh : randisyustico@gmail.com">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="pass" required="required" placeholder="Password">
						</div>
					</div>
				</div>
				<div class="pull-right">
					<button type="submit" class="btn btn-primary btn-md">Submit</button>
			</form>
		</div>
		<a href="<?= base_url() ?>" class="text-center">Sudah punya akun</a>
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