<?php
include('../functions/functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_POST['contact_us'])) {
	addcontact();
	header('location: Contact.php');
}

function addcontact(){
$data = mysqli_connect('localhost', 'root', '', 'phplogin');

	$fullname    =  $_POST['contact_name'];
	$email       =  $_POST['contact_email'];
	$address  =  $_POST['contact_address'];
	$phonenumber  =  $_POST['contact_phone'];
	$contactmessage  =  $_POST['contact_message'];


  $query = "INSERT INTO contact (contact_name, contact_email, contact_address, contact_number, contact_message)
            VALUES('$fullname', '$email', '$address', '$phonenumber', '$contactmessage')";
  mysqli_query($data, $query);

	echo '<h4 style="text-align:center; text-decoration-style: solid;
	 background: darkgrey; color: white; margin-bottom:0;">Contact form submitted successfully!</h4>';

}
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

.input-group {
	margin: 10px 0px 10px 0px;
}
.input-group label {
	display: block;
	text-align: left;
	margin: 3px;

}
.input-group input {
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
.cash{
	width: 40%;
	margin: 0px auto;
	padding: 20px;
	border: 1px solid #B0C4DE;
	background: white;
	border-radius: 0px 0px 10px 10px;
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
    <!-- Including search scripting file. -->
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

	<section class="product-description" style="text-align: center; margin-bottom:0;">
		<div class="container"style="text-align: center; margin-bottom:0;">
			<h3 style="text-align: center; margin-bottom:0;">Contact Details </h3>
			<p>Email: Yassiribararh@gmail.com<br />
				 Phone Number: +447763431236 <br />
				 Adress: 53 Dunton Street, <br />LE3 5EL, <br />  Leicester, <br />Leicestershire, <br /> England, Uk<br />
			</p>
		</div>
		<form method="post" action="Contact.php">
			<table style="margin: auto;" >
				<thead>
					<tr>
						<td colspan="2" class="head"><h5>Or Leave Us a message: </h5></td>
					</tr>
				</thead>
				<tbody >
					<tr>
						<td colspan="5" style="margin: auto;" class="cash">
							<div class="input-group" >
								<label>Full Name:</label>
								<input type="text" name="contact_name">
							</div>
							<div class="input-group">
								<label>Email:</label>
								<input type="text" name="contact_email">
							</div>
							<div class="input-group">
								<label>Address</label>
								<input type="text" name="contact_address">
							</div>
							<div class="input-group">
								<label>Phone Number</label>
								<input type="text" name="contact_phone">
							</div>
							<div class="input-group">
								<label>Message</label>
								<input type="text" name="contact_message" style="padding-bottom:50px;">
							</div>
							<div class="input-group">
								<button type="submit" class="button" name="contact_us" style="margin:auto;">Submit</button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
  </section>
	<!--Footer-->
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
