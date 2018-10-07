<?php
$query = "select * from posts";
$result = mysqli_query($con, $query);
// count the total records
$total_posts = mysqli_num_rows($result);
// using cell function to divide the total records on per page
$total_pages = cell($total_posts / $per_page);
// going to first page
echo"
<center>
<div id='pagination'>
<a herf='home.php?page=1'>First page</a>
";

for($i=1; $i<=$total_pages; $i++) {
	echo "<a herf='home.php?page= $i'>$i</a>;
}
	//going to last page 
	echo "<a herf='home.php?page=$total pages'>Last page</a></center></div>";
	
?>