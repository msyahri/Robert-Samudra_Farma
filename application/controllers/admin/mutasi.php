<?php
class Mutasi extends CI_Controller
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
            $data['data'] = $this->m_mutasi->tampil_barang();
            $data['kat'] = $this->m_merek->tampil_merek();
            $data['kat2'] = $this->m_merek->tampil_merek();
            $data['kat3'] = $this->m_mutasi->tampil_warna();
            $data['kat4'] = $this->m_toko->tampil_toko();
            $this->load->view('admin/v_mutasi', $data);
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
            3=>'barang_stok',
            4=>'toko_nama',
            5=>'kategori_merek',
            6=>'status',
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
                $rows->barang_stok,
                $rows->toko_nama,
                $rows->kategori_merek,
                $rows->status,
                "<a href='javascript:void(0);' class='edit_record btn btn-xs btn-warning' 
                data-brgimei='".$rows->barang_id."'
                data-brgnama='".$rows->nama_merek."'
                data-tokoid='".$rows->toko_id."'
                data-tokonama='".$rows->toko_nama."'><span class='fa fa-edit'>Edit</span></a>"
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

    function edit_barang()
    {
        if ($this->session->userdata('akses') == '1') {
            $kobar = $this->input->post('barang_imei');
            $toko = $this->input->post('toko_tujuan');
            $tokoasal = $this->input->post('toko_awal');
            $this->m_mutasi->update_barang($kobar, $toko);
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
