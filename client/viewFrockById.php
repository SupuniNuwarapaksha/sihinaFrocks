<?php
include('../config/connectDB.php');



if(isset($_GET['id'])){
    $code=mysqli_real_escape_string($conn, $_GET['id']);

    $sql="SELECT * FROM frock WHERE fcode='$code'";

    $result=mysqli_query($conn,$sql);
    
    $frock=mysqli_fetch_assoc($result);
       
    //free the result variable
    mysqli_free_result($result);

    //close the database
    mysqli_close($conn);
   // print_r($frock);
}

if(isset($_POST['Update'])){
    $code=mysqli_real_escape_string($conn, $_POST['Code']);
   // echo $code;

   $Name=mysqli_real_escape_string($conn, $_POST['Name']);
   $Type=mysqli_real_escape_string($conn, $_POST['Type']);
   $Price=mysqli_real_escape_string($conn, $_POST['Price']);
   $Material=mysqli_real_escape_string($conn, $_POST['Material']);
   $Size=mysqli_real_escape_string($conn, $_POST['Size']);
  // $Publish=mysqli_real_escape_string($conn, $_POST['Publish']);
  
    $sql="UPDATE frock SET fname='$Name',ftype='$Type',price=$Price,material='$Material',size='$Size' WHERE fcode='$code'";
    
    if(mysqli_query($conn,$sql)){
        
      }else{
        echo "Error ".mysqli_error($conn);
      }
}
?>

<html>
<?php include('templates/header.php') ?>
<center>
<?php $linkToPic=str_replace("open","uc",$frock['link']);?>
<img src="<?php echo $linkToPic ?>" alt=""  width="700">
</center>

<center>
<center><h1>View Frock Details</h1></center>
<form   action="viewFrockById.php" method="POST">
  <label for="Name">Name:</label><br>
  <input type="text" name="Name" style="#FFF" value="<?php echo htmlspecialchars($frock['fname']);?>" ><br>
  <br>

  <label for="Code">Code:</label><br>
  <input type="text"  name="Code" style="#FFF" value="<?php echo htmlspecialchars($frock['fcode']);?>" ><br>
  <br>

  <label for="Type">Type:</label><br>
  <input type="text"  name="Type" style="#FFF" value="<?php echo htmlspecialchars($frock['ftype']);?>"><br>
  <br>

  <label for="Price">Rental Price:</label><br>
  <label for="Price">Rs:</label> <input type="number"  name="Price" style="#FFF" min="5000" value="<?php echo htmlspecialchars($frock['price']);?>"><br>
  <br>

  
  <label for="Material">Material:</label><br>
  <input type="text"  name="Material" style="#FFF" value="<?php echo htmlspecialchars($frock['material']);?>"><br>
  <br>

  <label for="Size">Size:</label><br>
  <input type="text"  name="Size" style="#FFF" value="<?php echo htmlspecialchars($frock['size']);?>"><br>
  <br>

  <label for="Publish"> Publish</label><br>
  <input type="checkbox"  name="Publish" value="1">
  

  <div> <input type="submit"  name="Update" class="button button5"></div>

</form>

</center>



<?php include('templates/footer.php') ?>
</html>