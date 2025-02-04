<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


include('../config/connectDB.php');

$sql='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY added_at DESC';

$result=mysqli_query($conn,$sql);

$frocks=mysqli_fetch_all($result, MYSQLI_ASSOC);




if(isset($_POST['Delete'])){
    $id_to_delete= mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql="DELETE FROM frock WHERE fcode='$id_to_delete'";

    if(mysqli_query($conn,$sql)){
      header('Location: view.php');
    }else{
      echo "Error ".mysqli_error($conn);
    }
  }

//free the result variable
mysqli_free_result($result);

//close the database
mysqli_close($conn);

?>
<html>
<?php include('templates/header.php') ?>
<?php include('./searchbar.php') ?>

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
<?php foreach($frocks as $frock) :?> 
<table opacity: 0.5;>
<tr>
<th height="200" width="200">
<?php $linkToPic=str_replace("open","uc",$frock['link']);?>
<img src="<?php echo $linkToPic ?>" alt="" height="200" width="200">
</th>
<th>
<ul><h3>
<li><?php echo htmlspecialchars($frock['fname']);  ?></li>
<li><?php echo htmlspecialchars($frock['fcode']);  ?></li>
<li><?php echo htmlspecialchars($frock['price']);  ?></li>
<li><?php echo htmlspecialchars($frock['material']);  ?></li>
<li><?php echo htmlspecialchars($frock['size']);  ?></li>
<li><?php echo htmlspecialchars($frock['fdescription']);  ?></li>
<div style="width:500px;">
<div style="float: left; width: 130px"><button type="submit" class="msgBtn" onclick="window.location.href='viewFrockById.php?id=<?php echo $frock['fcode'] ?>'" >Edit or Publish</button></div>
<form action="view.php" method="POST"> 
<input type="hidden" name="id_to_delete" value="<?php echo $frock['fcode'] ; ?>">
<input type="submit" name="Delete" value="Delete" >
</form>
</div>
</h3>
</ul>
</th>
</tr>
</table>
<?php endforeach; ?>



<?php include('templates/footer.php') ?>
</html> 