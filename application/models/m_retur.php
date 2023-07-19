<?php
class M_retur extends CI_Model
{

	function hapus_retur_beli($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_retur_beli WHERE retur_id='$kode'");
		return $hsl;
	}
	function hapus_retur_jual($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_retur_jual WHERE retur_id='$kode'");
		return $hsl;
	}

	function tampil_retur_beli()
	{
		$hsl = $this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_harpok,retur_qty,
		(retur_harpok*retur_qty) AS retur_subtotal,retur_keterangan,nama_merek
		FROM tbl_retur_beli
		JOIN tbl_barang	ON retur_barang_id=barang_id
		JOIN tbl_merek 	ON barang_merek_id=merek_id
		JOIN tbl_toko ON `tbl_barang`.`toko_id`=`tbl_toko`.`toko_id`
		ORDER BY retur_id DESC");
		return $hsl;
	}

	function simpan_retur_beli($kobar, $harpok, $qty, $keterangan)
	{
		$hsl = $this->db->query("INSERT INTO tbl_retur_beli(retur_barang_id,retur_harpok,retur_qty,retur_keterangan) VALUES ('$kobar','$harpok','$qty','$keterangan')");
		return $hsl;
	}
		function update_stok_status($kobar, $qty)
	{
	    $hsl = $this->db->query("UPDATE tbl_barang SET`status`='0',barang_stok=barang_stok-'$qty',barang_tgl_last_update=NOW() WHERE barang_id='$kobar'");
		return $hsl;
	}
	function simpan_retur_jual($kobar, $harjul, $qty, $keterangan)
	{
		$hsl = $this->db->query("INSERT INTO tbl_retur_jual(retur_barang_id,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$harjul','$qty','$keterangan')");
		return $hsl;
	}
		function update_stok_status_jual($kobar, $qty)
	{
	    $hsl = $this->db->query("UPDATE tbl_barang SET barang_stok=barang_stok+'$qty',barang_tgl_last_update=NOW() WHERE barang_id='$kobar'");
		return $hsl;
	}
	
		function update_stok_status_hapus_beli($kobar, $qty)
	{
	    $hsl = $this->db->query("UPDATE tbl_barang SET`status`='1',barang_stok=barang_stok+'$qty',barang_tgl_last_update=NOW() WHERE barang_id='$kobar'");
		return $hsl;
	}
		function update_stok_status_hapus_jual($kobar, $qty)
	{
	    $hsl = $this->db->query("UPDATE tbl_barang SET`status`='1',barang_stok=barang_stok-'$qty',barang_tgl_last_update=NOW() WHERE barang_id='$kobar'");
		return $hsl;
	}
	
}