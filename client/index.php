<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


include('../config/connectDB.php');

//orders to be accepted
$sql='SELECT * FROM order_item WHERE accept=0';
$result=mysqli_query($conn,$sql);
$orders=mysqli_fetch_all($result, MYSQLI_ASSOC);

//orders to be delivered
$sql='SELECT * FROM order_item WHERE accept=1';
$result=mysqli_query($conn,$sql);
$accepted_orders=mysqli_fetch_all($result, MYSQLI_ASSOC);

//appoitments for today
$sql='SELECT * FROM `appointment`';
$result=mysqli_query($conn,$sql);
$appointments=mysqli_fetch_all($result, MYSQLI_ASSOC);

if(isset($_POST['Delete'])){
    $id_to_delete= mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql="DELETE FROM frock WHERE fcode='$id_to_delete'";

    if(mysqli_query($conn,$sql)){
      header('Location: index.php');
    }else{
      echo "Error ".mysqli_error($conn);
    }
  }


  if(isset($_POST['Delete'])){
    $id_to_delete= mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql="UPDATE order_item SET accept=2 WHERE id='$id_to_delete'";

    if(mysqli_query($conn,$sql)){
        header('Location: accept.php');
    }else{
      echo "Error ".mysqli_error($conn);
    }
  }

  if(isset($_POST['accept'])){
    $id_to_delete= mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql="UPDATE order_item SET accept=1 WHERE id='$id_to_delete'";

    if(mysqli_query($conn,$sql)){
        header('Location: accept.php');
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

<center><h1 style="background-color:#D0D5B8;">Todays Orders to be Delivered</h1></center>
<?php foreach($accepted_orders as $order) :?> 
<?php
$today = date("Y-m-d");
$date = $order['fdate'];

if ($date == $today) { 
  $frockcode=$order['frock_id'];
   // echo $frockcode;
   include('../config/connectDB.php');
   $sql2="SELECT * FROM frock WHERE fcode='$frockcode'";
   $result2=mysqli_query($conn,$sql2);
   $frock=mysqli_fetch_assoc($result2);
   ?>
<table opacity: 0.5;>
<tr>
<th height="200" width="200">
<?php $linkToPic=str_replace("open","uc",$frock['link']);?>
<img src="<?php echo $linkToPic ?>" alt="" height="200" width="200">
</th>
<th>
<ul><h3>
<li><?php echo htmlspecialchars($order['user_name']);  ?></li>
<li>From: <?php echo htmlspecialchars($order['fdate']);  ?></li>
<li>To: <?php echo htmlspecialchars($order['tdate']);  ?></li>
<li>Address: <?php echo htmlspecialchars($order['address']);  ?></li>
<li>Ordered at: <?php echo htmlspecialchars($order['ordered_date']);  ?></li>
<?php
    $a=(strtotime($order['tdate'])-strtotime($order['fdate']))/86400;
    $fee=$a*$frock['price'];
?>
<li>For <?php echo $a; ?> 
<?php if($a==1): ?>day
<?php else : ?> days <?php endif; ?>
</li>
<li>Rental fee: Rs.<?php echo htmlspecialchars($fee);  ?></li>
</h3>
</ul>
</th>
</tr>
</table>

<?php
}
?>
<?php endforeach; ?>

<center><h1 style="background-color:#D0D5B8;">Todays Appointments</h1></center>
<table width="100">
<tr>
  <th>Name</th>
  <th>hour</th>>
</tr>
<?php foreach($appointments as $appointment) :?> 
<?php
$today = date("Y-m-d");
$date = $appointment['fdate'];

if ($date == $today && $appointment['accept']==1) { ?>
<tr> 
  <th><?php echo htmlspecialchars($appointment['uname']);  ?></th>
  <th><?php echo htmlspecialchars($appointment['hour']);  ?></th>
  </tr>
<?php
}
?>
<?php endforeach; ?>
</table>

<center><h1 style="background-color:#D0D5B8;">Todays Orders to be Accepted</h1></center>
<?php foreach($orders as $order) :?> 
<?php
$today = date("Y-m-d");
$date = $order['fdate'];

if ($date == $today) { 
  $frockcode=$order['frock_id'];
   // echo $frockcode;
   include('../config/connectDB.php');
   $sql2="SELECT * FROM frock WHERE fcode='$frockcode'";
   $result2=mysqli_query($conn,$sql2);
   $frock=mysqli_fetch_assoc($result2);
   ?>
<table opacity: 0.5;>
<tr>
<th height="200" width="200">
<?php $linkToPic=str_replace("open","uc",$frock['link']);?>
<img src="<?php echo $linkToPic ?>" alt="" height="200" width="200">
</th>
<th>
<ul><h3>
<li><?php echo htmlspecialchars($order['user_name']);  ?></li>
<li>From: <?php echo htmlspecialchars($order['fdate']);  ?></li>
<li>To: <?php echo htmlspecialchars($order['tdate']);  ?></li>
<li>Address: <?php echo htmlspecialchars($order['address']);  ?></li>
<li>Ordered at: <?php echo htmlspecialchars($order['ordered_date']);  ?></li>
<?php
    $a=(strtotime($order['tdate'])-strtotime($order['fdate']))/86400;
    $fee=$a*$frock['price'];
?>
<li>For <?php echo $a; ?> 
<?php if($a==1): ?>day
<?php else : ?> days <?php endif; ?>
</li>
<li>Rental fee: Rs.<?php echo htmlspecialchars($fee);  ?></li>
<form action="accept.php" method="POST"> 
<input type="hidden" name="id_to_delete" value="<?php echo $order['id'] ; ?>">
<input type="submit" name="accept" value="Accept" >
<input type="submit" name="Delete" value="Delete" >
</form>
</h3>
</ul>
</th>
</tr>
</table>

<?php
}
?>
<?php endforeach; ?>



<?php include('templates/footer.php') ?>
</html> 