<?php
class Invoice extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_merek');
		$this->load->model('m_barang');
		$this->load->model('m_toko');
		$this->load->model('m_suplier');
		$this->load->model('m_retur');
		$this->load->model('m_penjualan');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
// 			$data['data'] = $this->m_barang->tampil_barang();
// 			$data['retur'] = $this->m_retur->tampil_retur_beli();
			$this->load->view('admin/v_invoice');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function show_invoice()
	{
		if ($this->session->userdata('akses') == '1') {
		    $nofaktur = $this->input->post('nofak');
			$x['data'] = $this->m_penjualan->cetak_faktur($nofaktur)->row_array();
			$x['tampilstruk'] = $this->m_penjualan->cetak_faktur($nofaktur)->result();
			$this->load->view('admin/v_show_invoice', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function get_penjualan()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$nofaktur = $this->input->post('nofak');
			$x['brg'] = $this->m_penjualan->cetak_faktur($nofaktur);
			$this->load->view('admin/v_detail_invoice', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
