<?php
class M_customer extends CI_Model
{

	function hapus_customer($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_customer where customer_id='$kode'");
		return $hsl;
	}

	function update_customer($kode, $nama,  $notelp, $alamat)
	{
		$hsl = $this->db->query("UPDATE tbl_customer set customer_nama='$nama',customer_telp='$notelp',customer_alamat='$alamat' where customer_id='$kode'");
		return $hsl;
	}

	function tampil_customer()
	{
		$hsl = $this->db->query("select * from tbl_customer order by customer_id desc");
		return $hsl;
	}

	function tampil_customer_by_id($id)
	{
		$hsl = $this->db->get_where('tbl_customer', ['customer_id' => $id]);
		return $hsl;
	}

	function simpan_customer($nama, $notelp, $alamat)
	{
		$hsl = $this->db->query("INSERT INTO tbl_customer(customer_nama,customer_telp,customer_alamat) VALUES ('$nama','$notelp','$alamat')");
		return $hsl;
	}
}
