<?php include('server.php');
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
</head>
<body>
<div class="navbar">
  <div class="headtitle">
    <article>Travelblogs</article>
  </div>
  <a href="#">MyProfil</a>
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
  <div class="header newdiaryheader">
  	<h2>Create a new Diary</h2>
  </div>


  <form class="content newdiary" method="post" action="newdiary.php">
  	<?php include('errors.php'); ?>
	  <div class = "input-group newdiaryname">
		<label>Diaryname</label>
		<input type="text" name="diaryname" value="<?php echo $blogname; ?>">
		</div>
  	<div class="input-group creatediarybutton">
  	  <button type="submit" class="btn" name="setdiaryname">Done</button>
    </div>
    <div class="input-group cancelbutton2">
      <button type="submit" class="btn cancelbutton" name="canceltodashboard">Cancel</button>
          </div>
  </form>
</div>
</body>
</html>