<?php
class Mlogin extends CI_Model
{
    function cekadmin($u, $p, $l)
    {
        $hasil = $this->db->query("select * from tbl_user where user_username='$u'and user_password=md5('$p') and user_level='$l' and user_status=1");
        return $hasil;
    }
    function gettoko()
    {
        $hasil = $this->db->get('tbl_toko');
        return $hasil;
    }
    function getuser()
    {
        $hasil = $this->db->get('tbl_user');
        return $hasil;
    }
    function getTokoById($id)
    {
        $hasil = $this->db->get_where('tbl_toko', ['toko_id' => $id]);
        return $hasil;
    }
}
