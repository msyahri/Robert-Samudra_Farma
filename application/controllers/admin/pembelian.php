<?php
class Pembelian extends CI_Controller
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
		$this->load->model('m_pembelian');
		$this->load->model('m_toko');
	}
	
	function index()
	{
		$formbeli = $this->session->userdata('formbeli');
		if (!isset($formbeli)) {
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
			$this->session->unset_userdata('warna');
			$this->session->unset_userdata('merek');
			$this->session->unset_userdata('jml_byr');
		}
		$this->session->set_userdata('formbeli', "true");
		if ($this->session->userdata('akses') == '1') {
		    
		    $nofak = $this->session->userdata('nofak');
		    $x['cartbrg'] = $this->m_pembelian->tampil_cart($nofak);
		    $x['carttotal'] = $this->m_pembelian->tampil_cart_total($nofak);
			$x['sup'] = $this->m_suplier->tampil_suplier();
			$x['merk'] = $this->m_merek->tampil_merek();
			$x['warna'] = $this->m_barang->tampil_warna();
			$this->load->view('admin/v_pembelian', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function reset_pembelian()
	{
		if ($this->session->userdata('akses') == '1') {
			$nofak = $this->session->userdata('nofak');
			$this->m_pembelian->hapus_semua_cart($nofak);
		    
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
			$this->session->unset_userdata('warna');
			$this->session->unset_userdata('merek');
			$this->session->unset_userdata('jml_byr');
			
			redirect('admin/pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
		    
	
	public function tabel_pembelian()
	{
	    if ($this->session->userdata('akses') == '1') {
	        $data['suplier'] = $this->m_suplier->tampil_suplier();
			$this->load->view('admin/v_tbl_pembelian', $data);
		} else {
			alert("Halaman tidak ditemukan");
		}
	}
	
	//get
	public function showBarang()
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
            0=>'beli_tanggal',
            1=>'beli_nofak',
            2=>'d_beli_barang_id',
            3=>'nama_merek',
            4=>'d_beli_harga',
            5=>'d_beli_jumlah',
            6=>'beli_pembayaran',
            7=>'beli_tempo',
            8=>'toko_nama',
            9=>'suplier_nama',
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
    
		$this->db->select('toko_nama,beli_nofak, beli_kode, beli_suplier_id, beli_tanggal, nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,beli_tempo,d_beli_barang_id,suplier_nama, kategori_merek');
        $this->db->from('tbl_beli'); 

        $this->db->join('tbl_detail_beli', 'd_beli_kode = beli_kode');
        $this->db->join('tbl_barang', 'tbl_barang.barang_id = tbl_detail_beli.d_beli_barang_id');
        $this->db->join('tbl_merek', 'tbl_merek.merek_id = tbl_barang.barang_merek_id');
        $this->db->join('tbl_toko', 'tbl_toko.toko_id = tbl_barang.toko_id');
        $this->db->join('tbl_suplier', 'tbl_suplier.suplier_id = tbl_beli.beli_suplier_id');
        $tbl_brg = $this->db->get();
        $data = array();
        
        foreach($tbl_brg->result() as $rows)
        {
            $data[]= array(
                $rows->beli_tanggal,
                $rows->beli_nofak,
                $rows->d_beli_barang_id,
                $rows->nama_merek,
                $rows->d_beli_harga,
                $rows->d_beli_jumlah,
                $rows->beli_pembayaran,
                $rows->beli_tempo,
                $rows->toko_nama,
                $rows->suplier_nama,
                "<a href='javascript:void(0);' class='edit_record btn btn-xs btn-warning' 
                data-brgid='".$rows->d_beli_barang_id."'
                data-editbelikode='".$rows->beli_kode."'
                data-editnofak='".$rows->beli_nofak."'
                data-edittgl='".$rows->beli_tanggal."'
                data-editsupplier='".$rows->beli_suplier_id."'
                data-editpembayaran='".$rows->beli_pembayaran."'
                data-edittempo='".$rows->beli_tempo."'><span class='fa fa-edit'> Edit</span></a>
                <a href='javascript:void(0);'  class='delete_record btn btn-xs btn-danger'
                data-hapusimei='".$rows->d_beli_barang_id."'
                data-hapusbelikode='".$rows->beli_kode."'><span class='fa fa-close'> Hapus</a>"
            );     
        }
        $total_brg = $this->totalBrg();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_brg,
            "recordsFiltered" => $total_brg,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    
    public function totalBrg()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_detail_beli");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
    
	function get_barang()
	{
		if ($this->session->userdata('akses') == '1') {
			$kobar = $this->input->post('kode_brg');
			$x['brg'] = $this->m_barang->get_barang($kobar);
			$this->load->view('admin/v_detail_barang_beli', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function cek_kategori_merek()
	{
		$id_merek=$this->input->post('id_merek');
		$hasil=$this->m_merek->tampil_merek_by_id($id_merek)->row_array();
		$kategori=$hasil['kategori_merek'];
		//$kategori="123";
		if($kategori==0){
			$data['kategori']="handphone";
		}else{
			$data['kategori']="acc";
		}
		echo json_encode($data);

	}

	function get_merek()
	{
		if ($this->session->userdata('akses') == '1') {
			$x['result_merek'] = $this->m_merek->tampil_merek();
			$this->load->view('admin/v_detail_barang_beli', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

// 	function add_to_cart()
// 	{
// 		if ($this->session->userdata('akses') == '1') {
// 			$nofak = $this->input->post('nofak');
// 			$tgl = $this->input->post('tgl');
// 			$suplier = $this->input->post('suplier');
// 			$cara_byr = $this->input->post('cara_byr');
// 			$tgl_tempo = $this->input->post('tgl_tempo');
// 			$imei = $this->input->post('imei');
// 			$merek = $this->input->post('merek');
// 			$warna = $this->input->post('warna');
// 			$harpok = $this->input->post('harpok');
// 			$harsrp = $this->input->post('harsrp');
// 			$harmin = $this->input->post('harmin');
// 			$harmax = $this->input->post('harmax');
// 			$jumlah = $this->input->post('jumlah');
// 			$jml_byr = $this->input->post('jml_byr');

// 			$this->session->set_userdata('nofak', $nofak);
// 			$this->session->set_userdata('tglfak', $tgl);
// 			$this->session->set_userdata('suplier', $suplier);
// 			$this->session->set_userdata('cara_byr', $cara_byr);
// 			$this->session->set_userdata('tgl_tempo', $tgl_tempo);
// 			$this->session->set_userdata('imei', $imei);
// 			$this->session->set_userdata('merek', $merek);
// 			$this->session->set_userdata('warna', $warna);
// 			$this->session->set_userdata('harpok', $harpok);
// 			$this->session->set_userdata('harsrp', $harsrp);
// 			$this->session->set_userdata('harmin', $harmin);
// 			$this->session->set_userdata('harmax', $harmax);
// 			$this->session->set_userdata('jumlah', $jumlah);
// 			$this->session->set_userdata('jml_byr', $jml_byr);

// 			$produk = $this->m_merek->tampil_merek_by_id($merek);
// 			$i = $produk->row_array();

// 			$sqlwarna = $this->m_barang->tampil_warna_by_id($warna);
// 			$j = $sqlwarna->row_array();

// 			$data = array(
// 				'id'       => $imei,
// 				'imei'       => $imei,
// 				'merek_id'     => $merek,
// 				'merek_nama'     => $i['nama_merek'],
// 				'warna'   => $warna,
// 				'warna_nama'   => $j['warna'],
// 				'harpok'    => $harpok,
// 				'harsrp'    => $harsrp,
// 				'harmin'      => $harmin,
// 				'harmax'      => $harmax,
// 				'jumlah'      => $jumlah
// 			);

// 			$this->cart->insert($data);
// 			redirect('admin/pembelian');
// 		} else {
// 			echo "Halaman tidak ditemukan";
// 		}
// 	}

	function add_to_cart()
	{
		if ($this->session->userdata('akses') == '1') {
			$nofak = $this->input->post('nofak');
			$tgl = $this->input->post('tgl');
			$suplier = $this->input->post('suplier');
			$cara_byr = $this->input->post('cara_byr');
			$tgl_tempo = $this->input->post('tgl_tempo');
			$imei = $this->input->post('imei');
			$merek = $this->input->post('merek');
			$warna = $this->input->post('warna');
			$harpok = $this->input->post('harpok');
			$harsrp = $this->input->post('harsrp');
			$harmin = $this->input->post('harmin');
			$harmax = $this->input->post('harmax');
			$jumlah = $this->input->post('jumlah');
			$jml_byr = $this->input->post('jml_byr');
			$subtotal = $harpok*$jumlah;

			$this->session->set_userdata('nofak', $nofak);
			$this->session->set_userdata('tglfak', $tgl);
			$this->session->set_userdata('suplier', $suplier);
			$this->session->set_userdata('cara_byr', $cara_byr);
			$this->session->set_userdata('tgl_tempo', $tgl_tempo);
			$this->session->set_userdata('imei', $imei);
			$this->session->set_userdata('merek', $merek);
			$this->session->set_userdata('warna', $warna);
			$this->session->set_userdata('harpok', $harpok);
			$this->session->set_userdata('harsrp', $harsrp);
			$this->session->set_userdata('harmin', $harmin);
			$this->session->set_userdata('harmax', $harmax);
			$this->session->set_userdata('jumlah', $jumlah);
			$this->session->set_userdata('jml_byr', $jml_byr);

			$produk = $this->m_merek->tampil_merek_by_id($merek);
			$i = $produk->row_array();

			$sqlwarna = $this->m_barang->tampil_warna_by_id($warna);
			$j = $sqlwarna->row_array();

			$data = array(
				'cart_nofak'       => $nofak,
				'cart_imei'       => $imei,
				'cart_merek_barang_id'  => $merek,
				'cart_merek_barang'     => $i['nama_merek'],
				'cart_warna_id'   =>  $warna,
				'cart_warna'   => $j['warna'],
				'cart_harga_pokok'    => $harpok,
				'cart_harga_srp'    => $harsrp,
				'cart_harga_min'      => $harmin,
				'cart_harga_max'      => $harmax,
				'cart_jumlah'      => $jumlah,
				'cart_subtotal'      => $subtotal
			);

			$this->db->insert('tbl_cart', $data);
			redirect('admin/pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
// 	function remove()
// 	{
// 		if ($this->session->userdata('akses') == '1') {
// 			$row_id = $this->uri->segment(4);
// 			$this->cart->update(array(
// 				'rowid'      => $row_id,
// 				'qty'     => 0
// 			));
// 			redirect('admin/pembelian');
// 		} else {
// 			echo "Halaman tidak ditemukan";
// 		}
// 	}
	function remove()
	{
		if ($this->session->userdata('akses') == '1') {
			$id = $this->uri->segment(4);
			$this->m_pembelian->hapus_cart($id);
			redirect('admin/pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function simpan_pembelian()
	{
		if ($this->session->userdata('akses') == '1') {
			$nofak = $this->session->userdata('nofak');
			$tglfak = $this->session->userdata('tglfak');
			$suplier = $this->session->userdata('suplier');
			$cara_byr = $this->session->userdata('cara_byr');
			$tgl_tempo = $this->session->userdata('tgl_tempo');
			$toko_id = $this->session->userdata('tokoid');
			$jml_byr = $this->session->userdata('jml_byr');

			if (!empty($nofak) && !empty($tglfak) && !empty($suplier)) {
				$beli_kode = $this->m_pembelian->get_kobel();
				$order_proses = $this->m_pembelian->simpan_pembelian($nofak, $tglfak, $suplier, $cara_byr, $tgl_tempo, $beli_kode, $toko_id);
				
				if($cara_byr=="Kredit"){
                    //data dari tabel detail beli
                    $getdata = $this->m_pembelian->get_barang_by_nofak($nofak)->row_array();
                    $total = $getdata['total'];
                    $sisa = $total - $jml_byr;
                    //simpan ke tbl_hutang
                     $this->db->query("INSERT INTO tbl_hutang (hutang_id,hutang_tempo,hutang_status) VALUES ('$nofak','$tgl_tempo','0')");
                    //simpan ke tbl_detail_hutang
                     $this->db->query("INSERT INTO tbl_detail_hutang (hutang_id,hutang_awal,hutang_bayar,hutang_sisa,tanggal) VALUES ('$nofak','$total','$jml_byr','$sisa','$tglfak')");
                }
				
				
				if ($order_proses) {
					$this->cart->destroy();
					$this->session->unset_userdata('nofak');
					$this->session->unset_userdata('tglfak');
					$this->session->unset_userdata('suplier');
					$this->session->unset_userdata('cara_byr');
					$this->session->unset_userdata('tgl_tempo');
					$this->session->unset_userdata('jml_byr');
        	        echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil disimpan!</div>');
					redirect('admin/pembelian');
				} else {
					redirect('admin/pembelian');
				}
			} else {
        	        echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Warning!</strong> Data Gagal disimpan, Mohon periksa kembali inputan anda!</div>');
				redirect('admin/pembelian');
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function edit_pembelian()
	{
	    if ($this->session->userdata('akses') == '1') {
	        $id = $this->input->post('idbrg');
	        // cek data penjualan, boleh edit jika belum terjual
	        $brgTerjual = $this->m_pembelian->ambil_data_penjualan($id);
	        if ($brgTerjual->num_rows() <= 0){
    	        $belkod = $this->input->post('belikode');
    	        $nofak = $this->input->post('no_fak');
    	        $tgl = $this->input->post('tgl');
    	        $suplier = $this->input->post('suplier');
    	        $pembayaran = $this->input->post('pembayaran');
    	        $tempo = $this->input->post('tempo');
    	        
    	        $this->m_pembelian->update_beli($belkod,$nofak,$tgl,$suplier,$pembayaran,$tempo);
    	        echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil diedit!</div>');
	        } else {
	            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Warning!</strong> Barang terjual, data tidak dapat diedit!</div>');
	        }
    	    redirect('admin/pembelian/tabel_pembelian');
	        
	        
	        
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function hapus_beli()
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
    	        else{
    	        //telah dihapus
                echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil dihapus!</div>');
    	        }
	        } else {
	            //tidak boleh dihapus
	            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Warning!</strong> Barang terjual, data tidak dapat dihapus!</div>');
	        }
            redirect('admin/pembelian/tabel_pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function cek_duplikasi_imei()
	{
		$id_merek = $this->input->post('id_merek');
		$get_id = $this->db->query("SELECT barang_id FROM tbl_barang WHERE barang_id = '$id_merek'")->row_array();
		$imei = $get_id['barang_id'];
		
		if($imei) {
		    $data['imei']="duplikasi";
		}
    	echo json_encode($data);
	}
}
