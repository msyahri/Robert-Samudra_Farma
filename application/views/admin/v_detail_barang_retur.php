					<?php
					error_reporting(0);
					$b = $brg->row_array();
					?>
					<table>
						<tr>
							<th style="width:200px;"></th>
							<th>Nama Barang</th>
							<th>Harga Beli(Rp)</th>
							<th>Jumlah</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</tr>
						<tr>
							<td style="width:200px;">
								</th>
							<td><input type="text" name="nabar" value="<?php echo $b['nama_merek']; ?>" style="width:380px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="harpok" value="<?php echo number_format($b['barang_harpok']); ?>" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm" readonly></td>
							<td><input type="number" name="qty" id="qty" value="1" min="1" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
							<td><input type="text" name="keterangan" id="diskon" class="form-control input-sm" style="width:140px;margin-right:5px;" required></td>
							<td><button type="submit" style="margin-right:5px;" class="btn btn-sm btn-info"><span class="fa fa-refresh"></span> Retur</button></td>
							<td><a href="<?= base_url('admin/retur'); ?>" class="btn btn-sm btn-warning" ><span class="fa fa-close"></span> Batal</a></td>
						</tr>
					</table>