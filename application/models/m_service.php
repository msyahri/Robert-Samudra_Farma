<?php
class M_service extends CI_Model
{
    function tampil_service()
    {
         $hsl = $this->db->query("SELECT * FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak JOIN tbl_user ON tbl_user.user_id = tbl_service.service_user_id JOIN tbl_customer ON tbl_customer.customer_id=tbl_service.service_customer");
        return $hsl;
    }
    function hapus_service_det($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_detail_service where d_service_nofak='$kode'");
		return $hsl;
	}
    function hapus_service($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_service where service_nofak='$kode'");
		return $hsl;
	}
    function hapus_retur($kode)
    {
        $hsl = $this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
        return $hsl;
    }

    function tampil_retur()
    {
        $hsl = $this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
        return $hsl;
    }

    function simpan_retur($kobar, $nabar, $satuan, $harjul, $qty, $keterangan)
    {
        $hsl = $this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
        return $hsl;
    }

    function simpan_service($nofak, $total, $jml_uang, $kembalian)
    {
        $idadmin = $this->session->userdata('idadmin');
        $tgljual = $this->session->userdata('tglfakjual');
        $customer = $this->session->userdata('customer');
        $cara_byr_jual = $this->session->userdata('cara_byr_jual');
        $toko = $this->session->userdata('tokonama');

        $this->db->query("INSERT INTO tbl_service (service_nofak,service_tanggal,service_total,service_dp,service_kekurangan,service_user_id,service_keterangan,service_pembayaran,service_customer,service_toko) VALUES ('$nofak','$tgljual','$total','$jml_uang','$kembalian','$idadmin','1','$cara_byr_jual','$customer','$toko')");
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'd_service_nofak'                 =>    $nofak,
                'd_service_nama'                 =>    $item['id'],
                'd_service_barang_har_srp_pot'    =>    $item['harpok'],
                'd_service_qty'                =>    $item['qty'],
                'd_service_total'                =>    $item['subtotal']
            );
            $this->db->insert('tbl_detail_service', $data);
        }
        return true;
    }
    function get_nofak($tgljual)
    {
        $tgl = substr($tgljual, 8, 2);
        $bln = substr($tgljual, 5, 2);
        $thn = substr($tgljual, 2, 2);
        $date = $tgl . $bln . $thn;
        $tgl = substr($tgljual, 0, 10);
        $q = $this->db->query("SELECT MAX(RIGHT(service_nofak,6)) AS kd_max FROM tbl_service WHERE DATE(service_tanggal)='$tgl'");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "300001";
        }
        return $date . $kd;
    }

    //=====================service grosir================================
    function simpan_service_grosir($nofak, $total, $jml_uang, $kembalian)
    {
        $idadmin = $this->session->userdata('idadmin');
        $this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','grosir')");
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'd_jual_nofak'             =>    $nofak,
                'd_jual_barang_id'        =>    $item['id'],
                'd_jual_barang_nama'    =>    $item['name'],
                'd_jual_barang_satuan'    =>    $item['satuan'],
                'd_jual_barang_har_srp_pot'    =>    $item['harpok'],
                'd_jual_barang_har_srp'    =>    $item['amount'],
                'd_jual_qty'            =>    $item['qty'],
                'd_jual_diskon'            =>    $item['disc'],
                'd_jual_total'            =>    $item['subtotal']
            );
            $this->db->insert('tbl_detail_jual', $data);
            $this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
        }
        return true;
    }

    function cetak_faktur($nofak)
    {
        // 		$nofak = $this->session->userdata('c_nofak');
        $hsl = $this->db->query("SELECT * FROM tbl_service JOIN tbl_detail_service ON service_nofak=d_service_nofak WHERE service_nofak='$nofak'");
        return $hsl;
    }

    function tampil_cara_bayar()
    {
        $hsl = $this->db->query("SELECT * FROM tbl_cara_bayar");
        return $hsl;
    }

    function simpan_cara_bayar($nm)
    {
        $hsl = $this->db->query("INSERT INTO tbl_cara_bayar(crbyr_nama) VALUES ('$nm')");
        return $hsl;
    }

    function tampil_struk_service($nofak)
    {
        $hsl = $this->db->query("SELECT * FROM `tbl_detail_service` WHERE tbl_detail_service.d_service_nofak = '$nofak'");
        return $hsl;
    }
}
