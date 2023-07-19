<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By Mahakarya Promosindo">
    <meta name="author" content="Mahakarya Promosindo">

    <title>Transaksi Penjualan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() . 'assets/css/4-col-portfolio.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/dist/css/bootstrap-select.css' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-datetimepicker.min.css' ?>">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
     function BtPrint(prn){
        var S = "#Intent;scheme=rawbt;";
        var P =  "package=ru.a402d.rawbtprinter;end;";
        var textEncoded = encodeURI(prn);
        window.location.href="intent:"+textEncoded+S+P;
    }
    
    function ajax_print(url, btn) {
            b = $(btn);
            b.attr('data-old', b.text());
            b.text('wait');
            	var ua = navigator.userAgent.toLowerCase();
		var isAndroid = ua.indexOf("android") > -1;
            $.get(url, function (data) {
                window.location.href = url;  // main action
            }).fail(function () {
                if(isAndroid) {
		   //android_print();
		   BtPrint(document.getElementById('pre_print').innerText);
		}else{
		   pc_print('http://bjs.kopyus.com/admin/penjualan/cetak_from_pc_test');
		}
            }).always(function () {
                b.text(b.attr('data-old'));
            })
        }
        
         function android_print(){
   alert("Print dari android");
        }
        function pc_print(url_pc){
    alert("Print dari Komputer");
    window.location.href = url_pc;
    
        }

    </script>
</head>

<body>

    <!-- Navigation -->
    <?php
    $this->load->view('admin/menu');
    ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">

            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <!-- <th style="width:90px;padding-bottom:5px;">customer</th> -->
                        <th>No Faktur</th>
                        <!-- <td style="width:350px;"> -->
                        <td>
                            <input type="text" name="nofak_alert" id="" class="form-control input-sm" value="<?= $data['jual_nofak']; ?>" readonly>
                        </td>

                        <th>Customer</th>
                        <td>
                            <?php foreach ($cstmr->result() as $c) { ?>
                                <input type="text" name="cust_alert" id="" class="form-control input-sm" value="<?= $c->customer_nama; ?>" readonly>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Toko</th>
                        <td>
                            <input type="text" name="toko_alert" id="" class="form-control input-sm" value="<?= $this->session->userdata('tokonama'); ?>" readonly>
                        </td>
                        <th>Tanggal</th>
                        <td>
                            <div class='input-group date ml-3' id='datepicker'>
                                <input type='text' name="tgljual_alert" class="form-control" value="<?= $data['jual_tanggal']; ?>" placeholder="Tanggal..." readonly />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>Kasir</th>
                        <td>
                            <input type="text" name="kasir_alert" id="" class="form-control input-sm" value="<?= $this->session->userdata('user'); ?>" readonly>
                        </td>
                        <th>cara bayar</th>
                        <td>
                            <input type='text' name="cara_byr_jual_alert" class="form-control" value="<?= $data['jual_pembayaran']; ?>" placeholder="Cara Bayar..." readonly />
                        </td>
                    </tr>
                </table>
                <hr />

                <table class="table table-striped">
                    <tr>
                        <th>IMEI</th>
                        <th>Nama Merek</th>
                        <th>Warna</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                    <?php $total = 0 ?>
                    <?php foreach ($tampilstruk as $i) : ?>
                        <tr>
                            <td><?= $i->d_jual_barang_id; ?></td>
                            <td><?= $i->nama_merek; ?></td>
                            <td><?= $i->barang_warna; ?></td>
                            <td><?= $i->d_jual_barang_har_srp; ?></td>
                            <td><?= $i->d_jual_qty; ?></td>
                            <td><?= $i->d_jual_total; ?></td>
                        </tr>
                        <?php $total = $total + $i->d_jual_total; ?>
                    <?php endforeach; ?>

                    <tr>
                        <th colspan="5" style="text-align:right">Total</th>
                        <td><?= $data['jual_total']; ?></td>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align:right">Tunai</th>
                        <td><?= $data['jual_jml_uang']; ?></td>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align:right">Kembalian</th>
                        <td><?= $data['jual_kembalian']; ?></td>
                    </tr>
                </table>
                <div class="alert alert-success">
                    <strong>Transaksi Berhasil Silahkan Cetak Faktur Penjualan!</strong>

                    <a class="btn btn-default" href="<?php echo base_url() . 'admin/penjualan' ?>"><span class="fa fa-backward"></span>Kembali</a>
                   <!-- <a class="btn btn-info" href="<?php echo base_url() . 'admin/penjualan/cetak_faktur' ?>" target="_blank"><span class="fa fa-print"></span>Cetak</a> -->
                    <a class="btn btn-info" onclick="BtPrint(document.getElementById('pre_print').innerText);"><span class="fa fa-print"></span>Cetak</a>
                    <!--<button class="btn btn-info" onclick="ajax_print('http://bjs.kopyus.com/admin/penjualan/hasil_simpanabc',this)"><span class="fa fa-print"></span>Cetak test</button>
                   -->
                </div>
            </div>
        </div>
        
        <pre id="pre_print" >
<table border="1">
    <tr>
    <th colspan="4"><center>APOTEK SAMUDRA</center></th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;">Telp/WA: <?= $data['toko_telp']; ?></th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;"><?= $this->session->userdata('tokonama'); ?></th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;"><?= $data['toko_alamat']; ?></th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;"><?= $this->session->userdata('nama'); ?></th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;"><?= $data['jual_tanggal']; ?></th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;">No. Faktur: <?= $data['jual_nofak']; ?></th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;">Customer: <?= $c->customer_nama; ?></th>
    </tr>
    <tr>
    <th><br></th>
    </tr>
    <tr>
    <th> <font Size="0,1px">Barang</font></th>
    <th style="padding-left: 15px;"><font Size="0,1px">Jml</font></th>
    <th style="padding-left: 15px;"><font Size="0,1px">Hrg</font></th>
    <th style="padding-left: 15px;"><font Size="0,1px">Subtotal</font></th>
    </tr>
    
    <?php
    foreach ($tampilstruk as $print) :
    ?>
    <tr>
    <td><?= $print->nama_merek; ?> </br> <?= $print->barang_id; ?></td>
    <td style="padding-left: 15px;"><?= $print->d_jual_qty; ?></td>
    <td style="padding-left: 15px;"><?= $print->d_jual_barang_har_srp; ?></td>
    <td style="padding-left: 15px;"><?= $print->d_jual_total; ?></td>
    </tr>
     <?php $total = $total + $i->d_jual_total; ?>
    <?php endforeach; ?>
    
    <tr>
        <td colspan="3" style="text-align:right">Total</td>
        <td style="padding-left: 15px;"><?= $data['jual_total']; ?></td>
    </tr>
    <tr>
    <td colspan="3" style="text-align:right">Bayar</td>
    <td style="padding-left: 15px;"><?= $data['jual_jml_uang']; ?></td>
    </tr>
    <tr>
    <td colspan="3" style="text-align:right">Kembalian</td>
    <td style="padding-left: 15px;"><?= $data['jual_kembalian']; ?></td>
    </tr>
    <tr>
    <td colspan="3" style="text-align:right">Cara Bayar</td>
    <td style="padding-left: 15px;"><?= $data['jual_pembayaran']; ?></td>
    </tr>
    
     <tr> <th><br></th> </tr>
    <tr>
    <th colspan="4" style="text-align: center;">Terimakasih telah belanja..</th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;">Instagram : HOME_CELL_JATISARI</th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;">Shopee    : homecellular19 </th>
    </tr>
    <tr>
    <th colspan="4" style="text-align: center;">Tokopedia : home cellular 19</th>
    </tr>
   
</table>
   

</pre>
        <!-- /.row -->
        <!-- Projects Row -->



        <!--END MODAL-->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p style="text-align:center;">Copyright &copy; 2020 by Kopyus</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() . 'assets/dist/js/bootstrap-select.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/moment.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>



</body>

</html>