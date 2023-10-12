<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if ($this->session->userdata('level') == 'Anggota') {
	redirect(base_url('transaksi'));
} ?>
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard <small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-sm-12">

				<div class="col-lg-4 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?= $count_pinjam; ?></h3>

							<p>Peminjaman</p>
						</div>
						<div class="icon">
							<i class="fa fa-user-plus"></i>
						</div>
						<a href="transaksi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-xs-6">
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?= $count_kembali; ?></h3>

							<p>Pengembalian</p>
						</div>
						<div class="icon">
							<i class="fa fa-list"></i>
						</div>
						<a href="transaksi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-xs-6">
					<div class="small-box bg-orange">
						<div class="inner">
							<h3><?= $count_pending; ?></h3>

							<p>Status Transaksi</p>
						</div>
						<div class="icon">
							<i class="fa fa-list"></i>
						</div>
						<a href="transaksi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-xs-6">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?= $count_pengguna; ?></h3>

							<p>Anggota</p>
						</div>
						<div class="icon">
							<i class="fa fa-edit"></i>
						</div>
						<a href="user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-xs-6">
					<!--small box-->
					<div class="small-box bg-blue">
						<div class="inner">
							<h3><?= $count_buku; ?></h3>

							<p>Buku</p>
						</div>
						<div class="icon">
							<i class="fa fa-book"></i>
						</div>
						<a href="data" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-12 center-block" style="padding: 0 1em">
					<button class="btn btn-primary btn-block" id="generateqr"><i class="fa fa-qrcode"> </i> Generate QR</button>
					<div class="mx-auto text-center hidden" id="qr" style="margin-top: 1em">
						<img src="<?= base_url(); ?>/dashboard/generateqr" class="w-25 img-thumbnail">
						<a id="printqr" class="btn btn-success btn-block" style="margin-top:1em"><i class="fa fa-print"> </i> Print QR</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	$('#generateqr').on('click', () => {
		$('#qr').removeClass('hidden')
	})
	$('#printqr').on('click', () => {
		window.open('/dashboard/printqr', '_blank')
	})
</script>
<!-- /.content -->
