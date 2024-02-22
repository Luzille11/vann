<?php

class Model_Pengembalian extends CI_Model 
{
    function getDataPengembalian()
    {
        // Dapatkan peran (role) user dari sesi
        $user_role = $this->session->userdata('level');
    
        // Jika user adalah admin, tampilkan semua data
        if ($user_role == 'admin') {
            $this->db->join('buku', 'pengembalian.id_buku = buku.id_buku');
            $this->db->join('user', 'pengembalian.id_user = user.id_user');
            return $this->db->get('pengembalian');
        }
        
        if ($user_role == 'petugas') {
            $this->db->join('buku', 'pengembalian.id_buku = buku.id_buku');
            $this->db->join('user', 'pengembalian.id_user = user.id_user');
            return $this->db->get('pengembalian');
        }
        
        // Jika user bukan admin, hanya tampilkan data sesuai dengan ID user yang sedang login
        $user_id = $this->session->userdata('id_user');
        $this->db->join('buku', 'pengembalian.id_buku = buku.id_buku');
        $this->db->join('user', 'pengembalian.id_user = user.id_user');
        $this->db->where('pengembalian.id_user', $user_id);
        
        return $this->db->get('pengembalian');
    }

    public function jumlah_buku($id)
    {
        $this->db->select('jumlah');
        $this->db->from('buku');
        $this->db->where('id_buku',$id);
        return $this->db->get('')->row_array();
    }
}