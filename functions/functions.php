<?php
     $con= mysqli_connect("localhost","root","social network") or die("connection was not estabilished")
	  //functions for getting topics
	  
	    
		function getTopic();
		global $con();
		
		$gettopics = "select * from topics";
		$run_topics = mysqli_query($con,$get_topics);
		while($row=mysqli_fetch_array($run_topics)) {
			$topic_id=$row('topic_id');
			$topic_name=$row('topic_name');
		echo"<option value='$topic_id'>$topic_name</option>;
		}
	}	
     
	 //functions for inserting posts
	 function insertPost(){
		 if(isset($_POST['sub'])){
			 global $con;
			 global $user_id;
			 $title = addslashes($_POST['title']);
			 $content = addslashes($_POST['content']);
			 $topic = addslashes($_POST['topic']);
			 
			 if ($content=='') {
				 echo "<h2>Please enter title and description</h2>";
				 exit();
			 }
			 else {
				 $insert = "insert into posts(user_id,topic_id,posts_title,post_content,post_date) values ('$user_id','$topic','$title','$content',NOW())";
				 $run = mysqli_query($con,$insert);
				    if($run) {
						echo "<h3>posted to timeline, looks great!</h3>";
						$update = "update users set posts='yes' while user_id='$user_id'";
						$run_update = mysqli_query($con,$update);
					}
			 }
		 }
	 }
	 //function for displaying posts
	 
	 function get_posts(){
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
			 
			 
			 
			 
			 
			 
			 
?>
