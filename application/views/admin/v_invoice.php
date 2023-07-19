<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Made By Kopyus @2020">
    <meta name="author" content="Kopyus">

    <title>Invoice Penjualan</title>

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
                <h1 class="page-header">Invoice
                    <small>Penjualan</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <form action="<?php echo base_url() . 'admin/invoice/show_invoice' ?>" method="post"  target="_blank">
                    <table>
                        <tr>
                            <th>No. Faktur</th>
                        </tr>
                        <tr>
                            <th><input type="text" name="nofak" id="nofak" class="form-control input-sm"></th>
                        </tr>
                        <div id="detail_barang" style="position:absolute;">
                        </div>
                    </table>
                </form>
                <br />

                <hr />
            </div>
            <!-- /.row -->
           

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
            $(document).ready(function() {
                $('#mydata2').DataTable();
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
                //Ajax kabupaten/kota insert
                $("#nofak").focus();
                $("#nofak").on("input", function() {
                    var kobar = {
                        nofak: $(this).val()
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'admin/invoice/get_penjualan'; ?>",
                        data: kobar,
                        success: function(msg) {
                            $('#detail_barang').html(msg);
                        }
                    });
                });

                $("#nofak").keypress(function(e) {
                    if (e.which == 13) {
                        $("#jumlah").focus();
                    }
                });
            });
        </script>


</body>

</html>