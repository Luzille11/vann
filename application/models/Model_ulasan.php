<?php

class Model_Ulasan extends CI_Model 
{
    function getDataUlasan()
    {
        // Dapatkan ID user dari sesi    
        // Gabungkan tabel peminjaman dengan tabel buku dan user
        $this->db->join('buku', 'ulasan.id_buku = buku.id_buku');
        $this->db->join('user', 'ulasan.id_user = user.id_user');
    
        // Kembalikan hasil query
        return $this->db->get('ulasan');
    }

    public function getReturnedBooksByUser($id_user) {
        $this->db->select('*');
        $this->db->from('pengembalian');
        $this->db->join('buku', 'pengembalian.id_buku = buku.id_buku');
        $this->db->where('pengembalian.id_user', $id_user);
        return $this->db->get()->result();
    }

    function insertUlasan($data)
    {
        $tambah = $this->db->insert('ulasan',$data);
        if($tambah) {
            return 1;
        }else {
            return 0;
        }
    }

    public function getUlasanOwner($id_ulasan) {
        $result = $this->db->get_where('ulasan', array('id_ulasan' => $id_ulasan))->row_array();
        return isset($result['id_user']) ? $result['id_user'] : null;
    }


    function updateUlasan($data, $id_ulasan)
    {
        $edit = $this->db->update('ulasan',$data, array('id_ulasan' => $id_ulasan));
        if($edit) {
            return 1;
        }else {
            return 0;
        }
    }

    function DeleteDataUlasan($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }
}