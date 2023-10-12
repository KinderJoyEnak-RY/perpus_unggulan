<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-edit" style="color:green"> </i> <?= $title_web; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
			<li class="active"><i class="fa fa-file-text"></i>&nbsp; <?= $title_web; ?></li>
		</ol>
	</section>
	<section class="content">
		<?php if (!empty($this->session->flashdata())) {
			echo $this->session->flashdata('pesan');
		} ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">

					<!-- /.box-header -->
					<div class="box-body">
						<br />
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table" width="100%">

								<?php if ($this->session->userdata('level') == 'Petugas') { ?>
									<tbody>
										<tr>

											<div class="container">
												<br>
												<h4>Pencarian Data Berdasarkan Tanggal</h4>

												<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

													<div class="form-group">
														<label>Tanggal Awal</label>
														<div class="input-group date">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
															<input id="tgl_mulai" placeholder="masukkan tanggal Awal" type="text" class="form-control datepicker" name="tgl_awal" value="<?php if (isset($_POST['tgl_awal'])) echo $_POST['tgl_awal']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label>Tanggal Akhir</label>
														<div class="input-group date">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
															<input id="tgl_akhir" placeholder="masukkan tanggal Akhir" type="text" class="form-control datepicker" name="tgl_akhir" value="<?php if (isset($_POST['tgl_akhir'])) echo $_POST['tgl_akhir']; ?>">
														</div>
													</div>

													<script type="text/javascript">
														$(function() {
															$(".datepicker").datepicker({
																format: 'dd-mm-yyyy',
																autoclose: true,
																todayHighlight: false,
															});
															$("#tgl_mulai").on('changeDate', function(selected) {
																var startDate = new Date(selected.date.valueOf());
																$("#tgl_akhir").datepicker('setStartDate', startDate);
																if ($("#tgl_mulai").val() > $("#tgl_akhir").val()) {
																	$("#tgl_akhir").val($("#tgl_mulai").val());
																}
															});
														});
													</script>
													<div class="form-group">
														<input type="submit" class="btn btn-info" value="Cari">
														<input type="submit" class="btn btn-info" value="Print">
													</div>
												</form>
												<table class="table table-bordered table-hover">
													<br>
													<thead>
														<tr>
															<th>No</th>
															<th>Sampul</th>
															<th>ISBN</th>
															<th>Judul</th>
															<th>Penerbit</th>
															<th>Tahun Buku</th>
															<th>Stok Buku</th>
															<th>Dipinjam</th>
															<th>Tanggal Masuk</th>
														</tr>
													</thead>
													<tbody>
														<?php
														if (empty($this->data['transaksi'])) { // Jika data tidak ada
															echo "<tr><td colspan='8'>Data tidak ada</td></tr>";
														} else { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
															foreach ($this->data['transaksi'] as $key => $data) { // Looping hasil data transaksi
																$tgl_masuk = date('d-m-Y', strtotime($data->tgl_masuk)); // Ubah format tanggal jadi dd-mm-yyyy
																echo "<tr>";
																echo "<td>" . ($key+1) . "</td>";
																echo "<td>" . $data->buku_id . "</td>";
																echo "<td>" . $data->isbn . "</td>";
																echo "<td>" . $data->title . "</td>";
																echo "<td>" . $data->penerbit . "</td>";
																echo "<td>" . $data->pengarang . "</td>";
																echo "<td>" . $data->thn_buku . "</td>";
																echo "<td>" . $data->jml . "</td>";
																echo "<td>" . $tgl_masuk . "</td>";
																echo "</tr>";
															}
														}
														?>
													</tbody>
									</tbody>

								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
