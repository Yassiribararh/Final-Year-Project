<?php
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Declaring variables
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // we basically are checking if the product exists in our database
    $stmt = $pdo->prepare('SELECT * FROM productsfyp WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Remove product from cart, it will check for the URL param "remove", this is the product id, to make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM productsfyp WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }

    $id = $product['name'];
    $img = $product['img'];
    // connect to database
    $paypal_method = "Paypal_Payment";
    $db = mysqli_connect('localhost', 'root', '', 'phplogin');
    // inserting values into orders table.
    $query = "INSERT INTO orders (order_total, product_id, payement_method, product_img)
    					  VALUES('$subtotal', '$id', '$paypal_method','$img')";
    			mysqli_query($db, $query);
}

// For testing purposes we will only use paypal sandbox
$testmode = true;
$paypalurl = $testmode ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
// If the user clicks the PayPal checkout button...
if (isset($_POST['paypal']) && $products_in_cart && !empty($products_in_cart)) {
    // Variables we need to pass to paypal
    $data = array(
        'cmd'			=> '_cart',
        'upload'        => '1',
        'lc'			=> 'EN',
        'business' 		=> 'yassiribararh@gmail.com',
        'cancel_return'	=> 'http://localhost/Final-Year-Project/php/index.php?page=cart',
        'notify_url'	=> 'http://localhost/Final-Year-Project/php/index.php?page=cart&ipn_listener=paypal',
        'currency_code'	=> 'USD',
        'return'        => 'http://localhost/Final-Year-Project/php/index.php?page=placeorder'
    );

    // Add all the products that are in the shopping cart to the data array variable
    for ($i = 0; $i < count($products); $i++) {
        $data['item_number_' . ($i+1)] = $products[$i]['id'];
        $data['item_name_' . ($i+1)] = $products[$i]['name'];
        $data['quantity_' . ($i+1)] = $products_in_cart[$products[$i]['id']];
        $data['amount_' . ($i+1)] = $products[$i]['price'];
    }
    // Send the user to the paypal checkout screen
    header('location:' . $paypalurl . '?' . http_build_query($data));
    // End the script don't need to execute anything else
    exit;
}


if (isset($_POST['pay-cash'])) {
	addtrans();
  addorder();
}

function addtrans(){
$database = mysqli_connect('localhost', 'root', '', 'phplogin');
global $product;

	$fullname    =  $_POST['fullname'];
	$email       =  $_POST['payer_email'];
	$postcode  =  $_POST['postcode'];
	$address  =  $_POST['payer_address'];
	$phonenumber  =  $_POST['phonenumber'];
  $subtotal  =  $_POST['subtotal'];


  $query = "INSERT INTO transactions (fullname, payer_email, payer_address, payment_status, payer_phone,
                                    	payer_postcode, payment_amount)
        VALUES('$fullname', '$email', '$address', 'Cash-payement', '$phonenumber', '$postcode', '$subtotal')";
  mysqli_query($database, $query);
  header('Location: index.php?page=placeorder');
}

function addorder(){
$database = mysqli_connect('localhost', 'root', '', 'phplogin');
global $product;
global $item_id;
global $item_quantity;
global $item_mc_gross;


	$order_total      =  $_POST['payer_email'];
	$product_id  =  $_POST['postcode'];

  $query = "INSERT INTO orders (orde_total, product_id)
        VALUES('$item_mc_gross', '$item_id')";
  mysqli_query($database, $query);
}

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

.paypal {
	padding-bottom: 40px;
}
.paypal button {
	display: inline-block;
	padding: 10px 20px 7px 20px;
	background-color: #FFC439;
	border-radius: 5px;
	border: none;
	cursor: pointer;
	width: 215px;
}
.paypal button:hover {
	background-color: #f3bb37;
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
<?=template_header('Cart')?>

<body>
  <div class="cart content-wrapper"  >
    <h1 style="text-align:center;">Shopping Cart:</h1>
    <form action="index.php?page=cart" method="post">
      <table style="margin: auto;" >
        <thead>
          <tr>
            <td colspan="2" class="head"><h5>Product</h5></td>
            <td style="padding-right: 20px;" class="head"><h5>Price</h5></td>
            <td style="padding-right: 20px;" class="head"><h5>Quantity</h5></td>
            <td style="padding-right: 20px;" class="head"><h5>Total</h5></td>
          </tr>
        </thead>
      <tbody >
      <?php if (empty($products)): ?>
        <tr>
          <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
        </tr>
      <?php else: ?>
      <?php foreach ($products as $product): ?>
      <tr>
        <td class="img">
          <a href="index.php?page=product&id=<?=$product['id']?>">
            <img src="../imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
          </a>
        </td>
        <td>
          <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
          <br>
          <button><a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove" style="color:black;">Remove</a></button>
          <hr style="border-top:2px dotted #ccc;"/>
          </td>
          <td class="price">&dollar;<?=$product['price']?></td>
          <td class="quantity">
            <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
          </td>
          <td class="price">&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <table style="margin: auto;" >
      <thead>
        <tr>
          <td colspan="2" class="head"><h5>Pay with: </h5></td>
        </tr>
      </thead>
      <tbody >
        <tr>
          <td colspan="5" style="text-align:center;">
            <div class="paypal">
              <button type="submit" name="paypal"><img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-100px.png" border="0" alt="PayPal Logo"></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="subtotal" style="text-align:center;">
      <span class="text">Order Total:</span>
      <span class="price">&dollar;<?=$subtotal?></span>
    </div>
    <div class="buttons" style="text-align:center; margin-bottom: 102px;">
      <input type="submit" value="Update" name="update">
    </div>
  </form>
  <form method="post" action="cart.php">
    <table style="margin: auto;" >
      <thead>
        <tr>
          <td colspan="2" class="head"><h5>Or with cash upon arrival: </h5></td>
        </tr>
      </thead>
      <tbody >
        <tr>
          <td colspan="5" style="margin: auto;" class="cash">
            <div class="input-group" >
            	<label>Full Name:</label>
          		<input type="text" name="fullname">
          	</div>
          	<div class="input-group">
          		<label>Email:</label>
          		<input type="email" name="payer_email">
          	</div>
          	<div class="input-group">
          		<label>Postcode</label>
          		<input type="text" name="postcode">
          	</div>
          	<div class="input-group">
          		<label>Address</label>
          		<input type="text" name="payer_address">
          	</div>
          	<div class="input-group">
          		<label>Phone Number</label>
          		<input type="text" name="phonenumber">
          	</div>
            <div class="input-group">
          		<label>Subtotal</label>
          		<input type="text" name="subtotal" readonly="readonly" value="$<?=$subtotal?> (In American Dollars!)">
          	</div>
            <div class="input-group">
          		<button type="submit" class="button" name="pay-cash" style="margin:auto;">Submit</button>
          	</div>
          </td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </form>
</div>
<?=template_footer()?>
