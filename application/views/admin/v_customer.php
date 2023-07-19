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
                    <small>Customer</small>
                    <div class="pull-right">
                        <!--<a href="<?= base_url('admin/customer/export_excel'); ?>" class="btn btn-sm btn-success"><span class="fa fa-file"></span> Export Excel</a>-->
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Customer</a>
                    </div>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-condensed" id="mydata">
                    <thead class="thead-dark">
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th>Nama Customer</th>
                            <th>No Telp/HP</th>
                            <th>Alamat</th>
                            <!--<th>Date Created</th>-->
                            <!--<th>Total Transaksi</th>-->
                            <th style="text-align:center;width:100px;" >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
        <hr>
        <!-- Modal delete Customer-->
          <form id="add-row-form" action="<?php echo base_url('admin/customer/hapus_customer');?>" method="post">
             <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h4 class="modal-title" id="myModalLabel">Delete Customer</h4>
                       </div>
                       <div class="modal-body">
                            <input type="hidden" name="kode_customer" class="form-control" required>
                            <p>Apakah anda yakin hapus customer: <b id="view_nama"> </b> ? </p>
                       </div>
                       <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Ya</button>
                       </div>
                        </div>
                </div>
             </div>
         </form>
        
          <!-- Modal Update Customer-->
          <form id="add-row-form" class="form-horizontal" action="<?php echo site_url('admin/customer/edit_customer');?>" method="post">
             <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h4 class="modal-title" id="myModalLabel">Form Edit Customer</h4>
                       </div>
                       <div class="modal-body">
                           
                           <div class="form-group">
                                <label for="cust_id" class="control-label col-xs-3">Customer ID</label>
                                <div class="col-xs-9">
                                    <input type="text" name="cust_id" class="form-control" style="width:280px;" readonly>
                                </div>
                           </div>
                           <div class="form-group">
                                <label for="cust_nama" class="control-label col-xs-3">Nama Customer</label>
                                <div class="col-xs-9">
                                    <input type="text" name="cust_nama" class="form-control" style="width:280px;" required>
                               </div>
                           </div>
                           <div class="form-group">
                                <label for="cust_telp" class="control-label col-xs-3">No Telp</label>
                                <div class="col-xs-9">
                                    <input type="text" name="cust_telp" class="form-control" style="width:280px;" required>
                                </div>
                           </div>
                           <div class="form-group">
                                 <label for="cust_alamat" class="control-label col-xs-3">Alamat</label>
                                 <div class="col-xs-9">
                                    <input type="text" name="cust_alamat" class="form-control" style="width:280px;" required>
                                </div>
                            </div>
                       </div>
                       <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-info">Simpan</button>
                       </div>
                    </div>
                </div>
             </div>
           </form>
        
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Form Tambah Customer</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/customer/tambah_customer' ?>">
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

        <!-- ============ MODAL EDIT =============== -->
        <?php
        foreach ($data->result_array() as $a) {
            $id = $a['customer_id'];
            $nm = $a['customer_nama'];
            $notelp = $a['customer_telp'];
            $alamat = $a['customer_alamat'];
        ?>
            <div id="modalEditPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="myModalLabel">Form Edit Customer</h3>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/customer/edit_customer' ?>">
                            <div class="modal-body">
                                <input name="kode" type="hidden" value="<?php echo $id; ?>">

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Nama Customer</label>
                                    <div class="col-xs-9">
                                        <input name="nama" class="form-control" type="text" placeholder="Nama Customer..." value="<?php echo $nm; ?>" style="width:280px;" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-xs-3">No Telp/ HP</label>
                                    <div class="col-xs-9">
                                        <input name="notelp" class="form-control" type="text" placeholder="No Telp/HP..." value="<?php echo $notelp; ?>" style="width:280px;" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Alamat</label>
                                    <div class="col-xs-9">
                                        <input name="alamat" class="form-control" type="text" placeholder="Alamat..." value="<?php echo $alamat; ?>" style="width:280px;" required>
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
        <?php } ?>

        <!-- ============ MODAL HAPUS =============== -->
        <?php
        foreach ($data->result_array() as $a) {
            $id = $a['customer_id'];
            $nm = $a['customer_nama'];
            $notelp = $a['customer_telp'];
            $alamat = $a['customer_alamat'];
        ?>
            <div id="modalHapusPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="myModalLabel">Hapus customer</h3>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/customer/hapus_customer' ?>">
                            <div class="modal-body">
                                <p> Yakin hapus data <b><?php echo $nm; ?></b>?</p>
                                <input name="kode" type="hidden" value="<?php echo $id; ?>">
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!--END MODAL-->


           
    <?php
    $this->load->view('admin/footer');
    ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
    //

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
                 "order": [[0, "asc" ]],
                 "ajax":{
                          url :  base_url+'admin/customer/showCust',
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
                    ],
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'copy', 'csv', 'excel', 'pdf', 'print'
                    // ]
              }); // End of DataTable
              
              $('#mydata').on('click','.delete_record',function(){
                    var codeCust=$(this).data('codecust');
                    var codeNama=$(this).data('codenama');
                    $('#ModalDelete').modal('show');
                    $('[name="kode_customer"]').val(codeCust);
                    document.getElementById("view_nama").innerHTML = codeNama; //untuk alert
              });
              
              $('#mydata').on('click','.edit_record',function(){
                var id=$(this).data('editcustid');
                var nama=$(this).data('editcustnama');
                var telp=$(this).data('editcusttelp');
                var almt=$(this).data('editcustalmt');
                $('#ModalUpdate').modal('show');
                $('[name="cust_id"]').val(id);
                $('[name="cust_nama"]').val(nama);
                $('[name="cust_telp"]').val(telp);
                $('[name="cust_alamat"]').val(almt);
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

</body>

</html>