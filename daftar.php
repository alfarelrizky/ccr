<?php
include_once "library/inc.sesadmin.php";
include_once "library/inc.sesadministrator.php";
include "library/koneksi.php";
include "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnsimpan'])){
	# BACA DATA DALAM FORM, masukkan datake variabel
	
	$txtnama		= $_POST['txtnama'];
	$txtjalur		= $_POST['txtjalur'];
	$txtusername	= $_POST['txtusername'];
	$txtpassword	= $_POST['txtpassword'];
	$txtnpk			= $_POST['txtnpk'];
	$txttlp			= $_POST['txttlp'];
	$txtlevel		= $_POST['txtlevel'];
	$txtaktifasi	= $_POST['txtaktifasi'];
	$txtshift		= $_POST['txtshift'];
	
	# VALIDASI USERNAME, jika sudah ada akan ditolak
	$cekSql="SELECT * FROM user WHERE username='$txtusername'";
	$cekQry=mysqli_query($koneksi, $cekSql) or die ("Eror Query".mysqli_error()); 
	if(mysqli_num_rows($cekQry)>=1){
		echo "<div class='alert alert-warning alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i> Maaf, ID <strong>$txtusername</strong> Sudah terdaftar, Silakan buat dengan ID User lain</div>";
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$pas1			= md5($txtpassword);
		$pas2			= md5($pas1);
		$txtpasswordmax = md5($pas2);
		$mysqli  		= "INSERT INTO user (jalur, nama_user, username, password, npk, no_telepon, level, aktifasi, shift)
						VALUES ('$txtjalur', '$txtnama', '$txtusername', '$txtpasswordmax', '$txtnpk', '$txttlp', '$txtlevel', '$txtaktifasi', '$txtshift')";
		$myQry=mysqli_query($koneksi, $mysqli) or die ("Gagal query".mysqli_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=data-user'>";
		}
		exit;
	}	
} // Penutup POST

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
      <h2 class="mb-3 border-bottom border-dark"><i class="fa fa-edit"></i> Daftar User</h2>
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="nama">Nama User</label>
            <input type="text" name="txtnama" class="form-control" id="nama" placeholder="" value="" required>
            <div class="invalid-feedback">
              Silakan isi nama User.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="npk">NPK</label>
            <input type="number" name="txtnpk" class="form-control" id="npk" placeholder="" value="" required>
            <div class="invalid-feedback">
              Silakan isi NPK User.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="shift">Shift</label>
            <select name="txtshift" class="custom-select d-block w-100" id="shift" required>
              <option value="">Choose...</option>
              <option value="Shift A">Shift A</option>
              <option value="Shift B">Shift B</option>
              <option value="Non Shift">Non Shift</option>
            </select>
            <div class="invalid-feedback">
              Silakan pilih Shift.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="jalur">Jalur</label>
            <select  name="txtjalur" class="custom-select w-100" id="jalur" required>
              <option value="">Choose...</option>
              <?php	
           			$dataSql = "SELECT * FROM jalur ORDER BY nama_jalur ASC";
           			$dataQry = mysqli_query($koneksi, $dataSql) or die ("Gagal Query".mysqli_error());
           			while ($dataRow = mysqli_fetch_array($dataQry)) {
	         			echo "<option value='$dataRow[nama_jalur]'>$dataRow[nama_jalur]</option>";
 	         							};
	          ?> 
            </select>
            <div class="invalid-feedback">
              Silakan pilih Jalur.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="tlp">No Telepon</label>
            <input type="text"  name="txttlp" class="form-control" id="tlp" placeholder="" required>
            <div class="invalid-feedback">
              Silakan isi No.Telephone.
            </div>
          </div>
        </div>
        <hr class="mb-4 border-dark">
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="username">ID User</label>
            <input type="text" name="txtusername" class="form-control" id="username" placeholder="" required>
            <small class="text-muted">Nama User untuk login</small>
            <div class="invalid-feedback">
              Isi Nama User untuk login.
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="password">Password User</label>
            <input type="password" name="txtpassword" class="form-control" id="password" placeholder="" required>
            <div class="invalid-feedback">
              Isi Password User untuk login.
            </div>
          </div>
        </div>
		  <input name="txtaktifasi" type="hidden" id="aktifasi" value="">
		  <input name="txtlevel" type="hidden" id="level" value="Admin">
        <hr class="mb-4 border-dark">
		<div class="row">
          <div class="col-md-6 mb-3"> 
        	<button name="btnsimpan" class="btn btn-primary btn-block" type="submit"><i class="fa fa-edit"></i> Daftar</button>
		  </div>
		  <div class="col-md-6 mb-3"> 
        	<a href="?open=login" class="btn btn-success btn-block"><i class='fa fa-sign-in'></i> Sudah punnya Akun</a>
		  </div>
	    </div>
      </form>
    </div>
	</div>
</body>
</html>