<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PdfController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Dompdf_lib');
    }

    public function index() {
        // Load view content as HTML
        $this->load->view('cetak', $data);

        // Generate PDF
        $this->dompdf_lib->generatePDF($data['content'], 'output_filename');
    }
}