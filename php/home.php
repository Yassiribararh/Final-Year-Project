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

<?=template_header('Home')?>


<h4 style="text-align:center; text-decoration-style: solid; background: darkgrey; color: white; margin-bottom:0;">Welcome back, <?=$_SESSION['user']['username']?>!</h4>
<section class="header">
  <div class="side-menu" id="side-menu">
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
					<img src="http://www.prontoitservices.com.au/wp-content/uploads/2016/07/shoponline.jpg" class="d-block w-100"alt="..." >
				</div>
				<!-------------i might add some more images to slider---------->
			</div>
			<!--- <ol class="carousel-indicators">
			<li data-target="#slider" data-slide-to="0" class="active"></li>
			<li data-target="#slider" data-slide-to="1"></li>
			<li data-target="#slider" data-slide-to="2"></li>
			</ol> ---->
		</div>
	</div>
</section>
<!-------------New Products---------->
<section class="New-products">
	<div class="container" >
		 <div class="title-box" style="margin-top:100px;" >
				 <h2 >On Sale</h2>
		 </div>
		 <div class="row">
			<!-------------New Arrivals 1---------->
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
</section>
<?=template_footer()?>
