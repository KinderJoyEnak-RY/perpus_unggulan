<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CheckLate extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
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
		$currDate = new DateTime(date('Y-m-d'));
		$extDate = date('Y-m-d', strtotime("+3 days"));
		$data = $this->db->query("SELECT * FROM tbl_pinjam INNER JOIN tbl_buku ON tbl_buku.buku_id = tbl_pinjam.buku_id INNER JOIN tbl_login ON tbl_login.anggota_id = tbl_pinjam.anggota_id WHERE status = 'Dipinjam' AND 'tgl_balik' <= $extDate")->result_array();
		foreach ($data as $value) {
			$kembali = $value['tgl_balik'];
			$date = new DateTime($kembali);
			$diff = $currDate->diff($date)->format("%r%a");
			if ($diff <= 0) {
				$title = $value['title'];
				$message = "Anda memiliki buku yang masih di pinjam \n\nNama Buku: $title\nTgl Kembali: $kembali\n\nMohon untuk kembalikan buku tepat waktu agar tidak dikenakan denda";
				try {
					$this->sendWA(preg_replace('/^0?/', '62', $value['telepon']), $message);
				} catch (\Exception $e) {
				}
			}
		}

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode(['success' => true, 'message' => 'Success']);
	}
	
	private function sendWA($phone, $message)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.kirimwa.id/v1/messages');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Authorization: Bearer R+yTITosTVTiHKsEdltaGkovGmEm+BTLBL6NftODigFOVCj1QPR1CcuNifkjuGfY-hendrik',
			'Content-Type: application/json',
		]);
		$data = [
			'phone_number' => $phone,
			'message' => $message,
			'device_id' => 'iphone-x-pro',
			'message_type' => 'text'
		];
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		$response = curl_exec($ch);

		curl_close($ch);

		return $response;
	}
}
