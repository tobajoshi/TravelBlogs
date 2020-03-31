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
<style>
  
</style>
</head>
<body>

<div class="navbar">
  <div class="headtitle">
    <article>Travelblogs</article>
  </div>
  <div class="dropdown">
  <button class="dropbtn">Profil
      <i class="fa fa-caret-down"></i>
  </button>
    <div class="dropdown-content">
      <a href="#">Edit Profil</a>
      <a href="settings.php">Settings</a>
  </div>  
  </div>
  <a href="dashboard.php">Feed</a>
  <div class="dropdown">
    <button class="dropbtn">Diary
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="newdiary.php">New Diary</a>
      <a href="editdiary.php?usern=$_SESSION['username']">Edit Diary</a>
  </div>  
</div>
  

   


</body>
</html>


