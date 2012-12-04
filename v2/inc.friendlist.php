<?php
	include_once('class.php');
	$mod_fl = new cejas;
	$SESSID = 33;
	$OFFSET = 0;
	$LIMIT  = 24;
?>
<ul class="grid-view">
<?php foreach($mod_fl->friends($SESSID,$OFFSET,$LIMIT) as $friend){?>
    <li>
		<a href="<?php echo $friend['uri'];?>">
        	<img src="<?php echo $friend['pic'];?>" alt="" class="img50" title="<?php echo $friend['name'];?>"/>
       		<div class="name"><?php echo substr($friend['name'],0,10);?></div>
		</a>
	</li>
<?php }?>
</ul>