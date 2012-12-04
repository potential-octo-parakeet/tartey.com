<?php
	include('session.php');
	include('class.php');
	$igb	= new igobig;
	$ses_id	= $_SESSION['id'];
	$acct	= $igb->get_user_basic_information($ses_id);
?>
<script type="text/javascript">
$('#save').click(function(){
	$(this).hide();
	$('#uploading').show();
});
</script>
<style type="text/css">
#uploading{float:left;text-align:center;display:none;font-weight:bold;color:#666;font-size:14px;}
</style>
<div id="profile_pic_holder">
	<img src="<?php echo "/user_images/".$acct['picture180'];?>" />
</div>
<div id="profile_pic_browser">
    <div class="headertxt">Select an image file on your computer (4MB max):</div>
    <div class="uploader_form">
    <form action="" method="post" class="profile_pic_uploader" enctype="multipart/form-data">
    <input type="hidden" name="sk" value="picture">
    <input type="file" name="picture" class="picturebrowser"/>
    <br /><br /><br />
    <div id="uploading"><img src="lib/images/jKEcVPZFk-2.gif" /><br />Uploading Picture ...</div>
    <button type="submit" class="savechanges" id="save">Save Changes</button>    
    </form>
	</div>
</div>
<div class="clear"></div>