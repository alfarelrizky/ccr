// JavaScript Document

$( function() {

$( "input[type=radio]" ).checkboxradio({
      icon: false
    });
	
$( "#kalender" ).datepicker();

$( "#accordion" ).accordion();

$( "#button" ).button();

$( "#controlgroup" ).controlgroup();
					

$( "#controlgroup2" ).controlgroup();

$( "#controlgroup3" ).controlgroup();

$( "#carigroup" ).controlgroup();

$( "#button_login" ).button({
	icon: "ui-icon-unlocked",
	showLabel: true
});

$( "#button_reset" ).button({
	icon: "ui-icon-arrowrefresh-1-w",
	showLabel: true
});

$( "#button_login_lock" ).button({
	icon: "ui-icon-locked",
	showLabel: true
});

$( "#button_login_out" ).button({
	icon: "ui-icon-person",
	showLabel: true
});

$( "#button_save" ).button({
	icon: "ui-icon-disk",
	showLabel: true
});

$( "#button_tambah" ).button({
	icon: "ui-icon-plusthick",
	showLabel: true
});

$( "#button_daftar" ).button({
	icon: "ui-icon-check",
	showLabel: true
});

$( "#button_setting" ).button({
	icon: "ui-icon-gear",
	showLabel: false
});

$( "#button_cari" ).button({
	icon: "ui-icon-search",
	showLabel: true
});

$( "#button_cari2" ).button({
	icon: "ui-icon-search",
	showLabel: true
});

$( "#pilih" ).selectmenu()
					.selectmenu( "menuWidget" )
					.addClass( "overflow" );

$( "#pilih2" ).selectmenu()

$( "#menu_admin" ).tabs();

$( "#radioset" ).buttonset();

$( "#onoff" ).buttonset()
			.checkboxradio({
      icon: false
    });

$( "#menu" ).menu();
					
 } );