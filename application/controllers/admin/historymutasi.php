<?php
class Historymutasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        };
        $this->load->model('m_merek');
        $this->load->model('m_mutasi');
        $this->load->model('m_toko');
        $this->load->library('barcode');
    }
    function index()
    {
        if ($this->session->userdata('akses') == '1') {
            $data['data'] = $this->m_mutasi->tampil_barang_histori();
            $data['kat'] = $this->m_merek->tampil_merek();
            $data['kat2'] = $this->m_merek->tampil_merek();
            $data['kat3'] = $this->m_mutasi->tampil_warna();
            $data['kat4'] = $this->m_toko->tampil_toko();
            $this->load->view('admin/v_history_mutasi', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
    
    public function showMutasi()
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
            0=>'mutasi_imei',
            1=>'nama_merek',
            2=>'mutasi_toko_asal',
            3=>'toko_nama',
            4=>'mutasi_tanggal',
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
        
		$this->db->select('*,mutasi_imei,mutasi_toko_asal,mutasi_toko_tujuan,mutasi_tanggal,barang_merek_id,nama_merek,tbl_barang.toko_id,toko_nama');
        $this->db->from('tbl_mutasi');
        $this->db->join('tbl_barang', 'barang_id = mutasi_imei');
        $this->db->join('tbl_merek', 'merek_id = barang_merek_id');
        $this->db->join('tbl_toko', 'tbl_toko.toko_id = mutasi_toko_tujuan');
        $tbl_mutasi = $this->db->get();
        $data = array();
        
        
        foreach($tbl_mutasi->result() as $rows)
        {
            
            $data[]= array(
                $rows->mutasi_imei,
                $rows->nama_merek,
                $rows->mutasi_toko_asal,
                $rows->toko_nama,
                $rows->mutasi_tanggal,
            );     
        }
        $total_mutasi = $this->totalMutasi();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_mutasi,
            "recordsFiltered" => $total_mutasi,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function totalMutasi()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_mutasi");
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
            $kobar = $this->input->post('kobar');
            $nabar = $this->input->post('nabar');
            $warna = $this->input->post('warna');
            // $harpok = str_replace(',', '', $this->input->post('harpok'));
            // $harsrp = str_replace(',', '', $this->input->post('harsrp'));
            // $stok = $this->input->post('stok');
            $toko = $this->input->post('toko');
            $tokoasal = $this->input->post('tokoasal');
            // $kat = $this->input->post('kategori');
            $status = $this->input->post('status');
            $this->m_mutasi->update_barang($kobar, $nabar, $warna, $toko, $status);
            $this->m_mutasi->add_mutasi($kobar, $toko, $tokoasal);
            redirect('admin/mutasi');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
    function hapus_barang()
    {
        if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode');
            $this->m_barang->hapus_barang($kode);
            redirect('admin/mutasi');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
}
