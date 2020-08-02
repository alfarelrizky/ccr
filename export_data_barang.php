<?php
 $simpan ='Data_barang_' . date("d-m-Y") . '.xls';

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
// Mendefinisikan nama file ekspor "data.xls"
header('Content-Disposition: attachment; filename=' . basename($simpan));
 
// Tambahkan table

include 'data_barang_dwn.php';
?>

