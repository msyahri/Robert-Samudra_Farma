<?php
class Barang extends CI_Controller
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
		$this->load->model('m_pembelian');
		$this->load->library('barcode');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
 			$data['data'] = $this->m_barang->tampil_barang_tabel();
			$data['kat'] = $this->m_merek->tampil_merek();
			$data['kat2'] = $this->m_merek->tampil_merek();
			$data['kat3'] = $this->m_barang->tampil_warna();
			$data['kat4'] = $this->m_toko->tampil_toko();
			$this->load->view('admin/v_barang', $data);
		} else if ($this->session->userdata('akses') == '2') {
 			$data['data'] = $this->m_barang->tampil_barang_tabel();
			$data['kat'] = $this->m_merek->tampil_merek();
			$data['kat2'] = $this->m_merek->tampil_merek();
			$data['kat3'] = $this->m_barang->tampil_warna();
			$data['kat4'] = $this->m_toko->tampil_toko();
			$this->load->view('admin/v_barang_kasir', $data);
		} else {
			echo "Halaman tidak ditemukan";
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
            0=>'barang_id',
            1=>'nama_merek',
            2=>'warna',
            3=>'barang_harpok',
            4=>'barang_har_srp',
            5=>'barang_harmin',
            6=>'barang_harmax',
            7=>'barang_stok',
            8=>'toko_nama',
            9=>'kategori_merek',
            10=>'status',
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
        
		$this->db->select('*,barang_id,barang_satuan,barang_harpok,barang_har_srp,barang_harmin,barang_harmax,barang_har_srp_pot,barang_stok,barang_min_stok,barang_merek_id,nama_merek,warna,barang_warna,tbl_barang.toko_id,toko_nama,status,kategori_merek');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_merek', 'merek_id = barang_merek_id');
        $this->db->join('tbl_toko', 'tbl_toko.toko_id = tbl_barang.toko_id');
        $this->db->join('tbl_warna', 'warna_id = barang_warna');
        $tbl_brg = $this->db->get();
        $data = array();
        $no = 1;
        $status_brg = '';
        $kat_brg = '';
        
        
        foreach($tbl_brg->result() as $rows)
        {
            if ($rows->status == 1) {
                ($rows->barang_stok == 0 ) ? $status_brg = "Sold" : $status_brg = "Available";
            } else {
                $status_brg = "Retur";
            };
            
            ($rows->kategori_merek == 0 ) ? $kat_brg = "HP" : $kat_brg = "ACC";
            
            $data[]= array(
                $rows->barang_id,
                $rows->nama_merek,
                $rows->warna,
                $rows->barang_harpok,
                $rows->barang_har_srp,
                $rows->barang_harmin,
                $rows->barang_harmax,
                $rows->barang_stok,
                $rows->toko_nama,
                $rows->kategori_merek,
                $rows->status,
                "<a href='javascript:void(0);' class='edit_record btn btn-xs btn-warning' 
                data-editbrgid='".$rows->barang_id."'
                data-editbrgnama='".$rows->barang_merek_id."'
                data-editbrgwarna='".$rows->barang_warna."'
                data-editbrgharpok='".$rows->barang_harpok."'
                data-editbrgharsrp='".$rows->barang_har_srp."'
                data-editbrgharmin='".$rows->barang_harmin."'
                data-editbrgharmax='".$rows->barang_harmax."'
                data-editbrgstok='".$rows->barang_stok."'
                data-editbrgtoko='".$rows->toko_id."'
                data-editbrgkatmerek='".$rows->kategori_merek."'
                data-editbrgstatus='".$rows->status."'><span class='fa fa-edit'>Edit</span></a>"
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
        $query = $this->db->select("COUNT(*) as num")->get("tbl_barang");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
	
	// function tambah_barang()
	// {
	// 	if ($this->session->userdata('akses') == '1') {
	// 		$kobar = $this->m_barang->get_kobar();
	// 		$nabar = $this->input->post('nabar');
	// 		$kat = $this->input->post('kategori');
	// 		$satuan = $this->input->post('satuan');
	// 		$harpok = str_replace(',', '', $this->input->post('harpok'));
	// 		$harjul = str_replace(',', '', $this->input->post('harjul'));
	// 		$harjul_grosir = str_replace(',', '', $this->input->post('harjul_grosir'));
	// 		$stok = $this->input->post('stok');
	// 		$min_stok = $this->input->post('min_stok');
	// 		$this->m_barang->simpan_barang($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok);

	// 		redirect('admin/barang');
	// 	} else {
	// 		echo "Halaman tidak ditemukan";
	// 	}
	// }
	function edit_barang()
	{
		if ($this->session->userdata('akses') == '1') {
			// $harpok = str_replace(',', '', $this->input->post('harpok'));
            $kobar_old = $this->input->post('brg_id_old');
	        // cek data penjualan, boleh edit jika belum terjual
	        $brgTerjual = $this->m_pembelian->ambil_data_penjualan($kobar_old);
	        if ($brgTerjual->num_rows() <= 0){   
	            // cek status retur, boleh edit jika tidak/belum diretur
	            $brgDiretur = $this->m_barang->cek_status_retur($kobar_old);
	            if ($brgDiretur->num_rows() <= 0){ 
                    $kobar = $this->input->post('brg_id');
        			$nabar = $this->input->post('nm_merek');
        			$warna = $this->input->post('warna');
        			$harpok = $this->input->post('harpok');
        			$harsrp = $this->input->post('harsrp');
        			$harmin = $this->input->post('harmin');
        			$harmax = $this->input->post('harmax');
        			$stok = $this->input->post('stok');
        			$toko = $this->input->post('toko');
        // 			$kat = $this->input->post('katmerek'); //kategori included with merek
        			$this->m_barang->update_barang($kobar_old,$kobar, $nabar, $warna, $harpok, $harsrp, $harmin, $harmax, $stok, $toko);
        			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil diedit!</div>');
	            } else {
    	            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Warning!</strong> Barang telah di-Retur, data tidak dapat diedit!</div>');
	            }
	        } else {
	            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Warning!</strong> Barang terjual atau di-Retur, data tidak dapat diedit!</div>');
	        }
			redirect('admin/barang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_barang()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			// cek data penjualan, boleh edit jika belum terjual
	        $brgTerjual = $this->m_pembelian->ambil_data_penjualan($kode);
	        if ($brgTerjual->num_rows() <= 0){   
			    $this->m_barang->hapus_barang($kode);
	            echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil dihapus!</div>');
	        } else {
	            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Warning!</strong> Barang terjual, data tidak dapat dihapus!</div>');
	        }
			redirect('admin/barang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
