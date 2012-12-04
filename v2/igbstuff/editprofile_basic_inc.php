<?php
	include('session.php');
	include('class.php');	
	$igb	= new igobig;
	$current_loc = $igb->location();
	$ses_id	= $_SESSION['id'];
	$acct	= $igb->get_user_basic_information($ses_id);
	$loc	= $acct['location'];	
?>
<script type="text/javascript">
$(document).ready(function(){
 $('input[name=birthday]').datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true,yearRange: '1905:c'}); 
 $('input[name=gender]').click(function(){$('#ui-gender-select').toggle(200);});
 $('.ui-gender-option').click(function(){$('input[name=gender]').val($(this).text());$('#ui-gender-select').toggle(200);});
 $('body').click(function(e){if(e.target.id!=='gender'){if($('#ui-gender-select').is(':visible')){$('#ui-gender-select').toggle();}}});
 $('#editbasic').submit(function(){$.post('/ajax_request.php',$(this).serialize(),function(response){if(response=='Your profile has been updated.'){$('#headerContainer').load('header.php');$('#leftNavContainerEditProfile').load('editprofile_sidebar.php');if($('#ui-response-false').is(':visible')){$('#ui-response-false').hide();}$('#ui-response-true').text(response).fadeIn();}else{if($('#ui-response-true').is(':visible')){$('#ui-response-true').hide();}$('#ui-response-false').text(response).fadeIn();}});return false;});
});
</script>
<style type="text/css">
.ui-datepicker-month{padding:2px;}
.ui-datepicker-year{padding:2px;margin-left:10px;}
#ui-gender-select{width:90px;border:1px solid #aaaaaa;background:#FFF;color:#212121;position:absolute;display:none;}
.ui-gender-option{padding:2px 4px;border:1px solid #d3d3d3;margin:2px;background:#e6e6e6;cursor:pointer;}
.ui-gender-option:hover{border:1px solid #aaaaaa;background:#fff;}
.savechanges{background:url(/lib/images/save_button.png);width:93px;height:23px;text-indent:-999999px;border:0;cursor:pointer;}
.label{padding-right:0;}
#lastloc{color:#666;margin-left:5px;}
#ui-response-false{background:#ffebe8;border:1px solid #dd3c10;color:#333;padding:10px;margin:-10px 10px 20px 10px;display:none;}
#ui-response-true{background:#E1FED7;border:1px solid #98C589;padding:10px;color:#333;margin:-10px 10px 20px 10px;display:none;}
</style>
<div id="ui-response-false"></div>
<div id="ui-response-true"></div>
<form action="" method="post" id="editbasic">
<input type="hidden" name="sk" value="basic" />
<table class="table">
 	<tbody>    	
    	<tr><th class="label">Email:</th><td><input type="text" name="email" autocomplete="off" class="input" style="width:200px;" value="<?php echo stripslashes($acct['email']);?>"/></td></tr>
        <tr><th class="label">First Name:</th><td><input type="text" name="firstname" autocomplete="off" class="input" style="width:200px;" value="<?php echo stripslashes($acct['firstname']);?>"/></td></tr>
        <tr><th class="label">Last Name:</th><td><input type="text" name="lastname" autocomplete="off"  class="input" style="width:200px;" value="<?php echo stripslashes($acct['lastname']);?>"/></td></tr>                
        <tr><th class="label">Gender:</th><td><input type="text" name="gender" id="gender" readonly="readonly" class="input" style="width:80px;" value="<?php echo $acct['gender'];?>"/>
        <div id="ui-gender-select">
        <div class="ui-gender-option">Male</div>
        <div class="ui-gender-option">Female</div>
        </div>
        </td></tr>
        <tr><th class="label">Birthday:</th><td><input type="text" name="birthday" readonly="readonly" class="input" style="width:80px;"  value="<?php echo $acct['birthday'];?>"/></td></tr>
        <tr><th class="label">Mobile:</th><td><input type="text" name="mobile" maxlength="10" class="input" style="width:80px;"  value="<?php echo $acct['mobile'];?>"/></td></tr>
        <tr><th class="label">Current Location:</th><td><input type="text" name="location" readonly="readonly" class="input"  style="width:160px;" value="<?php echo $current_loc; ?>"/>
        <span id="lastloc"><?php if($loc){echo "You're last seen at $loc";}?></span></td></tr>
        <tr><th class="label">Hometown/City/Zip:</th><td><input type="text" name="hometown" autocomplete="off"  class="input" style="width:270px;" value="<?php echo stripslashes($acct['hometown']);?>"/></td></tr>       
    	<tr><th class="label">About Me:</th><td><textarea class="txtarea" name="bio" rows="5"><?php echo stripslashes($acct['bio']);?></textarea></td></tr>
	</tbody>
    <tfoot>
    	<tr><td></td><td><button type="submit" class="savechanges">Save Changes</button></td></tr>
    </tfoot>
</table>
</form>