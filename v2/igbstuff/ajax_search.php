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
	$('#loadMoreResults').click(function(){
		alert('This feature is coming.');
		return false;
	});
});
</script>
<?php if(!empty($q)){?>
<ul>
	<?php foreach($igb->search_people($q) as $searchCount=>$row):?>
	<li>
    	<a href="/profile.php?id=<?php echo $row['id'];?>" class="resultLnk">
        <img src="<?php echo $row['pic'];?>" class="thumbnail-small left" alt=""/>
        <span class="left username"><?php echo $row['name'];?></span>
        <div class="clear"></div>
        </a> 
  	</li>
    <?php $searchCountValue = $searchCount + 1;?>
    <?php endforeach;//search result?>
</ul>
<?php }//end q?>
<div class="moreResult" id="loadMoreResults">
	<a href="/">See more results for <span id="queryString"><?php echo $q;?></span><br/>
	<span class="searchvalue">displaying top <?php echo $searchCountValue;?> results</span>
    </a>
</div>