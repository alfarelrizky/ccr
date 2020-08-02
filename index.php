<?php
session_start();

 include "backup_database/backup.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
   <title>Cost Control Assy 2</title>
	<link href="image/chart.png" rel="icon" type="image/png" />
    <link href="skin/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="skin/font-awesome/css/font-awesome.css" rel="stylesheet">
	<script src="skin/bootstrap/jquery/jquery.js"></script>
  	<script src="skin/bootstrap/js/bootstrap.js"></script>
  	
</head>
  <body>
	  
  <!-- menu atas -->
 	 <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top shadow"><img src="image/chart.png" width="50" height="50">
        <a class="navbar-brand" href="index.php"> &nbsp;Data CCR</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
        	<?php include "menu.php";?>
            <div class="navbar-nav ml-auto">
            	<?php include "login_info.php";?>
            </div>
 		</div>
 	 </nav>
	  
<!-- Konten atas -->
  <br>
  <br>
  <br>
  <main role="main" class="col-md-6 col-lg-12 px-4">
    <div class="nav border-bottom border-dark" id="date">
		<div class="navbar">
          <h6><i class="fa fa-calendar"></i> <?php include "library/tanggal.php"; ?></h6>
		</div>
		<div class="navbar-text ml-auto">
			<?php 
				$periksa=mysqli_query($koneksi, "select * from barang where stock_barang <= stock_std");
				$jum=mysqli_num_rows($periksa);
			?>
		<button class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#pesan"><i class="fa fa-comments-o"></i> Pesan <span class="badge badge-danger badge-pill"><?php echo  $jum; ?></span></button>
			<!-- modal pesan -->
			<div id="pesan" class="modal fade">
				<div class="modal-dialog modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Notification</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>							
						</div>
						<div class="modal-body">
						<?php 
							$periksa=mysqli_query($koneksi, "select * from barang where stock_barang <= stock_std ORDER BY stock_std ASC");
							while($q=mysqli_fetch_array($periksa)){	
								if ($q['stock_barang'] == 0){						
									echo "<div class='alert alert-danger alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>  Stok  <strong><a style='color:red'>". $q['nama_barang']."</a></strong> habis..... !!</div>";
								}
								else{
									echo "<div class='alert alert-info alert-dismissible fade show' align='center'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>  Stok  <a style='color:red'>". $q['nama_barang']."</a> yang tersisa sudah kurang dari <strong><a style='color:red'>" . $q['stock_std']. "</a></strong>. silahkan pesan lagi !!</div>";	
								}
							}
						?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>						
						</div>				
					</div>
				</div>
			</div>
	    </div>    	
	  </div>
  </main>  
  <br>
<!-- Bawah -->
 <footer class="bg-dark fixed-bottom shadow">
	<div class="text-center text-muted">
    <a href="#">Back to top</a><p>Copyright&copy;2020.Alfarel Rizqi.Allreserved.</p>
	</div>
 </footer>
	  

<!-- Isi -->  
  <div class="px-4">
	<?php include "open_file.php";?>
  </div>
  <br>
  <br>
  <br>
	  
</body>
</html>
