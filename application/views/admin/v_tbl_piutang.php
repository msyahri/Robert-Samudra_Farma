<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Made By Kopyus @2020">
    <meta name="author" content="Kopyus">

    <title>Data Piutang</title>

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
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    
    
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
                    <small>Piutang</small>
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
                            <th>No Faktur</th>
                            <th>Customer</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <hr />
            </div>
           
            <hr>
          <!-- Modal delete Retur-->
          <form id="add-row-form" action="<?php echo base_url('admin/retur/hapus_retur');?>" method="post">
             <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
                       </div>
                       <div class="modal-body">
                            <input type="hidden" name="kode_retur" class="form-control" required>
                            <input type="hidden" name="kode_brg" class="form-control" required>
                            <input type="hidden" name="qty" class="form-control" required>
                            <p>Apakah anda yakin hapus retur IMEI: <b id="view_imei"> </b> ? </p>
                       </div>
                       <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-success">Yes</button>
                       </div>
                        </div>
                </div>
             </div>
         </form>
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
            $(document).ready(function(e){
              var base_url = "<?php echo base_url();?>"; // You can use full url here but I prefer like this
              $('#mydata').DataTable({
                 "pageLength" : 10,
                 "processing": true,
                 "serverSide": true,
                 "order": [[2, "desc" ]],
                 "ajax":{
                          url :  base_url+'admin/piutang/showpiutang',
                          type : 'POST'
                        },
                 columns: [
                    { data: "null", "sortable": false, render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; }},
                    { data: "0"},
                    { data: "1"},
                    { data: "2", displayFormat: "D MMMM YYYY" },
                    { data: "3", render: function (data) { return data == 1 ? "LUNAS" : "BELUM LUNAS"; }},
                    { data: "4" },
                ],
                columnDefs: [
                   { type: 'date-uk', targets: 0 }
                ],
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