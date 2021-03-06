<?php include('../functions/functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
  <link rel="stylesheet" href="../styles/stylelogin.css">
</head>
<body>
  <div class="header">
	  <h2>Register</h2>
  </div>
  <form method="post" action="register.php">
  <?php echo display_error(); ?>
	  <div class="input-group">
		  <label>Username</label>
		  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
	  <div class="input-group">
		  <label>Email</label>
	  	<input type="email" name="email" value="<?php echo $email; ?>">
	  </div>
	  <div class="input-group">
		  <label>Password</label>
	  	<input type="password" name="password_1">
	  </div>
	  <div class="input-group">
	  	<label>Confirm password</label>
		  <input type="password" name="password_2">
	  </div>
	  <div class="input-group">
		  <label>Postcode</label>
		  <input type="text" name="postcode">
	  </div>
	  <div class="input-group">
		  <label>Address</label>
		  <input type="text" name="address">
	  </div>
	  <div class="input-group">
		  <label>Phone Number</label>
	  	<input type="text" name="phonenumber">
	  </div>
	  <div class="input-group">
		  <button type="submit" class="btn" name="register_btn">Register</button>
	  </div>
	  <p>
		Already a member? <a href="login.php">Sign in</a>
	  </p>
  </form>
</body>
</html>
