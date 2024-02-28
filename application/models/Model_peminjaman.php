<?php

class Model_Peminjaman extends CI_Model 
{
    function getDataPeminjaman()
    {
    // Dapatkan peran (role) user dari sesi
    $user_role = $this->session->userdata('level');

    // Jika user adalah admin, tampilkan semua data
    if ($user_role == 'admin') {
        $this->db->join('buku', 'peminjaman.id_buku = buku.id_buku');
        $this->db->join('user', 'peminjaman.id_user = user.id_user');
        return $this->db->get('peminjaman');
    }
    
    if ($user_role == 'petugas') {
        $this->db->join('buku', 'peminjaman.id_buku = buku.id_buku');
        $this->db->join('user', 'peminjaman.id_user = user.id_user');
        return $this->db->get('peminjaman');
    }
    
    // Jika user bukan admin, hanya tampilkan data sesuai dengan ID user yang sedang login
    $user_id = $this->session->userdata('id_user');
    $this->db->join('buku', 'peminjaman.id_buku = buku.id_buku');
    $this->db->join('user', 'peminjaman.id_user = user.id_user');
    $this->db->where('peminjaman.id_user', $user_id);
    
    return $this->db->get('peminjaman');
    }

    public function jumlah_buku($id)
    {
        $this->db->select('jumlah');
        $this->db->from('buku');
        $this->db->where('id_buku',$id);
        return $this->db->get()->row_array();
    }

    public function insertPeminjaman($data)
    {
        $tambah = $this->db->insert('peminjaman',$data);
        if($tambah) {
            return 1;
        }else {
            return 0;
        }
    }

    public function getDataByid_peminjaman($id)
    {
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('buku','peminjaman.id_buku = buku.id_buku');
        $this->db->join('user','peminjaman.id_user = user.id_user');
        $this->db->where('peminjaman.id_peminjaman', $id);
        return $this->db->get()->row_array();
    }

    public function deletePeminjaman($id)
    {
        $this->db->where('id_peminjaman', $id);
        $this->db->delete('peminjaman');
    }

    public function get_pengembalian_perbulan() {
        $query = $this->db->query("SELECT MONTHNAME(tanggal_peminjaman) as bulan, COUNT(id_pengembalian) as jumlah_pengembalian FROM pengembalian GROUP BY MONTH(tanggal_peminjaman)");
        return $query->result();
    }
    public function get_peminjaman_perbulan() {
        $query = $this->db->query("SELECT MONTHNAME(tanggal_peminjaman) as bulan, COUNT(id_peminjaman) as jumlah_peminjaman FROM peminjaman GROUP BY MONTH(tanggal_peminjaman)");
        return $query->result();
    }
}