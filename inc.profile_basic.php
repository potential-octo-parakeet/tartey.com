<?php 
	$u = $f->user_basic_info($SESSID);
?>
<div class="wrapper profile-page">
  <table class="tabular-data" cellpadding="4">
    <tbody>
      <tr><td class="label">Email Address</td><td><?php echo $u['email'];?>
      <?PHP if($SESSID==$_SESSION['id']){//IF $_GET['id'] IS EQUAL TO SESSION ID THEN DISPLAY EDIT BUTTON?>
      <a href="profile.php?sk=edit" class="r edit-profile-basic">Edit</a>
	  <?PHP }?>
      </td></tr>
      <?PHP if($SESSID==$_SESSION['id']){//IF $_GET['id'] IS EQUAL TO SESSION ID THEN DISPLAY THIS FIELDS?>
      <tr><td class="label">First Name</td><td><?php echo stripslashes($u['firstname']);?></td></tr>
      <tr><td class="label">Last Name</td><td><?php echo stripslashes($u['lastname']);?></td></tr>
      <?PHP }?>
      <tr><td class="label">Gender</td><td><?php echo $u['gender'];?></td></tr>
      <tr><td class="label">Birthday</td><td><?php echo $u['birthday'];?></td></tr>
      <?PHP if($SESSID==$_SESSION['id']){?>
      <tr><td class="label">Mobile</td><td><?php echo $u['mobile'];?></td></tr>
      <?PHP }else{?>
      <tr><td class="label">Mobile</td><td>*Private</td></tr>
      <?PHP }?>
      <tr><td class="label">Current Location</td><td><?php echo stripslashes($u['location']);?></td></tr>
      <tr><td class="label">Hometown/City/Zip</td><td><?php echo stripslashes($u['hometown']);?></td></tr>
      <tr><td class="label">About Me</td><td><?php echo stripslashes($u['bio']);?></td></tr>
    </tbody>
    <?PHP if($SESSID==$_SESSION['id']){//IF $_GET['id'] IS EQUAL TO SESSION ID THEN DISPLAY EDIT BUTTON?>
    <tfoot>
      <tr><td colspan="2"><a href="profile.php?sk=edit" class="r edit-profile-basic">Edit</a></td></tr>
    </tfoot>
    <?PHP }?>
  </table>
</div>