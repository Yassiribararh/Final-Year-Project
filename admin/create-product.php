<?php
if (isset($_POST['create_product_btn'])) {
	addnewproduct();
}

function addnewproduct(){
$database = mysqli_connect('localhost', 'root', '', 'phplogin');

	$productname    =  $_POST['productname'];
	$productdesc       =  $_POST['description'];
	$productprice       =  $_POST['price'];
	$productquantity  =  $_POST['quantity'];
	$productimg  =  $_POST['img'];


  $query = "INSERT INTO productsfyp (name, desc, price, quantity, img)
        VALUES('$productname','$productdesc','$productprice','$productquantity','$productimg')";
  mysqli_query($database, $query);
}
?>
<?php include('../functions/functions.php') ?>
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
			<input type="text" name="productname">
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="price" name="price">
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
			<input type="text" name="description"style="width: 95%">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="create_product_btn"> + Create Product</button>
		</div>
	</form>
</body>
</html>
