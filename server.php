<?php
session_start();

// initializing variables
$lastname = "";
$firstname ="";
$username = "";
$email    = "";
$password = "";
$password_1 = "";
$password_2 = "";
$errors = array(); 

//new Diary Varibles
$userid=0;
$blogid=0;
$blogname="";
$daydate= date("Y-m-d");
$entry="";
$location="";


// connect to the database
$db = mysqli_connect("localhost", "root", "-----", "SignUps");
if (!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($lastname)) { array_push($errors, "Last name is required"); }
  if (empty($firstname)) { array_push($errors, "First name is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM SignUpData WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO SignUpData (lastname, firstname, username, email, password) 
  			  VALUES('$lastname', '$firstname','$username', '$email', '$password')";
  	mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $query = "SELECT UserID FROM SignUpData WHERE username='$username'";
    $result = mysqli_query($db, $query);
    $row = $result->fetch_assoc();
    $userid = (int) $row['UserID'];
    $_SESSION['userid'] =$userid;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ... 
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM SignUpData WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          $query = "SELECT UserID FROM SignUpData WHERE username='$username'";
          $result = mysqli_query($db, $query);
          $row = $result->fetch_assoc();
          $userid = (int) $row['UserID'];
          $_SESSION['userid'] =$userid;
          header('location: index.php');
        }
        else {
            array_push($errors, "Wrong username/password combination");
        } 
    }
  }


//create new diary

if (isset($_POST['setdiaryname'])) {
$blogname= mysqli_real_escape_string($db, $_POST['diaryname']);
$userid = $_SESSION['userid'];

// check if user already created a diary with the same name
$user_check_query = "SELECT * FROM Travelblog WHERE blogname='$blogname' AND userid= '$userid' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // if diary exists
  if ($user['blogname'] === $blogname) {
    array_push($errors, "blogname already exists");
  }
}
if (count($errors) == 0) {
$userid = $_SESSION['userid'];
$query = "INSERT INTO Travelblog (userid, blogname) 
          VALUES('$userid', '$blogname')";
          mysqli_query($db, $query);
$userid = $_SESSION['userid'];
$query = "SELECT blogID FROM Travelblog WHERE blogname='$blogname' AND userID = '$userid' ";
$result = mysqli_query($db, $query);
$row = $result->fetch_assoc();
$blogid = (int) $row['blogID'];
$_SESSION['blogid'] =$blogid;
  header('location: writeentry.php');
  }
}

//Make new Day

if (isset($_POST['finish_entry'])) {
  $daydate= mysqli_real_escape_string($db, $_POST['daydate']);
  $location=mysqli_real_escape_string($db, $_POST['location']);
  $entrytext=mysqli_real_escape_string($db, $_POST['entrytext']);
  $blogid = $_SESSION['blogid'];
  $userid = $_SESSION['userid'];
  $query = "INSERT INTO TravelblogEntries (blogid ,userid, daydate, mylocation, entrytext) 
            VALUES('$blogid','$userid', '$daydate', '$location','$entrytext')";
    mysqli_query($db, $query);
    unset($_SESSION['blogid']);
    header('location: dashboard.php');
  }

  // make another day
  if (isset($_POST['next_day'])) {
    $daydate= mysqli_real_escape_string($db, $_POST['daydate']);
    $location=mysqli_real_escape_string($db, $_POST['location']);
    $entrytext=mysqli_real_escape_string($db, $_POST['entrytext']);
    $blogid = $_SESSION['blogid'];
    $userid = $_SESSION['userid'];
    $query = "INSERT INTO TravelblogEntries (blogid ,userid, daydate, mylocation, entrytext) 
              VALUES('$blogid','$userid', '$daydate', '$location','$entrytext')";
      mysqli_query($db, $query);
      header('location: writeentry.php');
    }
  // show all diarys

  if(isset($_GET['usern'])){
  $userid = $_SESSION['userid'];
  $query = "SELECT blogname, count(entryID) FROM 
  (SELECT * FROM Travelblog WHERE UserID = '$userid') as A
   INNER JOIN TravelblogEntries as B
   USING (blogID) 
   group by blogname";
  $result = mysqli_query($db, $query);
}

  // show all entries
  if(isset($_GET['blogn']))
  {
    $_SESSION['blogname'] = $_GET['blogn'];
    $blogname = $_SESSION['blogname'];
    $userid = $_SESSION['userid'];
    $query = "SELECT blogID FROM Travelblog WHERE userid = '$userid' AND blogname = '$blogname'";
    $result2 = mysqli_query($db, $query);
    $blogidtable = $result2->fetch_assoc();
    $blogid = (int)$blogidtable['blogID'];
    $_SESSION['blogid'] = $blogid;
    $query = "SELECT entryID, mylocation, daydate FROM TravelblogEntries WHERE blogID = '$blogid' AND userid = '$userid' order by daydate";
    $result3 = mysqli_query($db, $query);
  }

  //create new Diary out of Diary list
  if(isset($_POST['createnewdiary_list']))
  {
    unset ($_SESSION['blogname']);
    unset ($_SESSION['blogid']);
    header('location: newdiary.php');

  }

  if(isset($_POST['canceltodashboard'])){
    unset ($_SESSION['blogname']);
    unset ($_SESSION['blogid']);
    header('location: dashboard.php');
  }

  if(isset($_POST['canceltodiarylist'])){
    unset ($_SESSION['blogname']);
    unset ($_SESSION['blogid']);
    header('location: editdiary.php');
}
if (isset($_POST['createnewentry_list']))
{
  header('location: writeentry.php');
}

if(isset($_POST['canceltodiarylist'])){
  unset ($_SESSION['blogname']);
  unset ($_SESSION['blogid']);
  header('location: editdiary.php?usern=$_SESSION["username"]');
}

if(isset($_GET['entryident'])){
  $entryid = $_GET['entryident'];
  $_SESSION['entryid'] = $entryid;
  $userid = $_SESSION['userid'];
  $query="SELECT daydate, mylocation, entrytext FROM TravelblogEntries WHERE entryID='$entryid' AND userID ='$userid'";
  $result3 = mysqli_query($db, $query);
  $row = $result3->fetch_assoc();
}

if(isset($_POST['update_entry'])){
  $daydate= mysqli_real_escape_string($db, $_POST['daydate']);
  $location=mysqli_real_escape_string($db, $_POST['location']);
  $entrytext=mysqli_real_escape_string($db, $_POST['entrytext']);
  $entryid = $_SESSION['entryid'];
  echo "location";
  $query = "UPDATE TravelblogEntries SET
  daydate = '$daydate',
  mylocation = '$location',
  entrytext = '$entrytext'
  WHERE entryID = '$entryid'";
  mysqli_query($db, $query);
  unset($_SESSION['entryid']);
  unset($_SESSION['blogid']);
  unset($_SESSION['blogname']);
  header("location: dashboard.php");
}
if (isset($_POST['cancelandeleteentry'])){
  unset ($_SESSION['blogname']);
  unset ($_SESSION['blogid']);
  header('location: editdiary.php?usern=$_SESSION["username"]');
}
?>
