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
</style>

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
    <!-- Including the search scripting file. -->
    <script type="text/javascript" src="../scripts/script.js"></script>
  </head>
	<div class="top-nav-bar">
		<div class="search-box">
			<i class="fa fa-bars" id="menu-btn" onclick="openmenu()"></i>
			<i class="fa fa-times" id="close-btn" onclick="closemenu()"></i>
      <a href="home.php"><img src="../imgs/admin_profile.png" class ="myLogo"></a>
			<h2><br/>Admin - Home Page</h2>
    </div>
    <div class="menu-bar">
			<ul>
				<li><a href="admin-profile.php"><i class="fas fa-user-circle"></i> Profile</a>
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
		<?php
			$con=mysqli_connect('localhost', 'root', '', 'phplogin');
			// Check connection
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		 $users = mysqli_query($con,"SELECT * FROM users");
		echo "<h5 style='color:darkred; text-align:center;'>Users:</h5>";
		echo "<table border='1'  style='margin-left:auto; margin-right:auto;' >
		<tr>
		<th>Username</th>
		<th>Email</th>
		<th>Address</th>
		<th>Password</th>
		<th>Postcode</th>
		<th>Phonenumber</th>
		<th>User-Type</th>
		</tr>";


		while($row = mysqli_fetch_array($users)) {
			echo "<tr>";
			echo "<td>" . $row['username'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . $row['address'] . "</td>";
			echo "<td>" . $row['password'] . "</td>";
			echo "<td>" . $row['postcode'] . "</td>";
			echo "<td>" . $row['phonenumber'] . "</td>";
			echo "<td>" . $row['user_type'] . "</td>";
			echo "</tr>";
		}

		echo "</table>";
		echo "<div style='text-align: center; margin-top:10px; margin-bottom:40px;'>";
		echo "<a href='create_user.php'> + Add User</a>";
		echo "</div>";
	?>
