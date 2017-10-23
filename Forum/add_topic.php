<?php
	$host="dbserver.engr.scu.edu"; // Host name 
	$username="jpatel1"; // Mysql username 
	$password="00000974297"; // Mysql password 
	$db_name="test"; // Database name 
	$tbl_name="forum_question"; // Table name 

	// Connect to server and select database.
	$con = mysqli_connect($host, $username, $password, $db_name);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	// get data that sent from form 
	$topic=$_POST['topic'];
	$detail=$_POST['detail'];
	$name=$_POST['name'];
	$email=$_POST['email'];

	$datetime=date("m/d/y h:i"); //create date time

	$sql="INSERT INTO $tbl_name(topic, detail, name, email, datetime)VALUES('$topic', '$detail', '$name', '$email', '$datetime')";
	$result=mysqli_query($con, $sql);

	if($result){
	echo "Successful<BR>";
	echo "<a href=main_forum.php>View your topic</a>";
	}
	else {
	echo "ERROR";
	}
	mysqli_close($con);
?>