<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By Mahakarya Promosindo">
    <meta name="author" content="Mahakarya Promosindo">

    <title>Transaksi Service</title>

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
                            <input type="text" name="nofak_alert" id="" class="form-control input-sm" value="<?= $data['service_nofak']; ?>" readonly>
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
                                <input type='text' name="tgljual_alert" class="form-control" value="<?= $data['service_tanggal']; ?>" placeholder="Tanggal..." readonly />
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
                            <input type='text' name="cara_byr_jual_alert" class="form-control" value="<?= $data['service_pembayaran']; ?>" placeholder="Cara Bayar..." readonly />
                        </td>
                    </tr>
                </table>
                <hr />

                <table class="table table-striped">
                    <tr>
                        <th>Nama Service</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                    <?php $total = 0 ?>
                    <?php foreach ($tampilstruk as $i) : ?>
                        <tr>
                            <td><?= $i->d_service_nama; ?></td>
                            <td><?= $i->d_service_barang_har_srp_pot; ?></td>
                            <td><?= $i->d_service_qty; ?></td>
                            <td><?= $i->d_service_total; ?></td>
                        </tr>
                        <?php $total = $total + $i->d_service_total; ?>
                    <?php endforeach; ?>

                    <tr>
                        <th colspan="5" style="text-align:right">Total</th>
                        <td><?= $data['service_total']; ?></td>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align:right">Tunai</th>
                        <td><?= $data['service_dp']; ?></td>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align:right">Kembalian</th>
                        <td><?= $data['service_kekurangan']; ?></td>
                    </tr>
                </table>
                <div class="alert alert-success">
                    <strong>Transaksi Berhasil Silahkan Cetak Faktur Penjualan!</strong>

                    <a class="btn btn-default" href="<?php echo base_url() . 'admin/penjualan' ?>"><span class="fa fa-backward"></span>Kembali</a>
                    <a class="btn btn-info" href="<?php echo base_url() . 'admin/penjualan/cetak_faktur' ?>" target="_blank"><span class="fa fa-print"></span>Cetak</a>
                </div>
            </div>
        </div>
        
        <pre id="pre_print" >
<table>
    <tr>
    <th>Nama</th>
    <th>Jml</th>
    <th>Jml</th>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
    </tr>
    <tr>
    <td>Hp Samsung Note 8</td>
    <td>1</td>
    <td>5.000.000</td>
    </tr>
    <tr>
    <td>Hp Iphone X</td>
    <td>1</td>
    <td>10.000.000</td>
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