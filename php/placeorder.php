<?php

// Check the session variable for products in cart to be displayed
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
if ($products_in_cart) {
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM productsfyp WHERE id IN (' . $array_to_question_marks . ')');
    $stmt->execute(array_keys($products_in_cart));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}

if (isset($_POST['review'])) {
	addreview();
}

function addreview(){
$data = mysqli_connect('localhost', 'root', '', 'phplogin');

	$fullname    =  $_POST['review_name'];
	$reviewmessage  =  $_POST['review_message'];

  $query = "INSERT INTO reviews (review_name, review_message)
            VALUES('$fullname', '$reviewmessage')";
  mysqli_query($data, $query);

  echo '<h1 style="text-align:center; text-decoration-style: solid;
	 background: darkgrey; color: white; margin-bottom:0;">Review form submitted successfully!</h1>';
}
?>
<!--Script file for downloading html to pdf to generate receipt for user-->
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

<style>
.table-bordered {
  font-family: arial, sans-serif;
  border-style: solid;
  background-color: white;
}

tr:nth-child(even) {
  background-color: #dddddd;
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Genuine Shop</title>
	<link rel="stylesheet" type="text/css" href="../styles/Styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >
	<Link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: lightgrey;" >
  <div class="jumbotron text-center" style="padding-bottom:20px; margin-bottom:0; background-color: lightgrey;">
    <h1>Your Order Has Been Placed !!</h1>
    <p>Thank you for ordering with us, below youcan find your invoice and we'll contact you by email with your order details.</p>
  </div>
  <div class="invoicecontainer" id="invoice" >
    <div class="row">
      <div class="col-md-1"></div>
        <div class="col-md-10 border" >
          <div class="row">
            <div class="col-md-12 invoice text-center text-primary">
              <h2 style="color: darkred;">Invoice</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <p><strong>Invoice No: </strong> 12345</p>
              <p><strong>Date: </strong> </br><script> document.write(new Date().toLocaleDateString()); </script></p>
              <p>United Kingdom</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 well invoice-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                  <tr>
                    <td class="img">
                      <a href="index.php?page=product&id=<?=$product['id']?>">
                        <img src="../imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
                      </a>
                    </td>
                    <td>
                      <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                    </td>
                    <td class="price">&dollar;<?=$product['price']?></td>
                    <td class="quantity">
                      <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" readonly="readonly" style="text-align:center;">
                    </td>
                    <td class="price">&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12 text-center" style="text-align: right;">
            <span class="text">Order Total:</span>
            <span class="price"><strong>&dollar;<?=$subtotal?></strong></span>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">Signature: <strong>@GenuineShop </strong></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row ">
        <div class="col-md-12 text-center">
          <button class="btn btn-warning" id="downloadPdf" style="margin-top: 20px; background-color:darkred; color:white;">
            Download Receipt
          </button>
          <p class="lead">
            <a class="btn btn-warning" href="home.php" role="button"style="background-color:darkred; color:white;" >Back to homepage</a>
          </p>
        </div>
      </div>
    </div>
    <form method="post" action="placeorder.php">
      <table style="margin: auto;" >
        <thead>
          <tr>
            <td colspan="2" class="head"><h5>Leave Us a review ? </h5></td>
          </tr>
        </thead>
        <tbody >
          <tr>
            <td colspan="5" style="margin: auto;" class="cash">
              <div class="input-group" >
                <label>Full Name:</label>
                <input type="text" name="review_name">
              </div>
              <div class="input-group">
                <label>Message</label>
                <input type="text" name="review_message" style="padding-bottom:50px;">
              </div>
              <div class="input-group">
                <button type="submit" class="button" name="review" style="margin:auto;">Submit</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </body>
<script>
document
  .getElementById("downloadPdf")
  .addEventListener("click", function download() {
    const element = document.getElementById("invoice");
    html2pdf()
      .from(element)
      .save();
  });
</script>
</html>
