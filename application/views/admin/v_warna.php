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
                <h1 class="page-header">Warna
                    <small>Barang</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Warna</a></div>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-hover table-condensed" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th>Warna</th>
                            <th style="width:140px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data->result_array() as $a) :
                            $no++;
                            $id = $a['warna_id'];
                            $nm = $a['warna'];
                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td><?php echo $nm; ?></td>
                                <td style="text-align:center;">
                                    <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                                    <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-trash"></span> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
</body>

</html>

<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Form Tambah Warna</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/warna/tambah_warna' ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3">Nama Warna</label>
                        <div class="col-xs-9">
                            <input name="warna" class="form-control" type="text" placeholder="Input Nama Warna..." required>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============ MODAL EDIT =============== -->
<?php
foreach ($data->result_array() as $a) {
    $id = $a['warna_id'];
    $nm = $a['warna'];
?>
    <div id="modalEditPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Form Edit Warna</h3>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/warna/edit_warna' ?>">
                    <div class="modal-body">
                        <input name="kode" type="hidden" value="<?php echo $id; ?>">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Warna</label>
                            <div class="col-xs-9">
                                <input name="warna" class="form-control" type="text" value="<?php echo $nm; ?>" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>

<!-- ============ MODAL HAPUS =============== -->
<?php
foreach ($data->result_array() as $a) {
    $id = $a['warna_id'];
    $nm = $a['warna'];
?>
    <div id="modalHapusPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Konfimasi Hapus Warna</h3>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/warna/hapus_warna' ?>">
                    <div class="modal-body">
                        <p>Apakah anda yakin hapus warna <b><?php echo $nm; ?> </b>?</p>
                        <input name="kode" type="hidden" value="<?php echo $id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>

<!--END MODAL-->


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