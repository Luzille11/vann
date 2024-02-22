<?php

class Model_laporan extends CI_Model
{
    public function getAllData()
    {
        $this->db->join('buku','pengembalian.id_buku = buku.id_buku');
        $this->db->join('user','pengembalian.id_user = user.id_user');
        return $this->db->get('pengembalian');
    }

    public function get_data_filtered($tanggalAwal, $tanggalAkhir) {
        $this->db->join('buku','pengembalian.id_buku = buku.id_buku');
        $this->db->join('user','pengembalian.id_user = user.id_user');
        $this->db->where('tanggal_peminjaman >=', $tanggalAwal);
        $this->db->where('tanggal_peminjaman <=', $tanggalAkhir);
        $query = $this->db->get('pengembalian');
     
        return $query->result();
     }
     
}