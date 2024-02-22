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
    }
    
    function ulasan() 
    {
        $this->load->model('Model_ulasan');

        $data['Ulasan'] = $this->Model_ulasan->getDataUlasan()->result();
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $this->load->view('home', $data);
    }
}