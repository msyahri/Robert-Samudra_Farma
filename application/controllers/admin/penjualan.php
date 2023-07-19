<?php
class Penjualan extends CI_Controller
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
		 // me-load library escpos
        $this->load->library('escpos');
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
			$data['data'] = $this->m_barang->data_barang_available();
			$data['customer'] = $this->m_customer->tampil_customer();
			$data['crbyr'] = $this->m_penjualan->tampil_cara_bayar();
			$data['cart'] = $this->m_penjualan->tampil_cart($this->session->userdata('idadmin'));
			$data['totalbelanja'] = $this->m_penjualan->tampil_total_belanja($this->session->userdata('idadmin'));
			$this->load->view('admin/v_penjualan', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function reset_penjualan()
	{
	    if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$idadmin = $this->session->userdata('idadmin');
			$this->m_penjualan->hapus_semua_cart($idadmin);
			
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
			
			redirect('admin/penjualan');
	    } else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function tukartambah()
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
		    	$x['sup'] = $this->m_suplier->tampil_suplier();
			$x['merk'] = $this->m_merek->tampil_merek();
			$x['warna'] = $this->m_barang->tampil_warna();
			$data['data'] = $this->m_barang->data_barang_available();
			$data['customer'] = $this->m_customer->tampil_customer();
			$data['crbyr'] = $this->m_penjualan->tampil_cara_bayar();
			$this->load->view('admin/v_tukartambah', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	public function showPenjualan()
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search = $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'jual_nofak',
            1=>'jual_tanggal',
            2=>'d_jual_barang_id',
            3=>'nama_merek',
            4=>'toko_nama',
            5=>'user_nama',
            6=>'d_jual_barang_har_srp',
            7=>'d_jual_barang_har_srp_pot',
            8=>'d_jual_qty',
            9=>'d_jual_total',
            10=>'d_jual_diskon',
            11=>'jual_total',
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
        $this->db->limit($length,$start);
        
		$this->db->select('jual_jml_uang,user_nama,toko_nama, jual_nofak,jual_tanggal,jual_total,d_jual_barang_id,
            d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek');
        $this->db->from('tbl_jual');
        $this->db->join('tbl_detail_jual', 'd_jual_nofak = jual_nofak');
        $this->db->join('tbl_barang', 'tbl_detail_jual.d_jual_barang_id = tbl_barang.barang_id');
        $this->db->join('tbl_merek', 'tbl_barang.barang_merek_id = tbl_merek.merek_id');
        $this->db->join('tbl_toko', 'tbl_barang.toko_id = tbl_toko.toko_id');
        $this->db->join('tbl_user', 'tbl_jual.jual_user_id = tbl_user.user_id');
        //$this->db->order_by('title', 'DESC');
        $penjualan_b = $this->db->get();
        $data = array();
        foreach($penjualan_b->result() as $rows)
        {

            $data[]= array(

                $rows->jual_nofak,
                $rows->jual_tanggal,
                $rows->d_jual_barang_id,
                $rows->nama_merek,
                $rows->toko_nama,
                $rows->user_nama,
                $rows->d_jual_barang_har_srp,
                $rows->d_jual_barang_har_srp_pot,
                $rows->d_jual_qty,
                $rows->d_jual_total,
                $rows->d_jual_diskon,
                $rows->jual_total,
               "<a href='javascript:void(0);' class='edit_record btn btn-xs btn-warning' 
                data-editbrgid='".$rows->d_jual_barang_id."'
                data-editbrgharsrppot='".$rows->d_jual_barang_har_srp_pot."'
                data-editbrgqty='".$rows->d_jual_qty."'
                data-editbrgjmluang='".$rows->jual_jml_uang."'
                data-editnofak='".$rows->jual_nofak."''><span class='fa fa-edit'> Edit</span></a>
                "
                // <a href='javascript:void(0);'  class='delete_record btn btn-xs btn-danger'
                // data-hapusimei='".$rows->d_jual_barang_id."'
                // data-hapusjualkode='".$rows->jual_nofak."'><span class='fa fa-close'> Hapus</a>
                );     
        }
        $total_penjualan_b = $this->totalPenjualanB();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_penjualan_b,
            "recordsFiltered" => $total_penjualan_b,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function totalPenjualanB()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_detail_jual");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
    
    function tabel_penjualan()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			
			$this->load->view('admin/v_tbl_penjualan');
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
			$idMerek = $b['nama_merek'];
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
// 	function add_to_cart()
// 	{
// 		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
// 			$kobar = $this->input->post('kode_brg');
// 			$tgljual = $this->input->post('tgljual');
// 			$customer = $this->input->post('customer');
// 			$cara_byr_jual = $this->input->post('cara_byr_jual');
//             $tgl_tempo = $this->input->post('tgl_tempo');
			
// 			$this->session->set_userdata('tgl_tempo', $tgl_tempo);
// 			$this->session->set_userdata('tglfakjual', $tgljual);
// 			$this->session->set_userdata('customer', $customer);
// 			$this->session->set_userdata('cara_byr_jual', $cara_byr_jual);

// 			$produk = $this->m_barang->get_barang($kobar);
// 			$i = $produk->row_array();
// 			$data = array(
// 				'id'       => $i['barang_id'],
// 				'merek_id'       => $i['barang_id'],
// 				'merek_nama'       => $i['nama_merek'],
// 				'warna'       => $i['warna'],
// 				'price'    => str_replace(",", "", $this->input->post('harsrp')),
// 				//harpok adalah harga srp potongan (harga jual)
// 				'harpok'	  => str_replace(",", "", $this->input->post('harsrppot')),
// 				'disc'     => $this->input->post('diskon'),
// 				'qty'      => $this->input->post('qty'),
// 				'jumlah'      => $this->input->post('qty'),
// 				'amount'	  => str_replace(",", "", $this->input->post('harsrp'))
// 				// 'name'     => $i['barang_nama'],
// 				// 'harpok'   => $i['barang_harpok'],

// 			);
// 			if (!empty($this->cart->total_items())) {
// 				foreach ($this->cart->contents() as $items) {
// 					$id = $items['id'];
// 					$qtylama = $items['qty'];
// 					$rowid = $items['rowid'];
// 					$kobar = $this->input->post('kode_brg');
// 					$qty = $this->input->post('qty');
// 					if ($id == $kobar) {
// 						$up = array(
// 							'rowid' => $rowid,
// 							'qty' => $qtylama + $qty
// 						);
// 						$this->cart->update($up);
// 					} else {
// 						$this->cart->insert($data);
// 					}
// 				}
// 			} else {
// 				$this->cart->insert($data);
// 			}

// 			redirect('admin/penjualan');
// 		} else {
// 			echo "Halaman tidak ditemukan";
// 		}
// 	}

	function add_to_cart()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kobar = $this->input->post('kode_brg');
			$tgljual = $this->input->post('tgljual');
			$customer = $this->input->post('customer');
			$cara_byr_jual = $this->input->post('cara_byr_jual');
            $tgl_tempo = $this->input->post('tgl_tempo');
            
            $merek = $this->input->post('merek');
            $warna = $this->input->post('warna');
            $id_warna = $this->input->post('id_warna');
            $harsrp = str_replace(",", "", $this->input->post('harsrp'));
            $harsrppot = str_replace(",", "", $this->input->post('harsrppot'));
            $qty = $this->input->post('qty');
            $diskon = $harsrp-$harsrppot;
            $subtotal = $harsrppot*$qty;
           
            $idadmin = $this->session->userdata('idadmin');
           
			$this->session->set_userdata('tgl_tempo', $tgl_tempo);
			$this->session->set_userdata('tglfakjual', $tgljual);
			$this->session->set_userdata('customer', $customer);
			$this->session->set_userdata('cara_byr_jual', $cara_byr_jual);

			$data = array(
				'cart_jual_id_admin'    => $idadmin,
				'cart_jual_imei'        => $kobar,
				'cart_jual_nama_merek'  => $merek,
				'cart_jual_warna'       => $warna,
				'cart_jual_id_warna'    => $id_warna,
				'cart_jual_harga_srp'   => $harsrp,
				'cart_jual_harga_jual'  => $harsrppot,
				'cart_jual_qty'         => $qty,
				'cart_jual_diskon'      => $diskon,
				'cart_jual_subtotal'    => $subtotal,
			);
			$query = $this->db->query(" SELECT * FROM tbl_cart_jual WHERE cart_jual_id_admin = '$idadmin' AND cart_jual_imei='$kobar'");
			if ($query->num_rows() != 0) {
				foreach ($query->result_array() as $items) {
					$id         = $items['cart_jual_id'];
					$qtylama    = $items['cart_jual_qty'];
					$up = ['cart_jual_qty' => $qtylama + $qty];
					
					$this->db->where('cart_jual_id', $id);
                    $this->db->update('tbl_cart_jual', $up);
				}
			} else {
				$this->db->insert('tbl_cart_jual', $data);
			}

			redirect('admin/penjualan');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function remove()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$id = $this->uri->segment(4);
			$this->db->delete('tbl_cart_jual', ['cart_jual_id' => $id]);
			redirect('admin/penjualan');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function simpan_penjualan()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$total = str_replace(",", "", $this->input->post('total'));
			$cr_byr = $this->session->userdata('cara_byr_jual');
			$jml_uang = str_replace(",", "", $this->input->post('jml_uang'));
			$tgl_tempo = $this->session->userdata('tgl_tempo');
			$kembalian = $jml_uang - $total;
			$sisa = $total - $jml_uang;
			if (!empty($total) && !empty($jml_uang)) {
				if ($jml_uang < $total && $cr_byr != 'Kredit') {
					echo $this->session->set_flashdata('msg', '<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
					redirect('admin/penjualan');
				} else {
					$tgljual = $this->session->userdata('tglfakjual');
					$nofak = $this->m_penjualan->get_nofak($tgljual);
					$this->session->set_userdata('nofak', $nofak);
					$order_proses = $this->m_penjualan->simpan_penjualan($nofak, $total, $jml_uang, $kembalian);
					
					if($cr_byr =="Kredit"){
                    //data dari tabel detail beli
                    // $getdata = $this->m_penjualan->get_barang_by_nofak($nofak)->row_array();
                    // $total = $getdata['total'];
                    // $sisa = $total - $jml_byr;
                    //simpan ke tbl_hutang
                     $this->db->query("INSERT INTO tbl_piutang (piutang_id,piutang_tempo,piutang_status) VALUES ('$nofak','$tgl_tempo','0')");
                    //simpan ke tbl_detail_hutang
                     $this->db->query("INSERT INTO tbl_detail_piutang (d_piutang_id,piutang_id,piutang_awal,piutang_bayar,piutang_sisa,tanggal) VALUES ('','$nofak','$total','$jml_uang','$sisa','$tgljual')");
                }
					if ($order_proses) {
						$c_customer = $this->session->userdata('customer');
						$this->session->set_userdata('cstmr', $c_customer);
						$c_nofak = $nofak;
						$this->session->set_userdata('c_nofak', $c_nofak);

						$data['cstmr'] = $this->m_customer->tampil_customer_by_id($this->session->userdata('cstmr'));
						
						$idadmin = $this->session->userdata('idadmin');
						$this->db->delete('tbl_cart_jual', ['cart_jual_id_admin' => $idadmin]); 

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
						redirect('admin/penjualan/hasil_simpan');
						// $this->load->view('admin/alert/alert_sukses', $data);
					} else {
						redirect('admin/penjualan');
					}
				}
			} else {
				echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
				redirect('admin/penjualan');
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function cetak_faktur()
	{
		// $x['cstmr'] = $this->m_customer->tampil_customer_by_id($this->session->userdata('customer'));
		$x['data'] = $this->m_penjualan->cetak_faktur();
		$this->load->view('admin/laporan/v_faktur', $x);
		// $this->load->view('admin/alert/alert_sukses', $x);
		//$this->session->unset_userdata('nofak');
	}

	function hasil_simpan()
	{
		$nofak = $this->session->userdata('c_nofak');
		$x['cstmr'] = $this->m_customer->tampil_customer_by_id($this->session->userdata('cstmr'));
		$x['data'] = $this->m_penjualan->cetak_faktur($nofak)->row_array();
		$x['tampilstruk'] = $this->m_penjualan->tampil_struk_jual($nofak)->result();
		$this->load->view('admin/alert/alert_sukses', $x);
		// $this->load->view('admin/alert/alert_sukses', $data);
	}
	
	function cetak_from_pc()
	{
		$nofak = $this->session->userdata('c_nofak');
		$x['cstmr'] = $this->m_customer->tampil_customer_by_id($this->session->userdata('cstmr'));
		$x['data'] = $this->m_penjualan->cetak_faktur($nofak)->row_array();
		$x['tampilstruk'] = $this->m_penjualan->tampil_struk_jual($nofak)->result();
		$this->load->view('admin/alert/alert_sukses', $x);
		// $this->load->view('admin/alert/alert_sukses', $data);
	}
	
	function cetak_from_pc_test() {
       

        // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("eppos_1");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);

        // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
        function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 8;
            $lebar_kolom_3 = 8;
            $lebar_kolom_4 = 9;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }   

        // Membuat judul
        $printer->initialize();
        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text("Nama Toko\n");
        $printer->text("\n");

        // Data transaksi
        $printer->initialize();
        $printer->text("Kasir : Badar Wildanie\n");
        $printer->text("Waktu : 13-10-2019 19:23:22\n");

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom("Barang", "qty", "Harga", "Subtotal"));
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom("Makaroni 250gr", "2pcs", "15.000", "30.000"));
        $printer->text(buatBaris4Kolom("Telur", "2pcs", "5.000", "10.000"));
        $printer->text(buatBaris4Kolom("Tepung terigu", "1pcs", "8.200", "16.400"));
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom('', '', "Total", "56.400"));
        $printer->text("\n");

         // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("Terima kasih telah berbelanja\n");
        $printer->text("http://badar-blog.blogspot.com\n");

        $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
        $printer->close();
    }
    
    function edit_penjualan()
	{
	    if ($this->session->userdata('akses') == '1') {
	        $id = $this->input->post('imei');
            $nofak = $this->input->post('no_fak');
    	    $harsrppot = $this->input->post('harsrppot');
    	    $qty = $this->input->post('qty');
    	    $tbayar = $this->input->post('totalbayar');
    	    
    	    $harsrppotOld = $this->input->post('harsrppot_old');
    	    $qtyOld = $this->input->post('qty_old');
    	    $tbayarOld = $this->input->post('totalbayar_old');
    	        
    	    $this->m_penjualan->update_detail_jual($nofak,$id,$qty,$harsrppot);
    	    
    	    $this->m_penjualan->update_jual($nofak,$qty,$harsrppot,$tbayar,$qtyOld,$harsrppotOld,$tbayarOld);
    	    
    	    $this->m_penjualan->update_barang($id,$harsrppot);
    	    
    	    echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil diedit!</div>');
    	    redirect('admin/penjualan/tabel_penjualan');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function hapus_jual()
	{
	    if ($this->session->userdata('akses') == '1') {
	        $imei = $this->input->post('imei');
	        
	        // 1. cek data penjualan, boleh edit jika belum terjual
	        $brgTerjual = $this->m_pembelian->ambil_data_penjualan($imei);
	        if ($brgTerjual->num_rows() <= 0){
    	        $belikode = $this->input->post('belikode');
    	         
    	        //hapus tb_detail_beli
    	        //kodisi X       
    	        $this->m_pembelian->hapus_tbl_detail_beli($imei);  
    	        
    	        //hapus tb_barang
    	        //kondisi X
    	        $this->m_pembelian->hapus_tbl_brg($imei);
    	        
    	        //hapus tb_beli
    	        // 2. kondisi cek tb_detail ada belikode = $belikode ? "jgn hapus" : "hapus where belikode=$belikode"
    	        $adaKode = $this->m_pembelian->ambil_detail($belikode);
    	        if($adaKode->num_rows <= 0)
    	        {
    	            $this->m_pembelian->hapus_tbl_beli($belikode);  
                }
    	        
    	        //telah dihapus
                echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil dihapus!</div>');
	        } else {
	            //tidak boleh dihapus
	            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Warning!</strong> Barang terjual, data tidak dapat dihapus!</div>');
	        }
            redirect('admin/pembelian/tabel_pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function tambah_cara_bayar()
	{
		$crbyr = $this->input->post('crbyr');
		$this->m_penjualan->simpan_cara_bayar($crbyr);
		redirect('admin/penjualan');
	}
	
	function cek_barcode()
	{
		
			$this->load->view('admin/v_cek_barcode');
	
	}
}
