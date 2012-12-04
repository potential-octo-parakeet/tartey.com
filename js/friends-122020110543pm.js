// JavaScript Document
function friends(uid){
	$.ajax({
		url: 'json/friends.php',
		data: 'uid='+uid+'&offset=0&limit=500',//TEMPORARILY SET
		dataType: 'json',
		success: function(response){
					$('.friends_in_total').text(response.total);
					$.each(response.friends,function(i,data){
						$('#friends-grid-display').append(						
									'<li><a href="'+data.uri+'">'+
									'<img src="'+data.img+'" alt="'+data.name+'" class="img50" title="'+data.name+'"/>' +
									'<div class="name">'+data.nick+'</div>' +
									'</a></li>'
						);
					});
				},
		error: function(){alert('Please wait, processing your request.')}
	});
}