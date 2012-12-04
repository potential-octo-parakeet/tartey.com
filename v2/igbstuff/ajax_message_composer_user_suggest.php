<?php
	include('class.php');
	$igb = new igobig;
	if(isset($_POST['q'])){
		$q = $_POST['q'];
	}
	$searchCountValue = 0;
	
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.ui_user_list').click(function(){
		$('#recipientContainer').append($('#user_'+this.id).html()).show();
		$('#UserIDContainer').append('<input type="hidden" name="user[]" value="'+this.id+'"/>');		
		$('#uiUserDropDown').fadeOut();
		$('#wrapper'+this.id).attr('title',$('#wrapper'+this.id).text());
		$('#user_q').val('').focus();
		return false;
	});
	$('html').click(function(e){
		var uiudd = $('#uiUserDropDown');
		if(uiudd.is(':visible') && e.target.className!='ui_user_list'){
			uiudd.fadeOut();
			$('#user_q').val('');
		}	
	});	
});
</script>
<?php if(!empty($q) && QhasData($q)){?>
<ul id="userList">
	<?php foreach(listUser($q) as $searchCount=>$row):?>
	<li>
       	<a href="" id="<?php echo $row['id'];?>" class="ui_user_list">
       	<img src="<?php echo $row['pic'];?>"/>
      	<div class="box"><div class="username" id="user_<?php echo $row['id'];?>">
        <span class="uiWrapUser" id="wrapper<?php echo $row['id'];?>"><?php echo $row['name'];?></span>        
        </div>
        <div class="infotxt"><?php echo $row['loc'];?></div></div>
    	</a>        
  	</li>
    <?php $searchCountValue = $searchCount + 1;?>
    <?php endforeach;//search result?>
</ul>
<?php }//end q?>

<?php
	function listUser($q,$offset=0,$limit=5){
		db::connect();
		$sql=sprintf("SELECT id,name,picture50,location FROM user WHERE name LIKE '%s%%' LIMIT %d,%d",
			mysql_real_escape_string($q),$offset,$limit);
		$sql=mysql_query($sql);
		$a=array();$i=0;
		while($row=mysql_fetch_assoc($sql)){
			$a[$i]['id']	= $row['id'];
			$a[$i]['name']	= $row['name'];
			$a[$i]['pic']	= "/user_images/".$row['picture50'];
			$a[$i]['loc']	= $row['location'];
			$i++;
		}
		return $a;
	}
	function QhasData($q){
		db::connect();
		$sql=sprintf("SELECT 1 FROM user WHERE name LIKE '%s%%'",mysql_real_escape_string($q));
		$sql=mysql_query($sql);
		if(mysql_num_rows($sql)){
			return true;
		}else{
			return false;
		}
	}
?>