<?php

class Ulasan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        checklog();
        $this->load->model('Model_ulasan');
        $this->load->model('Model_user');
        $this->load->model('Model_buku');
        $this->load->model('Model_pengembalian');
    }
    
    function ulasan() 
    {
        $user_role = $this->session->userdata('level');
        if ($user_role == 'admin' || $user_role == 'petugas') {
            redirect('dashboard');
        }
        $this->load->model('Model_ulasan');

        $data['Ulasan'] = $this->Model_ulasan->getDataUlasan()->result();
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $id_user = $this->session->userdata('id_user'); // Sesuaikan dengan cara penyimpanan ID pengguna di sesi

        // Memuat model BukuModel
        $this->load->model('Model_ulasan');

        // Mendapatkan daftar buku yang telah dikembalikan oleh pengguna
        $data['ulas'] = $this->Model_ulasan->getReturnedBooksByUser($id_user);

        // Memuat view dengan formulir ulasan buku

        // Menampilkan view untuk memberi ulasan buku
        $this->template->load('template/template', 'perpus/view_ulasan', $data);
    }

    //public function showReviewForm() {
        //$id_user = $this->session->userdata('id_user'); // Sesuaikan dengan cara penyimpanan ID pengguna di sesi

        // Memuat model BukuModel
        //$this->load->model('Model_ulasan');

        // Mendapatkan daftar buku yang telah dikembalikan oleh pengguna
        //$data['ulas'] = $this->Model_ulasan->getReturnedBooksByUser($id_user);

        // Memuat view dengan formulir ulasan buku

        // Menampilkan view untuk memberi ulasan buku
        //$this->template->load('template/template', 'perpus/view_ulasan', $data);
    //}

    function tambahulasan() 
    {
        $id_ulasan = $this->input->post('id_ulasan');
        $user = $this->input->post('user');
        $buku = $this->input->post('buku');
        $ulasan = $this->input->post('ulasan');
        $rating = $this->input->post('rating');

        $data = array(
            'id_ulasan' => $id_ulasan,
            'id_user' => $user,
            'id_buku' => $buku,
            'ulasan' => $ulasan,
            'rating' => $rating
        );

        $tambah = $this->Model_ulasan->insertUlasan($data);
        if($tambah == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Data Berhasil Disimpan!
            </div>');
            redirect('Ulasan/ulasan');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Data Gagal Disimpan!
            </div>');
            redirect('Ulasan/ulasan');
        }
    }

    public function editulasan()
	{
        $id_ulasan = $this->uri->segment(3);
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $data['ulasan'] = $this->Model_ulasan->getDataUlasan($id_ulasan)->row_array();
        $this->template->load('template/template', 'edit/edit_ulasan', $data);
	}

    function updateulasan()
    {
        $id_ulasan = $this->input->post('id_ulasan');
        $user = $this->input->post('user');
        $buku = $this->input->post('buku');
        $ulasan = $this->input->post('ulasan');
        $rating = $this->input->post('rating');

        $data = array(
            'id_user' => $user,
            'id_buku' => $buku,
            'ulasan' => $ulasan,
            'rating' => $rating
        );

        $edit = $this->Model_ulasan->updateUlasan($data, $id_ulasan);
        if($edit == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Edit Data Berhasil !
            </div>');
            redirect('Ulasan/ulasan');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Edit Data Gagal !
            </div>');
            redirect('Ulasan/ulasan');
        }
    }

    public function hapusulasan()
	{
		$a = $this->uri->segment(3);

		$this->Model_ulasan->DeleteDataUlasan('ulasan', 'id_ulasan', $a);

		redirect('Ulasan/ulasan');
	}
}