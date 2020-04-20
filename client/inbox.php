<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


include('../config/connectDB.php');

$sql='SELECT * FROM message ORDER BY added_at DESC';

$result=mysqli_query($conn,$sql);

$messages=mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<html>
<?php include('templates/header.php') ?>
<table>
  <tr>
  <th>Name</th>
  <th>Email</th>
  <th>Contact Number</th>
  <th>Message</th>
  <th></th>
  
  </tr>
 

  <?php foreach($messages as $message) :?> 
  <tr > 
  <th><?php echo htmlspecialchars($message['fname']);  ?></th>
  <th><?php echo htmlspecialchars($message['email']);  ?></th>
  <th><?php echo htmlspecialchars($message['phone']);  ?></th>
  <th><?php echo htmlspecialchars($message['message']);  ?></th>
  <th><a href="reply.php?id=<?php echo $message['id'] ?>">Reply</a></th>
  </tr>
 <?php endforeach; ?>
 

</table>
<?php include('templates/footer.php') ?>
</html>