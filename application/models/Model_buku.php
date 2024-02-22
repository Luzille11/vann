<?php

class Model_Buku extends CI_Model 
{
    function getDataBuku()
    {
        $this->db->join('kategori','buku.id_kategori = kategori.id_kategori');
        $this->db->join('rak','buku.id_rak = rak.id_rak');
        return $this->db->get('buku');
    }
    
    function insertBuku($data)
    {
        $tambah = $this->db->insert('buku',$data);
        if($tambah) {
            return 1;
        }else {
            return 0;
        }
    }

    function getBuku($id_buku)
    {
        return $this->db->get_where('buku',array('id_buku' => $id_buku));
    }

    function updateBuku($data, $id_buku)
    {
        $edit = $this->db->update('buku',$data, array('id_buku' => $id_buku));
        if($edit) {
            return 1;
        }else {
            return 0;
        }
    }

    function DeleteDataBuku($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }

    public function getStokBuku($id_buku)
    {
        $this->db->select('jumlah');
        $this->db->from('buku');
        $this->db->where('id_buku', $id_buku);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlah;
        } else {
            return 0; // Jika buku tidak ditemukan, anggap stok kosong
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

    public function returnBook($id_buku, $id_user) {
        // Lakukan proses pengembalian buku tanpa perhitungan denda di sini
        $tanggal_pengembalian = date('Y-m-d '); // Tanggal pengembalian

        // Simpan data pengembalian ke database
        $data = array(
            'tanggal_pengembalian' => $tanggal_pengembalian
        );

        $this->db->where('id_buku', $id_buku);
        $this->db->where('id_user', $id_user);
        $this->db->update('peminjaman', $data);
    }
}