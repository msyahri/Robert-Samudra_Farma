<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Bonus Penjualan Karyawan</title>
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
                        <h4>Laporan Bonus Penjualan Karyawan Dari Tanggal <?= $dari ?> -   <?= $sampai ?></h4>
                        
                        <h4>Karyawan: <?= $krywn ?> </h4>
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
        $bns = $bns->row_array(); 
        ?>
        <table border="1" align="center" style="width:900px;margin-bottom:20px;">
            <thead>
                <tr>
                    <th colspan="5" style="text-align:left;">Tanggal : <?= $dari ?> -   <?= $sampai ?></th>
                </tr>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>IMEI</th>
                    <th>Harga Beli</th>
                    <th>Harga SRP</th>
                    <th>Harga Jual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;
                    $imei = $i['barang_id'];
                    $hargabeli = $i['barang_harpok'];
                    $hargasrp = $i['barang_har_srp'];
                    $hargajual = $i['barang_har_srp_pot'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="text-align:center;"><?php echo $imei; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($hargabeli); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($hargasrp); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($hargajual); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>

                <tr>
                    <td colspan="2" style="text-align:center;"><b>Total</b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['total_harpok']); ?></b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['total_har_srp']); ?></b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['total_har_srp_pot']); ?></b></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;"><b>Bonus</b></td>
                    <td colspan="3" style="text-align:right;"><b><?php echo 'Rp ' . number_format($bns['bonus']); ?></b></td>
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