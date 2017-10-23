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
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu";
$db_user = "jpatel1";
$db_pass = "00000974297";
$db_name = "sdb_jpatel1";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql="SELECT * FROM Users";

  $result = $con->query($sql);
  if (!$result)
  {
    die('Error: ' . mysqli_error($con));
  }	

echo "<table border='1'>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Username</th>
</tr>";

while($row = mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>" . $row['FirstName'] . "</td>";
echo "<td>" . $row['LastName'] . "</td>";
echo "<td>" . $row['UserName'] . "</td>";
echo "</tr>";
}
echo "</table>";
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
</html>
