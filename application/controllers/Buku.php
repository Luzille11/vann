<?php

class Buku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        checklog();
        $this->load->model('Model_buku');
        $this->load->model('Model_kategori');
        $this->load->model('Model_rak');
    }
    
    function buku() 
    {
        $user_role = $this->session->userdata('level');
        if ($user_role == 'peminjam') {
            redirect('dashboard');
        }
        $this->load->model('Model_buku');

        $data['Buku'] = $this->Model_buku->getDataBuku()->result();
        $data['kategori'] = $this->Model_kategori->getDataKategori()->result();
        $data['rak'] = $this->Model_rak->getDataRak()->result();
        $this->template->load('template/template', 'perpus/view_buku', $data);
    }

    
    public function tambahbuku() {
        $id_buku = $this->input->post('id_buku');
        $kategori = $this->input->post('kategori');
        $rak = $this->input->post('rak');
        $judul = $this->input->post('judul');
        $penulis = $this->input->post('penulis');
        $penerbit = $this->input->post('penerbit');
        $tahun_terbit = $this->input->post('tahun_terbit');
        $deskripsi = $this->input->post('deskripsi');
        $jumlah = $this->input->post('jumlah');
    
        // Konfigurasi Upload
        $config['upload_path'] = FCPATH . 'assets/dist/img/'; // Sesuaikan dengan direktori penyimpanan Anda
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // Maksimum 2MB
        $config['file_name'] = $id_buku . '_' . time(); // Nama file berdasarkan ID buku dan waktu upload
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('gambar')) {
            $upload_data = $this->upload->data();
            $gambar = $upload_data['file_name'];
    
            $data = array(
                'id_buku' => $id_buku,
                'id_kategori' => $kategori,
                'id_rak' => $rak,
                'judul' => $judul,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'deskripsi' => $deskripsi,
                'jumlah' => $jumlah,
                'gambar' => $gambar // Nama gambar disimpan ke dalam database
            );
    
            $tambah = $this->Model_buku->insertBuku($data);
    
            if ($tambah == 1) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
                <i class="nav-icon fas fa-check"></i>
                Data Berhasil Disimpan!
                </div>');
                redirect(site_url('Buku/buku'));
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                <i class="nav-icon fas fa-xmark"></i>
                Data Gagal Disimpan!
                </div>');
                redirect(site_url('Buku/buku'));
            }
        } else {
            $error = array('error' => $this->upload->display_errors());
            // Handle error, misalnya menampilkan pesan kesalahan
            print_r($error);
        }
    }


    
    function updatebuku()
    {
    $id_buku = $this->input->post('id_buku');
    $kategori = $this->input->post('kategori');
    $rak = $this->input->post('rak');
    $judul = $this->input->post('judul');
    $penulis = $this->input->post('penulis');
    $penerbit = $this->input->post('penerbit');
    $tahun_terbit = $this->input->post('tahun_terbit');
    $deskripsi = $this->input->post('deskripsi');
    $jumlah = $this->input->post('jumlah');

    // Ambil nama gambar lama
    $gambar_lama = $this->Model_buku->getGambarById($id_buku);

    // Proses upload gambar baru
    $config['upload_path'] = FCPATH . 'assets/dist/img/'; // Sesuaikan dengan direktori penyimpanan Anda
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 2048; // Ukuran maksimal dalam kilobita

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
        // Hapus gambar lama jika upload gambar baru berhasil
        if ($gambar_lama && file_exists(FCPATH . 'assets/dist/img/' . $gambar_lama)) {
            unlink(FCPATH . 'assets/dist/img/' . $gambar_lama);
        }

        $data_upload = $this->upload->data();
        $nama_gambar_baru = $data_upload['file_name'];

        // Update data termasuk nama gambar baru
        $data = array(
            'id_buku' => $id_buku,
            'id_kategori' => $kategori,
            'id_rak' => $rak,
            'judul' => $judul,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah,
            'gambar' => $nama_gambar_baru,
        );
    } else {
        // Update data tanpa mengganti gambar
        $data = array(
            'id_buku' => $id_buku,
            'id_kategori' => $kategori,
            'id_rak' => $rak,
            'judul' => $judul,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah,
        );
    }

    $edit = $this->Model_buku->updateBuku($data, $id_buku);

    if ($edit == 1) {
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Edit Data Berhasil !
            </div>');
        redirect('Buku/buku');
    } else {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Edit Data Gagal !
            </div>');
        redirect('Buku/buku');
    }
    }


    public function hapusbuku()
    {
        $id_buku = $this->uri->segment(3);
    
        // Ambil nama gambar sebelum menghapus
        $nama_gambar = $this->Model_buku->getGambarById($id_buku);
    
        $hapus = $this->Model_buku->DeleteDataBuku('buku', 'id_buku', $id_buku);
    
        if ($hapus == 1) {
            // Hapus gambar dari direktori penyimpanan
            $this->hapusGambar($nama_gambar);
    
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
                <i class="nav-icon fas fa-check"></i>
                Data Berhasil Dihapus!
                </div>');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                <i class="nav-icon fas fa-xmark"></i>
                Data Gagal Dihapus!
                </div>');
        }
    
        redirect('Buku/buku');
    }
    
    private function hapusGambar($nama_gambar)
    {
    $path_gambar = FCPATH . 'assets/dist/img/' . $nama_gambar;

    if (file_exists($path_gambar)) {
        // Hapus gambar jika ada
        unlink($path_gambar);
        return true;
    } else {
        // File gambar tidak ditemukan
        log_message('error', 'Gagal menghapus gambar. File tidak ditemukan: ' . $path_gambar);
        return false;
    }
    }

    

}