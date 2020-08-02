<div class="navbar-nav">
	<?php
	if(isset($_SESSION['SES_ADMIN_CCR'])){
	?>
      <a href="?open=home" class="nav-item nav-link"><i class="fa fa-home"></i> Home</a>
      <a href="?open=order-barang" class="nav-item nav-link"><i class="fa fa-shopping-basket"></i> Order Barang</a>
	  <a href="?open=data-barang" class="nav-item nav-link"><i class="fa fa-archive"></i> Data Barang</a>
		<div class="nav-item dropdown">
        	<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-stack-overflow"></i> Order</a>
            <div class="dropdown-menu alert-dark">
				<a href="?open=data-order" class="dropdown-item"><i class="fa fa-list-alt"></i> Data Order</a>
	  			<a href="?open=data-order-back" class="dropdown-item"><i class="fa fa-recycle"></i> Order Recycle</a>
	  			<a href="?open=data-order-print" class="dropdown-item"><i class="fa fa-print"></i> Cetak All Order</a>
			</div>
		</div>
	  
		<?php
			if($_SESSION['SES_LEVEL_CCR'] == 'Administrator')
            	{
		?>
		<div class="nav-item dropdown">
        	<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i> Control Panel</a>
            <div class="dropdown-menu alert-dark">
            	<a href="?open=data-user" class="dropdown-item"><i class="fa fa-user"></i> User</a>
				<a href="?open=data-jalur" class="dropdown-item"><i class="fa fa-link"></i> Data Jalur</a>
				<a href="?open=data-keterangan" class="dropdown-item"><i class="fa fa-calendar-o"></i> Isi Keteranagn</a>
			</div>
		</div>
        <?php
        } 
        ?>
	<?php
	} else { 
	?>
	<a href="?open=home" class="nav-item nav-link"><i class="fa fa-home"></i> Home</a>
      <a href="?open=order-barang" class="nav-item nav-link"><i class="fa fa-shopping-basket"></i> Order Barang</a>
	<?php 
	}
	?>
</div>