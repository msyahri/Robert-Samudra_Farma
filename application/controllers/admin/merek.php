<?php
class Merek extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_merek');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
			$data['data'] = $this->m_merek->tampil_merek();
			$this->load->view('admin/v_merek', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	//get
	public function showMerek()
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
            0=>'nama_merek',
            1=>'kategori_merek',
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
        
		$this->db->select('merek_id,nama_merek,kategori_merek');
        $this->db->from('tbl_merek');
        $tbl_brg = $this->db->get();
        $data = array();
        
        foreach($tbl_brg->result() as $rows)
        {
            $data[]= array(
                $rows->nama_merek,
                $rows->kategori_merek,
                "<a href='javascript:void(0);' class='edit_record btn btn-xs btn-warning' 
                data-idmerek='".$rows->merek_id."'
                data-nama='".$rows->nama_merek."'
                data-kat='".$rows->kategori_merek."'><span class='fa fa-edit'>Edit</span></a>
                <a href='javascript:void(0);' class='delete_record btn btn-xs btn-danger' 
                data-codemerek='".$rows->merek_id."'
                data-codenama='".$rows->nama_merek."'><span class='fa fa-trash'> Hapus</span></a>"
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
        $query = $this->db->select("COUNT(*) as num")->get("tbl_merek");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
    
	function tambah_merek()
	{
		if ($this->session->userdata('akses') == '1') {
			$nm = $this->input->post('merek');
			$kat = $this->input->post('kategori');
			 
			$cekmerek=$this->db->query("SELECT nama_merek FROM tbl_merek WHERE nama_merek='$nm'")->num_rows();
			 if ($cekmerek <= 0) {
    			$this->m_merek->simpan_merek($nm, $kat);
    			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data merek berhasil disimpan!</div>');
			 } else {
			     echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data merek sudah terdaftar!</div>');
			 }
			redirect('admin/merek');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_merek2()
	{
		if ($this->session->userdata('akses') == '1') {
			$nm = $this->input->post('merek');
			$kat = $this->input->post('kategori');
			$this->m_merek->simpan_merek($nm, $kat);
			redirect('admin/pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_merek()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('mrk_id');
			$nm = $this->input->post('mrk_nm');
			$kat = $this->input->post('mrk_kat');
			
			$cekmerek=$this->db->query("SELECT nama_merek FROM tbl_merek WHERE nama_merek='$nm' AND merek_id != '$kode'")->num_rows();
			if ($cekmerek <= 0) {
    			$this->m_merek->update_merek($kode, $nm, $kat);
    			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data merek berhasil diedit!</div>');
			} else {
			     echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data merek sudah terdaftar!</div>');
			}
			redirect('admin/merek');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_merek()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode_merek');
			
			$cekterpakai=$this->db->query("SELECT barang_merek_id FROM tbl_barang WHERE barang_merek_id='$kode'")->num_rows();
			
			if ($cekterpakai <= 0) {
    			$this->m_merek->hapus_merek($kode);
    			echo $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Success!</strong> Data merek berhasil dihapus!</div>");
    		} else {
    		    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data merek terpakai tidak dapat dihapus, silahkan cek pembelian!</div>');
    		}
			redirect('admin/merek');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function ubah_handphone()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			$this->m_merek->update_kat($kode);
			redirect('admin/merek');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function ubah_accessories()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');
			$this->m_merek->update_kat2($kode);
			redirect('admin/merek');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
