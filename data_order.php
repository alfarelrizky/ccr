<?php
include_once "library/inc.sesadmin.php";
include_once "library/inc.library.php";
include_once "library/koneksi.php";

$tanggal_sekarang	= date('Y-m-d');
if(! isset($_SESSION['barcode'])) {
	$barcode 				= '';
}else{
	$barcode 			=$_SESSION['barcode'];
};
// Penutup POST

# TOMBOL SIMPAN Konfirmasi diklik
if(isset($_POST["conf"])){
$size = count($_POST['id_order_history']);

$i = 0;
	
	
while ($i < $size) {
	$id_order_history	= $_POST['id_order_history'][$i];
	$nama_barang		= $_POST['nama_barang'][$i];
	$jumlah_order		= $_POST['jml_order'][$i];
	
	$mysqli 			= "SELECT * FROM barang WHERE nama_barang= '$nama_barang'  LIMIT 1";
	$Qry 				= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
	$Data				= mysqli_fetch_array($Qry);
	
	$id_barang			= $Data['id_barang'];
	$stock_awal			= $Data['stock_barang'];
	$stock_akhir		= ($stock_awal-$jumlah_order);
	
	# Konfirmasi ke history order
	$query = "UPDATE order_history SET konfirmasi='ok'
				  WHERE id_order_history='$id_order_history' LIMIT 1";
	mysqli_query($koneksi, $query) or die ("Gagal query".mysqli_error());
	
	# Konfirmasi Update Stock barang
		$mysqlisto	= "UPDATE barang SET stock_barang='$stock_akhir'
				  WHERE id_barang='$id_barang'";		
		$myQrysto	= mysqli_query($koneksi, $mysqlisto) or die ("Gagal query".mysqli_error());	
	
	++$i;
}
if($myQrysto){
			// Setelah data disimpan, Refresh
		echo "<meta http-equiv='refresh' content='0; url=?open=data-order'>";
		}


}
// pembagian halaman

$currentPage = $_SERVER["PHP_SELF"];
$baris	= 15;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM order_history WHERE konfirmasi='' AND barcode='$barcode'";
$pageQry= mysqli_query($koneksi, $pageSql) or die ("error paging: ".mysqli_error());
$jumlah	= mysqli_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1);

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
    	<h2 class="mb-3 border-bottom border-dark"><i class="fa fa-list-alt"></i> Data Order</h2>
	<div class="row">
		<div class="mb-3 col-md-6">
			<form action="?open=konf-data-order" method="post" name="form1" target="_self" class="needs-validation" novalidate>			
			<h6><i class="fa fa-barcode"></i> Scan Data Order</h6>
			<div class="input-group">
			<input type="password" name="code" class="form-control" placeholder="" value="" required autofocus>			
			<div class="input-group-append">
				<button name="scan" class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
			</div>
			<div class="invalid-feedback">
              Belum ada data Scan.
            </div>
			</div>
			</form>
		</div>
		<div class="mb-3 col-md-6">			
			<form action="?open=konf-data-order" method="post" name="form2" target="_self" class="needs-validation" novalidate>
			<h6><i class="fa fa-search-plus"></i> Cari Manual</h6>
				<div class="input-group mb-3">
					<select  name="jalur" class="custom-select" required>
                      <option value="">Pilih Jalur</option>
                      <?php	
                   			$dataSql = "SELECT * FROM jalur ORDER BY nama_jalur ASC";
                   			$dataQry = mysqli_query($koneksi, $dataSql) or die ("Gagal Query".mysqli_error());
                   			while ($dataRow = mysqli_fetch_array($dataQry)) {
	                 			echo "<option value='$dataRow[nama_jalur]'>$dataRow[nama_jalur]</option>";
 	                 							};
	                  ?> 
                    </select>
					<select name="shift" class="custom-select" id="shift" required>
             		 <option value="">Shift ...</option>
             		 <option value="Shift A">Shift A</option>
             		 <option value="Shift B">Shift B</option>
            		  <option value="Non Shift">Non Shift</option>
            		</select>
					<input type="date" name="tgl" class="form-control" value="<?php echo $tanggal_sekarang; ?>" required>
					<input type="hidden" name="code" value="">
					<div class="input-group-append">					
					<button name="scan2" class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>	
					</div>
					<div class="invalid-feedback">
             		 Data Blum lengkap.
            		</div>			
				</div>
			</form>			
		</div>
	</div>	
		<div class="table-responsive-sm">
			<table class="table table-hover table-striped">
				<thead class="thead-dark table-bordered">
					<tr class="text-center align-middle">
						<th>No</th>
						<th>Kode barang</th>
						<th>Nama barang</th>
						<th>Kategori</th>
						<th>Keterangan</th>
						<th>Jumlah Order</th>
						<th>Satuan</th>
						<th>Harga barang</th>						
						<th>Total harga</th>
						<th colspan="2">Konfirmasi</th>
					</tr>
				</thead>
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
				<tbody class="align-middle">
					<?php
						$mysqli 	= "SELECT * FROM order_history WHERE konfirmasi='' AND barcode='$barcode' LIMIT $mulai, $baris";
						$myQry 	= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
						
						$nomor  = 0; 
						$i = 0;
						while ($myData = mysqli_fetch_array($myQry)) {
								$nomor++;
								$Kode = $myData['id_order_history'];
					?>
					<tr>		
						<td><?php echo $nomor; ?></td>
						<td><?php echo $myData['kode_barang']; ?></td>
						<td><?php echo $myData['nama_barang']; ?></td>
						<td><?php echo $myData['kategori']; ?></td>
						<td><?php echo $myData['keterangan']; ?></td>
						<td><?php echo $myData['jumlah_order']; ?></td>
						<td><?php echo $myData['satuan']; ?></td>
						<td class="text-right">@ <?php echo (rupiah($myData['harga'])); ?></td>
						<td class="text-right"><?php echo (rupiah($myData['total_harga'])); ?></td>
						<td class="text-center">
							<?php
								echo "<input type='hidden' name='id_order_history[$i]' value='{$myData['id_order_history']}' />";
								echo "<input type='hidden' name='nama_barang[$i]' value='{$myData['nama_barang']}' />";
								echo "<input type='hidden' name='jml_order[$i]' value='{$myData['jumlah_order']}' />";
								++$i;
							?>
						</td> 
						<td class="text-center"><a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $myData['id_order_history']; ?>"><i class="fa fa-trash"></i> Delete</a>			  
		 					<!-- modal delete -->
							<div id="delete<?php echo $myData['id_order_history']; ?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Confirmasi</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										</div>
										<div class="modal-body">
											Apakah Anda yakin ingin Menghapus <strong><?php echo $myData['nama_barang']; ?></strong>
										</div>
										<div class="modal-footer">
											<a class="btn btn-danger btn-sm" href="?open=order-barang-delete-adm&amp;id_order_history=<?php echo $myData['id_order_history']; ?>"><i class="fa fa-trash"></i> Delete</a>
											<button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Batal</button>						
										</div>
									</div>
								</div>
							</div>  
		 				</td>
					</tr> <?php  } ?>
					<tr class="bg-dark text-light">
						<td colspan="8" class="text-right align-middle"><strong>Total :</strong></td>
						<td class="text-right align-middle">
							<?php 		
								$sum=mysqli_query($koneksi, "select sum(total_harga) as total FROM order_history WHERE konfirmasi='' AND barcode='$barcode'");	
								$totalsum=mysqli_fetch_array($sum);			
								echo "<strong>". rupiah($totalsum['total'])."</strong>";	
							
								$data = mysqli_num_rows($myQry);
								if ($data >= 1){
									$isi = "";
								}else{
									$isi = "disabled";
								};
									
							?>
						</td>
						<td colspan="2" class="text-center"><button type="submit" name="conf" class="btn btn-success" <?php echo $isi; ?>><i class="fa fa-cart-plus"></i> Konfirmasi</button></td>				
					</tr>
				</tbody></form>
			</table>
		<div class="btn disabled"><strong>Total Data : <?php echo $jumlah; ?></strong></div>
		<ul class="pagination">
			<li class="page-item disabled"><strong><a class="page-link" href="#">Halaman ke :</a></strong></li>	
               <?php
	           $awal = 1;
	           for ($h = 1; $h <= $maks; $h++) {
	           	if((($h >= $hal - 3) && ($h <= $hal + 3 )) || ($h == $maks))
	           		{
	           		if ($h == $hal) echo "<li class='page-item disabled'><a class='page-link bg-primary' href='#'>".$h."</a></li>";
	           		else echo "<li class='page-item'><a class='page-link' href='?open=data-barang&hal=$h'>$h</a></li>";
					}
	           	}
	           ?>
		</ul>
		</div>
   
	</div>
</body>
</html>