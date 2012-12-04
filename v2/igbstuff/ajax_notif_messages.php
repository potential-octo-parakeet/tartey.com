<?php 
	include('session.php');
	include('class.php');
	$ses_id	= $_SESSION['id'];
	$igb = new igobig;
?>
<?php foreach(newMessage($ses_id) as $count=>$row){?>
<ul>
	<li>
  		<div class="rowContainer">
       		<a href="/messages.php?action=read&id=<?php echo $row['id'];?>&token=<?php echo $row['token'];?>" class="notifLnk">
         	<img src="<?php echo $row['picture'];?>" class="thumbnail-small left" alt=""/>
         	<span class="left username"><?php echo $row['username'];?><br/>
            <span class="txtBox <?php if(!$row['read']){echo('txtBoxnew');}?>">
			<?php echo strlen($row['message'])>40 ? htmlentities(substr($row['message'],0,40),ENT_QUOTES).'...' : htmlentities($row['message'],ENT_QUOTES);?>
            </span></span>
           	<div class="clear"></div>
        	</a> 
		</div>                                   
	</li>
</ul>
<?php }?>
<?php if(!isset($count)){?>
<div class="noNotif">No new messages.</div>
<?php }//end no id?>

<?php
function newMessage($ses_id){
	db::connect();
	$sql=mysql_query("SELECT user_message.id,user.picture50,user.name,user_message.`text`,user_message.token,user_message.read
			FROM user_message JOIN user ON user_message.from_userid=user.id WHERE user_message.to_userid='$ses_id' ORDER BY `read` ASC,id DESC LIMIT 8");
	$a=array();$i=0;
	while($row=mysql_fetch_assoc($sql)){
		$a[$i]['id']= $row['id'];
		$a[$i]['picture']	= "/user_images/".$row['picture50'];
		$a[$i]['username']	= $row['name'];
		$a[$i]['message']	= $row['text'];
		$a[$i]['token']		= $row['token'];
		$a[$i]['read']		= $row['read'];
		$i++;
	}
	return $a;
}	
?>