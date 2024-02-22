<?php 
class M_squrity extends CI_Model {

public function getSqurity()
{
    $username = $this->session->userdata('username');
    if (empty($username)) {
        $this->session->session_destroy();
        redirect('auth/login');
    }
}
}