<?php 
 if(isset($_POST['to'])){
	$to = $_POST['to'];
	$su = "Test mail";
	$me = "It works!";
	$he = "From: tartey <notifications@tartey.com>\r\nContent-type:text/html\r\n";
	mail($to,$su,$me,$he);
	echo "sent mail to $to";
 }
?>
<form action="" method="post">
<input type="text" name="to" />
<button type="submit">Send</button>
</form>