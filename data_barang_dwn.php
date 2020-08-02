<?php
include_once "library/inc.library.php";
include_once "library/koneksi.php";

// pembagian halaman

$currentPage = $_SERVER["PHP_SELF"];
$baris	= 10;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM barang";
$pageQry= mysqli_query($koneksi, $pageSql) or die ("error paging: ".mysqli_error());
$jumlah	= mysqli_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1);

?>
<!doctype html>
<html>
<head>

<meta charset="utf-8">
<style type="text/css">
	body {
    font-family: Calibri;
	}
.huruf {
    color: #FFFFFF;
    font-size: 14px;
}
</style>
</head>
<body>
    	<div align="center"><h1 class="mb-3 border-bottom border-dark"><i class="fa fa-archive"></i> Data Barang</h1></div>
		<div class="btn disabled"><strong>Total Data : <?php echo $jumlah; ?></strong></div>
	  <div class="table-responsive-sm">
			<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;" width="100%">
				<thead>
					<tr class="text-center huruf" bgcolor="#B4B4B4">
						<th>No</th>
						<th>Kode barang</th>
						<th>Nama barang</th>
						<th>Satuan</th>
						<th>Kategori</th>
						<th>Harga barang</th>
						<th>Stock barang</th>
						<th>Stock minimal</th>						
						<th>Kondisi</th>						
					</tr>
				</thead>
				<tbody class="align-middle">
					<?php
						$mysqli 	= "SELECT * FROM barang ORDER BY kode_barang ASC";
						$myQry 	= mysqli_query($koneksi, $mysqli)  or die ("Query  salah : ".mysqli_error());
						$nomor  = 0; 
						while ($myData = mysqli_fetch_array($myQry)) {
								$nomor++;
								$Kode = $myData['id_barang'];
							if($nomor%2==1) { $warna="#DFDDFF"; } else {$warna="#ffffff";}
					?>
					<tr bgcolor="<?php echo $warna; ?>">		
						<td align="center"><?php echo $nomor; ?></td>
						<td align="right"><?php echo $myData['kode_barang']; ?></td>
						<td align="left"><?php echo $myData['nama_barang']; ?></td>
						<td align="center"><?php echo $myData['satuan']; ?></td>
						<td align="center"><?php echo $myData['kategori']; ?></td>
						<td align="right"><?php echo (rupiah($myData['harga_barang'])); ?></td>
						<td align="right"><?php echo $myData['stock_barang']; ?></td>
						<td align="right"><?php echo $myData['stock_std']; ?></td>
						<?php 
							$stk = $myData['stock_barang'];
							$std = $myData['stock_std'];
							if($stk>=$std) { $dt = "OK"; $wr=""; } else {if($stk == 0){ $dt = "Habis"; $wr="#ff0000"; }else{ $dt = "Kurang"; $wr="#ffff00"; }} ?>
						<td align="center" bgcolor="<?php echo $wr; ?>"><strong><?php echo $dt; ?></strong></td>
						
					</tr> <?php } ?>
				</tbody>
			</table>
		<div class="btn disabled"><strong>Total Data : <?php echo $jumlah; ?></strong></div>
		</div>
	<?php
 $simpan ='Data_barang_' . date("d-m-Y") . '.xls';

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "data.xls"
header('Content-Disposition: attachment; filename=' . basename($simpan));

?>
</body>
</html>