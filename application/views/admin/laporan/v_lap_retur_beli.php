<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan data retur pembelian</title>
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
                        <h4>LAPORAN DATA RETUR PEMBELIAN BARANG</h4>
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
                <tr  style='background-color:#ccc;'>
                    <th style="width:50px;">No</th>
                    <th>Tanggal</th>
                    <th>IMEI</th>
                    <th>Nama Merek</th>
                    <th style="text-align:center;">Harga(Rp)</th>
                    <th style="text-align:center;">Jumlah</th>
                    <th style="text-align:center;">Subtotal(Rp)</th>
                    <th style="text-align:center;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $items) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?php echo $items['retur_tanggal']; ?></td>
                        <td><?php echo $items['retur_barang_id']; ?></td>
                        <td style="text-align:left;"><?php echo $items['nama_merek']; ?></td>
                        <td style="text-align:center;"><?php echo number_format($items['retur_harpok']); ?></td>
                        <td style="text-align:center;"><?php echo $items['retur_qty']; ?></td>
                        <td style="text-align:center;"><?php echo number_format($items['retur_subtotal']); ?></td>
                        <td style="text-align:center;"><?php echo $items['retur_keterangan']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
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