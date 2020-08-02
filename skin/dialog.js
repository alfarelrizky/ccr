// JavaScript Document
$(document).ready(function() {

	var textPESAN = 'Apa Anda yakin akan menghapusnya ?';

	$("#dialog").dialog({
		modal: true,
		bgiframe: true,
		width: 400,
		height: 170,
		autoOpen: false,
		title: 'Konfirmasi'
		});

	// Set link
	$("a.confirm").click(function(link) {
        link.preventDefault();
        var ambilHREF = $(this).attr("href");
		var setingPESAN = $(this).attr("pesan");
		var textPESAN = (setingPESAN == undefined || setingPESAN == '') ? pesan_default : setingPESAN;
		var gambarICON = '<span class="fa fa-danger" style="float:left; margin:0 7px 0 0;"></span>';

		// set kotak dialog 
		$('#dialog').html('<P>' + gambarICON + textPESAN + '</P>');

		$("#dialog").dialog('option', 'buttons', {
                "Confirm" : function() {
                    window.location.href = ambilHREF;
                    },
                "Cancel" : function() {
                    $(this).dialog("close");
                    }
                });
		$("#dialog").dialog("open");
		});
});