// JavaScript Document
var _QUOTE = "";
$(document).ready(function(){	
	$('.edit-quote').click(function(){
		_QUOTE = $('#quote-text').text();
		$('#ui-dialog').show().load('ajax/quote.php');
		return false;
	});
	$('.edit_pic').click(function(){
		$('#ui-dialog').show().load('ajax/edit_picture.php');
		return false;
	});	
	$.ajax({
		url: 'json/friends.php',
		data: 'uid='+AUSER.uid+'&offset=0&limit=500',//TEMPORARILY SET
		dataType: 'json',
		success: function(response){
					$('#friends_in_total').text(response.total);
					$.each(response.friends,function(i,data){
						$('#friends-grid-display').append(						
									'<li><a href="'+data.uri+'">'+
									'<img src="'+data.img+'" alt="'+data.name+'" class="img50" title="'+data.name+'"/>' +
									'<div class="name">'+data.nick+'</div>' +
									'</a></li>'
						);
					});
				},
	});
	setInterval(function(){
		$.ajax({
			url:'json/session.php',
			dataType: 'json',
			success:function(response){
				if(!response.status){
					window.location.href='login.php?user=true&email='+AUSER.email+'&timeout=true';
				}
			}
		})
	},10000);
});