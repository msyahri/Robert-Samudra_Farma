<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Made By Kopyus @2020">
    <meta name="author" content="Kopyus">

    <title>Data History Mutasi</title>

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
    
    <!--cdn-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/af-2.3.7/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/cr-1.5.4/date-1.1.0/fc-3.3.3/fh-3.1.9/kt-2.6.2/r-2.2.8/rg-1.1.3/rr-1.2.8/sc-2.0.4/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css"/>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">-->
    
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
                    <small>History Mutasi</small>
                    <!--<a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Bantuan?</small></a>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-condensed" style="font-size:11px;margin-top:10px;" id="mydata">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>IMEI</th>
                            <th >Nama Merek</th>
                            <th>Toko Asal</th>
                            <th>Toko Tujuan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <hr />
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
    <!--<script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.min.js' ?>"></script>-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>
    
    
    <!--cdn-->
    <!--<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>-->
    <!--<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>-->
    
    <!-- DataTables -->
    <!--<link rel="stylesheet" href="{{url('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">-->
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/af-2.3.7/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/cr-1.5.4/date-1.1.0/fc-3.3.3/fh-3.1.9/kt-2.6.2/r-2.2.8/rg-1.1.3/rr-1.2.8/sc-2.0.4/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.js"></script>
    
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
            $(document).ready(function(e){
              var base_url = "<?php echo base_url();?>"; // You can use full url here but I prefer like this
              $('#mydata').DataTable({
                 "pageLength" : 10,
                 "processing": true,
                 "serverSide": true,
                 "order": [[4, "desc" ]],
                 "ajax":{
                          url :  base_url+'admin/historymutasi/showMutasi',
                          type : 'POST'
                        },
                        
                columns: [
                    {data: "null", "sortable": false ,render: function (data,type,row,meta){
                            return meta.row + meta.settings._iDisplayStart +1;
                    }},
                    {data: "0",},
                    {data: "1",},
                    {data: "2",},
                    {data: "3",},
                    {data: "4",},
                    ]
              }); // End of DataTable
            }); // End Document Ready Function
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
                        url: "<?php echo base_url() . 'admin/retur/get_barang'; ?>",
                        data: kobar,
                        success: function(msg) {
                            $('#detail_barang').html(msg);
                        }
                    });
                });

                $("#kode_brg").keypress(function(e) {
                    if (e.which == 13) {
                        $("#jumlah").focus();
                    }
                });
            });
        </script>


</body>

</html>