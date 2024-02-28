<?php

class Laporan extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        checklog();
        $this->load->model('Model_laporan');
        $this->load->model('Model_user');
        $this->load->model('Model_buku');
    }
    
    public function laporan()
    {
        $data['Laporan'] = $this->Model_laporan->getAllData()->result();
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $this->template->load('template/template', 'perpus/view_laporan', $data);
    }

    public function metode_filter() {
        $tanggalAwal = $this->input->post('tanggalAwal');
        $tanggalAkhir = $this->input->post('tanggalAkhir');
          
        $data['Pengembalian'] = $this->Model_laporan->get_data_filtered($tanggalAwal, $tanggalAkhir);
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
     
        $this->load->view('cetak', $data);
     }
     
    public function cetak()
    {
        $data['Laporan'] = $this->Model_laporan->getAllData()->result();
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $this->load->view('cetak', $data);
    }
    public function cetakfilter()
    {
        $tanggalAwal = $this->input->get('tanggalAwal');
        $tanggalAkhir = $this->input->get('tanggalAkhir');
        $data['Pengembalian'] = $this->Model_laporan->get_data_filtered($tanggalAwal, $tanggalAkhir);
        $data['Pengembalian'] = $this->Model_laporan->getAllData()->result();
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $this->load->view('cetakfilter', $data);
    }

}