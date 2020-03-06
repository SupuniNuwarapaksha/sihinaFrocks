<?php
if(isset($_GET['search'])){
  $query = htmlspecialchars($_GET['query']); 
 // echo $query;

 $sql="SELECT * FROM frock WHERE (`fcode` LIKE '%".$query."%') OR (`fname` LIKE '%".$query."%')";
 $results = mysqli_query($conn,$sql);

 $frocks=mysqli_fetch_all($result, MYSQLI_ASSOC);
 echo $frocks;

}
?>

<center>
<form action="index.php" method="GET">
<input type="text" name="query">
<input type="submit" name="search">
</form>
</center>