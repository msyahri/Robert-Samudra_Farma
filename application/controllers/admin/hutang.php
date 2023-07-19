<?php
class Hutang extends CI_Controller
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
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
// 			$data['data'] = $this->m_barang->tampil_barang();
// 			$data['retur'] = $this->m_retur->tampil_retur_beli();
			$this->load->view('admin/v_hutang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
		function tabel_hutang()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$this->load->view('admin/v_tbl_hutang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	//get
	public function showHutang()
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
            0=>'hutang_id',
            1=>'hutang_tempo',
            2=>'hutang_status'
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
        $this->db->from('tbl_hutang');
        // $this->db->join('tbl_detail_hutang', 'hutang_id = hutang_id');
        $hutang = $this->db->get();
        $data = array();
        foreach($hutang->result() as $rows)
        {
            
            $data[]= array(
                $idddd=$rows->hutang_id,
                $rows->hutang_tempo,
                $rows->hutang_status,
                
                "<form id='add-row-form' action='".base_url('admin/hutang/detail_hutang')."' method='post'><input type='hidden' name='hutang_id' value='".$rows->hutang_id."'><button type='submit' class='delete_record btn btn-xs btn-success'><span class='fa fa-edit'> Lihat Detail</span></button></form>"
                // $this->session->set_flashdata('iduntukdetaihutang', $idddd). 
                // "<a href='detail_hutang/' class='delete_record btn btn-xs btn-success' 
                // ><span class='fa fa-edit'> Lihat Detail</span></a>"
            );     
        }
        $total_hutang = $this->totalHutang();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_hutang,
            "recordsFiltered" => $total_hutang,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    
    public function totalHutang()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_hutang");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
    
    	function detail_hutang()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
		    if(empty($this->input->post('hutang_id')))
		    {
		        $id = $this->session->userdata('iduntukdetaihutang');
		    } else 
		    {
		        $id = $this->input->post('hutang_id');
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

	function hapus_detail_hutang()
	{
		if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode');
            $kode_hutang = $this->input->post('kode_hutang');
			$this->m_hutang->hapus_detail_hutang($kode);
			$sisa = $this->m_hutang->tampil_detail_hutang_last($kode_hutang)->row_array();
			if($sisa['hutang_sisa']>0){
               $status=0; 
            }else{
                $status=1;
            }
			$this->m_hutang->update_hutang($kode_hutang,$status);
			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Detail hutang berhasil dihapus!</div>');
			$this->session->set_flashdata('iduntukdetaihutang', $kode_hutang);
			redirect('admin/hutang/detail_hutang/');
			
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_detail_hutang()
	{
		if ($this->session->userdata('akses') == '1') {
            $id_hutang = $this->input->post('id_hutang');
            $id_detail = $this->input->post('id');
            $awal = $this->input->post('awal');
            $bayar = $this->input->post('bayar');
            $sisa = $this->input->post('sisa');
            $tgl = $this->input->post('tgl');
			$this->m_hutang->edit_detail_hutang($id_detail,$awal,$bayar,$sisa,$tgl);
			if($sisa>0){
               $status=0; 
            }else{
                $status=1;
            }
			$this->m_hutang->update_hutang($id_hutang,$status);
				echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Detail hutang berhasil diedit!</div>');
			$this->session->set_flashdata('iduntukdetaihutang', $id_hutang);	
			redirect('admin/hutang/detail_hutang/');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_detail_hutang()
	{
		if ($this->session->userdata('akses') == '1') {
            $id_hutang = $this->input->post('kode');
            $awal = $this->input->post('awal');
            $bayar = $this->input->post('bayar');
            $sisa = $this->input->post('sisa');
            $tgl = $this->input->post('tgl');
            
			$this->m_hutang->tambah_detail_hutang($id_hutang,$awal,$bayar,$sisa,$tgl);
			if($sisa>0){
               $status=0; 
            }else{
                $status=1;
            }
			$this->m_hutang->update_hutang($id_hutang,$status);
				echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Detail hutang berhasil disimpan!</div>');
			$this->session->set_userdata('iduntukdetaihutang', $id_hutang);
			redirect('admin/hutang/detail_hutang/');
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
