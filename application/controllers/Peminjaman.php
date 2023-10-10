<?php

class Peminjaman extends CI_Controller{

    public function __construct()
    {
        parent ::__construct();
        $this->load->model('m_peminjaman');
        $this->load->library('session');
        $this->load->library('ciqrcode');
    }

    public function index()
    {
        $isi['content'] = 'peminjaman/v_peminjaman';
        $isi['judul']   = 'Data Peminjaman';
        $isi['data']    = $this->m_peminjaman->getDataPeminjaman();
        $this->load->view('v_dashboard', $isi);
    }
    
    public function tambah_peminjaman()
    {
        $isi['content'] = 'peminjaman/form_peminjaman';
        $isi['judul']   = 'Form Peminjaman Buku';
        $isi['id_peminjaman'] = $this->m_peminjaman->id_peminjaman();
        $isi['peminjam'] = $this->db->get('anggota')->result();
        $isi['buku']     = $this->db->get('buku')->result();

        $dataQRCode = $this->session->userdata('dataQRCode'); // Ambil data hasil scan QR code dari session

        if ($dataQRCode) {
            $isi['id_bukuQRCode'] = $dataQRCode['id_buku'];
            $isi['judul_bukuQRCode'] = $dataQRCode['judul_buku'];
            $isi['pengarangQRCode'] = $dataQRCode['pengarang'];
            $isi['penerbitQRCode'] = $dataQRCode['penerbit'];
        } else {
            $isi['id_bukuQRCode'] = '';
            $isi['judul_bukuQRCode'] = '';
            $isi['pengarangQRCode'] = '';
            $isi['penerbitQRCode'] = '';
        }

        $this->load->view('v_dashboard', $isi);
        $this->load->view('templates/scan_header', $isi);
        $this->load->view('templates/scan_footer', $isi);
    }

    public function simpan()
    {
        $data = array(
            'id_peminjaman'  => $this->input->post('id_peminjaman'),
            'id_anggota'     => $this->input->post('id_anggota'),
            'id_buku'        => $this->input->post('id_buku'),
            'judul_buku'     => $this->input->post('judul_buku'),
            'penerbit'       => $this->input->post('penerbit'),
            'pengarang'      => $this->input->post('pengarang'),
            'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
            'tanggal_kembali'=> $this->input->post('tanggal_kembali'),
        );
        $query = $this->db->insert('peminjaman', $data);
        if ($query = true) {
            $this->session->set_flashdata('info','Data Transaksi berhasil di Simpan');
            redirect('peminjaman');
        }
        
        // Mendapatkan hasil scan QR code
       
    
         // Simpan data ke dalam database
        $query = $this->db->insert('peminjaman', $data);
    
    
                foreach ($selectedBooks as $selectedBook) {
                    $this->db->set('jumlah_buku', 'jumlah_buku - 1', FALSE);
                    $this->db->where('id_buku', $selectedBook);
                    $this->db->update('buku');
    
            $this->session->set_flashdata('info', 'Data Transaksi berhasil di Simpan');
            redirect('peminjaman');
        }
    }

    public function kembalikan($id)
    {
        $data = $this->m_peminjaman->getDataById_peminjaman($id);
        $id_buku = $data['id_buku'];
        $kembalikan = array(
            'id_anggota'        => $data['id_anggota'],
            'id_buku'           => $data['id_buku'],
            // 'jumlah_pinjam'     => $data['jumlah_pinjam'],
            'tanggal_pinjam'    => $data['tanggal_pinjam'],
            'tanggal_kembali'   => $data['tanggal_kembali'],
            'tanggal_kembalikan'=> date('Y-m-d')
            
        );

        $query = $this->db->insert('pengembalian', $kembalikan);
        if ($query) {
            // Kembalikan stok buku
            $id_buku_array = explode(',', $id_buku);
            foreach ($id_buku_array as $id_buku) {
                $this->db->set('jumlah_buku', 'jumlah_buku + 1', FALSE);
                $this->db->where('id_buku', $id_buku);
                $this->db->update('buku');
            }
    
            // Hapus data peminjaman
            $this->m_peminjaman->deletePeminjaman($id);
    
            $this->session->set_flashdata('info', 'Buku Berhasil di Kembalikan');
            redirect('peminjaman');
        }
    }

    public function detailpinjam()
    {
        $isi['content']     = 'Peminjaman/detailpinjam'; // memnaggil folder buku dengan detailpinjam
        $isi['judul']       = 'Detail Pinjam Buku';
        $isi['data']        = $this->m_peminjaman->detailpinjam($id_peminjaman);
        $this->load->view('v_dashboard', $isi);
    }

    // public function jumlah_buku()
    // {
    //     $id_buku = $this->input->post('id');
    //     $jumlah_buku = $this->m_peminjaman->getJumlahBuku($id_buku);

    //     echo json_encode(['jumlah_buku' => $jumlah_buku]);
    // }

    public function hapus($id)
    {
        $hapus = $this->m_peminjaman->hapus($id);
        if ($hapus = true) {
            $this->session->set_flashdata('info', 'Data Berhasil di Hapus');
            redirect('peminjaman');
        }
    }

}