<?php

class Cetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_laporan');
        $this->load->model('Model_user');
        $this->load->model('Model_buku');
    }
}