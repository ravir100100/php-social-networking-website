<div id="content"><!--content area starts here-->
		 <div>
		 <img src="images/image12.jpg" style="float:left; margin-left:-100px"/>
		 </div>
		 <div id="form2">
		 <form action="" method="post">
		 <h2>Sign up today!</h2>
		 <table>
		 <tr>
		   <td align="right"><strong>Name:</strong></td>
		   <td><input type="text" name="U_name" required="required"
		   placeholder="write your name"/></td>
		 </tr>
		  <tr>
		   <td align="right"><strong>Password:</strong></td>
		   <td><input type="password" name="U_pass" required="required"
		   placeholder="enter a password"/></td>
		 </tr>
		  <tr>
		   <td align="right"><strong>Email:</strong></td>
		   <td><input type="email" name="U_email" required="required"
		   placeholder="write your email"/></td>
		 </tr>
		  <tr>
		   <td align="right"><strong>country:</strong></td>
		   <td>
		   <select name="u_country">
		   <option>Select a country</option>
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
		   <td align="right"><strong>birthday:</strong></td>
		   <td><input type="date" name="U_birthday" required="required"
		   /></td>
		 </tr>
		 <tr>
		 <td colspan="6">
		 <button name="sign_up">Sign up</button>
		 </td>
		 </tr>
		 </table>
		 </form>
<?php include("insert_user.php");?>		 
		 </div>
		 
		 </div>
		 <!--content area ends here-->