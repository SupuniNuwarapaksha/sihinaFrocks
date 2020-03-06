<?php
include('../config/connectDB.php');

$sql='SELECT fname,fcode,price,material,size,link,fdescription FROM frock';

$result=mysqli_query($conn,$sql);

$frocks=mysqli_fetch_all($result, MYSQLI_ASSOC);




if(isset($_POST['Delete'])){
    $id_to_delete= mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql="DELETE FROM frock WHERE fcode='$id_to_delete'";

    if(mysqli_query($conn,$sql)){
      header('Location: index.php');
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
<form action="index.php" method="POST"> 
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