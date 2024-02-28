<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_lib {

    public function __construct() {
        $this->dompdf = new Dompdf();
    }

    public function generatePDF($html, $filename='', $stream=TRUE, $paper='A4', $orientation='portrait') {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $this->dompdf->setOptions($options);
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF to Browser
        if ($stream) {
            $this->dompdf->stream($filename.'.pdf', array('Attachment' => 0));
        } else {
            return $this->dompdf->output();
        }
    }
}