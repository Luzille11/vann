<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller 
{

    public function excel() {
        $this->load->view('cetak');
    }
 
    public function export() {
        // Load the model or fetch your data as needed
        $this->load->model('Model_laporan');
        $this->load->model('Model_user');
        $this->load->model('Model_buku');

        
 
        // Fetch data from the model (replace 'Your_model' with your actual model name)
        $data['Laporan'] = $this->Model_laporan->getAllData()->result();
        $data['user'] = $this->Model_user->getDataUser()->result();
        $data['buku'] = $this->Model_buku->getDataBuku()->result();
 
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
 
        // Set the active sheet
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
 
        $sheet = $spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
        $sheet = $spreadsheet->getActiveSheet()->setCellValue('B1', 'USER');
        $sheet = $spreadsheet->getActiveSheet()->setCellValue('C1', 'BUKU');
        $sheet = $spreadsheet->getActiveSheet()->setCellValue('D1', 'TANGGAL PEMINJAMAN');
        $sheet = $spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL PENGEMBALIAN');
        $sheet = $spreadsheet->getActiveSheet()->setCellValue('F1', 'TANGGAL KEMBALIKAN');
        $sheet = $spreadsheet->getActiveSheet()->setCellValue('G1', 'DENDA');
        
        $baris = 2;
        $no = 1;

        foreach ($data['Laporan'] as $lpr) {
            $tanggal_pengembalian = new DateTime($lpr->tanggal_pengembalian);
            $tanggal_sekarang = new DateTime();
            $selisih = $tanggal_sekarang->diff($tanggal_pengembalian)->format("%a");
            $fine_amount = 0; // Default value if not overdue
            if ($tanggal_pengembalian < $tanggal_sekarang && $selisih > 0) {
                $fine_amount = $selisih * 2500; // Rp 2,500 per day
            }
            $sheet = $spreadsheet->getActiveSheet()->setCellValue('A'.$baris, $no++);
            $sheet = $spreadsheet->getActiveSheet()->setCellValue('B'.$baris, $lpr->nama);
            $sheet = $spreadsheet->getActiveSheet()->setCellValue('C'.$baris, $lpr->judul);
            $sheet = $spreadsheet->getActiveSheet()->setCellValue('D'.$baris, $lpr->tanggal_peminjaman);
            $sheet = $spreadsheet->getActiveSheet()->setCellValue('E'.$baris, $lpr->tanggal_pengembalian);
            $sheet = $spreadsheet->getActiveSheet()->setCellValue('F'.$baris, $lpr->tanggal_kembalikan);
            $sheet = $spreadsheet->getActiveSheet()->setCellValue('G'.$baris, 'Rp ' . number_format($fine_amount, 0, ',', '.')); 
            $baris++;
        }
        // Create a writer and output the spreadsheet to the browser
        $filename = 'laporan peminjaman.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
 
    private function formatDataForExcel($data) {
        // Format your data if needed before exporting
        return $data;
    }
}