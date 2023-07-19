<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan data histori mutasi</title>
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
                        <h4>LAPORAN DATA HISTORI MUTASI BARANG</h4>
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
                    <th>IMEI</th>
                    <th>Nama Barang</th>
                    <th>Toko Asal</th>
                    <th>Toko Tujuan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;
                    $imei = $i['mutasi_imei'];
                    $merek = $i['nama_merek'];
                    $asal = $i['mutasi_toko_asal'];
                    $tujuan = $i['toko_tujuan'];
                    $tgl = $i['mutasi_tanggal'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="padding-left:5px;"><?php echo $imei; ?></td>
                        <td style="text-align:left;"><?php echo $merek; ?></td>
                        <td style="text-align:left;"><?php echo $asal; ?></td>
                        <td style="text-align:left;"><?php echo $tujuan; ?></td>
                        <td style="text-align:center;"><?php echo $tgl; ?></td>
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