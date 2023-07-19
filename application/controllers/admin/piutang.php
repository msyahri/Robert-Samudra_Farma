<?php
class Piutang extends CI_Controller
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
		$this->load->model('m_piutang');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
// 			$data['data'] = $this->m_barang->tampil_barang();
// 			$data['retur'] = $this->m_retur->tampil_retur_beli();
			$this->load->view('admin/v_piutang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
		function tabel_piutang()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$this->load->view('admin/v_tbl_piutang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	//get
	public function showPiutang()
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
            0=>'piutang_id',
            1=>'customer_nama',
            2=>'piutang_tempo',
            3=>'piutang_status'
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
        
		$this->db->select('*');
        $this->db->from('tbl_piutang');
        $this->db->join('tbl_jual', 'jual_nofak = piutang_id');
        $this->db->join('tbl_customer', 'customer_id = jual_customer');
        $piutang = $this->db->get();
        $data = array();
        foreach($piutang->result() as $rows)
        {
            $data[]= array(
                $rows->piutang_id,
                $rows->customer_nama,
                $rows->piutang_tempo,
                $rows->piutang_status,
                "<a href='detail_piutang/".$rows->piutang_id."' class='delete_record btn btn-xs btn-success' 
                ><span class='fa fa-edit'> Lihat Detail</span></a>"
            );     
        }
        $total_piutang = $this->totalPiutang();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_piutang,
            "recordsFiltered" => $total_piutang,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    
    public function totalPiutang()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_piutang");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
    
    	function detail_piutang()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
		    $id = $this->uri->segment(4);
			$data['data'] = $this->m_piutang->tampil_detail_piutang($id);
			$data['data_piutang_last'] = $this->m_piutang->tampil_detail_piutang_last($id);
			$data['data_piutang'] = $this->m_piutang->tampil_piutang_by_id($id);
			$this->load->view('admin/v_detail_piutang', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function simpan_retur()
	{
		if ($this->session->userdata('akses') == '1') {
			$kobar = $this->input->post('kode_brg');
			$harpok = str_replace(",", "", $this->input->post('harpok'));
			$qty = $this->input->post('qty');
			$keterangan = $this->input->post('keterangan');
			$this->m_retur->simpan_retur_beli($kobar, $harpok, $qty, $keterangan);
			$this->m_retur->update_stok_status($kobar,$qty);
			
			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil disimpan!</div>');
	        redirect('admin/retur');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function simpan_retur_jual()
	{
		if ($this->session->userdata('akses') == '1') {
			$kobar = $this->input->post('kode_brg');
			$harjul = str_replace(",", "", $this->input->post('harjul'));
			$qty = $this->input->post('qty');
			$keterangan = $this->input->post('keterangan');
			$this->m_retur->simpan_retur_jual($kobar, $harjul, $qty, $keterangan);
			$this->m_retur->update_stok_status_jual($kobar,$qty);
				echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data berhasil disimpan!</div>');
			redirect('admin/retur/retur_penjualan');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function hapus_detail_piutang()
	{
		if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode');
            $kode_piutang = $this->input->post('kode_piutang');
			$this->m_piutang->hapus_detail_piutang($kode);
			$sisa = $this->m_piutang->tampil_detail_piutang_last($kode_piutang)->row_array();
			if($sisa['piutang_sisa']>0){
               $status=0; 
            }else{
                $status=1;
            }
			$this->m_piutang->update_piutang($kode_piutang,$status);
			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Detail piutang berhasil dihapus!</div>');
			redirect('admin/piutang/detail_piutang/'.$kode_piutang);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_detail_piutang()
	{
		if ($this->session->userdata('akses') == '1') {
            $id_piutang = $this->input->post('id_piutang');
            $id_detail = $this->input->post('id');
            $awal = $this->input->post('awal');
            $bayar = $this->input->post('bayar');
            $sisa = $this->input->post('sisa');
            $tgl = $this->input->post('tgl');
			$this->m_piutang->edit_detail_piutang($id_detail,$awal,$bayar,$sisa,$tgl);
			if($sisa>0){
               $status=0; 
            }else{
                $status=1;
            }
			$this->m_piutang->update_piutang($id_piutang,$status);
				echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Detail piutang berhasil diedit!</div>');
			redirect('admin/piutang/detail_piutang/'.$id_piutang);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_detail_piutang()
	{
		if ($this->session->userdata('akses') == '1') {
            $id_piutang = $this->input->post('kode');
            $awal = $this->input->post('awal');
            $bayar = $this->input->post('bayar');
            $sisa = $this->input->post('sisa');
            $tgl = $this->input->post('tgl');
			$this->m_piutang->tambah_detail_piutang($id_piutang,$awal,$bayar,$sisa,$tgl);
			if($sisa>0){
               $status=0; 
            }else{
                $status=1;
            }
			$this->m_piutang->update_piutang($id_piutang,$status);
				echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Detail piutang berhasil disimpan!</div>');
			redirect('admin/piutang/detail_piutang/'.$id_piutang);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function hapus_retur_jual()
	{
		if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode_retur_jual');
            $kobar = $this->input->post('kode_brg_jual');
            $qty = $this->input->post('qty_jual');
			$this->m_retur->hapus_retur_jual($kode);
			$this->m_retur->update_stok_status_hapus_jual($kobar,$qty);
				echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Retur berhasil dibatalkan!</div>');
			redirect('admin/retur/history_retur_jual');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
