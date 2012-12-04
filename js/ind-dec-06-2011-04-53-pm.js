// JavaScript Document
$(document).ready(function(){
	/*
	$('#ftusers').load('ajax/home_featured_users.php?u');	
	setInterval(function(){$('#ftusers').load('ajax/home_featured_users.php?u');},60000);	
	$('#ftcount').load('json/index_users.php');
	setInterval(function(){$('#ftcount').load('ajax/home_featured_users.php?c');},60000);	
	*/
	people();
	setInterval(function(){people()},60000);	
});
people = function(){
	$.ajax({
		url: 'json/_index.php',
		dataType: 'json',
		success: function(response,ex){
					if(ex=='success'){
						$('#ftcount').text('');$('#people-grid-view').html('');
						$('#ftcount').text('There are '+response.total+' people inside.')
						$.each(response.users,function(i,data){						
							$('#people-grid-view').append(						
											'<li><a href="'+data.uri+'">'+
											'<img src="'+data.img+'" alt="'+data.name+'" class="img50" title="'+data.name+'"/>' +
											'<div class="name">'+data.nick+'</div>' +
											'</a></li>'
							);
						});
					}
				}
	});
}