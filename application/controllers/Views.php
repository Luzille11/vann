<?php

class Views extends CI_Controller 
{


    function buku() 
    {
        $this->load->model('MSudi');

        $data['Buku'] = $this->MSudi->getData('buku');
        $data['id_kategori'] = $this->MSudi->GetData('kategori');
        $this->template->load('template/template', 'perpus/view_buku', $data);
    }


    function tambahulasan() 
    {
		$add['id_ulasan'] = $this->input->post('id_ulasan');
		$add['id_user'] = $this->input->post('id_user');
		$add['id_buku'] = $this->input->post('id_buku');
		$add['ulasan'] = $this->input->post('ulasan');
		$add['rating'] = $this->input->post('rating');
        
        $this->MSudi->AddData('ulasan', $add);

        redirect('Views/ulasan');
    }

    public function editulasan()
	{
		$a = $this->input->post('id_ulasan');
		$update['id_user'] = $this->input->post('id_user');
		$update['id_buku'] = $this->input->post('id_buku');
		$update['ulasan'] = $this->input->post('ulasan');
		$update['rating'] = $this->input->post('rating');
        
		$this->MSudi->UpdateData('ulasan', 'id_ulasan', $a, $update);

		redirect(site_url('Views/ulasan'));
	}

    public function hapusulasan()
	{
		$a = $this->uri->segment(3);

		$this->MSudi->DeleteData('ulasan', 'id_ulasan', $a);

		redirect('Views/ulasan');
	}
    
    function peminjaman() 
    {
        $this->load->model('MSudi');

        $data['Peminjaman'] = $this->MSudi->getData('peminjaman');
        $data['id_user'] = $this->MSudi->GetData('user');
        $data['id_buku'] = $this->MSudi->GetData('buku');
        $this->template->load('template/template', 'perpus/view_peminjaman', $data);
    }

    function tambahpeminjaman() 
    {
		$add['id_peminjaman'] = $this->input->post('id_peminjaman');
		$add['id_user'] = $this->input->post('id_user');
		$add['id_buku'] = $this->input->post('id_buku');
		$add['tanggal_peminjaman'] = $this->input->post('tanggal_peminjaman');
		$add['tanggal_pengembalian'] = $this->input->post('tanggal_pengembalian');
		$add['status_peminjaman'] = $this->input->post('status_peminjaman');
        
        $this->MSudi->AddData('peminjaman', $add);

        redirect('Views/peminjaman');
    }

    public function editpeminjaman()
	{
		$a = $this->input->post('id_peminjaman');
		$update['id_user'] = $this->input->post('id_user');
		$update['id_user'] = $this->input->post('id_user');
		$update['tanggal_peminjaman'] = $this->input->post('tanggal_peminjaman');
		$update['tanggal_pengembalian'] = $this->input->post('tanggal_pengembalian');
		$update['status_peminjaman'] = $this->input->post('rating');
        
		$this->MSudi->UpdateData('peminjaman', 'id_peminjaman', $a, $update);

		redirect(site_url('Views/peminjaman'));
	}
}