<!DOCTYPE html>
<html>

<head>
	<title>APOTEK SAMUDRA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Made By Kopyus @2022">
	<meta name="author" content="Kopyus">
	<!-- Bootstrap -->
	<link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
	<!-- styles -->
	<link href="<?php echo base_url() . 'assets/css/stylesl.css' ?>" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url() . 'assets/img/logo.png' ?>">


</head>

<body class="login-bg">


	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
					<div class="box">
						<div class="content-wrap">
							<img width="310px" src="<?php echo base_url() . 'assets/img/logo_teks.png' ?>" />
							<!-- <h1>Logo CV</h1> -->
							<h5 style="color:red"><?php echo $this->session->flashdata('msg'); ?></h5>
							<hr />
							<form action="<?php echo base_url() . 'administrator/cekuser' ?>" method="post">
								<input class="form-control" type="text" name="username" placeholder="Username" required autofocus>
								<input class="form-control" type="password" name="password" placeholder="Password" required>
								<select class="form-control" name="level" required>
									<option value="notoko">-- Login Sebagai --</option>
									    <option value="3">Kasir</option>
										<option value="2">Owner</option>
								        <option value="1">Admin</option>
								</select>
								<div class="action">
									<button type="submit" class="btn btn-lg btn-primary ">Login</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>

</body>

</html>