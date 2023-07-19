					<?php
					error_reporting(0);
					$b = $brg->row_array();
					?>
					<table>
						<tr>
							<th style="width:200px;"></th>
							<th>Tanggal Jual</th>
							<th>Customer</th>
							<th>Aksi</th>
						</tr>
						<tr>
							<td style="width:200px;">
								</th>
							<td><input type="text" name="tgl" value="<?php echo $b['jual_tanggal']; ?>" style="width:380px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="cust" value="<?php echo $b['customer_nama']; ?>" style="width:380px;margin-right:5px;" class="form-control input-sm" readonly></td>
							
							<td><button type="submit" style="margin-right:5px;" class="btn btn-sm btn-info"><span class="fa fa-print"></span> Cetak</button></td>
							<td><a href="<?= base_url('admin/invoice'); ?>" class="btn btn-sm btn-warning"><span class="fa fa-close"></span> Batal</a></td>
						</tr>
					</table>