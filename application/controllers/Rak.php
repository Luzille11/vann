<?php

class Rak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        checklog();
        $this->load->model('Model_rak');
    }
    
    function rak() 
    {
        $user_role = $this->session->userdata('level');
        if ($user_role == 'peminjam') {
            redirect('dashboard');
        }
        $this->load->model('Model_rak');

        $data['Rak'] = $this->Model_rak->getDataRak()->result();
        $this->template->load('template/template', 'perpus/view_rak', $data);
    }

    public function hapusrak()
	{
		$a = $this->uri->segment(3);

		$this->Model_kategori->DeleteDataKategori('rak', 'id_rak', $a);

		redirect('Rak/rak');
	}

    function tambahrak()
    {
        $id_rak = $this->input->post('id_rak');
        $rak = $this->input->post('rak');

        $data = array(
            'id_rak' => $id_rak,
            'rak' => $rak
        );

        $tambah = $this->Model_rak->insertrak($data);
        if($tambah == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Data Berhasil Disimpan!
            </div>');
            redirect('rak/rak');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Data Gagal Disimpan!
            </div>');
            redirect('Rak/rak');
        }
    }
    
    function editrak()
    {
        $id_rak = $this->input->post('id_rak');
        $rak = $this->input->post('rak');

        $data = array(
            'rak' => $rak
        );

        $edit = $this->Model_rak->editrak($data, $id_rak);
        if($edit == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Edit Data Berhasil !
            </div>');
            redirect('Rak/rak');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Edit Data Gagal !
            </div>');
        }
    }

}