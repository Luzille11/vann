<?php

class Auth extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Auth');
    }
    
    function login()
    {
        $this->load->view('auth/login');
    }
    
    public function prosesLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->Model_Auth->prosesLogin($username, $password);
        
        if ($user) {
            // Check if the user is approved
            if ($user->status == 1) {
                // Successful login for an approved user
                $this->session->set_userdata('id_user', $user->id_user);
                $this->session->set_userdata('username', $user->username);

                // Redirect to the desired page
                redirect('dashboard'); // Change 'dashboard' to your desired destination
            } else {
                // User not approved, show an error message
                $this->session->set_flashdata('error', 'Your account is not yet approved by the admin.');
                redirect('auth/login');
            }
    }
}

     // Pastikan status pengguna disetujui

    
    function logout() 
    {
        session_destroy();
        redirect('auth/login');
    }
}