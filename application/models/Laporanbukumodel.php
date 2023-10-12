<?php if (!defined('BASEPATH')) exit('No direct script acess allowed');

class Laporanbukumodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
	}

	function get_all()
	{
		$query = $this->db->query("SELECT * FROM tbl_buku INNER JOIN tbl_pinjam ON tbl_pinjam.buku_id = tbl_buku.buku_id GROUP BY tbl_buku.buku_id")->result();
		return $query;
	}

	function view_by_date($start, $end)
	{
		$start = date("Y-m-d", strtotime($start));
		$end = date("Y-m-d", strtotime($end));
		$query = $this->db->query("SELECT * FROM tbl_buku INNER JOIN tbl_pinjam ON tbl_pinjam.buku_id = tbl_buku.buku_id  WHERE tbl_pinjam.tgl_pinjam BETWEEN '$start' AND '$end' GROUP BY tbl_buku.buku_id")->result();
		return $query;
	}
}
