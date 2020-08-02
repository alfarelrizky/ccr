<!DOCTYPE html>
<html lang="en">
<head>
	<link href="skin/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="skin/highcharts.js" type="text/javascript"></script>
	<!--<script src="skin/themes/dark-blue.js" type="text/javascript"></script><script src="skin/themes/skies.js" type="text/javascript"></script><script src="skin/themes/sand-signika.js" type="text/javascript"></script><script src="skin/themes/grid-light.js" type="text/javascript"><script src="skin/themes/gray.js" type="text/javascript"></script><script src="skin/themes/dark-unica.js" type="text/javascript"></script>
	<script src="skin/themes/dark-green.js" type="text/javascript"></script>-->
	</script><script src="skin/themes/grid.js" type="text/javascript"></script>
	
	
	
	
	
	
</head>
<body>
<script type="text/javascript">
$(function () {
    $('#grap').highcharts({
        title: {
            text: 'Data Consumable Per Jalur'
        },
		credits:{
			    enabled: false
				},
		yAxis: {
		title: {
                text: 'Jumlah dalam Rupiah (M = Juta)'
            },
		},
        xAxis: {

            categories: [<?PHP
			$jalurSql= "SELECT * FROM order_history WHERE konfirmasi='ok' GROUP BY nama_jalur";
			$jalurQry= mysqli_query( $koneksi, $jalurSql) or die ("error paging: ".mysqli_error());
			while ($myData = mysqli_fetch_array($jalurQry)) {
	$jalur = $myData['nama_jalur'];
	$dataSql= "SELECT * FROM order_history WHERE konfirmasi='ok' AND nama_jalur='$jalur'";
	$dataQry= mysqli_query($koneksi, $dataSql) or die ("error paging: ".mysqli_error());
	$jumlahjalur = mysqli_num_rows($dataQry);
	echo "'";
	echo $myData['nama_jalur'];
	echo "',";
	 };
			?>]
        },

        series: [{
            type: 'column',
			dataLabels: {enabled: true},
            name: 'Jumlah Order dalam Rupiah (Rp.)',
            data: [<?PHP
			$jalurSql= "SELECT * FROM order_history WHERE konfirmasi='ok' GROUP BY nama_jalur";
			$jalurQry= mysqli_query($koneksi,$jalurSql) or die ("error paging: ".mysqli_error());
			while ($myData = mysqli_fetch_array($jalurQry)) {
	$jalur = $myData['nama_jalur'];
	$dataSql= "SELECT SUM(total_harga) as total FROM order_history WHERE konfirmasi='ok' AND nama_jalur='$jalur'";
	$sum= mysqli_query($koneksi, $dataSql) or die ("error paging: ".mysqli_error());
	$totalsum=mysqli_fetch_array($sum);				
	echo $totalsum['total'];
	echo ",";
	 };
			?>]
        }
          ]
    });
});


		</script>
	<div id="grap" class="card shadow rounded"></div>
</body>
</html>