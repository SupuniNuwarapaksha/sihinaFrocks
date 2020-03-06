<?php
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