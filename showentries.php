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
  	<h2>Choose an entry</h2>
  </div>
  
  <form class="content editdiary" method="post" action="editdiary.php">
    <?php include('errors.php'); ?>
    <div class="diarytable"> 
    <table class="striped" style="width: 100%">
        <tr class="header">
            <td>Location</td>
            <td>Date</td>
        </tr>

        <?php
           while ($row = $result3->fetch_assoc()) {
                $entryident = $row["entryID"];
               echo "<td><a class='nicelinks' href='editentry.php?entryident=$entryident'>".$row["mylocation"]."</a></td>";
               echo "<td style='text-align: center;'>".$row['daydate']."</td>";
               echo "</tr>";
           }
        ?>
    </table>
    </div>
    <div class="input-group createnewdiaryfromlist">
      <button type="submit" class="btn" name="createnewentry_list">Create new Entry</button>
          </div>
    <div class="input-group cancelbutton1">
      <button type="submit" class="btn cancelbutton" name="canceltodiarylist">Cancel</button>
          </div>
  </form>
  </div>
</body>
</html>