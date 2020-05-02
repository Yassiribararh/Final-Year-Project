<?php include('../functions/functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Product</title>
	<link rel="stylesheet" type="text/css" href="../stylelogin.css">
</head>
<body>
	<div class="header">
		<h2>Admin - Create Product</h2>
	</div>
	<form method="post" action="create-product.php">
		<?php echo display_error(); ?>
		<div class="input-group">
			<label>Product Name</label>
			<input type="text" name="username" value="">
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="price" name="price" value="">
		</div>
		<div class="input-group">
			<label>Quantity</label>
      <input type="number" name="quantity" value="">
		</div>
		<div class="input-group">
			<label>image title</label>
			<input type="text" name="img" value="">
		</div>
    <div class="input-group">
			<label>Product Description</label>
      <textarea rows="4" cols "60" name="description" style="width: 95%"></textarea>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="create_product_btn"> + Create Product</button>
		</div>
	</form>
</body>
</html>
