	<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Made By Kopyus @2020">
		<meta name="author" content="Kopyus">

		<title>Data Service</title>

		<!-- Bootstrap Core CSS -->
		<link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
		<link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
		<link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="<?php echo base_url() . 'assets/css/4-col-portfolio.css' ?>" rel="stylesheet">
		<link href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">
		<link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>" rel="stylesheet">
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
						<small>Service</small>
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
								<th style="text-align:center;width:40px;">No</th>
								<th>No. Service Faktur</th>
								<th>Nama Service</th>
								<th>Harga Service</th>
								<th>Toko</th>
								<th>Kasir</th>
								<th>Customer</th>
								<th>Tanggal</th>
								<th>Qty</th>
								<th style="width:100px;text-align:center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($service->result_array() as $a) :
								$no++;
								$id = $a['service_nofak'];
								$nama_service = $a['d_service_nama'];
								$harga_service = $a['d_service_barang_har_srp_pot'];
								$toko_service = $a['service_toko'];
								$kasir_service = $a['user_nama'];
								$customer_service = $a['customer_nama'];
								$tgl_service = $a['service_tanggal'];
								$qty_service = $a['d_service_qty'];
							?>
								<tr>
									<td style="text-align:center;"><?php echo $no; ?></td>
									<td><?php echo $id; ?></td>
									<td><?php echo $nama_service; ?></td>
									<td style="text-align:right;"><?php echo 'Rp ' . number_format($harga_service); ?></td>
									<td style="text-align:center;"><?php echo $toko_service; ?></td>
									<td style="text-align:center;"><?php echo $kasir_service; ?></td>
									<td style="text-align:center;"><?php echo $customer_service; ?></td>
									<td style="text-align:center;"><?php echo $tgl_service; ?></td>
									<td style="text-align:center;"><?php echo $qty_service; ?></td>
									<td style="text-align:center;">

										<a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-trash"></span></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.row -->

			<!-- ============ MODAL HAPUS =============== -->
			<?php
			foreach ($service->result_array() as $a) {
				$id = $a['service_nofak'];
				$nama_service = $a['d_service_nama'];
				$harga_service = $a['d_service_barang_har_srp_pot'];
				$toko_service = $a['service_toko'];
				$kasir_service = $a['user_nama'];
				$customer_service = $a['customer_nama'];
				$tgl_service = $a['service_tanggal'];
				$qty_service = $a['d_service_qty'];
			?>
				<div id="modalHapusPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 class="modal-title" id="myModalLabel">Hapus Service</h3>
							</div>
							<form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/service/hapus_service' ?>">
								<div class="modal-body">
									<p>Yakin menghapus data service <?php echo $id .' - '. $nama_service ;  ?>?</p>
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
			<?php
			}
			?>

			<!--END MODAL-->

			<hr>

			<!-- Footer -->
			<footer>
				<div class="row">
					<div class="col-lg-12">
						<p style="text-align:center;">Copyright &copy; <?php echo '2020'; ?> by Kopyus</p>
					</div>
				</div>
				<!-- /.row -->
			</footer>

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
		<script type="text/javascript">
			$(document).ready(function() {
				$('#mydata').DataTable();
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