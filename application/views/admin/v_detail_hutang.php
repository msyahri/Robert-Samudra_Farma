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
                <h1 class="page-header">Data
                    <small>Detail Hutang</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Bayar Hutang</a></div>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        
        <?php
            foreach ($data_hutang->result_array() as $a) :
            $nofak_hutang = $a['hutang_id'];
            $status_hutang = $a['hutang_status'];
            $tempo_hutang = $a['hutang_tempo'];
            $nama_suplier = $a['suplier_nama'];
            $alamat_suplier = $a['suplier_alamat'];
        ?>
            <table class="table table-striped table-condensed">
                <tr>
                    <th>No Faktur</th>
                    <td><input name="kode" type="text" readonly class="form-control" value="<?php echo $nofak_hutang; ?>"></td>
                    <th>Tempo</th>
                    <td><input name="kode" type="text" readonly class="form-control" value="<?php echo $tempo_hutang; ?>"></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><input name="kode" type="text" readonly class="form-control" value="<?php echo $status_hutang==1?"LUNAS":"BELUM LUNAS"; ?>"></td>
                    <th>Suplier</th>
                    <td><input name="kode" type="text" readonly class="form-control" value="<?php echo $nama_suplier?> - <?=$alamat_suplier; ?>"></td>
                </tr>
            </table>
        <?php endforeach; ?>
        
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-condensed" id="mydata">
                    <thead class="thead-dark">
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th>Hutang Awal</th>
                            <th>Hutang Bayar</th>
                            <th>Hutang Sisa</th>
                            <th>Tanggal Bayar</th>
                            <th style="width:140px;text-align:center;">Aksi</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data->result_array() as $a) :
                            $no++;
                            $id = $a['d_hutang_id'];
                            $awal = $a['hutang_awal'];
                            $akhir = $a['hutang_bayar'];
                            $sisa = $a['hutang_sisa'];
                            $tgl = $a['tanggal'];
                        ?>
                        <?php $numrow =  $data->num_rows(); ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td><?php echo $awal; ?></td>
                                <td><?php echo $akhir; ?></td>
                                <td><?php echo $sisa; ?></td>
                                <td><?php echo $tgl; ?></td>
                                <td style="text-align:center;">
                                    <?php if($no == $numrow && $no == 1) : ?>
                                        <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                                    <?php endif;?>
                                    <?php if($no == $numrow &&  $no != 1) :?>
                                        <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                                        <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-trash"></span> Hapus</a>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        
        <?php
            foreach ($data_hutang_last->result_array() as $a) {
                            $id_hutang = $a['hutang_id'];
                            $id = $a['d_hutang_id'];
                            $awal = $a['hutang_sisa'];
                            $akhir = $a['hutang_bayar'];
                            $tgl = $a['tanggal']; 
                        ?>
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Form Tambah Bayar Hutang</h4>
                    </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/hutang/tambah_detail_hutang' ?>">
                            <div class="modal-body">
                                <input name="kode" type="hidden" value="<?php echo $id_hutang; ?>">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Hutang saat ini</label>
                                    <div class="col-xs-9">
                                        <input name="awal" class="form-control" type="text" placeholder="Hutang saat ini..." value="<?php echo $awal; ?>" style="width:280px;" id="add_awal" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Bayar</label>
                                    <div class="col-xs-9">
                                        <input name="bayar" class="form-control" type="text" placeholder="Bayar..." style="width:280px;" id="add_bayar" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Sisa</label>
                                    <div class="col-xs-9">
                                        <input name="sisa" class="form-control" type="text" placeholder="perhitungan sisa"  style="width:280px;" id="add_sisa" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Tanggal</label>
                                    <div class="col-xs-9">
                                        <input name="tgl" class="form-control" type="date" style="width:280px;" required>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button type="submit" class="btn btn-info">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- ============ MODAL EDIT =============== -->
        <?php
        $i=0;
            foreach ($data->result_array() as $a) {
                $i++;
                            $id_hutang = $a['hutang_id'];
                            $id = $a['d_hutang_id'];
                            $awal = $a['hutang_awal'];
                            $akhir = $a['hutang_bayar'];
                            $sisa = $a['hutang_sisa'];
                            $tgl = $a['tanggal']; 
                        ?>
            <div id="modalEditPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Form Edit Supplier</h4>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/hutang/edit_detail_hutang' ?>">
                            <div class="modal-body">
                                <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Detail Hutang ID</label>
                                    <div class="col-xs-9">
                                        <input name="id_hutang" class="form-control" type="hidden" value="<?php echo $id_hutang; ?>" style="width:280px;" readonly>
                                        <input name="id" class="form-control" type="text" value="<?php echo $id; ?>" style="width:280px;" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Hutang saat ini</label>
                                    <div class="col-xs-9">
                                        <input name="awal" class="form-control" type="text" placeholder="Hutang saat ini..." value="<?php echo $awal; ?>" style="width:280px;" id="edit_awal<?= $i?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Bayar</label>
                                    <div class="col-xs-9">
                                        <input name="bayar" class="form-control" type="text" placeholder="Bayar..." value="<?php echo $akhir; ?>" style="width:280px;" id="edit_bayar<?= $i?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Sisa</label>
                                    <div class="col-xs-9">
                                        <input name="sisa" class="form-control" type="text" placeholder="perhitungan sisa" value="<?php echo $sisa; ?>" style="width:280px;" id="edit_sisa<?= $i?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Tanggal</label>
                                    <div class="col-xs-9">
                                        <input name="tgl" class="form-control" type="date" value="<?php echo $tgl; ?>" style="width:280px;" required>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button type="submit" class="btn btn-info">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <input name="loop" id="loop" class="form-control" type="hidden" value="<?= $i; ?>"   >

        <!-- ============ MODAL HAPUS =============== -->
         <?php
            foreach ($data->result_array() as $a) {
                            $id = $a['d_hutang_id'];
                            $id_hutang = $a['hutang_id'];
                            $awal = $a['hutang_awal'];
                            $akhir = $a['hutang_bayar'];
                            $sisa = $a['hutang_sisa'];
                            $tgl = $a['tanggal']; 
                        ?>
            <div id="modalHapusPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Detail Hutang</h4>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/hutang/hapus_detail_hutang' ?>">
                            <div class="modal-body">
                                <p> Apakah anda yakin hapus data?</p>
                                <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                <input name="kode_hutang" type="hidden" value="<?php echo $id_hutang; ?>">
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tidak</button>
                                <button type="submit" class="btn btn-danger">Ya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <!--END MODAL-->

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
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
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
                //Ajax bayar
              
                var last_id = $('#loop').val();
                $('#edit_bayar'+last_id).on("input", function() {
                    var asal = $('#edit_awal'+last_id).val();
                var bayar = $('#edit_bayar'+last_id).val();
               var total=asal-bayar;
                    $('#edit_sisa'+last_id).val(total);
                });
                $('#add_bayar').on("input", function() {
                    var asal = $('#add_awal').val();
                var bayar = $('#add_bayar').val();
               var total=asal-bayar;
                    $('#add_sisa').val(total);
                });
            });
        </script>
</body>

</html>