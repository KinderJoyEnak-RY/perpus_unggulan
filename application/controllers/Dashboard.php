<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once dirname(__DIR__) . '/libraries/phpqrcode/phpqrcode.php';

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
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
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['title_web'] = 'Dashboard ';
		$this->data['count_pengguna'] = $this->db->query("SELECT * FROM tbl_login")->num_rows();
		$this->data['count_buku'] = $this->db->query("SELECT * FROM tbl_buku")->num_rows();
		$this->data['count_pinjam'] = $this->db->query("SELECT * FROM tbl_pinjam WHERE status = 'Dipinjam'")->num_rows();
		$this->data['count_kembali'] = $this->db->query("SELECT * FROM tbl_pinjam WHERE status = 'Di Kembalikan'")->num_rows();
		$this->data['count_pending'] = $this->db->query("SELECT * FROM tbl_pinjam WHERE status = 'Pending'")->num_rows();
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('dashboard_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function generateQr()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$url = base_url() . 'dashboard/processqr';
		QRcode::png($url, false, 'L', 12, 2);
	}

	public function scanQr()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->load->view('scanqr');
	}

	public function processQr()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$date = new DateTime();
		$data = [
			'user_id' => $this->session->userdata('ses_id'),
			'datetime' => $date->format('Y-m-d H:i:s')
		];
		try {
			$this->db->insert('tbl_absen', $data);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode(['success' => true, 'message' => 'Berhasil absen']);
		} catch (\Exception $e) {
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode(['success' => false, 'message' => 'Gagal absen']);
		}
	}

	public function printQr()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->load->view('printqr');
	}
}
