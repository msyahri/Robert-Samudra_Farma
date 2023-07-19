<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Made By Kopyus @2020">
    <meta name="author" content="Kopyus">

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
            <div class="col-lg-12">
                <center><?php echo $this->session->flashdata('msg'); ?></center>
                <h1 class="page-header">Transaksi
                    <small>Service</small>

                    <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Cari Produk <span class="fa fa-search" aria-hidden="true"></span></small></a>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <form action="<?php echo base_url() . 'admin/penjualan/add_to_cart' ?>" method="post">
                    <table>
                        <tr>
                            <!-- <th style="width:90px;padding-bottom:5px;">customer</th> -->
                            <th style="width:100px;padding-bottom:5px;">Customer</th>
                            <!-- <td style="width:350px;"> -->
                            <td style="padding-bottom:5px;">
                                <select name="customer" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih customer" data-width="100%" required>
                                    <?php foreach ($customer->result_array() as $i) {
                                        $id_cus = $i['customer_id'];
                                        $nm_cus = $i['customer_nama'];
                                        $al_cus = $i['customer_alamat'];
                                        $notelp_cus = $i['customer_telp'];
                                        $sess_id = $this->session->userdata('customer');
                                        if ($sess_id == $id_cus)
                                            echo "<option value='$id_cus' selected>$nm_cus - $al_cus - $notelp_cus</option>";
                                        else
                                            echo "<option value='$id_cus'>$nm_cus - $al_cus - $notelp_cus</option>";
                                    } ?>
                                </select>
                            </td>
                            <td style="padding-bottom:5px;">
                                <a href="#" class="btn btn-sm btn-success" style="margin-left:5px;" data-toggle="modal" data-target="#largeModalCustomer"><span class="fa fa-plus"></span> Tambah Customer</a>
                            </td>
                        </tr>
                        <tr>
                            <th style="width:100px;padding-bottom:5px;">Toko</th>
                            <td style="padding-bottom:5px;">
                                <input type="text" name="toko" id="" class="form-control input-sm" value="<?= $this->session->userdata('tokonama'); ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th style="width:100px;padding-bottom:5px;">Tanggal</th>
                            <td style="width:300px;padding-bottom:5px;">
                                <div class='input-group date ml-3' id='datetimepicker' style="width:300px;">
                                    <input type='text' name="tgljual" class="form-control" value="<?php echo $this->session->userdata('tglfakjual'); ?>" placeholder="Tanggal..." required />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style="width:100px;padding-bottom:5px;">Cara bayar</th>
                            <td style="width:300px;padding-bottom:5px;">
                                <select name="cara_byr_jual" class="selectpicker show-tick form-control crbyr" data-live-search="true" title="Pilih Cara Bayar" data-width="100%" required>
                                    <?php foreach ($crbyr->result_array() as $i) {
                                        $nm_crbyr = $i['crbyr_nama'];
                                        $sess_id = $this->session->userdata('cara_byr_jual');
                                        if ($sess_id == $nm_crbyr)
                                            echo "<option value='$nm_crbyr' selected>$nm_crbyr</option>";
                                        else
                                            echo "<option value='$nm_crbyr'>$nm_crbyr</option>";
                                    } ?>
                                </select>
                            </td>
                            <td style="padding-bottom:5px;">
                                <a href="#" class="btn btn-sm btn-success" style="margin-left:5px;" data-toggle="modal" data-target="#largeModalCaraBayar"><span class="fa fa-plus"></span> Tambah Cara Bayar</a>
                            </td>
                        </tr>
                    </table>

                    <hr />

                    <table>
                        <tr>
                            <th>Imei</th>
                        </tr>
                        <tr>
                            <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>
                        </tr>
                    </table>

                    <table>
                        <div id="detail_barang"></div>
                    </table>
                    <table>
                        <tr>
                            <th>Nama Merek</th>
                            <th>Warna</th>
                            <th>Stok</th>
                            <th>Harga SRP(Rp)</th>
                            <th>Harga SRP Pot(Rp)</th>
                            <th style="text-align: center;">Jumlah</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="nabar" style="width:300px;margin-right:5px;" class="form-control input-sm" readonly>
                                <input type="hidden" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>

                            <td><input type="text" name="nabar" style="width:100px;margin-right:5px;" class="form-control input-sm" readonly></td>
                            <td><input type="text" name="stok" style="width:40px;margin-right:5px;" class="form-control input-sm" readonly></td>
                            <td><input type="text" name="harsrp" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm" readonly></td>
                            <td><input type="text" name="harsrppot" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm"></td>
                            <td><button type="submit" class="btn btn-sm btn-success" style="margin-right:5px;">Ok</button></td>
                            <td><a href="#" onclick="document.getElementById('kode_brg').value=''" id="batalInsertCart" class="btn btn-sm btn-warning"><span class="fa fa-close"></span> Batal</a></td>
                        </tr>
                    </table>

                </form>

                <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
                    <thead>
                        <tr>
                            <th>IMEI</th>
                            <th>Nama Merek</th>
                            <th>Warna</th>
                            <th style="text-align:center;">Harga SRP (Rp)</th>
                            <th style="text-align:center;">Harga SRP Pot (Rp)</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:center;">Sub Total</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($this->cart->contents() as $items) : ?>
                            <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                            <tr>
                                <td><?= $items['merek_id']; ?></td>
                                <td><?= $items['merek_nama']; ?></td>
                                <td><?= $items['warna']; ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['price']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['harpok']); ?></td>
                                <td style="text-align:center;"><?php echo number_format($items['jumlah']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>

                                <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/penjualan/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                            </tr>

                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form action="<?php echo base_url() . 'admin/penjualan/simpan_penjualan' ?>" method="post">
                    <table>
                        <tr>
                            <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg"> Simpan</button></td>
                            <th style="width:140px;">Total Belanja(Rp)</th>
                            <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total()); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                            <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total(); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                        </tr>
                        <tr>
                            <th>Tunai(Rp)</th>
                            <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                            <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Kembalian(Rp)</th>
                            <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                        </tr>

                    </table>
                </form>
                <hr />
            </div>
            <!-- /.row -->

            <!-- ============ MODAL ADD Customer =============== -->
            <div class="modal fade" id="largeModalCustomer" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="myModalLabel">Tambah Customer</h3>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/customer/tambah_customer_jual' ?>">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Nama Customer</label>
                                    <div class="col-xs-9">
                                        <input name="nama" class="form-control" type="text" placeholder="Nama Customer..." style="width:280px;" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">No Telp/ HP</label>
                                    <div class="col-xs-9">
                                        <input name="notelp" class="form-control" type="text" placeholder="No Telp/HP..." style="width:280px;" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Alamat</label>
                                    <div class="col-xs-9">
                                        <input name="alamat" class="form-control" type="text" placeholder="Alamat..." style="width:280px;" required>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-info">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ============ MODAL ADD Customer =============== -->
            <div class="modal fade" id="largeModalCaraBayar" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="myModalLabel">Tambah Cara Bayar</h3>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/penjualan/tambah_cara_bayar' ?>">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Nama Cara Bayar</label>
                                    <div class="col-xs-9">
                                        <input name="crbyr" class="form-control" type="text" placeholder="Nama Cara Bayar..." style="width:280px;" autofocus required>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-info">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ============ MODAL ADD =============== -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="myModalLabel">Data Barang</h3>
                        </div>
                        <div class="modal-body" style="overflow:scroll;height:500px;">

                            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;width:40px;">No</th>
                                        <th style="width:120px;">Kode Barang</th>
                                        <th style="width:240px;">Nama Merek</th>
                                        <th style="width:240px;">Warna</th>
                                        <th style="width:100px;">Harga</th>
                                        <th>Stok</th>
                                        <th style="width:100px;text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($data->result_array() as $a) :
                                        $no++;
                                        $id = $a['barang_id'];
                                        $harpok = $a['barang_harpok'];
                                        $harjul = $a['barang_har_srp'];
                                        $harjul_grosir = $a['barang_har_srp_pot'];
                                        $stok = $a['barang_stok'];
                                        $min_stok = $a['barang_min_stok'];
                                        $kat_id = $a['barang_merek_id'];
                                        $kat_nama = $a['nama_merek'];
                                        $warna = $a['warna'];
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo $no; ?></td>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $kat_nama; ?></td>
                                            <td><?php echo $warna; ?></td>
                                            <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                            <td style="text-align:center;"><?php echo $stok; ?></td>
                                            <td style="text-align:center;">
                                                <form action="<?php echo base_url() . 'admin/penjualan/add_to_cart' ?>" method="post">
                                                    <input type="hidden" name="kode_brg" value="<?php echo $kat_id ?>">
                                                    <input type="hidden" name="nabar" value="<?php echo $kat_nama; ?>">
                                                    <input type="hidden" name="stok" value="<?php echo $stok; ?>">
                                                    <input type="hidden" name="harjul" value="<?php echo number_format($harjul); ?>">
                                                    <input type="hidden" name="diskon" value="0">
                                                    <input type="hidden" name="qty" value="1" required>
                                                    <button type="submit" class="btn btn-xs btn-info" title="Pilih"><span class="fa fa-edit"></span> Pilih</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>

                        </div>
                    </div>
                </div>
            </div>



            <!-- ============ MODAL HAPUS =============== -->


            <!--END MODAL-->

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p style="text-align:center;">Copyright &copy; <?php echo '2020'; ?> by Kopyus</p>
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
        <script type="text/javascript">
            $(function() {
                $('#jml_uang').on("input", function() {
                    var total = $('#total').val();
                    var jumuang = $('#jml_uang').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    $('#jml_uang2').val(hsl);
                    $('#kembalian').val(hsl - total);
                })

            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#mydata').DataTable();
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $('.jml_uang').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });
                $('#jml_uang2').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ''
                });
                $('#kembalian').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });
                $('.harjul').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {





                //Ajax kabupaten/kota insert
                $("#kode_brg").focus();
                $("#kode_brg").on("input", function() {
                    var kobar = {
                        kode_brg: $(this).val()
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'admin/penjualan/get_barang'; ?>",
                        data: kobar,
                        success: function(msg) {
                            $('#detail_barang').html(msg);
                        }
                    });
                });

                $("#kode_brg").keypress(function(e) {
                    $('#detail_barang').show();
                    $('#kode_brg').focus();
                    if (e.which == 13) {
                        $("#jumlah").focus();

                    }
                });



                // $('#cek_merek_id').on('change', function() {
                //     var id_merek = $(this).val();
                //     var baseURL = "<?= base_url(); ?>";
                //     if (id_merek) {
                //         $.ajax({
                //             type: 'POST',
                //             url:"<?php echo base_url(); ?>admin/pembelian/cek_kategori_merek",
                //             dataType:'JSON',
                //             data: 'id_merek=' + id_merek,
                //             success: function(html) {
                //                 if (html.kategori == "handphone") {
                //                    document.getElementById("qty").readOnly=true;
                //                 } else {
                //                     document.getElementById("qty").readOnly=false;
                //                 }
                //                alert(html.kategori);
                //             }
                //         });
                //     }
                // });
            });
        </script>



        <script type="text/javascript">
            $(function() {
                $('#datetimepicker').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm:ss',
                    maxDate: new Date(),
                    defaultDate: new Date(),
                });

                $('#datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
                $('#datepicker2').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#timepicker').datetimepicker({
                    format: 'HH:mm'
                });
            });
        </script>
    </div>
</body>

</html>