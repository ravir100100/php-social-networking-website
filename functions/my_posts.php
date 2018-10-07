
<!DOCTYPE html>
<?php
 session_start();
 include("include/connection.php")
 include("functions/functions.php")
 ?>

<html>
  <head>
  <title>Welcome user</title>
  <link rel="stylsheet" herf="styles/home_style.css" media="all"/>
  </head>
  
  <body>
    <!--container start-->
	<div class="container">
	<!--header wrapper start-->
	<div id="head_wrap">
	<!--header start-->
	<div id="header">
	   <ul id="menu">
	   <li><a herf="home.php">Home </a></li>
	   <li><a herf="members.php">members </a></li>
	   <strong>Topics:</strong>
	   <?php
	   
	   $get_topics = "select * from topics";
	   $run_topics = mysql_query($con,$get_topics);
	   while($row=mysqli_fetch_array($run_topics)){
		   $topic_id = $row['topic_id'];
	       $topic_name = $row['topic_name'];
		 
        echo "<li><a herf='topic.php?topic=$topic_id'>$topic_name</a></li>";
	   }
       ?>
       </ul>
       <form method="get" action="results.php" id="form1">
          <input type="text" name="user_query" placeholder="search a topic"/>
          <input type="submit" name="search" value="search"/>
       </form>		  
	</div>
	<!--header ends-->
	</div>
	<!--header wrapper ends-->
	<!--content area start-->
	<div class="content">
	<!--user timeline start-->
	<div id="user_timeline">
	  <div id="user_details">
	    <?php
		$user = $_SESSION('user email');
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);
		
		$user_id = $row('user_id');
		$user_name = $row('user_name');
		$user_country = $row('user_country');
		$user_image = $row('user_image');
		$register_date = $row('user_reg_date');
		$last_login = $row('user_last_login');
		
		$user_posts = "select * from posts where user_id='$user_id'";
		$run_posts = mysqli_query($con,$user_posts);
		$posts = mysqli_num_rows($run_posts);
		
		//getting the number of unread messages
		$sel_msg = "select * from messages where receiver='$user_id' AND status='unread' ORDER by 1 DESC";
		$run_msg = mysqli_query($con,$sel_msg);
		$count_msg = mysqli_num_rows($run_msg);
		
		echo  "
		     <center>
			 <img src='users/$user_image' width:'200' height:'200'/>
			 </center>
			 <div id='user_mention'>
			 <p><strong>Name:</strong> $user_name</p>
			 <p><strong>Country:</strong> $user_country</p>
			 <p><strong>Last login:</strong> $last_login</p>
			 <p><strong>Member since:</strong> $register_date</p>
			 
			 <p><a herf='my messages.php?inbox&u_id=$user_id'>Messages ($count_msg)</a></p>
			 <p><a herf='my posts.php?u_id=$user_id'>My posts ($posts)</a></p>
			 <p><a herf='edit_profile.php?u_id=$user_id'>Edit my Account</a></p>
			 <p><a herf='logout.php'>Logout</a></p>
			 </div>
			";
			?>
			</div>
		</div>
	</div>
	
	<!--user timeline ends-->
	<!--content timeline starts-->

		  
		       <h3>see all members here</h3>
			   <?php members();?>
			   
	</div>
	<!--content area ends-->
	</div>
	<!--container ends-->
	
</body>
</html>