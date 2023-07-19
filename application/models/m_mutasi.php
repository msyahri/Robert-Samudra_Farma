<?php
class M_mutasi extends CI_Model
{
    function hapus_barang($kode)
    {
        $hsl = $this->db->query("DELETE FROM tbl_barang where barang_id='$kode'");
        return $hsl;
    }

    function update_barang($kobar,$toko)
    {
        $user_id = $this->session->userdata('idadmin');
        $hsl = $this->db->query("UPDATE tbl_barang SET toko_id='$toko',barang_tgl_last_update=NOW(),barang_user_id='$user_id' WHERE barang_id='$kobar'");
        return $hsl;
    }

    function add_mutasi($kobar, $toko, $tokoasal)
    {
        // $user_id = $this->session->userdata('idadmin');
        $hsl = $this->db->query("INSERT INTO tbl_mutasi (mutasi_imei,mutasi_toko_asal,mutasi_toko_tujuan) VALUES ('$kobar','$tokoasal','$toko')");
        return $hsl;
    }


    function tampil_barang()
    {
        $hsl = $this->db->query("SELECT barang_id,barang_satuan,barang_harpok,barang_har_srp,barang_harmin,barang_harmax,barang_har_srp_pot,barang_stok,barang_min_stok,barang_merek_id,nama_merek,warna,barang_warna,`tbl_barang`.`toko_id`,toko_nama,`status`,kategori_merek
		FROM tbl_barang 
		JOIN tbl_merek 	ON barang_merek_id=merek_id
		JOIN tbl_toko 	ON `tbl_barang`.`toko_id`=`tbl_toko`.`toko_id`
		JOIN tbl_warna 	ON barang_warna=warna_id
		WHERE `status`=1");
        return $hsl;
    }
    function tampil_barang_histori()
    {
        $hsl = $this->db->query("SELECT mutasi_imei,mutasi_toko_asal,mutasi_toko_tujuan,mutasi_tanggal,barang_merek_id,nama_merek,`tbl_barang`.`toko_id`,toko_nama as toko_tujuan
		FROM tbl_mutasi
        JOIN tbl_barang ON mutasi_imei=`tbl_barang`.`barang_id`
        JOIN tbl_merek 	ON barang_merek_id=merek_id
        JOIN tbl_toko  ON mutasi_toko_tujuan =`tbl_toko`.`toko_id`");
        return $hsl;
    }
    function simpan_barang($kobar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok)
    {
        $user_id = $this->session->userdata('idadmin');
        $hsl = $this->db->query("INSERT INTO tbl_barang (barang_id,,barang_satuan,barang_harpok,barang_har_srp,barang_har_srp_pot,barang_stok,barang_min_stok,barang_merek_id,barang_user_id) VALUES ('$kobar','$satuan','$harpok','$harjul','$harjul_grosir','$stok','$min_stok','$kat','$user_id')");
        return $hsl;
    }

    function tampil_warna()
    {
        $hsl = $this->db->query("SELECT * FROM tbl_warna");
        return $hsl;
    }

    function tampil_warna_by_id($id)
    {
        $hsl = $this->db->query("SELECT * FROM tbl_warna where warna_id='$id'");
        return $hsl;
    }

    function get_barang($kobar)
    {
        // $hsl = $this->db->query("SELECT * FROM tbl_barang where barang_id='$kobar'");
        $hsl = $this->db->query("SELECT barang_id,barang_satuan,barang_harpok,barang_har_srp,barang_harmin,barang_harmax,barang_har_srp_pot,barang_stok,barang_min_stok,barang_merek_id,nama_merek,warna,barang_warna,`tbl_barang`.`toko_id`,toko_nama,`status`,kategori_merek
		FROM tbl_barang 
		JOIN tbl_merek 	ON barang_merek_id=merek_id
		JOIN tbl_toko 	ON `tbl_barang`.`toko_id`=`tbl_toko`.`toko_id`
		JOIN tbl_warna 	ON barang_warna=warna_id
		WHERE `status`=1 AND barang_id=$kobar");
        return $hsl;
    }

    function get_kobar()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(barang_id,6)) AS kd_max FROM tbl_barang");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        return "BR" . $kd;
    }
}
