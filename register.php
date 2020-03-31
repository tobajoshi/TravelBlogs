<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<div class = "headcontainer">
<h1>Welcome to Travelblogs</h1>
</div>
<div class="specific">
  <div class="header registrationheader">
  	<h2>Register</h2>
  </div>
	
  <form class="content registration" method="post" action="register.php">
  	<?php include('errors.php'); ?>
	  <div class = "input-group lastname">
		<label>Last Name</label>
		<input type="text" name="lastname" value="<?php echo $lastname; ?>">
		</div>
		<div class = "input-group firstname">
		<label>First Name</label>
		<input type="text" name="firstname" value="<?php echo $firstname; ?>">
		</div>
  	<div class="input-group username">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group email">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group password1">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group password2">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group registrationbutton">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
	  </div>
	  <div class="signinlink">
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
	  </p>
</div>
  </form>
</div>
</body>
</html>