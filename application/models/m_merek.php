<?php
class M_merek extends CI_Model
{

	function hapus_merek($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_merek where merek_id='$kode'");
		return $hsl;
	}

	function update_merek($kode, $nm, $kat)
	{
		$hsl = $this->db->query("UPDATE tbl_merek set nama_merek='$nm', kategori_merek='$kat' where merek_id='$kode'");
		return $hsl;
	}

	function tampil_merek()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_merek order by nama_merek asc");
		// $hsl = $this->db->query("SELECT * FROM tbl_merek");
		return $hsl;
	}

	function tampil_merek_by_id($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_merek where merek_id='$id'");
		return $hsl;
	}

	function simpan_merek($nm, $kat)
	{
		$hsl = $this->db->query("INSERT INTO tbl_merek(nama_merek, kategori_merek) VALUES ('$nm','$kat')");
		return $hsl;
	}
}
