<?php
include_once "library/inc.sesadmin.php";
include_once "library/inc.sesadministrator.php";
include_once "library/inc.library.php";
include_once "library/koneksi.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnsimpan'])){
	# BACA DATA DALAM FORM, masukkan datake variabel
	
	$nama_jalur		= $_POST['nama_jalur'];
	
	# VALIDASI USERNAME, jika sudah ada akan ditolak
	$cekSql="SELECT * FROM jalur WHERE nama_jalur='$nama_jalur'";
	$cekQry=mysqli_query($koneksi, $cekSql) or die ("Eror Query".mysqli_error()); 
	if(mysqli_num_rows($cekQry)>=1){
		echo "<div class='alert alert-warning alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i> Maaf, Jalur <strong>$nama_jalur</strong> Sudah Ada, Silakan buat dengan nama jalur lain</div>";
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$mysqli	= "INSERT INTO jalur (nama_jalur)
							VALUES ('$nama_jalur')";		
		$myQry	= mysqli_query($koneksi, $mysqli) or die ("Gagal query".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=data-jalur'>";
		}
		exit;
	}	
} // Penutup POST

// pembagian halaman

$currentPage = $_SERVER["PHP_SELF"];
$baris	= 10;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM jalur";
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
	 <div>
      <h2 class="mb-3 border-bottom border-dark"><i class="fa fa-link"></i> Data Jalur</h2>
			 <a class="btn btn-outline-primary mb-2"  href="#" data-toggle="modal" data-target="#tambahjalur"><i class="fa fa-plus"></i> Tambah Jalur</a>
		 
		 <!-- modal tambah jalur -->
	<div id="tambahjalur" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Jalur</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="needs-validation" novalidate>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="namajalur">Nama Jalur</label>
                      <input type="text" name="nama_jalur" class="form-control" id="namajalur" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Silakan isi nama Jalur.
                      </div>
                    </div>
                  </div>
				</div>
				<div class="modal-footer">
					<button name="btnsimpan" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Batal</button>						
				</div>
			</div>
		</div>
	</div>
		
		
	<div class="table-responsive-sm">
     <table class="table table-hover table-striped">
		<thead class="thead-dark">
		 <tr>
		  <th width="5%">No</th>
		  <th>Nama Jalur</th>
		  <th>Tool</th>
		 </tr>
		</thead>
		 <tbody class="align-middle">
		 <?php
		 	$mysqli 	= "SELECT * FROM jalur ORDER BY nama_jalur ASC LIMIT $mulai, $baris";
		 	$myQry 	= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
		 	$nomor  = 0; 
		 	while ($myData = mysqli_fetch_array($myQry)) {
				$nomor++;
				$Kode = $myData['id_jalur'];
		?>
		 <tr class="<?php echo $warna; ?>">		
		  <td><?php echo $nomor; ?></td>
		  <td><?php echo $myData['nama_jalur']; ?></td>
		  <td>
			  <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#<?php echo $myData['nama_jalur']; ?>"><i class="fa fa-trash"></i> Delete</a>
		 <!-- modal delete -->
	<div id="<?php echo $myData['nama_jalur']; ?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Confirmasi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin Menghapus <strong><?php echo $myData['nama_jalur']; ?></strong>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger btn-sm" href="?open=jalur-delete&amp;id_jalur=<?php echo $myData['id_jalur']; ?>"><i class="fa fa-trash"></i> Delete</a>
					<button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Batal</button>						
				</div>
			</div>
		</div>
	</div>
		 </td>
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
	           		else echo "<li class='page-item'><a class='page-link' href='?open=data-jalur&hal=$h'>$h</a></li>";
					}
	           	}
	           ?>
		</ul>
	</div>
    </div>
	</div>
</body>
</html>