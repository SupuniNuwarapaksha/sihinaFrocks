<?php

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include('../config/connectDB.php');

$code="";

if(isset($_GET['id'])){
    $code=mysqli_real_escape_string($conn, $_GET['id']);

    $sql="SELECT * FROM message WHERE id='$code'";

    $result=mysqli_query($conn,$sql);
    
    $message=mysqli_fetch_assoc($result);
       
    //free the result variable
    mysqli_free_result($result);

    //close the database
    mysqli_close($conn);
   // print_r($frock);
}

?>
<html>
<?php include('templates/header.php') ?>
<center>
<div class="container">

	<?php 
		if(isset($_POST['sendmail'])) {
			require 'PHPMailerAutoload.php';
			require 'credential.php';

			$mail = new PHPMailer;

			// $mail->SMTPDebug = 4;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';
            $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = EMAIL;                 // SMTP username
			$mail->Password = PASS;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom(EMAIL, 'Dsmart Tutorials');
			$mail->addAddress($_POST['email']);     // Add a recipient

			$mail->addReplyTo(EMAIL);
			// print_r($_FILES['file']); exit;
			for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
				$mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
			}
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = $_POST['subject'];
			$mail->Body    = '<div style="border:2px solid red;">This is the HTML message body <b>in bold!</b></div>';
			$mail->AltBody = $_POST['message'];

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
		}
	 ?>
	<div class="row">
    <div class="col-md-9 col-md-offset-2">
        <form role="form" method="post" enctype="multipart/form-data" style="background-color:rgb(60, 60, 60);" class="form1">
        	<div class="row">
                <div class="col-sm-9 form-group">
                    <label for="email">FROM: <?php echo $message['email']; ?></label>
                    <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $message['email']; ?> " maxlength="50">
                </div>
            </div>
            <div class="row" >
                <div class="col-sm-9 form-group">
                    <label for="email">Message: <?php echo $message['message']; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 form-group">
                    <input type="hidden" class="form-control" id="subject" name="subject" value="Reply for your message" maxlength="50">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="name">Message:</label>
                    <br>
                    <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Your Message Here" maxlength="6000" rows="4">Test mail using PHPMailer</textarea>
                </div>
            </div>
         
             <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block">Send</button>
                </div>
            </div>
        </form>
	</div>
</div>
</center>
</html>