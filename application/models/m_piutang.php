<?php
class M_piutang extends CI_Model
{

	function hapus_piutang($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_piutang where piutang_id='$kode'");
		return $hsl;
	}

	function update_piutang($kode, $status)
	{
		$hsl = $this->db->query("UPDATE tbl_piutang set piutang_status='$status' where piutang_id='$kode'");
		return $hsl;
	}

	function tampil_piutang()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_piutang");
		// $hsl = $this->db->query("SELECT * FROM tbl_piutang");
		return $hsl;
	}
	
	function tampil_piutang_by_id($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_piutang INNER JOIN tbl_beli ON tbl_beli.beli_nofak = tbl_piutang.piutang_id INNER JOIN tbl_suplier ON tbl_suplier.suplier_id = tbl_beli.beli_suplier_id where piutang_id='$id'");
		return $hsl;
	}
	
	function tampil_detail_piutang($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_detail_piutang  where piutang_id='$id'");
		// $hsl = $this->db->query("SELECT * FROM tbl_piutang");
		return $hsl;
	}
	function tampil_detail_piutang_last($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_detail_piutang  where piutang_id='$id' order by d_piutang_id desc LIMIT 1");
		// $hsl = $this->db->query("SELECT * FROM tbl_piutang");
		return $hsl;
	}
	
	function hapus_detail_piutang($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_detail_piutang where d_piutang_id='$kode'");
		return $hsl;
	}
	
	function edit_detail_piutang($id_detail,$awal,$bayar,$sisa,$tgl)
	{
		$hsl = $this->db->query("UPDATE tbl_detail_piutang SET piutang_awal='$awal', piutang_bayar='$bayar', piutang_sisa='$sisa', tanggal='$tgl' where d_piutang_id='$id_detail'");
		return $hsl;
	}
	function tambah_detail_piutang($id_piutang,$awal,$bayar,$sisa,$tgl)
	{
		$hsl = $this->db->query("INSERT INTO tbl_detail_piutang (piutang_id,piutang_awal, piutang_bayar, piutang_sisa, tanggal) VALUES ('$id_piutang','$awal','$bayar','$sisa','$tgl')");
		return $hsl;
	}

	function simpan_piutang($nm, $kat)
	{
		$hsl = $this->db->query("INSERT INTO tbl_piutang(nama_piutang, kategori_piutang) VALUES ('$nm','$kat')");
		return $hsl;
	}
}
