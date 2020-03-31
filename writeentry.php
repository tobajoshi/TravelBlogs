<?php 
include('server.php');
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create Blog</title>
  <link rel="stylesheet" type="text/css" href="style.css">
<style>
  
</style>
</head>
<body>

<div class="navbar">
  <div class="headtitle">
    <article>Travelblogs</article>
  </div>
  <a href="#home">Profil</a>
  <a href="dashboard.php">Feed</a>
  <div class="dropdown">
    <button class="dropbtn">Diary
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="newdiary.php">New Diary</a>
      <a href="editdiary.php">Edit Diary</a>
    </div>
  </div>  
</div>

<div class="specific">
<div class="header writeentryheader">
  	<h2>Write an Entry for your Diary</h2>
  </div>

<form class="content writeentrycontent" method="post" action="writeentry.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group daydate">
  		<label>Date</label>
  		<input type="date" name="daydate" value="<?php echo $daydate; ?>">
  	</div>
  	<div class="input-group location">
  		<label>Where was your adventure?</label>
  		<input type="text" name="location" value="<?php echo $location; ?>">
  	</div>
      <div class ="input-group entrytext">
      <label>What was your adventure?</label>
      <textarea class="FormElement" name="entrytext" id="entrytext" value="<?php echo $entry; ?>"></textarea>
    </div>
  	<div class="input-group finishentrybutton">
  		<button type="submit" class="btn" name="finish_entry">finish</button>
  	</div>
    <div class="input-group anotherdaybutton">
  		<button type="submit" class="btn" name="next_day">Create another day</button>
    </div>
    <div class="input-group cancelbutton1">
  		<button type="submit" class="btn cancelbutton" name="cancelandeleteentry">Cancel and delete</button>
    </div>
</div>

  

   


</body>
</html>


