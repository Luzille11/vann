<?php

class Peminjaman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        checklog();
        $this->load->model('Model_peminjaman');
        $this->load->model('Model_user');
        $this->load->model('Model_buku');
    }
    
    function peminjaman() 
    {
        $this->load->model('Model_peminjaman');

        $data['Peminjaman'] = $this->Model_peminjaman->getDataPeminjaman()->result();
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $this->template->load('template/template', 'perpus/view_peminjaman', $data);
    }

    public function tambahPeminjaman()
    {
        if ($this->session->userdata('id_user')) {
            $id_buku = $this->input->post('id_buku');
            $tanggal_peminjaman = date('Y-m-d');
            $tanggal_pengembalian = date('Y-m-d', strtotime('+7 days'));
    
            $data = array(
                'id_user' => $this->session->userdata('id_user'),
                'id_buku' => $id_buku,
                'tanggal_peminjaman' => $tanggal_peminjaman,
                'tanggal_pengembalian' => $tanggal_pengembalian,
            );
    
            $tambah = $this->Model_peminjaman->insertPeminjaman($data);
    
            if ($tambah == 1) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
                    <i class="nav-icon fas fa-check"></i>
                    Permohonan Peminjaman Berhasil Diajukan!
                </div>');
                redirect('Peminjaman/peminjaman');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                    <i class="nav-icon fas fa-xmark"></i>
                    Permohonan Peminjaman Gagal Diajukan!
                </div>');
                redirect('Peminjaman/peminjaman');
            }
        }
    }


    public function jumlah_buku()
{
    $id = $this->input->post('id');
    $data = $this->Model_peminjaman->jumlah_buku($id);

    header('Content-Type: application/json'); // Set header sebagai JSON
    echo json_encode(['jumlah' => $data]);
}

    public function kembalikan($id) 
    {
    $data = $this->Model_peminjaman->getDataByid_peminjaman($id); 
    $kembalikan = array(
        'id_user' => $data['id_user'],
        'id_buku' => $data['id_buku'],
        'tanggal_peminjaman' => $data['tanggal_peminjaman'],
        'tanggal_pengembalian' => $data['tanggal_pengembalian'],
        'tanggal_kembalikan' => date('Y-m-d')
        );

        $query = $this->db->insert('pengembalian', $kembalikan);
        if($query = true) {
            $delete = $this->Model_peminjaman->deletePeminjaman($id);
            if($delete = true) {
                $this->session->set_flashdata('info','Buku Behasil di Kembalikan!');
                redirect('Peminjaman/peminjaman');
            }
        }
    }
    public function batalkan($id) 
    {
            $delete = $this->Model_peminjaman->deletePeminjaman($id);
            if($delete = true) {
                $this->session->set_flashdata('info','Peminjaman Buku di Batalkan!');
                redirect('Peminjaman/peminjaman');
        }
    }

    public function returnBook($id_buku, $id_user) {
        // Lakukan proses pengembalian buku dan perhitungan denda jika ada
        $tanggal_pengembalian = time(); // Tanggal pengembalian

        // Ambil informasi peminjaman
        $Peminjaman = $this->Model_buku->getDataPeminjaman($id_buku, $id_user);

        // Hitung denda jika melebihi batas waktu pengembalian
        $due_date = strtotime('+7 days', strtotime($Peminjaman['tanggal_peminjaman']));
        $late_days = max(0, floor(($tanggal_pengembalian - $due_date) / (60 * 60 * 24)));
        $fine_amount = $late_days * 500; // Denda Rp 500 per hari

        // Simpan data pengembalian ke database
        $this->Model_buku->returnBook($id_buku, $id_user);

        // Tambahkan informasi denda ke hasil yang dikembalikan
        // Load view dengan informasi peminjaman buku dan denda
        $this->template->load('template/template', 'perpus/view_peminjaman', array('tanggal_peminjaman' => $Peminjaman, 'fine_amount' => $fine_amount));
        
    }
}