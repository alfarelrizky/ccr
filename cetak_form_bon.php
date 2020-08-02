<?php
include_once "library/inc.library.php";
include_once "library/koneksi.php";

#ambil data print
$nama		= $_GET['nama'];
$npk		= $_GET['npk'];
$datashift		= $_GET['shift'];
$tanggal	= $_GET['tgl'];
$shift   = substr($datashift, 6, 1);
$tahun   = substr($tanggal, 0, 4);
$bulan   = substr($tanggal, 5, 2);
$tgl   = substr($tanggal, 8, 2);
$nomor = "$tahun/$bulan/$tgl-$shift";
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

<body><div>
<table width="895" border="1" align="center" bordercolor="#000000" cellpadding="2" cellspacing="2" >
  <tbody>
	<tr>
	<td>
	  <table width="100%" border="1" align="center" cellpadding="1" cellspacing="3" bordercolor="#000000" style="border-collapse:collapse;">
		  <tr>
			<td width="13%" rowspan="4" align="center"><img src="image/Daihatsu logo.png" width="100" height="63" alt=""/></td>
		  	<td width="44%" rowspan="4" align="center"><font size="+1">BON PERMINTAN BARANG</font><br>
				<font size="+1"><strong>DEPT. ASSY 2/P4/<?php echo $nomor; ?></strong></font></td>
			  <td width="9%" rowspan="4" align="center"><font size="+4"><strong><?php echo $shift; ?></strong></font></td>
		  	<td width="16%">DEPT</td>
		  	<td width="18%">: ASSY 2</td>
		  </tr>
		  <tr>
			<td>COST CENTER</td>
		  	<td>: P-602-0454</td>
		  </tr>
		  <tr>
			<td>LINE</td>
		  	<td>: COST CONTROL</td>
		  </tr>
		  <tr>
			<td>TANGGAL</td>
		  	<td>: <?php echo (tglhari($tanggal)); ?></td>
		  </tr>
		  <tr>
			  <td colspan="5" align="center" bgcolor="#C2C2C2">DIRECT MATERIAL CONSUMABLE</td>
		  </tr>
		</table>
		<table width="100%" border="1" align="center" cellpadding="1" cellspacing="3" bordercolor="#000000" style="border-collapse:collapse;">
			<tbody>
			<tr align="center">
				<td width="4%">No.</td>
				<td width="17%">NO. Material</td>
				<td width="38%">Nama Barang</td>
				<td width="10%">Qty</td>
				<td width="10%">Satuan</td>
				<td width="21%">Keterangan</td>
			</tr>
				<?php
						$mysqlidir = "SELECT * FROM order_history WHERE konfirmasi='ok' AND kategori='direct' AND tanggal='$tanggal' AND shift='$shift' GROUP BY nama_barang ORDER BY tanggal ASC";
						$myQrydir 	= mysqli_query($koneksi, $mysqlidir)  or die ("Query  salah : ".mysqli_error());
						$datadir = mysqli_num_rows($myQrydir);
						$nomordir  = 0; 
						if ($datadir >= 1){
						while ($myDatadir = mysqli_fetch_array($myQrydir)) {
								$nomordir++;
								$Kode = $myDatadir['id_order_history'];
	  			?>
			<tr>
				<td align="center"><?php echo $nomordir; ?></td>	
				<td><?php echo $myDatadir['kode_barang']; ?></td>	
				<td><?php echo $myDatadir['nama_barang']; ?></td>	
				<td align="center">
					<?php 		
							$nama_barangdir = $myDatadir['nama_barang'];
								$sumdir=mysqli_query($koneksi, "select sum(jumlah_order) as total FROM order_history WHERE konfirmasi='ok' AND kategori='direct' AND tanggal='$tanggal' AND shift='$shift' AND nama_barang='$nama_barangdir'");	
								$totalsumdir=mysqli_fetch_array($sumdir);			
								echo $totalsumdir['total'];	
					?></td>	
				<td align="center"><?php echo $myDatadir['satuan']; ?></td>	
				<td><?php echo $myDatadir['keterangan']; ?></td>	
			</tr>
				<?php 
						}
					}else { ?>
					<tr  align="center">
					<td><strong>1</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					</tr>	
					<?php } ?>
			<tr>
				<td colspan="6" align="center" bgcolor="#C2C2C2">INDIRECT MATERIAL CONSUMABLE</td>
			</tr>
			</tbody>	
		</table>
		<table width="100%" border="1" align="center" cellpadding="1" cellspacing="3" bordercolor="#000000" style="border-collapse:collapse;">
			<tbody>
			<tr align="center">
				<td width="4%">No.</td>
				<td width="17%">NO. Material</td>
				<td width="38%">Nama Barang</td>
				<td width="10%">Qty</td>
				<td width="10%">Satuan</td>
				<td width="21%">Keterangan</td>
			</tr>
				<?php
						$mysqliin = "SELECT * FROM order_history WHERE konfirmasi='ok' AND kategori='indirect' AND tanggal='$tanggal' AND shift='$shift' GROUP BY nama_barang ORDER BY tanggal ASC";
						$myQryin 	= mysqli_query($koneksi, $mysqliin)  or die ("Query  salah : ".mysqli_error());
						$datain = mysqli_num_rows($myQryin);
						$nomorin  = 0; 
						if ($datain >= 1){
						while ($myDatain = mysqli_fetch_array($myQryin)) {
								$nomorin++;
								$Kodein = $myDatain['id_order_history'];
	  			?>
			<tr>
				<td align="center"><?php echo $nomorin; ?></td>	
				<td><?php echo $myDatain['kode_barang']; ?></td>	
				<td><?php echo $myDatain['nama_barang']; ?></td>	
				<td align="center">
					<?php 		
							$nama_barangin = $myDatain['nama_barang'];
								$sumin=mysqli_query($koneksi, "select sum(jumlah_order) as total FROM order_history WHERE konfirmasi='ok' AND kategori='indirect' AND tanggal='$tanggal' AND shift='$shift' AND nama_barang='$nama_barangin'");	
								$totalsumin=mysqli_fetch_array($sumin);			
								echo $totalsumin['total'];	
					?></td>	
				<td align="center"><?php echo $myDatain['satuan']; ?></td>	
				<td><?php echo $myDatain['keterangan']; ?></td>	
			</tr>
				<?php 
						}
					}else { ?>
					<tr align="center">
					<td><strong>1</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					</tr>	
					<?php } ?>
			<tr>
				<td colspan="6" align="center"></td>
			</tr>
			</tbody>	
		</table>
		<table width="100%" border="1" align="center" cellpadding="1" cellspacing="3" bordercolor="#000000" style="border-collapse:collapse;">
			<tbody>
			<tr align="center">
				<td width="20%">DISETUJUI</td>
				<td width="20%">DIKONTROL</td>
				<td width="20%">DIBUAT</td>
				<td width="20%">PETUGAS WAREHOUSE</td>
				<td width="20%">PENERIMA</td>
			</tr>
			<tr>
				<td height="70px">&nbsp;</td>	
				<td>&nbsp;</td>	
				<td>&nbsp;</td>	
				<td>&nbsp;</td>	
				<td>&nbsp;</td>		
			</tr>
			<tr>
				<td>NAMA :</td>	
				<td>NAMA :</td>	
				<td>NAMA : <?php echo $nama; ?></td>	
				<td>NAMA :</td>	
				<td>NAMA :</td>		
			</tr>
			<tr>
				<td>NPK :</td>	
				<td>NPK :</td>	
				<td>NPK : <?php echo $npk; ?></td>	
				<td>NPK :</td>	
				<td>NPK :</td>		
			</tr>
			</tbody>	
		</table>
		</td>  
	</tr>
  </tbody>
</table>

</div>
	
</body>
</html>
