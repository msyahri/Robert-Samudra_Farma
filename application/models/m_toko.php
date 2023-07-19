<?php
class M_toko extends CI_Model
{
    function tampil_toko()
    {
        $hsl = $this->db->query("SELECT * FROM tbl_toko");
        // $hsl = $this->db->query("SELECT * FROM tbl_merek");
        return $hsl;
    }
}
