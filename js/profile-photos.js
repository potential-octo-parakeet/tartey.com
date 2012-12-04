// JavaScript Document
$(document).ready(function(){
	$.ajax({
		url:'json/photos.php',		
		data: 'uid='+AUSER.uid+'&offset=0&limit=100',
		type: 'post',
		dataType: 'json',
		success: function(response){
			$('#photoCount').text(response.total);
			if(response.total==0){$('#buttonWrapper').addClass('hidden');}
			$.each(response.photos,function(i,data){
				$('#photo-grid-display').append(
					'<li id="'+data.id+'">'+
					'<a class="photo-gallery" href="'+data.zoom+'"><img src="'+data.thumbnail+'" /></a>'+
					'<div><input type="checkbox" name="action[]" class="selectedImg" value="'+data.id+'"/></div>'+
					'</li>'						
					);
			});
		}
	});	
});