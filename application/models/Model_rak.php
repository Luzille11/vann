<?php

class Model_Rak extends CI_Model 
{
    function getDataRak()
    {
        return $this->db->get('rak');
    }
    
    function insertRak($data)
    {
        $tambah = $this->db->insert('rak',$data);
        if($tambah) {
            return 1;
        }else {
            return 0;
        }
    }

    function DeleteDataRak($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }
}