<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include('../config/connectDB.php');



  

$sql='SELECT * FROM order_item WHERE accept=1 ORDER BY ordered_date DESC';

$result=mysqli_query($conn,$sql);

$orders=mysqli_fetch_all($result, MYSQLI_ASSOC);
//print_r($frocks);



//free the result variable
mysqli_free_result($result);

//close the database
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>


<?php foreach($orders as $order) {
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
<?php } ?>

<?php include('templates/footer.php') ?>
</html> 