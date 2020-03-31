<?php
include('functions.php');
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

		<link rel="stylesheet" type="text/css" href="Styles.css">
    <link rel="stylesheet" type="text/css" href="styless.css">
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
      <a href="home.php"><img src="imgs/myLogo1.jpg" class ="myLogo"></a>
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
				<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</li></a>
      </ul>
    </div>
    <div style="width: 700px;margin-top:-25px; auto; margin-left:100px; cursor:pointer; width: 48%;">
      <ul style=" list-style-type: none; ">
        <li style=" list-style-type: none;"><div id="display" style="border:solid 0 #BDC7D8;display:none; "></div></li>
      </ul>
    </div>
  </div>
	<body>
                <!-------------Product Description---------->
    <section class="product-description">
      <div class="container">
        <h3>Privacy Policy </h3>
				<p>This website is operated by YASSIR IBARARH and whose registered address is De Montfort University. We are committed to protecting and preserving the privacy of our visitors when visiting our site or communicating electronically with us.

				This policy sets out how we process any personal data we collect from you or that you provide to us through our website.<br />
				 We confirm that we will keep your information secure and that we will comply fully with all applicable UK Data Protection legislation and regulations.<br />
				 Please read the following carefully to understand what happens to personal data that you choose to provide to us, or that we collect from you when you visit this site.<br />
				 By visiting (our website) you are accepting and consenting to the practices described in this policy.<br />

				Types of information we may collect from you<br />
				We may collect, store and use the following kinds of personal information about individuals who visit and use our website:<br />

				Information you supply to us. You may supply us with information about you by filling in forms on our website.<br />
				 This includes information you provide when you submit a contact/enquiry form [list any other active forms on your website (ie. Request a Prospectus Form, Application Form, Report and Absence Form, etc.]. <br />
				The information you give us may include your name, address, e-mail address and phone number, (ie. child’s name, child’s date of birth, etc.).

				Information our website automatically collects about you. With regard to each of your visits to our website we may automatically collect information including the following:

				technical information, including a truncated and anonymised version of your Internet protocol (IP) address, browser type and version, operating system and platform;
				information about your visit, including what pages you visit, how long you are on the site, how you got to the site (including date and time); page response times, length of visit, what you click on, documents downloaded and download errors.


				Cookies

				Our website uses cookies to distinguish you from other users of our website. This helps us to provide you with a good experience when you browse our website and also allows us to improve our site. <br />
				For detailed information on the cookies we use and the purposes for which we use them see our Cookie Policy.<br />
				<br />
				How we may use the information we collect<br />
				We use the information in the following ways:<br />

				Information you supply to us. We will use this information:<br />

				to provide you with information and/or services that you request from us.<br />

				Information we automatically collect about you. We will use this information:<br />
				<br />
				to administer our site including troubleshooting and statistical purposes;
				to improve our site to ensure that content is presented in the most effective manner for you and for your computer;
				security and debugging as part of our efforts to keep our site safe and secure.<br />
				This information is collected anonymously and is not linked to information that identifies you as an individual.<br />
				 We use Google Analytics to track this information. <br />
				Find out how Google uses your data at https://support.google.com/analytics/answer/6004245. <br />
				<br />
				Disclosure of your information
				Any information you provide to us will either be emailed directly to us or may be stored on a secure server located near Dublin within the Republic of Ireland.<br />
				 We use a trusted third party website and hosting provider (Cleverbox) to facilitate the running and management of this website.<br />
				 Cleverbox meet high data protection and security standards and are bound by contract to keep any information they process on our behalf confidential.<br />
				 Any data that may be collected through this website that Cleverbox process, is kept secure and only processed in the manner we instruct them to.<br />
				 Cleverbox cannot access, provide, rectify or delete any data that they store on our behalf without permission.<br />
				<br />
				We do not rent, sell or share personal information about you with other people or non-affiliated companies.<br />

				We will use all reasonable efforts to ensure that your personal data is not disclosed to regional/national institutions and authorities,<br />
				 unless required by law or other regulations.<br />

				Unfortunately, the transmission of information via the internet is not completely secure. <br />
				Although we will do our best to protect your personal data, we cannot guarantee the security of your data transmitted to our site;<br />
				 any transmission is at your own risk. <br />
				Once we have received your information, we will use strict procedures and security features to try to prevent unauthorised access.

				Third party links<br />
				Our site may, from time to time, contain links to and from the third party websites.<br />
				 If you follow a link to any of these websites, please note that these websites have their own privacy policies and that we do not accept any responsibility or liability for these policies.<br />
				 Please check these policies before you submit any personal data to these websites.

				Your rights – access to your personal data<br />
				You have the right to ensure that your personal data is being processed lawfully (“Subject Access Right”). <br />
				Your subject access right can be exercised in accordance with data protection laws and regulations.<br />
				 Any subject access request must be made in writing to De Montfort University. We will provide your personal data to you within the statutory time frames. <br />
				To enable us to trace any of your personal data that we may be holding, we may need to request further information from you.<br />
				 If you have a complaint about how we have used your information, you have the right to complain to the Information Commissioner’s Office (ICO).

				Changes to our privacy policy<br />
				Any changes we may make to our privacy policy in the future will be posted on this page and, where appropriate, notified to you by e-mail.<br />
				 Please check back frequently to see any updates or changes to our privacy policy.<br />
				<br />
				Contact<br />
				Questions, comments and requests regarding this privacy policy are welcomed and should be addressed to YASSIRIBARARH@GMAIL.COM.<br />
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
  </body>
</html>
