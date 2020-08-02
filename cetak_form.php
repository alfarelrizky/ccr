<?php
include_once "library/inc.library.php";
include_once "library/koneksi.php";

#ambil data print
$barcode	= $_GET['barcode'];
$pic		= $_GET['pic'];
$npk		= $_GET['npk'];
$kategori	= $_GET['kategori'];
$jalur		= $_GET['jalur'];
$shift		= $_GET['shift'];
$tanggal	= $_GET['tanggal'];

#pagging halaman print
$currentPage = $_SERVER["PHP_SELF"];
$baris	= 15;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM order_history WHERE barcode = '$barcode'";
$pageQry= mysqli_query($koneksi, $pageSql) or die ("error paging: ".mysqli_error());
$jumlah	= mysqli_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cetak</title>
<link rel="stylesheet" href="vendor/Font/barcode.css">
<style type="text/css">
body {
    font-size: 14px;
    font-family: Calibri;
	}
</style>

</head>

<body>
<table width="895" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tbody>
    <tr>
      <td width="134" rowspan="4" align="center"><img src="image/Daihatsu logo.png" width="118" height="78" alt=""/></td>
      <td width="501" rowspan="4" align="center"><div><font size="+3">BON PERMINTAAN BARANG</font></div>
        <div style="font-family:codebr; font-size:20px;">*<?php echo $barcode; ?>*</div></td>		
      <td width="99">&nbsp;JALUR</td>
      <td width="151">&nbsp;<?php echo $jalur; ?></td>
    </tr>
    <tr>
      <td>&nbsp;SHIFT</td>
      <td>&nbsp;<?php echo $shift; ?></td>
    </tr>
    <tr>
	  <td>&nbsp;KATEGORY</td>
      <td>&nbsp;<?php echo $kategori; ?></td>
    </tr>
    <tr>
	  <td>&nbsp;TANGGAL </td>
      <td>&nbsp;<?php echo (TanggalIndo($tanggal)); ?></td>
    </tr>
 </tbody>
</table>
	<div align="center"><?php echo $kategori; ?> MATERIAL</div>
<table width="895" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tbody>
    <tr align="center">
      <td width="30">NO</td>
      <td width="158">NO. MATERIAL</td>
      <td width="382">NAMA BARANG</td>
      <td width="69">JUMLAH</td>
      <td width="67">SATUAN</td>
      <td width="175">KETERANGAN</td>
    </tr>
	  <?php
						$mysqli = "SELECT * FROM order_history WHERE barcode = '$barcode' ORDER BY id_order_history ASC LIMIT $mulai, $baris";
						$myQry 	= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
						$nomor  = 0; 
						while ($myData = mysqli_fetch_array($myQry)) {
								$nomor++;
								$Kode = $myData['id_order_history'];
	  ?>
    <tr valign="middle">
      <td align="center"><?php echo $nomor; ?></td>
      <td>&nbsp;<?php echo $myData['kode_barang']; ?></td>
      <td>&nbsp;<?php echo $myData['nama_barang']; ?></td>
      <td align="center"><?php echo $myData['jumlah_order']; ?></td>
      <td align="center"><?php echo $myData['satuan']; ?></td>
      <td>&nbsp;<?php echo $myData['keterangan']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
	<br>
<table width="895" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tbody>	  
    <tr align="center">
      <td width="179">DIBUAT OLEH :</td>
      <td width="179">DISETUJUI OLEH :</td>
      <td width="179">DIKONTROL OLEH :</td>
      <td width="179">PETUGAS GUDANG :</td>
      <td width="179">PENERIMA :</td>
    </tr>
    <tr height="80">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><?php echo $pic," / ",$npk; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
	<div style="border-bottom: 2px dashed #000000"><h3 align="center">Form untuk petugas</h3></div><br>
<table width="895" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tbody>
    <tr>
      <td width="134" rowspan="4" align="center"><img src="image/Daihatsu logo.png" width="118" height="78" alt=""/></td>
      <td width="501" rowspan="4" align="center"><div><font size="+3">BON PERMINTAAN BARANG</font></div>
        <div style="font-family:codebr; font-size:20px;">*<?php echo $barcode; ?>*</div></td>		
      <td width="99">&nbsp;JALUR</td>
      <td width="151">&nbsp;<?php echo $jalur; ?></td>
    </tr>
    <tr>
      <td>&nbsp;SHIFT</td>
      <td>&nbsp;<?php echo $shift; ?></td>
    </tr>
    <tr>
	  <td>&nbsp;KATEGORY</td>
      <td>&nbsp;<?php echo $kategori; ?></td>
    </tr>
    <tr>
	  <td>&nbsp;TANGGAL </td>
      <td>&nbsp;<?php echo (TanggalIndo($tanggal)); ?></td>
    </tr>
 </tbody>
</table>
	<div align="center"><?php echo $kategori; ?> MATERIAL</div>
<table width="895" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tbody>
    <tr align="center">
      <td width="30">NO</td>
      <td width="158">NO. MATERIAL</td>
      <td width="382">NAMA BARANG</td>
      <td width="69">JUMLAH</td>
      <td width="67">SATUAN</td>
      <td width="175">KETERANGAN</td>
    </tr>
	  <?php
						$mysqli = "SELECT * FROM order_history WHERE barcode = '$barcode' ORDER BY id_order_history ASC LIMIT $mulai, $baris";
						$myQry2 	= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
						$nomor2  = 0; 
						while ($myData2 = mysqli_fetch_array($myQry2)) {
								$nomor2++;
								$Kode2 = $myData2['id_order_history'];
	  ?>
    <tr valign="middle">
      <td align="center"><?php echo $nomor2; ?></td>
      <td>&nbsp;<?php echo $myData2['kode_barang']; ?></td>
      <td>&nbsp;<?php echo $myData2['nama_barang']; ?></td>
      <td align="center"><?php echo $myData2['jumlah_order']; ?></td>
      <td align="center"><?php echo $myData2['satuan']; ?></td>
      <td>&nbsp;<?php echo $myData2['keterangan']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
	<br>
<table width="895" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tbody>	  
    <tr align="center">
      <td width="179">DIBUAT OLEH :</td>
      <td width="179">DISETUJUI OLEH :</td>
      <td width="179">DIKONTROL OLEH :</td>
      <td width="179">PETUGAS GUDANG :</td>
      <td width="179">PENERIMA :</td>
    </tr>
    <tr height="80">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><?php echo $pic," / ",$npk; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<script>
	window.print();
</script>	
</body>
</html>
