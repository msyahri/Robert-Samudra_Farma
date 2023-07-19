<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Made By Kopyus @2022">
    <meta name="author" content="Kopyus">
<link rel="icon" href="<?php echo base_url() . 'assets/img/logo.png' ?>">
    <title>APOTEK SAMUDRA v.1.0</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() . 'assets/css/4-col-portfolio.css' ?>" rel="stylesheet">

    <style type="text/css">
        .bg {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: -1;
            float: left;
            left: 0;
            margin-top: -20px;
        }
        body {
              background: rgb(0,0,0);
            background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(65,9,121,1) 30%, rgba(28,27,71,1) 50%, rgba(69,8,97,1) 70%, rgba(5,36,42,1) 100%);
        }
        
    </style>
</head>

<body>
    <img src="<?php echo base_url() . 'assets/img/bg5.jpg' ?>" alt="gambar" class="bg" />
    <!-- Navigation -->
    <?php
    $this->load->view('admin/menu');
    ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:#e1f7d5;"><?= $this->session->userdata('tokonama'); ?>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="mainbody-section text-center">
            <?php $h = $this->session->userdata('akses'); ?>
            <?php $u = $this->session->userdata('user'); ?>

            <!-- Projects Row 1-->
            <div class="row">
                <?php if ($h == '1') { ?>
                    <div class="col-md-3 portfolio-item ">
                        <div class="menu-item blue-fb" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/penjualan' ?>" data-toggle="modal">
                                <i class="fa fa-fax"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Penjualan</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item light-red" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/pembelian' ?>" data-toggle="modal">
                                <i class="fa fa-truck"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Pembelian</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item light-orange" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/barang' ?>" data-toggle="modal">
                                <i class="fa fa-medkit"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Produk</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item light-orange" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/barang' ?>" data-toggle="modal">
                                <i class="fa fa-search"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Cari</p>
                            </a>
                        </div>
                    </div>
                    
                <?php } ?>
                <?php if ($h == '2') { ?>

                <?php } ?>
            </div>

            <!-- /.row -->

            <!-- Projects Row 2-->
            <div class="row">
                <?php if ($h == '1') { ?>
                    
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item red" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/pengguna' ?>" data-toggle="modal">
                                <i class="fa fa-user"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">User</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item blue-fb" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/customer' ?>" data-toggle="modal">
                                <i class="fa fa-users"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Customer</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item light-orange" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/suplier' ?>" data-toggle="modal">
                                <i class="fa fa-address-card"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Suplier</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item color" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/mutasi' ?>" data-toggle="modal">
                                <i class="fa fa-archive"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Stok Opname</p>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($h == '2') { ?>

                   
                    
                <?php } ?>
            </div>

            <!-- Projects Row 3-->
            <div class="row">
                <?php if ($h == '1') { ?>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item color" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/mutasi' ?>" data-toggle="modal">
                                <i class="fa fa-share-square"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Rak Obat</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item light-red" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/grafik' ?>" data-toggle="modal">
                                <i class="fa fa-line-chart"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Grafik</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item green" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/laporan' ?>" data-toggle="modal">
                                <i class="fa fa-bar-chart"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Laporan</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item blue-fb" style="height:150px;">
                            <a href="#<?php echo base_url() . 'admin/suplier' ?>" data-toggle="modal">
                                <i class="fa fa-bell"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Notifikasi</p>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($h == '2') { ?>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item purple-fb" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/service' ?>" data-toggle="modal">
                                <i class="fa fa-mobile"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Service</p>
                            </a>
                        </div>
                    </div>
                    
                    <!-- <div class="col-md-3 portfolio-item">
                        <div class="menu-item color" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/mutasi' ?>" data-toggle="modal">
                                <i class="fa fa-share-square"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Mutasi</p>
                            </a>
                        </div>
                    </div> -->
                    <!-- <div class="col-md-3 portfolio-item">
                        <div class="menu-item light-red" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/grafik' ?>" data-toggle="modal">
                                <i class="fa fa-line-chart"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Grafik</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item green" style="height:150px;">
                            <a href="<?php echo base_url() . 'admin/laporan' ?>" data-toggle="modal">
                                <i class="fa fa-bar-chart"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Laporan</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 portfolio-item">
                        <div class="menu-item blue-fb" style="height:150px;">
                            <a href="#<?php echo base_url() . 'admin/suplier' ?>" data-toggle="modal">
                                <i class="fa fa-bell"></i>
                                <p style="text-align:center;font-size:24px;padding-left:5px;">Notifikasi</p>
                            </a>
                        </div>
                    </div> -->
                <?php } ?>
            </div>

            <!-- /.row -->

            <!-- /.container -->
            
                   <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <p style="text-align:center; color:white;">
                                Copyright &copy; <?php echo '2022'; ?>
                                APOTEK SAMUDRA
                            </p>
                            <p style="text-align:center; color:white;">
                                by Robert
                            </p>
                        </div>
                    </div>
                    <!-- /.row -->
                </footer>

            <!-- jQuery -->
            <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
            <script src="https://kit.fontawesome.com/2a647ef5f0.js" crossorigin="anonymous"></script>

</body>

</html>