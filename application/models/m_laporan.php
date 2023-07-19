<?php
class M_laporan extends CI_Model
{
    function get_stok_barang()
    {

        $hsl = $this->db->query("SELECT merek_id,nama_merek,COUNT(barang_stok) as tot_stok,toko_nama,warna FROM tbl_barang JOIN tbl_merek ON barang_merek_id=merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_warna ON barang_warna=warna_id GROUP BY tbl_barang.barang_merek_id,tbl_barang.barang_warna,tbl_barang.toko_id ORDER BY nama_merek ASC");
        return $hsl;
    }
    function get_data_barang()
    {
        $hsl = $this->db->query("SELECT merek_id,barang_id,nama_merek,barang_satuan,barang_har_srp,barang_stok,toko_nama,warna FROM tbl_barang JOIN tbl_merek ON barang_merek_id=merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_warna ON barang_warna=warna_id");
        return $hsl;
    }
    function get_data_barang_pertoko($toko)
    {
        $hsl = $this->db->query("SELECT merek_id,barang_id,nama_merek,barang_satuan,barang_har_srp,barang_stok,toko_nama,warna FROM tbl_barang JOIN tbl_merek ON barang_merek_id=merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_warna ON barang_warna=warna_id WHERE tbl_barang.toko_id='$toko' ORDER BY barang_stok DESC");
        return $hsl;
    }
    function get_data_so_pertoko($toko)
    {
        $hsl = $this->db->query("SELECT merek_id,barang_id,nama_merek,barang_satuan,barang_har_srp,barang_stok,toko_nama,warna FROM tbl_barang JOIN tbl_merek ON barang_merek_id=merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_warna ON barang_warna=warna_id WHERE tbl_barang.toko_id='$toko' AND barang_stok != 0 AND status ='1' ");
        return $hsl;
    }
    function get_data_aset_pertoko($toko)
    {
        $hsl = $this->db->query("SELECT merek_id,barang_id,nama_merek,barang_satuan,barang_harpok,barang_har_srp,barang_stok,toko_nama,warna FROM tbl_barang JOIN tbl_merek ON barang_merek_id=merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_warna ON barang_warna=warna_id WHERE tbl_barang.toko_id='$toko' AND barang_stok != 0");
        return $hsl;
    }
    function get_data_total_aset_pertoko($toko)
    {
        $hsl = $this->db->query("SELECT merek_id,barang_id,nama_merek,barang_satuan,barang_harpok,SUM(barang_harpok) AS total,barang_har_srp,barang_stok,toko_nama,warna FROM tbl_barang JOIN tbl_merek ON barang_merek_id=merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_warna ON barang_warna=warna_id WHERE tbl_barang.toko_id='$toko' AND barang_stok != 0");
        return $hsl;
    }
    function get_data_penjualan()
    {
        $hsl = $this->db->query("SELECT user_nama,toko_nama, jual_nofak,customer_nama,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id= tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_total_penjualan()
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_data_jual_pertanggal($tanggal)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE DATE(jual_tanggal)='$tanggal' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_data__total_jual_pertanggal($tanggal)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE DATE(jual_tanggal)='$tanggal' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_data_jual_pertanggal_toko($tanggal, $toko)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE DATE(jual_tanggal)='$tanggal' AND tbl_barang.toko_id='$toko' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_data__total_jual_pertanggal_toko($tanggal, $toko)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek,sum(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE DATE(jual_tanggal)='$tanggal' AND tbl_barang.toko_id='$toko' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_bulan_jual()
    {
        $hsl = $this->db->query("SELECT DISTINCT DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan FROM tbl_jual");
        return $hsl;
    }
    function get_tahun_jual()
    {
        $hsl = $this->db->query("SELECT DISTINCT YEAR(jual_tanggal) AS tahun FROM tbl_jual");
        return $hsl;
    }
    function get_jual_perbulan($bulan)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,nama_merek,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_total_jual_perbulan($bulan)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_jual_perbulan_toko($bulan, $toko)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,nama_merek,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' AND tbl_barang.toko_id='$toko' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_total_jual_perbulan_toko($bulan, $toko)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek,sum(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' AND tbl_barang.toko_id='$toko' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_jual_pertahun($tahun)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE YEAR(jual_tanggal)='$tahun' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_total_jual_pertahun($tahun)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,jual_nofak,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE YEAR(jual_tanggal)='$tahun' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_jual_pertahun_toko($tahun, $toko)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE YEAR(jual_tanggal)='$tahun' AND tbl_barang.toko_id='$toko' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_total_jual_pertahun_toko($tahun, $toko)
    {
        $hsl = $this->db->query("SELECT user_nama,customer_nama,toko_nama,jual_nofak,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_har_srp_pot,d_jual_barang_har_srp,d_jual_qty,d_jual_diskon,d_jual_total,nama_merek,sum(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_user ON tbl_user.user_id=tbl_jual.jual_user_id JOIN tbl_customer ON jual_customer = customer_id WHERE YEAR(jual_tanggal)='$tahun' AND tbl_barang.toko_id='$toko' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    //=========Laporan Laba rugi============
    function get_lap_laba_rugi($bulan)
    {
        $hsl = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%d %M %Y ') as jual_tanggal,nama_merek,d_jual_barang_har_srp_pot,barang_harpok,(d_jual_barang_har_srp_pot-barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,((d_jual_barang_har_srp_pot-barang_harpok)*d_jual_qty) AS untung_bersih FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id WHERE tbl_barang.status ='1' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
        return $hsl;
    }
    function get_total_lap_laba_rugi($bulan)
    {
        $hsl = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,barang_harpok,d_jual_barang_har_srp_pot,(d_jual_barang_har_srp_pot-barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,SUM(((d_jual_barang_har_srp_pot-barang_harpok)*d_jual_qty)) AS total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id WHERE tbl_barang.status ='1' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
        return $hsl;
    }

    function get_lap_beli_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT toko_nama,beli_nofak, DATE_FORMAT(beli_tanggal,'%d %M %Y ') as beli_tanggal,nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,IF(beli_tempo=0000-00-00,'-',beli_tempo) as beli_tempo,d_beli_barang_id,suplier_nama FROM tbl_beli JOIN tbl_detail_beli ON beli_kode=d_beli_kode JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE beli_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY beli_nofak DESC");
        return $hsl;
    }
    function get_total_lap_beli_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT toko_nama,beli_nofak, DATE_FORMAT(beli_tanggal,'%d %M %Y ') as beli_tanggal,nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,IF(beli_tempo=0000-00-00,'-',beli_tempo) as beli_tempo,d_beli_barang_id,suplier_nama,SUM(d_beli_total) AS total FROM tbl_beli JOIN tbl_detail_beli ON beli_kode=d_beli_kode JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE beli_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY beli_nofak DESC");
        return $hsl;
    }
    function get_lap_beli_pilihan_toko($dari_tgl, $sampai_tgl, $toko)
    {
        $hsl = $this->db->query("SELECT toko_nama,beli_nofak, DATE_FORMAT(beli_tanggal,'%d %M %Y ') as beli_tanggal,nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,IF(beli_tempo=0000-00-00,'-',beli_tempo) as beli_tempo,d_beli_barang_id,suplier_nama FROM tbl_beli JOIN tbl_detail_beli ON beli_kode=d_beli_kode JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE tbl_barang.toko_id='$toko' AND beli_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY beli_nofak DESC");
        return $hsl;
    }
    function get_total_lap_beli_pilihan_toko($dari_tgl, $sampai_tgl, $toko)
    {
        $hsl = $this->db->query("SELECT toko_nama,beli_nofak, DATE_FORMAT(beli_tanggal,'%d %M %Y ') as beli_tanggal,nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,IF(beli_tempo=0000-00-00,'-',beli_tempo) as beli_tempo,d_beli_barang_id,suplier_nama,SUM(d_beli_total) AS total FROM tbl_beli JOIN tbl_detail_beli ON beli_kode=d_beli_kode JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE tbl_barang.toko_id='$toko' AND beli_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY beli_nofak DESC");
        return $hsl;
    }
     function get_lap_tempo_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT toko_nama,beli_nofak, DATE_FORMAT(beli_tanggal,'%d %M %Y ') as beli_tanggal,nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,IF(beli_tempo=0000-00-00,'-',beli_tempo) as beli_tempo,d_beli_barang_id,suplier_nama FROM tbl_beli JOIN tbl_detail_beli ON beli_kode=d_beli_kode JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE  beli_tempo!='NULL' AND beli_tempo BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY beli_nofak DESC");
        return $hsl;
    }
    function get_total_lap_tempo_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT toko_nama,beli_nofak, DATE_FORMAT(beli_tanggal,'%d %M %Y ') as beli_tanggal,nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,IF(beli_tempo=0000-00-00,'-',beli_tempo) as beli_tempo,d_beli_barang_id,suplier_nama,SUM(d_beli_total) AS total FROM tbl_beli JOIN tbl_detail_beli ON beli_kode=d_beli_kode JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE  beli_tempo!='NULL' AND beli_tempo BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY beli_nofak DESC");
        return $hsl;
    }
    function get_lap_tempo_pilihan_toko($dari_tgl, $sampai_tgl, $toko)
    {
        $hsl = $this->db->query("SELECT toko_nama,beli_nofak, DATE_FORMAT(beli_tanggal,'%d %M %Y ') as beli_tanggal,nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,IF(beli_tempo=0000-00-00,'-',beli_tempo) as beli_tempo,d_beli_barang_id,suplier_nama FROM tbl_beli JOIN tbl_detail_beli ON beli_kode=d_beli_kode JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE  beli_tempo!='NULL' AND tbl_barang.toko_id='$toko' AND beli_tempo BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY beli_nofak DESC");
        return $hsl;
    }
    function get_lap_mutasi_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT mutasi_imei,mutasi_toko_asal, mutasi_toko_tujuan, mutasi_tanggal, barang_merek_id, nama_merek, `tbl_barang`.`toko_id`, toko_nama as toko_tujuan
		FROM tbl_mutasi
        JOIN tbl_barang ON mutasi_imei=`tbl_barang`.`barang_id`
        JOIN tbl_merek 	ON barang_merek_id=merek_id
        JOIN tbl_toko  ON mutasi_toko_tujuan =`tbl_toko`.`toko_id` WHERE mutasi_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl'");
        return $hsl;
    }
    function get_total_lap_tempo_pilihan_toko($dari_tgl, $sampai_tgl, $toko)
    {
        $hsl = $this->db->query("SELECT toko_nama,beli_nofak, DATE_FORMAT(beli_tanggal,'%d %M %Y ') as beli_tanggal,nama_merek,d_beli_harga,d_beli_jumlah,d_beli_total,beli_pembayaran,IF(beli_tempo=0000-00-00,'-',beli_tempo) as beli_tempo,d_beli_barang_id,suplier_nama,SUM(d_beli_total) AS total FROM tbl_beli JOIN tbl_detail_beli ON beli_kode=d_beli_kode JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE  beli_tempo!='NULL' AND tbl_barang.toko_id='$toko' AND beli_tempo BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY beli_nofak DESC");
        return $hsl;
    }
    function get_lap_laba_rugi_pilihan_toko($dari_tgl, $sampai_tgl, $toko)
    {
        $hsl = $this->db->query("SELECT toko_nama,jual_nofak, DATE_FORMAT(jual_tanggal,'%d %M %Y ') as jual_tanggal,nama_merek,d_jual_barang_har_srp_pot,barang_harpok,(d_jual_barang_har_srp_pot-barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,((d_jual_barang_har_srp_pot-barang_harpok)*d_jual_qty) AS untung_bersih FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id WHERE tbl_barang.status ='1' AND tbl_barang.toko_id='$toko' AND jual_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_total_lap_laba_rugi_pilihan_toko($dari_tgl, $sampai_tgl, $toko)
    {
        $hsl = $this->db->query("SELECT toko_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,barang_harpok,d_jual_barang_har_srp_pot,(d_jual_barang_har_srp_pot-barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,SUM((d_jual_barang_har_srp_pot-barang_harpok)*d_jual_qty) AS total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id WHERE tbl_barang.status ='1' AND tbl_barang.toko_id='$toko' AND jual_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_lap_laba_rugi_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT toko_nama,jual_nofak, DATE_FORMAT(jual_tanggal,'%d %M %Y ') as jual_tanggal,nama_merek,d_jual_barang_har_srp_pot,barang_harpok,(d_jual_barang_har_srp_pot-barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,((d_jual_barang_har_srp_pot-barang_harpok)*d_jual_qty) AS untung_bersih FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id WHERE tbl_barang.status ='1' AND jual_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY jual_nofak DESC");
        return $hsl;
    }
    function get_total_lap_laba_rugi_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT toko_nama,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,barang_harpok,d_jual_barang_har_srp_pot,(d_jual_barang_har_srp_pot-barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,SUM((d_jual_barang_har_srp_pot-barang_harpok)*d_jual_qty) AS total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_merek ON tbl_merek.merek_id=tbl_barang.barang_merek_id JOIN tbl_toko ON tbl_barang.toko_id= tbl_toko.toko_id WHERE tbl_barang.status ='1' AND jual_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl' ORDER BY jual_nofak DESC");
        return $hsl;
    }

    function get_data_service()
    {
        $hsl = $this->db->query("SELECT * ,service_nofak,DATE_FORMAT(service_tanggal,'%d %M %Y') AS service_tanggal,service_total,service_dp,service_kekurangan,d_service_id,d_service_nama,d_service_barang_har_srp_pot,d_service_qty,d_service_total FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak ORDER BY service_nofak DESC");
        return $hsl;
    }
    function get_total_service()
    {
        $hsl = $this->db->query("SELECT * ,service_nofak,DATE_FORMAT(service_tanggal,'%d %M %Y') AS service_tanggal,service_total,service_dp,service_kekurangan,d_service_id,d_service_nama,d_service_barang_har_srp_pot,d_service_qty,d_service_total,sum(d_service_total) as total FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak ORDER BY service_nofak DESC");
        return $hsl;
    }
    function get_data_service_pertanggal($tanggal)
    {
        $hsl = $this->db->query("SELECT * ,service_nofak,DATE_FORMAT(service_tanggal,'%d %M %Y') AS service_tanggal,service_total,service_dp,service_kekurangan,d_service_id,d_service_nama,d_service_barang_har_srp_pot,d_service_qty,d_service_total FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak  WHERE DATE(service_tanggal)='$tanggal' ORDER BY service_nofak DESC");
        return $hsl;
    }
    function get_data__total_service_pertanggal($tanggal)
    {
        $hsl = $this->db->query("SELECT * ,service_nofak,DATE_FORMAT(service_tanggal,'%d %M %Y') AS service_tanggal,service_total,service_dp,service_kekurangan,d_service_id,d_service_nama,d_service_barang_har_srp_pot,d_service_qty,d_service_total,sum(d_service_total) as total FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak WHERE DATE(service_tanggal)='$tanggal' ORDER BY service_nofak DESC");
        return $hsl;
    }
    function get_bulan_service()
    {
        $hsl = $this->db->query("SELECT DISTINCT DATE_FORMAT(service_tanggal,'%M %Y') AS bulan FROM tbl_service");
        return $hsl;
    }
    function get_tahun_service()
    {
        $hsl = $this->db->query("SELECT DISTINCT YEAR(service_tanggal) AS tahun FROM tbl_service");
        return $hsl;
    }
    function get_service_perbulan($bulan)
    {
        $hsl = $this->db->query("SELECT * ,service_nofak,DATE_FORMAT(service_tanggal,'%d %M %Y') AS service_tanggal,service_total,service_dp,service_kekurangan,d_service_id,d_service_nama,d_service_barang_har_srp_pot,d_service_qty,d_service_total FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak WHERE DATE_FORMAT(service_tanggal,'%M %Y')='$bulan' ORDER BY service_nofak DESC");
        return $hsl;
    }
    function get_total_service_perbulan($bulan)
    {
        $hsl = $this->db->query("SELECT * ,service_nofak,DATE_FORMAT(service_tanggal,'%d %M %Y') AS service_tanggal,service_total,service_dp,service_kekurangan,d_service_id,d_service_nama,d_service_barang_har_srp_pot,d_service_qty,d_service_total,sum(d_service_total) as total FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak WHERE DATE_FORMAT(service_tanggal,'%M %Y')='$bulan' ORDER BY service_nofak DESC");
        return $hsl;
    }
    function get_service_pertahun($tahun)
    {
        $hsl = $this->db->query("SELECT * ,YEAR(service_tanggal) AS tahun,service_nofak,DATE_FORMAT(service_tanggal,'%d %M %Y') AS service_tanggal,service_total,service_dp,service_kekurangan,d_service_id,d_service_nama,d_service_barang_har_srp_pot,d_service_qty,d_service_total FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak WHERE YEAR(service_tanggal)='$tahun' ORDER BY service_nofak DESC");
        return $hsl;
    }
    function get_total_service_pertahun($tahun)
    {
        $hsl = $this->db->query("SELECT * ,YEAR(service_tanggal) AS tahun,service_nofak,DATE_FORMAT(service_tanggal,'%d %M %Y') AS service_tanggal,service_total,service_dp,service_kekurangan,d_service_id,d_service_nama,d_service_barang_har_srp_pot,d_service_qty,d_service_total,sum(d_service_total) as total FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak WHERE YEAR(service_tanggal)='$tahun' ORDER BY service_nofak DESC");
        return $hsl;
    }
    function get_lap_retur_beli_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_harpok,retur_qty,
		(retur_harpok*retur_qty) AS retur_subtotal,retur_keterangan,nama_merek
		FROM tbl_retur_beli
		JOIN tbl_barang	ON retur_barang_id=barang_id
		JOIN tbl_merek 	ON barang_merek_id=merek_id
		JOIN tbl_toko ON `tbl_barang`.`toko_id`=`tbl_toko`.`toko_id` WHERE retur_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl'");
        return $hsl;
    }
    function get_lap_retur_jual_pilihan($dari_tgl, $sampai_tgl)
    {
        $hsl = $this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_harjul,retur_qty,
		(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan,nama_merek
		FROM tbl_retur_jual
		JOIN tbl_barang	ON retur_barang_id=barang_id
		JOIN tbl_merek 	ON barang_merek_id=merek_id
		JOIN tbl_toko ON `tbl_barang`.`toko_id`=`tbl_toko`.`toko_id` WHERE retur_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl'");
        return $hsl;
    }
    
    function get_lap_bonus($dari_tgl, $sampai_tgl, $karyawan)
    {
        $hsl = $this->db->query("SELECT barang_id,user_nama,barang_harpok,barang_har_srp,barang_har_srp_pot, DATE_FORMAT(jual_tanggal,'%d %M %Y ') as jual_tanggal FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_user ON tbl_user.user_id=tbl_barang.barang_user_id WHERE d_jual_barang_har_srp_pot >= d_jual_barang_har_srp AND tbl_jual.jual_user_id='$karyawan' AND jual_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl 23:59:59'");
        return $hsl;
    }
    function get_lap_bonus_dibayar($dari_tgl, $sampai_tgl, $karyawan)
    {
        $hsl = $this->db->query("SELECT  COUNT(barang_id)*25000 AS bonus,user_nama,barang_harpok,barang_har_srp,barang_har_srp_pot, DATE_FORMAT(jual_tanggal,'%d %M %Y ') as jual_tanggal FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_user ON tbl_user.user_id=tbl_barang.barang_user_id WHERE d_jual_barang_har_srp_pot >= d_jual_barang_har_srp AND tbl_jual.jual_user_id='$karyawan' AND jual_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl 23:59:59'");
        return $hsl;
    }
    
    function get_total_lap_bonus($dari_tgl, $sampai_tgl, $karyawan)
    {
        $hsl = $this->db->query("SELECT barang_id,user_nama,barang_harpok,barang_har_srp,barang_har_srp_pot, DATE_FORMAT(jual_tanggal,'%d %M %Y ') as jual_tanggal,SUM(barang_harpok) AS total_harpok,SUM(barang_har_srp) AS total_har_srp,SUM(barang_har_srp_pot) AS total_har_srp_pot FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_barang ON tbl_barang.barang_id=tbl_detail_jual.d_jual_barang_id JOIN tbl_user ON tbl_user.user_id=tbl_barang.barang_user_id WHERE d_jual_barang_har_srp_pot >= d_jual_barang_har_srp AND tbl_jual.jual_user_id='$karyawan' AND jual_tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl 23:59:59'");
        return $hsl;
    }
}
