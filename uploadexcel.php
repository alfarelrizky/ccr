<?php
include 'library/koneksi.php';
require 'vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
 
$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
 
    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
    $extension = end($arr_file);
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
     
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	for($i = 2;$i < count($sheetData);$i++)
	{
		$kode_barang		= $sheetData[$i]['1'];
		$nama_barang		= $sheetData[$i]['2'];
		$satuan				= $sheetData[$i]['3'];
		$kategori			= $sheetData[$i]['4'];
		$harga_barang		= $sheetData[$i]['5'];
		$stock_barang		= $sheetData[$i]['6'];
		$kuery = "SELECT * FROM `barang` where kode_barang = '".$kode_barang."'";
		$exekuery = mysqli_query($koneksi, $kuery);
		$rows = mysqli_num_rows($exekuery);
            if ($rows > 0) {
				$po +=1;
				$_SESSION['peringatan_validpart'][$po] = $nama_barang;
			}else{
				
			}	
			
        $mysqli	= "INSERT INTO barang (kode_barang, nama_barang, satuan, kategori, harga_barang, stock_barang)
							VALUES ('$kode_barang', '$nama_barang', '$satuan', '$kategori', '$harga_barang', '$stock_barang')";		
		$myQry=mysqli_query($koneksi, $mysqli) or die ("Gagal query".mysqli_error());	
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=data-barang'>";
		}
    }
}
?>