<?php
include_once "library/inc.library.php";
include_once "library/koneksi.php";

$nama		= $_GET['nama'];
$npk		= $_GET['npk'];
$datashift		= $_GET['shift'];
$tanggal	= $_GET['tgl'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
			<table border="1" align="center" cellpadding="1" cellspacing="3" bordercolor="#000000" style="border-collapse:collapse;" width="100%">
				<thead>
					<tr class="text-center">
						<th bgcolor="#9B9B9B" colspan="6">DIRECT MATERIAL CONSUMABLE</th>					
					</tr>
				</thead>
				<thead class="thead-dark table-bordered">					
					<tr class="text-center align-middle">
						<th width="5%">No</th>
						<th width="25%">Kode barang</th>
						<th width="25%">Nama barang</th>
						<th width="10%">Qty</th>
						<th width="15%">Satuan</th>
						<th width="20%">Keterangan</th>
					</tr>
				</thead>
				<tbody class="align-middle">
					<?php
						$mysqlidir 	= "SELECT * FROM order_history WHERE konfirmasi='ok' AND kategori='direct' AND tanggal='$tanggal' AND shift='$datashift' GROUP BY nama_barang ORDER BY tanggal ASC";
						$myQrydir 		= mysqli_query($koneksi, $mysqlidir)  or die ("Query  salah : ".mysqli_error());
						$datadir 		= mysqli_num_rows($myQrydir);
						$nomordir  	= 0; 
						$idir 			= 0;
					if ($datadir >= 1){
						while ($myDatadir = mysqli_fetch_array($myQrydir)) {
								$nomordir++;
								$Kodedir = $myDatadir['id_order_history'];
					?>
					<tr>		
						<td class="text-center"><?php echo $nomordir; ?></td>
						<td><?php echo $myDatadir['kode_barang']; ?></td>
						<td><?php echo $myDatadir['nama_barang']; ?></td>
						<td class="text-right"><?php 		
							$nama_barangdir = $myDatadir['nama_barang'];
								$sumdir=mysqli_query($koneksi, "select sum(jumlah_order) as total FROM order_history WHERE konfirmasi='ok' AND kategori='direct' AND tanggal='$tanggal' AND shift='$datashift' AND nama_barang='$nama_barangdir'");	
								$totalsumdir=mysqli_fetch_array($sumdir);			
								echo $totalsumdir['total'];	
					?></td>
						<td><?php echo $myDatadir['satuan']; ?></td>
						<td><?php echo $myDatadir['keterangan']; ?></td>					
					</tr> <?php 
						}
					}else { ?>
					<tr class="text-center">
					<td><strong>1</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					</tr>	
					<?php } ?>					
				</tbody>
				<thead>
					<tr class="text-center">
						<th bgcolor="#9B9B9B" colspan="6">INDIRECT MATERIAL CONSUMABLE</th>					
					</tr>
				</thead>
				<thead class="thead-dark table-bordered">					
					<tr class="text-center align-middle">
						<th>No</th>
						<th>Kode barang</th>
						<th>Nama barang</th>
						<th>Qty</th>
						<th>Satuan</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody class="align-middle">
					<?php
						$mysqliin 	= "SELECT * FROM order_history WHERE konfirmasi='ok' AND kategori='indirect' AND tanggal='$tanggal' AND shift='$datashift' GROUP BY nama_barang ORDER BY tanggal ASC";
						$myQryin 	= mysqli_query($koneksi, $mysqliin)  or die ("Query  salah : ".mysqli_error());
						$datain = mysqli_num_rows($myQryin);
						$nomorin  = 0; 
						$iin = 0;
					if ($datain >= 1){
						while ($myDatain = mysqli_fetch_array($myQryin)) {
								$nomorin++;
								$Kodein = $myDatain['id_order_history'];
					?>
					<tr>		
						<td class="text-center"><?php echo $nomorin; ?></td>
						<td><?php echo $myDatain['kode_barang']; ?></td>
						<td><?php echo $myDatain['nama_barang']; ?></td>
						<td class="text-right"><?php 		
							$nama_barangin = $myDatain['nama_barang'];
								$sumin=mysqli_query($koneksi, "select sum(jumlah_order) as total FROM order_history WHERE konfirmasi='ok' AND kategori='indirect' AND tanggal='$tanggal' AND shift='$datashift' AND nama_barang='$nama_barangin'");	
								$totalsumin=mysqli_fetch_array($sumin);			
								echo $totalsumin['total'];	
					?></td>
						<td><?php echo $myDatain['satuan']; ?></td>
						<td><?php echo $myDatain['keterangan']; ?></td>					
					</tr> <?php 
						}
					}else { ?>
					<tr class="text-center">
					<td><strong>1</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					</tr>	
					<?php } ?>
				</tbody>
			</table>
	
	<?php
	 $simpan ='Data_barang_' . date("d-m-Y") . '.xls';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=" . basename($simpan)); 
	?>
</body>
</html>