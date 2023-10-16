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

		.navbar {
			margin-bottom: 20px;
		}

		.navbar-inverse {
			background-color: #28a745;
			/* Hijau */
			display: flex;
			align-items: center;
			position: relative;
			padding: 10px;
		}

		.navbar-color {
			color: #FFFFFF;
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			text-align: center;
		}

		.navbar-color h2 {
			color: #FFFFFF;
			text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
		}

		.login-box {
			margin-top: 30px;
		}

		.login-box-body {
			border: 2px solid #28a745;
			/* Hijau */
			padding: 20px;
			background-color: #e6ffe6;
			/* Hijau muda */
			border-radius: 10px;
			/* Pembulatan sudut */
		}

		.login-logo p {
			color: #28a745;
			/* Hijau */
		}

		.btn-primary {
			background-color: #28a745;
			/* Hijau */
			border-color: #28a745;
			/* Hijau */
		}

		.btn-primary:hover,
		.btn-primary:active,
		.btn-primary:focus {
			background-color: #218838;
			/* Hijau tua */
			border-color: #218838;
			/* Hijau tua */
		}

		.form-control {
			border-radius: 5px;
		}

		.form-group {
			margin-bottom: 15px;
		}

		.row {
			margin-top: 15px;
		}

		body {
			overflow-y: auto;
			background: url('<?php echo base_url('assets_style/image/bg.jpg'); ?>') no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}

		@media (max-width: 767px) {
			.navbar-color {
				position: static;
				transform: none;
				text-align: left;
				margin-top: 10px;
			}
		}
	</style>
</head>


<body class="hold-transition login-page" style="background:url('<?php echo base_url('assets_style/image/bg.jpg'); ?>')no-repeat;background-size:100%;">
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<img src="<?php echo base_url('assets_style/image/logo.png'); ?>" alt="logo" width="120px">
		</div>
		<div class="navbar-text navbar-color">
			<h2><b>PERPUSTAKAAN <br> SMP UNGGULAN AISYYAH BANTUL</b></h2>
		</div>
	</nav>
	<div class="container mt-5">
		<div class="login-box">
			<div id="tampilalert"></div>
			<div class="login-box-body">
				<div class="login-logo">
					<p><b>Register<br /></p>
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
						<button type="submit" class="btn btn-primary btn-md">Register</button>
				</form>
			</div>
			<a href="<?= base_url() ?>" class="text-center d-block mt-3">Sudah Punya Akun</a>
			<!-- /.login-box-body -->
			<br />
		</div>
		<!-- /.login-box -->
	</div>
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