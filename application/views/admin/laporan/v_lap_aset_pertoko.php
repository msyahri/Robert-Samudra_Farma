<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>laporan data barang</title>
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
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>LAPORAN DATA <?= $judul ?> APOTEK SAMUDRA</h4>
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
            <?php
            $urut = 0;
            $nomor = 0;
            $group = '-';
            foreach ($data->result_array() as $d) {
                $nomor++;
                $urut++;
                if ($group == '-' || $group != $d['toko_nama']) {
                    $kat = $d['toko_nama'];

                    if ($group != '-')
                        echo "</table><br>";
                    echo "<table align='center' width='900px;' border='1'>";
                    echo "<tr><td colspan='7'><b>Kategori: $kat</b></td> </tr>";
                    echo "<tr style='background-color:#ccc;'>
    <td width='4%' align='center'>No</td>
    <td width='10%' align='center'>Kode Barang</td>
    <td width='40%' align='center'>Nama Barang</td>
    <td width='10%' align='center'>Warna</td>
    <td width='10%' align='center'>Satuan</td>
    <td width='10%' align='center'>Stok</td>
    <td width='20%' align='center'>Harga Beli</td>
    
    </tr>";
                    $nomor = 1;
                }
                $group = $d['toko_nama'];
                if ($urut == 500) {
                    $nomor = 0;
                    echo "<div class='pagebreak'> </div>";
                }
            ?>
                <tr>
                    <td style="text-align:center;vertical-align:center;text-align:center;"><?php echo $nomor; ?></td>
                    <td style="vertical-align:center;padding-left:5px;text-align:center;"><?php echo $d['barang_id']; ?></td>
                    <td style="vertical-align:center;padding-left:5px;"><?php echo $d['nama_merek']; ?></td>
                    <td style="vertical-align:center;text-align:center;"><?php echo $d['warna']; ?></td>
                    <td style="vertical-align:center;text-align:center;"><?php echo $d['barang_satuan']; ?></td>
                    <td style="vertical-align:center;text-align:center;text-align:center;"><?php echo $d['barang_stok']; ?></td>
                    <td style="vertical-align:center;padding-right:5px;text-align:right;"><?php echo 'Rp ' . number_format($d['barang_harpok']); ?></td>
                </tr>


            <?php
            }
            ?>
            <tfoot>
            <?php
        $b = $jml->row_array();
        ?>
                <tr>
                    <td colspan="6" style="text-align:center;"><b>Total Aset</b></td>
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