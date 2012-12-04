<?php 
	session_start();
	$SESSID = $_SESSION['id'];
?>
<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript">
var _uid = 0;
	_uid = <?php echo $SESSID;?>;
$(document).ready(function() {
  $('#file_upload').uploadify({
    'uploader'  : '/uploadify/uploadify.swf',
    'script'    : '/uploadify/uploadify.php',
    'cancelImg' : '/uploadify/cancel.png',
	'scriptData': {'uid':_uid,'path':'/user_images'},
    'auto'      : true,
	'fileExt'   : '*.jpg;*.jpeg',
	'fileDesc'	: 'Image Files',
	'sizeLimit' : 1000000,
	'removeCompleted' : false
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#throbber').hide();
	$('#cancel').click(function(){
		$('#ui-dialog').hide();
	});
	$('form[name=imgupload]').submit(function(){
		$('#imgfile').hide();
		$('#throbber').show();
	});
});
</script>
<form action="/ajax/upload.php" name="imgupload" method="post" enctype="multipart/form-data">
<div class="ui-dialog-wrapper">
    <h2 class="ui-dialog-title">Upload Photo</h2>
    <div class="ui-dialog-warning">Note: Maximum of 1MB file size will be accepted the rest will be ignore.</div>
    <div class="ui-dialog-input">    	
      	<input type="file" name="profile_img" id="file_upload"/>
        <div id="throbber" style="display:table-cell;height:20px;">
        	<img src="../images/throbber-sq.gif" style="vertical-align:middle"/>
            <span style="vertical-align:middle">Please wait, uploading...</span>
       	</div>
   	</div>
    <div class="ui-dialog-button">
    	<button type="submit" name="upload" class="hidden">Upload</button>&nbsp;&nbsp;&nbsp;<button type="button" id="cancel">Cancel</button>
	</div>
</div>
</form>
