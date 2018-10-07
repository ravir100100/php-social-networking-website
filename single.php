<div id="content_timeline">
	      <form action="home.php?id=<?php echo $user_id;?>" method="post" id="f">
		  <h2> whats your question today? Lets discuss!</h2>
		  <Input type="text" name="title" placeholder="write a title..." size="82" required="required"/><br/>
		  <textarea col="83" rows="4" name="content" placeholder="write description..."></textarea><br/>
		  <select name="topic">
		       <option>select topic</option>
			   <?php getTopics();?>
		  </select>
		  <input type="submit" name="sub" value="post to timeline"/>
		  </form>
		  <?php insertPost();?>
		  
		       <h3>most recent discussion!</h3>
			   <?php //get_posts();?>
			   
	</div>
	<!--content area ends-->
	</div>
	<!--container ends-->
	
</body>
</html>