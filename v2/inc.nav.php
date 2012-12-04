<?php
	function parent_nav(){
		$nav = array(
			'home.php'=>'Home',
			'profile.php'=>'Profile',
			'messages.php'=>'Messages',
			'friends.php'=>'Friends',
			'blogs.php'=>'Blogs',
			'games.php'=>'Games');
		return $nav;
	}
?>
<div id="nav_wrapper" class="cf">
	<ul class="nav l">
    <?php 
		foreach(parent_nav() as $uri=>$nav):    
			if($uri==preg_replace("/\/|(\?+sk=+.)/","",$_SERVER['PHP_SELF'])):
				echo "<li><a href='$uri' class='selected'>$nav</a></li>";
			else:
				echo "<li><a href='$uri'>$nav</a></li>";
			endif;
		endforeach;//parent_nav()
	?>         
	</ul>
	<ul class="nav r">
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>