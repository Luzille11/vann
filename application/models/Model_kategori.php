<?php

class Model_Kategori extends CI_Model 
{
    function getDataKategori()
    {
        return $this->db->get('kategori');
    }
    

    function insertKategori($data)
    {
        $tambah = $this->db->insert('kategori',$data);
        if($tambah) {
            return 1;
        }else {
            return 0;
        }
    }

    function editKategori($data, $id_kategori)
    {
        $edit = $this->db->update('kategori',$data, array('id_kategori' => $id_kategori));
        if($edit) {
            return 1;
        }else {
            return 0;
        }
    }

    function DeleteDataKategori($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }
}