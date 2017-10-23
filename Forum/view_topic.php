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

	// get value of id that sent from address bar 
	$id=$_GET['id'];
	$sql="SELECT * FROM $tbl_name WHERE id='$id'";
	$result=mysqli_query($con,$sql);
	$rows=mysqli_fetch_array($result);

	echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
	<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">
	<tr align="center">
	<td bgcolor="#F8F7F1"><strong>', $rows['topic'], '</strong></td>
	</tr>

	<tr>
	<td bgcolor="#F8F7F1">',$rows['detail'],'</td>
	</tr>
	<tr>
	<td bgcolor="#F8F7F1"><strong> By: </strong>', $rows['name'],'
	</tr>
	<tr>
	<td bgcolor="#F8F7F1"><strong>Email: </strong>', $rows['email'], '</td>
	</tr>
	<tr>
	<td bgcolor="#F8F7F1"><strong>Date/time : </strong>', $rows['datetime'], '</td>
	</tr>
	</table></td>
	</tr>
	</table>
	<BR>';
?>

<?php
	$tbl_name2="forum_answer"; // Switch to table "forum_answer"
	$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id'";
	$result2=mysqli_query($con,$sql2);
	while($rows2=mysqli_fetch_array($result2)){
		echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
			<tr>
			<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
			<tr>
			<td bgcolor="#F8F7F1"><strong>Date/Time</strong></td>
			<td bgcolor="#F8F7F1">:</td>
			<td bgcolor="#F8F7F1">',$rows2['a_datetime'],'</td>
			</tr>
			<tr>
			<td width="18%" bgcolor="#F8F7F1"><strong>Name</strong></td>
			<td width="5%" bgcolor="#F8F7F1">:</td>
			<td width="77%" bgcolor="#F8F7F1">',$rows2['a_name'],'</td>
			</tr>
			<tr>
			<td bgcolor="#F8F7F1"><strong>Email</strong></td>
			<td bgcolor="#F8F7F1">:</td>
			<td bgcolor="#F8F7F1">',$rows2['a_email'],'</td>
			</tr>
			<tr>
			<td bgcolor="#F8F7F1"><strong>Answer</strong></td>
			<td bgcolor="#F8F7F1">:</td>
			<td bgcolor="#F8F7F1">',$rows2['a_answer'],'</td>
			</tr>
			</table></td>
			</tr>
			</table><br>';
	}
?>
	 
<?php

	$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
	$result3=mysqli_query($con,$sql3);
	$rows=mysqli_fetch_array($result3);
	$view=$rows['view'];
	 
	// if have no counter value set counter = 1
	if(empty($view)){
	$view=1;
	$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
	$result4=mysqli_query($con,$sql4);
	}
	 
	// count more value
	$addview=$view+1;
	$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
	$result5=mysqli_query($con,$sql5);
	mysqli_close($con);
?>

<BR>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<form name="form1" method="post" action="add_answer.php">
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
					<td width="18%"><strong>Name</strong></td>
					<td width="3%">:</td>
					<td width="79%"><input name="a_name" type="text" id="a_name" size="45"></td>
				</tr>
				<tr>
					<td><strong>Email</strong></td>
					<td>:</td>
					<td><input name="a_email" type="text" id="a_email" size="45"></td>
				</tr>
				<tr>
					<td valign="top"><strong>Answer</strong></td>
					<td valign="top">:</td>
					<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
					<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
				</tr>
			</table>
		</td>
		</form>
	</tr>
</table>