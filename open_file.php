<?php
if($_GET) {
	switch($_GET['open']){				
		case '' :				
			if(!file_exists ("main.php")) die (include include "empty.php"); 
			include "main.php";		break;			
		case 'home' :				
			if(!file_exists ("grafik.php")) die (include include "empty.php"); 
			include "grafik.php";	break;

		
		# USER LOGIN
		case 'login' :				
			if(!file_exists ("login.php")) die (include include "empty.php"); 
			include "login.php";	break;			
		case 'login-validasi' :				
			if(!file_exists ("login_validasi.php")) die (include include "empty.php"); 
			include "login_validasi.php";		break;			
		case 'logout' :				
			if(!file_exists ("login_out.php")) die (include include "empty.php"); 
			include "login_out.php";		break;			
		case 'user-daftar' :				
			if(!file_exists ("daftar.php")) die (include include "empty.php"); 
			include "daftar.php";		break;
			
		case 'data-user' :				
			if(!file_exists ("data_user.php")) die (include include "empty.php"); 
			include "data_user.php";		break;		
		case 'user-delete' :				
			if(!file_exists ("user_delete.php")) die (include include "empty.php"); 
			include "user_delete.php";		break;			
		case 'license' :				
			if(!file_exists ("license.php")) die (include include "empty.php"); 
			include "license.php";	 break;
			
		# Update File	
		case 'update' :				
			if(!file_exists ("update.php")) die (include "empty.php"); 
			include "update.php"; break;
		case 'update_data' :				
			if(!file_exists ("update_data.php")) die (include "empty.php"); 
			include "update_data.php"; break;
		case 'update_delete' :				
			if(!file_exists ("update_delete.php")) die (include "empty.php"); 
			include "update_delete.php"; break;	
			
		# Jalur
		case 'data-jalur' :				
			if(!file_exists ("data_jalur.php")) die (include "empty.php"); 
			include "data_jalur.php"; break;	
		case 'jalur-delete' :				
			if(!file_exists ("jalur_delete.php")) die (include "empty.php"); 
			include "jalur_delete.php";		break;	
			
		# Keterangan
		case 'data-keterangan' :				
			if(!file_exists ("keterangan.php")) die (include "empty.php"); 
			include "keterangan.php"; break;	
		case 'keterangan-delete' :				
			if(!file_exists ("keterangan_delete.php")) die (include "empty.php"); 
			include "keterangan_delete.php";		break;
			
		# Barang
		case 'data-barang' :				
			if(!file_exists ("data_barang.php")) die (include "empty.php"); 
			include "data_barang.php"; break;	
		case 'barang-delete' :				
			if(!file_exists ("barang_delete.php")) die (include "empty.php"); 
			include "barang_delete.php";		break;	
		case 'order-barang' :				
			if(!file_exists ("order_barang.php")) die (include "empty.php"); 
			include "order_barang.php";		break;
		case 'order' :				
			if(!file_exists ("order.php")) die (include "empty.php"); 
			include "order.php";		break;
		case 'konf-order' :				
			if(!file_exists ("konf_order.php")) die (include "empty.php"); 
			include "konf_order.php";		break;
		case 'order-barang-delete' :				
			if(!file_exists ("order_barang_delete.php")) die (include "empty.php"); 
			include "order_barang_delete.php";		break;
		case 'order-barang-delete-adm' :				
			if(!file_exists ("order_barang_delete_adm.php")) die (include "empty.php"); 
			include "order_barang_delete_adm.php";		break;
		case 'data-order' :				
			if(!file_exists ("data_order.php")) die (include "empty.php"); 
			include "data_order.php";		break;
		case 'data-order-print' :				
			if(!file_exists ("data_order_print.php")) die (include "empty.php"); 
			include "data_order_print.php";		break;
		case 'data-order-back' :				
			if(!file_exists ("data_order_back.php")) die (include "empty.php"); 
			include "data_order_back.php";		break;
		case 'konf-data-order' :				
			if(!file_exists ("konf_data_order.php")) die (include "empty.php"); 
			include "konf_data_order.php";		break;
		case 'konf-data-order-back' :				
			if(!file_exists ("konf_data_order_back.php")) die (include "empty.php"); 
			include "konf_data_order_back.php";		break;
			
		# upload
		case 'upload-excel' :				
			if(!file_exists ("uploadexcel.php")) die (include "empty.php"); 
			include "uploadexcel.php"; break;	
	}
}
else {
	if(!file_exists ("grafik.php")) die (include "empty.php"); 
			include "grafik.php";
}
?>