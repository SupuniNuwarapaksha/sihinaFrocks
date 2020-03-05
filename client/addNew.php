<?php
include('../config/connectDB.php');
$Name= $Code= $Type= $Price= $Material= $Size= $photo= $description='';
$errors= array('Name'=> '', 'Code'=>'', 'Type'=>'', 'Price'=>'', 'Material'=>'', 'Size'=>'', 'photo'=>'', 'description'=>'');

if(isset($_POST['submit'])){
    if(empty($_POST['Name'])){
        $errors['Name']=  'This field is required';
      } else{
        $Name=$_POST['Name'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $Name)){
          $errors['Name']= 'Enter a valid name';
        }
      }


      if(empty($_POST['Code'])){
        $errors['Code']=  'This field is required';
      } else{
        $Code=$_POST['Code'];
        
      }


      if(empty($_POST['Type'])){
        $errors['Type']=  'This is required';
      } else{
        $Type=$_POST['Type'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $Type)){
          $errors['Type']= 'Enter a valid name';
        }
      }

      if(empty($_POST['Material'])){
        $errors['Material']=  'This is required';
      } else{
        $Material=$_POST['Material'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $Material)){
          $errors['Material']= 'Enter a valid name';
        }
      }

      if(empty($_POST['Size'])){
        $errors['Size']=  'This is required';
      } else{
        $Size=$_POST['Size'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $Size)){
          $errors['Size']= 'Enter a valid name';
        }
      }

      if(empty($_POST['photo'])){
        $errors['photo']=  'This is required';
      } else{
        $photo=$_POST['photo'];
        
      }

      $description=$_POST['description'];

      
      if(!array_filter($errors)){
        $Name= mysqli_real_escape_string($conn, $_POST['Name']);
        $Code= mysqli_real_escape_string($conn, $_POST['Code']);
        $Type= mysqli_real_escape_string($conn, $_POST['Type']);
        $Price= mysqli_real_escape_string($conn, $_POST['Price']);
        $Material= mysqli_real_escape_string($conn, $_POST['Material']);
        $Size= mysqli_real_escape_string($conn, $_POST['Size']);
        $photo= mysqli_real_escape_string($conn, $_POST['photo']);
        $description= mysqli_real_escape_string($conn, $_POST['description']);
    
        //sql statement
        $sql="INSERT INTO frock(fname,fcode,ftype,price,material,size,link,fdescription) VALUES ('$Name', '$Code', '$Type', '$Price', '$Material', '$Size', '$photo', '$description')";
        if(mysqli_query($conn,$sql)){
         header('Location: index.php');
         //echo $pass;
        } else {
          echo 'Error '.mysqli_error($conn);
        }
    
        
      }

}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>

<center>
<form style="background-color:rgb(60, 60, 60);" class="form1" action="addNew.php" method="POST">
<h1>Add a New Dress</h1>
  <label for="Name">Name:</label><br>
  <input type="text" name="Name" style="#FFF" value="<?php echo htmlspecialchars($Name);?>" ><br>
  <div><?php echo $errors['Name']; ?></div>
  <br>

  <label for="Code">Code:</label><br>
  <input type="text"  name="Code" style="#FFF" value="<?php echo htmlspecialchars($Code);?>" ><br>
  <div><?php echo $errors['Code']; ?></div>
  <br>

  <label for="Type">Type:</label><br>
  <input type="text"  name="Type" style="#FFF" value="<?php echo htmlspecialchars($Type);?>"><br>
  <div><?php echo $errors['Type']; ?></div>
  <br>

  <label for="Price">Rental Price:</label><br>
  <label for="Price">Rs:</label> <input type="number"  name="Price" style="#FFF" min="5000" value="<?php echo htmlspecialchars($number);?>"><br>
  <div><?php echo $errors['Price']; ?></div>
  <br>

  
  <label for="Material">Material:</label><br>
  <input type="text"  name="Material" style="#FFF" value="<?php echo htmlspecialchars($Material);?>"><br>
  <div><?php echo $errors['Material']; ?></div>
  <br>

  <label for="Size">Choose a Size:</label>
  <br>
  <select id="Size" name="Size">
    <option value="volvo">Adjustable</option>
    <option value="audi">XXS</option>
    <option value="saab">XS</option>
    <option value="fiat">S</option>
    <option value="audi">M</option>
    <option value="audi">L</option>
    <option value="audi">XL</option>
    <option value="audi">XXL</option>
  </select>
  <br>
  <div><?php echo $errors['Size']; ?></div>
  <br>

  <label for="photo">Link to the Photo:</label><br>
  <input type="text"  name="photo" style="#FFF" value="<?php echo htmlspecialchars($photo);?>"><br>
  <div><?php echo $errors['photo']; ?></div>
  <br>

  <label for="description">Description:</label><br>
  <textarea type="text"  name="description" style="#FFF" value="<?php echo htmlspecialchars($description);?>"></textarea><br>
  <div><?php echo $errors['description']; ?></div>
  <br>
  


  <div> <input type="submit"  name="submit" class="button button5"></div>

</form>
</center>

<?php include('templates/footer.php') ?>
</html> 
