<?PHP
//array hari
$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
$hari = $array_hari[date("N")];

//format tanggal
$tanggal = date("j");

//array bulan
$array_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulan = $array_bulan[date("n")];

//format tahun
$tahun = date("Y");

//menampilkan tanggal
echo $hari.", ".$tanggal." ".$bulan." ".$tahun;
?>