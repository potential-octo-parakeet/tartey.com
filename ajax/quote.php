<?php session_start();?>
<script type="text/javascript">
$(document).ready(function(){
	$('#cancel').click(function(){
		$('#ui-dialog').hide();
	});
	$('textarea').val(_quote);
});
</script>
<div class="ui-dialog-wrapper">
    <h2 class="ui-dialog-title">Write Your Quote</h2>
	<form action="" method="post">
    <input type="hidden" name="uid" value="<?php echo $_SESSION['id'];?>" />
    <div class="ui-dialog-textarea">
      	<textarea cols="1" rows="1" name="quote" class="quote-text textarea"></textarea>
   	</div>
    <div class="ui-dialog-button">
    	<button type="submit" name="save">Save</button>&nbsp;&nbsp;&nbsp;<button type="button" id="cancel">Cancel</button>
	</div>
    </form>
</div>
