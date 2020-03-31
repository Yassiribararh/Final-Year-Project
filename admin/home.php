<?php
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
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

		<link rel="stylesheet" type="text/css" href="../Styles.css">
    <link rel="stylesheet" type="text/css" href="../styless.css">
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
      <a href="home.php"><img src="../images/admin_profile.png" class ="myLogo"></a>
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

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>


		<!-- logged in user information -->

<h4 style="text-align:center; text-decoration-style: solid; background: darkgrey; color: white; margin-bottom:20px;">Welcome back, <?=$_SESSION['user']['username']?>!
<small><i  style="color: white;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i><br></small></h4>

	<?php
$con=mysqli_connect('localhost', 'root', '', 'phplogin');
// Check connection
if (mysqli_connect_errno())
{
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


while($row = mysqli_fetch_array($users))
{
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

$products = mysqli_query($con,"SELECT * FROM productsfyp");

echo "<h5 style='color:darkred; text-align:center;'>Products:</h5>";
echo "<table border='1' style=' margin-left:auto; margin-right:auto;' >
<tr>
<th>ProductId</th>
<th>Name</th>
<th  style='padding-right:235px;'>Description</th>
<th>Price</th>
<th>Quantity</th>
<th>Image</th>
<th style='padding-right:50px;'>Date added</th>
</tr>";


while($row = mysqli_fetch_array($products))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . substr($row['desc'], 0, 50). "<p>...</p></td>";
echo "<td>" . $row['price'] . "</td>";
echo "<td>" . $row['quantity'] . "</td>";
echo "<td>" . $row['img'] . "</td>";
echo "<td>" . $row['date_added'] . "</td>";
echo "</tr>";
}
echo "</table>";
echo "<div style='text-align: center; margin-top:10px; margin-bottom:40px;'>";
echo "<a href='create-product.php'> + Add Product</a>";
echo "</div>";
mysqli_close($con);
?>
</body>
</html>
