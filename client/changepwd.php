<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
include('../config/connectDB.php');
 
// Define variables and initialize with empty values
$opassword = $npassword = $cpassword = "";
$opassword_err = $npassword_err = $cpassword_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check if password is empty
    if(empty(trim($_POST["opassword"]))){
        $opassword_err = "Please enter your old password.";
    } else{
        $opassword = trim($_POST["opassword"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["npassword"]))){
        $npassword_err = "Please enter new password.";
    } else{
        $npassword = trim($_POST["npassword"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["cpassword"]))){
        $cpassword_err = "Please enter your password.";
    } else{
        $cpassword = trim($_POST["cpassword"]);
    }

    if($cpassword != $npassword) {
        $cpassword_err = $npassword_err = "Password doesn't match";
    }


    $username= $_SESSION["username"];
    $sql="SELECT passwd FROM user_account WHERE user_name='$username'";
    $result=mysqli_query($conn,$sql);
    $user=mysqli_fetch_assoc($result);

    $password=md5($_POST['opassword']); 
    if($user['passwd']==$password){
        if($opassword_err=="" && $npassword_err=="" && $cpassword_err==""){
        $param_password = md5($_POST['npassword']); 
        $sql1="UPDATE user_account SET passwd='$param_password' WHERE user_name='$username'";
        if(mysqli_query($conn,$sql1)){
            header("location: temp.php");
        } }
       
    } else {
        $opassword_err= "Please enter the correct password";
    }

   
}
    
    
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ 
            font: 14px sans-serif;
            background-image: url('login.jpg');
            }

        .wrapper{ 
            
            width: 350px; 
            padding: 20px; 
            background-color: #C6D6E8;
        }

        #centering{
            padding: 200px 600px;

        }
    </style>
</head>
<body>
<div id="centering">
    <div class="wrapper">
    
        <center><h2>Login</h2></center>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
            <div class="form-group <?php echo (!empty($opassword_err)) ? 'has-error' : ''; ?>">
                <label>Old Password</label>
                <input type="password" name="opassword" class="form-control">
                <span class="help-block"><?php echo $opassword_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($npassword_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="npassword" class="form-control">
                <span class="help-block"><?php echo $npassword_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($cpassword_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="cpassword" class="form-control">
                <span class="help-block"><?php echo $cpassword_err; ?></span>
            </div>
            <center>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Change">
            </div>
            </center>
        </form>
        
    </div>   
</div>   
</body>
</html>