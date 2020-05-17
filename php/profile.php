<?php
include('../functions/functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
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
$stmt = $con->prepare('SELECT password, email, address, postcode, phonenumber FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $address, $postcode, $phonenumber);
$stmt->fetch();
$stmt->close();
?>

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
	<div class="top-nav-bar">
		<div class="search-box">
			<i class="fa fa-bars" id="menu-btn" onclick="openmenu()"></i>
			<i class="fa fa-times" id="close-btn" onclick="closemenu()"></i>
			<a href="home.php"><img src="../imgs/myLogo1.jpg" class ="myLogo"></a>
			<form class="search-box" method="POST" action="Search_results.php">
				<input type="text" class="form-control" id="search" placeholder="Search here..." name="keyword" required="required"/>
				<span class="input-group-btn">
					<button class="input-group-text" name="search"><span ><i class="fa fa-search"></i></span></button>
				</span>
			</form>
			<br />
		</div>
		<div class="menu-bar">
			<ul>
				<li><a href="index.php?page=cart"><i class="fa fa-shopping-basket "></i> cart</a> </li>
				<li><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
				<li><a href="home.php?logout='1'"><i class="fas fa-sign-out-alt"></i> Logout</li></a>
			</ul>
		</div>
		<div style="width: 700px;margin-top:-25px; auto; margin-left:100px; cursor:pointer; width: 48%;">
			<ul style=" list-style-type: none; ">
				<li style=" list-style-type: none;"><div id="display" style="border:solid 0 #BDC7D8;display:none; "></div></li>
			</ul>
		</div>
	</div>
	<div class="content" style="margin:auto;">
		<h2 style="margin:auto;">Profile Details</h2>
		<div style="text-align:center;">
			<p>Your account details are below:</p>
			<table style="margin:auto; text-align:left;">
				<?php  if (isset($_SESSION['user'])) : ?>
					<img src="../imgs/user_profile.png" style="width: 30%; margin:auto;" >
					<h4><?php echo $_SESSION['user']['username']; ?></h4>
					<h4>(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</h4>
				<?php endif ?>
				<tr>
					<td>Username:</td>
					<td><?=$_SESSION['user']['username']?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?=$_SESSION['user']['email']?></td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><?=$_SESSION['user']['address']?></td>
				</tr>
				<tr>
					<td>Postcode:</td>
					<td><?=$_SESSION['user']['postcode']?></td>
				</tr>
				<tr>
					<td>Phone Number:</td>
					<td><?=$_SESSION['user']['phonenumber']?></td>
				</tr>
			</table>
		</div>
	</div>
	<!-------------Footer---------->
	<section class="footer">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-3">
					<h1>Useful Links</h1>
					<a href="PrivacyPolicy.php" style="color:white"><p>Privacy Policy</p></a>
					<a href="ReturnPolicy.php" style="color:white"><p>Return Policy</p></a>
				</div>
				<div class="col-md-3">
					<h1>Company</h1>
					<a href="AboutUs.php" style="color:white"><p>About Us</p></a>
					<a href="Contact.php" style="color:white"><p>Contact</p></a>
				</div>
				<div class="col-md-3">
					<h1>Follow Us on</h1>
					<a href="https://www.facebook.com/" style="color:white"><p><i class=" fa fa-facebook official "></i>  Facebook</p></a>
					<a href="https://instagram.com/" style="color:white"><p><i class=" fa fa-instagram "></i> Instagram</p></a>
					<a href="https://www.twitter.com/" style="color:white"><p><i class=" fa fa-twitter"></i> Twitter</p></a>
				</div>
			</div>
		</div>
  </section>
</html>
