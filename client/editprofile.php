<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$user=$_SESSION["username"];

include('../config/connectDB.php');

$sql="SELECT user_name,email FROM user_account WHERE user_name='$user'";
$result=mysqli_query($conn,$sql);

$userDetails=mysqli_fetch_assoc($result);
//print_r($userDetails);

?>
<html>
<?php include('templates/header.php') ?>


<center>

<form   action="editprofile.php" method="POST" id="editfrom">

<center><h1>Edit Profile</h1></center>
  <label for="Name">User Name:</label><br>
  <input type="text" name="Name" style="#FFF" value="<?php echo htmlspecialchars($userDetails['user_name']);?>" ><br>
  <br>

  <label for="Code">Email:</label><br>
  <input type="text"  name="Code" style="#FFF" value="<?php echo htmlspecialchars($userDetails['email']);?>" ><br>
  <br>

  <div> <input type="submit"  name="Update" class="button button5"></div>
  <a href="changepwd.php">Change Password</a>
</form>

</center>

<center>
<div> <input  type="button" onclick="window.location.href = 'logout.php';" class="button button5" value="Logout"></div>
</center>

<?php include('templates/footer.php') ?>
</html>
