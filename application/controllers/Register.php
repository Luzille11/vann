<?php

class Register extends CI_Controller 
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_regis');
    }

    public function register()
    {
        $this->load->view('auth/register');
    }
    
    public function prosesRegister() {
        // Tampilkan halaman registrasi
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('no_telp', 'No_telp', 'required');
            $this->form_validation->set_rules('level', 'Level', 'required');
            if ($this->form_validation->run()==true)
            {
                $nama = $this->input->post('nama');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $alamat = $this->input->post('alamat');
                $no_telp = $this->input->post('no_telp');
                $level = $this->input->post('level');
                $this->Model_regis->insertRegis($nama,$username,$password,$email,$alamat,$no_telp,$level,$status);
                $this->session->set_flashdata('success_register','Proses Pendaftaran Berhasil!');
                redirect('auth/login');
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
                redirect('auth/register');
            }
    }
}