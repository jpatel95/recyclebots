<?php 
session_start();	// Start the session before you write your HTML page
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

<?php 	
// This function displays the contents of the shopping cart
// if user has chosen "add"
if ( isset($_GET['add'])) { 
	addToCart();
	unset($_GET['add']);
}
// if user has chosen "show cart"	
elseif (isset($_GET['show'])){ 
	
	show_cart();
	unset($_GET['show']);	
}
// if user has chosen "clear cart"	
elseif (isset($_GET['clear'])){ 
	clearCart();
	unset($_GET['clear']);	
}
// if user has chosen "remove item from cart"		
elseif (isset($_GET['drop'])){ 
	drop();
	unset($_GET['drop']);	
}
	
// if user has chosen "checkout"		
elseif (isset($_GET['checkout'])){ 
	checkout();
	unset($_GET['checkout']);	
}
   	
function show_cart() {
	global $names;
	global $filenames;
    if (isset($_SESSION['cart'])){
		echo "<h3 class='center'>Shopping Cart</h3><br/>"; 
		$mycart = $_SESSION['cart'];
		echo "<div> <table width='50%'>";
		foreach ($mycart as $key => $value){
			if ($value >0){
		    	// get the full widget name from the widgets array;
				$fullname = $names[$key];
				$src = $filenames[$key];
				print("<tr> <td><img src='$src' alt='$fullname' height='100'></td> <td><strong>$fullname</strong></td> <td> Quantity: $value </td>"."<td><a id='buttonIndex2' class='btn' href="."viewCart.php?drop=$key"."> Remove</a></td></tr>");
			}
		}
		echo "</table></div>";
	}
	else{
	 echo "<h4>No items in the cart</h4>";
   	}
}

// This function removes an item from the shopping cart
function drop() {

	 if (isset($_GET['drop'])){
	 	$dropItemId = $_GET['drop'];	 		 		
		if (isset($_SESSION['cart'])){
			$mycart = $_SESSION['cart'];
			if($mycart[$dropItemId] == 1)
				unset ($mycart[$dropItemId]);	
			else
				$mycart[$dropItemId] --;
			$_SESSION['cart'] = $mycart; 	
			$message = "Item removed from cart";
			echo "<script type='text/javascript'>window.location.href='viewCart.php?show';</script>";
		} 
	}  
} 

// Adds an item to the shopping cart
function addToCart(){
	// Access the global array
	global $names;
	
	
	// Get the item id to add - this is the string sent with the 
	// selection when the user clicked a link
	
	$addItemId = $_GET['add'];
		 		 		
	if (isset($_SESSION['cart'])){
		$mycart = $_SESSION['cart'];
		
		// if the item already exists, increment the count
		if (isset($mycart[$addItemId])){
			$mycart[$addItemId]+= 1;									
		} 
		// if the item does not exist, add it to the cart
		else{
			$mycart[$addItemId] = 1;
		}		
	}
	else{
		// cart does not exist, create one
		$mycart = array();
		$mycart[$addItemId] = 1;
	}
    $_SESSION['cart'] = $mycart;
	$message = "Item added to cart";
	echo "<script type='text/javascript'>
		window.location.href='viewCart.php?show';</script>";
}
function clearCart(){
	if (isset($_GET['clear'])){
	 	if (isset($_SESSION['cart'])){
			unset($_SESSION['cart']); 
	  	}
		echo "<h4>Shopping Cart Cleared</h4> ";
	} 
}
function checkout()
{
	ini_set('display_errors','On');
	error_reporting(E_ALL);
	$db_host = "dbserver.engr.scu.edu";
	$db_user = "jpatel1";
	$db_pass = "00000974297";
	$db_name = "sdb_jpatel1";
	$tbl_nameUsers="Users";
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

	global $names;
	global $prices;
	global $quantities;
	global $filenames;

	$grandTotal = 0;
	$discount = 0;
	$tax = 0.0875;
    	if (isset($_SESSION['cart'])){
		echo "<h4>Checkout</h4>"; 
		$mycart = $_SESSION['cart'];
		echo "<table><tr><th>Product Image<th>Product Name<th>Price<th>Quantity<th>Subtotal<th></tr>";
		foreach ($mycart as $key => $value){
			// get the full widget name from the widgets array;
			$fullname = $names[$key];

			//check if in stock
			if($value > $quantities[$key]){
				if($quantities[$key] > 0){
					$stockMessage = "Oops! Looks like our stock is low on $fullname. We were still able to get you $quantities[$key] of the $fullname";
					$value = $quantities[$key];
					echo "<script type='text/javascript'>alert('$stockMessage');</script>";
				}
				else if($quantities[$key] == 0){
			 		$stockMessage = "Oops! Looks like we're out of that item. We'll notify you when item $fullname is back in stock.:)";
					$value = 0;
					echo "<script type='text/javascript'>alert('$stockMessage');</script>";
				}
			}
			//Remove from stock
			$quantities[$key] -= $value;
			if ($value >0){
				$src = $filenames[$key];
				$subtotal = ($value)*($prices[$key]);
				$grandTotal += $subtotal;
				echo "<tr><td><img src='$src' alt='$fullname' height='100'></td><td>$fullname</td><td>$$prices[$key]</td><td>$value</td><td>$$subtotal</td></tr>";
			}
		}
		echo "</table><hr/><br/>";
		
		
		print('<form method="post"><fieldset><legend>Apply member discount</legend><br/>Member Code: <input type="text" name="code" id="code" /><input type="submit" /><br/><br/></fieldset></form>');

		//checks user
		if(isset($_POST['code'])){
			$name=$_POST['code'];
			$sqlUserCheck="SELECT UserName FROM $tbl_nameUsers WHERE UserName='$name'";
			$resultUserCheck=mysqli_query($con, $sqlUserCheck);
			if(mysqli_num_rows($resultUserCheck) <= 0){
				$message = "Member code not found";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$discount = 0;
			}
			else 
				$discount = 0.1;
		} 
		//echo "The discount is $discount";
		$savings = round(($grandTotal * $discount),2);
		$discountedTotal = $grandTotal - $savings;
		$shipping = round(($grandTotal * 0.15),2);
		$taxTotal = round(($discountedTotal * $tax),2);
		$finalTotal = round(($discountedTotal + $taxTotal + $shipping),2);
		print('<br/><form method="post"><fieldset><legend>New Customer Shipping Info</legend>Name<input type="text" name="name" id="name" /><br/><br/>Mailing Address<input type="text" name="address" id="address" /><br/><br/>Email<input type="text" name="email" id="email" /><br/><br/>Phone Number<input type="text" name="phone" id="phone" /><input type="submit" /><br/><br/></fieldset></form>');
		if(isset($_POST['name'])){
			print("<p align='center'>Thank you!</p>");
		}
		
		print ("<div style='background-color: #b8b894;'><p align='center'>Total: $$grandTotal<br/>");
		if($discount > 0)
			print("Promo code: $$savings<br/>");
		print("Tax: $$taxTotal<br/>");
		print("Shipping: $$shipping<br/>");
		print("Grand total: $$finalTotal<br/></p></div>");
		
	}
		
	else {
		echo "<h4>No items in the cart</h4>";
	}
}


?>

<div class="center"> 
    <a id="buttonIndex2" class="btn-large" href="projcatalog.php?">Back to the Catalog</a> 
</div>
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
