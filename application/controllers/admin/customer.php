<?php

class Customer extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_customer');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
			$data['data'] = $this->m_customer->tampil_customer();
			$this->load->view('admin/v_customer', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	
	public function showCust()
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
            0=>'customer_nama',
            1=>'customer_telp',
            2=>'customer_alamat',
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
        $this->db->from('tbl_customer');
        $tbl_cust = $this->db->get();
        $data = array();
        
        
        foreach($tbl_cust->result() as $rows)
        {
            
            $data[]= array(
                $rows->customer_nama,
                $rows->customer_telp,
                $rows->customer_alamat,
                "<a href='javascript:void(0);' class='edit_record btn btn-xs btn-warning' 
                data-editcustid='".$rows->customer_id."'
                data-editcustnama='".$rows->customer_nama."'
                data-editcusttelp='".$rows->customer_telp."'
                data-editcustalmt='".$rows->customer_alamat."'><span class='fa fa-edit'>Edit</span></a>
                <a href='javascript:void(0);' class='delete_record btn btn-xs btn-danger' 
                data-codecust='".$rows->customer_id."'                
                data-codenama='".$rows->customer_nama."'><span class='fa fa-trash'> Hapus</span></a>"
                );     
        }
        $total_cust = $this->totalCust();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_cust,
            "recordsFiltered" => $total_cust,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function totalCust()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_customer");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
	
	function tambah_customer()
	{
		if ($this->session->userdata('akses') == '1') {
			$nama = $this->input->post('nama');
			$notelp = $this->input->post('notelp');
			$alamat = $this->input->post('alamat');
			
			$cekcustomer=$this->db->query("SELECT customer_telp FROM tbl_customer WHERE customer_telp='$notelp'")->num_rows();
			if ($cekcustomer <= 0) {
			    $this->m_customer->simpan_customer($nama, $notelp, $alamat);
    		    echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data customer berhasil disimpan!</div>');
			} else {
			    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data nomor telepon sudah terdaftar!</div>');
			}
		    redirect('admin/customer');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_customer_jual()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$nama = $this->input->post('nama');
			$notelp = $this->input->post('notelp');
			$alamat = $this->input->post('alamat');
			$this->m_customer->simpan_customer($nama, $notelp, $alamat);
			redirect('admin/penjualan');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_customer()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('cust_id');
			$nama = $this->input->post('cust_nama');
			$notelp = $this->input->post('cust_telp');
			$alamat = $this->input->post('cust_alamat');
			$cekcustomer=$this->db->query("SELECT customer_telp FROM tbl_customer WHERE customer_telp='$notelp' AND customer_id != '$kode'")->num_rows();
			if ($cekcustomer <= 0) {
			    $this->m_customer->update_customer($kode, $nama, $notelp, $alamat);
    			echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Success!</strong> Data customer berhasil diedit!</div>');
			} else {
			     echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data nomor telepon sudah terdaftar!</div>');
			}
			redirect('admin/customer');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_customer()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode_customer');
            $cekterpakai=$this->db->query("SELECT jual_customer FROM tbl_jual WHERE jual_customer='$kode'")->num_rows();
			if ($cekterpakai <= 0) {
			    $this->m_customer->hapus_customer($kode);
    			echo $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Success!</strong> Data customer berhasil dihapus!</div>");
    		} else {
    		    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Failed!</strong> Data customer terpakai tidak dapat dihapus!</div>');
    		}
			redirect('admin/customer');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function export_excel_spreadsheet()
	{
		if ($this->session->userdata('akses') == '1') {
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('A1', 'Hello World !');
			$writer = new Xlsx($spreadsheet);
			$writer->save('hello world.xlsx');
			redirect('admin/customer');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function export_excel()
	{
		if ($this->session->userdata('akses') == '1') {

			$data['customer'] = $this->m_customer->tampil_customer()->result();
			require 'assets\vendor\autoload.php';

			require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
			require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

			$objPHPExcel = new PHPExcel();

			$objPHPExcel->getProperties()->setCreator("APOTEK SAMUDRA");
			$objPHPExcel->getProperties()->setLastModifiedBy("APOTEK SAMUDRA");
			$objPHPExcel->getProperties()->setTitle("Data-Customer");
			$objPHPExcel->getProperties()->setSubject("");
			$objPHPExcel->getProperties()->setDescription("");

			$objPHPExcel->setActiveSheetIndex(0);

			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'No Telp');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Alamat');

			$baris = 2;
			$x = 1;
			foreach ($data['customer'] as $data) {
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $x);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $data->customer_nama);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $data->customer_telp);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $baris, $data->customer_alamat);
				$x++;
				$baris++;
			}
			$filename = date("d-m-Y")  . " Data-Customers" . '.xlsx';
			$objPHPExcel->getActiveSheet()->setTitle("Data Customer");

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="' . $filename . '"');
			header('Cache-Control: max-age=0');

			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$writer->save('php://output');

			exit;
			redirect('admin/customer');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
