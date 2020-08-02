<?php include "library/koneksi.php"; ?>
<?php
if(! isset($_SESSION['SES_LOGIN_CCR'])) {
?>
<link href="skin/bootstrap/css/bootstrap.css" rel="stylesheet">
<div>
	<a href="?open=login" title="Login System"><button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#myModal"><i class='fa fa-leaf'></i> Login</button></a>
</div>
<?php
}
else { 
$loginQry = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='".$_SESSION['SES_LOGIN_CCR']."'")  or die ("Query user salah : ".mysqli_error());
$loginRow = mysqli_fetch_array($loginQry);	
?>
     <a href="?open=logout" title="Logout (<?php echo $loginRow['nama_user'];?>)"><button id="button_login_out"type="button" class="btn btn-outline-info btn-sm">Hi, <?php echo $loginRow['nama_user'];?> <i class='fa fa-user'></i> ( <b>Logout</b> )</button></a>
</div>
<?php 
}
?>