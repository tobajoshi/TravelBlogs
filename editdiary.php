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
  <a href="#home">MyProfil</a>
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
  <div class="header editdiaryheader">
  	<h2>Click on the diary you want to edit</h2>
  </div>
  
  <form class="content editdiary" method="post" action="editdiary.php">
    <?php include('errors.php'); ?>
    <div class="diarytable"> 
    <table class="striped" style="width: 100%">
        <tr class="header">
            <td>Diaryname</td>
            <td>Entries</td>
        </tr>
          
        <?php
           while ($row = $result->fetch_assoc()) {
               $blogname = $row["blogname"];
               echo "<td><a class='nicelinks' href='showentries.php?blogn=$blogname'>".$row["blogname"]."</a></td>";
               echo "<td style='text-align: center;'>".$row['count(entryID)']."</td>";
               echo "</tr>";
           }
        ?>
    </table>
    </div>
    <div class="input-group createnewdiaryfromlist">
      <button type="submit" class="btn" name="createnewdiary_list">Create new Diary</button>
          </div>
    <div class="input-group cancelbutton1">
      <button type="submit" class="btn cancelbutton" name="canceltodashboard">Cancel</button>
          </div>
  </form>
  </div>
</body>
</html>
