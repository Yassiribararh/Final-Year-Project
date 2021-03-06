<?php
include('../functions/functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
$pdo = pdo_connect_mysql();
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM productsfyp ORDER BY date_added DESC LIMIT 11');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h4 style="text-align:center; margin-right: 0; text-decoration-style: solid; background: darkgrey;
 color: white; margin-bottom:0;">Welcome back, <?=$_SESSION['user']['username']?>!</h4>
<div class="search-box" style="background-color:grey;">
	<i class="fa fa-bars" id="menu-btn" onclick="openmenu()"></i>
	<i class="fa fa-times" id="close-btn" onclick="closemenu()"></i>
</div>

<?=template_header('Home')?>

<style>
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

.product-top img:hover {
  transform: scale(1.5);
	transition: 1s;
}

</style>


<section class="header">
  <div class="side-menu" id="side-menu" style="height:405px;">
		<ul>
			<li><a href="index.php?page=product&id=6" style="color:white">Whey Protein <i class="fa fa-angle-right"></i></a></li>
			<li><a href="index.php?page=product&id=8" style="color:white"> Omega 3 Vegan <i class="fa fa-angle-right"></i></a></li>
			<li><a href="index.php?page=product&id=7" style="color:white" > Amino Acids <i class="fa fa-angle-right"></i></a></li>
			<li><a href="index.php?page=product&id=9" style="color:white" >Creatine <i class="fa fa-angle-right"></i></a></li>
			<li><a href="index.php?page=product&id=10" style="color:white">Multivitamins <i class="fa fa-angle-right"></i></a></li>
			<li><a href="index.php?page=product&id=11" style="color:white">Pre Workouts <i class="fa fa-angle-right"></i></a></li>
			<li> <a href="index.php?page=product&id=12" style="color:white"> Chockolate Protein Shake <i class="fa fa-angle-right"></i></a></li>
			<li><a href="index.php?page=product&id=13" style="color:white"> Strawberry Protein Shake <i class="fa fa-angle-right"></i></a></li>
			<li> <a href="index.php?page=product&id=14" style="color:white">Healthy snacks <i class="fa fa-angle-right"></i></a></li>
			<li><a href="index.php?page=product&id=15" style="color:white">Omega 3 Fish Oil <i class="fa fa-angle-right"></i></a></li>
			<li><a href="index.php?page=product&id=16" style="color:white">Diet Whey Protein <i class="fa fa-angle-right"></i></a></li>
		</ul>
	</div>
	<div class="slider">
		<div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="../imgs/shoponline.jpg" class="d-block w-100"alt="..." style="height:405px;">
				</div>
				<div class="carousel-item">
					<img src="../imgs/shoponline1.png" class="d-block w-100"alt="..."style="height:405px;" >
				</div>
				<div class="carousel-item">
					<img src="../imgs/shoponline2.jpg" class="d-block w-100"alt="..." style="height:405px;">
				</div>
				<div class="carousel-item">
					<img src="../imgs/shoponline3.jpg" class="d-block w-100"alt="..." style="height:405px;">
				</div>
				<div class="carousel-item">
					<img src="../imgs/shoponline4.png" class="d-block w-100"alt="..." style="height:405px;">
				</div>
			</div>
			<ol class="carousel-indicators">
			<li data-target="#slider" data-slide-to="0" class="active"></li>
			<li data-target="#slider" data-slide-to="1"></li>
			<li data-target="#slider" data-slide-to="2"></li>
			<li data-target="#slider" data-slide-to="3"></li>
			<li data-target="#slider" data-slide-to="4"></li>
			</ol>
		</div>
	</div>
</section>
<!--New  On sale Products--->
<section class="New-products">
	<div class="container" >
		<div class="title-box" style="margin-top:50px;" >
			<h2 >On Sale</h2>
		</div>
		<div class="row">
		<!---Listing all last products created limit is 11-->
		<?php foreach ($recently_added_products as $product): ?>
			<div class="col-md-3">
				<div class="product-top">
					<a href="index.php?page=product&id=<?=$product['id']?>" class="product">
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
					</div>
				</div>
			</span>
			</a>
		  <?php endforeach; ?>
		  </div>
	  </div>
  </div>
  <div class="astrodivider"><div class="astrodividermask"></div><span><i>&#10038;</i></span></div>
  <div class="container" >
	  <div class="title-box" style="margin-top:50px;" >
		  <h2>Reviews</h2>
	  </div>
  </div>
	<?php
	 $con=mysqli_connect('localhost', 'root', '', 'phplogin');
	 // Check connection
	 if (mysqli_connect_errno()) {
		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
	 }
	 $users = mysqli_query($con,"SELECT * FROM reviews");
	echo "<table border='1'  style='margin-left:auto; margin-right:auto; width:80%;' >
	<tr>
	<th>Customer Name</th>
	<th>Review</th>
	<th>submitted</th>
	</tr>";

	while($row = mysqli_fetch_array($users)) {
	 echo "<tr>";
	 echo "<td>" . $row['review_name'] . "</td>";
	 echo "<td>" . $row['review_message'] . "</td>";
	 echo "<td>" . $row['review_date'] . "</td>";
	 echo "</tr>";
	}

	echo "</table>";
	?>
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
<?=template_footer()?>
