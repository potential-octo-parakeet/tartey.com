<div class="wrapper profile-page" style="padding-right:0;padding-left:0;">
  <div class="option-wrapper">
  <?PHP if($SESSID==$_SESSION['id']){//IF USER $_GET['id'] IS EQUAL TO SESSION ID THEN DISPLAY UPLOAD BUTTON?>
  	<a href="" class="aButton upload-photos">Upload Photos (<span id="photoCount"></span>)</a>
  <?PHP }?>
  </div> 
  <div class="photos" style="border:0;">
	<ul id="photo-grid-display">      
    </ul>
  </div>
  <?PHP if($SESSID==$_SESSION['id']){//IF USER $_GET['id'] IS EQUAL TO SESSION ID THEN DISPLAY CHECKBOX?>
  <div id="buttonWrapper" class="option-wrapper" style="border:0;border-top:1px solid #FDD;">
  <div id="error_msg" style="font-weight:bold;color:red;"></div>
  <a href="#" class="aButton" id="delSelected">Delete selected</a> &nbsp;&nbsp;&nbsp; 
  <a href="#" class="aButton" id="makePrimary">Make Primary</a>
  </div>
  <?PHP }?>
</div>