<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


include('../config/connectDB.php');


//appoitments for today
$sql='SELECT * FROM `appointment`';
$result=mysqli_query($conn,$sql);
$appointments=mysqli_fetch_all($result, MYSQLI_ASSOC);

  if(isset($_POST['Delete'])){
    $id_to_delete= mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql="UPDATE appointment SET accept=2 WHERE id='$id_to_delete'";

    if(mysqli_query($conn,$sql)){
        header('Location: appointment.php');
    }else{
      echo "Error ".mysqli_error($conn);
    }
  }

  if(isset($_POST['accept'])){
    $id_to_accept= mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql="UPDATE appointment SET accept=1 WHERE id='$id_to_accept'";

    if(mysqli_query($conn,$sql)){
        header('Location: appointment.php');
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


<center><h1 style="background-color:#D0D5B8;">Appointments to Accept</h1></center>
<table width="100">
<tr>
  <th>id</th>
  <th>Name</th>
  <th>Date</th>
  <th>hour</th>
</tr>
<?php foreach($appointments as $appointment) :?> 
<?php
$today = date("Y-m-d");
$date = $appointment['fdate'];

if ($appointment['accept']==0) { ?>
<tr> 
  <th><?php echo htmlspecialchars($appointment['id']);  ?></th>
  <th><?php echo htmlspecialchars($appointment['uname']);  ?></th>
  <th><?php echo htmlspecialchars($appointment['fdate']);  ?></th>
  <th><?php echo htmlspecialchars($appointment['hour']);  ?></th>
  <th>
    <form action="appointment.php" method="POST"> 
        <input type="hidden" name="id_to_delete" value="<?php echo $appointment['id']; ?>">
        <input type="submit" name="accept" value="Accept" >
        <input type="submit" name="Delete" value="Delete" >
    </form>
  </th>
  </tr>
<?php
}
?>
<?php endforeach; ?>
</table>

<center><h1 style="background-color:#D0D5B8;">Accepted Appointments</h1></center>
<table width="100">
<tr>
<th>id</th>
  <th>Name</th>
  <th>Date</th>
  <th>hour</th>
</tr>
<?php foreach($appointments as $appointment) :?> 
<?php
$today = date("Y-m-d");
$date = $appointment['fdate'];

if ($appointment['accept']==1) { ?>
<tr> 
  <th><?php echo htmlspecialchars($appointment['id']);  ?></th>
  <th><?php echo htmlspecialchars($appointment['uname']);  ?></th>
  <th><?php echo htmlspecialchars($appointment['fdate']);  ?></th>
  <th><?php echo htmlspecialchars($appointment['hour']);  ?></th>
  </tr>
<?php
}
?>
<?php endforeach; ?>
</table>



<?php include('templates/footer.php') ?>
</html> 