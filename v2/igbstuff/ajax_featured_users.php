<?php
	include('class.php');
	function featured_users(){
		db::connect();
		$sql = mysql_query("SELECT * FROM user WHERE picture50!='small_pic.gif' ORDER BY RAND() LIMIT 10");
		$a=array();$i=0;
		while($row=mysql_fetch_assoc($sql)){
			$a[$i]['picture'] 	= $row['picture50'];
			$a[$i]['name']		= $row['name'];
			$i++;
		}
		return $a;
	}	
	function user_count(){
		db::connect();
		$sql = mysql_query("SELECT COUNT(1) FROM user");		
		return mysql_result($sql,0);
	}
?>

<?php 
if(isset($_GET['f'])){
	foreach(featured_users() as $list){
echo "<img src='user_images/$list[picture]' style='border:0;float:left;margin-right:1px;margin-bottom:2px;cursor:pointer;width:50px;height:50px;' title='$list[name]'/>";
	}
}
if(isset($_GET['c'])){
	echo "Currently there are ".number_format(10000+user_count(),0)." users and counting";
}
?>