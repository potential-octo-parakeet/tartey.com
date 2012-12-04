/*
 * (c) TARTEY 2011
 * CODED BY MAR CEJAS
 * 
 */
$(document).ready(function(){
	$('.dum-email').click(function(){$('.login-email').focus()});
	$('.dum-passwd').click(function(){$('.login-passwd').focus()});
	$('.login-email').keyup(function(){if($(this).val()!=''){$('.dum-email').hide();}});
	$('.login-passwd').keyup(function(){if($(this).val()!=''){$('.dum-passwd').hide();}});
	$('.reg-lab-fname').click(function(){$('.reg-fname').focus()});
	$('.reg-lab-lname').click(function(){$('.reg-lname').focus()});
	$('.reg-lab-email').click(function(){$('.reg-email').focus()});
	$('.reg-lab-passwd').click(function(){$('.reg-passwd').focus()});
	$('.reg-fname').keyup(function(){if($(this).val()!=''){$('.reg-lab-fname').hide();}});
	$('.reg-lname').keyup(function(){if($(this).val()!=''){$('.reg-lab-lname').hide();}});
	$('.reg-email').keyup(function(){if($(this).val()!=''){$('.reg-lab-email').hide();}});
	$('.reg-passwd').keyup(function(){if($(this).val()!=''){$('.reg-lab-passwd').hide();}});
});