<?php
class Retur extends CI_Controller
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
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
// 			$data['data'] = $this->m_barang->tampil_barang();
// 			$data['retur'] = $this->m_retur->tampil_retur_beli();
			$this->load->view('admin/v_retur');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function retur_penjualan()
	{
        if ($this->session->userdata('akses') == '1') {
			$this->load->view('admin/v_retur_penjualan');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	
	//get
	public function showRetur()
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
            0=>'retur_tanggal',
            1=>'retur_barang_id',
            2=>'nama_merek',
            3=>'retur_harpok',
            4=>'retur_qty',
            5=>'retur_subtotal',
            6=>'retur_keterangan',
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
        
		$this->db->select('*,(retur_harpok*retur_qty) as retur_subtotal');
        $this->db->from('tbl_retur_beli');
        $this->db->join('tbl_barang', 'barang_id = retur_barang_id');
        $this->db->join('tbl_merek', 'merek_id = barang_merek_id');
        $retur_b = $this->db->get();
        $data = array();
        foreach($retur_b->result() as $rows)
        {
            $data[]= array(
                $rows->retur_tanggal,
                $rows->retur_barang_id,
                $rows->nama_merek,
                $rows->retur_harpok,
                $rows->retur_qty,
                $rows->retur_subtotal,
                $rows->retur_keterangan,
                "<a href='javascript:void(0);' class='delete_record btn btn-xs btn-danger' 
                data-coderetur='".$rows->retur_id."'
                data-codeimei='".$rows->retur_barang_id."'
                data-codeqty='".$rows->retur_qty."'><span class='fa fa-close'> Batal</span></a>"
            );     
        }
        $total_retur_b = $this->totalReturB();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_retur_b,
            "recordsFiltered" => $total_retur_b,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function totalReturB()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_retur_beli");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
    // --------------------------------------------------------------------------------------------------
    
    //get
	public function showReturJual()
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
            0=>'retur_tanggal',
            1=>'retur_barang_id',
            2=>'nama_merek',
            3=>'retur_harjul',
            4=>'retur_qty',
            5=>'retur_subtotal',
            6=>'retur_keterangan',
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
        
		$this->db->select('*,(retur_harjul*retur_qty) as retur_subtotal');
        $this->db->from('tbl_retur_jual');
        $this->db->join('tbl_barang', 'barang_id = retur_barang_id');
        $this->db->join('tbl_merek', 'merek_id = barang_merek_id');
        $retur_j = $this->db->get();
        $data = array();
        foreach($retur_j->result() as $rows)
        {
            $data[]= array(
                $rows->retur_tanggal,
                $rows->retur_barang_id,
                $rows->nama_merek,
                $rows->retur_harjul,
                $rows->retur_qty,
                $rows->retur_subtotal,
                $rows->retur_keterangan,
                "<a href='javascript:void(0);' class='delete_record btn btn-xs btn-danger' 
                data-codereturjual='".$rows->retur_id."'
                data-codeimeijual='".$rows->retur_barang_id."'
                data-codeqtyjual='".$rows->retur_qty."'><span class='fa fa-close'> Batal</span></a>"
            );     
        }
        $total_retur_j = $this->totalReturJ();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_retur_j,
            "recordsFiltered" => $total_retur_j,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function totalReturJ()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_retur_jual");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
    // --------------------------------------------------------------------------------------------------
    
	function history_retur()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$data['data'] = $this->m_barang->tampil_barang();
			$data['retur'] = $this->m_retur->tampil_retur_beli();
			$this->load->view('admin/v_history_retur', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function history_retur_jual()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$data['data'] = $this->m_barang->tampil_barang();
			$data['retur'] = $this->m_retur->tampil_retur_beli();
			$this->load->view('admin/v_history_retur_jual', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	function get_barang()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kobar = $this->input->post('kode_brg');
			$x['brg'] = $this->m_barang->get_barang($kobar);
			$this->load->view('admin/v_detail_barang_retur', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function get_barang_jual()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kobar = $this->input->post('kode_brg');
			$x['brg'] = $this->m_barang->get_barang_jual($kobar);
			$this->load->view('admin/v_detail_barang_retur_jual', $x);
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

	function hapus_retur()
	{
		if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode_retur');
            $kobar = $this->input->post('kode_brg');
            $qty = $this->input->post('qty');
			$this->m_retur->hapus_retur_beli($kode);
			$this->m_retur->update_stok_status_hapus_beli($kobar,$qty);
				echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Retur berhasil dibatalkan!</div>');
			redirect('admin/retur/history_retur');
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
