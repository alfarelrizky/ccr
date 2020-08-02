<?php
include_once "library/inc.library.php";
include_once "library/koneksi.php";

# Jika tidak ada History Order
if(! isset($_SESSION['ses_jalur_order'])) {
	echo "<div class='alert alert-warning alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i> Maaf, tidak ada history Order, Silakan masukan data anda</div>";
	include_once "order_barang.php";
	exit;
} 

# Ambil data history
 $nama_order 		= $_SESSION['ses_nama_order'];
 $npk_order 		= $_SESSION['ses_npk_order'];
 $shift_order		= $_SESSION['ses_shift_order'];
 $jalur_order 		= $_SESSION['ses_jalur_order'];
 $kategori_order 	= $_SESSION['ses_kategori_order'];
 $tanggal_sekarang	= date('Y-m-d');

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnsimpan'])){
	# BACA DATA DALAM FORM, masukkan datake variabel
	$nama_barang		= $_POST['nama_barang'];
	$jumlah_order		= $_POST['jumlah_order'];
	$data_stock_barang	= $_POST['data_stock_barang'];	
	$barcode			= $_POST['barcode'];
	$keterangan			= $_POST['keterangan'];
	$mysqli 			= "SELECT * FROM barang WHERE nama_barang='$nama_barang' ";
	$myQry 				= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
	$myData				= mysqli_fetch_array($myQry);
	
	$kode_barang		= $myData['kode_barang'];
	$satuan				= $myData['satuan'];
	$harga				= $myData['harga_barang'];
	$total_harga 		= ($harga*$jumlah_order);
	$kategori			= $kategori_order;
	$nama_pic			= $nama_order;
	$npk				= $npk_order;
	$nama_jalur  		= $jalur_order;
	$shift 				= $shift_order;
	$tanggal			= date('Y-m-d');
	
	# VALIDASI, jika sudah ada akan ditolak
	$cekSql="SELECT * FROM order_history WHERE nama_barang='$nama_barang' AND nama_jalur='$nama_jalur' AND tanggal='$tanggal_sekarang'";
	$cekQry=mysqli_query($koneksi, $cekSql) or die ("Eror Query".mysqli_error()); 
	if(mysqli_num_rows($cekQry)>=1){
		echo "<div class='alert alert-warning alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i> Maaf, barang <strong>$nama_barang</strong> Sudah anda Order, Silakan Order barang lain</div>";
	}else{
	if (trim($jumlah_order)>trim($data_stock_barang)){
		echo "<div class='alert alert-warning alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i> Maaf, Jumlah barang yang anda order melebihi stok yang tersedia, Silakan anda Order sesuai stok yang tersedia</div>";
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$mysqli	= "INSERT INTO order_history (nama_jalur, kode_barang, nama_barang, jumlah_order, satuan, kategori, keterangan, nama_pic, npk_pic, shift, tanggal, barcode, harga, total_harga)
							VALUES ('$nama_jalur', '$kode_barang', '$nama_barang', '$jumlah_order', '$satuan', '$kategori', '$keterangan', '$nama_pic', '$npk', '$shift', '$tanggal', '$barcode', '$harga', '$total_harga')";		
		$myQry=mysqli_query($koneksi, $mysqli) or die ("Gagal query".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=order'>";
		}
		exit;
	}
	}	
} // Penutup POST

# TOMBOL EDIT DIKLIK
if(isset($_POST['btnedit'])){
	# Baca Variabel Form
	$id_order_history	= $_POST['id_order_history'];
	$nama_barang		= $_POST['nama_barang'];
	$jumlah_order		= $_POST['jumlah_order'];
	$keterangan			= $_POST['keterangan'];

		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database	
		$mysqli	= "UPDATE order_history SET nama_barang='$nama_barang', jumlah_order='$jumlah_order', keterangan='$keterangan'
				  WHERE id_order_history='$id_order_history'";		
		$myQry	= mysqli_query($koneksi, $mysqli) or die ("Gagal query".mysqli_error());
		if($myQry){
			// Setelah data disimpan, Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=order'>";
		}
		exit;
		
} // Penutup POST

?>
<!doctype html>
<html>
<head>
    <link href="skin/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="skin/font-awesome/css/font-awesome.css" rel="stylesheet">
	<script src="skin/form-validation.js" type="text/javascript"></script>
</head>
<body>
	<div class="jumbotron shadow">
		<div>
    	<h2><i class="fa fa-shopping-basket"></i> Order Barang</h2>
		<hr class="bg-dark mb-3">
		<div class="row ">
			<div class="col-md-6">
				<a class="btn btn-outline-primary" href="#" data-toggle="modal" data-target="#tambahorder"><i class="fa fa-plus"></i> Tambah Order Barang</a>
				<a class="btn btn-outline-dark" href="cetak_form.php?barcode=<?php echo $jalur_order.$tanggal_sekarang.$shift_order ; ?>&amp;pic=<?php echo $nama_order ; ?>&amp;npk=<?php echo $npk_order ; ?>&amp;kategori=<?php echo $kategori_order ; ?>&amp;jalur=<?php echo $jalur_order ; ?>&amp;shift=<?php echo $shift_order ; ?>&amp;tanggal=<?php echo $tanggal_sekarang; ?>" target="_blank"><i class="fa fa-print"></i> Cetak</a>
				
				<!--modal order-->
					<div id="tambahorder" class="modal fade">
						<div class="modal-dialog modal-dialog-scrollable">
							<div class="modal-content">
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="needs-validation" novalidate>
								<div class="modal-header">
									<h4 class="modal-title">Order Barang</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">					
									<div class="row">
										<div class="col-md-12 mb-3">
											<?php
												$habis 		= 0 ;
												$dataSql	= "SELECT * FROM barang WHERE kategori='$kategori_order' AND stock_barang !='$habis' ORDER BY nama_barang ASC";
												$dataQry 	= mysqli_query($koneksi, $dataSql) or die ("Gagal Query".mysqli_error());
												$jsArray	= "var stockbarang = new Array();\n";
													echo '<label for="br">Nama Barang</label>';
													echo '<input type="text" id="br" name="nama_barang" list="barang" class="form-control" onchange="document.getElementById(\'nm_br\').value = stockbarang[this.value]" class="custom-select w-100" autocomplete="off" required/>';
													echo '<datalist id="barang">';													
													echo '<select>';  
    												echo '<option value="">Choose...</option>'; 
												while ($row = mysqli_fetch_array($dataQry)) {  
														echo '<option value="' . $row['nama_barang'] . '"></option>';  
														$jsArray .= "stockbarang['" . $row['nama_barang'] . "'] = '" . addslashes($row['stock_barang']) . "';\n";
    												};
													echo'</select>';										
											?> 
											</datalist>
            								<div class="invalid-feedback">
             									 Silakan pilih Barang.
            								</div>
                    					</div>
										<div class="col-sm-6 mb-3">
											<label for="nm_br">Sisa Stock</label>
											<input id="nm_br" type="text" name="data_stock_barang" class="form-control tex" readonly="readonly">
											<script type="text/javascript">  
    											<?php echo $jsArray;?> 
    										</script>
										</div>
										<div class="col-sm-6 mb-3">
											<label for="kodebarang">Jumlah Order</label>
											<input type="number" name="jumlah_order" class="form-control" id="kodebarang" placeholder="" value="" max="" required>
											<div class="invalid-feedback">
                        						Silakan isi Jumlah Order.
											</div>
										</div>						
										<div class="col-md-12 mb-3">
											<label for="ket">Keterangan</label>
											<select  name="keterangan" class="custom-select w-100" id="ket" required>
												<option value="">Choose...</option>
      									  			<?php	
													$dataSql = "SELECT * FROM keterangan ORDER BY ket ASC";
													$dataQry = mysqli_query($koneksi, $dataSql) or die ("Gagal Query".mysqli_error());
														while ($dataRow = mysqli_fetch_array($dataQry)) {
															echo "<option value='$dataRow[ket]'>$dataRow[ket]</option>";
														};
	          										?> 
      	  	   		 						</select>
      	  	    							<div class="invalid-feedback">
      	  	     							 Silakan pilih Kegunan barang.
      	  	    							</div>
											<input type="hidden" name="barcode" value="<?php echo $jalur_order.$tanggal_sekarang.$shift_order ; ?>">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button name="btnsimpan" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
									<button type="reset" class="btn btn-warning btn-sm"><i class="fa fa-repeat"></i> Reset</button>
									<button class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>						
								</div>
							</form>
							</div>
						</div>
					</div>
				
				
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-4 text-left">
				
				<!--table data-->
				<table class="table table-striped table-sm">
					<tbody class="table-dark">
						<tr>
							<td>Nama </td>
							<td>: <?php echo "$nama_order" ; ?></td>
							<td>Jalur </td>
							<td>: <?php echo "$jalur_order" ; ?></td>
						</tr>
						<tr>
							<td>Npk </td>
							<td>: <?php echo "$npk_order" ; ?></td>
							<td>Shift </td>
							<td>: <?php echo "$shift_order" ; ?></td>
							
						</tr>
						<tr>
							<td>Tanggal </td>
							<td colspan="3">: <?php include "library/tanggal.php"; ?></td>
						</tr>
					</tbody>
				</table>
				
			</div>
		</div>
		<hr class="bg-dark mb-3">
		<div>
		<div class="table-responsive-sm">
			<table class="table table-hover table-striped">
				<thead class="thead-dark table-bordered">
					<tr class="text-center">
						<th>NO</th>
						<th>NO. MATERIAL</th>
						<th>NAMA BARANG</th>
						<th>JUMLAH</th>
						<th>SATUAN</th>
						<th>HARGA</th>
						<th>TOTAL HARGA</th>
						<th>KETERANGAN</th>
						<th colspan="2">EDIT</th>
					</tr>
				</thead>
				<tbody class="align-middle">
					<?php 
						$mysqli 	= "SELECT * FROM order_history WHERE nama_jalur='$jalur_order' AND tanggal='$tanggal_sekarang' AND kategori='$kategori_order' ORDER BY tanggal ASC";
						$myQry 	= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
						$nomor  = 0; 
						while ($myData = mysqli_fetch_array($myQry)) {
								$nomor++;
								$Kode = $myData['id_order_history'];
					?>
					<tr>		
						<td><?php echo $nomor; ?></td>
						<td><?php echo $myData['kode_barang']; ?></td>
						<td><?php echo $myData['nama_barang']; ?></td>
						<td class="text-right"><?php echo $myData['jumlah_order']; ?></td>
						<td><?php echo $myData['satuan']; ?></td>
						<td class="text-right">@ <?php echo (rupiah($myData['harga'])); ?></td>
						<td class="text-right"><?php echo (rupiah($myData['total_harga'])); ?></td>
						<td><?php echo $myData['keterangan']; ?></td>
						<td class="text-center"><a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#edit<?php echo $myData['id_order_history']; ?>"><i class="fa fa-edit"></i> Edit</a>
							<!-- modal edit -->
							<div id="edit<?php echo $myData['id_order_history']; ?>" class="modal fade">
						<div class="modal-dialog modal-dialog-scrollable">
							<div class="modal-content">
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form2" target="_self" class="needs-validation" novalidate>
								<div class="modal-header">
									<h4 class="modal-title">Order Barang</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">					
									<div class="row">
										<div class="col-md-12">
											<input type="hidden" name="id_order_history" value="<?php echo $myData['id_order_history']; ?>">
											<label for="barang">Nama Barang</label>
            								<input name="nama_barang" class="form-control" id="barang" value="<?php echo $myData['nama_barang']; ?>" readonly>
              								<div class="invalid-feedback">
             									 Silakan pilih Barang.
            								</div>
                    					</div>
										<div class="col-md-12">
											<label for="order">Jumlah Order</label>
											<?php
												$nm_br 		= $myData['nama_barang'] ;
												$dtSql	= "SELECT * FROM barang WHERE nama_barang='$nm_br'";
												$dtQry 	= mysqli_query($koneksi, $dtSql) or die ("Gagal Query".mysqli_error());
												$rows		= mysqli_fetch_array($dtQry);
																							
											?> 
											<input type="number" name="jumlah_order" class="form-control" id="order" placeholder="" value="<?php echo $myData['jumlah_order']; ?>" max="<?php echo $rows['stock_barang']; ?>" required>
											<div class="invalid-feedback">
                        						Jumlah Order melebihi <?php echo $rows['stock_barang']; ?>.
											</div>
										</div>						
										<div class="col-md-12">
											<label for="ket">Keterangan</label>
											<select  name="keterangan" class="custom-select w-100" id="ket" required>
												<option value="<?php echo $myData['keterangan']; ?>"><?php echo $myData['keterangan']; ?></option>
      									  			<?php	
													$dataSql = "SELECT * FROM keterangan ORDER BY ket ASC";
													$dataQry = mysqli_query($koneksi, $dataSql) or die ("Gagal Query".mysqli_error());
														while ($dataRow = mysqli_fetch_array($dataQry)) {
															echo "<option value='$dataRow[ket]'>$dataRow[ket]</option>";
														};
	          										?> 
      	  	   		 						</select>
      	  	    							<div class="invalid-feedback">
      	  	     							 Silakan pilih Kegunan barang.
      	  	    							</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button name="btnedit" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Edit</button>
									<button type="reset" class="btn btn-warning btn-sm"><i class="fa fa-repeat"></i> Reset</button>
									<button class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>						
								</div>
							</form>
							</div>
						</div>
					</div>
							
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
											<a class="btn btn-danger btn-sm" href="?open=order-barang-delete&amp;id_order_history=<?php echo $myData['id_order_history']; ?>"><i class="fa fa-trash"></i> Delete</a>
											<button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Batal</button>						
										</div>
									</div>
								</div>
							</div>  
		 				</td>
					</tr> <?php } ?>
					<tr class="bg-dark text-light">
						<td colspan="6" class="text-right"><strong>Total :</strong></td>
						<td class="text-right">
							<?php 		
								$sum=mysqli_query($koneksi, "select sum(total_harga) as total FROM order_history WHERE nama_jalur='$jalur_order' AND tanggal='$tanggal_sekarang'");	
								$totalsum=mysqli_fetch_array($sum);			
								echo "<strong>". rupiah($totalsum['total'])."</strong>";		
							?>
						</td>
						<td colspan="3">&nbsp;</td>						
					</tr>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</body>
</html>