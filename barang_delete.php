<?php
include_once "library/inc.sesadmin.php";
include_once "library/inc.sesadministrator.php";
include_once "library/inc.library.php";
include_once "library/koneksi.php";

// Kode di URL harus ada
if(empty($_GET['id_barang'])){
	echo "<b>Data yang dihapus tidak ada</b>";
}
else {
	// Membaca Kode dari URL
	$Kode	= $_GET['id_barang'];
	
	// Menghapus data sesuai Kode yang didapat di URL
	$mysqli 	= "DELETE FROM barang WHERE id_barang='$Kode'";
	$myQry 	= mysqli_query($koneksi, $mysqli) or die ("Eror hapus data".mysqli_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?open=data-barang'>";
	}
}
?>