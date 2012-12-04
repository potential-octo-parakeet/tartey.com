<?php
	function child_nav(){
		$nav = array(
				'inbox'=>'Inbox',
				'compose'=>'Compose Message');
		return $nav;
	}
?>
<div id="subnav">
  <ul class="subnav">
  <?php 
    foreach(child_nav() as $ski=>$nav):
  	  if($sk==$ski):
        echo "<li><a href='messages.php?sk=$ski' class='selected'>$nav</a></li>";
	  else:
	    echo "<li><a href='messages.php?sk=$ski'>$nav</a></li>";
	  endif;
    endforeach;//end child_nav();
  ?>
  </ul>
</div>