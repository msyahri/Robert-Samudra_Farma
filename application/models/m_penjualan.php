<?php
class M_penjualan extends CI_Model
{
    function tampil_cart($idadmin)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_cart_jual WHERE cart_jual_id_admin = '$idadmin'");
		return $hsl;
	}
    function tampil_total_belanja($idadmin)
	{
		$hsl = $this->db->query("SELECT sum(cart_jual_subtotal) as total FROM tbl_cart_jual WHERE cart_jual_id_admin = '$idadmin'");
		return $hsl;
	}
	function hapus_semua_cart($idadmin) 
	{
	    $hasil = $this->db->query("DELETE FROM tbl_cart_jual WHERE cart_jual_id_admin = '$idadmin'");
	    return $hasil;
	}
	function hapus_retur($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
		return $hsl;
	}

	function tampil_retur()
	{
		$hsl = $this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
		return $hsl;
	}

	function simpan_retur($kobar, $nabar, $satuan, $harjul, $qty, $keterangan)
	{
		$hsl = $this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
		return $hsl;
	}
	
	function update_detail_jual($nofak,$id,$qty,$harsrppot)
	{
	    $hasil = $this->db->query("UPDATE tbl_detail_jual SET d_jual_barang_har_srp_pot = '$harsrppot', d_jual_qty = '$qty', d_jual_total = '$harsrppot * $qty' WHERE d_jual_nofak = '$nofak' AND d_jual_barang_id = '$id'");
	    return $hasil;
	}
	
	function update_jual($nofak,$qty,$harsrppot,$tbayar,$qtyOld,$harsrppotOld,$tbayarOld)
	{
	    //selisih
	    $jual_total = ($harsrppot * $qty)-($harsrppotOld * $qtyOld); 
	    
	    $hasil = $this->db->query("UPDATE tbl_jual SET jual_total = jual_total + '$jual_total', jual_jml_uang = '$tbayar', jual_kembalian = '$tbayar' - jual_total WHERE jual_nofak = '$nofak'");
	   
	    return $jual_total;
	}

	function update_barang($id,$harsrppot)
	{
	    $hasil = $this->db->query("UPDATE tbl_barang SET barang_har_srp_pot = '$harsrppot' WHERE barang_id = '$id'");
	   
	    return $jual_total;
	}
	function simpan_penjualan($nofak, $total, $jml_uang, $kembalian)
	{
		$idadmin = $this->session->userdata('idadmin');
		$tgljual = $this->session->userdata('tglfakjual');
		$customer = $this->session->userdata('customer');
		$cara_byr_jual = $this->session->userdata('cara_byr_jual');

		$this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_pembayaran,jual_customer) VALUES ('$nofak','$tgljual','$total','$jml_uang','$kembalian','$idadmin','1','$cara_byr_jual','$customer')");
		
		$cart = $this->m_penjualan->tampil_cart($this->session->userdata('idadmin'));
		foreach ($cart->result_array() as $item) {
			$data = array(
				'd_jual_nofak' 				=>	$nofak,
				'd_jual_barang_id'			=>	$item['cart_jual_imei'],
				'd_jual_barang_har_srp_pot'	=>	$item['cart_jual_harga_jual'],
				'd_jual_barang_har_srp'		=>	$item['cart_jual_harga_srp'],
				'd_jual_qty'				=>	$item['cart_jual_qty'],
				'd_jual_diskon'				=>	$item['cart_jual_diskon'],
				'd_jual_total'				=>	$item['cart_jual_subtotal']
			);
			$this->db->insert('tbl_detail_jual', $data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[cart_jual_qty]' where barang_id='$item[cart_jual_imei]'");
			//ganti status 
// 			$stokbrg = $this->db->query("select barang_stok from tbl_barang where barang_id='$item[id]'");
// 			if($stokbrg =='0'){ 
// 			    $this->db->query("update tbl_barang set status='0' where barang_id='$item[id]'");
// 			};
			
			$this->db->query("update tbl_barang set barang_har_srp_pot='$item[cart_jual_harga_jual]' where barang_id='$item[cart_jual_imei]'");
		}
		return true;
	}
	function get_nofak($tgljual)
	{
		$tgl = substr($tgljual, 8, 2);
		$bln = substr($tgljual, 5, 2);
		$thn = substr($tgljual, 2, 2);
		$date = $tgl . $bln . $thn;
		$tgl = substr($tgljual, 0, 10);
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)='$tgl'");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "000001";
		}
		return $date . $kd;
	}

	//=====================Penjualan grosir================================
	function simpan_penjualan_grosir($nofak, $total, $jml_uang, $kembalian)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','grosir')");
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_har_srp_pot'	=>	$item['harpok'],
				'd_jual_barang_har_srp'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual', $data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}

	function cetak_faktur($nofak)
	{
// 		$nofak = $this->session->userdata('c_nofak');
		$hsl = $this->db->query("SELECT * FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak INNER JOIN tbl_barang ON tbl_detail_jual.d_jual_barang_id = tbl_barang.barang_id INNER JOIN tbl_merek ON tbl_barang.barang_merek_id=tbl_merek.merek_id INNER JOIN tbl_customer ON tbl_customer.customer_id = tbl_jual.jual_customer INNER JOIN tbl_toko ON tbl_toko.toko_id = tbl_barang.toko_id INNER JOIN tbl_user ON tbl_user.user_id = tbl_jual.jual_user_id WHERE jual_nofak='$nofak'");
		return $hsl;
	}

	function tampil_cara_bayar()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_cara_bayar");
		return $hsl;
	}

	function simpan_cara_bayar($nm)
	{
		$hsl = $this->db->query("INSERT INTO tbl_cara_bayar(crbyr_nama) VALUES ('$nm')");
		return $hsl;
	}
	
	function tampil_struk_jual($nofak)
	{
	    $hsl = $this->db->query("SELECT * FROM `tbl_detail_jual` INNER JOIN tbl_barang ON tbl_detail_jual.d_jual_barang_id = tbl_barang.barang_id INNER JOIN tbl_merek ON tbl_barang.barang_merek_id=tbl_merek.merek_id
INNER JOIN tbl_warna ON tbl_barang.barang_warna=tbl_warna.warna_id WHERE tbl_detail_jual.d_jual_nofak = '$nofak'");
		return $hsl; 
	}
	
}
