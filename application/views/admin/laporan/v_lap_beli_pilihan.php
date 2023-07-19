<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Pembelian Pilihan</title>
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
                        <h4>Laporan Pembelian Dari Tanggal <?= $dari ?> -   <?= $sampai ?></h4>
                        
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
        <?php
        $b = $jml->row_array();
        ?>
        <table border="1" align="center" style="width:900px;margin-bottom:20px;">
            <thead>
                <tr>
                    <th colspan="11" style="text-align:left;">Tanggal : <?= $dari ?> -   <?= $sampai ?></th>
                </tr>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Tanggal</th>
                    <th>No Faktur</th>
                    <th>IMEI</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Qty</th>
                    <th>Harga total</th>
                    <th>Pembayaran</th>
                    <th>Tempo</th>
                    <th>Suplier</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;
                    $tgl = $i['beli_tanggal'];
                    $nabar = $i['nama_merek'];
                    $nofak = $i['beli_nofak'];
                    $qty = $i['d_beli_jumlah'];
                    $imei = $i['d_beli_barang_id'];
                    $hargabeli = $i['d_beli_harga'];
                    $hargatotal = $i['d_beli_total'];
                    $pembayaran = $i['beli_pembayaran'];
                    $tempo = $i['beli_tempo'];
                    $suplier = $i['suplier_nama'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="text-align:center;"><?php echo $tgl; ?></td>
                        <td style="text-align:left;"><?php echo $nofak; ?></td>
                        <td style="text-align:left;"><?php echo $imei; ?></td>
                        <td style="text-align:left;"><?php echo $nabar; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($hargabeli); ?></td>
                        <td style="text-align:left;"><?php echo $qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($hargatotal); ?></td>
                        <td style="text-align:left;"><?php echo $pembayaran; ?></td>
                        <td style="text-align:left;"><?php echo $tempo; ?></td>
                        <td style="text-align:left;"><?php echo $suplier; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>

                <tr>
                    <td colspan="10" style="text-align:center;"><b>Total Pembelian</b></td>
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