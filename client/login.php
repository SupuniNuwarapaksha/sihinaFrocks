<?php
// Initialize the session
session_start();
 
//Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
 }
 
// Include config file
include('../config/connectDB.php');
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    $sql="SELECT * FROM user_account WHERE user_name='$username'";
    $result=mysqli_query($conn,$sql);
    

    $user=mysqli_fetch_assoc($result);

   // echo $user['passwd'];

   if($user['passwd']==$password){
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username; 

    header("location: index.php");
   } else {
    $password_err = "The password you entered was not valid.";
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
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <center>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            </center>
            <center>
            <p><a href="changepw.php">Forgot Password? </a>.</p>
            </center>
        </form>
        
    </div>   
</div>   
</body>
</html>