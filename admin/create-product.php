<?php
if (isset($_POST['create_new_product'])) {
	addnewproduct();
}

function addnewproduct(){
$dB = mysqli_connect('localhost', 'root', '', 'phplogin');

	$productname    =  $_POST['name'];
	$productdesc       =  $_POST['descr'];
	$productprice       =  $_POST['price'];
	$productquantity  =  $_POST['quantity'];
	$productimg  =  $_POST['img'];


  $sql = "INSERT INTO productsfyp (`desc`, name, price, quantity, img)
	  VALUES('$productdesc','$productname',
			 '$productprice', '$productquantity', '$productimg' )";
  mysqli_query($dB, $sql);
	echo '<h4 style="text-align:center; text-decoration-style: solid;
		background: darkgrey; color: white; margin-bottom:0;">Product created successfully!</h4>';
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Product</title>
	<link rel="stylesheet" type="text/css" href="../styles/stylelogin.css">
</head>
<body>
	<div class="header">
		<h2>Admin - Create Product</h2>
	</div>

	<form method="post" action="create-product.php">
		<div class="input-group">
			<label>Product Name</label>
			<input type="text" name="name">
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="number" name="price">
		</div>
		<div class="input-group">
			<label>Quantity</label>
      <input type="number" name="quantity">
		</div>
		<div class="input-group">
			<label>image title</label>
			<input type="text" name="img">
		</div>
    <div class="input-group">
			<label>Product Description</label>
			<input type="text" name="descr">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="create_new_product"> + Create Product</button>
		</div>
	</form>
</body>
</html>
