<?php
date_default_timezone_set("Asia/Jakarta");

# Fungsi untuk membuat kode automatis
function buatKode($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);

 	$qry	= mysql_query("SELECT MAX(".$field.") FROM ".$tabel);
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}

# Fungsi untuk membalik tanggal dari format bootsrap -> English 26/11/2019 1-26-9--20
function BotTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$awal="$thn-$bln-$tgl";
	return $awal;
}


# Fungsi untuk membalik tanggal dari format Indo -> English
function InggrisTgl($tanggal){
	$tgl=substr($tanggal,3,2);
	$bln=substr($tanggal,0,2);
	$thn=substr($tanggal,6,4);
	$awal="$thn-$bln-$tgl";
	return $awal;
}

# Fungsi untuk membalik tanggal dari format English -> Indo
function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$awal="$tgl-$bln-$thn";
	return $awal;
}

# Fungsi untuk membalik tanggal dari format jquery -> English
function jqueryTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$awal="$bln/$tgl/$thn";
	return $awal;
}

# Fungsi untuk membalik tanggal dari format english -> Indo bulan
function TanggalIndo($date){
$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
$tahun = substr($date, 0, 4);
$bulan = substr($date, 5, 2);
$tgl   = substr($date, 8, 2);
 
$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;	
return($result);
}

# Fungsi untuk membalik tanggal dari format english -> Indo bulan
function TanggalIn($date){
$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
 
$tahun = substr($date, 0, 4);
$bulan = substr($date, 5, 2);
$tgl   = substr($date, 8, 2);
 
$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;	
return($result);
}

# Fungsi untuk membalik tanggal dari format english -> Indo bulan dan hari
function tglhari($date){
$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"); 
$hari = $array_hari[date("N")];
	
$tahun = substr($date, 0, 4);
$bulan = substr($date, 5, 2);
$tgl   = substr($date, 8, 2);
 
$result = $hari . ", " . $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;	
return($result);
}

# Fungsi untuk membalik tanggal dari format english -> Indo bulan yang di tampilkan saja
function Tanggalbln($date){
$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");
 
$bulan = substr($date, 5, 2);
 
$result = $BulanIndo[(int)$bulan-1];	
return($result);
}

# Fungsi untuk membalik tanggal dari format jqueryTgl -> englis tanggal
function tanggal($tanggal){
	$tgl=substr($tanggal,3,2);
	$awal="$tgl";
	return $awal;
}

# Fungsi untuk membalik tanggal dari format jqueryTgl -> englis bulan
function bulan($date){
$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
$bulan = substr($date, 0,2); 
$result = $BulanIndo[(int)$bulan-1];	
return($result);
}

# Fungsi untuk membalik tanggal dari format jqueryTgl -> englis bulan
function bln($date){
$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"); 
$bulan = substr($date, 0,2); 
$result = $BulanIndo[(int)$bulan-1];	
return($result);
}


# Fungsi untuk membalik tanggal dari format jqueryTgl -> englis tanggal
function tahun($tanggal){
	$thn=substr($tanggal,6,4);
	$awal="$thn";
	return $awal;
}

# Fungsi untuk membuat format rupiah pada angka (uang)
function format_angka($angka) {
	$hasil =  number_format($angka,0, ",",".");
	return $hasil;
}

function format_angka2($angka) {
	$hasil =  number_format($angka,0, ",",",");
	return $hasil;
}

function rupiah($angka) {
	$id		= ("Rp. ");
	$hasil	=  number_format($angka,0, ".",".");
	$ak		= (",-");
	$mata	= "$id $hasil $ak";
	return $mata;
}


# Fungsi untuk format tanggal, dipakai plugins Callendar
function form_tanggal($nama,$value=''){
	date_default_timezone_set("Asia/Jakarta");

	echo" <input type='text' name='$nama' id='$nama' size='9' maxlength='20' value='$value'/>&nbsp;
	<img src='images/calendar-add-icon.png' align='top' style='cursor:pointer; margin-top:7px;' alt='kalender'onclick=\"displayCalendar(document.getElementById('$nama'),'dd-mm-yyyy',this)\"/>			
	";
}

function umur($birthday){
	date_default_timezone_set("Asia/Jakarta");

	list($year,$month,$day) = explode("-",$birthday);
	$year_diff = date("Y") - $year;
	$month_diff = date("m") - $month;
	$day_diff = date("d") - $day;
	if ($month_diff < 0) $year_diff--;
	elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
	return $year_diff;
}

function angkaTerbilang($x){
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return angkaTerbilang($x - 10) . " belas";
  elseif ($x < 100)
    return angkaTerbilang($x / 10) . " puluh" . angkaTerbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . angkaTerbilang($x - 100);
  elseif ($x < 1000)
    return angkaTerbilang($x / 100) . " ratus" . angkaTerbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . angkaTerbilang($x - 1000);
  elseif ($x < 1000000)
    return angkaTerbilang($x / 1000) . " ribu" . angkaTerbilang($x % 1000);
  elseif ($x < 1000000000)
    return angkaTerbilang($x / 1000000) . " juta" . angkaTerbilang($x % 1000000);
}

?>