<?php
   session_start();
   include("includes/connection.php");
   include("functions/functions.php");
   
   if(!isset($_SESSION['user_email'])) {
	   header("location: index.php");
   }
   
   else {
	   ?>
	   <!DOCTYPE html>
	   <html>
	       <head>
		     <title>welcome user!</title>
			 <link rel="stylesheet" herf="styles/home_style.css" media="all"/>
			 <style>
			 input[type='file'] {width:180px;}
			 </style>
			 </head>
	
	<body>
	    <!--conatiner starts-->
		<div class="container">
		 
		 <!--header wrapper starts-->
		 <div id="head_wrap">
		 
		 <!--header starts-->
		 <div id="header">
		 <ul id="menu">
		 <li><a herf="home.php">Home</a></li>
		 <li><a herf="members.php">Members</a></li>
		 <strong>Topics:</strong>
		 <?php
		 
		 $get_topics = "select * from topics";
		 $run_topics = mysqli_query($con,$get_topics)){
			 $topic_id = $row['topic_id'];
			 $topic_name = $row['topic_name'];
			 
		 echo "<li><a herf ='topic.php?topic=$topic_id'>$topic_name</a></li>";
		 }
		 
		 ?>
		 
		 </ul>
		 <form method="get" action="result.php" id="form1">
		    <input type="text" name="user_query" placeholder="search a topic"/>
			<input type="submit" name="search" value="search"/>
			</form>
		</div>
		<!--header ends-->
		</div>
		<!--header wrapper ends-->
		
		<!--content timeline starts-->
		
		<div>
		  <form action="" method="post" id="f" class="ff" enctype="multipart/form-data">
		  
		  <table>
		     <tr align="center">
			     <td colspan="6"<h2>Edit your profile:</h2></td>
			 </tr>
			 <tr>
			     <td align="right">Name:</td>
				 <td>
				 <input type="text" name="u_name" required="required" value="
				  <?php echo $user_name;?>"/> 
				  </td>
			 </tr>
			 <tr>
			    <td align="right">password:</td>
				<td>
				<input type="password" name="u_pass" required="required"
				value="<?php echo $user_pass;?>"/>
				</td>
			 </tr>
			 <tr>
			    <td align="right">Country:</td>
				<td>
				<select name="u_country" disabled="disabled">
				     <option><?php $user_country;?></option>
					 	   <option>India</option>
		   <option>Pakistan</option>
		   <option>Afghanistan</option>
		   </select>
		   </td>
		  </tr>
		  <tr>
		   <td align="right"><strong>Gender:</strong></td>
		   <td> 
		   <select name="u_gender">
		   <option>male</option>
		   <option>female</option>
		   </select>
		   </td>
		 </tr>
		    <tr>
			<td align="right">Photo:</td>
			<td>
			<input type="file" name="u_image" required="required"/>
			</td>
			</tr>
			
			<tr align="center">
			    <td colspan="6">
				<input type="submit" name="update" value="Update"/>
				</td>
			</tr>
			</table>
		</form>
				
			
			 
		<?php
			 
			 if(isset($_POST['update'])) {
				 $u_name = $_POST['u_name'];
				 $u_pass = $_POST['u_pass'];
				 $u_email = $_POST['u_email'];
				 $u_image = $_FILES['u_image']['name'];
				 $image_tmp = $_FILES['u_image']['tmp_name'];
				 
				 move_uploaded_file($image_tmp,"user/user_images/$U_image");
				 
				 $update = "update users set user_name='$u_image', user_pass='$u_pass', user_email='$u_email', user_image='$u_image', where user_id='$user_id'";
				 $run = mysqli_query($con,$update);
				 if($run) {
					 echo"<script>alert<'your profile updated!'</script>";
					 echo"<script>window.open('home.php','_self')</script>";
				 }
			 }
		?>
			 
			 
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
		
   