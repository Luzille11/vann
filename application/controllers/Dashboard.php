<?php

class Dashboard extends CI_Controller 
{
    function __construct() 
    {
        parent::__construct();
        checklog();
        $this->load->model('Model_pengembalian');
        $this->load->model('Model_user');
        $this->load->model('Model_peminjaman');
        $this->load->model('Model_buku');
    }
    
    function index(){
        $data['jmlpengembalian'] = $this->Model_pengembalian->getDataPengembalian()->num_rows();
        $data['jmlbuku'] = $this->Model_buku->getDataBuku()->num_rows();
        $data['jmlpeminjaman'] = $this->Model_peminjaman->getDataPeminjaman()->num_rows();
        $data['jmluser'] = $this->Model_user->getDataUser()->num_rows();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
        $data['peminjaman'] = $this->Model_peminjaman->getDataPeminjaman()->result();
        $dataPengembalian = $this->Model_peminjaman->get_pengembalian_perbulan();
        $dataPeminjaman = $this->Model_peminjaman->get_peminjaman_perbulan();

        // Inisialisasi data bulan dengan jumlah peminjaman 0
        $allMonths = array(
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        );

        $formattedData = array();

        foreach ($allMonths as $month) {
            $formattedData[] = array(
                'bulan' => $month,
                'jumlah_pengembalian' => 0
            );
        }

        // Update data peminjaman yang ada
        foreach ($dataPengembalian as $item) {
            $index = array_search($item->bulan, $allMonths);
            $formattedData[$index]['jumlah_pengembalian'] = $item->jumlah_pengembalian;
        }
        // Update data peminjaman yang ada
        foreach ($dataPeminjaman as $item) {
            $index = array_search($item->bulan, $allMonths);
            $formattedData[$index]['jumlah_peminjaman'] = $item->jumlah_peminjaman;
        }

        $data['dataPengembalian'] = json_encode($formattedData);
        $data['dataPeminjaman'] = json_encode($formattedData);
        $this->template->load('template/template','dashboard/dashboard', $data);
    }           

    public function pencarian() {
        $keyword = $this->input->get('keyword');
    
        // Lakukan pencarian di model (gantilah dengan model dan logika pencarian sesuai kebutuhan)
        $data['buku'] = $this->Model_buku->cariData($keyword)->result();
    
        // Tampilkan hasil pencarian di tampilan
        $this->template->load('template/template','dashboard/dashboard', $data);
    }
}