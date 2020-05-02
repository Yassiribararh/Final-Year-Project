<?php
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
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

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
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
}


?>
<?=template_header('Place Order')?>
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

</style>

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
<?=template_footer()?>
