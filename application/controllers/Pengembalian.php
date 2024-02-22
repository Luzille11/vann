<?php

class Pengembalian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        checklog();
        $this->load->model('Model_pengembalian');
        $this->load->model('Model_user');
        $this->load->model('Model_buku');
    }
    
    function pengembalian() 
    {
        $user_role = $this->session->userdata('level');
        if ($user_role == 'peminjam') {
            redirect('dashboard');
        }
        $this->load->model('Model_pengembalian');

        $data['Pengembalian'] = $this->Model_pengembalian->getDataPengembalian()->result();
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $this->template->load('template/template', 'perpus/view_pengembalian', $data);
    }

    public function jumlah_buku()
    {
        $id = $this->input->post('id');
        $data = $this->Model_peminjaman->jumlah_buku($id);
        echo json_encode($data);
    }
}