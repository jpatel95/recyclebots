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
      </ul>

      <!-- For Mobile responsiveness  -->
      <ul id="nav-mobile" class="side-nav">
        <li><a class="nav" href="index.html">Home</a></li>
        <li><a class="nav" href="projcatalog.php">Store</a></li>
        <li><a class="nav" href="main_forum.php">Forum</a></li>
        <li><a class="nav" href="index.html">Fun</a></li> <!-- Game cannot be played on a phone -->
        <li><a class="nav" href="map.html">Map</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

<?php
	$host="dbserver.engr.scu.edu"; // Host name 
	$username="jpatel1"; // Mysql username 
	$password="00000974297"; // Mysql password 
	$db_name="sdb_jpatel1"; // Database name 
	$tbl_name="forum_answer"; // Table name 

	$con = mysqli_connect($host, $username, $password, $db_name);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	// Get value of id that sent from hidden field 
	$id=$_POST['id'];

	// Find highest answer number. 
	$sql="SELECT MAX(a_id) AS Maxa_id FROM $tbl_name WHERE question_id='$id'";
	$result=mysqli_query($con,$sql);
	$rows=mysqli_fetch_array($result);

	// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1 
	if ($rows) {
	$Max_id = $rows['Maxa_id']+1;
	}
	else {
	$Max_id = 1;
	}

	// get values that sent from form 
	$a_name=$_POST['a_name'];
	$a_email=$_POST['a_email'];
	$a_answer=$_POST['a_answer']; 

	$datetime=date("m/d/y h:i"); // create date and time

	// Insert answer 
	$sql2="INSERT INTO $tbl_name(question_id, a_id, a_name, a_email, a_answer, a_datetime)VALUES('$id', '$Max_id', '$a_name', '$a_email', '$a_answer', '$datetime')";
	$result2=mysqli_query($con,$sql2);

	if($result2){
	// If added new answer, add value +1 in reply column 
	$tbl_name2="forum_question";
	$sql3="UPDATE $tbl_name2 SET reply='$Max_id' WHERE id='$id'";
	$result3=mysqli_query($con,$sql3);
	
	header('Location: view_topic.php?id='.$id); /* Redirect browser */
	exit();	
	}
	else {
		echo "ERROR";
	}

	// Close connection
	mysqli_close($con);
?>

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
