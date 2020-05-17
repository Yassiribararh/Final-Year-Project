<?php
include('../functions/functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../php/login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../php/login.php");
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email, address, postcode, phonenumber, user_type FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $address, $postcode, $phonenumber, $user_type);
$stmt->fetch();
$stmt->close();


$pdo = pdo_connect_mysql();
// Get the 4 most recently added products
$stmt1 = $pdo->prepare('SELECT * FROM productsfyp ORDER BY date_added DESC LIMIT 4');
$stmt1->execute();
$recently_added_products = $stmt1->fetchAll(PDO::FETCH_ASSOC);
// Get the 4 most paid transactions
$stmt2 = $pdo->prepare('SELECT * FROM transactions ORDER BY payment_amount DESC LIMIT 4');
$stmt2->execute();
$highest_transactions = $stmt2->fetchAll(PDO::FETCH_ASSOC);
// Get the 4 most added products to cart
$stmt3 = $pdo->prepare('SELECT * FROM orders ORDER BY order_date DESC LIMIT 4');
$stmt3->execute();
$highest_product = $stmt3->fetchAll(PDO::FETCH_ASSOC);


?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.head {
  background-color: darkred;
  color: white;
}

tr:nth-child(even) {
  background-color: #dddddd;

}


/*------------divider css----------*/

.astrodivider {
  margin:64px auto;
  width:400px;
  max-width: 100%;
  position:relative;
}

.astrodividermask {
  overflow:hidden; height:20px;
}

.astrodividermask:after {
  content:'';
  display:block; margin:-25px auto 0;
  width:100%; height:25px;
  border-radius:125px / 12px;
  box-shadow:0 0 8px red;
}
.astrodivider span {
  width:50px; height:50px;
  position:absolute;
  bottom:100%; margin-bottom:-25px;
  left:50%; margin-left:-25px;
  border-radius:100%;
  box-shadow:0 2px 4px red;
  background:#fff;
}
.astrodivider i {
  position:absolute;
  top:4px; bottom:4px;
  left:4px; right:4px;
  border-radius:100%;
  border:1px dashed red;
  text-align:center;
  line-height:40px;
  font-style:normal;
  color:red;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.head {
  background-color: darkred;
  color: white;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<html>
	<head>
		<meta charset="utf-8">
		<title>Genuine Shop</title>
		<link rel="stylesheet" type="text/css" href="../styles/Styles.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >
		<Link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Including the search scripting file. -->
    <script type="text/javascript" src="../scripts/script.js"></script>
  </head>
	<!-- logged in user information -->
		<h4 style="text-align:center; text-decoration-style: solid; background: darkgrey; color: white; margin-bottom:0;">Welcome back, <?=$_SESSION['user']['username']?>!
		<small><i  style="color: white;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i><br></small></h4>
	<div class="top-nav-bar">
		<div class="search-box">
			<i class="fa fa-bars" id="menu-btn" onclick="openmenu()"></i>
			<i class="fa fa-times" id="close-btn" onclick="closemenu()"></i>
      <a href="home.php"><img src="../imgs/admin_profile.png" class ="myLogo"></a>
			<h2><br/>Admin - Home Page</h2>
    </div>
    <div class="menu-bar">
			<ul>
				<li><a href="admin-profile.php"><i class="fas fa-user-circle"></i> Profile</li></a>
				<li><a href="home.php?logout='1'"><i class="fas fa-sign-out-alt"></i> Logout</li></a>
      </ul>
    </div>
    <div style="width: 700px;margin-top:-25px; auto; margin-left:100px; cursor:pointer; width: 48%;">
      <ul style=" list-style-type: none; ">
        <li style=" list-style-type: none;"><div id="display" style="border:solid 0 #BDC7D8;display:none; "></div></li>
      </ul>
    </div>
  </div>
  <body>
		<section class="header">
			 <div class="side-menu" id="side-menu" style="height:220px; margin-right:20px; margin-top:-10px;">
				 <ul>
					 <li><a href="users.php" style="color:white">Users <i class="fa fa-angle-right"></i></a></li>
					 <li><a href="products.php" style="color:white"> Products <i class="fa fa-angle-right"></i></a></li>
					 <li><a href="orders.php" style="color:white" > Orders <i class="fa fa-angle-right"></i></a></li>
					 <li><a href="transactions.php" style="color:white" >Transactions <i class="fa fa-angle-right"></i></a></li>
					 <li><a href="messages.php" style="color:white">Messages <i class="fa fa-angle-right"></i></a></li>
					 <li><a href="reviews.php" style="color:white">Reviews <i class="fa fa-angle-right"></i></a></li>
				 </ul>
			 </div>
		 </section>
		 <!--New  On sale Products--->
 		<section class="New-products"  style="margin-top:0;">
 			<div class="container">
 				<div class="title-box" >
 					<h2>Newly listed:</h2>
 				</div>
 				<div class="row">
 				<!---Listing all last products created limit is 4-->
 				<?php foreach ($recently_added_products as $product): ?>
 					<div class="col-md-3" style="border-style: dashed;">
 						<div class="product-top">
 							<img src="../imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
 						</div>
 						<div class="product-bottom text-center">
 							<i class="fa fa-star"></i>
 							<i class="fa fa-star"></i>
 							<i class="fa fa-star"></i>
 							<i class="fa fa-star"></i>
 							<i class="fa fa-star-half-o"></i>
 							<span class="name" style="color:darkred"><h3><?=$product['name']?></h3></span>
 							<span class="price"style="color:black">
 							 &dollar;<?=$product['price']?>
 								<?php if ($product['rrp'] > 0): ?>
 								<span class="rrp">&dollar;<?=$product['rrp']?></span>
 								<?php endif; ?>
								<span class="name" style="color:black;"><h3> Date added : </br><?=$product['date_added']?></h3></span>
 							</div>
 						</div>
 				  <?php endforeach; ?>
 				  </div>
 			  </div>
 			</section>
      <div class="astrodivider"><div class="astrodividermask"></div><span><i>&#10038;</i></span></div>
 			<!--Listing the biggest orders-->
 			<section class="New-products"  style="margin-top:20px; margin-left:20px;">
 				<div class="container">
 				  <div class="title-box" style="padding-bottom:70px;" >
 					  <h2>Completed transactions:</h2>
 				  </div>
 				  <div class="row" >
 				  <!---Listing all last products created limit is 11-->
 				  <?php foreach ($highest_transactions as $transaction): ?>
 					  <div class="col-md-3" style="border-style: dashed;">
 						  <div class="product-top">
 							  <img src="../imgs/user_profile.png" width="200" height="200" alt="">
 						  </div>
 						  <div class="product-bottom text-center">
 							  <span class="name" style="color:black;"><h3><?=$transaction['fullname']?></h3></span>
 							  <span class="name" style="color:darkred"><h3>$<?=$transaction['payment_amount']?></h3></span>
 							  <span class="name" style="color:black;"><h3><?=$transaction['payment_status']?></h3></span>
 							  <span class="name" style="color:black;"><h3><?=$transaction['date-of-order']?></h3></span>
 						  </div>
 					  </div>
 				    <?php endforeach; ?>
 				  </div>
 			  </div>
 			</div>
 		</section>
    <div class="astrodivider"><div class="astrodividermask"></div><span><i>&#10038;</i></span></div>
 		<!---Listing products added to cart-->
 		<section class="New-products"  style="margin-top:20px; margin-left:20px;">
 			<div class="container">
 				<div class="title-box" style="padding-bottom:70px;" >
 					<h2>Latest bought:</h2>
 				</div>
 				<div class="row">
					<!---Listing all last products added limit is 4-->
		 			<?php foreach ($highest_product as $popular): ?>
		 				<div class="col-md-3" style="border-style: dashed;">
		 					<div class="product-top">
		 						<img src="../imgs/<?=$popular['product_img']?>" width="200" height="200" alt="">
		 					</div>
		 					<div class="product-bottom text-center">
		 						<span class="name" style="color:black;"><h3><?=$popular['product_id']?></h3></span>
		 						<span class="name" style="color:darkred;"><h3>Date bought: <small><?=$popular['order_date']?></small></h3></span>
		 					</div>
		 				</div>
		 				<?php endforeach; ?>
		 				</div>
		 			</div>
		 		</div>
		 	</div>
		</section>
		<div class="astrodivider"><div class="astrodividermask"></div><span><i>&#10038;</i></span></div>
		 <!--Counting the times the column value is the same to output the number products are added to the cart-->
		 <section class="New-products"  style="margin-top:20px; margin-left:20px;">
			 <div class="container">
				 <div class="title-box" style="padding-bottom:70px;" >
					 <h2>Popular products:</h2>
				 </div>
				 <div class="row">
			   <!---Listing all last products created limit is 11-->
			   <?php
			   foreach($db->query('SELECT product_id, product_img, COUNT(product_id)
			   FROM orders GROUP BY product_id ORDER BY COUNT(product_id) DESC LIMIT 4') as $row) { ?>
				 <div class="col-md-3" style="border-style: dashed;">
					 <div class="product-top">
						 <img src="../imgs/<?=$row['product_img']?>" width="200" height="200" alt="">
					 </div>
					 <div class="product-bottom text-center">
						 <span class="name" style="color:black;"><h3><?=$row['product_id']?></h3></span>
						 <span class="name" style="color:darkred;"><h3>Added to cart: <?=$row['COUNT(product_id)']?> x times</h3></span>
					 </div>
				 </div>
				 <?php } ?>
				 </div>
			 </div>
		 </div>
	 </div>
 </section>

 <!-------------OpenAndCloseSideMenu---------->
 <script>
 	function openmenu() {
 		document.getElementById("side-menu").style.display="block";
 		document.getElementById("menu-btn").style.display="none";
 		document.getElementById("close-btn").style.display="block";
 	}
 	 function closemenu() {
 		 document.getElementById("side-menu").style.display="none";
 		 document.getElementById("menu-btn").style.display="block";
 		 document.getElementById("close-btn").style.display="none";
 	 }

 </script>
 </html>
