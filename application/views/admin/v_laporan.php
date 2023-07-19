<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Made By Kopyus @2020">
    <meta name="author" content="Kopyus">

    <title>Home Cell v.1.0</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() . 'assets/css/4-col-portfolio.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-datetimepicker.min.css' ?>">
    <link href="<?php echo base_url() . 'assets/dist/css/bootstrap-select.css' ?>" rel="stylesheet">

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
                <h1 class="page-header">Data
                    <small>Laporan</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped table-condensed" style="font-size:12px;" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th>Laporan</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php $h = $this->session->userdata('akses'); ?>
                <?php $u = $this->session->userdata('user'); ?>
                <?php if ($h == '1') { ?>
                        <tr>
                            <td style="text-align:center;vertical-align:middle">1</td>
                            <td style="vertical-align:middle;">Laporan Data Barang</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="<?php echo base_url() . 'admin/laporan/lap_data_barang' ?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">2</td>
                            <td style="vertical-align:middle;">Laporan Data Barang PerToko</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_brg_pertoko" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">3</td>
                            <td style="vertical-align:middle;">Laporan Data SO PerToko</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_so_pertoko" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">4</td>
                            <td style="vertical-align:middle;">Laporan Pembelian Pilihan</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_pembelian_pilihan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">5</td>
                            <td style="vertical-align:middle;">Laporan Penjualan</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="<?php echo base_url() . 'admin/laporan/lap_data_penjualan' ?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">6</td>
                            <td style="vertical-align:middle;">Laporan Penjualan PerTanggal</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_jual_pertanggal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">7</td>
                            <td style="vertical-align:middle;">Laporan Penjualan PerBulan</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_jual_perbulan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">8</td>
                            <td style="vertical-align:middle;">Laporan Penjualan PerTahun</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_jual_pertahun" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">9</td>
                            <td style="vertical-align:middle;">Laporan Service</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="<?php echo base_url() . 'admin/laporan/lap_data_service' ?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">10</td>
                            <td style="vertical-align:middle;">Laporan Service PerTanggal</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_service_pertanggal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">11</td>
                            <td style="vertical-align:middle;">Laporan Service PerBulan</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_service_perbulan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">12</td>
                            <td style="vertical-align:middle;">Laporan Service PerTahun</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_service_pertahun" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">13</td>
                            <td style="vertical-align:middle;">Laporan Laba/Rugi</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_laba_rugi" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">14</td>
                            <td style="vertical-align:middle;">Laporan Laba/Rugi Pilihan</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_laba_rugi_pertanggal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>
                        
                         <tr>
                            <td style="text-align:center;vertical-align:middle">15</td>
                            <td style="vertical-align:middle;">Laporan Data Tempo</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_tempo_pilihan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align:center;vertical-align:middle">16</td>
                            <td style="vertical-align:middle;">Laporan Data Mutasi</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_mutasi_pilihan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align:center;vertical-align:middle">17</td>
                            <td style="vertical-align:middle;">Laporan Data Aset PerToko</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_aset_pertoko" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align:center;vertical-align:middle">18</td>
                            <td style="vertical-align:middle;">Laporan Data Retur Beli</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_retur_beli_pilihan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align:center;vertical-align:middle">19</td>
                            <td style="vertical-align:middle;">Laporan Data Retur Jual</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_retur_jual_pilihan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;vertical-align:middle">20</td>
                            <td style="vertical-align:middle;">Bonus Karyawan</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_bonus" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <?php } ?>
                        <?php if ($h == '2') { ?>
                          <tr>
                            <td style="text-align:center;vertical-align:middle">1</td>
                            <td style="vertical-align:middle;">Laporan Penjualan</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="<?php echo base_url() . 'admin/laporan/lap_data_penjualan' ?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">2</td>
                            <td style="vertical-align:middle;">Laporan Penjualan PerTanggal</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_jual_pertanggal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">3</td>
                            <td style="vertical-align:middle;">Laporan Penjualan PerBulan</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_jual_perbulan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;vertical-align:middle">4</td>
                            <td style="vertical-align:middle;">Laporan Penjualan PerTahun</td>
                            <td style="text-align:center;">
                                <a class="btn btn-sm btn-default" href="#lap_jual_pertahun" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                            </td>
                        </tr>
                        
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
        
         <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_bonus" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_bonus' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Dari Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker16' style="width:300px;">
                                        <input type='text' name="dari_tgl" class="form-control" value="" placeholder=" Dari Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Sampai Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker17' style="width:300px;">
                                        <input type='text' name="sampai_tgl" class="form-control" value="" placeholder=" Sampai Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Karyawan</label>
                                <div class="col-xs-9">
                                    <select name="karyawan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Karyawan" data-width="80%" required />
                                    <?php foreach ($karyawan->result_array() as $z) { ?>
                                        <option value="<?= $z['user_id']; ?>">
                                            <?= $z['user_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_penjualan_pertanggal' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker' style="width:300px;">
                                        <input type='text' name="tgl" class="form-control" value="" placeholder="Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <option value="semua_toko">Semua Toko</option>
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_penjualan_perbulan' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Bulan</label>
                                <div class="col-xs-9">
                                    <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required />
                                    <?php foreach ($jual_bln->result_array() as $k) {
                                        $bln = $k['bulan'];
                                    ?>
                                        <option><?php echo $bln; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <option value="semua_toko">Semua Toko</option>
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tahun</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_penjualan_pertahun' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Tahun</label>
                                <div class="col-xs-9">
                                    <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required />
                                    <?php foreach ($jual_thn->result_array() as $t) {
                                        $thn = $t['tahun'];
                                    ?>
                                        <option><?php echo $thn; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <option value="semua_toko">Semua Toko</option>
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_laba_rugi" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_laba_rugi' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Bulan</label>
                                <div class="col-xs-9">
                                    <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required />
                                    <?php foreach ($jual_bln->result_array() as $k) {
                                        $bln = $k['bulan'];
                                    ?>
                                        <option><?php echo $bln; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ========================MODAL PER TOKO ==================================================== -->
        <div class="modal fade" id="lap_brg_pertoko" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Toko</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_data_barang_pertoko' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--END MODAL-->
        
        <!-- ========================MODAL PER TOKO ==================================================== -->
        <div class="modal fade" id="lap_so_pertoko" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Toko</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_data_so_pertoko' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL-->
        
        <div class="modal fade" id="lap_aset_pertoko" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Toko</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_data_aset_pertoko' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_service_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_service_pertanggal' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker3' style="width:300px;">
                                        <input type='text' name="tglservice" class="form-control" value="" placeholder="Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_service_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_service_perbulan' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Bulan</label>
                                <div class="col-xs-9">
                                    <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required />
                                    <?php foreach ($service_bln->result_array() as $k) {
                                        $bln = $k['bulan'];
                                    ?>
                                        <option><?php echo $bln; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_service_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tahun</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_service_pertahun' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Tahun</label>
                                <div class="col-xs-9">
                                    <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required />
                                    <?php foreach ($service_thn->result_array() as $t) {
                                        $thn = $t['tahun'];
                                    ?>
                                        <option><?php echo $thn; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_pembelian_pilihan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_pembelian_pilihan' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Dari Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker6' style="width:300px;">
                                        <input type='text' name="dari_tgl" class="form-control" value="" placeholder=" Dari Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Sampai Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker7' style="width:300px;">
                                        <input type='text' name="sampai_tgl" class="form-control" value="" placeholder=" Sampai Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <option value="semua_toko">Semua Toko</option>
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_tempo_pilihan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_tempo_pilihan' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Dari Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker8' style="width:300px;">
                                        <input type='text' name="dari_tgl" class="form-control" value="" placeholder=" Dari Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Sampai Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker9' style="width:300px;">
                                        <input type='text' name="sampai_tgl" class="form-control" value="" placeholder=" Sampai Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <option value="semua_toko">Semua Toko</option>
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_mutasi_pilihan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_mutasi_pilihan' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Dari Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker10' style="width:300px;">
                                        <input type='text' name="dari_tgl" class="form-control" value="" placeholder=" Dari Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Sampai Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker11' style="width:300px;">
                                        <input type='text' name="sampai_tgl" class="form-control" value="" placeholder=" Sampai Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

  <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_retur_beli_pilihan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_retur_beli_pilihan' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Dari Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker12' style="width:300px;">
                                        <input type='text' name="dari_tgl" class="form-control" value="" placeholder=" Dari Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Sampai Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker13' style="width:300px;">
                                        <input type='text' name="sampai_tgl" class="form-control" value="" placeholder=" Sampai Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_retur_jual_pilihan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_retur_jual_pilihan' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Dari Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker14' style="width:300px;">
                                        <input type='text' name="dari_tgl" class="form-control" value="" placeholder=" Dari Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Sampai Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker15' style="width:300px;">
                                        <input type='text' name="sampai_tgl" class="form-control" value="" placeholder=" Sampai Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_laba_rugi_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/laporan/lap_laba_rugi_pilihan' ?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Dari Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker4' style="width:300px;">
                                        <input type='text' name="dari_tgl" class="form-control" value="" placeholder=" Dari Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Sampai Tanggal</label>
                                <div class="col-xs-9">
                                    <div class='input-group date' id='datepicker5' style="width:300px;">
                                        <input type='text' name="sampai_tgl" class="form-control" value="" placeholder=" Sampai Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Toko</label>
                                <div class="col-xs-9">
                                    <select name="toko" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Toko" data-width="80%" required />
                                    <option value="semua_toko">Semua Toko</option>
                                    <?php foreach ($datatoko->result_array() as $z) { ?>
                                        <option value="<?= $z['toko_id']; ?>">
                                            <?= $z['toko_nama']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <?php
    $this->load->view('admin/footer');
    ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() . 'assets/dist/js/bootstrap-select.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
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
            $('#datepicker3').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker4').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker5').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker6').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker7').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker8').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker9').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker10').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker11').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker12').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker13').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker14').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker15').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker16').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker17').datetimepicker({
                format: 'YYYY-MM-DD',
            });

            $('#timepicker').datetimepicker({
                format: 'HH:mm'
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
        });
    </script>

</body>

</html>