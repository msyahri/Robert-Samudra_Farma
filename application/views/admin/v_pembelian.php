<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Made By Kopyus @2023">
    <meta name="author" content="Kopyus">

    <!-- <title>Home Cell v.1.0</title> -->

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
                <h1 class="page-header">Pembelian
                    <small>Barang</small>
                    <div class="pull-right">
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#Warna"><span class="fa fa-plus"></span> Indikasi</a>
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#Merek"><span class="fa fa-plus"></span> Merek</a>
                    </div>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <form action="<?php echo base_url() . 'admin/pembelian/add_to_cart' ?>" method="post">
                    <table>
                        <tr>
                            <!-- <th style="width:90px;padding-bottom:5px;">Suplier</th> -->
                            <th style="width:100px;padding-bottom:5px;">Suplier</th>
                            <!-- <td style="width:350px;"> -->
                            <td style="padding-bottom:5px;">
                                <select name="suplier" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Suplier" data-width="100%" required>
                                    <?php foreach ($sup->result_array() as $i) {
                                        $id_sup = $i['suplier_id'];
                                        $nm_sup = $i['suplier_nama'];
                                        $al_sup = $i['suplier_alamat'];
                                        $notelp_sup = $i['suplier_notelp'];
                                        $sess_id = $this->session->userdata('suplier');
                                        if ($sess_id == $id_sup)
                                            echo "<option value='$id_sup' selected>$nm_sup - $al_sup - $notelp_sup</option>";
                                        else
                                            echo "<option value='$id_sup'>$nm_sup - $al_sup - $notelp_sup</option>";
                                    } ?>
                                </select>
                            </td>
                            <td style="width:20px;"></td>
                            <th style="width:60px;padding-bottom:5px;">Tanggal</th>
                            <td>
                                <div class='input-group date ml-3' id='datepicker' style="width:300px;">
                                    <input type='text' name="tgl" class="form-control" value="<?php echo $this->session->userdata('tglfak'); ?>" placeholder="Tanggal..." required />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <th style="width:100px;padding-bottom:5px;" >cara bayar</th>
                            <!-- <td style="width:350px;"> -->
                            <td style="width:300px;padding-bottom:5px;">
                                <select name="cara_byr" class="selectpicker show-tick form-control crbyr" id="carabayar" data-live-search="true" title="Pilih Cara Bayar" data-width="100%" required>
                                    <option <?= ($this->session->userdata('cara_byr') == "Tunai") ? " selected" : "" ?> value="Tunai">Tunai</option>
                                    <option <?= ($this->session->userdata('cara_byr') == "Debit") ? " selected" : "" ?> value="Debit">Debit</option>
                                    <option <?= ($this->session->userdata('cara_byr') == "Kredit") ? " selected" : "" ?> value="Kredit">Kredit</option>
                                </select>
                            </td>

                            <td style="width:20px;"></td>
                            <th id="targethide1" style="display: none;">Tempo</th>
                            <td id="targethide2" style="display: none;">
                                <div class='input-group date ml-3' id='datepicker2' style="width:300px;">
                                    <input type='text' name="tgl_tempo" class="form-control" value="<?php echo $this->session->userdata('tgl_tempo'); ?>" placeholder="Tanggal..." />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th style="width:100px;padding-bottom:5px;">No Faktur</th>
                            <th style="width:300px;padding-bottom:5px;"><input type="text" name="nofak" value="<?php echo $this->session->userdata('nofak'); ?>" class="form-control input-sm" style="width:300px;" required></th>
                            <td style="width:20px;"></td>
                            <th id="targethide3" style="display: none;">Bayar</th>
                            <td id="targethide4" style="display: none;">
                                <div class='input-group date ml-3' style="width:300px;">
                                    <input type='text' name="jml_byr" class="form-control" value="<?php echo $this->session->userdata('jml_byr'); ?>" placeholder="Masukan Jumlah Bayar (Wajib di isi)..." />
                                </div>
                            </td>
                        </tr>
                    </table>

                    <hr />


                    <table>
                        <tr>
                            <th class="text-center">Kode Barang</th>
                            <th class="text-center">Merek</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Harga Pokok</th>
                            <th class="text-center">Harga SRP</th>
                            <th class="text-center">Harga Min</th>
                            <th class="text-center">Harga Max</th>
                            <th class="text-center">Jumlah</th>
                        </tr>
                        <tr>
                            <td style="padding-right:5px;">
                                <input type="text" name="imei" id="imei" class="form-control input-sm">
                            </td>
                            <td style="padding-right:5px;">
                                <select name="merek" id="combo_merek" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Merek" data-width="100%" required>
                                    <?php foreach ($merk->result_array() as $i) {
                                        $id_merk = $i['merek_id'];
                                        $nm_merk = $i['nama_merek'];
                                        $sess_merk = $this->session->userdata('merek');
                                        if ($sess_merk == $id_merk)
                                            echo "<option value='$id_merk' selected>$nm_merk</option>";
                                        else
                                            echo "<option value='$id_merk'>$nm_merk</option>";
                                    } ?>
                                </select>
                            </td>
                            <td style="padding-right:5px;">
                                <select name="warna" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Warna" data-width="100%" required>
                                    <?php foreach ($warna->result_array() as $i) {
                                        $id_warna = $i['warna_id'];
                                        $nm_warna = $i['warna'];
                                        $sess_warna = $this->session->userdata('warna');
                                        if ($sess_warna == $id_warna)
                                            echo "<option value='$id_warna' selected>$nm_warna</option>";
                                        else
                                            echo "<option value='$id_warna'>$nm_warna</option>";
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="harpok" value="" style="width:130px;margin-right:5px;" class="form-control input-sm" required>
                            </td>
                            <td>
                                <input type="text" name="harsrp" value="" style="width:130px;margin-right:5px;" class="form-control input-sm" required>
                            </td>
                            <td><input type="text" name="harmin" id="harmin" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
                            <td><input type="text" name="harmax" id="harmax" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
                            <td><input type="text" value="1" name="jumlah" id="jumlah" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
                            <td><input type="submit" id="btnOk" value="OK" class="btn btn-sm btn-primary" placeholder="OK"></td>
                        </tr>
                    </table>
                </form>
                <table class="table table-bordered table-condensed" style="font-size:12px;margin-top:10px;">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Merek</th>
                            <th>Satuan</th>
                            <th>Harga Pokok</th>
                            <th>Harga SRP</th>
                            <th>Harga Min</th>
                            <th>Harga Max</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($cartbrg->result_array() as $items) : ?>
                            <?php echo form_hidden($i . '[cart_id]', $items['cart_id']); ?>
                            <tr>
                                <td><?= $items['cart_imei']; ?></td>
                                <td><?= $items['cart_merek_barang']; ?></td>
                                <td style="text-align:center;"><?= $items['cart_warna']; ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['cart_harga_pokok']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['cart_harga_srp']); ?></td>
                                <td style="text-align:center;"><?php echo number_format($items['cart_harga_min']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['cart_harga_max']); ?></td>
                                <td><?= $items['cart_jumlah']; ?></td>
                                <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/pembelian/remove/' . $items['cart_id']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" style="text-align:center;">Total</td>
                            <?php foreach ($carttotal->result_array() as $i) : ?>
                            <td style="text-align:right;">Rp. <?php echo number_format($i['total']); ?></td>
                        <?php endforeach; ?>
                        </tr>
                    </tfoot>
                    
                </table>
                 <!--<input type="text" id="total" name="total" value="<?php echo $this->cart->total(); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>-->
                <a href="<?= base_url(). 'admin/pembelian/reset_pembelian';?>" class="btn btn-warning btn-lg"><span class="fa fa-refresh"></span>  Reset</a>
                <a href="<?php echo base_url() . 'admin/pembelian/simpan_pembelian' ?>" class="btn btn-info btn-lg"><span class="fa fa-save"></span> Simpan</a>
            </div>
        </div>
        <!-- /.row -->

        <hr>
        <!-- Footer -->
        <?php
    $this->load->view('admin/footer');
    ?>

    </div>
    <!-- /.container -->

    <!-- ============ MODAL ADD Merek =============== -->
    <div class="modal fade" id="Merek" tabindex="-1" role="dialog" aria-labelledby="Merek" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Tambah Merek</h3>
                </div>

                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/merek/tambah_merek2' ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Nama Merek</label>
                            <div class="col-xs-9">
                                <input name="merek" class="form-control" type="text" placeholder="Nama merek..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Kategori Merek</label>
                            <div class="col-xs-9">
                                <select class="selectpicker show-tick form-control" name="kategori" id="kategori">
                                    <option value="0">Handphone</option>
                                    <option value="1">Accessories</option>
                                </select>
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
    <!-- ============ MODAL ADD Warna =============== -->
    <div class="modal fade" id="Warna" tabindex="-1" role="dialog" aria-labelledby="warna" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Tambah Indikasi</h3>
                </div>

                <form class="form-horizontal text-center" method="post" action="<?php echo base_url() . 'admin/warna/tambah_warna2' ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Indikasi</label>
                            <div class="col-xs-9">
                                <input name="warna" class="form-control" type="text" placeholder="Nama warna..." required>
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
            $('#datetimepicker').datetimepicker({
                format: 'DD MMMM YYYY HH:mm',
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
    <script type="text/javascript">
        $(function() {
            $('.harpok').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: ','
            });
            $('.harsrp').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: ','
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            
            $("#imei").focus();

            $("#imei").keypress(function(e) {
                if (e.which == 13) {
                    $("#jumlah").focus();
                }
            });
            
            $("#combo_merek").on("change", function () {
              const id_merek = $(this).val();
              const baseURL = "<?= base_url(); ?>";
              if (id_merek) {
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>admin/pembelian/cek_kategori_merek",
                  dataType: "JSON",
                  data: "id_merek=" + id_merek,
                  success: function (html) {
                    if (html.kategori == "handphone") {
                      document.getElementById("jumlah").readOnly = true;
                    }
                    // alert(html.kategori);
                  },
                  error: function(html) {
                      alert(html)
                  }
                });
              }
            });
            
            $("#imei").on("change", function () {
              let id_merek = $(this).val();
              const baseURL = "<?= base_url(); ?>";
              if (id_merek) {
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>admin/pembelian/cek_duplikasi_imei",
                  dataType: "JSON",
                  data: "id_merek=" + id_merek,
                  success: function (response) {
                    const result = response.imei;
                    updateFormUI(result)
                  },
                  error: function (response) {
                      if(response.imei == undefined){
                        document.getElementById("jumlah").readOnly = false;
                        document.getElementById("btnOk").disabled = false;
                      }
                  }
                });
              }
            });
            
            function updateFormUI(result) {
                if (result == "duplikasi") {
                    alert("IMEI Barang sudah ada! Cek Data Barang!");
                    $("btnOk").attr("disabled", "disabled");
                    document.getElementById("jumlah").readOnly = true;
                    document.getElementById("btnOk").disabled = true;
                }
            }

        });
    </script>
    
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000);
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
                    $('#targethide3').show();
                    $('#targethide4').show();
                } else {
                    $('#targethide1').hide();
                    $('#targethide2').hide();
                    $('#targethide3').hide();
                    $('#targethide4').hide();
                }
       }
    </script>
</body>

</html>