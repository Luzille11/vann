<?php

class Model_User extends CI_Model 
{
    function getDataUser()
    {
        return $this->db->get('user');
    }

    public function getPetugas() {
        $this->db->where('level', 'petugas');
        return $this->db->get('user');
    }

    public function getPeminjam() {
        $this->db->where('level', 'peminjam');
        return $this->db->get('user');
    }

    function insertPetugas($data)
    {
        $tambah = $this->db->insert('user',$data);
        if($tambah) {
            return 1;
        }else {
            return 0;
        }
    }

    function updatePetugas($data, $id_user)
    {
        $edit = $this->db->update('user',$data, array('id_user' => $id_user));
        if($edit) {
            return 1;
        }else {
            return 0;
        }
    }

    function DeleteDataPetugas($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }
    function DeleteDataUser($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }

    public function get_user_by_id($id_user) {
        return $this->db->get_where('user', array('id_user' => $id_user))->row();
    }

    public function approve_user($ide_user) {
        $this->db->where('id_user', $ide_user);
        $this->db->update('user', array('status' => 1));
    }

    public function get_pending_users() {
        return $this->db->get_where('user', array('status' => 0))->result();
    }
}