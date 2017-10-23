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

 <div class="footerClass">
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
 </div>

  <h4 class="header center">Forum Discussions</h4>
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

	$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
	// OREDER BY id DESC is order result by descending

	$result=mysqli_query($con, $sql);
?>

	<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
	<tr bgcolor="#b8b894">
	<td width="53%" align="center"><strong>Topic</strong></td>
	<td width="15%" align="center"><strong>Views</strong></td>
	<td width="13%" align="center"><strong>Replies</strong></td>
	<td width="13%" align="center"><strong>Date/Time</strong></td>
	</tr>

<?php 
	// Start looping table row
	while($rows=mysqli_fetch_array($result)){
		echo '<tr bgcolor="#FFFFFF" align="center">',
   		'<td> <a href="view_topic.php?id=',$rows['id'],'">',$rows['topic'],"</a></td>
   		<td>", $rows['view'],"</td>
		<td>", $rows['reply'],"</td>
		<td>", $rows['datetime'],"</td>
		</tr>";
	}
	mysqli_close($con);
?>

<tr bgcolor="#b8b894">
	<td colspan="5"><a href="create_topic.php"><strong color="#000000">Add a New Topic</strong> </a></td>
</tr>
</table>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="materialize/js/materialize.js"></script>
<script src="materialize/js/init.js"></script>
</body>
</html>
