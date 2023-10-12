<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_login');
		$this->load->model('M_Admin');
	}

	public function index()
	{
		$this->data['title_web'] = 'Login | Sistem Informasi Perpustakaan';
		$this->load->view('login_view', $this->data);
	}

	public function auth()
	{
		$user = htmlspecialchars($this->input->post('user', TRUE), ENT_QUOTES);
		$pass = htmlspecialchars($this->input->post('pass', TRUE), ENT_QUOTES);
		// auth
		$proses_login = $this->db->query("SELECT * FROM tbl_login WHERE user='$user' AND pass = md5('$pass')");
		$row = $proses_login->num_rows();
		if ($row > 0) {
			$hasil_login = $proses_login->row_array();

			// create session
			$this->session->set_userdata('masuk_sistem_rekam', TRUE);
			$this->session->set_userdata('level', $hasil_login['level']);
			$this->session->set_userdata('ses_id', $hasil_login['id_login']);
			$this->session->set_userdata('anggota_id', $hasil_login['anggota_id']);

			echo '<script>window.location="' . base_url() . 'dashboard";</script>';
		} else {

			echo '<script>alert("Login Gagal, Periksa Kembali Username dan Password Anda");
            window.location="' . base_url() . '"</script>';
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		echo '<script>window.location="' . base_url() . '";</script>';
	}

	public function register()
	{
		$this->data['title_web'] = 'Daftar | Sistem Informasi Perpustakaan';
		$this->load->view('register', $this->data);
	}

	public function processRegister()
	{

		$id = $this->M_Admin->buat_kode('tbl_login', 'AG', 'id_login', 'ORDER BY id_login DESC LIMIT 1');
		$nama = htmlentities($this->input->post('nama', TRUE));
		$user = htmlentities($this->input->post('user', TRUE));
		$pass = md5(htmlentities($this->input->post('pass', TRUE)));
		$level = "Anggota";
		$jenkel = $this->input->post('jenkel', TRUE) ? htmlentities($this->input->post('jenkel', TRUE)) : null;
		$telepon = htmlentities($this->input->post('telepon', TRUE));
		$status = $this->input->post('jenkel', TRUE) ? htmlentities($this->input->post('status', TRUE)) : null;
		$alamat = $this->input->post('jenkel', TRUE) ? htmlentities($this->input->post('alamat', TRUE)) : null;
		$email = $_POST['email'];

		$dd = $this->db->query("SELECT * FROM tbl_login WHERE user = '$user' OR email = '$email'");
		if ($dd->num_rows() > 0) {
			echo '<script>alert("Gagal Update User : ' . $nama . ' !, Username / Email Anda Sudah Terpakai");
            window.location="' . base_url('/login/register') . '"</script>';
		} else {
			// setting konfigurasi upload
			$data = array(
				'anggota_id' => $id,
				'user' => $user,
				'nama' => $nama,
				'pass' => $pass,
				'level' => $level,
				'tempat_lahir' => isset($_POST['lahir']) ? $_POST['lahir'] : null,
				'tgl_lahir' => isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : null,
				'level' => $level,
				'email' => $_POST['email'],
				'telepon' => $telepon,
				'jenkel' => $jenkel,
				'alamat' => $alamat,
				'tgl_bergabung' => date('Y-m-d')
			);
			$this->db->insert('tbl_login', $data);

			echo '<script>alert("Daftar User telah berhasil !");
            window.location="' . base_url() . '"</script>';
		}
	}

	public function forgot()
	{
		$this->data['title_web'] = 'Lupa Password | Sistem Informasi Perpustakaan';
		$this->load->view('forgot_password', $this->data);
	}

	public function processForgot()
	{
		if (!isset($_POST['telepon'])) {
			echo '<script>alert("Silahkan masukkan nomor telepon yg valid!");
			window.location="' . base_url('login/forgot') . '"</script>';
		}
		$phone = $_POST['telepon'];
		$dd = $this->db->query("SELECT * FROM tbl_login WHERE telepon = '$phone'");

		if ($dd->num_rows() > 0) {
			$hasil_login = $dd->row_array();
			$data = [
				'reset_token' => md5($phone),
			];
			$this->M_Admin->update_table('tbl_login', 'id_login', $hasil_login['id_login'], $data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://api.kirimwa.id/v1/messages');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Authorization: Bearer R+yTITosTVTiHKsEdltaGkovGmEm+BTLBL6NftODigFOVCj1QPR1CcuNifkjuGfY-hendrik',
				'Content-Type: application/json',
			]);
			$message = "Silahkan klik tautan berikut ini untuk reset password Anda\n\n" . base_url() . "login/reset/" . md5($phone) . "\n\nTerima Kasih";
			$data = [
				'phone_number' => $phone,
				'message' => $message,
				'device_id' => 'iphone-x-pro',
				'message_type' => 'text'
			];
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

			$response = curl_exec($ch);

			curl_close($ch);
			// var_dump($response);
			echo '<script>alert("Link untuk reset password telah dikirim ke nomor telepon / whatsapp anda !");
			window.location="' . base_url() . '"</script>';
		} else {
			echo '<script>alert("Nomor telepon tidak ditemukan!");
            window.location="' . base_url('/login/forgot') . '"</script>';
		}
	}

	public function reset()
	{
		$token = $this->uri->segment(3);
		$dd = $this->db->query("SELECT * FROM tbl_login WHERE reset_token = '$token'");

		if ($dd->num_rows() < 1) {
			echo '<script>alert("Token tidak valid!");
			window.location="' . base_url() . '"</script>';
		}

		$this->data['title_web'] = 'Reset Password | Sistem Informasi Perpustakaan';
		$this->data['token'] = $token;
		$this->load->view('reset_password', $this->data);
	}

	public function processReset()
	{
		$token = isset($_POST['token']) ? $_POST['token'] : null;
		$pass = md5(htmlentities($this->input->post('new_password', TRUE)));
		$confirmPass = md5(htmlentities($this->input->post('confirm_password', TRUE)));
		if (empty($token)) {
			echo '<script>alert("Token tidak valid!");
			window.location="' . base_url() . '"</script>';
		}

		$dd = $this->db->query("SELECT * FROM tbl_login WHERE reset_token = '$token'");

		if ($dd->num_rows() < 1) {
			echo '<script>alert("Token tidak valid!");
			window.location="' . base_url() . '"</script>';
		}

		if ($pass != $confirmPass) {
			echo '<script>alert("Password tidak sama!");
			window.location="' . base_url('login/reset/' . $token) . '"</script>';
		}
		$data = [
			'reset_token' => null,
			'pass' => $pass
		];
		$hasil_login = $dd->row_array();
		$this->M_Admin->update_table('tbl_login', 'id_login', $hasil_login['id_login'], $data);

		echo '<script>alert("Password berhasil diubah!");
			window.location="' . base_url() . '"</script>';
	}
}
