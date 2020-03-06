<?php
include('../config/connectDB.php');

$sql='SELECT fname,fcode,price,material,size FROM frock';

$result=mysqli_query($conn,$sql);

$frocks=mysqli_fetch_all($result, MYSQLI_ASSOC);

//free the result variable
mysqli_free_result($result);

//close the database
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>
<?php foreach($frocks as $frock) :?> 

<?php endforeach; ?>

<table>
  <tr>
  <th>Name</th>
  <th>Code</th>
  <th>Price</th>
  <th>Material</th>
  <th>Size</th>
  <th>More</th>
  
  </tr>

  <?php foreach($frocks as $frock) :?> 
  <tr> 
  <th><?php echo htmlspecialchars($frock['fname']);  ?></th>
  <th><?php echo htmlspecialchars($frock['fcode']);  ?></th>
  <th><?php echo htmlspecialchars($frock['price']);  ?></th>
  <th><?php echo htmlspecialchars($frock['material']);  ?></th>
  <th><?php echo htmlspecialchars($frock['size']);  ?></th>
  <th><a href="viewFrockById.php?id=<?php echo $frock['fcode'] ?>">More</a></th>
  </tr>
 <?php endforeach; ?>

</table>

<?php include('templates/footer.php') ?>
</html> 