<?php

class Model_Regis extends CI_Model 
{
    function insertRegis($nama,$username,$password,$email,$alamat,$no_telp,$level = 'user')
    {
        $data = array(
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'level' => $level,
            'status' => 0
        );
        $this->db->insert('user',$data); 
    }
}