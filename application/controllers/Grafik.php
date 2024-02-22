// application/controllers/Grafik.php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/ChartJS/Chart.bundle.php'; // Sesuaikan dengan lokasi Chart.js di proyek Anda

class Grafik extends CI_Controller {
    public function generate_chart() {
        $data['peminjaman'] = $this->Model_peminjaman->get_peminjaman_perbulan();

        $labels = [];
        $dataPeminjaman = [];

        foreach ($data['peminjaman'] as $row) {
            $labels[] = "Bulan " . $row->bulan;
            $dataPeminjaman[] = $row->jumlah_peminjaman;
        }

        $config = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Jumlah Peminjaman',
                        'data' => $dataPeminjaman,
                        'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                    ],
                ],
            ],
        ];

        $chart = new \Chart('bar', $config);

        header('Content-Type: image/png');
        echo $chart->getData();

        exit();
    }

    public function index() {
        $this->template->load('template/template','dashboard/dashboard', $data);
    }
}