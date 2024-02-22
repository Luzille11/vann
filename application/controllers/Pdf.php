<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_laporan');
        $this->load->model('Model_user');
        $this->load->model('Model_buku');
    }

    public function cetak_data() {
        // Load library DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        // Load view yang ingin dicetak
        $data['judul'] = 'Judul Cetak PDF';
        $data['isi'] = 'Isi Cetak PDF';

        $html = $this->load->view('cetak', $data, true);

        $dompdf->loadHtml($html);

        // (Opsional) Atur ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (Opsional: Simpan dalam file atau keluarkan ke browser)
        $dompdf->render();
        $dompdf->stream('output.pdf', array('Attachment' => 0));
    }
}