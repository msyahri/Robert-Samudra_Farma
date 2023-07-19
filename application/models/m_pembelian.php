<?php
class M_pembelian extends CI_Model
{

	function simpan_pembelian($nofak, $tglfak, $suplier, $cara_byr, $tgl_tempo, $beli_kode, $toko_id)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_beli (beli_nofak,beli_tanggal,beli_suplier_id,beli_user_id,beli_kode, beli_pembayaran, beli_tempo) VALUES ('$nofak','$tglfak','$suplier','$idadmin','$beli_kode','$cara_byr', '$tgl_tempo')");
// 		foreach ($this->cart->contents() as $item) {
		$cart =  $this->db->get_where('tbl_cart', array('cart_nofak' => $nofak));
		foreach ($cart->result_array() as $item) {
			$data = array(
				'barang_id'	=>	$item['cart_imei'],
				'barang_merek_id'	=>	$item['cart_merek_barang_id'],
				'barang_harpok'		=>	$item['cart_harga_pokok'],
				'barang_har_srp'	=>	$item['cart_harga_srp'],
				'barang_harmin'		=>	$item['cart_harga_min'],
				'barang_harmax'		=>	$item['cart_harga_max'],
				'barang_stok'		=>	$item['cart_jumlah'],
				'barang_user_id'	=>	$idadmin,
				'barang_warna'		=>	$item['cart_warna_id'],
				'status'			=>	"1",
				'toko_id'			=>  $toko_id
				//kategoti belum ke isi
			);
			$this->db->insert('tbl_barang', $data);
		}
// 		foreach ($this->cart->contents() as $item) {
// 		$cart =  $this->db->get_where('tbl_cart', array('cart_nofak' => $nofak));
// 		$cart =  $this->db->query("SELECT * FROM tbl_cart WHERE cart_nofak='$nofak'");
		foreach ($cart->result_array() as $item) {
			$data = array(
				'd_beli_nofak' 		=>	$nofak,
				'd_beli_barang_id'	=>	$item['cart_imei'],
				'd_beli_harga'		=>	$item['cart_harga_pokok'],
				'd_beli_jumlah'		=>	$item['cart_jumlah'],
				'd_beli_total'		=>	$item['cart_harga_pokok'] * $item['cart_jumlah'],
				'd_beli_kode'		=>	$beli_kode
			);
			$this->db->insert('tbl_detail_beli', $data);

			// $this->db->query("update tbl_barang set barang_stok=barang_stok+'$item[qty]',barang_harpok='$item[price]',barang_har_srp='$item[harga]' where barang_id='$item[id]'");
		}
		$this->hapus_semua_cart($nofak);
		return true;
	}
	
	function hapus_semua_cart($nofak) 
	{
	    $hasil = $this->db->query("DELETE FROM tbl_cart WHERE cart_nofak = '$nofak'");
	    return $hasil;
	}
	
	function get_kobel()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(beli_kode,6)) AS kd_max FROM tbl_beli WHERE DATE(timestamp)=CURDATE()");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "000001";
		}
		date_default_timezone_set('Asia/Jakarta'); //tambahan set date karena ganti hari tidak tergenerate
		return "BL" . date('dmy') . $kd;
	}
	
	function tampil_cart($nofak) 
	{
	    $hasil = $this->db->query("SELECT * FROM tbl_cart WHERE cart_nofak = '$nofak'");
	    return $hasil;
	}
	function tampil_cart_total($nofak) 
	{
	    $hasil = $this->db->query("SELECT sum(cart_subtotal) as total FROM tbl_cart WHERE cart_nofak = '$nofak'");
	    return $hasil;
	}
	function hapus_cart($id) 
	{
	    $hasil = $this->db->query("DELETE FROM tbl_cart WHERE cart_id = '$id'");
	    return $hasil;
	}
	
	function update_beli($belkod,$nofak,$tgl,$suplier,$pembayaran,$tempo)
	{
	    $hasil = $this->db->query("UPDATE tbl_beli SET beli_nofak = '$nofak', beli_tanggal = '$tgl', beli_suplier_id = '$suplier', beli_pembayaran = '$pembayaran', beli_tempo = '$tempo' WHERE beli_kode = '$belkod'");
	    return $hasil;
	}
	function get_barang_by_nofak($nofak)
	{
	     $hasil = $this->db->query("SELECT *, SUM(d_beli_total) as total FROM tbl_detail_beli WHERE d_beli_nofak = '$nofak'");
	     return $hasil;
	}
	function hapus_tbl_brg($id)
	{
	    $hasil = $this->db->query("DELETE from tbl_barang WHERE barang_id='$id'");
	    return $hasil;
	}
	
	function ambil_data_penjualan($id)
	{
	    $hasil = $this->db->query("SELECT * FROM tbl_detail_jual WHERE d_jual_barang_id = '$id'");
	    return $hasil;
	}
	
	function hapus_tbl_detail_beli($id)
	{
	    $hasil = $this->db->query("DELETE from tbl_detail_beli WHERE d_beli_barang_id='$id'");
	    return $hasil;
	}
	function ambil_detail($belikode)
	{
	    $hasil = $this->db->query("SELECT * FROM tbl_detail_beli WHERE d_beli_kode='$belikode'");
	    return $hasil;
	}
	function hapus_tbl_beli($belikode)
	{
	    $nofakk=$this->db->query("SELECT * FROM tbl_beli WHERE beli_kode='$belikode'")->row_array();
    	            $kd_nofak= $nofakk['beli_nofak'];
	    //echo $nofak;
	    $this->db->query("DELETE from tbl_detail_hutang WHERE hutang_id='$kd_nofak'");
	    $this->db->query("DELETE from tbl_hutang WHERE hutang_id='$kd_nofak'");
	    $hasil=$this->db->query("DELETE from tbl_beli WHERE beli_kode='$belikode'");
	    
	    return $hasil; 
	}
	
	
}
