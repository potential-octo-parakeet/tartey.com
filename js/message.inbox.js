// JavaScript Document

$(document).ready(function(){
	var _offset = 0;
	var _limit	= 500;
	$.ajax({
		url: 'json/messages.php',
		data: {offset:_offset,limit:_limit,read:true},
		dataType: 'json',
		success: function(response){			
			if(response.result){
				$.each(response.data,function(i,data){
					$('#tbody').append(
					'<tr id="'+data.id+'">'+
						'<td class="data-img">'+
							'<a href="'+data.uri+'"><img src="'+data.img+'" class="img"/></a>'+
						'</td>'+
						'<td class="data-content">'+
							'<a href="'+data.uri+'" class="username">'+data.name+'</a>'+
							'<a href="http://tartey.com/messages.php?sk=read&id='+data.id+'" class="content-msg">'+data.message+'</a>'+
						'</td>'+
						'<td class="data-time">'+
							'<span class="timestamp">'+data.timestamp+'</span>'+
							'<span><input type="checkbox" name="msg[]" class="selectedMsg" value="'+data.id+'"/></span>'+
						'</td>'+
					'</tr>');
				});
			}else{$('#error_msg').html('<span style="float:left">'+response.message+'</span>')}
		}
	});
	$('#delSelected').click(function(){
		$('.selectedMsg').each(function(){
			if($(this).is(':checked')){
				var _msg_id = this.value;
				$.ajax({
					url: 'json/messages.php',
					data: {msg_id:_msg_id,del:true,receiver:true},
					dataType: 'json',
					success: function(response){
						if(response.result){		
							$('#'+_msg_id).fadeOut();							
						}else{
							alert(response.message);
						}
					}
				});				
			}
		});return false;
	});
	$('#selectAll').click(function(){
		$('.selectedMsg').each(function(){
			if($(this).not(':checked')){
				$(this).attr('checked','checked');
				$('#'+this.value).css('background','white');
			}
		});return false;
	});
	$('#deselectAll').click(function(){
		$('.selectedMsg').each(function(){
			if($(this).is(':checked')){
				$(this).removeAttr('checked');
				$('#'+this.value).css('background','#FEEDEF');
			}
		});return false;
	});
	$('.selectedMsg').live('click',function(){
		if($(this).is(':checked')){
			$('#'+this.value).css('background','white');
		}
		if(!$(this).is(':checked')){
			$('#'+this.value).css('background','#FEEDEF');
		}
	});
});