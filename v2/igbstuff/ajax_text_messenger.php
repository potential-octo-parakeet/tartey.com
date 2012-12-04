<?php
	session_start();
	$ses_id = $_SESSION['id'];
	include('class.php');
	$_user = new profile;
?>
<script type="text/javascript">
$(document).ready(function(){	
	credits();cint();
	$('#textsubmit').submit(function(){
		$('#sending_throbber').show();
		$('#sending_throbber').ajaxStart(function(){$(this).show();}).ajaxStop(function(){$(this).hide();$(this).unbind();});
		$.post('ajax_sms.php',$(this).serialize(),function(response){$('#smsconfirm').html(response).fadeIn();credits();cint();});
		return false;
	});
	$('#mobilenumber').focus(function(){var n=$(this);if(n.val()=='905xxxxxxx'){n.val('');}});
	$('#mobilenumber').blur(function(){var n=$(this);if(n.val()==''){n.val('905xxxxxxx');}});
	$('#textbox').keyup(function(){var l=this.value.length;var c=120-l;$('#charcount').text(c);if(l>120){$('#chars,#textbox').css('color','red');}else{$('#chars').css('color','gray');$('#textbox').css('color','#333');}});
	setInterval(function(){credits();cint();},30000);
});
function credits(){
	$.get('ajax_sms.php?credit',function(response){$('.credits').html(response)});
	$.get('ajax_sms.php?mobile',function(response){$('#mynumber').val(response)});
}
function cint(){
	$.get('ajax_sms.php?cint',function(response){if(response<1){$('#send').attr('disabled','disabled');}else{$('#send').removeAttr('disabled');}});
}
</script>
<style type="text/css">
#mobilenumber{width:210px;outline:none;padding:2px 4px;border:1px solid #aaa;color:#ccc;}
#mobilenumber:focus{color:#333;}
#textbox{outline:none;resize:none;width:210px;padding:2px 4px;border:1px solid #aaa;font-family:arial;font-size:12px;overflow:hidden;color:#333;}
#send{padding:2px 4px;width:80px;cursor:pointer;color:#510;font-weight:bold;}
#msgr_form_wrapper{margin:10px;}
.umobile{color:gray;}
#smsconfirm{padding:4px;background:#d8fdea;border:1px solid #15884e;display:none;}
#sending_throbber{margin-left:10px;display:none;}
</style>
<div class="column_right_box_header">Text Messenger (<span class='credits'>Credit: 0</span>) </div>
<div class="text_messenger">
	<div id="msgr_form_wrapper">
	<form action="" method="post" id="textsubmit">
    <input type="hidden" name="sms" value="true" />
    <input type="hidden" name="mynumber" id="mynumber"/>
	<div><input type="text" name="mobile" id="mobilenumber" maxlength="10" value="905xxxxxxx"/></div>
    <div><textarea rows="5" cols="20" name="message" id="textbox"></textarea></div>
    <div id="smsconfirm"></div>
    <div><button type="submit" id="send">Send</button><span id="sending_throbber"><img src='lib/images/GsNJNwuI-UM.gif'/></span></div>
    </form>
    <div class="umobile hide">Your mobile #: </div>
    <div class="umobile" id="chars">Characters: <span id="charcount">120</span></div>
    <div class="umobile"><span class="credits">Credit: 0</span></div>    
    <div class="umobile">Add more friends to earn more credits.</div>
    </div>    
</div>