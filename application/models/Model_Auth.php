<?php

class Model_Auth extends CI_Model 
{
    function getLogin($username, $password)
    {
        return $this->db->get_where('user',array('username' => $username, 'password' => $password));
    }

    function prosesLogin($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        if ($query->num_rows()>0) {
            $user = $query->row();

            // Check if the user is approved
            if ($user->status == 1) {
                $data = array(
                    'id_user' => $user->id_user,   
                    'nama' => $user->nama,   
                    'username' => $user->username,   
                    'password' => $user->password,   
                    'email' => $user->email,   
                    'alamat' => $user->alamat,   
                    'no_telp' => $user->no_telp,   
                    'level' => $user->level
                );
                $this->session->set_userdata($data);
            redirect('dashboard');
        }else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
            Akun Anda belum disetujui oleh admin. </div>');
            redirect('auth/login');
    } 
    }else  {
        // User not approved
        $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
        Username atau Password Salah ! </div>');
        redirect("auth/login");
    }
}
}