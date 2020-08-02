<?php
include_once "library/inc.sesadmin.php";
include_once "library/inc.library.php";
include_once "library/koneksi.php";

$tanggal_sekarang	= date('Y-m-d');
$tanggal			= isset($_POST['tgl']) ? $_POST['tgl'] : '';
$shift				= isset($_POST['shift']) ? $_POST['shift'] : '';
$nama				= $_SESSION['SES_USER_CCR'];
$npk				= $_SESSION['SES_NPK_CCR'];
$datatanggal 		= $tanggal;
$datashift 			= $shift;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <link href="skin/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="skin/font-awesome/css/font-awesome.css" rel="stylesheet">
	<script src="skin/form-validation.js" type="text/javascript"></script>
</head>
<body>
	<div class="jumbotron shadow">
    	<h2 class="mb-3 border-bottom border-dark"><i class="fa fa-print"></i> Data Print</h2>
	<div class="row">
		<div class="mb-3 col-md-6">
			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form2" target="_self" class="needs-validation" novalidate>
			<h6><i class="fa fa-filter"></i>Short Data Print</h6>
				<div class="input-group mb-3">
					<select name="shift" class="custom-select" id="shift" required>
             		 <option value="">Shift ...</option>
             		 <option value="Shift A">Shift A</option>
             		 <option value="Shift B">Shift B</option>
            		  <option value="Non Shift">Non Shift</option>
            		</select>
					<input type="date" name="tgl" class="form-control" value="<?php echo $tanggal_sekarang; ?>" required>
					<div class="input-group-append">					
					<button name="scan2" class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> Short</button>	
					</div>
					<div class="invalid-feedback">
             		 Data Blum lengkap.
            		</div>			
				</div>
			</form>	
		</div>
		<div class="mb-3 col-md-6">	
			<h6><i class="fa fa-print"></i> Data</h6>
			<div class="mb-3">
				<a class="btn btn-success mb-2" href="data_order_exp.php?nama=<?php echo $nama ; ?>&amp;npk=<?php echo $npk ; ?>&amp;shift=<?php echo $datashift ; ?>&amp;tgl=<?php echo $datatanggal ; ?>" target="_blank"> Export to <img src="image/Microsoft excel.svg" width="16" height="16"></a>
				<a class="btn btn-outline-dark mb-2" href="cetak_form_bon.php?nama=<?php echo $nama ; ?>&amp;npk=<?php echo $npk ; ?>&amp;shift=<?php echo $datashift ; ?>&amp;tgl=<?php echo $datatanggal ; ?>" target="_blank"><i class="fa fa-print"></i> Print</a>
			</div>		
		</div>
	</div>	
		<div class="table-responsive-sm">
			<table class="table table-hover table-striped">
				<thead>
					<tr class="text-center">
						<th bgcolor="#9B9B9B" colspan="6">DIRECT MATERIAL CONSUMABLE</th>					
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
						$mysqlidir 	= "SELECT * FROM order_history WHERE konfirmasi='ok' AND kategori='direct' AND tanggal='$tanggal' AND shift='$shift' GROUP BY nama_barang ORDER BY tanggal ASC";
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
								$sumdir=mysqli_query($koneksi, "select sum(jumlah_order) as total FROM order_history WHERE konfirmasi='ok' AND kategori='direct' AND tanggal='$tanggal' AND shift='$shift' AND nama_barang='$nama_barangdir'");	
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
						$mysqliin 	= "SELECT * FROM order_history WHERE konfirmasi='ok' AND kategori='indirect' AND tanggal='$tanggal' AND shift='$shift' GROUP BY nama_barang ORDER BY tanggal ASC";
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
								$sumin=mysqli_query($koneksi, "select sum(jumlah_order) as total FROM order_history WHERE konfirmasi='ok' AND kategori='indirect' AND tanggal='$tanggal' AND shift='$shift' AND nama_barang='$nama_barangin'");	
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
		</div>
   
	</div>
</body>
</html>