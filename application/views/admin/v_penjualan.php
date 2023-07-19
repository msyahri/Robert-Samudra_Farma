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
                    <small>Penjualan</small>

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
                            <th style="width:100px;padding-bottom:5px;" id="targethide1" style="display: none;">Tempo</th>
                            <td id="targethide2" style="width:300px;padding-bottom:5px;">
                                <div class='input-group date ml-3' id='datepicker2' style="width:300px;">
                                    <input type='text' name="tgl_tempo" class="form-control" value="<?php echo $this->session->userdata('tgl_tempo'); ?>" placeholder="Tanggal..." />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style="width:100px;padding-bottom:5px;">Cara bayar</th>
                            <td style="width:300px;padding-bottom:5px;">
                                <select name="cara_byr_jual" class="selectpicker show-tick form-control crbyr" id="carabayar" data-live-search="true" title="Pilih Cara Bayar" data-width="100%" required>
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
                    <button title="Play" class="btn btn-success btn-sm"  onclick="playcam()" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-camera"></span></button>
     
                    <table>
                        <tr>
                            <th>Kode Barang</th>
                        </tr>
                        <tr>
                            <th><input type="text" name="kode_brg" id="kode_brg"  class="form-control input-sm"></th>
                        </tr>
                    </table>
                    
                <table>
                    <div id="detail_barang"></div>
                </table>
                </form>
                
                <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Merek</th>
                            <th>satuan</th>
                            <th style="text-align:center;">Harga SRP (Rp)</th>
                            <th style="text-align:center;">Harga Jual (Rp)</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:center;">Sub Total</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($cart->result_array() as $items) : ?>
                            
                            <tr>
                                <td><?= $items['cart_jual_imei']; ?></td>
                                <td><?= $items['cart_jual_nama_merek']; ?></td>
                                <td><?= $items['cart_jual_warna']; ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['cart_jual_harga_srp']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['cart_jual_harga_jual']); ?></td>
                                <td style="text-align:center;"><?php echo number_format($items['cart_jual_qty']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['cart_jual_subtotal']); ?></td>

                                <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/penjualan/remove/' . $items['cart_jual_id']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                            </tr>

                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form action="<?php echo base_url() . 'admin/penjualan/simpan_penjualan' ?>" method="post">
                    <table>
                        <tr>
                            <td style="width:760px;" rowspan="2">
                                <a href="<?= base_url(). 'admin/penjualan/reset_penjualan';?>" class="btn btn-warning btn-lg"><span class="fa fa-refresh"></span>  Reset</a>
                                <button type="submit" class="btn btn-info btn-lg"><span class="fa fa-save"></span>  Simpan</button>
                            </td>
                            <th style="width:140px;">Total Belanja(Rp)</th>
                            <?php foreach ($totalbelanja->result_array() as $items) : ?>
                                <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?= number_format($items['total']); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                                <input type="hidden" id="total" name="total" value="<?= $items['total']; ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Tunai(Rp)</th>
                            <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                            <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Kembalian(Rp)</th>
                            <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="kembalian form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                        </tr>

                    </table>
                </form>
                <hr />
            </div>
            <!-- /.row -->
            <!-- ============ MODAL scanner =============== -->
            <div class="modal fade" id="ModalScanner" tabindex="-1" role="dialog" aria-labelledby="ModalScanner" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" onclick="stopcam()" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="myModalLabel">Scan Barcode</h3>
                        </div>
                        
                            <div class="modal-body">

                               <div class="panel-body text-center" >
                                    <canvas></canvas>
                                    <hr>
                                  <button title="Stop" class="btn btn-danger btn-sm"  onclick="stopcam()" type="button" data-dismiss="modal"><span class="fa fa-close"> Batal</span></button>
                                  </div>

                            </div>

                           
                       
                    </div>
                </div>
            </div>
            <!-- ============ MODAL scanner =============== -->
            
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
                                        <th style="width:240px;">Merek</th>
                                        <th style="width:240px;">Indikasi</th>
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
                                                <input type="hidden" name="kode_brg" class="imeibrg" value="<?php echo $kat_id ?>">
                                                <input type="hidden" name="nabar" value="<?php echo $kat_nama; ?>">
                                                <input type="hidden" name="stok" value="<?php echo $stok; ?>">
                                                <input type="hidden" name="harjul" value="<?php echo number_format($harjul); ?>">
                                                <input type="hidden" name="diskon" value="0">
                                                <input type="hidden" name="qty" id="idQty" value="1" required>
                                                <a href='javascript:void(0);' class="btn btn-xs btn-info btnpilih" data-imeiBrg="<?php echo $id; ?>" title="Pilih"><span class="fa fa-edit"></span> Pilih </a>
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

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p style="text-align:center;">Copyright &copy; <?php echo '2023'; ?> by Kopyus</p>
                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <!-- library scanner -->
        <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/qrcodelib.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/webcodecamjquery.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/webcodecamjs.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/main.js' ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() . 'assets/dist/js/bootstrap-select.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/moment.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>
        
        
       
        
        
       
        
        <script type="text/javascript">
           function playcam() {
              $("#ModalScanner").modal()
              var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
              decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
            }
            
            function stopcam() {
              var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
              decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).stop();
            }
            
            function cek_brg() {
            //$("#kode_brg").focus();
               var x = document.getElementById("kode_brg").value;
                    var kobar = {
                        kode_brg: x
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'admin/penjualan/get_barang'; ?>",
                        data: kobar,
                        success: function(msg) {
                            $('#detail_barang').html(msg);
                             $('#detail_barang').show();
                             
                             var ceknabar = document.getElementById("ceknabar").value;
                             if (ceknabar==""){
                                 alert("Kode barang/IMEI tidak ditemukan");
                             }else{
                                 $("#qty").focus();
                             }
                             
                        }
                    });
               

                
            }
            
            var arg = {
                resultFunction: function(result) {
                document.getElementById("kode_brg").value = result.code;
                //alert(result.code);
                stopcam();
                $("#ModalScanner").modal("hide");
                cek_brg();
                    }
                };
        </script>
        
        <script type="text/javascript">
            $(function() {
                $('#jml_uang').on("input", function() {
                    var total = $('#total').val();
                    var jumuang = $('#jml_uang').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    $('#jml_uang2').val(hsl);
                    $('#kembalian').val(hsl - total).priceFormat({
                        prefix: '',
                        allowNegative: true,
                        //centsSeparator: '',
                        centsLimit: 0,
                        thousandsSeparator: ','
                    });
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
                $('.harjul').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });
            });
        </script>
        // <script type="text/javascript">
             $(document).ready(function() {

        //         $("#kode_brg").focus();
        //         $("#kode_brg").on("input", function() {
        //             var kobar = {
        //                 kode_brg: $(this).val()
        //             };
        //             $.ajax({
        //                 type: "POST",
        //                 url: "<?php echo base_url() . 'admin/penjualan/get_barang'; ?>",
        //                 data: kobar,
        //                 success: function(msg) {
        //                     $('#detail_barang').html(msg);
        //                 }
        //             });
        //         });

        //         $("#kode_brg").keypress(function(e) {
        //             $('#detail_barang').show();
        //             $('#kode_brg').focus();
        //             if (e.which == 13) {
        //                 $("#jumlah").focus();
        //             }
        //         });

            $("#kode_brg").keypress(function(e) {
                    if (e.which == 13) {
                        //  var x = document.getElementById("kode_brg").value;
                        // alert(x);
                        cek_brg();
                        $("#qty").focus();
                    }
                });

        //         // $('#cek_merek_id').on('change', function() {
        //         //     const id_merek = $(this).val();
        //         //     const baseURL = "<?= base_url(); ?>";
        //         //     if (id_merek) {
        //         //         $.ajax({
        //         //             type: 'POST',
        //         //             url:"<?php echo base_url(); ?>admin/pembelian/cek_kategori_merek",
        //         //             dataType:'JSON',
        //         //             data: 'id_merek=' + id_merek,
        //         //             success: function(html) {
        //         //                 if (html.kategori == "handphone") {
        //         //                     document.getElementById("idQty").readOnly=true;
        //         //                 } else {
        //         //                     document.getElementById("idQty").readOnly=false;
        //         //                 }
        //         //                 // alert(html.kategori);
        //         //             }
        //         //         });
        //         //     }
        //         // });
             });
        // </script>

        <script type="text/javascript">
            $(document).ready(function() {

                $(".btnpilih").on("click", function() {
                    var brgImei = $(this).attr("data-imeiBrg");
                    console.log('ini btn pilih^^');
                    console.log(brgImei);
                    
                    $("#kode_brg").val(brgImei).trigger('change');
                    cek_brg();
                    $("#largeModal").modal('hide');
                });
                
                $('#largeModal').on('hidden.bs.modal', function () {
                    $('#detail_barang').show();
                    $('#kode_brg').focus();
                    // alert('ok');
                });
            });
        </script> 
          
    <script type="text/javascript">
        $(document).ready(function() {
            cek_crbyr();
            $("select.crbyr").change(function() {
               cek_crbyr();
            });
        });
    </script>
     <script type="text/javascript">
       function cek_crbyr(){
            const selectedCrByr = $('#carabayar').val();
                if (selectedCrByr == "Kredit") {
                    $('#targethide1').show();
                    $('#targethide2').show();
                    // $('#targethide3').show();
                    // $('#targethide4').show();
                } else {
                    $('#targethide1').hide();
                    $('#targethide2').hide();
                    // $('#targethide3').hide();
                    // $('#targethide4').hide();
                }
       }
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