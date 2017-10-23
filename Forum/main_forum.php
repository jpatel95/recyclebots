<?php
	$host="dbserver.engr.scu.edu"; // Host name 
	$username="jpatel1"; // Mysql username 
	$password="00000974297"; // Mysql password 
	$db_name="test"; // Database name 
	$tbl_name="forum_question"; // Table name 

	// Connect to server and select databse.
	$con = mysqli_connect($host, $username, $password, $db_name);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
	// OREDER BY id DESC is order result by descending

	$result=mysqli_query($con, $sql);
?>

	<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
	<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
	<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Views</strong></td>
	<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Replies</strong></td>
	<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
	</tr>

<?php 
	// Start looping table row
	while($rows=mysqli_fetch_array($result)){
		echo '<tr align="center">',
   		'<td> <a href="view_topic.php?id=',$rows['id'],'">',$rows['topic'],"</a></td>
   		<td>", $rows['view'],"</td>
		<td>", $rows['reply'],"</td>
		<td>", $rows['datetime'],"</td>
		</tr>";
	}
	mysqli_close($con);
?>

<tr>
<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="create_topic.php"><strong>Add a New Topic</strong> </a></td>
</tr>
</table>