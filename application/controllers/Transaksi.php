<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->library(array('cart'));
		if ($this->session->userdata('masuk_sistem_rekam') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->data['title_web'] = 'Data Pinjam Buku ';
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, `anggota_id`, 
		`status`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali` 
		FROM tbl_pinjam ORDER BY id_pinjam DESC");

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/pinjam_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function pinjam()
	{

		$this->data['nop'] = $this->M_Admin->buat_kode('tbl_pinjam', 'PJ', 'id_pinjam', 'ORDER BY id_pinjam DESC LIMIT 1');
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");

		$this->data['title_web'] = 'Tambah Pinjam Buku ';

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/tambah_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function detailpinjam()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id);
		if ($count > 0) {
			$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, 
			`anggota_id`, `status`, 
			`tgl_pinjam`, `lama_pinjam`, 
			`tgl_balik`, `tgl_kembali` 
			FROM tbl_pinjam WHERE pinjam_id = '$id'")->row();
		} else {
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
		}

		$this->data['title_web'] = 'Detail Pinjam Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function kembalipinjam()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id);
		if ($count > 0) {
			$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, 
			`anggota_id`, `status`, 
			`tgl_pinjam`, `lama_pinjam`, 
			`tgl_balik`, `tgl_kembali` 
			FROM tbl_pinjam WHERE pinjam_id = '$id'")->row();
		} else {
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
		}


		$this->data['title_web'] = 'Kembali Pinjam Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/kembali', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function prosespinjam()
	{
		$post = $this->input->post();

		if (!empty($post['tambah'])) {

			$tgl = $post['tgl'];
			$tgl2 = date('Y-m-d', strtotime('+' . $post['lama'] . ' days', strtotime($tgl)));

			$hasil_cart = array_values(unserialize($this->session->userdata('cart')));
			$status = $this->session->userdata('level') === 'Anggota' ? 'Pending' : 'Dipinjam';
			foreach ($hasil_cart as $isi) {
				$data[] = array(
					'pinjam_id' => htmlentities($post['nopinjam']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'buku_id' => $isi['id'],
					'status' => $status,
					'tgl_pinjam' => htmlentities($post['tgl']),
					'lama_pinjam' => htmlentities($post['lama']),
					'tgl_balik'  => $tgl2,
					'tgl_kembali'  => '0',
				);
			}
			$total_array = count($data);
			if ($total_array != 0) {
				$this->db->insert_batch('tbl_pinjam', $data);

				$cart = array_values(unserialize($this->session->userdata('cart')));
				for ($i = 0; $i < count($cart); $i++) {
					unset($cart[$i]);
					$this->session->unset_userdata($cart[$i]);
					$this->session->unset_userdata('cart');
				}
			}

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}

		if ($this->input->get('pinjam_id')) {
			$this->M_Admin->delete_table('tbl_pinjam', 'pinjam_id', $this->input->get('pinjam_id'));
			$this->M_Admin->delete_table('tbl_denda', 'pinjam_id', $this->input->get('pinjam_id'));

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p>  Hapus Transaksi Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}

		if ($this->input->get('kembali')) {
			$id = $this->input->get('kembali');
			$pinjam = $this->db->query("SELECT  * FROM tbl_pinjam WHERE pinjam_id = '$id'");

			foreach ($pinjam->result_array() as $isi) {
				$pinjam_id = $isi['pinjam_id'];
				$denda = $this->db->query("SELECT * FROM tbl_denda WHERE pinjam_id = '$pinjam_id'");
				$jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();
				if ($denda->num_rows() > 0) {
					$s = $denda->row();
					echo $s->denda;
				} else {
					$date1 = date('Ymd');
					$date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']);
					$diff = $date2 - $date1;
					if ($diff >= 0) {
						$harga_denda = 0;
						$lama_waktu = 0;
					} else {
						$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
						$harga_denda = $jml * ($dd->harga_denda * abs($diff));
						$lama_waktu = abs($diff);
					}
				}
			}

			$data = array(
				'status' => 'Di Kembalikan',
				'tgl_kembali'  => date('Y-m-d'),
			);

			$total_array = count($data);
			if ($total_array != 0) {
				$this->db->where('pinjam_id', $this->input->get('kembali'));
				$this->db->update('tbl_pinjam', $data);
			}

			$data_denda = array(
				'pinjam_id' => $this->input->get('kembali'),
				'denda' => $harga_denda,
				'lama_waktu' => $lama_waktu,
				'tgl_denda' => date('Y-m-d'),
			);
			$this->db->insert('tbl_denda', $data_denda);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Pengembalian Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}
	}

	public function denda()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['denda'] =  $this->db->query("SELECT * FROM tbl_biaya_denda ORDER BY id_biaya_denda DESC");

		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_biaya_denda', 'id_biaya_denda', $id);
			if ($count > 0) {
				$this->data['den'] = $this->db->query("SELECT *FROM tbl_biaya_denda WHERE id_biaya_denda='$id'")->row();
			} else {
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="' . base_url('transaksi/denda') . '"</script>';
			}
		}

		$this->data['title_web'] = ' Denda ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('denda/denda_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function dendaproses()
	{
		if (!empty($this->input->post('tambah'))) {
			$post = $this->input->post('harga');
			$data = array(
				'harga_denda' => $post,
				'stat' => 'Tidak Aktif',
				'tgl_tetap' => date('Y-m-d')
			);

			$this->db->insert('tbl_biaya_denda', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah  Harga Denda  Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}

		if (!empty($this->input->post('edit'))) {
			$dd = $this->M_Admin->get_tableid('tbl_biaya_denda', 'stat', 'Aktif');
			foreach ($dd as $isi) {
				$data1 = array(
					'stat' => 'Tidak Aktif',
				);
				$this->db->where('id_biaya_denda', $isi['id_biaya_denda']);
				$this->db->update('tbl_biaya_denda', $data1);
			}

			$post = $this->input->post();
			$data = array(
				'harga_denda' => htmlentities($post['harga']),
				'stat' => $post['status'],
				'tgl_tetap' => date('Y-m-d')
			);

			$this->db->where('id_biaya_denda', $post['edit']);
			$this->db->update('tbl_biaya_denda', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Harga Denda  Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}

		if (!empty($this->input->get('denda_id'))) {
			$this->db->where('id_biaya_denda', $this->input->get('denda_id'));
			$this->db->delete('tbl_biaya_denda');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Harga Denda Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}
	}


	public function result()
	{

		$user = $this->M_Admin->get_tableid_edit('tbl_login', 'anggota_id', $this->input->post('kode_anggota'));
		error_reporting(0);
		if ($user->nama != null) {
			echo '<table class="table table-striped">
						<tr>
							<td>Nama Anggota</td>
							<td>:</td>
							<td>' . $user->nama . '</td>
						</tr>
						<tr>
							<td>Telepon</td>
							<td>:</td>
							<td>' . $user->telepon . '</td>
						</tr>
						<tr>
							<td>E-mail</td>
							<td>:</td>
							<td>' . $user->email . '</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td>' . $user->alamat . '</td>
						</tr>
						<tr>
							<td>Level</td>
							<td>:</td>
							<td>' . $user->level . '</td>
						</tr>
					</table>';
		} else {
			echo 'Anggota Tidak Ditemukan !';
		}
	}

	public function buku()
	{
		$id = $this->input->post('judul');
		$row = $this->db->query("SELECT * FROM tbl_buku WHERE title LIKE '%$id%'");

		if ($row->num_rows() > 0) {
			$tes = $row->row();
			$item = array(
				'id'      => $tes->buku_id,
				'qty'     => 1,
				'price'   => '1000',
				'name'    => $tes->title,
				'options' => array('isbn' => $tes->isbn, 'thn' => $tes->thn_buku, 'penerbit' => $tes->penerbit)
			);
			if (!$this->session->has_userdata('cart')) {
				$cart = array($item);
				$this->session->set_userdata('cart', serialize($cart));
			} else {
				$cart = array_values(unserialize($this->session->userdata('cart')));
				$index = array_search($item['id'], array_column($cart, 'id'));;
				if ($index === false) {
					array_push($cart, $item);
					$this->session->set_userdata('cart', serialize($cart));
				} else {
					$cart[$index]['quantity']++;
					$this->session->set_userdata('cart', serialize($cart));
				}
			}
		} else {
		}
	}

	public function buku_list()
	{
?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Title</th>
					<th>Penerbit</th>
					<th>Tahun</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				if (empty($this->session->userdata('cart'))) {
					echo '<tr><td colspan="5">Kode Buku tidak ditemukan</td></tr>';
				} else {
					foreach (array_values(unserialize($this->session->userdata('cart'))) as $items) { ?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= $items['name']; ?></td>
							<td><?= $items['options']['penerbit']; ?></td>
							<td><?= $items['options']['thn']; ?></td>
							<td>
								<a href="javascript:void(0)" id="delete_buku<?= $no; ?>" data_<?= $no; ?>="<?= $items['id']; ?>" class="btn btn-danger btn-sm">
									<i class="fa fa-trash"></i></a>
							</td>
							<td><div class="checkbox" style="margin-left: 1em;"><input type="checkbox"></div></td>
						</tr>
						<script>
							$(document).ready(function() {
								$("#delete_buku<?= $no; ?>").click(function(e) {
									$.ajax({
										type: "POST",
										url: "<?php echo base_url('transaksi/del_cart'); ?>",
										data: 'kode_buku=' + $(this).attr("data_<?= $no; ?>"),
										beforeSend: function() {},
										success: function(html) {
											$("#tampil").html(html);
										}
									});
								});
							});
						</script>
				<?php $no++;
					}
				} ?>
			</tbody>
		</table>
		<?php
		if (empty($this->session->userdata('cart'))) {
		} else {
			foreach (array_values(unserialize($this->session->userdata('cart'))) as $items) { ?>
				<input type="hidden" value="<?= $items['id']; ?>" name="idbuku[]">
		<?php }
		} ?>
		<div id="tampil"></div>
<?php
	}

	public function del_cart()
	{
		error_reporting(0);
		$id = $this->input->post('buku_id');
		$index = $this->exists($id);
		$cart = array_values(unserialize($this->session->userdata('cart')));
		unset($cart[$index]);
		$this->session->set_userdata('cart', serialize($cart));
		// redirect('jual/tambah');
		echo '<script>$("#result_buku").load("' . base_url('transaksi/buku_list') . '");</script>';
	}

	private function exists($id)
	{
		$cart = array_values(unserialize($this->session->userdata('cart')));
		for ($i = 0; $i < count($cart); $i++) {
			if ($cart[$i]['buku_id'] == $id) {
				return $i;
			}
		}
		return -1;
	}

	public function approve($id)
	{
		$data = array(
			'status' => 'Dipinjam',
		);
		$pinjam = $this->db->query("SELECT * FROM tbl_pinjam INNER JOIN tbl_buku ON tbl_buku.buku_id = tbl_pinjam.buku_id INNER JOIN tbl_login ON tbl_login.anggota_id = tbl_pinjam.anggota_id WHERE pinjam_id = '$id'")->row();
		$this->db->where('pinjam_id', $id);
		$this->db->update('tbl_pinjam', $data);

		$jml = $pinjam->jml-1;

		$this->db->query("UPDATE `tbl_buku` SET `jml` = '$jml'  WHERE `buku_id` = '$pinjam->buku_id'");

		$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Berhasil disetujui !</p>
			</div></div>');

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode(['success' => true, 'message' => "Berhasil disetujui !"]);
	}
}
