<?php

class User extends CI_Controller 
{
    public function __construct() {
        parent::__construct();
        checklog();
        $this->load->model('Model_user');
    }


    public function petugas() {
        $user_role = $this->session->userdata('level');
        if ($user_role == 'peminjam' || $user_role == 'petugas') {
            redirect('dashboard');
        }
        $this->load->model('Model_user');

        $data['Petugas'] = $this->Model_user->getPetugas()->result();
        $this->template->load('template/template', 'user/petugas', $data);
    }

    public function peminjam() {
        $user_role = $this->session->userdata('level');
        if ($user_role == 'peminjam'  || $user_role == 'petugas') {
            redirect('dashboard');
        }
        $data['Peminjam'] = $this->Model_user->getPeminjam()->result();
        $this->template->load('template/template', 'user/peminjam', $data);
    }

    function tambahpetugas() 
    {
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $no_telp = $this->input->post('no_telp');

        $data = array(
            'id_user' => $id_user,
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'level' => 'petugas'
        );
        $tambah = $this->Model_user->insertPetugas($data);
        if($tambah == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Data Berhasil Disimpan!
            </div>');
            redirect('User/petugas');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Data Gagal Disimpan!
            </div>');
            redirect('User/petugas');
        }
    }

    function updatePetugas()
    {
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $no_telp = $this->input->post('no_telp');
        $data = array(
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            
        );
        $edit = $this->Model_user->updatePetugas($data, $id_user);
        if($edit == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Edit Data Berhasil !
            </div>');
            redirect('User/petugas');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Edit Data Gagal !
            </div>');
            redirect('User/petugas');
        }
    }

    public function hapusPetugas()
	{
		$a = $this->uri->segment(3);

        $hapus = $this->Model_petugas->DeleteDataPetugas('user', 'id_user', $a);
        if($hapus == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Data Berhasil Dihapus!
            </div>');
            redirect('User/petugas');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Data Berhasil Dihapus!
            </div>');
            redirect('User/petugas');
        }
	}
    public function hapusUser()
	{
		$a = $this->uri->segment(3);

        $hapus = $this->Model_user->DeleteDataUser('user', 'id_user', $a);
        if($hapus == 1) {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-check"></i>
            Data Berhasil Dihapus!
            </div>');
            redirect('User/peminjam');
        }else {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
            <i class="nav-icon fas fa-xmark"></i>
            Data Berhasil Dihapus!
            </div>');
            redirect('User/peminjam');
        }
	}

    public function approve_user($id_user) {
        $this->Model_user->approve_user($id_user);
        redirect('user/peminjam'); // Ganti dengan lokasi yang sesuai
    }

    public function users() {
        // Mendapatkan daftar pengguna belum disetujui dari model
        $data['user'] = $this->Model_user->get_pending_users();

        // Memuat tampilan dengan data pengguna
        $this->load->view('user/peminjam', $data);
    }
}