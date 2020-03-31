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
<div class="main">
  <div class="header loginheader">
  	<h2>Login</h2>
  </div>
	
  <form class="content login" method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group existingusername">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group password">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group loginbutton">
  		<button type="submit" class="btn" name="login_user">Login</button>
	  </div>
	  <div class="registrationlink">
  	<p>
  		New Traveler? <a href="register.php">Sign up</a>
	  </p>
</div>
  </form>
</div>
</body>
</html>