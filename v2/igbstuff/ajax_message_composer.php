<script type="text/javascript">
$(document).ready(function(){
	$('#uiButtonCancel').click(function(){
		$('#uiComposeMessageContainer').fadeOut();		
	});
	$('#user_q').keyup(function(){
		var s = $(this).val();
		$.post('/ajax_message_composer_user_suggest.php',{user_q:true,q:s},function(response){$('#uiUserDropDown').html(response).fadeIn();});
	});		
	$('#ui_message_composer').autoResize({
		onResize : function() {
			$(this).css({opacity:0.8});
		},
		animateCallback : function() {
			$(this).css({opacity:1});
		},
		animateDuration : 300,
		extraSpace : 0
	});
	$('#messageComposer').submit(function(){
		$.post('/ajax_request.php',$(this).serialize(),function(response){if(response){$('#uiConfirmSend').text(response).fadeIn()}});
		return false;
	});
});
</script>
<div id="uiComposeMessage">
<div class="ui-wrapper">
 	<div class="ui-corner-top"></div>
  	<div class="ui-center">
   		<div class="ui-content-header"><h2>New Message<span class="right"><i class="keyicon"></i></span></h2></div>        
  		<div class="ui-content-wrapper">       
        <div id="uiConfirmSend"></div>         
        <form action="" method="post" id="messageComposer">
        <div id="UserIDContainer"></div>        
    	<table class="ui-form-wrapper">
    		<tbody>
  				<tr><td class="label">To: </td>
                <td>
                	<div class="uiTextAreaWrapper">
                    	<div id="recipientContainer"></div>
                    	<input type="text" name="recipient" class="ui-input-to-user" id="user_q"/>
                    </div>
                	<div id="uiUserDropDown">
                    </div>
              	</td></tr>
           		<tr><td class="label">Message: </td>
                <td>
                	<div class="uiTextAreaWrapper">
                    <textarea name="message" cols="4" rows="4" class="ui-input-message" id="ui_message_composer"></textarea></div>
               	</td></tr>
     		</tbody>
		</table>
   		<div class="ui-content-footer">
    		<span class="right"><button type="submit" class="ui-button-icon ui-button-send">Send</button>
      		<button type="button" class="ui-button-icon ui-button-cancel" id="uiButtonCancel">Cancel</button></span>
      		<div class="clear"></div>
    	</div>
        </form>
		</div>            
	</div>        
	<div class="ui-corner-bottom"></div>
</div>