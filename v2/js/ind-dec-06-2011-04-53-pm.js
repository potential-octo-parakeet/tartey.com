// JavaScript Document
$(document).ready(function(){
	$('#ftusers').load('ajax/home_featured_users.php?u');
	$('#ftcount').load('ajax/home_featured_users.php?c');
	setInterval(function(){$('#ftusers').load('ajax/home_featured_users.php?u');},20000);
});