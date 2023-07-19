<?php
class M_notifikasi extends CI_Model
{
	function notif_hutang()
	{
	   // $tgl_now=date("Y-m-d");
		$hsl = $this->db->query("SELECT * FROM tbl_hutang");
		return $hsl;
	}
}
