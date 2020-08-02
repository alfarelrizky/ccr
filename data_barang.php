<?php
include_once "library/inc.sesadmin.php";
include_once "library/inc.library.php";
include_once "library/koneksi.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnsimpan'])){
	# BACA DATA DALAM FORM, masukkan datake variabel
	
	$kode_barang		= $_POST['kode_barang'];
	$nama_barang		= $_POST['nama_barang'];
	$satuan				= $_POST['satuan'];
	$kategori			= $_POST['kategori'];
	$harga_barang		= $_POST['harga_barang'];
	$stock_barang		= $_POST['stock_barang'];
	$stock_std			= $_POST['stock_std'];
	
	# VALIDASI USERNAME, jika sudah ada akan ditolak
	$cekSql="SELECT * FROM barang WHERE nama_barang='$nama_barang'";
	$cekQry=mysqli_query($koneksi, $cekSql) or die ("Eror Query".mysqli_error()); 
	if(mysqli_num_rows($cekQry)>=1){
		echo "<div class='alert alert-warning alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i> Maaf, barang <strong>$nama_barang</strong> Sudah Ada, Silakan buat dengan nama barang lain</div>";
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$mysqli	= "INSERT INTO barang (kode_barang, nama_barang, satuan, kategori, harga_barang, stock_barang, stock_std)
							VALUES ('$kode_barang', '$nama_barang', '$satuan', '$kategori', '$harga_barang', '$stock_barang', '$stock_std')";		
		$myQry=mysqli_query($koneksi, $mysqli) or die ("Gagal query".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=data-barang'>";
		}
		exit;
	}	
} // Penutup POST

# TOMBOL DIKLIK
if(isset($_POST['btnedit'])){
	# Baca Variabel Form
	$id_barang			= $_POST['id_barang'];
	$kode_barang		= $_POST['kode_barang'];
	$nama_barang		= $_POST['nama_barang'];
	$satuan				= $_POST['satuan'];
	$kategori			= $_POST['kategori'];
	$harga_barang		= $_POST['harga_barang'];
	$stock_barang		= $_POST['stock_barang'];
	$stock_std			= $_POST['stock_std'];

		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database	
		$mysqli	= "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', satuan='$satuan', kategori='$kategori', harga_barang='$harga_barang', stock_barang='$stock_barang', stock_std='$stock_std'
				  WHERE id_barang='$id_barang'";		
		$myQry	= mysqli_query($koneksi, $mysqli) or die ("Gagal query".mysqli_error());
		if($myQry){
			// Setelah data disimpan, Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=data-barang'>";
		}
		exit;
		
} // Penutup POST


//
$caribarang 		= isset($_POST['cari_barang']) ? $_POST['cari_barang'] : '';

// pembagian halaman

$currentPage = $_SERVER["PHP_SELF"];
$baris	= 10;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM barang";
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
	<?php 
		$periksa=mysqli_query($koneksi, "select * from barang where stock_barang <= stock_std ORDER BY stock_std ASC");
		$jum=mysqli_num_rows($periksa);
		$nol= 0;
		while($q=mysqli_fetch_array($periksa)){	
		if ($q['stock_barang'] == 0){						
			echo "<div class='alert alert-danger alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>  Stok  <strong><a style='color:red'>". $q['nama_barang']."</a></strong> habis..... !!</div>";
					}
			else{
			echo "<div class='alert alert-info alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>  Stok  <a style='color:red'>". $q['nama_barang']."</a> yang tersisa sudah kurang dari <strong><a style='color:red'>" . $q['stock_std']. "</a></strong>. silahkan pesan lagi !!</div>";	
		}
		}
	?>
	<div class="jumbotron shadow">
    	<h2 class="mb-3 border-bottom border-dark"><i class="fa fa-archive"></i> Data Barang</h2>
		<div>
			<a class="btn btn-outline-primary mb-2" href="#" data-toggle="modal" data-target="#tambahbarang"><i class="fa fa-plus"></i> Tambah barang</a>
			<a class="btn btn-outline-success mb-2" href="excel/Upload barang.xlsx"><i class="fa fa-download"></i> Download Format Upload <img src="image/Microsoft excel.svg" width="16" height="16"></a>
			<a class="btn btn-outline-success mb-2" href="#" data-toggle="modal" data-target="#excel"><img src="image/Microsoft excel.svg" width="16" height="16"> Upload</a>		   
			<a class="btn btn-success mb-2" href="data_barang_dwn.php" target="_blank"> Export to <img src="image/Microsoft excel.svg" width="16" height="16"></a>		   
		</div>
		 
		 <!-- modal upload excel-->
		<div id="excel" class="modal fade">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Upload Data Barang</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form action="?open=upload-excel" method="post" name="form1" enctype="multipart/form-data" class="needs-validation" novalidate>
				<div class="modal-body">
					<div class="row col-auto">
						<div class="">
						<input type="file" name="berkas_excel" id="fileexcel" class="btn btn-outline-success btn-sm" width="100%">			    	
						</div>  
					</div>
				</div>
				<div class="modal-footer">
					<button name="btnupload" class="btn btn-success" type="submit"><i class="fa fa-upload"></i> Upload <img src="image/Microsoft excel.svg" width="16" height="16"></button>
					<button class="btn btn-danger" data-dismiss="modal">Tutup</button>						
				</div>
				</form>			
			</div>				
      	</div>
	</div>
		 
		 <!-- modal tambah barang -->
		<div id="tambahbarang" class="modal fade">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="needs-validation" novalidate>
				<div class="modal-header">
					<h4 class="modal-title">Tambah Barang</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="row">
						<div class="col-md-12">
							<label for="kodebarang">Kode barang</label>
							<input type="text" name="kode_barang" class="form-control" id="kodebarang" placeholder="" value="" required>
							<div class="invalid-feedback">
                        	Silakan isi kode barang.
							</div>
						</div>
						<div class="col-md-12">
                      		<label for="namabarang">Nama barang</label>
                      		<input type="text" name="nama_barang" class="form-control" id="namabarang" placeholder="" value="" required>
                      		<div class="invalid-feedback">
                       		Silakan isi nama barang. 
                      		</div>
                    	</div>
						<div class="col-md-12">
							<label for="satuan">Satuan</label>
							<input type="text" name="satuan" class="form-control" id="satuan" placeholder="" value="" required>
							<div class="invalid-feedback">
							Silakan isi satuan barang.
							</div>
						</div>
						<div class="col-md-12">
							<label for="kategori">Kategori</label>
							<select name="kategori" class="form-control" id="kategori" placeholder="" value="" required>
								<option value="">Choose...</option>
								<option value="Indirect">Indirect</option>
								<option value="Direct">Direct</option>
							</select>
							<div class="invalid-feedback">
							Silakan isi kategori barang.
							</div>
						</div>
						<div class="col-md-12">
							<label for="hargabarang">Harga barang</label>
							<input type="number" name="harga_barang" class="form-control" id="hargabarang" placeholder="" value="" required>
							<div class="invalid-feedback">
							Silakan isi harga barang.
							</div>
						</div>
						<div class="col-md-12">
							<label for="stockbarang">Stock barang</label>
							<input type="number" name="stock_barang" class="form-control" id="stockbarang" placeholder="" value="" required>
							<div class="invalid-feedback">
                        	Silakan isi stock barang.
                      		</div>
                    	</div>
						<div class="col-md-12">
							<label for="stockmin">Stock minimal</label>
							<input type="number" name="stock_std" class="form-control" id="stockmin" placeholder="" value="" required>
							<div class="invalid-feedback">
                        	Silakan isi stock minimal.
                      		</div>
                    	</div>
					</div>
				</div>
				<div class="modal-footer">
					<button name="btnsimpan" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<button type="reset" class="btn btn-warning btn-sm">Reset</button>
					<button class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>						
				</div>
				</form>
			</div>
		</div>
		</div>
		
		
		<div class="table-responsive-sm">
			<table class="table table-hover table-striped">
				<thead class="thead-dark table-bordered">
					<tr class="text-center">
						<th>No</th>
						<th>Kode barang</th>
						<th>Nama barang</th>
						<th>Satuan</th>
						<th>Kategori</th>
						<th>Harga barang</th>
						<th>Stock barang</th>
						<th>Stock minimal</th>
						<th colspan="2">Tool</th>
					</tr>
				</thead>
				<tbody class="align-middle">
					<?php
						$mysqli 	= "SELECT * FROM barang ORDER BY nama_barang ASC LIMIT $mulai, $baris";
						$myQry 	= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
						$nomor  = 0; 
						while ($myData = mysqli_fetch_array($myQry)) {
								$nomor++;
								$Kode = $myData['id_barang'];
					?>
					<tr>		
						<td><?php echo $nomor; ?></td>
						<td><?php echo $myData['kode_barang']; ?></td>
						<td><?php echo $myData['nama_barang']; ?></td>
						<td><?php echo $myData['satuan']; ?></td>
						<td><?php echo $myData['kategori']; ?></td>
						<td class="text-right"><?php echo (rupiah($myData['harga_barang'])); ?></td>
						<td class="text-center"><?php echo $myData['stock_barang']; ?></td>
						<td class="text-center"><?php echo $myData['stock_std']; ?></td>
						<td class="text-center"><a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#edit<?php echo $myData['id_barang']; ?>"><i class="fa fa-edit"></i> edit</a>
							<!-- modal edit -->
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form2" target="_self" class="needs-validation" novalidate>
							<div id="edit<?php echo $myData['id_barang']; ?>" class="modal fade">
								<div class="modal-dialog modal-dialog-scrollable">
									<div class="modal-content">										
										<div class="modal-header">
											<h4 class="modal-title">Edit Barang</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										</div>
										<div class="modal-body text-left">
											<input type="hidden" name="id_barang" value="<?php echo $myData['id_barang']; ?>">
											<div class="row">
												<div class="col-md-12">
												<label for="kodebarang">Kode barang</label>
												<input type="text" name="kode_barang" class="form-control" id="kodebarang" placeholder="" value="<?php echo $myData['kode_barang']; ?>" required>
												<div class="invalid-feedback">
												Silakan isi kode barang.
												</div>
											</div>
												<div class="col-md-12">
												<label for="namabarang">Nama barang</label>
												<input type="text" name="nama_barang" class="form-control" id="namabarang" placeholder="" value="<?php echo $myData['nama_barang']; ?>" required>
												<div class="invalid-feedback">
												Silakan isi nama barang.
												</div>
											</div>
												<div class="col-md-12">
												<label for="satuan">Satuan</label>
												<input type="text" name="satuan" class="form-control" id="satuan" placeholder="" value="<?php echo $myData['satuan']; ?>" required>
												<div class="invalid-feedback">
												Silakan isi satuan barang.
												</div>
											</div>
												<div class="col-md-12">
                    							<label for="kategori">Kategori</label>
                    							<select name="kategori" class="form-control" id="kategori" placeholder="" value="" required>
													<option value="<?php echo $myData['kategori']; ?>"><?php echo $myData['kategori']; ?></option>
													<option value="Indirect">Indirect</option>
													<option value="Direct">Direct</option>
												</select>
                    							<div class="invalid-feedback">
                    						    Silakan isi kategori barang.
                    						 	</div>
                    						</div>
												<div class="col-md-12">
                    							<label for="hargabarang">Harga barang</label>
                    							<input type="number" name="harga_barang" class="form-control" id="hargabarang" placeholder="" value="<?php echo $myData['harga_barang']; ?>" required>
                    							<div class="invalid-feedback">
                    							Silakan isi harga barang.
                    							</div>
                    						</div>
												<div class="col-md-12">
                    							<label for="stockbarang">stock barang</label>
                    							<input type="number" name="stock_barang" class="form-control" id="stockbarang" placeholder="" value="<?php echo $myData['stock_barang']; ?>" required>
                    							<div class="invalid-feedback">
                    							Silakan isi stock barang.
                    							</div>
												</div>
												<div class="col-md-12">
												<label for="stockmin">Stock minimal</label>
												<input type="number" name="stock_std" class="form-control" id="stockmin" placeholder="" value="<?php echo $myData['stock_std']; ?>" required>
												<div class="invalid-feedback">
                        						Silakan isi stock minimal.
                      							</div>
                    							</div>                    						
											</div>
										</div>
										<div class="modal-footer">
											<button name="btnedit" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-edit"></i> Edit</button>
											<button type="reset" class="btn btn-info btn-sm" data-dismiss="modal">Batal</button>						
										</div>										
									</div> 
								</div>
							</div>
							</form>
						</td> 
						<?php
							if($_SESSION['SES_LEVEL_CCR'] == 'Administrator')
            				{
						?>
						<td class="text-center"><a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $myData['id_barang']; ?>"><i class="fa fa-trash"></i> Delete</a>			  
		 					<!-- modal delete -->
							<div id="delete<?php echo $myData['id_barang']; ?>" class="modal fade">
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
											<a class="btn btn-danger btn-sm" href="?open=barang-delete&amp;id_barang=<?php echo $myData['id_barang']; ?>"><i class="fa fa-trash"></i> Delete</a>
											<button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Batal</button>						
										</div>
									</div>
								</div>
							</div>  
		 				</td>
						<?php
							} 
        				?>
					</tr> <?php } ?>
				</tbody>
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