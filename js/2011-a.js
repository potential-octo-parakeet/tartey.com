/*
 * (c) IGOBIG 2011
 * CODED BY MAR CEJAS
 *
 */

$(document).ready(function(){
	$('#createAccount').submit(function(){		
		$.post('/ajax_register.php',$(this).serialize(),function(response){$('#callBackMessage').html(response).fadeIn();});
		return false;
	});
	$('.jqloading').ajaxStart(function(){$(this).show()}).ajaxStop(function(){$(this).hide();});
});