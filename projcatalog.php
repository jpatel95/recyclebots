<?php 
	session_start();// Start the session before you write your HTML page
?>
 <?php 
    include ("inventory.php"); 	
 ?>

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
<h4 class="header center">Store</h4>
<table>
  <tr> <th> Product Image <th> Product Name <th> Item Code <th> Description <th> Price <th> </tr>

  <?php
	
	function showCatalog(){
		global $names;
		global $itemCodes;
		global $prices;
		global $descriptions;
		global $filenames;
		foreach ($names as $key => $value){
			$fullname = $names[$key];
			$cost = $prices[$key];
			$description = $descriptions[$key];
			$itemCode = $itemCodes[$key];
			$src = $filenames[$key];
			
			print("<tr><td><img src='$src' alt='$fullname' height='100'></td><td>$fullname</td><td>$itemCode</td><td>$description</td><td>$$cost</td><td><a id='buttonIndex2' class='btn' href='viewCart.php?add=$key'>Add to cart</a></td></tr>");
		}
			
	}
	
	showCatalog();
  ?>
  
  </table>
  
<div class="center">
    <a id="buttonIndex1" class="btn center" href="viewCart.php?show">View Shopping Cart</a> 
    <br/> <br/>
	<a id="buttonIndex1" class="btn center" href="viewCart.php?checkout">Checkout</a> 
    <br/> <br/>
    <a id="buttonIndex1" class="btn center" href="viewCart.php?clear">Clear Shopping Cart</a> 
</div>

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
