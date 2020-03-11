<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_GET['search'])){
    $query = htmlspecialchars($_GET['query']); 
    echo $query;
  
  }
?>

<center>
<form action="index.php" method="GET">
<input type="text" name="query">
<input type="submit" name="search">
</form>
</center>