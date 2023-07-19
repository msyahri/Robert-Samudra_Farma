<?php
class Service extends CI_Controller
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
		$this->load->model('m_suplier');
		$this->load->model('m_customer');
		$this->load->model('m_penjualan');
		$this->load->model('m_service');
	}
	function index()
	{
		$formbeli = $this->session->userdata('formbeli');
		if ($formbeli == "true") {
			//unset
			$this->cart->destroy();
			$this->session->unset_userdata('customer');
			$this->session->unset_userdata('suplier');
			$this->session->unset_userdata('nofak');
			$this->session->unset_userdata('tglfak');
			$this->session->unset_userdata('tgl_tempo');
			$this->session->unset_userdata('cara_byr_jual');
			$this->session->unset_userdata('cara_byr');
			$this->session->unset_userdata('tglfakjual');
			$this->session->unset_userdata('formbeli');
			$this->session->unset_userdata('warna');
			$this->session->unset_userdata('merek');
		}
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$data['data'] = $this->m_barang->tampil_barang();
			$data['customer'] = $this->m_customer->tampil_customer();
			$data['crbyr'] = $this->m_service->tampil_cara_bayar();
			$this->load->view('admin/v_service', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function service_tabel()
	{
	    if ($this->session->userdata('akses') == '1') {
		    $x['service'] = $this->m_service->tampil_service();
		    $this->load->view('admin/v_service_tabel', $x);
		} else if($this->session->userdata('akses') == '2') {
			$x['service'] = $this->m_service->tampil_service();
			$this->load->view('admin/v_service_tabel_kasir', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_service()
	{
	    	if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kode = $this->input->post('kode');
			$this->m_service->hapus_service_det($kode);
			$this->m_service->hapus_service($kode);
			redirect('admin/service/service_tabel');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function get_barang()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kobar = $this->input->post('kode_brg');
			$x['brg'] = $this->m_barang->get_barang($kobar);
			$this->load->view('admin/v_detail_barang_jual', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function get_barang2()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kobar = $this->input->post('kode_brg');
			$brg = $this->m_barang->get_barang($kobar);
			//$this->load->view('admin/v_detail_barang_jual', $x);


			$b = $brg->row_array();
			$namaMerek = $b['nama_merek'];
			echo "					
			
			
			
			<table>
				<tr>
					<th style='width:200px;'></th>
					<th>Nama Merek</th>
					<th>Warna</th>
					<th>Stok</th>
					<th>Harga SRP(Rp)</th>
					<th>Harga SRP Pot(Rp)</th>
					<th style='text-align: center;'>Jumlah</th>
				</tr>
				<tr>
					<th style='width:200px;'>
					</th>
					<td><input type='text' name='nabar' value='$namaMerek' style='width:300px;margin-right:5px;' class='form-control input-sm' readonly>
						<input type='hidden' value='" . $b['barang_merek_id'] . "' style='width:120px;margin-right:5px;' class='form-control input-sm' readonly></td>

					<td><input type='text' name='nabar' value='" . $b['warna'] . "' style='width:100px;margin-right:5px;' class='form-control input-sm' readonly></td>
					<td><input type='text' name='stok' value='" . $b['barang_stok'] . "' style='width:40px;margin-right:5px;' class='form-control input-sm' readonly></td>
					<td><input type='text' name='harsrp' value='" . number_format($b['barang_har_srp']) . "' style='width:120px;margin-right:5px;text-align:right;' class='form-control input-sm' readonly></td>
					<td><input type='text' name='harsrppot' value='" . number_format($b['barang_har_srp']) . "' style='width:120px;margin-right:5px;text-align:right;' class='form-control input-sm'></td>
					<td><input type='number' name='qty' id='qty' value='1' min='1' max='" . $b['barang_stok'] . "' class='form-control input-sm' style='width:90px;margin-right:5px;' required></td>
					<td><button type='submit' class='btn btn-sm btn-success' style='margin-right:5px;'>Ok</button></td>
					<td><a id='batalInsertCart' class='btn btn-sm btn-warning'><span class='fa fa-close'></span> Batal</a></td>
				</tr>
			</table>



			";
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function add_to_cart()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
// 			$kobar = $this->input->post('kode_brg');
			$tgljual = $this->input->post('tgljual');
			$customer = $this->input->post('customer');
			$cara_byr_jual = $this->input->post('cara_byr_jual');
			
			$this->session->set_userdata('tglfakjual', $tgljual);
			$this->session->set_userdata('customer', $customer);
			$this->session->set_userdata('cara_byr_jual', $cara_byr_jual);

// 			$produk = $this->m_barang->get_barang($kobar);
// 			$i = $produk->row_array();
			$data = array(
				'id'       => $this->input->post('nama_service'),
				// 'merek_id'       => $i['nama_service'],
				'merek_id'       => $this->input->post('nama_service'),
				'service_nama'       => $this->input->post('nama_service'),
				 'warna'       => 1,
				'price'    => str_replace(",", "", $this->input->post('harsrppot')),
				//harpok adalah harga srp potongan (harga jual)
				'harpok'	  => str_replace(",", "", $this->input->post('harsrppot')),
				// 'disc'     => $this->input->post('diskon'),
				'qty'      => $this->input->post('stok'),
				'jumlah'      => $this->input->post('stok'),
				'amount'	  => str_replace(",", "", $this->input->post('harsrppot'))
				// 'name'     => $i['barang_nama'],
				// 'harpok'   => $i['barang_harpok'],

			);
			
				$this->cart->insert($data);

			redirect('admin/service');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function remove()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$row_id = $this->uri->segment(4);
			$this->cart->update(array(
				'rowid'      => $row_id,
				'qty'     => 0
			));
			redirect('admin/service');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function simpan_service()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$total = $this->input->post('total');

			$jml_uang = str_replace(",", "", $this->input->post('jml_uang'));
			$kembalian = $total - $jml_uang ;
			if (!empty($total) && !empty($jml_uang)) {
					$tgljual = $this->session->userdata('tglfakjual');
					
					$nofak = $this->m_service->get_nofak($tgljual);
					$this->session->set_userdata('nofak', $nofak);
					$order_proses = $this->m_service->simpan_service($nofak, $total, $jml_uang, $kembalian);
					if ($order_proses) {
						$c_customer = $this->session->userdata('customer');
						$this->session->set_userdata('cstmr', $c_customer);
						$c_nofak = $nofak;
						$this->session->set_userdata('c_nofak', $c_nofak);

						$data['cstmr'] = $this->m_customer->tampil_customer_by_id($this->session->userdata('cstmr'));
						$this->cart->destroy();

						$this->session->unset_userdata('tglfak');
						$this->session->unset_userdata('suplier');
						$this->session->unset_userdata('customer');
						$this->session->unset_userdata('suplier');
						//$this->session->unset_userdata('nofak');
						$this->session->unset_userdata('tglfak');
						$this->session->unset_userdata('tgl_tempo');
						$this->session->unset_userdata('cara_byr_jual');
						$this->session->unset_userdata('cara_byr');
						$this->session->unset_userdata('tglfakjual');
						$this->session->unset_userdata('warna');
						$this->session->unset_userdata('merek');
						redirect('admin/service/hasil_simpan');
						// $this->load->view('admin/alert/alert_sukses', $data);
					} else {
						redirect('admin/service');
					}
				
			} else {
				echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
				redirect('admin/service');
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function cetak_faktur()
	{
		// $x['cstmr'] = $this->m_customer->tampil_customer_by_id($this->session->userdata('customer'));
		$x['data'] = $this->m_service->cetak_faktur();
		$this->load->view('admin/laporan/v_faktur', $x);
		// $this->load->view('admin/alert/alert_sukses', $x);
		//$this->session->unset_userdata('nofak');
	}

	function hasil_simpan()
	{
		$nofak = $this->session->userdata('c_nofak');
		$x['cstmr'] = $this->m_customer->tampil_customer_by_id($this->session->userdata('cstmr'));
		$x['data'] = $this->m_service->cetak_faktur($nofak)->row_array();
		$x['tampilstruk'] = $this->m_service->tampil_struk_service($nofak)->result();
		$this->load->view('admin/alert/alert_sukses_service', $x);
		// $this->load->view('admin/alert/alert_sukses', $data);
	}

	function tambah_cara_bayar()
	{
		$crbyr = $this->input->post('crbyr');
		$this->m_service->simpan_cara_bayar($crbyr);
		redirect('admin/service');
	}
}
