<!DOCTYPE html>
<html lang="en">
<head>
	<link href="skin/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="skin/form-validation.js" type="text/javascript"></script>
</head>
<body>
	<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<div class="card shadow">
	      <div class="card-header bg-info">
	        <i class="fa fa-user fa-3x"></i>
	   		<h1>Login</h1>
	      </div>
	      <div class="card-body">
	        <form action="?open=login-validasi" method="post"  class="needs-validation" novalidate>
	   			<div class="form-group">
	      			<label for="uname">Username:</label>
	      			<input type="text" class="form-control" id="uname" placeholder="" name="uname" required>
	      			<div class="invalid-feedback">Silakan Isi Data Username</div>	   		 		
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
	    			<input type="password" class="form-control" id="pwd" placeholder="" name="pass" required>
	    			<div class="invalid-feedback">Silakan Isi Data Password</div>
				</div>
				<button type="submit" class="btn btn-primary" name="btnLogin"><i class='fa fa-unlock'></i> Login</button>
	  		</form>
		 </div>
	</div>
	</div>
	<div class="col-md-4"></div>
	</div>
</body>
</html>