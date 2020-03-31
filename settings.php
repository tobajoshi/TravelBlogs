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
  <a href="#home">My Profil</a>
  <a href="#news">Feed</a>
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

<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
  

   


</body>
</html>


