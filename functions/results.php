
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


	 function user_posts(){
		 global $con;
		 $per_page=5;
		 if(isset($_GET['page'])){
			 $page=$_GET['page'];
		 }
		 else {
			 $page=1;
		 }
		 $start_from=($page-1) * $per_page;
		 $get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
		 $run_posts = mysqli_query($con,$get_posts);
		 while($row_posts=mysqli_fetch_array($run_posts)) {
			 $post_id = $row_posts['post_id'];
			 $user_id = $row_posts['user_id'];
			 $post_title = $row_posts['post_title'];
			 $content = substr($row_posts['post_content'],0,150);
			 $post_date = $row_posts['post_date'];
			 
			 //getting the user who has posted the thread
			 $user = "select * from users where user_id='$user_id' AND posts='yes'";
			 
			 $run_user = mysqli_query($con,$user);
			 $row_user = mysqli_fetch_array($run_user);
			 $user_name = $row_user['user_name'];
			 $user_image = $row_user['user_image'];
			 
			 //now displaying all at once
			 echo"<div id='posts'>
			 
			 <p><img src='users/$user_image' width='50' height='50'></p>
			 <h3><a herf='user_profile.php?u_id=$user_id'>$user_name</a></h3>
			 <h3>$post_title</h3>
			 <p>$post_date</p>
			 <p>$content</p>
			 <a herf='single.php?post_id=$post_id' style='float:right;'><button>see reply or reply to this</button></a>
			 
			 </div><br/>
			 ";
			 
		 }
		 //include("pagination.php");
			 
			function single_post(){
				if(isset($_GET['post_id'])){
					global $con;
					$get_id = $_GET['post_id'];
					$get_posts = "select * from posts where post_id='$get_id'";
					
					$run_posts = mysql_query($con,$get_posts);
					$row_posts = mysqli_fetch_array($run_posts);
					
					$post_id = $row_posts['post_id'];
					$user_id = $row_posts['user_id'];
                    $post_title = $row_posts['post_title'];
					$content = $row_posts['post_content'];
					$post_date = $row_posts['post_date'];
					
					//getting the user who has posted the thread
			 $user = "select * from users where user_id='$user_id' AND posts='yes'";
			 
			 $run_user = mysqli_query($con,$user);
			 $row_user = mysqli_fetch_array($run_user);
			 $user_name = $row_user['user_name'];
			 $user_image = $row_user['user_image'];
			 
			 //getting the user session
			 $user_com = $_SESSION['user_email'];
			 $get_com = "select * from users where user_email='$user_com'";
			 $run_com = mysqli_query($con,$get_com);
			 $row_com = mysqli_fetch_array($run_com);
			 $user_com_id = $row_com('user_id');
			 $user_com_name = $row_com('user_name'):
			 
			 //now displaying all at once
			 echo"<div id='posts'>
			 
			 <p><img src='users/$user_image' width='50' height='50'></p>
			 <h3><a herf='user_profile.php?u_id=$user_id'>$user_name</a></h3>
			 <h3>$post_title</h3>
			 <p>$post_date</p>
			 <p>$content</p>
			 <a herf='single.php?post_id=$post_id' style='float:right;'><button>see reply or reply to this</button></a>
			 
			 </div><br/>
			 ";
			 include("comments.php");
			 
			 echo "
			 <form action='' method='post' id='reply'>
			 <textarea cols='50' rows='5' name='comment' placeholder='write your reply'></textarea></br>
			 <input type='submit' name='reply' value='reply to this'/>
			 </form>
			 ";
			 
			 if(isset($_POST['reply'])){
				 $comment = $_POST('comment');
				 $insert = "insert into comments
				 (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW())";
				 $run = mysqli_query($con,$insert);
				 echo "<h2>your reply was added!</h2>";
				 
			 }
				}
			}
			 
			 
			 function members() {
				 global $con;
				 // select new members
				 
				 $user = "select * from users LIMIT 0,20";
				 $run_user = mysqli_query($con,$user);
				 
				 while ($row_user=mysqli_fetch_array($run_user)) {
					 $user_id = $row_user['user_id'];
					 $user_name = $row_user['user_name'];
					 $user_image = $row_user['user_image'];
					 
					 
					 echo  "
					 <span>
					 <a herf='user_profile.php?u_id=$user_id'>
					 <img src='users/$user_image' width='50' height='50' title='$user_name' style='float:left; margin:1px;'/>
					 </a>
					 </span>
					 
					 

					 ";
					 
				 }
			 }
	 }
					 