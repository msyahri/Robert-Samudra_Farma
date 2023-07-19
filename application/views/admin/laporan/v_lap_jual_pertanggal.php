<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Data Penjualan Pertanggal</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
</head>

<body onload="window.print()">
    <div id="laporan">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
            <!--<tr>
    <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
</tr>-->
        </table>

        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;paddin-left:20px;">
                    <center>
                        <h4>Laporan Penjualan Barang Per <?= $tgl ?> </h4>
                        
                        <h4> <?= $tk ?> </h4>
                    </center><br />
                </td>
            </tr>

        </table>

        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>

        <table border="1" align="center" style="width:900px;margin-bottom:20px;">
            <thead>
                <tr style='background-color:#ccc;'>
                    <th style="width:50px;">No</th>
                    <th>No Faktur</th>
                    <th>Tanggal</th>
                    <th>Pembeli</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Toko</th>
                    <th>Kasir</th>
                    <th>Harga SRP</th>
                    <th>Harga SRP POT</th>
                    <th>Qty</th>
                    <th>Diskon</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;
                    $nofak = $i['jual_nofak'];
                    $tgl = $i['jual_tanggal'];
                    $cust = $i['customer_nama'];
                    $barang_id = $i['d_jual_barang_id'];
                    $barang_nama = $i['nama_merek'];
                    $toko = $i['toko_nama'];
                    $kasir = $i['user_nama'];
                    $barang_har_srp = $i['d_jual_barang_har_srp'];
                    $barang_har_srp_pot = $i['d_jual_barang_har_srp_pot'];
                    $barang_qty = $i['d_jual_qty'];
                    $barang_diskon = $i['d_jual_diskon'];
                    $barang_total = $i['d_jual_total'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="padding-left:5px;"><?php echo $nofak; ?></td>
                        <td style="text-align:center;"><?php echo $tgl; ?></td>
                        <td style="text-align:center;"><?php echo $cust; ?></td>
                        <td style="text-align:center;"><?php echo $barang_id; ?></td>
                        <td style="text-align:center;"><?php echo $barang_nama; ?></td>
                        <td style="text-align:center;"><?php echo $toko; ?></td>
                        <td style="text-align:center;"><?php echo $kasir; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_har_srp); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_har_srp_pot); ?></td>
                        <td style="text-align:center;"><?php echo $barang_qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_diskon); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_total); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php
                $b = $jml->row_array();
                ?>
                <tr>
                    <td colspan="11" style="text-align:center;"><b>Total</b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['total']); ?></b></td>
                </tr>
            </tfoot>
        </table>
        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td></td>
        </table>
        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td align="right">Purwokerto, <?php echo date('d-M-Y') ?></td>
            </tr>
            <tr>
                <td align="right"></td>
            </tr>

            <tr>
                <td><br /><br /><br /><br /></td>
            </tr>
            <tr>
                <td align="right">( <?php echo $this->session->userdata('nama'); ?> )</td>
            </tr>
            <tr>
                <td align="center"></td>
            </tr>
        </table>
        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <th><br /><br /></th>
            </tr>
            <tr>
                <th align="left"></th>
            </tr>
        </table>
    </div>
</body>

</html>