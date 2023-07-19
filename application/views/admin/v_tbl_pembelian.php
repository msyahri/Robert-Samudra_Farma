<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Made By Kopyus @2020">
    <meta name="author" content="Kopyus">

    <title>Management Data Barang</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() . 'assets/css/4-col-portfolio.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/dist/css/bootstrap-select.css' ?>" rel="stylesheet">
    
    
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
             <center><?php echo $this->session->flashdata('msg'); ?></center>
            <div class="col-lg-12">
                <h1 class="page-header">Data
                    <small>Pembelian</small>
                    <!-- <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Barang</a></div> -->
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-condensed" id="mydata">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>No. Faktur</th>
                            <th>IMEI</th>
                            <th>Nama Merek</th>
                            <th>Harga Pokok</th>
                            <th>Qty</th>
                            <th>Pembayaran</th>
                            <th>Tempo</th>
                            <th>Toko</th>
                            <th>Supplier</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
        
        <form id="add-row-form" action="<?php echo site_url('admin/pembelian/edit_pembelian'); ?>" method="post">
            <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Update Pembelian</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-md-center"> 
                                <div class="col col-lg-12">
                                    <div class="form-group">
                                        <label for="no_fak">No Faktur :</label>
                                        <input type="hidden" name="idbrg" class="form-control">
                                        <input type="hidden" name="belikode" class="form-control">
                                        <input type="text" name="no_fak" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl">Tanggal :</label>
                                        <input type="date" name="tgl" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="suplier">Suplier :</label>
                                        <select name="suplier" class="form-control" data-live-search="true" title="Pilih Suplier" data-width="100%" placeholder="Pilih Suplier">
                                           <?php foreach ($suplier->result_array() as $s) {
                                                $id_suplier = $s['suplier_id'];
                                                $nm_suplier = $s['suplier_nama'];
                                                echo "<option value='$id_suplier'>$nm_suplier</option>";
                                            } ?>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label for="pembayaran">Pembayaran :</label>
                                        <input type="text" name="pembayaran" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempo">Tempo :</label>
                                        <input type="date" name="tempo" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- Modal delete Beli-->
          <form id="add-row-form" action="<?php echo base_url('admin/pembelian/hapus_beli');?>" method="post">
             <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
                       </div>
                       <div class="modal-body">
                            <input type="hidden" name="imei" class="form-control" required>
                            <input type="hidden" name="belikode" class="form-control" required>
                            <p>Apakah anda yakin hapus pembelian IMEI: <b id="view_imei"> </b> ? </p>
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
        $(document).ready(function(e){
            var base_url = "<?php echo base_url();?>"; // You can use full url here but I prefer like this
            $('#mydata').DataTable({
                "pageLength" : 10,
                "processing": true,
                "serverSide": true,
                "order": [[0, "desc" ]],
                "ajax":{
                    url :  base_url+'admin/pembelian/showBarang',
                    type : 'POST'
                },
                columns: [
                    { data: "null", "sortable": false, render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; }},
                    { data: "0" },
                    { data: "1" },
                    { data: "2" },
                    { data: "3" },
                    { data: "4" , render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ) },
                    { data: "5" },
                    { data: "6" },
                    { data: "7" , render: function (data) { return data == "0000-00-00" ? "-" : data; }},
                    { data: "8" },
                    { data: "9" },
                    { data: "10" },
                ],
                // dom: 'Bfrtip',
                // buttons: [
                //     'colvis',
                //     'excel',
                //     'print'
                // ]
            }); // End of DataTable
            
            $('#mydata').on('click', '.edit_record', function() {
                var id = $(this).data('brgid');
                var belkod =  $(this).data('editbelikode');
                var noFak =  $(this).data('editnofak');
                var tgl =  $(this).data('edittgl');
                var sup =  $(this).data('editsupplier');
                var pemb =  $(this).data('editpembayaran');
                var tempo =  $(this).data('edittempo');
                
                
                $('#ModalUpdate').modal('show');
                $('[name="idbrg"]').val(id);
                $('[name="belikode"]').val(belkod);
                $('[name="no_fak"]').val(noFak);
                $('[name="tgl"]').val(tgl);
                $('[name="suplier"]').val(sup);
                $('[name="pembayaran"]').val(pemb);
                $('[name="tempo"]').val(tempo);
                
                $('[name="suplier"] option').filter(function() { 
                    return ($(this).val() == sup); //To select barang_merek_id
                }).prop('selected', true);
            });
            
            $('#mydata').on('click','.delete_record',function(){
                var imeiBrg=$(this).data('hapusimei');
                var beliKode=$(this).data('hapusbelikode');
                $('#ModalDelete').modal('show');
                $('[name="imei"]').val(imeiBrg);
                $('[name="belikode"]').val(beliKode);
                document.getElementById("view_imei").innerHTML = imeiBrg; //untuk alert
            });
        }); // End Document Ready Function 
        
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
        $(function() {
            $('.harpok').priceFormat({
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

</body>

</html>