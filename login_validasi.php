<?php 
include "library/koneksi.php"; 
if(isset($_POST['btnLogin'])){
	# Baca variabel form
	$txtUser 	= $_POST['uname'];
	$txtUser 	= str_replace("'","&acute;",$txtUser);
	
	$txtPassword= $_POST['pass'];
	$txtPassword= str_replace("'","&acute;",$txtPassword);
	
	# Akun Belum di Aktifasi
	$cekQry=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$txtUser' AND Aktifasi='on' ") or die ("Eror Query".mysqli_error());
	if(mysqli_num_rows($cekQry)>=1){
		echo "<div class='alert alert-warning alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i> Maaf, Akun <strong>$txtUser </strong>belum <strong>Diaktifasi</strong>, Silakan menghubungi Administrator</div>";
		include "login.php";
	}
	else {
		# LOGIN CEK KE TABEL USER LOGIN 
		$pas1			= md5($txtPassword);
		$pas2			= md5($pas1);
		$txtPasswordmax = md5($pas2);
		$loginQry		= mysqli_query($koneksi,"SELECT * FROM user WHERE username='$txtUser' AND password='$txtPasswordmax'") or die ("Query Salah : ".mysqli_error());

		# JIKA LOGIN SUKSES
		if (mysqli_num_rows($loginQry) >=1) {
			$loginData = mysqli_fetch_array($loginQry);
			$_SESSION['SES_LOGIN_CCR'] 	= $loginData['id_user']; 
			$_SESSION['SES_ADMIN_CCR'] 	= $txtUser;
			$_SESSION['SES_LEVEL_CCR'] 	= $loginData['level'];
			$_SESSION['SES_JALUR_CCR'] 	= $loginData['jalur'];
			$_SESSION['SES_NPK_CCR'] 	= $loginData['npk'];
			$_SESSION['SES_USER_CCR'] 	= $loginData['nama_user'];
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open'>";
		}
		else{
			echo "<div class='alert alert-danger alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i> User atau Password Anda salah...</div>"; 
		
				// Tampilkan lagi form login
				include "login.php";
			}
	}
} // End POST
?>
 
