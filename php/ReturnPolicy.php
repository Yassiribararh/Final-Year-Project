
<?php
include('../functions/functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
?>
<!DOCTYPE html>
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
	  <!-- Including our scripting file. -->
	  <script type="text/javascript" src="script.js"></script>
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
  <!-------------Product Description---------->
	<section class="product-description" >
    <div class="container" style="height:300px;">
			<h3>Generic refund policy </h3>
			<p>Thanks for purchasing our products at Genuine Shop operated by YASSIR IBARARH.<br />
				 In order to be eligible for a refund, you have to return the product within 30 calendar days of your purchase.<br />
				 The product must be in the same condition that you receive it and undamaged in any way.<br />
				 After we receive your item, our team of professionals will inspect it and process your refund.<br />
				 The money will be refunded to the original payment method you’ve used during the purchase.<br />
				 For credit card payments it may take 5 to 10 business days for a refund to show up on your credit card statement.<br />
				 If the product is damaged in any way, or you have initiated the return after 30 calendar days have passed, you will not be eligible for a refund.<br />
				 If anything is unclear or you have more questions feel free to contact our customer support team.
			</p>
    </div>
  </section>
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
