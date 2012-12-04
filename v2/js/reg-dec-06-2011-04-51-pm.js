// JavaScript Document
$(document).ready(function(){
	$('#register').submit(function(){
		var fields = $(this).serialize();
		var result = $('.error');
		var throb  = $('.throbber_circle');
		throb.ajaxStart(function(){$(this).show()}).ajaxStop(function(){$(this).hide().unbind()});
		$.post('ajax/register.php',fields,function(response){result.html(response).fadeIn(100);});
		return false;
	});
});
