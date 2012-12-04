// JavaScript Document
$(document).ready(function(){
	var _offset = 0;
	var _limit	= 500;
	$.ajax({
		url: 'json/messages.php',
		data: {offset:_offset,limit:_limit},
		dataType: 'json',
		success: function(response){
			$.each(response.data,function(i,data){
				$('#tbody').append(
				'<tr>'+
					'<td class="data-img">'+
						'<a href="'+data.uri+'"><img src="'+data.img+'" class="img"/></a>'+
					'</td>'+
					'<td class="data-content">'+
						'<a href="'+data.uri+'" class="username">'+data.name+'</a>'+
						'<a href="http://tartey.com/messages.php?sk=read&id='+data.id+'" class="content-msg">'+data.message+'</a>'+
					'</td>'+
					'<td class="data-time">'+
						'<span class="timestamp">'+data.timestamp+'</span><span><input type="checkbox" name="msg[]" class="selectedMsg" /></span>'+
					'</td>'+
				'</tr>');
			});
		}
	});
});