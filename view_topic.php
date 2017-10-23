<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <link rel="icon" href="images/favicon_32.png" sizes="32x32">
  <title>RecycleBots, Inc.</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/styles.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
<body>
  <nav role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.html" class="brand-logo"><img class="logosvg" src="images/logo2.svg" alt="logo"> RecycleBots</a>

      <ul class="right hide-on-med-and-down">
        <li><a class="nav" href="index.html">Home</a></li>
        <li><a class="nav" href="projcatalog.php">Store</a></li>
        <li><a class="nav" href="main_forum.php">Forum</a></li>
        <li><a class="nav" href="game.html">Fun</a></li>
        <li><a class="nav" href="map.html">Map</a></li>
	<li><a class="nav" href="username.html">Join Now</a></li>
      </ul>

      <!-- For Mobile responsiveness  -->
      <ul id="nav-mobile" class="side-nav">
        <li><a class="nav" href="index.html">Home</a></li>
        <li><a class="nav" href="projcatalog.php">Store</a></li>
        <li><a class="nav" href="main_forum.php">Forum</a></li>
        <li><a class="nav" href="index.html">Fun</a></li> <!-- Game cannot be played on a phone -->
        <li><a class="nav" href="map.html">Map</a></li>
	<li><a class="nav" href="username.html">Join Now</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

<?php
	$host="dbserver.engr.scu.edu"; // Host name 
	$username="jpatel1"; // Mysql username 
	$password="00000974297"; // Mysql password 
	$db_name="sdb_jpatel1"; // Database name 
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

	echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#b8b894">
	<tr>
	<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">
	<tr align="center">
	<td bgcolor="#F8F7F1"><strong>Topic: </strong>', $rows['topic'], '</td>
	</tr>

	<tr>
	<td bgcolor="#F8F7F1"><strong>Details: </strong>',$rows['detail'],'</td>
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
		echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#b8b894">
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
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#b8b894">
	<tr>
		<form name="form1" method="post" action="add_answer.php">
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
					<td width="18%"><strong>Name</strong></td>
					<td width="3%">:</td>
					<td width="79%"><textarea name="a_name" type="text" id="a_name" size="45"></textarea></td>
				</tr>
				<tr>
					<td><strong>Email</strong></td>
					<td>:</td>
					<td><textarea name="a_email" type="text" id="a_email" size="45"></textarea></td>
				</tr>
				<tr>
					<td valign="top"><strong>Answer</strong></td>
					<td valign="top">:</td>
					<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
					<td><input type="submit" name="Submit" value="Reply"> <input type="reset" name="Submit2" value="Clear"></td>
				</tr>
			</table>
		</td>
		</form>
	</tr>
</table>

  <footer id="pageFooter" class="page-footer">
    <div class="container">
      <div class="row">
        <div class="col s12 center white-text">
          <h5>Contact Us</h5>
          <p>
            To get in contact with us through email. Click on the clickable links on the bottom of this page to email us.
          </p>
        </div>
      </div>
    </div>
    <div class="footer-copyright" id="copyrightDiv">
      <div class="container center">
        <p>Webmasters:
          <a href="mailto:ctnguyen@scu.edu">Christen Nguyen</a> and <a href="mailto:jpatel@scu.edu">Jimmy Patel</a>
        </p>
      </div>
    </div>
  </footer>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="materialize/js/materialize.js"></script>
<script src="materialize/js/init.js"></script>
</body>
</html>
