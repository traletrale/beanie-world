<!DOCTYPE html>
<html>
<html lang="en">
 <head>
 <title>Create Account</title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="finalprojectstyle.css">
</head>
<head>
    <body>
<header>
 <nav>
<ul>
  <li><a href="homepage.php">Beanie World</a></li> 
  <li><a href="mycollection.php">My Collection</a></li> 
  <li><a href="browsecollections.php">Browse Collections</a></li> 
  <li><a href="market.php">Market</a></li> 
  <li><a href="trading.php">Trading</a></li>
</ul>
 </nav>
</header>
</head>
<body>
<ul> 
<br>
<br>
<?php

$hn = 'localhost';  
$db = 'btevis_638';  
$un = 'btevis_mysql';  
$pw = 'sldUEQ53gLJ6'; 

session_start(); 
  
if (isset($_POST['submit'])) { //check if the form has been submitted
  if ( empty($_POST['username']) || empty($_POST['password']) ) {
    echo "<p>Please fill out all of the form fields!</p>";
  } else {
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    $username = sanitizeMySQL($conn, $_POST['username']);
    $password = sanitizeMySQL($conn, $_POST['password']);     
    $salt1 = "qm&h*";  
    $salt2 = "pg!@";  
    $password = hash('ripemd128', $salt1.$password.$salt2);
    $query  = "SELECT * FROM collector WHERE username='$username' AND password='$password'"; 
    $result = $conn->query($query);    
    if (!$result) die($conn->error); 
    $rows = $result->num_rows;
    if ($rows==1) {
      $row = $result->fetch_assoc();
      $_SESSION['collectorID'] = $row['collectorID'];
      $_SESSION['username'] = $row['username']; 
      header("location: mycollection.php");       
    } else {

    }
  }
}
function sanitizeString($var)
{
  $var = stripslashes($var);
  $var = strip_tags($var);
  $var = htmlentities($var);
  return $var;
}
function sanitizeMySQL($connection, $var)
{
  $var = sanitizeString($var);
  $var = $connection->real_escape_string($var);
  return $var;
}

?>
<fieldset style="width:30%"><legend>Create Account</legend>
<form method="POST" action="createaccount.php">
Username:<br><input type="text" name="username" size="40"><br>
Password:<br><input type="password" name="password" size="40"><br>
<input type="submit" name="submit" value="Create Account">
</form>
</fieldset>
</ul>
</body>
</html>