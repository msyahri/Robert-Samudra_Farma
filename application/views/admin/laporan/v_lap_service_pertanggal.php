<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Data Service Pertanggal</title>
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
                        <h4>Laporan Service Barang Per <?= $tgl ?></h4>
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
                <tr>
                    <th style="width:50px;">No</th>
                    <th>No Faktur</th>
                    <th>Tanggal</th>
                    <th>Toko</th>
                    <th>Nama Barang</th>
                    <th>Harga Service</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;
                    $nofak = $i['service_nofak'];
                    $tgl = $i['service_tanggal'];
                    $barang_nama = $i['d_service_nama'];
                    $barang_har_srp_pot = $i['d_service_barang_har_srp_pot'];
                    $barang_qty = $i['d_service_qty'];
                    $toko = $i['service_toko'];
                    $barang_total = $i['d_service_total'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="padding-left:5px;"><?php echo $nofak; ?></td>
                        <td style="text-align:center;"><?php echo $tgl; ?></td>
                        <td style="text-align:center;"><?php echo $toko; ?></td>
                        <td style="text-align:center;"><?php echo $barang_nama; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_har_srp_pot); ?></td>
                        <td style="text-align:center;"><?php echo $barang_qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_total); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php
                $b = $jml->row_array();
                ?>
                <tr>
                    <td colspan="7" style="text-align:center;"><b>Total</b></td>
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

</html>_