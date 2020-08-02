<?php
$nama 		= $_POST['nama_order'];
$npk 		= $_POST['npk_order'];
$shift	 	= $_POST['shift_order'];
$jalur 		= $_POST['jalur_order'];
$kategori 	= $_POST['kategori_order'];

$_SESSION['ses_nama_order'] 		= $nama;
$_SESSION['ses_npk_order'] 			= $npk;
$_SESSION['ses_shift_order'] 		= $shift;
$_SESSION['ses_jalur_order'] 		= $jalur;
$_SESSION['ses_kategori_order'] 	= $kategori;

echo "<meta http-equiv='refresh' content='0; url=?open=order'>";
?>