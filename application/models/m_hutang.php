<?php
class M_hutang extends CI_Model
{

	function hapus_hutang($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_hutang where hutang_id='$kode'");
		return $hsl;
	}

	function update_hutang($kode, $status)
	{
		$hsl = $this->db->query("UPDATE tbl_hutang set hutang_status='$status'where hutang_id='$kode'");
		return $hsl;
	}

	function tampil_hutang()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_hutang");
		// $hsl = $this->db->query("SELECT * FROM tbl_hutang");
		return $hsl;
	}
	
	function tampil_hutang_by_id($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_hutang INNER JOIN tbl_beli ON tbl_beli.beli_nofak = tbl_hutang.hutang_id INNER JOIN tbl_suplier ON tbl_suplier.suplier_id = tbl_beli.beli_suplier_id where hutang_id='$id'");
		return $hsl;
	}
	
	function tampil_detail_hutang($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_detail_hutang  where hutang_id='$id'");
		// $hsl = $this->db->query("SELECT * FROM tbl_hutang");
		return $hsl;
	}
	function tampil_detail_hutang_last($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_detail_hutang  where hutang_id='$id' order by d_hutang_id desc LIMIT 1");
		// $hsl = $this->db->query("SELECT * FROM tbl_hutang");
		return $hsl;
	}
	
	function hapus_detail_hutang($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_detail_hutang where d_hutang_id='$kode'");
		return $hsl;
	}
	
	function edit_detail_hutang($id_detail,$awal,$bayar,$sisa,$tgl)
	{
		$hsl = $this->db->query("UPDATE tbl_detail_hutang SET hutang_awal='$awal', hutang_bayar='$bayar', hutang_sisa='$sisa', tanggal='$tgl' where d_hutang_id='$id_detail'");
		return $hsl;
	}
	function tambah_detail_hutang($id_hutang,$awal,$bayar,$sisa,$tgl)
	{
		$hsl = $this->db->query("INSERT INTO tbl_detail_hutang (hutang_id,hutang_awal, hutang_bayar, hutang_sisa, tanggal) VALUES ('$id_hutang','$awal','$bayar','$sisa','$tgl')");
		return $hsl;
	}

	function simpan_hutang($nm, $kat)
	{
		$hsl = $this->db->query("INSERT INTO tbl_hutang(nama_hutang, kategori_hutang) VALUES ('$nm','$kat')");
		return $hsl;
	}
}
