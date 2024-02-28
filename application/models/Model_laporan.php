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
        // Pastikan tanggalAwal dan tanggalAkhir tidak kosong dan memiliki nilai yang valid
        if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
            // Ubah format tanggal jika diperlukan
            // Contoh: $tanggalAwal = date('Y-m-d', strtotime($tanggalAwal));
            // Contoh: $tanggalAkhir = date('Y-m-d', strtotime($tanggalAkhir));
    
            $this->db->select('*');
            $this->db->from('pengembalian');
            $this->db->join('buku', 'pengembalian.id_buku = buku.id_buku');
            $this->db->join('user', 'pengembalian.id_user = user.id_user');
            $this->db->where('tanggal_peminjaman >=', $tanggalAwal);
            $this->db->where('tanggal_peminjaman <=', $tanggalAkhir);
    
            $query = $this->db->get();
    
            return $query->result();
        } else {
            // Handle kesalahan jika tanggalAwal atau tanggalAkhir kosong
            return array();
        }
    }
     
}