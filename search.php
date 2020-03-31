<?php
  if(ISSET($_POST['search'])){
    $keyword = $_POST['keyword'];
?>

<div>
  <h2>Result</h2>
  <hr style="border-top:2px dotted #ccc;"/>
  <?php
    require 'conn.php';
      $query = mysqli_query($conn, "SELECT * FROM `productsfyp` WHERE `name` LIKE '%$keyword%' ORDER BY `id`") or die(mysqli_error());
    while($fetch = mysqli_fetch_array($query)){
  ?>
  <div style="word-wrap:break-word; text-align: center;">
    <img src="imgs/<?php echo $fetch['img']?>" width="50" height="50" alt="<?php echo $fetch['name']?>">

    <a href="index.php?page=product&id=<?php echo $fetch['id']?>"><h4><?php echo $fetch['name']?></h4></a>
    <p><?php echo substr($fetch['desc'], 0, 100)?>...</p>
  </div>
  <hr style="border-bottom:1px solid #ccc;"/>
  <?php
    }
  ?>
</div>
<?php
  }
?>
