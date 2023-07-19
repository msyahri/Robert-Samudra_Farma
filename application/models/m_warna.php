<?php
class M_warna extends CI_Model
{

	function hapus_warna($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_warna where warna_id='$kode'");
		return $hsl;
	}

	function update_warna($kode, $nm)
	{
		$hsl = $this->db->query("UPDATE tbl_warna set warna='$nm' where warna_id='$kode'");
		return $hsl;
	}

	function tampil_warna()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_warna order by warna asc");
		// $hsl = $this->db->query("SELECT * FROM tbl_warna");
		return $hsl;
	}

	function tampil_warna_by_id($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_warna where warna_id='$id' order by warna asc");
		return $hsl;
	}

	function simpan_warna($nm)
	{
		$hsl = $this->db->query("INSERT INTO tbl_warna(warna) VALUES ('$nm')");
		return $hsl;
	}
}
