// JavaScript Document
$(document).ready(function(){
	$.ajax({
		url: 'json/friends.php',
		data: 'uid='+AUSER.uid+'&offset=0&limit=500',//TEMPORARILY SET
		dataType: 'json',
		success: function(response){
			$.each(response.friends,function(i,data){
				$('#people-grid-display').append(
									'<li><a href="'+data.uri+'">'+
									'<img src="'+data.img+'" alt="'+data.name+'" class="img50" title="'+data.name+'"/>' +
									'<div class="name">'+data.nick+'</div>' +
									'</a></li>'
									);
			});
		}
	});
});