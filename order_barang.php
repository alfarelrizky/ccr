<!doctype html>
<html>
<head>
    <link href="skin/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="skin/font-awesome/css/font-awesome.css" rel="stylesheet">
	<script src="skin/form-validation.js" type="text/javascript"></script>
</head>
<body>
	<div class="jumbotron shadow">
    	<h2 class="border-bottom border-dark mb-3"><i class="fa fa-shopping-basket"></i> Order Barang</h2>
		<div>
			<a class="btn btn-outline-primary" href="?open=order"><i class="fa fa-history"></i> History Order</a>	   
		</div>
		<hr class="bg-dark mb-3">
		<form action="?open=konf-order" method="post" name="form1" target="_self" class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama_order" class="form-control" id="nama" placeholder="" value="" required>
            <div class="invalid-feedback">
              Silakan isi nama.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="npk">NPK</label>
            <input type="number" name="npk_order" class="form-control" id="npk" placeholder="" value="" required>
            <div class="invalid-feedback">
              Silakan isi NPK.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="shift">Shift</label>
            <select name="shift_order" class="custom-select d-block w-100" id="shift" required>
              <option value="">Choose...</option>
              <option value="Shift A">Shift A</option>
              <option value="Shift B">Shift B</option>
              <option value="Non Shift">Non Shift</option>
            </select>
            <div class="invalid-feedback">
              Silakan pilih Shift.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="jalur">Jalur</label>
            <select  name="jalur_order" class="custom-select w-100" id="jalur" required>
              <option value="">Choose...</option>
              <?php	
           			$dataSql = "SELECT * FROM jalur ORDER BY nama_jalur ASC";
           			$dataQry = mysqli_query($koneksi, $dataSql) or die ("Gagal Query".mysqli_error());
           			while ($dataRow = mysqli_fetch_array($dataQry)) {
	         			echo "<option value='$dataRow[nama_jalur]'>$dataRow[nama_jalur]</option>";
 	         							};
	          ?> 
            </select>
            <div class="invalid-feedback">
              Silakan pilih Jalur.
            </div>
          </div>
			<div class="col-md-4 mb-3">
            <label for="kategori">Jenis Barang</label>
            <select name="kategori_order" class="custom-select d-block w-100" id="kategori" required>
              <option value="">Choose...</option>
              <option value="DIRECT">DIRECT</option>
              <option value="INDIRECT">INDIRECT</option>
            </select>
            <div class="invalid-feedback">
              Pilih jenis barang.
            </div>
          </div>
        </div>
     	<hr class="bg-dark mb-3">
		<div class="row">
          <div class="col-md-6 mb-3"> 
        	<button name="btnsimpan" class="btn btn-primary btn-block btn-lg" type="submit"><i class='fa fa-sign-in'></i> Mulai Order</button>
		  </div>
		  <div class="col-md-6 mb-3"> 
        	<button class="btn btn-warning btn-block btn-lg" type="reset"><i class='fa fa-refresh'></i> Reset</button>
		  </div>	    
		</div>
		</form>
	</div>
</body>
</html>