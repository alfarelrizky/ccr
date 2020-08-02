<?php
if(isset($_POST['scan'])){
	# Baca Variabel Form
	$code		= $_POST['code'];
	$_SESSION['barcode_back'] 		= $code ;
	}else{if(isset($_POST['scan2'])){
	# Baca Variabel Form
	$jalur				= $_POST['jalur'];
	$tgl				= $_POST['tgl'];
	$shift				= $_POST['shift'];
	$code 			= $jalur.$tgl.$shift ;
	$_SESSION['barcode_back'] 		= $code ;
}};
echo "<meta http-equiv='refresh' content='0; url=?open=data-order-back'>";
?>