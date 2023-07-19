<?php
class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        };
        $this->load->model('m_merek');
        $this->load->model('m_pengguna');
        $this->load->model('m_toko');
        $this->load->model('m_barang');
        $this->load->model('m_suplier');
        $this->load->model('m_pembelian');
        $this->load->model('m_penjualan');
        $this->load->model('m_laporan');
    }
    function index()
    {
        if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
            $data['data'] = $this->m_barang->tampil_barang();
            $data['karyawan'] = $this->m_pengguna->get_karyawan();
            $data['kat'] = $this->m_merek->tampil_merek();
            $data['jual_bln'] = $this->m_laporan->get_bulan_jual();
            $data['datatoko'] = $this->m_toko->tampil_toko();
            $data['jual_thn'] = $this->m_laporan->get_tahun_jual();
            $data['service_thn'] = $this->m_laporan->get_tahun_service();
            $data['service_bln'] = $this->m_laporan->get_bulan_service();
            $this->load->view('admin/v_laporan', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
    function lap_stok_barang()
    {
        $x['data'] = $this->m_laporan->get_stok_barang();
        $this->load->view('admin/laporan/v_lap_stok_barang', $x);
    }
    function lap_data_barang()
    {
        $x['data'] = $this->m_laporan->get_data_barang();
        $this->load->view('admin/laporan/v_lap_barang', $x);
    }
    function lap_data_barang_pertoko()
    {
        $x['judul'] = "BARANG";
        $toko = $this->input->post('toko');
        $x['data'] = $this->m_laporan->get_data_barang_pertoko($toko);
        $this->load->view('admin/laporan/v_lap_barang_pertoko', $x);
    }
    function lap_data_so_pertoko()
    {
        $x['judul'] = "SO";
        $toko = $this->input->post('toko');
        $x['data'] = $this->m_laporan->get_data_so_pertoko($toko);
        $this->load->view('admin/laporan/v_lap_barang_pertoko', $x);
    }
    function lap_data_aset_pertoko()
    {
        $x['judul'] = "ASET";
        $toko = $this->input->post('toko');
        $x['jml'] = $this->m_laporan->get_data_total_aset_pertoko($toko);
        $x['data'] = $this->m_laporan->get_data_aset_pertoko($toko);
        $this->load->view('admin/laporan/v_lap_aset_pertoko', $x);
    }
    
    function lap_data_penjualan()
    {
        $x['data'] = $this->m_laporan->get_data_penjualan();
        $x['jml'] = $this->m_laporan->get_total_penjualan();
        $this->load->view('admin/laporan/v_lap_penjualan', $x);
    }
    function lap_penjualan_pertanggal()
    {
        $tanggal = $this->input->post('tgl');
        $toko = $this->input->post('toko');
        if($toko=='semua_toko')
        {
            $x['jml'] = $this->m_laporan->get_data__total_jual_pertanggal($tanggal);
            $x['data'] = $this->m_laporan->get_data_jual_pertanggal($tanggal);
            $x['tk'] = "APOTEK SAMUDRA";
        }else{
            $x['jml'] = $this->m_laporan->get_data__total_jual_pertanggal_toko($tanggal,$toko);
            $x['data'] = $this->m_laporan->get_data_jual_pertanggal_toko($tanggal,$toko);
            $xtoko = $this->db->get_where('tbl_toko', ['toko_id' => $toko])->row_array();
            $x['tk'] = $xtoko['toko_nama'];
        }
        $x['tgl'] = $tanggal;
        $this->load->view('admin/laporan/v_lap_jual_pertanggal', $x);
    }
    function lap_penjualan_perbulan()
    {
        $bulan = $this->input->post('bln');
        $toko = $this->input->post('toko');
        if($toko=='semua_toko')
        {
            $x['jml'] = $this->m_laporan->get_total_jual_perbulan($bulan);
            $x['data'] = $this->m_laporan->get_jual_perbulan($bulan);
            $x['tk'] = "APOTEK SAMUDRA";
        }else{
            $x['jml'] = $this->m_laporan->get_total_jual_perbulan_toko($bulan,$toko);
            $x['data'] = $this->m_laporan->get_jual_perbulan_toko($bulan,$toko);
            $xtoko = $this->db->get_where('tbl_toko', ['toko_id' => $toko])->row_array();
            $x['tk'] = $xtoko['toko_nama'];
        }
        $x['bulan'] = $bulan;
        $this->load->view('admin/laporan/v_lap_jual_perbulan', $x);
    }
    function lap_penjualan_pertahun()
    {
        $tahun = $this->input->post('thn');
        $toko = $this->input->post('toko');
         if($toko=='semua_toko')
        {
            $x['jml'] = $this->m_laporan->get_total_jual_pertahun($tahun);
            $x['data'] = $this->m_laporan->get_jual_pertahun($tahun);
            $x['tk'] = "APOTEK SAMUDRA";
        }else{
            $x['jml'] = $this->m_laporan->get_total_jual_pertahun_toko($tahun,$toko);
            $x['data'] = $this->m_laporan->get_jual_pertahun_toko($tahun,$toko);
            $xtoko = $this->db->get_where('tbl_toko', ['toko_id' => $toko])->row_array();
            $x['tk'] = $xtoko['toko_nama'];
        }
        $x['tahun'] = $tahun;
        $this->load->view('admin/laporan/v_lap_jual_pertahun', $x);
    }
    
    function lap_pembelian_pilihan()
    {
        $dari_tanggal = $this->input->post('dari_tgl');
        $sampai_tanggal = $this->input->post('sampai_tgl');
        $toko = $this->input->post('toko');
        if($toko=='semua_toko')
        {
            $x['jml'] = $this->m_laporan->get_total_lap_beli_pilihan($dari_tanggal,$sampai_tanggal);
            $x['data'] = $this->m_laporan->get_lap_beli_pilihan($dari_tanggal,$sampai_tanggal);
            $x['tk'] = "APOTEK SAMUDRA";
            
        }else{
            $x['jml'] = $this->m_laporan->get_total_lap_beli_pilihan_toko($dari_tanggal,$sampai_tanggal,$toko);
            $x['data'] = $this->m_laporan->get_lap_beli_pilihan_toko($dari_tanggal,$sampai_tanggal,$toko);
            $xtoko = $this->db->get_where('tbl_toko', ['toko_id' => $toko])->row_array();
            $x['tk'] = $xtoko['toko_nama'];
        }
        $x['dari'] = $dari_tanggal;
        $x['sampai'] = $sampai_tanggal;
        $this->load->view('admin/laporan/v_lap_beli_pilihan', $x);
    }
    function lap_tempo_pilihan()
    {
        $dari_tanggal = $this->input->post('dari_tgl');
        $sampai_tanggal = $this->input->post('sampai_tgl');
        $toko = $this->input->post('toko');
        if($toko=='semua_toko')
        {
            $x['jml'] = $this->m_laporan->get_total_lap_tempo_pilihan($dari_tanggal,$sampai_tanggal);
            $x['data'] = $this->m_laporan->get_lap_tempo_pilihan($dari_tanggal,$sampai_tanggal);
            $x['tk'] = "APOTEK SAMUDRA";
            
        }else{
            $x['jml'] = $this->m_laporan->get_total_lap_tempo_pilihan_toko($dari_tanggal,$sampai_tanggal,$toko);
            $x['data'] = $this->m_laporan->get_lap_tempo_pilihan_toko($dari_tanggal,$sampai_tanggal,$toko);
            $xtoko = $this->db->get_where('tbl_toko', ['toko_id' => $toko])->row_array();
            $x['tk'] = $xtoko['toko_nama'];
        }
        $x['dari'] = $dari_tanggal;
        $x['sampai'] = $sampai_tanggal;
        $this->load->view('admin/laporan/v_lap_beli_pilihan', $x);
    }
     function lap_mutasi_pilihan()
    {
        $dari_tanggal = $this->input->post('dari_tgl');
        $sampai_tanggal = $this->input->post('sampai_tgl');
        $x['data'] = $this->m_laporan->get_lap_mutasi_pilihan($dari_tanggal,$sampai_tanggal);
        $this->load->view('admin/laporan/v_lap_mutasi_pilihan', $x);
    }
    
    function lap_laba_rugi()
    {
        $bulan = $this->input->post('bln');
        $x['jml'] = $this->m_laporan->get_total_lap_laba_rugi($bulan);
        $x['data'] = $this->m_laporan->get_lap_laba_rugi($bulan);
        $this->load->view('admin/laporan/v_lap_laba_rugi', $x);
    }
            
    function lap_laba_rugi_pilihan()
    {
        $dari_tanggal = $this->input->post('dari_tgl');
        $sampai_tanggal = $this->input->post('sampai_tgl');
        $toko = $this->input->post('toko');
        if($toko=='semua_toko')
        {
            $x['jml'] = $this->m_laporan->get_total_lap_laba_rugi_pilihan($dari_tanggal,$sampai_tanggal);
            $x['data'] = $this->m_laporan->get_lap_laba_rugi_pilihan($dari_tanggal,$sampai_tanggal);
            $x['tk'] = "APOTEK SAMUDRA";
            
        }else{
            $x['jml'] = $this->m_laporan->get_total_lap_laba_rugi_pilihan_toko($dari_tanggal,$sampai_tanggal,$toko);
            $x['data'] = $this->m_laporan->get_lap_laba_rugi_pilihan_toko($dari_tanggal,$sampai_tanggal,$toko);
            $xtoko = $this->db->get_where('tbl_toko', ['toko_id' => $toko])->row_array();
            $x['tk'] = $xtoko['toko_nama'];
        }
        $x['dari'] = $dari_tanggal;
        $x['sampai'] = $sampai_tanggal;
        $this->load->view('admin/laporan/v_lap_laba_rugi_pilihan', $x);
    }
    function lap_data_service()
    {
        $x['data'] = $this->m_laporan->get_data_service();
        $x['jml'] = $this->m_laporan->get_total_service();
        $this->load->view('admin/laporan/v_lap_service', $x);
    }
    function lap_service_pertanggal()
    {
        $tanggal = $this->input->post('tglservice');
        $x['jml'] = $this->m_laporan->get_data__total_service_pertanggal($tanggal);
        $x['data'] = $this->m_laporan->get_data_service_pertanggal($tanggal);
        $x['tgl'] = $tanggal;
        $this->load->view('admin/laporan/v_lap_service_pertanggal', $x);
    }
    function lap_service_perbulan()
    {
        $bulan = $this->input->post('bln');
        $x['jml'] = $this->m_laporan->get_total_service_perbulan($bulan);
        $x['data'] = $this->m_laporan->get_service_perbulan($bulan);
        $x['bulan'] = $bulan;
        $this->load->view('admin/laporan/v_lap_service_perbulan', $x);
    }
    function lap_service_pertahun()
    {
        $tahun = $this->input->post('thn');
        $x['jml'] = $this->m_laporan->get_total_service_pertahun($tahun);
        $x['data'] = $this->m_laporan->get_service_pertahun($tahun);
        $x['tahun'] = $tahun;
        $this->load->view('admin/laporan/v_lap_service_pertahun', $x);
    }
      function lap_retur_beli_pilihan()
    {
        $dari_tanggal = $this->input->post('dari_tgl');
        $sampai_tanggal = $this->input->post('sampai_tgl');
        $x['data'] = $this->m_laporan->get_lap_retur_beli_pilihan($dari_tanggal,$sampai_tanggal);
        $this->load->view('admin/laporan/v_lap_retur_beli', $x);
    }
      function lap_retur_jual_pilihan()
    {
        $dari_tanggal = $this->input->post('dari_tgl');
        $sampai_tanggal = $this->input->post('sampai_tgl');
        $x['data'] = $this->m_laporan->get_lap_retur_jual_pilihan($dari_tanggal,$sampai_tanggal);
        $this->load->view('admin/laporan/v_lap_retur_jual', $x);
    }
    function lap_bonus()
    {
        $dari_tanggal = $this->input->post('dari_tgl');
        $sampai_tanggal = $this->input->post('sampai_tgl');
        $karyawan = $this->input->post('karyawan');
        
            $x['jml'] = $this->m_laporan->get_total_lap_bonus($dari_tanggal,$sampai_tanggal,$karyawan);
            $x['bns'] = $this->m_laporan->get_lap_bonus_dibayar($dari_tanggal,$sampai_tanggal,$karyawan);
            $x['data'] = $this->m_laporan->get_lap_bonus($dari_tanggal,$sampai_tanggal,$karyawan);
            $xkaryawan = $this->db->get_where('tbl_user', ['user_id' => $karyawan])->row_array();
            $x['krywn'] = $xkaryawan['user_nama'];
        
        $x['dari'] = $dari_tanggal;
        $x['sampai'] = $sampai_tanggal;
        $this->load->view('admin/laporan/v_lap_bonus', $x);
    }
}