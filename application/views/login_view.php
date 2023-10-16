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

		.footer {
			background-color: #28a745;
			/* Hijau */
			color: #FFFFFF;
			text-align: center;
			padding: 10px;
			position: fixed;
			width: 100%;
			bottom: 0;
		}
	</style>
</head>

<body class="hold-transition login-page" style="overflow-y: hidden;background:url('<?php echo base_url('assets_style/image/bg.jpg'); ?>')no-repeat;background-size:100%;">
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<img src="<?php echo base_url('assets_style/image/logo.png'); ?>" alt="logo" width="120px">
		</div>
		<div class="navbar-text navbar-color">
			<h2><b>PERPUSTAKAAN <br> SMP UNGGULAN AISYYAH BANTUL</b></h2>
		</div>
	</nav>

	<div class="login-box">
		<div id="tampilalert"></div>
		<div class="login-box-body">
			<div class="login-logo">
				<p><b>Login<br /></p>
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
					<!-- <div class="col-xs-6">
						<a href="<?= base_url() ?>/login/forgot">Lupa Password</a><br>
					</div> -->
					<div class="col-xs-6" style="display: flex; gap: 0.5em;">
						<a href="<?= base_url() ?>/login/register" class="btn btn-warning btn-flat">Register</a>
						<button type="submit" id="loding" class="btn btn-primary btn-flat">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /.login-box-body -->
	<br />
	</div>
	<!-- /.login-box -->
	<!-- Response Ajax -->
	<div id="tampilkan"></div>
	<footer class="footer">
		<p>Perpustakaan adalah harta karun pengetahuan</p>
	</footer>
	<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets_style/assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('assets_style/assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url('assets_style/assets/plugins/iCheck/icheck.min.js'); ?>"></script>
</body>

</html>