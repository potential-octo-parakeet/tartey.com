/*
 * (c) TARTEY 2011
 * CODED BY MAR CEJAS
 * 
 */
$(document).ready(function(){
	$('.dum-email').click(function(){$('.login-email').focus()});
	$('.dum-passwd').click(function(){$('.login-passwd').focus()});
	$('.login-email').keyup(function(){$('.dum-email').hide();});
	$('.login-email').change(function(){if($(this).val()!=''){$('.dum-email').hide();}});
	$('.login-passwd').keyup(function(){$('.dum-passwd').hide();});
	$('.reg-lab-fname').click(function(){$('.reg-fname').focus()});
	$('.reg-lab-lname').click(function(){$('.reg-lname').focus()});
	$('.reg-lab-email').click(function(){$('.reg-email').focus()});
	$('.reg-lab-passwd').click(function(){$('.reg-passwd').focus()});
	$('.reg-fname').keyup(function(){$('.reg-lab-fname').hide();});
	$('.reg-lname').keyup(function(){$('.reg-lab-lname').hide();});
	$('.reg-email').keyup(function(){$('.reg-lab-email').hide();});
	$('.reg-passwd').keyup(function(){$('.reg-lab-passwd').hide();});
});