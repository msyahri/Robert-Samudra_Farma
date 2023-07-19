<title>APOTEK SAMUDRA v.1.0</title>
<link rel="icon" href="<?php echo base_url() . 'assets/img/logo.png' ?>">

<?php
//$this->load->model('m_notifikasi');
$tgl_now=date("Y-m-d");
$notif_hutang =  $this->db->query("SELECT *, DATEDIFF(hutang_tempo,'$tgl_now') as sisa FROM tbl_hutang INNER JOIN tbl_beli ON tbl_beli.beli_nofak=tbl_hutang.hutang_id INNER JOIN tbl_suplier ON tbl_suplier.suplier_id=tbl_beli.beli_suplier_id WHERE DATEDIFF(hutang_tempo,'$tgl_now')<4 AND hutang_status=0");
$jml_hutang=$notif_hutang->num_rows();
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url() . 'welcome' ?>"> <span><img src="<?php echo base_url() . 'assets/img/logo.png' ?>" alt="Home" width="30px"> SAMUDRA FARMA</span></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php $h = $this->session->userdata('akses'); ?>
                <?php $u = $this->session->userdata('user'); ?>
                <?php if ($h == '1') { ?>
                    <!--dropdown-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Transaksi <span class="fa fa-caret-down" aria-hidden="true"></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url() . 'admin/pembelian' ?>"><span class="fa fa-shopping-bag" aria-hidden="true"></span> Pembelian</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/penjualan' ?>"><span class="fa fa-mobile" aria-hidden="true"></span> Penjualan</a>
                            </li>
                            
                           
                            <li>
                                <a href="<?php echo base_url() . 'admin/mutasi' ?>"><span class="fa fa-share-square" aria-hidden="true"></span> Mutasi Barang</a>
                            </li>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/invoice' ?>"><span class="fa fa-print" aria-hidden="true"></span> Cetak Invoice</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Produk"><span class="fa fa-briefcase" aria-hidden="true"></span> Data <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url() . 'admin/barang' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Data Produk</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/pembelian/tabel_pembelian' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Data Pembelian</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/penjualan/tabel_penjualan' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Data Penjualan</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/historymutasi' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Data Mutasi</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/merek' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Data Merek Barang</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/warna' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Data Warna Barang</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/warna' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Data Rak Obat</a>
                            </li>
                        </ul>
                    </li>
                    <!--ending dropdown-->
                    <li class="<?= ($this->uri->segment(2) == "suplier") ? "active" : "" ?>">
                        <a href="<?php echo base_url() . 'admin/suplier' ?>"><span class="fa fa-institution"></span> Suppliers</a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) == "customer") ? "active" : "" ?>">
                        <a href="<?php echo base_url() . 'admin/customer' ?>"><span class="fa fa-user"></span> Customers</a>
                    </li>
                    
                    <li>
                        <a href="<?php echo base_url() . 'admin/grafik' ?>"><span class="fa fa-line-chart"></span> Grafik</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . 'admin/laporan' ?>"><span class="fa fa-file"></span> Laporan</a>
                    </li>
                    
                    
                    <li class="dropdown">
                        <a href="#" class="notification" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Produk"><span class="fa fa-bell"></span> Notif <span class="badge"><?= $jml_hutang; ?></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach($notif_hutang->result() as $list_hutang){
                               // $jatuh_tempo=new date($list_hutang->hutang_tempo);
                               // $abc=new date($tgl_now);
                               // $sisa_waktu=date_diff($abc,$abc);
                               if($list_hutang->sisa>=0){
                                   $kata="lagi";
                               }else{
                                   $kata="lalu";
                               }
                            ?>
                            <li>
                                <form id='add-row-form' action='<?=base_url('admin/hutang/detail_hutang')?>' method='post'><input type='hidden' name='hutang_id' value='<?= $list_hutang->hutang_id ?>'><button type='submit' class='btn btn' style='background-color:white'><span class="fa fa-hourglass-end" aria-hidden="true"></span> <?= $list_hutang->suplier_nama ?> - <?= $list_hutang->beli_nofak ?> (<?= $list_hutang->sisa ;?> hari <?= $kata ?>)</button></form>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($h == '2') { ?>
                    <!--dropdown-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Transaksi <span class="fa fa-caret-down" aria-hidden="true"></a>
                        <ul class="dropdown-menu">
                            <!--<li>-->
                            <!--    <a href="<?php echo base_url() . 'admin/pembelian' ?>"><span class="fa fa-shopping-bag" aria-hidden="true"></span> Pembelian</a>-->
                            <!--</li>-->
                            <li>
                                <a href="<?php echo base_url() . 'admin/penjualan' ?>"><span class="fa fa-mobile" aria-hidden="true"></span> Penjualan (Handphone)</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Produk"><span class="fa fa-briefcase" aria-hidden="true"></span> Produk <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url() . 'admin/barang' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Barang</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/merek' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Merek Produk</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'admin/warna' ?>"><span class="fa fa-briefcase" aria-hidden="true"></span> Indikasi Obat</a>
                            </li>
                        </ul>
                    </li>
                    <!--ending dropdown-->
                    <!--<li class="<?= ($this->uri->segment(2) == "suplier") ? "active" : "" ?>">-->
                    <!--    <a href="<?php echo base_url() . 'admin/suplier' ?>"><span class="fa fa-institution"></span> Suppliers</a>-->
                    <!--</li>-->
                    <!--<li class="<?= ($this->uri->segment(2) == "customer") ? "active" : "" ?>">-->
                    <!--    <a href="<?php echo base_url() . 'admin/customer' ?>"><span class="fa fa-user"></span> Customers</a>-->
                    <!--</li>-->
                    
                    <!--<li>-->
                    <!--    <a href="<?php echo base_url() . 'admin/grafik' ?>"><span class="fa fa-line-chart"></span> Grafik</a>-->
                    <!--</li>-->
                    <li>
                        <a href="<?php echo base_url() . 'admin/laporan' ?>"><span class="fa fa-file"></span> Laporan</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="<?php echo base_url() . 'administrator/logout' ?>"><span class="fa fa-sign-out"></span> Logout</a>
                </li>
            </ul>


        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<script type="text/javascript">
    // $(document).ready(function(){
    //     tampil_data_jadwal();  //pemanggilan fungsi tampil mhs.
        
    //     $('#mydata').dataTable();
         
    //     //fungsi tampil mhs
    //     function tampil_data_jadwal(){
    //         $.ajax({
    //             type  : 'POST',
    //             url   : '<?php echo base_url()?>index.php/welcome/tampil_notif',
    //             async : false,
    //             dataType : 'json',
    //             success : function(data){
    //                 var html = '';
    //                 var i;
    //                 for(i=0; i<data.length; i++){
    //                     html += '<tr>'+
    //                             '<td>'+(i+1)+'</td>'+
    //                             '<td>'+data[i].NAMA_JADWAL+'</td>'+
    //                             '<td>'+data[i].TGL_DAFTAR1+'<br> s/d <br>'+data[i].TGL_DAFTAR2+'</td>'+
    //                             '<td>'+data[i].TGL_TPA1+'</td>'+
    //                             '<td>'+data[i].TGL_KESEHATAN1+'</td>'+
    //                             '<td>'+data[i].TGL_WAWANCARA1+'</td>'+
    //                             '<td>'+data[i].TGL_PENGUMUMAN1+'</td>'+
                                
    //                             '<td style="text-align:right;">'+
    //                               '<a href="javascript:;" class="btn btn-warning item_edit" data="'+data[i].ID_JADWAL+'" style="background:#f39c12"> Edit </a>'+' '+
    //                               '<a href="javascript:;" class="btn btn-danger item_hapus" data="'+data[i].ID_JADWAL+'"> Hapus </a>'+
    //                             '</td>'+
    //                             '</tr>';
    //                 }
    //                 $('#show_data').html(html);
    //             }

    //         });
    //     }

           
        

        

        

       
            
        

    // });

</script>