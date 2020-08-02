
<?php
if(isset($_SESSION['SES_ADMIN_CCR'])) {
	$loginQry = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='".$_SESSION['SES_LOGIN_CCR']."'")  or die ("Query user salah : ".mysqli_error());
	$loginRow = mysqli_fetch_array($loginQry);
 	
	echo "<main role='main'><div class='jumbotron shadow'>
    <div class='container' align='center'>
      <h2 class='text-primary'>Selamat datang, " .$loginRow['nama_user']. "........!</h2>
      <h5 class='text-danger'>Anda sudah login sebagai " .$loginRow['level']."</h5>
    </div>
  </div>" ;
	
}
else {
	include "grafik.php" ;
}
?>

