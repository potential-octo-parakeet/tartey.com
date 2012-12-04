<?php
	session_start();
	$ses_id = $_SESSION['id'];
	include('class.php');
	$_user = new profile;
	function people_you_may_know($ses_id){
		db::connect();
		$sql=mysql_query("SELECT DISTINCT user.id,user.name,user.picture50,user.location FROM user WHERE user.id!='$ses_id' ORDER BY RAND() LIMIT 10");
		$a=array();$i=0;
		while($row=mysql_fetch_assoc($sql)){
			$a[$i]['id']		= $row['id'];
			$a[$i]['profile']	= "profile.php?id=".$row['id'];
			$a[$i]['name']		= $row['name'];
			$a[$i]['picture']	= "user_images/".$row['picture50'];
			$a[$i]['location']	= $row['location'];
			$i++;
		}
		return $a;
	}
?>
<script type="text/javascript">
$(document).ready(function(){
	/*
	$('.addfriend').click(function(){
		var p_id = this.id;
			p_id = parseInt(p_id.replace('p_',''));
		$.post('/ajax_request.php',{friendrequest:true,user_id:p_id});
		$(this).css({'color':'#aaa','cursor':'default','text-decoration':'none'})
		$(this).html('<i class="plusone" style="background-position:13px 0;"></i> Request Sent');
		return false;
	});
	*/
});
</script>
<style type="text/css">.addfriendlnk{color:#aaa;cursor:default;text-decoration:none;position:relative;padding-left:18px;}</style>
<div class="column_right_box_header">People You May Want To Know</div>
<?php foreach(people_you_may_know($ses_id) as $row){?>
<div class="people_umk_wrapper">
    <a href="<?php echo $row['profile'];?>"><img src="<?php echo $row['picture'];?>" class="img" title="<?php echo $row['name'];?>"/></a>
    <div style="float:left;margin-left:10px;">
        <div>
        <a href="<?php echo $row['profile'];?>" class="username" title="<?php echo $row['name'];?>"><?php echo substr($row['name'],0,28);?></a>
        </div>
        <div class="addr"><?php echo substr($row['location'],0,28);?></div>      
        <div><a href="<?php echo $row['profile'];?>" class="addfriend" style="padding:0;">View Profile</a></div>
    	<!--
        <div><a href="<?php echo $row['profile'];?>" class="addfriend" id="p_<?php echo $row['id'];?>"><i class="plusone"></i> Add Friend</a></div>
        -->
    </div>
	<div class="clear"></div>
</div>
<?php }//end of people?>