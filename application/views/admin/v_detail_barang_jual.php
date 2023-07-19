					<?php
					error_reporting(0);
					$b = $brg->row_array();
					?>
					<table>
						<tr>
							<th>Merek</th>
							<th>Indikasi</th>
							<th>Stok</th>
							<th>Harga SRP(Rp)</th>
							<th>Harga SRP Pot(Rp)</th>
							<th style="text-align: center;">Jumlah</th>
						</tr>
						<tr>
							<td><input type="text" name="merek" value="<?php echo $b['nama_merek']; ?>" style="width:300px;margin-right:5px;" class="form-control input-sm" readonly>
								<input type="hidden" value="<?php echo $b['barang_merek_id']; ?>" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>

							<td><input type="text" name="warna" id="ceknabar" value="<?php echo $b['warna']; ?>" style="width:100px;margin-right:5px;" class="form-control input-sm" readonly>
							    <input type="hidden" name="id_warna" id="ceknabar" value="<?php echo $b['barang_warna']; ?>" style="width:100px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="stok" value="<?php echo $b['barang_stok']; ?>" style="width:40px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="harsrp" value="<?php echo number_format($b['barang_har_srp']); ?>" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="harsrppot" value="<?php echo number_format($b['barang_har_srp']); ?>" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm"></td>
							<td><input type="number" name="qty" id="qty" value="1" min="1" max="<?php echo $b['barang_stok']; ?>" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
							<td><button type="submit" class="btn btn-sm btn-success" style="margin-right:5px;">Ok</button></td>
							<td><a href="#" onclick="document.getElementById('kode_brg').value=''" id="batalInsertCart" class="btn btn-sm btn-warning"><span class="fa fa-close"></span> Batal</a></td>
						</tr>
					</table>



					<script>
						$(document).ready(function() {
							$("#batalInsertCart").click(function() {
								// $("kode_brg").val('');
								$("kode_brg").focus();
								$('#detail_barang').hide();
							});
						});
					</script>