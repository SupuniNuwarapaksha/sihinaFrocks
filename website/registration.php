<?php
$currentpage=$_SERVER['REQUEST_URI'];
echo $currentpage;
// Include config file
include('../config/connectDB.php');

 
//define variables and errors with empty values
$username = $email = $address = $mobile = $password = $confirm_password = "";
$username_err = $email_err = $address_err = $mobile_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $username=trim($_POST["username"]);
        $sql= "SELECT id FROM users WHERE username='$username'";
       // if(mysqli_query($conn,$sql)) echo "Success";
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter your email.";
    } else{
        $email=trim($_POST["email"]);
        $sql= "SELECT id FROM users WHERE email='$email'";
       // if(mysqli_query($conn,$sql)) echo "Success";
    }

    // addres
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter your email.";
    } else{
            $address = trim($_POST["address"]);
        }
    

    // mobile
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "Please enter your email.";
    } else{
            $mobile = trim($_POST["mobile"]);
        }
    
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    $param_password = md5($_POST['password']); 

    $sql="INSERT INTO users(username,email,mobnumber,address,password) VALUES ('$username', '$email' , '$mobile' , '$address' , '$param_password' )";
    if(mysqli_query($conn,$sql)){
        
    }
    
    // Close connection
   // mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper" id="loginform">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                <label>Contact Number</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo $mobile; ?>">
                <span class="help-block"><?php echo $mobile_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>