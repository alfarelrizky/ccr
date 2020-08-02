<?php
include_once "library/inc.sesadmin.php";
include_once "library/inc.sesadministrator.php";
include_once "library/inc.library.php";
include_once "library/koneksi.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['simpan'])){
	# BACA DATA DALAM FORM, masukkan datake variabel
	$id_user	= $_POST['id_user'];
	$aktifasi	= $_POST['txtaktifasi'];
	$level		= $_POST['txtlevel'];
	
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database	
		$mysqli	= "UPDATE user SET aktifasi='$aktifasi', level='$level'
				  WHERE id_user='$id_user'";		
		$myQry	= mysqli_query($koneksi, $mysqli) or die ("Gagal query".mysqli_error());
		if($myQry){
			// Setelah data disimpan, Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=data-user'>";
		exit;
	}	
} // Penutup POST

// pembagian halaman
$currentPage = $_SERVER["PHP_SELF"];
$baris	= 10;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM user WHERE NOT(id_user='1')";
$pageQry= mysqli_query($koneksi, $pageSql) or die ("error paging: ".mysqli_error());
$jumlah	= mysqli_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <title>Data</title>
    <link href="skin/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="skin/font-awesome/css/font-awesome.css" rel="stylesheet">
	<script src="skin/form-validation.js" type="text/javascript"></script>
</head>
<body>
	<div class="jumbotron shadow">
	 <div>
      <h2 class="mb-3 border-bottom border-dark"><i class="fa fa-user"></i> Data User</h2>
			 <a class="btn btn-outline-primary mb-2" href="?open=user-daftar"><i class="fa fa-user-plus"></i> Tambah User</a>
		<div class="table-responsive-sm"> 
     <table class="table table-hover table-striped">
		<thead class="thead-dark">
		 <tr>
		  <th>No</th>
		  <th>Nama User</th>
		  <th>Npk</th>
		  <th>Shift</th>
		  <th>Jalur</th>
		  <th>Username</th>
		  <th>Level</th>
		  <th>Aktivasi</th>
		  <th colspan="2" class="align-content-center">Tool</th>
		 </tr>
		</thead>
		 <tbody>
		 <?php
		 	$mysqli 	= "SELECT * FROM user WHERE NOT(id_user='1') ORDER BY id_user ASC LIMIT $mulai, $baris";
		 	$myQry 	= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
		 	$nomor  = 0; 
		 	while ($myData = mysqli_fetch_array($myQry)) {
				$nomor++;
				$Kode = $myData['id_user'];
		?>
		 <tr class="<?php echo $warna; ?>">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" target="_self">
		  <td><?php echo $nomor; ?></td>
		  <td><?php echo $myData['nama_user']; ?></td>
		  <td><?php echo $myData['npk']; ?></td>
		  <td><?php echo $myData['shift']; ?></td>
		  <td><?php echo $myData['jalur']; ?></td>
		  <td><?php echo $myData['username']; ?></td>
		  <td>
				<select name="txtlevel" id="txtlevel"  class="custom-select custom-select-sm">
        		  <option value="Admin" <?php if (($myData['level'])=="Admin") {echo "selected";} ?>>Admin</option>
				  <option value="Administrator" <?php if ($myData['level']=="Administrator") {echo "selected";} ?>>Administrator</option>
        		  
      			</select>
		  </td>
		  <td>
			  <div class="custom-control custom-switch">
			  <input type="checkbox" name="txtaktifasi" class="custom-control-input" value="on" id="<?php echo $myData['npk']; ?>" <?php if ($myData['aktifasi']=="on") {echo "checked";} ?>>
				  <label class="custom-control-label" for="<?php echo $myData['npk']; ?>">On</label>
			  </div>
			  <input name="id_user" type="hidden" id="id_user" value="<?php echo $myData['id_user']; ?>"> 
		  </td>
		  <td>
			<button name="simpan" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Ubah</button>
		  </td>
		 </form>
		  <td>
			  <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#<?php echo $myData['username']; ?>"><i class="fa fa-trash"></i> Delete</a>
		 <!-- modal delete -->
	<div id="<?php echo $myData['username']; ?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Confirmasi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin Menghapus User <strong><?php echo $myData['username']; ?></strong>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger btn-sm" href="?open=user-delete&amp;id_user=<?php echo $myData['id_user']; ?>"><i class="fa fa-trash"></i> Delete</a>
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
	           		else echo "<li class='page-item'><a class='page-link' href='?open=data-user&hal=$h'>$h</a></li>";
					}
	           	}
	           ?>
		</ul>
    </div>
    </div>
	</div>


</body>
</html>