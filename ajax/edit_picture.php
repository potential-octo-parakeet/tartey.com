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
	'scriptData': {'dir':'photos','uid':_uid},
    'auto'      : true,
	'fileExt'   : '*.jpg;*.jpeg;*.png;*.gif',
	'fileDesc'	: 'Image Files',
	'sizeLimit' : 4000000,
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
    <div class="ui-dialog-warning">Note: Maximum of 4MB file size will be accepted the rest will be ignore.</div>
    <div class="ui-dialog-input">    	
      	<input type="file" name="profile_img" id="file_upload"/>        
   	</div>
    <div class="ui-dialog-button">
    	<button type="submit" name="upload" class="hidden">Upload</button>&nbsp;&nbsp;&nbsp;<button type="button" id="cancel">Cancel</button>
	</div>
</div>
</form>
