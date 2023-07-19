	<?php
	class Notifikasi extends CI_Controller
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
		$this->load->model('m_hutang');
	}
	function notifikasi_hutang($id_nutang)
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
		    if(empty($id_nutang))
		    {
		        $id = $this->session->userdata('iduntukdetaihutang');
		    } else 
		    {
		        $id = $id_nutang;
		        $this->session->set_flashdata('iduntukdetaihutang', $id);
		    }
		    
		  //  $id = $this->session->userdata('iduntukdetaihutang');
			$data['data'] = $this->m_hutang->tampil_detail_hutang($id);
			$data['data_hutang_last'] = $this->m_hutang->tampil_detail_hutang_last($id);
			$data['data_hutang'] = $this->m_hutang->tampil_hutang_by_id($id);
			$this->load->view('admin/v_detail_hutang', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}