<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Perpustakaan UA</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<style>
		body {
			background-color: #f0f0f0;
		}

		.navbar {
			background-color: #00796b;
			box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.1);
		}

		.navbar-brand,
		.nav-link {
			color: #ffffff !important;
		}

		.navbar-brand img {
			width: 30px;
			height: 30px;
			margin-right: 10px;
		}

		.header {
			background: url('https://images.unsplash.com/photo-1569511166187-97eb6e387e19?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=1080&ixid=MnwxfDB8MXxyYW5kb218MHx8bGlicmFyeXx8fHx8fDE2OTYwMTYwMjE&ixlib=rb-4.0.3&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=1920') no-repeat center center;
			background-size: cover;
			color: #ffffff;
			padding: 100px 0;
			text-align: center;
		}

		.header h1 {
			margin: 0;
			padding: 0;
			font-size: 2.8em;
		}

		.content {
			text-align: center;
			padding: 50px 0;
			background-color: #ffffff;
		}

		.content img {
			width: 150px;
			height: 150px;
			margin-bottom: 20px;
			border-radius: 50%;
			box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
		}

		.content h1 {
			font-size: 2.2em;
			margin-bottom: 10px;
			color: #00796b;
		}

		.content p {
			color: #6c757d;
			font-size: 1.1em;
		}

		.footer {
			background-color: #00796b;
			color: #ffffff;
			text-align: center;
			padding: 10px;
			position: fixed;
			bottom: 0;
			width: 100%;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand d-flex align-items-center" href="<?php echo base_url('hal_utama') ?>">
				<img src="assets/image/profil_perpus/logo_smp_ua.png" alt="Logo SMP UA"> Perpustakaan UA
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('hal_utama') ?>"><i class="fas fa-home"></i> Beranda</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url() ?>Auth"><i class="fas fa-sign-in-alt"></i> Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="header">
		<h1>Selamat Datang di Perpustakaan SMP Unggulan Aisyiyah Bantul</h1>
	</div>

	<div class="content">
		<img src="assets/image/profil_perpus/logo_smp_ua.png" alt="Logo SMP UA">
		<h1>Tempat Dimana Pengetahuan dan Informasi Berkembang</h1>
		<p>Menyediakan berbagai koleksi buku dan sumber belajar yang dapat diakses oleh semua siswa dan guru untuk mendukung proses belajar mengajar.</p>
	</div>

	<div class="footer">
		<p>&copy; 2023 Perpustakaan UA. All Rights Reserved.</p>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>