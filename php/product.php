<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM productsfyp WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        die ('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    die ('Product does not exist!');
}
?>
<?=template_header('Product')?>

<!-------------Product image---------->
<section class="single-product"  >
  <div class="container">
    <div class="row" >
      <div class="col-md-5">
        <div id="product-slider" class="carousel slide carousel-fade" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../imgs/<?=$product['img']?>" class="d-block w-100"alt="..." >
            </div>
            <a class="carousel-control-prev" href="#product-slider" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#product-slider" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <!-------------Product price/condition...---------->
          <form action="index.php?page=cart" method="post" >
            <div class="col-md-7" >
              <p class="new-arrival text-center">NEW</p>
              <h3><?=$product['name']?> </h3>
              <h5>Product id: <?=$product['id']?> </h5>

              <div class="product-bottom" style="margin-right:-100px;">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                <p class="price">&dollar;<?=$product['price']?></p>
                <p><b> Availability: </b> In Stock</p>
                <p><b> Condition: </b> New</p>
                <label><b> Quantity: </b></label>
                <input class="qs" type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                <button class="qs" type="submit" style="margin-left:20px; margin-top:20px;">Add to Cart!</button>
              </div>
            </form>
          </div>
</section>
<!-------------Product Description---------->
<section class="product-description">
    <div class="container">
      <h3>Product Description: </h3>
      <p><?=$product['desc']?></p>
    </div>
</section>
<?=template_footer()?>
