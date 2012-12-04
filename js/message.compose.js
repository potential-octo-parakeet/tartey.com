// JavaScript Document
$(document).ready(function(){
	$('#receiver').keyup(function(){
		$.ajax({
			url: 'json/search.php',
			data: {q:this.value},
			dataType: 'json',
			success: function(response){
				$('#suggest').html('');
				if(response.result){
					$.each(response.data,function(i,data){
						$('#suggest').append(
							'<li class="sItem" id="'+data.id+'" data="'+data.name+'">'+
								'<img src="'+data.img+'" class="img32"/>'+
								'<div class="details"><span class="username">'+data.name+'</span></div>'+
							'</li>'
						).show();
					});
				}else{
					$('#suggest').html('').fadeOut('fast');
				}
			}
		});
	}).focus(function(){$(this).val('');$('#r').val('')});
	$(document).click(function(){
		$('#suggest').fadeOut('fast');
	});
	$('.sItem').live('click',function(){
		$('#r').val(this.id);
		$('#receiver').val($(this).attr('data'));
	});
	$('#composer').submit(function(){
		$('#response_msg').html('<img src="/images/throbber-sq.gif"/>');
		$.ajax({
			url: 'json/messages.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(response){
				if(response.result){
					$('#response_msg').html('<span style="color:green">'+response.message+'</span>').fadeIn();
				}else{
					$('#response_msg').html('<span style="color:red">'+response.message+'</span>').fadeIn();
				}
			},
			error: function(){$('#response_msg').html('<span style="color:red">An error has occured while sending.</span>').fadeIn();}
		});
		return false;
	});
});