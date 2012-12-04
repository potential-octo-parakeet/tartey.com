<?php 
	include('session.php');
	$ses_id = $_SESSION['id'];
	include('class.php');
	$igb = new igobig;
	if(isset($_GET['id']) && isset($_GET['token'])){
	$msg_id = $_GET['id'];
	$msg_token = $_GET['token'];
	$igb->connect();	
	$sql=sprintf("SELECT user_message.id,user_message.token,user.name,user.picture50 AS 'pic',user_message.`text`,
	DATE_FORMAT(CONVERT_TZ(user_message.`timestamp`,'+00:00','-02:00'),'%%M %%d, %%Y at %%h:%%i%%p') AS 'date' 
	FROM user_message JOIN user ON user_message.from_userid=user.id WHERE user_message.id='%d' AND user_message.token='%s'",$msg_id,$msg_token);
	$sql=mysql_query($sql);		
?>
<?php while($row=mysql_fetch_assoc($sql)){?>
<div class="messageDataUI" id="message_<?php echo $row['id'];?>">
	<img src="/user_images/<?php echo $row['pic'];?>" class="userImage" alt=""/>
    <div class="messageContainer">
    	<span class="username"><?php echo $row['name'];?></span>
        <div class="usertext">
			<div style="width:540px;word-wrap:break-word;float:left;"><?php echo stripslashes(nl2br(htmlentities($row['text'],ENT_QUOTES)));?></div>
        	<span class="right" style="color:#aaa;"><?php echo $row['date'];?> PST</span>
       	</div>        
   	</div>
    <div class="clear"></div>
</div>
<?php }/*end messages*/read_message_true($msg_id);}?>

<?php 
function read_message_true($id){
	db::connect();
	$sql=sprintf("UPDATE user_message SET `read`='1' WHERE id='%d'",$id);
	mysql_query($sql) or die(mysql_error());
}
?>