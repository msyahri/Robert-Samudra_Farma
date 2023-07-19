<?php
class Suplier extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_suplier');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
			$data['data'] = $this->m_suplier->tampil_suplier();
			$this->load->view('admin/v_suplier', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_suplier()
	{
		if ($this->session->userdata('akses') == '1') {
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$notelp = $this->input->post('notelp');
			$perusahaan = $this->input->post('perusahaan');
			
			$cekmerek=$this->db->query("SELECT suplier_notelp FROM tbl_suplier WHERE suplier_notelp='$notelp'")->num_rows();
			 if ($cekmerek <= 0) {
    			$this->m_suplier->simpan_suplier($nama, $alamat, $notelp, $perusahaan);
    			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data supplier berhasil disimpan!</div>');
			 } else {
			     echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data nomor telepon sudah terdaftar!</div>');
			 }
			
			redirect('admin/suplier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function edit_suplier()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$notelp = $this->input->post('notelp');
			$perusahaan = $this->input->post('perusahaan');

			$cekmerek=$this->db->query("SELECT suplier_notelp FROM tbl_suplier WHERE suplier_notelp='$notelp' AND suplier_id != '$kode'")->num_rows();
			if ($cekmerek <= 0) {
			    $this->m_suplier->update_suplier($kode, $nama, $alamat, $notelp, $perusahaan);
			    echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data supplier berhasil diedit!</div>');
			} else {
			     echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data nomor telepon sudah terdaftar!</div>');
			}
			redirect('admin/suplier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_suplier()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			
			$cekterpakai=$this->db->query("SELECT beli_suplier_id FROM tbl_beli WHERE beli_suplier_id='$kode'")->num_rows();
			
			if ($cekterpakai <= 0) {
			    $this->m_suplier->hapus_suplier($kode);
    			echo $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Success!</strong> Data supplier berhasil dihapus!</div>");
    		} else {
    		    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data supplier terpakai tidak dapat dihapus, silahkan cek pembelian!</div>');
    		}
			redirect('admin/suplier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
