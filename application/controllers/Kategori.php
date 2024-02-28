<?php

class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        checklog();
        $this->load->model('Model_kategori');
    }
    
    function kategori() 
    {
        $user_role = $this->session->userdata('level');
        if ($user_role == 'peminjam') {
            redirect('dashboard');
        }
        $this->load->model('Model_kategori');

        $data['Kategori'] = $this->Model_kategori->getDataKategori()->result();
        $this->template->load('template/template', 'perpus/view_kategori', $data);
    }

    public function hapuskategori()
	{
		$a = $this->uri->segment(3);

        $hapus = $this->Model_kategori->DeleteDataKategori('kategori', 'id_kategori', $a);
        if($hapus == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Data Berhasil Dihapus!
            </div>');
            redirect('Kategori/kategori');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Data Berhasil Dihapus!
            </div>');
            redirect('Kategori/kategori');
        }
	}

    function tambahkategori()
    {
        $id_kategori = $this->input->post('id_kategori');
        $kategori = $this->input->post('kategori');

        $data = array(
            'id_kategori' => $id_kategori,
            'kategori' => $kategori
        );

        $tambah = $this->Model_kategori->insertKategori($data);
        if($tambah == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Data Berhasil Disimpan!
            </div>');
            redirect('Kategori/kategori');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Data Gagal Disimpan!
            </div>');
            redirect('Kategori/kategori');
        }
    }
    
    function editkategori()
    {
        $id_kategori = $this->input->post('id_kategori');
        $kategori = $this->input->post('kategori');

        $data = array(
            'kategori' => $kategori
        );

        $edit = $this->Model_kategori->editKategori($data, $id_kategori);
        if($edit == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Edit Data Berhasil !
            </div>');
            redirect('Kategori/kategori');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Edit Data Gagal !
            </div>');
        }
    }

}