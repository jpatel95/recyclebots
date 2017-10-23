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
	$tbl_nameUsers="Users";
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

	$sqlUserCheck="SELECT UserName FROM $tbl_nameUsers WHERE UserName='$name'";
	$resultUserCheck=mysqli_query($con, $sqlUserCheck);
	if(mysqli_num_rows($resultUserCheck) <= 0){
		$message = "You need to be a member to add new topics!";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='main_forum.php';</script>";
		exit();
	}


	$sql="INSERT INTO $tbl_name(topic, detail, name, email, datetime)VALUES('$topic', '$detail', '$name', '$email', '$datetime')";
	$result=mysqli_query($con, $sql);

	if($result){
		echo "Successful<BR>";
		echo "<a href=main_forum.php>View your topic</a>";
		header('Location: main_forum.php'); /* Redirect browser */
	}
	else {
		echo "ERROR";
	}
	mysqli_close($con);
?>
</table>

  <footer id="pageFooter" class="page-footer">
    <div class="container">
      <div class="row" id>
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
