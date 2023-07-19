<?php
class Warna extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_warna');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
			$data['data'] = $this->m_warna->tampil_warna();
			$this->load->view('admin/v_warna', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_warna()
	{
		if ($this->session->userdata('akses') == '1') {
			$nm = $this->input->post('warna');
			$kat = $this->input->post('kategori');
			
			$cekmerek=$this->db->query("SELECT warna FROM tbl_warna WHERE warna='$nm'")->num_rows();
			 if ($cekmerek <= 0) {
			    $this->m_warna->simpan_warna($nm, $kat);
    			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data warna berhasil disimpan!</div>');
			 } else {
			     echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data warna sudah terdaftar!</div>');
			 }
			 
			redirect('admin/warna');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_warna2()
	{
		if ($this->session->userdata('akses') == '1') {
			$nm = $this->input->post('warna');
			$kat = $this->input->post('kategori');
			$this->m_warna->simpan_warna($nm, $kat);
			redirect('admin/pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_warna()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			$nm = $this->input->post('warna');
			$kat = $this->input->post('kategori');
			
			$cekmerek=$this->db->query("SELECT warna FROM tbl_warna WHERE warna='$nm' AND warna_id != '$kode'")->num_rows();
			 if ($cekmerek <= 0) {
			    $this->m_warna->update_warna($kode, $nm, $kat);
    			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data warna berhasil diedit!</div>');
			 } else {
			     echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data warna sudah terdaftar!</div>');
			 } 
			redirect('admin/warna');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_warna()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			
			$cekterpakai=$this->db->query("SELECT barang_warna FROM tbl_barang WHERE barang_warna='$kode'")->num_rows();
			
			if ($cekterpakai <= 0) {
			    $this->m_warna->hapus_warna($kode);
    			echo $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Success!</strong> Data warna berhasil dihapus!</div>");
    		} else {
    		    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data warna terpakai tidak dapat dihapus, silahkan cek data barang!</div>');
    		}
			redirect('admin/warna');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function ubah_handphone()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			$this->m_warna->update_kat($kode);
			redirect('admin/warna');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function ubah_accessories()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			$this->m_warna->update_kat2($kode);
			redirect('admin/warna');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
